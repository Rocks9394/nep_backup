@extends('layouts.filldart-app')
@section('title', 'Goforfit | ' . $title)
@section('content')

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<div class="pg-yallow-color">
    <div class="container">
        <div class="navbar-expand-lg">
            <div id="fillter" class="" role="group" aria-label="Basic example">
            </div>
        </div>
    </div>
</div>

<div class="">
    <div class="all-chaptr-cards1">

        <div class="container">
            <div class="t-mrg2">
                <div class=" all-chaptr-cards" style="margin: 0;">
                    <form method="POST" class="" name="view-trainer-report" id="" action="{{ route('student.map.students') }}">
                            <div class="row">
                                <div class="col">
                                    <div class="heading-rw mt-0 mt-md-1 mb-0 p-0">
                                        <a href="{{ route('filldart.dashboard') }}" class="back-button">
                                            <span class="arrow"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5" />
                                                </svg></span>
                                            <!-- <span class="back-txt">Back</span> -->
                                        </a>
                                    
                                        <h1 class="mt-2 mt-md-0 ml-md-4 mb-0">{{$title}}</h1>
                                    </div>
                                </div>
                                <!-- Success message -->
                                @if (session('success'))
                                    <script>
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Success!',
                                            text: '{{ session('success') }}',
                                            confirmButtonColor: '#3085d6'
                                        });
                                    </script>
                                @endif

                                <!-- Error Alert -->
                                @if (session('error'))
                                    <script>
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Oops...',
                                            text: '{{ session('error') }}',
                                            confirmButtonColor: '#d33'
                                        });
                                    </script>
                                @endif


                                <div class="col col-md-auto">
                                    <div class="form-group select-class">
                                        <!--  <label for="Period">By Class</label><br>-->

                                        <input type="hidden" name="school_id" id="school_id" value="{{ $schoolId }}">

                                        <select class="form-control mx-0 w-100" name="by_class_id" id="by_class_id" onchange="getStudentDetail(0,this.value)">
                                            <option value="">Select Class</option>

                                            @foreach($classes as $key => $val)
                                            <option value="{{ $val->id. '-' . $val->class_id }}">{{ $val->classname.'-'.$val->section }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>


                                {{method_field('post')}}
                                @csrf

                                <div class="col-12">
                                    <p class="msg_info my-5">Please select a class to Map Students</p>
                                    <div id="activity_from_div" class="from__bx1 sports-filtr overlay">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="w-100 studs-list my-4">
                                                    <h3 class="list-heading mb-4" style="display:none" id="student-map-id">Student Map with Sport</h3>
                                                    <ul id="student_id" class="map-student">
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="form-group col-12 col-md-auto mt-2 pt-0 ml-auto mb-5" id="submit_btn_id" style="display:none">
                                                <button type="submit" name="filldata" id="activity_fillter" value="filldatasubmit" class="btn btn-primary d-block mt-2 btn-full"><i class="fa fa-filter" aria-hidden="true"></i> Save
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!---->

                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
</div>



<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    function getStudentDetail(i, val) {
		$(".msg_info").show();
        jQuery('#student_id').empty();
        //$("#submit_btn_id", "student-map-id").hide();
        $("#submit_btn_id").hide();
        $("#student-map-id").hide();

        var school_id = jQuery('#school_id').val();
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        jQuery.ajax({
            url: "{{ route('get.students.according.to.class') }}",
            data: {
                "class_id": val,
                "school_id": school_id,
                "_token": csrfToken
            },
            type: 'GET',
            success: function(response) {
                // Fetch sports data from the server
                jQuery.ajax({
                    url: "{{ route('get.sports') }}",
                    type: 'GET',
                    data: {
                        "school_id": school_id,
                        "_token": csrfToken
                    },
                    success: function(sportsResponse) {
						
						
                        //var sportsOptions = '<option value=""></option>';
                        var sportsOptions = '';
                        $.each(sportsResponse, function(key, sport) {
                            sportsOptions += '<option value="' + sport.id + '">' + sport.name + '</option>';
                        });
						
						if(response.studentrecord.length >0)
						{
							$(".msg_info").hide();
							$("#submit_btn_id").show();
                            $("#student-map-id").show();
						}else{
							$(".msg_info").show();
							$("#student-map-id").hide();
						}

                        $.each(response.studentrecord, function(key, val) {
                            //$("#submit_btn_id", "student-map-id").show();

                            var sportsData = '<select class="form-control js-example-basic-multiple mx-0 w-100" name="sports[' + val.id + '][]" id="sports_id-' + val.id + '" multiple>' + sportsOptions + '</select>';
                            jQuery('#student_id').append('<li><input type="hidden" id="std_idd-' + val.id + '" name="std_idd[]" value="' + val.id + '"><label>' + val.student_name + '</label>' + sportsData + '</li>');

                            // Initialize Select2 for the dynamically added select elements
                            $('#sports_id-' + val.id).select2();

                            // Pre-select the sports options for each student
                            if (response.mappedstudent[val.id]) {
                                $('#sports_id-' + val.id).val(response.mappedstudent[val.id]).change();
                            }
                        });
                    }
                });
            }
        });
    }

    $(document).ready(function() {
        // Initialize any existing select elements on page load
        $('.js-example-basic-multiple').select2();
    });
</script>




@endsection