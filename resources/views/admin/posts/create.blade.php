@extends('admin.layouts.app')
@section('title', 'Goforfit Admin Activity')
@section('content')
<div class="content-wrapper"> 
<section class="content-header">
  <div class="container-fluid">
	<div class="row mb-2">
	  <div class="col-sm-12">
		<a class="" href="{{ route('admin.posts.index') }}"><i class="fas fa-long-arrow-alt-left"></i> Back</a>
		<h1>Add Activity</h1>
	  </div>
	  </div>
     <div class="row mb-2">  
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active"aria-current="page">Activity</li>
            </ol>
          </div>
        </div>
      </div>
</section>    
<section class="content">
  <div class="container-fluid">
	<div class="row">          
	  <div class="col-md-12">            
		<div class="card card-primary">
		  <div class="card-header">
			<h3 class="card-title">Add Activity</h3>
		  </div>             
		   <form method="POST" action="{{ route('admin.posts.store') }}" enctype="multipart/form-data">
			  @csrf
			  <div class="card-body">					   
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
							<div class="col-md-12">
					          <div class="card card-secondary">
					            <div class="card-header" style="background-color: #007bff;height:40px !important">
					              <h3 class="card-title">Activity</h3>
					              <div class="card-tools">
					                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
					                  <i class="fas fa-minus"></i>
					                </button>
					              </div>
					            </div>
								
					            <div class="card-body">
					            	<div class="form-group">
									  <label for="exampleInputEmail1" scope="col">Teaching Through :</label><br>
									   <?php 
			                             $i=0;						   
										 if(!empty($teaching)){	
										   foreach($teaching as $tch){ 
										    $i++;
											$chk=!empty($tch->id)&&($i==2) ? 'checked="checked"' : ''; ?>
											<div class="form-check form-check-radio form-check-inline">
											  <label class="form-check-label">
												<input class="form-check-input" <?=$chk?> type="checkbox" name="teaching_through[]" id="inlineRadio<?=$tch->id?>" value="{{ $tch->id }}"><?=$tch->name;?>
												<span class="circle">
													<span class="check"></span>
												</span>
											  </label>
											</div>									
										<?php } } ?>							
										</div>
										
					              <div class="form-group">
					                <label for="inputEstimatedBudget">Skills</label>
					                <select name="skills[]" id="skills" multiple="multiple" data-placeholder="Select Skills" class="select2 form-control" style="width: 100%;">
									   <?php
										 if(!empty($skills)){
										   foreach($skills as $scls){ ?>
											<option  value="{{ $scls->id }}"><?=$scls->name;?></option> 								
										<?php } } ?>	
									</select>
					              </div>
					              <div class="form-group">
					                <label for="inputSpentBudget">Tags :</label>
					                <select name="tags[]" class="select2 form-control" multiple="multiple" data-placeholder="Select Tags" style="width: 100%;">
					                <?php 
									 if(!empty($tags)){								
									   foreach($tags as $tcls){ ?>
									    <option value="{{ $tcls->id }}"><?=$tcls->name;?></option>	
									<?php } } ?>	
					              </select>
					              </div>
					               <div class="form-group">
									<label for="exampleInputEmail1" scope="col">Activity Name :</label>
									  <input type="text" name="title" class="form-control" placeholder="Enter activity name">
									</div>
									<div class="form-group">
									<label for="exampleInputEmail1" scope="col">Activity URL :</label>
										<input type="text" name="url" class="form-control" placeholder="Enter URL">
									</div>
									<div class="form-group">
									<label for="exampleInputEmail1" scope="col">Image :</label>	
									  <input type="file" name="image" class="form-control" style="position:none !important;">
									</div>		
					            </div>
					          </div>
					        </div>


					        <section class="content">
							 <div class="row">
								<div class="col-md-12">
								  <div class="card card-outline card-info">
									<div class="card-header">
									  <label for="exampleInputEmail1" scope="col">Learning Outcomes :</label>
									  <textarea class="form-control mytextarea" id="mytextarea" name="learning_outcomes[]"  placeholder="Enter Learning Outcomes" required >
									  </textarea>
									</div>
								  </div>
								</div>
							 </div>
						   </section>



							<section class="content" style="margin-right: auto;margin-left: 0px;margin-right: -333px;">
						      <div class="row">
						        <div class="col-md-12">
						          <div class="card card-outline card-info">
						            <div class="card-header">
						              <label for="exampleInputEmail1" scope="col">Description :</label>
									<textarea id="summernote" class="form-control" name="description" placeholder="Description">
									</textarea>
						            </div>
						          </div>
						        </div>
						      </div>
						    </section>
							
						    <section class="content" style="margin-right: auto;margin-left: 0px;margin-right: -333px;">
						      <div class="row">
						        <div class="col-md-12">
						          <div class="card card-outline card-info">
						            <div class="card-header">
						              <label for="exampleInputEmail1" scope="col">Variations :</label>
									<textarea class="form-control" id="change-it" name="change_it" placeholder="Change it (Variations)">
									</textarea>
						            </div>
						          </div>
						        </div>
						      </div>
						    </section>

						    <section class="content" style="margin-right: auto;margin-left: 0px;margin-right: -333px;">
						      <div class="row">
						        <div class="col-md-12">
						          <div class="card card-outline card-info">
						            <div class="card-header">
						              <label for="exampleInputEmail1" scope="col">Coaching (Teaching Tips) :</label>
									<textarea class="form-control" id="coaching" name="coaching" placeholder="Coaching (Teaching Tips)">
									</textarea>
						            </div>
						          </div>
						        </div>
						      </div>
						    </section>	
						    <section class="content" style="margin-right: auto;margin-left: 0px;margin-right: -333px;">
						      <div class="row">
						        <div class="col-md-12">
						          <div class="card card-outline card-info">
						            <div class="card-header">
						              <label for="exampleInputEmail1" scope="col">Equipment :</label>
									<textarea class="form-control" id="equipment" name="equipment" placeholder="Equipment">
									</textarea>
						            </div>
						          </div>
						        </div>
						      </div>
						    </section>

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
								<input class="" type="radio" name="status" id="inlineRadio2" value="0"> In Active
								<span class="circle">
									<span class="check"></span>
								</span>
							  </label>
							</div>			 
						 </div>
						 
						<div class="col-md-4 pull-right">						
						 						
					    <div class="card card-secondary">
							<div class="card-header" style="background-color: #007bff;height:40px !important;">
							  <h3 class="card-title">Activity To Sports Relation</h3>
							  <div class="card-tools">
								<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
								  <i class="fas fa-minus"></i>
								</button>
							  </div>
							</div>						
							
						   <div class="card-body">						   
						    <div id="chk_sport" style="display:block">						    
							<label for="Classes" scope="col">Sports:-</label><hr>
							 <select name="sports[]" id="sports" multiple="multiple" data-placeholder="Select Sports" class="select2 form-control" style="width: 100%;">
							  <?php
								 if(!empty($sports)){								
								   foreach($sports as $cls){ ?>
									<option value="{{ $cls->id }}"><?=$cls->name;?></option> 								
							  <?php } } ?>	
							 </select><br>	
							 <button id="savesports" type="button" class="btn btn-xs btn-primary">Save</button>							
					        </div>						  
					     </div>
					    </div>
						
						
						<div class="card card-secondary">
							<div class="card-header" style="background-color: #007bff;height:40px !important">
							  <h3 class="card-title">Add Class,Subject,Chapter,Concept</h3>
							  <div class="card-tools">
								<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
								  <i class="fas fa-minus"></i>
								</button>
							  </div>
					        </div>
							<div class="card-body">						   
						    <span><a id="myBtn" style="cursor:pointer;color: #007bff;" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus-circle" aria-hidden="true"> ( Add Class ) </i></a></span><br>
						    <!--<select name="classes" class="form-control" required style="width:100% !important;">
						    <option value=""> Select Class </option>							 
							 <?php			    
								/*if(!empty($classes)){								
								   foreach($classes as $klas){
							 ?>	
						    <option <?=$klas->id == $post->class_id ? 'selected="selected"' : '';?> value="<?=$klas->id?>"><?=$klas->name?></option>
							<?php } }*/ ?>	
						   </select>							
						   <label for="Classes" scope="col"> Subjects</label>&nbsp;&nbsp;-->
                           <span><a id="smyBtn" style="cursor:pointer;color: #007bff;" data-toggle="modal" data-target="#smyModal"><i class="fa fa-plus-circle" aria-hidden="true"> ( Add Subject ) </i></a></span><br>
						   <!--<span><a id="stoclsmyBtn" style="cursor:pointer;color: #007bff;" data-toggle="modal" data-target="#stoclsmyModal"><i class="fa fa-plus-circle" aria-hidden="true"> ( Add Subject To Class ) </i></a></span>-->
							 <!--<select name="subjects" id="subjects" class="form-control" required style="width:100% !important;">
							   <option value="">Select Subjects</option> 
							   <?php 
								 /*if(!empty($subjects)){								
								   foreach($subjects as $scls){									
								?>
					           <option <?=$scls->id == $post->subject_id ? 'selected="selected"' : '';?> value="<?=$scls->id?>"><?=$scls->name?></option>
							 <?php } }*/ ?>	
							</select>
							<label for="Classes" scope="col"> Chapters</label>&nbsp;&nbsp;-->
							<span><a id="chpBtn" style="cursor:pointer;color: #007bff;" data-toggle="modal" data-target="#chmyModal"><i class="fa fa-plus-circle" aria-hidden="true"> ( Add Chapter )</i></a></span><br>
						    <!--<select name="chapters" id="chapters" class="form-control" style="width:100% !important;">
							  <option value="">Select Chapters</option>   
							   <?php 
								 /*if(!empty($chapters)){								
								   foreach($chapters as $chp){ 
								?>
					             <option <?=$chp->id == $post->chapter_id ? 'selected="selected"' : '';?> value="<?=$chp->id?>"><?=$chp->name?></option>
								<?php } }*/ ?>	
							</select>
							<label for="Classes" scope="col">Concepts</label>&nbsp;&nbsp;--> 
							<span><a id="conBtn" style="cursor:pointer;color: #007bff;" data-toggle="modal" data-target="#conmyModal"><i class="fa fa-plus-circle" aria-hidden="true"> ( Add Concept )</i></a></span>
						    <!--<select name="concepts" id="kconcepts" class="form-control" style="width:100% !important;">
							 <option value="">Select Concepts</option>  
						    <?php 							    
							 /*if(!empty($concepts)){								
							   foreach($concepts as $cnc){ ?>
								<option <?=$cnc->id == $post->concept_id ? 'selected="selected"' : '';?> value="{{ $cnc->id }}"><?php echo $cnc->name;?></option> 								
							<?php } }*/ ?>	
						   </select>-->						   
						   <?php						   
						    //echo $var;die;						   
						     //$spt=!empty($var)&&($var==2) ? 'display:block':'display:none';
						   ?>						  						  
					     </div>
					    </div>
					   </div>
					  </div>
					 </div>						 
				   </div>					   
				   </div>
				  <div class="clearfix">&nbsp;</div>					 
				 <div class="card-footer">
				  <button type="submit" class="btn btn-sm btn-primary">Submit</button>
				 </div>
			  </form>
            </div>
          </div>
     </section>  
  </div> 
  
  <!-- Add Subject to Class Modal -->  
	<div class="modal fade" id="stoclsmyModal" tabindex="-1" role="dialog" aria-labelledby="stoclsmyModalLabel" aria-hidden="true" style="display: none;">
	 <div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header"><strong>Add Subject To Class</strong>
			<div class="alert alert-success" id="add-new-alert" style="display:none"></div>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			</div>
			<div class="modal-body">			
			  <form id="stoclsmy_form" method="POST">				   
				  <div class="card-body">
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
					 <label>Class :</label>            
					 <select name="class_id" id="class_id" class="form-control" required style="width:100% !important;">
					  <?php 
					   if(!empty($classes)){ ?>
                         <option value=""> Select Class </option>  						   
					   <?php 
					     foreach($classes as $cls){ ?>
						  <option value="{{ $cls->id }}"><?=$cls->name;?></option>                
					  <?php } } ?>  
					 </select>  
					</div>
					
					<div class="form-group">            
					 <label>Subject :</label>					 
					 <select name="subject[]" id="all_sub" multiple="multiple" data-placeholder="Select Subject" class="select2 form-control" style="width: 100%;">
					 <?php 
					  if(!empty($allsubject)){               
					   foreach($allsubject as $sb){  ?>
						<option value="{{ $sb->id }}"><?=$sb->name;?></option>                
					  <?php } } ?>  
					  </select>  
					</div>
				</div>					
				<div class="modal-footer">
				 <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
				 <button id="subject_class" type="button" class="btn btn-sm btn-primary">Save</button>				 
				</div>
			 </form>
		   </div>				
		</div>
	  </div>
	</div>  
  
  
  <!-- Concept Modal -->  
	<div class="modal fade" id="conmyModal" tabindex="-1" role="dialog" aria-labelledby="conmyModalLabel" aria-hidden="true" style="display: none;">
	 <div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header"><strong>Add New Concept</strong>
			<div class="alert alert-success" id="add-new-alert" style="display:none"></div>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			</div>
			<div class="modal-body">			
			  <form id="mychp_form" method="POST">				   
				  <div class="card-body">
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
                        <label>Class :</label>            
                         <select name="class_id" id="class_id" class="form-control" required style="width:100% !important;">
                          <option value="">Select Class</option>
						  <?php 
                           if(!empty($classes)){                
                             foreach($classes as $cls){ ?>
                              <option value="{{ $cls->id }}"><?=$cls->name;?></option>                
                          <?php } } ?>  
                         </select>  
                        </div>

                        <div class="form-group">            
                          <label>Subject :</label>
                          <select name="subject" id="subject" class="form-control" required style="width:100% !important;">
                          <option value="">Select Subject</option>
						  <?php 
                          if(!empty($subjects)){               
                           foreach($subjects as $cls){  ?>
                            <option value="{{ $cls->id }}"><?=$cls->name;?></option>                
                          <?php } } ?>  
                          </select>  
                        </div>
						
						 <div class="form-group"> 
                            <label for="exampleInputEmail1" scope="col">Chapter :</label>           
				              <select name="chapter" id="chapter" class="form-control" required style="width:100% !important;">
				               <option value="">Select Chapter</option>
								<?php 
								 if(!empty($chapters)){								
								   foreach($chapters as $cls){	?>
								    <option value="{{ $cls->id }}"><?=$cls->name;?></option> 								
								<?php } } ?>	
				               </select>  
                            </div>
					
						<div class="form-group">
							<label for="exampleInputEmail1" scope="col">Concept:</label>
							<input type="text" name="concept" class="form-control" id="concept" placeholder="Enter Concept" required >
						</div>
						
						<div class="form-check form-check-radio form-check-inline">
						  <label class="form-check-label">
						  <input class="act_sts" checked="checked" type="radio" name="status" value="1"> Active
						  <span class="circle">
							<span class="check"></span>
						  </span>
						  </label>
						</div>
						<div class="form-check form-check-radio form-check-inline">
						  <label class="form-check-label">
						  <input class="act_sts" type="radio" name="status" value="0"> In Active
						  <span class="circle">
							<span class="check"></span>
						  </span>
						  </label>
						</div>      
					</div>
					
					<div class="modal-footer">
					 <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
					 <button id="consave" type="button" class="btn btn-sm btn-primary">Save</button>				 
					</div>
				</form>
			 </div>				
		</div>
	  </div>
  </div>	
  
  <!-- chpter Modal -->  
	<div class="modal fade" id="chmyModal" tabindex="-1" role="dialog" aria-labelledby="chmyModalLabel" aria-hidden="true" style="display: none;">
	 <div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header"><strong>Add New Chapter</strong>
			<div class="alert alert-success" id="add-new-alert" style="display:none"></div>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			</div>
			<div class="modal-body">			
			  <form id="mychp_form" method="POST">				   
				  <div class="card-body">
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
                        <label>Class :</label>            
                         <select name="class_id" id="classid" class="form-control" required style="width:100% !important;">
                          <option value="">Select Class</option> 
						   <?php 
                           if(!empty($classes)){                
                             foreach($classes as $cls){ ?>
                              <option value="{{ $cls->id }}"><?=$cls->name;?></option>                
                          <?php } } ?>  
                         </select>  
                        </div>

                        <div class="form-group">            
                          <label>Subject :</label>
                          <select name="subject" id="subject" class="form-control" required style="width:100% !important;">
                          <option value="">Select Subject</option> 
						  <?php 
                          if(!empty($subjects)){               
                           foreach($subjects as $cls){  ?>
                            <option value="{{ $cls->id }}"><?=$cls->name;?></option>                
                          <?php } } ?>  
                          </select>  
                        </div>
					
						<div class="form-group">
							<label for="exampleInputEmail1" scope="col">Chapter Name:</label>
							<input type="text" name="chapter" class="form-control" id="chapter" placeholder="Enter Chapter" required >
						</div>
						
						<div class="form-check form-check-radio form-check-inline">
						  <label class="form-check-label">
						  <input class="act_sts" checked="checked" type="radio" name="status" value="1"> Active
						  <span class="circle">
							<span class="check"></span>
						  </span>
						  </label>
						</div>
						<div class="form-check form-check-radio form-check-inline">
						  <label class="form-check-label">
						  <input class="act_sts" type="radio" name="status" value="0"> In Active
						  <span class="circle">
							<span class="check"></span>
						  </span>
						  </label>
						</div>      
					</div>
					
					<div class="modal-footer">
					 <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
					 <button id="chaptersave" type="button" class="btn btn-sm btn-primary">Save</button>				 
					</div>
				</form>
			 </div>				
		</div>
	  </div>
	</div>	
	
	<!-- Subject Modal -->  
	<div class="modal fade" id="smyModal" tabindex="-1" role="dialog" aria-labelledby="smyModalLabel" aria-hidden="true" style="display: none;">
	 <div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header"><strong>Add New Subject</strong>
			<div class="alert alert-success" id="add-new-alert" style="display:none"></div>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			</div>
			<div class="modal-body">			
			  <form id="mysubject_form" method="POST">				   
				  <div class="card-body">
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
							<label for="exampleInputEmail1" scope="col">Subject Name:</label>
							<input type="text" name="subject" class="form-control" id="subject" placeholder="Enter Subject" required >
						</div>
						<div class="form-check form-check-radio form-check-inline">
						  <label class="form-check-label">
						  <input class="act_sts" checked="checked" type="radio" name="status" value="1"> Active
						  <span class="circle">
							<span class="check"></span>
						  </span>
						  </label>
						</div>
						<div class="form-check form-check-radio form-check-inline">
						  <label class="form-check-label">
						  <input class="act_sts" type="radio" name="status" value="0"> In Active
						  <span class="circle">
							<span class="check"></span>
						  </span>
						  </label>
						</div>      
					</div>
					
					<div class="modal-footer">
					 <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
					 <button id="subjectsave" type="button" class="btn btn-sm btn-primary">Save</button>				 
					</div>
				</form>
			 </div>				
		</div>
	  </div>
	</div>
  <!-- Class Modal -->  
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	 <div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header"><strong>Add New Class</strong>
			<div class="alert alert-success" id="add-new-alert" style="display:none"></div>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			</div>
			<div class="modal-body">			
			  <form id="myclass_form" method="POST">
				   
				  <div class="card-body">
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
							<label for="exampleInputEmail1" scope="col">Class Name:</label>
							<input type="text" name="class_name" class="form-control" id="class_name" required placeholder="Enter Class" required >
						</div>
						<div class="form-check form-check-radio form-check-inline">
						  <label class="form-check-label">
						  <input class="act_sts" checked="checked" type="radio" name="status" value="1"> Active
						  <span class="circle">
							<span class="check"></span>
						  </span>
						  </label>
						</div>
						<div class="form-check form-check-radio form-check-inline">
						  <label class="form-check-label">
						  <input class="act_sts" type="radio" name="status" value="0"> In Active
						  <span class="circle">
							<span class="check"></span>
						  </span>
						  </label>
						</div>      
					</div>
					
					<div class="modal-footer">
					 <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
					 <button id="cls_save" type="button" class="btn btn-sm btn-primary">Save</button>				 
					</div>
				</form>
			 </div>				
		</div>
	  </div>
	</div> 

  <!--Add Activity Concept Modal-->
  
   <div class="modal fade" id="actconmyModal" tabindex="-1" role="dialog" aria-labelledby="conmyModalLabel" aria-hidden="true" style="width:100%;display: none;">
	 <div class="modal-dialog">
		<div class="modal-content" style="width: 800px;margin: 0px auto;">
		  <div class="modal-header"><strong>Add Activity Concept</strong>		  
		   <div class="alert alert-success" id="add-new-alert" style="display:none"></div>
			 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			</div>
			<div class="modal-body">
			<div class="col-md-10"><center>Please Select Activity</center></div>
			
			 <!--<form id="mychp_form" method="POST">				   
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
			 <div class="input-group control-group after-add-more">		
			  <div class="row" style="width:800px">
				<div class="col-md-2">
				 <div id="div_id_stock_1_service" class="form-group">
					<label for="id_stock_1_product" class="control-label  requiredField">
						Class <span class="asteriskField">*</span>
					</label>
					<div class="controls">
					 <select class="select form-control" id="id_class" name="class[]">
					 <option value="">--Select--</option>
					 <?php 
					   if(!empty($classes)){ ?>                      				   
					   <?php 
					     foreach($classes as $cls){ ?>
						  <option value="{{ $cls->id }}"><?=$cls->name;?></option>                
					  <?php } } ?>
					 </select>
					</div>
				 </div>
				</div>
				
				<div class="col-md-2">
				  <div id="div_id_stock_1_unit" class="form-group">
					<label for="id_stock_1_unit" class="control-label  requiredField">
						Subject <span class="asteriskField">*</span>
					</label>
					<div class="controls ">
					  <select class="select form-control" id="id_subject" name="subject[]">
						<option value="">--Select--</option>
						<?php 
						  if(!empty($allsubject)){               
						   foreach($allsubject as $sb){  ?>
							<option value="{{ $sb->id }}"><?=$sb->name;?></option>                
					  <?php } } ?>
					  </select>
					</div>
				  </div>
				</div>
				
				<div class="col-md-2">
				  <div id="div_id_stock_1_quantity" class="form-group">
					<label for="id_chapter" class="control-label  requiredField">
						Chapter <span class="asteriskField">*</span>
					</label>
					<div class="controls">
					 <select class="select form-control" id="id_chapter" name="chapter[]">
					  <option value="">--Select--</option>
					  <?php 
						 if(!empty($chapters)){								
						   foreach($chapters as $cls){	?>
							<option value="{{ $cls->id }}"><?=$cls->name;?></option> 								
					  <?php } } ?>	
					 </select>
					</div>
				  </div>
				</div>
				
				<div class="col-md-5">
				  <div id="div_concept" class="form-group">
					<label for="id_concept" class="control-label requiredField"> Concept <span class="asteriskField">*</span></label>
					<div class="controls">
					 <input type="text" id="concept" name="concept[]" class="form-control" placeholder="Enter Concept Here"> 
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
				<input class="" type="radio" name="status" id="inlineRadio2" value="0"> In Active
				<span class="circle">
					<span class="check"></span>
				</span>
			  </label>
			</div>
          </form>
	    </div>
		
		<div class="modal-footer">
		 <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
		 <button id="actconsave" type="button" class="btn btn-sm btn-primary">Save</button>				 
		</div>-->
		
	  </div>
	</div>
  </div>
</div> 
@endsection