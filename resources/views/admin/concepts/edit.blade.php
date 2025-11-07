@extends('admin.layouts.app')
@section('title', 'Goforfit - Update Concept')
@section('content')
<div class="content-wrapper" id="concept-main">
    <section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-12">
					<a class="" href="{{ route('admin.concepts.index') }}"> <i class="fas fa-long-arrow-alt-left"></i> Back </a>     
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
					<h3 class="card-title">Update Concept/Learning Objectives</h3>
				</div> 
				
				<form method="POST" action="{{ route('admin.concepts.update', $concepts->id) }}" enctype="multipart/form-data">
					@csrf
                    @method('PATCH')
					
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
							<div class="col-md-4"> 
								<div class="form-group">
									<label>Class*</label>  
									<select class="form-control selctopt @error('class_id') is-invalid @enderror" name="class_id" id="id_class0" onchange="getsubjects(0,this.value)">
										<option value="">Select Class</option>
										<?php if(!empty($classes)){                
											foreach($classes as $cls){ ?>
												<option value="{{ $cls->id }}" <?=$cls->id == $concepts->class_id ? ' selected="selected"' : '';?>><?=$cls->name;?></option>                
										<?php 	} } ?> 
									</select>
								</div>
							</div>
							
							<div class="col-md-4">
								<div class="form-group">
									<label>Subject*</label>
									<select name="subject_id" id="id_subject0" class="form-control @error('subject_id') is-invalid @enderror " onchange="getchapters(0,this.value)">
									<option value="">Select Subject</option>
									<?php 
										if(!empty($subjects)){               
											foreach($subjects as $cls){  ?>
												<option value="{{ $cls->id }}" <?=$cls->id == $concepts->subject_id ? ' selected="selected"' : '';?>  > <?=$cls->name;?></option>                
									<?php } } ?>  
									</select>
								</div>
							</div>
							
							<div class="col-md-4">
								<div class="form-group">
									<label>Chapter*</label>
									<select name="chapter_id" id="id_chapter0" class="form-control @error('chapter_id') is-invalid @enderror ">
									<option value="">Select Chapter</option>
									<?php 
										if(!empty($chapters)){               
											foreach($chapters as $cls){  ?>
												<option value="{{ $cls->id }}" <?=$cls->id == $concepts->chapter_id ? ' selected="selected"' : '';?>  > <?=$cls->name;?></option>                
									<?php } } ?>  
									</select>
								</div>
							</div>
							
						</div>
						
						<div class="add-concepts" id="add-concepts-div">
						<div class="row">          
							<div class="col-md-12"> 
								<div class="form-group">
									<label>Concept/Learning Objectives*</label>
									<input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Concept" value="{{ $concepts->name }}">
								</div>
							</div>
						</div>
						
						<div class="row">          
							<div class="col-md-6">
								<div class="form-group">
									<label>Upload Image*</label>            
									<input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
									@if(Illuminate\Support\Str::contains( $concepts->image,'storage/app/public/uploads'))
										<img src="{{ $concepts->image }}" width="100" height="100">
									@elseif(!empty($concepts->image))
									  <img src="{{ asset('public/uploads').'/'.$concepts->image }}" alt="image" width="100" height="100">
									  @else
									  <img src="{{ asset('public/uploads').'/images.jpg' }}" alt="image" width="75"> 
									@endif 
								</div>
							</div>
							<div class="col-md-6"> 
								<div class="form-group">
									<label>External Video Link URL(Youtube)</label>               
									<input type="text" name="url" class="form-control" placeholder="Enter URL" value="{{ $concepts->url }}">
								</div>
							</div>
						</div>
							
                       
						<div class="row">          
							<div class="col-md-12">
							<div class="form-group">							
								<label>Learning Objectives*</label>
								<textarea id="learning_outcomes" class="form-control mytextarea @error('learning_outcomes') is-invalid @enderror" name="learning_outcomes" placeholder="Learning Objectives">{{ $concepts->learning_outcomes }}</textarea>
								</div>
							</div>
						</div>
						
						<div class="row">          
							<div class="col-md-12"> 
							<div class="form-group">							
								<label>Learning Outcome</label>
								<textarea id="description" class="form-control mytextarea @error('description') is-invalid @enderror" name="description" placeholder="Learning Outcome">{{ $concepts->description }}</textarea>
							</div>
							</div>
						</div>
					  
						  
			
				       
						<div class="row">          
							<div class="col-6 col-sm-4 col-md-3">
							<div class="form-group">
								<label>Concept Order*</label>
								<select name="order" id="order" class="form-control @error('order') is-invalid @enderror" style="width:120px !important;">
								<option value="">Select</option>
									<?php for($i=1;$i<=20;$i++){ ?>
										<option value="<?=$i?>" <?=($concepts->order==$i ? 'selected="selected"' : '' )?> ><?=$i?></option>
									<?php } ?>
								</select>
							</div> 
							</div>
						  
						  <div class="col-6 col-sm-4 col-md-3">
							<div class="form-group">
								<label>Status </label><br>
								<div class="form-check form-check-radio form-check-inline">
									<label class="form-check-label">
										<input class="form-check-input" type="radio" name="status" id="inlineRadio1" value="1"  <?=$concepts->status=="1" ? "checked" : "" ?> >Active
										<span class="circle">
											<span class="check"></span>
										</span>
									</label>
								</div>
								<div class="form-check form-check-radio form-check-inline">
									<label class="form-check-label">
									<input class="form-check-input" type="radio" name="status" id="inlineRadio2" value="0" <?=$concepts->status=="0" ? "checked" : "" ?> > Inactive
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
        
    </script>
	<style>
	.ck-editor__editable {
		min-height: 150px;
	}
	</style>

</div>
@endsection