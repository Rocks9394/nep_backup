@extends('layouts.app')
@section('title','Status')
@section('content')
<style>
#center {
  margin-left: auto;
  margin-right: auto;
  width:150%;
  height:130%;
}
.add-act-btn-div{ margin-top:24px; }
</style>
<div class="wrapper">
	<div class="container">
   

    <div id="content">
      
      
		 <form method="get" action="{{ route('userstatus') }}" id="add-activity">

                @csrf

<br>
                <div class="row">

                    <div class="col-md-12">
                        <div class="row">
										<div class="col-md-3 offset-md-2">
											
											<label class="">Region</label>
											<select id="region" name="region" aria-required="true" 
											class="form-control " value="{{ old('region') }}">
											<option value="" >Choose Region</option> 
											
												@foreach($regions as $region){
												<option value="{{$region->id}}" >{{ $region->name }}</option>                              
												@endforeach
											</select>
											
											
											
										
										</div>
										
										<div class="col-md-3">
											
											<label class="">Subject</label>
											<select id="subject" name="subject" aria-required="true" 
											class="form-control " value="{{ old('subject') }}">
											<option value="" >Choose Subject</option> 
											
												@foreach($subjects as $subject)
												<option value="{{$subject->name }}" >{{$subject->name }}</option>                              
												@endforeach
											</select>
											
											
										</div>
										
										<div class="col-md-3">
										 
											<div class="action-btns add-act-btn-div">
											<button type="submit" name="search" value="search" class="add-act-link btn btn-md btn-primary add-act-btn">Search</button>
											</div>
										
										</div>
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
								<th scope="col">RO</th>
								<th scope="col">Name Of Teacher</th>
								<th scope="col">School Name</th>
								<th scope="col">Subject Name</th>
								<th scope="col">User Info</th>
								<th scope="col">Class/Subject/Chapter</th>
								<th scope="col">Activity Created</th>
								<th scope="col">Comment</th>
								
							</tr>
						</thead>
						
						<tbody>
						    @foreach($status as $st)
							<tr>
							
								<th scope="row">{{ $st->regionname }}</th>
								<td>{{ $st->name }}</td>
								
								<td>{{ $st->school_name }} </td>
								
								<td>@if(!empty($st->subjectname))
								{{ $st->subjectname }}
								@else
									---
								@endif
								</td>
								
								<td>{{ $st->phone }}
								<br>
								{{ $st->email }}</td>
								
								
									<td>
									@if(!empty($st->actid))
								
									@foreach($academics as $academic)
										@if($st->actid  ==  $academic->act_id )
								
											{{$academic->clsname}}/{{$academic->subjectname}}/{{$academic->chaptername}}
									
										
										
							    
										@endif
									@endforeach
									@endif
								</td>
								
								
								<td>
								@if(!empty($st->title))
								<a href="{{route('actconcepts', $st->actid)}}" target="_blank">{{ $st->title }}</a>
								@else
								<span style="color:red">Yet to submit</span>
								@endif
								</td>
								
								<td>
									@if(!empty($st->actid))
								
									@foreach($academics as $academic)
										@if($st->actid  ==  $academic->activity_id )
											<?php echo strip_tags("$academic->comment"); ?>
											
									
										
										
							    
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
		   <div class="d-flex justify-content-center">{{$status->appends(request()->input())->links()}}</div>
	</div>
  </div>
</div>
					
					
@endsection