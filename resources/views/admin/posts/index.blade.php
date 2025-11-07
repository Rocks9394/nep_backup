@extends('admin.layouts.app')
@section('title', 'Goforfit Admin Activity')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-10">
					<h1>Activity</h1>
				</div>
				<div class="col-2">
					<a href="{{ route('admin.posts.create') }}" class="create-btn"> <input type="submit" value="Add" class="btn btn-sm btn-success "></a>
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
				 <form class="form-inline fltr-row " type="get" action="{{ route('admin.posts.index') }}">
					<div class="fltr-drdwn form-group">
					 @if(!empty($classes)) 
					  <select class="form-control" name="classSelect2" >
						@foreach($classes as $cls)	
						 <option value="{{$cls->id}}" 
						 <?php if(!empty($_REQUEST['classSelect2'])){				
							$selct=(in_array($cls->id, $_REQUEST['classSelect2']) ? 'selected="selected"':'');}else{ $selct='';}?><?=$selct?>>{{$cls->name}}</option>
						@endforeach
					  </select>
					 @endif	

					<select class="form-control" name="classSelect2" >
						@foreach($classes as $cls)	
						 <option value="{{$cls->id}}" 
						 <?php if(!empty($_REQUEST['classSelect2'])){				
							$selct=(in_array($cls->id, $_REQUEST['classSelect2']) ? 'selected="selected"':'');}else{ $selct='';}?><?=$selct?>>{{$cls->name}}</option>
						@endforeach
					  </select>


					<select class="form-control" name="classSelect2" >
						@foreach($classes as $cls)	
						 <option value="{{$cls->id}}" 
						 <?php if(!empty($_REQUEST['classSelect2'])){				
							$selct=(in_array($cls->id, $_REQUEST['classSelect2']) ? 'selected="selected"':'');}else{ $selct='';}?><?=$selct?>>{{$cls->name}}</option>
						@endforeach
					</select>
					
					<select class="form-control" name="classSelect2" >
						@foreach($classes as $cls)	
						 <option value="{{$cls->id}}" 
						 <?php if(!empty($_REQUEST['classSelect2'])){				
							$selct=(in_array($cls->id, $_REQUEST['classSelect2']) ? 'selected="selected"':'');}else{ $selct='';}?><?=$selct?>>{{$cls->name}}</option>
						@endforeach
					</select>
					
					<button type="submit" name="searchdata" value="searchdata" class="btn btn-primary btn-sm"> <i class="fa fa-filter" aria-hidden="true"></i></button>  
					</div>              
				   
				   <?php		 
				if(!empty($_REQUEST['activity_name'])&& $_REQUEST['activity_name']!=''){
				  
				   $tname=$_REQUEST['activity_name'];

				 }else{

				   $tname='';
				 } 
			   ?> 
					<div class="fltr-srch form-group">                	 
							<input type="search" name="activity_name" value="<?=$tname?>" id="activity_name" class="form-control  fltr-txt-bx"  placeholder="Search Activity" width="180px">
							<button type="submit" class="btn btn-primary btn-sm" name="search" value="Search"><i class="fa fa-search" aria-hidden="true"></i></button>
					</div>
						
				 </form>			 
			</div>
			
							
			
		 </div>			
		
        </div>		      
        <div class="card-body table-responsive p-0">              
			<table class="table table-striped projects">
				<thead>
					<tr class="thead-dark">
						<th scope="col">Image</th>
						<th scope="col">Title</th>
						<th scope="col">Class</th>
						<th scope="col" style="width:17%">Teaching Through</th>
                   
						@if(Auth::user()->role_id == '1' OR Auth::user()->role_id == '4')
						<th scope="col">Action</th>
						@endif
					</tr>
				</thead>
            <tbody>
	        <?php $i=0; ?>
            <?php if(!empty($posts)){			   
			 foreach($posts as $val){ ?>
			  <tr> 
					<td>
						 <?php           
						   $word = "wp-content";
						   $mystring = $val->image;
						//print_r($mystring);
						  if(strpos($mystring, $word)!== false){
						 ?>
						  <img src="{{ preg_replace('/[^(\x20-\x7F)\x0A\x0D]*/','', $val->image) }}" width="100" height="100"> 
						 <?php } else if (file_exists('public/uploads/'.$val->image)){ ?>
						  <img src="{{ asset('public/uploads').'/'.$val->image }}" alt="" width="100" height="100">              
						 <?php } else{ ?>        
						 <img src="{{ asset('public/uploads').'/'.'images.jpg' }}" width="100" height="100">
						 <?php }  ?>     
					</td> 
					
					<td><?php echo preg_replace('/[^(\x20-\x7F)\x0A\x0D]*/','', $val->title);?></td>
					<td>{{ $val->cls }}</td> 				  
					<td>
						<?php
						   $var = explode(",",$val->teach_id);
						   foreach($teaching as $tch){                 
							 echo (in_array($tch->id, $var) ? ($tch->name == '' ? '' : '<span class="tag" >'.$tch->name . '</span>') : '');
						   } 
						?>         
					</td>				 
				                    
            <!-- <td>
			<?php //(!empty($val->status)&& $val->status==1 ? 'Active' : 'In Active');
			?></td> -->
			 @if(Auth::user()->role_id == '1' OR Auth::user()->role_id == '4')
             <td class="form-check form-check-radio form-check-inline">
              <a style="display: inline !important;" class="btn btn-info btn-xs" href="{{ route('admin.posts.edit',$val->id) }}"> <i class="fas fa-pencil-alt"></i></a>
               &nbsp;&nbsp;
                  <form action="{{ route('admin.posts.destroy', $val->id) }}" method="POST">
                      @csrf
                      @method('DELETE')
                   <button  style="display: inline !important;"class="btn btn-danger btn-xs" type="submit"><i class="fa fa-trash" aria-hidden="true" onclick="return confirm('Do you want to delete ?')"></i></button>
                 </form>
             </td>
				@endif
            </tr>
		  <?php } } ?>			             
          </tbody>
          </table>
		 <div class="d-flex justify-content-center"></div>
       </div>
      </div>
     </div>
    </div>
   </div>
  </section>    
 </div> 
@endsection