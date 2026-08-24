<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warmupemail extends Model
{
    protected $fillable = [
        'user_type',
        'send_to',
        'count',
        'subject',
        'message',
        'attachment'
    ];
}
