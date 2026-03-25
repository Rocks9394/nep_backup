@extends('layouts.icsce-master-app')
@section('title', 'Goforfit | ' . $title)
@section('content')
<style>
    .hide{
        pointer-events: none;   
        opacity: 0.6;    
        cursor: not-allowed;
    }
</style>
<div class="all-chaptr-cards">
    <div class="container">
        <div class="t-mrg2 mb-5 pb-5">
            <div class="row">
                <div class="col-12">
                    <div class="heading-rw mt-0 mt-md-1 mb-0 p-0">
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

                    
                        <h1 class="ml-md-4 mb-0">{{$title}}</h1> 
                    </div>
                </div>
            </div>

            {{-- get student list componet --}}

            @php
            $type = "fitnessTest";
            @endphp

            <x-get-student-list :classes="$classes" :type="$type" :title="$title"  />
            
            
            <form class="row" method="POST" name="savePlateTappingRecord" id="save_hand-toss" action="">
                {{method_field('post')}}
                @csrf
                    
            <input type="hidden" name="skillReportId" value="{{ $skillReportId }}">
            <input type="hidden" name="TestTypeMasterID" value="{{ $TestTypeMasterID }}">
            <input type="hidden" id="SchoolId" name="SchoolId" value="{{ $SchoolId }}">
            <input type="hidden" id="selected_student_id" name="student_id">
            <input type="hidden" id="total_milisecond_id" name="total_miliseconds">
        
            <h2 class="mb-3 mt-4 text-center">{{$title}} Score</h2>
        
            {{-- footer for submit and reset button --}}
            @php
                $id = "plateTapping";
            @endphp
            <x-reset-submit-btn :id="$id"/>
            {{-- footer close --}}	
        </form>	
            
        </div>
    </div>
</div>

@endsection