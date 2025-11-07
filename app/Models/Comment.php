<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
	protected $table = 'activity_comments';
    protected $fillable = ['comment','rating','commented_by','activity_id','name','activity_sports',
	'activity_subject','qualityofactivity','creativity'];
	public $timestamps = true;
}
