
<?php $__env->startSection('title', 'Goforfit | ' . $title); ?>
<?php $__env->startSection('content'); ?>
<div class="pg-yallow-color">
    <div class="container">
        <div class="navbar-expand-lg">
            <div id="fillter" class="" role="group" aria-label="Basic example">
            </div>
        </div>
    </div>
</div>
<style>

</style>

<div class="container">
    <div class="t-mrg">

        <div class="row text-center justify-content-md-center">
            <div class="col-12 col-md-10 col-lg-10">
                <div class="form-row" style="justify-content: center;">
                    

                    <div class="col-4 col-md-3 col-lg-3 col-xl-2 mb-4">
                        <a href="<?php echo e(route('student.test.dashboard' )); ?>" class="box">
                            <div>
                                <img class="img-fluid" alt="" src="<?php echo e(asset('public/uploads/icons/Dashboard.svg')); ?>">
                            </div>
                            <span>Student Dashboard</span>
                        </a>
                    </div>
                    
                    <div class="col-4 col-md-3 col-lg-3 col-xl-2 mb-4 text-center">
                        <a href="<?php echo e(route('skill.dailyreport')); ?>" class="box"><div><img class="img-fluid" alt="" src="<?php echo e(asset('public/uploads/icons/skills-report.svg')); ?>"></div><span>Daily Tracker</span></a>
                    </div>
                      
                    <div class="col-4 col-md-3 col-lg-3 col-xl-2 mb-4">
                        <a href="<?php echo e(route('skill.report')); ?>" class="box">
                            <div> <img class="img-fluid" alt="" src="<?php echo e(asset('public/uploads/icons/skills-report.svg')); ?>"> </div>
                            <span>Skill Reports</span>
                        </a>
                    </div>

                    <div class="col-4 col-md-3 col-lg-2 col-xl-2 mb-4">
                        <a href="<?php echo e(route('activity.according.to.class')); ?>" class="box"><div><img class="img-fluid" alt="" src="<?php echo e(asset('public/uploads/icons/activities.svg')); ?>"></div><span>Activity Planner</span></a>
                    </div>

                    <div class="col-4 col-md-3 col-lg-3 col-xl-2 mb-4">
                        <a href="<?php echo e(route('student.report')); ?>" class="box">
                            <div data-toggle="tooltip" data-placement="top" title="Progress Report">
                                <img class="img-fluid" alt="" src="<?php echo e(asset('public/uploads/icons/taketest.svg')); ?>">
                            </div>
                            <span>Progress Report</span>
                        </a>
                    </div>
                    
                    <div class="col-4 col-md-3 col-lg-2 col-xl-2 mb-4">
                        <a href="<?php echo e(route('test.videos')); ?>" class="box"><div><img class="img-fluid" alt="" src="<?php echo e(asset('public/uploads/icons/test-demo.svg')); ?>"></div><span>Battery of Tests</span></a>
                    </div>


    				<?php if($countFMS >0): ?>
                        <div class="col-4 col-md-3 col-lg-3 col-xl-2 mb-4">
                            <a href="<?php echo e(route('fms.skills.reports')); ?>" class="box" data-toggle="tooltip" data-placement="top" title="End of the term">
                                <div >
                                    <img class="img-fluid" alt="" src="<?php echo e(asset('public/uploads/icons/Dashboard.svg')); ?>">
                                </div>
                                <span >FMS Development</span>
                            </a>
                        </div>
    				<?php else: ?>



    			    <?php endif; ?>		
					
					


                    <div class="col-4 col-md-3 col-lg-3 col-xl-2 mb-4">
                        <a href="<?php echo e(route('learn.sports')); ?>" class="box"><div><img class="img-fluid" alt="" src="<?php echo e(asset('public/uploads/icons/Learn-Sports.svg')); ?>"></div><span>Learn Sports</span></a>
                    </div>
                    

                    <div class="col-4 col-md-3 col-lg-3 col-xl-2 mb-4">
                        <a href="<?php echo e(route('getactive')); ?>" class="box"><div><img class="img-fluid" alt="" src="<?php echo e(asset('public/uploads/icons/Get-Active.svg')); ?>"></div><span>Get Active</span></a>
                    </div>




                    
                    

					


                </div>
            </div>

        </div>

    </div>





</div>
</div>



 <!-- Modal for profile update -->
 <div class="modal fade"  id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true" >
     <div class="modal-dialog modal-dialog modal-lg modal-dialog-centered">

         <form action="<?php echo e(route('profile.update')); ?>" method="POST" class="modal-lg modal-content"> 
             <?php echo csrf_field(); ?>
             <?php echo method_field('PUT'); ?>
             <div class="modal-content">
                 <div class="modal-header">
                    <h5 class="modal-title" id="profileModalLabel">Update Profile</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>

                  <div class="modal-body">
                     <!-- Name Input -->

                     <div class="alert alert-warning" role="alert">
                       Last updated on : <?php echo e(date('d-M-Y', strtotime($stdInfo->last_updated))); ?>

                     </div>

                     <div class="row">
                        <div class="col">
                           <div class="mb-3">
                               <label for="name" class="form-label">Name</label>
                               <input type="text" class="form-control" id="name" name="student_name" value="<?php echo e(old('student_name', $stdInfo->student_name)); ?>" required>
                           </div>
                        </div>
                        
                        <div class="col">
                           <div class="mb-3">
                               <label for="email" class="form-label">Email</label>
                               <input type="email" class="form-control" id="email" name="email_id" value="<?php echo e(old('email_id', $stdInfo->email_id)); ?>" required>
                           </div>
                         </div>
                     </div>

                     <div class="row">
                        <div class="col">

                           
                           <div class="mb-3">
                              <label for="dob" class="form-label">Date of Birth</label>
                              <input type="date" name="dob" id="dob" data-id="" value="<?php echo e($stdInfo->dob); ?>" class="form-control">
                           </div>
                        </div>
                        
                        <div class="col">
                           <div class="mb-3">
                               <label for="domicile" class="form-label">Domicile</label>
                               <input type="text" class="form-control" id="domicile" name="domicile" value="<?php echo e(old('domicile', $stdInfo->domicile)); ?>">
                           </div>
                         </div>
                     </div>

                     <div class="row">
                        <div class="col">
                            <div class="mb-3">
                               <label for="fav_sport" class="form-label">Favourite Sport</label>
                               <input type="text" class="form-control" id="fav_sport" name="fav_sport" value="<?php echo e(old('fav_sport', $stdInfo->fav_sport)); ?>">
                           </div>
                        </div>
                        
                        <div class="col">
                            <div class="mb-3">
                               <label for="hobbies" class="form-label">Hobbies</label>
                               <input type="text" class="form-control" id="hobbies" name="hobbies" value="<?php echo e(old('hobbies', $stdInfo->hobbies)); ?>">
                           </div>
                         </div>
                     </div>
                  </div>

                 <div class="modal-footer">
                     <button type="submit" class="btn btn-sm btn-primary">Save changes</button>
                 </div>
             </div>
         </form>
     </div>
 </div>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
//    $(document).ready(function() {
//       // Initialize Bootstrap tooltips
//       $('[data-toggle="tooltip"]').tooltip();
//    });



</script>
<script>
    $('#notAvailable').on('click', function (e) {

        Swal.fire({
            icon: 'info',
            title: 'Temporarily Unavailable',
            text: 'This feature is temporarily unavailable. Will come back soon.',
            confirmButtonText: 'OK'
        });
        return;
    });
</script>


<?php if(session('updateprofile')): ?>
   <script>
     document.addEventListener('DOMContentLoaded', function () {
         $('#profileModal').modal('show');
     });
   </script>
<?php endif; ?>

<?php if(session()->has('message')): ?>    
   <script type="text/javascript">
      Swal.fire({
        position: "top-end",
        icon: "success",
        title: <?php echo json_encode(session()->get('message'), 15, 512) ?>,
        showConfirmButton: false,
        timer: 1500
      });
   </script>
<?php endif; ?>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.filldart-app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\nep\resources\views/parent/index.blade.php ENDPATH**/ ?>