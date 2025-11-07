<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Class_SkillArea_Sports_Tech extends Model
{
    use HasFactory;
	protected $table = 'class_skillarea_sports_tech';
    protected $fillable = ['class_id','sports_id','skillarea_id','tech_id'];
	public $timestamps = false;
}
