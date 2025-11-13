<?php if(!empty($dailyReportCard['reportCardDetails']) && collect($dailyReportCard['reportCardDetails'])->isNotEmpty()): ?>

    <?php $__currentLoopData = collect($dailyReportCard['reportCardDetails'])->sortKeys(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sport => $details): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

        <div class="col-12"> <h2 class="mt-0 mb-4"><?php echo e($sport); ?></h2> </div>                                    
        <?php $__currentLoopData = collect($details)->sortByDesc('date'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                <div class="card mb-4 mt-2">

                    <div class="activity-img" onclick="modelContent(<?php echo e($detail['activity_id']); ?>, '<?php echo e($detail['skillsport']); ?>',  '<?php echo e($sport); ?>', '<?php echo e($detail['techniques']); ?>', '<?php echo e($dailyReportCard['studentProfile']['class']); ?> - <?php echo e($dailyReportCard['studentProfile']['section'] ?? ''); ?>', true)">
                        <div class="class">
                            <div class="date col py-1"><?php echo e(date('d-M-Y', strtotime($detail['date'])) ?? 'N.A'); ?></div>
                            <div class="prd col py-1">Period <?php echo e($detail['period'] ?? 'N.A'); ?></div>
                        </div>

                        <?php 
                            if($detail['image'] == ''){
                               $imagepath = 'public/change-activities/default_activity_img.svg'; 
                            } else {
                                if(str_starts_with($detail['image'], 'https')){
                                    $imagepath = $detail['image'];
                                }else{
                                    $file = 'public/uploads/'.$detail['image'];
                                    if (file_exists($file)) {                                                        
                                        $imagepath = 'public/uploads/'.$detail['image'];
                                    } else {
                                       $imagepath = 'public/change-activities/default_activity_img.svg';
                                    }
                                }
                            } 
                        ?>

                        <div class="img_overlay"></div>
                        <img class="card-img-top" src="<?php echo e($imagepath); ?>" alt="Card image cap">
                    </div>

                    <div class="card-body">
                        <h5 class="card-title"><?php echo e($detail['activity'] ?? 'N.A'); ?></h5> 
                        <p class="card-text"><strong>Rating</strong>                            
                            <span class="rating" style="position: relative; top: -5px;">
                                <span class="stars" style="margin-right: 0px;">
                                    <?php for ($i=0; $i < $detail['level'] ; $i++) {  ?>
                                      <img alt="star" src="<?php echo e('public/change-activities/star_fill-o.svg'); ?>" class="img-fluid">
                                    <?php } ?>
                                      
                                    <?php for ($i=0 ; $i < 7-$detail['level'] ; $i++ ) { ?>
                                        <img alt="star" src="<?php echo e('public/change-activities/star_border-o.svg'); ?>" class="img-fluid">
                                    <?php } ?>
                                </span>
                            </span>
                        </p>

                        <p class="card-text"><strong>Skill/Sports</strong> <?php echo e($detail['skillsport'] ?? 'N.A'); ?> </p>
                        <p class="card-text"><strong>Technique</strong><?php echo e($detail['techniques'] ?? 'N.A'); ?>  </p>
                        <p class="card-text"><strong>Level- <?php echo e($detail['level'] ?? 'N.A'); ?></strong><?php echo e($detail['level_name'] ?? 'N.A'); ?> </p>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php else: ?>
    <div class="col-12 col-md-12 mt-5">
        <div class="card py-5" style="text-align: center;">
            <h4>No data for this session</h4> 
        </div>
    </div>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\nep\resources\views/parent/partials/daily_tracker_details.blade.php ENDPATH**/ ?>