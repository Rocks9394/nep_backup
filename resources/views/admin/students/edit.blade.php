@extends('admin.layouts.app')
@section('title', 'Update Student - Goforfit')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          
            <div class="col-sm-6">
           <a class="" href="{{ route('admin.students.index') }}"> <i class="fas fa-long-arrow-alt-left"></i> Back </a>
         
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
			@if (session('msg'))
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
              <div class="card-header">
                <h3 class="card-title">Update Teacher</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="{{ route('admin.students.update', $result->id) }}">
					  @csrf
					  @method('PATCH')
					  <input type="hidden" name="user_id" value="{{$result->user_id}}">
					  <div class="card-body">					   
					   <div class="row">					   
					    				   
					    
						  <div class="col-md-6">	
						  <div class="form-group row"id="school"  >
						<label for="state" class="col-md-4 col-form-label text-md-right">School Name</label>
						
						<select class="form-control select2" name="school_name" class="form-control @error('school_name') is-invalid @enderror" aria-required="true">
						<option selected="selected">Select Schools</option>
						
						<?php
                                    foreach($schools as $school){
                                //echo "<pre>";print_r($st->name);
                              if(strtolower(trim($school->school_name)) == strtolower(trim($result->school_name)))
                                 {
                                      $ksel= 'selected';
 
                                        } else {
                                        $ksel = '';
                                  
                                         } 
                                        ?>  
                                

                        <option value="{{$school->id}}" <?=$ksel?>>{{ $school->school_name }}</option>                              
                                      <?php } ?>
						</select>
						</div>
					</div>
					
						   						
						
						<div class="col-md-6">	
					<div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $result->name }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
                    </div>
					</div>
						
						<div class="col-md-6">	
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $result->email }}" required autocomplete="email"  readonly>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
                        </div>
						</div>
						
						<div class="col-md-6">	
						 <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>

                            
                                <input id="phone" type="mobile" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{$result->phone }}" required autocomplete="phone">

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                           
                        </div>
						</div>
						
						
						<div class="col-md-6">	
						<div class="form-group row">
                     
                        <label for="state" class="col-md-4 col-form-label text-md-right">{{ __('State') }}</label>
						
                        <select id="state" name="state" class="form-control @error('state') is-invalid @enderror" aria-required="true">
						
                            <option value="">Select State</option>
							
							<?php
                                    foreach($states as $st){
                                //echo "<pre>";print_r($st->name);
                              if(strtolower(trim($st->name)) == strtolower(trim($result->state)))
                                 {
                                      $ksel= 'selected';
 
                                        } else {
                                        $ksel = '';
                                  
                                         } 
                                        ?>  
                                

                                    <option value="{{$st->id}}" <?=$ksel?>>{{ $st->name }}</option>                              
                                      <?php } ?>
                            
                        </select>
						@error('state')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                   
					</div>
					</div>
					
					<div class="col-md-6">	
                   <div class="form-group row">
					<label for="district" class="col-md-4 col-form-label text-md-right">{{ __('District') }}</label>
					
                        <select id="district" name="district" class="form-control @error('district') is-invalid @enderror" aria-required="true">
							<option value="">Select District</option>
							 <?php
                            foreach($districts as $dst){
                                
                                
                              if(strtolower(trim($dst->name)) == strtolower(trim($result->district)))
                              {
                                 $sel= 'selected';
                                
                                 
                               } else {
                                  $sel = '';
                                  
                                } 
                                 ?>  
                                 
                                <option value="{{$dst->id}}" <?=$sel?>>{{ $dst->name }}</option>                              
                              <?php  } ?>
                        
						
						@error('district')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
						</select>
                    
                </div>
				</div>
				
                <div style="clear:both"></div> 
				<div class="col-md-6">	
				 <div class="form-group row">
                            <label for="city" class="col-md-4 col-form-label text-md-right">{{ __('City') }}</label>

                           
                                <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ $result->city }}" required autocomplete="city">

                                @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
                        </div>
					</div>	
						
						
                     <div class="clearfix">&nbsp;</div>					 
				     <div class="card-footer">
					  <button type="submit" class="btn btn-sm btn-primary">Update</button>
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

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
    $('#state').change(function(){
        state_id = $('#state').val();
        $.ajax({
            url: "{{ route('admin.userdistrict') }}",
            type: "post",
            data: { "id":state_id,"_token": "{{ csrf_token() }}"} ,
            success: function (response) {
               console.log(response);
               $('#district').html(response);
            },
        });
    });
	
	
	</script>

@endsection