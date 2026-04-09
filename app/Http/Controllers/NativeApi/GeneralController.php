<?php

namespace App\Http\Controllers\NativeApi;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Response;


class GeneralController extends Controller {


	public function GetActivityList(){
		
		$videos = [
		    ['id' => 'g1rCLbqosQU', 'title' => 'Balance'],
		    ['id' => 'u8jSpu9qceQ', 'title' => 'Abdominal muscular strength and Endurance'],
		    ['id' => 'EjjvPin7sZc', 'title' => 'Muscular Endurance for Children'],
		    ['id' => 'SCcs5ccJp8E', 'title' => 'Muscular Endurance for Adults'],
		    ['id' => 'FMN9GRh5oj0', 'title' => 'Agility for 65+'],
		    ['id' => '2mM5m5XLHT8', 'title' => 'Flexibility for 65+'],
		    ['id' => 'WQTEnfNmwFo', 'title' => 'Abdominal Muscular Strength & Endurance for 19-65'],
		    ['id' => 'QwhZl7IbtR4', 'title' => 'Cardiovascular Endurance'],
		    ['id' => 'wD3DenG9JiQ', 'title' => 'Flexibility for 9-18'],
		    ['id' => 'msjIcQ0lKCk', 'title' => 'Flexibility for 19 to 65'],
		    ['id' => 'LZRKCMrFVCQ', 'title' => 'Aerobic Endurance for 65+'],
		    ['id' => 'GX-w7lOUd0c', 'title' => 'Muscular Endurance for 65+'],
		    ['id' => 'BxvdqGqeGiY', 'title' => 'Flexibility for 65+'],
		];

		return Response::json([
			'status' => true,
			'video'  => $videos,
		]);
	}

}