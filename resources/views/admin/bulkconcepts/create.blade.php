@extends('admin.layouts.app')
@section('title', 'Goforfitk Admin-All Concept')
@section('content')
<style>
.mb-3{ margin-bottom: 0 !important; margin-right: 10px; }
.btn-sm{ padding: .375rem .75rem; }
.rtside{ float:right; }
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <a class="" href="{{ route('admin.bulkconcepts.index') }}"> <i class="fas fa-long-arrow-alt-left"></i> Back </a>     
            <h1 scope="col">Add bulkconcepts</h1>
          </div>
    </div>        
    <div class="row mb-2">  
          <div class="col-sm-12">
            <ol class="breadcrumb float-sm-right">
                <div class="pull-right">
                    
                </div>              
            </ol>
          </div>      
          <div class="col-sm-12">
            <ol class="breadcrumb float-sm-left">               
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active"aria-current="page">bulkconcepts</li>
            </ol>
          </div>     
        </div>
      </div><!-- /.container-fluid -->
    </section>
   
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add Bulk Concepts</h3>
              </div>
              <form method="POST" action="{{ route('admin.bulkconcepts.store') }}" enctype="multipart/form-data">
                      @csrf
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
                       <label for="exampleInputEmail1" scope="col">Class :</label>           
					   <select name="class_id" id="class_id" class="form-control" required style="width:100% !important;">
						 <?php 
						 if(!empty($classes)){								
						   foreach($classes as $cls){	?>
							<option value="{{ $cls->id }}"><?=$cls->name;?></option> 								
						<?php } } ?>  
					   </select>  
                    </div>
					
					<div class="form-group"> 
					 <label for="exampleInputEmail1" scope="col">Subjects :</label>            
					   <select name="subjects" id="subjects" class="form-control" required style="width:100% !important;">
						 <?php 
						 if(!empty($subjects)){								
						   foreach($subjects as $cls){	?>
							<option  value="{{ $cls->id }}"><?=$cls->name;?></option> 								
						<?php } } ?>
					   </select>  
					</div>
					
					<div class="form-group"> 
					<label for="exampleInputEmail1" scope="col">Chapter :</label>
					   <select name="chapter" id="chapter" class="form-control" required style="width:100% !important;">
						  <?php 
								 if(!empty($chapters)){								
								   foreach($chapters as $cls){	?>
									<option value="{{ $cls->id }}"><?=$cls->name;?></option> 			
								<?php } } ?>	
					   </select>  
					</div>

					<div class="form-group">
					 <label for="exampleInputEmail1" scope="col">Concept :</label>
					 <input type="text" name="title[]" class="form-control" placeholder="Enter Concept" required >
					</div>
					
					<div class="bulkaddmore">
					    <div class="form-group">
						 <label class="form-check-label pull-right"><button type="button" name="add" id="add" class="add_bulkconcept btn btn-sm btn-success pull-right"><i class="fa fa-plus-circle pull-right" aria-hidden="true"> Add More</i></button></label>
					    </div>
						<section class="content">
						  <div class="row">
							<div class="col-md-12">
							  <div class="card card-outline card-info">
								<div class="card-header">
								  <label for="exampleInputEmail1" scope="col">Learning Outcomes :</label>
								  <textarea class="form-control" id="learning_outcomes" name="learning_outcomes[]" placeholder="Enter Learning Outcomes">
								  </textarea>
								</div>
							  </div>
							</div>
						  </div>
						</section>
				  
					  <div class="form-group">
						 <label for="image" scope="col">Image :</label>
						 <input type="file" name="image[]" class="form-control" style="position:none !important;">
					  </div>

					   <section class="content">
						  <div class="row">
							<div class="col-md-12">
							  <div class="card card-outline card-info">
								<div class="card-header">
								  <label for="exampleInputEmail1" scope="col">Description :</label>
								  <textarea class="form-control" id="l-outcome" name="description[]" placeholder="Enter your Description">
								  </textarea>
								</div>
							  </div>
							</div>
						  </div>
						</section>
					  
					</div>
					
					<div class="form-check form-check-radio form-check-inline">
					  <label class="form-check-label">
					  <input class="form-check-input" checked="checked" type="radio" name="status" id="inlineRadio1" value="1">Active
					  <span class="circle">
						<span class="check"></span>
					  </span>
					  </label>
					</div>
					<div class="form-check form-check-radio form-check-inline">
					  <label class="form-check-label">
					  <input class="form-check-input" type="radio" name="status" id="inlineRadio2" value="0"> In Active
					  <span class="circle">
						<span class="check"></span>
					  </span>
					  </label>
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
  </div> 
@endsection