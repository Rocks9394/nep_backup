<?php

namespace App\Http\Controllers;
ini_set('memory_limit','1024M');

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
use App\Models\ViewDart;
use App\Models\User;
use App\Models\Usermeta;
use App\Models\Region;
use App\Models\SchoolTrainer;
use Artisan;
use DataTables;
use Carbon\Carbon;
use Auth;
use Session;

class ViewTrainerController extends Controller
{
	
	public function __construct()
    {
        $this->middleware('auth');
    }
	
	/**
     * 06-08-2024
     * Show activities records of all the trainer in Veiw-Dart Module.
     * */
	 
	public function index(Request $request)	
	{
		
		$title   	= 'View Dart';
		$trainer_id = Auth::user()->id;
		
		if(!empty(Session::get('SelectSchoolId')))
		{	
			$school_id = SchoolTrainer::where('trainer_id',$trainer_id)->where('school_id',Session::get('SelectSchoolId'))->value('school_id');
		}else{
			
			$school_id = SchoolTrainer::where('trainer_id',$trainer_id)->value('school_id');	
		}
		
		
	
		if(empty($school_id) || $school_id == '')
		{
		 die('--You should select the school or try to login again--');
		}
		
		$school = School::find($school_id);

		$trainerList = $school->getTrainers->where('status',1);
		foreach ($trainerList as $trainer) {
		    $trainer->name = User::where('id', $trainer->trainer_id)->orderBy('name')->first()->name;
		}

		$classList = $school->getClasses;
		foreach ($classList as $class) 	{			
		   // $class->name = Sclass::where('id', $class->class_id)->orderBy('name')->first()->name;

		   $originalClass =  Sclass::where('id', $class->class_id)->orderBy('orders')->first();
		   $class->name = !empty($class->nomenclature) ? $class->nomenclature 	: ($originalClass ? $originalClass->name : null);
		}


		$trainersData = DB::table('schools')
	    ->select(
	      'schools.id as schools_id',
	      'school_trainers.trainer_id',
	      'reports.student_id',
	      'reports.submitted_by',
	      'reports.level',
	      'users.name',
	      'reports.date',
	      'reports.period',
	      'reports.level',
	      'skillareas.name as skillareas',
	      'sports.name as sports',
	      'techniques.name as techniques',
	      // 'class.name as class',
	      'activity.title as title',
	      'activity.id as activity_id', 
	      'custom_classes.section as section',

	      DB::raw("CASE 
            WHEN custom_classes.nomenclature IS NOT NULL AND custom_classes.nomenclature <> '' 
            THEN custom_classes.nomenclature 
            ELSE class.name 
          END AS class")
          
	    )

	    ->join('school_trainers', 'school_trainers.school_id', '=', 'schools.id')
	    ->join('users', 'users.id', '=', 'school_trainers.trainer_id')
	    ->join('reports', 'reports.submitted_by', '=', 'school_trainers.trainer_id')
	    ->join('class', 'class.id', '=', 'reports.class_id')
	    ->join('custom_classes', 'custom_classes.id', '=', 'reports.custom_class_id')
	    ->join('skillareas', 'skillareas.id', '=', 'reports.skill_area_id')
	    ->join('sports', 'sports.id', '=', 'reports.skill_sports_id')
	    ->join('techniques', 'techniques.id', '=', 'reports.technique_id')
	    ->join('activity', 'activity.id', '=', 'reports.activity_id')
	    ->where('reports.status', 1)
		 //->where('reports.submitted_by', $trainer_id)
	    ->where('schools.id', $school_id)
	    ->orderBy('reports.period', 'ASC')
	    ->orderBy('reports.date', 'DESC')
	    ->orderBy('reports.custom_class_id', 'ASC')
	    ->orderBy('custom_classes.orders', 'ASC')
	    ->get()

	    // Group by trainer_id first
	    ->groupBy('submitted_by')
	    ->map(function ($recordsByTrainer) {
	        return $recordsByTrainer->groupBy('date')->map(function ($recordsByDate, $date) {
	            return $recordsByDate->groupBy('skillareas')->map(function ($recordsBySkillarea, $skillarea) use ($date) {
	                return $recordsBySkillarea->groupBy(function ($record) {
	                    return $record->class . '-' . $record->section;
	                })->map(function ($recordsByClassSection, $classSection) use ($date, $skillarea ){
	                    return $recordsByClassSection->groupBy('period')->map(function ($recordsByPeriod, $period) use ($classSection, $date, $skillarea) {
	                        
	                    		$presentCount = $absentCount = 0;	  
	                    		$checkstring = '';
	                    		$data = [];
	                    		$getRecords = [];
	                    		foreach ($recordsByPeriod as $entry) {
	                    				$checkstring = $entry->student_id;
	                    				if(!in_array($checkstring, $data)){
		                            if ($entry->level > 0) {
		                                $presentCount++;
		                            } else {
		                                $absentCount++;
		                            }
		                            $data[] = $checkstring;
		                            $getRecords[] = $entry;

	                    				}
	                        }
	                        
	                        return [
	                            'class_section' => $classSection,
	                            'period' => $period,
	                            'present_count' => $presentCount,
	                            'absent_count' => $absentCount,
	                            'records' => collect($getRecords)
	                        ];
	                    });
	                });
	            });
	        });
	    })

	    ->flatMap(function ($trainerGroups) {
	        return $trainerGroups->flatMap(function ($dateGroups, $date) {
	            return $dateGroups->flatMap(function ($skillareaGroups, $skillarea) {
	                return $skillareaGroups->flatMap(function ($classSectionGroups, $classSection) {	            
	                    return $classSectionGroups->map(function ($periodGroup, $period) use ($classSection) {
	                        return [
	                            'date' => $periodGroup['records']->first()->date,
	                            'trainer_id' => $periodGroup['records']->first()->trainer_id,
	                            'name' => $periodGroup['records']->first()->name,
	                            'class_section' => $classSection,
	                            'period' => $period,
	                            'present_count' => $periodGroup['present_count'],
	                            'absent_count' => $periodGroup['absent_count'],
	                            'class' => $periodGroup['records']->first()->class,
	                            'section' => $periodGroup['records']->first()->section,
	                            'skillareas' => $periodGroup['records']->first()->skillareas,
	                            'sports' => $periodGroup['records']->first()->sports,
	                            'techniques' => $periodGroup['records']->first()->techniques,
	                            'title' => $periodGroup['records']->first()->title,
	                            'activity_id' => $periodGroup['records']->first()->activity_id,
	                        ];
	                    });
	                });
	            });
	        });
	    });


		if($request->ajax()){
			return Datatables::of($trainersData)
     		->addIndexColumn()
				->addColumn('title', function($row){
					$html = '<a href="javascript:void(0)" onclick="modelContent('.$row['activity_id'].', \''.$row['skillareas'].'\', \''.$row['sports'].'\', \''.$row['techniques'].'\', \''.$row['class_section'].'\')">'.$row['title'].'</a>';
     			return $html;
     		})

     		->addColumn('classandsec', function($row){
     			return $row['class_section'];
     		})

     		->addColumn('date', function($row){
					$newDate = date("d-m-Y", strtotime($row['date']));
          	return $newDate;
          })
      	->rawColumns(['title','classandsec','date'])
			->toJson();
		}

 		return view('viewtrainer.index', compact('title','trainerList','classList','trainersData'));
 		

 		
 		/*
		$ViewDartData = DB::table('view_dart')
		    ->select('users.name','view_dart.*'	)
		    ->join('users', 'users.id', '=', 'view_dart.trainer_id')
		    ->where('view_dart.school_id', '=' , $school_id)
		    ->get();

		if($request->ajax()){
			return Datatables::of($ViewDartData)
     		->addIndexColumn()

     		->addColumn('classandsec', function($row){
     			$classSection = \App\Helpers\Helper::getClassAndSection($row->custm_cls_id);
     			return $classSection ?? '---';
     		})

     		->addColumn('skillareas', function($row){
					$skillareas = \App\Helpers\Helper::getSkillArea($row->skill_area_id);
     			return $skillareas ?? '---';
     		})

     		->addColumn('sports', function($row){
					$sports = \App\Helpers\Helper::getSports($row->skillsports_id);
     			return $sports ?? '---';
     		})

     		->addColumn('techniques', function($row){
					$techniques = \App\Helpers\Helper::getTechnique($row->technique_id);
     			return $techniques ?? '---';
     		})

			->addColumn('title', function($row){

				if(empty($row->activity_id)){
					return \App\Helpers\Helper::getOtherDuties($row->other_duties_id);
				}

				$activitytitle = \App\Helpers\Helper::getActivity($row->activity_id);
				$classSection = \App\Helpers\Helper::getClassAndSection($row->custm_cls_id);
				$skillareas = \App\Helpers\Helper::getSkillArea($row->skill_area_id);
				$sports = \App\Helpers\Helper::getSports($row->skillsports_id);
				$techniques = \App\Helpers\Helper::getTechnique($row->technique_id);

				$activity = '<a href="javascript:void(0)" onclick="modelContent('.$row->activity_id.', \''.$skillareas.'\', \''.$sports.'\', \''.$techniques.'\', \''.$classSection.'\')">'.$activitytitle.'</a>';

     			return $activity ?? 'N.A.';
     		})

     		->addColumn('present_count', function($row){	 
     			return $row->present ?? '---' ;
     		})

     		->addColumn('absent_count', function($row){	
     			return $row->absent ?? '---' ;
     		})

      		->rawColumns(['classandsec','skillareas','sports','techniques','title','present_count','absent_count'])->toJson();
		}

		*/

		return view('viewtrainer.index', compact('title','trainerList','classList'));
    }
	
	
	public function modifyTrainerRecord()
	{
		$classList = '';
		$trainer_id = Auth::user()->id;
		$school_id = Session::get('SelectSchoolId');
		$title   = 'Modify Dart';
		$school = School::find($school_id);
		
		$classList = $school->getClasses;
		foreach ($classList as $class) 	{			
		   $class->name = Sclass::where('id', $class->class_id)->orderBy('name')->first()->name;
		}

		return view('viewtrainer.modify-trainer-record', compact('title','classList'));
		
	}
	
	public function modifyTrainerRecordSubmit(Request $request)
	{
	
		if ($request->input('options_bytype') === 'edit') {

		 $validator  = Validator::make($request->all(), [
		   'date_edit' => 'required|date',
		   'date_edit_to' => 'required|date',
		   'from_period' => 'required',
		   'to_period' => 'required',
		   'class_edit' => 'required',
			
		]);
		} elseif ($request->input('options_bytype') === 'delete') {

		 $validator  = Validator::make($request->all(), [
		   'date_delete' => 'required|date',
		   'period_delete' => 'required',
		   'class_delete' => 'required',
			
		]);
		}


		if($validator->fails()) 
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}
	
		$trainer_id = Auth::user()->id;
		#$school_id = SchoolTrainer::where('trainer_id',$trainer_id)->value('school_id');
		$school_id = Session::get('SelectSchoolId');
		$title   = 'Modify Dart';
		$school = School::find($school_id);
		
		
		if ($request->input('options_bytype') === 'edit') 
		{
			
			$class1 = $request->input('class_edit');
			$class_parts1 = explode("-", $class1);
			$class_id1 = $class_parts1[0] ?? '';
			$custom_class_id1 = $class_parts1[1] ?? '';
			
			
			$data1 = Report::select('*')->where('school_id',$school_id)->where('custom_class_id',$custom_class_id1)->where('date',$request->date_edit)->where('period',$request->from_period)->where('submitted_by',$trainer_id)->get();
			
			if(count($data1) >0)
			{
				
				Report::where('school_id', $school_id)
				->where('custom_class_id', $custom_class_id1)
				->where('date', $request->date_edit)
				->where('period', $request->from_period)
				->where('submitted_by', $trainer_id)
				->update([
				'period' => $request->to_period,
				'date' => $request->date_edit_to,
				]);


				ViewDart::where('school_id', $school_id)
				->where('custm_cls_id', $custom_class_id1)
				->where('date', $request->date_edit)
				->where('period', $request->from_period)
				->where('trainer_id', $trainer_id)
				->update([
				'period' => $request->to_period,
				'date' => $request->date_edit_to,
				]);
				
			    return redirect()->route('modify.trainer.record',['edit' => 'success'])->with('success', 'Data midify successfully!');
				
			}
			else{
				return redirect()->route('modify.trainer.record',['edit' => 'error'])->with('error', 'data not match in our records!');
			}
			
		
		}elseif ($request->input('options_bytype') === 'delete') 
		{
			
			$class = $request->input('class_delete');
			$class_parts = explode("-", $class);
			$class_id = $class_parts[0] ?? '';
			$custom_class_id = $class_parts[1] ?? '';
			
			
			$data = Report::select('*')->where('school_id',$school_id)->where('custom_class_id',$custom_class_id)->where('date',$request->date_delete)->where('period',$request->period_delete)->where('submitted_by',$trainer_id)->get();
			
			if(count($data) >0)
			{
				Report::where('school_id',$school_id)->where('custom_class_id',$custom_class_id)->where('date',$request->date_delete)->where('period',$request->period_delete)->where('submitted_by',$trainer_id)->delete();

				ViewDart::where('school_id',$school_id)->where('custm_cls_id',$custom_class_id)->where('date',$request->date_delete)->where('period',$request->period_delete)->where('trainer_id',$trainer_id)->delete();	
				
				  return redirect()->route('modify.trainer.record',['edit' => 'success-delete'])->with('success', 'Data midify successfully!');
			}else{
				return redirect()->route('modify.trainer.record',['edit' => 'error'])->with('error', 'data not match in our records!');
			}
			
			
		}
	
		
	}


   
    /**
     * 06-08-2024
     * Filter the Activities Records based on class, Trainner and selected date.
     * */

    
    public function getTrainerReport(Request $request){
		
		$trainer_id = Auth::user()->id;
		//$SchoolUserId
		$role_id =  \Auth::user()->role_id;
		
		
		if($role_id == 4)
		{        
				  #die('----first one--');
				  #here need to enter principle id but i changed the value name 
	              #schooluserid instead of trainer id.
				$school_id = DB::table('school_reference')->where('school_user_id',$trainer_id)->where('status', 1)->value('school_id');
			
		}else
		{
			if(!empty(Session::get('SelectSchoolId')))
			{	
			
				$school_id = SchoolTrainer::where('trainer_id',$trainer_id)->where('school_id',Session::get('SelectSchoolId'))->value('school_id');
				
			}else{
					
				$school_id = SchoolTrainer::where('trainer_id',$trainer_id)->value('school_id');	
			}
			
		}
		
		
		

    	#$SchoolUserId  =  \Auth::id();
    	#$school_id = DB::table('school_reference')->where('school_user_id',$SchoolUserId)->where('status', 1)->value('school_id');

    	if($request->ajax()){

    		$formData = $request->all();
			$trainer_id = $formData['trainer_id'] ?? '';
			$class = $formData['custom_class_id'] ?? '';
			$class_parts = explode("-", $class);
			$class_id = $class_parts[0] ?? '';
			$custom_class_id = $class_parts[1] ?? '';
			$from_date = $formData['from_date'];
			$to_date = $formData['to_date'];    	
			$condition = [];

			//echo "from_date :" .$from_date;
			//echo "to_date :" .$to_date;
			//exit(); from_date :2025-01-16 to_date :2025-01-23

			if (!empty($trainer_id)) {
			    $condition[] = ['view_dart.trainer_id', '=', $trainer_id];  
			}

			if (!empty($class_id) && !empty($custom_class_id)) {
			    $condition[] = ['view_dart.custm_cls_id', '=', $custom_class_id];  
			}

			if (!empty($school_id)) {
			    $condition[] = ['view_dart.school_id', '=', $school_id];  
			}

			$query = DB::table('view_dart')
		    ->select('users.name','view_dart.*'	)
		    ->join('users', 'users.id', '=', 'view_dart.trainer_id')->orderBy('view_dart.date', 'desc');

			if (!empty($from_date) && !empty($to_date)) {
			    $query->whereBetween('view_dart.date', [$from_date, $to_date]);
			}

			if (!empty($condition)) {
			    $query->where($condition);
			}

			if ($request->has('search') && $request->search['value']) {
	            $searchValue = $request->search['value'];
	            $query->where(function ($query) use ($searchValue) {
	                $query->where('users.name', 'like', '%' . $searchValue . '%');
	            });
	        }

	        if ($request->has('order')) {
	            $columnIndex = $request->input('order.0.column');
	            $columnName = $request->input('columns.' . $columnIndex . '.data');
	            $orderDirection = $request->input('order.0.dir');
	            $query->orderBy($columnName, $orderDirection);
	        }

	        $start = $request->input('start', 0);
	        $length = $request->input('length', 100);
	        if ($length != -1) {
	            $query->skip($start)->take($length);
	        }

			$trainersData = $query->get();
        	$totalRecords = DB::table('view_dart')->where('view_dart.trainer_id', '=', $trainer_id)->count();

			$data = $trainersData->map(function($row) {
	            return [
	            	'name' => $row->name,
	            	'date' => date("d-m-Y", strtotime($row->date)),
	            	'period' => $row->period,
	                'classandsec' => \App\Helpers\Helper::getClassAndSection($row->custm_cls_id) ?? '---',
	                'skillareas' => \App\Helpers\Helper::getSkillArea($row->skill_area_id) ?? '---',
	                'sports' => \App\Helpers\Helper::getSports($row->skillsports_id) ?? '---',
	                'techniques' => \App\Helpers\Helper::getTechnique($row->technique_id) ?? '---',
	                'title' => $this->getActivityTitle($row),
	                'present_count' => $row->present ?? '---',
	                'absent_count' => $row->absent ?? '---',
	                'data' => $row 
	            ];
	        });

	        if ($request->ajax()) {
	            return response()->json([
	                'draw' => intval($request->draw),
	                'recordsTotal' => $totalRecords,
	                'recordsFiltered' => $totalRecords,
	                'data' => $data
	            ]);
	        }
    	}
    }
    

    private function getActivityTitle($row) {
	    if (empty($row->activity_id)) {
	        return \App\Helpers\Helper::getOtherDuties($row->other_duties_id);
	    }

	    $activitytitle = \App\Helpers\Helper::getActivity($row->activity_id);
	    $classSection = \App\Helpers\Helper::getClassAndSection($row->custm_cls_id);
	    $skillareas = \App\Helpers\Helper::getSkillArea($row->skill_area_id);
	    $sports = \App\Helpers\Helper::getSports($row->skillsports_id);
	    $techniques = \App\Helpers\Helper::getTechnique($row->technique_id);

	    return '<a href="javascript:void(0)" onclick="modelContent(' . $row->activity_id . ', \'' . $skillareas . '\', \'' . $sports . '\', \'' . $techniques . '\', \'' . $classSection . '\')">' . $activitytitle . '</a>';
	}


    
    public function getTrainerReport_bk(Request $request){

    	if($request->ajax()){

    		$formData = $request->all();
    		$trainer_id = $formData['trainer_id'] ?? '';
    		$class = $formData['custom_class_id'] ?? '';
			$class_parts = explode("-", $class);
			$class_id = $class_parts[0] ?? '';
			$custom_class_id = $class_parts[1] ?? '';
			$from_date = $formData['from_date'];
			$to_date = $formData['to_date'];    	
			$condition = [];

			if (!empty($trainer_id)) {
			    $condition[] = ['school_trainers.trainer_id', '=', $trainer_id];  
			}

			if (!empty($class_id) && !empty($custom_class_id)) {
			    $condition[] = ['reports.class_id', '=', $class_id];
			    $condition[] = ['reports.custom_class_id', '=', $custom_class_id];  
			} 

    		$trainersData = DB::table('schools')
			    ->select(
		      'schools.id as schools_id',
		      'school_trainers.trainer_id',
		      'reports.student_id',
		      'reports.submitted_by',
		      'reports.level',
		      'users.name',
		      'reports.date',
		      'reports.period',
		      'reports.level',
		      'skillareas.name as skillareas',
		      'sports.name as sports',
		      'techniques.name as techniques',
		      'class.name as class',
		      'activity.title as title',
		      'custom_classes.section as section'
		    )

		    ->join('school_trainers', 'school_trainers.school_id', '=', 'schools.id')
		    ->join('users', 'users.id', '=', 'school_trainers.trainer_id')
		    ->join('reports', 'reports.submitted_by', '=', 'school_trainers.trainer_id')
		    ->join('class', 'class.id', '=', 'reports.class_id')
		    ->join('custom_classes', 'custom_classes.id', '=', 'reports.custom_class_id')
		    ->join('skillareas', 'skillareas.id', '=', 'reports.skill_area_id')
		    ->join('sports', 'sports.id', '=', 'reports.skill_sports_id')
		    ->join('techniques', 'techniques.id', '=', 'reports.technique_id')
		    ->join('activity', 'activity.id', '=', 'reports.activity_id')
		    ->where('reports.status', 1);


		    // Conditionally add whereBetween
				if (!empty($from_date) && !empty($to_date)) {
				    $trainersData->whereBetween('reports.date', [$from_date, $to_date]);
				}

				// Conditionally add other where conditions
				if (!empty($condition)) {
				    $trainersData->where($condition);
				}


				$trainersData = $trainersData
				->orderBy('reports.period', 'ASC')
		    ->orderBy('reports.date', 'DESC')
		    ->orderBy('reports.custom_class_id', 'ASC')
		    ->orderBy('custom_classes.orders', 'ASC')
		    ->get()

		    ->groupBy('submitted_by')
	        ->map(function ($recordsByTrainer) {
	        return $recordsByTrainer->groupBy('date')->map(function ($recordsByDate, $date) {
	            return $recordsByDate->groupBy('skillareas')->map(function ($recordsBySkillarea, $skillarea) use ($date) {
	                return $recordsBySkillarea->groupBy(function ($record) {
	                    return $record->class . '-' . $record->section;
	                })->map(function ($recordsByClassSection, $classSection) use ($date, $skillarea ){
	                    return $recordsByClassSection->groupBy('period')->map(function ($recordsByPeriod, $period) use ($classSection, $date, $skillarea) {
	                        
	                    		$presentCount = $absentCount = 0;	  
	                    		$checkstring = '';
	                    		$data = [];
	                    		$getRecords = [];

	                    		foreach ($recordsByPeriod as $entry) {
                    				$checkstring = $entry->student_id;
                    				if(!in_array($checkstring, $data)){
	                            if ($entry->level > 0) {
	                                $presentCount++;
	                            } else {
	                                $absentCount++;
	                            }
	                            $data[] = $checkstring;
	                            $getRecords[] = $entry;
                    				}
	                        }
	                       
	                        return [
	                            'class_section' => $classSection,
	                            'period' => $period,
	                            'present_count' => $presentCount,
	                            'absent_count' => $absentCount,
	                            'records' => collect($getRecords)
	                        ];

	                    })->sortBy('period');
	                });
	            });
	        });
	    })

	    ->flatMap(function ($trainerGroups) {
	        return $trainerGroups->flatMap(function ($dateGroups, $date) {
	            return $dateGroups->flatMap(function ($skillareaGroups, $skillarea) {
	                return $skillareaGroups->flatMap(function ($classSectionGroups, $classSection) {	            
	                    return $classSectionGroups->map(function ($periodGroup, $period) use ($classSection) {
	                        return [
	                            'date' => date("d-m-Y", strtotime($periodGroup['records']->first()->date)) ,
	                            'trainer_id' => $periodGroup['records']->first()->trainer_id,
	                            'name' => $periodGroup['records']->first()->name,
	                            'class_section' => $classSection,
	                            'period' => $period,
	                            'present_count' => $periodGroup['present_count'],
	                            'absent_count' => $periodGroup['absent_count'],
	                            'class' => $periodGroup['records']->first()->class,
	                            'section' => $periodGroup['records']->first()->section,
	                            'skillareas' => $periodGroup['records']->first()->skillareas,
	                            'sports' => $periodGroup['records']->first()->sports,
	                            'techniques' => $periodGroup['records']->first()->techniques,
	                            'title' => $periodGroup['records']->first()->title,
	                        ];
	                    });
	                });
	            });
	        });
	    })->collect()->sortByDesc('date');

			if($request->ajax()){

				return Datatables::of($trainersData)
	       		->addIndexColumn()

	       		->addColumn('classandsec', function($row){
	       			$clsandsec = $row['class_section'];
	       			return $clsandsec;
	       		})

	       		->addColumn('date', function($row){
							$newDate = date("d-m-Y", strtotime($row['date']));
	            	return $newDate;
	            })
	        	->rawColumns(['classandsec','date'])
				->toJson();
			}
    	}
    }
    


    public function showlist(Request $request) {


	   	// $trainer_id = Auth::user()->id;
	
		$trainer_id = 902;
		$schoolData = School::with([
			'SchoolTrainer' => function($query) use ($trainer_id) {
				$query->where('trainer_id', $trainer_id)->select('trainer_id','school_id')
				->with(['trainer' => fn ($trainer) => $trainer->select('id','name')]);
			},
			'getClasses' => function($class) {
				$class->select('id','school_id','class_id','section')->with(['class' => fn ($classname) => $classname->select('id','name') ]);
			}, 


		])->where('id',2823)->get(['id','school_name','board','school_code','school_email','principal_phone','address','pincode','state']);




		echo "<pre>"; 	print_r($schoolData);exit();
	

		$schoolData = School::with([			
			'getTrainers' => function($query){
				$query->select('id','school_id','trainer_id')
				->with(['trainer' => function($trainer){
					$trainer->select('id','name');
				}]);
			},
			'getClasses' => function ($query) {
				$query->select('id','class_id','section','school_id')
				->with(['class' => function($classname){
					$classname->select('id','name');
				}]);
			},
			'getStudents' => fn ($query) =>  $query->select('id','school_id','student_name'),
		])->where('id',2823)->get(['id','school_name','school_code','school_email','principal_phone','state']);	


		


       
		// $ReportsData1=Report::with(['trainer','level','customClass','class','skillArea','sport','technique','activity'])->get();

		/*
		$ReportsData1=Report::with(['trainer'])->get(['id','school_id','class_id','custom_class_id','activity']); 



        $transformedData = $ReportsData1->map(function ($report) {

        	$present = Report::where('submitted_by', $report->submitted_by)->where('period', $report->period)
        		->where('custom_class_id', $report->custom_class_id)
        		->where('activity_id', $report->activity_id)	
        		->where('level', '<>', 0)
        		->count();

        	$absent = Report::where('submitted_by', $report->submitted_by)->where('period', $report->period)
        	->where('custom_class_id', $report->custom_class_id)
        	->where('activity_id', $report->activity_id)
        	->where('level', '=', 0)->count();

		    return [
		    	'date'  => $report->date,	
		    	'custom_class_id'  => $report->custom_class_id,		    	
		        'trainer_name' => $report->trainer->name,
		        'period'  => $report->period,
		        'class_name' => $report->customClass->class->name,
		        'class_section' => $report->customClass->section,
		        'skillArea' => $report->skillArea->name,
		        'sport' => $report->sport->name,
		        'technique' => $report->technique->name,
		        'activity' => $report->activity->title,
		        // 'student' => $report->student->student_name,
		        'level' => $report->level,	
		        'present' => $present,
		        'absent' => $absent,
		    ];
		});

        $ReportsData  = $transformedData->groupBy('trainer_name');
		*/ 

       
        $title = 'View Trainers';
		return view('viewtrainer.showlist', compact('title','schoolData')); 
    }


	public function trainerProfile(Request $request , $id){

		$schools = School::select('id','school_name')->orderBy('school_name')->get();
		$regions = Region::all();
		$districts = DB::table('districts')->get();
		$states = DB::table('states')->get();
		$result = DB::table('users')
					->leftJoin('usermetas','usermetas.user_id','=','users.id')
					->select('users.id','users.name','users.email','users.phone','users.self_registrationId','users.gender','usermetas.qualification',
					'usermetas.experience','usermetas.region_id','usermetas.state_id', 'usermetas.pincode' ,'usermetas.school_id','usermetas.subject','usermetas.dob','usermetas.address','usermetas.district','usermetas.city')
					->where('users.id',$id)
					->first();
		return view('viewtrainer.edit-profile',compact('result','regions','schools','states','districts'));
	}
	public function trainerUpdate(Request $request,$id)
	{
			//dd($request->all());
			$user_id = Auth::id();
			$request->validate([
				'name' => 'required|string|max:255',
				'gender' => 'required',
				'dob' => 'required|date',
				'email' => 'required|email',
				'phone' => 'required',
				'qualification' => 'required',
				'region' => 'required',
				'state' => 'required',
				'district' => 'required',
				'city' => 'required',
				'pincode' => 'required|digits:6',
			]);

			list($stateId, $stateName) = explode('|', $request->state);
		
			$users         = User::find($id);
			$users->name   = $request->name;
			$users->phone  = $request->phone;
			$users->email  = $request->email;
			$users->gender = $request->gender;
			$users->save();
			
			$usermetas = Usermeta::where('user_id',$id)->first();

			if(!empty($usermetas))
				{
					$usermetas->gender 		  = $request->gender;
					$usermetas->qualification = $request->qualification;
					$usermetas->experience    = $request->experience;
					$usermetas->address    = $request->address;
					$usermetas->region_id     = $request->region;
					$usermetas->state         = $stateName;
					$usermetas->state_id      = $stateId;
					$usermetas->state_id      = $stateId;
					$usermetas->district      = $request->district;
					$usermetas->city      	  = $request->city;
					$usermetas->pincode       = $request->pincode;
					$usermetas->dob           = $request->dob;
					$usermetas->save();
				}
			else
				{
					$usermetas = new Usermeta();
					$usermetas->gender 		  = $request->gender;
					$usermetas->qualification = $request->qualification;
					$usermetas->experience 	  = $request->experience;
					$usermetas->address       = $request->address;
					$usermetas->region_id     = $request->region;
					$usermetas->state         = $stateName;
					$usermetas->state_id      = $stateId;
					$usermetas->state_id      = $stateId;
					$usermetas->district      = $request->district;
					$usermetas->city      	  = $request->city;
					$usermetas->pincode       = $request->pincode;
					$usermetas->dob           = $request->dob;
					$usermetas->save();
				}
			
			
			return back()->with('msg','Profile updated successfully');
	}
}
