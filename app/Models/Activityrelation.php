<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activityrelation extends Model
{
    use HasFactory;
	protected $table = 'activity_relation';
	public $timestamps = false;
    protected $fillable = ['activity_id', 'activity_key','activity_value'];

}
