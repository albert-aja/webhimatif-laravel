<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = [
        'email', 'username', 'password', 'activation_hash',
        'activation_status', 'email_verified_at', 'activation_expires',
        'reset_hash', 'reset_at', 'reset_expires',
    ];

    protected $hidden = [
        'password', 'activation_hash', 'activation_status', 
        'activation_expires', 'reset_hash', 'reset_at',
        'reset_expires'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
