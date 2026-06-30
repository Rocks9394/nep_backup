<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="twitter:card" value="summary">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="msapplication-TileImage" content="{{ asset('resources/images/edutok-fav.ico')}}" />
    <title>@yield('title')</title>
    <link rel="icon" href="#" sizes="32x32" />
    
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
    
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap/bootstrap.min.css') }}" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link href="{{ asset('resources/css/style.css') }}" rel="stylesheet" media="all">
    <link rel="stylesheet" href="{{ asset('resources/css/custom-style.css') }}">

    <link href="{{ asset('resources/css/print.css') }}" rel="stylesheet" media="print">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <script src="{{ asset('resources/js/jquery.min.js') }}"></script>
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
     
    <link rel="stylesheet" href="{{ asset('assets/css/customstyle.css') }}" type="text/css"> 
    <link rel="stylesheet" href="{{ asset('assets/css/take-test-root.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/take-test-style.css') }}">
    <link href="{{ asset('resources/css/responsive.css') }}" rel="stylesheet" media="screen">

</head>

<body oncopy="return false" oncut="return false" class="{{ last(request()->segments()) }}  common-inner-cls" >

<nav class="navbar navbar-light top_nav_bar px-0">
    <div class="container d-flex justify-content-between w-100">
        <div class="ml-5 ml-sm-0">
            @php
            $GetSchoolLogo = Helper::GetSchoolLogo();
            @endphp
            
                @if(!empty($GetSchoolLogo->logo))
                    <img src="{{ asset('assets/uploads/logos/'.$GetSchoolLogo->logo) }}" style="height:42px; padding:0;">
                @endif    
        
        </div>

        @if(auth()->guard('web')->check())
            <a class="navbar-brand logo d-md-block d-none" href="{{ route('filldart.dashboard') }}">
                <img src="{{ asset('resources/images/gofor-fit-logo.png') }}" class="d-inline-block align-top" alt="goforfit - web" style="height:32px;">
            </a>
        @elseif(auth()->guard('sstudent')->check())
            <a class="navbar-brand logo d-md-block d-none" href="{{ route('student.dashboard') }}">
                <img src="{{ asset('resources/images/gofor-fit-logo.png') }}" class="d-inline-block align-top" alt="goforfit - student" style="height:32px;">
            </a>
        @endif

        <div class="btn-group">
            <div class="user-cred order-md-12">
                <ul class="navbar-nav">

                    {{--
                    @guest
                    <li class="nav-item l_area mr-2">
                        @if(Route::has('login'))
                        <a class="nav-link user-login" href="{{ route('login') }}">{{ __('Login') }}</a>
                        @endif
                    </li>

                    @else
                    <li class="nav-item dropdown avtar">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="{{ route('filldart.dashboard') }}" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <img src="{{ asset('resources/images/avtar.png') }}" class="d-inline-block align-top" height="32" alt="avtar">
                    <span class="d-md-block d-none">
                                {{ Auth::user()->name }}
                    </span>
                        </a>
                        <div class="dropdown-menu user-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ url('editprofile') }}/{{ Auth::user()->id }}">
                                {{ __('Edit Profile') }}
                            </a>
                            <a class="dropdown-item last_child" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                    @endguest
                    --}}


                    @if(auth()->guard('web')->guest() && auth()->guard('sstudent')->guest())
                        <li class="nav-item l_area mr-2">
                            <a class="nav-link user-login" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @else
                        <li class="nav-item dropdown avtar">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="{{ route('filldart.dashboard') }}" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <img src="{{ asset('resources/images/avtar.png') }}" class="d-inline-block align-top" height="32" alt="avtar">
                                @if(auth()->guard('web')->check())
                                    <span class="d-md-block d-none">
                                {{ Auth::user()->name }}
                    </span>
                                @elseif(auth()->guard('sstudent')->check())
                    <span class="d-md-block d-none">
                                {{ Auth::guard('sstudent')->user()->student_name }}
                    </span>

                                @endif
                            </a>
                            <div class="dropdown-menu user-menu" aria-labelledby="navbarDropdown">
                                @if(auth()->guard('web')->check())
                                    <a class="dropdown-item" href="{{ url('editprofile/' . Auth::user()->id) }}">
                                        {{ __('Edit Profile') }}
                                    </a>
                                @elseif(auth()->guard('sstudent')->check())
                                    <a class="dropdown-item" href="#">
                                        {{ __('Edit Profile') }}
                                    </a>
                                @endif
                                <a class="dropdown-item last_child" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endif


                </ul>
            </div>
        </div>

        </div>
    </nav>


    <!-- Header -->
   
    <!-- Header end -->
    <!-- Content section -->
    @yield('content')
    <!-- Content section end-->
    <!-- Footer -->

@include('layouts.icsce-master-footer')
</body>

</html>