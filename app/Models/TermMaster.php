<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TermMaster extends Model
{
    use HasFactory;

    protected $fillable = [
        'school_id',
        'term_name',
        'camp_type',
        'academic_year',
        'term_start_date',
        'term_end_date',
        'is_active',
    ];

    // Relationship to School
    public function school()
    {
        return $this->belongsTo(School::class, 'school_id');
    }
}
