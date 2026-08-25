@extends('assessor.cwsn.index')

@section('cwsnform')

@push('cwsn-style')
<style>
    .all-chaptr-cards .card {
        min-height: 0px !important;
    }
</style>
@endpush

<h2 class="mb-4 text-center">{{ $title }} Score</h2>

<form class="form row" method="POST" name="{{ $TestTypeId }}" id="{{ $TestTypeId }}" action="javascript:void(0);">
    {{ method_field('POST') }}
    @csrf     
    
    <input type="hidden" name="skillReportId" value="{{ $skillReportId }}">
    <input type="hidden" name="TestTypeMasterID" value="{{ $TestTypeMasterID }}">
    <input type="hidden" id="SchoolId" name="SchoolId" value="{{ $SchoolId }}">
    <input type="hidden" id="selected_student_id" name="student_id">

    <!-- Hidden input fields to manage state submission -->
    <input type="hidden" name="assessment_result" id="assessment_result" value="">
    <input type="hidden" name="heart_rate_status" id="heart_rate_status" value="">


    <!-- 2. COUNTDOWN TIMER ASSEMBLY -->
    <div class="card border-0 bg-light p-3 mb-0 text-center shadow-sm" style="border-radius: 12px;">
        <div class="row">
            <div class="col-12 col-md-6 mb-3">
                <div class="card border-0 shadow-sm" style="border-radius: 12px;">
                    <div class="card-body text-center">
                        <h4 class="font-weight-bold text-uppercase mb-2" style="font-size: 1.1rem;">Time Constraint (Within 60s)</h4>
                        <div class="btn-group w-100 shoulder-toggle">
                            <button type="button" id="btn_outcome_pass" class="btn btn-outline-success font-weight-bold w-50" style="border-top-left-radius: 20px; border-bottom-left-radius: 20px;"> <span>Passed</span>
                            </button>
                            <button type="button" id="btn_outcome_fail" class="btn btn-outline-danger w-50 fw-bold py-2.5 d-flex align-items-center justify-content-center gap-2" style="border-top-right-radius: 20px; border-bottom-right-radius: 20px;"> <span>Failed</span>
                            </button>             
                        </div>
                    </div>
                </div>
            </div>
                    
            <!-- HEART RATE INTENSITY CARD -->
            <div class="col-12 col-md-6 mb-3">
                    <div class="card border-0 shadow-sm" style="border-radius: 12px;">
                        <div class="card-body text-center">
                            <h4 class="font-weight-bold text-uppercase mb-2" style="font-size: 1.1rem;">Heart Rate Intensity</h4> 
                            <div class="btn-group w-100 shoulder-toggle">
                                <button type="button" id="btn_hr_acceptable" class="btn btn-outline-success font-weight-bold w-50" style="border-top-left-radius: 20px; border-bottom-left-radius: 20px;"> <span>Acceptable</span>
                                </button>
                                <button type="button" id="btn_hr_unacceptable" class="btn btn-outline-danger w-50 fw-bold py-2.5 d-flex align-items-center justify-content-center gap-2" style="border-top-right-radius: 20px; border-bottom-right-radius: 20px;">
                                    <span>UnAcceptable</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="stopwatch_display" class="mt-0 mb-3 text-center" style="font-family: monospace; font-size: 1.5rem;">60:00</div>    
             <div class="actions px-2">
                <button id="stopwatch_btn" data-state="start" class="btn btn-success py-3 mx-auto w-100 d-flex justify-content-center align-items-center fw-bold gap-2" style="border-radius: 12px;">
                    <i class="bi bi-play-fill"></i>
                    <span>Start Timer</span>
                </button>
            </div>
         </div>
    </div>

    <!-- 3. ACTION LAYER -->
    <div>
        <footer class="container-fluid position-fixed bg-white p-0" style="bottom: 0; left: 0; right: 0; z-index: 100; border-top: 1px solid #e9ecef;">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="action-bar py-3 p-0 d-flex justify-content-between">
                            <button type="reset" id="reset_{{$TestTypeId}}" class="btn py-2 px-5 btn-outline-secondary">Reset</button>  
                            <button type="submit" id="submit_{{$TestTypeId}}" class="btn py-2 px-5 btn-primary">Save Result</button>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>

</form>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const formId = @json($TestTypeId);
    const hiddenResult = document.getElementById('assessment_result');
    const hiddenHr = document.getElementById('heart_rate_status');
    
    // Explicit selection elements
    const btnOutcomePass = document.getElementById('btn_outcome_pass');
    const btnOutcomeFail = document.getElementById('btn_outcome_fail');
    const btnHrAcceptable = document.getElementById('btn_hr_acceptable');
    const btnHrUnacceptable = document.getElementById('btn_hr_unacceptable');
    
    const timerBtn = document.getElementById('stopwatch_btn');
    const timerDisplay = document.getElementById('stopwatch_display');

    let timerInterval = null;
    let startTime = 0;
    let elapsedMs = 0;
    const TOTAL_LIMIT_MS = 60000; 

    // --- Direct State Machine UI Handlers ---
    function setOutcomeState(isPassed) {

        hiddenResult.value = isPassed ? "1" : "0";
        if (isPassed) {
            btnOutcomePass.className = "btn btn-success w-50 fw-bold py-2.5 d-flex align-items-center justify-content-center gap-2";
            btnOutcomeFail.className = "btn btn-outline-danger w-50 fw-bold py-2.5 d-flex align-items-center justify-content-center gap-2";
        } else {
            btnOutcomePass.className = "btn btn-outline-success w-50 fw-bold py-2.5 d-flex align-items-center justify-content-center gap-2";
            btnOutcomeFail.className = "btn btn-danger w-50 fw-bold py-2.5 d-flex align-items-center justify-content-center gap-2";
        }
    }

    function setHeartRateState(isAcceptable) {
        hiddenHr.value = isAcceptable ? "1" : "0";
        if (isAcceptable) {
            btnHrAcceptable.className = "btn btn-success w-50 fw-bold py-2.5 d-flex align-items-center justify-content-center gap-2";
            btnHrUnacceptable.className = "btn btn-outline-danger w-50 fw-bold py-2.5 d-flex align-items-center justify-content-center gap-2";
        } else {

            btnHrAcceptable.className = "btn btn-outline-success w-50 fw-bold py-2.5 d-flex align-items-center justify-content-center gap-2";
            btnHrUnacceptable.className = "btn btn-danger w-50 fw-bold py-2.5 d-flex align-items-center justify-content-center gap-2";
        }
    }

    function clearSelectionStates() {
        hiddenResult.value = "";
        hiddenHr.value = "";
        
        btnOutcomePass.className = "btn btn-outline-success w-50 fw-bold py-2.5 d-flex align-items-center justify-content-center gap-2";
        btnOutcomeFail.className = "btn btn-outline-danger w-50 fw-bold py-2.5 d-flex align-items-center justify-content-center gap-2";
        
        btnHrAcceptable.className = "btn btn-outline-success w-50 fw-bold py-2.5 d-flex align-items-center justify-content-center gap-2";
        btnHrUnacceptable.className = "btn btn-outline-danger w-50 fw-bold py-2.5 d-flex align-items-center justify-content-center gap-2";
    }

    // Direct Event Wireframe Bindings
    btnOutcomePass.addEventListener('click', () => setOutcomeState(true));
    btnOutcomeFail.addEventListener('click', () => setOutcomeState(false));
    btnHrAcceptable.addEventListener('click', () => setHeartRateState(true));
    btnHrUnacceptable.addEventListener('click', () => setHeartRateState(false));

    // --- Time Parser Logic ---
    function formatRemainingTime(msRemaining) {
        if (msRemaining <= 0) return "00:00";
        let totalSeconds = msRemaining / 1000;
        let seconds = Math.floor(totalSeconds);
        let hundredths = Math.floor((totalSeconds % 1) * 100);
        
        let displaySecs = seconds < 10 ? '0' + seconds : seconds;
        let displayMs = hundredths < 10 ? '0' + hundredths : hundredths;
        
        return displaySecs + ':' + displayMs;
    }

    function resetTimerUI() {

        clearInterval(timerInterval);
        elapsedMs = 0;
        timerDisplay.innerText = "60:00";
        timerDisplay.className = "mt-0 mb-3 text-center";
        timerBtn.setAttribute('data-state', 'start');
        timerBtn.querySelector('span').innerText = "Start Timer";
        timerBtn.querySelector('i').className = "bi bi-play-fill";
        timerBtn.className = "btn btn-success py-3 mx-auto w-100 d-flex justify-content-center align-items-center fw-bold gap-2";
    }

    timerBtn.addEventListener('click', function(e) {
        e.preventDefault();
        const currentState = timerBtn.getAttribute('data-state');
        
        if (currentState === 'start') {
            timerBtn.setAttribute('data-state', 'running');
            timerBtn.querySelector('span').innerText = "Stop Timer";
            timerBtn.querySelector('i').className = "bi bi-stop-fill";
            timerBtn.className = "btn btn-success py-3 mx-auto w-100 d-flex justify-content-center align-items-center fw-bold text-white gap-2";
            
            startTime = performance.now() - elapsedMs;
            
            timerInterval = setInterval(() => {
                elapsedMs = performance.now() - startTime;
                let msRemaining = TOTAL_LIMIT_MS - elapsedMs;
                
                if (msRemaining <= 10000) {
                    timerDisplay.className = "my-3 text-center fw-bold text-danger";
                }
                
                if (msRemaining <= 0) {
                    clearInterval(timerInterval);
                    timerDisplay.innerText = "00:00";
                    timerBtn.setAttribute('data-state', 'reset');
                    timerBtn.querySelector('span').innerText = "Reset Timer";
                    timerBtn.querySelector('i').className = "bi bi-arrow-counterclockwise";
                    timerBtn.className = "btn btn-success py-3 mx-auto w-100 d-flex justify-content-center align-items-center fw-bold gap-2";
                    
                    // Fall back cleanly to absolute countdown deadline
                    setOutcomeState(false);
                } else {
                    timerDisplay.innerText = formatRemainingTime(msRemaining);
                }
            }, 10);
        } 
        else if (currentState === 'running') {
            clearInterval(timerInterval);
            timerBtn.setAttribute('data-state', 'reset');
            timerBtn.querySelector('span').innerText = "Reset Timer";
            timerBtn.querySelector('i').className = "bi bi-arrow-counterclockwise";
            timerBtn.className = "btn btn-success py-3 mx-auto w-100 d-flex justify-content-center align-items-center fw-bold gap-2";
        } 
        else if (currentState === 'reset') {
            resetTimerUI();
            clearSelectionStates();
        }
    });

    document.getElementById("reset_{{$TestTypeId}}").addEventListener('click', function() {
        resetTimerUI();
        clearSelectionStates();
    });


    $(`#${formId}`).submit(function(e) {
        e.preventDefault();

        const studentId = document.getElementById('selected_student_id').value;
        const assessment = document.getElementById('assessment_result').value;
        const heart_rate = document.getElementById('heart_rate_status').value;

        if (!studentId) {
            handleResponseMessages( 'warning',  'Select Student', 'Please select the student');
            return;
        }

        if (assessment === '' || heart_rate === '') {
            handleResponseMessages('info', 'Incomplete Form', 'Please record both Time Constraint and Heart Rate Intensity before saving.');
            return;
        }

        let route = '{{ route("cwsn.types.submit") }}';
        let formData =  $(this).serialize();
        SubmitForm(formId, formData, route);
        document.getElementById('live_status_badge').textContent = `Level 1, Shuttle 0`;
    });

});





</script>


@endsection