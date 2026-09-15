<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailVerificationDomain extends Model
{
    protected $fillable = [
        'domain',
        'catch_all',
        'verified_at',
    ];

    protected $casts = [
        'catch_all' => 'boolean',
        'verified_at' => 'datetime',
    ];
}