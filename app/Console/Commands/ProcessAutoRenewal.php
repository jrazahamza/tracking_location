<?php

namespace App\Console\Commands;

use App\Models\Subscription;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Stripe\Customer;
use Stripe\PaymentIntent;
use Stripe\Stripe;

class ProcessAutoRenewal extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'billing:auto-renew';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Charge 49.98 after 24-hour trial ends and handle monthly renewals';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        // Process trial users whose trial has ended
        $this->processTrialRenewals();

        // Process monthly subscription renewals
        $this->processMonthlyRenewals();

        $this->info('Auto-renewal process completed.');
    }

    /**
     * Process users whose trial has ended (using subscription table only)
     */
    private function processTrialRenewals()
    {
        // Find trial subscriptions that have ended
        $expiredTrials = Subscription::where('amount', 0.95)
            ->where('status', 'active')
            ->where('subscription_ends_at', '<=', value: now())
            ->with('user')
            ->get();

        $this->info("Found {$expiredTrials->count()} expired trials to process");

        foreach ($expiredTrials as $trialSubscription) {
            $user = $trialSubscription->user;

            if (!$user || !$user->stripe_customer_id) {
                continue;
            }

            try {
                $this->renewUserSubscription($user, 49.98, 'Monthly Subscription After Trial');

                // Mark trial subscription as expired
                $trialSubscription->status = 'expired';
                $trialSubscription->save();

            } catch (\Exception $e) {
                Log::error("Trial renewal failed for user {$user->id}: " . $e->getMessage());
                $this->error("Trial renewal failed for user {$user->email}: " . $e->getMessage());

                // Mark trial as expired
                $trialSubscription->status = 'trial_expired';
                $trialSubscription->save();
            }
        }
    }

    /**
     * Process monthly subscription renewals
     */
    private function processMonthlyRenewals()
    {
        // Find active paid subscriptions that are ending today
        $expiredSubscriptions = Subscription::where('subscription_ends_at', '<=', now())
            ->where('status', 'active')
            ->where('amount', '>', 0.95) // Not trial subscriptions
            ->with('user')
            ->get();

        $this->info("Found {$expiredSubscriptions->count()} paid subscriptions to renew");

        foreach ($expiredSubscriptions as $subscription) {
            $user = $subscription->user;

            if (!$user || !$user->stripe_customer_id) {
                continue;
            }

            try {
                $this->renewUserSubscription($user, 49.98, 'Monthly Subscription Renewal');

                // Mark old subscription as expired
                $subscription->status = 'expired';
                $subscription->save();

            } catch (\Exception $e) {
                Log::error("Monthly renewal failed for user {$user->id}: " . $e->getMessage());
                $this->error("Monthly renewal failed for user {$user->email}: " . $e->getMessage());

                // Mark subscription as expired
                $subscription->status = 'expired';
                $subscription->save();
            }
        }
    }

    /**
     * Renew user subscription
     */
    private function renewUserSubscription($user, $amount, $description)
    {
        // Get saved payment methods for the customer
        $paymentMethods = Customer::allPaymentMethods($user->stripe_customer_id, [
            'type' => 'card'
        ]);

        if (empty($paymentMethods->data)) {
            throw new \Exception("No saved payment method found for customer");
        }

        $paymentMethod = $paymentMethods->data[0]; // Use first saved payment method

        // Create payment intent with saved payment method
        $intent = PaymentIntent::create([
            'amount' => (int) round($amount * 100), // Convert to cents
            'currency' => 'usd',
            'customer' => $user->stripe_customer_id,
            'payment_method' => $paymentMethod->id,
            'off_session' => true, // Indicates this is for a saved payment method
            'confirm' => true, // Automatically confirm the payment
            'description' => $description,
            'metadata' => [
                'user_id' => $user->id,
                'auto_renewal' => 'true'
            ]
        ]);

        if ($intent->status === 'succeeded') {
            // Create new subscription record
            Subscription::create([
                'user_id' => $user->id,
                'stripe_payment_id' => $intent->id,
                'amount' => $amount,
                'start_date' => now(),
                'end_date' => now()->addMonth(),
                'subscription_ends_at' => now()->addMonth(),
                'payment_status' => 'succeeded',
                'payment_method' => 'stripe',
                'currency' => 'usd',
                'status' => 'active',
            ]);

            Log::info("Successfully renewed subscription for user: {$user->email} - Amount: ${$amount}");
            $this->info("Renewed subscription for: {$user->email}");

        } else {
            throw new \Exception("Payment intent status: {$intent->status}");
        }
    }
}
