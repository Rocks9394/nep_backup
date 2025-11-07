<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UserImport;
use App\Models\Region;
use App\Models\Chainopt;
use App\Models\Role;
use App\Models\School;

class ImportData extends Controller
{
    //
	
	public function __construct()
    {
        $this->middleware('auth:admin');
    }
	
	public function importteachers(Request $request){
		$chains = Chainopt::get()->pluck('chainname','id')->toArray();
		return view('admin.import.upload' , compact('chains') );  
	}
	
	public function uploadteachers(Request $request){
		
		request()->validate([
                    'file'  => 'required|mimes:xls,xlsx,csv|max:2048',
					'chain' => 'required',
                ]);
				
		//echo '<pre>';
		
		$roles = Role::select('id', DB::raw('LOWER(name) as name') )->get()->pluck('name','id')->toArray(); 
		$regions = Region::select('id', DB::raw('LOWER(name) as name') )->get()->pluck('name','id')->toArray();
		$schools = School::select('id', DB::raw('LOWER(school_name) as school_name') )->where( 'chain_id', $request->chain )->get()->pluck('school_name','id')->toArray(); 

		Excel::import(new UserImport( $request->chain, $roles, $regions, $schools ), $request->file('file')); 
		return redirect()->back()->with('status', 'File Uploaded successfully '); 
		//exit();	
	}
	
	
}
