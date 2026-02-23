<?php

namespace App\Http\Controllers\NativeApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

use App\Http\Resources\ProfileResource;

class ProfileController extends Controller
{
 

    public function show(Request $request) {
    
        $authUser = $request->user();


        echo "<pre>"; print_r($authUser);exit();
        

        if (!$authUser) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized'
            ], 401);
        }


        if ($authUser instanceof \App\Models\User) {

            $authUser->load(['schools', 'usermeta']);

            return response()->json([
                'status' => true,
                'account_type' => 'user',
                'data' => new ProfileResource($authUser),
            ]);
        }

        // If logged-in model is Student
        if ($authUser instanceof \App\Models\Sstudent) {

            return response()->json([
                'status' => true,
                'account_type' => 'student',
                'data' => $authUser, // or StudentProfileResource
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Invalid account type'
        ], 400);
    }


    public function show_nk(Request $request) {

        $user = auth()->user();

        echo "<pre>"; print_r($user); exit();

        $user = $request->user()->load(['schools','usermeta']);
        
        return response()->json([
            'status' => true,
            'data' => new ProfileResource($user),
        ]);
    }


    public function update(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id),
            ],
            'phone' => 'nullable|string|max:15',
        ]);

        $user->update($validated);

        return response()->json([
            'status'  => true,
            'message' => 'Profile updated successfully',
            'data'    => $user,
        ]);
    }

    // POST /api/profile/avatar
    public function updateAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user = $request->user();

        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);
        }

        $path = $request->file('avatar')->store('avatars', 'public');

        $user->update([
            'avatar' => $path,
        ]);

        return response()->json([
            'status'     => true,
            'message'    => 'Avatar updated successfully',
            'avatar_url' => asset('storage/' . $path),
        ]);
    }
}
