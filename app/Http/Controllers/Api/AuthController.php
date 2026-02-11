<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\Sstudent;
use GuzzleHttp\Client;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $loginType = $request->login_by;

        $rules = $this->getValidationRules($loginType);
        $validator = Validator::make($request->all(), $rules, $this->getValidationMessages());

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        switch ($loginType) {
            case 'Parent':
                return $this->parentLogin($request);

            case 'Trainer':
                return $this->trainerLogin($request);

            case 'School':
                return $this->schoolLogin($request);

            default:
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid login option'
                ], 400);
        }
    }

    private function schoolLogin(Request $request)
    {
        $credentials = [
            'password' => $request->password,
            'status' => 1
        ];

        // Login with email OR userid
        if (
            !Auth::attempt(array_merge($credentials, ['email' => $request->email])) &&
            !Auth::attempt(array_merge($credentials, ['userid' => $request->email]))
        ) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid school credentials'
            ], 401);
        }

        $user = Auth::user();

        // Role check
        if (!in_array($user->role_id, [2, 4])) {
            Auth::logout();
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized role'
            ], 403);
        }

        // Use Passport password grant to issue token
        return $this->passportToken($user->email, $request->password);
    }

    private function passportToken($email, $password)
    {
        $http = new Client();

        try {
            $response = $http->post(url('/oauth/token'), [
                'form_params' => [
                    'grant_type' => 'password',
                    'client_id' => env('PASSPORT_CLIENT_ID'),
                    'client_secret' => env('PASSPORT_CLIENT_SECRET'),
                    'username' => $email,
                    'password' => $password,
                    'scope' => '',
                ],
            ]);

            return response()->json(json_decode((string) $response->getBody(), true));
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Unable to generate access token',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    private function trainerLogin(Request $request)
    {
        if (!Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
            'status' => 1
        ])) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid credentials'
            ], 401);
        }

        $user = Auth::user();

        if ($user->role_id != 3) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized role'
            ], 403);
        }

        $token = $user->createToken('trainer-token')->plainTextToken;

        return response()->json([
            'status' => true,
            'token' => $token,
            'user' => $user
        ]);
    }


    private function parentLogin(Request $request)
    {
        $student = Sstudent::where('user_id', $request->student_id)
            ->where('status', '<>', 'transfer')
            ->where('is_active', '<>', 0)
            ->first();

        if (!$student || $student->password !== $request->dob) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid credentials'
            ], 401);
        }

        // Sanctum token
        $token = $student->createToken('parent-token')->plainTextToken;

        return response()->json([
            'status' => true,
            'message' => 'Login successful',
            'token' => $token,
            'user' => $student
        ]);
    }

    private function getValidationRules($loginType)
    {
        switch ($loginType) {
            case 'Parent':
                return [
                    'student_id' => 'required',
                    'dob' => 'required',
                ];
            case 'Trainer':
            case 'School':
                return [
                    'email' => 'required|email',
                    'password' => 'required',
                ];
            default:
                return [];
        }
    }

    private function getValidationMessages(){
        return [
            'student_id.required' => 'The school ID field is required.',
            'dob.required' => 'The password field is required.',
            'email.required' => 'The email field is required.',
            'email.email' => 'Please enter a valid email address.',
            'password.required' => 'The password field is required.',
        ];
    }


}