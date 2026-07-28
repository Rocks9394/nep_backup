@extends('assessor.cwsn.index')
@section('cwsnform')

<style>
    .btn-primary.disabled, .btn-primary:disabled {
        color: #fff;
        background-color: #ff8000;
        border-color: #ff8000;
        cursor: not-allowed;
    }

    .btn-theme-primary:disabled {
        background-color: #cccccc !important;
        border-color: #cccccc !important;
        color: #ff8000 !important;
        cursor: not-allowed;
    }

     .btn-theme-primary {
        background-color: #4da3ff !important;
        border-color: #4da3ff !important;
        color: #ffffff !important;
    }
    .btn-theme-primary:hover:not(:disabled) {
        background-color: #378ce6 !important;
        border-color: #378ce6 !important;
    }
    .btn-theme-primary:disabled {
        background-color: #cccccc !important;
        border-color: #cccccc !important;
        color: #666666 !important;
        cursor: not-allowed;
        opacity: 0.65;
    }

    #btn-timer-control.paused {
        background-color: red;
        color: white;
        border: none;
        border-radius: 10px;
    }

</style>

<h2 class="mb-3 text-center">{{ $title }} Score </h2>

<form class="row bg-white mt-4" method="POST" name="seated-pushup" id="save_flamingo_record_id" action="javascript:void(0);">
    {{ method_field('post') }}
    @csrf

    <input type="hidden" name="skillReportId" value="{{ $skillReportId }}" id="skillReportId">
    <input type="hidden" name="TestTypeMasterID" value="{{ $TestTypeMasterID }}">
    <input type="hidden" id="SchoolId" name="SchoolId" value="{{ $SchoolId }}">
    <input type="hidden" id="selected_student_id" name="student_id">
    <input type="hidden" name="score_measurement" id="score_measurement" value="">



    <div class="col-12">
       <div class="form mb-4">  
            <div class="card-body text-center">
                <!-- Centered Digital Timer Display Circle -->
                <div class="d-flex justify-content-center align-items-center">
                    <div class="d-flex flex-column justify-content-center align-items-center text-dark" id="timer-display-box">
                        <span id="stopwatch_display" class="font-weight-bold" style="font-size: 2.4rem; font-family: monospace; line-height: 1;">0.0</span>  

                        <small class="text-uppercase tracking-wider text-muted font-weight-bold m-2" id="timer-status" style="font-size: 0.65rem;">Ready</small>
                    </div>
                </div>

            	<button type="button" id="btn-timer-control" class="btn btn-success w-100 d-flex justify-content-center" style="gap: 8px; border-radius: 8px;">
                    <i class="bi bi-stopwatch"></i><span id="timer-btn-text">Start Timer</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Sticky Bottom Layout Form Controls -->
    <div class="col-12">
        <footer class="container-fluid position-fixed bg-white shadow-lg border-top p-0" style="bottom: 0; left: 0; right: 0; z-index: 100;">
            <div class="container py-3">
                <div class="d-flex justify-content-between align-items-center px-2">
                    <button type="button" id="reset_seatedPushup" class="btn py-2.5 px-5 font-weight-bold btn-outline-secondary" style="border-radius: 8px; min-width: 140px;">Reset</button>   
                    <button type="submit" id="submit_seatedPushup" class="btn py-2.5 px-5 font-weight-bold btn-primary" style="border-radius: 8px; min-width: 140px;" disabled>Save</button>
                </div>
            </div>
        </footer>
    </div>
</form>

<script>
document.addEventListener("DOMContentLoaded", function () {

    const testtype = `{{ $title }}`;

    let animationFrame = null;
    let startTime = null;
    let elapsedTime = 0;
    let isRunning = false;

    const stopwatchDisplay = document.getElementById("stopwatch_display");
    const timerStatus = document.getElementById("timer-status");
    const timerBox = document.getElementById("timer-display-box");
    const btnControl = document.getElementById("btn-timer-control");
    const btnReset = document.getElementById("reset_seatedPushup");
    const btnSubmit = document.getElementById("submit_seatedPushup");
    const hiddenScoreInput = document.getElementById("score_measurement");

    // Force secure initial state values
    if (btnSubmit) {
        btnSubmit.disabled = true;
    }

    btnControl.addEventListener("click", function () {
        if (!isRunning) {
            startTimer();
        } else {
            stopTimer(false, testtype);
        }
    });

    btnReset.addEventListener("click", function (e) {
        e.preventDefault();
        resetTimer();
    });

    function startTimer() {

        isRunning = true;
        startTime = performance.now() - elapsedTime;

        document.getElementById("timer-btn-text").textContent = "Stop";
        btnControl.classList.remove("btn-success");
        btnControl.classList.add("paused");

        timerStatus.innerText = "Running";
        timerBox.style.borderColor = "#28a745"; // Success Green Boundary color

        if (btnSubmit) {
            btnSubmit.disabled = true; // Lock submittals during continuous active tracking runs
            btnSubmit.classList.remove("btn-theme-primary");
            btnSubmit.classList.add("btn-primary");
        }

        updateTimer();
    }

    function updateTimer() {
        if (!isRunning) return;

        elapsedTime = performance.now() - startTime;
        let seconds = elapsedTime / 1000;

        if(testtype == 'Isometric Push-up'){
            let maxtime = 40;

            if (seconds >= 40) {
                seconds = 40.0;
                elapsedTime = 40000;
                stopwatchDisplay.innerText = "40.0";
                hiddenScoreInput.value = "40.0";
                stopTimer(true,testtype);
                return;
            }

        }

        if(testtype == 'Seated Push-up'){
            let maxtime = 40;
            if (seconds >= 20) {
                seconds = 20.0;
                elapsedTime = 20000;
                stopwatchDisplay.innerText = "20.0";
                hiddenScoreInput.value = "20.0";
                stopTimer(true,testtype);
                return;
            }
        }

        stopwatchDisplay.innerText = seconds.toFixed(1);
        hiddenScoreInput.value = seconds.toFixed(1);
        animationFrame = requestAnimationFrame(updateTimer);
    }

    function stopTimer(maxReached = false, testtype) {

        let maxtime = '';
        if(testtype == 'Isometric Push-up'){
          maxtime = 40;
        }

        if(testtype == 'Seated Push-up'){
          maxtime = 20;
        }

        isRunning = false;

        if (animationFrame) {
            cancelAnimationFrame(animationFrame);
            animationFrame = null;
        }

        const finalScore = Math.min(maxtime, elapsedTime / 1000);
        const textScore = finalScore.toFixed(1);


        stopwatchDisplay.innerText = textScore;
        hiddenScoreInput.value = textScore;


        document.getElementById("timer-btn-text").textContent = "Start Timer";
        btnControl.classList.remove("paused");
        btnControl.classList.add("btn-success");
        btnControl.disabled = true;



        if (maxReached) {
            timerStatus.innerText = "Max Reached";
            document.getElementById("timer-btn-text").textContent = "Test Completed!";
            timerBox.style.borderColor = "#ffc107"; 
        } else {
            timerStatus.innerText = "Saved";
            timerBox.style.borderColor = "#dc3545"; 
        }

        if (btnSubmit && finalScore > 0) {
            btnSubmit.disabled = false;

            btnSubmit.classList.remove("btn-theme-primary");
            btnSubmit.classList.add("btn-primary");
        }
    }

    function resetTimer() {
        if (animationFrame) {
            cancelAnimationFrame(animationFrame);
            animationFrame = null;
        }

        isRunning = false;
        elapsedTime = 0;
        startTime = null;

        stopwatchDisplay.innerText = "0.0";
        timerStatus.innerText = "Ready";
        timerBox.style.borderColor = "#4da3ff";

        hiddenScoreInput.value = "";

        btnControl.disabled = false;
        document.getElementById("timer-btn-text").textContent = "Start Timer";
        btnControl.classList.remove("paused");
        btnControl.classList.add("btn-success");

        if (btnSubmit) {
            btnSubmit.disabled = true;

            btnSubmit.classList.remove("btn-theme-primary");
            btnSubmit.classList.add("btn-primary");
        }
    }
});
</script>

@endsection