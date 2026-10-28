

<style>
  body.error {
    background-color: #F1F4F8;
  }
</style>
<?php $__env->startSection('content'); ?>


		<?php 
		if(!empty(Auth::User()->role_id))
		{
			 $data = Auth::User();
			if($data->role_id == 3 || $data->role_id == 4)
				$redirectUrl =  'filldart.dashboard';

		}elseif(!empty(Auth::guard('sstudent')->user()))
		{    
			$redirectUrl = 'student.dashboard';
		}else
		{
			$redirectUrl = 'login';
		}
		?>

<div class="error-div">
  <div class="row align-items-center">
    <div class="col-12 col-md-12 col-lg-5 col-xl-5">

      <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script> 

        <dotlottie-player src="https://lottie.host/5fae6665-ef4f-4cfb-b8b2-0334f49504ba/IqlN5UW58R.json" background="transparent" speed="1" loop autoplay></dotlottie-player>

    </div>
    <div class="col-12 col-md-12 col-lg-7 col-xl-7">

      <h1>Server Side...Almost there!</h1>
      <p>Looks like this page is out of bounds. <br>
        Head back to the home page and set your goal!</p>
            <a href="<?php echo e(route($redirectUrl)); ?>" class="goback">Go to homepage</a>
    </div>
	

	
	

  </div>


</div>

<script>
  $('body').addClass('error');
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.filldart-app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/nep/resources/views/errors/500.blade.php ENDPATH**/ ?>