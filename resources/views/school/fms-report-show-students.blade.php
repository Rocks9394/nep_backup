@extends('layouts.filldart-app')
@section('title', 'Goforfit | ' . $title)
@section('content')
<div class="pg-yallow-color">
    <div class="container">
        <div class="navbar-expand-lg">
            <div id="fillter" class="" role="group" aria-label="Basic example">
            </div>
        </div>
    </div>
</div>

<div class="">
    <div class="all-chaptr-cards">


        @if($errors->any())
        <div class="alert alert-info">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @if(session('success'))
        <div class="alert alert-info">
            {{ session('success') }}
        </div>
        @endif

        <!-- Success message -->
        <div class="container">
            <div class="t-mrg2">
                <div class="all-chaptr-cards">
                    <div class="form-row">
                        <div class="col col-md col-lg">
                            <div class="heading-rw mt-0 mt-md-1 mb-0 p-0">
                                <a href="{{ route('filldart.dashboard') }}" class="back-button">
                                    <span class="arrow"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5" />
                                        </svg></span>
                                
                                </a>
                            
                                <h1 class="ml-md-4 mb-0 mt-3 mt-md-0">{{$title}}</h1>
                            </div>
                        </div>

						<div class="col-auto col-md-auto col-lg-auto mb-0 mt-0 mt-md-0">
							
                                <div class="mb-3 d-flex align-items-center" style="gap:15px;">
                                    <span style="display:none" id="multiple-pdf-setting-id">	
                                        <a id="multiplePDFID" href="{{ route('school.fms.skills.multiple.pdf.download') }}" class="btn btn-primary d-flex align-items-center" style="gap:10px;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-arrow-down" viewBox="0 0 16 16">
                                            <path d="M8.5 6.5a.5.5 0 0 0-1 0v3.793L6.354 9.146a.5.5 0 1 0-.708.708l2 2a.5.5 0 0 0 .708 0l2-2a.5.5 0 0 0-.708-.708L8.5 10.293z"/>
                                            <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2M9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z"/>
                                            </svg>
                                            <span class="d-none d-sm-block">Download PDF</span>
                                        </a>
                                    </span>

                                    <input type="hidden" name="school_id" id="school_id" value="{{ $schoolId }}">

                                    <select class="form-control mx-0 w-100" name="by_class_id" id="by_class_id"  onchange="getStudentDetail(0, this.value, this.options[this.selectedIndex].getAttribute('data-class-section'))">
                                        <option value="">Select Class</option>

                                        @foreach($classes as $key => $val)
                                        <option value="{{ $val->id }}" data-class-section="{{ $val->classname.'-'.$val->section }}">{{ $val->classname.'-'.$val->section }}</option>
                                        @endforeach

                                    </select>
                                </div>
                           
						</div>

                       
                    </div>

                    
                </div>
                <div class="row">
                    <div class="col-12">
                    
                    
                    <form method="POST" class="row" name="view-trainer-report" id="" action="{{ route('student.map.students') }}">
                    {{method_field('post')}}
                    @csrf
                        <div class="col-12">

                            <div id="activity_from_div" class="sports-filtr overlay activity_cards activity-info">
                                <div class="row">

                                    <div class="col-12 col-md-12">
                                        
                                        <div class="w-100 studs-list mb-4">
                                       
												<table class="table table-striped">
												  <thead>
													<tr>
													  <th scope="col">#</th>
													  <th scope="col">Student Code</th>
													  <th scope="col">Student Name</th>
													  <th scope="col">Gender</th>
													  <th scope="col">Class</th>
													  <th scope="col">FMS Report</th>
													  <th scope="col">Download PDF</th>
													</tr>
												  </thead>
												  <tbody id="student_idd" >
												   
												  </tbody>
												</table>


                                        </div>

                                    </div>
                                    
                                </div>
                            </div>
                        </div>

                    </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
</div>



<script>
    function getStudentDetail(i, val, clsSecName) {
        
        jQuery('#student_idd').empty();
		$("#multiple-pdf-setting-id").hide();
        var school_id = jQuery('#school_id').val();
        jQuery.ajax({
            url: "{{ route('get.student.according.class') }}",
            data: {
                "custom_class_id": val,
                "school_id": school_id,
                "_token": "{{ csrf_token() }}"
            },
            type: 'GET',
            success: function(response) 
            {
                
				if(response.success)
				{
					$("#multiple-pdf-setting-id").show();
					var  MultiPlePDFURL= "{{ route('school.fms.skills.multiple.pdf.download') }}?custom_class_id="+val+"&school_id="+school_id;
					
					$("#multiplePDFID").attr('href', MultiPlePDFURL);
					
				
					$.each(response.studentList, function(key, val) 
					{
						
						var UserId = "{{ route('school.fms.skills.reports')}}?studentId="+val.id;
						var PDFId = "{{ route('school.fms.skills.reports.pdf')}}?studentId="+val.id;
						var sno = ++key;
						console.log(val);
						var content ='<tr><th scope="row">'+sno+'</th><td>'+val.student_uid+'</td><td>'+val.student_name+'</td><td>'+val.gender+'</td><td>'+clsSecName+'</td><td><a href="'+UserId+'" target="_blank">View Report</a> </td><td><a href="'+PDFId+'" target="_blank">Download PDF</a> </td></tr>';
						jQuery('#student_idd').append(content);
					
					});
					
					
				}else{
					//alert("School not found our records...");
				}

            }
        });
    }
	
 
</script>




@endsection