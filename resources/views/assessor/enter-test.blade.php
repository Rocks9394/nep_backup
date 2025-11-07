@extends('layouts.icsce-master-app')
@section('title', 'Goforfit | ' . $title)
@section('content')

<div class="container">
    <div class="t-mrg mt-3 mb-4">
        <div class="row">
            <div class="col-12">

                @if(auth()->guard('web')->check())

                <a href="javascript:history.back()" class="back-button">
                    <span class="arrow"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5" />
                        </svg></span> </a>

                @elseif(auth()->guard('sstudent')->check())

                <a href="javascript:history.back()" class="back-button">
                    <span class="arrow"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5" />
                        </svg></span> </a>
                @endif

                <div class="heading-rw mt-2 mb-0 pt-1">
                    <h1 class="px-2 px-lg-0 mr-0">{{$title}}</h1>
               
                    
                </div>
            </div>
        </div>

        <div class="row mt-2 mt-lg-4">
            <div class="col-12 text-left my-2">
                
                <h2 class="h2 mb-3 black">Illinois Circuit</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="student-details">
                        <div class="d-none d-md-block">
                        <img alt="" src="{{asset('public/uploads/avatar.svg') }}" height="62" alt="avatar">
                        </div>
                        <div class="__details">
                            <h4 class="h5">Ramesh Kumar</h4>
                            <p>
                                <span>Class:</span> VI B, 5684725
                            </p>
                            <p>
                                <span>School:</span> Rabindranath World School, Sector 65, Gurgaon
                            </p>
                        </div>
                    </div>
                    <a href="#a" class="btn btn-outline-primary scan mt-4">Scan</a>
                </div>
            </div>
            <div class="col-12">
                <div class="form my-5">
                    <label for="exampleDataList" class="form-label mb-3">Enter Active Straight Leg Raise Test Score</label>
                    <div class="input-group input-group__3 input__3 mb-3">
                        <span class="__bx">
                            <label for="exampleDataList" class="form-label">Meter</label>
                            <input
                                type="text"
                                class="form-control form-control-lg"
                                id="exampleFormControlInput1"
                                placeholder="">
                        </span>
                        <span class="__bx">
                            <label for="exampleDataList" class="form-label">Cms.</label>
                            <input
                                type="text"
                                class="form-control form-control-lg"
                                id="exampleFormControlInput1"
                                placeholder="">
                        </span>
                        <span class="__bx">
                            <label for="exampleDataList" class="form-label">mm</label>
                            <input
                                type="text"
                                class="form-control form-control-lg"
                                id="exampleFormControlInput1"
                                placeholder="">
                        </span>
                    </div>
                    <div class="d-flex justify-content-between gx-3 actions">
                        <a href="#a" class="btn btn-lg py-2 btn-outline-secondary w-50">Cancel</a>
                        <a href="#a" class="btn btn-lg py-2 btn-primary w-50">Save</a>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="form my-5">
                    <label for="exampleDataList" class="form-label mb-3">Enter Active Straight Leg Raise Test Score</label>
                    <div class="input-group input-group__2 input__2 mb-3">
                        <span class="col __bx p-0">
                            <label for="exampleDataList" class="form-label">Cms.</label>
                            <input
                                type="text"
                                class="form-control form-control-lg"
                                id="exampleFormControlInput1"
                                placeholder="">
                        </span>
                        <span class="col __bx p-0">
                            <label for="exampleDataList" class="form-label">mm</label>
                            <input
                                type="text"
                                class="form-control form-control-lg"
                                id="exampleFormControlInput1"
                                placeholder="">
                        </span>
                    </div>
                    <div class="d-flex justify-content-between gx-3 actions">
                        <a href="#a" class="btn btn-lg py-2 btn-outline-secondary w-50">Cancel</a>
                        <a href="#a" class="btn btn-lg py-2 btn-primary w-50">Save</a>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="form my-5">
                    <label for="exampleDataList" class="form-label mb-3">Enter Active Straight Leg Raise Test Score</label>
                    <div class="input-group input-group__2 input__1 mb-3">
                        
                        <span class="col __bx p-0">
                            <label for="exampleDataList" class="form-label">mm</label>
                            <input
                                type="text"
                                class="form-control form-control-lg"
                                id="exampleFormControlInput1"
                                placeholder="">
                        </span>
                    </div>
                    <div class="d-flex justify-content-between gx-3 actions">
                        <a href="#a" class="btn btn-lg py-2 btn-outline-secondary w-50">Cancel</a>
                        <a href="#a" class="btn btn-lg py-2 btn-primary w-50">Save</a>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <a href="#a" class="btn py-3 btn-outline-primary w-100 btn-add">Add Child</a>
            </div>
        </div>        
    </div>
</div>
</div>

@endsection