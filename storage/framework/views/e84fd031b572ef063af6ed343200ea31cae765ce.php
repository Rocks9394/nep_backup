
<?php $__env->startSection('title', 'Goforfit | ' . $title); ?>
<?php $__env->startSection('content'); ?>
<style>
    .hide{
        pointer-events: none;   
        opacity: 0.6;    
        cursor: not-allowed;
    }
</style>
<div class="all-chaptr-cards">
    <div class="container">
        <div class="t-mrg2 mb-5 pb-5">
            <div class="row">
                <div class="col-12">
                    <div class="heading-rw mt-0 mt-md-1 mb-0 p-0">
                    <?php if(auth()->guard('web')->check()): ?>
                    
                        <a href="javascript:history.back()" class="back-button">
                            <span class="arrow"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5" />
                                </svg></span> 
                        </a>

                    <?php elseif(auth()->guard('sstudent')->check()): ?>

                        <a href="javascript:history.back()" class="back-button">
                            <span class="arrow"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5" />
                                </svg></span> 
                        </a>
                    
                    <?php endif; ?>

                    
                        <h1 class="ml-md-4 mb-0"><?php echo e($title); ?></h1> 
                    </div>
                </div>
            </div>

            

            <?php
            $type = "fitnessTest";
            ?>

            <?php if (isset($component)) { $__componentOriginala79132a0eb0555395f0871f42920999627f369c7 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\GetStudentList::class, ['classes' => $classes,'type' => $type]); ?>
<?php $component->withName('get-student-list'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala79132a0eb0555395f0871f42920999627f369c7)): ?>
<?php $component = $__componentOriginala79132a0eb0555395f0871f42920999627f369c7; ?>
<?php unset($__componentOriginala79132a0eb0555395f0871f42920999627f369c7); ?>
<?php endif; ?>
            
            
            <form class="row" method="POST" name="savePlateTappingRecord" id="save_hand-toss" action="">
                <?php echo e(method_field('post')); ?>

                <?php echo csrf_field(); ?>
                    
            <input type="hidden" name="skillReportId" value="<?php echo e($skillReportId); ?>">
            <input type="hidden" name="TestTypeMasterID" value="<?php echo e($TestTypeMasterID); ?>">
            <input type="hidden" id="SchoolId" name="SchoolId" value="<?php echo e($SchoolId); ?>">
            <input type="hidden" id="selected_student_id" name="student_id">
            <input type="hidden" id="total_milisecond_id" name="total_miliseconds">
            
            <h2 class="mb-3 mt-4 text-center"><?php echo e($title); ?> Score</h2>
        
            
            <?php
                $id = "plateTapping";
            ?>
            <?php if (isset($component)) { $__componentOriginal13ae91a68310e77ac9eb18b0d1e273979f9627eb = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\ResetSubmitBtn::class, ['id' => $id]); ?>
<?php $component->withName('reset-submit-btn'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal13ae91a68310e77ac9eb18b0d1e273979f9627eb)): ?>
<?php $component = $__componentOriginal13ae91a68310e77ac9eb18b0d1e273979f9627eb; ?>
<?php unset($__componentOriginal13ae91a68310e77ac9eb18b0d1e273979f9627eb); ?>
<?php endif; ?>
            	
        </form>	
            
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.icsce-master-app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\nep\resources\views/assessor/shuttle-run.blade.php ENDPATH**/ ?>