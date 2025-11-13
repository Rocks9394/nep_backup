
<?php $__env->startSection('title', 'Goforfit | ' . $title); ?>
<?php $__env->startSection('content'); ?>

<div class="all-chaptr-cards">
    <div class="container">
        <div class="t-mrg2 mb-5 pb-5">
            <div class="row">
                <div class="col-12">
                    <div class="heading-rw mt-0 mt-md-1 mb-0 p-0">
                        <a href="javascript:history.back()" class="back-button">
                            <span class="arrow"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5" />
                                </svg>
                            </span>
                        </a>

                        <h1 class="ml-md-4 mb-0"><?php echo e($title); ?></h1>
                    </div>
                </div>
            </div>

            
                <?php
                $type = "allFmsTest";
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

                <form class="row" method="POST" name="fms_types_submit" id="fms_types_submit_id" action="">
                    <?php echo e(method_field('post')); ?>

                    <?php echo csrf_field(); ?>

                    <input type="hidden" name="skillReportId" value="<?php echo e($skillReportId); ?>" id="skillReportId">
                    <input type="hidden" name="TestTypeMasterID" value="<?php echo e($TestTypeMasterID); ?>">
                    <input type="hidden" name="SchoolId" id="SchoolId"  value="<?php echo e($SchoolId); ?>">
                    <input type="hidden" name="student_id" id="selected_student_id" >


                        <div class="col-12">
                            <div class="list-group mb-4">

                                <?php $__currentLoopData = $skillTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <label class="list-group-item pr-3">
                                    <input class="form-check-input me-1" name="description[]" type="checkbox" value="<?php echo e($val->id); ?>">
                                    <?php echo e($val->description); ?>

                                </label>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </div>
                        </div>

                        
                        <?php
                            $id = "fmsTest";
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


<script>
$(document).ready(function() {
    $('#fms_types_submit_id').submit(function(e) {
        e.preventDefault(); // prevent default form submission
    
        const studentId = document.getElementById('selected_student_id').value;
        if(!studentId){
            handleResponseMessages( 'warning',  'Select Student', 'Please select the student');
            return;
        }

        const checkedCount = $('input[name="description[]"]:checked').length;

        if (checkedCount === 0) {
            handleResponseMessages( 'warning',  'No Observation Selected', 'Please select at least one observation before submitting');
            return;
        }
        submitLoader();
        $.ajax({
            url: '<?php echo e(route("fms.types.submit")); ?>', 
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {	
                Swal.close();	
                $('#fms_types_submit_id')[0].reset();
                
                handleResponseMessages( 'success',  '', response.message, {
                    confirmText: 'OK',
                    onConfirm: function () {
                        location.reload();
                    }
                });		
					
            },
            error: function(xhr) {
                Swal.close();
                let errors = xhr.responseJSON.errors;
                let errorHtml = '<ul>';
                $.each(errors, function(key, value) {
                    errorHtml += '<li>' + value[0] + '</li>';
                });
                errorHtml += '</ul>';
                $('#response').html('<div style="color:red;">' + errorHtml + '</div>');
				
				Swal.fire({
					title: "error!",
					html: errorHtml,
					icon: "error"
					});
				
            }
        });
    });
});
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.icsce-master-app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\nep\resources\views/assessor/fms-types.blade.php ENDPATH**/ ?>