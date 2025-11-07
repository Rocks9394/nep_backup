@extends('admin.layouts.app')
@section('title', 'Goforfit Admin Activity')
@section('content')

<style>
	label:not(.form-check-label):not(.custom-file-label) {
    font-weight: 700 !important;
}
</style>
	
	
<div class="content-wrapper"> 
    <section class="content-header">
      <div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-12">       
				<a class="" href="{{ route('admin.posts.index') }}"> <i class="fas fa-long-arrow-alt-left"></i> Back </a>
				<div class="top-action-btns"> <button type="submit" class="btn btn-sm btn-primary"><?=!empty($post->id) ? "Update" : "Insert" ?></button> </div>
			</div>
		</div>
    
        
      </div>
    </section>
    @if($errors->any())
	  <div class="alert alert-danger">
		<ul>
			@foreach($errors->all() as $error)
			 <li>{{ $error }}</li>
			@endforeach
		</ul>
	  </div>
    @endif	
	
    <section class="content">
      <div class="container-fluid">
        <div class="row">          
          <div class="col-md-12">          
            <div class="update-activity">
              <!--<div class="card-header">
                <h3 class="card-title">Edit Activity</h3>
              </div>-->
               <form method="POST" action="{{ route('admin.posts.update', $post->id) }}" enctype="multipart/form-data">
				   @csrf
				   @method('PATCH')
				   <input type="hidden" name="sport_act" id="sport_act" value="<?=$post->id ?>">
				   <!--<div class="card-body">-->					   
					<div class="row">	   
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
							
							
								<div class="form-group">
									<label>Name</label>	
									<input type="text" name="title" value="{{ preg_replace('/[^(\x20-\x7F)\x0A\x0D]*/','', $post->title) }}" class="form-control">
								</div> 
							
							
							
						
								<div class="form-group">
								  <label for="exampleInputEmail1" scope="col">Teaching Through</label><br>	
								   <?php 
									 $spt='';
									 $var='';
									 if(!empty($teaching)){								
									   foreach($teaching as $tch){					  
										  $var = explode(",",$post->teach_id);
										?>
										<div class="form-check form-check-radio form-check-inline">
										   <label class="form-check-label">
											<input class="form-check-input through_sport" <?php echo (in_array($tch->id, $var) ? 'checked' : '');?> type="checkbox" name="teaching_through[]" id="inlineRadio<?=$tch->id?>" value="{{ $tch->id }}"><?=$tch->name;?>
											<span class="circle">
												<span class="check"></span>
											</span>
										   </label>
										</div>									
									<?php } } ?>						
								</div>
								
							
								<div class="form-group">
								<div class="row">
									<div class="col-md-6">
									
									<div class="form-group">
										<label>Featured Image</label>		
										<input type="file" name="image" class="form-control" style="position:none !important;">
										 
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
									<textarea class="form-control" id="l-outcome" name="learning_outcomes" placeholder="Learning Outcomes">{{ $post->learning_outcomes }}</textarea>
								</div>
							   
							

						   
						
								<div class="form-group">
									<label for="exampleInputEmail1" scope="col">Description</label>
									<textarea id="summernote" class="form-control" name="description" placeholder="Description">{{ preg_replace('/[^(\x20-\x7F)\x0A\x0D]*/','', $post->description) }}</textarea>
								</div>
							
							
						
								<div class="form-group">
								   <label for="exampleInputEmail1" scope="col">Variations</label>							  
										 <textarea class="form-control" id="change-it" name="change_it" placeholder="Change it (Variations)">{{ $post->change_it }}</textarea>
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
						 
						<div class="card card-secondary" id="academic">
							<div class="card-header"  data-card-widget="collapse" title="Collapse" >
								<h3 class="card-title">Academic Concepts</h3>
								<div class="card-tools">
									<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
									  <i class="fas fa-minus"></i>
									</button>
								</div>
					        </div>							
							<?php							
							  $actconcepts = DB::table('concept')
											->leftJoin('activity_concept', 'activity_concept.con_id', '=', 'concept.id')
											->where('concept.name','!=','null')
											->where('activity_concept.act_id','=',$post->id)
											->orderBy('concept.name', 'asc')
											->get();
							?>							
							<div class="card-body">							
						  	 
								<ul class="select2-selection__rendered act-concepts">							 
									<?php $cepts =''; $classname =''; $subname =''; $chapname ='';
									  
									if(!empty($actconcepts)){								
										foreach($actconcepts as $cls){ 
									   
										$cepts = DB::table('concept')
												->select('class_id','subject_id','chapter_id')
												->where('name','!=','null')->where('id','=',$cls->id)->first();
												
										$classname = DB::table('class')->where('id', $cepts->class_id)->first();
										$subname = DB::table('subject')->where('id', $cepts->subject_id)->first();
										$chapname = DB::table('chapter')->where('id', $cepts->chapter_id)->first();
									 ?>								   
										<li class="tooltip1 select2-selection__choice multiact multi-tag" title="Concepts"> 
										   <ul>
										   <li class="act-cls"><span><?=$classname->name?></span> </li> 
										   <li class="act-sub"> <span><?=$subname->name?> </span></li>
										   <li class="act-cptr"> Chapter: <span> <?=$chapname->name?> </span></li>
										   <li class="act-cont"> Concept: <span>{{ $cls->name }} </span></li>
											 
											
										   </ul>
											<span class="select2-selection__choice__remove selmultiact" data-selectid="{{ $cls->id }}"  role="presentation"> x</span>
										</li>
									<?php } } ?>	
								</ul>
							
						    
							
								<button type="button" id="actconBtn"  date-actid="<?=$post->id?>"  class="btn btn-light"
						   data-toggle="modal" data-target="#actconmyModal"><i class="fa fa-plus-circle" aria-hidden="true"> </i> Add </button>
						   
							</div>
					    </div>
						
						
						
						
					    
						
						<div class="card card-secondary" id="sports-skills">
							<div class="card-header"  data-card-widget="collapse" title="Collapse">
							<h3 class="card-title">Sports Skills/Techniques</h3>
							  <div class="card-tools">
								<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
								  <i class="fas fa-minus"></i>
								</button>
							  </div>
					        </div>							
												
							<div class="card-body">						
						  	 <ul class="select2-selection__rendered ">							 
							  <?php                                 								  
								 if(!empty($skills)){								
								   foreach($skills as $scls){
								  if(in_array($scls->id, $skillact)){								     
							  ?>								   
								<li class="select2-selection__choice multiact" title="Concepts">{{ preg_replace('/&amp;[^(\x20-\x7F)\x0A\x0D]*/','', $scls->name) }}<span class="select2-selection__choice__remove skldel" data-selectid="{{ $scls->id }}" role="presentation">x</span></li>
							  <?php } } } ?>	
							 </ul>
														
							
							<div class="clearfix">&nbsp;</div>
							<select name="skills[]" id="skills" multiple="multiple" data-placeholder="Select Skills" class="select2 form-control" style="width: 100%;">
							   <?php
								 if(!empty($skills)){								
								   foreach($skills as $scls){ ?>
									<option value="{{ $scls->id }}"><?=$scls->name;?></option> 								
								<?php } } ?>	
							</select>
							<div class="clearfix">&nbsp;</div>	
						 
							<button type="button" name="savedata" id="save_skill" class="btn btn-light" style=><i class="fa fa-plus-circle" aria-hidden="true"> </i> Add</button>
						 
							</div>
					    </div>					
						
						
					   </div>						
					  </div>
				    <!--</div>-->
				   <div class="clearfix">&nbsp;</div>	
				  <div class="action-btns">
				   <button type="submit" class="btn btn-sm btn-primary"><?=!empty($post->id) ? "Update" : "Insert" ?></button>
				 </div>
				</form>					   
			 </div>
          </div>
        </div> 	   
      </div>
    </section>
  </div>

  
<?php

$classes  = DB::table('class')->orderBy('id', 'asc')->get();
$subjects  = DB::table('subject')->orderBy('name', 'asc')->get();
$chapters  = DB::table('chapter')->orderBy('name', 'asc')->get();
//$concepts  = DB::table('concept')->orderBy('name', 'asc')->get();
$concepts = DB::table('concept')->select(DB::raw('DISTINCT name,id, COUNT(*) AS cid'))
			->groupBy('id')
			->where('name','!=','null')
			->orderBy('cid', 'desc')
			->get();


$acls='<option value="">--Select--</option>';

if(!empty($classes)){	
	foreach($classes as $cls){		
	  $acls.='<option value='.$cls->id.'>'.$cls->name.'</option>';	
	}
}

$asub='<option value="">--Select--</option>';
$achp='<option value="">--Select--</option>';
$aconc='<option value="">--Select--</option>';

/*
if(!empty($subjects)){	
	foreach($subjects as $sb){		
	  $asub.='<option value='.$sb->id.'>'.$sb->name.'</option>';	
	}
}

if(!empty($chapters)){	
	foreach($chapters as $chp){		
	  $achp.='<option value='.$chp->id.'>'.$chp->name.'</option>';	
	}
 }
 
 if(!empty($concepts)){	
	foreach($concepts as $con){		
	  $aconc.='<option value='.$con->id.'>'.$con->name.'</option>';	
	}
 }
 */
?>

  
  <!-- Add Activity Concept Modal -->
   <div class="modal fade" id="actconmyModal" tabindex="-1" role="dialog" aria-labelledby="conmyModalLabel" aria-hidden="true" style="width:100%;display: none;">
	<div class="modal-dialog">
		<div class="modal-content" style="width: 800px;margin: 0px auto;">
			<div class="modal-header"><strong>Add Academic Concept:-</strong>
				<div class="alert alert-success" id="add-new-alert" style="display:none"></div>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			</div>
			<div class="modal-body">
				<form id="actconmy_form" name="actconmy_form" method="POST">
					@csrf
					
					<div class="card-body" style="padding:0px;margin:0px !important;">
						@if(session('status'))
						<div class="alert alert-success">{{ session('msg') }}</div>
						@endif
						@if($errors->any())
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
											<option value="">--Select--</option>
											<?php 
											if(!empty($classes)){ 
												foreach($classes as $cls){ ?>
												  <option value="{{ $cls->id }}"><?=$cls->name;?></option>                
											<?php }
											} 
											?>
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
											<option value="">--Select--</option>
											<?php 
											  /*if(!empty($allsubject)){               
											   foreach($allsubject as $sb){  ?>
												<option value="{{ $sb->id }}"><?=$sb->name;?></option>                
										  <?php } }*/ ?>
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
										  <option value="">--Select--</option>
										  <?php 
											 /*if(!empty($chapters)){								
											   foreach($chapters as $cls){	?>
												<option value="{{ $cls->id }}"><?=$cls->name;?></option> 								
										  <?php } }*/ ?>	
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
										  <option value="">--Select--</option>
										  <?php 
											 /*if(!empty($concepts)){								
											   foreach($concepts as $cls){	?>
												<option value="{{ $cls->id }}"><?=$cls->name;?></option> 								
										  <?php } }*/ ?>	
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
	$('#teaching_through').change(function(){
		if($('#teaching_through').val() == 'through_sports'){
			$('#row_dim').show(); 
		} else {
			$('#row_dim').hide(); 
		}    
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
	
	$(".add-more").click(function(){ // 
	    
		$(".after-add-more").append('<div id="row'+k+'" class="row" style="width:800px"><div class="col-md-2"><div id="elem_class_'+k+'" class="form-group"><label for="id_class'+k+'" class="control-label"><span class="asteriskField"></span></label><div class="controls"><select class="select form-control cls_elem" id="id_class'+k+'" name="class['+k+']"  onchange="getsubjects('+k+',this.value)"><?=$acls?></select></div></div></div><div class="col-md-2"><div id="elem_subject_'+k+'" class="form-group"><label for="id_subject'+k+'" class="control-label"><span class="asteriskField"></span></label><div class="controls"><select class="select form-control sub_elem" id="id_subject'+k+'" name="subject['+k+']" onchange="getchapters('+k+',this.value)" ><?=$asub?></select></div></div></div><div class="col-md-2"><div id="elem_chapter_'+k+'" class="form-group"><label for="id_chapter'+k+'" class="control-label"><span class="asteriskField"></span></label><div class="controls"><select class="select form-control chp_elem" id="id_chapter'+k+'" name="chapter['+k+']" onchange="getconcepts('+k+',this.value)" ><?=$achp?></select></div></div></div><div class="col-md-5"><div id="elem_concept_'+k+'" class="form-group"><label for="id_concept'+k+'" class="control-label requiredField"><span class="asteriskField"></span></label><div class="controls"><select class="select form-control con_elem" id="id_concept'+k+'" name="concept['+k+']"><?=$aconc?></select></div></div></div><div class="col-md-1"><div id="div_id_stock_1_quantity" class="form-group"><label for="id_quantity" class="control-label">&nbsp;</label><div class="controls"><button class="btn btn-danger remove rem" id="'+k+'" type="button"><i class="fa fa-minus-circle" aria-hidden="true"></i></button></div></div></div></div>');
		
	    k++; 
    });
	  
	  $('.after-add-more').on('click', '.rem', function(e){
       e.preventDefault();
	   var bid = $(this).attr("id");
		$("#row"+bid+"").remove();
   }); 
   
   
   
   
    $("span.selmultiact").click(function(e){
	var selc = $(this).attr("data-selectid");
    var actid = $('#sport_act').val();	
	
	    if(selc.length > 0 ){ 
          //alert(selc);
            var checkstr =  confirm('are you sure you want to delete this?');			
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
					  alert('Delete Successfully!');
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
   
</script>
	
@endsection