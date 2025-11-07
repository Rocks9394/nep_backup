<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use App\Models\User;
use App\Mail\SendMailreset;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\RequestHelper;//updatePassword


class ChanagePasswordController extends Controller { 

  //public function updatePassword(RequestHelper $request){    

   public function updatePassword(Request $request){       

        return $this->validateToken($request)->count() > 0 ? $this->changePassword($request) : $this->noToken();
    }

    private function validateToken($request){

        //'token' => $request->passwordToken     

        return DB::table('password_resets')->where([
            'email' => $request->email,
            'token' => $request->token            
        ]);
    }

    private function noToken() {
        return response()->json([
          'error' => 'Email or token does not exist.'
        ],Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    private function changePassword($request) {
        $user = User::whereEmail($request->email)->first();
        $user->update([
          'password'=>bcrypt($request->password)
        ]);
        $this->validateToken($request)->delete();
        return response()->json([
          'data' => 'Password changed successfully.'
        ],Response::HTTP_CREATED);
    }  
}