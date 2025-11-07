<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request,Response,Redirect;
use App\Models\School;
use App\Models\State;
use App\Models\District;
use App\Models\Chainopt;
use App\Models\Board;
use App\Models\Region;

class SchollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
		if($request->input('search') == 'search')
		{
			$search_text = $request->input('name');
		$schools = School::where('school_name',$search_text)->paginate(40);
		
		}
		else
		{
		$schools = School::paginate(40);
		}
		$count = $schools->count();
		return view('admin.schools.index',compact('schools','count'));
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$boards = Board::all();
		
		$chainopts = Chainopt::all();
		$regions = Region::orderBy('name','ASC')->get();
		$states = State::all();
		$districts = District::all();
        return view('admin.schools.create',compact('states','districts','boards','chainopts','regions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		//dd($request->all());
		$date = date('d-m-y h:i:s');
		
		$state = State::where('id', $request->state)->first();
		 //dd($state->name);
		 
		 
		
        $district = District::where('id', $request->district)->first();
		$board = Board::where('id', $request->board)->first();
		$chainopts = Chainopt::where('id', $request->chainopts)->first();
		
		$request->validate([
		'schoolname' => ['required', 'string', 'max:255'],
		'principalname' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email'],
		'phone' => ['required', 'string', 'min:10', 'max:10'],
		'state' => ['required'],
		'district' => ['required'],
		'city' => ['required'],	
		'pincode' => ['required'],	
		'address' => ['required'],
		'board' => ['required'],
		'region' => ['required'],
		'zonename' => ['required'],
		'chainopts' => ['required'],	
        
		]);
		/*'school_name','school_principal','school_email','city','state','principal_phone',	
	'district','students','address','chain','board','pincode','status','state_id','district_id','board_id','chain_id','registered_by','added_date'*/
		$school = new School();
		$school->school_name = $request->schoolname;
		$school->school_principal = $request->principalname;
		$school->school_email = $request->email;
		$school->city = $request->city;
		$school->state = $state->name;
		$school->state_id = $state->id;
		$school->principal_phone = $request->phone;
		$school->district = $district->name;
		$school->district_id = $district->id;
		$school->address = $request->address;
		$school->region = $request->region;
		$school->chain = $chainopts->chainname;
		$school->chain_id = $chainopts->id;
		$school->board = $board->boardname;
		$school->board_id = $board->id;
		$school->pincode = $request->pincode;
		$school->zonename = $request->zonename;
		$school->registered_by = Auth::user()->id;
		$school->added_date = $date;
		$school->status = 1;
		$school->save();
		
		
        return back()->with(['status' => 'success' , 'msg' => 'Successfully added']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$boards = Board::all();
		
		$chainopts = Chainopt::all();
		$regions = Region::orderBy('name','ASC')->get();
		$states = State::all();
		$districts = District::all();
		$school = School::findOrFail($id);
        return view('admin.schools.edit',compact('school','chainopts','states','districts','boards','regions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
		//dd($request->all());
		$date = date('d-m-y h:i:s');
		
		$state = State::where('id', $request->state)->first();
		 //dd($state->name);
		 
		 
		
        $district = District::where('id', $request->district)->first();
		$board = Board::where('id', $request->board)->first();
		$chainopts = Chainopt::where('id', $request->chainopts)->first();
		
		$request->validate([
		'schoolname' => ['required', 'string', 'max:255'],
		'principalname' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email'],
		'phone' => ['required', 'string', 'min:10', 'max:10'],
		'state' => ['required'],
		'district' => ['required'],
		'city' => ['required'],	
		'pincode' => ['required'],	
		'address' => ['required'],
		'region' => ['required'],
		'zonename' => ['required'],
		'board' => ['required'],
		'chainopts' => ['required'],	
        
		]);
		
		$school =  School::find($id);
		$school->school_name = $request->schoolname;
		$school->school_principal = $request->principalname;
		$school->school_email = $request->email;
		$school->city = $request->city;
		$school->state = $state->name;
		$school->state_id = $state->id;
		$school->principal_phone = $request->phone;
		$school->district = $district->name;
		$school->district_id = $district->id;
		$school->address = $request->address;
		$school->region = $request->region;
		$school->chain = $chainopts->chainname;
		$school->chain_id = $chainopts->id;
		$school->board = $board->boardname;
		$school->board_id = $board->id;
		$school->pincode = $request->pincode;
		$school->zonename = $request->zonename;
		$school->registered_by = Auth::user()->id;
		$school->added_date = $date;
		$school->status = 1;
		$school->save();
		
		
        return back()->with(['status' => 'success' , 'msg' => 'Successfully added']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $school = School::find($id);
		$school->delete();
		return back();
    }
	
	public function getschoolDistrict(Request $request){
		
        $state_id = $request->id;
        $district_list = District::where('state_id', $state_id)->orderby('name', 'asc')->get();
        $district = '<option value="">Select District</option>';
        if(!empty($district_list)){
            foreach ($district_list as $dist) {
               $district .= '<option value="'.$dist['id'].'">'.$dist['name'].'</option>';
            }
        }
        return $district;

    }
}
