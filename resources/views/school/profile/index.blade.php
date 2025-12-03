

@extends('layouts.filldart-app')
@section('title', 'Goforfit | ' . $title)
@section('content')



<style>
  .preview-img {
    max-width: 100px;
    height: auto;
  }
</style>

<div class="container">
	<div class="t-mrg2 mb-5 pb-5">
        <div class="container all-chaptr-cards">	
			<div class="row">
				<div class="col">
					<div class="heading-rw mt-0 mt-md-1 mb-0 p-0">
					<a href="#a" onclick="history.back()" class="back-button">
						<span class="arrow">
							<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
								<path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5" />
							</svg>
						</span>
					</a>
						<h1 class="mt-2 mt-md-0 ml-md-4 mb-0">{{$title}}</h1>
					</div>


				</div>

				<div class="col">
					@if(session('success'))
						<script>
							Swal.fire({
								title: `{{ session('success') }}`,
								icon: "success",
								draggable: true
								});
						</script>
					@endif

					@if ($errors->any())
						<div class="alert alert-danger alert-dismissible fade show" role="alert" id="error-alert">
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
							<button type="button" class="close" data-dismiss="alert">&times;</button>
						</div>
					@endif
				</div>
			</div>
				
			
			<div class="row">
				<div class="col-12">               
					<div class="all-chaptr-cards1 filter-bx1 from__bx mt-4">

						<form id="schoolSelfRegistrationForm" method="post" action="{{ route('school.profile.update', $schoolData->id) }}" enctype="multipart/form-data">
							@csrf
							@method('PUT')
							
							<h5 class="card-title text-left mt-1 mb-4">School Details</h5> 
							<!-- School Code (readonly) -->
							<div class="form-row">
								<div class="form-group col-md-3">
									<label for="schoolCode">School Code (U-DISE Code) </label>
									<input type="text" class="form-control" id="schoolCode" name="school_code"
										value="{{ $schoolData->school_code }}" readonly>
								</div>
								<div class="form-group col-md-9">
									<label for="schoolName">School Name </label>
									<input type="text" class="form-control @error('schoolName') is-invalid @enderror" 
										id="schoolName" name="school_name" value="{{ old('school_name', $schoolData->school_name) }}" readonly>
									@error('schoolName')
										<div class="invalid-feedback">{{ $message }}</div>
									@enderror
								</div>
							</div>
							<!-- Region, State, District, City -->
							
							<!-- Region -->
							<div class="form-row">
								<div class="form-group col-md-3">
									<label for="selectRegion">Region </label>
									<select id="selectRegion" name="region" class="form-control @error('region') is-invalid @enderror">
										<option value="">Select...</option>
										@foreach($regions as $region)
											<option value="{{ $region->name }}"
												{{ (old('region') ?? $schoolData->region) == $region->name ? 'selected' : '' }}>
												{{ $region->name }}
											</option>
										@endforeach
									</select>
									@error('region') <div class="invalid-feedback">{{ $message }}</div> @enderror
								</div>

								<!-- State -->
								<div class="form-group col-md-3">
									<label for="selectState">State </label>
									<select id="selectState" name="state" class="form-control @error('state') is-invalid @enderror">
										<option value="">Choose...</option>
										@foreach($states as $state)
											<option value="{{ $state->name }}"
												{{ (old('state') ?? $schoolData->state) == $state->name ? 'selected' : '' }}>
												{{ $state->name }}
											</option>
										@endforeach
									</select>
									@error('state') <div class="invalid-feedback">{{ $message }}</div> @enderror
								</div>

								<!-- District -->
								<div class="form-group col-md-3">
									<label for="selectDistrict">District </label>
									<input type="text" name="district" id="selectDistrict"
										class="form-control @error('district') is-invalid @enderror"
										value="{{ old('district', $schoolData->district) }}" readonly>
									@error('district') <div class="invalid-feedback">{{ $message }}</div> @enderror
								</div>

								<!-- City -->
								<div class="form-group col-md-3">
									<label for="city">City </label>
									<input type="text" class="form-control @error('city') is-invalid @enderror"
										id="city" name="city" value="{{ old('city', $schoolData->city) }}" readonly>
									@error('city') <div class="invalid-feedback">{{ $message }}</div> @enderror
								</div>
							</div>

							<!-- Address -->
							<div class="form-group">
								<label for="schoolAddress">School Address <span class="text-danger">*</span></label>
								<textarea id="schoolAddress" name="school_address" rows="2"  class="form-control @error('school_address') is-invalid @enderror">{{ old('school_address') ?? $schoolData->s_address ?? 'N.A.' }}</textarea>
								@error('school_address')
									<div class="invalid-feedback">{{ $message }}</div>
								@enderror
							</div>

							<!-- School Contact-->
							<div class="form-row">
								<div class="form-group col-md-5">
									<label for="schoolEmail">Email <span class="text-danger">*</span></label>
									<input type="email" class="form-control @error('schoolEmail') is-invalid @enderror" id="schoolEmail" name="school_email" value="{{ old('schoolEmail') ?? $schoolData->s_email ?? '' }}">
									@error('school_email')
										<div class="invalid-feedback">{{ $message }}</div>
									@enderror
								</div>

								<div class="form-group col-md-4">
									<label for="schoolPhone">School Contact Number <span class="text-danger">*</span></label>
									<input type="text" class="form-control @error('mobile') is-invalid @enderror"  id="schoolPhone" name="school_phone" value="{{ old('school_phone') ?? $schoolData->s_contact ?? '' }}">
									@error('school_phone')
										<div class="invalid-feedback">{{ $message }}</div>
									@enderror
								</div>

								<div class="form-group col-md-3">
					            <label for="schoolShift">Shift <span class="text-danger">*</span></label>
					            <select name="school_shift" id="schoolShift" class="form-control @error('schoolShift') is-invalid @enderror">
					                <option value="">Select</option>
					                <option value="Morning" {{ (old('schoolShift') ?? $schoolData->shift ?? '') == 'Morning' ? 'selected' : '' }}>Morning</option>
					                <option value="Evening" {{ (old('schoolShift') ?? $schoolData->shift ?? '') == 'Evening' ? 'selected' : '' }}>Evening</option>
					            </select>
					            @error('schoolShift')
					                <div class="invalid-feedback">{{ $message }}</div>
					            @enderror
					        </div>

							</div>
							<!-- Website & Logo -->
							<div class="form-group">
								<div class="row align-items-end">
									<div class="col-md-6">
										<label for="schoolWebsite">School Website Address</label>
										<input type="text" class="form-control @error('website') is-invalid @enderror" id="schoolWebsite" name="school_url" value="{{$schoolData->school_url}}">
										@error('school_url') 
											<div class="invalid-feedback">{{ $message }}</div> 
										@enderror
									</div>

									<div class="col-md-4">
										<label for="imageUpload">Upload Logo</label>
										<input class="form-control @error('school_logo') is-invalid @enderror" type="file" accept=".jpg,.jpeg,.png" id="imageUpload" name="school_logo" onchange="previewImage(event)">
										@error('school_logo')
											<div class="invalid-feedback">{{ $message }}</div>
										@enderror
									</div>


									<div class="col-md-2">
										@if($schoolData->logo)
											<img src="{{ asset('public/assets/uploads/logos/' . $schoolData->logo) }}" id="imagePreview" class="preview-img img-thumbnail" />
										@else .
											<img id="imagePreview" class="preview-img img-thumbnail d-none" />
										@endif
									</div>					           
								</div>
							</div>			
						
							{{-- Terms details and add terms  --}}
							<h5 class="mt-4">School Terms</h5>

							@if(!$activeTerm)
								<div class="form-row">
									<div class="form-group col-md-3">
										<label for="term-select">Terms in School<span class="text-danger">*</span></label>
										<select id="term-select" name="term-select" class="form-control @error('term-select') is-invalid @enderror">
											<option value="">Select Term</option>									
											<option value="1">1</option>									
											<option value="2">2</option>									
											<option value="3">3</option>									
											<option value="4">4</option>								
										</select>
										<small class="text-danger text-sm">Only for current academic year</small>
									</div>
									<div class="form-group col-md-9" id="term-details"></div>
								</div>							
							@else
								{{-- active and previouse terms  --}}
								@foreach($termsDetail->reverse()->values() as $index => $termsDetail)
									<div class="form-row">
										<div class="form-group col-md-3">
											<label for="current-term">{{ $index === 0 ? 'Previous' : 'Current' }} Term</label>
											<input class="form-control" type="text" id="current-term" name="current-term" value="{{$termsDetail->term_name}}" readonly>
										</div>
										<div class="form-group col-md-3">
											<label for="academic_year">Academic Year</label>
											<input class="form-control" type="text" id="academic_year" name="academic_year" value="{{$termsDetail->academic_year}}" readonly>
										</div>
										<div class="form-group col-md-3">
											<label for="current-term-start">Start Date</label>
											<input class="form-control" type="text" id="current-term-start" name="current-term-start" value="{{ \Carbon\Carbon::parse($termsDetail->term_start_date)->format('d/m/Y')}}" readonly>
										</div>
										<div class="form-group col-md-3">
											<label for="current-term-end">End Date</label>
											<input class="form-control" type="text" id="current-term-end" name="current-term-end" value="{{\Carbon\Carbon::parse($termsDetail->term_end_date)->format('d/m/Y')}}" readonly>
										</div>
									</div>
								@endforeach

								{{-- Term to update  --}}
								<h5 class="mb-4">Add Term</h5>
								<div class="form-row">
									<div class="form-group col-md-3">
										<label for="term">Term Name</label>
										{{-- <input class="form-control" type="text" id="full-term" name="full-term" value="Full Term" readonly> --}}
										<select class="form-control" name="term" id="term">
											<option value="">--Select--</option>
											<option value="Full Term">Full Term</option>
											<option value="Term-1">Term-1</option>
											<option value="Term-2">Term-2</option>
											<option value="Term-3">Term-3</option>
											<option value="Term-4">Term-4</option>
										</select>
									</div>
									@php
										$year = date('Y'); 
										$nextYear = $year + 1;
										$currentAcademicYear = $year . "-" . $nextYear;

										$nextNextYear = $nextYear + 1;
										$nextAcademicYear = $nextYear . "-" . $nextNextYear;
									@endphp

									<div class="form-group col-md-3">
										<label for="academic_year">Academic Year</label>
										{{-- <input class="form-control" type="text" id="academic_year" name="academic_year" value="{{$termsDetail->academic_year}}" readonly> --}}
										<select name="academic_year" id="academic_year" class="form-control">
											<option value="{{$currentAcademicYear}}">{{$currentAcademicYear}}</option>
											<option value="{{$nextAcademicYear}}">{{$nextAcademicYear}}</option>
										</select>

									</div>
									<div class="form-group col-md-3">
										<label for="term-start">Start Date <span class="text-danger">*</span></label>
										<input class="form-control" type="date" id="term-start" name="term-start">
									</div>
									<div class="form-group col-md-3">
										<label for="term-end">End Date <span class="text-danger">*</span></label>
										<input class="form-control" type="date" id="term-end" name="term-end">
									</div>
									
								</div>

							@endif

							{{-- School Admin / Principal Contact & Signature --}}

							<h5 class="mt-4">School Admin Details</h5>					
							<div class="form-row">
								<div class="form-group col-md-4">
									<label for="principalName">HM/Principal <span class="text-danger">*</span></label>
									<input type="text" class="form-control @error('principalName') is-invalid @enderror" 
										id="principalName" name="principalName" value="{{ old('principalName') ?? $schoolData->p_name ?? '' }}">
									@error('principalName')
										<div class="invalid-feedback">{{ $message }}</div>
									@enderror	
								</div>

								<div class="form-group col-md-4">
									<label for="principalEmail">Email <span class="text-danger">*</span></label>
									<input type="email" class="form-control @error('principalEmail') is-invalid @enderror"  id="principalEmail" name="principalEmail" value="{{ old('principalEmail') ?? $schoolData->p_email ?? '' }}">
									@error('principalEmail') <div class="invalid-feedback">{{ $message }}</div>
									@enderror
								</div>

								<div class="form-group col-md-2">
									<label for="schoolAdminDesignation">Designation <span class="text-danger">*</span></label>
									<select name="schoolAdminDesignation" id="schoolAdminDesignation" 
											class="form-control @error('schoolAdminDesignation') is-invalid @enderror">
										<option value="0">Select</option>
										<option value="HM" {{ $schoolData->p_designation == 'HM' ? 'selected' : '' }}>HM</option>
										<option value="Principal" {{ $schoolData->p_designation == 'Principal' ? 'selected' : '' }}>Principal</option>
									</select>
									@error('schoolAdminDesignation')
										<div class="invalid-feedback">{{ $message }}</div>
									@enderror
								</div>


								<div class="form-group col-md-2">
									<label for="gender">Gender <span class="text-danger">*</span></label>
									<select name="gender" id="gender" class="form-control @error('gender') is-invalid @enderror">
										<option value="3">Select</option>
										<option value="Male" {{$schoolData->p_gender == 'Male' ? 'selected' : '' }}>Male</option>
										<option value="Female" {{$schoolData->p_gender == 'Female' ? 'selected' : '' }}>Female</option>
										<option value="TransGender" {{ $schoolData->p_gender == 'TransGender' ? 'selected' : '' }}>TransGender</option>
									</select>
									@error('gender')
										<div class="invalid-feedback">{{ $message }}</div>
									@enderror
								</div>
							</div>


							<div class="form-group">
								<div class="row align-items-end">
									<div class="col-md-6">
										<label for="principalContact">Principal Contact Number</label>
										<input type="text" class="form-control @error('principal_contact') is-invalid @enderror"  id="principalContact" name="principal_contact"    value="{{ old('p_contact') ?? $schoolData->p_contact ?? '' }} ">
										@error('principal_contact') 
											<div class="invalid-feedback">{{ $message }}</div> 
										@enderror
									</div>

									<div class="col-md-4">
										<label for="principalSign">Upload Signature</label>
										<input class="form-control @error('principal_signature') is-invalid @enderror" type="file" accept=".jpg,.jpeg,.png" id="principalSign" name="principal_signature" onchange="previewImage(event)">
										@error('principal_signature')
											<div class="invalid-feedback">{{ $message }}</div>
										@enderror
									</div>

									<div class="col-md-2">
										@if($schoolData->signature)
											<img src="{{ asset('public/assets/uploads/signatures/' . $schoolData->signature) }}" id="signaturePreview" class="preview-img img-thumbnail" />
										@else .
											<img id="signaturePreview" class="preview-img img-thumbnail d-none" />
										@endif
									</div>
								</div>
							</div>


							<!-- Submit Buttons -->
							<div class="d-flex justify-content-end mt-5">
								<a type="button" class="btn btn-secondary mr-2" href="#a" onclick="history.back()">Cancel</a>
								<button type="submit" class="btn btn-primary">Update Profile</button>
							</div>
						</form>

					</div>
				</div>
			</div>
		</div>
    </div>
</div>


<script>
  function previewImage(event) {
    const input = event.target;
    if(event.target.id == 'imageUpload'){
    	var preview = document.getElementById('imagePreview');
    }

    if(event.target.id == 'principalSign'){
    	var preview = document.getElementById('signaturePreview');
    }   

    if (input.files && input.files[0]) {
      const reader = new FileReader();
      reader.onload = function (e) {
        preview.src = e.target.result;
        preview.classList.remove('d-none');
      };
      reader.readAsDataURL(input.files[0]);
    }
  }

	$('#selectState').on('change', function() {
        const stateId = $(this).val();
        const selectDistrict = $('#selectDistrict');
        selectDistrict.empty().append('<option value="">Select District</option>');

        if (stateId) {
            $.ajax({
                type: 'POST',
                url: "{{ route('school.getDistrict') }}",
                data: {
                    stateId: stateId,
                    _token: "{{ csrf_token() }}"
                },
                dataType: 'json',

                success: function(response) {
                    $.each(response, function(index, city) {
                        selectDistrict.append(
                            $('<option>', {
                                value: city.id,
                                text: city.name
                            })
                        );
                    });
                },

                error: function(xhr, status, error) {
                    console.error("AJAX Error:", xhr.responseText);
                    $('#message').text('Error loading districts!');
                }
            });
        }
    });
</script>



<script>
	const termSelect = document.getElementById('term-select');
	const termDetails = document.getElementById('term-details');

	function generateForm(term) {
		let content = '';

		if (term === '1') {
			content = `
			<div class="form-row">
				<div class="form-group col-md-4">
					<label for="full-term">Term Name</label>
					<input class="form-control" type="text" id="full-term" name="full-term" value="Full Term" readonly>
				</div>
				<div class="form-group col-md-4">
					<label for="start-date">Start Date <span class="text-danger">*</span></label>
					<input class="form-control" type="date" id="start-date" name="start-date" required>
				</div>
				<div class="form-group col-md-4">
					<label for="end-date">End Date <span class="text-danger">*</span></label>
					<input class="form-control" type="date" id="end-date" name="end-date" required>
				</div>
				
			</div>
			`;
		} else if (term === '2') {
			content = `
			<div class="form-row">
				<div class="form-group col-md-4">
					<label for="term-1">Term Name</label>
					<input class="form-control" type="text" id="term-1" name="term-1" value="Term-1" readonly>
				</div>
				<div class="form-group col-md-4">
					<label for="start-date-1">Start Date <span class="text-danger">*</span></label>
					<input class="form-control" type="date" id="start-date-1" name="start-date-1" required>
				</div>
				<div class="form-group col-md-4">
					<label for="end-date-1">End Date <span class="text-danger">*</span></label>
					<input class="form-control" type="date" id="end-date-1" name="end-date-1" required>
				</div>
				
			</div>
			<div class="form-row">
				<div class="form-group col-md-4">
					<label for="term-2">Term Name</label>
					<input class="form-control" type="text" id="term-2" name="term-2" value="Term-2" readonly>
				</div>
				<div class="form-group col-md-4">
					<label for="start-date-2">Start Date <span class="text-danger">*</span></label>
					<input class="form-control" type="date" id="start-date-2" name="start-date-2" required>
				</div>
				<div class="form-group col-md-4">
					<label for="end-date-2">End Date <span class="text-danger">*</span></label>
					<input class="form-control" type="date" id="end-date-2" name="end-date-2" required>
				</div>
				
			</div>
			`;
		} else if (term === '3') {
			content = `
			<div class="form-row">
				<div class="form-group col-md-4">
					<label for="term-1">Term Name</label>
					<input class="form-control" type="text" id="term-1" name="term-1" value="Term-1" readonly>
				</div>
				<div class="form-group col-md-4">
					<label for="start-date-1">Start Date <span class="text-danger">*</span></label>
					<input class="form-control" type="date" id="start-date-1" name="start-date-1" required>
				</div>
				<div class="form-group col-md-4">
					<label for="end-date-1">End Date <span class="text-danger">*</span></label>
					<input class="form-control" type="date" id="end-date-1" name="end-date-1" required>
				</div>
				
			</div>
			<div class="form-row">
				<div class="form-group col-md-4">
					<label for="term-2">Term Name</label>
					<input class="form-control" type="text" id="term-2" name="term-2" value="Term-2" readonly>
				</div>
				<div class="form-group col-md-4">
					<label for="start-date-2">Start Date <span class="text-danger">*</span></label>
					<input class="form-control" type="date" id="start-date-2" name="start-date-2" required>
				</div>
				<div class="form-group col-md-4">
					<label for="end-date-2">End Date <span class="text-danger">*</span></label>
					<input class="form-control" type="date" id="end-date-2" name="end-date-2" required>
				</div>
				
			</div>
			<div class="form-row">
				<div class="form-group col-md-4">
					<label for="term-3">Term Name</label>
					<input class="form-control" type="text" id="term-3" name="term-3" value="Term-3" readonly>
				</div>
				<div class="form-group col-md-4">
					<label for="start-date-3">Start Date <span class="text-danger">*</span></label>
					<input class="form-control" type="date" id="start-date-3" name="start-date-3" required>
				</div>
				<div class="form-group col-md-4">
					<label for="end-date-3">End Date <span class="text-danger">*</span></label>
					<input class="form-control" type="date" id="end-date-3" name="end-date-3" required>
				</div>
				
			</div>
			`;
		}else if (term === '4') {
			content = `
			<div class="form-row">
				<div class="form-group col-md-4">
					<label for="term-1">Term Name</label>
					<input class="form-control" type="text" id="term-1" name="term-1" value="Term-1" readonly>
				</div>
				<div class="form-group col-md-4">
					<label for="start-date-1">Start Date <span class="text-danger">*</span></label>
					<input class="form-control" type="date" id="start-date-1" name="start-date-1" required>
				</div>
				<div class="form-group col-md-4">
					<label for="end-date-1">End Date <span class="text-danger">*</span></label>
					<input class="form-control" type="date" id="end-date-1" name="end-date-1" required>
				</div>
				
			</div>
			<div class="form-row">
				<div class="form-group col-md-4">
					<label for="term-2">Term Name</label>
					<input class="form-control" type="text" id="term-2" name="term-2" value="Term-2" readonly>
				</div>
				<div class="form-group col-md-4">
					<label for="start-date-2">Start Date <span class="text-danger">*</span></label>
					<input class="form-control" type="date" id="start-date-2" name="start-date-2" required>
				</div>
				<div class="form-group col-md-4">
					<label for="end-date-2">End Date <span class="text-danger">*</span></label>
					<input class="form-control" type="date" id="end-date-2" name="end-date-2" required>
				</div>
				
			</div>
			<div class="form-row">
				<div class="form-group col-md-4">
					<label for="term-3">Term Name</label>
					<input class="form-control" type="text" id="term-3" name="term-3" value="Term-3" readonly>
				</div>
				<div class="form-group col-md-4">
					<label for="start-date-3">Start Date <span class="text-danger">*</span></label>
					<input class="form-control" type="date" id="start-date-3" name="start-date-3" required>
				</div>
				<div class="form-group col-md-4">
					<label for="end-date-3">End Date <span class="text-danger">*</span></label>
					<input class="form-control" type="date" id="end-date-3" name="end-date-3" required>
				</div>
				
			</div>
			<div class="form-row">
				<div class="form-group col-md-4">
					<label for="term-4">Term Name</label>
					<input class="form-control" type="text" id="term-4" name="term-4" value="Term-4" readonly>
				</div>
				<div class="form-group col-md-4">
					<label for="start-date-4">Start Date <span class="text-danger">*</span></label>
					<input class="form-control" type="date" id="start-date-4" name="start-date-4" required>
				</div>
				<div class="form-group col-md-4">
					<label for="end-date-4">End Date <span class="text-danger">*</span></label>
					<input class="form-control" type="date" id="end-date-4" name="end-date-4" required>
				</div>
				
			</div>
			`;
		}

		termDetails.innerHTML = content;
	}

	termSelect.addEventListener('change', (e) => {
		generateForm(e.target.value);
	});
	generateForm(termSelect.value);
</script>
@endsection