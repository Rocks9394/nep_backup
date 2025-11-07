@extends('admin.layouts.app')
@section('title', 'Sports Skill - Goforfit')

@section('content')
<style>
.mb-3{ margin-bottom: 0 !important; margin-right: 10px; }
.btn-sm{ padding: .375rem .75rem; }
.rtside{ float:right; }
</style>
<div class="content-wrapper">
    <section class="content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-2">
					<h1 class="act-header">Sports/Skills</h1>					
					   <a href="{{ route('admin.sportskills.create') }}"> <input type="submit" value="Add New Sport" class="btn btn-success float-right"> </a>
				</div>
				<div class="col-md-10">
					
				</div>
			</div>
		</div>
    </section>
	
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <div class="card-tools">
			 <a href="{{ route('admin.sportskills.create') }}"> <input type="submit" value="Add New Sport" class="btn btn-success float-right"> </a>
          </div>
        </div>
		
        <div class="card-body table-responsive p-0">
         <table class="table table-striped projects">
              <thead>
                  <tr class="thead-dark">
                    <th scope="col">#</th>
                    <th scope="col"></th>
                   
                    <th scope="col">Action</th>
                  </tr>
              </thead>
              <tbody>
              <?php $i=0; ?>
                
				
                  <tr>
                    <th scope="row">{{++$i}}</th>
                    <td>
                        
                      
                              
                      </td>
                       
                            
                      
                  </tr>
                 
 
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