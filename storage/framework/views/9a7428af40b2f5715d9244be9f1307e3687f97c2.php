<div class="grid">                        
   
   <?php if(!empty($reportDetail['reportCardDetails']) && collect($reportDetail['reportCardDetails'])->isNotEmpty()): ?>

      <table cellspacing="0" cellpadding="0" class="tbl">
         <tr class="s3">
            <th width="170px;">Skill / Sports</th>
            <th width="170px;">Technique</th>
            <th>Activity</th>
            <th colspan="7" width="130px;">Rating</th>
            <th width="140px;">Level</th>
         </tr>

         <?php $__currentLoopData = collect($reportDetail['reportCardDetails'])->sortKeys(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skillName => $skillarea): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <?php
               $sportRowspan = 0;
               foreach($skillarea as $technique){
                  $sportRowspan += count($technique); 
               }
               $sportFirstRow = true; 
            ?>

            <?php $__currentLoopData = collect($skillarea)->sortKeys(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $techniqueName => $activities): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
               <?php $techniqueRowspan = count($activities); ?>

               <?php $__currentLoopData = collect($activities)->sortKeys(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity_title => $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                  <?php $__currentLoopData = $activity; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $outcomes): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                     <tr>
                        <?php if($sportFirstRow): ?>
                           <td rowspan="<?php echo e($sportRowspan); ?>" style="text-align: center;"><p class="s4"><?php echo e($skillName ?? 'N.A'); ?></p></td>
                           <?php $sportFirstRow = false; ?>
                        <?php endif; ?>

                        <?php if(!isset($techniqueFirstRow)): ?>
                           <?php $techniqueFirstRow = true; ?>
                        <?php endif; ?>

                        <?php if($techniqueFirstRow): ?>
                        <td rowspan="<?php echo e($techniqueRowspan); ?>" style="text-align: center;"><p class="s4"><?php echo e($techniqueName ?? 'N.A'); ?></p></td>
                          <?php $techniqueFirstRow = false; ?>
                        <?php endif; ?>

                        <td><p class="s4"><?php echo e($activity_title ?? 'N.A'); ?></p></td>
                        <td class="star" colspan="7" style="text-align: left;">
                           <?php for($i = 0; $i < $outcomes['level']; $i++): ?>
                              <span class="s5 filled">&#9733;</span>   
                           <?php endfor; ?>

                           <?php for($i = 0; $i < 7 - $outcomes['level']; $i++): ?>
                              <span class="s5 ">&#9734;</span>
                           <?php endfor; ?>
                        </td>
                        <td><p class="s4"><?php echo e($outcomes['level_name'] ?? 'N.A'); ?></p></td>
                     </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>   
               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

               <?php unset($techniqueFirstRow); ?>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </table>
   </div>


    <button class="btn btn-link collapsed mt-4 px-0" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree"> Rubric Descriptions </button>

    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
         <div class="card-body p-0">
            <table class="table table-bordered ">
               <thead>
                  <tr>
                     <th scope="col">Level</th>
                     <th scope="col">Level Name</th>
                     <th scope="col">Description</th>
                  </tr>
               </thead>
               <tbody>
                  <?php $__currentLoopData = $levels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $level): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                     <td>L-<?php echo e($level->level_value); ?> </td>
                     <td> <?php echo e($level->level_name); ?> </td>
                     <td> <?php echo e($level->description); ?> </td>
                  </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>              
               </tbody>
            </table>
         </div>
      </div>

   <?php else: ?>

      <div class=" mt-4">
         <div class="col-12 student-report">
            <div class="row activity_cards mb-5">
               <div class="col-12 col-md-12 mt-5 p-0">
                  <div class="card" style="text-align: center; min-height: auto; box-shadow: none;">
                     <h4>No Report Available</h4>
                  </div>
               </div>
            </div>
         </div>
      </div>

   <?php endif; ?>


<?php /**PATH C:\xampp\htdocs\nep\resources\views/parent/partials/report_card_details.blade.php ENDPATH**/ ?>