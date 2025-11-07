@extends('admin.layouts.app')
@section('title', 'Goforfit Admin Activity')
@section('content')


<style>
	label:not(.form-check-label):not(.custom-file-label) { font-weight: 700 !important; }
	.controls.control_buttons { display: flex; column-gap: 6px; margin-left: 9px; }
	.copy-icon {color: #ffffff; }

</style>



	
<div class="content-wrapper"> 
    <section class="content-header">
      <div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-12">       
				<a class="" href="{{ route('admin.activities.index') }}"> <i class="fas fa-long-arrow-alt-left"></i> Back </a>
				<div class="top-action-btns"> <button type="submit" class="btn btn-sm btn-primary" onclick="document.getElementById('add-activity').submit();" >Update</button> </div>
			</div>
		</div>
    
        
      </div>
    </section>
   
	
    <section class="content">
      <div class="container-fluid">
        <div class="row">          
          <div class="col-md-12">          
            <div class="update-activity">
              <!--<div class="card-header">
                <h3 class="card-title">Edit Activity</h3>
              </div>-->
               <form method="POST" action="{{ route('admin.activities.update', $post->id) }}" enctype="multipart/form-data" id="add-activity">
				   @csrf
				   @method('PATCH')
				   <input type="hidden" name="sport_act" id="sport_act" value="<?=$post->id ?>">
				   <!--<div class="card-body">-->					   
					<div class="row">	   
							
					
					 <div class="col-md-8 pull-left">					 
					  <div class="card card-secondary">
						<div class="card-header"  data-card-widget="collapse" title="Collapse">
						  <h3 class="card-title">Activity</h3>
						  <div class="card-tools">
							
							<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
							  <i class="fas fa-minus"></i>
							</button>
						  </div>
						</div>
				       <div class="card-body">
					   
						<div class="row">
							<div class="col-md-12">
							
							
							@if (session('status'))
							<div class="alert alert-success">
								{{ session('msg') }}
							</div>
							@endif
							@if ($errors->any())
							<div class="alert alert-danger alert-dismissible fade show" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								  <span aria-hidden="true">&times;</span>
								</button>
								<ul>
									@foreach ($errors->all() as $error)
										<li>{{ $error }}</li>
									@endforeach
								</ul>
							</div>
						  @endif
					
					
							
								<div class="form-group">
									<label>Name</label>	
									<input type="text" name="title" value="{{ preg_replace('/[^(\x20-\x7F)\x0A\x0D]*/','', $post->title) }}" class="form-control">
								</div> 
							
							
							
						
								<div class="form-group">
								  <label for="exampleInputEmail1" scope="col">Teaching Through</label><br>	
								   <?php  $spt='';$teach_id='';
									 if(!empty($teaching)){								
									   foreach($teaching as $tch){					  
										  $teach_id = explode(",",$post->teach_id);
										?>
										<div class="form-check form-check-radio form-check-inline">
										   <label class="form-check-label">
											<input class="form-check-input through_sport" <?php echo (in_array($tch->id, $teach_id) ? 'checked' : '');?> type="checkbox" name="teaching_through[]" id="inlineRadio<?=$tch->id?>" value="{{ $tch->id }}"><?=$tch->name;?>
											
										   </label>
										</div>									
									<?php } } ?>						
								</div>
								
							
								<div class="form-group">
								<div class="row">
									<div class="col-md-6">
									
									<div class="form-group">
										<label>Image</label>		
										<input type="file" name="image" class="form-control" >
										 
									</div>
									</div>
									
									<div class="col-md-6">
									
									<div class="form-group">
										<?php $word = "wp-content"; $mystring = $post->image;
											
											if(strpos($mystring, $word)!== false){ ?>
												<img src="{{ $post->image }}" width="100" height="100">	
											<?php } else if (file_exists('public/uploads/'.$post->image)){ ?>
											<img src="{{ asset('public/uploads').'/'.$post->image }}" alt="" width="100" height="100">							
											<?php } else { ?>				 
											<img src="{{ asset('public/uploads').'/'.'images.jpg' }}" width="100" height="100">
											<?php }  ?>
									
									</div>
									</div>
									
								</div>
								</div>
							
						
						
							
						
								<div class="form-group">
									<label for="exampleInputEmail1" scope="col">Youtube URL</label>	
									<input type="text" name="url" value="{{ $post->url }}" class="form-control" placeholder="Enter URL">
								</div>
							
							
							
							
							
							
								<div class="form-group">
									<label>Learning Outcomes</label>							
									<textarea class="form-control" id="learning_outcomes" name="learning_outcomes" placeholder="Learning Outcomes">{{ $post->learning_outcomes }}</textarea>
								</div>
							   
							

						   
						
								<div class="form-group">
									<label for="exampleInputEmail1" scope="col">Description</label>
									<textarea id="description" class="form-control" name="description" placeholder="Description">{{ preg_replace('/[^(\x20-\x7F)\x0A\x0D]*/','', $post->description) }}</textarea>
								</div>
							
							
						
								<div class="form-group">
								   <label for="exampleInputEmail1" scope="col">Variations</label>							  
										 <textarea class="form-control" id="variations" name="change_it" placeholder="Change it (Variations)">{{ $post->change_it }}</textarea>
								</div>
							

						
						
							<div class="form-group">
								<label for="exampleInputEmail1" scope="col">Coaching (Teaching Tips)</label>							  
							    <textarea class="form-control" id="coaching" name="coaching" placeholder="Coaching (Teaching Tips)">{{ $post->coaching }}</textarea>
                            </div>
							
							
                                 
						
						    <div class="form-group">
                                <label for="exampleInputEmail1" scope="col">Equipment:</label>	
							    <textarea class="form-control" id="equipment" name="equipment" placeholder="Equipment">{{ $post->equipment }}</textarea>
                            </div>
							
							
                            
							
							<div class="form-check form-check-radio form-check-inline">
							  <label class="form-check-label">
								<input class="" checked="checked" type="radio" name="status" id="inlineRadio1" value="1"> Active
								<span class="circle">
									<span class="check"></span>
								</span>
							  </label>
							</div>
							<div class="form-check form-check-radio form-check-inline">
							  <label class="form-check-label">
								<input class="" type="radio" name="status" id="inlineRadio2" value="0"> Inactive
								<span class="circle">
									<span class="check"></span>
								</span>
							  </label>
							</div>
							
							 </div>					 
						</div>
							

							
						 </div>					 
						</div>					 
						</div>					 
						
					<div class="col-md-4 pull-right">						
						 
						<div class="card card-secondary" id="academic" <?php if(!in_array(1, $teach_id)){ echo 'style="display:none"'; } ?> >
							<div class="card-header"  data-card-widget="collapse" title="Collapse" >
								<h3 class="card-title">Academic Concepts</h3> 
								<div class="card-tools">
									<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
									  <i class="fas fa-minus"></i>
									</button>
								</div>
					        </div>							
														
							<div class="card-body">							
						  	 
								<ul class="select2-selection__rendered act-concepts">							 
									<?php $cepts =''; $classname =''; $subname =''; $chapname ='';
									  
									if(!empty($actconcepts)){								
										foreach($actconcepts as $cls){  
										
										?>
										
										<li class="tooltip1 select2-selection__choice multiact multi-tag" title="Concepts"> 
										   <ul>
										   <li class="act-cls"><span>{{ $cls->clsname }} </span> </li> 
										   <li class="act-sub"> <span>{{ $cls->subjectname }}  </span></li>
										   <li class="act-cptr"> Chapter: <span> {{ $cls->chaptername }} </span></li>
										   <li class="act-cont"> Concept: <span>{{ $cls->conceptname }} </span></li>
											 
											
										   </ul>
											<span class="select2-selection__choice__remove selmultiact" data-selectid="{{ $cls->con_id }}"  role="presentation"> x</span>
										</li>
									<?php } } ?>	
								</ul>
							
						    
							
								<button type="button" id="actconBtn"  date-actid="<?=$post->id?>"  class="btn btn-light"
						   data-toggle="modal" data-target="#actconmyModal"><i class="fa fa-plus-circle" aria-hidden="true"> </i> Add </button>
						   
							</div>
					    </div>
						
						
						
						
					    
						
						<div class="card card-secondary" id="sports-skills" <?php if(!in_array(2, $teach_id)){ echo 'style="display:none"'; } ?> >
							<div class="card-header"  data-card-widget="collapse" title="Collapse">
							<h3 class="card-title">Sports Skills/Techniques</h3>
							  <div class="card-tools">
								<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
								  <i class="fas fa-minus"></i>
								</button>
							  </div>
					        </div>							
												
							<div class="card-body">						
						  	 
								<ul class="select2-selection__rendered act-concepts">							 
									<?php 
									  
									if(!empty($acttechniques)){								
										foreach($acttechniques as $cls){  
										
										?>
										
										<li class="tooltip1 select2-selection__choice multiact multi-tag" title="Concepts"> 
										   <ul>
										   <li class="act-cls"><span>{{ $cls->clsname }} </span> </li> 
										   <li class="act-sub"> <span>Skillarea: {{ $cls->skillareaname }}  </span></li>
										   <li class="act-cptr"> Sports/Skill: <span> {{ $cls->sportsname }} </span></li>
										   <li class="act-cont"> Technique: <span>{{ $cls->techniquename }} </span></li>
											
										   </ul>
											<span class="select2-selection__choice__remove delskill" data-technique="{{ $cls->technique_id }}"  data-cls="{{ $cls->class_id }}" data-skillarea="{{ $cls->skillarea_id }}" data-sportskill="{{ $cls->sportskill_id }}" role="presentation"> x</span>
											
										</li>
									<?php } } ?>	
								</ul>
						 
							<button type="button" id="actskillBtn"  date-actid="<?=$post->id?>"  class="btn btn-light"
						   data-toggle="modal" data-target="#actskillModal"><i class="fa fa-plus-circle" aria-hidden="true"> </i> Add </button>
						 
							</div>
					    </div>					
						
						
					   </div>						
					  </div>
				    <!--</div>-->
				   <div class="clearfix">&nbsp;</div>	
				  <div class="action-btns">
				   <button type="submit" class="btn btn-sm btn-primary">Update</button>
				 </div>
				</form>					   
			 </div>
          </div>
        </div> 	   
      </div>
    </section>
  </div>

  
<?php
	$acls='<option value="">--Select--</option>';

	if(!empty($classes)){	
		foreach($classes as $cls){		
		  $acls.='<option value='.$cls->id.'>'.$cls->name.'</option>';	
		}
	}

	$asub='<option value="">--Select--</option>';
	$achp='<option value="">--Select--</option>';
	$aconc='<option value="">--Select--</option>';
	
	$askillarea='<option value="">--Select--</option>';
	if(!empty($skillareas)){								
		foreach($skillareas as $skillarea){	
			$askillarea.= '<option value="'.$skillarea->id.'" >'.$skillarea->name.'</option>'; 								
		} 
	}
	
	$asportskills='<option value="">--Select--</option>';
	if(!empty($sportskills)){								
		foreach($sportskills as $sportskill){	
			$asportskills.= '<option value="'.$sportskill->id.'" >'.$sportskill->name.'</option>'; 								
		} 
	}
	
	$atechniques='<option value="">--Select--</option>';
	if(!empty($techniques)){								
		foreach($techniques as $technique){	
			$atechniques.= '<option value="'.$technique->id.'" >'.$technique->name.'</option>'; 								
		} 
	}
	
												

?>

  
  <!-- Add Activity Sports Skill Modal -->
  <div class="modal fade" id="actskillModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="conmyModalLabel" aria-hidden="true" style="width:100%;display: none;">
	<div class="modal-dialog">
		<div class="modal-content" style="width: 800px;margin: 0px auto;">
			<div class="modal-header"><strong>Sports Skill and Technique bs cmpy</strong>
				
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			</div>
			<div class="modal-body">


				<form id="actskill_form" name="actconmy_form" method="POST">
					@csrf
					
					<div class="card-body" style="padding:0px;margin:0px !important;">					
						<input type="hidden" name="act_val" id="actskill_val" value="<?=$post->id?>">				
						<div class="input-group control-group after-skill-add-more">	


							<div class="container-fluid">
								<div class="row" style="width:800px">
									<div class="col-12">

										<div class="row row-wrapper">
												<div class="col-md-2">
													<div class="form-group">
														<label for="skill_class0" class="control-label  requiredField">
															Class <span class="asteriskField">*</span>
														</label>
														<div class="controls">
														<select class="select form-control skillcls_elem" id="skill_class0" name="skillclass[0]" 
														onchange="getskillarea(0,this.value)">
															<?=$acls?>
														</select>
														</div>
													</div>
												</div>
											
												<div class="col-md-3">
													<div  class="form-group">
														<label for="skillarea0" class="control-label  requiredField">
															Skill Area <span class="asteriskField">*</span>
														</label>
														<div class="controls ">
														  <select class="select form-control skillarea_elem" id="skillarea0" name="skillarea[0]" 
														onchange="agetskillsports(0,this.value)" >
															<?=$askillarea?>
														
														  </select>
														</div>
													</div>
												</div>
											
												<div class="col-md-2">
													<div class="form-group">
														<label for="skillsports0" class="control-label  requiredField">
															Skill / Sports <span class="asteriskField">*</span>
														</label>
														<div class="controls">
														<select class="select form-control skillsports_elem" id="skillsports0" name="skillsports[0]" 
														onchange="agettechnique(0,this.value)" > 
														  <?=$asportskills?>	
														 </select>
														</div>
													</div>
												</div>
											
												<div class="col-md-3" style="width: 34% !important">
													<div class="form-group">
														<label for="technique0" class="control-label  requiredField">
															Techniques <span class="asteriskField">*</span>
														</label>
														<div class="controls">
														 <select class="select form-control technique_elem" id="technique0" name="technique[0]">
														  <?=$atechniques?>	
														 </select>
														</div>
													</div>
												</div>
											
												<div class="col-md-2">
												  <div id="div_id_skill_quantity" class="form-group">
													<label for="id_skill_quantity" class="control-label">&nbsp;</label>


													<div class="controls control_buttons">
														<button class="btn btn-success skill-add-more" type="button"><i class="fa fa-plus-circle" aria-hidden="true"></i></button>
														<button class="btn btn-success copy-selected-row" type="button"><i class="fa fa-copy copy-icon" aria-hidden="true"></i></button>
													</div>


												<!-- 	<div class="controls">
													<button class="btn btn-success skill-add-more" type="button"><i class="fa fa-plus-circle" aria-hidden="true"></i>
													</button>
													</div> -->



												  </div>
												</div>	

											</div>


									</div>

								</div>	
							</div>

						</div>
				
					</div>
				</form>
			
			
				<div class="modal-footer">
					<button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
					<button id="actskillsave" type="button" class="btn btn-sm btn-primary">Save</button>				 
				</div>
			
			</div>
		</div>
	</div>
	</div>
	
	
	
	
  <!-- Add Activity Concept Modal -->
   <div class="modal fade" id="actconmyModal" tabindex="-1" role="dialog" aria-labelledby="conmyModalLabel" aria-hidden="true" style="width:100%;display: none;">
	<div class="modal-dialog">
		<div class="modal-content" style="width: 800px;margin: 0px auto;">
			<div class="modal-header"><strong>Add Academic Concept</strong>
				<div class="alert alert-success" id="add-new-alert" style="display:none"></div>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			</div>
			<div class="modal-body">
				<form id="actconmy_form" name="actconmy_form" method="POST">
					@csrf
					
					<div class="card-body" style="padding:0px;margin:0px !important;">
						
				
						<input type="hidden" name="act_val" id="act_val">				
						<div class="input-group control-group after-add-more">		
							<div class="row" style="width:800px">
								<div class="col-md-2">
									<div id="elem_class_0" class="form-group">
										<label for="id_class0" class="control-label  requiredField">
											Class <span class="asteriskField">*</span>
										</label>
										<div class="controls">
										<select class="select form-control cls_elem" id="id_class0" name="class[0]" onchange="getsubjects(0,this.value)">
											<?=$acls?>
										</select>
										</div>
									</div>
								</div>
							
								<div class="col-md-2">
									<div id="elem_subject_0" class="form-group">
										<label for="id_subject0" class="control-label  requiredField">
											Subject <span class="asteriskField">*</span>
										</label>
										<div class="controls ">
										  <select class="select form-control sub_elem" id="id_subject0" name="subject[0]" onchange="getchapters(0,this.value)"  >
											<?=$asub?>
										  </select>
										</div>
									</div>
								</div>
							
								<div class="col-md-2">
									<div id="elem_chapter_0" class="form-group">
										<label for="id_chapter0" class="control-label  requiredField">
											Chapter <span class="asteriskField">*</span>
										</label>
										<div class="controls">
										<select class="select form-control chp_elem" id="id_chapter0" name="chapter[0]" onchange="getconcepts(0,this.value)"> 
										 <?=$achp?>	
										 </select>
										</div>
									</div>
								</div>
							
								<div class="col-md-5">
									<div id="elem_concept_0" class="form-group">
										<label for="id_concept0" class="control-label  requiredField">
											Concept <span class="asteriskField">*</span>
										</label>
										<div class="controls">
										 <select class="select form-control con_elem" id="id_concept0" name="concept[0]">
										  <?=$aconc?>		
										 </select>
										</div>
									</div>
								</div>
							
								<div class="col-md-1">
								  <div id="div_id_stock_1_quantity" class="form-group">
									<label for="id_stock_1_quantity" class="control-label">&nbsp;</label>
									<div class="controls">
									<button class="btn btn-success add-more" type="button"><i class="fa fa-plus-circle" aria-hidden="true"></i>
									</button>
									</div>
								  </div>
								</div>				
							</div>			  
						</div>
				
					</div>
				</form>
			
			
				<div class="modal-footer">
					<button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
					<button id="actconsave" type="button" class="btn btn-sm btn-primary">Save</button>				 
				</div>
			
			</div>
		</div>
	</div>
	</div>
  
 <script>
	$('.teaching_through').change(function(){
		if($('#teaching_through').val() == 'through_sports'){
			$('#row_dim').show(); 
		} else {
			$('#row_dim').hide(); 
		}    
	});
	
	jQuery('input[name="teaching_through[]"]').on('click', function(){
		if ( $(this).is(':checked') ) {
			if($(this).val() == 1){
				$('#academic').show();
			}
			if($(this).val() == 2){
				$('#sports-skills').show();
			}
		} 
		else {
			if($(this).val() == 1){
				$('#academic').hide();
			}
			if($(this).val() == 2){
				$('#sports-skills').hide();
			}
		}
	});

	$('#actskillsave').click(function(event){
		
        var clsname = $(".skillcls_elem");
		var skillarea = $('.skillarea_elem');
        var skillsports = $('.skillsports_elem');
        var technique = $('.technique_elem');
		var act_val = $('#actskill_val').val();
		
		var skillval = [];
		
		for(var i = 0; i < clsname.length; i++){
			if($(clsname[i]).val() == "" || $(skillarea[i]).val() == "" || $(skillsports[i]).val()  == "" || $(technique[i]).val()  == ""){
				alert('Please select all options');
				return false;
			}
			skillval.push({
				class_id: $(clsname[i]).val(),
				skillarea_id:$(skillarea[i]).val(),
				skillsports_id:$(skillsports[i]).val(),
				technique_id:$(technique[i]).val()
				});
		}
		
		
		jQuery.ajax({
			url: "{{ route('activitytechnique') }}",     
			type: "POST" ,
			data:{ 
		        "acdata": skillval,
				"act_val" : act_val,
                "_token": "{{ csrf_token() }}",
              },		  
		 
			success:function(response){
				console.log(response);
				
				$("#actskillModal").modal("hide");
				alert('Skill Technique Saved Successfully!');
				location.reload();
							  
			}
        });
		
		
	});	
		

	$('#actconsave').click(function(event){
		//event.preventDefault();
		
        var clname = $(".cls_elem");
		var subject = $('.sub_elem');
        var chapter = $('.chp_elem');
        var concept = $('.con_elem');
		var act_val = $('#act_val').val();
		
		
		//console.log(act_val);
		var conceptval = [];
		
		for(var i = 0; i < clname.length; i++){
			//console.log($(clname[i]).val());
			if($(clname[i]).val() == "" || $(subject[i]).val() == "" || $(chapter[i]).val()  == "" || $(concept[i]).val()  == ""){
				alert('Please select all options');
				return false;
			}
			conceptval.push({
				class_id: $(clname[i]).val(),
				subject_id:$(subject[i]).val(),
				chapter_id:$(chapter[i]).val(),
				concept_id:$(concept[i]).val()
				});
		}
		
		//console.log(conceptval);
		
	
	
		//var str = $('#actconmy_form').serialize();
		jQuery.ajax({
			url: "{{ route('activityconcept') }}",     
			type: "POST" ,
			data:{ 
		        "acdata": conceptval,
				"act_val" : act_val,
                "_token": "{{ csrf_token() }}",
              },		  
		 
			success:function(response){
				console.log(response);
				
				$("#actconmyModal").modal("hide");
				alert('Concept Saved Successfully!');
				location.reload(); 
							  
			}
        });
		
		
		
	
    });
	
	
	
	
	$("#conBtn").click(function(){
       $("#conmyModal").modal("show");
    });
	
	 
	 
	$("#actconBtn").click(function(){
       $("#actconmyModal").modal("show");	   
	   $("#act_val").val($(this).attr("date-actid"));	   
	   $('#acfooter').hide(); 
    });

    var k = 1; 	
	
	$(".add-more").click(function(){ 
	    
		//$(".after-add-more").append('<div id="row'+k+'" class="row" style="width:800px"><div class="col-md-2"><div id="elem_class_'+k+'" class="form-group"><label for="id_class'+k+'" class="control-label"><span class="asteriskField"></span></label><div class="controls"><select class="select form-control cls_elem" id="id_class'+k+'" name="class['+k+']"  onchange="getsubjects('+k+',this.value)"><?=$acls?></select></div></div></div><div class="col-md-2"><div id="elem_subject_'+k+'" class="form-group"><label for="id_subject'+k+'" class="control-label"><span class="asteriskField"></span></label><div class="controls"><select class="select form-control sub_elem" id="id_subject'+k+'" name="subject['+k+']" onchange="getchapters('+k+',this.value)" ><?=$asub?></select></div></div></div><div class="col-md-2"><div id="elem_chapter_'+k+'" class="form-group"><label for="id_chapter'+k+'" class="control-label"><span class="asteriskField"></span></label><div class="controls"><select class="select form-control chp_elem" id="id_chapter'+k+'" name="chapter['+k+']" onchange="getconcepts('+k+',this.value)" ><?=$achp?></select></div></div></div><div class="col-md-5"><div id="elem_concept_'+k+'" class="form-group"><label for="id_concept'+k+'" class="control-label requiredField"><span class="asteriskField"></span></label><div class="controls"><select class="select form-control con_elem" id="id_concept'+k+'" name="concept['+k+']"><?=$aconc?></select></div></div></div><div class="col-md-1"><div id="div_id_stock_1_quantity" class="form-group"><label for="id_quantity" class="control-label">&nbsp;</label><div class="controls"><button class="btn btn-danger remove rem" id="'+k+'" type="button"><i class="fa fa-minus-circle" aria-hidden="true"></i></button></div></div></div></div>');
		
	    k++; 
    });
	  
	$('.after-add-more').on('click', '.rem', function(e){
       e.preventDefault();
	   var bid = $(this).attr("id");
		$("#row"+bid+"").remove();
	}); 
   
   
  //Skills activity 
   var sk = 1; 	
	
$(".skill-add-more").click(function() {
   // alert('-----');
    
	var technique =  '<?= $atechniques ?>';
	
    $(".after-skill-add-more").append(
        '<div id="row' + sk + '" class="row" style="width:800px">' +
            '<div class="col-md-2">' +
                '<div class="form-group">' +
                    '<label for="skill_class' + sk + '" class="control-label"><span class="asteriskField"></span></label>' +
                    '<div class="controls">' +
                        '<select class="select form-control skillcls_elem" id="skill_class' + sk + '" name="skillclass[' + sk + ']" onchange="getskillarea(' + sk + ', this.value)">' +
                        '<?= $acls ?>' +
                        '</select>' +
                    '</div>' +
                '</div>' +
            '</div>' +
            
            '<div class="col-md-2">' +
                '<div class="form-group">' +
                    '<label for="skillarea' + sk + '" class="control-label"><span class="asteriskField"></span></label>' +
                    '<div class="controls">' +
                        '<select class="select form-control skillarea_elem" id="skillarea' + sk + '" name="skillarea[' + sk + ']" onchange="agetskillsports(' + sk + ', this.value)">' +
                        '<?= $askillarea ?>' +
                        '</select>' +
                    '</div>' +
                '</div>' +
            '</div>' +
            
            '<div class="col-md-2">' +
                '<div class="form-group">' +
                    '<label for="skillsports' + sk + '" class="control-label"><span class="asteriskField"></span></label>' +
                    '<div class="controls">' +
                        '<select class="select form-control skillsports_elem" id="skillsports' + sk + '" name="skillsports[' + sk + ']" onchange="agettechnique(' + sk + ', this.value)">' +
                        '<?= $asportskills ?>' +
                        '</select>' +
                    '</div>' +
                '</div>' +
            '</div>' +
            
            '<div class="col-md-5">' +
                '<div class="form-group">' +
                    '<label for="technique' + sk + '" class="control-label requiredField"><span class="asteriskField"></span></label>' +
                    '<div class="controls">' +
                        '<select class="select form-control technique_elem" id="technique' + sk + '" name="technique[' + sk + ']">' +
                        technique +  // Ensure PHP generates valid HTML
                        '</select>' +
                    '</div>' +
                '</div>' +
            '</div>' +
            
            '<div class="col-md-1">' +
                '<div id="div_id_stock_1_quantity" class="form-group">' +
                    '<label for="id_quantity" class="control-label">&nbsp;</label>' +
                    '<div class="controls">' +
                        '<button class="btn btn-danger remove rem" id="' + sk + '" type="button"><i class="fa fa-minus-circle" aria-hidden="true"></i></button>' +
                    '</div>' +
                '</div>' +
            '</div>' +
        '</div>'
    );

    sk++; 
});


	  
	$('.after-skill-add-more').on('click', '.rem', function(e){
       e.preventDefault();
	   var bid = $(this).attr("id");
		$("#row"+bid+"").remove();
	}); 
   
   
	$("span.delskill").click(function(e){
	
		var actid = $('#sport_act').val();
		var technique_id = $(this).attr("data-technique");
		var class_id = $(this).attr("data-cls");
		var skillarea_id = $(this).attr("data-skillarea");
		var sportskill_id = $(this).attr("data-sportskill");
		// console.log(actid, technique_id, class_id, skillarea_id, sportskill_id );
		
		
	
	    if(technique_id.length > 0 ){ 
            var checkstr =  confirm('Are you sure you want to delete?');			
			if(checkstr == true){
			  $.ajax({
				url: "{{ route('techniquedelete') }}",
				data: {"actid":actid,"technique_id":technique_id,"class_id":class_id,"skillarea_id":skillarea_id,"sportskill_id":sportskill_id,"_token": "{{ csrf_token() }}"} ,
				type: 'POST',
				success:function(response){
				 //console.log(response);
					if((response.errors)){
						alert('error!');
					}else{
					  alert('Deleted Successfully!');
					  location.reload();
					}			  
                },
			  });
			}else{
			  return false;
			}			
        }else{
		  alert('Please Select Sports Skill/Technique');return false;	
		}       
	});
   
    $("span.selmultiact").click(function(e){
	var selc = $(this).attr("data-selectid");
    var actid = $('#sport_act').val();	
	
	    if(selc.length > 0 ){ 
          //alert(selc);
            var checkstr =  confirm('Are you sure you want to delete?');			
			if(checkstr == true){
			  $.ajax({
				url: "{{ route('conceptsdelete') }}",
				data: {"actid":actid,"conc_id":selc,"_token": "{{ csrf_token() }}"} ,
				type: 'POST',
				success:function(response){
				 //console.log(response);
					if((response.errors)){
						alert('error!');
					}else{
					  alert('Deleted Successfully!');
					  location.reload();
					}			  
                },
			  });
			}else{
			  return false;
			}			
        }else{
		  alert('Please Select Sports Name');return false;	
		}       
   });
   



     $(document).ready(function () {
    $(document).on("click", ".copy-selected-row", function () {

	      let lastRow = $(".row-wrapper:last"); 
	      let selectedValues = {};

	      lastRow.find("select").each(function () {
	          let selectName = $(this).attr("name");
	          selectedValues[selectName] = $(this).val();
	      });


	      let newRow = lastRow.clone(); 
	      let lastIndex = parseInt(lastRow.find("select").first().attr("name").match(/\d+/)[0]); 
	      let newIndex = lastIndex + 1;

	       
	      newRow.find("select, input").each(function () {
	        let oldName = $(this).attr("name");
	        let newName = oldName.replace(/\d+/, newIndex);
	        $(this).attr("name", newName);

	        let oldId = $(this).attr("id");
	        let newId = oldId.replace(/\d+/, newIndex);
	        $(this).attr("id", newId);

	        // Remove the 'onchange' event
	        $(this).removeAttr("onchange");


	        $(this).on('change', function () {
	        		colned_data(newIndex, newName);
	        });
	      });

	      // Remove old buttons and add only the remove button
		    newRow.find(".skill-add-more, .copy-selected-row").remove();

		    newRow.find(".control_buttons").html(`
		        <button class="btn btn-danger remove-row" type="button">
		            <i class="fa fa-minus-circle" aria-hidden="true"></i>
		        </button>
		    `);

	      lastRow.after(newRow);

	      newRow.find("select").each(function () {
	          let newName = $(this).attr("name").replace(/\d+/, lastIndex);
	          if (selectedValues[newName] !== undefined) {
	              $(this).val(selectedValues[newName]); 
	          }
	      });

	    });

	    $(document).on("click", ".remove-row", function () {
	        $(this).closest(".row-wrapper").remove();
	    });
	});



</script>


	
@endsection