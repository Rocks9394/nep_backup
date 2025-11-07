@extends('layouts.icsce-master-app')
@section('title', 'Goforfit | ' . $title)
@section('content')


<div class="container">
    <div class="t-mrg">
       <div class="row">
        <div class="col">

            @if(auth()->guard('web')->check())

                <a href="{{ route('filldart.dashboard') }}" class="back-button">
                    <span class="arrow"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5" />
                        </svg></span> 
                </a>

            @elseif(auth()->guard('sstudent')->check())

                <a href="{{ route('student.dashboard') }}" class="back-button">
                    <span class="arrow"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5" />
                        </svg></span> 
                </a>
            
            @endif

            <div class="heading-rw mt-2 mb-0 pt-1">
                <h1>{{$title}}</h1>
            </div>
        </div>
       </div>
    <div class="row text-center justify-content-md-center mt-4 mt-lg-5">
        <div class="col-12 col-md-12 col-lg-12 col-xl-10">
            <div class="form-row" style="justify-content: center;">

                <div class="col-4 col-md-3 col-lg-2 col-xl-2 mb-4">
                    <a href="{{ url('assessor-app-agility')}}" class="box">
                        <div><img class="img-fluid" alt="" src="{{asset('public/uploads/icons/tacktest/agility.svg') }}"></div><span>Agility</span>
                    </a>
                </div>

                <div class="col-4 col-md-3 col-lg-2 col-xl-2 mb-4">
                    <a href="#a" class="box">
                        <div><img class="img-fluid" alt="" src="{{asset('public/uploads/icons/tacktest/speed.svg') }}"></div><span>Speed</span>
                    </a>
                </div>

                <div class="col-4 col-md-3 col-lg-2 col-xl-2 mb-4">
                    <a href="#a" class="box">
                        <div><img class="img-fluid" alt="" src="{{asset('public/uploads/icons/tacktest/ls.svg') }}"></div><span>Locomotive Skills</span>
                    </a>
                </div>

                <div class="col-4 col-md-3 col-lg-2 col-xl-2 mb-4">
                    <a href="#a" class="box">
                        <div><img class="img-fluid" alt="" src="{{asset('public/uploads/icons/tacktest/gymnastic.svg') }}"></div><span>Gymnastic</span>
                    </a>
                </div>


                <div class="col-4 col-md-3 col-lg-2 col-xl-2 mb-4">
                    <a href="#a" class="box">
                        <div><img class="img-fluid" alt="" src="{{asset('public/uploads/icons/tacktest/flexibility.svg') }}"></div><span>Flexibility</span>
                    </a>
                </div>

  

                <div class="col-4 col-md-3 col-lg-2 col-xl-2 mb-4">
                    <a href="#a" class="box">
                        <div><img class="img-fluid" alt="" src="{{asset('public/uploads/icons/tacktest/strength.svg') }}"></div><span>Strength</span>
                    </a>
                </div>

                <div class="col-4 col-md-3 col-lg-2 col-xl-2 mb-4">
                    <a href="#a" class="box">
                        <div><img class="img-fluid" alt="" src="{{asset('public/uploads/icons/tacktest/power.svg') }}"></div><span>Power</span>
                    </a>
                </div>
                <div class="col-4 col-md-3 col-lg-2 col-xl-2 mb-4">
                    <a href="#a" class="box">
                        <div><img class="img-fluid" alt="" src="{{asset('public/uploads/icons/tacktest/bmi.svg') }}"></div><span>BMI</span>
                    </a>
                </div>
                <div class="col-4 col-md-3 col-lg-2 col-xl-2 mb-4">
                    <a href="#a" class="box">
                        <div><img class="img-fluid" alt="" src="{{asset('public/uploads/icons/tacktest/endurance.svg') }}"></div><span>Endurance</span>
                    </a>
                </div>
                <div class="col-4 col-md-3 col-lg-2 col-xl-2 mb-4">
                    <a href="#a" class="box">
                        <div><img class="img-fluid" alt="" src="{{asset('public/uploads/icons/tacktest/balance.svg') }}"></div><span>Balance</span>
                    </a>
                </div>
                <div class="col-4 col-md-3 col-lg-2 col-xl-2 mb-4">
                    <a href="#a" class="box">
                        <div><img class="img-fluid" alt="" src="{{asset('public/uploads/icons/tacktest/soccer.svg') }}"></div><span>Soccer</span>
                    </a>
                </div>
                <div class="col-4 col-md-3 col-lg-2 col-xl-2 mb-4">
                    <a href="#a" class="box">
                        <div><img class="img-fluid" alt="" src="{{asset('public/uploads/icons/tacktest/ms.svg') }}"></div><span>Manipulative Skills</span>
                    </a>
                </div>
                <div class="col-4 col-md-3 col-lg-2 col-xl-2 mb-4">
                    <a href="#a" class="box">
                        <div><img class="img-fluid" alt="" src="{{asset('public/uploads/icons/tacktest/bms.svg') }}"></div><span>Body Management Skills</span>
                    </a>
                </div>
                <div class="col-4 col-md-3 col-lg-2 col-xl-2 mb-4">
                    <a href="#a" class="box">
                        <div><img class="img-fluid" alt="" src="{{asset('public/uploads/icons/tacktest/power.svg') }}"></div><span>Manipulative Skills</span>
                    </a>
                </div>
                <div class="col-4 col-md-3 col-lg-2 col-xl-2 mb-4">
                    <a href="#a" class="box">
                        <div><img class="img-fluid" alt="" src="{{asset('public/uploads/icons/tacktest/power.svg') }}"></div><span>Manipulative Skills</span>
                    </a>
                </div>
                <div class="col-4 col-md-3 col-lg-2 col-xl-2 mb-4">
                    <a href="#a" class="box">
                        <div><img class="img-fluid" alt="" src="{{asset('public/uploads/icons/tacktest/power.svg') }}"></div><span>Manipulative Skills</span>
                    </a>
                </div>


            </div>
        </div>
    </div>
</div>
</div>


@endsection