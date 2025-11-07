@extends('layouts.icsce-master-app')
@section('title', 'Goforfit | ' . $title)
@section('content')


<div class="container">
    <div class="t-mrg2 mb-5 pb-5">
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

        <div class="row mt-0 mt-md-4">
            <div class="col-12 text-left my-2">
                 <h1 class="h6">{{ $title }}</h1> 
                
            </div>

        </div>
        <div class="row my-2">
            <!-- User Deatils -->
            <div class="col-12">
                <div class="card alert alert-warning" style="box-shadow: none;">
                    <div class="student-details p-0">
                        <div class="__details">
                            <p><span class="h6">Ritesh Kumar</span>, </p>
                            <p><span>Class:</span> VI B, 5684725
                            </p>
                        </div>
                        <a href="{{ route('scan') }}" class="btn btn-outline-secondary px-3 ml-md-3 ml-0 d-flex justify-content-center align-items-center border-btn" style="gap: 5px"><span class="d-flex"><i class="bi bi-qr-code"></i></span>
                            <span>Scan</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="list-group mb-4">
                    <label class="list-group-item">
                        <input class="form-check-input me-1" type="checkbox" value="">
                        First checkbox
                    </label>
                    <label class="list-group-item">
                        <input class="form-check-input me-1" type="checkbox" value="">
                        Second checkbox
                    </label>
                    <label class="list-group-item">
                        <input class="form-check-input me-1" type="checkbox" value="">
                        Third checkbox
                    </label>
                    <label class="list-group-item">
                        <input class="form-check-input me-1" type="checkbox" value="">
                        Fourth checkbox
                    </label>
                    <label class="list-group-item">
                        <input class="form-check-input me-1" type="checkbox" value="">
                        Fifth checkbox
                    </label>
                </div>
            </div>

        </div>
        <footer class="container-fluid position-fixed bg-white p-0" style="bottom: 0; left: 0; right: 0; z-index: 100;">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="action-bar py-3 p-0 actions">
                            <a href="#a" onclick="history.back()" class="btn py-2 px-5 btn-outline-secondary " id="button-addon2">Reset</a>
                            <a href="#a" onclick="history.back()" class="btn py-2 px-5 btn-primary" id="button-addon2">Save</a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>

@endsection