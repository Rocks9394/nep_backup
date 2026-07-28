@extends('assessor.cwsn.index')

@section('cwsnform')

<style>
    /* Theme Buttons */
    .theme-btn-group .btn-outline-theme {
        color: #292775;
        border-color: #292775;
    }

    .theme-btn-group .btn-outline-theme:hover,
    .theme-btn-group .btn-outline-theme.active {
        color: #fff !important;
        background: #292775 !important;
        border-color: #292775 !important;
    }

    /* Assessment Buttons */
    .assessment-btn {
        border-width: 2px;
        border-radius: 8px;
        padding: 1.7rem;
        transition: all .2s ease-in-out;
    }

    .assessment-btn small {
        color: #6c757d;
        transition: color .2s;
    }

    .btn-danger small,
    .btn-success small {
        color: #fff !important;
    }

    /* Submit Button */
    #btn-submit,
    #save_reverse_curl button[type="submit"] {
        background: #FF8000 !important;
        border-color: #FF8000 !important;
        color: #fff !important;
    }

    custom-hover-btn small {
      color: #6c757d; 
      transition: color 0.2s ease; 
    }

    
    .custom-hover-btn:hover small {
      color: #ffffff;
    }


</style>

<form
    method="POST"
    id="save_reverse_curl"
    name="saveBMIRecord"
    action=""
>

    @csrf

    <input type="hidden" name="skillReportId" value="{{ $skillReportId }}">
    <input type="hidden" name="TestTypeMasterID" value="{{ $TestTypeMasterID }}">
    <input type="hidden" name="SchoolId" value="{{ $SchoolId }}">
    <input type="hidden" name="student_id" id="selected_student_id">
    <input type="hidden" name="testtype" value="juniorbmi">

    <input
        type="hidden"
        name="score_measurement"
        id="score_measurement"
        value=""
    >

    <input
        type="hidden"
        name="weight_used"
        id="weight_used"
        value="0.5kg"
    >

    <!-- Weight Selector -->
    <!-- Parameter Selector: Dumbbell Weight (FIXED ALIGNMENT & THEME) -->
	<div class="row shadow-sm mb-4 border-0">
	    <div class="card-body text-center d-flex flex-column align-items-center justify-content-center">
	        <label class="form-label font-weight-bold text-uppercase text-muted tracking-wide mb-2" style="font-size: 0.8rem;">Select Dumbbell Weight</label>


	        <div class="btn-group btn-group-toggle theme-btn-group d-inline-flex" data-toggle="buttons" style="max-width: fit-content; width: 100%;">
			    <!-- 0.5kg is now active and checked by default -->
			    <label class="btn btn-outline-theme font-weight-bold px-3 py-2 active">
			        <input type="radio" name="weight_selector" value="0.5kg" autocomplete="off" checked> 0.5 kg
			    </label>
			    <label class="btn btn-outline-theme font-weight-bold px-3 py-2">
			        <input type="radio" name="weight_selector" value="1kg" autocomplete="off"> 1 kg
			    </label>
			    <label class="btn btn-outline-theme font-weight-bold px-3 py-2">
			        <input type="radio" name="weight_selector" value="1.5kg" autocomplete="off"> 1.5 kg
			    </label>
			    <label class="btn btn-outline-theme font-weight-bold px-3 py-2">
			        <input type="radio" name="weight_selector" value="2kg" autocomplete="off"> 2 kg
			    </label>
			</div>      
	       
	    </div>
	</div>

    <!-- Result Buttons -->
    <div class="mb-4">
        <div class="row">
            <div class="col-6">
                <button type="button" id="btn-fail" class="btn btn-outline-danger btn-block d-flex flex-column justify-content-center align-items-center assessment-btn custom-hover-btn" > FAIL <small> Incorrect / Dropped</small>
                </button>
            </div>

            <div class="col-6">
                <button type="button" id="btn-pass" class="btn btn-outline-success btn-block d-flex flex-column justify-content-center align-items-center assessment-btn custom-hover-btn" >PASS <small>  Held 2 Seconds </small>
                </button>
            </div>
        </div>
    </div>

    @php  $id = "bmi";  @endphp
    <x-reset-submit-btn :id="$id"/>

</form>

<script>
document.addEventListener("DOMContentLoaded", function () {

    const form = document.getElementById("save_reverse_curl");

    if (!form) return;

    const btnFail = document.getElementById("btn-fail");
    const btnPass = document.getElementById("btn-pass");

    const scoreInput = document.getElementById("score_measurement");
    const weightInput = document.getElementById("weight_used");

    const submitBtn =
        form.querySelector('button[type="submit"]') ||
        document.getElementById("btn-submit");

    if (submitBtn) {
        submitBtn.disabled = true;
    }

    function enableSubmit() {
        if (submitBtn) {
            submitBtn.disabled = false;
        }
    }

    function selectFail() {

        scoreInput.value = 0;

        btnFail.classList.remove("btn-outline-danger");
        btnFail.classList.add("btn-danger");

        btnPass.classList.remove("btn-success");
        btnPass.classList.add("btn-outline-success");

        enableSubmit();
    }

    function selectPass() {

        scoreInput.value = 1;

        btnPass.classList.remove("btn-outline-success");
        btnPass.classList.add("btn-success");

        btnFail.classList.remove("btn-danger");
        btnFail.classList.add("btn-outline-danger");

        enableSubmit();
    }

    btnFail.addEventListener("click", selectFail);

    btnPass.addEventListener("click", selectPass);

    document
        .querySelectorAll('input[name="weight_selector"]')
        .forEach(function (radio) {

            radio.addEventListener("change", function () {

                weightInput.value = this.value;

            });

        });

});
</script>

@endsection