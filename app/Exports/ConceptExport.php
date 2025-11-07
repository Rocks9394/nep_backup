<?php

namespace App\Exports;

use App\Models\Concept;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Http\Request;

class ConceptExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
		if(request()->has('class') || request()->has('subject') || request()->has('chapter'))
		{
			
			return collect(Concept::getConcept());
			//return Concept::all();
		}
		else{
			print_r("bye");
			exit();
		}
        //return Concept::all();
    }
	public function headings():array{
		return ['ID','Chapter_Id','CONCEPT','Learning Outcomes','Learning Objective','Class_ID','Subject_ID'];
	}
}
