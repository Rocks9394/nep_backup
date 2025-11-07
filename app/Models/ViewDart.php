<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ViewDart extends Model
{
    use HasFactory;
	
	protected $table = 'view_dart';
    protected $fillable = ['school_id','term_master_id','trainer_id','period','custm_cls_id','skill_area_id','skillsports_id','technique_id','activity_id','total_student','present','absent','other_duties_id','date'];
	public $timestamps = false;
	

}
