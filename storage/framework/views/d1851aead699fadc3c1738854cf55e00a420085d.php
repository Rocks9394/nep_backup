
<?php $__env->startSection('title', 'Goforfit | ' . $title); ?>
<?php $__env->startSection('content'); ?>


<div class="container all-chaptr-cards mt-5">
   <div class="row">
      <div class="col-12">
         <a href="<?php echo e(route('student.dashboard')); ?>" class="back-button">
            <span class="arrow">
               <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                  <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5" />
               </svg>
            </span>
         </a>
         <div class="heading-rw mt-2 mb-2">
            <h1><?php echo e($title); ?></h1>
			
            <?php
               $classSection = \App\Helpers\Helper::ClassSectionName($studentInfo->custom_class_id);
            ?>
         
            
			
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-12">
         <div class="mt-5">
            <div class="stu__report__area">
               <div class="stu__bmi">
                  <div class="std-report-info">
                     <p><span>Name: </span><?php echo e($studentInfo->student_name); ?></p>
                     <p><span>Class: <?php echo e($classSection->name.'-'.$classSection->section); ?></span></p>
                     <p><span>User ID: </span><?php echo e($studentInfo->user_id); ?></p>
                     <p><span>Gender/DOB: </span><?php echo e($studentInfo->gender); ?>/<?php echo e($studentInfo->dob); ?></p>
                     <p><span>School: </span><?php echo e($studentInfo->school_name); ?></p>
                  </div>

				  
               </div>
               <div class="stu__report mt-3">
                  <!--<h2>FMS Development Report</h2>-->
                  <h3 class="mt-3 mb-0">Locomotor Skills</h3>
                  <div class="test__tble mt-3">

                     <?php if(!empty($ReportDetail1) && count($ReportDetail1) > 0): ?>
                     <table>
                        <tr>
                           <th width="50px">P1</th>
                           <th><?php echo e($ReportDetail1[0]->skill_name); ?></th>
                           <th width="70px">Term 1</th>
                           <th width="70px">Term 2</th>
                        </tr>				 
                        
                        <?php $__currentLoopData = $ReportDetail1; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                        <tr>
                           <td><?php echo e($val->skill_type_name); ?></td>
                           <td><?php echo e($val->description); ?></td>
                           <td><?php if($val->skill_type_value == 'Y'): ?> <img src="<?php echo e(asset('public/assets/imgs/check.svg')); ?>">
                           <?php endif; ?>
                           </td>
                           <td></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>				  
                     </table>
                     <?php endif; ?>

                     <?php if(!empty($ReportDetail2) && count($ReportDetail2) > 0): ?>
                     <table>				  
                        <tr>
                           <th width="50px">P2</th>
                           <th><?php echo e($ReportDetail2[0]->skill_name); ?></th>
                           <th width="70px">Term 1</th>
                           <th width="70px">Term 2</th>
                        </tr>
                  
                        <?php $__currentLoopData = $ReportDetail2; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key2 => $val2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                        <tr>
                           <td><?php echo e($val2->skill_type_name); ?></td>
                           <td><?php echo e($val2->description); ?></td>
                           <td><?php if($val2->skill_type_value == 'Y'): ?> <img src="<?php echo e(asset('public/assets/imgs/check.svg')); ?>">
                           <?php endif; ?>
                           </td>
                           <td></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>				  
                     </table>
                     <?php endif; ?>
               
                     <?php if(!empty($ReportDetail3) && count($ReportDetail3) > 0): ?>
                     <table>				  
                        <tr>
                           <th width="50px">P3</th>
                           <th><?php echo e($ReportDetail3[0]->skill_name); ?></th>
                           <th width="70px">Term 1</th>
                           <th width="70px">Term 2</th>
                        </tr>
                     
                        <?php $__currentLoopData = $ReportDetail3; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key3 => $val3): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                           <tr>
                              <td><?php echo e($val3->skill_type_name); ?></td>
                              <td><?php echo e($val3->description); ?></td>
                              <td><?php if($val3->skill_type_value == 'Y'): ?> <img src="<?php echo e(asset('public/assets/imgs/check.svg')); ?>">
                              <?php endif; ?>
                              </td>
                              <td></td>
                           </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>				  
                     </table>
                     <?php endif; ?>
               
                     <?php if(!empty($ReportDetail4) && count($ReportDetail4) > 0): ?>
                     <table>				  
                        <tr>
                           <th width="50px">P4</th>
                           <th><?php echo e($ReportDetail4[0]->skill_name); ?></th>
                           <th width="70px">Term 1</th>
                           <th width="70px">Term 2</th>
                        </tr>
                     
                        <?php $__currentLoopData = $ReportDetail4; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key4 => $val4): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                        <tr>
                           <td><?php echo e($val4->skill_type_name); ?></td>
                           <td><?php echo e($val4->description); ?></td>
                           <td><?php if($val4->skill_type_value == 'Y'): ?> <img src="<?php echo e(asset('public/assets/imgs/check.svg')); ?>">
                           <?php endif; ?>
                           </td>
                           <td></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>				  
                     </table>
                     <?php endif; ?>

                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.filldart-app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\nep\resources\views/parent/fms-report.blade.php ENDPATH**/ ?>