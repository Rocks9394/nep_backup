<?php $__env->startSection('title','Edit Profile'); ?>
<?php $__env->startSection('content'); ?>
<style>
  .preview-img {
    max-width: 100px;
    height: auto;
  }
</style>

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
				<?php if(session('success')): ?>
					<script>
						Swal.fire({
							  title: `<?php echo e(session('success')); ?>`,
							  icon: "success",
							  draggable: true
							});
					</script>
				<?php endif; ?>

				<?php if($errors->any()): ?>
				    <div class="alert alert-danger alert-dismissible fade show" role="alert" id="error-alert">
				        <ul>
				            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				                <li><?php echo e($error); ?></li>
				            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				        </ul>
				        <button type="button" class="close" data-dismiss="alert">&times;</button>
				    </div>
				<?php endif; ?>
			</div>
		</div>
		
			
		
        <div class="row">
            <div class="col-12">               
				<h5 class="card-title text-center mb-0">Update Trainer's Profile</h5> 
                <div class="all-chaptr-cards filter-bx mt-4">
					
					<form id="updateProfileForm">
						<?php echo csrf_field(); ?>
						<?php echo method_field('POST'); ?>
						
						<div class="form-row">
							<div class="form-group col-md-3">
								<label for="self_registrationId">Self Registration Id <span class="text-danger">*</span></label>
								<input type="text" class="form-control" id="self_registrationId" name="self_registrationId"
									value="<?php echo e($result->self_registrationId); ?>" readonly>
							</div>
							<div class="form-group col-md-4">
								<label for="name">Name <span class="text-danger">*</span></label>
								<input type="text" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
										id="name" name="name" value="<?php echo e($result->name ?? ''); ?>">
								<?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
									<div class="invalid-feedback"><?php echo e($message); ?></div>
								<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>	
							</div>
							<div class="form-group col-md-2">
								<label for="gender">Gender <span class="text-danger">*</span></label>
								<select name="gender" id="gender" class="form-control <?php $__errorArgs = ['gender'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
									<option value="">Select</option>
									<option value="Male" <?php echo e((old('gender') ?? $result->gender ?? '') == 'Male' ? 'selected' : ''); ?>>Male</option>
									<option value="Female" <?php echo e((old('gender') ?? $result->gender ?? '') == 'Female' ? 'selected' : ''); ?>>Female</option>
									<option value="TransGender" <?php echo e((old('gender') ?? $result->gender ?? '') == 'TransGender' ? 'selected' : ''); ?>>TransGender</option>
								</select>
								<?php $__errorArgs = ['gender'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
									<div class="invalid-feedback"><?php echo e($message); ?></div>
								<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
							</div>
							<div class="form-group col-md-3">
								<label for="dob">Date of Birth <span class="text-danger">*</span></label>
								<input type="date" class="form-control <?php $__errorArgs = ['dob'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
										id="dob" name="dob"  data-dob="<?php echo e($result->dob); ?>" value="<?php echo e($result->dob); ?>">
								<?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
									<div class="invalid-feedback"><?php echo e($message); ?></div>
								<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>	
							</div>
						</div>
						
						<div class="form-row">
							<div class="form-group col-md-3">
								<label for="email">Email <span class="text-danger">*</span></label>
								<input type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" data-email = "<?php echo e(old('email') ?? $result->email ?? ''); ?>"  id="email" name="email" value="<?php echo e(old('email') ?? $result->email ?? ''); ?>">
								<?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div>
								<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
							</div>
							<div class="form-group col-md-3">
								<label for="phone">Contact Number<span class="text-danger">*</span></label>
								<input type="text" class="form-control <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"  id="phone" name="phone"    value="<?php echo e(old('phone') ?? $result->phone ?? ''); ?> ">
								<?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> 
									<div class="invalid-feedback"><?php echo e($message); ?></div> 
								<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
							</div>
							<div class="form-group col-md-3">
								<label for="profilePicture">Profile Picture</label>
								<input class="form-control <?php $__errorArgs = ['profile_picture'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="file" accept=".jpg,.jpeg,.png" id="profilePicture" name="profilePicture" onchange="previewImage(event)">
								<?php $__errorArgs = ['profile_picture'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
									<div class="invalid-feedback"><?php echo e($message); ?></div>
								<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
							</div>

							<div class="form-group col-md-3" style="text-align:center">
								<?php if($result->profile_picture): ?>
									<img src="<?php echo e(asset('public/assets/uploads/profilePictures/users/' . $result->profile_picture)); ?>" id="profilePicturePreview" class="preview-img img-thumbnail" />
								<?php else: ?> .
									<img id="profilePicturePreview" class="preview-img img-thumbnail d-none" />
								<?php endif; ?>
							</div>							

						</div>

						<!-- Region, State, District, City -->
						
						<!-- Region -->
						<div class="form-row">
							<div class="form-group col-md-3">
								<label for="selectRegion">Region <span class="text-danger">*</span></label>
								<select id="selectRegion" name="region" class="form-control <?php $__errorArgs = ['region'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
									<option value="">Select...</option>
										<?php $__currentLoopData = $regions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $region): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<option value="<?php echo e($region->id); ?>"
												<?php echo e((old('region') ?? $result->region_id) == $region->id ? 'selected' : ''); ?>>
												<?php echo e($region->name); ?>

											</option>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</select>
								<?php $__errorArgs = ['region'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
							</div>

							<!-- State -->
							<div class="form-group col-md-3">
								<label for="selectState">State <span style="color: red; font-weight: bold;" >*</span></label>
								<select id="selectState" name="state" class="form-control <?php $__errorArgs = ['state'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
									<option selected>Select</option>
									<?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<option value="<?php echo e($state->id); ?>|<?php echo e($state->name); ?>"
										<?php echo e((old('state') ?? $result->state_id) == $state->id ? 'selected' : ''); ?>>
											<?php echo e($state->name); ?>

										</option>

									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</select>
								<?php $__errorArgs = ['state'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
									<div class="invalid-feedback"><?php echo e($message); ?></div>
								<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
							</div>


							<div class="form-group col-md-3">
								<label for="selectDistrict">District <span style="color: red; font-weight: bold;">*</span></label>
								<select id="selectDistrict" name="district" class="form-control <?php $__errorArgs = ['district'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
									<option value="" <?php echo e((old('district') ?? $result->district ?? '') == '' ? 'selected' : ''); ?>>Select</option>
									<?php $__currentLoopData = $districts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $district): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<option value="<?php echo e($district->id); ?>"
											<?php echo e((old('district') ?? $result->district) == $district->id ? 'selected' : ''); ?>>
											<?php echo e($district->name); ?>

										</option>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</select>
								<?php $__errorArgs = ['district'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
									<div class="invalid-feedback"><?php echo e($message); ?></div>
								<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
							</div>

							
							<div class="form-group col-sm-6 col-md-6 col-lg-3">
								<label for="selectCity">City <span style="color:red; font-weight: bold;" >*</span></label>
								<input type="text" class="form-control <?php $__errorArgs = ['city'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="city" name="city" placeholder="" value="<?php echo e($result->city); ?>">
								<?php $__errorArgs = ['city'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
									<div class="invalid-feedback"><?php echo e($message); ?></div>
								<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
							</div>

							
						</div>
						<div class="form-row">							
							<div class="form-group col-md-3">
								<label for="qualification">Quaification<span class="text-danger">*</span></label>
								<input type="text" class="form-control <?php $__errorArgs = ['qualification'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"  id="qualification" name="qualification"    value="<?php echo e($result->qualification); ?> ">
								<?php $__errorArgs = ['qualification'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> 
									<div class="invalid-feedback"><?php echo e($message); ?></div> 
								<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
							</div>
							<div class="form-group col-md-3">
								<label for="experience">Experience </label>
								<input type="text" class="form-control <?php $__errorArgs = ['experience'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"  id="experience" name="experience" value="<?php echo e($result->experience); ?> ">
								<?php $__errorArgs = ['experience'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> 
									<div class="invalid-feedback"><?php echo e($message); ?></div> 
								<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
							</div>
							<div class="form-group col-md-3">
								<label for="address">Address<span class="text-danger">*</span></label>
								<input type="text" class="form-control <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"  id="address" name="address" value="<?php echo e($result->address); ?> ">
								<?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> 
									<div class="invalid-feedback"><?php echo e($message); ?></div> 
								<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
							</div>
							<div class="form-group col-md-3">
								<label for="pincode">Pincode<span class="text-danger">*</span></label>
								<input type="text" class="form-control <?php $__errorArgs = ['pincode'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"  id="pincode" name="pincode" value ="<?php echo e($result->pincode); ?>" required>
								<?php $__errorArgs = ['pincode'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> 
									<div class="invalid-feedback"><?php echo e($message); ?></div> 
								<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
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
                url: "<?php echo e(route('school.getDistrict')); ?>",
                data: {
                    stateId: stateId,
                    _token: "<?php echo e(csrf_token()); ?>"
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
	function previewImage(event) {
		const input = event.target;
		if(event.target.id == 'profilePicture'){
			var preview = document.getElementById('profilePicturePreview');		
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
</script>
<script>
	$(document).ready(function () {
		$('#updateProfileForm').on('submit', function (e) {
			e.preventDefault();

			let form = $(this);
			let formData = new FormData(this);
			let userId = "<?php echo e(Auth::user()->id); ?>";

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
					url: "<?php echo e(url('update-profile')); ?>",
					type: "POST",
					data: formData,
					processData: false,
					contentType: false,
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
							Swal.fire("Profile Update Fail", errorMessages, "warning");
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

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.filldart-app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\nep\resources\views/viewtrainer/edit-profile.blade.php ENDPATH**/ ?>