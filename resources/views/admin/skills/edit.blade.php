@extends('admin.layouts.app')
@section('title', 'Goforfit - Edit Skill')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
				<div class="col-sm-12">
					<a class="" href="{{ route('admin.skills.index') }}"> <i class="fas fa-long-arrow-alt-left"></i> Back </a>     
				</div>
			</div>   
        </div>
     
    </section>

	
	<section class="content">
      <div class="container-fluid">
        <div class="row">
          
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Update Skill Area</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
			  
              <form method="POST" action="{{ route('admin.skills.update',$skill->id) }}" >
			 
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
							  <label for="exampleInputEmail1">skill area</label>
							  <input type="text" name="name" class="form-control" id="name" value="{{ $skill->name }}" placeholder="Enter Subject">
					</div>
                   
                
                </div>
                
				 </div>
				 
				 <div class="col-md-12">
							<div class="form-group">                  
							  <label for="exampleInputEmail1">Classes</label>							
								@if(!empty($classes)) 
								 <select class="form-control multicls" id="class" name="class[]" multiple="multiple">
									@foreach($classes as $cls)
									 <option value="{{$cls->id}}" <?php echo (in_array($cls->id, $clsskill) ? 'selected="selected"' : '');?>>{{$cls->name}}</option>
									@endforeach
								 </select>
								@endif
								<p style="color:blue;">Note:You can add multiple classes by pressing CTRL key</p>
							</div>
				</div>
				 
				 
               
				 
				  
                </div>
               
              </div>
               
			
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary btn-sm">Submit</button>
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