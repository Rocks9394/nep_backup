<style type="text/css">
    .heading-rw{
        margin-left: -30px;
    }
</style>

<div class="col d-flex">
    <a href="#a" onclick="history.back()" class="back-button">
        <span class="arrow">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5" />
            </svg>
        </span>
    </a>

    <div class="heading-rw mt-1 mb-0">
        <h1><?php echo e($title); ?></h1>
    </div>
</div>

<div class="col-auto col-md-auto">
  <?php if(isset($actionsOutside)): ?>
        <div class="datatable-actions-outside">
            <?php echo e($actionsOutside); ?>

        </div>
    <?php endif; ?>
</div>




<?php /**PATH C:\xampp\htdocs\nep\resources\views/components/back-button.blade.php ENDPATH**/ ?>