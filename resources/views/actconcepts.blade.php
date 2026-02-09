@extends('layouts.app')
@section('title', 'Academic')
@section('content')
	

   <?php if(!empty($activity[0])){ ?>
    <div class="">         
        <!--<div class="pg-yallow-1-3"></div>-->
        <nav aria-label="breadcrumb">
        <div class="container">
            <ol class="breadcrumb">
               <li class="breadcrumb-item"><a href="{{ url('sport')}}">{{ $title }}</a></li>
               <li class="breadcrumb-item active" aria-current="page">{{ $activity[0]->title }}</li>
            </ol>
   </div>
        </nav>		
        <div class="container">
            <div class="concepts-area">
                <div class="row">
                    <div class="col-12 col-lg-4">
                        <div class="card card-details ml-0 ml-lg-3">
                          <button class="goback back-btn" onclick="goBack()"><img src="{{ asset('resources/images').'/'.'back-arrow.png'}}" alt=""><span class="back-to-chptr"><svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd"><path d="M2.117 12l7.527 6.235-.644.765-9-7.521 9-7.479.645.764-7.529 6.236h21.884v1h-21.883z"/></svg>Back to Chapters</span></button>
						   <?php
						   
							$word = "wp-content";										
							if(strpos($activity[0]->image, $word)!== false){ ?>
							 <figure><img class="card-img-top" src="{{ $activity[0]->image }}" alt="Card image cap"></figure>
							<?php } else if(file_exists('public/uploads/'.$activity[0]->image)){ ?>
                                <figure><img class="card-img-top" src="{{ asset('public/uploads').'/'.$activity[0]->image }}" alt="Card image cap">	</figure>						
							<?php } else{ ?>				 
                                <figure><img  class="card-img-top" src="{{ asset('resources/images').'/'.'default-chapter-img.png' }}" alt="Card image cap"></figure>
							<?php } ?>														
							<div class="card-body chapter-dtls">
                                <!--<span class="no-concents">{{$total}} Activities</span>-->
                                <p class="chapter-info-txt">Activity</p>
                                <h1 class="chapter-heading">{{ $activity[0]->title }}</h1>
                                <p class="card-text"><?php //echo preg_replace('/[^(\x20-\x7F)\x0A\x0D]*/','', $activity[0]->description);?></p>
                            </div>
							
							<?php 
							//echo "<pre>";
							//print_r($actconcepts);
							//die('0----777');
							
							?>
							
							 @if(!empty($actconcepts))
						<div style="background-color:#eee;color:black;padding:16px;">
								
										
										@foreach($actconcepts as $cls)
											
										<strong>{{ $cls->clsname }} </strong>&nbsp;
										
										<strong>{{  $cls->subjectname  }} </strong>
										<br>Chapter:
										<strong>{{  $cls->chaptername }}</strong><br>
										Concept:
										<strong>{{  $cls->conceptname  }}</strong><br>
										<br>
										@endforeach
							
							
							@endif
							
							<div class="clearfix"></div>
							@if(!empty($acttechniques))	
							
														
								@foreach($acttechniques as $cls)
								
								
								Class:
								<strong>{{ $cls->clsname }}</strong>&nbsp; 

								
									
								<br>Skill:
								<strong>{{ $cls->skillareaname }}</strong>&nbsp; 
								<br>Sports:
								<strong>{{ $cls->sportsname }}</strong><br>
								Technique:
								<strong>{{ $cls->techniquename }}</strong><br>
								<br>
								@endforeach
							
								</div>
								@endif
							
							
                        </div>
						
                     </div>
					
					 <div class="col-12 col-lg-8">					
                        <div class="row">
                            <div class="col">
                                <div onclick="copyContent()" class="mt-3 activity-rw heading-rw" onclick="myFunction()">
                                    <h2 id="myText" >{{ $activity[0]->title }} </h2>

                                </div>
                            </div>
                        </div>					
						
				
						
						
						<div class="activity-dv">
						
						<h3>Learning Outcomes </h3>
                              <p> 
							 
								<?php if(!empty($activity[0]->learning_outcomes)){ ?>						  
						        <?php echo $activity[0]->learning_outcomes;?> 
						        <?php } ?>
							</p>
						
						
						
						 <?php if(!empty($activity[0]->url)){ ?>
						<p>
						 
						<?php
						preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $activity[0]->url, $match);
						$vid = $match[1];
						?>
						 
						  
						 <object width="325" height="250" data="https://www.youtube.com/v/<?php echo $vid; ?>" type="application/x-shockwave-flash"><param name="src"
						 value="https://www.youtube.com/v/<?php echo $vid; ?>" /></object>
						  
						</p>
						 <?php } ?>
                       
						
						<h3>Description Of Activity</h3>
							<p>
							
							  <?php if(!empty($activity[0]->description)){ ?>						  
							  <?php echo $activity[0]->description;?> 
							  <?php } ?>
							</p>
							
							<?php if(!empty($activity[0]->change_it)){ ?>	
							<h3>Variations</h3>
                              <p> 
													  
						        <?php echo $activity[0]->change_it;?> 
						       
							  </p>
							<?php } ?>
							
							
							  <?php if(!empty($activity[0]->coaching)){ ?>
							   <h3>Coaching  Tips</h3>							  
								<span class="hint"><img src="{{asset('resources/images/hint-i.png')}}" alt=""> 
						        <?php echo $activity[0]->coaching;?> 
								</span>
						        <?php } ?>
								

						
						
							<h3>Equipment/Material Required</h3>
                              <p> 
								<?php if(!empty($activity[0]->equipment)){ ?>						  
						        <?php echo $activity[0]->equipment;?> 
						        <?php } ?>
							  </p>
							 						
							
						
                        </div>
                    </div>                    
                </div>
				<br>
				 <div class="row">
				 <form  name="commentactivity" id="commentactivity">
				 @if(Auth::guard('admin')->check() &&  (Auth::guard('admin')->user()->role_id == 4 || Auth::guard('admin')->user()->role_id == 1))
				 <input type="hidden" name="activity_id" id="activity_id" value="{{$activity[0]->id}}">
					<div class="row">
						<div class="col-md-12">
							<div class="row">
								<div class="col-md-8">
											 <label for="exampleInputPassword1">Rate The Activity</label>
											<!--<select class="form-control selctopt" id="rating" name="rating"  style="width:225px">
												 <option value="">Choose to Rate Activity</option>
												 <option value="Relevance of Activity with Sports" >Relevance of Activity with Sports</option>
												 <option value="Relevance of Activity with Subject">Relevance of Activity with Subject</option>
												 <option value="Quality of Activity">Quality of Activity</option>
												 <option value="Creativity">Creativity</option>
												 
											</select>-->
								
								<table class="table table-sm table-borderless " >
								
								<tr>
									<th scope="row">Relevance of Activity with Sports</th>
									<td>
									
								
									<input  id="star1" type="radio" name="star1" value="1"/>
									<label  for="star-5">1</label>
									<input  id="star1" type="radio" name="star1" value="2"/>
									<label  for="star-4">2</label>
									<input  id="star1" type="radio" name="star1" value="3"/>
									<label  for="star-3">3</label>
									<input  id="star1" type="radio" name="star1" value="4"/>
									<label  for="star-2">4</label>
									<input  id="star1" type="radio" name="star1" value="5"/>
									<label  for="star-1">5</label>
  
									
										
									</td>
								</tr>
								<tr>
									<th scope="row">Relevance of Activity with Subject</th>
									<td>
									
								
									<input class="star star-5" id="star2" type="radio" name="star2" value="1"/>
									<label class="star star-5" for="star-5">1</label>
									<input class="star star-4" id="star2" type="radio" name="star2" value="2"/>
									<label class="star star-4" for="star-4">2</label>
									<input class="star star-3" id="star2" type="radio" name="star2" value="3"/>
									<label class="star star-3" for="star-3">3</label>
									<input class="star star-2" id="star2" type="radio" name="star2" value="4"/>
									<label class="star star-2" for="star-2">4</label>
									<input class="star star-1" id="star2" type="radio" name="star2" value="5"/>
									<label class="star star-1" for="star-1">5</label>
  
									
										
									</td>
								</tr>
								<tr>
									<th scope="row">Quality of Activity</th>
									<td>
									
								
									<input class="star star-5" id="star3" type="radio" name="star3" value="1"/>
									<label class="star star-5" for="star-5">1</label>
									<input class="star star-4" id="star3" type="radio" name="star3" value="2"/>
									<label class="star star-4" for="star-4">2</label>
									<input class="star star-3" id="star3" type="radio" name="star3" value="3"/>
									<label class="star star-3" for="star-3">3</label>
									<input class="star star-2" id="star3" type="radio" name="star3" value="4"/>
									<label class="star star-2" for="star-2">4</label>
									<input class="star star-1" id="star3" type="radio" name="star3" value="5"/>
									<label class="star star-1" for="star-1">5</label>
  
									
										
									</td>
								</tr>
								<tr>
									<th scope="row">Creativity</th>
									<td>
									
								
									<input class="star star-5" id="star4" type="radio" name="star4" value="1"/>
									<label class="star star-5" for="star-5">1</label>
									<input class="star star-4" id="star4" type="radio" name="star4" value="2"/>
									<label class="star star-4" for="star-4">2</label>
									<input class="star star-3" id="star4" type="radio" name="star4" value="3"/>
									<label class="star star-3" for="star-3">3</label>
									<input class="star star-2" id="star4" type="radio" name="star4" value="4"/>
									<label class="star star-2" for="star-2">4</label>
									<input class="star star-1" id="star4" type="radio" name="star4" value="5"/>
									<label class="star star-1" for="star-1">5</label>
  
									
										
									</td>
								</tr>
							</table>
						



						
						
						
						
							
	
						</div>
						
						<div class="col-md-4">
							 <label for="exampleInputEmail1" scope="col">Experts Comment</label>
                                <textarea class="form-control" name="comments" id="comments"
                                                placeholder="Experts Comment" style="width:440px;height:210px;background-color:#FFF;">{{ old('comments') }}</textarea>
												
							<label for="exampleInputPassword1" style="height:30px;width:250px;"></label>
							<button type="submit" name="submit" value="submit" id="submit" class="add-act-link btn btn-md btn-primary  add-act-btn" onClick="showMessage()">Submit</button>					
						</div>
						
						
					@endif
							</div>
						</div>
					</div>
					</form>
				
					
			</div>
			
			<div class="row">
				<div class="col-md-12">
					<div class="row">
						<label for="exampleInputPassword1">Comments</label>
						
							<table class="table table-striped" id="tabledetails">
								<thead>
									<tr>
									<th scope="col">Relevance Activity with sports</th>
									<th scope="col">Relevance Activity with subject</th>
									<th scope="col">Quality of Activity</th>
									<th scope="col">Creativity</th>
									<th scope="col">Expert Comment</th>
									
									<th scope="col">Name</th>
									<th scope="col">Action</th>
									
									
									</tr>
								</thead>
								<tbody>
								@if(!empty($comments))
									@foreach($comments as $cmt)
									<tr id="cmt{{$cmt->id}}">
									<td>{{$cmt->activity_sports}}</td>
									<td>{{$cmt->activity_subject}}</td>
									<td>{{$cmt->qualityofactivity}}</td>
									<td>{{$cmt->creativity}}</td>
									<td><?php echo strip_tags("$cmt->comment"); ?></td>
									<td>{{$cmt->name}}</td>
									<td><a href="javascript:void(0)" onclick="deleteComment({{$cmt->id}})" >delete</a>
									

									<a href="javascript:void(0)" onclick="editComment({{$cmt->id}})" >edit</a>
								

									</td>
									
									</tr>
									@endforeach
								@endif
								</tbody>
							</table>
					</div>
				</div>
			</div>




				
						
            </div>
			
		</div>
	</div> 
  <?php } ?>
  
 
  
  
  
  <div class="modal fade" id="commentmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update Comment</h5>
                        <button type="button" id="btn-close" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						
                    </div>
                    <div class="modal-body">
                    <form id="updatecomment">
						@csrf
						<input type="hidden" id="id" name="id">
					
					<div class ="form-group">
					<label for="exampleInputEmail1" scope="col">Experts Comment</label>
					<textarea class="form-control" name="comment" id="comments2"
					placeholder="Experts Comment" style="width:440px;height:210px;background-color:#FFF;">{{ old('comments') }}</textarea>
		
					</div>
					<input type="submit" value="Add" class="btn btn-primary">
					</form>	  
                    </div>
                </div>
            </div>
        </div>
    </div>
	
<script>
  let text = document.getElementById('myText').innerHTML;
  const copyContent = async () => { 
    try {
      await navigator.clipboard.writeText(text);
      console.log('Content copied to clipboard');
    } catch (err) {
      console.error('Failed to copy: ', err);
    }
  }
</script>
	
	
	
	
  <script type="text/javascript">
   function editComment(id)
   {
	   var url = 'https://nep.goforfit.in/editcomment/'+id;
	  
	   console.log(url);
	   $.get(url,function(act_comment){
		   console.log(act_comment.comment);
		   $("#id").val(act_comment.id);
		   $("#comments2").val(act_comment.comment);
		   $("#commentmodal").modal('toggle');
	   });
   }
   
   
   
	$("#updatecomment").submit(function(e){
		e.preventDefault();
		let comments = $("#comments2").val();
		console.log(comments);
		let id = $("#id").val();
		 //var url = 'http://103.65.20.170/goforfit/updatecomment/'+id;
		$.ajax({
			url: 'https://nep.goforfit.in/updatecomment/'+id,
			type: "PUT",
			data:{
				"id":id,
				"comments":comments,
				"_token": "{{csrf_token()}}"
			},
			success:function(response)
			{
				 $('#cmt' + response.id +' td:nth-child(5)').text(response.comment);
				$("#commentmodal").modal('hide');
				$("#updatecomment")[0].reset();
			}
		});
		
	});
			
   </script>
  
 <script type="text/javascript">
	/*$(".btn-primary").click(function() {

		if ($(this).data("closedAll")) {
			$(".collapse").collapse("show");
		} else {
			$(".collapse").collapse("hide");
		}

		// save last state
		$(this).data("closedAll", !$(this).data("closedAll"));
	});

	// init with all closed
	$(".btn-primary").data("closedAll", true);*/
	
	
function goBack() {
  window.history.back();
}
function showMessage()
{
	alert("Comment Submitted successfully!!!");
}

</script>


   <script type="text/javascript">
		$('#commentactivity').on('submit',function(e){
			e.preventDefault();
			let rating = $('#rating').val();
			let comments = $('#comments').val();
			let activity_id = $('#activity_id').val();
			let star1 = $('#star1:checked').val();
			let star2 = $('#star2:checked').val();
			let star3 = $('#star3:checked').val();
			let star4 = $('#star4:checked').val();
			$.ajax({
				url:"{{ route('storecomment') }}",
				type:"POST",
				data:{"_token":"{{ csrf_token() }}","rating":rating,"comments":comments,"activity_id":activity_id,"star1":star1,
				"star2":star2,"star3":star3,"star4":star4},
				success:function(response)
				{
					console.log(response);
					if(response)
					{
						$("#tabledetails tbody").prepend('<tr><td>'+response.activity_sports +'</td><td>'+response.activity_subject+'</td><td>'+response.qualityofactivity+'</td><td>'+response.creativity+'</td><td>'+ response.comment +'</td><td>'+ response.name+'</td></tr>');
					}
				},
			});
		});
   
   </script>
   
   <script>
		function deleteComment(id)
		{
			if(confirm("Do you want to delete?"))
			{
				$.ajax({
					url: 'https://nep.goforfit.in/commentedelte/'+id,
					type:'DELETE',
					data:{
						"_token":"{{ csrf_token() }}",
					},
					success:function(response)
					{
						$("#cmt"+id).remove();
					}
					
				});
			}
		}
		
	</script>	

@endsection