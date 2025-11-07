<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request,Response,Redirect;
use App\Models\User;
use App\Models\State;
use App\Models\District;
use App\Models\Usermeta;
use App\Models\Role;
use App\Models\School;
use App\Models\Teacher;
use App\Models\Sclass;
use App\Models\Subject;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$count = User::where('users.role_id','3')->count();
       $admin_role = Auth::user()->role_id;
		 //$userid = Auth::user()->id;
		 //dd($userid);
		//dd($admin_role);
		if($admin_role == '4')
		{
		$users = DB::table('users')
				->rightJoin('usermetas','users.id', '=',	'usermetas.user_id')
				->select(['users.id','users.name','users.email','users.phone','usermetas.state','usermetas.district'])
				->where('users.role_id','3')
				->where('usermetas.created_by', Auth::user()->id)
				->orderBy('id','asc')
				->paginate(40);
		}
		else{
			$users = DB::table('users')
				->rightJoin('usermetas','users.id', '=',	'usermetas.user_id')
				->select(['users.id','users.name','users.email','users.role_id','users.phone','usermetas.state','usermetas.district'])
				->where('users.role_id','3')
				->orderBy('id','asc')
				->paginate(40);
		}
		
		
        return view('admin.teachers.index',compact('users','admin_role','count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        $states = State::all();
		$districts = District::all();
		$schools = School::all();
		$classes = Sclass::all();
		$subjects = Subject::all();
        return view('admin.teachers.create',compact('states','districts','roles','schools','classes','subjects'));
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
		 $state = State::where('id', $request->state)->first();
		 //dd($state->name);
		 
		 
		$school = School::where('id', $request->school_name)->first();
        $district = District::where('id', $request->district)->first();
       // dd($request->all());
		$request->validate([
		'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
		'phone' => ['required', 'string', 'min:10', 'max:10'],
		'state' => ['required'],
		'district' => ['required'],
		'city' => ['required'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
		]);
        //dd($request->all());
			$teacher = Teacher::create([
            'name' => $request->name,
            'email' => $request->email,
			'phone' => $request->phone,
			'role_id' => 3,
            'password' => Hash::make($request->password),
			]);
		
			if($teacher->id){
			//dd($user->id);
				$usermeta = new Usermeta();
				$usermeta->user_id = $teacher->id;
				$usermeta->state = $state->name;
				$usermeta->state_id = $state->id;
				$usermeta->district = $district->name;
				$usermeta->district_id = $district->id;
				$usermeta->city = $request->city;
				$usermeta->school_name = $school->school_name;
				$usermeta->school_id = $school->id;
				$usermeta->created_by = Auth::user()->id;
				$usermeta->class = $request->class_id;
				$usermeta->subject = $request->subject_id;
				$usermeta->qualification = $request->qualification;
				$usermeta->dob = $request->dob;
				$usermeta->achievement = $request->achievement;
				$usermeta->gender = $request->gender;
				
				
				$usermeta->save();
				}
			$teacher->save();
		
       
	   return back()->with('msg','The following teacher has been added');
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
        
		$states = State::all();
		$districts = District::all();
		$schools = School::all();
		$classes = Sclass::all();
		$subjects = Subject::all();
        
		$result = DB::table('users')
					->leftJoin('usermetas', 'users.id', '=', 'usermetas.user_id')
					->select(['users.id','users.name','users.phone','users.email','usermetas.state',
					'usermetas.district','usermetas.city','usermetas.user_id','usermetas.school_name','usermetas.subject','usermetas.class',
					'usermetas.achievement','usermetas.dob','usermetas.gender','usermetas.qualification'])
					->where('users.id', $id)
					->first();
			//dd($result);		
       
	   return view('admin.teachers.edit',compact('states','districts','result','schools','classes','subjects'));
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
		
		$states = State::where('id',$request->state)->first();
		$districts = District::where('id',$request->district)->first();
		$school = School::where('id', $request->school_name)->first();
		  
		$request->validate([
		'name' => ['required', 'string', 'max:255'],
        
		'phone' => ['required', 'string', 'min:10', 'max:10'],
		'state' => ['required'],
		'district' => ['required'],
		'city' => ['required'],
       
		]);
        
			$teachers  = Teacher::find($id);
			$teachers->name = $request->name;
			$teachers->phone = $request->phone;
			
			$teachers->save();
			
			$usermetas = Usermeta::where('user_id',$id)->first();
			
			
				$usermetas->state = $states->name;
				$usermetas->state_id = $states->id;
				$usermetas->district = $districts->name;
				$usermetas->district_id = $districts->id;
				$usermetas->city = $request->city;
				$usermetas->school_name = $school->school_name;
				$usermetas->school_id = $school->id;
				$usermetas->created_by = Auth::user()->id;
				$usermetas->class = $request->class_id;
				$usermetas->subject = $request->subject_id;
				$usermetas->qualification = $request->qualification;
				$usermetas->dob = $request->dob;
				$usermetas->achievement = $request->achievement;
				$usermetas->gender = $request->gender;
			
			$usermetas->save();
			return back()->with('msg','The following teacher has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = Usermeta::where('user_id',$id)->first();
		$result->delete();
					
		return back()->with('msg','Deleted Succsfully');
    }
	
	public function getteacherDistrict(Request $request){
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
