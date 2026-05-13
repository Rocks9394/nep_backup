@extends('layouts.icsce-master-app')
@section('title', 'Goforfit | ' . $title)
@section('content')

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
                            </svg></span> </a>
                    @endif

                        <h1 class="ml-md-4 mb-0">{{$title}}</h1>
                    </div>
                </div>
            </div>

            {{-- get student list componet --}}
            @php
            $type = "fitnessTest";
            @endphp

            <x-get-student-list :classes="$classes" :type="$type"  :title="$title" />
            
            
        <form class="row" method="POST" name="saveSitAndReachRecord" id="vertical_jump" action="">
                {{method_field('post')}}
                @csrf
                
                <input type="hidden" name="skillReportId" value="{{ $skillReportId }}" id="skillReportId">
                <input type="hidden" name="TestTypeMasterID" value="{{ $TestTypeMasterID }}">
                <input type="hidden" name="SchoolId" id="SchoolId" value="{{ $SchoolId }}">
                <input type="hidden" name="student_id" id="selected_student_id" >
                <input type="hidden" name="result" id="result" placeholder="Result" readonly>
                
                <div class="col-12">
                    <div class="form">
                        <h2 class="mb-2 mt-4 text-center">{{$title}} Score</h2>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form">
                        <h3 class="mb-2 mt-4 text-left label">Initial Position</h3>
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
                        <h3 class="mb-2 mt-4 text-left label">Final Position</h3>
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
            
			
				@if(Auth::user()->id == '995')
								<!--<button type="button" id="start-exercise-btn" class="btn btn-warning py-2 w-100 d-flex justify-content-center" 
							onclick="redirectToPython()" style="color: white; font-weight: bold;"> Switch to AI </button>-->
							
							<button type="button" id="start-exercise-btn" class="btn btn-warning py-2 w-100 d-flex justify-content-center"  onclick="openAIScreen()" style="color: white; font-weight: bold;"> Switch to AI </button>
							
							
							
							
				@endif
            
        </div>
    </div>
</div>

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
    $('#vertical_jump').submit(function(e) {
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
				
				$('#vertical_jump')[0].reset();	
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

<script>
// --- NEW CODE START: RECEIVE DATA FROM AI SCREEN ---
window.addEventListener("message", function(event) {
    // Only process the message if it is our specific AI Sync type
    if (event.data && event.data.type === "AI_SYNC_VERTICAL_JUMP") {
        
        // 1. Fill Initial Position Fields using the IDs in your HTML
        // Matches id="initial_cm_id" and id="initial_mm_id"
        document.getElementById('initial_cm_id').value = event.data.initialCm;
        document.getElementById('initial_mm_id').value = event.data.initialMm;

        // 2. Fill Final Position Fields
        // Matches id="final_cm_id" and id="final_mm_id"
        document.getElementById('final_cm_id').value = event.data.finalCm;
        document.getElementById('final_mm_id').value = event.data.finalMm;

        // 3. Automatically trigger your existing calculateScore() function
        calculateScore();

        console.log("AI Data Received: Form Updated successfully!");
    }
}, false);
// --- NEW CODE END ---
</script>

@endsection