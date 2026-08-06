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
                                </svg>
                            </span>
                        </a>

                    @elseif(auth()->guard('sstudent')->check())

                        <a href="javascript:history.back()" class="back-button">
                            <span class="arrow"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5" />
                                </svg></span> 
                        </a>
                    
                    @endif
                        <h1 class="ml-md-4 mb-0">{{$title}}</h1>
                    </div>
                </div>
            </div>

            {{-- get student list componet --}}

            @php
            $type = "fitnessTest";
            @endphp

            <x-get-student-list :classes="$classes" :type="$type" :title="$title"  />   

            <form method="POST" name="saveBMIRecord" id="save_bmi_record_id" action="">
                {{method_field('post')}}
                @csrf
                    
                    
                <input type="hidden" name="skillReportId" value="{{ $skillReportId }}">
                <input type="hidden" name="TestTypeMasterID" value="{{ $TestTypeMasterID }}">
                <input type="hidden" id="SchoolId" name="SchoolId" value="{{ $SchoolId }}">
                <input type="hidden" id="selected_student_id" name="student_id">
                <input type="hidden" id="testtype" name="testtype" value="seniorbmi">
                <div class="row">
                    <div class="col-12">
                        <div class="form">
                            <h2 class="mb-3 mt-4 text-center">Enter Height and Weight Score</h2>
                            <div class="input-group input-group__2 mb-3">
                                <span class="form-control">
                                    <label for="AGE_GENDER_ID" class="form-label">Age/Gender</label>
                            
                                    <input type="text" class="form-control form-control-lg no-cursor" id="AGE_GENDER_ID" placeholder="" disabled="">
                                </span>
                                <span class="form-control">
                                    <label for="heightInput" class="form-label">Height(cm)</label>
                                    <input type="text" name="height" required class="form-control form-control-lg" id="heightInput" placeholder="--">
                                </span>
                                <span class="form-control">
                                    <label for="weightInput" class="form-label"> Weight(kgs)</label>
                                    <input type="text" name="weight" required class="form-control form-control-lg" id="weightInput" placeholder="--">
                                </span>
                            </div>

                        </div>
                    </div>

                </div>


                {{-- footer for submit and reset button --}}
                @php
                    $id = "seniorBmi";
                @endphp
                <x-reset-submit-btn :id="$id"/>
                {{-- footer close --}}
					<button type="button" id="start-exercise-btn" class="btn btn-warning py-2 w-100 d-flex justify-content-center " 
					onclick="openFastAPIScreen()" style="color: white; font-weight: bold;"> Switch to AI </button>	
            
            </form>	
            
            
        </div>
    </div>
</div>


<script>
$(document).ready(function() {
    $('#save_bmi_record_id').submit(function(e) {
        e.preventDefault(); // prevent default form submission
        const studentId = document.getElementById('selected_student_id').value;
        if (!studentId) {
            handleResponseMessages( 'warning',  'Add Student', 'Please select the student');
            return;
        }
        submitLoader();
        $.ajax({
            url: '{{ route("bmi.record.submit") }}', // or your route URL
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
				Swal.close();
	       		$('#save_bmi_record_id')[0].reset();
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



// Height inputs restrictions
document.addEventListener("DOMContentLoaded", function () {
    const heightInput = document.getElementById("heightInput");

    // Check if element exists on page before attaching listener
    if (!heightInput) return;

    heightInput.addEventListener("input", function (e) {
        let value = e.target.value;

        // Allow only numbers and a single decimal point
        value = value.replace(/[^0-9.]/g, '');

        // Prevent multiple decimal points
        const parts = value.split('.');
        if (parts.length > 2) {
            value = parts[0] + '.' + parts[1];
        }

        // Limit to max 3 digits before decimal and 2 after (e.g. 175.50)
        let match = value.match(/^(\d{0,3})(\.(\d{0,2})?)?$/);
        if (match) {
            value = match[0];
        } else {
            value = value.slice(0, -1);
        }

        e.target.value = value;
    });

    // Validate 0 on blur (when user finishes typing and leaves field)
    heightInput.addEventListener("change", function (e) {
        let value = e.target.value;
        if (value && parseFloat(value) <= 0) {
            e.target.value = '';
            Swal.fire({
                title: '',
                text: "Height can't be 0",
                icon: 'warning'
            });
        }
    });
});


// Weight inputs restrictions
document.addEventListener("DOMContentLoaded", function () {
    const weightInput = document.getElementById("weightInput");

    // Guard clause: prevents script errors if element is missing
    if (!weightInput) return;

    weightInput.addEventListener("input", function (e) {
        let value = e.target.value;

        // Strip everything except digits and decimal point
        value = value.replace(/[^0-9.]/g, '');

        // Keep only the first decimal point
        const parts = value.split('.');
        if (parts.length > 2) {
            value = parts[0] + '.' + parts[1];
        }

        // Allow up to 3 digits before decimal and 2 digits after (e.g., 120.55)
        let match = value.match(/^(\d{0,3})(\.(\d{0,2})?)?$/);
        if (match) {
            value = match[0];
        } else {
            value = value.slice(0, -1);
        }

        e.target.value = value;
    });

    // Check for zero or negative values when the user finishes typing (blur event)
    weightInput.addEventListener("change", function (e) {
        let value = e.target.value;
        if (value && parseFloat(value) <= 0) {
            e.target.value = '';
            Swal.fire({
                title: '',
                text: "Weight can't be 0",
                icon: 'warning'
            });
        }
    });
});


</script>


<script>
// Global Listener for data from the AI Scanner
window.addEventListener('message', function(event) {
    // 1. Security Check: Only accept messages from your goforfit.in domains
    if (!event.origin.includes("goforfit.in")) return;

    const data = event.data;
	
	console.log('---start here:---data value:');
	
	console.log(data);
	
	console.log('---end here---data value:');

    // 2. Check for the specific Data Type we send from the AI Screen
    if (data.type === "AI_SYNC_DATA") {
        console.log("Biometric data received:", data);

        // Fill Height field
        const heightInput = document.getElementById('heightInput');
        if (heightInput) {
            heightInput.value = data.bmiScore;
        }

        // Optional: Fill Weight field with Wingspan if needed
        // const weightInput = document.getElementById('weightInput');
        // if (weightInput) weightInput.value = data.wingspan;

        // 3. Success Feedback
        Swal.fire({
            icon: 'success',
            title: 'AI Data Synced',
            text: 'Height: ' + data.bmiScore + ' cm has been recorded.',
            timer: 2000,
            showConfirmButton: false
        });
    }
}, false);
</script>




@endsection