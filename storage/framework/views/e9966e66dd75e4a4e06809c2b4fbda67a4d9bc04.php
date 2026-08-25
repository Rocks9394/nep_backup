<header>
    <!--<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />-->
    <div class="container">
        <div class="row">
            <div class="col">
                <nav class="navbar navbar-expand-md">
                    
                    <a class="navbar-brand pt-1 pl-2 pb-1 pr-2 pr-xs-1" href="<?php echo e(route('index')); ?>"><img src="<?php echo e(asset('resources/images/goforfit-logo-w.svg')); ?>" alt="" title="" class="img-fluid goforfit-logo d-none d-md-none d-lg-block"> <img src="<?php echo e(asset('resources/images/goforfit-logo-i-w.svg')); ?>" class="img-fluid goforfit-logo logo-mob d-md-block d-lg-none d-sm-block" alt="" title=""></a>
                    <button class="navbar-toggler mob-menu" type="button" data-toggle="collapse" data-target="#navbarNav">
                        <span class="navbar-toggler-icon"><svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd">
                                <path d="M24 18v1h-24v-1h24zm0-6v1h-24v-1h24zm0-6v1h-24v-1h24z" fill="#ffffff" />
                                <path d="M24 19h-24v-1h24v1zm0-6h-24v-1h24v1zm0-6h-24v-1h24v1z" />
                            </svg></span>
                    </button>
                    <div class="user-cred order-md-12">
                        <ul class="navbar-nav">
                            <?php if(auth()->guard()->guest()): ?>

                            <li class="nav-item l_area mr-2">
                                <?php if(Route::has('login')): ?>
                                <a class="nav-link user-login" href="<?php echo e(route('login')); ?>"><?php echo e(__('Login')); ?></a>
                                <?php endif; ?>

                            </li>


                            <!-- <li class="nav-item l_area">
										
									</li> -->

                            <?php else: ?>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="<?php echo e(url('dashboard')); ?>" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <?php echo e(Auth::user()->name); ?>

                                </a>
                                <div class="dropdown-menu user-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="<?php echo e(url('editprofile')); ?>/<?php echo e(Auth::user()->id); ?>">
                                        <?php echo e(__('Edit Profile')); ?>

                                    </a>
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
                    <div class="navbar-collapse collapse order-md-1 mob-dropdown" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item <?php echo e((request()->is('sports')) ? 'active' : ''); ?>">
                                <a class="nav-link <?php echo e((request()->is('sports')) ? 'active' : ''); ?>" href="<?php echo e(route('sports')); ?>">Sports</a>
                            </li>
                            <li class="nav-item custom-nav-link dropdown <?php echo e((request()->is('academics')) ? 'active' : ''); ?>">
                                <a class="nav-link <?php echo e((request()->is('academics')) ? 'active' : ''); ?>" href="<?php echo e(route('academics')); ?>">Academic</a>
                            </li>

                            <li class="nav-item dropdown<?php echo e((request()->is('activities')) ? 'active' : ''); ?>">
                                <a class="nav-link dropdown-toggle <?php echo e((request()->is('activities')) ? 'active' : ''); ?>" href="<?php echo e(route('activities')); ?>" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Activities

                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="<?php echo e(route('addactivity')); ?>">Add Activity</a>
                                    <a class="dropdown-item" href="<?php echo e(route('myactivities')); ?>">My Activities</a>
                                    <a class="dropdown-item" href="<?php echo e(route('activities')); ?>">All Activities</a>
                                </div>

                            </li>

                            <li class="nav-item <?php echo e((request()->is('userstatus')) ? 'active' : ''); ?>">
                                <a class="nav-link <?php echo e((request()->is('userstatus')) ? 'active' : ''); ?>" href="<?php echo e(route('userstatus')); ?>">Activity Status</a>
                            </li>


                            <?php /*<li class="nav-item {{ (request()->is('fill-dart')) ? 'active' : '' }}">
                                <a class="nav-link {{ (request()->is('fill-dart')) ? 'active' : '' }}"
                                    href="{{ route('view.dart') }}">Fill Dart</a>
                              </li>*/ ?>

                        </ul>
                    </div>

                </nav>


            </div>
        </div>
    </div>
</header><?php /**PATH C:\xampp\htdocs\nep\resources\views/layouts/header.blade.php ENDPATH**/ ?>