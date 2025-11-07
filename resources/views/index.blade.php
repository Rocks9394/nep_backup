@extends('layouts.app')
@section('title', 'Goforfit')
@section('content')

<link href="resources/css/bootstrap.min.css" rel="stylesheet">

<script defer src="resources/js/fontawesome-all.js"></script>
<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/all.js"
    integrity="sha384-xymdQtn1n3lH2wcu0qhcdaOpQwyoarkgLVxC/wZ5q7h9gHtxICrpcaSUfygqZGOe" crossorigin="anonymous">
</script>

<!-- slider Start 
<section class="main-carousel mb-5">
    <div id="mainCarouselIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#mainCarouselIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#mainCarouselIndicators" data-slide-to="1"></li>
            <li data-target="#mainCarouselIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="" src="resources/images/slides/slide1.svg" alt="slide">
            </div>
            <div class="carousel-item">
                <img class="" src="resources/images/slides/slide2.svg" alt="slide">
            </div>
            <div class="carousel-item">
                <img class="" src="resources/images/slides/slide3.svg" alt="slide">
            </div>
        </div>
        <a class="carousel-control-prev" href="#mainCarouselIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#mainCarouselIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</section>
 slider End -->



<section class="main-sec">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="heading-rw mb-3">
                    <h1>Sports</h1>
                </div>
            </div>
        </div>
        <!-- For 3 Sebjects -->

        <div class="row mb-4 thumbs-rw">

            <div class="col-6 col-md-4 col-lg-3 col-xl-2 offset-0">
                <div class="card chapter-bx mb-4">
                    <a href="{{route('sport')}}"></a>
                    <img class="" src="resources/images/sports/archery-thumb.jpg" alt="Archery">
                    <span class="card-body">
                        <h3 class="card-text">Archery</h3>
                    </span>

                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-3 col-xl-2 offset-0">
                <div class="card chapter-bx mb-4">
                    <a href="{{route('sport')}}"></a>
                    <img class="" src="resources/images/sports/athletics-thumb.jpg" alt="Athletics">
                    <span class="card-body">
                        <h3 class="card-text">Athletics</h3>
                    </span>

                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-3 col-xl-2 offset-0">
                <div class="card chapter-bx mb-4">
                    <a href="{{route('sport')}}"></a>
                    <img class="" src="resources/images/sports/Badminton-thumb.jpg" alt="Badminton">
                    <span class="card-body">
                        <h3 class="card-text">Badminton</h3>
                    </span>

                </div>
            </div>

            <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                <div class="card chapter-bx mb-4">
                    <a href="{{route('sport')}}"></a>
                    <img class="" src="resources/images/sports/Basketball-thumb.jpg" alt="Basketball">
                    <span class="card-body">
                        <h3 class="card-text">Basketball</h3>
                    </span>

                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                <div class="card chapter-bx mb-4">
                    <a href="{{route('sport')}}"></a>
                    <img class="" src="resources/images/sports/boxing-thumb.jpg" alt="boxing">
                    <span class="card-body">
                        <h3 class="card-text">Boxing</h3>
                    </span>

                </div>
            </div>

            <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                <div class="card chapter-bx mb-4">
                    <a href="{{route('sport')}}"></a>
                    <img class="" src="resources/images/sports/Cricket-thumb.jpg" alt="Cricket">
                    <span class="card-body">
                        <h3 class="card-text">Cricket</h3>
                    </span>

                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                <div class="card chapter-bx mb-4">
                    <a href="{{route('sport')}}"></a>
                    <img class="" src="resources/images/sports/Football-thumb.jpg" alt="Football">
                    <span class="card-body">
                        <h3 class="card-text">Football</h3>
                    </span>

                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                <div class="card chapter-bx mb-4">
                    <a href="{{route('sport')}}"></a>
                    <img class="" src="resources/images/sports/gymnastics-thumb.jpg" alt="Gymnastics">
                    <span class="card-body">
                        <h3 class="card-text">Gymnastics</h3>
                    </span>

                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                <div class="card chapter-bx mb-4">
                    <a href="{{route('sport')}}"></a>
                    <img class="" src="resources/images/sports/handBall-thumb.jpg" alt="handBall">
                    <span class="card-body">
                        <h3 class="card-text">HandBall</h3>
                    </span>

                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                <div class="card chapter-bx mb-4">
                    <a href="{{route('sport')}}"></a>
                    <img class="" src="resources/images/sports/Hockey-thumb.jpg" alt="Hockey">
                    <span class="card-body">
                        <h3 class="card-text">Hockey</h3>
                    </span>

                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                <div class="card chapter-bx mb-4">
                    <a href="{{route('sport')}}"></a>
                    <img class="" src="resources/images/sports/judo-thumb.jpg" alt="judo">
                    <span class="card-body">
                        <h3 class="card-text">Judo</h3>
                    </span>

                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                <div class="card chapter-bx mb-4">
                    <a href="{{route('sport')}}"></a>
                    <img class="" src="resources/images/sports/Kabaddi-thumb.jpg" alt="Kabaddi">
                    <span class="card-body">
                        <h3 class="card-text">Kabaddi</h3>
                    </span>

                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                <div class="card chapter-bx mb-4">
                    <a href="{{route('sport')}}"></a>
                    <img class="" src="resources/images/sports/Kho-Kho-thumb.jpg" alt="Kho Kho">
                    <span class="card-body">
                        <h3 class="card-text">Kho Kho</h3>
                    </span>

                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                <div class="card chapter-bx mb-4">
                    <a href="{{route('sport')}}"></a>
                    <img class="" src="resources/images/sports/Table-tennis-thumb.jpg" alt="Table Tennis">
                    <span class="card-body">
                        <h3 class="card-text">Table Tennis</h3>
                    </span>

                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                <div class="card chapter-bx mb-4">
                    <a href="{{route('sport')}}"></a>
                    <img class="" src="resources/images/sports/shooting-thumb.jpg" alt="shooting">
                    <span class="card-body">
                        <h3 class="card-text">Shooting</h3>
                    </span>

                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                <div class="card chapter-bx mb-4">
                    <a href="{{route('sport')}}"></a>
                    <img class="" src="resources/images/sports/swimming-thumb.jpg" alt="Swimming">
                    <span class="card-body">
                        <h3 class="card-text">Swimming</h3>
                    </span>

                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                <div class="card chapter-bx mb-4">
                    <a href="{{route('sport')}}"></a>
                    <img class="" src="resources/images/sports/Tennis-thumb.jpg" alt="Tennis">
                    <span class="card-body">
                        <h3 class="card-text">Tennis</h3>
                    </span>

                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                <div class="card chapter-bx mb-4">
                    <a href="{{route('sport')}}"></a>
                    <img class="" src="resources/images/sports/Volleyball-thumb.jpg" alt="Volleyball">
                    <span class="card-body">
                        <h3 class="card-text">Volleyball</h3>
                    </span>

                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                <div class="card chapter-bx mb-4">
                    <a href="{{route('sport')}}"></a>
                    <img class="" src="resources/images/sports/weightlifting-thumb.jpg" alt="weightlifting">
                    <span class="card-body">
                        <h3 class="card-text">Weightlifting</h3>
                    </span>

                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                <div class="card chapter-bx mb-4">
                    <a href="{{route('sport')}}"></a>
                    <img class="" src="resources/images/sports/wrestling-thumb.jpg" alt="wrestling">
                    <span class="card-body">
                        <h3 class="card-text">Wrestling</h3>
                    </span>

                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                <div class="card chapter-bx mb-4">
                    <a href="{{route('sport')}}"></a>
                    <img class="" src="resources/images/sports/yoga-thumb.jpg" alt="yoga">
                    <span class="card-body">
                        <h3 class="card-text">Yoga</h3>
                    </span>

                </div>
            </div>

        </div>

        <div class="row">
            <div class="col">
                <div class="heading-rw mb-3">
                    <h1>Academics</h1>

                </div>
            </div>
        </div>
        <!-- For 3 Sebjects -->

        <div class="row mb-5 thumbs-rw">

            <div class="col-6 col-md-4 col-lg-3 col-xl-2 offset-0">
                <div class="card chapter-bx mb-4">
                    <a href="{{route('academics')}}"></a>
                    <img class="" src="resources/images/academy/cls-1.png" alt="Class 1">
                    <span class="card-body">
                        <h3 class="card-text">Class 1</h3>
                    </span>

                </div>
            </div>

            <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                <div class="card chapter-bx mb-4">
                    <a href="{{route('academics')}}"></a>
                    <img class="" src="resources/images/academy/cls-2.png" alt="Class 2">
                    <span class="card-body">

                        <h3 class="card-text">Class 2</h3>
                    </span>

                </div>
            </div>

            <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                <div class="card chapter-bx mb-4">
                    <a href="{{route('academics')}}"></a>
                    <img class="" src="resources/images/academy/cls-3.png" alt="Class 3">
                    <span class="card-body">

                        <h3 class="card-text">Class 3</h3>
                    </span>

                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                <div class="card chapter-bx mb-4">
                    <a href="{{route('academics')}}"></a>
                    <img class="" src="resources/images/academy/cls-4.png" alt="Class 4">
                    <span class="card-body">

                        <h3 class="card-text">Class 4</h3>
                    </span>

                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                <div class="card chapter-bx mb-4">
                    <a href="{{route('academics')}}"></a>
                    <img class="" src="resources/images/academy/cls-5.png" alt="Class 5">
                    <span class="card-body">

                        <h3 class="card-text">Class 5</h3>
                    </span>

                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                <div class="card chapter-bx mb-4">
                    <a href="{{route('academics')}}"></a>
                    <img class="" src="resources/images/academy/cls-6.png" alt="Class 6">
                    <span class="card-body">

                        <h3 class="card-text">Class 6</h3>
                    </span>

                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                <div class="card chapter-bx mb-4">
                    <a href="{{route('academics')}}"></a>
                    <img class="" src="resources/images/academy/cls-7.png" alt="Class 7">
                    <span class="card-body">

                        <h3 class="card-text">Class 7</h3>
                    </span>

                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                <div class="card chapter-bx mb-4">
                    <a href="{{route('academics')}}"></a>
                    <img class="" src="resources/images/academy/cls-8.png" alt="Class 8">
                    <span class="card-body">

                        <h3 class="card-text">Class 8</h3>
                    </span>

                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                <div class="card chapter-bx mb-4">
                    <a href="{{route('academics')}}"></a>
                    <img class="" src="resources/images/academy/cls-9.png" alt="Class 9">
                    <span class="card-body">

                        <h3 class="card-text">Class 9</h3>
                    </span>

                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                <div class="card chapter-bx mb-4">
                    <a href="{{route('academics')}}"></a>
                    <img class="" src="resources/images/academy/cls-10.png" alt="Class 10">
                    <span class="card-body">

                        <h3 class="card-text">Class 10</h3>
                    </span>

                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                <div class="card chapter-bx mb-4">
                    <a href="{{route('academics')}}"></a>
                    <img class="" src="resources/images/academy/cls-11.png" alt="Class 11">
                    <span class="card-body">

                        <h3 class="card-text">Class 11</h3>
                    </span>

                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                <div class="card chapter-bx mb-4">
                    <a href="{{route('academics')}}"></a>
                    <img class="" src="resources/images/academy/cls-12.png" alt="Class 12">
                    <span class="card-body">

                        <h3 class="card-text">Class 12</h3>
                    </span>

                </div>
            </div>

        </div>
    </div>
</section>





@endsection