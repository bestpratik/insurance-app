<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Illuminate\Support\Facades\Log;
use Stripe\Webhook;
use App\Models\Purchase;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;
use Stripe\Checkout\Session as StripeSession;
use Illuminate\Support\Facades\Session;

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

    public function success(Request $request)
    {
        // You can fetch session ID if needed via $request->get('session_id')
        $purchaseId = session('pending_purchase_id');

        if ($purchaseId) {
            $purchase = Purchase::find($purchaseId);
            if ($purchase) {
                $purchase->payment_status = 'Paid'; // Optional: add this field to your table
                $purchase->save();
            }

            session()->forget('pending_purchase_id');
        }

        return redirect()->route('front.purchase.success');
    }

    public function cancel()
    {
        session()->forget('pending_purchase_id');
        return redirect()->route('policy.buyer')->with('error', 'Payment was cancelled.');
    }

    public function handleWebhook(Request $request)
    {
        Log::info('Stripe Webhook Headers:', $request->headers->all());
        Log::info('Stripe Webhook Payload:', $request->all());

        // $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
        $endpoint_secret = env('STRIPE_WEBHOOK_SECRET');
        $requestBody = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');

        try {
            $event = Webhook::constructEvent($requestBody, $sigHeader, $endpoint_secret);
            if ($event->type == 'checkout.session.completed') {
                // status update on purchase table
            $session = $event->data->object;
            $purchaseId = $session->client_reference_id;

            if ($purchaseId) {
                $purchase = Purchase::find($purchaseId);
                if ($purchase) {
                    $purchase->payment_status = 'Paid';
                    $purchase->save();

                    Log::info("Purchase ID {$purchase->id} marked as Paid.");
                }
            }

            //Sent email

            } elseif ($event->type == 'payment_intent.payment_failed') {
                //Status update on purchase email
                $intent = $event->data->object;
                Log::warning('Payment failed: ' . $intent->id);
                //Sent email
            }

            DB::table('payments')->insert([
                'txanid' => $event->data->object->id,
                'status' => $event->type,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::commit();
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

        return response()->json(['status' => 'success']);
    }

    

}
