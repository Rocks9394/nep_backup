


<style>
  body.error {
    background-color: #F1F4F8;
  }
</style>
<?php $__env->startSection('content'); ?>

<div class="error-div" >
  <div class="row align-items-center">
    <div class="col-12 col-md-12 col-lg-5 col-xl-5">
      <div class="ani-icon">
      <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script>
      <dotlottie-player src="https://lottie.host/8886fe59-5c16-4f11-8ffe-70feed548fd3/ap5GbiN34n.json" background="transparent" speed="1" loop autoplay></dotlottie-player>
    </div>
    </div>
    <div class="col-12 col-md-12 col-lg-7 col-xl-7">
      <h1>Front End... Almost there!</h1>
      <p>Looks like this page is out of bounds. <br>
        Head back to the home page and set your goal!</p>
	
         <a href="<?php echo e(route('pe-activities.index')); ?>" class="goback">Go to homepage</a>
     
    </div>
  </div>
</div>
 

<script>
  $('body').addClass('error');
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.filldart-app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/nep/resources/views/errors/404.blade.php ENDPATH**/ ?>