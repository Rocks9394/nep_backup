<?php

namespace App\Http\Controllers\NativeApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\ProfileResource;

class TrainerProfileController extends Controller
{
    public function show(Request $request) {

        $trainer = Auth::guard('user-api')->user();

        return response()->json([
            'status' => true,
            'account_type' => 'user',
            'data' => new ProfileResource($trainer->load(['schools','usermeta'])),
        ]);
    }
}
