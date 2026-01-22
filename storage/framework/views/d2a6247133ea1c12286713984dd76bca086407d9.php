
<?php $__env->startSection('title', 'Goforfit | ' . $title); ?>
<?php $__env->startSection('content'); ?>

<style>
   td.dt-type-numeric {
       text-align: center;
       text-align: left !important;
   }
</style>
<div class="container" >
   <div class="t-mrg2">
      <div class=" all-chaptr-cards">
         <!-- Success message -->
         <form method="POST" name="view-trainer-report" id="reportform"  action="javascript(0);">
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
               <div class="col-auto col-md-auto">
                           <div class="btn-group btn-group-toggle p-0" data-toggle="buttons" id="chksubmit_button">
                              <label class="btn btn-secondary d-flex align-items-center active" style="gap:5px;">
                              <input type="radio" name="options_bytype" value="bytrainer" checked>
                              <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16"> <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/></svg>
                              <span class="d-none d-sm-block">By Trainer</span>
                              </label>
                              <label class="btn btn-secondary d-flex align-items-center" style="gap:5px;">
                              <input type="radio" name="options_bytype" value="byclass">
                              <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-backpack3" viewBox="0 0 16 16"><path d="M4.04 7.43a4 4 0 0 1 7.92 0 .5.5 0 1 1-.99.14 3 3 0 0 0-5.94 0 .5.5 0 1 1-.99-.14M4 9.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5zm1 .5v3h6v-3h-1v.5a.5.5 0 0 1-1 0V10z"/> <path d="M6 2.341V2a2 2 0 1 1 4 0v.341c.465.165.904.385 1.308.653l.416-1.247a1 1 0 0 1 1.748-.284l.77 1.027a1 1 0 0 1 .15.917l-.803 2.407C13.854 6.49 14 7.229 14 8v5.5a2.5 2.5 0 0 1-2.5 2.5h-7A2.5 2.5 0 0 1 2 13.5V8c0-.771.146-1.509.41-2.186l-.802-2.407a1 1 0 0 1 .15-.917l.77-1.027a1 1 0 0 1 1.748.284l.416 1.247A6 6 0 0 1 6 2.34ZM7 2v.083a6 6 0 0 1 2 0V2a1 1 0 1 0-2 0m5.941 2.595.502-1.505-.77-1.027-.532 1.595q.447.427.8.937M3.86 3.658l-.532-1.595-.77 1.027.502 1.505q.352-.51.8-.937M8 3a5 5 0 0 0-5 5v5.5A1.5 1.5 0 0 0 4.5 15h7a1.5 1.5 0 0 0 1.5-1.5V8a5 5 0 0 0-5-5"/></svg>
                              <span class="d-none d-sm-block">By Class</span>
                              </label>
                           </div>
                        </div>
            </div>

            <div class="row">
               <div class="col-12">
                  <div id="activity_from_div" class="sports-filtr overlay mt-3">
                        <div class="from__bx">
                           <div class="form-row">
                              <div class="col-12 col-md-12 col-lg-10">
                                 <div  id="form-fields" class="form-row">

                                    <div class="col-12 col-md-12 col-lg-3 mb-3"  id="by-trainer" >
                                       <label for="Class">By Trainer</label><br>
                                       <select class="form-control mx-0 w-100" name="trainer_id" id="trainer_id">
                                          <option value="">All Trainer</option>
                                          <?php $__currentLoopData = $trainerList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trainer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                          <option value="<?php echo e($trainer->trainer_id); ?>"><?php echo e($trainer->name); ?></option>
                                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                       </select>
                                    </div>
                                    <div class="col-6 col-md-6 col-lg-3 mb-3" id="from-date">
                                       <label for="skillarea">From Date</label><br>
                                       <input type="date" class="form-control mx-0 w-100" value="" id="from_date_id" name="from_date">
                                    </div>
                                    <div class="col-6 col-md-6 col-lg-3 mb-3" id="last-date">
                                       <label for="sports">To Date</label><br>
                                       <input type="date" class="form-control selctopt" value="" id="to_date_id" name="to_date">
                                    </div>


                                    <div class="col-12 col-md-12 col-lg-3 mb-3" id="by-class">
                                       <label for="Period">By Class</label><br>
                                       <select class="form-control mx-0 w-100" name="custom_class_id" id="custom_class_id">
                                          <option value="">All Class</option>
                                          <?php $__currentLoopData = $classList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                          <option value="<?php echo e($class->class_id); ?>-<?php echo e($class->id); ?> "><?php echo e($class->name); ?>-<?php echo e($class->section); ?> </option>
                                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                       </select>
                                    </div>

                                 </div>
                              </div>
                              <div class="col-12 col-md-12 col-lg-2 mt-0 mb-1 mt-md-0 mt-md-1 mt-lg-4 pt-0">
                                 <button type="submit" name="filldata" id="activity_fillter" value="filldatasubmit"
                                    class="btn btn-primary d-block w-100 mt-2 submit_btn"><i class="fa fa-filter" aria-hidden="true"></i> View Report
                                 </button>
                                 <!-- <a  class="btn btn-primary mt-1" href="">Reset</a>  -->
                              </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!---->
         </form>
         <p id="load_more_button"></p>


         <div class="container-fluid p-0">
            <div class="responsive" style="margin-top: 0px !important;" id="record_table">
               <table id="reporttable" class="table table-sm table-striped tbl-style" calspan="0" rowspan="0">
                  <thead>
                     <tr>
                        <th scope="col">Trainer Name</th>
                        <th scope="col" width="8%">Date</th>
                        <th scope="col">Period</th>
                        <th scope="col">Class</th>
                        <th scope="col">Skill Area </th>
                        <th scope="col">Skill / Sports </th>
                        <th scope="col">Technique </th>
                        <th scope="col">Activity </th>
                        <th scope="col">Present</th>
                        <th scope="col">Absent</th>
                     </tr>
                  </thead>
                  <tbody> </tbody> 
               </table>
            </div>
         </div>
      </div>
   </div>
</div>


<!-- The Activity Modal -->
  <div class="modal" id="activityDetailId">
    <div class="modal-dialog modal-lg modal-xl modal-dialog-scrollable">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
            <!-- <h2>Activity Info</h2> -->
            <h3 class="modal-title" id="model-title-id"></h3>
        </div>
        
        <button type="button" class="close" data-dismiss="modal">×</button>
      <div id="modal-image-id"></div>
      
        <!-- Modal body -->
        <div class="modal-body pt-0 pb-4 px-4 mt-3">
        
        <div class="activity-details mb-4">
        <div class="act__video">
         <iframe id="youtubeurl_id" src="https://www.youtube.com/embed/QUTYxwTsbiM?si=KHp-2Z1yYZFHCzJS" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
         </div>
          <div class="img-act">
           <img id="modal-image" src="" alt="Activity Image" class="img-fluid mb-3">
         </div>
        <div class="f-row">
      <p id="is-activity-happend"></p>
        <div class="std-info mb-4">
         
            <p>Class: <span id="model-cls-sec-id"></span></p>
            <p>Skill Area: <span id="model-skill-area-id">Skill Area</span></p>
            <p>Skill/ Sports: <span id="model-sports-id">Sports</span></p>
            <p>Techniques: <span id="model-technique-id">Sudden Change of direction</span></p>
        </div>
      
      <div class="break-line pt-3 pb-2 my-3" id="learning_outcomes_parent_id">
         <h4>Learning Outcomes</h4> 
         <p id="learning_outcomes_id" class="l-cum"></p>
      </div>
         </div>
         
        </div>
      <div class="description break-line" id="model-description-parent_id">
         <h4>Description</h4>
         <p id="model-description-id" class="des-txt"></p>
         </div>
       
      <div class="break-line pt-3 pb-2 my-3" id="change_it_parent_id"><h4>Variation</h4>  <p id="change_it_id"></p></div>
      
      <div class="break-line pt-3 pb-2 my-3" id="coaching_parent_id"><h4>Coaching/Teaching Tips</h4>  <p id="coaching_id"></p></div>
      
      <div class="break-line pt-3 pb-2 my-3" id="equipment_parent_id"><h4>Equipment</h4>  <p id="equipment_id"></p></div>

        
        </div>
      
        
        <!-- Modal footer -->
        <!-- <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
         -->
      </div>
    </div>
  </div>
  <!-- End The Model -->

  

<script>

   /**
    * 06-08-2024
    * Load and manipulate Activites records into datatable.
    * */
   $(document).ready(function(){

      loadDataTable('bytrainer');

      function loadDataTable(condition) {

         if ($.fn.DataTable.isDataTable('#reporttable')) {
            $('#reporttable').DataTable().destroy();
         }
         $('#reporttable').empty();
         var columnsConfig;
         var headersHtml = '';
   
         if (condition === 'bytrainer') {
            columnsConfig = [
               { data: 'name', name: 'name' },
               { data: 'date', name: 'date' },
               { data: 'period', name: 'period' },
               { data: 'classandsec', name: 'classandsec' },  
               { data: 'skillareas', name: 'skillareas' },
               { data: 'sports', name: 'sports' },
               { data: 'techniques', name: 'techniques' },
               { data: 'title', name: 'title' },
               { data: 'present_count', name: 'present_count' },
               { data: 'absent_count', name: 'absent_count' }
           ];

            headersHtml = `
                <tr>
                    <th width="12%">Name</th>
                    <th width="8%">Date</th>
                    <th width="5%">Period</th>
                    <th width="11%">Class</th>
                    <th>Skill Area</th>
                    <th>Sports</th>
                    <th>Techniques</th>
                    <th>Title</th>
                    <th width="3%">Present</th>
                    <th width="3%">Absent</th>
                </tr>
            `;

         } else {
            
            columnsConfig = [
               { data: 'classandsec', name: 'classandsec' },
               { data: 'date', name: 'date' },
               { data: 'period', name: 'period' },
               { data: 'skillareas', name: 'skillareas' },
               { data: 'sports', name: 'sports' },
               { data: 'techniques', name: 'techniques' },
               { data: 'title', name: 'title' },
               { data: 'name', name: 'name' },
               { data: 'present_count', name: 'present_count' },
               { data: 'absent_count', name: 'absent_count' }
           ];
            
           headersHtml = `
                <tr>
                    <th width="11%">Class</th>
                    <th width="8%">Date</th>
                    <th width="3%">Period</th>
                    <th>Skill Area</th>
                    <th>Sports</th>
                    <th>Techniques</th>
                    <th>Title</th>
                    <th width="12%">Name</th>
                    <th width="3%">Present</th>
                    <th width="3%">Absent</th>
                </tr>
            `;
         }
         

         $('#reporttable').append(`
            <thead>
                ${headersHtml}
            </thead>
            <tbody>
                <!-- Data rows will be filled by DataTables -->
            </tbody>
        `);

         var route = "<?php echo e(route('viewschooldart')); ?>";
         var method = 'GET';
         loadData(route , method ,serializedData ='' , columnsConfig);
      }

      $("input[name='options_bytype']").change(function() {
         loadDataTable($(this).val());
      });
   });


   /**
    * 06-08-2024
    * Sorting Trainer and Class
    * */
   $(document).ready(function() {
      reorderFields(["by-trainer", "from-date", "last-date",  "by-class"]);
      $("input[name='options_bytype']").change(function() {
         var selectedOption = $(this).val();

         if ($(this).val() === "bytrainer"){
            reorderFields(["by-trainer", "from-date", "last-date",  "by-class"]);
         }else if ($(this).val() === "byclass") {
            reorderFields(["by-class", "from-date", "last-date", "by-trainer" ]);
         }
      });

      function reorderFields(order) {
         var formFields = $("#form-fields");
         var fields = order.map(function(id) {
           return $("#" + id).detach();
         });

         fields.forEach(function(field) {
           formFields.append(field);
         });
      }
   });


   /**
    * 06-08-2024
    * Filter Activities Record using ajax and maniplate the response in datatable.
    * */
   $(document).on('submit', 'form#reportform', function(e) {
      e.preventDefault();

      var $table = $('#reporttable');
      if ($.fn.DataTable.isDataTable($table)) {
         $table.DataTable().destroy();
      }

      var serializedData = {};
      var formData = new FormData(document.querySelector('form#reportform'));
      formData.forEach(function(value, key) {
        serializedData[key] = value;
      });


      var condition = $("input[name=options_bytype]:checked").val()
      var columnsConfig;

      if (condition === 'bytrainer') {
         columnsConfig = [
            { data: 'name', name: 'name' },
            { data: 'date', name: 'date' },
            { data: 'period', name: 'period' },
            { data: 'classandsec', name: 'classandsec' },
            { data: 'skillareas', name: 'skillareas' },
            { data: 'sports', name: 'sports' },
            { data: 'techniques', name: 'techniques' },
            { data: 'title', name: 'title' },
            { data: 'present_count', name: 'present_count' },
            { data: 'absent_count', name: 'absent_count' }
        ];

      } else {
          columnsConfig = [
            { data: 'classandsec', name: 'classandsec' },
            { data: 'date', name: 'date' },
            { data: 'period', name: 'period' },
            { data: 'skillareas', name: 'skillareas' },
            { data: 'sports', name: 'sports' },
            { data: 'techniques', name: 'techniques' },
            { data: 'title', name: 'title' },
            { data: 'name', name: 'name' },
            { data: 'present_count', name: 'present_count' },
            { data: 'absent_count', name: 'absent_count' }
        ];
      }

      var route =  "<?php echo e(route('getTrainerReport')); ?>";
      var method = "POST";
      loadData(route , method , serializedData , columnsConfig);
   });


   /**
    * 06-08-2024
    * Loading Datatable.
    * */
   function loadData(route , method ,serializedData = '', columnsConfig) {

      $('#reporttable').DataTable({

         "dom": `<"top"lf><"filter-right"B>rt<"bottom"ip><"clear">`,
         "lengthChange": true,
         "lengthMenu": [[20, 40, 60, 80, 100, -1], [20, 40, 60, 80, 100, 'All']],
         "pageLength": 100,
         "info": true,
         "responsive": true,
         "processing": true,
         "serverSide": true,
         "order": [],
         "ajax": {
            "headers": { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            "type": method,
            "url": route,
            "data": function(d) {
               return Object.assign({}, d, serializedData);
            },
            "dataType": 'json',
            "dataSrc": "data",
            "error": function(xhr, error, thrown) {
               console.error('Error fetching data:', error);
            }
         },

         "columns": columnsConfig,
         "buttons": [
            {
               extend: 'collection',
               text: 'Export',
               className: 'exportButton',
               buttons: [
                  {
                     extend: 'excelHtml5',
                     text: 'Excel',
                     customize: function(xlsx) {
                          var sheet = xlsx.xl.worksheets['sheet1.xml'];

                          $(sheet).find('row c[r^="D"]').each(function() {
                              var cell = $(this);
                              var value = cell.text();
                              if (value) {
                                  var date = new Date(value);
                                  if (!isNaN(date.getTime())) {
                                      var day = ('0' + date.getDate()).slice(-2);
                                      var month = ('0' + (date.getMonth() + 1)).slice(-2);
                                      var year = date.getFullYear();
                                      cell.text(day + '-' + month + '-' + year);
                                  }
                              }
                          });
                      }
                  },


                  {
                     extend: 'pdfHtml5',
                     text: 'PDF',
                     customize: function(doc) {
                          doc.content.forEach(function(item) {
                              if (item.table && item.table.body) {
                                  item.table.body.forEach(function(row) {
                                      row.forEach(function(cell, index) {
                                          if (cell.text && index === 2) {
                                              var date = new Date(cell.text);
                                              if (!isNaN(date.getTime())) {
                                                  var day = ('0' + date.getDate()).slice(-2);
                                                  var month = ('0' + (date.getMonth() + 1)).slice(-2);
                                                  var year = date.getFullYear();
                                                  cell.text = day + '-' + month + '-' + year;
                                              }
                                          }
                                      });
                                  });
                              }
                          });
                     }
                  }
               ],
            }
         ]
      });
   }


   function modelContent(ActivityId, skillarea, sports, technique, ClassSectionName, TickMark='') {


      jQuery.ajax({
         url: "<?php echo e(route('lession.plan.details')); ?>",
         data: {
             "activiy_id": ActivityId,
             "_token": "<?php echo e(csrf_token()); ?>"
         },
         type: 'GET',
         success: function(response) {

            $.each(response.activityDetail, function(key, val) {

               var word = "wp-content"; 
               var img = imagepath ='';
               var mystring = val.image;
               
               
               if(mystring.indexOf(word) !== -1)  { 
                   imagepath = val.image;
               } else if(val.image == '') {
                  imagepath = 'public/change-activities/default_activity_img.svg';  
               }else {
                  imagepath = 'public/uploads/'+val.image;
               }

               $("#modal-image").attr("src", imagepath);
               $("#model-title-id").html(val.title.toUpperCase());   
               
               if(val.description && val.description.length > 0){
                  $("#model-description-parent_id").show();  
                  $("#model-description-id").html(val.description);
               } else {
                  $("#model-description-parent_id").hide();
               }
               
               if(val.learning_outcomes && val.learning_outcomes.length > 0) {  
                  $("#learning_outcomes_parent_id").show();  
                  $("#learning_outcomes_id").html(val.learning_outcomes);
               } else {
                  $("#learning_outcomes_parent_id").hide();
               }
               
               if(val.change_it && val.change_it.length > 0)
               {
                $("#change_it_parent_id").show();
                      $("#change_it_id").html(val.change_it);  
               }
               else
               {
                 $("#change_it_parent_id").hide();
               }
               
               
               if (val.coaching && val.coaching.length > 0) 
               {
                $("#coaching_parent_id").show();
                      $("#coaching_id").html(val.coaching);
               }
               else
               {
                $("#coaching_parent_id").hide();
               }
               
               if (val.equipment && val.equipment.length > 0) 
               {
                $("#equipment_parent_id").show();
                      $("#equipment_id").html(val.equipment);
               }
               else
               {
                $("#equipment_parent_id").hide();
               }
               

                     
               
               
                     $("#youtubeurl_id").attr("src",val.url);
               $('#activityDetailId').modal('show');
               $('#model-skill-area-id').html(skillarea);
               $('#model-sports-id').html(sports);
               $('#model-technique-id').html(technique);
               $('#model-cls-sec-id').html(ClassSectionName);
               if(TickMark == 'active-completed')
                $('#is-activity-happend').addClass(TickMark).html('<span>Completed</span>');
                else 
                $('#is-activity-happend').addClass('').text('');
            
               
               
               
               
               var src = $("#youtubeurl_id").attr('src');
               if (src && src.length > 0) 
               {
                $(".img-act").hide();
                $(".act__video").show();
               }else
               {
                $(".act__video").hide();
                $(".img-act").show();
               }
               
             });


         }
     });
     
    }

   // to set calender date
   const fromDateInput = document.getElementById('from_date_id');
   const toDateInput = document.getElementById('to_date_id');

   const today = new Date().toISOString().split("T")[0];
   fromDateInput.max = today;
   toDateInput.max = today;

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.filldart-app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\nep\resources\views/school/viewschooldart.blade.php ENDPATH**/ ?>