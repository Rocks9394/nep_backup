@extends('admin.layouts.app')
@section('title', 'Teacher - Goforfit')

@section('content')

<div class="content-wrapper" id="class-main">
    <!-- Content Header (Page header) -->
  <section class="content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<h1 class="act-header">All Users</h1>					
					 <a href="{{ route('admin.users.create') }}" class="create-btn"> <input type="submit" value="Add" class="btn btn-sm btn-success "></a>
				</div>
			</div>
		</div>
    </section>
	
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        
		
		<div class="row"> 
					<div class="col-12 div-count">
						<div class="fltr-count">Users: <span class="no-counts"><span></div>
					</div>
				</div>
        <div class="card-body table-responsive p-0">
					<table class="table table-striped projects table-grid">
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
                      
                      
                      <td class="project-actions text-right">
                          
                          <a class="btn btn-info btn-xs edit-btn" title="Update" href="{{ route('admin.users.edit', $user->id)}}"><i class="fas fa-pencil-alt"></i></a>
                              
                           
						  
						 
                          <form action="{{route('admin.users.destroy', $user->id)}}" method="post">
							@csrf
							@method('DELETE')
						 <button  class="btn btn-danger btn-xs delete-btn" type="submit" title="Delete" onclick="return confirm('Do you want to delete ?')" ><i class="fa fa-trash" aria-hidden="true" ></i></button>
						</form>
						
                      </td>
					 
                  </tr>
                  
				@endforeach
                  
                  
              </tbody>
          </table>
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