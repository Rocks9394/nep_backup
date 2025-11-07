<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weakness extends Model
{
    use HasFactory;
	protected $table='activity_weakness';
	
    protected $fillable = [
        'activity_id',
        'weakness_type',
        'class_id',
        'subject_id',
        'chapters',
        'concepts',        
        'status',        
    ];
	
}
