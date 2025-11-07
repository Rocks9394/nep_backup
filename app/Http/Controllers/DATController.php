<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sclass;
use App\Models\Teachingthrough;



use App\Models\School;
use App\Models\Activity;
use App\Models\Report;
use DB;
use Response;
use Validator;
use Redirect;
use paginate;

class DATController extends Controller
{
	
	public function __construct()
    {
        $this->middleware('auth');
    }
	
	public function index(Request $request)
	{

		$title = 'View Trainer';
		return view('viewtrainer.index', compact('title')); 
    }


	function ReadExcelDemo(request $request)
	{
		
		//$dailyactivitydata = DB::table('dats')->where('class','Pre-Nursery')->first();
		try {
			
		 

		$dailyactivitydata = DB::table('dats')->where('class','Pre-Nursery')->where('activity_name','Animal walk kangaroo jumps')->get();

		//echo count($dailyactivitydata);
		//die;
		foreach($dailyactivitydata as $fkey => $fval)
		{

		// if($fkey ==0 || $fkey ==1 ||  $fkey ==2 ||  $fkey ==3 ||  $fkey ==4 ||  $fkey ==5 ||  $fkey ==6 ||  $fkey ==7 ||  $fkey ==8 || $fkey ==9 || $fkey ==10 )
		// continue;

			 if($fkey >0)
			 continue;

		

			if($fkey > 12)
			{
			 die('---stop shere---');
			}

			//echo $fkey;
			//die('--s-');

			$usersdata = DB::table('users')->where('name',$fval->trainer_name)->first('id');
			
		

		$excelDatafirst = DB::table('dublicate_sheet_b')->where('activity13',$fval->activity_name)->get();


		//echo $fval->activity_name;
		//die('--');

		    
		

		foreach($excelDatafirst as $key => $val)
		{
		
			// 	try
			// 	{

				//if($key == 0)
				//continue;

			//echo "key index----".$key;
			//echo "-----------";

			$ActivityValue = '';

			//$PropertyName   = "activity".++$key;
			$PropertyName   = "activity13";

			
			$ActivitySearch = $excelDatafirst[0]->$PropertyName;

			//echo $PropertyName;
			//echo "<hr>";
			//echo $ActivitySearch;
			//echo "<hr>";




			//echo $fval->activity_name;
			//echo "<pre>";
			 //print_r($val);
			 //die('----');



			


	   


			// if($key <=8)
			// {
			// 	$PropertyName   = "activity".$key;
			//     $ActivitySearch = $excelDatafirst[0]->$PropertyName;
			// 	//$ActivityValue  = $val->$PropertyName;
			// }
			// elseif($key >8 && $key<=12)
			// {
			// 	$PropertyName   = "May".$key;
			// 	$ActivitySearch = $excelDatafirst[0]->$PropertyName;
			// 	//$ActivityValue  = $val->$PropertyName;
			// }else
			// {
			//     die('----hello india----'); 
			// }


			//echo "<pre>";
			//echo $ActivitySearch.' '.$ActivityValue;
			
			//echo "<hr>";
			//die('---change the detail----');



		 	$studentData = DB::table('students')->where('custom_class_id', 1)->get();


		 	foreach($studentData as $skey => $sval)
		 	{

		 		//$sId = (float)$sval->student_uid.'.0';
				  $sId = $sval->student_uid;
				
		 		$excelData = DB::table('dublicate_sheet_b')->where('adm_no',$sId)->first();

			
		 		if(empty($excelData))
		 		  continue;

				 $levelVal   =  $excelData->$PropertyName;
			
				// $absentDate =  $excelData->unknownColumn10;
				// echo "<pre>";
				// $arrayDate = explode(" ",$absentDate);
				
				 //echo "-----------";
				
				 //$arrayDate = explode("+",implode(",",$arrayDate));
				 //print_r($arrayDate);
				//echo 'studentid---'.$sId.'----';
				//echo "<pre>";
				//print_r($absentDate);
				//echo "================================";
				
				
		 		//$getactivity = DB::table('activity')->where('title', 'LIKE', "%{$ActivitySearch}%") ->get();
				$getactivity = DB::table('activity')->where('title',$ActivitySearch) ->get();

				echo "count--".count($getactivity);
				echo "---cahnge the data---";
				if(count($getactivity) == 0)
				{
					continue;
                    // die('----stop');
				}else{

				}
				


		 		//echo "<pre>";
		 		//print_r($getactivity[0]->id);
		 		//echo "<hr>";
		 		//echo $sval->class_id;

				

			if(!empty($getactivity))
			{
				 $ActivityTechnique = DB::table('activity_technique')->where('act_id',$getactivity[0]->id)->where('class_id',$sval->class_id)->first();

				 //echo count($getactivity);
		 		 //echo "<pre>";
		 		 //print_r($ActivityTechnique);
		 		 //echo "<hr>";
		 		 //echo $sval->class_id;
		 		 //die('-------');


			}else
			{
				 continue;
			}


		 		$userId  = $usersdata->id;
				$date    = $fval->date;
				$period    = $fval->period;

		 		if(!empty($sval))
		 		{


					echo  'class_id--'.$sval->class_id.'---custom-cls-id--'.$sval->custom_class_id.'--period-'.$period.'---date--'.$date.'---skilarea-'.$ActivityTechnique->skillarea_id.'---sports--'.$ActivityTechnique->sportskill_id.'--technique--'.$ActivityTechnique->technique_id.'----activity--'.$ActivityTechnique->act_id.'----student_id--'.$sval->id.'----activity-value---'.$ActivityTechnique->act_id;
					echo "<hr>";


					// echo "---";
					// echo "<pre>";
					// //print_r($getactivity);
					// echo "<hr>";
					// print_r($ActivityTechnique);
					//die('----changedd the detail---');
	


					//echo "<hr>";
	
					$reports = new Report;
					$reports->school_id       =  2823;
					$reports->class_id        =  $sval->class_id;
					$reports->custom_class_id =  $sval->custom_class_id;
					$reports->period          =  $period;
					$reports->date            =  $date;
					$reports->skill_area_id   =  $ActivityTechnique->skillarea_id;
					$reports->skill_sports_id =  $ActivityTechnique->sportskill_id;
					$reports->technique_id    =  $ActivityTechnique->technique_id;
					$reports->activity_id     =  $ActivityTechnique->act_id;
					$reports->student_id      =  $sval->id;
					$reports->level           =  $levelVal;
					$reports->submitted_by    =  $userId;
					$reports->status          =  1;
					$reports->save(); 

				}



		 	}


		// }catch(\Exception $e)
		// {
		// 	echo $e->getMessage();
		// 	die('----');
		// }


		    
		//echo "-----double engine-----";
		//echo "<hr>";

			//$studentData = DB::table('students')->where('student_uid', $val->unknownColumn2)->first();


		}
		

	   }


	} catch (\Exception $e) {
		echo "<pre>";
		print_r($e->getMessage());
		die;
	  }
		//die('----');

	}



	private function LatestBackupReadExcelDemo(request $request)
	{
		echo "<pre>";
		print_r($request->all());
		die('----change the detail---');
    
		$excelDatafirst = DB::table('backup_workingfile_nursery')->get();
		
		foreach($excelDatafirst as $key => $val)
		{
		
		// 	try
		// 	{

			if($key == 0)
			 continue;

			echo "key index----".$key;
			echo "-----------";
			
			$ActivityValue = '';
			
			if($key <=8)
			{
				$PropertyName   = "April".$key;
			    $ActivitySearch = $excelDatafirst[0]->$PropertyName;
				//$ActivityValue  = $val->$PropertyName;
			}
			elseif($key >8 && $key<=12)
			{
				$PropertyName   = "May".$key;
				$ActivitySearch = $excelDatafirst[0]->$PropertyName;
				//$ActivityValue  = $val->$PropertyName;
			}else
			{
                die('----hello india----'); 
			}


			//echo "<pre>";
			//echo $ActivitySearch.' '.$ActivityValue;
			
			//echo "<hr>";
			//die('---change the detail----');

		 	$studentData = DB::table('students')->where('custom_class_id', 2)->get();

			
		 	foreach($studentData as $skey => $sval)
		 	{

		 		$sId = (float)$sval->student_uid.'.0';
				
		 		$excelData = DB::table('backup_workingfile_nursery')->where('unknownColumn2',$sId)->first();
		 		if(empty($excelData))
		 		  continue;


				 $levelVal   =  $excelData->$PropertyName;
				 $absentDate =  $excelData->unknownColumn10;
				 echo "<pre>";
				 $arrayDate = explode(" ",$absentDate);
				
				 echo "-----------";
				
				 $arrayDate = explode("+",implode(",",$arrayDate));
				 print_r($arrayDate);
				//echo 'studentid---'.$sId.'----';
				//echo "<pre>";
				//print_r($absentDate);
				echo "================================";
				
				
		 		$getactivity = DB::table('activity')->where('title', 'LIKE', "%{$ActivitySearch}%") ->get();

		 		//echo "<pre>";
		 		//print_r($getactivity[0]->id);
		 		//echo "<hr>";
		 		//echo $sval->class_id;

				

			if(!empty($getactivity))
			{
				 $ActivityTechnique = DB::table('activity_technique')->where('act_id',$getactivity[0]->id)->where('class_id',$sval->class_id)->first();

		 		 //echo "<pre>";
		 		 //print_r($ActivityTechnique);
		 		 //echo "<hr>";
		 		 //echo $sval->class_id;
		 		 //die('-------');

			}else
			{
				 continue;
			}


		 		$userId  = \Auth::id();
				$date    = "2024-03-10";

		 		if(!empty($sval))
		 		{


						//echo  'class_id--'.$sval->class_id.'---custom-cls-id'.$sval->custom_class_id.'--period-4'.'---date--'.$date.'---skilarea-'.$ActivityTechnique->skillarea_id.'---sports--'.$ActivityTechnique->sportskill_id.'--technique--'.$ActivityTechnique->technique_id.'----activity--'.$ActivityTechnique->act_id.'----student_id--'.$sval->id.'----activity-value'.$ActivityValue;
						//echo "<hr>";
	 
						// $reports = new Report;
						// $reports->school_id       =  2823;
						// $reports->class_id        =  $sval->class_id;
						// $reports->custom_class_id =  $sval->custom_class_id;
						// $reports->period          =  4;
						// $reports->date            =  $date;
						// $reports->skill_area_id   =  $ActivityTechnique->skillarea_id;
						// $reports->skill_sports_id =  $ActivityTechnique->sportskill_id;
						// $reports->technique_id    =  $ActivityTechnique->technique_id;
						// $reports->activity_id     =  $ActivityTechnique->act_id;
						// $reports->student_id      =  $sval->id;
						// $reports->level           =  $levelVal;
						// $reports->submitted_by    =  $userId;
						// $reports->status          =  1;
						// $reports->save(); 

				}



		 	}


		// }catch(\Exception $e)
		// {
		// 	echo $e->getMessage();
		// 	die('----');
		// }


		    
		//echo "-----double engine-----";
		//echo "<hr>";

			//$studentData = DB::table('students')->where('student_uid', $val->unknownColumn2)->first();


		}
		
		//die('----');

	}


	private function BackUpReadExcelDemo(request $request)
	{
    
		$excelData = DB::table('backup_workingfile_nursery')->get();
		
		foreach($excelData as $key => $val)
		{

			if($key == 0)
			continue;

			
			if($key <=8)
			{
				$PropertyName   = "April".$key;
			    $ActivitySearch = $excelData[0]->$PropertyName;
				$ActivityValue  = $val->$PropertyName;
			}
			elseif($key >8 && $key<=12)
			{
				$PropertyName   = "May".$key;
				$ActivitySearch = $excelData[0]->$PropertyName;
				$ActivityValue  = $val->$PropertyName;

			}else
			{
                die('----hello india---'); 
			}
		    
		

			$studentData = DB::table('students')->where('student_uid', $val->unknownColumn2)->first();
			
			$getactivity = DB::table('activity')->where('title', 'LIKE', "%{$ActivitySearch}%") ->get();

			 if(!empty($getactivity))
			 {
			  $ActivityTechnique = DB::table('activity_technique')->where('act_id',$getactivity[0]->id)->where('class_id',$studentData->class_id)->first();
			 }else
			 {
			 	continue;
			 }

		

			$userId  = \Auth::id();
            $date    = "2024-02-25";

			if(!empty($studentData))
			{
				$reports = new Report;
				$reports->school_id       =  2823;
				$reports->class_id        =  $studentData->class_id;
				$reports->custom_class_id =  $studentData->custom_class_id;
				$reports->period          =  4;
				$reports->date            =  $date;
				$reports->skill_area_id   =  $ActivityTechnique->skillarea_id;
				$reports->skill_sports_id =  $ActivityTechnique->sportskill_id;
				$reports->technique_id    =  $ActivityTechnique->technique_id;
				$reports->activity_id     =  $ActivityTechnique->act_id;
				$reports->student_id      =  $studentData->id;
				$reports->level           =  $ActivityValue;
				$reports->submitted_by    =  $userId;
				$reports->status          =  1;
				$reports->save(); 

			 }


		}
		
		//die('----');

	}


}
