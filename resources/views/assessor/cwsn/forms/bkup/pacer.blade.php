@extends('assessor.cwsn.index')
@section('cwsnform')


<style>

    @media only screen and (max-width: 600px) {
        .btn {  min-width: 80px; }
        #laps_completed{
            width: 100px;         }
    }

    @media only screen and (min-width: 600px) {
        .btn { min-width: 170px; }
        #laps_completed{
            width: 140px;
        }
    }

    @media only screen and (min-width: 768px) {
        .btn {  min-width: 170px;}
        #laps_completed{
            width: 140px;
        }
    }

    #laps_completed{ height: 45px !important; font-size: 20px;}

    button.btn.btn-secondary.d-flex.align-items-center.justify-content-center.fw-bold.fs-3.user-select-none {
        border: 1px solid orange;
    }

</style>

<h3 class="mb-4 text-center">Total Completed Laps ({{ $title }})</h3>

<form class="row bg-white mt-4" method="POST" name="fms_types_submit" id="fms_types_submit_id" action="">
    {{ method_field('post') }}
    @csrf

    <input type="hidden" name="skillReportId" value="{{ $skillReportId }}" id="skillReportId">
    <input type="hidden" name="TestTypeMasterID" value="{{ $TestTypeMasterID }}">
    <input type="hidden" name="SchoolId" id="SchoolId" value="{{ $SchoolId }}">
    <input type="hidden" name="student_id" id="selected_student_id">
    <input type="hidden" name="pwd_category_id" value="{{ $pwd_category_id ?? '' }}">

    <!-- Total Laps Counter Component -->
    <div class="col-12 p-5 d-flex flex-column align-items-center justify-content-center text-center">
        
        
        <div class="counter-container d-flex justify-content-center align-items-center w-100">
            <div class="d-flex align-items-center justify-content-center" style="max-width: 280px; width: 100%;">
                
                <button type="button" onclick="changeLap(-1)" class="btn btn-secondary d-flex align-items-center justify-content-center fw-bold fs-3 user-select-none" style="width: 55px; height: 45px; font-size: 20px;">-</button>
            
                <input type="number" id="laps_completed" name="laps_completed" value="0" min="0" class="form-control text-center mx-3 fw-bolder fs-3 bg-light" readonly>
            
                <button type="button" onclick="changeLap(1)" class="btn btn-primary d-flex align-items-center justify-content-center fw-bold fs-3 user-select-none" style="width: 55px; height: 45px; font-size: 20px;" >+</button>
                
            </div>
        </div>
    </div>

   

    @php
        $id = "fmsTest";
    @endphp
    <x-reset-submit-btn :id="$id"/>
</form>

<script>
const pacerMatrix = {
    1: 7,  2: 8,  3: 8,  4: 9,  5: 9,  6: 10, 7: 10, 8: 11,
    9: 11, 10: 11, 11: 12, 12: 12, 13: 13, 14: 13, 15: 14, 
    16: 14, 17: 15, 18: 15, 19: 16, 20: 16, 21: 16
};

function changeLap(val) {
    const lapInput = document.getElementById('laps_completed');
    let current = parseInt(lapInput.value) || 0;
    current += val;

    if (current >= 0) {
        lapInput.value = current;
        updateLevelAndShuttle(current);
    }
}

function updateLevelAndShuttle(totalLaps) {
    let calculatedLevel = 1;
    let calculatedShuttle = 0;
    let accumulatedLaps = 0;

    if (totalLaps > 0) {
        let matched = false;
        for (let level in pacerMatrix) {
            let shuttlesInLevel = pacerMatrix[level];
            if (totalLaps <= (accumulatedLaps + shuttlesInLevel)) {
                calculatedLevel = parseInt(level);
                calculatedShuttle = totalLaps - accumulatedLaps;
                matched = true;
                break;
            }
            accumulatedLaps += shuttlesInLevel;
        }
        
        // Edge Catchment: If a runner finishes past the end of level 21 data array
        if (!matched) {
            calculatedLevel = 21;
            calculatedShuttle = totalLaps - accumulatedLaps + pacerMatrix[21];
        }
    } else {
        calculatedLevel = 1;
        calculatedShuttle = 0;
    }

    document.getElementById('final_level').value = calculatedLevel;
    document.getElementById('final_shuttle').value = calculatedShuttle;
}

function toggleGuideInput(checkbox) {
    const container = document.getElementById('guide_runner_container');
    const input = document.getElementById('guide_runner_name');
    
    if (checkbox.checked) {
        container.classList.remove('d-none');
        input.required = true;
        input.focus();
    } else {
        container.classList.add('d-none');
        input.required = false;
        input.value = '';
    }
}
</script>

@endsection