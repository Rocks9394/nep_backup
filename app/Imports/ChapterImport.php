<?php
namespace App\Imports;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;
use App\Models\Chapter;
use Illuminate\Support\Facades\Auth;

class ChapterImport implements ToCollection, withHeadingRow
{
    protected $class_id;
    protected $subject_id;

    public function __construct($class_id, $subject_id)
    {
       $this->class_id = $class_id;
	   
       $this->subject_id = $subject_id;
    }
 
    public function collection(Collection $rows){
       
	   $rows->each(function($row, $key){
		//Chapter	Math	Brief	Learning Outcomes	Unit	Book
	
		 if(!empty($row)){
			 //dd($row);
		  //echo "<pre>";print_r($this->class_id);
		  //echo "<pre>";print_r($this->class_id);die;							
		  $count = Chapter::where('name', $row['title'])
						   //->where('class_id', $this->class_id)
						   //->where('subject_id', $this->subject_id)
						   ->count();
		
			if($count == 0){					
				  Chapter::create([
						'class_id' => $this->class_id,					   
						'subject_id' => $this->subject_id,					   
						'name' => $row['title'],					   
						'description' => $row['brief'],
						'learning_outcomes' => $row['learning_outcomes'],					   
						'order' => $row['chapter'],				   
						'unit' => $row['unit'],					   
						'book' => $row['book'],   
						'user_id' => Auth::user()->id,   
						'status' =>'1'  
				  ]);                 				  
			}
		}			
      });
    }
}