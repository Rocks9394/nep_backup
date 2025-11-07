@extends('layouts.filldart-app')
@section('title', 'Goforfit | ' . $title)
@section('content')


<style type="text/css">
    .session_term .dropdown, .dropup {
        position: relative;
        height: 33px;
        padding: 6px;
    }
</style>


<div id="skill_report1">
    <div class="container">
        <div class="t-mrg2">
            <div class="all-chaptr-cards filter-bx1">
                <div class="row">
                    <div class="col">
                        <a href="#a" onclick="history.back()" class="back-button">
                            <span class="arrow"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16"> <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5" /></svg></span>
                        </a>
                        <div class="heading-rw mt-0" ><h1>{{$title}}</h1></div>
                    </div>
                
                    <div class="col">
                        <div class="session_term d-flex flex-row-reverse">                           

                            <select class="dropdown" name="session_term" id="session_term">
                                <option class="dropdown-item" value="" selected>Session | Term</option>
                                @foreach($SessionAndTerm as $data)
                                  <option class="dropdown-item" value="{{ $data->id }}" >{{ $data->academic_year }} | {{ $data->term_name }}</option>                          
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="student-info">
                    <div class="row">

                        <div class="col-12 col-lg-12 col-xl">
                            <span class="lb">Name:</span>{{ $dailyReportCard['studentProfile']['name'] }}<span></span>
                        </div>
                        <div class="col-6 col-lg-3 col-xl">
                            <span class="lb">Class:</span>{{ $dailyReportCard['studentProfile']['class']  }} - {{$dailyReportCard['studentProfile']['section'] ?? '' }}<span></span>
                        </div>
                        <div class="col-6 col-lg-3 col-xl">
                            <span class="lb">Roll No:</span>{{ $dailyReportCard['studentProfile']['rollno'] }}<span></span>
                        </div>
                        <div class="col-6 col-lg-3 col-xl">
                            <span class="lb">DOB:</span>{{ date('d-M-Y', strtotime($dailyReportCard['studentProfile']['dob'])) ?? 'N.A' }}<span></span>
                        </div>
                        <div class="col-6 col-lg-3 col-xl">
                            <span class="lb">Gender:</span>{{ $dailyReportCard['studentProfile']['gender'] }}<span></span>
                        </div>
                    </div>
                </div>    
            </div>
     
            <div class=""> 
                <div class="row mt-4">               
                    <div class="col-12">                        
                        <div class="row activity_cards mb-5" id="report_card_container">
                            @include('parent.partials.daily_tracker_details', ['dailyReportCard' => $dailyReportCard])
                        </div>                       
                    </div>                
                </div>
            </div>
        </div>
    </div>
</div>


<!-- The Modal -->
    <div class="modal" id="activityDetailId">
       <div class="modal-dialog modal-lg modal-xl modal-dialog-scrollable">
          <div class="modal-content">
             <!-- Modal Header -->
             <div class="modal-header">
                <!-- <h2>Activity Info</h2> -->
                <h3 class="modal-title" id="model-title-id"></h3>
             </div>
             <button type="button" class="close" data-dismiss="modal">×</button>
             <div id="modal-image-id"></div>
             <!-- Modal body -->
             <div class="modal-body pt-0 pb-4 px-4 mt-3">
                <div class="activity-details mb-4">
                   <div class="act__video">
                      <iframe id="youtubeurl_id" src="https://www.youtube.com/embed/QUTYxwTsbiM?si=KHp-2Z1yYZFHCzJS" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                   </div>
                   <div class="img-act">
                      <img id="modal-image" src="" alt="Activity Image" class="img-fluid mb-3">
                   </div>
                   <div class="f-row">
                      <p id="is-activity-happend"></p>
                      <div class="std-info mb-4">
                         <p>Class: <span id="model-cls-sec-id"></span></p>
                         <p>Skill Area: <span id="model-skill-area-id">Skill Area</span></p>
                         <p>Skill/ Sports: <span id="model-sports-id">Sports</span></p>
                         <p>Techniques: <span id="model-technique-id">Sudden Change of direction</span></p>
                      </div>
                      <div class="break-line pt-3 pb-2 my-3" id="learning_outcomes_parent_id">
                         <h4>Learning Outcomes</h4>
                         <p id="learning_outcomes_id" class="l-cum"></p>
                      </div>
                   </div>
                </div>
                <div class="description break-line" id="model-description-parent_id">
                   <h4>Description</h4>
                   <p id="model-description-id" class="des-txt"></p>
                </div>
                <div class="break-line pt-3 pb-2 my-3" id="change_it_parent_id">
                   <h4>Variation</h4>
                   <p id="change_it_id"></p>
                </div>
                <div class="break-line pt-3 pb-2 my-3" id="coaching_parent_id">
                   <h4>Coaching/Teaching Tips</h4>
                   <p id="coaching_id"></p>
                </div>
                <div class="break-line pt-3 pb-2 my-3" id="equipment_parent_id">
                   <h4>Equipment</h4>
                   <p id="equipment_id"></p>
                </div>
             </div>
             <!-- Modal footer -->
             <!-- <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
                -->
          </div>
       </div>
    </div>
<!-- End The Model -->
  
  
<script>
  function modelContent(ActivityId, skillarea, sports, technique, ClassSectionName, TickMark=true) 
  { 			   
	
        jQuery.ajax({
            url: "{{ route('lession.plan.details') }}",
            data: {
                "activiy_id": ActivityId,
                "_token": "{{ csrf_token() }}"
            },
            type: 'GET',
            success: function(response) 
            {
				      console.log('kumar', response)
			
                $.each(response.activityDetail, function(key, val) 
                {
						console.log('daily ',val.final_image)
                        /*
						var word = "wp-content"; 
						var img = imagepath ='';
						var mystring = val.image;
						
						
						if(mystring.indexOf(word) !== -1) 
						{ 
						    imagepath = val.image;
						}
						else if(val.image == '')
						{
					    	imagepath = 'public/change-activities/default_activity_img.svg';	
						}else
						{
						    imagepath = 'public/uploads/'+val.image;
						}

						$("#modal-image").attr("src", imagepath);
                        */

                        $("#modal-image").attr("src", val.final_image);

                        //jQuery('#student_id').append(content);
                        $("#model-title-id").html(val.title.toUpperCase());   
						
						if(val.description && val.description.length > 0)
						{
						  $("#model-description-parent_id").show();	
                          $("#model-description-id").html(val.description);
                        }else
						{
						 $("#model-description-parent_id").hide();
						}
						
						
					    if(val.learning_outcomes && val.learning_outcomes.length > 0)
						{	
						  $("#learning_outcomes_parent_id").show();	
                          $("#learning_outcomes_id").html(val.learning_outcomes);
						}else
						{
							$("#learning_outcomes_parent_id").hide();
						}
						
						if(val.change_it && val.change_it.length > 0)
						{
						 $("#change_it_parent_id").show();
                         $("#change_it_id").html(val.change_it);	
						}
						else
						{
						  $("#change_it_parent_id").hide();
						}
						
						
						if (val.coaching && val.coaching.length > 0) 
						{
						 $("#coaching_parent_id").show();
                         $("#coaching_id").html(val.coaching);
						}
						else
						{
						 $("#coaching_parent_id").hide();
						}
						
						if (val.equipment && val.equipment.length > 0) 
						{
						 $("#equipment_parent_id").show();
                         $("#equipment_id").html(val.equipment);
						}
						else
						{
						 $("#equipment_parent_id").hide();
						}
						

                        
						
						
                        $("#youtubeurl_id").attr("src",val.url);
						$('#activityDetailId').modal('show');
						$('#model-skill-area-id').html(skillarea);
						$('#model-sports-id').html(sports);
						$('#model-technique-id').html(technique);
						$('#model-cls-sec-id').html(ClassSectionName);
						if(TickMark == 'active-completed')
						 $('#is-activity-happend').addClass(TickMark).html('<span>Completed</span>');
					    else 
						 $('#is-activity-happend').addClass('').text('');
					
						
						
						
						
						var src = $("#youtubeurl_id").attr('src');
						if (src && src.length > 0) 
						{
						 $(".img-act").hide();
						 $(".act__video").show();
						}else
						{
						 $(".act__video").hide();
						 $(".img-act").show();
						}
						
                });


            }
        });
	  
  }



    $('#session_term').on('change', function () {
        let sessionTermId = $(this).val();

        if (sessionTermId) {
            $.ajax({
                url: "{{ route('skill.dailyreport') }}",
                type: 'GET',
                data: { session_term_id: sessionTermId },
                beforeSend: function() {
                    $('#report_card_container').html('<div class="text-center">Loading...</div>');
                },
                success: function (response) {
                    $('#report_card_container').html(response.html);
                },
                error: function () {
                    $('#report_card_container').html('<div class="text-danger">Something went wrong.</div>');
                }
            });
        }
    });



</script>


@endsection