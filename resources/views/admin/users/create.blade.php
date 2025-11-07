@extends('admin.layouts.app')
@section('title', 'Create User - Goforfit')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
     <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          
          </div>
		 <div class="row mb-2">  
          <div class="col-sm-6">
           <a class="" href="{{ route('admin.users.index') }}"> <i class="fas fa-long-arrow-alt-left"></i> Back </a>
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
			  
				  <h3 class="card-title">Add User</h3>
			 
                
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="{{ route('admin.users.store') }}">
					  @csrf
					  <input type="hidden" name="user_id" value="user_id">
					  
					  <div class="card-body">
						<div class="row">					  
					   				   
					    					   
					   
						   		
					
					<div class="col-md-6">	
					@if(Auth::user()->role_id == '1')
					<div class="form-group" >
                     
                        <label for="state" class="col-md-4 col-form-label text-md-right">{{ __('Role') }}</label>
						
                        <select id="role" name="role" class="form-control @error('role') is-invalid @enderror" aria-required="true" >
						<option>Select Role</option>
                            @foreach($roles as $role)
							<option value="{{$role->id}}" >{{ $role->name }}</option> 
							@endforeach
                                     
                            
                        </select>
						
						@error('role')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                        </div>
						
					</div>
					@endif
					
					
					<div class="col-md-6">	
					<div class="form-group "id="school" style="display:none;" >
					<label for="state" class="col-md-4 col-form-label text-md-right">School Name</label>
					
					<select class="form-control select2" name="school_name" 
					class="form-control @error('school_name') is-invalid @enderror" aria-required="true">
                    <option selected="selected">Select Schools</option>
					@foreach($schools as $school)
                    <option value="{{ $school->id }}">{{ $school->school_name }}</option>
                    @endforeach
					</select>
					@error('school_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
					</div>
					</div>
					
					
					<div class="col-md-6">		 
					<div class="form-group">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Name" value="{{ old('name') }}" required autocomplete="name" autofocus>

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

                            
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
                        </div>
						</div>
						
						<div class="col-md-6">	
						 <div class="form-group ">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>

                            
                                <input id="phone" type="mobile" class="form-control @error('phone') is-invalid @enderror"  name="phone" placeholder="Phone" value="{{ old('phone') }}" required autocomplete="phone">

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                           
                        </div>
						</div>
						
						<div class="col-md-6">	
						<div class="form-group ">
                     
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
                   <div class="form-group">
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
				 <div class="form-group">
                            <label for="city" class="col-md-4 col-form-label text-md-right">{{ __('City') }}</label>

                            
                                <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city" placeholder="City" value="{{ old('city') }}" required autocomplete="city">

                                @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                           
                        </div>
				</div>
				
						<div class="col-md-6">	
                        <div class="form-group">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                           
                        </div>
						</div>
						
						
						<div class="col-md-6">	
                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            
                            <input id="password-confirm" type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation" required autocomplete="new-password">
                            
                        </div>
						</div>
                       
						 
                     <div class="clearfix">&nbsp;</div>					 
				     <div class="card-footer">
					  <button type="submit" class="btn btn-sm btn-primary">Submit</button>
					 </div>
				  </form>
            </div>
           
            

         
          
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
	</div>
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
	
	$('#role').change(function(){
		roleid = $('#role').val();
		//console.log(roleid);
		if(roleid == 3)
			$('#school').show();
		else
			$('#school').hide();
			
	});
	</script>

@endsection