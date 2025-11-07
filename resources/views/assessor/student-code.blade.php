@extends('layouts.icsce-master-app')
@section('title', 'Goforfit | ' . $title)
@section('content')

<div class="container">
    <div class="t-mrg">
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
               
                    <h1 class="h6 px-2 px-lg-0 mr-0">Agility</h1>
               
                </div>
            </div>
        </div>
        
        <div class="row mt-4 mt-lg-5">
            <div class="col-12 text-left my-2">
                
                <h2 class="h2 mb-3 black">Illinois Circuit</h2>
            </div>
                        
        </div>
        <div class="row">
        <div class="col-12">
                <div class="form mt-0">
                    <label for="exampleDataList" class="form-label">Enter Student Code</label>
                    <div class="input-group mb-3">
                        <input
                            class="form-control form-control-lg"
                            list="datalistOptions"
                            id="exampleDataList"
                            placeholder="Type to search...">
                        <datalist id="datalistOptions">
                            <option value="00001">
                            <option value="00002">
                            <option value="00003">
                            <option value="00004">
                            <option value="00005">
                        </datalist>
                        <a href="{{ url('assessor-app-enter-test')}}" class="btn btn-lg btn-primary action-btn" id="button-addon2">Go</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>



@endsection