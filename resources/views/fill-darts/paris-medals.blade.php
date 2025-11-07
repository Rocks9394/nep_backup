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

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">  
     
    <link href="{{ asset('resources/css/style.css') }}" rel="stylesheet" media="all">   
    <link href="{{ asset('resources/css/responsive.css') }}" rel="stylesheet" media="screen"> 
    <link href="{{ asset('resources/css/custom-style.css') }}" rel="stylesheet">
	  <!-- <script src="{{ asset('resources/js/jquery.min.js') }}"></script> -->
	
	
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">


    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
        
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script> 
<style>
	*, body {
		padding: 0;
		margin: 0;
	}
</style>
</head> 
<body>
<div class="container-fluid">
	<div class="t-mrg2 mt-4">
		<div class="all-chaptr-cards mb-0">
			<div class="row">
				<div class="col">
					<a href="{{ url()->previous() }}" class="back-button">
						<span class="arrow"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
								<path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5" />
							</svg></span>
						<!-- <button class="close" type="button"><- Back</button> 
						<span class="back-txt">Back</span>-->
					</a>
					<div class="heading-rw mb-4 mt-0 px-5">
						<h1 style="position: relative; top:-5px;">{{$title}}</h1>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
			<iframe src="https://olympics.com/en/paris-2024/medals" title="Paris 2024" style="border:none; width:100%; height:calc(100vh - 82px);" id="iFrame1"></iframe>
				</div>
				</div>
		</div>
	</div>
</div>
<script type="application/javascript">

function resizeIFrameToFitContent( iFrame ) {

    iFrame.width  = iFrame.contentWindow.document.body.scrollWidth;
    iFrame.height = iFrame.contentWindow.document.body.scrollHeight;
}

window.addEventListener('DOMContentLoaded', function(e) {

    var iFrame = document.getElementById( 'iFrame1' );
    resizeIFrameToFitContent( iFrame );

    // or, to resize all iframes:
    var iframes = document.querySelectorAll("iframe");
    for( var i = 0; i < iframes.length; i++) {
        resizeIFrameToFitContent( iframes[i] );
    }
} );

</script>
</body>
</html>