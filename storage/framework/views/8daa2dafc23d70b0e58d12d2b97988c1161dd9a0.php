<div class="container-fluid p-0">
               <div class="container-fluid">
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
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-text" viewBox="0 0 16 16">
                                       <path d="M5 4a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1zm-.5 2.5A.5.5 0 0 1 5 6h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5M5 8a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1zm0 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1z" />
                                       <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2zm10-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1" />
                                    </svg>
                                 </span>
                                 Download Template 
                              </a>
                              <a href="<?php echo e(route('sample-data')); ?>" class="btn btn-link px-0 txt-btn">
                                 <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down-square" viewBox="0 0 16 16">
                                       <path fill-rule="evenodd" d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm8.5 2.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293z" />
                                    </svg>
                                 </span>
                                 Sample Data
                              </a>
                           </div>

                           <div class="uploadform mb-4 mt-3">
                              <form id="bulkuploadform" class="frms d-flex" action="javascript::void(0);">
                                    <?php echo csrf_field(); ?>
                                    <input type="file" name="upload_student_profile">
                                    <input type="hidden" name="event" value="preview">
                                    <button class="btn btn-primary uploadfile" type="submit"><i class="fa fa-upload" aria-hidden="true"></i> Upload</button>
                              </form>
                           </div>
                              <div id="error_msg" class="alert alert-danger pb-0 mt-1" style="display:none;text-align:left;"></div>
                       

                        <div class="col-xl-12 d-none d-xl-block text-center mb-3">
                           <img src="<?php echo e(asset('public/assets/imgs/upload-data.svg')); ?>">
                        </div>
                     </div>

                     <div class="instructions col-12 col-xl-6">
                        <div class="i-rules">
                           <h6>Instructions to fill the excel</h6>
                           <div class="i-rules-container d-flex">
                              <div class="list-group">
                                 <ul>
                                    <li>Keep the Excel heading as it is; don't change it.</li>
                                    <li>You can download the Sample Data to view the format required for import.</li>
                                    <li>The Excel file should be named 'PersonalProfile.xlsx.' Don't change the file name.</li>
                                    <li>Fields marked in orange are mandatory to fill out.</li>
                                    <li>School code: To be filled by fitness365</li>
                                    <li>Student UID: Registration Number or Admission Number.</li>
                                    <li>Name: Full name</li>
                                    <li>Gender: Male/Female</li>
                                    <li>Class: Pre Nursery, Nur, KG, I, II, ..., IX, X, XI.</li>
                                    <li>Section: A, B, C... (If there is no section please fill in A)</li>
                                    <li>Roll. No: 1,2,3……33,34,35.</li>
                                    <li>DOB: DD/MM/YYYY (e.g., 15/03/2014; this field is most critical).</li>
                                 </ul>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
<?php /**PATH C:\xampp\htdocs\nep\resources\views/school/bulkuploadform.blade.php ENDPATH**/ ?>