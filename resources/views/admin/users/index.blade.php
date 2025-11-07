@extends('admin.layouts.app')
@section('title', 'User - Goforfit')

@section('content')

<div class="content-wrapper" id="class-main">
    <!-- Content Header (Page header) -->
  <section class="content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-2">
					<h1 class="act-header">All Users</h1>					
					 <a href="{{ route('admin.users.create') }}" class="create-btn"> <input type="submit" value="Add" class="btn btn-sm btn-success "></a>
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
							<form class="form-inline fltr-row " type="get" action="{{ route('admin.users.index') }}">				
								
								

							   <?php if(!empty($_GET['name'])){ $name = $_GET['name'];}else{ $name='';  } ?> 
								
								<div class="fltr-srch form-group">                	 
										<input type="search" name="name" value="<?=$name?>" id="name" class="form-control  fltr-txt-bx @error('name') is-invalid @enderror"  placeholder="Search User" width="180px">
										
										<button type="submit" class="btn btn-primary btn-sm" name="search" value="search"><i class="fa fa-search" aria-hidden="true"></i></button>
								</div>
									
							</form>
						</div>
					</div>
				</div>
				
				<div class="row"> 
					<div class="col-12 div-count">
						<div class="fltr-count">Users: <span class="no-counts">{{$count}}<span></div>
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
					  
					  <th class ="text-right">
                          Action
                      </th>
					  
                      
                  </tr>
              </thead>
              <tbody>
              <?php $i=0; ?>
                 
				@foreach($users as $user)
				@if(!empty($user))
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
                          
                          <a class="btn btn-info btn-xs edit-btn" title="Update" href="{{ route('admin.users.edit', $user->id)}}"><i class="fas fa-pencil-alt"></i></a>
                              
                           
						  
						 
                          <form action="{{route('admin.users.destroy', $user->id)}}" method="post">
							@csrf
							@method('DELETE')
						 <button  class="btn btn-danger btn-xs delete-btn" type="submit" title="Delete" onclick="return confirm('Do you want to delete ?')" ><i class="fa fa-trash" aria-hidden="true" ></i></button>
						</form>
						
                      </td>
					 
                  </tr>
                  @endif
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

       <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
function getroleChange(userid,roleid)
{
	
	$('select').on('change', function (e) {
	
    var optionSelected = $("option:selected", this);
    var role_id = this.value;
	var uid = userid;
    $.ajax({
            url: "{{ route('admin.userrole') }}",
            type: "post",
            data: { "id":role_id,"userid":uid,"_token": "{{ csrf_token() }}"} ,
            success: function (response) {
               console.log(response);
              return false;
            },
        });
});
	
	
}

/*





    $('.role').change(function(){
		alert('test');
        var role_id = this.val();
		console.log(role_id);
       $.ajax({
            url: "{{ route('admin.userrole') }}",
            type: "post",
            data: { "id":role_id,"_token": "{{ csrf_token() }}"} ,
            success: function (response) {
               console.log(response);
              return false;
            },
        });
    });
	*/
	</script>
@endsection