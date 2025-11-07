<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityTechnique extends Model
{
    use HasFactory;
	protected $table = 'activity_technique';
	public $timestamps = false;
    protected $fillable = ['act_id','technique_id', 'class_id','skillarea_id', 'sportskill_id'];	
	
}
