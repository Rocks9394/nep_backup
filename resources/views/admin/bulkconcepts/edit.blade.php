@extends('admin.layouts.app')
@section('title', 'Goforfit Admin-All Concept')
@section('content')
<div class="content-wrapper"> 
   
    <section class="content-header">
      <div class="container-fluid">
     <div class="row mb-2">
      <div class="col-sm-12">       
    <a class="" href="{{ route('admin.bulkconcepts.index') }}"> <i class="fas fa-long-arrow-alt-left"></i> Back </a>
      <h1>Edit Concepts</h1>
      </div>
     </div>
    
        <div class="row mb-2">          
          <div class="col-sm-12">
            <ol class="breadcrumb float-sm-left">                
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active"aria-current="page">bulkconcepts</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

      @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <section class="content">
      <div class="container-fluid">
        <div class="row">          
          <div class="col-md-12">           
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Edit bulkconcepts</h3>
              </div>             
              <form method="POST" action="{{ route('admin.bulkconcepts.update', $concept->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
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
                              <label for="exampleInputEmail1" scope="col">Class:</label>            
                               <select name="class_id" id="class_id" class="form-control" required style="width:100% !important;">
                                 <?php 
                                 if(!empty($classes)){               
                                   foreach($classes as $cls){ ?>
                                    <option <?=$cls->id == $concept->class_id ? ' selected="selected"' : '';?> value="{{ $cls->id }}"><?=$cls->name;?></option>                
                                <?php } } ?>  
                               </select>  
                            </div>

                            <div class="form-group">
                            <label for="exampleInputEmail1" scope="col">Subjects:</label>
                             <select name="subjects" id="subjects" class="form-control" required style="width:100% !important;">
                               <?php 
                               if(!empty($subjects)){               
                                 foreach($subjects as $cls){  ?>
                                  <option <?=$cls->id == $concept->subject_id ? ' selected="selected"' : '';?> value="{{ $cls->id }}"><?=$cls->name;?></option>                
                              <?php } } ?>  
                             </select>  
                            </div>

                            <div class="form-group">  
                            <label for="exampleInputEmail1" scope="col">Chapter:</label>          
                             <select name="chapter" id="chapter" class="form-control" required style="width:100% !important;">
                               <?php 
                               if(!empty($concept)){               
                                 foreach($chapters as $cls){  ?>
                                  <option <?=$cls->id == $concept->chapter_id ? ' selected="selected"' : '';?> value="{{ $cls->id }}"><?=$cls->name;?></option>                 
                              <?php } } ?>  
                             </select>  
                            </div>
							
							 <div class="form-group">
                              <label for="exampleInputEmail1" scope="col">URL:</label>
                               <input type="text" name="url" value="{{ $concept->url }}" class="form-control" placeholder="Enter URL">
                            </div>
							
							 <div class="form-group">
								<label for="exampleInputEmail1" scope="col">Concept:</label> 
								<input type="text" name="title[]" value="{{ $concept->name }}" required class="form-control" placeholder="Enter Chapter">
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
										  <textarea class="form-control" id="learning_outcomes" name="learning_outcomes[]" value="{{ $concept->learning_outcomes }}" placeholder="Enter Learning Outcomes">
										  </textarea>
										</div>
									  </div>
									</div>
								</div>
							   </section>						  
							 <div class="form-group">
								<label for="exampleInputEmail1" scope="col">Upload:</label>
								<input type="file" name="image[]" class="form-control" style="position:none !important;">
								<input type="hidden" name="hidden_image" value="{{ $concept->image }}">
								@if(!empty($concept->image))
								<img src="{{ asset('public/uploads').'/'.$concept->image }}" width="100" height="100">
								@else
								<img src="{{ asset('public/uploads').'/default.jpg' }}" width="75" height="75">
								@endif  
							  </div>
							  <section class="content">
							   <div class="row">
								<div class="col-md-12">
								  <div class="card card-outline card-info">
									<div class="card-header">
									  <label for="exampleInputEmail1" scope="col">Description :</label>
									  <textarea class="form-control" id="l-outcome" name="description[]" placeholder="Enter your Description"><?=$concept->description;?></textarea>
									</div>
								  </div>
								</div>
							   </div>
							  </section>
							  <!--<div class="form-group">
								 <label class="form-check-label pull-right"><button type="button" name="add" id="add" class="add_bulkconcept btn btn-sm btn-success pull-right"><i class="fa fa-plus-circle pull-right" aria-hidden="true"> Add More</i></button></label>
							   </div>-->
							</div>
							
                            <!--<div class="clearfix">&nbsp;</div>
							<div class="form-group">
							   <label class="form-check-label pull-right"><button type="button" name="add" id="add" class="btn btn-sm btn-success pull-right"><i class="fa fa-plus-circle pull-right" aria-hidden="true"> Add More</i></button></label>
							</div>-->
							
                            <div class="form-check form-check-radio form-check-inline">
                              <label class="form-check-label">
                              <input class="form-check-input" checked="checked" type="radio" name="status" id="inlineRadio1" value="1" <?=$concept->status=="1" ? "checked" : "" ?>>Active
                              <span class="circle">
                                <span class="check"></span>
                              </span>
                              </label>
                            </div>
                            <div class="form-check form-check-radio form-check-inline">
                              <label class="form-check-label">
                              <input class="form-check-input" type="radio" name="status" id="inlineRadio2" value="0" <?=$concept->status=="0" ? "checked" : "" ?>> In Active
                              <span class="circle">
                                <span class="check"></span>
                              </span>
                              </label>
                            </div>      
                        </div>
                <!-- /.card-body -->

                  <div class="card-footer">
                    <button type="submit" class="btn btn-sm btn-primary"><?=!empty($class->id) ? "Update" : "Update" ?></button>
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