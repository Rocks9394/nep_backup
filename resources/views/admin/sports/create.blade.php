@extends('admin.layouts.app')
@section('title', 'Sports/Skills - Goforfit')

@section('content')
<style>
.mb-3{ margin-bottom: 0 !important; margin-right: 10px; }
.btn-sm{ padding: .375rem .75rem; }
.rtside{ float:right; }
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          
          <div class="col-sm-6">
           
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
	
    
	 <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Add Class-Sports/Skill</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->
		  <form method="POST" action="{{ route('admin.sports.store')}}" >
          <div class="card-body">
		   
			  @csrf
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
			<div class="col-md-12">
                <div class="form-group">
                  
				  <label for="exampleInputEmail1">Sports/Skills</label>
				  
                     
                    <input type="text" name="name" class="form-control" id="sport" placeholder="Enter skill/sport name">
				  
                </div>
               
              </div>
             
		   <div class="card-footer">
                  <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                </div>
		  </form>
          <!-- /.card-body -->
          
        </div>
        <!-- /.card -->

        
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
 
  </div>
  </div>


@endsection