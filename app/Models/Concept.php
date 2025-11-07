<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class Concept extends Model
{
    use HasFactory;
	protected $table = 'concept';
    protected $fillable = ['name','description','learning_outcomes','image','url','status','class_id','subject_id','chapter_id','order'];
    
	public static function getConcept()
	{
		//dd(request()->all());
		
		$records = Concept::orderBy('concept.id','DESC')
					->select(['concept.id','concept.chapter_id','concept.name','concept.description',
					'concept.learning_outcomes','concept.class_id','concept.subject_id'])
					->where('concept.class_id',request()->input('class'))
					->where('concept.subject_id',request()->input('subject'))
					->where('concept.chapter_id', request()->input('chapter'))
					->get();
		//dd($records);			
		return $records;			
		
		/*dd($records);
			if(!empty(request()->input('class')))
			{
				$records = $records->where('concept.class_id',request()->input('class'));
			}
			if(!empty(request()->input('subject')))
			{
				$records = $records->where('concept.subject_id',request()->input('subject'));
			}
			if(!empty(request()->input('chapter')))
			{
				$records = $records->where('concept.chapter_id', request()->input('chapter'));
			}
		//$records = $records->get();
		//dd($records);*/
					
		
	}
}
