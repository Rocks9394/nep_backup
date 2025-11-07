<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sport extends Model
{
    use HasFactory;
	protected $table = 'sports';
    protected $fillable = ['name'];
	public $timestamps = false;


   	public function reports()
   {
       return $this->hasOne(Report::class, 'skill_sports_id');
   }

}
