@extends('layouts.app')
@section('title', 'Goforfit')
@section('content')

   <div class=""> 
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href=""><?=$chapter[0]->subname;?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?=$chapter[0]->name;?></li>
          </ol>
        </nav>	
			
        <div class="container-fluid">
            <div class="concepts-area">
                <div class="row">
                    <div class="col-12 col-lg-3">
                        <div class="card card-details ml-0 ml-lg-3">
                            <button onclick="goBack()" href="" class="back-btn"><img src="{{ asset('resources/images').'/'.'back-arrow.png'}}" alt="back btn"><span class="back-to-chptr"><svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd"><path d="M2.117 12l7.527 6.235-.644.765-9-7.521 9-7.479.645.764-7.529 6.236h21.884v1h-21.883z"/></svg>Back to Chapters</span></button>
                            <?php if($chapter[0]->image!=''){ ?>
								<figure><img width="307" height="207" src="{{ $chapter[0]->image }}" class="img-fluid rounded act-img" alt="Card image cap"></figure>
							<?php } else{ ?>               
								<figure><img class="card-img-top" src="{{ asset('resources/images').'/'.'default-chapter-img.png' }}" alt="Card image cap"></figure>
						    <?php }  ?>            
							<div class="card-body chapter-dtls">
                                <span class="no-concents">{{$total}} Concepts</span>
                                <p class="chapter-info-txt">Chapter</p>
                                <h1 class="chapter-heading"><?=$chapter[0]->name;?></h1>
                                <p class="card-text"><?=$chapter[0]->description;?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-9">
					
					@if(!empty($chapter))
							 @foreach($chapter as $chapters)
                                <div class="collapse" id="collapse1">
                                    <div class="card-body">
                                        <p>
										
						
										   <h4>Learning Outcomes</h4>
										  
										   
										   <p><?=$chapters->learning_outcomes?>
										   
																				
											</p>
										 
                                      

										
										   <h4>PDF</h4>
										  
										   
										   <p><a href="{{$chapters->file}}" target="_blank">download pdf</a>
										   
																				
											</p>
										 
                                      
										   <h4>PDF Links</h4>
										  
										   
										   <p><a href="{{$chapters->link}}" target="_blank">pdf link</a>
										   
																				
											</p>
										 
                                       </div>
						
										
                            </div>
							@endforeach
						@endif

					
					
					<div class="card-header">
                                    <h3 class="btn btn-link" data-toggle="collapse" data-target="#collapse1" aria-expanded="false" aria-controls="collapse">
                                        Learning Outcomes
                                        <span class="open-i"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" viewBox="0 0 24 24">
                                                <path
                                                    d="M0 16.67l2.829 2.83 9.175-9.339 9.167 9.339 2.829-2.83-11.996-12.17z" />
                                            </svg></span>
                                        <span class="close-i"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" viewBox="0 0 24 24">
                                                <path
                                                    d="M0 7.33l2.829-2.83 9.175 9.339 9.167-9.339 2.829 2.83-11.996 12.17z" />
                                            </svg></span>
                                    </h3>
                                </div>
                        <div class="row">
                            <div class="col">
                                <div class="heading-rw">
                                    <h2>Concepts</h2>
                                    
									<button class="btn btn-primary expand_btn" type="button" data-toggle="collapse" data-target=".multi-collapse" aria-expanded="false" aria-controls="multicollapse1 multicollapse2">
									<span><svg width="24"
										height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd"
										clip-rule="evenodd">
										<path
											d="M14 19h-14v-1h14v1zm9.247-8.609l-3.247 4.049-3.263-4.062-.737.622 4 5 4-5-.753-.609zm-9.247 2.609h-14v-1h14v1zm0-6h-14v-1h14v1z" />
									</svg></span><span class="expand-txt">Expand All</span><span class="collapse-txt">Collapse All</span>
									</button>
                                </div>
                            </div>
                        </div>
						
						

						
						
						
						
                    <div class="expand-dv">	

						
						
						
						





					
						<?php
						   $i=0;
						   if($concept){
							foreach($concept as $conc){								
							  //echo "<pre>";print_r($conc->image);								
                             $i++;							
						?> 
						<div class="card">
							<div class="card-header">
								<h3 class="btn btn-link" data-toggle="collapse" href="#multicollapse<?=$i?>" role="button" aria-expanded="false" aria-controls="multicollapse<?=$i?>">
									<?=$i?>. <?=$conc->name?>
									<span class="open-i"><svg xmlns="http://www.w3.org/2000/svg" width="24"
										height="24" viewBox="0 0 24 24">
										<path
											d="M0 16.67l2.829 2.83 9.175-9.339 9.167 9.339 2.829-2.83-11.996-12.17z" />
									</svg></span>
									<span class="close-i"><svg xmlns="http://www.w3.org/2000/svg" width="24"
										height="24" viewBox="0 0 24 24">
										<path
											d="M0 7.33l2.829-2.83 9.175 9.339 9.167-9.339 2.829 2.83-11.996 12.17z" />
									</svg></span>
								</h3>
							</div>
                                <div class="collapse multi-collapse" id="multicollapse<?=$i?>">
                                    <div class="card-body">
                                      <div class="activities-dv">
										   <h4>Learning Outcomes</h4>
										   
										   <p><?=$conc->learning_outcomes?>
										 
																				
											</p>
										 
                                       </div>									   
									   <?php
									     $chapid=$chapter[0]->id;
										 
										 $ac_con = DB::table('activity_concept')
													->where('con_id', $conc->id)->get();									    
									    										 
										  $totalact = DB::table('activity_concept')
													->where('activity_concept.con_id', $conc->id)->count();
											
											if($totalact>0){$totalact=$totalact;}else{$totalact=0;}
									   ?>	
                                        <div class="activities-dv">
                                          <h5 class="">{{ $totalact }} Activities </h5>
                                            <ul class="activity-list row">
                                             <?php
											   if(!empty($ac_con)){												   
							                     foreach($ac_con as $kac){                      
                                                  
                                                  $activity = DB::table('activity')->where('id', $kac->act_id)->get();
												   if(!empty($activity)){	
                                                    foreach($activity as $act){ 
											  ?>
											    <li class="col-12 col-sm-4">
													<a href="{{ url('chpactconcepts/'.$act->id.'/'.$chapid)}}">
														<span class="card">
														  <?php				   
															$word = "wp-content";
																		
															if(strpos($act->image, $word)!== false){ ?>
															 <img class="card-img-left" src="{{ asset('public/uploads').'/'.$act->image }}" alt="Card image cap">
														  <?php } else if(file_exists($act->image)){ ?>
															 <img class="card-img-left" src="{{ asset('public/uploads').'/'.$act->image }}" alt="Card image cap">							
														  <?php } else{ ?>				 
															 <img  class="card-img-left" src="{{ asset('resources/images').'/'.'activity-default-img.png'}}" alt="Card image cap">
														  <?php } ?>
														   <span class="card-body">
															<h6 class="card-title">{{ preg_replace('/[^(\x20-\x7F)\x0A\x0D]*/','', $act->title) }}</h6>
														   </span>
														</span>
													</a>
												</li>
											  <?php } } ?>
											  <?php } } ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>							
						 <?php } } ?>
						 
						
                    </div>
                </div>
            </div>
        </div>
    </div>
	
  <!--</div>
 </div>
</div>
</div>-->

<!--<script>
 $(".btn-primary").click(function(){
	if ($(this).data("closedAll")) {
		$(".multi-collapse").collapse("show");
	} else {
		$(".multi-collapse").collapse("hide");
	}

	// save last state
	$(this).data("closedAll", !$(this).data("closedAll"));
 });

// init with all closed
$(".btn-primary").data("closedAll", true);
</script> -->
<script>
function goBack() {
  window.history.back();
}
</script>
@endsection