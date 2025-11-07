@extends('admin.layouts.app')
@section('title', 'Goforfit Activity Weakness')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
     <div class="row mb-2">
      <div class="col-sm-12">       
    <a class="" href="{{ route('admin.actweakness.index') }}"> <i class="fas fa-long-arrow-alt-left"></i> Back </a>
      <h1>Edit Active Weakness</h1>
      </div>
     </div>
    
        <div class="row mb-2">          
          <div class="col-sm-12">
            <ol class="breadcrumb float-sm-left">                
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active"aria-current="page">Active Weakness</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
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


    <!-- Main content -->
    
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Edit Active Weakness</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="{{ route('admin.actweakness.update', $weakness->id) }}" enctype="multipart/form-data">
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
							<h4 class="card-title"> Activity</h4>
							 <select name="activity_id" id="activity_id" class="form-control" style="width:100% !important;">
							   <?php 
								 if(!empty($activity)){								
								   foreach($activity as $act){
	                              
								    $achk=!empty($act->id)&&($act->id==$weakness->activity_id) ? 'selected="selected"' : '';
								
								?>
									<option <?=$achk?> value="{{ $act->id }}"><?=$act->title;?></option> 								
								<?php } } ?>	
							 </select>	
							</div>

							<div class="form-group">	
							 <h4 class="card-title"> Weakness</h4><br>							
							   <?php 
	                             $pweakness=array('Present','Foundation','Intermediate');							
								 if(!empty($pweakness)){								
								   foreach($pweakness as $tch){
									$chk=!empty($tch)&&($tch==$weakness->weakness_type) ? 'checked="checked"' : '';
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
							<h4 class="card-title"> Classes</h4>
							<select name="class_id" id="class_id" class="form-control" style="width:100% !important;">				 
							 <?php			    
								 if(!empty($classes)){								
								   foreach($classes as $klas){
							 ?>	
							  <option <?=$klas->id == $weakness->class_id ? ' selected="selected"' : '';?> value="<?=$klas->id?>"><?=$klas->name?></option>
							 <?php } } ?>	
							</select>
							</div>

							<div class="form-group">						
							<h4 class="card-title"> Subjects</h4>
							 <select name="subject_id" id="subject_id" class="form-control" style="width:100% !important;">
							   <option value="">Select Subjects</option> 
							   <?php 
								 if(!empty($subjects)){								
								   foreach($subjects as $scls){									
								?>
							   <option <?=$scls->id == $weakness->subject_id ? ' selected="selected"' : '';?> value="<?=$scls->id?>"><?=$scls->name?></option>
							 <?php } } ?>	
							</select>	
							</div>	
							<div class="form-group">			
								<h4 class="card-title"> Chapters</h4>
								<select name="chapters" id="chapters" class="form-control" style="width:100% !important;">
								  <option value="">Select Chapters</option>   
								   <?php 
									 if(!empty($chapters)){								
									   foreach($chapters as $chp){ 
									?>
									 <option <?=$chp->id == $weakness->chapter_id ? ' selected="selected"' : '';?> value="<?=$chp->id?>"><?=$chp->name?></option>
									<?php } } ?>	
								</select>
								</div>

								<div class="form-group">						
								 <h4 class="card-title">Concepts</h4>
								 <select name="concepts" id="kconcepts" class="form-control" style="width:100% !important;">
									<option value="">Select Concepts</option>  
									<?php 							    
									 if(!empty($concepts)){								
									   foreach($concepts as $cnc){ ?>
										<option <?=$cnc->id == $weakness->concept_id ? ' selected="selected"' : '';?> value="{{ $cnc->id }}"><?php echo $cnc->name;?></option> 								
									<?php } } ?>	
							     </select>	   
								</div>    
								<div class="form-check form-check-radio form-check-inline">
								  <label class="form-check-label">
									<input class="form-check-input" type="radio" name="status" id="inlineRadio1"
									value="1" <?=$weakness->status=="1" ? "checked" : "" ?>>Active
									<span class="circle">
										<span class="check"></span>
									</span>
								  </label>
								</div>
								<div class="form-check form-check-radio form-check-inline">
								  <label class="form-check-label">
									<input class="form-check-input" type="radio" name="status" id="inlineRadio2" 
									value="0" <?=$weakness->status=="0" ? "checked" : "" ?>> In Active
									<span class="circle">
										<span class="check"></span>
									</span>
								  </label>
								</div>     
                        </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-sm btn-primary"><?=!empty($class->id) ? "Update" : "Insert" ?></button>
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