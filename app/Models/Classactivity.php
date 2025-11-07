<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classactivity extends Model
{
    use HasFactory;
	protected $table = 'activity_class';
	public $timestamps = false;
    protected $fillable = ['act_id','class_id'];	
	
	
}
