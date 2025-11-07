<?php

namespace App\Exports;

use App\Models\Chapter;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Http\Request;

class ChapterExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
		if(request()->has('class') || request()->has('subject') )
		{
			
			return collect(Chapter::getChapter());
			//return Concept::all();
		}
		else{
			print_r("bye");
			exit();
		}
        //return Concept::all();
    }
	public function headings():array{
		return ['ID','Order','NAME','Description','Learning Outcomes','Unit','BOOK','Class_ID','Subject_ID'];
	}
}
