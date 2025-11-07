@extends('admin.layouts.app')
@section('title', 'Goforfit Activity Weakness')
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
            <a class="" href="{{ route('admin.actweakness.index') }}"> <i class="fas fa-long-arrow-alt-left"></i> Back </a>     
            <h1 scope="col">Add Activity Weakness</h1>
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
              <li class="breadcrumb-item active"aria-current="page">Activity Weakness</li>
            </ol>
          </div>
      
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add Activity Weakness</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="{{ route('admin.actweakness.store') }}" enctype="multipart/form-data">
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
							<h4 class="card-title"> Activity</h4>
							 <select name="activity_id" id="activity_id" class="form-control">
							 	<option>Select Activity</option>
							   <?php 
								 if(!empty($activity)){								
								   foreach($activity as $act){	?>
									<option value="{{ $act->id }}"><?=$act->title;?></option> 
								<?php } } ?>	
							 </select>	
						</div>


						<div class="form-group">	
						 <h4 class="card-title"> Weakness</h4><br>						
						   <?php 
                             $i=0;
                            $weakness=array('Present','Foundation','Intermediate');
							
							 if(!empty($weakness)){								
							   foreach($weakness as $tch){
                                //echo "";print_r($tch);	die;							   
							    $i++;
								
								$chk=!empty($tch=='Present')&&($i==1) ? 'checked="checked"' : '';
							  ?>
								<div class="form-check form-check-radio form-check-inline">
								  <label class="form-check-label">
									<input class="form-check-input" <?=$chk?> type="radio" name="weakness_type" id="weakness_type" value="{{ $tch }}"><?=$tch;?>
									<span class="circle">
										<span class="check"></span>
									</span>
								  </label>
								</div>									
							<?php } } ?>							
						</div>	

						<div class="form-group">						
						<h4 class="card-title"> Class</h4><br>
						 <select name="class_id" id="class_id" class="form-control" style="width:100% !important;">
						   <?php 
							 if(!empty($classes)){								
							   foreach($classes as $cls){	?>
								<option value="{{ $cls->id }}"><?=$cls->name;?></option> 								
							<?php } } ?>	
						 </select>	
						</div>

							<div class="form-group">						
							    <h4 class="card-title"> Subjects</h4><br>
								 <select name="subject_id" id="subject_id" class="form-control" style="width:100% !important;">
								   <?php 
									 if(!empty($subjects)){								
									   foreach($subjects as $cls){	?>
									    <option  value="{{ $cls->id }}"><?=$cls->name;?></option> 								
									<?php } } ?>	
								 </select>	
	                        </div>

	                        <div class="form-group">	
		                        <h4 class="card-title"> Chapters</h4><br>
								<select name="chapters" id="chapters" class="form-control" style="width:100% !important;">
								  <option value="">Select Chapters</option> 
								   <?php 
									 if(!empty($chapters)){								
									   foreach($chapters as $cls){	?>
									    <option value="{{ $cls->id }}"><?=$cls->name;?></option> 								
									<?php } } ?>	
								</select>
							</div>

							<div class="form-group">
								<h4 class="card-title">Concepts</h4><br>
									 <select name="concepts" id="kconcepts" class="form-control" style="width:100% !important;">
									   <option value="">Select Concepts</option>
									 </select>	
								
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
                        </div>
                        <!-- /.card-body -->

                    <div class="card-footer">
                      <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                    </div>
              </form>
            </div>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection