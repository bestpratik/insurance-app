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
use Illuminate\Support\Facades\Mail;

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
            'success_url' => route('stripe.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('stripe.cancel'),
        ]);

        return redirect($stripeSession->url);
    }

    // public function success(Request $request)
    // {
    //     // You can fetch session ID if needed via $request->get('session_id')
    //     $purchaseId = session('pending_purchase_id');

    //     if ($purchaseId) {
    //         $purchase = Purchase::find($purchaseId);
    //         if ($purchase) {
    //             $purchase->payment_status = 'Paid'; 
    //             $purchase->save();
    //         }

    //         session()->forget('pending_purchase_id');
    //     }

    //     return redirect()->route('front.purchase.success');
    // }

    // public function success(Request $request)
    // {
    //     Stripe::setApiKey(env('STRIPE_SECRET'));

    //     $sessionId = $request->get('session_id');
    //     // dd($sessionId);

    //     if (!$sessionId) {
    //         return redirect()->route('policy.buyer')->with('error', 'Missing session ID.');
    //     }

    //     try {
    //         $session = StripeSession::retrieve($sessionId);
    //         // dd($session);
    //     } catch (\Exception $e) {
    //         Log::error('Stripe session fetch error: ' . $e->getMessage());
    //         return redirect()->route('policy.buyer')->with('error', 'Payment verification failed.');
    //     }

    //     $purchaseId = session('pending_purchase_id') ?? $session->client_reference_id;

    //     if ($purchaseId) {
    //         $purchase = Purchase::find($purchaseId);
    //         if ($purchase) {
    //             DB::beginTransaction();

    //             $purchase->payment_status = 'Paid';
    //             $purchase->stripe_session_id = $sessionId;
    //             $purchase->save();

    //             DB::commit();
    //         }

    //         session()->forget('pending_purchase_id');
    //     }

    //     return redirect()->route('front.purchase.success');
    // }


    public function success(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $sessionId = $request->get('session_id');

        if (!$sessionId) {
            return redirect()->route('policy.buyer')->with('error', 'Missing session ID.');
        }

        try {
            $session = StripeSession::retrieve($sessionId);
        } catch (\Exception $e) {
            Log::error('Stripe session fetch error: ' . $e->getMessage());
            return redirect()->route('policy.buyer')->with('error', 'Payment verification failed.');
        }

        $purchaseId = session('pending_purchase_id') ?? $session->client_reference_id;

        if ($purchaseId) {
            $purchase = Purchase::with('invoice')->find($purchaseId);
            if ($purchase) {
                DB::beginTransaction();

                $purchase->payment_status = 'Paid';
                $purchase->stripe_session_id = $sessionId;
                $purchase->save();

                DB::commit();

                // Send Email and Attach PDFs
                try {
                    $insurance = Insurance::with('staticdocuments', 'dynamicdocument', 'insurancemailtemplate')->findOrFail($purchase->insurance_id);

                    $allDocs = [];
                    if ($insurance->staticdocuments) {
                        foreach ($insurance->staticdocuments as $docs) {
                            $filePath = public_path('uploads/insurance_document/' . $docs->document);
                            if (file_exists($filePath)) {
                                $allDocs[] = $filePath;
                            }
                        }
                    }

                    $pdfDynamicval = [
                        $insurance->name,
                        $purchase->policy_no,
                        $purchase->policy_holder_address,
                        date('jS F Y', strtotime($purchase->policy_start_date)),
                        date('jS F Y', strtotime($purchase->policy_end_date)),
                        date('jS F Y', strtotime($purchase->purchase_date)),
                        $purchase->policy_term,
                        $purchase->net_premium,
                        $purchase->ipt,
                        $purchase->gross_premium,
                        $purchase->rent_amount,
                    ];

                    $riskAddress = $purchase->door_no . ' ' . $purchase->address_one . ' ' . $purchase->address_two . ' ' . $purchase->address_three . ' ' . $purchase->post_code;

                    $insurartitle = "";
                    if ($purchase->policy_holder_type == 'Company') {
                        $insurartitle = $purchase->company_name;
                    } elseif ($purchase->policy_holder_type == 'Individual') {
                        $insurartitle = $purchase->policy_holder_title . ' ' . $purchase->policy_holder_fname . ' ' . $purchase->policy_holder_lname;
                    } else {
                        $insurartitle = $purchase->company_name . '/' . $purchase->policy_holder_title . ' ' . $purchase->policy_holder_fname . ' ' . $purchase->policy_holder_lname;
                    }

                    $pdfDynamicval[] = $riskAddress;
                    $pdfDynamicval[] = $insurartitle;
                    $pdfDynamicval[] = $insurance->details_of_cover;

                    if ($insurance->dynamicdocument) {
                        foreach ($insurance->dynamicdocument as $dydocs) {
                            $file_name = $dydocs->title . rand(11, 999999) . '.pdf';

                            $data = [
                                'templateTitle' => $dydocs->title,
                                'templateBody' => $dydocs->description,
                                'templateHeder' => $dydocs->header,
                                'templateFooter' => $dydocs->footer,
                                'templatebodyValue' => $pdfDynamicval
                            ];

                            $pdf = PDF::loadView('purchase.pdfs.insurance_dynamic_document_email', ['data' => $data]);
                            $pdfPath = public_path('uploads/dynamicdoc' . $file_name);
                            $pdf->save($pdfPath);

                            if (file_exists($pdfPath)) {
                                $allDocs[] = $pdfPath;
                            }
                        }
                    }

                    $bodyValue = $pdfDynamicval;

                    $sendToemails = [];
                    if ($purchase->policy_holder_type === 'Company') {
                        $sendToemails[] = $purchase->policy_holder_company_email;
                    } elseif ($purchase->policy_holder_type === 'Individual') {
                        $sendToemails[] = $purchase->policy_holder_email;
                    } elseif ($purchase->policy_holder_type === 'Both') {
                        $sendToemails[] = $purchase->policy_holder_email;
                        $sendToemails[] = $purchase->policy_holder_company_email;
                    }

                    $sendToemails = array_filter($sendToemails, function ($email) {
                        return filter_var($email, FILTER_VALIDATE_EMAIL);
                    });

                    $email_subject = $insurance->insurancemailtemplate->title ?? '';
                    $data = [
                        'body' => $insurance->insurancemailtemplate->description ?? '',
                        'bodyValue' => $bodyValue
                    ];

                    $copyEmails = explode(',', $purchase->copy_email);
                    $validCopyEmails = array_filter(array_map('trim', $copyEmails), function ($email) {
                        return filter_var($email, FILTER_VALIDATE_EMAIL);
                    });

                    $ccEmails = array_merge(['anuradham.dbt@gmail.com'], $validCopyEmails);

                    foreach ($sendToemails as $email) {
                        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                            throw new \Exception("Invalid To Email: $email");
                        }
                    }

                    Mail::send('email.insurance_billing', $data, function ($messages) use ($sendToemails, $allDocs, $email_subject, $ccEmails) {
                        $messages->to($sendToemails);
                        $messages->subject($email_subject);
                        $messages->cc($ccEmails);
                        $messages->bcc(['dcstest201@gmail.com']);

                        foreach ($allDocs as $attachment) {
                            $messages->attach($attachment);
                        }
                    });
                } catch (\Exception $e) {
                    Log::error('Email sending failed after Stripe success: ' . $e->getMessage());
                }

                session()->forget('pending_purchase_id');
            }
        }

        return redirect()->route('front.purchase.success');
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
    //             // status update on purchase table
    //         $session = $event->data->object;
    //         $purchaseId = $session->client_reference_id;

    //         if ($purchaseId) {
    //             $purchase = Purchase::find($purchaseId);
    //             if ($purchase) {
    //                 $purchase->payment_status = 'Paid';
    //                 $purchase->save();

    //                 Log::info("Purchase ID {$purchase->id} marked as Paid.");
    //             }
    //         }

    //         //Sent email

    //         } elseif ($event->type == 'payment_intent.payment_failed') {
    //             //Status update on purchase email
    //             $intent = $event->data->object;
    //             Log::warning('Payment failed: ' . $intent->id);
    //             //Sent email
    //         }

    //         DB::table('payments')->insert([
    //             'txanid' => $event->data->object->id,
    //             'status' => $event->type,
    //             'created_at' => now(),
    //             'updated_at' => now(),
    //         ]);

    //         DB::commit();
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



}
