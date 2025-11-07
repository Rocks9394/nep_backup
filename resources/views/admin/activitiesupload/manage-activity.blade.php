@extends('admin.layouts.app')
@section('title', $title)
@section('content')
<style>
.mb-3{ margin-bottom: 0 !important; margin-right: 10px; }
.btn-sm{ padding: .375rem .75rem; }
.rtside{ float:right; }
.dropdown {
  position: relative;
  left: 50px;
  top: 50px;
}
dropdown-menu.{

}

button.btn.btn-default.dropdown-toggle.form-control {
    display: flex
;
    align-items: center;
    justify-content: space-between;
}

</style>
<div class="content-wrapper">



	<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <a class="" href=""> <i class="fas fa-long-arrow-alt-left"></i> Back </a>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
				<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
				<li class="breadcrumb-item active"aria-current="page">Activity</li>
            </ol>
          </div>
        </div>
      </div>
    </section>




    <!-- Main content -->
    
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header"> <h3 class="card-title">{{ $title }}</h3> </div>
	            <div class="container-fluid p-5">
	               <div class="container-fluid">
	                   <div class="row s-code">	                 
	                        <div class="col-12 col-xl-6">	                      
	        
	                            <div class="action-btns">
																<a href="{{ route('admin.download-template', ['val' => $template = 'template']) }}" class="btn btn-link px-0 mr-3 txt-btn">
																 <span><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-text" viewBox="0 0 16 16"><path d="M5 4a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1zm-.5 2.5A.5.5 0 0 1 5 6h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5M5 8a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1zm0 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1z"></path><path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2zm10-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1"></path></svg></span> Template </a>

																<a href="{{ route('admin.download-template', ['val' => $template = 'sample']) }}" class="btn btn-link px-0 mr-3 txt-btn"><span><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down-square" viewBox="0 0 16 16"> <path fill-rule="evenodd" d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm8.5 2.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293z"></path> </svg> </span> Sample Data </a>

																<a href="#" class="btn btn-link px-0 txt-btn"><span><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down-square" viewBox="0 0 16 16"> <path fill-rule="evenodd" d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm8.5 2.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293z"></path> </svg> </span> Export Activities </a>
	                            </div>

	                            <div class="row">						                    
						                    <div class="col-sm-6">				
						                      <div class="form-group">

						                      	 <!--  <label>Teaching Through</label> -->
																		  <button class="btn btn-default dropdown-toggle form-control" type="button" data-toggle="dropdown">
																			  	<span class="dropdown-text"> Teaching Through</span>
																			  <span class="caret"></span>
																			</button>

																		  <ul class="dropdown-menu">
																		    <li class="list-group-item" style="padding:5px;">
																		    	<label><input type="checkbox" class="selectall" />
																		    		<span class="select-text">Select</span> All</label>
																		    </li>
																		    @foreach($teachingthrough as $teachingthrough)
																		    <li class="list-group-item" style="padding:5px;">
																		    	<label>
																		    		<input name='teaching_options[]' type="checkbox" class="option justone" value='{{ $teachingthrough->id }}'/> {{ $teachingthrough->name }}</label>
																		    </li>																		    
																		    @endforeach
																		  </ul>
						                      </div>
						                    </div>

						                    <div class="col-sm-6">
						                      <div class="form-group position-relative">						                      	
						                        <!-- <label>Teaching Through</label> -->
																		  <button class="btn btn-default dropdown-toggle form-control" type="button" data-toggle="dropdown">
																			  	<span class="dropdown-text"> Select Class</span>
																			  <span class="caret"></span>
																			</button>

																		  <ul class="dropdown-menu" style="width: 260px; overflow: auto; height: 300px; position: absolute; will-change: transform; top: 30px !important; left: 0px;">

																		    <li class="list-group-item" style="padding:5px;">
																		    	<label class="mb-0"><input type="checkbox" class="selectall" /><span class="select-text">Select</span> All</label>
																		    </li>

																		    <div class="select_list">
																			    @foreach($classes as $class)
																			    <li class="list-group-item" style="padding:5px;">
																			    	<label class="mb-0">
																			    		<input name='class_options[]' type="checkbox" class="option justone" value='{{ $class->id }}'/> {{ $class->name }}</label>
																			    </li>																		    
																			    @endforeach
																		    </div>
																		  </ul>
						                      </div>
						                    </div>

						                  </div>



	                            <div class="uploadform mb-4 mt-3">
	                              <form id="bulkuploadform" class="frms d-flex" action="javascript::void(0);">
	                                    @csrf
	                                    <input type="file" name="import_activity">
	                                    <input type="hidden" name="event" value="preview">
	                                    <button class="btn btn-primary uploadfile" type="submit"><i class="fa fa-upload" aria-hidden="true"></i> Upload</button>
	                              </form>
	                            </div>

	                        	<div id="error_msg" class="alert alert-danger pb-0 mt-1" style="display:none;text-align:left;"></div>
		                        <div class="col-xl-12 d-none d-xl-block text-center mb-3">
		                           <img src="{{ asset('public/assets/imgs/upload-data.svg') }}">
		                        </div>
	                        </div>

													<div class="instructions col-12 col-xl-6">
														<div class="i-rules">
														   <h6>Instructions to fill the excel</h6>
														   <div class="i-rules-container d-flex">
														      <div class="list-group">
														         <ul>
														            <li>Don't change the file name.</li>
														            <li>Keep the Excel heading as it is; don't change it.</li>
														            <li>Fields marked in orange are mandatory to fill out.</li>
														            <li>"Teaching Through" and "Class" are mandatory fields to ensure the activity being created is correctly mapped to the selected class.</li>
														            <li>SkillArea should be either:
																			    <ul>
																			      <li>Fundamental Movement Skills</li>
																			      <li>Specialised Sports Coaching</li>
																			    </ul>
																			  </li>
																		<!-- 	  <li>Status should be either:
																			    <ul>
																			      <li>1 for active</li>
																			      <li>0 for inactive</li>
																			    </ul>
																			  </li> -->
																			  <li>Before importing the sheet, please ensure that the Skill/Sport, and Technique entries already exist in the system.</li>
														            <li>You can download the Sample Data to view the format required for import.</li>
														         </ul>
														      </div>
														   </div>
														</div>
													</div>
	                  </div>
	               </div>
	            </div>
            </div>
          </div>
        </div>
    </section>
  </div>




 <script>


  $('body').on("click", ".dropdown-menu", function (e) {
    e.stopPropagation(); // keep dropdown open when clicking inside
  });

  $('.form-group').each(function () {
    const container = $(this);

    // Select All functionality
    container.find('.selectall').on('click', function () {
      const checked = $(this).is(':checked');
      container.find('.option').prop('checked', checked);

      const total = container.find(".option:checked").length;
      container.find(".dropdown-text").html(`(${total}) Selected`);
      container.find(".select-text").html(checked ? ' Deselect' : ' Select');
    });

    // Individual checkbox change
    container.find('.justone').on('change', function () {
      const allOptions = container.find(".justone");
      const checkedOptions = allOptions.filter(":checked");

      const allChecked = allOptions.length === checkedOptions.length;
      container.find(".selectall").prop('checked', allChecked);
      container.find(".select-text").html(allChecked ? ' Deselect' : ' Select');

      container.find(".dropdown-text").html(`(${checkedOptions.length}) Selected`);
    });
  });


	$('#bulkuploadform').on('submit', function(event) {
      event.preventDefault();
      var formData = new FormData(this);
      
      const teachingIds = $("input[name='teaching_options[]']:checked")
      .map(function () { return $(this).val(); }).get();

      const classIds = $("input[name='class_options[]']:checked")
      .map(function () { return $(this).val(); }).get();

      teachingIds.forEach((id, index) => {
			  formData.append(`teachingthrough_ids[${index}]`, id);
			});

			classIds.forEach((id, index) => {
			  formData.append(`class_ids[${index}]`, id);
			});


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
         url: "{{ route('admin.import-activity') }}",
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

						  		console.log('importdata');

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
			url: "{{ route('admin.import-activity') }}",
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

 </script>
@endsection