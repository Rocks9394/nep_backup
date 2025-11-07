<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\District;
use App\Models\State;
use App\Models\Usermeta;
use App\Models\Teacher;
use App\Models\Board;
use App\Models\Region;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Auth; 
use App\Contracts\EmailServiceInterface;
use Illuminate\Contracts\View\Factory as ViewFactory;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
		
		
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
			'phone' => ['required', 'string', 'min:10', 'max:10'],
			'state' => ['required'],
			'district' => ['required'],
			'city' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
		
		$chkerro = false;
		$validator = Validator::make([],[]);
		
		if(empty($data['state'])){
			$chkerro = true;
			$validator->errors()->add("The state field is required");
		}
		if(empty($data['district'])){
			$chkerro = true;
			$validator->errors()->add("The district field is required");
		}
		if($chkerro){
			throw new ValidationException($validator);   
		}
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
		
		
		if(!empty($data['state'])){ $state = State::find($data['state']); } 
		if(!empty($data['district'])){ $district = District::find($data['district']); } 
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
			'phone' => $data['phone'],
			'role_id' => 2,
            'password' => Hash::make($data['password']),
        ]);
		
		if($user->id){
            $usermeta = new Usermeta();
            $usermeta->user_id = $user->id;
            if(!empty($state['name'])) $usermeta->state = $state['name'];
			if(!empty($state['id'])) $usermeta->state_id = $state['id'];
            if(!empty($district['name'])) $usermeta->district = $district['name'];
			if(!empty($district['id'])) $usermeta->district_id = $district['id'];
            if(!empty($data['city'])) $usermeta->city = $data['city'];
            
            $usermeta->save();
        }
        return $user;
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




    /**
     * Date : 29-05-2025
     * Self Registration Form For School & Trainer.
     * */


    public function TrainerSelfRegistration(){ 

        $title = 'New Trainer Self Registration'; 
        $state_list  = State::orderBy('name', 'asc')->get();   
        $cities = District::orderBy('name', 'asc')->get(['id', 'name']);
        return view('auth.self_registration.trainer', compact('title','state_list','cities'));
    }

    public function RegisterTrainer(Request $request, EmailServiceInterface $emailService, ViewFactory $view){


        $state = State::where('id', $request->state)->first();         
        $district = District::where('id', $request->district)->first();


        $validator = Validator::make($request->all(), [
            'trainerName' => 'required|string|max:255',
            'gender' => 'required|in:Male,Female,Transgender',
            'qualification' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'mobile' => 'required|unique:users,phone|digits:10',
            'state' => 'required|integer|exists:states,id',
            'district' => 'required|integer|exists:districts,id',
            'city' => 'required|string|max:255',
            'block' => 'required|string|max:255',
            'address' => 'required|string|max:500',
            'marketing_consent' => 'accepted',
            'privacy_policy' => 'accepted',
            'term_condition' => 'accepted',
            'dob' => ['required', 'date', 'after_or_equal:start_date',
                function ($attribute, $value, $fail) use ($request) {
                    $dob = \Carbon\Carbon::parse($value);  $age = $dob->age;

                    if ($request->has('term_condition') && $age < 18) {
                        $fail('You must be at least 18 years old to accept the Terms and Conditions.');
                    }
                }],
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        $dob = $request->post('dob');
        $password = str_replace('-', '', $dob);

        $teacher = Teacher::create([
            'name' => $request->trainerName,
            'email' => $request->email,
            'phone' => $request->mobile,
            'position' => 'Trainer',
            'role_id' => 3,
            'status'  => 0,
            'password' => Hash::make($password),
        ]);

        if($teacher){ 
            $usermeta = new Usermeta();
            $usermeta->user_id = $teacher->id;
            $usermeta->state = $state->name;
            $usermeta->state_id = $state->id;
            $usermeta->district = $district->name;
            $usermeta->district_id = $district->id;
            $usermeta->city = $request->city;
            $usermeta->school_name = null;
            $usermeta->school_id = null;
            $usermeta->created_by = Auth::user()->id ?? null;
            $usermeta->class = null;
            $usermeta->subject = null;
            $usermeta->qualification = $request->qualification;
            $usermeta->dob = $request->dob;
            $usermeta->achievement = $request->achievement ?? null;
            $usermeta->gender = $request->gender;    
            $usermeta->save();
        }

        $teacher->save();
        $serial = str_pad($teacher->id, 7, '0', STR_PAD_LEFT);
        $self_registrationId = 'GFFT' . $serial;
        $teacher->update(['self_registrationId' => $self_registrationId]);


        $recipient = [
            'email' => $teacher->email,
            'name' => $teacher->name,
        ];
        $subject = 'Welcome to GoForFit, '. $teacher->name .' – Your Registration Is Successful!';
        $htmlContent = $view->make('emails.self_registration_mail', [
            'user' => $teacher,
            'password' => $password,
            'registrationId' => $self_registrationId,
        ])->render();

        $emailService->send($recipient, $subject, $htmlContent);
        

        return redirect()->back()->with('registration_success', $self_registrationId);
    }


    public function SchoolSelfRegistration(){        
        $title = 'New School Self Registration';  
        $board_list  = Board::orderBy('boardname', 'asc')->get();
        $state_list  = State::orderBy('name', 'asc')->get();  
        $regions     = Region::orderBy('name', 'asc')->get(); 
        $states      = State::orderBy('name','asc')->get();
        return view('auth.self_registration.school', compact('title','board_list','regions','states'));
    }

    public function getDistrictList(Request $request) {
        $stateId = $request->post('stateId');
        $cities = District::where('state_id', $stateId)->get(['id', 'name']);
        return response()->json($cities);
    }

    

    /* Date : 14-06-2025   working on */
    public function RegisterSchool(Request $request) {

        echo "<pre>"; print_r($request->post());exit();


        $validator = Validator::make($request->all(), [
            'joinType' => 'required|in:Board,SchoolChain',
            'board' => 'required_if:joinType,Board',
            'schoolChain' => 'required_if:joinType,SchoolChain',
            'ddlSchoolType' => 'required|in:1,2',
            'schoolCode' => 'required|string|unique:schools,school_code',
            'region' => 'required',
            'state' => 'required',
            'district' => 'required',
            'website' => 'nullable|string',
            'city' => 'required|string|max:100',
            'schoolName' => 'required|string|max:255',
            'schoolShift' => 'required|in:0,1',
            'schoolEmail' => 'required|email|unique:schools,school_email',
            'mobile' => 'required|digits:10',
            'address' => 'required|string',
            'description' => 'required|string',
            'principalName' => 'required|string|max:100',
            'principalEmail' => 'required|email|unique:users,email',
            'schoolAdminDesignation' => 'required|in:0,1',
            'gender' => 'required|in:0,1,2',
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

    

        try {

            $school = new School();
            $school->board_id = $request->board_id ?? null;
            $school->board    = $request->board;
            $school->school_name = $request->schoolName;
            $school->school_code = $request->schoolCode;
            $school->school_principal = $request->principalName;            
            $school->school_email = $request->schoolEmail;
            $school->school_phone = $request->schoolPhone;   
            $school->city = $request->city;
            $school->state_id = $request->state_id ?? null;
            $school->state    = $request->state ?? null;
            $school->district_id = $request->district;
            $school->region = null;
            $school->zonename = null;
            $school->address = $request->address;
            $school->chain = null;
            $school->board = null;
            $school->pincode = null;
            $school->chain = null;
            $school->chain = null;
            $school->status = null;
            $school->board_id = $request->board ?? null;
            $school->school_chain = $request->schoolChain ?? null;


            $school->type = $request->ddlSchoolType;
            $school->shift = $request->ddlShift;
            $school->website = $request->website;
            $school->description = $request->description;
            $school->save();

            // Create school admin user

            $serial = str_pad($school->id, 7, '0', STR_PAD_LEFT);
            $self_registrationId = 'GFFS' . $serial;

            $admin = new User();
            $admin->self_registrationId = $self_registrationId;
            $admin->name = $request->principalName;
            $admin->email = $school->principalEmail;
            $admin->designation = $request->ddlSchoolAdminDesignation;
            $admin->gender = $request->ddlGender;
            $admin->password = Hash::make('default_password');    // Update password logic as needed
            $admin->save();

          

            return redirect()->route('login')->with('success', 'School registered successfully. Please wait for approval.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'An error occurred. Please try again later.');
        }
    }


}
