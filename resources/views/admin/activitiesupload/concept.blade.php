@extends('admin.layouts.app')
@section('title', 'Goforfit Concepts')
@section('content')
<style>
.mb-3{ margin-bottom: 0 !important; margin-right: 10px; }
.btn-sm{ padding: .375rem .75rem; }
.rtside{ float:right; }
</style>
<div class="content-wrapper">
  <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <a class="" href=""> <i class="fas fa-long-arrow-alt-left"></i> Back </a>     
           
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
             
            </ol>
          </div>      
        </div>
      </div><!-- /.container-fluid -->
    </section>
 
    <section class="content">
      <div class="container-fluid">
        <div class="row">          
          <div class="col-md-12">          
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Import Concept</h3>
              </div>
              
			  
			   <div class="card-body">
                    @if(session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
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
              <form action="{{ route('admin.conceptimport') }}" method="POST" enctype="multipart/form-data">
                 @csrf
               
                            
							<div class="row">          
								<div class="col-md-4"> 
									<div class="form-group">
										<label>Class*</label>  
										<select class="form-control selctopt @error('class_id') is-invalid @enderror" required  name="class_id" id="id_class0" onchange="getsubjects(0,this.value)">
											<option value="">Select Class</option>
											<?php if(!empty($classes)){                
												foreach($classes as $cls){ ?>
													<option value="{{ $cls->id }}" {{ old('class_id')==$cls->id ? 'selected':'' }}><?=$cls->name;?></option>                
											<?php 	} } ?> 
										</select>
									</div>
								</div>
								
								<div class="col-md-4">
									<div class="form-group">
										<label>Subject*</label>
										<select name="subject_id" id="id_subject0" required class="form-control @error('subject_id') is-invalid @enderror " onchange="getchapters(0,this.value)">
										<option value="">Select Subject</option>
										<?php 
											if(!empty($subjects)){               
												foreach($subjects as $cls){  ?>
													<option value="{{ $cls->id }}" {{ old('subject_id')==$cls->id ? 'selected' : '' }} > <?=$cls->name;?></option>                
										<?php } } ?>  
										</select>
									</div>
								</div>
								
								<div class="col-md-4">
								<div class="form-group">
									<label>Chapter*</label>
									<select name="chapter_id" id="id_chapter0" class="form-control @error('subject_id') is-invalid @enderror ">
									<option value="">Select Chapter</option>
									<?php 
										if(!empty($chapters)){               
											foreach($chapters as $cls){  ?>
												<option value="{{ $cls->id }}" {{ old('chapter_id')==$cls->id ? 'selected':'' }} > <?=$cls->name;?></option>                
									<?php } } ?>  
									</select>
								</div>
							    </div>
								
							   <div class="col-md-12">
									<div class="form-group">
									  <input type="file" name="file" required class="form-control" accept=".xlsx, .xls, .csv"/>
							        </div>
								</div>
							</div>
                        </div>
                    <div class="card-footer">
					
                      <button class="btn btn-primary btn-sm">Import Concept</button> 
					  
                    </div>
              </form>
			  <P style="color:blue;">Please download the excel format to upload concepts details accordingly<a href=" {{ asset('resources/images/concept_demo.xlsx') }}" target="_blank">
					  <button class="btn btn-primary">Download</button></a>  </P> 
            </div>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection