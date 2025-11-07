<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sport_skill extends Model
{
    use HasFactory;
	protected $table = 'sorts_skills';
    protected $fillable = ['class_id','sports_id','skill_id'];
	public $timestamps = false;
}
