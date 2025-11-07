@extends('admin.layouts.app')
@section('title', 'Goforfit Admin Add Activity')
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
				<a class="" href="{{ route('admin.activities.index') }}"> <i class="fas fa-long-arrow-alt-left"></i> Back </a>
				<div class="top-action-btns"> <button type="submit" class="btn btn-sm btn-primary" onclick="document.getElementById('add-activity').submit();">Submit</button> </div>
			</div>
		</div>
    
        
      </div>
    </section>
   	
	
    <section class="content">
      <div class="container-fluid">
        <div class="row">          
          <div class="col-md-12">          
            <div class="update-activity">
             
               <form method="POST" action="{{ route('admin.activities.store') }}" id="add-activity" enctype="multipart/form-data">
				   @csrf
				   
				   <!--<div class="card-body">-->					   
					<div class="row">	   
							
					
					
					 <div class="col-md-12">					 
					  <div class="card card-secondary">
						<div class="card-header"  data-card-widget="collapse" title="Collapse">
						  <h3 class="card-title">Add Activity</h3>
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
									<input type="text" name="title" class="form-control">
								</div> 
							
							
							
						
								<div class="form-group">
								  <label for="exampleInputEmail1" scope="col">Teaching Through</label><br>	
								   <?php 
									 $spt='';
									 $var='';
									 if(!empty($teaching)){								
									   foreach($teaching as $tch){					  
										 
										?>
										<div class="form-check form-check-radio form-check-inline">
										   <label class="form-check-label">
											<input class="form-check-input through_sport" type="checkbox" name="teaching_through[]" id="inlineRadio<?=$tch->id?>" value="{{ $tch->id }}"><?=$tch->name;?>
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
										<label>Image</label>		
										<input type="file" name="image" class="form-control" style="position:none !important;">
										 
									</div>
									</div>
									
								</div>
								</div>
							
						
						
								<div class="form-group">
									<label for="exampleInputEmail1" scope="col">Youtube URL</label>	
									<input type="text" name="url" class="form-control" placeholder="Enter URL">
								</div>
							
							
							
								<div class="form-group">
									<label>Learning Outcomes</label>							
									<textarea class="form-control" id="learning_outcomes" name="learning_outcomes" placeholder="Learning Outcomes"></textarea>
								</div>
							   
							

						   
						
								<div class="form-group">
									<label for="exampleInputEmail1" scope="col">Description</label>
									<textarea id="description" class="form-control" name="description" placeholder="Description"></textarea>
								</div>
							
							
						
								<div class="form-group">
								   <label for="exampleInputEmail1" scope="col">Variations</label>							  
										 <textarea class="form-control" id="variations" name="change_it" placeholder="Change it (Variations)"></textarea>
								</div>
							

						
						
							<div class="form-group">
								<label for="exampleInputEmail1" scope="col">Coaching (Teaching Tips)</label>							  
							    <textarea class="form-control" id="coaching" name="coaching" placeholder="Coaching (Teaching Tips)"></textarea>
                            </div>
							
							
                                 
						
						    <div class="form-group">
                                <label for="exampleInputEmail1" scope="col">Equipment:</label>	
							    <textarea class="form-control" id="equipment" name="equipment" placeholder="Equipment"></textarea>
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
						
											
					  </div>
				    <!--</div>-->
				   <div class="clearfix">&nbsp;</div>	
				  <div class="action-btns">
				   <button type="submit" class="btn btn-sm btn-primary">Submit</button>
				 </div>
				</form>					   
			 </div>
          </div>
        </div> 	   
      </div>
    </section>
  </div>

 

	
@endsection