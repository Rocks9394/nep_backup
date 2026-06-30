<form id="school_users_form" method="POST" action="<?php echo e(route('viewers.store')); ?>">
    <?php echo csrf_field(); ?>

    <h5 class="card-title text-center mb-2">Add Viewer</h5>                  

    <div class="form-row">      
        <div class="form-group col-md-6">
            <label for="trainerName">Fullname <span style="color: red; font-weight: bold;" >*</span></label>
            <input type="text" class="form-control <?php $__errorArgs = ['trainerName'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="trainerName" name="trainerName" value="<?php echo e(old('trainerName')); ?>" placeholder="Your name" required>
            <?php $__errorArgs = ['trainerName'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="invalid-feedback"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="form-group col-md-3">
            <label for="gender">Gender <span style="color: red; font-weight: bold;">*</span></label>
            <select id="gender" name="gender" class="form-control <?php $__errorArgs = ['gender'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                <option value="" disabled <?php echo e(old('gender') ? '' : 'selected'); ?>>Choose...</option>
                <option value="Male" <?php echo e(old('gender') == 'Male' ? 'selected' : ''); ?>>Male</option>
                <option value="Female" <?php echo e(old('gender') == 'Female' ? 'selected' : ''); ?>>Female</option>
                <option value="Transgender" <?php echo e(old('gender') == 'Transgender' ? 'selected' : ''); ?>>Transgender</option>
            </select>

            <?php $__errorArgs = ['gender'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="invalid-feedback"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>


        <div class="form-group col-md-3">
            <label for="designation">Designation <span style="color: red; font-weight: bold;">*</span></label>

            <select id="designation" name="designation" class="form-control <?php $__errorArgs = ['designation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                <option value="Viewer" <?php echo e(old('designation') == 'Viewer' ? 'selected' : ''); ?> selected>Viewer</option>
                <option value="Principal" <?php echo e(old('designation') == 'Principal' ? 'selected' : ''); ?>>Principal</option>
                <option value="HM" <?php echo e(old('designation') == 'HM' ? 'selected' : ''); ?>>HM</option>
            </select>

            <?php $__errorArgs = ['designation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="invalid-feedback"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

    </div>

    <!-- Qualification, Email, Mobile -->
    <div class="form-row">
        <div class="form-group col-md-3">
            <label for="qualification">Qualification <span style="color: red; font-weight: bold;" >*</span></label>
            <input type="text" class="form-control <?php $__errorArgs = ['qualification'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="qualification" id="qualification" placeholder="Type here" value="<?php echo e(old('qualification')); ?>" required>
            <?php $__errorArgs = ['qualification'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="invalid-feedback"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="form-group col-md-3">
            <label for="trainerEmail">Email <span style="color: red; font-weight: bold;" >*</span></label>
            <input type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="trainerEmail" name="email" placeholder="sc_bosh@gmail.com" value="<?php echo e(old('email')); ?>" required>
            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="invalid-feedback"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="form-group col-md-3">
            <label for="number">Mobile <span style="color: red; font-weight: bold;">*</span></label>
            <input 
                type="text" 
                class="form-control <?php $__errorArgs = ['mobile'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                id="number" 
                name="mobile" 
                placeholder="Enter 10 digits mobile number" 
                value="<?php echo e(old('mobile')); ?>" 
                pattern="\d{10}" 
                maxlength="10" 
                required
            >
            <?php $__errorArgs = ['mobile'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="invalid-feedback"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>


        <div class="form-group col-md-3">
            <label for="dob">DOB <span style="color: red; font-weight: bold;" >*</span></label>
            <input type="date" name="dob" id="dob" class="form-control <?php $__errorArgs = ['dob'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                value="<?php echo e(old('dob')); ?>" 
                max="<?php echo e(date('Y-m-d', strtotime('-18 years'))); ?>" 
                required>
            <?php $__errorArgs = ['dob'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="invalid-feedback"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

    </div>

    <!-- Module Access -->
    <div class="form-row">
        <div class="col-12">
            <h5 class="mb-3">Assign Module Access <span style="color: red; font-weight: bold;">*</span></h5>          
            <div class="row">
                <?php $__currentLoopData = $DashboardModule; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-sm-6 col-md-4 mb-2">
                        <div class="form-check">
                            <input class="form-check-input" 
                            type="checkbox" 
                            name="module_access[]" 
                            id="roleId_<?php echo e($label->role_id); ?>-<?php echo e($key); ?>"
                            value="<?php echo e($label->route_name); ?>" 
                            <?php echo e((is_array(old('module_access')) && in_array($label->route_name, old('module_access'))) ? 'checked' : ''); ?> >
                            <label class="form-check-label" for="roleId_<?php echo e($label->role_id); ?>-<?php echo e($key); ?>"> &nbsp <?php echo e($label->name); ?> </label>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <?php $__errorArgs = ['module_access'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="text-danger mt-2"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>                                      
        </div>
    </div>

    <!-- Submit -->
    <div class="d-flex justify-content-end mt-4">
        <button type="submit" class="btn btn-primary"><span>Submit</span></button>
    </div>
</form>

<script>
    $(document).ready(function() {
        $('#school_users_form').on('submit', function(e) {
            e.preventDefault();

            let form = $(this);
            let formData = new FormData(this);
            let checkedModules = $('input[name="module_access[]"]:checked');
            let viewerName = $('input[name="trainerName"]').val();
            let qualification = $('input[name="qualification"]').val();
            
            console.log("name :", viewerName);
            const validChar = /^[a-zA-Z][a-zA-Z\s.'-]*$/u;

            if (!validChar.test(viewerName)) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Invalid Name',
                    text: 'Please enter a valid name (letters, spaces, dots, apostrophes, and hyphens only).',
                    allowOutsideClick: false,
                    confirmButtonText: 'OK'
                });
                return;
            }
            if (!validChar.test(qualification)) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Invalid Qualification',
                    text: 'Please enter a valid qualification (letters, spaces, dots, apostrophes, and hyphens only).',
                    allowOutsideClick: false,
                    confirmButtonText: 'OK'
                });
                return;
            }

            if (checkedModules.length === 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'No Module Selected',
                    text: 'Please select at least one module access before submitting.',
                    confirmButtonText: 'OK'
                });

                return;
            }

            $.ajax({
                url: form.attr('action'),
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    Swal.fire({
                        title: 'Processing...',
                        text: 'Please wait while we save the viewer details.',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                },
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: response.message || 'Viewer added successfully!',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        // Optionally reset or reload page
                        form.trigger('reset');
                        location.reload();
                    });
                },
                error: function(xhr) {
                    Swal.close();

                    let msg = 'Something went wrong! Please try again.';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        let errors = xhr.responseJSON.errors;
                        let errorMessages = Object.values(errors).map(e => e[0]).join('<br>');
                        msg = errorMessages;
                    } else if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        let errorMessages = Object.values(errors).map(e => e[0]).join('<br>');
                        msg = errorMessages;
                    }

                    Swal.fire({
                        icon: 'error',
                        title: 'Failed!',
                        html: msg,
                        confirmButtonText: 'OK'
                    });
                }
            });
        });
    });

</script>
<?php /**PATH C:\xampp\htdocs\nep\resources\views/auth/self_registration/add-school-user.blade.php ENDPATH**/ ?>