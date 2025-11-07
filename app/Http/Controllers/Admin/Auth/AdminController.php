<?php
namespace App\Http\Controllers\Admin\Auth;

use App\Http\Requests;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
		echo "22"; 
        return view('admin.dashboard');
    }
}