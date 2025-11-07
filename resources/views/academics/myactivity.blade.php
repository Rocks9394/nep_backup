@extends('layouts.app')
@section('title', 'Goforfit - '.$title )

@section('content')
@php $permission = array(1,3,4,5,6); @endphp

<!-- Required meta tags -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
    integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">

<!-- cdnjs.com / libraries / fontawesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" charset="utf-8"></script>

<style>
.note-popover .arrow {
    display: none;
}
</style>

<div class="wrapper">
    @include('layouts.sidebar')

    <div id="content">
    <div class="container-fluid">
    <div class="row">
    
    <div class="d-block d-sm-none activity-heading"><h1>My Activities</h1></div>
    
        <div class="navbar toggle-bar">
            <button type="button" id="sidebarCollapse" class="toggle-btn btn">
                <img src="resources/imgs/side-menu.svg" alt="sidemenu">
            </button>

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('academics') }}">Academic</a></li>

                    <li class="breadcrumb-item active"> My Activity </li>

                </ol>
            </nav>

        </div>


        <div class="dashboard-area my-activities-bx">

            <div class="row">
                @if(count($posts)>0)
                @if(!empty($posts))
                @foreach($posts as $act)
                <div class="col-12 col-md-4 col-lg-3 col-xl-2">
                    <div class="card chapter-bx">
                        
                        <?php				   
						 $word = "wp-content";
						 $mystring = $act->image;
										 
						 if(strpos($mystring, $word)!== false){
						 ?>
                        <figure class="thumb-card"><img
                                src="{{ preg_replace('/[^(\x20-\x7F)\x0A\x0D]*/','', $act->image) }}"
                                class="card-img-top attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="">
                        </figure>
                        <?php } else if (file_exists('public/uploads/'.$act->image)){ ?>
                        <figure class="thumb-card"><img src="{{ asset('public/uploads').'/'.$act->image }}"
                                class="card-img-top attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="">
                        </figure>
                        <?php } else{ ?>
                        <figure class="thumb-card"><img src="{{ asset('public/uploads').'/'.'images.jpg' }}"
                                class="card-img-top attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="">
                        </figure>
                        <?php } ?>
                        <div class="card-body">
                            <span class="no-concents1"></span>
                            <h3> {{ preg_replace('/[^(\x20-\x7F)\x0A\x0D]*/','', $act->title) }} </h3>
                            <span class="author-nm"><img src="{{ asset('resources/images').'/'.'/author-i.svg' }}"
                                    alt="author" />{{ $act->usrname }} </span>
                                    <div class="action-dv">
							<a class="view-post" href="{{ url('actconcepts/'.$act->id)}}"><span>View</span></a>
							<a class="edit-post" href="{{url('edit-activity')}}/{{$act->id}}"><span><!--<img src="{{ asset('resources/imgs').'/'.'/edit-i.svg' }}"
                                    alt="edit" />-->Edit</span></a>
                                    </div>
                        </div>

                    </div>
                </div>

                @endforeach
                @endif
                @else
                <div class="col-12 col-md-6 offset-md-3">

                    <div class="pg-not-found pt-3 pl-2 pb-4 pr-5 mt-4 mb-4">

                        <figure class="pt-3"><img src="{{ asset('resources/images/no-data-found.png') }}"
                                class="card-img-top attachment-post-thumbnail size-post-thumbnail wp-post-image"
                                alt="No data found"> </figure>
                        <div class="nofound-txt">
                            <h1>404</h1>
                            <h2>No Data Found...!</h2>
                            <p>Oops! The page you are looking for could not be found.</p>
                            <a href="{{ url('sport') }}" class="btn btn-primary"><svg class="bck-arw"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path d="M16.67 0l2.83 2.829-9.339 9.175 9.339 9.167-2.83 2.829-12.17-11.996z" />
                                </svg>Back to Home</a>
                        </div>
                    </div>

                    <!--<span class=""> No Activity Data Found ...!</span> -->

                </div>
                @endif
            </div>

            <div class="d-flex justify-content-center">{{ $posts->onEachSide(1)->links() }}</div>

        </div>

        </div>
        </div>
    </div>
    
</div>


@include('layouts.sidebarfooter')

@endsection