


<?php $__env->startSection('title', 'Goforfit | ' . $title); ?>
<?php $__env->startSection('content'); ?>



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
						<h1 class="mt-2 mt-md-0 ml-md-4 mb-0"><?php echo e($title); ?></h1>
					</div>


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
					<div class="all-chaptr-cards1 filter-bx1 from__bx mt-4">

						<form id="schoolSelfRegistrationForm" method="post" action="<?php echo e(route('school.profile.update', $schoolData->id)); ?>" enctype="multipart/form-data">
							<?php echo csrf_field(); ?>
							<?php echo method_field('PUT'); ?>
							
							<h2 class="card-title text-left mt-1 mb-4">School Details</h2> 
							<!-- School Code (readonly) -->
							<div class="form-row">
								<div class="form-group col-md-3">
									<label for="schoolCode">School Code (U-DISE Code) </label>
									<input type="text" class="form-control" id="schoolCode" name="school_code"
										value="<?php echo e($schoolData->school_code); ?>" readonly>
								</div>
								<div class="form-group col-md-9">
									<label for="schoolName">School Name </label>
									<input type="text" class="form-control <?php $__errorArgs = ['schoolName'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
										id="schoolName" name="school_name" value="<?php echo e(old('school_name', $schoolData->school_name)); ?>" readonly>
									<?php $__errorArgs = ['schoolName'];
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
							<!-- Region, State, District, City -->
							
							<!-- Region -->
							<div class="form-row">
								<div class="form-group col-md-3">
									<label for="selectRegion">Region </label>
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
											<option value="<?php echo e($region->name); ?>"
												<?php echo e((old('region') ?? $schoolData->region) == $region->name ? 'selected' : ''); ?>>
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
									<label for="selectState">State </label>
									<select id="selectState" name="state" class="form-control <?php $__errorArgs = ['state'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
										<option value="">Choose...</option>
										<?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<option value="<?php echo e($state->id ?? ''); ?>|<?php echo e($state->name); ?>"
												<?php echo e((old('state') ?? $schoolData->state) == $state->name ? 'selected' : ''); ?>>
												<?php echo e($state->name); ?>

											</option>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</select>
									<?php $__errorArgs = ['state'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
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
										<option value="" <?php echo e((old('district') ?? $schoolData->district ?? '') == '' ? 'selected' : ''); ?>>Select</option>
										<?php $__currentLoopData = $districts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $district): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<option value="<?php echo e($district->id ?? ''); ?>"
												<?php echo e((old('district') ?? $schoolData->district) == $district->name ? 'selected' : ''); ?>>
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

								<!-- City -->
								<div class="form-group col-md-3">
									<label for="city">City </label>
									<input type="text" class="form-control <?php $__errorArgs = ['city'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
										id="city" name="city" value="<?php echo e(old('city', $schoolData->city)); ?>">
									<?php $__errorArgs = ['city'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
								</div>
							</div>

							<!-- Address -->
							<div class="form-group">
								<label for="schoolAddress">School Address <span class="text-danger">*</span></label>
								<textarea id="schoolAddress" name="school_address" rows="2"  class="form-control <?php $__errorArgs = ['school_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"><?php echo e(old('school_address') ?? $schoolData->s_address ?? 'N.A.'); ?></textarea>
								<?php $__errorArgs = ['school_address'];
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

							<!-- School Contact-->
							<div class="form-row">
								<div class="form-group col-md-5">
									<label for="schoolEmail">Email <span class="text-danger">*</span></label>
									<input type="email" class="form-control <?php $__errorArgs = ['schoolEmail'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="schoolEmail" name="school_email" value="<?php echo e(old('schoolEmail') ?? $schoolData->s_email ?? ''); ?>" required>
									<?php $__errorArgs = ['school_email'];
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

								<div class="form-group col-md-4">
									<label for="schoolPhone">School Contact Number <span class="text-danger">*</span></label>
									<input type="text" class="form-control <?php $__errorArgs = ['mobile'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"  id="schoolPhone" name="school_phone" value="<?php echo e(old('school_phone') ?? $schoolData->s_contact ?? ''); ?>">
									<?php $__errorArgs = ['school_phone'];
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
					            <label for="schoolShift">Shift <span class="text-danger">*</span></label>
					            <select name="school_shift" id="schoolShift" class="form-control <?php $__errorArgs = ['schoolShift'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
					                <option value="">Select</option>
					                <option value="Morning" <?php echo e((old('schoolShift') ?? $schoolData->shift ?? '') == 'Morning' ? 'selected' : ''); ?>>Morning</option>
					                <option value="Evening" <?php echo e((old('schoolShift') ?? $schoolData->shift ?? '') == 'Evening' ? 'selected' : ''); ?>>Evening</option>
					            </select>
					            <?php $__errorArgs = ['schoolShift'];
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
							<!-- Website & Logo -->
							<div class="form-group">
								<div class="row align-items-end">
									<div class="col-md-6">
										<label for="schoolWebsite">School Website Address</label>
										<input type="text" class="form-control <?php $__errorArgs = ['website'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="schoolWebsite" name="school_url" value="<?php echo e($schoolData->school_url); ?>">
										<?php $__errorArgs = ['school_url'];
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

									<div class="col-md-4">
										<label for="imageUpload">Upload Logo</label>
										<input class="form-control <?php $__errorArgs = ['school_logo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="file" accept=".jpg,.jpeg,.png" id="imageUpload" name="school_logo" onchange="previewImage(event)">
										<?php $__errorArgs = ['school_logo'];
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


									<div class="col-md-2">
										<?php if($schoolData->logo): ?>
											<img src="<?php echo e(asset('public/assets/uploads/logos/' . $schoolData->logo)); ?>" id="imagePreview" class="preview-img img-thumbnail" />
										<?php else: ?> .
											<img id="imagePreview" class="preview-img img-thumbnail d-none" />
										<?php endif; ?>
									</div>					           
								</div>
							</div>

							
							<h2 class="mt-4">Academic Year Details</h2>
									
							<?php
								[$startYear, $endYear] = explode('-', $academicYear);
								$nextAcademicYear = ($startYear + 1) . '-' . ($endYear + 1);
								$academicStart = "$startYear-04-01";
								$academicEnd   = "$endYear-03-31";
								$lastTermEndDate = $terms->last()
								? \Carbon\Carbon::parse($terms->last()->term_end_date)->addDay()->format('Y-m-d')
								: $academicStart;
							?>
							<div class="row">
								<div class="form-group col-md-4">
									<label for="academic_year">Academic Year</label>
										<select name="academic_year" id="academic_year" class="form-control">
											<option value="<?php echo e($academicYear); ?>"><?php echo e($academicYear); ?></option>
											<option value="<?php echo e($nextAcademicYear); ?>"><?php echo e($nextAcademicYear); ?></option>
										</select>
								</div>
								<div class="form-group col-md-4">
									<label>Start Date</label>
									<input type="date" name="academic_year_start" id="academic_year_start" class="form-control"
										value="<?php echo e($academicStart); ?>">
								</div>

								<div class="form-group col-md-4">
									<label>End Date</label>
									<input type="date" name="academic_year_end" id="academic_year_end" class="form-control"
										value="<?php echo e($academicEnd); ?>">
								</div>
							</div>
							<?php if($terms->count()): ?>
								<h5 class="mt-4">Terms Details</h5>

								<?php $__currentLoopData = $terms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $term): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<div class="form-row">
										<div class="form-group col-md-4">
											<label>Term Name</label>
											<input
												class="form-control"
												type="text"
												name="existing_terms[<?php echo e($index); ?>][term_name]"
												value="<?php echo e($term->term_name); ?>"
												readonly
											>
										</div>

										<div class="form-group col-md-4">
											<label>Start Date</label>
											<input
												class="form-control"
												type="text"
												name="existing_terms[<?php echo e($index); ?>][start_date]"
												value="<?php echo e(\Carbon\Carbon::parse($term->term_start_date)->format('m/d/Y')); ?>"
												readonly
											>
										</div>

										<div class="form-group col-md-4">
											<label>End Date</label>
											<input
												class="form-control"
												type="text"
												name="existing_terms[<?php echo e($index); ?>][end_date]"
												value="<?php echo e(\Carbon\Carbon::parse($term->term_end_date)->format('m/d/Y')); ?>"
												readonly
											>
										</div>
									</div>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							<?php endif; ?>

							<div id="terms-wrapper">
								<div class="form-row term-row" data-index="1">									
									<div class="form-group col-md-4">
										<label>Term Name</label>
										<input type="text" name="terms[0][term_name]" class="form-control term-name" value="Full-Term" readonly>
									</div>
									<div class="form-group col-md-4">
										<label>Start Date</label>
										<input type="date" name="terms[0][start_date]" class="form-control start-date" value="<?php echo e($lastTermEndDate); ?>">
									</div>
									<div class="form-group col-md-4">
										<label>End Date</label>
										<input type="date" name="terms[0][end_date]" class="form-control end-date" value="<?php echo e($academicEnd); ?>" max="<?php echo e($academicEnd); ?>">
									</div>										
								</div>
							</div>

							

							<h2 class="mt-4">School Admin Details</h2>					
							<div class="form-row">
								<div class="form-group col-md-4">
									<label for="principalName">HM/Principal <span class="text-danger">*</span></label>
									<input type="text" class="form-control <?php $__errorArgs = ['principalName'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
										id="principalName" name="principalName" value="<?php echo e(old('principalName') ?? $schoolData->p_name ?? ''); ?>">
									<?php $__errorArgs = ['principalName'];
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

								<div class="form-group col-md-4">
									<label for="principalEmail">Email <span class="text-danger">*</span></label>
									<input type="email" class="form-control <?php $__errorArgs = ['principalEmail'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"  id="principalEmail" name="principalEmail" value="<?php echo e(old('principalEmail') ?? $schoolData->p_email ?? ''); ?>" required>
									<?php $__errorArgs = ['principalEmail'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div>
									<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
								</div>

								<div class="form-group col-md-2">
									<label for="schoolAdminDesignation">Designation <span class="text-danger">*</span></label>
									<select name="schoolAdminDesignation" id="schoolAdminDesignation" 
											class="form-control <?php $__errorArgs = ['schoolAdminDesignation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
										<option value="0">Select</option>
										<option value="HM" <?php echo e($schoolData->p_designation == 'HM' ? 'selected' : ''); ?>>HM</option>
										<option value="Principal" <?php echo e($schoolData->p_designation == 'Principal' ? 'selected' : ''); ?>>Principal</option>
									</select>
									<?php $__errorArgs = ['schoolAdminDesignation'];
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
										<option value="3">Select</option>
										<option value="Male" <?php echo e($schoolData->p_gender == 'Male' ? 'selected' : ''); ?>>Male</option>
										<option value="Female" <?php echo e($schoolData->p_gender == 'Female' ? 'selected' : ''); ?>>Female</option>
										<option value="TransGender" <?php echo e($schoolData->p_gender == 'TransGender' ? 'selected' : ''); ?>>TransGender</option>
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
							</div>


							<div class="form-group">
								<div class="row align-items-end">
									<div class="col-md-6">
										<label for="principalContact">Principal Contact Number</label>
										<input type="text" class="form-control <?php $__errorArgs = ['principal_contact'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"  id="principalContact" name="principal_contact"    value="<?php echo e(old('p_contact') ?? $schoolData->p_contact ?? ''); ?> ">
										<?php $__errorArgs = ['principal_contact'];
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

									<div class="col-md-4">
										<label for="principalSign">Upload Signature</label>
										<input class="form-control <?php $__errorArgs = ['principal_signature'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="file" accept=".jpg,.jpeg,.png" id="principalSign" name="principal_signature" onchange="previewImage(event)">
										<?php $__errorArgs = ['principal_signature'];
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

									<div class="col-md-2">
										<?php if($schoolData->signature): ?>
											<img src="<?php echo e(asset('public/assets/uploads/signatures/' . $schoolData->signature)); ?>" id="signaturePreview" class="preview-img img-thumbnail" />
										<?php else: ?> .
											<img id="signaturePreview" class="preview-img img-thumbnail d-none" />
										<?php endif; ?>
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
		
	const maxTerms = 4;
	let baseTermIndex = getBaseTermIndex();

	function getBaseTermIndex() {
		const currentTermInput = document.getElementById('current-term');
		if (!currentTermInput) return 0;

		const match = currentTermInput.value.match(/Term-(\d+)/);
		return match ? parseInt(match[1]) : 0;
	}

	function isSameDate(d1, d2) {
		return d1.getTime() === d2.getTime();
	}

	function getAcademicDates() {
		const [startYear, endYear] = document.getElementById('academic_year').value.split('-');
		return {
			start: new Date(`${startYear}-04-01`),
			end: new Date(`${endYear}-03-31`)
		};
	}


	document.getElementById('academic_year').addEventListener('change', function () {
		const year = this.value.split('-');
		const startYear = year[0];
		const endYear = year[1];

		const academicStart = `${startYear}-04-01`;
		const academicEnd = `${endYear}-03-31`;

		resetTerms(academicStart, academicEnd);
	});

	function resetTerms(academicStart, academicEnd) {
		const wrapper = document.getElementById('terms-wrapper');

		baseTermIndex = 0;
		wrapper.querySelectorAll('.term-row').forEach((row, index) => {
			if (index > 0) row.remove();
		});

		const firstRow = wrapper.querySelector('.term-row');

		document.getElementById('academic_year_start').value = academicStart;
		document.getElementById('academic_year_end').value = academicEnd;
;
		firstRow.querySelector('.start-date').value = academicStart;
		firstRow.querySelector('.end-date').value = academicEnd;

		endDateInput.setAttribute('max', academicEnd);

		firstRow.querySelector('.term-name').value = 'Full-Term';
	}


	document.addEventListener('change', function (e) {
		if (!e.target.classList.contains('end-date')) return;

		const row = e.target.closest('.term-row');
		const index = parseInt(row.dataset.index);
		const startDate = new Date(row.querySelector('.start-date').value);
		const endDateInput = e.target;

		if (!endDateInput.value) return;

		const endDate = new Date(endDateInput.value);

		if (endDate < startDate) {
			Swal.fire({
				icon: 'info',
				title: 'Invalid Date',
				text: 'End date cannot be earlier than the start date.',
				allowOutsideClick: false
			});

			endDateInput.value = '';
			row.querySelector('.term-name').value =
				isSameDate(startDate, getAcademicDates().start)
					? 'Full-Term'
					: 'Full-Term';

			removeNextRows(index);
			return;
		}

		const { start: academicStart, end: academicEnd } = getAcademicDates();

		removeNextRows(index);

		if (isSameDate(startDate, academicStart) && isSameDate(endDate, academicEnd)) {
			row.querySelector('.term-name').value = 'Full-Term';
			return;
		}

		if (isSameDate(startDate, academicStart)) {
			row.querySelector('.term-name').value = `Term-${index}`;
		} else {
			row.querySelector('.term-name').value = `Term-${baseTermIndex + index}`;
		}

		if (index >= maxTerms || endDate >= academicEnd) return;

		createNextRow(index, endDate, academicEnd);
	});

	const wrapper = document.getElementById('terms-wrapper');
	function createNextRow(index, endDate, academicEnd) {
		const nextIndex = index + 1;
		const nextStart = new Date(endDate);
		nextStart.setDate(nextStart.getDate() + 1);

		
		const academicYear = document.getElementById('academic_year').value;

		const row = document.createElement('div');
		row.className = 'form-row term-row';
		row.dataset.index = nextIndex;

		row.innerHTML = `
			<div class="form-group col-md-4">
				<label>Term Name</label>
				<input type="text" name="terms[${nextIndex}][term_name]" class="form-control term-name" readonly>
			</div>
			<div class="form-group col-md-4">
				<label>Start Date</label>
				<input type="date" name="terms[${nextIndex}][start_date]" class="form-control start-date" value="${formatDate(nextStart)}" readonly>
			</div>
			<div class="form-group col-md-4">
				<label>End Date</label>
				<input type="date" name="terms[${nextIndex}][end_date]" class="form-control end-date" max="${formatDate(academicEnd)}">
			</div>
			
		`;
		wrapper.appendChild(row);
		row.querySelector('.term-name').value = `Term-${baseTermIndex + nextIndex}`;

	}

	function removeNextRows(index) {
		document.querySelectorAll('.term-row').forEach(row => {
			if (parseInt(row.dataset.index) > index) row.remove();
		});
	}

	function formatDate(date) {
		return date.toISOString().split('T')[0];
	}

</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.filldart-app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\nep\resources\views/school/profile/index.blade.php ENDPATH**/ ?>