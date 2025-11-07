@extends('admin.layouts.app')
@section('title', 'Goforfit - Chapters list')
@section('content')
<div class="content-wrapper" id="chapter-main"> 

	<section class="content-header">
		<div class="container-fluid">
			<div class="row">
			
				<div class="col-md-2">
					<h1 class="act-header">Chapters</h1>					
					 <a href="{{ route('admin.chapters.create') }}" class="create-btn"> <input type="submit" value="Add" class="btn btn-sm btn-success "></a>
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

							<form class="form-inline fltr-row " type="get" action="{{ route('admin.chapters.index') }}">				
								
								<?php
									$aclasses ='<option value="">Select Class</option>';
									if(!empty($classes)){								
											foreach($classes as $cls){	
												$aclasses.= '<option value="'.$cls->id.'" ';
												if(!empty($_GET['aclass'])){
													if($cls->id == $_GET['aclass']){ $aclasses.= ' selected'; $aclsname = $cls->name; }
												} 
												$aclasses.= ' >'.$cls->name.'</option>';
											} 
									}
									
									$asubjects ='<option value="">Subject</option>';
									if(!empty($subjects)){								
										foreach($subjects as $cls){	
											$asubjects.= '<option value="'.$cls->id.'" ';
											if(!empty($_GET['subject'])){
												if($cls->id == $_GET['subject']){ $asubjects.= ' selected'; $asubjectname = $cls->name; }
											} 
											$asubjects.= ' >'.$cls->name.'</option>'; 								
										} 
									}
									
								?>
								
								<div class="fltr-drdwn form-group" >
									<select class="form-control selctopt clsopt @error('aclass') is-invalid @enderror" name="aclass" id="id_class0" onchange="getsubjects(0,this.value)">
										<?=$aclasses?>
									</select>
									<select class="form-control selctopt" id="id_subject0" name="subject" style="width:180px;">
										<?=$asubjects?>
									</select>
									<button type="submit" name="search" value="searchdata" class="btn btn-primary btn-sm"> <i class="fa fa-filter" aria-hidden="true"></i></button>
								</div>

							   <?php if(!empty($_GET['name'])){ $name = $_GET['name'];}else{ $name='';  } ?> 
								
								<div class="fltr-srch form-group">                	 
										<input type="search" name="name" value="<?=$name?>" id="name" class="form-control  fltr-txt-bx @error('name') is-invalid @enderror"  placeholder="Search Chapter" width="180px">
										
										<button type="submit" class="btn btn-primary btn-sm" name="search" value="Search"><i class="fa fa-search" aria-hidden="true"></i></button>
								</div>
									
							</form>

						
							<div class="fltr-keys">
							<?php 
									if(!empty($_GET['name']) && $_GET['search']=='Search'){
										echo 'Search by: '.' <span class="search-txt">'.$_GET['name'].'</span>';
									}else if(!empty($_GET['search']) && $_GET['search']=='searchdata'){
										$filtervar = '';
										$filtervar .= 'Filter by:';
										$filtervar .= '<ul>';
											if(!empty($aclsname)){
												$filtervar .= '<li class="act-cls"><span>'.$aclsname.'</span> </li>'; 
											}
											if(!empty($asubjectname)){
												$filtervar .= '<li class="act-cls"><span>'.$asubjectname.'</span> </li>'; 
											}
											
										$filtervar .= '</ul>';
										
										echo $filtervar;
										
									}else{ } ?>
							</div>
						</div>
					</div>				
				</div>
			
				
				
				
				<div class="col-md-12">
						<div class="row">
						
							<div class="col-md-8">
							<button class="btn btn-success btn-sm dwl" name="download" value="download"
							 onclick="window.location.href='chapter_export?class={{ request()->input('aclass')}}&subject={{ request()->input('subject')}}&search=search';" >
							<i class="fa fa-download"></i> Download</button>
							</div>
						

							<form action="{{ route('admin.updatechapter') }}" method="POST" enctype="multipart/form-data">
							@csrf
               
								<div class="col-md-10">
									
									  <input type="file" name="file" required class="form-control" accept=".xlsx, .xls, .csv"/>
							          <button class="btn btn-primary btn-sm">Import Chapter</button> 
								</div>
							
							</form>
					</div>
					</div>	
				
				
			
			
				<div class="row"> 
					<div class="col-12 div-count">
						<div class="fltr-count">Chapters Found: <span class="no-counts">{{ $count }}<span></div>
					</div>
				</div>
			
				<div class="card-body table-responsive p-0">
					<table class="table table-striped projects table-grid grid-6">
						<thead>
							<tr class="thead-dark">
								<th scope="col">Image</th>
								<th scope="col">Chapter</th>
								<th scope="col">Class</th>
								<th scope="col">Subject</th>
								<th scope="col">Status</th>
								<th scope="col">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php $i=0; ?>
							@foreach($results as $cls)
							<tr>
								
								<td>
									@if(Illuminate\Support\Str::contains( $cls->image,'storage/app/public/uploads'))
										<img src="{{ $cls->image }}" width="100" height="100">
									@elseif(!empty($cls->image))
										<img src="{{ asset('public/uploads').'/'.$cls->image }}" width="100" height="100">
									@else
										<img src="{{ asset('public/uploads').'/images.jpg' }}" width="100" height="100">
									@endif     
									
								</td>
								
								<td>{{ $cls->name }}</td>                   
								<td> {{ $cls->clsname }} </td>
								<td> {{ $cls->subname }} </td>  
								<td> <?=(!empty($cls->status)&& $cls->status== 1 ? 'Active' : 'In Active');?> </td>
								@if(Auth::user()->role_id == '1' )					
								<td>								 
								   <a class="btn btn-info btn-xs edit-btn pull-left" title="Update" href="{{ route('admin.chapters.edit', $cls->id) }}"> <i class="fas fa-pencil-alt"></i></a>
								   <form action="{{ route('admin.chapters.destroy', $cls->id) }}" class="pull-right" method="POST">
										@csrf
										@method('DELETE')
									   <button  class="btn btn-danger btn-xs delete-btn" type="submit" title="Delete" onclick="return confirm('Do you want to delete ?')" ><i class="fa fa-trash" aria-hidden="true" ></i></button>
									 </form>
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
					   {{ $results->appends(request()->input())->links() }}
					</div>
				</div>
			</div>
			</div>
			</div>
		</div>
    </section>
    
  </div>
@endsection