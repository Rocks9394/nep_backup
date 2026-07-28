@extends('assessor.cwsn.index')
@section('cwsnform')

<style>
	h4.text-uppercase {
    color: #292775 !important;
}

h4.text-uppercase {
    color: #292775 !important;
}
</style>
<h2 class="text-center pb-2">Enter {{ $title }} Score</h2>

<form method="POST" name="saveSitAndReachRecord" id="save_sit_and_reach_record_id" action="{{-- route('sit.and.reach.record.submit') --}}">
    {{ method_field('post') }}
    @csrf
    
    <input type="hidden" name="skillReportId" value="{{ $skillReportId }}" id="skillReportId">
    <input type="hidden" name="TestTypeMasterID" value="{{ $TestTypeMasterID }}">
    <input type="hidden" name="SchoolId" id="SchoolId" value="{{ $SchoolId }}">
    <input type="hidden" name="student_id" id="selected_student_id">

    <input type="hidden" name="score_measurement" id="score_measurement" value="">


	<div class="row">
	    <!-- Right Shoulder Assessment Card -->
	    <div class="col-12 col-md-6 px-2">
	        <div class="card border-0 shadow-sm" style="border-radius: 12px;">
	            <div class="card-body text-center">
	                <h4 class="font-weight-bold text-primary mb-1 text-uppercase" style="font-size: 1.1rem;">Right Arm Stretch</h4>
	                <p class="small text-muted">(Right arm over right shoulder, reaching down)</p>
	                
	                <div class="btn-group btn-group-toggle w-100" data-toggle="buttons">
	                    <label class="btn btn-outline-danger font-weight-bold w-50" style="border-top-left-radius: 20px; border-bottom-left-radius: 20px;">
	                        <input type="radio" name="right_shoulder_status" id="right_fail" value="0" autocomplete="off" onchange="syncShoulderPayload()"> FAIL
	                    </label>
	                    <label class="btn btn-outline-success font-weight-bold w-50" style="border-top-right-radius: 20px; border-bottom-right-radius: 20px;">
	                        <input type="radio" name="right_shoulder_status" id="right_pass" value="1" autocomplete="off" onchange="syncShoulderPayload()"> PASS
	                    </label>
	                </div>
	            </div>
	        </div>
	    </div>

	    <!-- Left Shoulder Assessment Card -->
	    <div class="col-12 col-md-6 px-2">
	        <div class="card border-0 shadow-sm" style="border-radius: 12px;">
	            <div class="card-body text-center">
	                <h4 class="font-weight-bold text-success mb-1 text-uppercase" style="font-size: 1.1rem;">Left Arm Stretch</h4>
	                <p class="small text-muted">(Left arm over left shoulder, reaching down)</p>
	                
	                <div class="btn-group btn-group-toggle w-100" data-toggle="buttons">
	                    <label class="btn btn-outline-danger font-weight-bold w-50" style="border-top-left-radius: 20px; border-bottom-left-radius: 20px;">
	                        <input type="radio" name="left_shoulder_status" id="left_fail" value="0" autocomplete="off" onchange="syncShoulderPayload()"> FAIL
	                    </label>
	                    <label class="btn btn-outline-success font-weight-bold w-50" style="border-top-right-radius: 20px; border-bottom-right-radius: 20px;">
	                        <input type="radio" name="left_shoulder_status" id="left_pass" value="1" autocomplete="off" onchange="syncShoulderPayload()"> PASS
	                    </label>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>

	@php  $id = "shoulderstreatch";  @endphp
    <x-reset-submit-btn :id="$id"/>
</form>


<script>
function syncShoulderPayload() {
    let rightVal = document.querySelector('input[name="right_shoulder_status"]:checked')?.value || '';
    let leftVal = document.querySelector('input[name="left_shoulder_status"]:checked')?.value || '';

    // Standard structural string assignment
    if (leftVal || rightVal) {
        document.getElementById('score_measurement').value = `L: ${leftVal || 'PENDING'} | R: ${rightVal || 'PENDING'}`;
    }

    // Pass quantitative score representation (e.g., total successful sides: 0, 1, or 2)
    let leftNumeric = leftVal === 'PASS' ? 1 : 0;
    let rightNumeric = rightVal === 'PASS' ? 1 : 0;
    document.getElementById('result').value = leftNumeric + rightNumeric;
}

$(document).ready(function() {
    // Dynamic binding to custom button components using correct id string
    $('#reset_btn_shoulderstretch').on('click', function() {
        $('#save_shoulder_stretch_record_id')[0].reset();
        $('.btn-group-toggle label').removeClass('active');
        document.getElementById('score_measurement').value = '';
        document.getElementById('result').value = '0';
    });

    $('#save_shoulder_stretch_record_id').submit(function(e) {
        e.preventDefault();
        
        const studentId = document.getElementById('selected_student_id').value;
        const rightVal = document.querySelector('input[name="right_shoulder_status"]:checked')?.value;
        const leftVal = document.querySelector('input[name="left_shoulder_status"]:checked')?.value;

        if (!studentId) {
            handleResponseMessages('info', 'Select Student', 'Please select a student from the listing array first.');
            return;
        }

        if (!rightVal || !leftVal) {
            handleResponseMessages('info', 'Incomplete Form', 'Please record both Left and Right arm metrics before saving.');
            return;
        }

        submitLoader(); // Trigger processing UI indicator
        
        $.ajax({
            url: $(this).attr('action'),
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                Swal.close();
                $('#save_shoulder_stretch_record_id')[0].reset();
                $('.btn-group-toggle label').removeClass('active');
                
                handleResponseMessages('success', '', response.message, {
                    confirmText: 'OK',
                    onConfirm: function () {
                        location.reload();
                    }
                });                 
            },
            error: function(xhr) {
                Swal.close();
                let err = xhr.responseJSON;
                Swal.fire({
                    title: "Error!",
                    text: (err && err.message) ? err.message : "Data capture transaction dropped by core service filters.",
                    icon: "error"
                });
            }
        });
    });
});
</script>

@endsection
