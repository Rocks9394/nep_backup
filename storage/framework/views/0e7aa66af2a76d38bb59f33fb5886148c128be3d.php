<?php $__env->startSection('title', 'Goforfit | ' . $title); ?>

<?php $__env->startSection('content'); ?>

<!-- <link href="<?php echo e(asset('assets/css/login.css')); ?>?v=<?php echo e(time()); ?>" rel="stylesheet">
<link href="<?php echo e(asset('assets/css/nvsdashboard.min.css')); ?>?v=<?php echo e(time()); ?>" rel="stylesheet" media="screen">        
<link href="<?php echo e(asset('assets/css/nvsstyle.css')); ?>?v=<?php echo e(time()); ?>" rel="stylesheet" media="all">
<link href="<?php echo e(asset('assets/css/nvscustom-style.css')); ?>?v=<?php echo e(time()); ?>" rel="stylesheet">
<link href="<?php echo e(asset('assets/css/nvsresponsive.css')); ?>?v=<?php echo e(time()); ?>" rel="stylesheet" media="screen"> -->

<?php $__env->startPush('styles'); ?>
<style>
   .captcha>input[type=checkbox] {
    top: 27px;
    left: 49px;
}
body{
    margin:0;
    font-family: 'Poppins', sans-serif;
}

.login-page{

    position:relative;

    min-height:100vh;

    background:url('/resources/images/bg-img.png');

    background-size:cover;

    background-position:center;

    background-repeat:no-repeat;

    overflow:hidden;
}

.overlay{

    position:absolute;

    width:100%;

    height:100%;

    background:rgba(0,0,0,.45);

}

.login_form{

    position:relative;

    z-index:5;

    background:rgba(255,255,255,.92);

    backdrop-filter:blur(10px);

    border-radius:20px;

    padding:40px;

    box-shadow:0 20px 60px rgba(0,0,0,.25);

}

.logo{

    display:block;

    text-align:center;

    margin-bottom:25px;

}

.logo img{

    height:65px;

}

.input_box{

    margin-bottom:18px;

}

.input_box label{

    font-weight:600;

    color:#444;

}

.form-control{

    border-radius:10px;

    height:48px;

}

.btn-primary{

    background:#ff8500;

    border:none;

    height:50px;

    border-radius:10px;

    font-weight:600;

    font-size:17px;

}

.btn-primary:hover{

    background:#ef7a00;

}

.form-check{

    margin-top:15px;

}

.captcha{

    margin:20px 0;

}

@media(max-width:768px){

.login-page{

    background-position:left;

}

.login_form{

    padding:25px;

    margin:20px;

}

}
</style>
<?php $__env->stopPush(); ?>


<main class="login-page">

    <div class="overlay"></div>

    <div class="container h-100">

        <div class="row h-100 align-items-center justify-content-center">

            <div class="col-lg-5 col-md-7">

                <div class="login_form">

                    <a href="<?php echo e(url('/')); ?>" class="logo">
                        <img src="<?php echo e(asset('resources/images/gofor-fit-logo.png')); ?>"
                             alt="goforfit">
                    </a>

                     <?php
                        $user_type                = Cookie::get('user_type');
                        $student_id_cookie        = Cookie::get('student_id_cookie') ?? old('student_id');
                        $student_password_cookie  = Cookie::get('student_password_cookie');  
                        $decodedPwd = base64_decode(base64_decode($student_password_cookie));
                        $plainPassword = substr($decodedPwd, 1, -1);
                        $student_remember_token   = Cookie::get('student_remember_token') ?? old('remember');  
                     ?>
                  
                     <!--<strong style="color:orange">The system will be unavailable on 12th August 2025 from 2:00 PM to 5:00 PM due to scheduled maintenance.</strong>-->

                     <form method="POST" action="<?php echo e(route('auth.login.new')); ?>">
                        <?php echo csrf_field(); ?>

                        <div class="input-group">
                           <div class="input-group-prepend">
                              <label class="input-group-text">Login As</label>
                              <input type="hidden" name="login_by" class="option_type" value="">
                           </div>
                           <select class="custom-select form-control" id="login_type">
                              <option selected>Choose User Type</option>
                              <option value="School">School</option>
                              <option value="Trainer">Trainer</option>
                              <option value="Parent">Parent</option>
                           </select>
                        </div>

                        <!-- Parent Login Fields -->
                        <div id="user_id_box" style="display: none;">
                           <div class="input_box mt-3">
                              <label for="userid_input">User Id</label>
                              <input type="text" id="userid_input" name="student_id" placeholder="Enter User Id" class="form-control" value="<?php echo e($student_id_cookie); ?>" />
                              <?php $__errorArgs = ['student_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="invalid-feedback" role="alert"><strong><?php echo e($message); ?></strong></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                           </div>

                           <div class="input_box">
                              <label for="dob_input">Password</label>
                              <input type="password" id="dob_input" name="dob" class="form-control <?php $__errorArgs = ['dob'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e($plainPassword); ?>" placeholder="Enter your password" />
                              <?php $__errorArgs = ['dob'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="invalid-feedback" role="alert"><strong><?php echo e($message); ?></strong></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                           </div>
                        </div>

                        <!-- Email Login Fields (Other Users) -->
                        <div id="email_box">
                           <div class="input_box mt-3">
                              <label for="email_input">Email</label>
                              <input type="email" id="email_input" name="email" placeholder="Enter Email" class="form-control" value="<?php echo e(old('email')); ?>" />
                              <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="invalid-feedback" role="alert"><strong><?php echo e($message); ?></strong></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                           </div>

                           <div class="input_box">
                              <label for="password_input">Password</label>
                              <input type="password" id="password_input" name="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Enter your password" value="<?php echo e(old('password')); ?>" />
                              <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="invalid-feedback" role="alert"><strong><?php echo e($message); ?></strong></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                           </div>
                        </div>

                        <div class="mb-4 form-check">
                           <input type="checkbox" class="form-check-input" id="remember" name="remember" <?php echo e($student_remember_token ? 'checked' : ''); ?>>
                           <label class="form-check-label" for="remember">Remember Me</label>
                        </div>
                     
                     

                        <div class="captcha-row">
                           <div id="pagecaptcha-cont">
                              <div class="captcha">
                                 <input type="checkbox" aria-label="Checkbox captcha" name="g-recaptcha-response">
                                 <img alt="captcha" src="<?php echo e(asset('assets/imgs/captcha-img.png')); ?>" class="img-fluid" usemap="#image-map">
                                 <map name="image-map">
                                    <area target="_blank" alt="Privacy" title="Privacy" href="https://policies.google.com/privacy?hl=en" coords="" shape="rect" class="m-p">
                                    <area target="_blank" alt="Terms" title="Terms" href="https://policies.google.com/terms?hl=en" coords="" shape="rect" class="m-t">
                                 </map>
                              </div>
                           </div>
                           <?php if($errors->any()): ?>
                              <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                 <p class="error_message"><?php echo e($error); ?></p>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                           <?php endif; ?>

                           <?php if(session('status') === 'error'): ?>
                              <p class="error_message">
                                 <?php echo e(session('msg')); ?>

                              </p>
                           <?php endif; ?>
                        </div> 

                        <button class="btn btn-lg btn-primary btn-block mb-0" type="submit" style="font-weight: 600;"><?php echo e(__('Login')); ?></button>
                     </form>

                </div>

            </div>

        </div>

    </div>

</main>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

   <script>
      $(document).ready(function () {
         function toggleLoginFields(userType) {

            $('#userid_input').val('');
            $('#birth_date').val('');
            $('#email_input').val('');
            $('#password_input').val('');


            if (userType === 'Parent') {
               $('#user_id_box').show();
               $('#userid_input').prop('required', true).prop('disabled', false);
               $('#birth_date').prop('required', true).prop('disabled', false);

               // Hide email login
               $('#email_box').hide();
               $('#email_input').prop('required', false).prop('disabled', true);
               $('#password').prop('required', false).prop('disabled', true);
            } else {
               // Show email login
               $('#email_box').show();
               $('#email_input').prop('required', true).prop('disabled', false);
               $('#password').prop('required', true).prop('disabled', false);

               // Hide parent login
               $('#user_id_box').hide();
               $('#userid_input').prop('required', false).prop('disabled', true);
               $('#birth_date').prop('required', false).prop('disabled', true);
            }

         }

         const savedOption = localStorage.getItem('selectedOption') || 'School';
         

         $('.option_type').val(savedOption);
         $('#login_type').val(savedOption);


         toggleLoginFields(savedOption);

         $('#login_type').on('change', function () {
            const selected = $(this).val();
            $('.option_type').val(selected);
            localStorage.setItem('selectedOption', selected);
            toggleLoginFields(selected);
         });
      });

   </script>
<?php echo $__env->make('layouts.filldart-login-app-header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\nep\resources\views/auth/backup-login.blade.php ENDPATH**/ ?>