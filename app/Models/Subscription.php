<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $table = 'subscriptions';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id',
        'stripe_payment_id',
        'amount',
        'start_date',
        'end_date',
        'subscription_ends_at',
        'payment_status',
        'payment_method',
        'currency',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Check if subscription is active
     */
    public function isActive(): bool
    {
        return $this->status === 'active' &&
            $this->subscription_ends_at > now();
    }

    /**
     * Check if this is a trial subscription
     */
    public function isTrial(): bool
    {
        return $this->amount == 0.95;
    }

    /**
     * Check if subscription is expired
     */
    public function isExpired(): bool
    {
        return $this->subscription_ends_at <= now() ||
            in_array($this->status, ['expired', 'trial_expired']);
    }

    /**
     * Get days remaining
     */
    public function daysRemaining(): int
    {
        if ($this->isExpired()) {
            return 0;
        }

        return now()->diffInDays($this->subscription_ends_at);
    }

    /**
     * Scope for active subscriptions
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active')
            ->where('subscription_ends_at', '>', now());
    }

    /**
     * Scope for trial subscriptions
     */
    public function scopeTrial($query)
    {
        return $query->where('amount', 0.95);
    }

    /**
     * Scope for paid subscriptions
     */
    public function scopePaid($query)
    {
        return $query->where('amount', '>', 0.95);
    }
}
