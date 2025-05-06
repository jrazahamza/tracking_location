<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class contactUs extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'contacts';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'email',
        'subject',
        'message',
        'userIP',
    ];

}
