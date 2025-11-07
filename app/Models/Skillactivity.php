<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skillactivity extends Model
{
   use HasFactory;
	protected $table = 'activity_skill';
	public $timestamps = false;
    protected $fillable = ['act_id','skill_id'];
	
}
