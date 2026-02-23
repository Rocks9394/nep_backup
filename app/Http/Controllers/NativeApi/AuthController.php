<?php

namespace App\Http\Controllers\NativeApi;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Sstudent;
class AuthController extends Controller {
  
    // LOGIN


    public function login(Request $request) {

        $request->validate([
            'login_id' => 'required|string',
            'password' => 'required|string',
        ]);

        $loginId = $request->login_id;
        $password = $request->password;

        $user = User::where('email', $loginId)->orWhere('userid', $loginId)->first();

        if ($user && Hash::check($password, $user->password)) {
            $token = $user->createToken('TrainerToken', ['trainer'])->accessToken;

            return response()->json([
                'status'       => true,
                'account_type' => 'user',
                'token'        => $token,
                'user'         => $user,
            ], 200);
        }


        $student = Sstudent::where('user_id', $loginId)->first();

        if ($student && Hash::check($password, $student->password)) {

            config(['auth.guards.api.provider' => 'sstudents']);
            // $student->withAccessToken($student->createToken('StudentToken', ['student'])->accessToken);
            $token = $student->createToken('StudentToken', ['student'])->accessToken;

            return response()->json([
                'status'       => true,
                'account_type' => 'student',
                'token'        => $token,
                'student'      => $student,
            ], 200);
        }

        return response()->json([
            'status' => false,
            'message' => 'Invalid credentials or user not registered',
        ], 401);
    }


    // LOGOUT
    public function logout(Request $request) {

        $request->user()->token()->revoke();

        return response()->json([
            'status' => true,
            'message' => 'Logged out successfully',
        ]);
    }
}
