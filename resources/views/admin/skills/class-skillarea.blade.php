@extends('admin.layouts.app')
@section('title', 'Skills - Goforfit')

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
            <h3 class="card-title">Add Class-SkillArea</h3>

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
		  <form method="POST" action="{{ route('admin.storeclsskill')}}" >
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
            <div class="row">
			 <div class="col-md-6">
                
                <!-- /.form-group -->
                <div class="form-group">
                  
				  <label for="exampleInputEmail1">SkillAreas</label>
                     <select class="form-control" id="skill" name="skill" >
					
                      @foreach($skills as $skill)
                      
                     
                      <option value="{{ $skill->id }}">{{ $skill->name }}</option>
                      
                      
                      @endforeach
        
                    </select>
				  
				  
                </div>
               
              </div>
			 
              <div class="col-md-6">
                <div class="form-group">
                  
				  <label for="exampleInputEmail1">Class</label>
                     <select class="form-control" id="class" name="class[]" multiple="multiple">
					
                      @foreach($classes as $class)
                      
                     
                      <option value="{{ $class->id }}">{{ $class->name }}</option>
                      
                      
                      @endforeach
        
                    </select>
				  
				  <p style="color:blue;">Note:you can select multiple classes by pressing CTRL key</p>
                </div>
               
              </div>
              <!-- /.col -->
             
             
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