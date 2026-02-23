 <?php $__env->startSection('title', $title); ?> <?php $__env->startSection('content'); ?>

<?php
	$userId = Auth::user()->id; 
	$schoolsId = DB::table('school_reference')->where('school_user_id',$userId)->where('status', 1)->value('school_id'); 
	$schoolCode = DB::table('schools')->where('id',$schoolsId)->value('school_code'); 
?>

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">


<style>
	.dt-container .top .filter-right {
		order: 2;
		margin-right: 8%;
		margin-top: 5px;
	}

	#select_action {
		margin-right: 15px !important;
	}
    .edit-pen-icon {
        position: absolute;
        top: 50%;
        right: 10px;
        transform: translateY(-50%);
        cursor: pointer;
        font-size: 14px;
        color: grey;
    }
    

   /* Force table layout */
	#studentTableRecords {
		table-layout: fixed !important;
		width: 100% !important;
	}
	#studentTableRecords col[data-dt-column="0"] { width: 2.6% !important; }
	#studentTableRecords col[data-dt-column="1"] { width: 3.5% !important; }
	#studentTableRecords col[data-dt-column="2"] { width: 8.8% !important; }
	#studentTableRecords col[data-dt-column="3"] { width: 7.0% !important; }
	#studentTableRecords col[data-dt-column="4"] { width: 7.9% !important; }
	#studentTableRecords col[data-dt-column="5"] { width: 15.8% !important; }
	#studentTableRecords col[data-dt-column="6"] { width: 10.5% !important; }
	#studentTableRecords col[data-dt-column="7"] { width: 15.8% !important; }
	#studentTableRecords col[data-dt-column="8"] { width: 8.8% !important; }
	#studentTableRecords col[data-dt-column="9"] { width: 10.5% !important; }
	#studentTableRecords col[data-dt-column="10"] { width: 8.8% !important; }

	#studentTableRecords select,
	#studentTableRecords input {
		width: 100% !important;
		max-width: 100% !important;
		box-sizing: border-box !important;
		white-space: normal !important;
		overflow-wrap: anywhere !important;
	}	
	/* #studentTableRecords .no-grey[readonly] {
		background-color: #fff !important;
		color: black;
		opacity: 1;
		cursor: default
	} */
	.form-control[readonly] {
		background-color: #ffffff;
		opacity: 1;
	}
</style>

<div class="container">
	<div class="t-mrg2 mb-5 pb-5">
		<!-- <div class="t-mrg2 mb-5 pb-4"> -->
		<div class=" all-chaptr-cards" style="margin: 0;">
			<!-- Success message -->
			<form method="POST" name="view-trainer-report" id="reportform" action="javascript(0);">
				<div class="row">
					<div class="col">
							<div class="heading-rw mt-3 mt-md-1 mb-0 p-0">
							<a href="#a" onclick="history.back()" class="back-button">
								<span class="arrow">
									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
										<path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5" />
									</svg>
								</span>
							</a>
							
							<h1 class="ml-md-4 mb-0"><?php echo e($title); ?></h1>
							</div>
						
					</div>

					<?php if($check == 'true'): ?>
					<div class="col-auto col-md-auto" style="color: #ffffff;">
						<div class="d-flex">
							<a type="button" id="upload_btn" title="Upload Data" class="btn btn-primary custome-btn-i w-100 mr-3" data-toggle="modal" data-target="#uploadbulkdata"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-upload" viewBox="0 0 16 16"> <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5"/><path d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708z"/></svg><span>Upload Data</span> </a>
							<a type="button" id="addstudent" title="Add Student" class="btn btn-primary custome-btn-i w-100" data-toggle="modal" data-target="#studentRegistrationForm"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2"/></svg><span>Add Student</span></a>
						</div>
					</div>
					<?php endif; ?>
				</div>
			</form>
		</div>

		<?php if($check == 'false'): ?>
			<?php echo $__env->make('school.bulkuploadform', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<?php endif; ?>

		<?php if($check == 'true'): ?>
		<div class="container-fluid p-0">
			<div class="responsive m-0 mt-4 pt-2" id="record_table">
				<table id="studentTableRecords" class="table table-bordered tbl-style" >
					<thead>
						<tr>
							<th><input type="checkbox" id="selectAll"></th>
							<th scope="col">#</th>
							<th>Class</th>
							<th scope="col">Section </th>
							<th scope="col">Roll No </th>
							<th scope="col">Student Name</th>
							<th scope="col">Admission Number</th>
							<th scope="col">Email</th>
							<th scope="col">Gender</th>
							<th scope="col">Birth Date</th>
							<th scope="col">Status</th>
							<th scope="col">Login</th>
						</tr>
					</thead>
					<tbody> </tbody>
				</table>
			</div>
		</div>
		<?php endif; ?>

	</div>
</div>

<!-- Bulk Upload form -->
<div class="modal fade" id="uploadbulkdata" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
   <!-- <div class="modal-dialog modal-xl modal-dialog-centered" role="document"> -->
   	<div class="modal-dialog modal-lg modal-xl modal-dialog-centered">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel1">Upload Student Data</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="upload">         
			<?php echo $__env->make('school.bulkuploadform', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
         </div>
      </div>
   </div>
</div>
<!-- EndOfTheModal -->



<!-- Registration Form For Students -->
<div class="modal fade bd-example-modal-lg" id="studentRegistrationForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Add Student</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			   
			<form action="javascript:void(0);" id="RegistrationForm">
				<?php echo csrf_field(); ?>
				<div class="modal-body">
					<input type="hidden" name="status" value="active">
					<input type="hidden" name="schools_id" value="<?php echo e($studentsDetails[0]->schools_id ?? ''); ?>">
					<input type="hidden" name="className" value="active">

					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="studentName">Student Name</label>
								<input class="form-control form-control-sm" id="studentName" type="text" name="student_name" placeholder="Enter Name">
								<span id="student_name_errormsg"></span>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="studentGender">Gender</label>
								<select class="form-control form-control-sm" name="gender" id="studentGender">
									<option value="">Select Gender</option>
									<option value="Male">Male</option>
									<option value="Female">Female</option>
								</select>
								<span id="gender_errormsg"></span>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="studentDob">Date Of Birth</label>
								<input class="form-control form-control-sm" id="studentDob" name="dob" type="date">
								<span id="dob_errormsg"></span>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="studentEmail">Email</label>
								<input class="form-control form-control-sm" id="studentEmail" name="email" type="email" placeholder="Enter Email" aria-describedby="emailHelp">
								<span id="email_errormsg"></span>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="studentClass">Class</label>
								<select class="form-control form-control-sm" name="class" id="studentClass">
									<option value="">Select Class</option>
									<?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<option data-id="<?php echo e($class->className); ?>" value="<?php echo e($class->id); ?>"><?php echo e($class->className); ?></option>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</select>
								<span id="class_errormsg"></span>
							</div>
						</div>


						<div class="col-md-4">
							<div class="form-group">
								<label for="sectionDropdown">Section</label>
								<select class="form-control form-control-sm" name="section" id="sectionDropdown">
									<option value="">Select Section</option>
								</select>
								<span id="section_errormsg"></span>
							</div>
						</div>
					</div>
					<div class="row">


						<div class="col-md-4">
							<div class="form-group">
								<label for="studentRollno">Roll Number</label>
								<input class="form-control form-control-sm" id="studentRollno" name="rollno" type="text" placeholder="Roll Number">
								<span id="rollno_errormsg"></span>
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group">
								<label for="studentUserId">School Code</label>
								<input class="form-control form-control-sm" type="text" name="school_code" value="<?php echo e($studentsDetails[0]->school_code  ?? ''); ?>" readonly>
							</div>
						</div>
				

						<div class="col-md-4">
							<div class="form-group">
								<label for="studentRegistration">Student Registration</label>
								<input class="form-control form-control-sm" id="studentRegistration" name="student_uid" type="text" placeholder="Enter Registration No.">
								<span id="student_uid_errormsg"></span>
							</div>
						</div>

						<div class="col-md-4 registerstudent">
							<div class="form-group">
								<label for="studentUserId">Student User ID</label>
								<input class="form-control form-control-sm" id="studentUserId" name="studentuid" type="text" value="<?php echo e($studentsDetails[0]->school_code  ?? ''); ?>" readonly>
								<span id="studentuid_errormsg"></span>
							</div>
						</div>
					</div>

				</div>

				<div class="modal-footer">
					<button type="submit" class="btn btn-sm btn-primary">Save</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- EndOfTheModal -->


<!-- SuccessModal get POP Up when student get added successfully -->
<div class="modal fade" id="showMessage" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="success_title"> Student Added Sucessfully </h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<p>Securely store student login details for future access!</p>
				<div id="logindetails"> </div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-sm btn-secondary textareacopybtn" onclick="copyToClipboard()">Copy</button>
			</div>
		</div>
	</div>
</div>
<!-- EndOfTheModal -->



<script>
	$(document).ready(function() {
		function setMaxDate() {
			var today = new Date();
			var year = today.getFullYear();
			var month = ("0" + (today.getMonth() + 1)).slice(-2);
			var day = ("0" + today.getDate()).slice(-2);
			var formattedDate = year + "-" + month + "-" + day;
			$('#studentDob').attr('max', formattedDate);
		}
		setMaxDate();
	});


	/*** Manipulate the Table with the Student Details.	* */


	$(document).ready(function() {

		var table = $('#studentTableRecords').DataTable({
			dom: `<"top"lf><"filter-right"B>rt<"bottom"ip><"clear">`,
			lengthChange: true,
			lengthMenu: [
				[20, 40, 60, 80, 100, -1],
				[20, 40, 60, 80, 100, 'All']
			],
			pageLength: 100,
			info: true,
			responsive: true,
			processing: true,
			serverSide: true,

			ajax: {
				url: "<?php echo e(route('managestudent')); ?>",
				data: function(d) {
			d.class_id = $('#select_class').val();
			d.status = $('#select_status').val();
			}
			},
			columns: [
				{	
					targets: 0,
					data: null,
					name: 'checkbox',
					orderable: false,
					searchable: false,
					className: 'no-sort text-center',
					defaultContent: '',
					render: function(data, type, row) {
						return `<input type="checkbox" name="checkbox" class="row-select" data-id="${row.student_id}">`;
					}
				},
				{
					data: null,
					orderable: false,
					searchable: false,
					className: 'serial-number',
					defaultContent: '',
					render: function(data, type, row, meta) {
						return meta.row + 1;
					}
				},

				{	data: 'class_id', name: 'class_id' },
				{  data: 'section_id', name: 'section_id'},
				{  
					data: 'rollno', 
					name: 'rollno', 
					render: function(data, type, row) {
						return `
						<div class="rollno-edit-wrapper position-relative">
							<input type="number" 
							class="form-control form-control-sm student-rollno update_rollno" 
							value="${data}" 
							data-rollno="${row.rollno}" 
							data-id="${row.student_id}" 
							readonly 
							style="padding-right: 30px;"
							onmouseenter="fetchTooltipSuggestions(this, ${row.student_id})"
							>
							<span class="edit-pen-icon" title="edit">
							<i class="fa-solid fa-pen"></i>
							</span>
						</div>
						`;
					}
				},

				{  
					data: 'student_name',
					name: 'student_name',
					render: function(data, type, row) {
						return `
							<div class="name-edit-wrapper position-relative">
								<input type="text" 
									class="form-control form-control-sm student-name update_name" 
									value="${data}" 
									data-name="${row.student_name}" 
									data-id="${row.student_id}" 
									readonly 
									style="padding-right: 30px;">
								<span class="edit-pen-icon" title="edit"><i class="fa-solid fa-pen"></i>
								</span>
							</div>
							`;
					}
				},
				{  data: 'registration_no', name: 'registration_no',
					render: function(data, type, row) {
						return `
							<div class="uid-edit-wrapper position-relative">
								<input type="text" 
									class="form-control form-control-sm student-uid update_uid" 
									value="${data}" 
									data-uid="${row.student_uid}" 
									data-id="${row.student_id}" 
									readonly 
									style="padding-right: 30px;">
								<span class="edit-pen-icon" title="edit"><i class="fa-solid fa-pen"></i>
								</span>
							</div>
							`;
					}						
				},
				{
					data: 'email',
					name: 'email',
					render: function(data, type, row) {
						return `
							<div class="email-edit-wrapper position-relative">
								<input type="email" 
									class="form-control form-control-sm student-email update_email" 
									value="${data}" 
									data-email="${row.email_id}" 
									data-id="${row.student_id}" 
									readonly 
									style="padding-right: 30px;">
								<span class="edit-pen-icon" title="edit"><i class="fa-solid fa-pen"></i>
								</span>
							</div>
							`;
					}
				},					
				{ 	data: 'gender', name: 'gender' },
				{	data: 'dob', name: 'dob' },
				{	data: 'status', name: 'status'},
				{
					data: null,
					orderable: false,
					searchable: false,
					className: 'text-center',
					defaultContent: '',
					render: function(data, type, row) {
						return `
							<button class="btn btn-sm btn-primary login-as-student" 
									data-id="${row.student_id}" 
									title="Login as ${row.student_name}">
								<i class="fa-solid fa-right-to-bracket"></i>
							</button>
						`;
					}
				},			
			],
			columnDefs: [
				{ targets: 0, orderable: false, className: 'no-sort' }
			],
			searchDelay: 2000,

			order: [[2, 'asc'], [3, 'asc'], [4, 'asc']],


			"initComplete": function() { 
			$('.dt-search input[type="search"]').attr('placeholder', 'Search here...');

				var classList = <?php echo json_encode($classList, 15, 512) ?>;
			const $dropdown = $('<select class="form-control" id="select_class"></select>');
			classList.forEach(option => {
				const section = option.section ? ` - ${option.section}` : '';
				const displayText = option.name + section;
				const value = option.class_id + '-' + option.section;
				$dropdown.append(new Option(displayText, value));
			});

			$('<div class="pull-right"></div>').append($dropdown).appendTo("#studentTableRecords_wrapper .top").next('.dt-length').addClass("pull-right");
			$dropdown.on('change', function() {
			table.ajax.reload();
			});


				var status = [
					{ name: 'Select Status', status: '',},
					{ name: 'Active', status: 'active', },
					{ name: 'Transfer', status: 'transfer', },
				];
				const $dropdown1 = $('<select class="form-control" id="select_status"></select>');
				status.forEach(option => {
					const section = option.status ? ` - ${option.status}` : '';
					const displayText = option.name;
					const value = option.status;

					$dropdown1.append(new Option(displayText, value));
				});
			$('<div class="pull-right"></div>').append($dropdown1).appendTo("#studentTableRecords_wrapper .top").next('.dt-length').addClass("pull-right");
			$dropdown1.on('change', function() {
			table.ajax.reload();
			});

			const $dropdown2 = $('<select class="form-control" id="select_action"></select>');

			var status = [
				{ name: 'Bulk Action', status: '',},
				{ name: 'Delete', status: 'delete', },
				{ name: 'Promote', status: 'promote', },
			];
			status.forEach(option => {
			    const section = option.status ? ` - ${option.status}` : '';
			    const displayText = option.name;
			    const value = option.status;
			    $dropdown2.append(new Option(displayText, value));
			});

			// $('<div class="pull-right"></div>').append($dropdown2).appendTo("#studentTableRecords_wrapper .top").next('.dt-length').addClass("pull-right");

            $('<div class="filter-right"></div>').append($dropdown2).appendTo("#studentTableRecords_wrapper .top").next('.dt-length').addClass("pull-right");


            $dropdown2.on('change', function() {

            	const action = $(this).val();
				var selectedIds = [];
				$('#studentTableRecords tbody input.row-select:checked').each(function() {
					selectedIds.push($(this).data('id'));
				});
				if (selectedIds.length === 0) {
				Swal.fire({
						icon: 'warning',
						title: 'No students selected',
						text: 'Please select at least one student.'
					});
					$('#select_action').val('');
					return;
				}

				Swal.fire({

					icon: 'warning',
					title: `Are you sure you want to ${action} the selected ${selectedIds.length} student(s)?`,
					text: "You won't be able to revert this!",
					showCancelButton: true,
					confirmButtonColor: "#3085d6",
					confirmButtonText: "Yes, proceed!",
					cancelButtonText: "Cancel",
					allowOutsideClick: false,
					reverseButtons: true,
				}).then((result) => {
					if (result.isConfirmed) {

						Swal.fire({
							title: 'Processing...',
							text: 'Please wait while we perform the action.',
							allowOutsideClick: false,
							didOpen: () => {
								Swal.showLoading();
							}
						});

						$.ajax({
							// url: "<?php echo e(route('del-student')); ?>",
							url: action === 'delete'
								? "<?php echo e(route('del-student')); ?>"
								: "<?php echo e(route('promote-student')); ?>",
							method: 'POST',
							data: {
								_token: $('meta[name="csrf-token"]').attr('content'),
								action: action,
								ids: selectedIds
							},
							success: function (response) {
								Swal.close();
								Swal.fire({
									icon: 'success',
									title: 'Success',
									text: response.message
								});

								$('#studentTableRecords').DataTable().ajax.reload();
								$('#select_action').val('');
							},
							error: function (xhr) {
								Swal.close();
								Swal.fire({
									icon: 'info',
									title: 'Error',
									text: 'The system is currently busy processing other requests. Please try again in a few moments.'
								}).then(() => {
								
									$('#studentTableRecords').DataTable().ajax.reload();
									$('#select_action').val('');
								});;
							}
						});
					} else {
						$('#select_action').val('');
					}
				});
            });
		},


			drawCallback: function(settings) {
				// Update select all checkbox state
				var allChecked = $('#studentTableRecords tbody input.row-select').length === 
							$('#studentTableRecords tbody input.row-select:checked').length;
				$('#selectAll').prop('checked', allChecked);

				$('#studentTableRecords tbody tr').removeClass('highlight-row');
				$('#studentTableRecords tbody tr').each(function() {
					var $row = $(this);
					var birthDateInput = $row.find('input[name="birth_date"]');
					if (birthDateInput.length && birthDateInput.val() === 'Fill date') {
						$row.addClass('highlight-row');
					}
				});
			},


			buttons: [{
				extend: 'collection',
				text: 'Export',
				className: 'exportButton',
				buttons: [
					{
						extend: 'excelHtml5', 
						text: 'Excel',
						filename: function() {
							return getTimestamp();
						},
						action: function (e, dt, button, config) {
							// Check if any students are selected
							if (!hasSelectedStudents()) {
								showNoSelectionAlert('export to Excel');
								return;
							}
							// Proceed with Excel export
							$.fn.dataTable.ext.buttons.excelHtml5.action.call(this, e, dt, button, config);
						},
						exportOptions: {
							modifier: {
								selected: true
							},
							columns: function (idx, data, node) {
								return idx !== 0 && idx != 11;
							},
							format: {
								body: function(data, row, column, node) {
									return processExportData(data, row, column, node);
								}
							},
						},
					},

					{
						extend: 'csvHtml5',
						text: 'CSV',
						filename: function() {
							return getTimestamp();
						},
						action: function (e, dt, button, config) {
							// Check if any students are selected
							if (!hasSelectedStudents()) {
								showNoSelectionAlert('export to CSV');
								return;
							}
							// Proceed with CSV export
							$.fn.dataTable.ext.buttons.csvHtml5.action.call(this, e, dt, button, config);
						},
						exportOptions: {
							modifier: {
								selected: true
							},
							columns: function (idx, data, node) {
								return idx !== 0 && idx != 11;
							},							
							format: {
								body: function(data, row, column, node) {
									return processExportData(data, row, column, node);
								}
							}
						}
					},

					{
						extend: 'pdfHtml5',
						text: 'PDF',
						filename: function() {
							return getTimestamp();
						},
						orientation: 'landscape',
						pageSize: 'A4', 
						action: function (e, dt, button, config) {
							// Check if any students are selected
							if (!hasSelectedStudents()) {
								showNoSelectionAlert('export to PDF');
								return;
							}
							// Proceed with PDF export
							$.fn.dataTable.ext.buttons.pdfHtml5.action.call(this, e, dt, button, config);
						},
						exportOptions: {
							modifier: {
								selected: true
							},
							columns: function (idx, data, node) {
								return idx !== 0 && idx != 11;
							},
							format: {
								body: function(data, row, column, node) {
									return processExportData(data, row, column, node);
								}
							}
						}
					},

					{
						text: 'Generate I-Cards',
						action: function ( e, dt, node, config ) {							
							generateICards();
						}
					},

					{
						text: 'Generate Login-Credentials',
						action: function ( e, dt, node, config ) {							
							generateClassSectionCredentials();
						}
					}

				],
			}]
		});
		

	table.on('preXhr.dt', function() {
			Swal.fire({
					icon : 'info',
				title: 'Loading Students...',
				html: 'Please wait while data is being loaded.',
				allowOutsideClick: false,
				didOpen: () => {
					Swal.showLoading();
				}
			});
	});

	table.on('xhr.dt', function() {
			Swal.close();
	});


		// When DataTable finishes drawing rows
		$('#studentTableRecords').on('draw.dt', function () {
			attachPenClickHandlers();
		});

		function attachPenClickHandlers() {
			document.querySelectorAll('.edit-pen-icon').forEach(icon => {
				icon.onclick = function () {
					const input = this.previousElementSibling;

					if (input.hasAttribute('readonly')) {
						input.removeAttribute('readonly');
						input.focus();
					} else {
						input.setAttribute('readonly', true);
					}
				};
			});
		}

		attachPenClickHandlers();

		// Enable row selection for DataTables
		table.select.style('api');

		// Handle row selection when checkboxes are clicked
		$('#studentTableRecords').on('change', '.row-select', function() {
			var $row = $(this).closest('tr');
			var row = table.row($row);
			
			if (this.checked) {
				row.select();
			} else {
				row.deselect();
			}
			
			// Update select all checkbox state
			var allChecked = $('#studentTableRecords tbody input.row-select').length === 
						$('#studentTableRecords tbody input.row-select:checked').length;
			$('#selectAll').prop('checked', allChecked);
		});

		// Handle select all functionality
		$('#selectAll').on('click', function() {
			var checked = this.checked;
			
			// Update all checkboxes
			$('#studentTableRecords tbody input.row-select').prop('checked', checked);
			
			// Update DataTables selection
			if (checked) {
				table.rows().select();
			} else {
				table.rows().deselect();
			}
		});

		// Function to check if any students are selected
		function hasSelectedStudents() {
			return $('#studentTableRecords tbody input.row-select:checked').length > 0;
		}

		// Function to show no selection alert
		function showNoSelectionAlert(actionType) {
			Swal.fire({
				icon: 'warning',
				title: 'No Students Selected',
				html: `Please select at least one student to ${actionType}.`,
				confirmButtonText: 'OK',
				confirmButtonColor: '#3085d6'
			});
		}

		function processExportData(data, row, column, node) {
			var $node = $(node);
			if ($node.find('input[type="checkbox"]').length || $node.find('[name="action"]').length) {
				return null;
			}
			var sectionDropdown = $node.find('select[name="section_id"]');
			if (sectionDropdown.length) {
				var sectionText = sectionDropdown.find('option:selected').text().trim();
				return sectionText || '';
			}
			var otherDropdowns = $node.find('select').not('[name="section_id"]');
			if (otherDropdowns.length) {
				var otherDropdownValue = otherDropdowns.map(function() {
					return $(this).find('option:selected').text().trim();
				}).get().join(', ');
				return otherDropdownValue;
			}
			var inputElement = $node.find('input');
			if (inputElement.length) {
				if (inputElement.attr('name') === 'birth_date') {
					var dateInput = inputElement.val();
					if (dateInput) {
						var date = new Date(dateInput);
						var day = ('0' + date.getDate()).slice(-2);
						var month = ('0' + (date.getMonth() + 1)).slice(-2);
						var year = date.getFullYear();
						return `${day}-${month}-${year}`;
					}
				}
				return inputElement.val() || inputElement.text() || data;
			}
			return data;
		}

		function getTimestamp() {
			let now = new Date();
			let year = now.getFullYear();
			let month = String(now.getMonth() + 1).padStart(2, '0');
			let day = String(now.getDate()).padStart(2, '0');
			let hours = String(now.getHours()).padStart(2, '0');
			let minutes = String(now.getMinutes()).padStart(2, '0');
			let seconds = String(now.getSeconds()).padStart(2, '0');
			return `Students Record ${day}-${month}-${year}`;
		}

			// Add this function to your existing JavaScript
		function generateClassSectionCredentials() {
			var studentIds = [];
			$('#studentTableRecords tbody input.row-select:checked').each(function() {
				studentIds.push($(this).data('id'));
			});

			if (studentIds.length === 0) {
				Swal.fire({
					icon: 'warning',
					title: 'No students selected',
					text: 'Please select at least one student to generate credentials.'
				});
				return;
			}

			// First get class-section summary to show preview
			Swal.fire({
				title: 'Loading...',
				text: 'Analyzing class-section structure',
				allowOutsideClick: false,
				didOpen: () => { Swal.showLoading(); }
			});

			$.ajax({
				url: "<?php echo e(route('get.class.section.summary')); ?>",
				method: "POST",
				contentType: "application/json",
				data: JSON.stringify({
					_token: "<?php echo e(csrf_token()); ?>",
					student_ids: studentIds
				}),
				success: function(response) {
					Swal.close();
					showExportOptions(response.class_summary, studentIds);
				},
				error: function(xhr, status, error) {
					Swal.close();
					Swal.fire({
						icon: 'error',
						title: 'Error',
						text: 'Failed to analyze student data'
					});
				}
			});
		}

		function showExportOptions(classSummary, studentIds) {
			Swal.fire({
				title: 'Generate Login Credentials',
				icon: 'info',
				html: `
					<div style="text-align:left">
						<p class="text-center mb-3"><strong>Select Export Option</strong></p>
						<label><input type="radio" name="exportOption" value="single" checked> Download all students credentials</label><br>
						<label><input type="radio" name="exportOption" value="separate"> Download class-wise credentials<strong> (.zip)</strong></label><hr>
						<p class="text-center"><small><i class="fas fa-info-circle"></i> ${classSummary.length} classes, ${studentIds.length} students total</small></p>
					</div>
				`,
				showCancelButton: true,
				confirmButtonText: 'Generate',
				cancelButtonText: 'Cancel',
				reverseButtons: true,
				allowOutsideClick: false,
				width: 400,
				preConfirm: () => {
					const option = document.querySelector('input[name="exportOption"]:checked').value;
					return { exportOption: option };
				}
			}).then(result => {
				if (result.isConfirmed) {
					generateCredentialsFiles(studentIds, result.value.exportOption, classSummary);
				}
			});
		}


		function generateCredentialsFiles(studentIds, exportType, classSummary = null) {
			const isFolderStructure = exportType === 'separate';
			
			Swal.fire({
				icon: 'info',
				title: isFolderStructure ? "Creating Class-wise Folders" : "Generating Single File",
				html: isFolderStructure 
					? `Creating folder structure with ${classSummary.length} classes...<br>This may take a moment.`
					: "Generating single credentials file...",
				allowOutsideClick: false,
				didOpen: () => { Swal.showLoading(); }
			});

			$.ajax({
				url: "<?php echo e(route('generate.class.section.credentials')); ?>",
				method: "POST",
				contentType: "application/json",
				data: JSON.stringify({
					_token: "<?php echo e(csrf_token()); ?>",
					student_ids: studentIds,
					export_type: exportType
				}),
				xhrFields: { 
					responseType: "blob" 
				},
				success: function (data, textStatus, xhr) {
					Swal.close();
					
					let filename = 'students-credentials-all-classes.xlsx';
					let successMessage = 'Credentials generated successfully!';
					if (isFolderStructure) {
						filename = 'students-credentials-class-wise.zip';
						successMessage = `Class-wise credentials generated!`;
					}

					// Try to get filename from response headers
					const disposition = xhr.getResponseHeader('Content-Disposition');
					if (disposition && disposition.indexOf('attachment') !== -1) {
						const filenameRegex = /filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/;
						const matches = filenameRegex.exec(disposition);
						if (matches != null && matches[1]) {
							filename = matches[1].replace(/['"]/g, '');
						}
					}

					const blob = new Blob([data]);
					const downloadUrl = window.URL.createObjectURL(blob);
					const link = document.createElement('a');
					link.href = downloadUrl;
					link.download = filename;
					document.body.appendChild(link);
					link.click();
					document.body.removeChild(link);
					window.URL.revokeObjectURL(downloadUrl);
					
					Swal.fire({
						icon: "success",
						title: "Download Complete!",
						html: successMessage,
						showConfirmButton: true,
						allowOutsideClick: false,
					});
				},
				error: function(xhr, status, error) {
					Swal.close();
					let errorMessage = "An error occurred while generating files.";
					
					try {
						const response = JSON.parse(xhr.responseText);
						errorMessage = response.message || errorMessage;
					} catch (e) {
						// Use default error message
					}
					
					Swal.fire({
						icon: 'error',
						title: 'Generation Failed',
						text: 'No active students'
					});
				}
			});
		}

		function generateICards() {
			var studentIds = [];
			$('#studentTableRecords tbody input.row-select:checked').each(function() {
				studentIds.push($(this).data('id'));
			});

			if (studentIds.length === 0) {
				Swal.fire({
					icon: 'warning',
					title: 'No students selected',
					text: 'Please select at least one student to generate I-Cards.'
				});
				return;
			}

			Swal.fire({
				title: 'Loading...',
				text: 'Analyzing class-section structure',
				allowOutsideClick: false,
				didOpen: () => { Swal.showLoading(); }
			});

			$.ajax({
				url: "<?php echo e(route('get.class.section.summary')); ?>",
				method: "POST",
				contentType: "application/json",
				data: JSON.stringify({
					_token: "<?php echo e(csrf_token()); ?>",
					student_ids: studentIds
				}),
				success: function(response) {
					Swal.close();
					generateIcardsFiles(studentIds, response.class_summary);
				},
				error: function(xhr, status, error) {
					Swal.close();
					Swal.fire({
						icon: 'error',
						title: 'Error',
						text: 'Failed to analyze student data'
					});
				}
			});

		}

		function generateIcardsFiles(studentIds, clsses) {
			
			Swal.fire({
				icon: 'info',
				title: "Creating Class-wise Folders",
				html: `Generating I-cards for ${clsses.length} classes in .zip file...<br>This may take a moment.`,
				allowOutsideClick: false,
				didOpen: () => { Swal.showLoading(); }
			});

			$.ajax({
				url: "<?php echo e(route('generatecard')); ?>",
				method: "POST",
				contentType: "application/json",
				data: JSON.stringify({
					_token: "<?php echo e(csrf_token()); ?>",
					student_ids: studentIds,
				}),
				xhrFields: { 
					responseType: "blob" 
				},
				success: function (data, textStatus, xhr) {
					Swal.close();
						filename = 'students-Icards-class-wise.zip';
						successMessage = `Class-wise Icards downloaded!`;
						
					// Try to get filename from response headers
					const disposition = xhr.getResponseHeader('Content-Disposition');
					if (disposition && disposition.indexOf('attachment') !== -1) {
						const filenameRegex = /filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/;
						const matches = filenameRegex.exec(disposition);
						if (matches != null && matches[1]) {
							filename = matches[1].replace(/['"]/g, '');
						}
					}

					const blob = new Blob([data]);
					const downloadUrl = window.URL.createObjectURL(blob);
					const link = document.createElement('a');
					link.href = downloadUrl;
					link.download = filename;
					document.body.appendChild(link);
					link.click();
					document.body.removeChild(link);
					window.URL.revokeObjectURL(downloadUrl);
					
					Swal.fire({
						icon: "success",
						title: "Download Complete!",
						html: successMessage,
						showConfirmButton: true,
						allowOutsideClick: false,
					});
				},
				error: function(xhr, status, error) {
					Swal.close();
					let errorMessage = "An error occurred while generating files.";
					
					try {
						const response = JSON.parse(xhr.responseText);
						errorMessage = response.message || errorMessage;
					} catch (e) {
						// Use default error message
					}
					
					Swal.fire({
						icon: 'error',
						title: 'Generation Failed',
						text: 'No active students'
					});
				}
			});
		}

	});

	const swalWithBootstrapButtons = Swal.mixin({
		customClass: {
			confirmButton: "btn btn-primary",
			cancelButton: "btn btn-light"
		},
		buttonsStyling: false
	});

	// reusable debounce for 

	function debounce(func, delay) {
		let timer;
		return function(...args) {
			clearTimeout(timer);
			timer = setTimeout(() => func.apply(this, args), delay);
		};
	}


	function updateContent(event, olddata = '', newdata = '', studentId = '', classId = '', section = '', newDate = '', newEmail = '', status = '', gender, $input = null) {

		swalWithBootstrapButtons.fire({
			title: `Are you sure want to change ${event} from ${olddata} to ${newdata}? `,
			text: "",
			icon: "warning",
			showCancelButton: true,
			confirmButtonText: "Yes, Update it",
			cancelButtonText: "Cancel",
			reverseButtons: true,
			allowOutsideClick: false,

		}).then((result) => {

			if (result.isConfirmed) {

				switch (event) {
					case 'section':
						updateSection(studentId, classId, section);
						break;
					case 'DOB':
						updateDate(studentId, newDate);
						break;
					case 'status':
						updatestatus(studentId, newdata);
						break;
					case 'gender':
						changegender(studentId, newdata);
						break;
					case 'email':
						updateEmail(studentId, newdata)
						break;
					case 'rollno':
						updateRollno(studentId, newdata, $input)
						break;
					case 'name':
						updateName(studentId, newdata)
						break;
					case 'UID':
						updateAdmissionNo(studentId, newdata)
						break;
					default:
						console.log('nothing is selected');
				}
			}

		});
	}

	// login as student 
	$('#studentTableRecords').on('click', '.login-as-student', function() {
		const studentId = $(this).data('id');
		console.log(studentId);

		$.ajax({
			url: "<?php echo e(route('school.loginAsStudent')); ?>",
			method: 'POST',
			data: {
				student_id: studentId,
				_token: $('meta[name="csrf-token"]').attr('content')
			},
			success: function(response) {
				if (response.success) {
					window.location.href = response.redirect_url;
				} else {
					Swal.fire({
						title: 'Login failed',
						icon: 'warning',
						text: response.message,
						allowOutsideClick: false,
						confirmButtonText: 'OK'
					});
				}
			},
			error: function() {
				Swal.fire({
					title: '',
					icon: 'warning',
					text: response.error,
					allowOutsideClick: false,
					confirmButtonText: 'OK'
				});
			}
		});
	});

	
	// to update name 

	const debouncedUpdateName = debounce(function($input) {
		const newName = $input.val().trim();
		const olddata = $input.attr('data-name');
		const studentId = $input.attr('data-id');

		const validChar = /^[a-zA-Z][a-zA-Z\s.']*$/u;

		if (!validChar.test(newName)) {
			Swal.fire({
				icon: 'warning',
				title: 'Invalid Name',
				text: 'Please enter a valid name (letters, spaces, dots, and apostrophes only).',
				allowOutsideClick: false,
				confirmButtonText: 'OK'
			}).then(() => {
				$input.val(olddata);
			});
			return;
		}

		if (newName && newName !== olddata) {
			const event = 'name';
			updateContent(event, olddata, newName, studentId, '', '');
		}
	}, 2000);

	
	$(document).on('keyup', '.student-name', function () {
		debouncedUpdateName($(this));
	});

	// to update email 

	const debouncedUpdateEmail = debounce(function($input) {
		const newEmail = $input.val().trim();
		const olddata = $input.attr('data-email');
		const studentId = $input.attr('data-id');
		const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

		if (!emailRegex.test(newEmail)) {
			$input.addClass('is-invalid');
			return;
		} else {
			$input.removeClass('is-invalid');
		}

		if (newEmail && newEmail !== olddata) {
			const event = 'email';
			updateContent(event, olddata, newEmail, studentId, '', '');
		}
	}, 2000);

	
	$(document).on('keyup', '.student-email', function () {
		debouncedUpdateEmail($(this));
	});

	// to update roll no 
	function fetchTooltipSuggestions(elem, studentId) {
		if ($(elem).data('tooltip-loaded')) return;

		$.ajax({
			url: 'rollNoSuggestion',
			type: 'POST',
			data: {
			student_id: studentId
			},
			headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			success: function(response) {
			const suggestions = response.suggested_roll_numbers;
			const tooltipText = suggestions.length 
				? "Suggestion: " + suggestions.join(', ') 
				: 'No suggestions';

			$(elem)
				.attr('title', tooltipText)
				.data('tooltip-loaded', true);
			$(elem).tooltip?.('dispose')?.tooltip?.();
			},
				error: function(xhr, status, error) {
				console.error('Error fetching roll number suggestions:', error);
			}
		});
	}

	
	const debouncedUpdateRollno = debounce(function($input) {
		const roll_number = $input.val().trim();
		const olddata = $input.attr('data-rollno');
		const studentId = $input.attr('data-id');
		const newRollno = roll_number === "" ? null : roll_number;

		if (newRollno===null || newRollno < 1) {
			Swal.fire({
				title: '',
				text: "Invalid roll number",
				icon: 'warning'
			});
			return;
		}
		if (newRollno && newRollno !== olddata) {
			const event = 'rollno';
			// updateContent(event, olddata, newRollno, studentId, '', '');
			updateContent(event, olddata, newRollno, studentId, '', '', '', '', '', '', $input);
		}
	}, 1000);

	
	$(document).on('keyup', '.student-rollno', function () {
		debouncedUpdateRollno($(this));
	});

	// update admission number 

	const debouncedupdateAdmissionNo = debounce(function($input) {
		const newUID = $input.val().trim();
		const olddata = $input.attr('data-uid');
		const studentId = $input.attr('data-id');
		
		const invalidChars = /[^a-zA-Z0-9\-\/]/g;
		
		if (invalidChars.test(newUID)) {
			$input.val(olddata);
			$input.focus();
			return;
		}
		
		console.log(olddata);
		if (newUID && newUID !== olddata) {
			const event = 'UID';
			updateContent(event, olddata, newUID, studentId, '', '');
		}
	}, 2000);

	$(document).on('keyup', '.student-uid', function () {
		const $input = $(this);
		const newUID = $input.val();
		
		const invalidChars = /[^a-zA-Z0-9\-\/]/g;
		
		if (invalidChars.test(newUID)) {
			$input.addClass('is-invalid');
			$input.attr('title', 'Only A-Z, 0-9, -, / are allowed');
			return;
		} else {
			$input.removeClass('is-invalid');
			$input.removeAttr('title');
			
			debouncedupdateAdmissionNo($input);
		}
	});


	// update dob 

	const debouncedupdateDOB = debounce(function($input) {
		const studentId = $input.attr('data-id');
		const newDate = $input.val(); 
		const olddob = $input.attr('data-dob');

		if (!newDate) return; 

		const date = new Date(newDate);
		const day = ('0' + date.getDate()).slice(-2);
		const month = ('0' + (date.getMonth() + 1)).slice(-2);
		const year = date.getFullYear();
		const newdata = `${day}-${month}-${year}`;
		date.setHours(0, 0, 0, 0);

		const today = new Date();
		const minAllowYear = today.getFullYear() - 2;
		const currentInputYear = date.getFullYear();

		if (currentInputYear > minAllowYear) {
			Swal.fire({
				title: 'Warning',
				text: "Student's age can't be less than 2 years.",
				icon: 'warning',
				confirmButtonText: 'OK',
				allowOutsideClick: false,
				allowEscapeKey: false,
			}).then(() => {
				$input.val(formatToInputDate(olddob));
			});
			return;
		}

		updateContent('DOB', olddob, newdata, studentId, '', '', newDate);

	}, 2000);

	$(document).on('change', '.datepicker', function() {
		debouncedupdateDOB($(this));
	});

	// to revert old dob format 
	function formatToInputDate(ddmmyyyy) {
		const parts = ddmmyyyy.split('-'); // ["12", "07", "2022"]
		const yyyy = parts[2];
		const mm = parts[1];
		const dd = parts[0];
		return `${yyyy}-${mm}-${dd}`; // "2022-07-12"
	}

	// to update section 

	$(document).on('change', '.section', function() {
		var option = $(this).find('option:selected');
		var studentId = $(this).attr('data-id');
		
		var event = 'section';
		var classId = option.val();
		var section = option.text().trim();
		var oldsection = $(this).attr('data-section');
		var olddata = `${oldsection}`;
		var newdata = `${section}`;
		updateContent(event, olddata, newdata, studentId, classId, section);
	});



	$(document).on('change', '.studentStatus', function() {
		var option = $(this).find('option:selected');
		var studentId = $(this).attr('data-id');
		var status = option.val();

		var event = 'status';
		var oldstatus = $(this).attr('data-status');
		var olddata = `${oldstatus}`;
		var newdata = `${status}`;
		updateContent(event, olddata, newdata, studentId, classId = '', section = '', newDate = '', status);

	});



	$(document).on('change', '.studentGender', function() {
		var option = $(this).find('option:selected');
		var studentId = $(this).attr('data-id');
		var gender = option.val();

		var event = 'gender';
		var oldgender = $(this).attr('data-gender');
		var olddata = `${oldgender}`;
		var newdata = `${gender}`;

		updateContent(event, olddata, newdata, studentId, classId = '', section = '', newDate = '', status = '', gender);
	});


	/**
	 * 26-07-2024
	 * Change Section Based on selected classs.
	 * */

	$(document).on('change', '#studentClass', function() {
		var option = $(this).find('option:selected');
		var classId = option.val();

		$('#sectionDropdown').empty().append('<option value="">Select Section</option>');

		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: 'getclasssection',
			method: 'POST',
			data: {
				classId: classId,
			},
			success: function(response) {
				$.each(response.data, function(index, value) {
					$('#sectionDropdown').append('<option value="' + value.section + '">' + value.section + '</option>');
				});
			},
			error: function(xhr, status, error) {
				// console.error(xhr.responseText);
			}
		});
	});


	/**
	 * Update student Active/Transfer status.
	 * */
	function updatestatus(studentId, status) {
		console.log(status);
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: 'changestatus',
			method: 'POST',
			data: {
				studentId: studentId,
				status: status,
			},
			success: function(response) {
				Swal.fire({
					title: "success!",
					text: response,
					icon: "success"
				});
			},
			error: function(xhr, status, error) {
				// console.error(xhr.responseText);
			}
		});
	}


	/**
	 * Function to update student gender.
	 * */
	function changegender(studentId, gender) {

		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: 'changegender',
			method: 'POST',
			data: {
				studentId: studentId,
				gender: gender,
			},
			success: function(response) {
				Swal.fire({
					title: "success!",
					text: response,
					icon: "success"
				});
			},
			error: function(xhr, status, error) {
				console.error(xhr.responseText);
			}
		});

	}

	/**
	 * Function to udpate DOB of student. 
	 * */
	
	function updateDate(studentId, newDate) {
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: 'updatedob',
			method: 'POST',
			data: {
				student_id: studentId,
				new_date: newDate
			},
			success: function(response) {
				Swal.fire({
					title: "success!",
					text: response,
					icon: "success"
				});
			},
			error: function(xhr, status, error) {
				console.error(xhr.responseText);
			}
		});
	}
	
	// Function to update Email

	function updateEmail(studentId, newEmail) {
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: 'updateEmail',
			method: 'POST',
			data: {
				student_id: studentId,
				newEmail: newEmail
			},
			success: function(response) {
				Swal.fire({
					title: "success!",
					text: response,
					icon: "success"
				});
			},
			error: function(xhr, status, error) {
				console.error(xhr.responseText);
			}
		});
	}

	// to update roll no 
	function updateRollno(studentId, newRollno, $input = null) {
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: 'updateRollNo',
			method: 'POST',
			data: {
				student_id: studentId,
				newRollno: newRollno
			},
			success: function(response) {
				Swal.fire({
					title: "success!",
					text: response,
					icon: "success"
				});
				if ($input) {
					$input.removeAttr('title').removeData('tooltip-loaded');
					fetchTooltipSuggestions($input, studentId);
				}
			},
			error: function(xhr, status, error) {
				Swal.fire({
					title: "",
					text: xhr.responseJSON.message,
					icon: "error"
				});
			}
		});
	}


	function updateName(studentId, newName) {
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: 'updateName',
			method: 'POST',
			data: {
				student_id: studentId,
				newName: newName
			},
			success: function(response) {
				Swal.fire({
					title: "success!",
					text: response,
					icon: "success"
				});
			},
			error: function(xhr, status, error) {
				Swal.fire({
					title: "",
					text: xhr.responseJSON.message,
					icon: "error"
				});
			}
		});
	}

	// update UID/Registration Number
	function updateAdmissionNo(studentId, newUID) {
		console.log(newUID);
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: 'updateAdmissionNo',
			method: 'POST',
			data: {
				student_id: studentId,
				newUID: newUID
			},
			success: function(response) {
				Swal.fire({
					title: "success!",
					text: response,
					icon: "success"
				});
			},
			error: function(xhr, status, error) {
				Swal.fire({
					title: "",
					text: xhr.responseJSON.message,
					icon: "error"
				});
			}
		});
	}



	/**
	 * Function to Update the Student's Class Section.
	 * */
	function updateSection(studentId, classId, section) {
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: 'updatesection',
			method: 'POST',
			data: {
				student_id: studentId,
				classId: classId,
				section: section
			},
			success: function(response) {

				//alert(response)
				Swal.fire({
					title: "success!",
					text: response,
					icon: "success"
				});

			},
			error: function(xhr, status, error) {
				console.error(xhr.responseText);
			}
		});
	}



	/**
	 * Manipulate Student User Id Input Field into the Registration form based on student registration number filled
	 * by the School Admin.  
	 * */


	$(document).on('keyup', '#studentRegistration', function() {
		$('.registerstudent').css('display', 'block');
		var school_code = `<?php echo e($schoolCode); ?>`;
		if ($(this).val() !== '') {
			$('#studentUserId').val(school_code + $(this).val());
		} else {
			$('.registerstudent').css('display', 'none');
		}
	});

	$(document).on('click', '#addstudent', function() {
		$('.registerstudent').css('display', 'none');
	});


	/**
	 * Handle Student Registration Form.
	 * */
	$(document).on('submit', 'form#RegistrationForm', function(e) {
		e.preventDefault();

		var data = new FormData($('form#RegistrationForm')[0]);
		$('#student_name_errormsg').empty();

		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: 'addstudent',
			method: 'POST',
			data: data,
			dataType: 'json',
			processData: false,
			contentType: false,
			success: function(response) {

				data.forEach(function(value, key) {
					$('#' + key + '_errormsg').empty();
				});

				if (response.status == 'success') {
					$('#studentRegistrationForm').modal('hide');
					$('form#RegistrationForm')[0].reset();
					$('#showMessage').modal('show');
					$('#success_title').text(response.message);

					var html = `
            		<p> Student Name :  ${response.student_name}</p>
            		<p> Roll Number  :  ${response.data.rollno}</p>
					<p> Student User Id :  ${response.StudentUserId}</p>
					<p> Login Password  :  ${response.Password}</p>`;
					$('#logindetails').empty().append(html);

				}


				if (response.status == 'fail') {
					$.each(response.error, function(key, value) {
						var html = '';
						$.each(value, function(index, errormesg) {
							html += `<p class="alert alert-danger"> ${errormesg}</p>`;
						});
						$('#' + key + '_errormsg').html(html);
					});

				} else {
					$.each(response.error, function(key, value) {
						$('#' + key + '_errormsg').empty();
					});
				}
			},

			error: function(xhr, status, error) {
				$('#validation-errors').html('');
				$.each(xhr.responseJSON.errors, function(key, value) {
					// console.log(key + value);
					$('#validation-errors').append('<div class="alert alert-danger">' + value + '</div');
				});
			},

		});
	})

	/**
	 * Function to clipboard
	 * */
	function copyToClipboard() {
		var copyButton = $('.textareacopybtn');
		copyButton.text('Copy');
		var copydata = $('#logindetails').text();

		navigator.clipboard.writeText(copydata).then(function() {
				copyButton.text('Copied');
				setTimeout(function() {
					copyButton.text('Copy');
				}, 1500);
			})
			.catch(function(err) {
				// console.error('Unable to copy to clipboard', err);
				copyButton.text('Copy');
			});
	}



	/**
	 * 09-09-2024
	 * check number of records going to import.
	 * */
	
	$('#bulkuploadform').on('submit', function(event) {
      event.preventDefault();
      var formData = new FormData(this);
      
	   Swal.fire({
	        title: 'Processing...',
	        text: 'Please wait while the data is being imported.',
	        allowOutsideClick: false,
	        showConfirmButton: false,
	        didOpen: () => {
	            Swal.showLoading();
	        }
	    });

      $.ajax({
         url: "<?php echo e(route('import-student-data')); ?>",
         type: 'POST',
         data: formData,
         processData: false,
         contentType: false,
         success: function(response) {      
         Swal.close();   
       		if (response.error) {
       			$('#error_msg').show();
					$('#error_msg').html(response.error);
					$('#import_msg').text('');
				}else{
					$('#error_msg').hide();
					$('#import_msg').text('');

					Swal.fire({
					   title: "Ready to Import!",
					   html: ` <div> ${response.summary} </div> `,
					   icon: response.icon,
					   showCancelButton: true,
					   confirmButtonText: response.cnfmText,
					   cancelButtonText: "Cancel!",
					   customClass: {
                    confirmButton: response.btnclass || 'btn-import',
                    cancelButton: 'btn-cancel',
                  },
					   reverseButtons: true,
					   allowOutsideClick: false,
						didOpen: () => {

							$(document).off('click', '.btn-import');
							$(document).off('click', '.btn-overwrite');
							$(document).off('click', '.btn-cancel');

							$('.btn-import').on('click', function() {
						  		formData.set('event','import');
						      importdata(formData);
						   });

						   $('.btn-overwrite').on('click', function() {
						  	   formData.set('event','override');
						      importdata(formData);
						   });

						   $('.btn-cancel').on('click', function() {
						      Swal.fire('Cancelled', 'The action was cancelled.', 'info');
						      Swal.close(); 
						   });

						   $('input[name="importOption"]').change(function() {
                         var selectedOption = $('input[name="importOption"]:checked').val(); 
                         var gettext = $('input[name="importOption"]:checked').attr('data-id');
                         var newClass = selectedOption === 'override' ? 'btn-overwrite' : 'btn-skipandimport';
                         Swal.getConfirmButton().className = `swal2-confirm ${newClass} swal2-styled`;
                         Swal.getConfirmButton().textContent = `${gettext}`;
                         $('.swal2-confirm').off('click').on('click', function() {
                             formData.set('event', selectedOption);
                             importdata(formData);
                         });
                     });
						}
					});	
				}
         },

         error: function(jqXHR, textStatus, errorThrown) {
            Swal.close();
            $('#error_msg').text('An unexpected error occurred.').show();
         }

      });
   });


	function importdata(formData){
		
	    Swal.fire({
	        title: 'Processing...',
	        text: 'Please wait while the data is being imported.',
	        allowOutsideClick: false,
	        showConfirmButton: false,
	        didOpen: () => {
	            Swal.showLoading();
	        }
	    });

	   $.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			type: "POST",
			url: "<?php echo e(route('import-student-data')); ?>",
			data: formData,
			processData: false,
			contentType: false,
			dataType: 'json',
			success: function(response) {
				Swal.close();

				Swal.fire({
					title: "Thank you for uploading the data.",
				    html: ` <div> ${response.summary} </div> `,
				   icon: "success",
				   allowOutsideClick: false
				}).then(function(result){
					location.reload();
				});
			},
			error: function(jqXHR, textStatus, errorThrown) {
        
            Swal.close();
            Swal.fire({
                title: "Error!",
                text: 'An unexpected error occurred while importing data.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        }

		});
	}


	$(document).on('click', '#upload_btn', function() {
		$('#import_msg').text('');
		$('#error_msg').hide();
	});




	$(document).on('click', '.student-login', function() {
	    const studentId = $(this).data('id');
	    const schools_id = $(this).data('schools_id');

	     const url = '<?php echo e(route("student.dashboard")); ?>?student_id=' + studentId + '&schools_id=' + schools_id;
	    // Create a temporary link and click it
	    const link = document.createElement('a');
	    link.href = url;
	    link.target = '_blank';
	    link.rel = 'noopener noreferrer';
	    link.click();
	});



	
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.filldart-app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\nep\resources\views/school/managestudent.blade.php ENDPATH**/ ?>