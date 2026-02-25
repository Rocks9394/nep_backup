@extends('layouts.filldart-app')
@section('title','Edit Profile')
@section('content')
<!--<style>
.center{
	width:40%;
	margin:0 auto;
	align-items: center; 
}
</style>-->

<div class="container">
	<div class="t-mrg">	
		<div class="row">
			<div class="col">
				<a href="#a" onclick="history.back()" class="back-button">
					<span class="arrow">
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
							<path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5" />
						</svg>
					</span>
				</a>
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
		{{-- Route::post('get-district', [RegisterController::class,'getDistrict'])->name('getdistrict'); --}}
			
		
        <div class="row">
            <div class="col-12">               
				<h5 class="card-title text-center mb-0">Update Trainer's Profile</h5> 
                <div class="all-chaptr-cards filter-bx mt-4">
					{{-- <form method="POST" action="{{ url('update-profile') }}/{{ Auth::user()->id }}">		 --}}
					<form id="updateProfileForm">
						@csrf
						@method('POST')
						
						<div class="form-row">
							<div class="form-group col-md-3">
								<label for="self_registrationId">Self Registration Id <span class="text-danger">*</span></label>
								<input type="text" class="form-control" id="self_registrationId" name="self_registrationId"
									value="{{ $result->self_registrationId }}" readonly>
							</div>
							<div class="form-group col-md-4">
								<label for="name">Name <span class="text-danger">*</span></label>
								<input type="text" class="form-control @error('name') is-invalid @enderror" 
										id="name" name="name" value="{{$result->name ?? '' }}">
								@error('name')
									<div class="invalid-feedback">{{ $message }}</div>
								@enderror	
							</div>
							<div class="form-group col-md-2">
								<label for="gender">Gender <span class="text-danger">*</span></label>
								<select name="gender" id="gender" class="form-control @error('gender') is-invalid @enderror">
									<option value="">Select</option>
									<option value="Male" {{ (old('gender') ?? $result->gender ?? '') == 'Male' ? 'selected' : '' }}>Male</option>
									<option value="Female" {{ (old('gender') ?? $result->gender ?? '') == 'Female' ? 'selected' : '' }}>Female</option>
									<option value="TransGender" {{ (old('gender') ?? $result->gender ?? '') == 'TransGender' ? 'selected' : '' }}>TransGender</option>
								</select>
								@error('gender')
									<div class="invalid-feedback">{{ $message }}</div>
								@enderror
							</div>
							<div class="form-group col-md-3">
								<label for="dob">Date of Birth <span class="text-danger">*</span></label>
								<input type="date" class="form-control @error('dob') is-invalid @enderror" 
										id="dob" name="dob"  data-dob="{{$result->dob}}" value="{{$result->dob}}">
								@error('name')
									<div class="invalid-feedback">{{ $message }}</div>
								@enderror	
							</div>
						</div>
						
						<div class="form-row">
							<div class="form-group col-md-4">
								<label for="email">Email <span class="text-danger">*</span></label>
								<input type="email" class="form-control @error('email') is-invalid @enderror" data-email = "{{ old('email') ?? $result->email ?? '' }}"  id="email" name="email" value="{{ old('email') ?? $result->email ?? '' }}">
								@error('email') <div class="invalid-feedback">{{ $message }}</div>
								@enderror
							</div>
							<div class="form-group col-md-4">
								<label for="phone">Contact Number<span class="text-danger">*</span></label>
								<input type="text" class="form-control @error('phone') is-invalid @enderror"  id="phone" name="phone"    value="{{ old('phone') ?? $result->phone ?? '' }} ">
								@error('phone') 
									<div class="invalid-feedback">{{ $message }}</div> 
								@enderror
							</div>
							<div class="form-group col-md-4">
								<label for="qualification">Quaification<span class="text-danger">*</span></label>
								<input type="text" class="form-control @error('qualification') is-invalid @enderror"  id="qualification" name="qualification"    value="{{$result->qualification }} ">
								@error('qualification') 
									<div class="invalid-feedback">{{ $message }}</div> 
								@enderror
							</div>

						</div>

						<!-- Region, State, District, City -->
						
						<!-- Region -->
						<div class="form-row">
							<div class="form-group col-md-3">
								<label for="selectRegion">Region <span class="text-danger">*</span></label>
								<select id="selectRegion" name="region" class="form-control @error('region') is-invalid @enderror">
									<option value="">Select...</option>
										@foreach($regions as $region)
											<option value="{{ $region->id }}"
												{{ (old('region') ?? $result->region_id) == $region->id ? 'selected' : '' }}>
												{{ $region->name }}
											</option>
										@endforeach
								</select>
								@error('region') <div class="invalid-feedback">{{ $message }}</div> @enderror
							</div>

							<!-- State -->
							<div class="form-group col-md-3">
								<label for="selectState">State <span style="color: red; font-weight: bold;" >*</span></label>
								<select id="selectState" name="state" class="form-control @error('state') is-invalid @enderror">
									<option selected>Select</option>
									@foreach($states as $state)
										<option value="{{ $state->id }}|{{ $state->name }}"
										{{ (old('state') ?? $result->state_id) == $state->id ? 'selected' : '' }}>
											{{ $state->name }}
										</option>

									@endforeach
								</select>
								@error('state')
									<div class="invalid-feedback">{{ $message }}</div>
								@enderror
							</div>


							<div class="form-group col-md-3">
								<label for="selectDistrict">District <span style="color: red; font-weight: bold;">*</span></label>
								<select id="selectDistrict" name="district" class="form-control @error('district') is-invalid @enderror">
									<option value="" {{ (old('district') ?? $result->district ?? '') == '' ? 'selected' : '' }}>Select</option>
									@foreach($districts as $district)
										<option value="{{ $district->id }}"
											{{ (old('district') ?? $result->district) == $district->id ? 'selected' : '' }}>
											{{ $district->name }}
										</option>
									@endforeach
								</select>
								@error('district')
									<div class="invalid-feedback">{{ $message }}</div>
								@enderror
							</div>

							
							<div class="form-group col-sm-6 col-md-6 col-lg-3">
								<label for="selectCity">City <span style="color:red; font-weight: bold;" >*</span></label>
								<input type="text" class="form-control @error('city') is-invalid @enderror" id="city" name="city" placeholder="" value="{{ $result->city }}">
								@error('city')
									<div class="invalid-feedback">{{ $message }}</div>
								@enderror
							</div>

							
						</div>
						<div class="form-row">
							<div class="form-group col-md-3">
								<label for="experience">Experience </label>
								<input type="text" class="form-control @error('experience') is-invalid @enderror"  id="experience" name="experience" value="{{$result->experience }} ">
								@error('experience') 
									<div class="invalid-feedback">{{ $message }}</div> 
								@enderror
							</div>
							<div class="form-group col-md-6">
								<label for="address">Address<span class="text-danger">*</span></label>
								<input type="text" class="form-control @error('address') is-invalid @enderror"  id="address" name="address" value="{{$result->address }} ">
								@error('address') 
									<div class="invalid-feedback">{{ $message }}</div> 
								@enderror
							</div>
							<div class="form-group col-md-3">
								<label for="pincode">Pincode<span class="text-danger">*</span></label>
								<input type="text" class="form-control @error('pincode') is-invalid @enderror"  id="pincode" name="pincode" value ="{{$result->pincode}}" required>
								@error('pincode') 
									<div class="invalid-feedback">{{ $message }}</div> 
								@enderror
							</div>
						</div>


						<!-- Submit Buttons -->
						<div class="d-flex justify-content-end mt-5">
							<a type="button" class="btn btn-secondary mr-2" href="#">Cancel</a>
							<button type="submit" class="btn btn-primary">Update Profile</button>
						</div>
					</form>
				</div>
            </div>
        </div>
    </div>
</div>


<script>
	
	const today = new Date().toISOString().split('T')[0];
  	document.getElementById('dob').setAttribute('max', today);
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
	$(document).ready(function () {
		$('#updateProfileForm').on('submit', function (e) {
			e.preventDefault();

			let form = $(this);
			let formData = form.serialize();
			let userId = "{{ Auth::user()->id }}";

			let email = $('#email').val();
			const emailInput = document.getElementById("email");
			const originalEmail = emailInput.getAttribute("data-email");

			let dob = $('#dob').val();
			const dobInput = document.getElementById("dob");
			const originalDob = dobInput.getAttribute("data-dob");

			let isEmailChanged = email !== originalEmail;
			let isDobChanged = dob !== originalDob;
		

			const sendUpdateRequest = () => {
				$.ajax({
					url: "{{ url('update-profile') }}",
					type: "POST",
					data: formData,
					beforeSend: function () {
						form.find("button[type='submit']").prop("disabled", true).text("Updating...");
					},
					success: function (response) {
						Swal.fire({
							icon: "success",
							title: "Profile Updated!",
							text: response.message ?? "Your profile has been updated successfully."
						});
					},
					error: function (xhr) {
						if (xhr.status === 422) {
							let errors = xhr.responseJSON.errors;
							let errorMessages = Object.values(errors).flat().join("\n");
							Swal.fire("Validation Error", errorMessages, "error");
						} else {
							Swal.fire("Error", "Something went wrong!", "error");
						}
					},
					complete: function () {
						form.find("button[type='submit']").prop("disabled", false).text("Update Profile");
					}
				});
			};

			if (isEmailChanged || isDobChanged) {
				Swal.fire({
					title: "Are you sure?",
					text: "You've updated your email or date of birth. This will change your login credentials. Do you want to continue?",
					icon: "warning",
					showCancelButton: true,
					confirmButtonText: "Yes, update it!",
					cancelButtonText: "Cancel"
				}).then((result) => {
					if (result.isConfirmed) {
						sendUpdateRequest();
					}
				});
			} else {
				sendUpdateRequest();
			}
		});
	});

</script>

@endsection