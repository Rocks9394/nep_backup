<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\School;

class SchoolTrainer extends Model
{
   use HasFactory;
	protected $table = 'school_trainers';
    #protected $fillable = ['name'];
	// public $timestamps = false;
	
	public function trainer(){

	  return $this->belongsTo(User::class, 'trainer_id');
	}

	


}
