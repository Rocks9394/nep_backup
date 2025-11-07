<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sclass;
use App\Models\Teachingthrough;
use App\Models\Skill;
use App\Models\Sport;
use App\Models\Technique;
class SportsController extends Controller
{
	
	public function __construct()
    {
		//die('-gg-----');
        $this->middleware('auth:admin');
    }
	
	public function index(Request $request)
	{
		//die('-------payment detail---');
		$title = 'Sports';
		$classes  = Sclass::orderBY('orders','ASC')->get();			
		$skillareas = Skill::orderBY('name','ASC')->get();
		$sportskills = Sport::orderBY('name','ASC')->get();
		$techniques = Technique::orderBY('name','ASC')->get();		
	
		return view('sports.index', compact('title','classes','skillareas','sportskills','techniques'));  
	}
	
	
}
