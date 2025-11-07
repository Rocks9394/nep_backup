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

class UpdateConceptImport implements ToCollection, withHeadingRow
{
   

    public function __construct()
    {
       
    }
 
    public function collection(Collection $rows){
       
	   $rows->each(function($row, $key){
		//Chapter	Math	Brief	Learning Outcomes	Unit	Book
	
		 if(!empty($row)){
			 //dd($row);
		 							
		  $count = Concept::where('name', $row['concept'])
						   ->count();
		
			if($count == 0){					
				  Concept::find($row['id'])->update([
						'id' => $row['id'],
						'class_id' => $row['class_id'],					   
						'subject_id' => $row['subject_id'],
						'chapter_id' => $row['chapter_id'],						
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