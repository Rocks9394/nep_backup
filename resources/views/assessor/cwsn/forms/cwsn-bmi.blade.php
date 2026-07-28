@extends('assessor.cwsn.index')
@section('cwsnform')

<form method="POST" name="saveBMIRecord" id="save_bmi_record_id" action="">
    {{ method_field('post') }}
    @csrf
                        
    <input type="hidden" name="skillReportId" value="{{ $skillReportId }}">
    <input type="hidden" name="TestTypeMasterID" value="{{ $TestTypeMasterID }}">
    <input type="hidden" id="SchoolId" name="SchoolId" value="{{ $SchoolId }}">
    <input type="hidden" id="selected_student_id" name="student_id">
    <input type="hidden" id="testtype" name="testtype" value="juniorbmi">

    <!-- STEP 1: Core Profile Selection -->
    <div class="row mb-4 align-items-center">
        <label for="disability_category" class="col-md-4 col-form-label">
           <strong>Select Student's Disability Category from drop-down:</strong> 
        </label>

        <div class="col-md-8">
		    <select id="disability_category" name="disability_category" class="form-control text-wrap mw-100" onchange="handleCategoryChange()">
		        <option value="sensory">Visual Disabilities/ Hearing and Communication Disabilities / Intellectual / Developmental Disability</option>
		        <option value="physical">Physical / Locomotor</option>
		    </select>
		</div>

		{{--
       <div class="col-md-8">
		    <select id="disability_category" name="disability_category" class="form-control mb-1" onchange="handleCategoryChange()">
		        <option value="sensory">Sensory / Intellectual Disabilities</option>
		        <option value="physical">Physical / Orthopedic / Locomotor</option>
		    </select>
		    <small class="text-muted d-block" style="word-break: break-word;">
		        *Includes: Visual, Hearing, Speech, Communication, and Developmental conditions.
		    </small>
		</div>

		--}}

    </div>

    <!-- CASE 2: Advanced Orthopedic Adaptation Selector (Hidden by default) -->
    <div id="physical-adaptation-options" class="mb-4" style="display: none;">
        <div class="row align-items-center">
            <label for="adaptation_type" class="col-md-4 col-form-label">
               <strong>Does this measurement require a specialized method?</strong> 
            </label>
            <div class="col-md-8">
                <select id="adaptation_type" name="adaptation_type" class="form-control" onchange="handleAdaptationChange()">
                    <option value="none">No adaptation needed (Can stand / use standard scale)</option>
                    <option value="segmented">Segmented Height (For contractures / Cerebral Palsy)</option>
                    <option value="wheelchair">Wheelchair Weight (Subtract tare weight)</option>
                    <option value="amputation">Limb Amputation Adjustment</option>
                </select>
            </div>
        </div>
    </div>


    <!-- MAIN ROW: Simple and clean for core metrics -->
	<div class="form-body-wrapper mb-3">
	    <div class="input-group input-group__2">
	        
	        <!-- Age & Gender Column -->
	        <span class="form-control">
	            <label for="AGE_GENDER_ID" class="form-label">Age/Gender</label>
	            <input type="text" class="form-control form-control-lg no-cursor" id="AGE_GENDER_ID" disabled>
	        </span>
	        
	        <!-- Standard Height Column (Only displays if NOT segmented) -->
	        <span class="form-control" id="standard-height-cell">
	            <label for="heightInput" class="form-label">Height(cm)</label>
	            <input type="text" name="height" class="form-control form-control-lg" id="heightInput" placeholder="--" maxlength="6">
	        </span>
	        
	        <!-- Standard Weight Column (Only displays if NOT wheelchair/amputation) -->
	        <span class="form-control" id="standard-weight-cell">
	            <label for="weightInput" class="form-label">Weight(kgs)</label>
	            <input type="text" name="weight" class="form-control form-control-lg" id="weightInput" placeholder="--" maxlength="7">
	        </span>

	    </div>
	</div>

	<!-- NEW SEPARATE ROW: Dedicated container for complex CWSN adaptations -->
	<div id="cwsn-adaptation-row" class="card p-3 shadow-sm" style="display: none; background-color: #fdfdfd; border-radius: 7px !important;">
	    
	    <!-- Case 2: Segmented Height Fields (Takes up full width row) -->
	    <div id="segmented-fields" style="display: none;">
	        <label class="form-label fw-bold mb-3"><strong>Segmented Layout Measurements (Cerebral Palsy)</strong></label>
	        <div class="row g-2">
	            <div class="col-4">
	                <label class="small text-muted mb-1">Floor to Knee (cm)</label>
	                <input type="number" name="segment_floor_to_knee" step="0.1" class="form-control form-control-lg" placeholder="--">
	            </div>
	            <div class="col-4">
	                <label class="small text-muted mb-1">Knee to Hip (cm)</label>
	                <input type="number" name="segment_knee_to_hip" step="0.1" class="form-control form-control-lg" placeholder="--">
	            </div>
	            <div class="col-4">
	                <label class="small text-muted mb-1">Hip to Head (cm)</label>
	                <input type="number" name="segment_hip_to_head" step="0.1" class="form-control form-control-lg" placeholder="--">
	            </div>
	        </div>
	    </div>

	    <!-- Case 3: Wheelchair Tare Weight Fields -->
	    <div id="wheelchair-fields" style="display: none;">
	        <label class="form-label fw-bold mb-3"><strong>Wheelchair Weight Metrics</strong></label>
	        <div class="row g-3">
	            <div class="col-6">
	                <label class="small text-muted mb-1">Total Weight with Chair (kg)</label>
	                <input type="number" name="total_combined_weight" step="0.1" class="form-control form-control-lg" placeholder="--">
	            </div>
	            <div class="col-6">
	                <label class="small text-muted mb-1">Wheelchair Tare Subtraction (kg)</label>
	                <input type="number" name="wheelchair_tare_weight" step="0.1" class="form-control form-control-lg" placeholder="--">
	            </div>
	        </div>
	    </div>

	    <!-- Case 4: Amputation Profile Fields -->
	    <div id="amputation-fields" style="display: none;" class="col-md-12">
	        <label class="form-label fw-bold mb-3"><strong>Amputation Scale Profiling</strong></label>
	        <div class="row g-3">
	            <div class="col-6">
	                <label class="small text-muted mb-1">Amputation Target Location</label>
	                <select name="amputation_type" class="form-control">
	                    <option value="below_knee">Below-Knee Amputation</option>
	                    <option value="above_knee">Above-Knee Amputation</option>
	                    <option value="hip">Hip Amputation</option>
	                </select>
	            </div>
	            <div class="col-6">
	                <label class="small text-muted mb-1">Raw Measured Weight (kg)</label>
	                <input type="number" name="amputation_raw_weight" step="0.1" class="form-control " placeholder="--">
	            </div>
	        </div>
	    </div>

	</div>


    @php $id = "bmi"; @endphp
    <x-reset-submit-btn :id="$id"/>


    
    
</form> 

<script>
    function handleCategoryChange() {
        const category = document.getElementById('disability_category').value;
        const physicalOptions = document.getElementById('physical-adaptation-options');

        if (category === 'physical') {
            physicalOptions.style.display = 'block';
        } else {
            physicalOptions.style.display = 'none';
            document.getElementById('adaptation_type').value = 'none';
            handleAdaptationChange();
        }
    }

    function handleAdaptationChange() {
        const adaptation = document.getElementById('adaptation_type').value;
        
        // Main row cell wrappers
        const standardHeightCell = document.getElementById('standard-height-cell');
        const standardWeightCell = document.getElementById('standard-weight-cell');
        
        // Bottom adaptation row wrappers
        const adaptationRow = document.getElementById('cwsn-adaptation-row');
        const segmentedPanel = document.getElementById('segmented-fields');
        const wheelchairPanel = document.getElementById('wheelchair-fields');
        const amputationPanel = document.getElementById('amputation-fields');

        // Reset visibility back to default standard layout state
        standardHeightCell.style.display = 'block';
        standardWeightCell.style.display = 'block';
        adaptationRow.style.display = 'none';
        segmentedPanel.style.display = 'none';
        wheelchairPanel.style.display = 'none';
        amputationPanel.style.display = 'none';

        // Direct layout adjustments based on options chosen
        switch(adaptation) {
            case 'segmented':
                standardHeightCell.style.display = 'none'; // Hide height box in main row
                adaptationRow.style.display = 'block';      // Open adaptation space below
                segmentedPanel.style.display = 'block';     // Show the 3 clean wide columns
                break;
                
            case 'wheelchair':
                standardWeightCell.style.display = 'none'; // Hide weight box in main row
                adaptationRow.style.display = 'block';
                wheelchairPanel.style.display = 'block';
                break;
                
            case 'amputation':
                standardWeightCell.style.display = 'none'; // Hide weight box in main row
                adaptationRow.style.display = 'block';
                amputationPanel.style.display = 'block';
                break;
                
            default:
                // No action needed; defaults back to base layout view cleanly
                break;
        }
    }
</script>
@endsection