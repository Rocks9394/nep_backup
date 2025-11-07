<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassSkill extends Model
{
   use HasFactory;
	protected $table = 'class_skillarea';
	public $timestamps = false;
    protected $fillable = ['class_id','skillarea_id'];
	
}
