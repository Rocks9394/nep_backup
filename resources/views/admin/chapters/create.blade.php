@extends('admin.layouts.app')
@section('title', 'Goforfit - Add Chapter')
@section('content')
<div class="content-wrapper" id="chapter-main">
    <section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-12">
					<a class="" href="{{ route('admin.chapters.index') }}"> <i class="fas fa-long-arrow-alt-left"></i> Back </a>     
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
					<h3 class="card-title">Add Chapter</h3>
				</div> 
				
				<form method="POST" action="{{ route('admin.chapters.store') }}" enctype="multipart/form-data">
					@csrf
					<div class="card-body">
						@if(session('success'))
							<div class="alert alert-success alert-dismissible fade show" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
								{{ session('success') }}
							</div>
						@endif
						
						@if ($errors->any())
							<div class="alert alert-danger alert-dismissible fade show" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
									@foreach ($errors->all() as $error)
										<div>{{ $error }}</div>
									@endforeach
							</div>
					   @endif		
					   
						
						<div class="row">          
							<div class="col-md-6"> 
								<div class="form-group">
									<label>Class*</label>  
									<select class="form-control selctopt @error('class_id') is-invalid @enderror" name="class_id" id="id_class0" onchange="getsubjects(0,this.value)">
										<option value="">Select Class</option>
										<?php if(!empty($classes)){                
											foreach($classes as $cls){ ?>
												<option value="{{ $cls->id }}" {{ old('class_id')==$cls->id ? 'selected' : '' }}><?=$cls->name;?></option>                
										<?php } } ?> 
									</select>
								</div>
							</div>
							
							<div class="col-md-6">
								<div class="form-group">
									<label>Subject*</label>
									<select name="subject_id" id="id_subject0" class="form-control @error('subject_id') is-invalid @enderror ">
									<option value="">Select Subject</option>
									<?php 
										if(!empty($subjects)){               
											foreach($subjects as $cls){  ?>
												<option value="{{ $cls->id }}" {{ old('subject_id')==$cls->id ? 'selected':'' }} > <?=$cls->name;?></option>                
									<?php } } ?>  
									</select>
								</div>
							</div>
						</div>
					

                    <div class="add_more_chapter">					
					  <div class="col-md-1">
					    <div class="form-group">						
						 <div class="controls">
						   <button class="btn btn-success add_chapter" type="button"><i class="fa fa-plus-circle" aria-hidden="true"></i></button>
						 </div>
					    </div>
					  </div>
					  
					  <div class="callout add-chapters" id="add_chapters_div">
						<div class="row">          
							<div class="col-md-12"> 
								<div class="form-group">
									<label>Chapter*</label>
									<input type="text" name="name[0]" class="form-control @error('name[0]') is-invalid @enderror" placeholder="Enter Chapter" value="{{ old('name[0]') }}">
								</div>
							</div>
						</div>
						
						<div class="row">          
							<div class="col-md-6">
								<div class="form-group">
									<label>Upload Image*</label>            
									<input type="file" name="image[0]" class="form-control @error('image[0]') is-invalid @enderror">
								</div>
							</div>
							<div class="col-md-6"> 
								<div class="form-group">
									<label>External Video Link URL(Youtube)</label>               
									<input type="text" name="url[0]" class="form-control" placeholder="Enter URL" value="{{ old('url[0]') }}">
								</div>
							</div>
						</div>
						
						<div class="row">          
							<div class="col-md-6">
								<div class="form-group">
									<label>Upload PDF*</label>            
									<input type="file" name="file[0]" class="form-control @error('file[0]') is-invalid @enderror">
								</div>
							</div>
							<div class="col-md-6"> 
								<div class="form-group">
									<label>External PDF(Any Source)</label>               
									<input type="text" name="link[0]" class="form-control" placeholder="Enter PDF Link" value="{{ old('link[0]') }}">
								</div>
							</div>
						</div>
							
                       
						<div class="row">          
							<div class="col-md-12">
							<div class="form-group">							
								<label>Learning Outcomes*</label>
								<textarea id="learning_outcomes" class="form-control mytextarea @error('learning_outcomes[0]') is-invalid @enderror" name="learning_outcomes[0]" placeholder="Enter Learning Outcomes">{{ old('learning_outcomes[0]') }}</textarea>
								</div>
							</div>
						</div>
						
						<div class="row">          
							<div class="col-md-12"> 
							<div class="form-group">							
								<label>Description*</label>
								<textarea id="description" class="form-control mytextarea @error('description[0]') is-invalid @enderror" name="description[0]" placeholder="Description">{{ old('description[0]') }}</textarea>
							</div>
							</div>
						</div>		
				       
						<div class="row">          
							<div class="col-md-6">
							<div class="form-group">
								<label>Chapter Order*</label>
								<select name="order[0]" id="order" class="form-control @error('order[0]') is-invalid @enderror" style="width:120px !important;">
								<option value="">Select</option>
									<?php for($i=1;$i<=20;$i++){ ?>
										<option value="<?=$i?>"  {{ old('order[0]')== $i ? 'selected' : '' }} ><?=$i?></option>
									<?php } ?>
								</select>
							</div> 
							</div>
						  
						  <div class="col-md-6">
							<div class="form-group">
								<label>Status </label><br>
								<div class="form-check form-check-radio form-check-inline">
									<label class="form-check-label">
										<input class="form-check-input" checked="checked" type="radio" name="status[0]" id="inlineRadio1" value="1">Active
										<span class="circle">
											<span class="check"></span>
										</span>
									</label>
								</div>
								<div class="form-check form-check-radio form-check-inline">
									<label class="form-check-label">
									<input class="form-check-input" type="radio" name="status[0]" id="inlineRadio2" value="0"> Inactive
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
				  </div>
				  
				 <div class="card-footer">
				   <button type="submit" class="btn btn-sm btn-primary">Submit</button>
				 </div>
				</form>
            </div>
			
          </div>
        </div>
	 </div>
    </section>
	<script>
	  $(document).ready(function(){    
		var chp = 1; 
		$(".add_chapter").click(function(){ 
		    //alert('kk');
			$(".add_more_chapter").append('<div class="callout add-chapters" id="add_chapters_div'+chp+'"><div class="form-group"><button class="btn btn-danger remove removechp" id="'+chp+'" type="button"><i class="fa fa-minus-circle" aria-hidden="true"></i></button></div><div class="row"><div class="col-md-11"><div class="form-group"><label>Chapter*</label><input type="text" name="name['+chp+']" class="form-control @error("name'+chp+'") is-invalid @enderror" placeholder="Enter Chapter" value="{{ old("name'+chp+'") }}"></div></div></div><div class="row"><div class="col-md-6"><div class="form-group"><label>Upload Image*</label><input type="file" name="image['+chp+']" class="form-control @error("image'+chp+'") is-invalid @enderror"></div></div><div class="col-md-6"><div class="form-group"><label>External Video Link URL(Youtube)</label><input type="text" name="url['+chp+']" class="form-control" placeholder="Enter URL" value="{{ old("url'+chp+'") }}"></div></div></div><div class="row"><div class="col-md-12"><div class="form-group"><label>Learning Outcomes*</label><textarea id="learning_outcomes'+chp+'" name="learning_outcomes['+chp+']" class="form-control mytextarea @error("learning_outcomes'+chp+'") is-invalid @enderror" placeholder="Enter Learning Outcomes">{{ old("learning_outcomes'+chp+'") }}</textarea></div></div></div><div class="row"><div class="col-md-12"><div class="form-group"><label>Description*</label><textarea id="description'+chp+'" name="description['+chp+']" class="form-control mytextarea @error("description'+chp+'") is-invalid @enderror" placeholder="Description">{{ old("description'+chp+'") }}</textarea></div></div></div><div class="row"><div class="col-md-6"><div class="form-group"><label>Chapter Order*</label><select name="order['+chp+']" id="order" class="form-control @error("order'+chp+'") is-invalid @enderror" style="width:120px !important;"><option value="">Select</option><?php for($i=1;$i<=20;$i++){ ?><option value="<?=$i?>"  {{ old("order'+chp+'")== $i ? "selected" : '' }} ><?=$i?></option><?php } ?></select></div></div><div class="col-md-6"><div class="form-group"><label>Status </label><br><div class="form-check form-check-radio form-check-inline"><label class="form-check-label"><input class="form-check-input" checked="checked" type="radio" name="status['+chp+']" id="inlineRadio1" value="1">Active<span class="circle"><span class="check"></span></span></label></div><div class="form-check form-check-radio form-check-inline"><label class="form-check-label"><input class="form-check-input" type="radio" name="status['+chp+']" id="inlineRadio2" value="0"> Inactive<span class="circle"><span class="check"></span></span></label></div></div></div></div></div>');
		
 			 ClassicEditor.create(document.querySelector('#learning_outcomes'+chp+''));
	         ClassicEditor.create(document.querySelector('#description'+chp+''));			
			
			 chp++; 	
		});

	   $('.add_more_chapter').on('click','.removechp', function(e){
		e.preventDefault();
		   //alert('kk');
		   var button_id = $(this).attr("id");
		   //alert(button_id);
			$("#add_chapters_div"+button_id+"").remove();
		});   
	  });         
	</script> 
    <style>
	 .ck-editor__editable {
		min-height: 150px;
	 }
	</style>
 </div>
@endsection