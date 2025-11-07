@extends('admin.layouts.app')
@section('title', 'School - Goforfit')

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
			<div class="row">
				<div class="col-12">
					<h1 class="act-header">Schools</h1>					
					 <a href="{{ route('admin.schools.create') }}" class="create-btn"> <input type="submit" value="Add" class="btn btn-sm btn-success "></a>
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
							<form class="form-inline fltr-row " type="get" action="{{ route('admin.schools.index') }}">				
								
								

							   <?php if(!empty($_GET['name'])){ $name = $_GET['name'];}else{ $name='';  } ?> 
								
								<div class="fltr-srch form-group">                	 
										<input type="search" name="name" value="<?=$name?>" id="name" class="form-control  fltr-txt-bx @error('name') is-invalid @enderror"  placeholder="Search School" width="180px">
										
										<button type="submit" class="btn btn-primary btn-sm" name="search" value="search"><i class="fa fa-search" aria-hidden="true"></i></button>
								</div>
									
							</form>
						</div>
					</div>
				</div>
		
          <div class="row"> 
					<div class="col-12 div-count">
						<div class="fltr-count">Schools: <span class="no-counts">{{$count}}<span></div>
					</div>
				</div>
		  
		 
		
        <div class="card-body table-responsive p-0">
         <table class="table table-striped projects table-grid grid-5">
              <thead>
                  <tr class="thead-dark">
                    <th scope="col">#</th>
                    <th scope="col">School Name/Chain/Board</th>
					 <th scope="col">Principal Details</th>
					 <th scope="col">Address Details</th>
                   
                    <th scope="col">Action</th>
                  </tr>
              </thead>
              <tbody>
              <?php $i=0; ?>
                @foreach($schools as $school)
                  <tr>
                    <th scope="row">{{++$i}}</th>
                    <td>
					{{$school->school_name}}<br>
					{{$school->region}} <br>
					{{$school->board}}<br>
					{{$school->chain}}        
                    </td>
					<td>
					{{$school->school_principal}}<br>
						{{$school->principal_phone}}<br>
							{{$school->school_email}}
					 </td>
					 <td>
					 {{$school->state}}<br>
						 {{$school->district}}<br>
						 {{$school->address}}<br>
							 {{$school->pincode}}
					 </td>
                     
                              
                   
                       
                   <td>  
           <a class="btn btn-info btn-xs edit-btn" href="{{route('admin.schools.edit',$school->id)}}"> <i class="fas fa-pencil-alt"></i></a>
           
            <form action="{{ route('admin.schools.destroy',$school->id) }}" method="POST">
              @csrf
              @method('DELETE')
             <button  class="btn btn-danger btn-xs delete-btn"  type="submit" onclick="return confirm('Do you want to delete ?')"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp;</button>
             </form> </td>
                 
				  
				     
                  </tr>
				  @endforeach
              </tbody>
          </table>

        <div class="d-flex justify-content-center">
      
        {{ $schools->links() }}
       
        </div>    
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
	
  </div>


@endsection