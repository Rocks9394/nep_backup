<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;
	protected $table = 'activity';
    protected $fillable = [
			'teach_id',
			'title',
			'url',
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
			'status',
			'user_id',
			'rating',
			'comments',
			'commented_by'
		];
		
		public function classactivity()
		{
			return $this->hasOne(Sclass::class);
		}

		public function reports()
		{
			return $this->hasMany(Report::class, 'activity_id','id');
		}	
		

    
}
