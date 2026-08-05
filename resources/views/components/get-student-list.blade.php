<div>
    <!-- I begin to speak only when I am certain what I will say is not better left unsaid. - Cato the Younger -->
    <div class="form-row my-2">
        <input type="hidden" id="all_classes" value='@json($classes)'>
        <input type="hidden" id="cwsn_type" value="{{ $cwsnType ?? 'None Specified' }}">

        <div class="col-12 col-md-4">
            <div class="form mt-1 mt-md-3">
                <label for="class_id" class="form-label">Select Class</label>
                <div class="input-group1 mb-3">
                    <select name="class_id" id="class_id" class="form-control">
                    <option value="">-- Select Class --</option>

                        @foreach ($classes as $customcls)
                    <option value="{{ $customcls->id . '-' . $customcls->class_id.'-'.$customcls->section }}">
                        {{ $customcls->classname . '-' . $customcls->section}}
                    </option>
                        @endforeach

                    </select>
                </div>
            </div>
        </div>
			
        <div class="col-12 col-md-7">
            <div class="form mt-1 mt-md-3">
                <label for="student_id" class="form-label">Select Student</label>
                <div class="input-group1 mb-3">
                    <select name="student_id" id="student_id" data-test-type="{{$type}}" class="form-control">
                        <option value="">-- Select Student --</option>
                    </select>
                </div>
            </div>
        </div> 


         @php
        $userId  = \Auth::id();
        $trainerName = auth()->user()->name;
        @endphp
    
        
        @if(Auth::user()->id == '995')

        <div class="col-12 col-md-1">
            <div class="form mt-1 mt-md-3">
                <div class="mb-3" style="margin-top:32px;">
                   <a href="{{ route('scan') }}"
                        class="btn btn-outline-secondary px-3 ml-0 d-flex justify-content-center align-items-center border-btn" id="scanner_btn" 
                        style="gap: 5px" data-toggle="modal" data-target=".bd-scan-modal-lg"><span
                            class="d-flex"><i class="bi bi-qr-code"></i></span>
                        <span>Scan</span>
                    </a>

                </div>
            </div>
        </div> 
        @endif
    </div>


    <div class="row my-2">
        <div class="col-12">
            <div class="card alert alert-warning border-0" style="box-shadow: none; min-height:auto;">

                <div class="d-flex w-100 align-items-center">
                    
                    <!-- Left Side (Takes up exactly 50% width) -->
                    <div class="w-50 pe-3">
                        <p class="mb-1 text-dark">
                            <strong id="student_name">Student Name </strong>&nbsp;|&nbsp;<span id="student_registration_no"> Registration Number: </span> 
                        </p>
                        <p class="mb-0 text-dark">
                            <span id="student_class"> Class</span>&nbsp;|&nbsp;Roll No: <span id="student_roll_no"></span>
                        </p>
                    </div>
                    @if($cwsnType == 7)
                   <div style="border-left: 1px solid #343a40; opacity: 0.3; height: 40px; margin: 0 20px;"></div>
                    <div class="w-50 border-start border-dark ps-4">
                        <p class="mb-1 text-dark">
                            <strong id="anthropometric_id">Anthropometric Measurement</strong>
                        </p>
                        <p class="mb-0 text-dark">
                            <strong>Height:</strong> <span id="height_value"></span>&nbsp;|&nbsp;
                            <strong>Weight:</strong> <span id="weight_value"></span>
                        </p>
                    </div>
                    @endif

                </div>
                
            </div>
        </div>
    </div>

</div>


<div class="modal fade bd-scan-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="left:20px; z-index:5; background:#fff;">
                <span aria-hidden="true">&times;</span>
            </button>
            <div id="my-qr-reader" style="position: relative; padding: 0px; border: 1px solid silver;">                
            </div>
        </div>
    </div>

</div>

@push('scripts')


<script>
   
function openAIScreen() {
    const studentSelect = document.querySelector('select[name="student_id"]');
    const classSelect = document.querySelector('select[name="class_id"]');
    
    const pathArray = window.location.pathname.split('/');
    const exerciseId = pathArray[pathArray.length - 1]; 

    if (!studentSelect || !studentSelect.value || studentSelect.value === "") {
        alert("Please select a student first!");
        return;
    }

    // Use Blade syntax to inject the values safely
    const trainerName = "{{ $trainerName }}";
    const exerciseTitle = "{{ $title }}";
    const currentTrainerId = "{{ $userId }}";

    const selectedOption = studentSelect.options[studentSelect.selectedIndex];
    const actualStudentId = selectedOption.getAttribute('data-id');
    const rollNoValue = studentSelect.value;
    const classSection = classSelect ? classSelect.options[classSelect.selectedIndex].text : "N/A";
    const fullText = selectedOption.text;
    
    let rollNo = rollNoValue;
    let studentName = fullText;

    if (fullText.includes('|')) {
        const parts = fullText.split('|');
        rollNo = parts[0].replace(/Roll No:/i, '').trim();
        studentName = parts[1].replace(/Name:/i, '').trim();
    }

    // --- DYNAMIC DATA: Construct URL parameters ---
    const queryParams = new URLSearchParams({
        id: actualStudentId,
        name: studentName,
        roll: rollNo,
        class_info: classSection,
        ex_id: exerciseId,
        trainerId: currentTrainerId, // MUST match what exercise-header.js reads
        traiName: trainerName,
        exerciseName: exerciseTitle     
    }); 
	
	
    
    // We make baseUrl a re-assignable 'let' variable so we can change it dynamically
    let baseUrl = "https://talentid.goforfit.in/";
    let pageName = "";

    switch (exerciseTitle) {
        // ────────────────────────────────────────────────────────
        // 1. NEW FASTAPI INTEGRATION
        // ────────────────────────────────────────────────────────
        case 'WingSpan':
        case 'Anthropometry':
            // Overwrite baseUrl to use your clean secure Apache reverse proxy directory
            baseUrl = "https://talentid.goforfit.in/fms/";
            pageName = "screen4"; // Triggers the /screen2 route in app.py
            break;

        // ────────────────────────────────────────────────────────
        // 2. OLD WORKING FRONTEND SCRIPT PATHS
        // ────────────────────────────────────────────────────────
        case 'Push Ups':
            pageName = "standard-push-ups.html";
            break;
        case 'Flamingo Balance Test':
        case 'One-Foot Balance':
            pageName = "single-leg-balance.html";
            break;
        case 'Flexed/Bent Arm Hang':
            pageName = "bent-arm-hang.html";
            break;
        case 'Plate Tapping':
            pageName = "plate-tapping.html";
            break;
        //case 'BMI':
           // pageName = "height-winspam-calculate.html";
           // break;
        case 'Partial curl up 30 sec':
            pageName = "partial-curl-up.html";
            break;
        case 'Vertical Jump':
            pageName = "standing-vertical-jump1.html";
            break;
        default:
            alert("Exercise page not found for: " + exerciseTitle);
            return;
    }

    // Build the URL with the data attached
    const aiUrl = `${baseUrl}${pageName}?${queryParams.toString()}`;

    // Open the window
    window.open(aiUrl, 'AIWindow', 'width=1200,height=800');
}


/**
 * Dedicated launch function for FastAPI AI Engine screens.
 * Leaves openAIScreen() completely untouched for legacy HTML tests.
 */
function openFastAPIScreen() {
    const studentSelect = document.querySelector('select[name="student_id"]');
    const classSelect   = document.querySelector('select[name="class_id"]');
    
    const pathArray  = window.location.pathname.split('/');
    const exerciseId = pathArray[pathArray.length - 1]; 

    if (!studentSelect || !studentSelect.value || studentSelect.value === "") {
        Swal.fire({
            icon: 'warning',
            title: 'Select Student',
            text: 'Please select a student first!'
        });
        return;
    }

    // Pull student metadata
    const selectedOption  = studentSelect.options[studentSelect.selectedIndex];
    const actualStudentId = selectedOption.getAttribute('data-id');
    const rollNoValue     = studentSelect.value;
    const classSection    = classSelect ? classSelect.options[classSelect.selectedIndex].text : "N/A";
    const fullText        = selectedOption.text;
    
    let rollNo      = rollNoValue;
    let studentName = fullText;

    if (fullText.includes('|')) {
        const parts = fullText.split('|');
        rollNo      = parts[0].replace(/Roll No:/i, '').trim();
        studentName = parts[1].replace(/Name:/i, '').trim();
    }

    // Blade context
    const trainerName      = "{{ $trainerName }}";
    const exerciseTitle    = "{{ $title }}";
    const currentTrainerId = "{{ $userId }}";

    // Clean test key formatted for FastAPI (e.g., "WingSpan" -> "wingspan")
    const testKey = exerciseTitle.toLowerCase().replace(/[^a-z0-9]/g, '_');

    // Build query parameters for FastAPI screen4
    const queryParams = new URLSearchParams({
        test: testKey,                  // 'wingspan', 'anthropometry', 'bmi', etc.
        id: actualStudentId,            // Student ID
        name: studentName,              // Student Name
        roll: rollNo,                   // Roll Number
        class_info: classSection,        // Class & Section
        ex_id: exerciseId,              // Exercise ID
        trainerId: currentTrainerId,    // Trainer ID
        traiName: trainerName,          // Trainer Name
        exerciseName: exerciseTitle     // Original Title
    });

    // Clean secure FastAPI base proxy endpoint
    const baseUrl  = "https://talentid.goforfit.in/fms/";
    const pageName = "screen4";

    const aiUrl = `${baseUrl}${pageName}?${queryParams.toString()}`;

    // Open in dedicated popup window
    window.open(aiUrl, 'FastAPIAIWindow', 'width=1280,height=800,scrollbars=yes,resizable=yes');
}
	
</script>







<script src="https://unpkg.com/html5-qrcode@2.3.8/html5-qrcode.min.js"></script>

<script>
    function domReady(fn) {
        if (document.readyState === "complete" || document.readyState === "interactive") {
            setTimeout(fn, 1000);
        } else {
            document.addEventListener("DOMContentLoaded", fn);
        }
    }
    let htmlscanner; 
    let testType = '';

    domReady(function () {

        $('.bd-scan-modal-lg').on('shown.bs.modal', function () {
            testType = $('#student_id').data('test-type');
            if (!htmlscanner) {
                htmlscanner = new Html5QrcodeScanner( "my-qr-reader", { fps: 10, qrbos: 240 } );
                htmlscanner.render(onScanSuccess);
            }
        });

        $('.bd-scan-modal-lg').on('hidden.bs.modal', function () {
            if (htmlscanner && typeof htmlscanner.clear === 'function') {
                htmlscanner.clear().then(() => {
                    htmlscanner = null;
                    $('#my-qr-reader').html("");
                }).catch(err => {
                    console.error("Scanner cleanup error:", err);
                });
            }
        });

        function extractUserId(decodeText) {
            const match = decodeText.match(/Goforfit Id\s*:\s*([A-Z0-9]+)/i);
            return match ? match[1] : null;
        }

        function onScanSuccess(decodeText, decodeResult) {
            let allClasses = $('#all_classes').val(); 
            let parsedClasses = [];
            let studentDropdown = document.getElementById('student_id');

            try {
                parsedClasses = JSON.parse(allClasses);
            } catch (e) {
                console.error("Invalid classes JSON", e);
            }

            if (!htmlscanner || typeof htmlscanner.clear !== 'function') {
                console.warn('Scanner not initialized');
                return;
            }
            htmlscanner.clear().then(() => {
                $('.bd-scan-modal-lg').modal('hide');
                submitLoader();

                const student_reg_no = extractUserId(decodeText);

                if (!student_reg_no) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Invalid QR Code',
                        text: 'User ID not found in QR code.'
                    });
                    return;
                }

                let school_id = $('#SchoolId').val();
                let skillReportId = $("input[name='skillReportId']").val();

                $.ajax({
                    url: '{{ route("fetch.student.detail") }}',
                    method: 'GET',
                    data: {
                        student_reg_no: student_reg_no,
                        skillReportId: skillReportId,
                        testType: testType,
                        school_id: school_id,                        
                        scan_classes: parsedClasses 
                    },
                    success: function(response) {
                        Swal.close();
                        if (!response.success || !response.data) {
                            Swal.fire({
                                icon: 'info',
                                title: 'Student Not Found',
                                text: response.message || 'No data returned for this student.'
                            });
                            return;
                        }
                        const studentData = response.data;
                        
                        studentDropdown.innerHTML = '<option value="">-- Select Student --</option>';
                        if (studentData.test_already_given === true) {
                            clearExistingRecords(response, skillReportId, school_id, response.data.class_name, testType);
                            return;
                        }                                                       
                        $('#student_name').text(response.data.name);
                        $('#student_class').text(response.data.class_name);
                        $('#student_registration_no').text(response.data.student_registration_no);
                        $('#selected_student_id').val(response.data.student_id);
                        $('#student_roll_no').text(response.data.student_roll_no);
                        $('#AGE_GENDER_ID').attr('placeholder', response.data.Age+ '/' + response.data.Gender);

                        $('#anthropo_ht_id').val(response.data.anthropo_ht_id);
                        $('#anthropo_wt_id').val(response.data.anthropo_wt_id);


                        //console.log('response', response.data)
                    },
                    error: function(xhr, status, error) {
                        Swal.close();
                        console.error('AJAX error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Request Failed',
                            text:error
                        });
                    }
                });

            }).catch(err => {
                console.error('Failed to clear htmlscanner:', err);
                Swal.fire({
                    icon: 'error',
                    title: 'Camera Error',
                    text: `Failed to stop camera after scanning: ${err.message || err}`
                });
            });
        }
    });



    $(document).ready(function () {
        if(localStorage.getItem("selected_class")){
            let savedClass = localStorage.getItem("selected_class");
            document.getElementById('class_id').value = savedClass;
            getStudents(savedClass);
        }
        $('#class_id').on('change', function () {
            let classCustom = this.value;
            localStorage.setItem('selected_class',classCustom);
            getStudents(classCustom);
        });

        function getStudents(classCustom){
            let skillReportId = $("input[name='skillReportId']").val();
            let testType = $('#student_id').data('test-type');
            const testStatus = localStorage.getItem("testStatus");
            let cwsn_type = $('#cwsn_type').val();

            $('#student_name').text('Student Name');
            $('#student_class').text('Class');
            $('#student_registration_no').text('Registration Number');
            $('#selected_student_id').val('');
            $('#AGE_GENDER_ID').text('');
            $('#student_roll_no').text('');
            $('#roll_no_id').val('');

            $('#anthropo_ht_id').val('');
            $('#anthropo_wt_id').val('');
            $('#height_value').text('');
            $('#weight_value').text('');



            let studentDropdown = document.getElementById('student_id');
            studentDropdown.innerHTML = '<option value="">Loading...</option>';

            if (classCustom) {
                fetch(`{{ route('studentRollNo.autocomplete') }}?class_id=${classCustom}&test_status=${testStatus}&skillReportId=${skillReportId}&testType=${testType}&cwsn_type=${cwsn_type}&query=`)
                    .then(response => response.json())
                    .then(data => {
                        studentDropdown.innerHTML = '';
                        let localData = localStorage.getItem("selected_student");
                        let localIds = [];

                        if (localData) {
                            try {
                                const parsed = JSON.parse(localData);
                                localIds = parsed.map(item => item.studentId);
                            } catch (e) {
                                console.error("Error parsing localStorage:", e);
                            }
                        }

                        let filteredData = data.filter(item => !localIds.includes(item.id));

                        if (Array.isArray(filteredData) && filteredData.length > 0) {
                            studentDropdown.innerHTML = '<option value="">-- Select Student --</option>';
                            filteredData.forEach(student => {
                                let option = document.createElement('option');
                                option.value = student.rollno;
                                option.setAttribute("data-id", student.id);
                                option.text = `Roll No: ${student.rollno} | Name: ${student.student_name}`;
                                studentDropdown.appendChild(option);
                            });
                        } 
                        else if (data.data && data.data.length > 0) {
                            studentDropdown.innerHTML = '<option value="">-- Select Student --</option>';
                            data.data.forEach(student => {
                                let option = document.createElement('option');
                                option.value = student.rollno;
                                option.setAttribute("data-id", student.id);
                                option.text = `Roll No: ${student.rollno} | Name: ${student.student_name}`;
                                studentDropdown.appendChild(option);
                            });
                        }
                        else {
                            studentDropdown.innerHTML = '<option value="">No students found in the selected class</option>';
                        }
                    })
                    .catch(() => {
                        studentDropdown.innerHTML = '<option value="">Error loading students</option>';
                    });
            } else {
                studentDropdown.innerHTML = '<option value="">-- Select Class First --</option>';
            }
        };

        window.clearExistingRecords = function(response, skillReportId, school_id, class_id, testType) {
            const selectElement = document.getElementById('student_id');
            const selectedStudent = selectElement.options[selectElement.selectedIndex];
            const studentId = selectedStudent ? selectedStudent.getAttribute('data-id') : null;

            Swal.fire({
                title: 'Test Already Completed',
                html: `<strong>${response.data.name}</strong> has already completed this test. Would you like to retake it?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Retake&nbsp;Test',
                cancelButtonText: 'Cancel',
                allowOutsideClick: false,
                allowEscapeKey: false,
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('delete-student-test') }}", 
                        type: "POST",
                        data: {
                            student_id: response.data.student_id,
                            skillReportId: skillReportId,
                            school_id: school_id,
                            class_id: class_id,
                            testType: testType,
                            _token: $('meta[name="csrf-token"]').attr("content")
                        },
                        beforeSend: function () {
                            Swal.fire({
                                title: "Deleting Record...",
                                text: "Please wait",
                                allowOutsideClick: false,
                                didOpen: () => {
                                    Swal.showLoading();
                                }
                            });
                        },
                        success: function(deleteResponse) {
                            Swal.close();

                            if (deleteResponse.success) {

                                Swal.fire("Deleted!", deleteResponse.message , "success")

                            .then(() => {

                                $('#student_name').text(response.data.name);
                                $('#student_class').text(response.data.class_name);
                                $('#student_registration_no').text(response.data.student_registration_no);
                                $('#selected_student_id').val(response.data.student_id);
                                $('#student_roll_no').text(response.data.student_roll_no);
                                $('#AGE_GENDER_ID').attr('placeholder', response.data.Age+ '/' + response.data.Gender);
                                }); 
                                

                            } else {
                                Swal.fire("Error", deleteResponse.message, "error");
                            }
                        }
                    });
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    $('#class_id').trigger('change');
                }
            });
        };

    });


    $('#student_id').on('change', function () {
        let rollNo = this.value;
        
        let selectedOption = $('#class_id option:selected');
        let classValue = $('#class_id').val();                                 
        let displayText = selectedOption.text();
        
        let skillReportId = $("input[name='skillReportId']").val();
        let school_id = $('#SchoolId').val();
        
        // for 50m dash and 600m speed 
        const selectElement = document.getElementById('student_id');
        const selectedStudent = selectElement.options[selectElement.selectedIndex];
        const studentId = selectedStudent.getAttribute('data-id');

        let cwsn_type = $('#cwsn_type').val();


        let [custom_class_id, class_id] = classValue.split('-');
        let testType = $('#student_id').data('test-type');
        $.ajax({
            url: '{{ route("fetch.student.detail") }}',
            method: 'GET',
            data: {
                class_id: class_id,
                custom_class_id: custom_class_id,
                studentId: studentId,
                roll_no: rollNo,
                class_name: displayText,
                skillReportId:skillReportId,
                testType:testType,
                school_id:school_id
            },

            beforeSend: function () {
                Swal.fire({
                    icon:'info',
                    title: 'Getting Student Data...',
                    text: 'Please wait while we load the student details.',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
            },

            success: function(response) {

                Swal.close();

                if (response.success) {

                    if (response.data.test_already_given === true) {
                        clearExistingRecords(response, skillReportId,school_id, class_id, testType);
                        return; 
                    }
                        
                    $('#student_name').text(response.data.name);
                    $('#student_class').text(response.data.class_name);
                    $('#student_registration_no').text(response.data.student_registration_no);
                    $('#selected_student_id').val(response.data.student_id);
                    $('#student_roll_no').text(response.data.student_roll_no);
                    $('#AGE_GENDER_ID').attr('placeholder', response.data.Age+ '/' + response.data.Gender);

                    $('#anthropo_ht_id').val(response.data.anthropo_ht_id);
                    $('#anthropo_wt_id').val(response.data.anthropo_wt_id);
                    $('#height_value').text(response.data.height_value ?? 'N.A.')
                    $('#weight_value').text(response.data.weight_value ?? 'N.A.')

                    if(cwsn_type == 7){
                        handleAdaptationChange();
                    }
                    
                } else {

                    // showMessages('info', 'Student not found', response.message);
                }
            },
            error: function() {
                 Swal.close();
                 handleResponseMessages('warning', 'Error', 'Something went wrong while fetching student. Please try later');
            }
        });
        
    });
</script>

@endpush