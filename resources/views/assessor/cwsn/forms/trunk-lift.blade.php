@extends('assessor.cwsn.index')
@section('cwsnform')


<form class="row" method="POST" name="saveSitAndReachRecord" id="save_sit_and_reach_record_id" action="">
                {{method_field('post')}}
                @csrf
                
                <input type="hidden" name="skillReportId" value="{{ $skillReportId }}" id="skillReportId">
                <input type="hidden" name="TestTypeMasterID" value="{{ $TestTypeMasterID }}">
                <input type="hidden" name="SchoolId" id="SchoolId" value="{{ $SchoolId }}">
                <input type="hidden" name="student_id" id="selected_student_id" >
                <input type="hidden" name="result" id="result" placeholder="Result" readonly>
                
                <div class="col-12">
                    <div class="form">
                        <h2 class="mb-2 mt-4 text-center">Enter {{ $title }} Test Score</h2>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form">
                        <h3 class="mb-2 mt-4 text-left label">Trial 1</h3>
                        <div class="input-group input-group__2 mb-3">
                            <span class="form-control">
                                <label for="initial_cm_id" class="form-label">Cms</label>
                                <input type="text" name="initial_cm" onkeyup="calculateScore()" class="form-control form-control-lg" id="initial_cm_id" placeholder="00">
                            </span>
                            <span class="form-control">
                                <label for="initial_mm_id" class="form-label">mm</label>
                                <input type="text" name="initial_mm" onkeyup="calculateScore()" class="form-control form-control-lg" id="initial_mm_id" placeholder="00">
                            </span>
                        </div>

                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="form">
                        <h3 class="mb-2 mt-4 text-left label">Trial 2</h3>
                        <div class="input-group input-group__2 mb-3">
                            <span class="form-control">
                                <label for="final_cm_id" class="form-label">Cms</label>
                                <input type="text" name="final_cm" class="form-control form-control-lg" onkeyup="calculateScore()" id="final_cm_id" placeholder="00">
                            </span>
                            <span class="form-control">
                                <label for="final_mm_id" class="form-label">mm</label>
                                <input type="text" name="final_mm" class="form-control form-control-lg" onkeyup="calculateScore()" id="final_mm_id" placeholder="00">
                            </span>
                        </div>
                        <div>
                    
                            <span id="net_score" style="display:none"><b>Net Score:</b> <span id="final_result_id"></span></span>
                        </div>

                    </div>
                </div>
                {{-- footer for submit and reset button --}}
                    @php
                        $id = "flexibility";
                    @endphp
                    <x-reset-submit-btn :id="$id"/>
                {{-- footer close --}}
        </form>


<script>
function getTotalInMm(cm, mm) {
    return (parseInt(cm) || 0) * 10 + (parseInt(mm) || 0);
}

function calculateScore() {
    let initialCm = document.getElementById("initial_cm_id").value;
    let initialMm = document.getElementById("initial_mm_id").value;
    let finalCm = document.getElementById("final_cm_id").value;
    let finalMm = document.getElementById("final_mm_id").value;

    let initialTotalMm = getTotalInMm(initialCm, initialMm);
    let finalTotalMm = getTotalInMm(finalCm, finalMm);

    let totalMm = finalTotalMm - initialTotalMm;

    // Properly handle negative values
    let sign = totalMm < 0 ? "-" : "";
    let absMm = Math.abs(totalMm);
    let resultCm = Math.floor(absMm / 10);
    let resultMm = absMm % 10;

    document.getElementById("net_score").style.display = "block";
    document.getElementById("result").value = totalMm;
    document.getElementById("final_result_id").innerHTML = `${sign}${resultCm}cm, ${sign}${resultMm}mm`;

    return totalMm;
}
</script>

<script>
$(document).ready(function() {
    $('#save_sit_and_reach_record_id').submit(function(e) {
        e.preventDefault(); // prevent default form submission
        const studentId = document.getElementById('selected_student_id').value;
        const finalMmInput = $('input[name="final_mm"]').val();
        const finalCmInput = $('input[name="final_cm"]').val();

        const finalMm = finalMmInput === "" ? null : finalMmInput;
        const finalCm = finalCmInput === "" ? null : finalCmInput;

      
        if(finalMm==null && finalCm == null) {
            handleResponseMessages( 'info',  '', 'Please enter position of the student');
            return;
        }
        
        if (!studentId) {
            handleResponseMessages( 'info',  'Select Student', 'Please select the student');
            return;
        }

        let score = calculateScore();
        if(score < 0 ){
            handleResponseMessages( 'info',  'Invalid Input', "Final value can't be less than initial value");
            return;
        }
        
        submitLoader();
        $.ajax({
            url: '{{ route("sit.and.reach.record.submit") }}', // or your route URL
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                Swal.close();
				
				$('#save_sit_and_reach_record_id')[0].reset();	
                handleResponseMessages( 'success',  '', response.message, {
                    confirmText: 'OK',
                    onConfirm: function () {
                        location.reload();
                    }
                });					
            },
            
            error: function(xhr) {
                Swal.close();
                let errors = xhr.responseJSON.errors;
                let errorHtml = '<ul>';
                $.each(errors, function(key, value) {
                    errorHtml += '<li>' + value[0] + '</li>';
                });
                errorHtml += '</ul>';
                $('#response').html('<div style="color:red;">' + errorHtml + '</div>');
				
				Swal.fire({
					title: "error!",
					text: response.message,
					icon: "error"
					});
				
            }
        });
    });
});

// for input validations

document.getElementById("initial_cm_id").addEventListener("input", function (e) {
    let value = e.target.value;
    value = value.replace(/[^0-9]/g, '');    
    let match = value.match(/^(\d{0,2})?$/);
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
document.getElementById("final_cm_id").addEventListener("input", function (e) {
    let value = e.target.value;
    value = value.replace(/[^0-9]/g, '');    
    let match = value.match(/^(\d{0,2})?$/);
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
document.getElementById("initial_mm_id").addEventListener("input", function (e) {
    let value = e.target.value;
    value = value.replace(/[^0-9]/g, '');    
    let match = value.match(/^(\d{0,1})?$/);
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
document.getElementById("final_mm_id").addEventListener("input", function (e) {
    let value = e.target.value;
    value = value.replace(/[^0-9]/g, '');    
    let match = value.match(/^(\d{0,1})?$/);
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
</script>



@endsection