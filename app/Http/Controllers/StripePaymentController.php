<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Illuminate\Support\Facades\Log;
use Stripe\Webhook;
use App\Models\Purchase;
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
        $payload = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');
        $endpointSecret = env('STRIPE_WEBHOOK_SECRET'); 

        try {
            $event = Webhook::constructEvent($payload, $sigHeader, $endpointSecret);
        } catch (\UnexpectedValueException $e) {
            return response()->json(['error' => 'Invalid payload'], 400);
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            return response()->json(['error' => 'Invalid signature'], 400);
        }

       
        if ($event->type === 'checkout.session.completed') {
            $session = $event->data->object;
            Log::info('Checkout session completed: ', (array) $session);
            
        }

        return response()->json(['status' => 'success']);
    }

   
}
