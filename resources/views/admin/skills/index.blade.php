@extends('admin.layouts.app')
@section('title', 'Skills - Goforfit')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-2">
					<h1 class="act-header">Skills</h1>					
					 <a href="{{ route('admin.skills.create') }}" class="create-btn"> <input type="submit" value="Add" class="btn btn-sm btn-success "></a>
				</div>
				<div class="col-md-10">
					
				</div>
			</div>
		</div>
    </section>
	
   
    <section class="content">
  <div class="container-fluid">
	<div class="row">
	  <div class="col-md-12">
      <div class="card"> 
	  
		<div class="card-header filter-head">  
		  <div class="row"> 
				<div class="col-md-12">
				</div>
		  </div>
		</div>
			
         
		  
		  <div class="row"> 
			<div class="col-12 div-count">
				<div class="fltr-count">SkillAreas Found: <span class="no-counts"><span></div>
			</div>
        </div>	
		
        <div class="card-body table-responsive p-0">
         <table class="table table-striped projects table-grid">
              <thead>
                  <tr class="thead-dark">
                    <th scope="col">#</th>
                    <th scope="col">Skill Area</th>
					 <th scope="col">Class</th>
                   
                    <th scope="col">Action</th>
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
					   <td>
                        
                      <span class="tag">
					  <?php
						$classes = array_unique(explode(",", $skill->cls));
						if(!empty($classes)){
							foreach($classes as $clss){
								if(!empty($clss)){
									
									$clss = (int) $clss;
									
									echo '<span class="tag">'.$classarr[$clss]["name"].'</span>';
								}
							}
						}
						?>
					  </span>
                              
                      </td>
                       
                   <td>  
            <a  class="btn btn-info btn-xs edit-btn" href="{{ route('admin.skills.edit',$skill->id) }}"> <i class="fas fa-pencil-alt"></i></a>
           <?php /*
            <form action="{{ route('admin.skills.destroy',$skill->id) }}" method="POST">
              @csrf
              @method('DELETE')
             <button  class="btn btn-danger btn-xs delete-btn" type="submit" onclick="return confirm('Do you want to delete ?')"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp;</button>
             </form> */ ?>
			 
			 </td>
                  @endforeach
				  
				     
                  </tr>
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