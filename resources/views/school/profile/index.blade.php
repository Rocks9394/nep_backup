

@extends('layouts.filldart-app')
@section('title', 'Goforfit | ' . $title)
@section('content')



<style>
  .preview-img {
    max-width: 100px;
    height: auto;
  }
</style>

<div>
	<div class="t-mrg2">
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
							
							<h2 class="card-title text-left mt-1 mb-4">School Details</h2> 
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
											<option value="{{ $state->id ?? '' }}|{{ $state->name }}"
												{{ (old('state') ?? $schoolData->state) == $state->name ? 'selected' : '' }}>
												{{ $state->name }}
											</option>
										@endforeach
									</select>
									@error('state') <div class="invalid-feedback">{{ $message }}</div> @enderror
								</div>

								<div class="form-group col-md-3">
									<label for="selectDistrict">District <span style="color: red; font-weight: bold;">*</span></label>
									<select id="selectDistrict" name="district" class="form-control @error('district') is-invalid @enderror">
										<option value="" {{ (old('district') ?? $schoolData->district ?? '') == '' ? 'selected' : '' }}>Select</option>
										@foreach($districts as $district)
											<option value="{{ $district->id ?? ''}}"
												{{ (old('district') ?? $schoolData->district) == $district->name ? 'selected' : '' }}>
												{{ $district->name }}
											</option>
										@endforeach
									</select>
									@error('district')
										<div class="invalid-feedback">{{ $message }}</div>
									@enderror
								</div>

								<!-- City -->
								<div class="form-group col-md-3">
									<label for="city">City </label>
									<input type="text" class="form-control @error('city') is-invalid @enderror"
										id="city" name="city" value="{{ old('city', $schoolData->city) }}">
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
									<input type="email" class="form-control @error('schoolEmail') is-invalid @enderror" id="schoolEmail" name="school_email" value="{{ old('schoolEmail') ?? $schoolData->s_email ?? '' }}" required>
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
							<h2 class="mt-4">Academic Year Details</h2>
									
							@php
								[$startYear, $endYear] = explode('-', $academicYear);
								$nextAcademicYear = ($startYear + 1) . '-' . ($endYear + 1);
								$academicStart = "$startYear-04-01";
								$academicEnd   = "$endYear-03-31";
							@endphp

							<div class="row">
								<div class="form-group col-md-4">
									<label>Academic Year</label>
									<select id="academic_year" name="academic_year" class="form-control">
										<option value="{{ $academicYear }}">{{ $academicYear }}</option>
										<option value="{{ $nextAcademicYear }}">{{ $nextAcademicYear }}</option>
									</select>
								</div>

								<div class="form-group col-md-4">
									<label>Start Date</label>
									<input type="date" name="academic_year_start" id="academic_year_start" class="form-control" value="{{ \Carbon\Carbon::parse($terms[0]->academic_year_start)->format('Y-m-d') }}">
								</div>

								<div class="form-group col-md-4">
									<label>End Date</label>
									<input type="date" name="academic_year_end" id="academic_year_end" class="form-control" value="{{ \Carbon\Carbon::parse($terms[0]->academic_year_end)->format('Y-m-d') }}">
								</div>
							</div>

							<h5 class="mt-4">Terms Details</h5>

							<div id="existing-terms" class="current-year-terms">
							@foreach($terms ?? [] as $index => $term)
								<div class="form-row existing-term-row" data-last="{{ $loop->last }}">
									<div class="form-group col-md-4">
										<label>Term Name</label>
										<input type="text" name="terms[{{ $index }}][term_name]" class="form-control" value="{{ $term->term_name }}" readonly>
									</div>
									<div class="form-group col-md-4">
										<label>Start Date</label>
										<input type="date" name="terms[{{ $index }}][start_date]" class="form-control" value="{{ \Carbon\Carbon::parse($term->term_start_date)->format('Y-m-d') }}">

									</div>
									<div class="form-group col-md-4">
										<label>End Date</label>
										<input type="date" name="terms[{{ $index }}][end_date]" class="form-control existing-end-date" 
											value="{{ \Carbon\Carbon::parse($term->term_end_date)->format('Y-m-d') }}"
											{{ !$loop->last ? 'readonly' : '' }}>
									</div>
								</div>
							@endforeach
							</div>
							<div id="terms-wrapper"></div>


							{{-- School Admin / Principal Contact & Signature --}}

							<h2 class="mt-4">School Admin Details</h2>					
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
									<input type="email" class="form-control @error('principalEmail') is-invalid @enderror"  id="principalEmail" name="principalEmail" value="{{ old('principalEmail') ?? $schoolData->p_email ?? '' }}" required>
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
								<a type="button" class="btn btn-secondary mr-2" href="{{ route('filldart.dashboard')}}">Cancel</a>
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

	const maxTerms = 4;
	const wrapper = document.getElementById('terms-wrapper');
	const academicYearSelect = document.getElementById('academic_year');

	document.addEventListener('DOMContentLoaded', function () {

		academicYearSelect.addEventListener('change', function () {
			clearNewTerms();
			const { start, end } = getAcademicDates();
			document.getElementById('academic_year_start').value = formatDate(start);
    		document.getElementById('academic_year_end').value = formatDate(end);

			if (this.value === "{{ $academicYear }}") {
				const { start, end } = getAcademicDates();			
				hideExistingTerms(false);
				@if(count($terms ?? []))
				const lastEnd = new Date("{{ \Carbon\Carbon::parse($terms->last()->term_end_date)->format('Y-m-d') }}");

				if (lastEnd < end) {
					const nextStart = new Date(lastEnd);
					nextStart.setDate(nextStart.getDate() + 1);
					const existingCount = document.querySelectorAll('.existing-term-row').length;
					createTermRow(existingCount + 1, nextStart, end, true, true);
				}
				@endif
				document.querySelectorAll('.term-row .lbh').forEach(label => {
					label.classList.add('d-none');	
				});
			} else {
				hideExistingTerms(true);
				const existingCount = document.querySelectorAll('.existing-term-row').length;
				createTermRow(existingCount + 1, start, end, true, true);
				document.querySelectorAll('.term-row .lbh').forEach(label => {
					label.classList.remove('d-none');	
				});
			}
		});
	});

	function getAcademicDates() {
		const [s, e] = academicYearSelect.value.split('-');
		return {
			start: new Date(`${s}-04-01`),
			end: new Date(`${e}-03-31`)
		};
	}

	function formatDate(date) {
		return date.toISOString().split('T')[0];
	}

	function clearNewTerms() {
		wrapper.innerHTML = '';
	}

	function hideExistingTerms(hide) {
		document.querySelectorAll('.current-year-terms').forEach(el => {
			el.style.display = hide ? 'none' : 'block';
		});
	}

	function createTermRow(index, startDate, endDate, editableStart, editableEnd) {
		const { end } = getAcademicDates();
		const row = document.createElement('div');
		row.className = 'form-row term-row';
		row.dataset.index = index;

		row.innerHTML = `
			<div class="form-group col-md-4">
				<label class="lbh d-none">Term Name</label>				
				<input type="text" class="form-control term-name"
					name="terms[${index}][term_name]" readonly>
			</div>
			<div class="form-group col-md-4">
				<label class="lbh d-none">Strat Date</label>
				<input type="date" class="form-control start-date"
					name="terms[${index}][start_date]"
					value="${formatDate(startDate)}"
					${editableStart ? '' : 'readonly'}>
			</div>
			<div class="form-group col-md-4">
				<label class="lbh d-none">End Date</label>
				<input type="date" class="form-control end-date"
					name="terms[${index}][end_date]"
					max="${formatDate(end)}"
					${editableEnd ? '' : 'readonly'}>
			</div>
		`;
		wrapper.appendChild(row);
	}
	// update newly created term name for new academic year 

	function updateTermName(row) {
		const index = parseInt(row.dataset.index);
		const start = new Date(row.querySelector('.start-date').value);
		const endInput = row.querySelector('.end-date');
		if (!endInput.value) return;

		const end = new Date(endInput.value);
		const { start: acadStart, end: acadEnd } = getAcademicDates();

		const isFullTerm =
			start.getTime() === acadStart.getTime() &&
			end.getTime() === acadEnd.getTime();

		row.querySelector('.term-name').value = isFullTerm
			? 'Full-Term'
			: `Term-${index}`;
	}
	// update existing term name  

	function updateExistingTermNames() {
		const existingRows = document.querySelectorAll('.existing-term-row');

		if (!existingRows.length) return;

		const firstRow = existingRows[0];
		const nameInput = firstRow.querySelector('input[name*="[term_name]"]');

		// Check if it's Full-Term
		if (nameInput.value === 'Full-Term') {
			existingRows.forEach((row, index) => {
				const input = row.querySelector('input[name*="[term_name]"]');
				input.value = `Term-${index + 1}`;
			});
		}
	}

	document.addEventListener('change', function (e) {
		if (!e.target.classList.contains('existing-end-date')) return;
		updateExistingTermNames();
		const endInput = e.target;
		const row = endInput.closest('.existing-term-row');
		const startDate = new Date(row.querySelector('input[type="date"]').value);
		const endDate = new Date(endInput.value);
		const { end: academicEnd } = getAcademicDates();

		if (endDate < startDate) {
			Swal.fire({
				icon: 'info',
				title: 'Oops!',
				text: "Term End date can't be less than start date",
				allowOutsideClick: false,
				confirmButtonText: 'OK'
			});
			endInput.value = formatDate(startDate);
			return;
		}

		if (endDate > academicEnd) {
			Swal.fire({
				icon: 'info',
				title: 'Oops!',
				text: "Term End date can't be greater than Academic Year end date",
				allowOutsideClick: false,
				confirmButtonText: 'OK'
			});
			endInput.value = formatDate(academicEnd);
			return;
		}

		clearNewTerms();

		if (endDate.getTime() >= academicEnd.getTime()) return;

		const nextStart = new Date(endDate);
		nextStart.setDate(nextStart.getDate() + 1);
		const existingCount = document.querySelectorAll('.existing-term-row').length;
		createTermRow(existingCount + 1, nextStart, academicEnd, true, true);
	});

	wrapper.addEventListener('change', function (e) {
		if (!e.target.classList.contains('end-date')) return;

		const row = e.target.closest('.term-row');
		const index = parseInt(row.dataset.index);
		const startDate = new Date(row.querySelector('.start-date').value);
		const endDate = new Date(e.target.value);
		const { end: academicEnd } = getAcademicDates();

		if (endDate < startDate) {
			Swal.fire({
				icon: 'info',
				title: 'Oops!',
				text: "Term End date can't be less than start date",
				allowOutsideClick: false,
				confirmButtonText: 'OK'
			});
			e.target.value = '';
			return;
		}

		if (endDate > academicEnd) {
			Swal.fire({
				icon: 'info',
				title: 'Oops!',
				text: "Term End date can't be greater than Academic Year end date",
				allowOutsideClick: false,
				confirmButtonText: 'OK'
			});
			e.target.value = '';
			return;
		}

		updateTermName(row);

		document.querySelectorAll('.term-row').forEach(r => {
			if (parseInt(r.dataset.index) > index) r.remove();
		});



		if (index >= maxTerms || endDate.getTime() === academicEnd.getTime()) return;

		const nextStart = new Date(endDate);
		nextStart.setDate(nextStart.getDate() + 1);
		createTermRow(index + 1, nextStart, academicEnd, false, true);
	});

	
	@if(count($terms ?? []))
		const lastEnd = new Date("{{ \Carbon\Carbon::parse($terms->last()->term_end_date)->format('Y-m-d') }}");
		const { end } = getAcademicDates();

		if (lastEnd < end) {
			const nextStart = new Date(lastEnd);
			nextStart.setDate(nextStart.getDate() + 1);
			const existingCount = document.querySelectorAll('.existing-term-row').length;
			createTermRow(existingCount + 1, nextStart, end, true, true);
		}
	@endif
	
</script>
@endsection