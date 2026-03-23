@extends('layouts.filldart-app') @section('title', $title) @section('content')

@php
	$userId = Auth::user()->id; 
	$schoolsId = DB::table('school_reference')->where('school_user_id',$userId)->where('status', 1)->value('school_id'); 
	$schoolCode = DB::table('schools')->where('id',$schoolsId)->value('school_code'); 
@endphp


<style type="text/css">
	.dt-container .top .filter-right {
		order: 2;
		margin-right: 8%;
		margin-top: 5px;
	}

	#select_action {
		margin-right: 15px !important;
	}

	#record_table {
		width: 100%;
		overflow-x: auto;
		overflow-y: auto;
		display: block;
	}

	#studentTableRecords thead th {
		position: sticky;
		top: 0;
		box-shadow: 0 2px 2px -1px rgba(0, 0, 0, 0.1);
	}

	
	#studentTableRecords th:nth-child(1),
	#studentTableRecords td:nth-child(1) {
		width: 4% !important;
		min-width: 30px !important;
	}

	#studentTableRecords th:nth-child(2),
	#studentTableRecords td:nth-child(2) {
		width: 6% !important;
		min-width: 40px !important;
	}

	#studentTableRecords th:nth-child(3),
	#studentTableRecords td:nth-child(3) {
		width: 7% !important;
		min-width: 60px !important;
	}

	#studentTableRecords th:nth-child(4),
	#studentTableRecords td:nth-child(4) {
		width: 12% !important;
		min-width: 70px !important;
	}

	#studentTableRecords th:nth-child(5),
	#studentTableRecords td:nth-child(5) {
		width: 8% !important;
		min-width: 30px !important;
	}

	#studentTableRecords th:nth-child(6),
	#studentTableRecords td:nth-child(6) {
		width: 15% !important;
		min-width: 150px !important;
	}

	#studentTableRecords th:nth-child(7),
	#studentTableRecords td:nth-child(7) {
		width: 10% !important;
		min-width: 110px !important;
	}

	#studentTableRecords th:nth-child(8),
	#studentTableRecords td:nth-child(8) {
		width: 18% !important;
		min-width: 180px !important;
	}

	#studentTableRecords th:nth-child(9),
	#studentTableRecords td:nth-child(9) {
		width: 8% !important;
		min-width: 95px !important;
	}

	#studentTableRecords th:nth-child(10),
	#studentTableRecords td:nth-child(10) {
		width: 10% !important;
		min-width: 100px !important;
	}

	#studentTableRecords th:nth-child(11),
	#studentTableRecords td:nth-child(11) {
		width: 9% !important;
		min-width: 95px !important;
	}

	#studentTableRecords th:nth-child(12),
	#studentTableRecords td:nth-child(12) {
		width: 7% !important;
		min-width: 70px !important;
	}

	#studentTableRecords select {
		width: 100% !important;
		max-width: 100% !important;
		box-sizing: border-box;
	}

	#studentTableRecords th:first-child,
	#studentTableRecords td:first-child,
	#studentTableRecords th:nth-child(2),
	#studentTableRecords td:nth-child(2),
	#studentTableRecords td:last-child {
		text-align: center;
	}

	#studentTableRecords th,
	#studentTableRecords td {
		white-space: normal !important;
		word-wrap: break-word;
		word-break: break-word;
	}
	table#studentTableRecords th.dt-orderable-none .dt-column-order {
	    display: none !important;
	}

	#studentTableRecords td:last-child {
		text-align: center;
	}
	@media (max-width: 1200px) {
		#studentTableRecords {
			font-size: 0.9rem;
		}
	}

	@media (max-width: 768px) {
		#record_table {
			height: 60vh;
		}
		
		#studentTableRecords {
			font-size: 0.85rem;
		}

		.dataTables_wrapper .dataTables_filter,
		.dataTables_wrapper .dataTables_length,
		.dataTables_wrapper .dataTables_info,
		.dataTables_wrapper .dataTables_paginate {
			font-size: 0.85rem;
		}
		
		.btn-sm {
			padding: 0.25rem 0.5rem;
			font-size: 0.75rem;
		}
	}

	.invalid-age {
		background-color: #ffcccc !important;
		color: #000;
		font-weight: bold;
	}
</style>

<div class="container">
	<div class="t-mrg2 mb-5 pb-5">
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
							
							<h1 class="ml-md-4 mb-0">{{$title}}</h1>
							</div>
						
					</div>

					@if($check == 'true')
					<div class="col-auto col-md-auto" style="color: #ffffff;">
						<div class="d-flex">

							<a type="button" id="upload_btn" title="Upload Data" class="btn btn-primary custome-btn-i w-100 mr-3" data-toggle="modal" data-target="#uploadbulkdata"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-upload" viewBox="0 0 16 16"> <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5"/><path d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708z"/></svg><span>Upload Data</span> </a>
							
							<a type="button" id="addstudent" title="Add Student" class="btn btn-primary custome-btn-i w-100  mr-3" data-toggle="modal" data-target="#studentRegistrationForm"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2"/></svg><span>Add Student</span></a>

							@if($logs->isNotEmpty())
							<a type="button" class="btn btn-primary custome-btn-i w-100" data-toggle="modal" data-target="#exampleModalCenter">
							 View History
							</a>
							@endif

							
						</div>
					</div>
					@endif
				</div>
			</form>
		</div>
		

		<!-- Modal -->
		<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			<div class="modal-dialog modal-lg modal-xl modal-dialog-centered">
		      <div class="modal-content">
		         
		         <div class="modal-header">
		            <h5 class="modal-title" id="exampleModalLabel1">Upload History</h5>
		            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		            <span aria-hidden="true">&times;</span>
		            </button>
		         </div>

		        <div class="modal-body">
				     <p>
				        <strong>Note:</strong> Upload history is retained for <strong>15 days</strong> only.  
				        After 15 days, all upload history will be permanently deleted from the system.  
				        Please ensure that the uploaded file and the uploaded data are correct.
				    </p>
				</div>

		          @if($logs->isNotEmpty())   
		          <div class="row m-1">
                 <div class="col">
		          	<table class="table table-bordered table-striped table-hover">
                           <thead class="table-dark">
                               <tr>
                                   <th>#</th>
                                   <th>Uploaded By</th>
                                   <th>Upload Time</th>
                                   <th>Status</th>
                                   <th>Message</th>
                                   <th>Completed At</th>
                                   <th>Uploaded File</th>
                                   <th>Error File</th>
                               </tr>
                           </thead>
                           <tbody>
                               @foreach($logs as $index => $log)
                               <tr>
                                   <td>{{ $index + 1 }}</td>
                                   <td>{{ $log->user->name ?? 'N/A' }}</td>
                                   <td>{{ \Carbon\Carbon::parse($log->created_at)->format('d M Y h:i A') }}</td>
                                   <td>
                                       @if($log->status === 'completed')
                                           <span class="badge bg-success" style="color:#ffffff;">Completed</span>
                                       @elseif($log->status === 'processing')
                                           <span class="badge bg-warning text-dark" style="color:#ffffff;">Processing</span>
                                       @elseif($log->status === 'queued')
                                           <span class="badge bg-info text-dark" style="color:#ffffff;">Queued</span>
                                       @else
                                           <span class="badge bg-danger" style="color:#ffffff;">Failed</span>
                                       @endif
                                   </td>
                                   <td>{!! nl2br(e($log->message)) !!}</td>
                                   <td>{{ $log->completed_at ? \Carbon\Carbon::parse($log->completed_at)->format('d M Y h:i A') : '-' }}</td>
                                   
                                    <td style="text-align: center;">
                                       @if($log->file_path)
                                           <a href="{{ route('download.uploadedfile', $log->id) }}" class="btn btn-sm btn-primary">View</a>
                                       @endif
                                   </td>

                                   <td style="text-align: center;">
	                                    @if($log->error_file)
	                                        <a href="{{ route('download.errorfile', $log->id) }}" class="btn btn-sm btn-primary">View</a>
	                                    @endif                      
                                   </td>
                                 </tr>

                               @endforeach
                           </tbody>
                       </table>
                    </div>
                 </div>
		          @endif
		      </div>
		   </div>
		</div>


		@if($check == 'false')
			@include('school.bulkuploadform')
		@endif

		@if($check == 'true')
			<div class="container-fluid p-0">
				<div class="responsive m-0 mt-4 pt-2" id="record_table">

					<table id="studentTableRecords" class="table table-bordered tbl-style" >
						<thead>
							<tr>
								<th scope="col"><input type="checkbox" id="selectAll"></th>
								<th scope="col" width="4%;">#</th>
								<th scope="col">Class</th>
								<th scope="col">Section </th>
								<th scope="col">Roll No. </th>
								<th scope="col">Student Name</th>
								<th scope="col" width="10%;">Admission No.</th>
								<th scope="col">Student Email</th>
								<th scope="col">Gender</th>
								<th scope="col">Birth Date</th>
								<th scope="col">Status</th>						
								<th scope="col">Action</th>
							</tr>
						</thead>
						<tbody> </tbody>
					</table>

				</div>
			</div>
		@endif

	</div>
</div>

<!-- Bulk Upload form -->
<div class="modal fade" id="uploadbulkdata" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
  
   <div class="modal-dialog modal-lg modal-xl modal-dialog-centered">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel1">Upload Student Data</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="upload">         
		 @include('school.bulkuploadform') 
         </div>
      </div>
   </div>
</div>
<!-- EndOfTheModal -->


{{-- edit student details modal  --}}
<div class="modal fade" id="editStudentModal" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-lg modal-dialog-centered">
		<div class="modal-content">

		<div class="modal-header">
			<h5 class="modal-title">Edit Student</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
		</div>

		<div class="modal-body">
			<form id="editStudentForm">
			@csrf
			<input type="hidden" id="s_id" name="s_id">
			<input type="hidden" id="school_id" value="{{ $schoolsId }}">

			<div class="form-row"> 
				<div class="form-group col-md-4">
				<label for="editStudentAdmissionNo">Admission Number</label>
				<input type="text" name="editStudentAdmissionNo" id="editStudentAdmissionNo" class="form-control" readonly>
				</div>

				<div class="form-group col-md-4">
				<label for="editStudentName">Student Name</label>
				<input type="text" name="editStudentName" id="editStudentName" class="form-control" placeholder="Enter student name">
				<span id="editStudentName_errormsg"></span>
				</div>
				<div class="form-group col-md-4">
				<label for="editStudentEmail">Student Email</label>
				<input type="email" name="editStudentEmail" id="editStudentEmail" class="form-control" placeholder="Enter student email">
				<span id="editStudentEmail_errormsg"></span>
				</div>
			</div>

			<div class="form-row">
				<div class="form-group col-md-4">
				<label for="editStudentClass">Class</label>
				<select name="editStudentClass" id="editStudentClass" class="form-control"></select>
				<span id="editStudentClass_errormsg"></span>
			</div>
				<div class="form-group col-md-4">
				<label for="editStudentSection">Section</label>
				<select name="editStudentSection" id="editStudentSection" class="form-control"></select>
				<span id="editStudentSection_errormsg"></span>
			</div>
				<div class="form-group col-md-4">
				<label for="editStudentRollno">Roll No</label>
				<input type="text" name="editStudentRollno" id="editStudentRollno" class="form-control" onclick="rollNoSuggestions(this,
						document.getElementById('editStudentClass').value,
						document.getElementById('editStudentSection').value
					)">
				<span id="editStudentRollno_errormsg"></span>
				</div>
			</div>

			<div class="form-row"> 
				<div class="form-group col-md-4">
				<label for="editStudentDOB">Date of Birth</label>
				<input type="date" name="editStudentDOB" id="editStudentDOB" class="form-control">
				<span id="editStudentDOB_errormsg"></span>
				</div>
				<div class="form-group col-md-4">
				<label for="editStudentGender">Gender</label>
				<select name="editStudentGender" id="editStudentGender" class="form-control">
					<option value="">Select Gender</option>
					<option value="Male">Male</option>
					<option value="Female">Female</option>
				</select>
				</div>
				<div class="form-group col-md-4">
					<label for="editStudentStatus">Status</label>
					<select type="date" name="editStudentStatus" id="editStudentStatus" class="form-control">
						<option value="active">Active</option>
						<option value="transfer">Transfer</option>
					</select>
				</div>

			</div>

			<div class="modal-footer d-flex justify-content-between align-items-center">
				<span class="text-danger" id="ageSuggetion" style="opacity: 0.92;"></span>
				<div>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Update</button>
				</div>
			</div>


			</form>
		</div>
		</div>
	</div>
</div>


{{-- edit student details modal close  --}}

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
				@csrf
				<div class="modal-body">
					<input type="hidden" name="status" value="active">
					<input type="hidden" name="schools_id" value="{{ $studentsDetails[0]->schools_id ?? ''}}">
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
								<select class="form-control form-control-sm" name="gender">
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
									@foreach($classes as $class)
									<option data-id="{{ $class->className }}" value="{{ $class->id }}">{{ $class->className }}</option>
									@endforeach
								</select>
								<span id="class_errormsg"></span>
							</div>
						</div>


						<div class="col-md-4">
							<div class="form-group">
								<label for="studentSection">Section</label>
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
								<input class="form-control form-control-sm" type="text" name="school_code" value="{{ $studentsDetails[0]->school_code  ?? ''}}" readonly>
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
								<input class="form-control form-control-sm" id="studentUserId" name="studentuid" type="text" value="{{ $studentsDetails[0]->school_code  ?? ''}}" readonly>
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
				url: "{{ route('managestudent') }}",
				data: function(d) {
               d.class_id = $('#select_class').val();
               d.section_id = $('#select_section').val();
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
	                name: 'serial_no',
	                orderable: false,
	                searchable: false,
	                render: function (data, type, row, meta) {
	                    return meta.row + meta.settings._iDisplayStart + 1;
	                }
	            },
				{	data: 'class_id', name: 'class_id' },
				{  data: 'section_id', name: 'section_id'	},
				{	data: 'rollno', name: 'rollno' },
				{  data: 'student_name', name: 'student_name' },
	            {  data: 'admissionnumber', name: 'admissionnumber' },
	            {  data: 'email_id', name: 'email_id' },
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
						<div class="d-flex align-items-center gap-4">
							<button class="btn btn-sm mx-1 edit-student" 
									data-id="${row.student_id}" 
									title="edit ${row.student_name} details" style="background:#8f8f8f;">
								<i class="fas fa-edit"></i>
							</button>

							<button class="btn btn-sm btn-primary mx-1 login-as-student" 
									data-id="${row.student_id}" 
									title="Login as ${row.student_name}">
								<i class="fa-solid fa-right-to-bracket"></i>
							</button>
						</div>
						`;
					}
				},
			],
						
			createdRow: function(row, data, dataIndex) {
				const hasDobError = $(row).find('input[data-dob-error="true"]').length > 0;
				
				if (hasDobError) {
					$(row).addClass('invalid-age');
				}
			},

			columnDefs: [
		        { targets: 0, orderable: false, searchable: false, className: 'no-sort text-center dt-' }
		    ],

			"initComplete": function() {
            $('.dt-search input[type="search"]').attr('placeholder', 'Search here...');

			const $dropdown2 = $('<select class="form-control" id="select_action"></select>');

			var status = [
				{ name: 'Bulk Action', status: '',},
				{ name: 'Delete', status: 'delete', },
				// { name: 'Promote', status: 'promote', },
			];
			status.forEach(option => {
			    const section = option.status ? ` - ${option.status}` : '';
			    const displayText = option.name;
			    const value = option.status;
			    $dropdown2.append(new Option(displayText, value));
			});

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
							// url: "{{ route('del-student') }}",
							url: action === 'delete'
								? "{{ route('del-student') }}"
								: "{{ route('promote-student') }}",
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
									text: response.message,
									confirmButtonText: 'OK',
									allowOutsideClick: false
								}).then((result) => {

									if (result.isConfirmed) {
										$('#studentTableRecords').DataTable().ajax.reload();
										$('#select_action').val('');
									}

								});
							},
							error: function (xhr) {
								Swal.close();

								let message = 'Something went wrong.';

								if (xhr.responseJSON && xhr.responseJSON.message) {
									message = xhr.responseJSON.message;
								}

								Swal.fire({
									icon: 'error',
									title: 'Error',
									text: message,
									confirmButtonText: 'OK',
									allowOutsideClick: false
								}).then((result) => {
									if (result.isConfirmed) {
										$('#studentTableRecords').DataTable().ajax.reload(null, false);
										$('#select_action').val('');
									}
								});
							}
						});
					} else {
						$('#select_action').val('');
					}
				});
            });


			var classList = @json($classList);

			const $classDropdown = $('<select class="form-control" id="select_class"></select>');
			const $sectionDropdown = $('<select class="form-control" id="select_section"><option value="">Select Section</option></select>');

			const classMap = {};

			classList.forEach(item => {
				if (!classMap[item.class_id]) {
					classMap[item.class_id] = item.name;
					$classDropdown.append(new Option(item.name, item.class_id));
				}
			});

			$classDropdown.on('change', function () {
				const selectedClassId = $(this).val();

				// reset section dropdown
				$sectionDropdown.empty().append('<option value="">Select Section</option>');

				classList.forEach(item => {
					if (item.class_id == selectedClassId && item.section) {
						$sectionDropdown.append(new Option(item.section, item.section));
					}
				});

				table.ajax.reload();
			});

			$sectionDropdown.on('change', function () {
				table.ajax.reload();
			});
			const $filterWrapper = $('<div class="pull-right d-flex" style="gap:10px;"></div>');

			$filterWrapper
				.append($classDropdown)
				.append($sectionDropdown)
				.appendTo("#studentTableRecords_wrapper .top");

			$("#studentTableRecords_wrapper .top .dt-length").addClass("pull-right");


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
        },


			drawCallback: function(settings) {

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
							if (!hasSelectedStudents()) {
								showNoSelectionAlert('export to PDF');
								return;
							}
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
						text: 'Parents Login-Credentials',
						action: function ( e, dt, node, config ) {							
							generateClassSectionCredentials();
						}
					},
					{
						text: 'Generate I-Cards',
						action: function ( e, dt, node, config ) {							
							generateICards();
						}
					},
				],
			}]
		});


		table.on('draw', function () {
	     
	        $('#select-all').off('click').on('click', function () {
	            var isChecked = $(this).is(':checked');
	            $('.row-checkbox').prop('checked', isChecked);
	        });

	        $('.row-checkbox').on('change', function () {
	            var total = $('.row-checkbox').length;
	            var checked = $('.row-checkbox:checked').length;
	            $('#select-all').prop('checked', total === checked);
	        });
	    });

		table.select.style('api');

		$('#studentTableRecords').on('change', '.row-select', function() {
			var $row = $(this).closest('tr');
			var row = table.row($row);
			
			if (this.checked) {
				row.select();
			} else {
				row.deselect();
			}
			
			var allChecked = $('#studentTableRecords tbody input.row-select').length === 
						$('#studentTableRecords tbody input.row-select:checked').length;
			$('#selectAll').prop('checked', allChecked);
		});

		$('#selectAll').on('click', function() {
			var checked = this.checked;
			$('#studentTableRecords tbody input.row-select').prop('checked', checked);
			
			if (checked) {
				table.rows().select();
			} else {
				table.rows().deselect();
			}
		});

		function hasSelectedStudents() {
			return $('#studentTableRecords tbody input.row-select:checked').length > 0;
		}

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

		$('#studentTableRecords').on('click', '.edit-student', function() {
			let studentId = $(this).data('id');
			let classes = @json($classes);
			console.log(classes); 
			let sections = @json($data); 
			let students = @json($studentsDetails);
			let student = students.find(s => s.student_id == studentId);
			
			$('#s_id').val(student.student_id);
			$('#editStudentName').val(student.student_name);
			$('#editStudentEmail').val(student.email_id);
			$('#editStudentGender').val(student.gender);
			$('#editStudentDOB').val(student.dob);

			let selectClass = document.getElementById('editStudentClass');
			selectClass.innerHTML = '';

			classes.forEach(cls => {
				let option = document.createElement('option');
				option.value = cls.id;
				option.textContent = cls.className;
				if(cls.id == student.class_id) {
					option.selected = true;
				}
				selectClass.appendChild(option);
			});
			
			let selectSection = document.getElementById('editStudentSection');
			selectSection.innerHTML = '';

			sections.forEach(sec => {
				if (sec.class_id == student.class_id) { 
					let option = document.createElement('option');
					option.value = sec.section;
					option.textContent = sec.section;

					if (sec.section === student.section_id) {
						option.selected = true;
					}

					selectSection.appendChild(option);
				}
			});
			$('#editStudentClass').val(student.class_id);
			$('#editStudentSection').val(student.section_id);
			$('#editStudentRollno').val(student.rollno);
			$('#editStudentAdmissionNo').val(student.admissionnumber);
			$('#editStudentStatus').val(student.status);

			$('#editStudentModal').modal('show');
		});

		// to reset modal errors 
		$('#editStudentModal').on('hidden.bs.modal', function () {
			$(this).find('form')[0].reset();
			$('#editStudentForm').find('span').html("");
		});
		$('#editStudentModal').on('hide.bs.modal', function () {
			document.activeElement.blur();
		});


		$(document).ready(function () {
			$('#editStudentForm').on('submit', function (e) {
				e.preventDefault();
				submitForm($(this));
			});

			function submitForm(form, forceUpdate = false) {

				let formData = form.serialize();

				if (forceUpdate) {
					formData += '&force_update=1';
				}

				submitLoader();

				$.ajax({
					headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
					url: "{{ route('edit.student.details') }}",
					type: 'POST',
					data: formData,
					dataType: 'json',

					success: function(response) {

						Swal.close();

						// AGE WARNING
						if (response.status === 'age_warning') {

							Swal.fire({
								title: 'Age Mismatch',
								text: response.message,
								icon: 'warning',
								showCancelButton: true,
								confirmButtonText: 'Proceed',
								cancelButtonText: 'Cancel'
							}).then((result) => {
								if (result.isConfirmed) {
									submitForm(form, true);
								}
							});

							return;
						}

						// SUCCESS
						if (response.status === 'success') {

							Swal.fire({
								title: 'Success',
								text: response.message,
								icon: 'success',
								allowOutsideClick: false
							});

							$('#editStudentModal').modal('hide');
							$('#studentTableRecords').DataTable().ajax.reload();
							return;
						}
						if (response.status === 'fail' && response.error) {

							form.find('input, select, textarea').each(function() {
								let name = $(this).attr('name');
								$('#' + name + '_errormsg').empty();
							});

							$.each(response.error, function(key, value) {
								let errorHtml = '';
								$.each(value, function(index, errormsg) {
									errorHtml += `<p class="alert alert-danger">${errormsg}</p>`;
								});
								$('#' + key + '_errormsg').html(errorHtml);
							});

							return;
						}

						if (response.status === 'fail') {
							Swal.fire('Error', response.message, 'error');
						}
					},

					error: function() {
						Swal.close();
						Swal.fire('Error', 'Something went wrong! Please try again.', 'error');
					}
				});
			}

		});

		$('#studentTableRecords').on('click', '.login-as-student', function() {
			const studentId = $(this).data('id');
			console.log(studentId);

			$.ajax({
				url: "{{ route('school.loginAsStudent')}}",
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
				url: "{{ route('get.class.section.summary') }}",
				method: "POST",
				contentType: "application/json",
				data: JSON.stringify({
					_token: "{{ csrf_token() }}",
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
				html: `Generating I-cards for ${clsses.length} classes in a ZIP file...<br>This may take a moment.`,
				allowOutsideClick: false,
				didOpen: () => Swal.showLoading()
			});

			$.ajax({
				url: "{{ route('generatecard') }}",
				method: "POST",
				contentType: "application/json",
				data: JSON.stringify({
					_token: "{{ csrf_token() }}",
					student_ids: studentIds
				}),
				xhrFields: {
					responseType: "blob"
				},
				success: function (data, textStatus, xhr) {
					Swal.close();

					let filename = 'students-Icards-class-wise.zip';
					let successMessage = 'Class-wise I-cards downloaded successfully!';

					const disposition = xhr.getResponseHeader('Content-Disposition');
					if (disposition && disposition.indexOf('attachment') !== -1) {
						const matches = /filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/.exec(disposition);
						if (matches && matches[1]) {
							filename = matches[1].replace(/['"]/g, '');
						}
					}

					const blob = new Blob([data], { type: 'application/zip' });
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
						text: successMessage,
						showConfirmButton: true
					});
				},

				error: function (xhr) {
					Swal.close();

					let errorMessage = "An error occurred while generating I-cards.";

					if (xhr.response instanceof Blob) {
						const reader = new FileReader();
						reader.onload = function () {
							try {
								const response = JSON.parse(reader.result);
								errorMessage = response.message || errorMessage;
							} catch (e) {
								// fallback message
							}

							Swal.fire({
								icon: 'error',
								title: 'Generation Failed',
								text: errorMessage
							});
						};
						reader.readAsText(xhr.response);
					} else {
						Swal.fire({
							icon: 'error',
							title: 'Generation Failed',
							text: errorMessage
						});
					}
				}
			});
		}

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
				url: "{{ route('get.class.section.summary') }}",
				method: "POST",
				contentType: "application/json",
				data: JSON.stringify({
					_token: "{{ csrf_token() }}",
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
				url: "{{ route('generate.class.section.credentials') }}",
				method: "POST",
				contentType: "application/json",
				data: JSON.stringify({
					_token: "{{ csrf_token() }}",
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
	});

	const swalWithBootstrapButtons = Swal.mixin({
		customClass: {
			confirmButton: "btn btn-primary",
			cancelButton: "btn btn-light"
		},
		buttonsStyling: false
	});


	function updateContent(event, olddata = '', newdata = '', studentId = '', classId = '', section = '', newDate = '', status = '', gender) {

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
						updatestatus(studentId, status);
						break;
					case 'gender':
						changegender(studentId, gender);
						break;
					default:
						console.log('nothing is selected');
				}
			}

		});
	}

	$(document).on('change', '#section', function() {
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



	$(document).on('change', '.datepicker', function() {

		var studentId = $(this).attr('data-id');
		var newDate = $(this).val();

		var event = 'DOB';
		var olddob = $(this).attr('data-dob');
		var olddata = `${olddob}`;


		var date = new Date(newDate);
		var day = ('0' + date.getDate()).slice(-2);
		var month = ('0' + (date.getMonth() + 1)).slice(-2);
		var year = date.getFullYear();
		dateValue = day + '-' + month + '-' + year;


		var newdata = `${dateValue}`;
		updateContent(event, olddata, newdata, studentId, classId = '', section = '', newDate);
		//updateDate(studentId, newDate);
	});



	$(document).on('change', '#studentStatus', function() {
		var option = $(this).find('option:selected');
		var studentId = $(this).attr('data-id');
		var status = option.val();

		var event = 'status';
		var oldstatus = $(this).attr('data-status');
		var olddata = `${oldstatus}`;
		var newdata = `${status}`;
		updateContent(event, olddata, newdata, studentId, classId = '', section = '', newDate = '', status);

	});



	$(document).on('change', '#studentGender', function() {
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
	$(document).on('change', '#editStudentSection', function () {
		var stdRollno = document.getElementById('editStudentRollno');
		stdRollno.value = '';
	});

	$(document).on('change', '#studentClass, #editStudentClass', function () {

		var classId = $(this).val();
		var stdRollno = document.getElementById('editStudentRollno');
		stdRollno.value = '';
		var targetDropdown = ($(this).attr('id') === 'studentClass') 
			? '#sectionDropdown' 
			: '#editStudentSection';

		$(targetDropdown).empty().append('<option value="">Select Section</option>');

		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: 'getclasssection',
			method: 'POST',
			data: {
				classId: classId,
			},
			success: function (response) {
				$(targetDropdown).empty().append('<option value="">Select Section</option>');
				$.each(response.data, function (index, value) {
					$(targetDropdown).append(`<option value="${value.section}">${value.section}</option>`);
				});

				if (response.suggestion && response.suggestion.length === 2) {
					$('#ageSuggetion').html(
						`<strong>Note:</strong> Student age should be between ${response.suggestion[0]} and ${response.suggestion[1]} years for Class ${classId}.`
					);

				}
			},

			error: function (xhr) {
				console.error(xhr.responseText);
			}
		});
	});


	/**
	 * Update student Active/Transfer status.
	 * */
	function updatestatus(studentId, status) {
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
				console.error(xhr.responseText);
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
	function updateDate(studentId, newDate, forceUpdate = false) {
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: 'updatedob',
			method: 'POST',
			data: {
				student_id: studentId,
				new_date: newDate,
				force_update: forceUpdate ? 1 : 0
			},
			success: function(response) {

				if (response.status === 'age_warning') {

					Swal.fire({
						title: 'Age Mismatch',
						text: response.message,
						icon: 'warning',
						showCancelButton: true,
						confirmButtonText: 'Proceed',
						cancelButtonText: 'Cancel'
					}).then((result) => {

						if (result.isConfirmed) {
							updateDate(studentId, newDate, true);
						}

					});

					return;
				}

				if (response.status === 'success') {

					$('#updated_date').val(newDate);

					Swal.fire({
						title: "Success!",
						text: response.message,
						icon: "success"
					});

					return;
				}

				if (response.status === 'fail') {

					Swal.fire({
						title: "Error!",
						text: response.message,
						icon: "error"
					});
				}
			},

			error: function() {

				Swal.fire({
					title: "Error!",
					text: "Something went wrong. Please try again.",
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
		var school_code = `{{ $schoolCode }}`;
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
					console.log(key + value);
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
				console.error('Unable to copy to clipboard', err);
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
	        text: 'Please wait while the data is being imported. This may take some time.',
	        allowOutsideClick: false,
	        showConfirmButton: false,
	        didOpen: () => {
	            Swal.showLoading();
	        }
	    });

      $.ajax({
         url: "{{ route('import-student-data') }}",
         type: 'POST',
         data: formData,
         processData: false,
         contentType: false,
         success: function(response) {      
         Swal.close();   
       		if (response.error) {

       			Swal.fire({
					  icon: response.icon,
					  title: response.title,
					  html: response.summary
					}).then(function(result){
						location.reload();
					});



       			/*$('#error_msg').show();
					$('#error_msg').html(response.error);
					$('#import_msg').text('');*/

				}else{
					$('#error_msg').hide();
					$('#import_msg').text('');

					Swal.fire({
					   title: response.title,
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
	        text: 'Please wait while the data is being imported. This may take some time.',
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
			url: "{{ route('import-student-data') }}",
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

			    let message = 'An unexpected error occurred while importing data. Please try again later.';

			    if (jqXHR.status === 524) {
			        // Cloudflare timeout
			        message = 'The server is still processing your data in the background due to the large file size. Please wait and do not close this window. You will be notified once complete.';
			    } else if (textStatus === 'timeout') {
			        // Browser-side AJAX timeout
			        message = 'The server is taking longer than expected. Your data is still being processed in the background. Please wait...';
			    } else if (textStatus === 'error') {
			        // Server not reachable
			        message = 'Unable to connect to the server. Please try again after some time.';
			    } else if (jqXHR.status === 500) {
			        message = jqXHR.responseJSON?.message || 'Internal server error occurred.';
			    }

			    Swal.fire({
			        title: "Notice",
			        text: message,
			        icon: 'warning',
			        confirmButtonText: 'OK'
			    });
			}

		});
	}


	$(document).on('click', '#upload_btn', function() {
		$('#import_msg').text('');
		$('#error_msg').hide();
	});

	function rollNoSuggestions(elem, cls_id, sec_id) {

		let schoolId = document.getElementById('school_id').value;

		$(elem).tooltip('dispose').removeAttr('data-original-title');
		$(elem).removeAttr('data-original-title');
		
		$.ajax({
			url: 'rollNoSuggestion',
			type: 'POST',
			data: { 
				schoolId: schoolId,
				class_id: cls_id,
				section_id: sec_id,
			 },
			headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
			success: function(response) {
				const suggestions = response.suggested_roll_numbers;
				const tooltipText = suggestions.length 
					? "Available rolls: " + suggestions.join(', ') 
					: 'No suggestions';

				$(elem).tooltip('dispose');
				$(elem).removeAttr('data-original-title');

				$(elem).attr('title', tooltipText);
				$(elem).tooltip({
					trigger: 'focus',
					placement: 'top'
				});
				$(elem).tooltip('show');				
			},
			error: function(xhr, status, error) {
				console.error('Error fetching roll number suggestions:', error);
			}
		});
	}

</script>

@endsection
