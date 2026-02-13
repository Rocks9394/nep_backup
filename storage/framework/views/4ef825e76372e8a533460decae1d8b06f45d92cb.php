
<?php $__env->startSection('title', 'Goforfit | ' . $title); ?>
<?php $__env->startSection('content'); ?>

<style>
    .select-terms{
        height: 35px;
        margin-left: 10px;
    }
    .term-select{
        border-color: var(--org-color);
        height: 100%;
        padding: 2px;
        border-radius:5px;
        color: var(--org-color);
    }
</style>
<?php if(session('warning') || isset($warning)): ?>
    <script>
        Swal.fire({
            icon: 'warning',
            title: 'Browser Recommendation',
            width: '600px',
            html: `
            <div style="background-color:#f8f9fa; border:1px solid #ddd; border-radius:8px; padding:16px; max-width:470px; margin:auto; font-family:Arial, sans-serif; color:#333;">
                    <strong><?php echo e($warning ?? session('warning')); ?></strong>
                    <ul style="margin:0 0 10px 0; text-align:left; padding:5px;">
                        <li class="pb-2">For the best experience, please use <strong>Google Chrome</strong> as your browser.</li>
                        <li class="pb-2">Make sure that <strong>JavaScript</strong> and <strong>cookies</strong> are enabled.</li>
                    </ul>

                    <div style="margin-top:15px; align-item:center;">
                        <p style="margin:0 0 8px 0; font-weight:500;">Download Google Chrome</p>

                        <div style="display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap;">

                            <!-- Play Store -->
                            <a href="https://play.google.com/store/apps/details?id=com.android.chrome" target="_blank"
                            style="display:inline-flex; align-items:center; text-decoration:none;">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/7/78/Google_Play_Store_badge_EN.svg"
                                    alt="Download on Google Play" style="height:35px;">
                            </a>

                            <!-- App Store -->
                            <a href="https://apps.apple.com/app/google-chrome/id535886823" target="_blank"
                            style="display:inline-flex; align-items:center; text-decoration:none;">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/91/Download_on_the_App_Store_RGB_blk.svg/2560px-Download_on_the_App_Store_RGB_blk.svg.png"
                                    alt="Download on App Store" style="height:35px;">
                            </a>

                            <!-- Desktop Chrome -->
                            <a href="https://www.google.com/chrome/" target="_blank"
                            style="display:inline-flex; align-items:center; text-decoration:none;">
                                <img src="https://www.google.com/chrome/static/images/fallback/chrome-logo-2023.png"
                                    alt="Get Chrome for Desktop" style="height:35px; border-radius:6px;">
                            </a>

                        </div>
                    </div>
                </div>

            `,
            confirmButtonText: 'OK',

            confirmButtonColor: '#3085d6',
            allowOutsideClick: false,
        });
    </script>
<?php endif; ?>

<div class="container">
    <div class="t-mrg2 mb-5 pb-5">
        <div class=" all-chaptr-cards" style="margin: 0;">
            <div class="row">
                    <div class="col">
                        <div class="heading-rw mt-0 mt-md-1 mb-0 p-0">
                            <?php if(auth()->guard('web')->check()): ?>

                            <a href="<?php echo e(route('filldart.dashboard')); ?>" class="back-button">
                                <span class="arrow"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5" />
                                    </svg>
                                </span>
                            </a>

                            <?php elseif(auth()->guard('sstudent')->check()): ?>

                                <a href="<?php echo e(route('student.dashboard')); ?>" class="back-button">
                                    <span class="arrow"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5" />
                                            </svg>
                                    </span>
                                </a>
                            <?php endif; ?>
                            
                            <h1 class="mt-2 mt-md-0 ml-md-4 mb-0"><?php echo e($title); ?></h1>
                           
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="select-terms">
                            <select name="term" id="term" class="term-select">
                                <?php $__currentLoopData = $terms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $term): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($term->id); ?>"
                                        <?php echo e($selectedTerm == $term->id ? 'selected' : ''); ?>>
                                        <?php echo e($term->academic_year); ?> | <?php echo e($term->term_name); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-auto">
                        <div class="btn-group toggle-btns" role="group" aria-label="Test Status Toggle">
                            <button type="button" class="btn btn-outline-primary btn-sm" id="btn-all" data-value="all">All</button>
                            <button type="button" class="btn btn-outline-primary btn-sm active" id="btn-remaining" data-value="remaining">Incomplete</button>
                        </div>
                    </div>
                </div>
                <div class="row text-center justify-content-md-center mt-3 mt-lg-4">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="all-tests mb-5">
                            <h4 class="test-cat">Development Skills for Age 5-8 (Class 1-3)</h4>
                            <ul class="list-group mt-0">
                            
                            <?php $__currentLoopData = $juniorData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <a href="<?php echo e(route('assessor-app-test', ['TestcategoryId' => $val->TestCategoryID])); ?>"><span><?php echo e($val->TestCategoryName); ?></span><span class="arrow-i"><i class="bi bi-arrow-right"></i></span></a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>     
                             
                           
                            </ul>
                            <br>
                            <h4 class="test-cat">Physical Fitness Assessment for Age 5-8 (Class 1-3)</h4>
                            <ul class="list-group mt-0">
                            
                            <?php $__currentLoopData = $juniorData1; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key1 => $val1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <a href="<?php echo e(route('assessor.app.physical.test', ['TestcategoryId' => $val1->TestCategoryID])); ?>"><span><?php echo e($val1->TestCategoryName); ?></span><span class="arrow-i"><i class="bi bi-arrow-right"></i></span></a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                        
                            </ul>
                             <br>
                             <h4 class="test-cat">Physical Fitness Assessment for Age 9-18 (Class 4-12)</h4>
                            <ul class="list-group mt-0">
                            
                            <?php $__currentLoopData = $seniorData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keys => $vals): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <?php if($vals->TestCategoryID == 3): ?> 
                                     <a href="<?php echo e(route('assessor.app.physical.senior.test', ['TestcategoryId' => $vals->TestCategoryID, 'SeniorBMI'=>True])); ?>"><span><?php echo e($vals->TestCategoryName); ?> </span><span class="arrow-i"><i class="bi bi-arrow-right"></i></span></a>
                                    <?php else: ?>
                                    <a href="<?php echo e(route('assessor.app.physical.test', ['TestcategoryId' => $vals->TestCategoryID])); ?>"><span><?php echo e($vals->TestCategoryName); ?> </span><span class="arrow-i"><i class="bi bi-arrow-right"></i></span></a>  
                                    <?php endif; ?>                                   

                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                        
                            </ul>
                            <?php if(Auth::user()->id == 995): ?>
                            <br>
                             <h4 class="test-cat">Adittional Fitness Assessment for Age 13-18 (Class 9-12)</h4>
                            <ul class="list-group mt-0">
                            
                            <?php $__currentLoopData = $cbseData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keys => $vals): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <?php if(in_array($vals->TestCategoryID, [2,6])): ?> 
                                     <a href="<?php echo e(route('assessor.app.physical.senior.test', ['TestcategoryId' => $vals->TestCategoryID, 'SeniorBMI'=>True])); ?>"><span><?php echo e($vals->TestCategoryName); ?> </span><span class="arrow-i"><i class="bi bi-arrow-right"></i></span></a>
                                    <?php else: ?>
                                    <a href="<?php echo e(route('assessor.app.physical.test', ['TestcategoryId' => $vals->TestCategoryID])); ?>"><span><?php echo e($vals->TestCategoryName); ?> </span><span class="arrow-i"><i class="bi bi-arrow-right"></i></span></a>  
                                    <?php endif; ?>                                   

                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                        
                            </ul>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
           
        </div>
    </div>

</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const termSelect = document.getElementById('term');
        let previousValue = termSelect.value;

        termSelect.addEventListener('change', function () {
            const selectedValue = this.value;
            const termText = termSelect.options[termSelect.selectedIndex].text;
            Swal.fire({
                icon: 'warning',
                title: 'Confirmation!',
                html: `Would you like to proceed with the test for <strong>${termText}</strog>?`,
                showCancelButton: true,
                allowOutsideClick: false,
                confirmButtonText: 'Yes, proceed.',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    saveTerm(selectedValue);
                    previousValue = selectedValue;

                    Swal.fire({
                        icon: 'success',
                        html: `You are going to take test for <strong>${termText}</strong>.`,
                        showConfirmButton: true,
                        allowOutsideClick: false,
                    });
                } else {
                    termSelect.value = previousValue;
                }
            });
        });

        function saveTerm(termId) {
            fetch("<?php echo e(route('save.term.session')); ?>", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>"
                },
                body: JSON.stringify({ term_id: termId })
            });
        }
    });


    document.addEventListener('DOMContentLoaded', function () {
        const buttons = document.querySelectorAll('[data-value]');
        const testStatusKey = "testStatus";

        // If no value is saved yet, default to "remaining" and store it
        let savedStatus = localStorage.getItem(testStatusKey);
        if (!savedStatus) {
            savedStatus = "remaining";
            localStorage.setItem(testStatusKey, savedStatus);
        }

        buttons.forEach(btn => {
            if (btn.dataset.value === savedStatus) {
                btn.classList.add('active');
            } else {
                btn.classList.remove('active');
            }
        });
        buttons.forEach(button => {
            button.addEventListener('click', function () {
                const selectedValue = this.dataset.value;
                localStorage.setItem(testStatusKey, selectedValue);

                buttons.forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');
            });
        });
    });
</script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.icsce-master-app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\nep\resources\views/assessor/alltests.blade.php ENDPATH**/ ?>