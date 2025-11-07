<?php
namespace App\Http\Controllers\Admin\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\School;
use App\Models\Chainopt;
use App\Models\Region;
use App\Models\Teacher;
use App\Models\User;
use App\Models\Usermeta;

use Maatwebsite\Excel\Facades\Excel;
use App\Imports\SchoolImport;
use App\Imports\TeacherImport;

class SchoolimportController extends Controller
{
  
public function schoolDetail(Request $request)
	{
		$chainopts = Chainopt::all();
		return view('admin.schools.upload',compact('chainopts'));
	}
	public function schoolImport(Request $request)
	{
		//dd($request->chainopts);
		 request()->validate([
                    'file'  => 'required|mimes:xls,xlsx,csv|max:2048',
					'chainopts' => 'required',
                ]);
		$school=request()->file('file');
		Excel::import(new SchoolImport ($request->chainopts), $school);
		return back()->with('status', 'Excel Data Imported successfully.');
		
	}

	public function teacherDetail(Request $request)
	{
		$regions = Region::all();
		return view('admin.teachers.upload',compact('regions'));
	}
	public function teacherImport(Request $request)
	{
		//dd($request->regions);
		 request()->validate([
                    'file'  => 'required|mimes:xls,xlsx,csv|max:2048',
					'regions' => 'required',
                ]);
		$teacher=request()->file('file');
		$schools = School::select('id','school_name')->where('region_id',$request->regions)->get();
		//$school = array_flip(array($schools));
		
		//return $schools;
		$school = array();
		foreach($schools as $sch)
		{
			$school[$sch->id] = strtolower($sch->school_name);
			
		}
		//var_dump($school);
		Excel::import(new TeacherImport($request->regions,$school), $teacher);
		return back()->with('status', 'Excel Data Imported successfully.');
		
	}
}