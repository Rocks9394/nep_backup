@extends('admin.layouts.app')
@section('title', 'Goforfit - Update Subject')
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
                <h3 class="card-title">Update Subject</h3>
              </div>             
              <form method="POST" action="{{ route('admin.subjects.update', $subject->id) }}" enctype="multipart/form-data">
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
							  <label for="exampleInputEmail1">Subject</label>
							  <input type="text" name="name" class="form-control" id="name" value="{{ $subject->name }}" placeholder="Enter Subject">
							</div>               
						  </div>
						  
						  <div class="col-md-6">
							<div class="form-group">                  
							  <label for="exampleInputEmail1">Classes</label>							
								@if(!empty($classes)) 
								 <select class="form-control multicls" id="class" name="class_id[]" multiple="multiple">
									@foreach($classes as $cls)
									 <option value="{{$cls->id}}" <?php echo (in_array($cls->id, $clssubj) ? 'selected="selected"' : '');?>>{{$cls->name}}</option>
									@endforeach
								 </select>
								@endif
								<p style="color:blue;">Note:You can add multiple classes by pressing CTRL key</p>
							</div>
						  </div>
						</div>                         
							
                         <div class="form-check form-check-radio form-check-inline">
                              <label class="form-check-label">
                              <input class="form-check-input" checked="checked" type="radio" name="status" id="inlineRadio1" value="1" <?=$subject->status=="1" ? "checked" : "" ?>>Active
                              <span class="circle">
                                <span class="check"></span>
                              </span>
                              </label>
                            </div>
                            <div class="form-check form-check-radio form-check-inline">
                              <label class="form-check-label">
                              <input class="form-check-input" type="radio" name="status" id="inlineRadio2" value="0" <?=$subject->status=="0" ? "checked" : "" ?>> Inactive
                              <span class="circle">
                                <span class="check"></span>
                              </span>
                              </label>
                            </div>      
                        </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-sm btn-primary"><?=!empty($subject->id) ? "Update" : "Insert" ?></button>
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