<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="twitter:card" value="summary">    
   <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="msapplication-TileImage" content="{{ asset('resources/images/edutok-fav.ico')}}"/>
    <title>@yield('title')</title>
    <link rel="icon" href="{{ asset('resources/images/edutok-fav.ico') }}" sizes="32x32"/>
    <link rel="icon" href="{{ asset('resources/images/edutok-fav.ico') }}" sizes="192x192"/>
    <link rel="apple-touch-icon-precomposed" href="{{ asset('resources/images/edutok-fav.ico') }}"/>   
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">  
    
 
    <link rel="stylesheet" href="{{ asset('resources/css/dashboard.min.css') }}" media="screen">   
    <link href="{{ asset('resources/css/style.css') }}" rel="stylesheet" media="all">   
    <link href="{{ asset('resources/css/responsive.css') }}" rel="stylesheet" media="screen"> 
    <link href="{{ asset('resources/css/print.css') }}" rel="stylesheet" media="print">
    <link href="{{ asset('resources/css/custom-style.css') }}" rel="stylesheet">
	  <script src="{{ asset('resources/js/jquery.min.js') }}"></script>
	
	
	  <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.4/summernote.css" rel="stylesheet">
	  <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.4/summernote.js"></script>
    @stack('styles')
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">


    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
        
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script> 
		
        
		<style>
			#top-admin-nav{
				padding: 0px 10px;	
			}
			#top-admin-nav .nav-link, #top-admin-nav .navbar-nav .nav-link:hover {
				text-transform: uppercase;
				font-weight: 200;
				font-size: 10px;
			}
		</style>
		
		<script>
		function disableSelect(event) {
			event.preventDefault();
		}

		function startDrag(event) {
			window.addEventListener('mouseup', onDragEnd);
			window.addEventListener('selectstart', disableSelect);
			// ... my other code
		}

		function onDragEnd() {
			window.removeEventListener('mouseup', onDragEnd);
			window.removeEventListener('selectstart', disableSelect);
			// ... my other code
		}
	
	window.addEventListener('selectstart', function(e){ e.preventDefault(); });
	</script>
</head>
<body oncopy="return false" oncut="return false" class="login">

    <!-- Header end -->   
    <!-- Content section -->
        @yield('content') 
    <!-- Content section end-->          
    <!-- Footer -->
         @include('layouts.footer')
    <!-- Optional JavaScript -->    
    <!-- Footer end-->    
</body>
</html>