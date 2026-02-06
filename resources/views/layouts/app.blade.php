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
    <!--<link rel="stylesheet" href="{{ asset('resources/css/bootstrap.min.css') }}" media="screen"> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">  
    
    <!--<link rel="stylesheet" href="{{ asset('resources/css/font-awesome.css') }}" media="screen">--> 
    <link rel="stylesheet" href="{{ asset('resources/css/dashboard.min.css') }}" media="screen">   
    <link href="{{ asset('resources/css/style.css') }}" rel="stylesheet" media="all">   
    <link href="{{ asset('resources/css/responsive.css') }}" rel="stylesheet" media="screen"> 
    <link href="{{ asset('resources/css/print.css') }}" rel="stylesheet" media="print">
	<script src="{{ asset('resources/js/jquery.min.js') }}"></script>
	
	
	<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.4/summernote.css" rel="stylesheet">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.4/summernote.js"></script>

    
    <!--
	<script src="https://cdn.ckeditor.com/ckeditor5/23.0.0/classic/ckeditor.js"></script>
	<link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&display=swap"
        rel="stylesheet">
        <link rel="pr econnect" href="https://fonts.gstatic.com"> -->

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">


<!--<script src="{{ asset('resources/js/slim.min.js') }}"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>  -->
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
<body oncopy="return false" oncut="return false" >

@if(Auth::guard('admin')->check())
<nav class="navbar navbar-expand-lg navbar-dark bg-dark" id="top-admin-nav">
 
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.activities.index')}}">Activities  </a>
      </li>
      
      <li class="nav-item">
        <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Academics
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="{{ route('admin.concepts.index') }}">Concepts</a>
          <a class="dropdown-item" href="{{ route('admin.chapters.index') }}">Chapter</a>
        </div>
      </li> 
	  
	@if(!empty(Request::segment(1))) 
    @if (str_contains(Request::segment(1), 'chpactconcepts') AND Request::segment(2) AND Request::segment(3))
		<li class="nav-item edit-pg">
        <a class="nav-link" href="{{ route('admin.activities.edit', Request::segment(2)) }}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M7.127 22.564l-7.126 1.436 1.438-7.125 5.688 5.689zm-4.274-7.104l5.688 5.689 15.46-15.46-5.689-5.689-15.459 15.46z"/></svg>Edit  </a>
      </li>
	@elseif (str_contains(Request::segment(1), 'actconcepts') AND Request::segment(2) )
		<li class="nav-item edit-pg">
        <a class="nav-link" href="{{ route('admin.activities.edit', Request::segment(2)) }}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M7.127 22.564l-7.126 1.436 1.438-7.125 5.688 5.689zm-4.274-7.104l5.688 5.689 15.46-15.46-5.689-5.689-15.459 15.46z"/></svg>Edit  </a>
      </li>
	@elseif(str_contains(Request::segment(1), 'concepts') AND Request::segment(2) )
		<li class="nav-item edit-pg">
        <a class="nav-link" href="{{ route('admin.chapters.edit', Request::segment(2)) }}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M7.127 22.564l-7.126 1.436 1.438-7.125 5.688 5.689zm-4.274-7.104l5.688 5.689 15.46-15.46-5.689-5.689-15.459 15.46z"/></svg>Edit  </a>
      </li>
	@endif
	
	@endif
    </ul>
	 
	
  </div>
</nav>
@endif
    <!-- Header -->
        @include('layouts.header')
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