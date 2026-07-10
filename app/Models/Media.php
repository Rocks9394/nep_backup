<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Media extends Model
{
    use HasFactory;

    protected $fillable = [
        'school_id',
        'activity_id',
        'class_id',
        'date',
        'media_type',
        'file_path',
        'file_name',
        'file_size',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function getUrlAttribute()
    {
        $path = $this->file_path;
        if (!$path) {
            return null;
        }

        // Ensure path starts with public/ for asset() URL generation
        // if (!Str::startsWith($path, 'public/')) {
        //     $path = 'public/' . $path;
        // }

        return asset($path);
    }

    // Relationships if needed
    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }
}