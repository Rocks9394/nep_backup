<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Class_subject extends Model
{
    use HasFactory;
	protected $table = 'class_subject';
	public $timestamps = false;
    protected $fillable = ['class_id','subject_id'];
    
}
