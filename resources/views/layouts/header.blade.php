<header>
    <!--<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />-->
    <div class="container">
        <div class="row">
            <div class="col">
                <nav class="navbar navbar-expand-md">
                    
                    <a class="navbar-brand pt-1 pl-2 pb-1 pr-2 pr-xs-1" href="{{route('index')}}"><img src="{{ asset('resources/images/goforfit-logo-w.svg') }}" alt="" title="" class="img-fluid goforfit-logo d-none d-md-none d-lg-block"> <img src="{{ asset('resources/images/goforfit-logo-i-w.svg') }}" class="img-fluid goforfit-logo logo-mob d-md-block d-lg-none d-sm-block" alt="" title=""></a>
                    <button class="navbar-toggler mob-menu" type="button" data-toggle="collapse" data-target="#navbarNav">
                        <span class="navbar-toggler-icon"><svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd">
                                <path d="M24 18v1h-24v-1h24zm0-6v1h-24v-1h24zm0-6v1h-24v-1h24z" fill="#ffffff" />
                                <path d="M24 19h-24v-1h24v1zm0-6h-24v-1h24v1zm0-6h-24v-1h24v1z" />
                            </svg></span>
                    </button>
                    <div class="user-cred order-md-12">
                        <ul class="navbar-nav">
                            @guest

                            <li class="nav-item l_area mr-2">
                                @if(Route::has('login'))
                                <a class="nav-link user-login" href="{{ route('login') }}">{{ __('Login') }}</a>
                                @endif

                            </li>


                            <!-- <li class="nav-item l_area">
										
									</li> -->

                            @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="{{ url('dashboard') }}" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
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
                        </ul>
                    </div>
                    <div class="navbar-collapse collapse order-md-1 mob-dropdown" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item {{ (request()->is('sports')) ? 'active' : '' }}">
                                <a class="nav-link {{ (request()->is('sports')) ? 'active' : '' }}" href="{{ route('sports') }}">Sports</a>
                            </li>
                            <li class="nav-item custom-nav-link dropdown {{ (request()->is('academics')) ? 'active' : '' }}">
                                <a class="nav-link {{ (request()->is('academics')) ? 'active' : '' }}" href="{{ route('academics') }}">Academic</a>
                            </li>

                            <li class="nav-item dropdown{{ (request()->is('activities')) ? 'active' : '' }}">
                                <a class="nav-link dropdown-toggle {{ (request()->is('activities')) ? 'active' : '' }}" href="{{ route('activities') }}" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Activities

                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('addactivity') }}">Add Activity</a>
                                    <a class="dropdown-item" href="{{ route('myactivities') }}">My Activities</a>
                                    <a class="dropdown-item" href="{{ route('activities') }}">All Activities</a>
                                </div>

                            </li>

                            <li class="nav-item {{ (request()->is('userstatus')) ? 'active' : '' }}">
                                <a class="nav-link {{ (request()->is('userstatus')) ? 'active' : '' }}" href="{{ route('userstatus') }}">Activity Status</a>
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
</header>