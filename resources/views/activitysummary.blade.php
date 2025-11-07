@extends('layouts.app')
@section('title','Status')
@section('content')
<style>
#center {
  margin-left: auto;
  margin-right: auto;
  width:80%;
  height:100%;
}
.add-act-btn-div{ margin-top:24px; }
</style>

<div class="wrapper">
	<div class="container">
   

    <div id="content">
      
      
		 <form method="get" action="{{ route('activitysummary') }}" id="add-activity">

                @csrf

<br>
                

                    <div class="col-md-12">
                        <div class="row">
						
						
						
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
									
									$achapters ='<option value="">Chapter</option>';
									if(!empty($chapters)){								
										foreach($chapters as $cls){	
											$achapters.= '<option value="'.$cls->id.'" ';
											if(!empty($_GET['chapter'])){
												if($cls->id == $_GET['chapter']){ $achapters.= ' selected'; $achaptername = $cls->name; }
											} 
											$achapters.= ' >'.$cls->name.'</option>'; 								
										} 
									}
									
									
								?>
								
								
						
										<div class="col-md-3 offset-md-1">
											
											
											<select class="form-control selctopt clsopt @error('aclass') is-invalid @enderror" name="aclass" id="id_class0" onchange="getsubjects(0,this.value)">
												<?=$aclasses?>
											</select>
										
										</div>
										
										<div class="col-md-3">
											
											<select class="form-control selctopt" id="id_subject0" name="subject" onchange="getchapters(0,this.value)" >
												<?=$asubjects?>
											</select>
											
											
										</div>
										
										<div class="col-md-3">
											
											<select class="form-control selctopt" id="id_chapter0" name="chapter" onchange="getconcepts(0,this.value)" >
												<?=$achapters?>
											</select>	
											
										</div>
										
										<div class="col-md-2">
										 
											
											<button type="submit" name="search" value="search" class="add-act-link btn btn-md btn-primary  add-act-btn">Search</button>
											
										
										</div>
						</div>
							
							
						
					</div>
				
				
		 </form>
		 <div class="clearfix"><br><br></div>
		 
		 
		 
		  <div class="row">

                    <div class="col-md-12" >
					<div class="table-responsive"> 
					<table class="table table-bordered "   id="center">
						<thead>
							<tr>
								<th scope="col">Class</th>
								<th scope="col">Subject</th>
								<th scope="col">Chapter</th>
								<th scope="col">Concept</th>
								<th scope="col">Activity Details</th>
								<th scope="col">Activity Created By</th>
							</tr>
						</thead>
						
						<tbody>
						     @foreach($activities as $act)
							<tr>
							
								<th scope="row">{{$act->clsname}}</th>
								<td>{{$act->subjectname}}</td>
								
								<td>{{$act->chaptername}} </td>
								
								<td>{{$act->chaptername}}</td>
								
								<td>
								@if(!empty($act->title))
								<a href="{{route('actconcepts', $act->act_id)}}" target="_blank">{{ $act->title }}</a>
								@else
								<span style="color:red">Yet to submit</span>
								@endif
								</td>
								
								<td>
								@if(!empty($act->user_id))
									@foreach($users as $user)
										@if( $user->uid  ==  $act->user_id )
								
											{{$user->name}}<br>
											{{$user->email}}<br>
											{{$user->phone}}
									
										
										
							    
										@endif
									@endforeach
								@endif
								</td>
							
							</tr>
							
							@endforeach
						</tbody>
					 </table>
					</div>
					</div>
		  </div>
		   <div class="d-flex justify-content-center">{{$activities->appends(request()->input())->links()}}</div>
		   
	</div>
  </div>
</div>
					
					
@endsection