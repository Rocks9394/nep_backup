@extends('assessor.cwsn.index')
@section('cwsnform')

<form class="row" method="POST" name="{{ $TestTypeId }}" id="{{ $TestTypeId }}" action="javascript:void(0);">
    {{method_field('post')}}
    @csrf     
    
    <input type="hidden" name="skillReportId" value="{{ $skillReportId }}">
    <input type="hidden" name="TestTypeMasterID" value="{{ $TestTypeMasterID }}">
    <input type="hidden" id="SchoolId" name="SchoolId" value="{{ $SchoolId }}">
    <input type="hidden" id="selected_student_id" name="student_id">
    
    <div class="col-12">
        <div class="row form mb-4">
            <h3 class="mb-3 text-center">{{ $title }} Score</h3>  
            <div class="input-group mb-3 text-center">
                <span class="form-control single-input">
                    <label for="pushUpCount" class="form-label">Counts</label>
                    <input type="text" name="total_push_up" class="form-control form-control-lg text-center" id="pushUpCount" placeholder="00">
                </span>
            </div>


            @if($TestTypeId != 1021) 
            <div id="timer" class="mt-0 mb-3 text-center" style="font-family: monospace; font-size: 1.5rem;">00:00:00</div>
            <div class="actions">
                <a id="startPauseBtn" href="#a" class="btn btn-success py-2 w-100 d-flex justify-content-center" style="gap: 10px;"><i class="bi bi-stopwatch"></i><span>Start Timer</span>
                </a>
            </div>
            @endif 
        </div>
    </div> 
    @php  $id = "pushups";  @endphp
    <x-reset-submit-btn :id="$TestTypeId"/>

</form>


<script>
    
let startTime = 0;
let elapsed = 0;
let timerInterval = null;
let running = false;

const display = document.getElementById("timer");
const pushUpInput = document.getElementById("pushUpCount");
const startPauseBtn = document.getElementById("startPauseBtn");

function updateTimer() {
    if (!display) return;
    const now = Date.now();
    let time = now - startTime + elapsed;

    let minutes = Math.floor(time / 60000);
    let seconds = Math.floor((time % 60000) / 1000);
    let milliseconds = Math.floor((time % 1000) / 10);

    minutes = minutes < 10 ? '0' + minutes : minutes;
    seconds = seconds < 10 ? '0' + seconds : seconds;
    milliseconds = milliseconds < 10 ? '0' + milliseconds : milliseconds;

    display.innerHTML = `${minutes}:${seconds}:${milliseconds}`;
}

if (startPauseBtn) {
    startPauseBtn.addEventListener("click", function () {

        if (!running) {
            // Start or Resume
            startTime = Date.now();
            timerInterval = setInterval(updateTimer, 10);
            startPauseBtn.innerHTML = '<i class="bi bi-stopwatch"></i><span>Pause Timer</span>';
            running = true;
        } else {
            // Pause

            console.log('ppassssss')
            clearInterval(timerInterval);
            elapsed += Date.now() - startTime;
            startPauseBtn.innerHTML = '<i class="bi bi-stopwatch"></i><span>Start Timer</span>';
            running = false;
        }
    });   
}

if (pushUpInput) {
    pushUpInput.addEventListener("input", function (e) {

        let value = e.target.value;
        value = value.replace(/[^0-9]/g, ''); 
        let match = value.match(/^(\d{0,3})?$/);
        if (match) {
            value = match[0];
        } else {
            value = value.slice(0, -1); 
        }
        
        if (value && parseFloat(value) < 0) {
            value = '';
        }
        e.target.value = value;
    });
}

$(document).ready(function() {

    const formName = @json($TestTypeId);

    $(`#${formName}`).submit(function(e) {
        e.preventDefault();

        const studentId = document.getElementById('selected_student_id').value;
        const pushUps = pushUpInput.value;

        if(!studentId){

            handleResponseMessages( 'warning',  'Select Student', 'Please select the student');
            return;
        }
        
        if (pushUps === "") {
            handleResponseMessages( 'warning',  'Push up empty', 'Please enter the push ups count');
            return;
        }

        let route = '{{ route("cwsn.types.submit") }}';
        let formData =  $(this).serialize();
        SubmitForm(formName, formData, route);
    });
});

</script>
@endsection