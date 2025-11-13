
<?php $__env->startSection('title', 'Goforfit | ' . $title); ?>
<?php $__env->startSection('content'); ?>

<style type="text/css">
    .session_term .dropdown, .dropup {
        position: relative;
        height: 33px;
        padding: 6px;
    }
</style>

<div class="container all-chaptr-cards mt-5">
   <div class="row">
      <div class="col-12">   
         <div class="heading-rw mt-0 mt-md-1 mb-0 p-0">
               <?php if(auth()->guard('sstudent')->check()): ?>
               <a href="<?php echo e(route('student.dashboard')); ?>" class="back-button">
               <span class="arrow"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16"> <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5" />
                  </svg></span> 
               </a>
               <?php else: ?>
               <a href="<?php echo e(route('filldart.dashboard')); ?>" class="back-button">
               <span class="arrow"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16"> <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5" />
                  </svg></span> 
               </a>
               <?php endif; ?>
         
               <h1 class="ml-md-4 mb-0"><?php echo e($title); ?></h1>
         </div>      
      </div>
      <div class="col">
         <div class="session_term d-flex flex-row-reverse">
            <select class="dropdown" name="session_term" id="session_term">
               <?php
                  $maxId = $SessionAndTerm->max('id');
               ?>

               <?php $__currentLoopData = $SessionAndTerm; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <option 
                     class="dropdown-item" 
                     value="<?php echo e($data->id); ?>" 
                     <?php echo e($data->id == $maxId ? 'selected' : ''); ?>>
                     <?php echo e($data->academic_year); ?> | <?php echo e($data->term_name); ?>

                  </option>
               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
         </div>
      </div>
   </div>

   <div class="row" id="skill_report1">
      <div class="col-12">
         <div class="container-fluid1">
            <div class="row">
               <div class="col-12">
                  <div class=" student-info">
                     <div class="container-fluid">
                        <div class="row">
                           <div class="col-12 col-md-4 col-lg">
                              <span class="lb">Name:</span><span><?php echo e($reportDetail['studentProfile']['name']); ?></span>
                           </div>
                           <div class="col-6 col-md-4 col-lg">
                              <span class="lb">Class:</span><span><?php echo e($reportDetail['studentProfile']['class']); ?> - <?php echo e($reportDetail['studentProfile']['section'] ?? ''); ?></span>
                           </div>
                           <div class="col-6 col-md-4 col-lg-2">
                              <span class="lb">Roll No:</span><span><?php echo e($reportDetail['studentProfile']['rollno']); ?></span>
                           </div>
                           <div class="col-6 col-md-4 col-lg-2">
                              <span class="lb">DOB:</span><span><?php echo e($reportDetail['studentProfile']['dob']); ?></span>
                           </div>
                           <div class="col-6 col-md-4 col-lg-2">
                              <span class="lb">Gender:</span><span><?php echo e($reportDetail['studentProfile']['gender']); ?></span>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="row mt-4">
               <div class="col-12 student-report" id="student_report_card">
                  <?php echo $__env->make('parent.partials.report_card_details', ['reportDetail' => $reportDetail, 'levels' => $levels], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>



<script>
   $('#session_term').on('change', function () {
        let sessionTermId = $(this).val();

        if (sessionTermId) {
            $.ajax({
                url: "<?php echo e(route('skill.report')); ?>",
                type: 'GET',
                data: { session_term_id: sessionTermId },
                beforeSend: function() {
                    $('#student_report_card').html('<div class="text-center">Loading...</div>');
                },
                success: function (response) {
                    $('#student_report_card').html(response.html);
                },
                error: function () {
                    $('#student_report_card').html('<div class="text-danger">Something went wrong.</div>');
                }
            });
        }
    });
</script>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.filldart-app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\nep\resources\views/parent/skillreport2.blade.php ENDPATH**/ ?>