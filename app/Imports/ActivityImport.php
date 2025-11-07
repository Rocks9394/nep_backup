<?php
namespace App\Imports;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;
use App\Models\Classactivity;
use App\Models\Skillactivity;
use App\Models\Categoryactivity;
use App\Models\Skill;
use App\Models\Category;
use App\Models\Activity;
use App\Models\Uploadactivity;

class ActivityImport implements ToModel, WithHeadingRow{	

	public function model(array $rows){	
		//echo "<pre>";print_r($rows);die; 			
		if(!empty($rows)){			
			$clsid='';							
			$activity = Activity::create([
					'title'            => $rows['title'],
					'description'      => $rows['description'], 
					'image'            =>$rows['image'],					
					'status'           => '1',
				  ]);
				  
			$catarray=explode(',', $rows['category']);
			
             foreach($catarray as $cat){

				if(!empty($cat)){
					
					$count = DB::table('category')
							->where('name', $cat)
							->count();

					if($count > 0){						
					  //exist;					  
					} else {
						
						$cat=Category::create([
							'name' => $cat,									
							'status'=> '1',
						  ]);			
				 
						if(!empty($activity->id)){				  
							$actcategory = new Categoryactivity();
							$actcategory->act_id = $activity->id;
							$actcategory->cat_id = $cat->id;					
							$actcategory->save();  
						}
					}		    
				}			   
			}
          				  
			$skillarray=explode(',', $rows['skill']);//skill
			
             foreach($skillarray as $skl){
				 
			    if(!empty($skl)){
					
					$kcount = DB::table('skill')
							->where('name', $skl)
							->count();

					if($kcount > 0){						
					  //exist;					  
					} else {						
						  $skil = Skill::create([
							'name' => $skl,									
							'status'=> '1',
						  ]); 
                 
						if(!empty($activity->id)){				  
							$skilact = new Skillactivity();
							$skilact->act_id = $activity->id;
							$skilact->skill_id = $skil->id;					
							$skilact->save();  
					   }
				 
			        }
		        }				
		    }
			
			
		  if(!empty($rows['class'])){
			
            $clsarray=explode(',', $rows['class']);			  
			
	        foreach($clsarray as $cls){	
			  
				$classactivity = new Classactivity();				
             
				if(trim($cls)=='Infant'){		
				  
				  $clsid='1';
					
				} else if(trim($cls)=='Toddler'){
				
				  $clsid='2';					
					
                } else if(trim($cls)=='Playschool'){					 
				  
				  $clsid='3';
					
			    } else if(trim($cls)=='Pre Nursury'){
					
				   $clsid='4';
					
				} else if(trim($cls)=='Nursury'){
					
				   $clsid='5';
					
				} else if(trim($cls)=='KG'){				
					
					$clsid='6';
					
				} else if(trim($cls)=='1st'){
				
				    $clsid='7';
					
				} else if(trim($cls)=='2nd'){
				 
				  $clsid='8';
					
				} else if(trim($cls)=='3rd'){
					 
				   $clsid='9';
					
				} else if(trim($cls)=='4th'){						
				
				   $clsid='10';
					
				} else if(trim($cls)=='5th'){	
				
				   $clsid='11';
					
				} else if(trim($cls)=='6th'){	
				
				   $clsid='12';
					
				} else if(trim($cls)=='7th'){	
				
				   $clsid='13';	
					
				} else if(trim($cls)=='8th'){		
				
				   $clsid='14';
					
				} else if(trim($cls)=='9th'){		
				
				  $clsid='15';
					
				} else if(trim($cls)=='10th'){	
				
				  $clsid='16';
					 
				} else if(trim($cls)=='11th'){		
				
				  $clsid='17';
					
				} else if(trim($cls)=='12th'){
					
				  $clsid='18'; 
				}
				
				if(!empty($clsid)&& $clsid!=''){
					 $classactivity = new Classactivity();	
					 $classactivity->act_id = $activity->id;
					 $classactivity->class_id = $clsid;                    
					 $classactivity->save();				 
			    }			
		     }		  
		   }		  
		}
		
		return $activity;
	}
}