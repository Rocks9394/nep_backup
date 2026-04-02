<?php


namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Sstudent;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cookie;
use App\Helpers\Helper;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Artisan;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    protected $redirectTo = '/academics';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
	
	
	public function showLoginForm() 
	{
       // return view('auth.login');
	   try{
		   return view('auth.logintest'); 
	   }catch(\Exception $e)
	   {
		  //
	   }
      
    }

    
    public function login(Request $request)	{  


    	echo "string"; exit();
	
        $data     = $request->all();
        $rules    = [];
        $messages = [];

        if ($data['login_by'] == 'Parent') {
            $rules = [
                'student_id' => 'required',
                //'dob' => 'required|date_format:m/d/Y', 
                //'captcha' => 'required|captcha',
				'g-recaptcha-response' => 'required'
            ];
            
            $messages = [
                'student_id.required' => 'The school ID field is required.',
                // 'student_id.numeric' => 'Student id must be numeric.',
                'dob.required' => 'The date of birth field is required.',
                // 'dob.date_format' => 'The date of birth does not match the format dd/mm/yy',
               // 'captcha.required' => 'The captcha field is required.',
              //  'captcha.captcha' => 'Invalid captcha code, please try again.'
				'g-recaptcha-response.required' => 'The captcha field is required.'
            ];
        } elseif ($data['login_by'] == 'Trainer' || $data['login_by'] == 'School') {
            $rules = [
                'email' => 'required|email',
                'password' => 'required',
               // 'captcha' => 'required|captcha',
				'g-recaptcha-response' => 'required'
            ];

            $messages = [
                'email.required' => 'The email field is required.',
                'email.email' => 'Please enter a valid email address.',
                'password.required' => 'The password field is required.',
               // 'captcha.required' => 'The captcha field is required.',
               // 'captcha.captcha' => 'Invalid captcha code, please try again.',
				'g-recaptcha-response.required' => 'The captcha field is required.'
				//'g-recaptcha-response' => 'required',
            ];
        } else {
            return redirect()->route('login')->with(['status' => 'error', 'msg' => 'Invalid login option selected.']);
        }

        $validator = Validator::make($data, $rules, $messages);
		
		//Add custom validation for reCAPTCHA
        /* $validator->after(function ($validator) use ($request) {
            $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
                'secret' => "6LdMGT0qAAAAAKO-o__ACk9zWTHDNoNBMmD-gMxE",
                'response' => $request->input('g-recaptcha-response'),
                'remoteip' => $request->ip(),
            ]);

            $responseBody = json_decode($response->getBody());

            if (!$responseBody->success) {
               // $validator->errors()->add('captcha', 'reCAPTCHA verification failed. Please try again.');
            }
        }); */

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
		
		
			$remember = $request->has('remember');
   
        if($data['login_by'] == 'Parent')
		{
			$student_id = $request->input('student_id');            
			$student_uid = $request->input('dob');
			$student_pwd = 'S'.$student_uid.'A';
			$cookiepassword = base64_encode(base64_encode($student_pwd));

			$student = Sstudent::where('user_id', $student_id)->where('status','<>','transfer')->where('is_active','<>', 0)->first();
			 Log::warning('User profile updated.', ['user_id' => 1, 'action' => 'update']);
                    
            if($student && $student->password == $student_uid) 
			{
                Auth::guard('sstudent')->login($student, $remember); 
				$request->session()->regenerate();
				
			
				if($remember) 
				{
					if(!$student->remember_token) 
					{
						$student->remember_token = Str::random(60);
						$student->save();
					}

					$oneMonth = 60 * 24 * 30;
					Cookie::queue('user_type', $data['login_by'], $oneMonth);
					Cookie::queue('student_id_cookie', $student_id, $oneMonth);
					Cookie::queue('student_password_cookie', $cookiepassword, $oneMonth);
					Cookie::queue('student_remember_token', $student->remember_token, $oneMonth);
				
					//return redirect()->route('student.dashboard')->withCookie($cookie);
					//return redirect()->route('student.dashboard');
				}else
				{
					$redict = 'student.dashboard';
					$oneMonth = 60 * 24 * 30;
					Cookie::queue('redirectionRole', $redict, $oneMonth);
				}
				
				$Cookname   = "RelayAuth";
				$Cookvalue  = $this->generateRandomString();
				$domain     = "goforfit.in";
				// Create the cookie
				$cookie = cookie('my_cookie_dot', $Cookvalue, 60, '/', $domain, true, false, false, 'None');
				
		
                return redirect()->route('student.dashboard')->cookie($cookie);
				//return redirect()->route('parent-dashboard');
            }

            return redirect()->route('login')->with(['status' => 'error', 'msg' => 'Invalid credentials.']);  

        }elseif($data['login_by'] == 'Trainer' || $data['login_by'] == 'School') 
		{
            $credentials = ['email' => $request->email, 'password' => $request->password, 'status' => 1]; 
            
            // $credentials = $request->only('email', 'password');
            if (Auth::attempt($credentials, $remember))
            {
                Helper::auditLog('login', $data['login_by']);
					$user = Auth::user();
					if($user->status == 0)
					{
						$this->guard('web')->logout();
					}						
					$request->session()->regenerate();
					
					
				if ($remember) 
				{
					if(!$user->remember_token) 
					{
						$user->remember_token = Str::random(60);
						$user->save();
					}
					
					
					$student_uid = $request->password;
					$student_pwd = 'S'.$student_uid.'A';
					$cookiepassword = base64_encode(base64_encode($student_pwd));
					
					
					$oneMonth = 60 * 24 * 30;
					Cookie::queue('user_type', $data['login_by'], $oneMonth);
					Cookie::queue('student_id_cookie',  $request->email, $oneMonth);
					Cookie::queue('student_password_cookie', $cookiepassword, $oneMonth);
					Cookie::queue('student_remember_token', $user->remember_token, $oneMonth);
				
					//return redirect()->route('student.dashboard')->withCookie($cookie);
					
					#if ($data['login_by'] == 'School')
					#return redirect()->route('schoolDashboard');
					#else
					#return redirect()->route('filldart.dashboard');
				}else
				{
					
					if($data['login_by'] == 'School')
				     $redict = 'schoolDashboard';
					else
					 $redict = 'filldart.dashboard';
					$oneMonth = 60 * 24 * 30;
					Cookie::queue('redirectionRole', $redict, $oneMonth);
				}
					
					
					
				if ($data['login_by'] == 'School')
				{
						$Cookname   = "RelayAuth";
						$Cookvalue  = $this->generateRandomString();
						$domain     = "goforfit.in";

						// Create the cookie
						$cookie = cookie('my_cookie_dot', $Cookvalue, 60, '/', $domain, true, false, false, 'None');
						return redirect()->route('schoolDashboard')->cookie($cookie);
					
				}
                else
                return redirect()->route('filldart.dashboard');
				
				
				
            } else
			{
                return redirect()->route('login')->with(['status' => 'error', 'msg' => 'Invalid credentials.']);
            }
        }

        return redirect()->route('login')->with(['status' => 'error', 'msg' => 'Invalid login option selected.']);
    }


    public function showCustomLoginForm() {
       return view('auth.customloginform');
    }
	
	
    public function logout(Request $request)
    {
        
        Helper::auditLog('log-out', 'System-logut');
		
		if(!empty(Auth::User()->role_id))
		{
		    $data = Auth::User();
			if ($data) 
			{
				$data->forceFill([
				'remember_token' => null,
				])->save();
			}
		  
			 if($data->role_id == 3 || $data->role_id == 4)
			  $this->guard('web')->logout();

		}else
		{
			$std = Auth::guard('sstudent')->user(); 
			if ($std) 
			{
				$std->forceFill([
				'remember_token' => null,
				])->save();
			}
			$this->guard('sstudent')->logout();
		}
		
		
		Cookie::queue(Cookie::forget('user_type'));
		Cookie::queue(Cookie::forget('student_id_cookie'));
		Cookie::queue(Cookie::forget('student_password_cookie'));
		Cookie::queue(Cookie::forget('student_remember_token'));
		Cookie::queue(Cookie::forget('redirectionRole'));

		$request->session()->invalidate();
		$request->session()->regenerateToken();
        return redirect()->route('login');
    }
	
	private function generateRandomString($length = 5) 
	{
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';

		for($i = 0; $i < $length; $i++) 
		{
			$randomString .= $characters[random_int(0, $charactersLength - 1)];
		}

		return $randomString;
	}
	

    // updated login form and method 

    public function newLoginForm() {
    
    	if (auth()->check()) {

	        $user = auth()->user();
	        switch ($user->role_id) {
	            case 3:
	                return redirect()->route('filldart.dashboard');
	            case 4:
	                return redirect()->route('filldart.dashboard');
	            default:
	                return redirect()->route('index');
	        }
	    }
		$title = 'Login';
	   	return view('auth.backup-login',compact('title'));  
    }


    private function getValidationRules($loginType){

    	switch ($loginType) {
	        case 'Parent':
	            return [
	                'student_id' => 'required',
	                'dob' => 'required',
	                'g-recaptcha-response' => 'required',
	            ];
	        case 'Trainer':
	        case 'Cicse':
	        case 'School':
	            return [
	                'email' => 'required|email',
	                'password' => 'required',
	                'g-recaptcha-response' => 'required',
	            ];
	        default:
	            return [];
	    }
    }

    private function getValidationMessages($loginType){

    	return [
	        'student_id.required' => 'The school ID field is required.',
	        'dob.required' => 'The password field is required.',
	        'email.required' => 'The email field is required.',
	        'email.email' => 'Please enter a valid email address.',
	        'password.required' => 'The password field is required.',
	        'g-recaptcha-response.required' => 'The captcha field is required.',
	    ];
    }


    private function handleParentLogin(Request $request, $remember, $role) {

	    $student_id = $request->input('student_id');
	    $dob = $request->input('dob'); // Used as password
	    $student = Sstudent::where('user_id', $student_id)
	        ->where('status', '<>', 'transfer')->where('is_active','<>', 0)
	        ->first();
	    if ($student && Hash::check($dob, $student->password)) {
	        Auth::guard('sstudent')->login($student, $remember);
	        $request->session()->regenerate();

	        $this->setRememberMeCookies($remember, $request, $dob, $student->remember_token, 'Parent');

	        // Set cross-domain secure cookie
	        $cookie = cookie('my_cookie_dot', $this->generateRandomString(), 60, '/', config('app.cookie_domain'), true, true, false, 'None');
			Helper::auditLog('login', $role);
			if (Carbon::parse($student->updated_at)->lt(now()->subMonths(3))) {
				$route = route('student.profile');
				session()->flash('show_profile_update_popup', true);
				session()->flash('profile_update_route', $route);
			}
	        return redirect()->route('student.dashboard')->cookie($cookie);
	    }

	    Auth::logout();
	    return redirect()->route('login')->with(['status' => 'error', 'msg' => 'Invalid credentials.']);
	}

	private function handleSchoolLogin(Request $request, $remember, $role) {

		$loginField = $request->email;
		
		$credentials = [
	        'password' => $request->password,
	        'status'   => 1,
	    ];


	    if ((Auth::attempt(array_merge($credentials, ['email' => $loginField]), $remember) 
    	|| Auth::attempt(array_merge($credentials, ['userid' => $loginField]), $remember)) && in_array(Auth::user()->role_id, [2, 4])) {
    		
	        $user = Auth::user();
	        $request->session()->regenerate();

	        if ($user->status == 0) {
	            Auth::logout();
	            return redirect()->route('login')->with(['status' => 'error', 'msg' => 'Account inactive.']);
	        }
	        $this->setRememberMeCookies($remember, $request, $request->password, $user->remember_token, 'School');

	        // $route = $role === 'School' ? 'schoolDashboard' : 'filldart.dashboard';
	        //$route = $role === 'School' ? 'filldart.dashboard' : 'filldart.dashboard';
	        Helper::auditLog('login', $role);
			if (Carbon::parse($user->updated_at)->lt(now()->subMonths(3))) {
				$route = route('update.profile');
				session()->flash('show_profile_update_popup', true);
				session()->flash('profile_update_route', $route);
			}

	        $cookie = cookie('my_cookie_dot', $this->generateRandomString(), 60, '/', config('app.cookie_domain'), true, true, false, 'None');
	        return redirect()->route('filldart.dashboard')->cookie($cookie);
	    }
	    Auth::logout();
	    return redirect()->route('login')->with(['status' => 'error', 'msg' => 'Invalid School credentials.']);
	}

	private function handleTrainerLogin(Request $request, $remember, $role) {
	    $credentials = [
	        'email' => $request->email,
	        'password' => $request->password,
	        'status' => 1,
	    ];

	    if (Auth::attempt($credentials, $remember) && Auth::user()->role_id == 3) {

	        $user = Auth::user();
	        if ($user->status == 0) {
	            Auth::logout();
	            return redirect()->route('login')->with(['status' => 'error', 'msg' => 'Account inactive.']);
	        }
	        $request->session()->regenerate();
	        $this->setRememberMeCookies($remember, $request, $request->password, $user->remember_token, 'Trainer');
	        $cookie = cookie('my_cookie_dot', $this->generateRandomString(), 60,'/', config('app.cookie_domain'), true,  true, false, 'None');
			Helper::auditLog('login', $role);
			if (Carbon::parse($user->updated_at)->lt(now()->subMonths(3))) {
				$route = route('editprofile');
				session()->flash('show_profile_update_popup', true);
				session()->flash('profile_update_route', $route);
			}
	        return redirect()->route('filldart.dashboard')->cookie($cookie);
	    }

	    Auth::logout();
	    return redirect()->route('login')->with(['status' => 'error', 'msg' => 'Invalid trainer credentials.']);
	}

	private function setRememberMeCookies($remember, Request $request, $rawPassword, $rememberToken, $loginType) {

	    if (!$remember) {
	        Cookie::queue('redirectionRole', $loginType === 'School' ? 'filldart.dashboard' : 'filldart.dashboard', 60 * 24 * 30);
	        return;
	    }

	    if (!$rememberToken) {
	        $user = Auth::user();
	        $user->remember_token = Str::random(60);
	        $user->save();
	        $rememberToken = $user->remember_token;
	    }

	    $cookiePassword = base64_encode(base64_encode('S' . $rawPassword . 'A'));

	    Cookie::queue('user_type', $loginType, 60 * 24 * 30);
	    Cookie::queue('student_id_cookie', $loginType === 'Parent' ? $request->student_id : $request->email, 60 * 24 * 30);
	    Cookie::queue('student_password_cookie', $cookiePassword, 60 * 24 * 30);
	    Cookie::queue('student_remember_token', $rememberToken, 60 * 24 * 30);
	}

    public function loginNew(Request $request) {

        $data     = $request->all();
        $loginType = $data['login_by'] ?? null;

	    $rules = $this->getValidationRules($loginType);
	    $messages = $this->getValidationMessages($loginType);

	    $validator = Validator::make($data, $rules, $messages);
	    if ($validator->fails()) {
	        return redirect()->back()->withErrors($validator)->withInput();
	    }

	    $remember = $request->has('remember');

	    switch ($loginType) {
	    	case 'Parent':
	    		return $this->handleParentLogin($request, $remember,  $loginType);
	    		break;
	    	case 'Trainer':
	    		return $this->handleTrainerLogin($request, $remember, $loginType);
	    		break;
	    	case 'School':
	    		return $this->handleSchoolLogin($request, $remember, $loginType);
	    		break;
	    	default:
	    		return redirect()->route('login.new')->with(['status' => 'error', 'msg' => 'Invalid login option selected.']);
	    }
    }


}


