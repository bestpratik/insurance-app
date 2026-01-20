<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Illuminate\Support\Facades\Log;
use Stripe\Webhook;
use App\Models\Purchase;
use App\Models\Payment;
use App\Models\Insurance;
use Illuminate\Support\Facades\DB;
use Stripe\Checkout\Session as StripeSession;
use Illuminate\Support\Facades\Session;
use PDF;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;


class StripePaymentController extends Controller
{

    public function booking()
    {
       
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $purchaseId = session('pending_purchase_id');

        if (!$purchaseId) {
            return redirect()->route('policy.buyer')->with('error', 'No purchase found.');
        }

        $purchase = Purchase::find($purchaseId);
        if (!$purchase) {
            return redirect()->route('policy.buyer')->with('error', 'Purchase not found.');
        }

        $stripeSession = StripeSession::create([
            'payment_method_types' => ['card'],
            'client_reference_id' => $purchase->id,
            'customer_email' => Auth::user()->email ?? '',
            'line_items' => [[
                'price_data' => [
                    'currency' => 'gbp',
                    'product_data' => [
                        'name' => $purchase->insurance->name,
                    ],
                    'unit_amount' => (int) ($purchase->payable_amount * 100),
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('stripe.success') . '?id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('stripe.cancel'),
        ]);

        $purchase->stripe_session_id = $stripeSession->id;
        $purchase->save();

        return redirect($stripeSession->url);
    }



    public function success(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $sessionId = $request->get('id');
        // dd($sessionId);

        if (!$sessionId) {
            return redirect()->route('policy.buyer')->with('error', 'Missing session ID.');
        }

        try {
            $session = StripeSession::retrieve($sessionId);
            // dd($session);
        } catch (\Exception $e) {
            Log::error('Stripe session fetch error: ' . $e->getMessage());
            return redirect()->route('policy.buyer')->with('error', 'Payment verification failed.'); 
        }

        $purchaseId = session('pending_purchase_id') ?? $session->client_reference_id;
        // dd($purchaseId);

        if ($purchaseId) {
            $purchase = Purchase::find($purchaseId);
            if ($purchase) {
                DB::beginTransaction();

                $purchase->payment_status = 'Paid';
                $purchase->payment_method = 'stripe';
                $purchase->stripe_session_id = Null;
                $purchase->save();

                DB::commit();
            }

            session()->forget('pending_purchase_id');
        }

        return redirect()->route('front.purchase.success', ['purchase_id' => $purchaseId]);

        // return redirect()->route('front.purchase.success');  
        
    } 




    public function cancel()
    {
        session()->forget('pending_purchase_id');
        return redirect()->route('policy.buyer')->with('error', 'Payment was cancelled.');
    }


    // public function handleWebhook(Request $request)
    // {
    //     Log::info('Stripe Webhook Headers:', $request->headers->all());
    //     Log::info('Stripe Webhook Payload:', $request->all());

    //     // $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
    //     $endpoint_secret = env('STRIPE_WEBHOOK_SECRET');
    //     $requestBody = $request->getContent();
    //     $sigHeader = $request->header('Stripe-Signature');

    //     try {
    //         $event = Webhook::constructEvent($requestBody, $sigHeader, $endpoint_secret);

    //         if ($event->type == 'checkout.session.completed') {
    //             $session = $event->data->object;

    //             $purchase = Purchase::where('stripe_session_id', $session->id)->first();

    //             if ($purchase) {
    //             DB::beginTransaction();

    //             DB::table('payments')->insert([
    //                 'txanid' => $event->data->object->id,
    //                 'status' => $event->type,
    //                 'created_at' => now(),
    //                 'updated_at' => now(),
    //             ]);

    //             $purchase->payment_status = 'Paid';
    //             $purchase->save();

    //             DB::commit();
    //         } else {
    //             Log::warning("No matching purchase found for Stripe session ID: {$session->id}");
    //         }
    //         } elseif ($event->type == 'payment_intent.payment_failed') {
    //             $intent = $event->data->object;

    //             DB::table('payments')->insert([
    //                 'txanid' => $intent->id,
    //                 'status' => 'payment_failed',
    //                 'created_at' => now(),
    //                 'updated_at' => now(),
    //             ]);
    //         }

    //         return response()->json(['status' => 'success'], 200);

    //     } catch (\Exception $e) {
    //         DB::rollBack();

    //         DB::table('payments')->insert([
    //             'txanid' => rand(1000, 99999),
    //             'status' => 'error',
    //             'created_at' => now(),
    //             'updated_at' => now(),
    //         ]);
    //         Log::error("Stripe webhook error: " . $e->getMessage());
    //         return response()->json(['error' => 'Webhook handling error'], 400);
    //     }

    //     return response()->json(['status' => 'success']);
    // }


       public function handleWebhook(Request $request)
    {
        Log::info('Stripe Webhook Headers:', $request->headers->all());
        Log::info('Stripe Webhook Payload:', $request->all());

        $endpoint_secret = env('STRIPE_WEBHOOK_SECRET');
        $requestBody = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');

        try {
            $event = Webhook::constructEvent($requestBody, $sigHeader, $endpoint_secret);

            if ($event->type == 'checkout.session.completed') {
                $session = $event->data->object;
                $purchase = Purchase::with('invoice')->where('stripe_session_id', $session->id)->first();

                if ($purchase) {
                    DB::beginTransaction();
                    try {
                        DB::table('payments')->insert([
                            'txanid' => $session->id,
                            'status' => $event->type,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);

                        $purchase->payment_status = 'Paid';
                        $purchase->save();
                        DB::commit();
                    } catch (\Exception $e) {
                        DB::rollBack();
                        Log::error('Error saving payment/purchase in webhook: ' . $e->getMessage());
                    }

                    // Send emails safely
                    try { $this->sent_insurance_mail($purchase->id); } 
                    catch (\Exception $e) { Log::error("Insurance mail error for purchase {$purchase->id}: " . $e->getMessage()); }

                    try { $this->sent_invoice_mail($purchase->id); } 
                    catch (\Exception $e) { Log::error("Invoice mail error for purchase {$purchase->id}: " . $e->getMessage()); }
                } else {
                    Log::warning("No matching purchase found for Stripe session ID: {$session->id}");
                }
            } elseif ($event->type == 'payment_intent.payment_failed') {
                $intent = $event->data->object;
                DB::table('payments')->insert([
                    'txanid' => $intent->id,
                    'status' => 'payment_failed',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            return response()->json(['status' => 'success'], 200);

        } catch (\Exception $e) {
            DB::rollBack();
            DB::table('payments')->insert([
                'txanid' => rand(1000, 99999),
                'status' => 'error',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            Log::error("Stripe webhook error: " . $e->getMessage());
            return response()->json(['error' => 'Webhook handling error'], 400);
        }
    }

    // public function test_mail()
    // {
    //     $purchaseId = 140;  // change to any purchase id for testing
    //     $this->sent_insurance_mail($purchaseId);
    //     $this->sent_invoice_mail($purchaseId);

    //     return response()->json(['message' => "Test emails triggered for Purchase ID: $purchaseId"]);
    // }


    public function sent_insurance_mail($purchase_id)
    {
        $purchase = Purchase::with('invoice')->find($purchase_id);
        if (!$purchase) { Log::warning("Purchase not found: {$purchase_id}"); return; }

        $insurance = Insurance::with('staticdocuments', 'dynamicdocument', 'insurancemailtemplate')
            ->find($purchase->insurance_id);
        if (!$insurance) { Log::warning("Insurance not found for purchase {$purchase_id}"); return; }

        $allDocs = [];

        // ---------- STATIC DOCUMENTS ----------
        foreach ($insurance->staticdocuments ?? [] as $docs) {
            $originalPath = public_path('uploads/insurance_document/' . $docs->document);
            if (file_exists($originalPath)) {
                $ext = pathinfo($docs->document, PATHINFO_EXTENSION);
                $docName = pathinfo($docs->document, PATHINFO_FILENAME);
                $newStaticName = $docName . '-' . $purchase->policy_no . '.' . $ext;
                $newStaticPath = public_path('uploads/insurance_document/' . $newStaticName);
                if (!file_exists($newStaticPath)) File::copy($originalPath, $newStaticPath);
                $allDocs[] = $newStaticPath;
            }
        }

        // ---------- DYNAMIC DOCUMENTS ----------
        $pdfDynamicval = [
            $insurance->name,
            $purchase->policy_no,
            $purchase->policy_holder_address,
            $purchase->policy_start_date ? date('jS F Y', strtotime($purchase->policy_start_date)) : '',
            $purchase->policy_end_date ? date('jS F Y', strtotime($purchase->policy_end_date)) : '',
            $purchase->purchase_date ? date('jS F Y', strtotime($purchase->purchase_date)) : '',
            $purchase->policy_term,
            $purchase->net_premium,
            $purchase->ipt,
            $purchase->payable_amount,
            $purchase->rent_amount,
            $purchase->payable_amount,
        ];

        $riskAddress = trim(implode(' ', [
            $purchase->door_no,
            $purchase->address_one,
            $purchase->address_two,
            $purchase->address_three,
            $purchase->post_code
        ]));

        $insurartitle = $purchase->policy_holder_type == 'Individual' 
            ? trim($purchase->policy_holder_title . ' ' . $purchase->policy_holder_fname . ' ' . $purchase->policy_holder_lname) 
            : ($purchase->policy_holder_type == 'Both' 
                ? $purchase->company_name . '/' . trim($purchase->policy_holder_title . ' ' . $purchase->policy_holder_fname . ' ' . $purchase->policy_holder_lname) 
                : $purchase->company_name);

        $pdfDynamicval[] = $riskAddress;
        $pdfDynamicval[] = $insurartitle;
        $pdfDynamicval[] = $insurance->details_of_cover;

    

        foreach ($insurance->dynamicdocument ?? [] as $dydocs) {
            $file_name = Str::slug($dydocs->title) . '-' . $purchase->policy_no . '.pdf';
            $data = [
                'templateTitle' => $dydocs->title,
                'templateBody' => $dydocs->description,
                'templateHeder' => $dydocs->header,
                'templateFooter' => $dydocs->footer,
                'templatebodyValue' => $pdfDynamicval
            ];

            $dynamicDocPath = public_path('uploads/dynamicdoc/');
            if (!File::exists($dynamicDocPath)) File::makeDirectory($dynamicDocPath, 0755, true);

            $pdfPath = $dynamicDocPath . $file_name;
            PDF::loadView('purchase.pdfs.insurance_dynamic_document_email', ['data' => $data])->save($pdfPath);
            if (file_exists($pdfPath)) $allDocs[] = $pdfPath;
        }

        // ---------- SEND INSURANCE EMAIL ----------
        $sendToemails = [];
        if ($purchase->policy_holder_type === 'Company') $sendToemails[] = $purchase->policy_holder_company_email;
        if ($purchase->policy_holder_type === 'Individual') $sendToemails[] = $purchase->policy_holder_email;
        if ($purchase->policy_holder_type === 'Both') {
            $sendToemails[] = $purchase->policy_holder_email;
            $sendToemails[] = $purchase->policy_holder_company_email;
        }

        $sendToemails = array_filter($sendToemails, fn($email) => filter_var($email, FILTER_VALIDATE_EMAIL));

        $copyEmails = explode(',', $purchase->copy_email);
        $validCopyEmails = array_filter(array_map('trim', $copyEmails), fn($email) => filter_var($email, FILTER_VALIDATE_EMAIL));
        $ccEmails = array_merge(['aadatia@moneywiseplc.co.uk'], $validCopyEmails);

        $email_subject = $insurance->insurancemailtemplate->title ?? '';
        $data = [
            'body' => $insurance->insurancemailtemplate->description ?? '',
            'bodyValue' => $pdfDynamicval
        ];

        if (!empty($sendToemails)) {
            try {
                Mail::send('email.insurance_billing', $data, function ($messages) use ($sendToemails, $allDocs, $email_subject, $ccEmails) {
                    $messages->to($sendToemails); 
                    $messages->subject($email_subject);
                    $messages->cc($ccEmails);
                    $messages->bcc(['bestpratik@gmail.com']);
                    foreach ($allDocs as $attachment) $messages->attach($attachment);
                });
                Log::info("Insurance email sent to: " . implode(', ', $sendToemails));
            } catch (\Exception $e) {
                Log::error("Failed to send insurance email: " . $e->getMessage());
            }
        } else {
            Log::warning("No valid insurance recipient emails for purchase {$purchase->id}");
        }
    }

    public function sent_invoice_mail($purchase_id)
    {
        $purchase = Purchase::with('invoice')->find($purchase_id);
        if (!$purchase || !$purchase->invoice || $purchase->invoice->is_invoice != 1) {
            Log::info("No invoice to send for purchase {$purchase_id}");
            return;
        }

        $invoicePdf = PDF::loadView('insurance.policy_invoice', compact('purchase'))->setPaper('a4');
        $invoiceFileName = 'policy_invoice_' . $purchase->id . '.pdf';
        $invoiceDirectory = public_path('uploads/invoice');
        if (!File::exists($invoiceDirectory)) File::makeDirectory($invoiceDirectory, 0755, true);
        $invoiceFilePath = $invoiceDirectory . '/' . $invoiceFileName;
        file_put_contents($invoiceFilePath, $invoicePdf->output());

        $billingEmail = $purchase->invoice->billing_email;
        if (filter_var($billingEmail, FILTER_VALIDATE_EMAIL)) {
            $copyEmails = explode(',', $purchase->copy_email);
            $validCopyEmails = array_filter(array_map('trim', $copyEmails), fn($email) => filter_var($email, FILTER_VALIDATE_EMAIL));
            $invoiceCopyEmails = array_merge(['aadatia@moneywiseplc.co.uk'], $validCopyEmails);

            $invoiceEmailData = [
                'body' => 'Dear client,<br>Please find the attached invoice for policy no. ' . $purchase->policy_no . '.'
            ];

            try {
                Mail::send('email.invoice_mail', $invoiceEmailData, function ($message) use ($billingEmail, $invoiceFilePath, $invoiceCopyEmails, $purchase) {
                    $message->to($billingEmail);
                    $message->subject('Moneywise Investments PLC - Invoice for Policy - ' . $purchase->policy_no);
                    $message->cc($invoiceCopyEmails);
                    $message->bcc(['bestpratik@gmail.com']);
                    $message->attach($invoiceFilePath);
                });
                Log::info("Invoice email sent to: $billingEmail");
            } catch (\Exception $e) {
                Log::error("Failed to send invoice email to: $billingEmail | Error: " . $e->getMessage());
            }
        } else {
            Log::warning("Invalid billing email for purchase {$purchase->id}");
        }
    }
}
 