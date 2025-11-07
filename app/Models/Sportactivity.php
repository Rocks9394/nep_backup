<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sportactivity extends Model
{
    use HasFactory;
	public $timestamps = false;
	protected $table = 'activity_sports';
    protected $fillable = ['act_id','sport_id'];
}
