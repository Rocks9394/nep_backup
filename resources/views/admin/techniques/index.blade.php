@extends('admin.layouts.app')
@section('title', 'Technique - Goforfit')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-2">
					<h1 class="act-header">Techniques</h1>					
					 <a href="{{ route('admin.techniques.create') }}" class="create-btn"> <input type="submit" value="Add" class="btn btn-sm btn-success "></a>
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
							<form class="form-inline fltr-row " type="get" action="{{ route('admin.techniques.index') }}">				
								
								

							   <?php if(!empty($_GET['name'])){ $name = $_GET['name'];}else{ $name='';  } ?> 
								
								<div class="fltr-srch form-group">                	 
										<input type="search" name="name" value="<?=$name?>" id="name" class="form-control  fltr-txt-bx @error('name') is-invalid @enderror"  placeholder="Search Technique" width="180px">
										
										<button type="submit" class="btn btn-primary btn-sm" name="search" value="search"><i class="fa fa-search" aria-hidden="true"></i></button>
								</div>
									
							</form>
						</div>
					</div>
				</div>
			
         
		  
		  <div class="row"> 
			<div class="col-12 div-count">
				<div class="fltr-count">Techniques Found: <span class="no-counts">{{$count}}<span></div>
			</div>
        </div>	
		
		
        <div class="card-body table-responsive p-0">
         <table class="table table-striped projects">
              <thead>
                  <tr class="thead-dark">
                    <th scope="col">#</th>
                    <th scope="col">Technique Name</th>
					<th scope="col">Class</th>
					<th scope="col">SkillArea</th>
					<th scope="col">Sports/Skill</th>
                    <th scope="col">Action</th>
                  </tr>
              </thead>
              <tbody>
              <?php $i=0; ?>
                 @foreach($techs as $tech)
                  <tr>
                    <th scope="row">{{++$i}}</th>
                    <td>{{$tech->name}}</td>
					<td>
						<?php
						$classes = array_unique(explode(",", $tech->cls));
						if(!empty($classes)){
							foreach($classes as $clss){
								if(!empty($clss)){
									$clss = (int) $clss;
									echo '<span class="tag">'.$classarr[$clss]["name"].'</span>';
								}
							}
						}
						?>
					</td>
					<td>
						<?php
						$skillareas = array_unique(explode(",", $tech->skillarea)); 
						
				
						if(!empty($skillareas))
						{
							foreach($skillareas as $skillarea)
							{
								if(!empty($skillarea))
								{
									$skillarea = (int) $skillarea;
									if(isset($skillareasarr[$skillarea]["name"]))
									{
									 echo '<span class="tag">'.$skillareasarr[$skillarea]["name"].'</span>';
									}else
									{
										
									 //
									 
									}
								}
							}
						}
						?>
					</td>
					
					<td>
						<?php
						$sports = array_unique(explode(",", $tech->sports)); 
						if(!empty($sports)){
							foreach($sports as $sport){
								if(!empty($sport)){
									$sport = (int) $sport;
									if(!empty($sportsarr[$sport]["name"]) && isset($sportsarr[$sport]["name"]))
									{
									  echo '<span class="tag">'.$sportsarr[$sport]["name"].'</span>';
									}else
									{
										echo '<span class="tag">--</span>';
									}
								}
							}
						}
						?>
					</td>
					
                    
            <td>  
            <a class="btn btn-info btn-xs edit-btn" href="{{ route('admin.techniques.edit',$tech->id) }}"> <i class="fas fa-pencil-alt"></i></a>
           <?php /*
            <form action="{{ route('admin.techniques.destroy',$tech->id) }}" method="POST">
              @csrf
              @method('DELETE')
             <button  class="btn btn-danger btn-xs delete-btn" type="submit" onclick="return confirm('Do you want to delete ?')"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp;</button>
             </form> */ ?> 
			 
			 </td>        
                      
                  </tr>
                  @endforeach
 
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