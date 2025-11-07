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
				<div class="col-12">
					<h1 class="act-header">All Teachers</h1>					
					 <a href="{{ route('admin.students.create') }}" class="create-btn"> <input type="submit" value="Add" class="btn btn-sm btn-success "></a>
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
							<form class="form-inline fltr-row " type="get" action="{{ route('admin.students.index') }}">				
								
								

							   <?php if(!empty($_GET['name'])){ $name = $_GET['name'];}else{ $name='';  } ?> 
								
								<div class="fltr-srch form-group">                	 
										<input type="search" name="name" value="<?=$name?>" id="name" class="form-control  fltr-txt-bx @error('name') is-invalid @enderror"  placeholder="Search School" width="180px">
										
										<button type="submit" class="btn btn-primary btn-sm" name="search" value="search"><i class="fa fa-search" aria-hidden="true"></i></button>
								</div>
									
							</form>
						</div>
					</div>
				</div>
        
		
        <div class="card-body table-responsive p-0">
         <table class="table table-striped projects">
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
                 
				
                  <tr>
                      <td>
                          {{++$i}}
                      </td>
                      <td>
					  
                      </td>
					  <td>
                       
                      </td>
					   <td>
                          
                      </td>
					  <td>
                          
                      </td>
                      
                      
                      <td class="project-actions text-right">
                          
                          <a class="btn btn-info btn-xs edit-btn" title="Update" href=""><i class="fas fa-pencil-alt"></i></a>
                              
                           
						  
						 
                          <form action="" method="post">
							@csrf
							@method('DELETE')
						 <button  class="btn btn-danger btn-xs delete-btn" type="submit" title="Delete" onclick="return confirm('Do you want to delete ?')" ><i class="fa fa-trash" aria-hidden="true" ></i></button>
						</form>
						
                      </td>
					 
                  </tr>
                  
			  
                  
              </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>


@endsection