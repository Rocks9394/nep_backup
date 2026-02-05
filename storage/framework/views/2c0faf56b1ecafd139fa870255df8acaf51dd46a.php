
<?php $__env->startSection('title', 'Goforfit | ' . $title); ?>
<?php $__env->startSection('content'); ?>

<style>
    td.dt-type-numeric {
        text-align: center;
        text-align: left !important;
    }
</style>
<div class="container">
    <div class="t-mrg2">
        <div class=" all-chaptr-cards">
            <!-- Success message -->

            <?php if($errors->any()): ?>
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="text-danger"><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
            <?php endif; ?>


            <?php if($errors->any()): ?>
            <script>
                Swal.fire('Oops!', 'There were some validation errors.', 'error');
            </script>
            <?php endif; ?>


            <?php
            $edit = request()->query('edit');
            ?>

            <?php if($edit === 'error'): ?>
            <div class="editMessage alert alert-danger">
                data not match in our records!
            </div>
            <script>
                Swal.fire('Oops!', 'data not match in our records!', 'error');
            </script>
            <?php endif; ?>

            <?php if($edit === 'success'): ?>
            <div class="editMessage alert alert-success">
                Data midify successfully!
            </div>
            <?php endif; ?>

            <?php if($edit === 'success-delete'): ?>
            <div class="editMessage alert alert-success">
                Data removed successfully!
            </div>
            <?php endif; ?>


            <script>
                // Remove all elements with class "editMessage" after 5 seconds
                setTimeout(function() {
                    document.querySelectorAll('.editMessage').forEach(function(message) {
                        message.remove(); // or use message.style.display = 'none';
                    });
                }, 5000); // 5 minutes = 300000 ms


                // Remove `?edit=...` from the URL after 5 seconds
                setTimeout(function() {
                    if (window.history.replaceState) {
                        const cleanUrl = window.location.origin + window.location.pathname;
                        window.history.replaceState(null, null, cleanUrl);
                    }
                }, 5000); // 5 seconds = 5000 ms
            </script>

            <form method="POST" name="view-trainer-report" id="modifytrainerform" action="<?php echo e(route('modify.trainer.record.submit')); ?>">
                <?php echo csrf_field(); ?>
                <div class="row">
                    <div class="col">
                        <div class="heading-rw mt-0 mt-md-1 mb-0 p-0">
                            <a href="<?php echo e(route('filldart.dashboard')); ?>" class="back-button">
                                <span class="arrow">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5" />
                                    </svg>
                                </span>
                            </a>
                        
                            <h1 class="mt-2 mt-md-0 ml-md-4 mb-0"><?php echo e($title); ?></h1>
                        </div>
                    </div>
                    <div class="col-auto">
                         <div class="btn-group btn-group-toggle py-0" data-toggle="buttons" id="chksubmit_button">
                            <label class="btn btn-secondary active">
                                <input type="radio" name="options_bytype" value="edit" checked> Edit
                            </label>
                            <label class="btn btn-secondary">
                                <input type="radio" name="options_bytype" value="delete"> Delete
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div id="activity_from_div" class="from__bx sports-filtr overlay">
                            <div class="form-row">
                                <div class="col-12">
                                    <div class="form-row">
                                        <div class="col-12 col-md-12">
                                            <input type="hidden" name="type_functionality" value="">
                                            <div class="row form-row">
                                                <div class="col-12 col-lg-10 col-xl">

                                                    <div id="form-fields-edit" class="row form-row">

                                                        <div class="col-6 col-md-6 col-lg-2 col-xl mb-3" id="from-date">
                                                            <label for="fromdateedit">From Date</label><br>
                                                            <input type="date" class="form-control mx-0 w-100" id="date_edit" name="date_edit" required>
                                                            <?php $__errorArgs = ['date_edit'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-danger"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                        </div>


                                                        <div class="col-6 col-md-6 col-lg-2 col-xl mb-3" id="to-date">
                                                            <label for="todateedit">To Date</label><br>
                                                            <input type="date" class="form-control mx-0 w-100" id="date_edit_to" name="date_edit_to" required>
                                                            <?php $__errorArgs = ['date_edit_to'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-danger"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                        </div>


                                                        <div class="col-6 col-md-6 col-lg col-xl mb-3" id="last-date">
                                                            <label for="sports">From Period</label><br>
                                                            <select class="form-control mx-0 w-100" name="from_period" id="from_period" required>
                                                                <option value="">Period</option>
                                                                <option value="1">1</option>
                                                                <option value="2">2</option>
                                                                <option value="3">3</option>
                                                                <option value="4">4</option>
                                                                <option value="5">5</option>
                                                                <option value="6">6</option>
                                                                <option value="7">7</option>
                                                                <option value="8">8</option>
                                                                <option value="9">9</option>
                                                                <option value="10">10</option>
                                                                <option value="11">11</option>
                                                            </select>
                                                            <?php $__errorArgs = ['from_period'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-danger"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                        </div>

                                                        <div class="col-6 col-md-6 col-lg col-xl mb-3" id="last-date">
                                                            <label for="sports">To Period</label><br>
                                                            <select class="form-control mx-0 w-100" name="to_period" id="to_period" required>
                                                                <option value="">Period</option>
                                                                <option value="1">1</option>
                                                                <option value="2">2</option>
                                                                <option value="3">3</option>
                                                                <option value="4">4</option>
                                                                <option value="5">5</option>
                                                                <option value="6">6</option>
                                                                <option value="7">7</option>
                                                                <option value="8">8</option>
                                                                <option value="9">9</option>
                                                                <option value="10">10</option>
                                                                <option value="11">11</option>
                                                            </select>
                                                            <?php $__errorArgs = ['to_period'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-danger"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                        </div>


                                                        <div class="col-12 col-md-12 col-lg-3 col-xl mb-4" id="by-class">
                                                            <label for="Period">Class</label><br>
                                                            <select class="form-control mx-0 w-100" name="class_edit" id="class_edit" required>

                                                                <option value="">All Class</option>
                                                                <?php $__currentLoopData = $classList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option value="<?php echo e($class->class_id); ?>-<?php echo e($class->id); ?>"><?php echo e($class->name); ?>-<?php echo e($class->section); ?> </option>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                            </select>
                                                            <?php $__errorArgs = ['class_edit'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-danger"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                        </div>

                                                    </div>

                                                    <!-- Delete -->

                                                    <div id="form-fields-delete" class="row form-row" style="display:none">

                                                        <div class="col-12 col-sm-4 col-lg mb-3" id="from-date">
                                                            <label for="skillarea">Date</label><br>
                                                            <input type="date" class="form-control mx-0 w-100" value="" id="date_delete" name="date_delete" required>
                                                            <?php $__errorArgs = ['date_delete'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-danger"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                        </div>

                                                        <div class="col-6 col-sm-4 col-lg mb-3" id="by-class">
                                                            <label for="Period">Class</label><br>
                                                            <select class="form-control mx-0 w-100" name="class_delete" id="class_delete_id" required>


                                                                <option value="">All Class</option>
                                                                <?php $__currentLoopData = $classList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option value="<?php echo e($class->class_id); ?>-<?php echo e($class->id); ?>"><?php echo e($class->name); ?>-<?php echo e($class->section); ?> </option>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                            </select>
                                                            <?php $__errorArgs = ['class_delete'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-danger"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                        </div>

                                                        <div class="col-6 col-sm-4 col-lg mb-3" id="">
                                                            <label for="sports">Period</label><br>
                                                            <select class="form-control mx-0 w-100" name="period_delete" id="period_delete" required>
                                                                <option value="">Period</option>
                                                                <option value="1">1</option>
                                                                <option value="2">2</option>
                                                                <option value="3">3</option>
                                                                <option value="4">4</option>
                                                                <option value="5">5</option>
                                                                <option value="6">6</option>
                                                                <option value="7">7</option>
                                                                <option value="8">8</option>
                                                                <option value="9">9</option>
                                                                <option value="10">10</option>
                                                                <option value="11">11</option>
                                                            </select>
                                                            <?php $__errorArgs = ['period_delete'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-danger"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                        </div>

                                                    </div>

                                                </div>

                                                <div class="col-12 col-lg-2 col-xl-auto">

                                                    <button type="submit" id="modify-record"
                                                        class="btn btn-primary d-block w-100 submit_btn" style="min-width: auto;"><i class="fa fa-filter" aria-hidden="true"></i> Submit
                                                    </button>
                                                    <!-- <a  class="btn btn-primary mt-1" href="">Reset</a>  -->

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!---->
            </form>


        </div>


    </div>
</div>


<!-- loader -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>
    $(document).ready(function() {
        $('input[name="type_functionality"]').val('edit');
        $('input[name="date_delete"], select[name="class_delete"], select[name="period_delete"]').prop('disabled', true);
        $('input[name="options_bytype"]').on('change', function() {
            let selectedValue = $(this).val();
            $('input[name="type_functionality"]').val(selectedValue);
            console.log("Selected option:", selectedValue);

            // Optional: Do something based on the value
            if (selectedValue === 'edit') {
                $('#form-fields-edit').show();
                $('#form-fields-delete').hide();

                $('input[name="date_edit"], input[name="date_edit_to"], select[name="from_period"], select[name="to_period"], select[name="class_edit"] ').prop('disabled', false);
                $('input[name="date_delete"], select[name="class_delete"], select[name="period_delete"]').prop('disabled', true);



            } else if (selectedValue === 'delete') {
                $('#form-fields-edit').hide();
                $('#form-fields-delete').show();

                $('input[name="date_edit"], input[name="date_edit_to"], select[name="from_period"], select[name="to_period"], select[name="class_edit"] ').prop('disabled', true);
                $('input[name="date_delete"], select[name="class_delete"], select[name="period_delete"]').prop('disabled', false);


            }
        });


    });


    $(document).ready(function() {

        const today = new Date(); // 12 May
        const startDate = new Date(today);
        startDate.setDate(today.getDate() - 45); // 6 May (start of 7-day window)

        const formatDate = (date) => date.toISOString().split('T')[0];

        const fromDateStr = formatDate(startDate); // 2025-05-06
        const toDateStr = formatDate(today); // 2025-05-12

        // Set input default to start date (optional)



        $('#date_edit, #date_edit_to, #date_delete').val(toDateStr);
        $('#date_edit, #date_edit_to, #date_delete').attr('min', fromDateStr);
        $('#date_edit, #date_edit_to, #date_delete').attr('max', toDateStr);


        // Filtering logic
        $('.data-row').each(function() {
            const rowDate = $(this).data('date');

            // Show only if date is within the exact 7-day window
            if (rowDate >= fromDateStr && rowDate <= toDateStr) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });

    });




    $(document).ready(function() {
        $('#modifytrainerform').on('submit', function(e) {
            e.preventDefault(); // Stop form from submitting immediately

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, submit it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit(); // Submit the form if confirmed
                } else {
                    Swal.fire(
                        'Cancelled',
                        'Your form was not submitted. 😊',
                        'info'
                    )
                }
            });
        });
    });
</script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.filldart-app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\nep\resources\views/viewtrainer/modify-trainer-record.blade.php ENDPATH**/ ?>