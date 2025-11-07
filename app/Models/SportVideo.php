<?php 


namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class SportVideo extends Model {
	
    protected $fillable = ['id','sport_name', 'chapter_id', 'video_url','thumbnail_url', 'chapter_id' ,'status','title'];
}


?>