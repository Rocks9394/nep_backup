@extends('admin.layouts.app')
@section('title', 'Class-Skills - Goforfit')

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

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
		
          <div class="card-tools">
			  <a href="{{ route('admin.clsskill') }}"> <input type="submit" value="Add New Class-Skill" class="btn btn-success float-right"> </a>
          </div>
		  
		  
        </div>
		
        <div class="card-body table-responsive p-0">
         <table class="table table-striped projects">
              <thead>
                  <tr class="thead-dark">
                    <th scope="col">#</th>
                    <th scope="col">Skill Area</th>
                   
                    <th scope="col">Class</th>
                  </tr>
              </thead>
              <tbody>
              <?php $i=0; ?>
                 @foreach($skills as $skill)
                  <tr>
                    <th scope="row">{{++$i}}</th>
                    <td>
                        
                      {{$skill->name}}
                              
                      </td>
                       
                     <td style="width:120px;display:inline-flex !important;">  
            &nbsp;<a style="display: inline !important;" class="btn btn-info btn-xs" href="{{ route('admin.skills.edit',$skill->id) }}"> <i class="fas fa-pencil-alt"></i></a>
            &nbsp;&nbsp;
            <form action="{{ route('admin.skills.destroy',$skill->id) }}" method="POST">
              @csrf
              @method('DELETE')
             <button  style="display: inline !important;" class="btn btn-danger btn-xs" type="submit" onclick="return confirm('Do you want to delete ?')"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp;</button>
             </form> </td>        
                      
                  </tr>
                  @endforeach
 
              </tbody>
          </table>

        <div class="d-flex justify-content-center">
       
        </div>    
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
	
  </div>


@endsection