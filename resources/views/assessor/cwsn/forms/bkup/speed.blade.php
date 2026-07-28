@extends('assessor.cwsn.index')
@section('cwsnform')



<form action="{{-- route('fitness-tests.store') --}}" method="POST">
    @csrf

	<input type="hidden" name="skillReportId" value="{{ $skillReportId }}"  id="skillReportId"> 
	<input type="hidden" name="TestTypeMasterID" value="{{ $TestTypeMasterID }}">
	<input type="hidden" name="SchoolId" id="SchoolId" value="{{ $SchoolId }}">


	<!-- Duration Inputs -->
    <div class="form-row my-2">
        <div class="col-12">
            <div class="lanes">
                <h3 class="mb-2 mt-1 text-left"><strong>Select no of athletes to track</strong></h3>

                <ul id="select_lane">
                    <li><a href="javascript:void(0)" data-lane-no="1">1</a></li>
                    <li><a href="javascript:void(0)" data-lane-no="2">2</a></li>
                    <li><a href="javascript:void(0)" data-lane-no="3">3</a></li>
                    <li><a href="javascript:void(0)" data-lane-no="4">4</a></li>
                    <li><a href="javascript:void(0)" data-lane-no="5">5</a></li>
                    <li><a href="javascript:void(0)" data-lane-no="6">6</a></li>
                    <li><a href="javascript:void(0)" data-lane-no="7">7</a></li>
                    <li><a href="javascript:void(0)" data-lane-no="8">8</a></li>
                </ul>

            </div>
        </div>

        <div class="col-12">
            <div class="form">
                <h2 class="mb-2 mt-4 text-center">{{$title}} Score</h2>
                <div class="input-group input-group__2 mb-3">
                    <span class="form-control">
                        <label for="minuteId" class="form-label">min</label>
                        <input type="number" name="total_min" class="form-control form-control-lg" id="minuteId"
                            placeholder="00" readonly>
                    </span>
                    <span class="form-control">
                        <label for="secondId" class="form-label">sec</label>
                        <input type="number" name="total_sec" class="form-control form-control-lg" id="secondId"
                            placeholder="00" readonly>
                    </span>
                    <span class="form-control">
                        <label for="milisecondId" class="form-label">msec</label>
                        <input type="number" name="total_mili" class="form-control form-control-lg"
                            id="milisecondId" placeholder="00" readonly>
                    </span>
                </div>
                <div class="actions">
                    <a href="javascript:void(0)" id="startTimerBtn"
                        class="btn btn-success py-2 w-100 d-flex justify-content-center" style="gap: 10px;">
                        <i class="bi bi-stopwatch"></i><span id="timerLabel">Start Timer</span></a>
                </div>
            </div>
        </div>

        <div class="col-12">

            <div class="rankings mt-3" style="display:none">
                <ul class="list-group" id="laneList">
                    <!-- new items will be appended here -->
                </ul>
            </div>
        </div>
    </div>

    
    <div class="cwsn-adaptive-recommandations">
    	@include('assessor.cwsn.adaptive-recommandation')
    </div>

    @php
        $id = "fmsTest";
    @endphp
    <x-reset-submit-btn :id="$id"/>

</form>

@endsection