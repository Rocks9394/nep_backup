<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usermeta extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','state','state_id','district','gender','qualification','district_id','city','school_id','school_name','module_access', 'dob','created_by'];
    
    public function user()
    {
        return $this->belongsTo(App\Models\User::class, 'user_id');
    }
}