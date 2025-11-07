<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teachingthrough extends Model
{
    use HasFactory;
	protected $table = 'teaching_through';
    protected $fillable = ['name','status'];
}
