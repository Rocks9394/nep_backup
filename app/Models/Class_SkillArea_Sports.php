<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Class_SkillArea_Sports extends Model
{
    use HasFactory;
	protected $table = 'class_skillarea_sports';
    protected $fillable = ['class_id','sports_id','skillarea_id'];
	public $timestamps = false;
}
