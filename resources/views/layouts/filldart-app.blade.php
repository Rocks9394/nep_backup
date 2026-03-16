<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="twitter:card" value="summary">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="msapplication-TileImage" content="{{ asset('public/favicon.ico')}}" />
    <title>@yield('title')</title>
    <link rel="icon" href="{{ asset('public/favicon.ico')}}" sizes="32x32" />
    <link rel="apple-touch-icon-precomposed" href="{{ asset('public/favicon.ico')}}" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

    <link rel="stylesheet" href="{{ asset('resources/css/dashboard.min.css') }}" media="screen">
    <link href="{{ asset('resources/css/style.css') }}" rel="stylesheet" media="all">
    <link rel="stylesheet" href="{{ asset('resources/css/custom-style.css') }}">
    <link href="{{ asset('resources/css/responsive.css') }}" rel="stylesheet" media="screen">

    <link href="{{ asset('resources/css/print.css') }}" rel="stylesheet" media="print">
    
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.4/summernote.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    
    <script src="{{ asset('resources/js/jquery.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.4/summernote.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <!-- DataTable CSS -->
    <script src="{{ asset('public/assets/DataTables/datatables.js') }}"></script>
    <script src="{{ asset('public/assets/DataTables/datatables.min.js') }}"></script>
    <!-- DataTables Buttons JS -->    
    <script src="https://cdn.datatables.net/select/2.0.3/js/dataTables.select.js"></script>
    <script src="https://cdn.datatables.net/select/2.0.3/js/select.bootstrap4.js"></script>
    <script src="https://cdn.datatables.net/datetime/1.5.3/js/dataTables.dateTime.min.js"></script>
    <script src="https://cdn.datatables.net/colreorder/2.0.3/js/dataTables.colReorder.js"></script>
    <script src="https://cdn.datatables.net/colreorder/2.0.3/js/colReorder.bootstrap4.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.1.0/js/dataTables.buttons.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.1.0/js/buttons.bootstrap4.js"></script>
    <!-- JSZip for Excel export -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <!-- PDFMake for PDF export -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <!-- Buttons HTML5 for export -->
    <script src="https://cdn.datatables.net/buttons/3.1.0/js/buttons.html5.min.js"></script>
    <!-- Buttons print for print button -->
    <script src="https://cdn.datatables.net/buttons/3.1.0/js/buttons.print.min.js"></script>
    <!-- sweet alert  -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        
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

        window.addEventListener('selectstart', function(e) {
            e.preventDefault();
        });
    </script>

    @stack('style-css')

    <link rel="stylesheet" href="{{ asset('public/assets/css/take-test-root.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/take-test-style.css') }}">

</head>


<body oncopy="return false" oncut="return false" class="{{ last(request()->segments()) }}  common-inner-cls" >

    <nav class="navbar navbar-light top_nav_bar px-0">
        <div class="container d-flex justify-content-between w-100">
	
            <!-- Left Logo -->
            @php  $SchoolDetails = Helper::GetSchoolDetails();  @endphp

            @if(!empty($SchoolDetails))
                @if($SchoolDetails->logo)
                    <img src="{{ asset('public/assets/uploads/logos/' . $SchoolDetails->logo) }}" style="height:42px; padding:0;">
                @else
                    <p>School: {{ $SchoolDetails->school_name }} @if($SchoolDetails->school_code)| {{ $SchoolDetails->school_code }}@endif</p>
                @endif
            @endif
            

            <!-- Mid-Logo -->
            @if(auth()->guard('sstudent')->check())
                <a class="navbar-brand logo d-lg-block d-none" href="{{ route('student.dashboard') }}">
                    <img src="{{ asset('resources/images/gofor-fit-logo.png') }}" class="d-inline-block align-top" alt="student">
                </a>
            @else
                <a class="navbar-brand logo d-lg-block d-none" href="{{ route('filldart.dashboard') }}">
                    <img src="{{ asset('resources/images/gofor-fit-logo.png') }}" class="d-inline-block align-top" alt="others">
                </a>
            @endif
        
            <!-- Right Side DropDown -->
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
                                {{ Auth::user()->name }}
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
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="{{ route('filldart.dashboard') }}" role="button"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <img src="{{ asset('resources/images/avtar.png') }}" class="d-inline-block align-top" height="32" alt="avtar">
                                    
                                    <span class="d-md-block d-none">
                                        @if(auth()->guard('web')->check())                                        
                                            {{ Auth::user()->name }}
                                        @elseif(auth()->guard('sstudent')->check())
                                            {{ Auth::guard('sstudent')->user()->student_name }}
                                        @endif
                                    </span>
                                </a>
                                <div class="dropdown-menu user-menu mt-2" aria-labelledby="navbarDropdown">
                                    @if(auth()->guard('web')->check())
                                        @if(Auth::user()->role_id == '4')
                                            <a class="dropdown-item" href="{{ route('update.profile')}}"> {{ __('School Profile') }} </a>
                                            @if(Auth::user()->role_id == '4' && Auth::user()->id == '974')
                                             <a class="dropdown-item" href="{{ route('password.change')}}"> {{ __('Change Password') }} </a>
                                            @endif
                                        @else
                                        <a class="dropdown-item" href="{{ url('editprofile') }}">
                                            {{ __('Edit Profile') }}
                                        </a>
                                        @endif
                                    @elseif(auth()->guard('sstudent')->check())
                                       <a class="dropdown-item" href="{{ route('student.profile')}}">
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
        <noscript>
            <div style="background-color: #ffcc00; color: #000; padding: 20px; text-align: center;">
                ⚠️ JavaScript is disabled in your browser. Please <a href="https://www.google.com/httpservice/retry/enablejs" target="_blank" style="text-decoration:none;">Enable JavaScript</a> to continue using this site.
                
            </div>
        </noscript>
         @if (session('Auth_id'))
             <style>
                .btn-outline-custom {
                    color: #ff8000 !important;
                    /* border-color: #1900ff !important; */
                }

                .btn-outline-custom:hover {
                    color: #ff8000 !important;
                    font-weight: bold;
                    border-color: #ff8000 !important;
                }
            </style>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const navEntries = performance.getEntriesByType("navigation");
                    if (navEntries.length > 0 && navEntries[0].type === "reload") {
                        window.location.replace("/student-dashboard");
                        return;
                    }
                    
                    history.pushState({ page: 1 }, "", "");
                    window.addEventListener("popstate", function (event) {
                        window.location.replace("/student-dashboard");
                    });
                });
            </script>
            <div style="background-color: #292775; color: #fff; padding: 5px; text-align: center;">
                You are logged in as 
                <strong>{{ session('student_name') }}</strong> 
                ({{ session('clsss') }}-{{ session('section') }} | RollNo: {{session('rollno')}})                
                <button id="leaveImpersonation" class="btn btn-sm btn-outline-custom" style="">Return to School</button>
            </div>
        @endif

    @yield('content')

    @stack('page-script')
    @include('layouts.footer')   

    <script>            
        $('#leaveImpersonation').on('click', function() {
            $.ajax({
                url: "{{route('school.leaveStudent')}}",
                method: 'POST',
                data: { _token: $('meta[name="csrf-token"]').attr('content') },
                success: function(response) {
                    if (response.success) {
                        window.location.href = response.redirect_url;
                    } else {
                        alert(response.message || 'Failed to leave impersonation');
                    }
                }
            });
        });
    </script>
</body>

</html>