@extends('layouts.filldart-app')
@section('title', 'Goforfit | ' . $title)
@section('content')

@php
    $user = null;
    if(auth()->guard('web')->check()) {
        $user = auth()->guard('web')->user();
    } elseif(auth()->guard('sstudent')->check()) {
        $user = auth()->guard('sstudent')->user();
    }
@endphp



@if(Auth::user()->role_id == '4')

	{{--
    <marquee behavior="scroll" direction="left" scrollamount="5" onmouseover="this.stop()" onmouseout="this.start()" style="font-size: 16px;
    font-weight: 500;
    background-color: #ff8000;
    color: #fff;
    padding: 4px;">
	  <strong>Important Notice: </strong><span>Please check the highlighted students in the Manage Student module and correct their DOB before starting the assessment. If all are already updated or no students are highlighted, you may ignore this notice.</span>
	</marquee>

	--}}

@elseif(Auth::user()->role_id == '3')
	<marquee behavior="scroll" direction="left" scrollamount="5" onmouseover="this.stop()" onmouseout="this.start()" style="font-size: 16px;
	font-weight: 500;
	background-color: #ff8000;
	color: #fff;
	padding: 4px;">
	<strong>Important Notice: </strong><span>Kindly update your profile details (email, mobile number, and date of birth) in the Edit Profile section. If all details are already updated, please ignore this notice.</span>
</marquee>
@endif



<div class="container">
    <div class="t-mrg">
        <div class="row text-center justify-content-md-center">
            <div class="col-12 col-md-12 col-lg-12 col-xl-10">
                <div class="form-row" style="justify-content: center;">

				    @php  $getActiveTerm = Helper::getActiveTerm();  @endphp





                	<!-- Trainers Dashboard  -->
                    @if((Auth::user()->role_id == '3' && $hasSchools) && (Auth::user()->role_id == '3' && $getActiveTerm))

	                    <div class="col-4 col-md-3 col-lg-2 col-xl-2 mb-4" data-id="{{ Auth::user()->role_id }}">
	                        <a href="{{ route('fill.dart') }}" class="box"><div><img class="img-fluid" alt="" src="{{asset('public/uploads/icons/Dart.svg') }}"></div><span>Fill DART</span></a>
	                    </div>

	                    <div class="col-4 col-md-3 col-lg-2 col-xl-2 mb-4">
	                        <a href="{{ route('view-trainer') }}" data-id="" class="box"><div><img class="img-fluid" alt="" src="{{asset('public/uploads/icons/viewDart.svg') }}"></div><span>View DART</span></a>
	                    </div>
	              
	                    <div class="col-4 col-md-3 col-lg-2 col-xl-2 mb-4">
	                        <a href="{{ route('activity.according.to.class') }}" class="box"><div><img class="img-fluid" alt="" src="{{asset('public/uploads/icons/activities.svg') }}"></div><span>Activity Planner</span></a>
	                    </div>
	                    	                  
	                    <div class="col-4 col-md-3 col-lg-2 col-xl-2 mb-4">
	                        <a href="{{ route('map.sports') }}" class="box"><div><img class="img-fluid" alt="" src="{{asset('public/uploads/icons/MAP-Students.svg') }}"></div><span>Map Students</span></a>
	                    </div>
	                 		                 	
	                    <div class="col-4 col-md-3 col-lg-2 col-xl-2 mb-4">
	                        <a href="{{ route('all-test') }}" class="box"><div><img class="img-fluid" alt="" src="{{asset('public/uploads/icons/taketest.svg') }}"></div><span>Take Test</span></a>
	                    </div>                  
	 	                    
	                    <div class="col-4 col-md-3 col-lg-2 col-xl-2 mb-4">
							<a href="{{ route('trainer.lowerclass.status') }}" class="box"><div>
							<img class="img-fluid" alt="" src="{{asset('public/uploads/icons/lc_test-status.svg') }}"></div><span>Fitness Test Status <br> (Upto Class-3)</span></a>
						</div>

						<div class="col-4 col-md-3 col-lg-2 col-xl-2 mb-4">
							<a href="{{ route('trainer.higherclass.status') }}" class="box"><div>
							<img class="img-fluid" alt="" src="{{asset('public/uploads/icons/hc_test-status.svg') }}"></div><span>
							Fitness Test Status <br> (Class-4 & Above)</span></a>
						</div>
					@endif


					<!-- School Dashboard -->
                    @if(Auth::user()->role_id == '4')


	                    <div class="col-4 col-md-3 col-lg-2 col-xl-2 mb-4">
	                        <a href="{{ route('viewschooldart') }}" class="box"><div><img class="img-fluid" alt="" src="{{asset('public/uploads/icons/viewDart.svg') }}" ></div><span>View DART</span></a>
	                    </div>

	                    <div class="col-4 col-md-3 col-lg-2 col-xl-2 mb-4">
	                        <a href="{{ route('activity.according.to.class') }}" class="box"><div><img class="img-fluid" alt="" src="{{asset('public/uploads/icons/activities.svg') }}"></div><span>Activity Planner</span></a>
	                    </div>

	                    <div class="col-4 col-md-3 col-lg-2 col-xl-2 mb-4">
							<a href="{{ route('fitness.report') }}" class="box"><div>
							<img class="img-fluid" alt="" src="{{asset('public/uploads/icons/fa.svg') }}"></div><span>Assessment Report</span></a>
						</div>
						<div class="col-4 col-md-3 col-lg-2 col-xl-2 mb-4">
							<a href="{{ route ('trainer.lowerclass.status')}}" class="box"><div>
							<img class="img-fluid" alt="" src="{{asset('public/uploads/icons/lc_test-status.svg') }}"></div><span>Fitness Test Status <br> (Upto Class-3)</span></a>
						</div>

						<div class="col-4 col-md-3 col-lg-2 col-xl-2 mb-4">
							<a href="{{ route ('trainer.higherclass.status')}}" class="box"><div>
							<img class="img-fluid" alt="" src="{{asset('public/uploads/icons/hc_test-status.svg') }}"></div><span>
							Fitness Test Status <br> (Class-4 & Above)</span></a>
						</div>
	                
	                     <div class="col-4 col-md-3 col-lg-2 col-xl-2 mb-4">
	                        <a href="{{ route('managestudent') }}" class="box"><div><img class="img-fluid" alt="" src="{{asset('public/uploads/icons/manage-stds.svg') }}"></div><span>Manage Students</span></a>
	                    </div>
	                    
	                    
	                    <div class="col-4 col-md-3 col-lg-2 col-xl-2 mb-4">
	                        <a href="{{ route('mapping.sports') }}" class="box"><div><img class="img-fluid" alt="" src="{{asset('public/uploads/icons/mapSports.svg') }}"></div><span>Map Sports</span></a>
	                    </div>
						
					
						<div class="col-4 col-md-3 col-lg-2 col-xl-2 mb-4">
	                        <a href="{{ route('students-sports-mapping') }}" class="box"><div><img class="img-fluid" alt="" src="{{asset('public/uploads/icons/activities.svg') }}"></div><span>Students Sport Mapping</span></a>
	                    </div>
	                   
	                    <div class="col-4 col-md-3 col-lg-2 col-xl-2 mb-4">
	                        <a href="{{ route('mapping.trainer') }}" class="box"><div><img class="img-fluid" alt="" src="{{asset('public/uploads/icons/MAP-Students.svg') }}"></div><span>Manage Trainers</span></a>
	                    </div>
	                    
	                    <div class="col-4 col-md-3 col-lg-2 col-xl-2 mb-4">
	                        <a href="{{ route('schoolDashboard') }}" class="box"><div><img class="img-fluid" alt="" src="{{asset('public/uploads/icons/Dashboard.svg') }}"></div><span>Dashboard</span></a>
	                    </div>
	                    	
            			<div class="col-4 col-md-3 col-lg-2 col-xl-2 mb-4">
							<a href="{{ route('create.users') }}" class="box"><div>
							<img class="img-fluid" alt="" src="{{asset('public/uploads/icons/manage-stds.svg') }}"></div><span> Create Viewer </span></a>
						</div>

						<div class="col-4 col-md-3 col-lg-2 col-xl-2 mb-4">
							<a href="{{ route('upload.test.data') }}" class="box"><div>
							<img class="img-fluid" alt="" src="{{asset('public/uploads/icons/taketest.svg') }}"></div><span>Upload Test Data</span></a>
						</div> 
						



						{{-- <div class="col-4 col-md-3 col-lg-2 col-xl-2 mb-4">
							<a href="{{ route('fms.report') }}" class="box"><div>
							<img class="img-fluid" alt="" src="{{asset('public/uploads/icons/fms-report.svg') }}"></div><span>FMS Development </span></a>
						</div>
						
						
						<div class="col-4 col-md-3 col-lg-2 col-xl-2 mb-4">
							<a href="{{ route('test.relay.auth') }}?p=2" class="box"><div>
							<img class="img-fluid" alt="" src="{{asset('public/uploads/icons/age-report.svg') }}"></div><span>Age Wise Performance</span></a>
						</div>
						
						
						<div class="col-4 col-md-3 col-lg-2 col-xl-2 mb-4">
							<a href="{{ route('test.relay.auth') }}?p=3" class="box"><div>
							<img class="img-fluid" alt="" src="{{asset('public/uploads/icons/School-Reports.svg') }}"></div><span>Institute Wise Performance</span></a>
						</div> 
						

						 <div class="col-4 col-md-3 col-lg-2 col-xl-2 mb-4">
							<a href="{{ route('test.relay.auth') }}?p=1" class="box"><div>
							<img class="img-fluid" alt="" src="{{asset('public/uploads/icons/fa.svg') }}"></div><span>Fitness Assessment</span></a>
						</div>


						<div class="col-4 col-md-3 col-lg-2 col-xl-2 mb-4">
							<a href="{{ route('test.relay.auth') }}?p=4" class="box"><div>
							<img class="img-fluid" alt="" src="{{asset('public/uploads/icons/top-performers.svg') }}"></div><span>Top Performers</span></a>
						</div>  

						<div class="col-4 col-md-3 col-lg-2 col-xl-2 mb-4">
							<a href="{{ route('showholiday') }}" class="box"><div>
							<img class="img-fluid" alt="" src="{{asset('public/uploads/icons/viewDart.svg') }}"></div><span> Manage Calendar</span></a>
						</div>
						--}}						
                    @endif


					@if($user && $user->role_id == 2)
					    @forelse($dashboardModules as $module)
					        <div class="col-4 col-md-3 col-lg-2 col-xl-2 mb-4">
					            <a href="{{ route($module->route_name) }}" class="box">
					                <div>
					                    <img class="img-fluid" alt="{{ $module->name }}" src="{{ asset('public/uploads/icons/'.$module->icon) }}">
					                </div>
					                <span>{{ $module->name }}</span>
					            </a>
					        </div>
					    @empty
					        <div class="alert alert-warning text-center mt-4 fixed-bottom">
					            <h6>Your Account is Deactivated</h6>
					            <p>Please contact your school administrator to activate your account.</p>
					        </div>
					    @endforelse
					@endif


					
					@if(!$user || $user->role_id != 2)

						<div class="col-4 col-md-3 col-lg-2 col-xl-2 mb-4">
	                        <a href="{{ route('learn.sports') }}" class="box"><div><img class="img-fluid" alt="" src="{{asset('public/uploads/icons/Learn-Sports.svg') }}"></div><span>Learn Sports</span></a>
	                    </div>

					    <div class="col-4 col-md-3 col-lg-2 col-xl-2 mb-4">
					        <a href="{{ route('getactive') }}" class="box">
					            <div><img class="img-fluid" alt="" src="{{ asset('public/uploads/icons/Get-Active.svg') }}"></div>
					            <span>Get Active</span>
					        </a>
					    </div>

					    <div class="col-4 col-md-3 col-lg-2 col-xl-2 mb-4">
					        <a href="{{ route('admin.manual') }}" target="_blank" class="box">
					            <div><img class="img-fluid" alt="" src="{{ asset('public/uploads/icons/trainer-manual2.svg') }}"></div>
					            <span>Training Manual</span>
					        </a>
					    </div>

					    <div class="col-4 col-md-3 col-lg-2 col-xl-2 mb-4">
					        <a href="{{ route('test.videos') }}" class="box">
					            <div><img class="img-fluid" alt="" src="{{ asset('public/uploads/icons/test-demo.svg') }}"></div>
					            <span>Battery of Tests</span>
					        </a>
					    </div>
					@endif





                    <!-- On Development Phase -->
					@if(Auth::user()->id == 974)
						<!-- href="{{ route('activity.gallary') }}?p=2" -->
						<div class="col-4 col-md-3 col-lg-2 col-xl-2 mb-4" id="activity_gallary">
							<a  href="javascript:void(0);"  class="box" ><div>
							<img class="img-fluid" alt="" src="{{asset('public/uploads/icons/age-report.svg') }}"></div><span>Activity Gallery</span></a>
						</div>
					@endif

					
                </div>
            </div>
        </div>
    </div>
</div>
</div>


@if(!$hasSchools && Auth::user()->role_id == 3)
  <div class="alert alert-warning text-center mt-4 fixed-bottom" >
    <h4>No School Assigned</h4>
    <p>Please contact your school administrator to activate your account.</p>
  </div>
  	
@elseif(!$getActiveTerm && Auth::user()->role_id == 3)
	<div class="alert alert-warning text-center mt-4 fixed-bottom" >
    <h4>No Active Terms</h4>
    <p>Please contact your school administrator to update terms in profile section.</p>
  </div>
@endif


<!-- School Selection Modal -->
@if($hasSchools)

    @if(Auth::user()->role_id == 3 && !Session::get('SelectSchoolId'))
	<div class="modal fade" id="exampleModal" tabindex="-1" data-backdrop='static' role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered model-md" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Choose your school</h5>
		      </div>  
			  
		     <div class="modal-body">
			   <form method="get" name="trainer_select_school" id="trainer_select_school_id" action="{{ route('filldart.dashboard') }}">
					<select name="select_school_id" required class="form-select form-select-lg form-control mx-0 w-100" aria-label=".form-select-lg example">
						<option value="">Select </option>
						  @foreach($SchoolTrainers as $key => $val)
							<option value="{{ $val->id }}">{{ $val->school_name }}</option>
						  @endforeach
					</select>
					<div class="modal-footer p-0 mt-4 border-0">
						<div class="col-auto p-0">
							<button type="submit" class="btn btn-primary px-4">Save</button>
						</div>
					</div>
				</form>
		      </div>	
		  </div>
		</div>
	</div>

	<script>
	$(window).on('load', function() {
		$('#exampleModal').modal('show');
	});

   

    </script>
  @endif
@endif


<script >
	 $('#assessment_report').click(function(){
      
        Swal.fire({
		  title: "Temporarily Unavailable",
		  text: "This feature is temporarily unavailable. Will come back soon.",
		  icon: "info",
		  allowOutsideClick: false,
		  allowEscapeKey: false
		});

      });
</script>
@endsection