
<?php $__env->startSection('title', 'CISCE | ' . $title); ?>
<?php $__env->startSection('content'); ?>

<style>

    /* Small devices (Large phones, 576px and up)  576px and 768px  */
    @media (min-width: 576px) {
     
    }

    /* Medium devices (Tablets, 768px and up)    768px and  992px */
    @media (min-width: 768px) {
      
    }


    /* Large devices (Desktops, 992px and up)  992px and above*/
    @media (min-width: 992px) {
      
    }

    /* 0px to 767px  */
    @media (max-width: 767px) {   


      .scanner-conatiner{
            margin-top: 0px !important;
      }
    }

    #scanner_btn{
        min-width: 56px !important;
    }

</style>
<?php echo $__env->yieldPushContent('cwsn-style'); ?>

<div class="container">
    <div class="t-mrg2 mb-5 pb-5">            
        <div class="all-chaptr-cards">
            <div class="row">
                <div class="col">
                    <div class="heading-rw mt-0 mt-md-1 mb-0 p-0"> 
                     <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.back-button','data' => ['title' => $title]]); ?>
<?php $component->withName('back-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($title)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?> 
                    </div>
                </div>
            </div>

            <?php  $type = "cwsnlist"; ?>
            
            <?php if (isset($component)) { $__componentOriginala79132a0eb0555395f0871f42920999627f369c7 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\GetStudentList::class, ['classes' => $classes,'type' => $type,'title' => $title,'cwsnType' => $pwd_category_id]); ?>
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
            
            <div class="col-12"> <?php echo $__env->yieldContent('cwsnform'); ?> </div>
        </div>
    </div>
</div>


<?php echo $__env->yieldPushContent('cwsn-module-script'); ?>

<script>
    function SubmitForm(formid, formData, route) {

        submitLoader();

        $.ajax({
            url: route,
            method: 'POST',
            data: formData, 
            success: function(response) {   
                Swal.close();   
                $(`#${formid}`)[0].reset();

                if (response.status === 'success' || response.success == true) {
                    handleResponseMessages( 'success',  '', response.message, {
                        confirmText: 'OK',
                        onConfirm: function () {
                            location.reload();
                        }
                    });
                }
            },

            error: function (xhr) {
                Swal.fire({
                    title: "Error!",
                    text: xhr.responseJSON?.message ?? 'Unexpected error occurred',
                    icon: "error"
                });
            }
        });
    }
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.filldart-app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\nep\resources\views/assessor/cwsn/index.blade.php ENDPATH**/ ?>