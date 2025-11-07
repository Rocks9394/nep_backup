@extends('admin.layouts.app')
@section('title', 'Goforfit - Add Subject')
@section('content')
<div class="content-wrapper" id="subject-main">
    <section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-12">
					<a class="" href="{{ route('admin.subjects.index') }}"> <i class="fas fa-long-arrow-alt-left"></i> Back </a>     
				</div>
			</div>  
 		</div>
    </section>

	
    <section class="content">
		<div class="container-fluid">
        <div class="row">          
          <div class="col-md-12">           
            <div class="card card-primary">
				<div class="card-header">
					<h3 class="card-title">Add Subject</h3>
				</div> 
				
				<form method="POST" action="{{ route('admin.subjects.store') }}" enctype="multipart/form-data">
					@csrf
					<div class="card-body">
						@if(session('success'))
							<div class="alert alert-success alert-dismissible fade show" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
								{{ session('success') }}
							</div>
						@endif
						
						@if ($errors->any())
							<div class="alert alert-danger alert-dismissible fade show" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
									@foreach ($errors->all() as $error)
										<div>{{ $error }}</div>
									@endforeach
							</div>
					   @endif					
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">                  
								  <label for="exampleInputEmail1">Subject</label>
								  <input type="text" name="name" class="form-control" id="name" placeholder="Enter Subject" value="{{ old('name') }}">
								</div>               
							</div>
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
							<input class="form-check-input" type="radio" name="status" id="inlineRadio2" value="0"> Inactive
							<span class="circle">
								<span class="check"></span>
							</span>
						  </label>
						</div>      
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