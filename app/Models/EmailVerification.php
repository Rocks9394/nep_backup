<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailVerification extends Model
{
    protected $fillable = [
        'email',
        'syntax_valid',
        'domain_valid',
        'mx_valid',
        'mx_host',
        'disposable',
        'smtp_status',
        'smtp_code',
        'smtp_message',
        'catch_all',
        'risk_level',
        'final_status',
        'risk_reasons',
        'verified_at',
    ];

    protected $casts = [
        'syntax_valid' => 'boolean',
        'domain_valid' => 'boolean',
        'mx_valid' => 'boolean',
        'disposable' => 'boolean',
        'catch_all' => 'boolean',
        'risk_reasons' => 'array',
        'verified_at' => 'datetime',
    ];
}