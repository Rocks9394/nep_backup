@extends('layouts.icsce-master-app')
@section('title', 'Goforfit | ' . $title)
@section('content')


<div class="container">
    <div class="t-mrg2 mb-5 pb-5">

        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-12">

                    @if(auth()->guard('web')->check())

                        <a href="javascript:history.back()" class="back-button">
                            <span class="arrow"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5" />
                                </svg></span> 
                        </a>

                        @elseif(auth()->guard('sstudent')->check())

                        <a href="javascript:history.back()" class="back-button">
                            <span class="arrow"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5" />
                                </svg></span> 
                        </a>
                        
                        @endif

                        <div class="heading-rw mt-0 mb-0 pt-0">
                            <h1 class="px-2 px-lg-0 mr-0">{{$title}}</h1>
                        </div>
                        
                    </div>
                </div>
                <div class="row text-center justify-content-md-center mt-3 mt-lg-4">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="all-tests">
                            <ul class="list-group mt-3">
                                <li>
                                    <a href="#"><span>One-Foot Balance</span><i class="bi bi-arrow-right"></i></a>
                                </li>
                                <li>
                                    <a href="#a"><span>Beam Walk</span><i class="bi bi-arrow-right"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection