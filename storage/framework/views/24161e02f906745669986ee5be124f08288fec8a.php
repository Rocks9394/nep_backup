<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title'); ?></title>
    
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<link rel="stylesheet" href="<?php echo e(asset('admin/plugins/fontawesome-free/css/all.min.css')); ?>">
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<link rel="stylesheet" href="<?php echo e(asset('admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')); ?>">
 <!-- 
  <link rel="stylesheet" href="<?php echo e(asset('admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('admin/plugins/jqvmap/jqvmap.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('admin/plugins/summernote/summernote-bs4.min.css')); ?>">
  -->
	<link rel="stylesheet" href="<?php echo e(asset('admin/dist/css/adminlte.min.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset('admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset('admin/plugins/daterangepicker/daterangepicker.css')); ?>">  
  
	<link rel="stylesheet" href="<?php echo e(asset('admin/plugins/custom/dashboard.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset('resources/css/admin-style.css')); ?>"> 
	<link rel="stylesheet" href="<?php echo e(asset('admin/plugins/select2/css/select2.min.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset('admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')); ?>">  
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
	<script src="<?php echo e(asset('admin/plugins/jquery/jquery.min.js')); ?>"></script>
	<link rel="pr econnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&amp;display=swap" rel="stylesheet">
	<script src="https://cdn.ckeditor.com/ckeditor5/23.0.0/classic/ckeditor.js"></script>
<!--
	<script src="https://cdn.tiny.cloud/1/f97hs3loi97ed70jpgkpnwraly9sb3nlec6qsb0f0obzecp7/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
	<script type="text/javascript">tinymce.init({selector: '.mytextarea'}); </script>
	<script src="https://cdn.ckeditor.com/ckeditor5/23.0.0/classic/ckeditor.js"></script>
	<link rel="stylesheet" href="https://adminlte.io/themes/v3/dist/css/adminlte.min.css">
	<link rel="stylesheet" href="https://adminlte.io/themes/v3/plugins/select2/css/select2.min.css">
	<link rel="stylesheet" href="https://adminlte.io/themes/v3/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
	-->
 
  <!--Nagendra Kumar-->  
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="<?php echo e(asset('admin/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('admin/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('admin/plugins/bs-stepper/css/bs-stepper.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('admin/plugins/dropzone/min/dropzone.min.css')); ?>">  

  <!-- sweet alert  -->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
	<body class="hold-transition sidebar-mini layout-fixed">
		<div class="wrapper">
			<?php echo $__env->make('admin.layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>    
			<?php echo $__env->make('admin.layouts.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>  
			<?php echo $__env->yieldContent('content'); ?>
			
			<footer class="main-footer" id="acfooter">
				<strong>Copyright &copy; <?=date('Y')?> </strong>All rights reserved.    
			</footer>  
			<aside class="control-sidebar control-sidebar-dark"> </aside>  
		</div>
		<?php echo $__env->make('admin.layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	</body>
</html><?php /**PATH C:\xampp\htdocs\nep\resources\views/admin/layouts/app.blade.php ENDPATH**/ ?>