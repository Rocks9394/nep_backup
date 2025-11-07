@extends('admin.layouts.app')
@section('title', 'Create User - Goforfit')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          
         
            <div class="col-sm-6">
           <a class="" href="{{ route('admin.teachers.index') }}"> <i class="fas fa-long-arrow-alt-left"></i> Back </a>
         
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
			 
                <h3 class="card-title">Add Teacher</h3>
			
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="{{ route('admin.teachers.store') }}">
					  @csrf
					  <input type="hidden" name="user_id" value="user_id">
					  <div class="card-body">					   
					   <div class="row">					   
					    
						   		
					
					
					
					
					
					
					
					
					<div class="col-md-6">	
					<div class="form-group row"id="school"  >
						<label for="state" class="col-md-4 col-form-label text-md-right">School Name</label>
						
						<select class="form-control select2" name="school_name" class="form-control @error('school_name') is-invalid @enderror" aria-required="true">
						<option selected="selected">Select Schools</option>
						@foreach($schools as $school)
						<option value="{{ $school->id }}">{{$school->school_name}}</option>
						@endforeach
						</select>
						
					</div>
					</div>
					
					<div class="col-md-6"> 
								<div class="form-group">
									<label>Class*</label>  
									<select class="form-control selctopt @error('class_id') is-invalid @enderror" name="class_id" id="id_class0" onchange="getsubjects(0,this.value)">
										<option value="">Select Class</option>
										<?php if(!empty($classes)){                
											foreach($classes as $cls){ ?>
												<option value="{{ $cls->id }}" ><?=$cls->name;?></option>                
										<?php 	} } ?> 
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
												<option value="{{ $cls->id }}"> <?=$cls->name;?></option>                
									<?php } } ?>  
									</select>
								</div>
						</div>
								
					<div class="col-md-6">		 
					<div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                           
                                <input id="name" type="text" placeholder="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

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

                           
                                <input id="email" type="email" placeholder="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

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

                            
                                <input id="phone" type="mobile" placeholder="mobile" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone">

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
                        </div>
						</div>
						
						<div class="col-md-6">	
						 <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('DOB') }}</label>

                            
                               <input id="dob" type="date" class="form-control @error('dob') is-invalid @enderror" name="dob" value="{{ old('dob') }}" required autocomplete="name" autofocus>


                                @error('dob')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
                        </div>
						</div>
						
						<div class="col-md-6">	
						 <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Qualification') }}</label>

                            
                               <input id="qualification" type="text" placeholder="your qualification" class="form-control @error('qualification') is-invalid @enderror" name="qualification" value="{{ old('qualification') }}" required autocomplete="qualification" autofocus>


                                @error('qualification')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
                        </div>
						</div>
						
						
						<div class="col-md-6">	
						 <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Achievements') }}</label>

                            
                               <input id="achievement" type="text" placeholder="achievement" class="form-control @error('achievement') is-invalid @enderror" name="achievement" value="{{ old('achievement') }}" required autocomplete="name" autofocus>


                                @error('achievement')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
                        </div>
						</div>
						
						
						<div class="col-md-6">	
                   <div class="form-group row">
					<label for="district" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>
						
						
						 <select name ="gender" id="gender" class="form-control @error('gender') is-invalid @enderror"  value="{{ old('gender') }}" required autocomplete="name" autofocus>
                                    <option selected >Please select</option>
                                    <option value="male">male</option>
                                    <option value="female">female</option>
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
                     
                        <label for="state" class="col-md-4 col-form-label text-md-right">{{ __('State') }}</label>
						
                        <select id="state" name="state" class="form-control @error('state') is-invalid @enderror" aria-required="true">
						
                            <option value="">Select State</option>
                            @foreach($states as $st)
                                <option value="{{ $st->id }}"  @if(!empty(old('state')) && old('state') == $st->id) {{ 'selected' }} @endif >
								{{ $st->name }}
								</option>
                            @endforeach
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
							@foreach($districts as $st)
                                <option value="{{ $st->id }}"  @if(!empty(old('district')) && old('district') == $st->id) {{ 'selected' }} {{ $st->state_id  }} @endif >
								{{ $st->name }}
								</option>
								
                            @endforeach
                        </select>
						
						@error('district')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    
                </div>
				</div>
				
				<div class="col-md-6">	
                <div style="clear:both"></div> 
				 <div class="form-group row">
                            <label for="city" class="col-md-4 col-form-label text-md-right">{{ __('City') }}</label>

                            
                                <input id="city" type="text" placeholder="city" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ old('city') }}" required autocomplete="city">

                                @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
                        </div>
				</div>
				
					
					<div class="col-md-6">	
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            
                                <input id="password" type="password" placeholder="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                           
                        </div>
						</div>
						
						<div class="col-md-6">	
                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            
                                <input id="password-confirm" type="password" placeholder="confirm password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                           
                        </div>
						</div>
						
						
                       
						 
                     <div class="clearfix">&nbsp;</div>					 
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

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
    $('#state').change(function(){
        state_id = $('#state').val();
        $.ajax({
            url: "{{ route('admin.teacher-district') }}",
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