@extends('admin.layouts.app')
@section('title', 'Teacher - Goforfit')

@section('content')
<style>
.mb-3{ margin-bottom: 0 !important; margin-right: 10px; }
.btn-sm{ padding: .375rem .75rem; }
.rtside{ float:right; }
</style>
<div class="content-wrapper" id="class-main">
    <!-- Content Header (Page header) -->
    <section class="content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-2">
					<h1 class="act-header">All Teachers</h1>					
					 <a href="{{ route('admin.teachers.create') }}" class="create-btn"> <input type="submit" value="Add" class="btn btn-sm btn-success "></a>
				</div>
			</div>
		</div>
    </section>
	
    <!-- Main content -->
     <section class="content">
		<div class="container-fluid">
			<div class="row">
			<div class="col-md-12">
			<div class="card">
			
				<div class="card-header filter-head">  
					<div class="row">
						<div class="col-md-12">					
							<form class="form-inline fltr-row " type="get" action="{{ route('admin.teachers.index') }}">				
								
								

							   <?php if(!empty($_GET['name'])){ $name = $_GET['name'];}else{ $name='';  } ?> 
								
								<div class="fltr-srch form-group">                	 
										<input type="search" name="name" value="<?=$name?>" id="name" class="form-control  fltr-txt-bx @error('name') is-invalid @enderror"  placeholder="Search Teacher" width="180px">
										
										<button type="submit" class="btn btn-primary btn-sm" name="search" value="search"><i class="fa fa-search" aria-hidden="true"></i></button>
								</div>
									
							</form>
						</div>
					</div>
				</div>
        
		<div class="row"> 
					<div class="col-12 div-count">
						<div class="fltr-count">Teachers: <span class="no-counts">{{$count}}<span></div>
					</div>
				</div>
		
		
        <div class="card-body table-responsive p-0 user-info">
         <table class="table table-striped projects table-grid grid-6">
              <thead>
                  <tr class="thead-dark">
                      <th>
                          #
                      </th>
                      <th>
                          Name
                      </th>
                      
                      <th class="text-left">
                          Email
                      </th>
					  <th>
                         Phone
                      </th>
                      
                      <th class="text-left">
                          State/District
                      </th>
					  <th class="text-left">
                          Action
                      </th>
					  
					  
					  
                      
                  </tr>
              </thead>
              <tbody>
              <?php $i=0; ?>
                 
				@foreach($users as $user)
                  <tr>
                      <td>
                          {{++$i}}
                      </td>
                      <td>
					  {{$user->name}}
                      </td>
					  <td>
                        {{$user->email}} 
                      </td>
					   <td>
                          {{$user->phone}}  
                      </td>
					  <td>
                          {{$user->state}} /  {{$user->district}} 
                      </td>
                      
                      
                      <td>
                          
                          <a class="btn btn-info btn-xs edit-btn" title="Update" href="{{ route('admin.teachers.edit', $user->id)}}"><i class="fas fa-pencil-alt"></i></a>
                              
                           
						  
						 
                          <form action="{{route('admin.teachers.destroy', $user->id)}}" method="post">
							@csrf
							@method('DELETE')
						 <button  class="btn btn-danger btn-xs delete-btn" type="submit" title="Delete" onclick="return confirm('Do you want to delete ?')" ><i class="fa fa-trash" aria-hidden="true" ></i></button>
						</form>
						
                      </td>
					 
                  </tr>
                  
				@endforeach
                  
                  
              </tbody>
          </table>
		  <div class="d-flex justify-content-center">{{$users->appends(request()->input())->links()}}</div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>


@endsection