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

<!-- Wrap everything inside a single master form submission to capture both scores simultaneously -->
<form method="POST" name="saveSitAndReachRecord" id="save_sit_and_reach_record_id" action="{{-- route('sit.and.reach.record.submit') --}}">
    {{ method_field('post') }}
    @csrf
    
    <input type="hidden" name="skillReportId" value="{{ $skillReportId }}" id="skillReportId">
    <input type="hidden" name="TestTypeMasterID" value="{{ $TestTypeMasterID }}">
    <input type="hidden" name="SchoolId" id="SchoolId" value="{{ $SchoolId }}">
    <input type="hidden" name="student_id" id="selected_student_id">
    <input type="hidden" name="result" id="result" placeholder="Result" readonly>
    
    <!-- Unified payload storage matched to your master schema: "L: X.X | R: Y.Y" -->
    <input type="hidden" name="score_measurement" id="score_measurement" value="">

    <div class="row mx-n2">
        <!-- ==================== LEFT LEG COLUMN ==================== -->
        <div class="col-12 col-md-6 px-2">
            <div class="card border-0 shadow-sm" style="border-radius: 12px;">
                <div class="p-1">
                    <h4 class="text-center text-primary text-uppercase" style="font-size: 1.1rem;">Left Leg Evaluation</h4>
                    
                    <div class="row">
                        <!-- Left Initial Position Grid -->
                        <div class="col-6 border-right">
                            <h5 class="mb-2 text-center text-muted font-weight-bold" style="font-size:1.0rem;">Initial Position</h5>
                            <div class="row no-gutters">
                                <div class="col-6 px-1">
                                    <label for="left_initial_cm" class="small font-weight-bold text-muted mb-1 d-block text-center">Cms</label>
                                    <input type="text" name="left_initial_cm" onkeyup="calculateLegScore('left')" class="form-control text-center font-weight-bold" id="left_initial_cm" placeholder="00" inputmode="numeric" style="font-size: 1.25rem;">
                                </div>
                                <div class="col-6 px-1">
                                    <label for="left_initial_mm" class="small font-weight-bold text-muted mb-1 d-block text-center">mm</label>
                                    <input type="text" name="left_initial_mm" onkeyup="calculateLegScore('left')" class="form-control text-center font-weight-bold" id="left_initial_mm" placeholder="0" inputmode="numeric" style="font-size: 1.25rem;">
                                </div>
                            </div>
                        </div>

                        <!-- Left Final Position Grid -->
                        <div class="col-6">
                            <h5 class="mb-2 text-center text-muted font-weight-bold" style="font-size:1.0rem;">Final Position</h5>
                            <div class="row no-gutters">
                                <div class="col-6 px-1">
                                    <label for="left_final_cm" class="small font-weight-bold text-muted mb-1 d-block text-center">Cms</label>
                                    <input type="text" name="left_final_cm" onkeyup="calculateLegScore('left')" class="form-control text-center font-weight-bold" id="left_final_cm" placeholder="00" inputmode="numeric" style="font-size: 1.25rem;">
                                </div>
                                <div class="col-6 px-1">
                                    <label for="left_final_mm" class="small font-weight-bold text-muted mb-1 d-block text-center">mm</label>
                                    <input type="text" name="left_final_mm" onkeyup="calculateLegScore('left')" class="form-control text-center" id="left_final_mm" placeholder="0" inputmode="numeric" style="font-size: 1.25rem;">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-center mt-3">
                        <span id="left_net_score_container" class="badge badge-light p-2 w-100 border text-secondary shadow-sm" style="display:none; font-size: 0.9rem; border-radius: 8px;">
                            Net Score: <strong id="left_final_result" class="text-dark">0.0 cm</strong>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- ==================== RIGHT LEG COLUMN ==================== -->
        <div class="col-12 col-md-6 px-2">
            <div class="card border-0 shadow-sm" style="border-radius: 12px;">
                <div class="p-1">
                    <h4 class="text-center font-weight-bold text-success text-uppercase" style="font-size: 1.1rem;">Right Leg Evaluation</h4>
                    
                    <div class="row">
                        <!-- Right Initial Position Grid -->
                        <div class="col-6 border-right">
                            <h5 class="mb-2 text-center text-muted font-weight-bold" style="font-size:1.0rem;">Initial Position</h5>
                            <div class="row no-gutters">
                                <div class="col-6 px-1">
                                    <label for="right_initial_cm" class="small font-weight-bold text-muted mb-1 d-block text-center">Cms</label>
                                    <input type="text" name="right_initial_cm" onkeyup="calculateLegScore('right')" class="form-control text-center font-weight-bold" id="right_initial_cm" placeholder="00" inputmode="numeric" style="font-size: 1.25rem;">
                                </div>
                                <div class="col-6 px-1">
                                    <label for="right_initial_mm" class="small font-weight-bold text-muted mb-1 d-block text-center">mm</label>
                                    <input type="text" name="right_initial_mm" onkeyup="calculateLegScore('right')" class="form-control text-center font-weight-bold" id="right_initial_mm" placeholder="0" inputmode="numeric" style="font-size: 1.25rem;">
                                </div>
                            </div>
                        </div>

                        <!-- Right Final Position Grid -->
                        <div class="col-6">
                            <h5 class="mb-2 text-center text-muted font-weight-bold" style="font-size:1.0rem;">Final Position</h5>
                            <div class="row no-gutters">
                                <div class="col-6 px-1">
                                    <label for="right_final_cm" class="small font-weight-bold text-muted mb-1 d-block text-center">Cms</label>
                                    <input type="text" name="right_final_cm" onkeyup="calculateLegScore('right')" class="form-control text-center font-weight-bold" id="right_final_cm" placeholder="00" inputmode="numeric" style="font-size: 1.25rem;">
                                </div>
                                <div class="col-6 px-1">
                                    <label for="right_final_mm" class="small font-weight-bold text-muted mb-1 d-block text-center">mm</label>
                                    <input type="text" name="right_final_mm" onkeyup="calculateLegScore('right')" class="form-control text-center font-weight-bold" id="right_final_mm" placeholder="0" inputmode="numeric" style="font-size: 1.25rem;">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-center mt-3">
                        <span id="right_net_score_container" class="badge badge-light p-2 w-100 border text-secondary shadow-sm" style="display:none; font-size: 0.9rem; border-radius: 8px;">
                            Net Score: <strong id="right_final_result" class="text-dark">0.0 cm</strong>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

    <!-- Sticky Footer Fixed Action Bar -->
    @php  $id = "pushups";  @endphp
    <x-reset-submit-btn :id="$id"/>


</form>

<script>
// Helper converts entry pairs into pure millimeters
function getTotalInMm(cm, mm) {
    return (parseInt(cm) || 0) * 10 + (parseInt(mm) || 0);
}

// Side-specific calculation isolates DOM lookups cleanly
function calculateLegScore(side) {
    let initialCm = document.getElementById(`${side}_initial_cm`).value;
    let initialMm = document.getElementById(`${side}_initial_mm`).value;
    let finalCm = document.getElementById(`${side}_final_cm`).value;
    let finalMm = document.getElementById(`${side}_final_mm`).value;

    // Wait until at least one character is entered to avoid flash of empty container
    if (!initialCm && !initialMm && !finalCm && !finalMm) {
        document.getElementById(`${side}_net_score_container`).style.display = "none";
        syncPayloadString();
        return 0;
    }

    let initialTotalMm = getTotalInMm(initialCm, initialMm);
    let finalTotalMm = getTotalInMm(finalCm, finalMm);
    let totalMm = finalTotalMm - initialTotalMm;

    document.getElementById(`${side}_net_score_container`).style.display = "block";
    
    if (totalMm < 0) {
        document.getElementById(`${side}_final_result`).innerHTML = `<span class="text-danger">Final position lower than initial</span>`;
    } else {
        let displayCm = Math.floor(totalMm / 10);
        let displayMm = totalMm % 10;
        document.getElementById(`${side}_final_result`).innerHTML = `${displayCm} cm, ${displayMm} mm`;
    }

    syncPayloadString();
    return totalMm;
}

// Packages structural values out directly into standard database payload format
function syncPayloadString() {
    let leftInitialCm = document.getElementById(`left_initial_cm`).value;
    let leftFinalCm = document.getElementById(`left_final_cm`).value;
    let rightInitialCm = document.getElementById(`right_initial_cm`).value;
    let rightFinalCm = document.getElementById(`right_final_cm`).value;

    let leftMm = getTotalInMm(leftFinalCm, document.getElementById(`left_final_mm`).value) - getTotalInMm(leftInitialCm, document.getElementById(`left_initial_mm`).value);
    let rightMm = getTotalInMm(rightFinalCm, document.getElementById(`right_final_mm`).value) - getTotalInMm(rightInitialCm, document.getElementById(`right_initial_mm`).value);

    let leftInches = (leftMm > 0) ? ((leftMm / 10) * 0.393701).toFixed(1) : "0.0";
    let rightInches = (rightMm > 0) ? ((rightMm / 10) * 0.393701).toFixed(1) : "0.0";

    // Dynamic field update mapped directly to standard schema architecture
    document.getElementById('score_measurement').value = `L: ${leftInches} in | R: ${rightInches} in`;
    document.getElementById('result').value = Math.max(0, leftMm + rightMm);
}

$(document).ready(function() {
    // Standard Reset Trigger Handler Setup
    $('#reset_sit_and_reach').on('click', function() {
        $('#save_sit_and_reach_record_id')[0].reset();
        $('#left_net_score_container, #right_net_score_container').hide();
        syncPayloadString();
    });

    $('#save_sit_and_reach_record_id').submit(function(e) {
        e.preventDefault();
        
        const studentId = document.getElementById('selected_student_id').value;
        
        // Comprehensive checks for completeness across both leg systems
        if(!$('#left_final_cm').val() && !$('#right_final_cm').val()) {
            handleResponseMessages('info', '', 'Please complete the scoring records before clicking save.');
            return;
        }
        
        if (!studentId) {
            handleResponseMessages('info', 'Select Student', 'Please select a student from the listing array first.');
            return;
        }

        let leftScore = getTotalInMm($('#left_final_cm').val(), $('#left_final_mm').val()) - getTotalInMm($('#left_initial_cm').val(), $('#left_initial_mm').value);
        let rightScore = getTotalInMm($('#right_final_cm').val(), $('#right_final_mm').val()) - getTotalInMm($('#right_initial_cm').val(), $('#right_initial_mm').value);
        
        if (leftScore < 0 || rightScore < 0) {
            handleResponseMessages('info', 'Invalid Input', "Calculated net adjustments cannot be negative values.");
            return;
        }
        
        submitLoader();
        $.ajax({
            url: $(this).attr('action'),
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                Swal.close();
                $('#save_sit_and_reach_record_id')[0].reset(); 
                document.getElementById(`left_net_score_container`).style.display = "none";
                document.getElementById(`right_net_score_container`).style.display = "none";
                
                handleResponseMessages('success', '', response.message, {
                    confirmText: 'OK',
                    onConfirm: function () {
                        location.reload();
                    }
                });                 
            },
            error: function(xhr) {
                Swal.close();
                let errorResponse = xhr.responseJSON;
                
                Swal.fire({
                    title: "Error!",
                    text: (errorResponse && errorResponse.message) ? errorResponse.message : "Data post process rejected by internal endpoint constraints.",
                    icon: "error"
                });
            }
        });
    });
});

// Setup input sizing filters to constrain input ranges
const inputConfigs = [
    { id: 'left_initial_cm', size: 2 }, { id: 'left_final_cm', size: 2 },
    { id: 'right_initial_cm', size: 2 }, { id: 'right_final_cm', size: 2 },
    { id: 'left_initial_mm', size: 1 }, { id: 'left_final_mm', size: 1 },
    { id: 'right_initial_mm', size: 1 }, { id: 'right_final_mm', size: 1 }
];

inputConfigs.forEach(config => {
    let element = document.getElementById(config.id);
    if(element) {
        element.addEventListener("input", function (e) {
            let val = e.target.value.replace(/[^0-9]/g, '');    
            if (val.length > config.size) {
                val = val.slice(0, config.size); 
            }
            e.target.value = val;
        });
    }
});
</script>
@endsection