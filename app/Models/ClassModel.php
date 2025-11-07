<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassModel extends Model
{
    use HasFactory;

    protected $table = 'class';

    protected $fillable = ['name'];

    public function customClasses()
    {
        return $this->hasMany(CustomClass::class);
    }

    /* Auther: Piyush */
    public function students()
    {
        return $this->hasMany(StudentDashboard::class, 'class_id');
    }
}
