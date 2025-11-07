@extends('admin.layouts.app')
@section('title', 'Goforfit - Classes list')
@section('content')
<div class="content-wrapper" id="class-main">

	<section class="content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<h1 class="act-header">Classes</h1>					
					 <a href="{{ route('admin.classes.create') }}" class="create-btn"> <input type="submit" value="Add" class="btn btn-sm btn-success "></a>
				</div>
			</div>
		</div>
    </section>
	
    @if($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
	
	
	<section class="content">
		<div class="container-fluid">
			<div class="row">
			<div class="col-md-12">
			<div class="card">
			
				<div class="card-header filter-head">  
					<div class="row"> 
						<div class="col-md-12">
							@if ($errors->any())
								<div class="alert alert-danger alert-dismissible">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
										@foreach ($errors->all() as $error)
											<div>{{ $error }}</div>
										@endforeach
									
								</div>
							@endif

							<form class="form-inline fltr-row " type="get" action="{{ route('admin.classes.index') }}">				
								
								

							   <?php if(!empty($_GET['name'])){ $name = $_GET['name'];}else{ $name='';  } ?> 
								
								<div class="fltr-srch form-group">                	 
										<input type="search" name="name" value="<?=$name?>" id="name" class="form-control  fltr-txt-bx @error('name') is-invalid @enderror"  placeholder="Search Class" width="180px">
										
										<button type="submit" class="btn btn-primary btn-sm" name="search" value="Search"><i class="fa fa-search" aria-hidden="true"></i></button>
								</div>
									
							</form>

						
							<div class="fltr-keys">
							<?php 
									if(!empty($_GET['name']) && $_GET['search']=='Search'){
										echo 'Search by: '.' <span class="search-txt">'.$_GET['name'].'</span>';
									}else if(!empty($_GET['search']) && $_GET['search']=='searchdata'){
										$filtervar = 'Filter by:';
										$filtervar .= '<ul>';
											if(!empty($aclsname)){
												$filtervar .= '<li class="act-cls"><span>'.$aclsname.'</span> </li>'; 
											}
										$filtervar .= '</ul>';
										
										echo $filtervar;
										
									}else{ } ?>
							</div>
						</div>
					</div>				
				</div>
			
			
			
			
				<div class="row"> 
					<div class="col-12 div-count">
						<div class="fltr-count">Classes Found: <span class="no-counts">{{ $count }}<span></div>
					</div>
				</div>
			
				<div class="card-body table-responsive p-0">
					<table class="table table-striped projects table-grid grid-4">
						<thead>
							<tr class="thead-dark">
								<th scope="col">#</th>
								<th scope="col">Class</th>
								<th scope="col">Status</th>
								<th scope="col">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php $i=0; ?>
							@foreach($results as $cls)
							<tr>
								<td>{{++$i}}</td>                    
								<td>{{ $cls->name }}</td>                   
								
								 
								<td> <?=(!empty($cls->status)&& $cls->status== 1 ? 'Active' : 'In Active');?> </td>
								
								@if(Auth::user()->role_id == '1' )					
								<td>
								 
								  <a class="btn btn-info btn-xs edit-btn" title="Update" href="{{ route('admin.classes.edit', $cls->id) }}"> <i class="fas fa-pencil-alt"></i></a>
								
								<?php /*
								<form action="{{ route('admin.classes.destroy', $cls->id) }}" method="POST">
										  @csrf
										  @method('DELETE')
									   <button  class="btn btn-danger btn-xs delete-btn" type="submit" title="Delete" onclick="return confirm('Do you want to delete ?')" ><i class="fa fa-trash" aria-hidden="true" ></i></button>
								</form> */ ?>
									 
								</td> 
								@endif
								
								  
							</tr>
							@endforeach
						</tbody>
					</table>
					
					
					@if(empty($count))
							<div class="d-flex justify-content-center no-record"> No record found </div>
					@endif
					
					<div class="d-flex justify-content-center">
					   {{ $results->appends(request()->query())->links() }}
					</div>
				</div>
			</div>
			</div>
			</div>
		</div>
    </section>
  
    
    
  </div>
@endsection