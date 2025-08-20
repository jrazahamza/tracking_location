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

        $this->processTrialRenewals();

        $this->processMonthlyRenewals();

        $this->info('Auto-renewal process completed.');
    }

    /**
     * Process users whose trial has ended (using subscription table only)
     */
    private function processTrialRenewals()
    {
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

                $trialSubscription->status = 'expired';
                $trialSubscription->save();
            } catch (\Exception $e) {
                Log::error("Trial renewal failed for user {$user->id}: " . $e->getMessage());
                $this->error("Trial renewal failed for user {$user->email}: " . $e->getMessage());

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
        $expiredSubscriptions = Subscription::where('subscription_ends_at', '<=', now())
            ->where('status', 'active')
            ->where('amount', '>', 0.95)
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

                $subscription->status = 'expired';
                $subscription->save();
            } catch (\Exception $e) {
                Log::error("Monthly renewal failed for user {$user->id}: " . $e->getMessage());
                $this->error("Monthly renewal failed for user {$user->email}: " . $e->getMessage());

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
        if ($this->hasRecentRenewal($user->id)) {
            throw new \Exception("Renewal already processed recently");
        }

        $paymentMethods = Customer::allPaymentMethods($user->stripe_customer_id, [
            'type' => 'card'
        ]);

        if (empty($paymentMethods->data)) {
            throw new \Exception("No saved payment method found for customer");
        }

        $paymentMethod = $paymentMethods->data[0];

        $intent = PaymentIntent::create([
            'amount' => (int) round($amount * 100),
            'currency' => 'usd',
            'customer' => $user->stripe_customer_id,
            'payment_method' => $paymentMethod->id,
            'off_session' => true,
            'confirm' => true,
            'description' => $description,
            'metadata' => [
                'user_id' => $user->id,
                'auto_renewal' => 'true'
            ]
        ]);

        if ($intent->status === 'succeeded') {
            Subscription::create( [
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

            Log::info("Successfully renewed subscription for user: {$user->email} - Amount: \${$amount}");
            $this->info("Renewed subscription for: {$user->email}");
        } else {
            throw new \Exception("Payment intent status: {$intent->status}");
        }
    }

    private function hasRecentRenewal($userId)
    {
        return Subscription::where('user_id', $userId)
            ->where('amount', 49.98)
            ->where('created_at', '>=', now()->subHours(24))
            ->exists();
    }
}
