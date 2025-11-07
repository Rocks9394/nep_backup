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
use App\Models\Concept;
use Illuminate\Support\Facades\Auth;

class ConceptImport implements ToCollection, withHeadingRow
{
    protected $class_id;
    protected $subject_id;
	protected $chapter_id;

    public function __construct($class_id, $subject_id , $chapter_id = null)
    {
       $this->class_id = $class_id;
	   
       $this->subject_id = $subject_id;
	   
	   $this->chapter_id = $chapter_id;
    }
 
    public function collection(Collection $rows){
       
	   $rows->each(function($row, $key){
		//Chapter	Math	Brief	Learning Outcomes	Unit	Book
	
		 if(!empty($row)){
			 //dd($row);
		 // echo "<pre>";print_r($this->class_id);
		 // echo "<pre>";print_r($this->subject_id);
		 // echo "<pre>";print_r($this->chapter_id);die;							
		  $count = Concept::where('name', $row['concept'])
						   //->where('class_id', $this->class_id)
						   //->where('subject_id', $this->subject_id)
						   ->count();
		
			if($count == 0){					
				  Concept::create([
						'class_id' => $this->class_id,					   
						'subject_id' => $this->subject_id,
						'chapter_id' => $this->chapter_id,
						'order' => $row['order'],						
						'name' => $row['concept'],					   
						'description' => $row['learning_outcomes'],
						'learning_outcomes' => $row['learning_objective'],					      
						'user_id' => Auth::user()->id,   
						'status' =>'1'  
				  ]);                 				  
			}
		}			
      });
    }
}