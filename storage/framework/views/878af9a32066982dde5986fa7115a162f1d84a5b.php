
<?php $__env->startSection('title', 'Goforfit | ' . $title); ?>
<?php $__env->startSection('content'); ?>

<?php
    $user = null;
    if(auth()->guard('web')->check()) {
        $user = auth()->guard('web')->user();
    } elseif(auth()->guard('sstudent')->check()) {
        $user = auth()->guard('sstudent')->user();
    }
?>



<?php if(Auth::user()->role_id == '4'): ?>

    <marquee behavior="scroll" direction="left" scrollamount="5" onmouseover="this.stop()" onmouseout="this.start()" style="font-size: 16px;
    font-weight: 500;
    background-color: #ff8000;
    color: #fff;
    padding: 4px;">
	  <strong>Important Notice: </strong><span>Please check the highlighted students in the Manage Student module and update their details.</span>
	</marquee>


<?php elseif(Auth::user()->role_id == '3'): ?>
	<marquee behavior="scroll" direction="left" scrollamount="5" onmouseover="this.stop()" onmouseout="this.start()" style="font-size: 16px;
	font-weight: 500;
	background-color: #ff8000;
	color: #fff;
	padding: 4px;">
	<strong>Important Notice: </strong><span>Kindly update your profile details (email, mobile number, and date of birth) in the Edit Profile section. If all details are already updated, please ignore this notice.</span>
</marquee>
<?php endif; ?>

<?php if(session('show_profile_update_popup')): ?>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        Swal.fire({
        title: 'Profile Update Required',
        text: 'Kindly update your profile.',
        icon: 'warning',
        confirmButtonText: 'Update Now',
        allowOutsideClick: false
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "<?php echo e(session('profile_update_route')); ?>";
        }
    });
    });
</script>
<?php endif; ?>

<div class="container">
    <div class="t-mrg">
        <div class="row text-center justify-content-md-center">
            <div class="col-12 col-md-12 col-lg-12 col-xl-10">
                <div class="form-row" style="justify-content: center;">

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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.filldart-app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\nep\resources\views/fill-darts/dashboard.blade.php ENDPATH**/ ?>