<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Str;
use App\Models\User;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;


    /**
     * Verify security code for password recovery
     */
    public function verifySecurityCode(Request $request) {
        
        // \Log::info('Security code verification request', $request->all());

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'security_code' => 'required|string'
        ], [
            'email.required' => 'Email is required',
            'email.email' => 'Please enter a valid email address',
            'email.exists' => 'No account found with this email address',
            'security_code.required' => 'Security code is required'
        ]);

        if ($validator->fails()) {
            \Log::error('Security code validation failed', $validator->errors()->toArray());
            
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $user = User::where('email', $request->email)->first();

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not found'
                ], 404);
            }

            // Check if user has a security code set
            if (!$user->security_code) {
                return response()->json([
                    'success' => false,
                    'message' => 'No security code found for this account'
                ], 422);
            }

            // Verify security code
            if (Hash::check($request->security_code, $user->security_code)) {
               
                if ($user->security_code_generated_at) {
                    $expiryDate = $user->security_code_generated_at->addDays(30);
                    if (now()->gt($expiryDate)) {
                        return response()->json([
                            'success' => false,
                            'message' => 'Security code has expired. Please use another recovery method.'
                        ], 422);
                    }
                }

                // Store verification in session for password reset
                session([
                    'recovery_user_id' => $user->id,
                    'recovery_verified' => true,
                    'recovery_method' => 'backup_code'
                ]);

                \Log::info('Security code verified successfully for user: ' . $user->id);

                return response()->json([
                    'success' => true,
                    'message' => 'Security code verified successfully'
                ]);
            }

            \Log::warning('Invalid security code attempt for user: ' . $user->id);

            return response()->json([
                'success' => false,
                'message' => 'Invalid security code'
            ], 422);

        } catch (\Exception $e) {
            \Log::error('Security code verification error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to verify security code: ' . $e->getMessage()
            ], 500);
        }
    }
}
