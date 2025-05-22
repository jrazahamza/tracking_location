<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrackingRequest extends Model
{
    protected $fillable = [
        'target_user_email',
        'target_contact_number',
        'user_id',
        'token',
        'latitude',
        'longitude',
        'message',
        'methods',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
