<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome-free/css/all.min.css') }}">
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<link rel="stylesheet" href="{{ asset('admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
 <!-- 
  <link rel="stylesheet" href="{{ asset('admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/plugins/jqvmap/jqvmap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/plugins/summernote/summernote-bs4.min.css') }}">
  -->
	<link rel="stylesheet" href="{{ asset('admin/dist/css/adminlte.min.css') }}">
	<link rel="stylesheet" href="{{ asset('admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
	<link rel="stylesheet" href="{{ asset('admin/plugins/daterangepicker/daterangepicker.css') }}">  
  
	<link rel="stylesheet" href="{{ asset('admin/plugins/custom/dashboard.css') }}">
	<link rel="stylesheet" href="{{ asset('resources/css/admin-style.css') }}"> 
	<link rel="stylesheet" href="{{ asset('admin/plugins/select2/css/select2.min.css') }}">
	<link rel="stylesheet" href="{{ asset('admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">  
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
	<script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>
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
  <link rel="stylesheet" href="{{ asset('admin/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/plugins/bs-stepper/css/bs-stepper.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/plugins/dropzone/min/dropzone.min.css') }}">  

  <!-- sweet alert  -->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
	<body class="hold-transition sidebar-mini layout-fixed">
		<div class="wrapper">
			@include('admin.layouts.header')    
			@include('admin.layouts.sidebar')  
			@yield('content')
			
			<footer class="main-footer" id="acfooter">
				<strong>Copyright &copy; <?=date('Y')?> </strong>All rights reserved.    
			</footer>  
			<aside class="control-sidebar control-sidebar-dark"> </aside>  
		</div>
		@include('admin.layouts.footer')
	</body>
</html>