
<?php $__env->startSection('cwsnform'); ?>

<style>
    h4.text-uppercase {
        color: #292775 !important;
    }
    /* Active visual state feedback styling for Bootstrap group buttons */
    .btn-group-toggle label.active.btn-outline-success {
        background-color: #28a745 !important;
        color: #fff !important;
    }
    .btn-group-toggle label.active.btn-outline-danger {
        background-color: #dc3545 !important;
        color: #fff !important;
    }
</style>

<h2 class="text-center pb-2"><?php echo e($title); ?> Score</h2>


<form method="POST" name="<?php echo e($TestTypeId); ?>" id="<?php echo e($TestTypeId); ?>" action="javascript:void(0);">
    <?php echo csrf_field(); ?>
    
    <input type="hidden" name="skillReportId" value="<?php echo e($skillReportId); ?>" id="skillReportId">
    <input type="hidden" name="TestTypeMasterID" value="<?php echo e($TestTypeMasterID); ?>">
    <input type="hidden" name="SchoolId" id="SchoolId" value="<?php echo e($SchoolId); ?>">
    <input type="hidden" name="student_id" id="selected_student_id">

    
    <input type="hidden" name="score_left" id="score_left" value="">
    <input type="hidden" name="score_right" id="score_right" value="">

    <div class="row">
        <!-- Left Shoulder Assessment Card -->
        <div class="col-12 col-md-6 mb-3">
            <div class="card border-0 shadow-sm" style="border-radius: 12px;">
                <div class="card-body text-center">
                    <h4 class="font-weight-bold text-uppercase mb-1" style="font-size: 1.1rem;">Left Arm Stretch</h4>
                    <p class="small mb-2 text-muted">(Left arm over left shoulder, fingertips touching)</p>
                    
                    <div class="btn-group w-100 shoulder-toggle">
                        <label class="btn btn-outline-danger font-weight-bold w-50" style="border-top-left-radius: 20px; border-bottom-left-radius: 20px;">
                            <input type="radio" name="left_shoulder_status" id="left_fail" value="0" autocomplete="off" class="d-none"> FAIL
                        </label>
                        <label class="btn btn-outline-success font-weight-bold w-50" style="border-top-right-radius: 20px; border-bottom-right-radius: 20px;">
                            <input type="radio" name="left_shoulder_status" id="left_pass" value="1" autocomplete="off" class="d-none"> PASS
                        </label>
                    </div>
                </div>
            </div>
        </div>
         <!-- Right Shoulder Assessment Card -->
        <div class="col-12 col-md-6 mb-3">
            <div class="card border-0 shadow-sm" style="border-radius: 12px;">
                <div class="card-body text-center">
                    <h4 class="font-weight-bold text-uppercase mb-1" style="font-size: 1.1rem;">Right Arm Stretch</h4>
                    <p class="small mb-2 text-muted">(Right arm over right shoulder,  fingertips touching)</p>
                    
                    <!-- REMOVED data-toggle="buttons" to prevent Bootstrap conflicts -->
                    <div class="btn-group w-100 shoulder-toggle">
                        <label class="btn btn-outline-danger font-weight-bold w-50" style="border-top-left-radius: 20px; border-bottom-left-radius: 20px;">
                            <input type="radio" name="right_shoulder_status" id="right_fail" value="0" autocomplete="off" class="d-none"> FAIL
                        </label>
                        <label class="btn btn-outline-success font-weight-bold w-50" style="border-top-right-radius: 20px; border-bottom-right-radius: 20px;">
                            <input type="radio" name="right_shoulder_status" id="right_pass" value="1" autocomplete="off" class="d-none"> PASS
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php if (isset($component)) { $__componentOriginal13ae91a68310e77ac9eb18b0d1e273979f9627eb = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\ResetSubmitBtn::class, ['id' => $TestTypeId]); ?>
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

<script>
function syncShoulderPayload() {
    let rightVal = document.querySelector('input[name="right_shoulder_status"]:checked')?.value || '';
    let leftVal = document.querySelector('input[name="left_shoulder_status"]:checked')?.value || '';

    document.getElementById('score_left').value = leftVal;
    document.getElementById('score_right').value = rightVal;
}

$(document).ready(function() {
    const formId = <?php echo json_encode($TestTypeId, 15, 512) ?>;
    const formSelector = $(`#${formId}`);

    formSelector.on('change', 'input[type="radio"]', function() {
        const selectedRadio = $(this);
        const parentLabel = selectedRadio.closest('label');
        const siblingLabels = selectedRadio.closest('.shoulder-toggle').find('label');

        siblingLabels.removeClass('active btn-danger btn-success');
        
        // 2. Add active visual feedback using proper contextual colors
        if (selectedRadio.val() === "1") {
            parentLabel.addClass('active btn-success');
        } else {
            parentLabel.addClass('active btn-danger');
        }

        syncShoulderPayload();
    });


    $(`#reset_${formId}`).on('click', function(e) {
        e.preventDefault();

        console.log('ppps')
        formSelector[0].reset();
        formSelector.find('.shoulder-toggle label').removeClass('active btn-danger btn-success');
        document.getElementById('score_left').value = '';
        document.getElementById('score_right').value = '';
    });


    $(`#${formId}`).submit(function(e) {
        e.preventDefault();

        const studentId = document.getElementById('selected_student_id').value;
        const scoreLeft = document.getElementById('score_left').value;
        const scoreRight = document.getElementById('score_right').value;

        if (!studentId) {
            handleResponseMessages( 'warning',  'Select Student', 'Please select the student');
            return;
        }

        if (scoreLeft === '' || scoreRight === '') {
            handleResponseMessages('info', 'Incomplete Form', 'Please record both Left and Right arm metrics before saving.');
            return;
        }

        let route = '<?php echo e(route("cwsn.types.submit")); ?>';
        let formData =  $(this).serialize();
        SubmitForm(formId, formData, route);
        document.getElementById('live_status_badge').textContent = `Level 1, Shuttle 0`;
    });

});
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('assessor.cwsn.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\nep\resources\views/assessor/cwsn/forms/shoulder-streatch.blade.php ENDPATH**/ ?>