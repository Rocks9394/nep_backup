<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoryactivity extends Model
{
    use HasFactory;    
	protected $table = 'activity_category';
	public $timestamps = false;
    protected $fillable = ['act_id','cat_id'];
	
}
