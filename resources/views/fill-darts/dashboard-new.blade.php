@extends('layouts.filldart-app') 
@section('title', $title)
@section('content')

<style>
    html, body {
        height: 100%;
        margin: 0;
        overflow: hidden;
    }
	.stat-card {
        border-radius: 6px;
        padding: 5px 10px;
        color: #fff;
        height: 100px;
        display: flex;
        align-items: center;
    }
    .stat-content {
        width: 70%;
    }
    .stat-card.green { background: #039a48; }
    .stat-card.yellow { background: #ffcb08; }
    .stat-card.blue { background: #007ec6; }
    .stat-card.red { background: #ec0000; }

    .stat-content h3 {
        font-size: 32px;
        font-weight: 700;
        margin: 0;
        color: #fff;
    }

    .stat-content p {        
        color: #fff;
        font-size: 1rem;
        text-transform: uppercase;
        margin: 5px 0 0;
    }
    .stat-icon i {
        font-size: 60px;
        opacity: 0.4;
        transition: transform 0.3s ease, opacity 0.3s ease;
    }
    .stat-icon {
        width: 30%;
        display: flex;
        justify-content: center;
        align-items: center; 
    }
    .stat-card:hover .stat-icon i {
        transform: scale(1.1);
        opacity: 0.7;
    }

    .counter {
        font-size: 2.4rem;
        font-weight: 700;
        margin-top: 10px;
    }
    .stat-card:hover {
        transform: scale(1.05);
    }
    .container-fluid {
        height: 100vh;
        display: flex;
        flex-direction: column;
    }

    .container-fluid > .row {
        flex: 1;
        overflow: hidden;
    }
    .sidebar {
        width: 150px;
        min-width: 150px;
        height: 88%;
        overflow-y: auto;
        background: #f8f9fa;
        border-right: 1px solid #e5e5e5;
    }
    .main-content {
        height: 88%;
        overflow-y: auto;
    }
    .sidebar::-webkit-scrollbar {
        width: 5px;
    }

    .sidebar::-webkit-scrollbar-thumb {
        background: #ccc;
        border-radius: 10px;
    }
    .card-text { font-size: 29px; text-align: center; margin-top: 20px; }
    .card-title { text-align: center; margin-top: 23px; }
    .table thead th { background:#434386; color:#fff; border-bottom:0; }
    .students_count { display:flex; justify-content:center; gap:15px; margin-top:16px; }
    .students_count p { font-weight:500; }

	.card-title {
		font-size: 1rem;
		text-transform: uppercase;
	}

	.counter {
		font-size: 2.5rem;
		font-weight: 700;
	}

    .card {
        padding: 15px;
        margin-bottom: 20px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    #mapChart {
        width: 100%;     /* or any width you want */
        height: 360px;
        position: relative;
        overflow: hidden; 
    }
    #mapTooltip{
        position: absolute;
        display: none;
        background: #fff;
        border: 1px solid #ccc;
        padding: 10px 12px;
        border-radius: 6px;
        font-size: 13px;
        box-shadow: 0 2px 2px rgba(0,0,0,0.05);
        pointer-events: none;
        z-index: 1000;
    }
    #indiaMap {
        width: 100%;
        height: 100%;
    }
    #indiaMap svg {
        width: 100%;
        height: 100%;
        display: block;
        object-fit: contain;
    }

    #indiaMap svg path {
        transition: fill 0.3s ease;
        cursor: pointer;
    }

    .map-legend {
        position: absolute;
        bottom: 20px;
        right: 10px;
        background: #fff;
        padding: 2px 5px;
        border-radius: 6px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
        z-index: 1 !important;
        min-width: 120px;
    }

    .legend-item {
        display: flex;
        align-items: center;
        margin-bottom: 1px;
        font-size: 11px;

    }

    .legend-item:last-child {
        margin-bottom: 0;
    }

    .legend-item span {
        width: 10px;
        height: 10px;
        display: inline-block;
        margin-right: 5px;
        border-radius: 2px;
    }
   .loader-overlay {
        position: absolute;
        top: 40%;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        flex-direction: column;
        align-items: center;
        z-index: 1 !important;
        pointer-events: none;
    }

    .loader-overlay .pulse {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        position: relative;
        margin-bottom: 8px;
    }

    .loader-overlay .pulse::before,
    .loader-overlay .pulse::after {
        content: "";
        position: absolute;
        inset: 0;
        border-radius: 50%;
        border: 6px solid #000;
        animation: pulseRing 1.2s ease-out infinite;
    }

    .loader-overlay .pulse::after {
        animation-delay: 0.8s;
        opacity: 0.5;
    }

    @keyframes pulseRing {
        0% { transform: scale(0.3); opacity: 0.9; }
        100% { transform: scale(1.2); opacity: 0; }
    }

    .loader-overlay p {
        margin: 0;
        font-weight: 500;
        font-size: 14px;
        color: #333;
    }
	.marquee-container {
		width: 100%;
		overflow: hidden;
		background: #f5f5f5;
		padding: 10px 0;
		font-weight: 500;
		background-color: #ff8000;
		color: #fff;
		padding: 4px;
	}

	.marquee {
		display: inline-block;
		white-space: nowrap;
		animation: scroll-left 15s linear infinite;
		
	}

	.marquee span {
		display: inline-block;
		padding-left: 100%;
	}
    .select-terms{
        height: 35px;
        margin-left: 10px;
    }
    .term-select{
        border-color: var(--org-color);
        height: 100%;
        padding: 2px;
        border-radius:5px;
        color: var(--org-color);
    }

	/* Animation */
	@keyframes scroll-left {
		0% {
			transform: translateX(0%);
		}
		100% {
			transform: translateX(-100%);
		}
	}

	/* Pause on hover */
	.marquee-container:hover .marquee {
		animation-play-state: paused;
	}

	@media only screen and (max-width: 768px) {
		.map-legend {
			display: none;
		}
	}
    .highcharts-credits{
        pointer-events: none;
    }
</style>

@if(Auth::user()->role_id == '4')
	<div class="marquee-container">
		<div class="marquee">
		<span><strong>Important Notice: </strong>Please check the highlighted students in the Manage Student module and update their details.</span>
		</div>
	</div>
@elseif(Auth::user()->role_id == '3')
	<div class="marquee-container">
		<div class="marquee">
		<span><strong>Important Notice: </strong>Kindly update your profile details (email, mobile number, and date of birth) in the Edit Profile section. If all details are already updated, please ignore this notice.</span>
		</div>
	</div>
@endif


@if(session('show_profile_update_popup'))
	<script>
		document.addEventListener("DOMContentLoaded", function() {
			Swal.fire({
				title: 'Profile Update Required',
				text: 'Kindly update your profile.',
				icon: 'warning',
				confirmButtonText: 'Update Now',
				cancelButtonText: 'Skip',
				showCancelButton: true,
				allowOutsideClick: false
			}).then((result) => {
				if (result.isConfirmed) {
					window.location.href = "{{ session('profile_update_route') }}";
				}
			});
		});
	</script>
@endif
<div class="container-fluid">
    <div class="row">

        <!-- SIDEBAR -->
        <div class="col-auto sidebar pt-4 pb-4">
            <div class="d-flex flex-column justify-content-md-center text-center">
            
                @php  $getActiveTerm = Helper::getActiveTerm();  @endphp


                	<!-- Trainers Dashboard  -->
                    @if((Auth::user()->role_id == '3' && $hasSchools) && (Auth::user()->role_id == '3' && $getActiveTerm))

	                    <div data-id="{{ Auth::user()->role_id }}">
	                        <a href="{{ route('fill.dart') }}" class="box"><div><img class="img-fluid" alt="" src="{{asset('public/uploads/icons/Dart.svg') }}"></div><span>Fill DART</span></a>
	                    </div>

	                    <div>
	                        <a href="{{ route('viewschooldart') }}" data-id="" class="box"><div><img class="img-fluid" alt="" src="{{asset('public/uploads/icons/viewDart.svg') }}"></div><span>View DART</span></a>
	                    </div>
	              
	                    <div>
	                        <a href="{{ route('activity.according.to.class') }}" class="box"><div><img class="img-fluid" alt="" src="{{asset('public/uploads/icons/activities.svg') }}"></div><span>Activity Planner</span></a>
	                    </div>
	                    	                  
	                    <div>
	                        <a href="{{ route('map.sports') }}" class="box"><div><img class="img-fluid" alt="" src="{{asset('public/uploads/icons/MAP-Students.svg') }}"></div><span>Map Students</span></a>
	                    </div>
	                 		                 	
	                    <div>
	                        <a href="{{ route('all-test') }}" class="box"><div><img class="img-fluid" alt="" src="{{asset('public/uploads/icons/taketest.svg') }}"></div><span>Take Test</span></a>
	                    </div>                  
	 	                    
	                    <div>
							<a href="{{ route('trainer.lowerclass.status') }}" class="box"><div>
							<img class="img-fluid" alt="" src="{{asset('public/uploads/icons/lc_test-status.svg') }}"></div><span>Test Summary <br> (Upto Class-3)</span></a>
						</div>

						<div>
							<a href="{{ route('trainer.higherclass.status') }}" class="box"><div>
							<img class="img-fluid" alt="" src="{{asset('public/uploads/icons/hc_test-status.svg') }}"></div><span>
							Test Summary <br> (Class-4 & Above)</span></a>
						</div>
					@endif


					<!-- School Dashboard -->
                    @if(Auth::user()->role_id == '4')


	                    <div>
	                        <a href="{{ route('viewschooldart') }}" class="box"><div><img class="img-fluid" alt="" src="{{asset('public/uploads/icons/viewDart.svg') }}" ></div><span>View DART</span></a>
	                    </div>

	                    <div>
	                        <a href="{{ route('activity.according.to.class') }}" class="box"><div><img class="img-fluid" alt="" src="{{asset('public/uploads/icons/activities.svg') }}"></div><span>Activity Planner</span></a>
	                    </div>

	                    <div>
							<a href="{{ route('fitness.report') }}" class="box"><div>
							<img class="img-fluid" alt="" src="{{asset('public/uploads/icons/fa.svg') }}"></div><span>Assessment Reports</span></a>
						</div>
						<div>
							<a href="{{ route ('trainer.lowerclass.status')}}" class="box"><div>
							<img class="img-fluid" alt="" src="{{asset('public/uploads/icons/lc_test-status.svg') }}"></div><span>Test Summary <br> (Upto Class-3)</span></a>
						</div>

						<div>
							<a href="{{ route ('trainer.higherclass.status')}}" class="box"><div>
							<img class="img-fluid" alt="" src="{{asset('public/uploads/icons/hc_test-status.svg') }}"></div><span>
							Test Summary <br> (Class-4 & Above)</span></a>
						</div>
	                
	                     <div>
	                        <a href="{{ route('managestudent') }}" class="box"><div><img class="img-fluid" alt="" src="{{asset('public/uploads/icons/manage-stds.svg') }}"></div><span>Manage Students</span></a>
	                    </div>
	                    
	                    
	                    <div>
	                        <a href="{{ route('mapping.sports') }}" class="box"><div><img class="img-fluid" alt="" src="{{asset('public/uploads/icons/mapSports.svg') }}"></div><span>Map Sports</span></a>
	                    </div>
						
					
						<div>
	                        <a href="{{ route('students-sports-mapping') }}" class="box"><div><img class="img-fluid" alt="" src="{{asset('public/uploads/icons/activities.svg') }}"></div><span>Students Sport Mapping</span></a>
	                    </div>
	                   
	                    <div>
	                        <a href="{{ route('mapping.trainer') }}" class="box"><div><img class="img-fluid" alt="" src="{{asset('public/uploads/icons/MAP-Students.svg') }}"></div><span>Manage Trainers</span></a>
	                    </div>
	                    
	                    <div>
	                        <a href="{{ route('schoolDashboard') }}" class="box"><div><img class="img-fluid" alt="" src="{{asset('public/uploads/icons/Dashboard.svg') }}"></div><span>Dashboard</span></a>
	                    </div>
	                    	
            			<div>
							<a href="{{ route('create.users') }}" class="box"><div>
							<img class="img-fluid" alt="" src="{{asset('public/uploads/icons/manage-stds.svg') }}"></div><span> Create Viewer </span></a>
						</div>

						<div>
							<a href="{{ route('upload.test.data') }}" class="box"><div>
							<img class="img-fluid" alt="" src="{{asset('public/uploads/icons/taketest.svg') }}"></div><span>Upload Test Data</span></a>
						</div> 
						



						{{-- <div>
							<a href="{{ route('fms.report') }}" class="box"><div>
							<img class="img-fluid" alt="" src="{{asset('public/uploads/icons/fms-report.svg') }}"></div><span>FMS Development </span></a>
						</div>
						
						
						<div>
							<a href="{{ route('test.relay.auth') }}?p=2" class="box"><div>
							<img class="img-fluid" alt="" src="{{asset('public/uploads/icons/age-report.svg') }}"></div><span>Age Wise Performance</span></a>
						</div>
						
						
						<div>
							<a href="{{ route('test.relay.auth') }}?p=3" class="box"><div>
							<img class="img-fluid" alt="" src="{{asset('public/uploads/icons/School-Reports.svg') }}"></div><span>Institute Wise Performance</span></a>
						</div> 
						

						 <div>
							<a href="{{ route('test.relay.auth') }}?p=1" class="box"><div>
							<img class="img-fluid" alt="" src="{{asset('public/uploads/icons/fa.svg') }}"></div><span>Fitness Assessment</span></a>
						</div>


						<div>
							<a href="{{ route('test.relay.auth') }}?p=4" class="box"><div>
							<img class="img-fluid" alt="" src="{{asset('public/uploads/icons/top-performers.svg') }}"></div><span>Top Performers</span></a>
						</div>  

						<div>
							<a href="{{ route('showholiday') }}" class="box"><div>
							<img class="img-fluid" alt="" src="{{asset('public/uploads/icons/viewDart.svg') }}"></div><span> Manage Calendar</span></a>
						</div>
						--}}						
                    @endif


					@if($user && $user->role_id == 2)
					    @forelse($dashboardModules as $module)
					        <div>
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

						<div>
	                        <a href="{{ route('learn.sports') }}" class="box"><div><img class="img-fluid" alt="" src="{{asset('public/uploads/icons/Learn-Sports.svg') }}"></div><span>Learn Sports</span></a>
	                    </div>

					    <div>
					        <a href="{{ route('getactive') }}" class="box">
					            <div><img class="img-fluid" alt="" src="{{ asset('public/uploads/icons/Get-Active.svg') }}"></div>
					            <span>Get Active</span>
					        </a>
					    </div>

					    <div>
					        <a href="{{ route('admin.manual') }}" target="_blank" class="box">
					            <div><img class="img-fluid" alt="" src="{{ asset('public/uploads/icons/trainer-manual2.svg') }}"></div>
					            <span>Training Manual</span>
					        </a>
					    </div>

					    <div>
					        <a href="{{ route('test.videos') }}" class="box">
					            <div><img class="img-fluid" alt="" src="{{ asset('public/uploads/icons/test-demo.svg') }}"></div>
					            <span>Battery of Tests</span>
					        </a>
					    </div>
					@endif





                    <!-- On Development Phase -->
					@if(Auth::user()->id == 974 || Auth::user()->id == 995)
						<!-- href="{{ route('activity.gallary') }}?p=2" -->
						<div id="activity_gallary">
							<a  href="{{ route('activity.gallary') }}"  class="box" ><div>
							<img class="img-fluid" alt="" src="{{asset('public/uploads/icons/age-report.svg') }}"></div><span>Activity Gallery</span></a>
						</div>

						<div>
							<a  href="{{ route('skill.reports')}}"  class="box" ><div>
							<img class="img-fluid" alt="" src="{{asset('public/uploads/icons/skills-report.svg') }}"></div><span>Skill Report</span></a>
						</div>
					@endif
            </div>
        </div>

        <!-- MAIN DASHBOARD -->
        <div class="col pt-3 pb-4 mb-5 main-content">
            <div class="row mb-3">
                <div class="col">
                    <div class="heading-rw mt-0 mt-md-1 mb-0 p-0">
                        <h1 class="text-center text-bold">{{ $SchoolName->school_name ?? '' }}</h1>
                        
                    </div>
                </div>
                <div class="col-auto">
                    <div class="select-terms">
                        <select name="term" id="term" class="term-select">
                            @foreach($terms as $term)
                                <option value="{{ $term->id }}"
                                    {{ $selectedTerm == $term->id ? 'selected' : '' }}>
                                    {{ $term->academic_year }} | {{ $term->term_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <!-- CHARTS -->
			<div class="row g-3 mb-4">
				<div class="col-lg-3 col-6">
					<div class="stat-card blue">
                        <div class="stat-content">
                            <p>Registered Students</p>
                            <h3 class="counter" data-target="{{ $totalStudents }}">0</h3>
                        </div>
                        <div class="stat-icon">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>                    
                </div>
				<div class="col-lg-3 col-6">
					<div class="stat-card yellow">
                        <div class="stat-content">
                            <p>In Progress</p>
                            <h3 class="counter" data-target="{{ $totalOngoing }}">0</h3>
                        </div>
                        <div class="stat-icon">
                            <i class="fas fa-hourglass-half"></i>
                        </div>
                    </div>                    
                </div>
				<div class="col-lg-3 col-6">
					<div class="stat-card red">
                        <div class="stat-content">
                            <p>Not Started</p>
                            <h3 class="counter" data-target="{{ $totalYetToStart }}">0</h3>
                        </div>
                        <div class="stat-icon">
                            <i class="fas fa-hourglass-start"></i>
                        </div>
                    </div>                    
                </div>                
				<div class="col-lg-3 col-6">
					<div class="stat-card green">
                        <div class="stat-content">                       
                            <p>Completed</p>
                            <h3 class="counter" data-target="{{ $totalCompleted }}">0</h3>
                        </div>
                        <div class="stat-icon">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                    </div>                    
                </div>                
			</div>
            <div class="row g-3 mb-4">                
                <div class="col-12 col-md-6">
                    <div class="card shadow p-2" style="height:400px;">
                        <div class="card-header fw-bold">Health Indicatior</div>
                        <div class="card-body p-2">
                            <canvas id="healthSummaryChart"></canvas>
                        </div>
                    </div>
                </div>
				<div class="col-12 col-md-6">
                  <div class="card shadow p-2" style="height:400px;">   
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span class="fw-bold">Fitness Indicator</span>

                        <select id="skillFilter" class="form-select form-select-sm" style="width: 180px; margin-left:120px;">
                            <option value="">All Skills (Combined)</option>
                            @foreach ($categories as $skill)
                                <option value="{{ $skill }}">{{ $skill }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="card-body p-2">
                        <canvas id="skillLevelChart"></canvas>
                    </div>
                  </div>
                </div>
            </div>
            <div class="row g-3 mb-4">
                <div class="col-md-12">
                    <div class="card">
                        <div id="skillChart" style="height: 500px;"></div>
                    </div>
                </div>
            </div>
            <div class="row g-3 mb-4">
                <div class="col-md-12">
                    <div class="card">
                        <div id="spiderChart" style="height: 500px;"></div>
                    </div>
                </div>
            </div>

			<!-- contry status  -->
			<div class="row g-3 mb-4 position-relative" id="loaderRow">
                <div class="loader-overlay">
                    <div class="pulse"></div>
                </div>

                <!-- Cards -->
                <div class="col-md-6">
                    <div class="card">
                        <div id="dd" style="height: 400px;"></div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <h5 class="card-title text-center mt-2 mb-3 text-dark">State-wise Fitness Map</h5>
                        <div id="mapChart">
                            <div id="indiaMap">
                                {!! file_get_contents(public_path('assets/uploads/map.svg')) !!}
                            </div>
                            <div class="map-legend mt-3"></div>
                            <div id="mapTooltip"></div>
                        </div>
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


<!-- Highcharts core -->
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script src="https://code.highcharts.com/highcharts-more.js"></script>
<script src="https://code.highcharts.com/modules/packed-bubble.js"></script>
<script src="https://code.highcharts.com/modules/no-data-to-display.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<script>

    document.addEventListener('DOMContentLoaded', function () {
        const termSelect = document.getElementById('term');

        termSelect.addEventListener('change', function () {
            const selectedValue = this.value;

            const url = new URL(window.location.href);
            url.searchParams.set('term_id', selectedValue);

            window.location.href = url.toString();
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        // counter 
		const counters = document.querySelectorAll('.counter');
		counters.forEach(counter => {
			const updateCount = () => {
				const target = +counter.getAttribute('data-target');
				const count = +counter.innerText.replace(/,/g, '');
				const increment = Math.ceil(target / 100);

				if (count < target) {
					const newCount = count + increment;
					counter.innerText = newCount.toLocaleString();
					setTimeout(updateCount, 20);
				} else {
					counter.innerText = target.toLocaleString();
				}
			};
			updateCount();
		});
        // --- Skill Levels Chart in % with count tooltips ---
        
        const skillCategories = @json($categories);
        const skillSeries     = @json($chartSeries);
        const levelNames = @json($levelNames);
        const matrix = @json($matrix); 
        const categories = @json($categories);
        const levelColors = @json($levelColors);

        let chart;

        function getData(selectedSkill = '') {
            const result = {};

            Object.keys(matrix).forEach(termId => {
                let dataObjects;

                if (!selectedSkill) {
                    // total per level across all skills
                    const totalPerLevel = levelNames.map(level => {
                        let total = 0;
                        categories.forEach(skill => {
                            total += (matrix[termId]?.[skill]?.[level] || 0);
                        });
                        return total;
                    });

                    const totalAll = totalPerLevel.reduce((a,b) => a+b, 0);

                    dataObjects = totalPerLevel.map(val => ({
                        percent: totalAll ? ((val / totalAll) * 100).toFixed(1) : 0,
                        count: val
                    }));

                } else {
                    const skillData = levelNames.map(level =>
                        matrix[termId]?.[selectedSkill]?.[level] || 0
                    );

                    const skillTotal = skillData.reduce((a,b) => a+b, 0);

                    dataObjects = skillData.map(val => ({
                        percent: skillTotal ? ((val / skillTotal) * 100).toFixed(1) : 0,
                        count: val
                    }));
                }

                result[termId] = dataObjects;
            });

            return result;
        }

        function renderChart(selectedSkill = '') {
            const dataByTerm = getData(selectedSkill);
            const ctx = document.getElementById('skillLevelChart');

            const termKeys = Object.keys(dataByTerm).sort((a, b) => a - b);
            const termLabels = termKeys.map((key, index) =>
                index === termKeys.length - 1 ? 'Current Term' : 'Previous Term'
            );

            const datasets = termKeys.map((termId, index) => {
                const dataObjects = dataByTerm[termId];

                return {
                    label: termLabels[index],
                    data: dataObjects.map(d => parseFloat(d.percent)),
                    counts: dataObjects.map(d => d.count),
                    backgroundColor: levelNames.map(l => {
                        const base = levelColors[l] || '#000';
                        return index === termKeys.length - 1 ? base : base + '88';
                    })
                };
            });

            if (chart) {
                chart.data.labels = levelNames;
                chart.data.datasets = datasets;
                chart.update();
                return;
            }

            chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: levelNames,
                    datasets: datasets
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: {
                            stacked: false,
                            title: { display: true, text: 'Levels (L1 - L7)' },
                            grid: { display: false }
                        },
                        y: {
                            beginAtZero: true,
                            title: { display: true, text: 'Students (%)' },
                            ticks: {
                                callback: val => val + '%'
                            },
                            grid: { display: false }
                        }
                    },
                    plugins: {
                        legend: { display: true },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const count = context.dataset.counts[context.dataIndex]; // get count from dataset
                                    const percent = context.parsed.y;
                                    return `Students: ${count} (${percent}%)`;
                                }
                            }
                        }
                    }
                }
            });
        }

        // Initial render
        renderChart();

        // Filter change
        document.getElementById('skillFilter').addEventListener('change', function () {
            renderChart(this.value);
        });

        renderChart();
        document.getElementById('skillFilter').addEventListener('change', function () {
            renderChart(this.value);
        });

		// api data in high chart 
        const stateCodeMap = {
            "Andhra Pradesh": "INAP",
            "Arunachal Pradesh": "INAR",
            "Assam": "INAS",
            "Bihar": "INBR",
            "Chhattisgarh": "INCT",
            "Goa": "INGA",
            "Gujarat": "INGJ",
            "Haryana": "INHR",
            "Himachal Pradesh": "INHP",
            "Jharkhand": "INJH",
            "Karnataka": "INKA",
            "Kerala": "INKL",
            "Madhya Pradesh": "INMP",
            "Maharashtra": "INMH",
            "Manipur": "INMN",
            "Meghalaya": "INML",
            "Mizoram": "INMZ",
            "Nagaland": "INNL",
            "Odisha": "INOR",
            "Punjab": "INPB",
            "Rajasthan": "INRJ",
            "Sikkim": "INSK",
            "Tamil Nadu": "INTN",
            "Telangana": "INTG",
            "Tripura": "INTR",
            "Uttar Pradesh": "INUP",
            "Uttarakhand": "INUT",
            "West Bengal": "INWB",
            "Delhi": "INDL",
            "Andaman and Nicobar Islands": "INAN",
            "Chandigarh": "INCH",
            "Dadra and Nagar Haveli": "INDH",
            "Daman and Diu": "INDD",
            "Jammu and Kashmir": "INJK",
            "Ladakh": "INLA",
            "Lakshadweep": "INLD",
            "Puducherry": "INPY"
        };
        const stateData = {};
        
        const tooltip = document.getElementById("mapTooltip");
		if (!tooltip) return;
       
        const FitnessMapUrl = "https://nep.goforfit.in/api/states-fitness-data";
        const localStorageKey = "FitnessMapData";

        // Try to get data from localStorage first
        let FitnessMap = JSON.parse(localStorage.getItem(localStorageKey)) || [];

        if (FitnessMap.length) {
            buildOverallHealthChart(FitnessMap);
            buildIndiaMap(FitnessMap);
            renderIndiaMap();
            renderPieChart();
            document.getElementsByClassName('loader-overlay')[0].style.display = 'none';
        } else {
            fetch(FitnessMapUrl, {
                headers: {
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                if (!response.ok) throw new Error(`API response not OK: ${response.status}`);
                return response.json();
            })
            .then(result => {
                document.getElementsByClassName('loader-overlay')[0].style.display = 'none';
                FitnessMap = result?.stateData ?? result?.data?.stateData ?? [];

                if (!FitnessMap.length) {
                    document.getElementById('dd').innerHTML = 'No data available';
                } else {
                    // Save in localStorage
                    localStorage.setItem(localStorageKey, JSON.stringify(FitnessMap));

                    buildOverallHealthChart(FitnessMap);
                    buildIndiaMap(FitnessMap);
                    renderIndiaMap();
                    renderPieChart();
                }
            })
            .catch(error => {
                console.error("Could not load mapdata API:", error);
            });
        }

        function buildOverallHealthChart(FitnessMap) {
            const overallHealthData = { UW:0, N:0, OW:0, OB:0 };
            FitnessMap.forEach(state => {
                overallHealthData.UW += parseInt(state.UW) || 0;
                overallHealthData.N  += parseInt(state.N)  || 0;
                overallHealthData.OW += parseInt(state.OW) || 0;
                overallHealthData.OB += parseInt(state.OB) || 0;
            });

            const healthCategories = ['UW','N','OW','OB'];
            const pieData = healthCategories.map(cat => ({
                name: cat,
                y: overallHealthData[cat],
                color: { UW:'#a3d55f', N:'#00953b', OW:'#ffaa62', OB:'#fe4a5d' }[cat]
            }));
        }
        // health pie chart country     
        
        function renderPieChart(){
            if (document.getElementById('dd')) {
                try {
                    const healthCategories = ['UW', 'N', 'OW', 'OB'];

                    const overallHealthData = { UW: 0, N: 0, OW: 0, OB: 0 };
                    FitnessMap.forEach(state => {
                        overallHealthData.UW += parseInt(state.UW) || 0;
                        overallHealthData.N  += parseInt(state.N)  || 0;
                        overallHealthData.OW += parseInt(state.OW) || 0;
                        overallHealthData.OB += parseInt(state.OB) || 0;
                    });

                    const pieData = healthCategories.map(cat => ({
                        name: cat,
                        y: overallHealthData[cat],
                        color: (() => {
                            // Set your colors for each category
                            const colors = { UW:'#6bc04b', N:'#039a48', OW:'#ffcb08', OB:'#ec0000' };
                            return colors[cat] || '#ccc';
                        })()
                    }));

                    // Render pie chart
                    Highcharts.chart('dd', {
                        
                        chart: {
							type: 'pie',
							height: 380,
							zooming: {
								type: 'xy'
							},
							panning: {
								enabled: true,
								type: 'xy'
							},
							panKey: 'shift'
						},
						title: { text: 'Country Health Indicator' },
						tooltip: {
							pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
						},
						plotOptions: {
							pie: {
								allowPointSelect: true,
								cursor: 'pointer',
								dataLabels: [{
									enabled: true,
									distance: 20
								}, 
								{
									enabled: true,
									distance: -40,
									format: '{point.percentage:.1f}%',
									style: {
									fontSize: '1.2em',
									textOutline: 'none',
									opacity: 0.7
									},
									filter: {
									operator: '>',
									property: 'percentage',
									value: 10
									}
								}]
							}
						},
                        series: [{
                            name: 'Students',
                            colorByPoint: true,
                            data: pieData
                        }]
                    });

                } catch (error) {
                    console.error('Overall Health Pie Chart Error:', error);
                    document.getElementById('dd').innerHTML = '<div class="map-error">Error loading overall health pie chart</div>';
                }
            }
        }
        

        // India Map with multiple fallback options

        function buildIndiaMap(FitnessMap){
            FitnessMap.forEach(item => {
                let stateName = item.name;

                if (stateName.includes("Delhi")) {
                    stateName = "Delhi";
                }

                const code = stateCodeMap[stateName];

                if (code) {
                    stateData[code] = item;
                }
            });
        }      
        // render data in map 

        function renderIndiaMap(){
			const mapColors = ['#fe4a5d','#ffaa62','#ffd26e','#74c4d6','#a3d55f','#6bc04b','#00953b'];

			function generateLegend() {
                    const legendContainer = document.querySelector('.map-legend');
                    if (!legendContainer) return;

                    legendContainer.innerHTML = '';

                    mapColors.forEach((color, index) => {
                        let min = index * 25;
                        let max = (index + 1) * 25;

                        let label = index === mapColors.length - 1 
                            ? `${min}+` 
                            : `${min}–${max}`;

                        const item = document.createElement('div');
                        item.className = 'legend-item';
                        item.innerHTML = `<span style="background:${color}"></span> ${label} Schools`;

                        legendContainer.appendChild(item);
                    });
                }

            generateLegend();
            document.querySelectorAll("#indiaMap svg path").forEach(path => {
                const code = path.id;
                const data = stateData[code];
                function getBaseColor(schools) {
                    if (!schools) return '#bbb';

                    let index = Math.floor((schools - 1) / 25);
                    if (index >= mapColors.length) index = mapColors.length - 1;

                    return mapColors[index] + 'CC';
                }

                const schools = data ? data.schools : 0;
                path.dataset.baseColor = getBaseColor(schools);
                path.style.fill = path.dataset.baseColor;

                path.addEventListener("mouseenter", function () {
                    tooltip.style.display = "block";
                    const baseColor = this.dataset.baseColor;
					function formatCount(value) {
						return value ? '~' + value : '0';
					}
                    this.style.fill = baseColor.replace(/CC$/, 'FF'); 
                    if (!data) {
                        tooltip.innerHTML = `<strong>No data</strong>`;
                    } else {
						const UW = Number(data.UW) || 0;
						const N  = Number(data.N)  || 0;
						const OW = Number(data.OW) || 0;
						const OB = Number(data.OB) || 0;

						const total = UW + N + OW + OB;
						function formatPercent(value) {
							if (!total) return 'No data';
							return ((value / total) * 100).toFixed(1) + '%';
						}
                        tooltip.innerHTML = `
                            <strong>${data.name}</strong><br>
                            UW: ~${formatPercent(UW)}<br>
							N: ~${formatPercent(N)}<br>
							OW: ~${formatPercent(OW)}<br>
							OB: ~${formatPercent(OB)}
                        `;
                    }
                    tooltip.style.display = "block";
                });

                path.addEventListener("mousemove", function (e) {
                    const container = document.getElementById("mapChart");
                    const rect = container.getBoundingClientRect();
                    tooltip.style.left = (e.clientX - rect.left + 10) + "px";
                    tooltip.style.top = (e.clientY - rect.top - 40) + "px";
                });

                path.addEventListener("mouseleave", function () {
                    this.style.fill = this.dataset.baseColor; // restore original
                    tooltip.style.display = "none";
                });
            });
        }        

        // School Skill Chart
        const currentTermId = @json($selectedTerm);                
        const currentTermSeries = skillSeries.filter(s => s.name.startsWith(`Term ${currentTermId} -`));

        if (document.getElementById('skillChart')) {
            try {
                Highcharts.chart('skillChart', {
                    chart: { type: 'bar' },
                    title: { text: 'Skill Analysis (Current Term)' },
                    xAxis: { categories: skillCategories },
                    yAxis: { min: 0, labels: { formatter() { return Math.round(this.value); } } },
                    legend: { enabled: false },
                    plotOptions: {
                        series: {
                            stacking: 'percent',
                            dataLabels: {
                                enabled: true,
                                formatter: function () {
                                    const level = this.series.name.split(' - ')[1] || this.series.name;
                                    return `${level} (${Math.round(this.percentage)}%)`;
                                },
                                style: { textOutline: 'none', fontSize: '11px' }
                            },
                            states: { inactive: { opacity: 1 } },
                            point: {
                                events: {
                                    mouseOver: function () {
                                        const chart = this.series.chart;
                                        chart.series.forEach((s) => {
                                            s.group.attr({ opacity: s.index === this.series.index ? 1 : 0.2 });
                                        });
                                    }
                                }
                            },
                            events: {
                                mouseOut: function () {
                                    this.chart.series.forEach(s => s.group.attr({ opacity: 1 }));
                                }
                            }
                        }
                    },
                    tooltip: {
                        formatter: function() {
                            return `Students: ${this.y} (${Math.round(this.percentage)}%)`;
                        }
                    },
                    series: currentTermSeries
                });
            } catch (error) {
                console.error('Skill Chart Error:', error);
                document.getElementById('skillChart').innerHTML = '<div class="map-error">Error loading skill chart</div>';
            }
        }

        // School Spider Chart
        const levelCategories = ['L1', 'L2', 'L3', 'L4', 'L5', 'L6', 'L7'];
        function transformData(skillCategories, currentTermSeries) {
            const levelCount = currentTermSeries.length;

            return skillCategories.map((skill, skillIndex) => {
                return {
                    name: skill,
                    data: currentTermSeries.map(level => level.data[skillIndex])
                };
            });
        }
        const transformedSeries = transformData(skillCategories, currentTermSeries);
        if (document.getElementById('spiderChart')) {
            try {
                Highcharts.chart('spiderChart', {
                    chart: {
                        polar: true,
                        type: 'areaspline',
                    },
                    title: {
                        text: 'Skill Analysis',
                        style: {
                            fontSize: '18px',
                            fontWeight: 'bold',
                        }
                    },
                    pane: {
                        size: '90%'
                    },
                    xAxis: {
                        categories: ['L1', 'L2', 'L3', 'L4', 'L5', 'L6', 'L7'],
                        tickmarkPlacement: 'on',
                        lineWidth: 0,
                        labels: {
                            style: {
                                fontSize: '13px',
                                color: '#555'
                            }
                        }
                    },
                    yAxis: {
                        min: 0,
                        // max: 100,
                        gridLineInterpolation: 'circle',
                        lineWidth: 0,
                        labels: {
                            formatter: function() {
                                return this.value;
                            },
                            style: {
                                fontSize: '11px',
                                color: '#666'
                            }
                        }
                    },
                    legend: {
                        enabled: true,
                        itemStyle: {
                            fontSize: '12px',
                            color: '#333'
                        },
                        labelFormatter: function() {
                            const level = this.name.split(' - ')[1] || this.name;
                            return level;
                        }
                    },
                    plotOptions: {
                        series: {
                            stacking: null,
                            // stacking: 'percent',
                            fillOpacity: 0.25,
                            lineWidth: 3,
                            marker: {
                                radius: 5
                            },
                            dataLabels: {
                                enabled: true,
                                formatter: function() {
                                   return this.y;
                                    // return `${this.series.name} (${Math.round(this.percentage)}%)`;
                                },
                                style: {
                                    fontSize: '11px',
                                    textOutline: 'none',
                                    color: '#222'
                                }
                            },
                            pointPlacement: 'on'
                        }
                    },
                    tooltip: {
                        shared: true,
                        backgroundColor: '#fff',
                        borderColor: '#999',
                        borderRadius: 5,
                        style: {
                            color: '#000'
                        },
                        pointFormatter: function() {
                            return `<span style="color:${this.color}">\u25CF</span>
                ${this.series.name}: ${this.y}<br/>`;
                            // return `<span style="color:${this.color}">\u25CF</span>
                            //         ${this.series.name}: ${this.y} (${Math.round(this.percentage)}%)<br/>`;
                        }
                    },
                    series: transformedSeries
                });
            } catch (error) {
                console.error('Skill Chart Error:', error);
                document.getElementById('spiderChart').innerHTML = '<div class="map-error">Error loading skill chart</div>';
            }
        }

        // School Health bar chart with bell curve 

        const healthData      = @json($healthData);  
        const nationalPercent = getNationalPercentage(FitnessMap); 
        function getNationalPercentage(FitnessMap) {
            const overallHealthData = { UW: 0, N: 0, OW: 0, OB: 0 };
            FitnessMap.forEach(state => {
                overallHealthData.UW += parseInt(state.UW) || 0;
                overallHealthData.N  += parseInt(state.N)  || 0;
                overallHealthData.OW += parseInt(state.OW) || 0;
                overallHealthData.OB += parseInt(state.OB) || 0;
            });

            const totalNational = Object.values(overallHealthData).reduce((a, b) => a + b, 0);

            const nationalPercent = ['UW', 'N', 'OW', 'OB'].map(cat => {
                return totalNational > 0
                    ? ((overallHealthData[cat] / totalNational) * 100).toFixed(1)
                    : 0;
            });

            return nationalPercent;
        }
        const termKeys = Object.keys(healthData).filter(key => key !== 'labels');
        const termPercent = {};
        termKeys.forEach(termKey => {
            const total = healthData[termKey].reduce((a,b) => a + b, 0);
            termPercent[termKey] = healthData[termKey].map(val => (val / total * 100).toFixed(1));
        });

        const colorsLight = ['#b1dea1', '#82fcb9', '#ffe380', '#ff8080'];
        const colorsDark  = ['#6bc04b', '#039a48', '#ffcb08', '#ec0000'];
        
        const datasets = [
            {
                label: 'Previous',
                data: termPercent[termKeys[1]],
                backgroundColor: colorsLight,
                rawCounts: healthData[termKeys[1]],
                order: 1
            },
            {
                label: 'Current',
                data: termPercent[termKeys[0]],
                backgroundColor: colorsDark,
                rawCounts: healthData[termKeys[0]],
                order: 5
            }
        ];

        const drawLineOnTopPlugin = {
            id: 'drawLineOnTop',
            afterDatasetsDraw(chart) {
                chart.data.datasets.forEach((dataset, index) => {
                    if (dataset.type === 'line') {
                        chart.getDatasetMeta(index).controller.draw();
                    }
                });
            }
        };

        // Bell curve dataset remains unchanged
        const bellCurveDataset = {
            label: 'National',
            data: nationalPercent,
            type: 'line',              
            borderColor: '#000814',    
            borderWidth: 3,
            fill: false,
            tension: 0.4,              
            pointStyle: 'circle',
            pointBorderColor: '#ffc300',
            pointRadius: 5,
            pointBackgroundColor: '#000814',
            order: 10
        };

        const allDatasets = [...datasets, bellCurveDataset];

        new Chart(document.getElementById('healthSummaryChart'), {
            type: 'bar',
            data: {
                labels: healthData.labels, 
                datasets: allDatasets
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: true },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                if (context.dataset.type === 'line') {
                                    return `${context.dataset.label}: ${context.raw}%`;
                                } else {
                                    const count = context.dataset.rawCounts[context.dataIndex];
                                    return `${context.dataset.label}: ${count} students (${context.parsed.y}%)`;
                                }
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            display: false
                        },
                        ticks: {
                            callback: function(value) { return value + '%'; }
                        }
                    },
                    x: {
                        stacked: false,
                        grid: {
                            display: false
                        }
                    }
                },
                datasets: {
                    bar: {
                        order: 1
                    },
                    line: {
                        order: 10
                    }
                }
            },
            plugins: [drawLineOnTopPlugin]
        });     
        
    });
</script>

@endsection