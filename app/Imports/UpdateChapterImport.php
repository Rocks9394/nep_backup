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

class UpdateChapterImport implements ToCollection, withHeadingRow
{
    

    public function __construct()
    {
       
    }
 
    public function collection(Collection $rows){
       
	   $rows->each(function($row, $key){
		//Chapter	Math	Brief	Learning Outcomes	Unit	Book
	
		 if(!empty($row)){
			 //dd($row);
		 							
		  $count = Chapter::where('name', $row['name'])
						  ->count();
		
			if($count == 0){					
				  Chapter::find($row['id'])->update([
						'id' => $row['id'],
						'class_id' => $row['class_id'],					   
						'subject_id' => $row['subject_id'],					   
						'name' => $row['name'],					   
						'description' => $row['brief'],
						'learning_outcomes' => $row['learning_outcomes'],					   
						'order' => $row['order'],				   
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