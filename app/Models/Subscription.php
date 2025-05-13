<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $table = 'user_payments';
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
}
