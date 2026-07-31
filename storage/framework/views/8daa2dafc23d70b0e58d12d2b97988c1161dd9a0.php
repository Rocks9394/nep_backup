<style>
   .dropdown-checkbox-menu {  max-height: 300px; overflow-y: auto; width: 100%;font-size: 0.875rem; padding: 5px 0;  }
   .dropdown-checkbox-menu.show {  width: 90%;  }
   .dropdown-menu label, .dropdown-menu input[type="text"] { width: 100%; padding: 6px 10px; font-size: 0.85rem; }
   .dropdown-menu input[type="checkbox"] { margin-right: 8px; transform: scale(1.1); appearance: auto !important;  vertical-align: middle; }
   .list-group-item { padding: 0; margin-left: 28px; border: none;}
   .dropdown-menu input, .dropdown-menu label { cursor: default; }
   .dropdown-toggle { text-align: left; }
   .dropdown-menu label {display: flex; align-items: center; font-size: 0.875rem; padding: 5px 10px; }
   li.list-group-item.nomeclature_list { margin: 3px; }

   .row.class_nomenclature_dropdown {
      margin-right: 36px;
   }
    .nomenclature-input.highlighted {
        background-color: #e7f3ff; /* Light blue highlight */
        border: 1px solid #007bff;
    }

   span.class-badge.selected_classs {
       background-color: #292775;
       color: #ffffff;
       padding: 8px 11px 8px 11px;
       margin-bottom: 4px;
       border-radius: 8px;
   }

   div:where(.swal2-icon).swal2-error [class^=swal2-x-mark-line][class$=right] {
       right: 0.75em;
   }

   div:where(.swal2-icon).swal2-error [class^=swal2-x-mark-line][class$=left] {
       left: 0.75em;
   }
   div:where(.swal2-icon).swal2-error [class^=swal2-x-mark-line] {
       top: 1.4125em;
       width: 1.4555em;

   }
   .upload-file {
          background: #fff;
          border-radius: 5px;
          height: 42px;
   }


   .class-badge {
    display: inline-block;
    background-color: #f0f0f0;
    padding: 6px 12px;
    margin: 4px;
    border-radius: 20px;
    position: relative;
    font-size: 14px;
}

.remove-class {
    color: #ffffff;
    margin-left: 8px;
    cursor: pointer;
    font-weight: bold;
}
.custom-dropdown .dropdown-toggle {
   position: relative;
}
.custom-dropdown .dropdown-toggle:after {
   right: 10px;
}



</style>


<div class="">
   <div class="mt-0">
      <div class="row s-code">
         <div class="col-12 col-xl-6">
            <div class="heading">
               <h6>
                  School&nbsp;Code: <div><span><?php echo e($schoolCode); ?></span></div>
               </h6>
                <span>Match "School Code" before upload students data</span>
            </div>



            <div class="action-btns">
               <a href="<?php echo e(route('download-template')); ?>" class="btn btn-link px-0 mr-3 txt-btn">
                  <span>
                     <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-file-text" viewBox="0 0 16 16">
                        <path
                           d="M5 4a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1zm-.5 2.5A.5.5 0 0 1 5 6h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5M5 8a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1zm0 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1z" />
                        <path
                           d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2zm10-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1" />
                     </svg>
                  </span>
                  Download Template
               </a>
               <a href="<?php echo e(route('sample-data')); ?>" class="btn btn-link px-0 txt-btn">
                  <span>
                     <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-arrow-down-square" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                           d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm8.5 2.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293z" />
                     </svg>
                  </span>
                  Sample Data
               </a>

               <button type="button" class="btn btn-link px-0 txt-btn" onclick="downloadStudentProfile()">
                   <span>
                       <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                           class="bi bi-arrow-down-square" viewBox="0 0 16 16">
                           <path fill-rule="evenodd"
                               d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm8.5 2.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293z" />
                       </svg>
                   </span>
                   Download All Students
               </button>

            </div>


            <div class="uploadform mb-4 mt-3">
               <form id="bulkuploadform" class="frms d-flex" action="javascript::void(0);">
                  <?php echo csrf_field(); ?>
                  <input type="file" name="upload_student_profile" class="p-2 mr-3 upload-file">
                  <input type="hidden" name="event" value="preview">
                  <button class="btn btn-primary uploadfile" type="submit"><i class="fa fa-upload" aria-hidden="true"></i> Upload</button>
               </form>
            </div>


            <div class="col-xl-12 d-none text-center mb-3">
               <img src="<?php echo e(asset('assets/imgs/upload-data.svg')); ?>">
            </div>
            <div class="instructions col-12 col-xl-12">
               <div class="i-rules">
                  <h6>Instructions to fill the excel for promotion</h6>
                  <div class="i-rules-container d-flex">
                     <div class="list-group p-2">
                        <ul>
                           <li>
                              <b>Download All Students Excel Template:</b>
                              Ensure that all Class 12 students and any other students who need to be transferred
                              are marked as <strong>Transfer</strong> before downloading the template.
                           </li>
                           <li>
                              <strong>Student Class:</strong> Enter the updated class in Roman numerals only 
                              (e.g., I, II, III, IV, V, VI, VII, VIII, IX, X, XI, XII).
                           </li>
                           <li>
                              <strong>Student Section:</strong> Enter the updated section using letters such as 
                              A, B, C, etc. If there is only one section, enter <strong>'A'</strong>.
                           </li>
                           <li>
                              <strong>Student Roll Number:</strong> Update the student's roll number if required.
                           </li>
                           <li>
                              <strong>Transfer Students:</strong> Ensure that all Class 12 students and any other 
                              students who need to be transferred are excluded from the Excel template.
                           </li>
                           <li>
                              <strong>Important:</strong> Verify all details carefully before uploading the Excel file, 
                              as changes made through upload may not be reversible.
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </div>


         <div class="instructions col-12 col-xl-6">
            <div class="i-rules">
               <h6>Instructions to fill excel for new students</h6>
               <div class="i-rules-container d-flex">
                  <div class="list-group p-2">
                     <ul>
                        <li>Download the template to import student data.</li>
                        <li>Keep the Excel heading as it is; don't change it.</li>
                        <li>You can download the Sample Data to view the format required for import.</li>
                         <li><strong>Worksheet Requirement:</strong> The Excel file must contain only one worksheet.</li>
                         <li><strong>Remove Extra Worksheets:</strong> Delete any additional sheets like <em>SampleData</em>, <em>Important Guidelines</em>, or any others.</li>
                        <li>Excel columns highlighted in orange are mandatory.</li>
                        <li>Excel columns highlighted in yellow are optional.</li>
                        <li>The Excel sheet should not contain any blank rows.</li>
                        <li>School code: Your school code is <strong><?php echo e($schoolCode); ?></strong>.(Spaces not allowed).</li>
                        <li>AdmissionNumber: Student Registration Number.</li>
                        <li>Name: Full name of the student (only letters, spaces, dots, and apostrophes are allowed).</li>
                        <li>Gender: Accepted values are Male, Female, M, or F only.</li>
                        <li>Class: Should be in Roman numerals only (e.g., I, II, III, IV, V, VI, VII, VIII, IX, X, XI, XII).</li>
                        <li>Section: Use letters like A, B, C, etc. (If there is only one section, please fill "A").</li>
                        <li>Roll No: Should be a numeric value (e.g., 1, 2, 3... 33, 34, 35) and cannot be left blank.</li>
                        <li>DOB: Format should be DD/MM/YYYY (e.g., 15/03/2014). This is a critical field — please ensure the date format is correct in the Excel sheet before uploading.</li>
                       <li>Email: Email ID of the parent (this will be used for communication purposes).</li>
                       <li>CWSN(Children with Special Needs): Fill <b>YES</b> if the student is differently abled; otherwise fill <b>NO</b>.</li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>


<script>
   function downloadStudentProfile() {

       Swal.fire({
            icon:'info',
           title: "Generating Excel...",
           text: "Please wait",
           allowOutsideClick: false,
           didOpen: () => Swal.showLoading()
       });

       $.ajax({
           url: "<?php echo e(route('download.student.profile')); ?>",
           method: "POST",
           data: {
               _token: "<?php echo e(csrf_token()); ?>"
           },
           xhrFields: {
               responseType: "blob"
           },

           success: function (data, status, xhr) {

               Swal.close();

               let filename = "StudentDataUploadFormat.xlsx";

               const blob = new Blob([data]);
               const url = window.URL.createObjectURL(blob);

               const a = document.createElement("a");
               a.href = url;
               a.download = filename;
               document.body.appendChild(a);
               a.click();
               a.remove();

               window.URL.revokeObjectURL(url);
           },

           error: function () {

               Swal.close();

               Swal.fire({
                   icon: "error",
                   title: "Export Failed"
               });
           }
       });
   }

</script>

<?php /**PATH C:\xampp\htdocs\nep\resources\views/school/bulkuploadform.blade.php ENDPATH**/ ?>