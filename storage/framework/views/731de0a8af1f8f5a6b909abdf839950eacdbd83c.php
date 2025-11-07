<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="twitter:card" value="summary">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta name="msapplication-TileImage" content="<?php echo e(asset('resources/images/edutok-fav.ico')); ?>" />
    <title><?php echo $__env->yieldContent('title'); ?></title>
    <link rel="icon" href="#" sizes="32x32" />
    
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
    
    <link rel="stylesheet" href="<?php echo e(asset('public/assets/css/bootstrap/bootstrap.min.css')); ?>" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link href="<?php echo e(asset('resources/css/style.css')); ?>" rel="stylesheet" media="all">
    <link rel="stylesheet" href="<?php echo e(asset('resources/css/custom-style.css')); ?>">

    <link href="<?php echo e(asset('resources/css/print.css')); ?>" rel="stylesheet" media="print">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <script src="<?php echo e(asset('resources/js/jquery.min.js')); ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script> 
    <style>
        #top-admin-nav {
            padding: 0px 10px;
        }

        #top-admin-nav .nav-link,
        #top-admin-nav .navbar-nav .nav-link:hover {
            text-transform: uppercase;
            font-weight: 200;
            font-size: 10px;
        }
        .avtar>a {
            display: flex;
            justify-content: center;
            align-items: center;
            color: #333 !important;
            gap: 10px;
        }

    </style>
     
    <link rel="stylesheet" href="<?php echo e(asset('public/assets/css/customstyle.css')); ?>" type="text/css"> 
    <link rel="stylesheet" href="<?php echo e(asset('public/assets/css/take-test-root.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('public/assets/css/take-test-style.css')); ?>">
    <link href="<?php echo e(asset('resources/css/responsive.css')); ?>" rel="stylesheet" media="screen">

</head>

<body oncopy="return false" oncut="return false" class="<?php echo e(last(request()->segments())); ?>  common-inner-cls" >

<nav class="navbar navbar-light top_nav_bar px-0">
    <div class="container d-flex justify-content-between w-100">
        <div class="ml-5 ml-sm-0">
            <?php
            $GetSchoolLogo = Helper::GetSchoolLogo();
            ?>
            
                <?php if(!empty($GetSchoolLogo->logo)): ?>
                    <img src="<?php echo e(asset('public/assets/uploads/logos/'.$GetSchoolLogo->logo)); ?>" style="height:42px; padding:0;">
                <?php endif; ?>    
        
        </div>

        <?php if(auth()->guard('web')->check()): ?>
            <a class="navbar-brand logo d-md-block d-none" href="<?php echo e(route('filldart.dashboard')); ?>">
                <img src="<?php echo e(asset('resources/images/gofor-fit-logo.png')); ?>" class="d-inline-block align-top" alt="goforfit - web" style="height:32px;">
            </a>
        <?php elseif(auth()->guard('sstudent')->check()): ?>
            <a class="navbar-brand logo d-md-block d-none" href="<?php echo e(route('student.dashboard')); ?>">
                <img src="<?php echo e(asset('resources/images/gofor-fit-logo.png')); ?>" class="d-inline-block align-top" alt="goforfit - student" style="height:32px;">
            </a>
        <?php endif; ?>

        <div class="btn-group">
            <div class="user-cred order-md-12">
                <ul class="navbar-nav">

                    


                    <?php if(auth()->guard('web')->guest() && auth()->guard('sstudent')->guest()): ?>
                        <li class="nav-item l_area mr-2">
                            <a class="nav-link user-login" href="<?php echo e(route('login')); ?>"><?php echo e(__('Login')); ?></a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item dropdown avtar">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="<?php echo e(route('filldart.dashboard')); ?>" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <img src="<?php echo e(asset('resources/images/avtar.png')); ?>" class="d-inline-block align-top" height="32" alt="avtar">
                                <?php if(auth()->guard('web')->check()): ?>
                                    <span class="d-md-block d-none">
                                <?php echo e(Auth::user()->name); ?>

                    </span>
                                <?php elseif(auth()->guard('sstudent')->check()): ?>
                    <span class="d-md-block d-none">
                                <?php echo e(Auth::guard('sstudent')->user()->student_name); ?>

                    </span>

                                <?php endif; ?>
                            </a>
                            <div class="dropdown-menu user-menu" aria-labelledby="navbarDropdown">
                                <?php if(auth()->guard('web')->check()): ?>
                                    <a class="dropdown-item" href="<?php echo e(url('editprofile/' . Auth::user()->id)); ?>">
                                        <?php echo e(__('Edit Profile')); ?>

                                    </a>
                                <?php elseif(auth()->guard('sstudent')->check()): ?>
                                    <a class="dropdown-item" href="#">
                                        <?php echo e(__('Edit Profile')); ?>

                                    </a>
                                <?php endif; ?>
                                <a class="dropdown-item last_child" href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <?php echo e(__('Logout')); ?>

                                </a>
                                <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                                    <?php echo csrf_field(); ?>
                                </form>
                            </div>
                        </li>
                    <?php endif; ?>


                </ul>
            </div>
        </div>

        </div>
    </nav>


    <!-- Header -->
   
    <!-- Header end -->
    <!-- Content section -->
    <?php echo $__env->yieldContent('content'); ?>
    <!-- Content section end-->
    <!-- Footer -->

<?php echo $__env->make('layouts.icsce-master-footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>

</html><?php /**PATH /var/www/nep/resources/views/layouts/icsce-master-app.blade.php ENDPATH**/ ?>