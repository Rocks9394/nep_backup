<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
	protected $table = 'subject';
    //protected $fillable = ['class_id','name','status'];
    protected $fillable = ['name','status'];
}
