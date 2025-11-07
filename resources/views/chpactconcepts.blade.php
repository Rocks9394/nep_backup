@extends('layouts.app')
@section('title','Goforfit')
@section('content')

   <?php if(!empty($chapter[0])){ ?>
    <div class="">         
        <nav aria-label="breadcrumb">
		<div class="container">
            <ol class="breadcrumb">
			<li class="breadcrumb-item"><a href=""><?=$chapter[0]->clsname;?></a></li>
               <li class="breadcrumb-item"><a href="{{route('academic')}}"><?=$chapter[0]->subname;?></a></li>               
               <li class="breadcrumb-item "><a href="">{{$chapter[0]->name}}</a></li>
              <li class="breadcrumb-item active"><a href="">{{  $activity[0]->title }}</a></li>
			</ol>
   </div>
        </nav>
		
        <div class="container">
            <div class="concepts-area">
                <div class="row">				
                    <aside class="col-12 col-md-4 d-none d-sm-none d-md-none d-lg-block">
                        <div class="chapter-menu">
                            <nav id="sidebar" class="mCustomScrollbar _mCS_1 mCS-autoHide" style="overflow: visible;"><div id="mCSB_1" class="mCustomScrollBox mCS-minimal mCSB_vertical mCSB_outside" style="max-height: 500px;" tabindex="0"><div id="mCSB_1_container" class="mCSB_container" style="position:relative; top:0; left:0;" dir="ltr">
                                <div class="sidebar-header">
									<div class="chaptr-nm">Chapter {{$chapter[0]->order}}</div>
                                    <h1>{{$chapter[0]->name}}</h1>
                                </div>								
                                <ul class="list-unstyled components">								
								 <?php
                                  $i=0;								 
								   if($concept){
									foreach($concept as $conc){
									 $act_con = DB::table('activity_concept')->where('con_id', $conc->id)->get();	
									//$activity = DB::table('activity')->where('id', $ac->act_id)->get();									  								
									   //echo "<br>";print_r($conc->name);
								 ?> 
                                    <li>
									 <a href="#homeSubmenu<?=$conc->id?>" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><span class="chptr-nm">Concept <?=$i+1?></span><p><?=$conc->name?></p></a>
                                       
                                         <ul class="collapse show list-unstyled" id="aboutSubmenu<?=$conc->id?>" style="">
                                          <?php 
										   if(!empty($act_con)){
											 foreach($act_con as $ac){
											  $activitydata = DB::table('activity')->where('id', $ac->act_id)->get();
											   if(!empty($activitydata)){
												 foreach($activitydata as $kac){
										  ?>  
											<li class="active">
											
                                                <a href="">{{ $kac->title }}</a>
                                            </li>
                                           <?php 							     
								               } 
								             }
								           ?> 
										   <?php 							     
								               } 
								             }
								           ?> 
                                        </ul>
                                    </li>
								   <?php 
								      $i++;
								     } 
								   }
								   ?>
                                </ul>
                            </div></div><div id="mCSB_1_scrollbar_vertical" class="mCSB_scrollTools mCSB_1_scrollbar mCS-minimal mCSB_scrollTools_vertical" style="display: block;"><div class="mCSB_draggerContainer"><div id="mCSB_1_dragger_vertical" class="mCSB_dragger" style="position: absolute; min-height: 50px; height: 162px; top: 0px; display: block; max-height: 188.938px;"><div class="mCSB_dragger_bar" style="line-height: 50px;"></div></div><div class="mCSB_draggerRail"></div></div></div></nav>
                        </div>
                    </aside>					
					
					<div class="col-12 col-md-8">					
                        
                                <div class="mt-3 activity-rw heading-rw"> 
								 <?php if(!empty($activity[0]->title)){ ?>
                                    <h2>{{ $activity[0]->title }}</h2>
                                 <?php } ?>	
									
								</div>
								<div class="row">
								 @if(!empty($actconcepts))
										
										@foreach($actconcepts as $cls)
											
										&nbsp;&nbsp;<span>{{ $cls->clsname }}&nbsp;|</span>
										&nbsp;<span>{{  $cls->subjectname  }}&nbsp;|</span>
										&nbsp;<span>{{  $cls->chaptername }}&nbsp;|</span>
										&nbsp;<span>{{  $cls->conceptname  }}&nbsp;</span>
										@endforeach
								@endif
								<div>
								<div class="row">
							@if(!empty($acttechniques))
									
										@foreach($acttechniques as $cls)
									
								
								&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;<span>{{ $cls->skillareaname }}&nbsp;| </span>
								
								&nbsp;<span>{{ $cls->sportsname }}&nbsp;|</span>
								&nbsp;<span>{{ $cls->techniquename }}&nbsp;</span>
								
										@endforeach
							@endif
								</div>			
							
							
							<div class="activity-dv">							
							
                              <h3>Learning Outcomes</h3>
                              <p> 
								<?php if(!empty($activity[0]->learning_outcomes)){ ?>						  
						        <?php echo $activity[0]->learning_outcomes;?> 
						        <?php } ?>
							  @if($activity[0]->image)
							
								<figure class="f-act-img"><img src="{{ asset('public/uploads').'/'.$activity[0]->image }}" class="img-fluid rounded thumbnail" /> </figure>
							
							  @endif
								
							  </p>
							 
							  
							<h3>Description</h3>
							<p>
							
							 
							  <?php if(!empty($activity[0]->description)){ ?>						  
							  <?php echo $activity[0]->description;?> 
							  <?php } ?>
							</p>
                            
							
							  
							  
							   <h3>Variations</h3>
                              <p> 
								<?php if(!empty($activity[0]->change_it)){ ?>						  
						        <?php echo $activity[0]->change_it;?> 
						        <?php } ?>
							  </p>
							  
							   <h3>Coaching (Teaching Tips)</h3>
                             
															  
								<?php if(!empty($activity[0]->learning_outcomes)){ ?>
								<span class="hint"><img src="{{asset('resources/images/hint-i.png')}}" alt=""> 
						        <?php echo $activity[0]->coaching;?> 
								</span>
						        <?php } ?>
								 
								 
							   <h3>Equipment</h3>
                              <p> 
								<?php if(!empty($activity[0]->equipment)){ ?>						  
						        <?php echo $activity[0]->equipment;?> 
						        <?php } ?>
							  </p>
							 
							 
							 
							  
                            </div>
							
							
                            </div>
							
                        
                    </div>                    
                </div>
            </div>
        </div>
    </div> 
  <?php } ?>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
 <script>
	$(".btn-primary").click(function() {

		if ($(this).data("closedAll")) {
			$(".collapse").collapse("show");
		} else {
			$(".collapse").collapse("hide");
		}

		// save last state
		$(this).data("closedAll", !$(this).data("closedAll"));
	});

	// init with all closed
	$(".btn-primary").data("closedAll", true);
</script>
@endsection