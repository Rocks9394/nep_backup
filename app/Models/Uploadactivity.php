<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Uploadactivity extends Model
{
    use HasFactory;
	protected $table = 'upload_activity';
	
    protected $fillable = [
			'title',			
			'image',
			'description',
			'learning_outcomes',
			'what_you_need',
			'what_to_do',
			'change_it',
			'coaching',					
			'game_rules',
			'equipment',
			'playing_area',
			'scoring',
			'safety',
			'ask_the_Players',
			'assignments',
			'projects',
			'status'
		];	
		
}
