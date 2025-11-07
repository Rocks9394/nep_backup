@extends('admin.layouts.app')
@section('title', 'Goforfit - Update Class')
@section('content')
<div class="content-wrapper" id="class-main">  
    <section class="content-header">
      <div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-12">       
				<a class="" href="{{ route('admin.classes.index') }}"> <i class="fas fa-long-arrow-alt-left"></i> Back </a>
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
                <h3 class="card-title">Update Class</h3>
              </div>             
              <form method="POST" action="{{ route('admin.classes.update', $class->id) }}" enctype="multipart/form-data">
				@csrf
				@method('PATCH')
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
						 <div class="col-md-6">
						   <div class="form-group">                  
							  <label for="exampleInputEmail1">Class</label>
							  <input type="text" name="name" class="form-control" id="name" value="{{ $class->name }}" placeholder="Enter Class">
							</div>               
						  </div>
						  
						 
						</div>                         
							
                         <div class="form-check form-check-radio form-check-inline">
                              <label class="form-check-label">
                              <input class="form-check-input" checked="checked" type="radio" name="status" id="inlineRadio1" value="1" <?=$class->status=="1" ? "checked" : "" ?>>Active
                              <span class="circle">
                                <span class="check"></span>
                              </span>
                              </label>
                            </div>
                            <div class="form-check form-check-radio form-check-inline">
                              <label class="form-check-label">
                              <input class="form-check-input" type="radio" name="status" id="inlineRadio2" value="0" <?=$class->status=="0" ? "checked" : "" ?>> Inactive
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