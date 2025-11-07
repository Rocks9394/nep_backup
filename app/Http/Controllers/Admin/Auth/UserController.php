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

class UserController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth:admin');
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
		
		$roles = Role::all();
		
		//dd($request->all());
		if($request->input('search') == 'search')
			{
				$search_text = $request->input('name');
				//dd($search_text);
			$users = DB::table('users')
				->leftJoin('usermetas','users.id', '=',	'usermetas.user_id')
				->select(['users.id','users.name','users.email','users.role_id','users.phone','usermetas.state','usermetas.district'])
				->where('users.name',$search_text)
				->paginate(40);
			
			}
			else{
				$users = DB::table('users')
				->leftJoin('usermetas','users.id', '=',	'usermetas.user_id')
				->select(['users.id','users.name','users.email','users.role_id','users.phone','usermetas.state','usermetas.district'])
				->orderBy('id','desc')
				->paginate(40);
			}
			$count= User::count();
		
        return view('admin.users.index',compact('users','roles','count'));
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
        return view('admin.users.create',compact('states','districts','roles','schools'));
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
		'phone' => ['required', 'string', 'min:10','unique:users', 'max:10'],
		'state' => ['required'],
		'district' => ['required'],
		'city' => ['required'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
		]);
		if($school)
			{
	
			$user = User::create([
            'name' => $request->name,
            'email' => $request->email,
			'phone' => $request->phone,
			'role_id' => $request->role,
            'password' => Hash::make($request->password),
			]);
		
			if($user->id){
			//dd($user->id);
				$usermeta = new Usermeta();
				$usermeta->user_id = $user->id;
				$usermeta->state = $state->name;
				$usermeta->state_id = $state->id;
				$usermeta->district = $district->name;
				$usermeta->district_id = $district->id;
				$usermeta->city = $request->city;
				$usermeta->school_name = $school->school_name;
				$usermeta->school_id = $school->id;
				$usermeta->created_by = Auth::user()->id;
            
				$usermeta->save();
				}
			
			}
			else{
			$user = User::create([
            'name' => $request->name,
            'email' => $request->email,
			'phone' => $request->phone,
			'role_id' => $request->role,
            'password' => Hash::make($request->password),
			]);
		
			if($user->id){
			//dd($user->id);
				$usermeta = new Usermeta();
				$usermeta->user_id = $user->id;
				$usermeta->state = $state->name;
				$usermeta->state_id = $state->id;
				$usermeta->district = $district->name;
				$usermeta->district_id = $district->id;
				$usermeta->city = $request->city;
				
				$usermeta->created_by = Auth::user()->id;
            
				$usermeta->save();
				}
			
			}
		$user->save();
		
		
       
	   return back()->with('msg','The following user has been added');
		
		
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
		$roles = Role::all();
		$states = State::all();
		$districts = District::all();
        
		$result = DB::table('users')
					->leftJoin('usermetas', 'users.id', '=', 'usermetas.user_id')
					->select(['users.id','users.name','users.phone','users.email','usermetas.state','usermetas.district','usermetas.city','usermetas.user_id','users.role_id'])
					->where('users.id', $id)
					->first();
					
       
	   return view('admin.users.edit',compact('states','districts','result','roles'));
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
		$request->validate([
		'name' => ['required', 'string', 'max:255'],
        
		'phone' => ['required'],
		'state' => ['required'],
		'district' => ['required'],
		'city' => ['required'],
       
		]);
		
			//dd($request->all());
		    $states = State::where('id',$request->state)->first();
			$districts = District::where('id',$request->district)->first();
		
        
			$users  = User::find($id);
			$users->name = $request->name;
			$users->phone = $request->phone;
			$users->role_id = $request->role;
			$users->save();
			
			$usermetas = Usermeta::where('user_id',$id)->first();
			
			$usermetas->state = $states->name;
			$usermetas->district = $districts->name;
			$usermetas->city = $request->city;
			$usermetas->save();
			return back()->with('msg','The following user has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		
		
					
        $usermeta = Usermeta::where('user_id',$id)->first();
		
		$usermeta->delete();
        
        
	  
		
					
		return back()->with('msg','Deleted Succsfully');		 
    }
	
	public function getDistrict(Request $request){
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
	
	
	public function status(Request $request,$type,$id)
    {
        $user = User::findOrFail($id);
		//dd($id);
        $user->role_id = $type;
        $user->save();
        return back()->with(['msg' => 'msg','msg' => 'successfully added']);
    }
	
	public function Userdetails(Request $request)
	{
		$roles = Role::all();
		
		
			$users = DB::table('users')
				->leftJoin('usermetas','users.id', '=',	'usermetas.user_id')
				->select(['users.id','users.name','users.email','users.role_id','users.phone','usermetas.state','usermetas.district'])
				->get();
		
		
        return view('admin.users.user',compact('users','roles'));
	}
	
	public function userRole(Request $request)
	{
		
		print_r($request->userid);
		echo '<br>';
		print_r($request->roleid);
		exit();
		$id =  $request->userid;
			$user = User::where('id', $request->userid);		
      //DB::update('update users set role_id = ? where id = ?',[$roleid,$id]);
		
		/* DB::enableQueryLog();
UPDATE `users` SET `role_id`=2 WHERE id=32		
		
		$user = User::where('id', $request->userid)->update([
           'role_id' => $request->roleid
        ]);
		
		
		dd(DB::getQueryLog());
		
		die('q'); */
		
		
		 //return $user_id;
		 //return $role_id;
		 
		
		 //return back()->with(['msg' => 'msg','msg' => 'successfully added']);
		
		
		 
	}
}
