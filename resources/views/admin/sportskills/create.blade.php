@extends('admin.layouts.app')
@section('title', 'Create Sport-skill - Goforfit')

@section('content')
<style>
	label:not(.form-check-label):not(.custom-file-label) {
    font-weight: 700 !important;
}
 input.larger {
        transform: scale(1);
        margin: 6px; 
      }
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          
          </div>
		 <div class="row mb-2">  
          <div class="col-sm-6">
           
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
			 
            <div class="card bg-secondary text-white">
              <div class="card-header">
                <h3 class="card-title">Add Class</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="{{ route('admin.sportskills.store') }}" >
			          @csrf
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
                   
                    <label for="exampleInputEmail1">Class</label>
                     <select class="form-control" id="class" name="class" >
					
                      @foreach($classes as $class)
                      
                     
                      <option value="{{ $class->id }}">{{ $class->name }}</option>
                      
                      
                      @endforeach
        
                    </select>
                   
                
						</div>
                
				</div>
				 </div>
                <!-- /.card-body -->
				<div class="card bg-secondary text-white">
				<div class="card-header">
                <h3 class="card-title">Add Sports</h3>
				</div>
					<div class="card-body">


               

                 
				        <div class="form-group">
                   
                    <label for="exampleInputEmail1" class="checkbox-inline">Sport</label>
					@foreach($sports as $sport)
                    <input type="checkbox" name="sport[]" class="larger" id="sport" value="{{$sport->id}}">{{$sport->name}}
					@endforeach
                   
                
						</div>
                
					</div>
				</div>
				
				<div class="card bg-secondary text-white">
				<div class="card-header">
                <h3 class="card-title">Add Skills</h3>
				</div>
					<div class="card-body">


               

                 
				        <div class="form-group">
                   
                    <label for="exampleInputEmail1" class="checkbox-inline" >Skills</label>
					@foreach($skills as $skill)
					
                    <input type="checkbox" name="skill[]" class="larger" id="sport" value="{{$skill->id}}">{{$skill->name}}
                   
					@endforeach
						</div>
                
					</div>
				</div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                </div>
              </form>
           
           
            

          </div>
          
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
	
    <!-- /.content -->
  </div>


@endsection