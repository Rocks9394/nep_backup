<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use App\Models\Sstudent;
use Illuminate\Support\Facades\Log;





class AuthenticateStudent
{


    public function handle(Request $request, Closure $next, ...$guards)
    {
        
        $isSchoolAdmin = Auth::guard('web')->check();
        $isStudent = Auth::guard('sstudent')->check();
        

        if ($isSchoolAdmin || $isStudent) {
            return $next($request);
        }

        $rememberToken = $request->cookie('student_remember_token');
        if ($rememberToken) {
            $student = Sstudent::where('remember_token', $rememberToken)->first();
            if ($student) {
                Auth::guard('sstudent')->login($student);
                $request->session()->regenerate();
                return $next($request);
            }
        }

        return redirect()->route('login.test');
    }


    public function handle_bk(Request $request, Closure $next, ...$guards)
    {
  
        $isSchoolAdmin = Auth::guard('web')->check();
        $isStudent = Auth::guard('sstudent')->check();
        

        if ($isSchoolAdmin || $isStudent) {
            return $next($request);
        }

        $rememberToken = $request->cookie('student_remember_token');
        if ($rememberToken) {
            $student = Sstudent::where('remember_token', $rememberToken)->first();
            if ($student) {
                Auth::guard('sstudent')->login($student);
                $request->session()->regenerate();
                return $next($request);
            }
        }

        return redirect()->route('login.test');
    
    }
}



