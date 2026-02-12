@extends('layouts.filldart-app') @section('title', $title) @section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
<div class="container">
	<div class="t-mrg2 mb-5 pb-5">

		<div class="all-chaptr-cards mb-4" style="margin: 0;">
			<div class="row">
				<x:back-button title="{{$title}}" >
					<x-slot name="actionsOutside">
				        <div >				        	
				        	<button class="btn btn-sm btn-primary" onclick="openAvailableDownloads()">Available Download</button>
				        	@include('reports.modals.available-downloads')
				        </div>
				    </x-slot>
				</x:back-button>
			</div>
		</div>

		<!-- <div class="alert alert-info d-flex align-items-start gap-2" role="alert" style="border-left: 4px solid #0d6efd;">
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
		 -->

		<div class="container-fluid p-0">

            <x-data-listing-component
                id="student-skill-reports-table"
                :headers="['Class','Section','Roll No.','Student Name', 'Admission No.','Gender','Birth Date','Report','Download']"
                :columns="[			       
			        ['data' => 'display_classname', 'name' => 'display_classname', 'orderable' => true],
			        ['data' => 'section_id',        'name' => 'section_id',        'orderable' => true],
			        ['data' => 'rollno',            'name' => 'rollno',            'orderable' => true],
			        ['data' => 'student_name',      'name' => 'student_name',      'orderable' => true, 'searchable' => true],
			        ['data' => 'admission_number',   'name' => 'admission_number',   'orderable' => true],
			        ['data' => 'gender',            'name' => 'gender',            'orderable' => true],
			        ['data' => 'dob',               'name' => 'students.dob',      'orderable' => false],
			        ['data' => 'viewReport',        'name' => 'id',                'orderable' => false],
			        ['data' => 'downloadReport',    'name' => 'id', 			   'orderable' => false],
			    ]"
				
                ajax-url="{{ route('skill.reports') }}"
                :enable-export-buttons="false"
                :enableLengthMenu="true"
				:exportButtonText="'Bulk Action'"
       			:pageLength="100"                
                :enable-class-filter="false"
                :enable-class-section-filter="true"
                :enable-school-terms-filter="true"
                {{-- :selectedClass="1" --}}
                :enable-status-filter="false"
                searchPlaceholder="Students Name | Admission"
                :export-buttons="[
                    [   
                        'type' => 'custom', 'text' => 'Request Report Cards', 'action' => 'generateFitnessReportCard'
                    ]
                ]"
               

            >

            </x-data-listing-component>
        </div>       
	</div>
</div>
@endsection


@push('scripts')
<script>

	const currentTermId = {{ $current_term_id }};

	function generateFitnessReportCard(e, dt, node, config, selectedIds, termIds) {
		

		if (!selectedIds || !termIds || selectedIds.length === 0) {   		

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
	        title: 'Are you sure?',
	        text: "Do you want to generate the report card(s)?",
	        icon: 'warning',
	        showCancelButton: true,
	        confirmButtonText: 'Yes, generate it!',
	        cancelButtonText: 'Cancel',
	        reverseButtons: true
	    }).then((result) => {

	        if (result.isConfirmed) {        
	            
	         	$.ajax({
		    	    headers: {
		                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
		            },
		            url: "{{ route('generate.skillreportcards') }}",
		            method: 'POST',            
		            contentType: "application/json",            
		            data: JSON.stringify({
		                _token: "{{ csrf_token() }}",
		                student_ids: selectedIds,
		                termIds : termIds,
		            }), 
			        
			        success: function(data) {
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

	    fetch("{{ route('skill.report.available') }}")
	        .then(res => res.json())
	        .then(data => {
	            document.getElementById('downloadsContent').innerHTML = data.html;	
	        });
	}

</script>
@endpush

