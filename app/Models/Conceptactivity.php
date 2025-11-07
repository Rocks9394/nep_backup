<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conceptactivity extends Model
{
    use HasFactory;
	protected $table = 'activity_concept';
	public $timestamps = false;
    protected $fillable = ['act_id','con_id', 'class_id','subject_id', 'chapter_id'];	
	
	
}
