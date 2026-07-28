@extends('assessor.cwsn.index')
@section('cwsnform')

<form class="row" method="POST" name="savePushUpRecord" id="save_push_up_id" action="">
    {{method_field('post')}}
    @csrf     
    
    <input type="hidden" name="skillReportId" value="{{ $skillReportId }}">
    <input type="hidden" name="TestTypeMasterID" value="{{ $TestTypeMasterID }}">
    <input type="hidden" id="SchoolId" name="SchoolId" value="{{ $SchoolId }}">
    <input type="hidden" id="selected_student_id" name="student_id">
    
    <div class="col-12">
        <div class="form mb-4">
            <h3 class="mb-3 mt-4 text-center">{{ $title }} Score</h3>  
            <div class="input-group mb-3 text-center">
                <span class="form-control single-input">
                    <label for="pushUpCount" class="form-label">Counts</label>
                    <input type="text" name="total_push_up" class="form-control form-control-lg text-center" id="pushUpCount" placeholder="00">
                </span>
            </div>
            <div id="timer" class="mt-0 mb-3 text-center">00:00:00</div>
            
            <div class="actions"><a  id="startPauseBtn" href="#a" class="btn btn-success py-2 w-100 d-flex justify-content-center" style="gap: 10px;"><i class="bi bi-stopwatch"></i><span>Start Timer</span></a></div>
    
    </div>
    </div> 
    @php  $id = "pushups";  @endphp
    <x-reset-submit-btn :id="$id"/>

</form>

<script>
$(function () {

    let startTime = 0;
    let elapsed = 0;
    let timerInterval = null;
    let running = false;

    const display        = document.getElementById("timer");
    const pushUpInput    = document.getElementById("pushUpCount");
    const startPauseBtn  = document.getElementById("startPauseBtn");

    updateTimerDisplay(0);

    function updateTimer() {
        const currentTime = Date.now() - startTime + elapsed;
        updateTimerDisplay(currentTime);
    }

    function updateTimerDisplay(time) {

        const minutes = String(Math.floor(time / 60000)).padStart(2, "0");
        const seconds = String(Math.floor((time % 60000) / 1000)).padStart(2, "0");
        const centiseconds = String(Math.floor((time % 1000) / 10)).padStart(2, "0");

        display.textContent = `${minutes}:${seconds}:${centiseconds}`;
    }

    startPauseBtn.addEventListener("click", function () {

        if (!running) {
            startTime = Date.now();
            timerInterval = setInterval(updateTimer, 10);
            startPauseBtn.textContent = "Pause Timer";
            running = true;
        } else {
            clearInterval(timerInterval);
            elapsed += Date.now() - startTime;
            startPauseBtn.textContent = "Resume Timer";
            running = false;
        }

    });

    // Allow only numbers (max 3 digits)
    pushUpInput.addEventListener("input", function () {
        this.value = this.value.replace(/\D/g, "").slice(0, 3);
    });

    $("#save_push_up_id").on("submit", function (e) {

        e.preventDefault();

        const studentId = $("#selected_student_id").val();
        const pushUps = pushUpInput.value;

        if (!studentId) {
            handleResponseMessages(
                "warning",
                "Select Student",
                "Please select the student"
            );
            return;
        }

        if (!pushUps) {
            handleResponseMessages(
                "warning",
                "Push-up Count",
                "Please enter the push-up count"
            );
            return;
        }

        Swal.fire({
            title: "Confirm Submission",
            text: `You completed ${pushUps} push-ups in ${display.textContent}.`,
            icon: "question",
            showCancelButton: true,
            confirmButtonText: "Yes, Submit",
            cancelButtonText: "Cancel"

        }).then((result) => {

            if (!result.isConfirmed) return;

            submitLoader();

            $.ajax({

                url: '{{ route("push.up.record.submit") }}',

                type: "POST",

                data: $("#save_push_up_id").serialize(),

                success: function (response) {

                    clearInterval(timerInterval);

                    running = false;

                    Swal.close();

                    $("#save_push_up_id")[0].reset();

                    updateTimerDisplay(0);

                    elapsed = 0;

                    startPauseBtn.textContent = "Start Timer";

                    handleResponseMessages(
                        "success",
                        "",
                        response.message,
                        {
                            confirmText: "OK",
                            onConfirm: function () {
                                location.reload();
                            }
                        }
                    );

                },

                error: function (xhr) {

                    Swal.close();

                    let message = "Something went wrong.";

                    if (xhr.responseJSON) {

                        if (xhr.responseJSON.message) {
                            message = xhr.responseJSON.message;
                        }

                        if (xhr.responseJSON.errors) {
                            message = Object.values(xhr.responseJSON.errors)
                                .flat()
                                .join("<br>");
                        }
                    }

                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        html: message
                    });

                }

            });

        });

    });

});
</script>
@endsection