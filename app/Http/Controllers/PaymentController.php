<?php

namespace App\Http\Controllers;

use App\Mail\AccountCreatedEmail;
use Illuminate\Http\Request;
use Stripe\PaymentIntent;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Stripe\Customer;
use Stripe\Exception\ApiErrorException;
use Stripe\Stripe;
use Stripe\Subscription as StripeSubscription;

class PaymentController extends Controller
{

    public function createPaymentIntent(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'name' => 'required|string',
        ]);

        $email = $request->email;
        $name = $request->name;

        $user = User::where('email', $email)->first();

        if (!$user) {
            $password = Str::random(10);
            $user = User::create([
                'first_name' => $name,
                'email' => $email,
                'password' => bcrypt($password),
            ]);

            Mail::to($email)->send(new AccountCreatedEmail($name, $email, $password));
        }

        Auth::login($user);

        if (!auth()->check()) {
            return response()->json([
                'error' => 'User not authenticated. Please log in.'
            ], 401);
        }

        $user = auth()->user();

        $hasUsedTrial = Subscription::where('user_id', $user->id)
            ->where('amount', 0.95)
            ->exists();

        $usdAmount = $hasUsedTrial ? 49.98 : 0.95;
        $amountInCents = (int) round($usdAmount * 100);

        Stripe::setApiKey(config('services.stripe.secret'));

        try {
            $customer = $this->getOrCreateStripeCustomer($user);

            $paymentIntent = PaymentIntent::create([
                "amount" => $amountInCents,
                "currency" => "usd",
                "customer" => $customer,
                "payment_method_types" => ["card"],
                "description" => $hasUsedTrial ? "Monthly Subscription" : "1-Day Trial ($0.95)",
                "setup_future_usage" => "off_session",
                "metadata" => [
                    'user_id' => $user->id,
                    'email' => $email,
                    'is_trial' => $hasUsedTrial ? 'false' : 'true',
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

    private function getOrCreateStripeCustomer($user)
    {
        if ($user->stripe_customer_id) {
            return $user->stripe_customer_id;
        }

        Stripe::setApiKey(config('services.stripe.secret'));

        $customer = Customer::create([
            'email' => $user->email,
            'name' => $user->first_name,
        ]);

        $user->stripe_customer_id = $customer->id;
        $user->save();

        return $customer->id;
    }

    /**
     * Handle successful payment completion
     */
    public function paymentComplete(Request $request)
    {
        if (!auth()->check()) {
            return response()->json([
                'redirect' => route("login.form"),
                'error' => 'User not authenticated. Please log in.'
            ], 401);
        }

        $request->validate([
            'payment_intent_id' => 'required|string',
        ]);

        Stripe::setApiKey(config('services.stripe.secret'));

        try {
            $paymentIntent = PaymentIntent::retrieve($request->payment_intent_id);

            if ($paymentIntent->status !== 'succeeded') {
                return response()->json([
                    'redirect' => route("checkouterror"),
                    'message' => 'Payment not successful.'
                ], 400);
            }

            $user = auth()->user();
            $amountInDollars = $paymentIntent->amount / 100;
            $isTrial = $amountInDollars == 0.95;

            if ($paymentIntent->status === 'succeeded') {
                $subscription = Subscription::create([
                    'user_id' => $user->id,
                    'stripe_payment_id' => $paymentIntent->id,
                    'amount' => $amountInDollars,
                    'start_date' => now(),
                    'end_date' => $isTrial ? now()->addHours(24) : now()->addMonth(),
                    'subscription_ends_at' => $isTrial ? now()->addHours(24) : now()->addMonth(),
                    'payment_status' => 'succeeded',
                    'payment_method' => 'stripe',
                    'currency' => 'usd',
                    'status' => 'active',
                ]);


                return response()->json([
                    'redirect' => route("checkout"),
                    'success' => true,
                    'message' => 'Payment processed successfully',
                ]);
            } else {
                return response()->json([
                    'redirect' => route("checkouterror"),
                    'success' => false,
                    'message' => 'Payment has not been completed',
                ], 400);
            }
        } catch (ApiErrorException $e) {
            return response()->json([
                'redirect' => route("checkouterror"),
                'success' => false,
                'message' => 'Payment verification error: ' . $e->getMessage(),
            ], 400);
        }
    }
}
