<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class Chapter extends Model
{
    use HasFactory;
	protected $table = 'chapter';
    protected $fillable = [
					'class_id',
					'subject_id',
					'name',
					'description',
					'image',
					'url',
					'learning_outcomes',
					'order',
					'unit',
					'book',
					'file',
					'link',
					'status'
			];
	
	public static function getChapter()
	{
		//dd(request()->all());
		
		$records = Chapter::orderBy('chapter.id','DESC')
					->select(['chapter.id','chapter.order','chapter.name','chapter.description',
					'chapter.learning_outcomes','chapter.unit','chapter.book','chapter.class_id','chapter.subject_id'])
					->where('chapter.class_id',request()->input('class'))
					->where('chapter.subject_id',request()->input('subject'))
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
