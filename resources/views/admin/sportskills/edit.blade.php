@extends('admin.layouts.app')
@section('title', 'Goforfit - Edit Sports')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
         
		</div>
		
		<div class="row mb-2">
          
        </div>
      </div><!-- /.container-fluid -->
    </section>

  
	<section class="content">
      <div class="container-fluid">
        <div class="row">
          
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Update Sports</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="{{ route('admin.sports.update',$sport->id) }}" >
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
                   
                    <label for="exampleInputEmail1">sport</label>
                    <input type="text" name="name" value="{{ $sport->name }}" class="form-control" id="sport" placeholder="Enter sport name">
                   
                
                </div>
                
				        </div>
                <!-- /.card-body -->

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