@extends('admin.layouts.app')
@section('title', 'Create School - Goforfit')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          
          </div>
		 <div class="row mb-2">  
          <div class="col-sm-6">
           <a class="" href="{{ route('admin.schools.index') }}"> <i class="fas fa-long-arrow-alt-left"></i> Back </a>
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
                <h3 class="card-title">Add School</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="{{ route('admin.schools.store') }}" >
			          @csrf
                <div class="card-body">					   
					   <div class="row">

               


									         
										<div class="col-md-6">
											<div class="form-group">
											<label>School Name</label>
											<input id="" name="schoolname" type="text" placeholder="School Name"
                                             class="form-control @error('schoolname') is-invalid @enderror" value="{{ old('schoolname') }}">
											{!!$errors->first("schoolname", "<span class='text-danger'>:message</span>")!!}
											</div>
										</div>
									
									
									<div class="col-md-6">
											<div class="form-group">
											<label>Principal Name</label>
											<input id="" name="principalname" type="text" placeholder="principal Name"
                                            class="form-control @error('principalname') is-invalid @enderror" value="{{ old('principalname') }}">
											{!!$errors->first("principalname", "<span class='text-danger'>:message</span>")!!}
											</div>
										</div>
									
									
									<div class="col-md-6">
											<div class="form-group">
											<label>School EmailId</label>
											<input id="" name="email" type="text" placeholder="School Email"
                                            class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
											{!!$errors->first("email", "<span class='text-danger'>:message</span>")!!}
											</div>
										
									</div>
									
									<div class="col-md-6">
											<div class="form-group">
											<label>School Principal Phone</label>
											<input id="" name="phone" type="text" placeholder="School Principal Phone"
                                            class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}">
											{!!$errors->first("phone", "<span class='text-danger'>:message</span>")!!}
											</div>
										
									</div>
									
									
									<div class="col-md-6">
											<div class="form-group">
											<label>State</label>
											<select id="state" name="state" aria-required="true" 
											class="form-control @error('state') is-invalid @enderror" value="{{ old('state') }}">
											<option value="">Select state</option>                              
											
											
											@foreach($states as $st)
											<option value="{{$st->id}}"  @if(!empty(old('state')) && old('state') == $st->id) {{ 'selected' }} @endif>{{ $st->name }}</option>                              
											@endforeach
											</select>
											{!!$errors->first("state", "<span class='text-danger'>:message</span>")!!}
											</div>
										
									</div>
									
									<div class="col-md-6">
											<div class="form-group">
											<label>District</label>
											<select id="district" name="district" aria-required="true" 
											class="form-control @error('district') is-invalid @enderror" value="{{ old('district') }}">
											<option value="">Select District</option>
											@foreach($districts as $dist)
											<option value="{{$dist->id}}" @if(!empty(old('district')) && old('district') == $st->id) {{ 'selected' }} {{ $st->state_id  }} @endif>{{ $dist->name }}</option>                              
											@endforeach
											</select>
											{!!$errors->first("district", "<span class='text-danger'>:message</span>")!!}
											</div>
										
									</div>
									
									<div class="col-md-6">
											<div class="form-group">
											<label>City</label>
											<input id="" name="city" type="text" placeholder="City"
                                            class="form-control @error('city') is-invalid @enderror" value="{{ old('city') }}">
											{!!$errors->first("City", "<span class='text-danger'>:message</span>")!!}
											</div>
										
									</div>
									
									<div class="col-md-6">
											<div class="form-group">
											<label>pincode</label>
											<input id="" name="pincode" type="text" placeholder="pincode"
                                            class="form-control @error('pincode') is-invalid @enderror" value="{{ old('pincode') }}">
											{!!$errors->first("pincode", "<span class='text-danger'>:message</span>")!!}
											</div>
										
									</div>
									
									<div class="col-md-6">
											<div class="form-group">
											<label>Address</label>
											<input id="" name="address" type="text" placeholder="Address"
                                            class="form-control @error('address') is-invalid @enderror" value="{{ old('address') }}">
											{!!$errors->first("address", "<span class='text-danger'>:message</span>")!!}
											</div>
										
									</div>
									
									
									
									<div class="col-md-6">
											<div class="form-group">
											<label>Chain Options</label>
											<select id="chainopts" name="chainopts" aria-required="true" 
											class="form-control @error('chainopts') is-invalid @enderror" value="{{ old('chainopts') }}">
											<option value="">Select Chain</option>
											@foreach($chainopts as $chain)
											<option value="{{$chain->id}}">{{ $chain->chainname }}</option>                              
											@endforeach
											</select>
											{!!$errors->first("chainopts", "<span class='text-danger'>:message</span>")!!}
											</div>
										
									</div>
									
									<div class="col-md-6">
											<div class="form-group">
											<label>Board</label>
											<select id="board" name="board" aria-required="true"
											class="form-control @error('board') is-invalid @enderror" value="{{ old('board') }}">
											<option value="">Select Board</option>
											@foreach($boards as $board)
											<option value="{{$board->id}}">{{ $board->boardname }}</option>                              
											@endforeach
											</select>
											{!!$errors->first("board", "<span class='text-danger'>:message</span>")!!}
											</div>
										
									</div>
									
									<div class="col-md-6">
											<div class="form-group">
											<label>Zone Name</label>
											
											<input id="" name="zonename" type="text" placeholder="zonename"
                                            class="form-control @error('zonename') is-invalid @enderror" value="{{ old('zonename') }}">
											{!!$errors->first("zonename", "<span class='text-danger'>:message</span>")!!}
											</div>
										
									</div>
									
									<div class="col-md-6">
											<div class="form-group">
											<label>Region</label>
											<select id="" name="region" aria-required="true"
											class="form-control @error('region') is-invalid @enderror" value="{{ old('region') }}">
											<option value="">Select Region</option>
											@foreach($regions as $region)
											<option value="{{$region->id}}">{{ $region->name }}</option>                              
											@endforeach
											</select>
											
											{!!$errors->first("region", "<span class='text-danger'>:message</span>")!!}
											</div>
										
										
									</div>
									
									
									
									
                
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                </div>
				
				</div>
                
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
            url: "{{ route('admin.school-district') }}",
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