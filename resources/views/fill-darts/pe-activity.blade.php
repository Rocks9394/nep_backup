@extends('layouts.filldart-app')
@section('title', 'Goforfit | ' . $title)
@section('content')

<div class="container">
    <div class="t-mrg2">
        <div class="all-chaptr-cards">
            <div class="row">
                <div class="col">
                    <div class="heading-rw mt-3 mt-md-1 mb-0 p-0">
                    @if(auth()->guard('web')->check())

                        <a href="{{ route('filldart.dashboard') }}" class="back-button">
                        <span class="arrow"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16"> <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5" /> </svg></span>  </a>

                    @elseif(auth()->guard('sstudent')->check())                      

                        <a href="{{ route('student.dashboard') }}" class="back-button">
                        <span class="arrow"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16"> <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5" /> </svg></span>  </a>
                    @endif                
                       <h1 class="ml-md-4 mb-0">{{$title}}</h1>
                    </div>
                </div>
            </div>
            <div class="row mt-4 mb-5 sports-list" style="justify-content: center;">
            <div class="col-4 col-md-3 col-lg-2 col-xl-2 mb-4"><a href="https://goforfit.in/genre/nursery/" target="_blank" class="img-grid" ><span>Nursery</span><img src="{{ asset('public/class/cls-nur.jpg') }}" class="img-fluid rounded w-100" alt="Class 1"></a></div>
            <div class="col-4 col-md-3 col-lg-2 col-xl-2 mb-4"><a href="https://goforfit.in/genre/kg/" target="_self" class="img-grid"><span>KG</span><img src="{{ asset('public/class/cls-ukg.jpg') }}" class="img-fluid rounded w-100" alt="Class 1"></a></div>
            <div class="col-4 col-md-3 col-lg-2 col-xl-2 mb-4"><a href="https://goforfit.in/genre/class-1/" target="_self" class="img-grid "><span>Class I</span><img src="{{ asset('public/class/cls-1.png') }}" class="img-fluid rounded w-100" alt="Class 1"></a></div>
            <div class="col-4 col-md-3 col-lg-2 col-xl-2 mb-4"><a href="https://goforfit.in/genre/class-2/" target="_self" class="img-grid "><span>Class II</span><img src="{{ asset('public/class/cls-2.png') }}" class="img-fluid rounded w-100" alt="Class 2"></a></div>
            <div class="col-4 col-md-3 col-lg-2 col-xl-2 mb-4"><a href="https://goforfit.in/genre/class-3/" target="_self" class="img-grid"><span>Class III</span><img src="{{ asset('public/class/cls-3.png') }}" class="img-fluid rounded w-100" alt="Class 3"></a></div>
            <div class="col-4 col-md-3 col-lg-2 col-xl-2 mb-4"><a href="https://goforfit.in/genre/class-4" target="_self" class="img-grid"><span>Class IV</span><img src="{{ asset('public/class/cls-4.png') }}" class="img-fluid rounded w-100" alt="Class 4"></a></div>
            <div class="col-4 col-md-3 col-lg-2 col-xl-2 mb-4"><a href="https://goforfit.in/genre/class-5/" target="_self" class="img-grid"><span>Class V</span><img src="{{ asset('public/class/cls-5.png') }}" class="img-fluid rounded w-100" alt="Class 5"></a></div>
            <div class="col-4 col-md-3 col-lg-2 col-xl-2 mb-4"><a href="https://goforfit.in/genre/class-6/" target="_self" class="img-grid"><span>Class VI</span><img src="{{ asset('public/class/cls-6.png') }}" class="img-fluid rounded w-100" alt="Class 6"></a></div>
            <div class="col-4 col-md-3 col-lg-2 col-xl-2 mb-4"><a href="https://goforfit.in/genre/class-7/" target="_self" target="_self" class="img-grid"><span>Class VII</span><img src="{{ asset('public/class/cls-7.png') }}" class="img-fluid rounded w-100" alt="Class 7"></a></div>
            <div class="col-4 col-md-3 col-lg-2 col-xl-2 mb-4"><a href="https://goforfit.in/genre/class-8/" target="_self" class="img-grid"><span>Class VIII</span><img src="{{ asset('public/class/cls-8.png') }}" class="img-fluid rounded w-100" alt="Class 8"></a></div>
            <div class="col-4 col-md-3 col-lg-2 col-xl-2 mb-4"><a href="https://goforfit.in/genre/class-9" target="_self" class="img-grid"><span>Class IX</span><img src="{{ asset('public/class/cls-9.png') }}" class="img-fluid rounded w-100" alt="Class 9"></a></div>
            <div class="col-4 col-md-3 col-lg-2 col-xl-2 mb-4"><a href="https://goforfit.in/genre/class-10/" target="_self" class="img-grid"><span>Class X</span><img src="{{ asset('public/class/cls-10.png') }}" class="img-fluid rounded w-100" alt="Class 10"></a></div>
            <div class="col-4 col-md-3 col-lg-2 col-xl-2 mb-4"><a href="https://goforfit.in/genre/class-11/" target="_self" class="img-grid"><span>Class XI</span><img src="{{ asset('public/class/cls-11.png') }}" class="img-fluid rounded w-100" alt="Class 11"></a></div>
            <div class="col-4 col-md-3 col-lg-2 col-xl-2 mb-4"><a href="https://goforfit.in/genre/class-12/" target="_self" class="img-grid"><span>Class XII</span><img src="{{ asset('public/class/cls-12.png') }}" class="img-fluid rounded w-100" alt="Class 12"></a></div>
            </div>

        </div>
    </div>
</div>


<script>
$(document).ready(function() {
    $('a.img-grid').click(function(event) {
        event.preventDefault();
        var url = $(this).attr('href');
        var namedWindow = window.open('', 'myNamedWindow');
        namedWindow.location.href = url;
    });
});
</script>



@endsection