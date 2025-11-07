@stack('scripts')
<script>

    function showMessages($icon, $title, $message) {
        Swal.fire({
            icon: $icon,
            title: $title,
            text: $message,
            allowOutsideClick: false,
            allowEscapeKey: false
        });
    }


    function handleResponseMessages(icon, title, message, options = {}) {

        let config = {
            icon: icon,
            title: title,
            text: message,
            allowOutsideClick: false,
            allowEscapeKey: false,
            
            showConfirmButton: true,
            confirmButtonText: options.confirmText || 'OK',
            
            showCancelButton: options.showCancel || false,
            cancelButtonText: options.cancelText || 'Cancel',

        };

        if (options.showCancel) {
            config.showCancelButton = true;
            config.cancelButtonText = options.cancelText || 'Cancel';
        }


        if (options.timer) {
            config.timer = options.timer;
            config.showConfirmButton = false;
        }

        return Swal.fire(config).then((result) => {
            if (result.isConfirmed && typeof options.onConfirm === 'function') {
                options.onConfirm();
            }
            if (result.dismiss === Swal.DismissReason.cancel && typeof options.onCancel === 'function') {
                options.onCancel();
            }
        });
    }


    function getStudentsList(classCustom){

        let studentDropdown = document.getElementById('student_id');
        studentDropdown.innerHTML = '<option value="">Loading...</option>';

        if (classCustom) {
            fetch(`{{ route('studentRollNo.autocomplete') }}?class_id=${classCustom}&query=`)
                .then(response => response.json())
                .then(data => {
                    studentDropdown.innerHTML = '';

                    if (Array.isArray(data) && data.length > 0) {
                        studentDropdown.innerHTML = '<option value="">-- Select Student --</option>';
                        data.forEach(student => {
                            let option = document.createElement('option');
                            option.value = student.rollno;
                            // option.text = `Reg. No:${student.user_id} | Name: ${student.student_name} | Roll No: ${student.rollno}`;
                            option.text = `Roll No: ${student.rollno} | Name: ${student.student_name}`;
                            studentDropdown.appendChild(option);
                        });
                    } 
                    else if (data.data && data.data.length > 0) {
                        studentDropdown.innerHTML = '<option value="">-- Select Student --</option>';
                        data.data.forEach(student => {
                            let option = document.createElement('option');
                            option.value = student.rollno;
                            option.text = `${student.rollno} - ${student.student_name}`;
                            studentDropdown.appendChild(option);
                        });
                    }
                    else {
                        // Empty result
                        studentDropdown.innerHTML = '<option value="">No students found in the selected class</option>';
                    }
                })
                .catch(() => {
                    studentDropdown.innerHTML = '<option value="">Error loading students</option>';
                });
        } else {
            studentDropdown.innerHTML = '<option value="">--Selected Students --</option>';
        }
    }

    // let stdArray = [];
    // const studentli = "selected_student";
    // $(document).ready(function () {
    //     function checkStudentsForClass(classCustom) {
    //         let skillReportId = $("input[name='skillReportId']").val();
    //         let testType = $('#student_id').data('test-type');
    //         const testStatus = localStorage.getItem("testStatus");

    //         return fetch(`{{ route('studentRollNo.autocomplete') }}?class_id=${classCustom}&test_status=${testStatus}&skillReportId=${skillReportId}&testType=${testType}&query=`)
    //             .then(response => response.json())
    //             .then(data => {
    //                 return Array.isArray(data) && data.length > 0;
    //             })
    //             .catch(() => {
    //                 return false;
    //             });
    //     }
    //     $('#class_id option').each(function() {
    //         let classCustom = $(this).val();
    //         let optionElement = $(this);

    //         if (classCustom) {
    //             checkStudentsForClass(classCustom).then(hasStudents => {
    //                 if (!hasStudents) {
    //                     optionElement.hide();
    //                 }
    //             });
    //         }
    //     });

    //     $('#class_id').on('change', function () {
    //         let classCustom = this.value;       
    //         let skillReportId = $("input[name='skillReportId']").val();
    //         let testType = $('#student_id').data('test-type');
    //         const testStatus = localStorage.getItem("testStatus");

    //         $('#student_name').text('Student Name');
    //         $('#student_class').text('Class');
    //         $('#student_registration_no').text('Registration Number');
    //         $('#selected_student_id').val('');
    //         $('#AGE_GENDER_ID').text('');
    //         $('#student_roll_no').text('');
    //         $('#roll_no_id').val('');

    //         let studentDropdown = document.getElementById('student_id');
    //         studentDropdown.innerHTML = '<option value="">Loading...</option>';

    //         if (classCustom) {
    //             fetch(`{{ route('studentRollNo.autocomplete') }}?class_id=${classCustom}&test_status=${testStatus}&skillReportId=${skillReportId}&testType=${testType}&query=`)
    //                 .then(response => response.json())
    //                 .then(data => {
    //                     studentDropdown.innerHTML = '';
    //                     let localData = localStorage.getItem("selected_student");
    //                     let localIds = [];

    //                     if (localData) {
    //                         try {
    //                             const parsed = JSON.parse(localData);
    //                             localIds = parsed.map(item => item.studentId);
    //                         } catch (e) {
    //                             console.error("Error parsing localStorage:", e);
    //                         }
    //                     }

    //                     let filteredData = data.filter(item => !localIds.includes(item.id));

    //                     if (Array.isArray(filteredData) && filteredData.length > 0) {
    //                         studentDropdown.innerHTML = '<option value="">-- Select Student --</option>';
    //                         filteredData.forEach(student => {
    //                             let option = document.createElement('option');
    //                             option.value = student.rollno;
    //                             option.setAttribute("data-id", student.id);
    //                             option.text = `Roll No: ${student.rollno} | Name: ${student.student_name}`;
    //                             studentDropdown.appendChild(option);
    //                         });
    //                     } 
    //                     else if (data.data && data.data.length > 0) {
    //                         studentDropdown.innerHTML = '<option value="">-- Select Student --</option>';
    //                         data.data.forEach(student => {
    //                             let option = document.createElement('option');
    //                             option.value = student.rollno;
    //                             option.setAttribute("data-id", student.id);
    //                             option.text = `Roll No: ${student.rollno} | Name: ${student.student_name}`;
    //                             studentDropdown.appendChild(option);
    //                         });
    //                     }
    //                     else {
    //                         studentDropdown.innerHTML = '<option value="">No students found in the selected class</option>';
    //                     }
    //                 })
    //                 .catch(() => {
    //                     studentDropdown.innerHTML = '<option value="">Error loading students</option>';
    //                 });
    //         } else {
    //             studentDropdown.innerHTML = '<option value="">-- Select Class First --</option>';
    //         }
    //     });

    //     window.clearExistingRecords = function(response, skillReportId, school_id, class_id, testType) {
    //         const selectElement = document.getElementById('student_id');
    //         const selectedStudent = selectElement.options[selectElement.selectedIndex];
    //         const studentId = selectedStudent ? selectedStudent.getAttribute('data-id') : null;

    //         Swal.fire({
    //             title: 'Test Already Completed',
    //             html: `<strong>${response.data.name}</strong> has already completed this test. Would you like to retake it?`,
    //             icon: 'warning',
    //             showCancelButton: true,
    //             confirmButtonText: 'Retake&nbsp;Test',
    //             cancelButtonText: 'Cancel',
    //             allowOutsideClick: false,
    //             allowEscapeKey: false,
    //             reverseButtons: true
    //         }).then((result) => {
    //             if (result.isConfirmed) {
    //                 $.ajax({
    //                     url: "{{ route('delete-student-test') }}", 
    //                     type: "POST",
    //                     data: {
    //                         student_id: response.data.student_id,
    //                         skillReportId: skillReportId,
    //                         school_id: school_id,
    //                         class_id: class_id,
    //                         testType: testType,
    //                         _token: $('meta[name="csrf-token"]').attr("content")
    //                     },
    //                     beforeSend: function () {
    //                         Swal.fire({
    //                             title: "Deleting Record...",
    //                             text: "Please wait",
    //                             allowOutsideClick: false,
    //                             didOpen: () => {
    //                                 Swal.showLoading();
    //                             }
    //                         });
    //                     },
    //                     success: function(deleteResponse) {
    //                         Swal.close();

    //                         if (deleteResponse.success) {

    //                             Swal.fire("Deleted!", deleteResponse.message , "success")

    //                         .then(() => {

    //                             $('#student_name').text(response.data.name);
    //                             $('#student_class').text(response.data.class_name);
    //                             $('#student_registration_no').text(response.data.student_registration_no);
    //                             $('#selected_student_id').val(response.data.student_id);
    //                             $('#student_roll_no').text(response.data.student_roll_no);
    //                             $('#AGE_GENDER_ID').attr('placeholder', response.data.Age+ '/' + response.data.Gender);
                                
    //                             if (selectedRank) {
    //                                 toggleValue(stdArray, studentId,selectedRank);
    //                                 let li = $(`#laneList li[data-rank='${selectedRank}']`);
    //                                 li.find('.student-name').text(response.data.name);
    //                                 li.find('.student-class').text(response.data.class_name);                        
    //                                 li.find('.student_roll_no').text(response.data.student_roll_no);
    //                                 li.find('.student-reg').text(response.data.student_registration_no);
    //                                 li.find('.student-id').val(response.data.student_id);                                                                    
    //                                 localStorage.setItem(studentli, JSON.stringify(stdArray));
    //                                 }
    //                                 $('#class_id').trigger('change');
    //                                 $('.bd-example-modal-lg').modal('hide'); 
    //                                 selectedRank = null;
    //                             }); 
                                

    //                         } else {
    //                             Swal.fire("Error", deleteResponse.message, "error");
    //                         }
    //                     }
    //                 });
    //             } else if (result.dismiss === Swal.DismissReason.cancel) {
    //                 $('#class_id').trigger('change');
    //             }
    //         });
    //     };

    // });

    // $('#student_id').on('change', function () {
    //     let rollNo = this.value;
        
    //     let selectedOption = $('#class_id option:selected');
    //     let classValue = $('#class_id').val();                                 
    //     let displayText = selectedOption.text();
        
    //     let skillReportId = $("input[name='skillReportId']").val();
    //     let school_id = $('#SchoolId').val();
        
    //     // for 50m dash and 600m speed 
    //     const selectElement = document.getElementById('student_id');
    //     const grade = selectElement.getAttribute('data-grade');
    //     const selectedStudent = selectElement.options[selectElement.selectedIndex];
    //     const studentId = selectedStudent.getAttribute('data-id');

    //     let [custom_class_id, class_id] = classValue.split('-');
    //     let testType = $('#student_id').data('test-type');
    //     $.ajax({
    //         url: '{{ route("fetch.student.detail") }}',
    //         method: 'GET',
    //         data: {
    //             class_id: class_id,
    //             custom_class_id: custom_class_id,
    //             studentId: studentId,
    //             roll_no: rollNo,
    //             class_name: displayText,
    //             skillReportId:skillReportId,
    //             testType:testType,
    //             school_id:school_id
    //         },

    //         beforeSend: function () {
    //             Swal.fire({
    //                 icon:'info',
    //                 title: 'Getting Student Data...',
    //                 text: 'Please wait while we load the student details.',
    //                 allowOutsideClick: false,
    //                 didOpen: () => {
    //                     Swal.showLoading();
    //                 }
    //             });
    //         },


    //         success: function(response) {

    //             Swal.close();

    //             if (response.success) {

    //                 if (response.data.test_already_given === true) {
    //                     clearExistingRecords(response, skillReportId,school_id, class_id, testType);
    //                     return; 
    //                 }
                    
    //                 if(grade=="speed"){

    //                     const studentId = response.data.student_id;
    //                     toggleValue(stdArray, studentId,selectedRank);

    //                     const existingStudent = document.querySelector(`.student-id[value="${studentId}"]`);
    //                     if (existingStudent) {
    //                         Swal.fire({
    //                             icon: 'warning',
    //                             title: 'Student Already Selected',
    //                             text: 'This student has already been assigned to another rank.',
    //                             confirmButtonText: 'OK'
    //                         });
    //                         return;
    //                     }

    //                     if (selectedRank) { // only update the current lane
    //                         let li = $(`#laneList li[data-rank='${selectedRank}']`);
    //                         li.find('.student-name').text(response.data.name);
    //                         li.find('.student-class').text(response.data.class_name);                        
    //                         li.find('.student_roll_no').text(response.data.student_roll_no);
    //                         li.find('.student-reg').text(response.data.student_registration_no);
    //                         li.find('.student-id').val(response.data.student_id);
    //                         localStorage.setItem(studentli, JSON.stringify(stdArray));
    //                         $('#class_id').trigger('change');

    //                     }

    //                     $('.bd-example-modal-lg').modal('hide');
    //                     document.getElementById('student_id').innerHTML = '<option value="">--Selected Students --</option>';                        
    //                     selectedRank = null;

    //                 }else{                        
    //                     $('#student_name').text(response.data.name);
    //                     $('#student_class').text(response.data.class_name);
    //                     $('#student_registration_no').text(response.data.student_registration_no);
    //                     $('#selected_student_id').val(response.data.student_id);
    //                     $('#student_roll_no').text(response.data.student_roll_no);
    //                     $('#AGE_GENDER_ID').attr('placeholder', response.data.Age+ '/' + response.data.Gender);
    //                 }


    //             } else {

    //                 // showMessages('info', 'Student not found', response.message);
    //             }
    //         },
    //         error: function() {
    //              Swal.close();
    //              handleResponseMessages('warning', 'Error', 'Something went wrong while fetching student. Please try later');
    //         }
    //     });
        
    // });

    // function toggleValue(arr, studentId, selectedRank){
    //     const sameRankIndex = arr.findIndex(item => item.selectedRank === selectedRank);
    //     if (sameRankIndex !== -1) {
    //         arr.splice(sameRankIndex, 1);
    //     }
    //     arr.push({selectedRank, studentId});
    // }

    function submitLoader(){
        Swal.fire({
            title: 'Submitting',
            text: 'Please wait...',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });
    }

</script>
