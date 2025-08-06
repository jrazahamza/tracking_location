<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */

    protected $guarded = [];

    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'email',
        'password',
        'phone_no',
        'gender',
        'street_address',
        'city',
        'state',
        'country',
        'description',
        'profile',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }


    public function currentSubscription()
    {
        return $this->subscriptions()
            ->where('status', 'active')
            ->where('subscription_ends_at', '>', now())
            ->orderBy('created_at', 'desc')
            ->first();
    }

    /**
     * Check if user has an active trial
     */
    public function hasActiveTrial(): bool
    {
        return $this->subscriptions()
            ->where('status', 'active')
            ->where('amount', 0.95)
            ->where('subscription_ends_at', '>', now())
            ->exists();
    }

    /**
     * Check if user has used trial before
     */
    public function hasUsedTrial(): bool
    {
        return $this->subscriptions()
            ->where('amount', 0.95)
            ->exists();
    }

    /**
     * Check if user has active subscription (trial or paid)
     */
    public function hasActiveSubscription(): bool
    {
        return $this->subscriptions()
            ->where('status', 'active')
            ->where('subscription_ends_at', '>', now())
            ->exists();
    }

    /**
     * Get subscription status
     */
    public function getSubscriptionStatus(): string
    {
        $currentSub = $this->currentSubscription();

        if (!$currentSub) {
            return 'inactive';
        }

        if ($currentSub->amount == 0.95) {
            return 'trial_active';
        }

        return 'subscribed';
    }

    /**
     * Get trial end time
     */
    public function getTrialEndsAt(): ?Carbon
    {
        $trialSub = $this->subscriptions()
            ->where('status', 'active')
            ->where('amount', 0.95)
            ->where('subscription_ends_at', '>', now())
            ->first();

        return $trialSub ? $trialSub->subscription_ends_at : null;
    }

    /**
     * Check if user's trial is ending soon (within next hour)
     */
    public function isTrialEndingSoon(): bool
    {
        $trialEndsAt = $this->getTrialEndsAt();

        if (!$trialEndsAt) {
            return false;
        }

        return $trialEndsAt->lte(now()->addHour());
    }
}
