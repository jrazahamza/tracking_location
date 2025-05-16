<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\PaymentIntent;
use App\Models\Subscription;  // Model for subscription
use App\Models\User;
use Stripe\Exception\ApiErrorException;
use Stripe\Stripe;
use Stripe\Subscription as StripeSubscription;

class PaymentController extends Controller
{
    /**
     * Create a PaymentIntent on the server
     */
    public function createPaymentIntent(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'name' => 'required|string',
        ]);

        if (!auth()->check()) {
            return response()->json([
                'error' => 'User not authenticated. Please log in.'
            ], 401); // 401 Unauthorized
        }

        $user = auth()->user();

        $hasUsedTrial = Subscription::where('user_id', $user->id)
            ->where('amount', 0.95)
            ->exists();

        $amount = $hasUsedTrial ? 50.00 : 0.95;

        Stripe::setApiKey(config('services.stripe.secret'));

        try {
            $paymentIntent = PaymentIntent::create([
                "amount" => $amount * 100,
                'currency' => 'usd',
                'metadata' => [
                    'user_id' => auth()->user()->id,
                    'email' => $request->email,
                ],
            ]);

            return response()->json([
                'clientSecret' => $paymentIntent->client_secret,
            ]);
        } catch (ApiErrorException $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 400);
        }
    }


    /**
     * Handle successful payment completion
     */
    public function paymentComplete(Request $request)
    {
        // Check if the user is authenticated
        if (!auth()->check()) {
            return response()->json([
                'redirect' => route("login.form"),
                'error' => 'User not authenticated. Please log in.'
            ], 401); // 401 Unauthorized
        }

        // Validate request
        $request->validate([
            'payment_intent_id' => 'required|string',
        ]);

        // Set Stripe API key
        Stripe::setApiKey(config('services.stripe.secret'));

        try {
            // Retrieve the payment intent to verify its status
            $paymentIntent = PaymentIntent::retrieve($request->payment_intent_id);

            if ($paymentIntent->status === 'succeeded') {
                // Create subscription record
                Subscription::create([
                    'user_id' => auth()->user()->id,
                    'stripe_payment_id' => $paymentIntent->id,
                    'amount' => 0.95,
                    'start_date' => now(),
                    'end_date' => now()->addDays(30), // 30-day subscription
                    'subscription_ends_at' => now()->addDays(30),
                    'payment_status' => 'succeeded',
                    'payment_method' => 'stripe',
                    'currency' => 'usd',
                ]);

                return response()->json([
                    'redirect' => route("dashboard"),
                    'success' => true,
                    'message' => 'Payment processed successfully',
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Payment has not been completed',
                ], 400);
            }
        } catch (ApiErrorException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Payment verification error: ' . $e->getMessage(),
            ], 400);
        }
    }
}
