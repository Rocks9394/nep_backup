 <?php $__env->startSection('title', $title); ?> <?php $__env->startSection('content'); ?>


<div class="container">
	<div class="t-mrg2 mb-5 pb-5">

		<div class="all-chaptr-cards mb-4" style="margin: 0;">
			<div class="row">
				<?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.back-button','data' => ['title' => ''.e($title).'']]); ?>
<?php $component->withName('back-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['title' => ''.e($title).'']); ?>
					 <?php $__env->slot('actionsOutside', null, []); ?> 
				        <div >				        	
				        	<button class="btn btn-sm btn-primary" onclick="openAvailableDownloads()">Available Download</button>
				        	<?php echo $__env->make('reports.modals.check-downloads', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>		
							

							

				        </div>
				     <?php $__env->endSlot(); ?>
				 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
			</div>
		</div>


		<div class="alert alert-info d-flex align-items-start gap-2" role="alert" style="border-left: 4px solid #0d6efd;">
		    <i class="bi bi-info-circle-fill text-primary"></i>
		    <div>
		        <strong>&nbsp;&nbsp;Note:</strong>  
		        <ul class="mb-0 mt-1">
		            <li> Reports can only be generated for students who have <strong>completed all fitness tests</strong>.</li>
		            <li> If a student’s report is <strong>already requested</strong> or <strong>currently being processed</strong>, the checkbox will be disabled until it’s complete.</li>

		            <li>
					  Students with <strong>incomplete test data</strong> will be skipped during bulk report card generation.
					  Please complete all tests or download the report manually.
					</li>
		            
		            <li>Generated reports are retained for <strong>7 days</strong> only. After 7 days, they will be permanently deleted from the system. Please download and store your reports before they expire.				  
					</li>
		        </ul>
		    </div>
		</div>


		<div class="container-fluid p-0">
			<?php
				$exportButtons = [
					[
						'type' => 'custom',
						'text' => 'Request Report Cards',
						'action' => 'generateFitnessReportCard'
					],
				];

				if (in_array(Auth::user()->id, [3251])){
					$exportButtons[] = [
						'type' => 'custom',
						'text' => 'Send Report Cards',
						'action' => 'sendFitnessReportCard'
					];
				}
			?>
            <?php if (isset($component)) { $__componentOriginal7d544a56946f4bd747a3eca2075b6198f1e62946 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\DataListingComponent::class, ['id' => 'student-skill-reports-table','headers' => ['Class','Section','Roll No.','Student Name', 'Admission No.','Gender','Birth Date','Status','Test Status','Report','Download'],'columns' => [			       
			        ['data' => 'display_classname', 'name' => 'display_classname', 'orderable' => true],
			        ['data' => 'section_id',        'name' => 'section_id',        'orderable' => true],
			        ['data' => 'rollno',            'name' => 'rollno',            'orderable' => true],
			        ['data' => 'student_name',      'name' => 'student_name',      'orderable' => true, 'searchable' => true],
			        ['data' => 'admission_number',  'name' => 'admission_number',  'orderable' => true],
			        ['data' => 'gender',            'name' => 'gender',            'orderable' => true],
			        ['data' => 'dob',               'name' => 'students.dob',      'orderable' => false],
			        ['data' => 'status',            'name' => 'students.status',   'orderable' => false],
			        ['data' => 'testStatus',        'name' => 'test_status',       'orderable' => false],
			        ['data' => 'viewReport',        'name' => 'id',                'orderable' => false],
			        ['data' => 'downloadReport',    'name' => 'id', 			   'orderable' => false],
			    ],'ajaxUrl' => ''.e(route('fitness.report')).'','enableExportButtons' => false,'enableLengthMenu' => true,'pageLength' => 100,'enableClassFilter' => false,'enableClassSectionFilter' => true,'enableSchoolTermsFilter' => true,'exportButtonText' => 'Bulk Action','enableTestStatusFilter' => true,'enableStudentCategoryFilter' => true,'enableStatusFilter' => false,'selectedStatus' => 'active','searchPlaceholder' => 'Students Name | Admission','exportButtons' => $exportButtons]); ?>
<?php $component->withName('data-listing-component'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7d544a56946f4bd747a3eca2075b6198f1e62946)): ?>
<?php $component = $__componentOriginal7d544a56946f4bd747a3eca2075b6198f1e62946; ?>
<?php unset($__componentOriginal7d544a56946f4bd747a3eca2075b6198f1e62946); ?>
<?php endif; ?>
        </div>       
	</div>
</div>
<?php $__env->stopSection(); ?>


<?php $__env->startPush('scripts'); ?>
<script>
	const currentTermId = <?php echo json_encode($TermMasterId, 15, 512) ?>;

	function generateFitnessReportCard(e, dt, node, config, selectedIds) {

		let termId = document.getElementById('filter-school-terms').value;
		const action = "download";

		// Swal.fire({
		// 	icon: 'info',
		// 	iconColor: '#3085d6',
		// 	title: 'Session Preparation in Progress',
		// 	html: `
		// 		<p style="font-size: 1.1em;">Preparation for the <strong>CISCE 2026-27 session</strong> is currently underway.</p>
		// 		<p>This module will be accessible shortly. We appreciate your patience.</p>
		// 	`,
		// 	confirmButtonText: 'Ok',
		// 	confirmButtonColor: '#3085d6',
		// 	allowOutsideClick: false,
		// });
		// return; 


		if (!selectedIds || selectedIds.length === 0) {   		

		    Swal.fire({
		        icon: 'info',
		        title: 'No Data Selected',
		        text: 'Please select at least one student.',
		        allowOutsideClick: false,
		        showConfirmButton: true
		    });
		    return; 
		}

		Swal.fire({
	        title: 'Action Required',
	        text: "Do you want to generate the report cards?",
	        icon: 'warning',
	        showCancelButton: true,
	        confirmButtonText: 'Yes, generate it!',
	        cancelButtonText: 'Cancel',
	        reverseButtons: true
	    }).then((result) => {

	        if (result.isConfirmed) {   
				Swal.fire({
					icon: 'info',
					title: 'Generating Report',
					text: 'Your request is being submitted. Please wait...',
					allowOutsideClick: false,
					didOpen: () => {
						Swal.showLoading();
					}
				});     
	            
	         	$.ajax({
		    	    headers: {
		                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
		            },
		            url: "<?php echo e(route('generate.reportcards')); ?>",
		            method: 'POST',            
		            contentType: "application/json",            
		            data: JSON.stringify({
		                _token: "<?php echo e(csrf_token()); ?>",
		                student_ids: selectedIds,
						termId: termId,
						action: action
		            }), 
			        
			        success: function(data) {
						Swal.close();
			        	if(data.status && data.message){
			        		Swal.fire({
						        icon: 'success',
						        title: "Request Submitted successfully",
						        text: data.message,
						        showCancelButton: false,
						        allowOutsideClick: false,
						        confirmButtonText: 'Ok',
							}).then((result) => {
						        if (result.isConfirmed) {
						            window.location.reload();
						        }
						    });
			        	}
			        },

			        error: function(err) {
	                    Swal.close();
	                    Swal.fire({
	                        icon: 'error',
	                        title: 'Error',
	                        text: 'Something went wrong while generating the report cards.'
	                    });
	                }
			    });

	        } else if (result.dismiss === Swal.DismissReason.cancel) {
	           
	            Swal.fire({
	                icon: 'info',
	                title: 'Cancelled',
	                text: 'Report card generation was cancelled.'
	            });
	        }
	    });

	}

	function openAvailableDownloads() {
	    $('#availableDownloadsModal').modal('show');

	    fetch("<?php echo e(route('fitness.report.available')); ?>")
	        .then(res => res.json())
	        .then(data => {
	            document.getElementById('downloadsContent').innerHTML = data.html;	
	        });
	}

	function checkSentReportStatus() {
	    $('#availableDownloadsModal').modal('show');

	    fetch("")
	        .then(res => res.json())
	        .then(data => {
	            document.getElementById('downloadsContent').innerHTML = data.html;	
	        });
	}

	function sendFitnessReportCard(e, dt, node, config, selectedIds) {

		let termId = document.getElementById('filter-school-terms').value;
		const action = "email";

		if (!selectedIds || selectedIds.length === 0) {   	

		    Swal.fire({
		        icon: 'info',
		        title: 'No Data Selected',
		        text: 'Please select at least one student.',
		        allowOutsideClick: false,
		        showConfirmButton: true
		    });
		    return; 
		}

		Swal.fire({
	        title: 'Action Required',
	        text: "Do you want to Sent the report cards to parent's email address?",
	        icon: 'warning',
	        showCancelButton: true,
	        confirmButtonText: 'Yes, Sent it!',
	        cancelButtonText: 'Cancel',
	        reverseButtons: true
	    }).then((result) => {
	        if (result.isConfirmed) {  				  
	            Swal.fire({
					icon: 'info',
					title: 'Sending Report',
					text: 'Your request is being submitted. Please wait...',
					allowOutsideClick: false,
					didOpen: () => {
						Swal.showLoading();
					}
				});
	         	$.ajax({
		    	    headers: {
		                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
		            },
		            url: "",
		            method: 'POST',            
		            contentType: "application/json",            
		            data: JSON.stringify({
		                _token: "<?php echo e(csrf_token()); ?>",
		                student_ids: selectedIds,
						termId: termId,
						action: action
		            }), 
			        
			        success: function(data) {
						Swal.close();
			        	if(data.status && data.message){
			        		Swal.fire({
						        icon: 'success',
						        title: "Request Submitted successfully",
						        text: data.message,
						        showCancelButton: false,
						        allowOutsideClick: false,
						        confirmButtonText: 'Ok',
							}).then((result) => {
						        if (result.isConfirmed) {
						            window.location.reload();
						        }
						    });
			        	}
			        },

			        error: function(err) {
	                    Swal.close();
	                    Swal.fire({
	                        icon: 'error',
	                        title: 'Error',
	                        text: 'Something went wrong while generating the report cards.'
	                    });
	                }
			    });

	        } else if (result.dismiss === Swal.DismissReason.cancel) {
	           
	            Swal.fire({
	                icon: 'info',
	                title: 'Cancelled',
	                text: 'Report card generation was cancelled.'
	            });
	        }
	    });

	}
	
</script>
<?php $__env->stopPush(); ?>


<?php echo $__env->make('layouts.filldart-app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\nep\resources\views/reports/fitnessreports.blade.php ENDPATH**/ ?>