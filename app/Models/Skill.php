<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
   use HasFactory;
	protected $table = 'skillareas';
    protected $fillable = ['name'];
	public $timestamps = false;


	public function reports()
   {
       return $this->hasMany(Report::class, 'skill_area_id');
   }
   
	
}
