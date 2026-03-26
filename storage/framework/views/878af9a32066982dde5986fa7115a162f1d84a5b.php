 
<?php $__env->startSection('title', $title); ?>
<?php $__env->startSection('content'); ?>

<style>
    html, body {
        height: 100%;
        margin: 0;
        overflow: hidden;
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
        right: 50px;
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

    @keyframes  pulseRing {
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

	/* Animation */
	@keyframes  scroll-left {
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
</style>

<?php if(Auth::user()->role_id == '4'): ?>
	<div class="marquee-container">
		<div class="marquee">
		<span><strong>Important Notice: </strong>Please check the highlighted students in the Manage Student module and update their details.</span>
		</div>
	</div>
<?php elseif(Auth::user()->role_id == '3'): ?>
	<div class="marquee-container">
		<div class="marquee">
		<span><strong>Important Notice: </strong>Kindly update your profile details (email, mobile number, and date of birth) in the Edit Profile section. If all details are already updated, please ignore this notice.</span>
		</div>
	</div>
<?php endif; ?>


<?php if(session('show_profile_update_popup')): ?>
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
					window.location.href = "<?php echo e(session('profile_update_route')); ?>";
				}
			});
		});
	</script>
<?php endif; ?>
<div class="container-fluid">
    <div class="row">

        <!-- SIDEBAR -->
        <div class="col-auto sidebar pt-4 pb-4">
            <div class="d-flex flex-column justify-content-md-center text-center">
            
                <?php  $getActiveTerm = Helper::getActiveTerm();  ?>


                	<!-- Trainers Dashboard  -->
                    <?php if((Auth::user()->role_id == '3' && $hasSchools) && (Auth::user()->role_id == '3' && $getActiveTerm)): ?>

	                    <div class="col-4 col-md-3 col-lg-2 col-xl-2 mb-4" data-id="<?php echo e(Auth::user()->role_id); ?>">
	                        <a href="<?php echo e(route('fill.dart')); ?>" class="box"><div><img class="img-fluid" alt="" src="<?php echo e(asset('public/uploads/icons/Dart.svg')); ?>"></div><span>Fill DART</span></a>
	                    </div>

	                    <div class="col-4 col-md-3 col-lg-2 col-xl-2 mb-4">
	                        <a href="<?php echo e(route('viewschooldart')); ?>" data-id="" class="box"><div><img class="img-fluid" alt="" src="<?php echo e(asset('public/uploads/icons/viewDart.svg')); ?>"></div><span>View DART</span></a>
	                    </div>
	              
	                    <div class="col-4 col-md-3 col-lg-2 col-xl-2 mb-4">
	                        <a href="<?php echo e(route('activity.according.to.class')); ?>" class="box"><div><img class="img-fluid" alt="" src="<?php echo e(asset('public/uploads/icons/activities.svg')); ?>"></div><span>Activity Planner</span></a>
	                    </div>
	                    	                  
	                    <div class="col-4 col-md-3 col-lg-2 col-xl-2 mb-4">
	                        <a href="<?php echo e(route('map.sports')); ?>" class="box"><div><img class="img-fluid" alt="" src="<?php echo e(asset('public/uploads/icons/MAP-Students.svg')); ?>"></div><span>Map Students</span></a>
	                    </div>
	                 		                 	
	                    <div class="col-4 col-md-3 col-lg-2 col-xl-2 mb-4">
	                        <a href="<?php echo e(route('all-test')); ?>" class="box"><div><img class="img-fluid" alt="" src="<?php echo e(asset('public/uploads/icons/taketest.svg')); ?>"></div><span>Take Test</span></a>
	                    </div>                  
	 	                    
	                    <div class="col-4 col-md-3 col-lg-2 col-xl-2 mb-4">
							<a href="<?php echo e(route('trainer.lowerclass.status')); ?>" class="box"><div>
							<img class="img-fluid" alt="" src="<?php echo e(asset('public/uploads/icons/lc_test-status.svg')); ?>"></div><span>Test Summary <br> (Upto Class-3)</span></a>
						</div>

						<div class="col-4 col-md-3 col-lg-2 col-xl-2 mb-4">
							<a href="<?php echo e(route('trainer.higherclass.status')); ?>" class="box"><div>
							<img class="img-fluid" alt="" src="<?php echo e(asset('public/uploads/icons/hc_test-status.svg')); ?>"></div><span>
							Test Summary <br> (Class-4 & Above)</span></a>
						</div>
					<?php endif; ?>


					<!-- School Dashboard -->
                    <?php if(Auth::user()->role_id == '4'): ?>


	                    <div class="col-4 col-md-3 col-lg-2 col-xl-2 mb-4">
	                        <a href="<?php echo e(route('viewschooldart')); ?>" class="box"><div><img class="img-fluid" alt="" src="<?php echo e(asset('public/uploads/icons/viewDart.svg')); ?>" ></div><span>View DART</span></a>
	                    </div>

	                    <div class="col-4 col-md-3 col-lg-2 col-xl-2 mb-4">
	                        <a href="<?php echo e(route('activity.according.to.class')); ?>" class="box"><div><img class="img-fluid" alt="" src="<?php echo e(asset('public/uploads/icons/activities.svg')); ?>"></div><span>Activity Planner</span></a>
	                    </div>

	                    <div class="col-4 col-md-3 col-lg-2 col-xl-2 mb-4">
							<a href="<?php echo e(route('fitness.report')); ?>" class="box"><div>
							<img class="img-fluid" alt="" src="<?php echo e(asset('public/uploads/icons/fa.svg')); ?>"></div><span>Assessment Reports</span></a>
						</div>
						<div class="col-4 col-md-3 col-lg-2 col-xl-2 mb-4">
							<a href="<?php echo e(route ('trainer.lowerclass.status')); ?>" class="box"><div>
							<img class="img-fluid" alt="" src="<?php echo e(asset('public/uploads/icons/lc_test-status.svg')); ?>"></div><span>Test Summary <br> (Upto Class-3)</span></a>
						</div>

						<div class="col-4 col-md-3 col-lg-2 col-xl-2 mb-4">
							<a href="<?php echo e(route ('trainer.higherclass.status')); ?>" class="box"><div>
							<img class="img-fluid" alt="" src="<?php echo e(asset('public/uploads/icons/hc_test-status.svg')); ?>"></div><span>
							Test Summary <br> (Class-4 & Above)</span></a>
						</div>
	                
	                     <div class="col-4 col-md-3 col-lg-2 col-xl-2 mb-4">
	                        <a href="<?php echo e(route('managestudent')); ?>" class="box"><div><img class="img-fluid" alt="" src="<?php echo e(asset('public/uploads/icons/manage-stds.svg')); ?>"></div><span>Manage Students</span></a>
	                    </div>
	                    
	                    
	                    <div class="col-4 col-md-3 col-lg-2 col-xl-2 mb-4">
	                        <a href="<?php echo e(route('mapping.sports')); ?>" class="box"><div><img class="img-fluid" alt="" src="<?php echo e(asset('public/uploads/icons/mapSports.svg')); ?>"></div><span>Map Sports</span></a>
	                    </div>
						
					
						<div class="col-4 col-md-3 col-lg-2 col-xl-2 mb-4">
	                        <a href="<?php echo e(route('students-sports-mapping')); ?>" class="box"><div><img class="img-fluid" alt="" src="<?php echo e(asset('public/uploads/icons/activities.svg')); ?>"></div><span>Students Sport Mapping</span></a>
	                    </div>
	                   
	                    <div class="col-4 col-md-3 col-lg-2 col-xl-2 mb-4">
	                        <a href="<?php echo e(route('mapping.trainer')); ?>" class="box"><div><img class="img-fluid" alt="" src="<?php echo e(asset('public/uploads/icons/MAP-Students.svg')); ?>"></div><span>Manage Trainers</span></a>
	                    </div>
	                    
	                    <div class="col-4 col-md-3 col-lg-2 col-xl-2 mb-4">
	                        <a href="<?php echo e(route('schoolDashboard')); ?>" class="box"><div><img class="img-fluid" alt="" src="<?php echo e(asset('public/uploads/icons/Dashboard.svg')); ?>"></div><span>Dashboard</span></a>
	                    </div>
	                    	
            			<div class="col-4 col-md-3 col-lg-2 col-xl-2 mb-4">
							<a href="<?php echo e(route('create.users')); ?>" class="box"><div>
							<img class="img-fluid" alt="" src="<?php echo e(asset('public/uploads/icons/manage-stds.svg')); ?>"></div><span> Create Viewer </span></a>
						</div>

						<div class="col-4 col-md-3 col-lg-2 col-xl-2 mb-4">
							<a href="<?php echo e(route('upload.test.data')); ?>" class="box"><div>
							<img class="img-fluid" alt="" src="<?php echo e(asset('public/uploads/icons/taketest.svg')); ?>"></div><span>Upload Test Data</span></a>
						</div> 
						



												
                    <?php endif; ?>


					<?php if($user && $user->role_id == 2): ?>
					    <?php $__empty_1 = true; $__currentLoopData = $dashboardModules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $module): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
					        <div class="col-4 col-md-3 col-lg-2 col-xl-2 mb-4">
					            <a href="<?php echo e(route($module->route_name)); ?>" class="box">
					                <div>
					                    <img class="img-fluid" alt="<?php echo e($module->name); ?>" src="<?php echo e(asset('public/uploads/icons/'.$module->icon)); ?>">
					                </div>
					                <span><?php echo e($module->name); ?></span>
					            </a>
					        </div>
					    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
					        <div class="alert alert-warning text-center mt-4 fixed-bottom">
					            <h6>Your Account is Deactivated</h6>
					            <p>Please contact your school administrator to activate your account.</p>
					        </div>
					    <?php endif; ?>
					<?php endif; ?>


					
					<?php if(!$user || $user->role_id != 2): ?>

						<div class="col-4 col-md-3 col-lg-2 col-xl-2 mb-4">
	                        <a href="<?php echo e(route('learn.sports')); ?>" class="box"><div><img class="img-fluid" alt="" src="<?php echo e(asset('public/uploads/icons/Learn-Sports.svg')); ?>"></div><span>Learn Sports</span></a>
	                    </div>

					    <div class="col-4 col-md-3 col-lg-2 col-xl-2 mb-4">
					        <a href="<?php echo e(route('getactive')); ?>" class="box">
					            <div><img class="img-fluid" alt="" src="<?php echo e(asset('public/uploads/icons/Get-Active.svg')); ?>"></div>
					            <span>Get Active</span>
					        </a>
					    </div>

					    <div class="col-4 col-md-3 col-lg-2 col-xl-2 mb-4">
					        <a href="<?php echo e(route('admin.manual')); ?>" target="_blank" class="box">
					            <div><img class="img-fluid" alt="" src="<?php echo e(asset('public/uploads/icons/trainer-manual2.svg')); ?>"></div>
					            <span>Training Manual</span>
					        </a>
					    </div>

					    <div class="col-4 col-md-3 col-lg-2 col-xl-2 mb-4">
					        <a href="<?php echo e(route('test.videos')); ?>" class="box">
					            <div><img class="img-fluid" alt="" src="<?php echo e(asset('public/uploads/icons/test-demo.svg')); ?>"></div>
					            <span>Battery of Tests</span>
					        </a>
					    </div>
					<?php endif; ?>





                    <!-- On Development Phase -->
					<?php if(Auth::user()->id == 974 || Auth::user()->id == 995): ?>
						<!-- href="<?php echo e(route('activity.gallary')); ?>?p=2" -->
						<div class="col-4 col-md-3 col-lg-2 col-xl-2 mb-4" id="activity_gallary">
							<a  href="javascript:void(0);"  class="box" ><div>
							<img class="img-fluid" alt="" src="<?php echo e(asset('public/uploads/icons/age-report.svg')); ?>"></div><span>Activity Gallery</span></a>
						</div>

						<div class="col-4 col-md-3 col-lg-2 col-xl-2 mb-4">
							<a  href="<?php echo e(route('skill.reports')); ?>"  class="box" ><div>
							<img class="img-fluid" alt="" src="<?php echo e(asset('public/uploads/icons/skills-report.svg')); ?>"></div><span>Skill Report</span></a>
						</div>
					<?php endif; ?>
            </div>
        </div>

        <!-- MAIN DASHBOARD -->
        <div class="col pt-4 pb-4 mb-5 main-content">
            <!-- TOP CARDS -->
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
                                <?php echo file_get_contents(public_path('assets/uploads/map.svg')); ?>

                            </div>
                            <div class="map-legend mt-3"></div>
                            <div id="mapTooltip"></div>
                        </div>
                    </div>
                </div> 
            </div>

            <!-- CHARTS -->
            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <div class="card">
                        <div id="fitnessChart" style="height: 400px;"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div id="healthChart" style="height: 400px;"></div>
                    </div>
                </div>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-md-12">
                    <div class="card">
                        <div id="skillChart" style="height: 400px;"></div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>


<?php if(!$hasSchools && Auth::user()->role_id == 3): ?>
  <div class="alert alert-warning text-center mt-4 fixed-bottom" >
    <h4>No School Assigned</h4>
    <p>Please contact your school administrator to activate your account.</p>
  </div>
  	
<?php elseif(!$getActiveTerm && Auth::user()->role_id == 3): ?>
	<div class="alert alert-warning text-center mt-4 fixed-bottom" >
    <h4>No Active Terms</h4>
    <p>Please contact your school administrator to update terms in profile section.</p>
  </div>
<?php endif; ?>


<!-- School Selection Modal -->
<?php if($hasSchools): ?>

    <?php if(Auth::user()->role_id == 3 && !Session::get('SelectSchoolId')): ?>
	<div class="modal fade" id="exampleModal" tabindex="-1" data-backdrop='static' role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered model-md" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Choose your school</h5>
		      </div>  
			  
		     <div class="modal-body">
			   <form method="get" name="trainer_select_school" id="trainer_select_school_id" action="<?php echo e(route('filldart.dashboard')); ?>">
					<select name="select_school_id" required class="form-select form-select-lg form-control mx-0 w-100" aria-label=".form-select-lg example">
						<option value="">Select </option>
						  <?php $__currentLoopData = $SchoolTrainers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<option value="<?php echo e($val->id); ?>"><?php echo e($val->school_name); ?></option>
						  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
  <?php endif; ?>
<?php endif; ?>

<!-- <div class="modal fade" id="stateModal" tabindex="-1" role="dialog" aria-labelledby="stateModalTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg modal-xl modal-dialog-centered">
        <div class="modal-content">        
            <div class="modal-header">
                <h5 class="modal-title">Schools Detail</h5>
                <button type="button" class="close" data-dismiss="modal">
                <span>&times;</span>
                </button>
            </div>

            <div class="modal-body" id="stateModalBody">
                <table border="1" id="schoolTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>School Code</th>
                            <th>School Name</th>
                            <th>Region</th>
                            <th>Registered</th>
                            <th>Completed</th>
                            <th>Ongoing</th>
                            <th>Yet to Start</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
				<div class="text-center p-4">Loading...</div>
            </div>

        </div>
    </div>
</div> -->

<!-- Highcharts core -->
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script src="https://code.highcharts.com/highcharts-more.js"></script>
<script src="https://code.highcharts.com/modules/packed-bubble.js"></script>
<script src="https://code.highcharts.com/modules/no-data-to-display.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        
        const fitnessLevels  = <?php echo json_encode($fitnessLevels, 15, 512) ?>;
        const fitnessData    = <?php echo json_encode($fitnessTotals, 15, 512) ?>;
        const fitnessAvg     = <?php echo json_encode($ranked_schoolsFitness, 15, 512) ?>;

        const healthLevels   = <?php echo json_encode($healthLevels, 15, 512) ?>;
        const healthData     = <?php echo json_encode($healthTotals, 15, 512) ?>;
        const healthAvg      = <?php echo json_encode($healthRankData, 15, 512) ?>;

        const skillCategories = <?php echo json_encode($categories, 15, 512) ?>;
        const skillSeries     = <?php echo json_encode($chartSeries, 15, 512) ?>;        
        // const FitnessMap1      = <?php echo json_encode($FitnessMap, 15, 512) ?>;
        const tooltip = document.getElementById("mapTooltip");
       
        const FitnessMapUrl = "https://nep.goforfit.in/api/states-fitness-data";

        let FitnessMap = [];
        renderPieChart();
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
            FitnessMap = result.stateData || (result.data && result.data.stateData) || [];
            buildOverallHealthChart(FitnessMap);
            buildIndiaMap(FitnessMap);
            renderIndiaMap();
            renderPieChart();
        })
        .catch(error => {
            console.error("Could not load mapdata API:", error);
        });

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

            Highcharts.chart('dd', {
                chart: { type: 'pie', height: 360 },
                title: { text: 'Country Health Indicator' },
                series: [{ name: 'Students', colorByPoint: true, data: pieData }]
            });
        }

        
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
                            const colors = { UW:'#a3d55f', N:'#00953b', OW:'#ffaa62', OB:'#fe4a5d' };
                            return colors[cat] || '#ccc';
                        })()
                    }));

                    // Render pie chart
                    Highcharts.chart('dd', {
                        chart: {
                            type: 'pie',
                            height: 360
                        },
                        title: { text: 'Country Health Indicator' },
                        tooltip: {
                            pointFormat: '{series.name}: <b>{point.y}</b> ({point.percentage:.1f}%)'
                        },
                        accessibility: {
                            point: { valueSuffix: '%' }
                        },
                        plotOptions: {
                            pie: {
                                allowPointSelect: true,
                                cursor: 'pointer',
                                dataLabels: {
                                    enabled: true,
                                    format: '<b>{point.name}</b>: {point.y} ({point.percentage:.1f}%)'
                                }
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

        function renderIndiaMap(){
            document.querySelectorAll("#indiaMap svg path").forEach(path => {
                const code = path.id;
                const data = stateData[code];

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
                    const baseColor = this.dataset.baseColor;

                    this.style.fill = baseColor.replace(/CC$/, 'FF'); 
                    if (!data) {
                        tooltip.innerHTML = `<strong>No data</strong>`;
                    } else {
                        tooltip.innerHTML = `
                            <strong>${data.name}</strong><br>
                            Schools: ${data.schools}<br>
                            Students: ${data.students}<br>
                            UW: ${data.UW}<br>
                            N: ${data.N}<br>
                            OW: ${data.OW}<br>
                            OB: ${data.OB}
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
        

        const levelColors = {
            L0:'#01160a', L1:'#fe4a5d', L2:'#ffaa62', L3:'#ffd26e',
            L4:'#74c4d6', L5:'#a3d55f', L6:'#6bc04b', L7:'#00953b', L8:'#01160a'
        };
        const healthColors = ['#a3d55f','#00953b','#ffaa62','#fe4a5d'];

        function buildColumnData(levels, values, colorMap = null, fallbackColors = []) {
            return levels.map((lvl, i) => ({
                y: values[i] ?? 0,
                color: colorMap ? (colorMap[lvl] || '#000') : (fallbackColors[i] || '#000')
            }));
        }

        // Fitness Chart
        if (document.getElementById('fitnessChart')) {
            try {
                Highcharts.chart('fitnessChart', {
                    chart: { type: 'column' },
                    title: { text: 'Fitness Indicator' },
                    xAxis: { categories: fitnessLevels },
                    yAxis: [{
                        title: { text: 'Total Students' },
                        visible: true
                    },{
                        title: { text: 'Overall Average' },
                        opposite: true,
                        labels: { enabled: false }
                    }],
                    tooltip: {
                        shared: true,
                        crosshairs: true
                    },
                    noData: {
                        style: { fontWeight: 'bold', fontSize: '15px', color: '#303030' }
                    },
                    series: [
                        { 
                            name: 'Total Students', 
                            data: buildColumnData(fitnessLevels, fitnessData, levelColors),
                            type: 'column'
                        },
                        { 
                            name: 'Overall Average', 
                            type: 'spline', 
                            data: fitnessAvg, 
                            yAxis: 1, 
                            color: '#434348',
                            marker: { enabled: true }
                        }
                    ]
                });
            } catch (error) {
                console.error('Fitness Chart Error:', error);
                document.getElementById('fitnessChart').innerHTML = '<div class="map-error">Error loading fitness chart</div>';
            }
        }

        // Health Chart
        if (document.getElementById('healthChart')) {
            try {
                Highcharts.chart('healthChart', {
                    chart: { type: 'column' },
                    title: { text: 'Health Indicator' },
                    xAxis: { categories: healthLevels },
                    yAxis: [{
                        title: { text: 'Total Students' },
                        visible: true
                    },{
                        title: { text: 'Overall Average' },
                        opposite: true,
                        labels: { enabled: false }
                    }],
                    tooltip: {
                        shared: true,
                        crosshairs: true
                    },
                    series: [
                        { 
                            name: 'Total Students', 
                            data: buildColumnData(healthLevels, healthData, null, healthColors),
                            type: 'column'
                        },
                        { 
                            name: 'Overall Average', 
                            type: 'spline', 
                            data: healthAvg, 
                            yAxis: 1, 
                            color: '#434348',
                            marker: { enabled: true }
                        }
                    ]
                });
            } catch (error) {
                console.error('Health Chart Error:', error);
                document.getElementById('healthChart').innerHTML = '<div class="map-error">Error loading health chart</div>';
            }
        }

        // Skill Chart
        if (document.getElementById('skillChart')) {
            try {
                Highcharts.chart('skillChart', {
                    chart: { type: 'bar' },
                    title: { text: 'Skill Analysis' },
                    xAxis: { categories: skillCategories },
                    yAxis: { min: 0, labels: { formatter() { return Math.round(this.value); } } },
                    legend: { enabled: false },
                    plotOptions: {
                        series: {
                            stacking: 'percent',
                            dataLabels: {
                                enabled: true,
                                formatter: function () {
                                    return `${this.series.name} (${Math.round(this.percentage)}%)`;
                                },
                                style: {
                                    textOutline: 'none',
                                    fontSize: '11px'
                                }
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
                    series: skillSeries
                });
            } catch (error) {
                console.error('Skill Chart Error:', error);
                document.getElementById('skillChart').innerHTML = '<div class="map-error">Error loading skill chart</div>';
            }
        }
        
    });
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.filldart-app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\nep\resources\views/fill-darts/dashboard.blade.php ENDPATH**/ ?>