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


 <form class="row" method="POST" name="saveFlamingoRecord" id="save_partial_curl_up_record_id" action="">
        {{method_field('post')}}
        @csrf
        
        <input type="hidden" name="skillReportId" value="{{ $skillReportId }}">
        <input type="hidden" name="TestTypeMasterID" value="{{ $TestTypeMasterID }}">
        <input type="hidden" id="SchoolId" name="SchoolId" value="{{ $SchoolId }}">
        <input type="hidden" id="selected_student_id" name="student_id">
        
        <div class="col-12"> 
            <div class="form mb-4">
                <h2 class="mb-3 mt-4 text-center">Enter {{ $title }} Score</h2>
                <div class="input-group mb-3 text-center">
                    <span class="form-control single-input">
                        <label for="count_total_number_id" class="form-label">Counts</label>
                        <input type="text" name="count_total_number" class="form-control form-control-lg text-center" id="count_total_number_id" placeholder="--">
                    </span>
                </div>
                <div  id="timer" class="mt-0 mb-3 text-center">00:00:00</div>
                <div class="actions"><a href="javascript:void(0)" id="startBtn" class="btn btn-success py-2 w-100 d-flex justify-content-center" style="gap: 10px;"><i class="bi bi-stopwatch"></i><span>Start Timer</span></a></div>
            </div>
        </div>
                

        @php $id = "strength"; @endphp
        <x-reset-submit-btn :id="$id"/>
</form> 



<script>
$(function () {

    const TEST_DURATION = 30000; 

    const saveBtn      = document.getElementById("submit_strength");
    const startBtn     = document.getElementById("startBtn");
    const countInput   = document.getElementById("count_total_number_id");
    const timerDisplay = document.getElementById("timer");

    let timerInterval = null;

    saveBtn.classList.add("hide");
    countInput.disabled = true;
    updateTimerDisplay(TEST_DURATION);
    startBtn.addEventListener("click", startTimer);

    function startTimer() {
        clearInterval(timerInterval);
        startBtn.innerHTML = "Test is Running...";
        startBtn.disabled = true;
        const endTime = Date.now() + TEST_DURATION;

        timerInterval = setInterval(function () {
            const remaining = endTime - Date.now();

            if (remaining <= 0) {
                clearInterval(timerInterval);
                updateTimerDisplay(0);

                countInput.disabled = false;
                countInput.focus();

                startBtn.innerHTML = "Test Completed";
                saveBtn.classList.remove("hide");

                return;
            }
            updateTimerDisplay(remaining);
        }, 10);
    }

    function updateTimerDisplay(ms) {
        const totalSeconds = Math.floor(ms / 1000);
        const minutes = String(Math.floor(totalSeconds / 60)).padStart(2, "0");
        const seconds = String(totalSeconds % 60).padStart(2, "0");
        const millis  = String(ms % 1000).padStart(3, "0");
        timerDisplay.textContent = `${minutes}:${seconds}:${millis}`;
    }


    countInput.addEventListener("input", function () {
        this.value = this.value.replace(/\D/g, "").slice(0, 3);
    });

});
</script>
@endsection