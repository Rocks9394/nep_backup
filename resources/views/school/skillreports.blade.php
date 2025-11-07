@extends('layouts.filldart-app')
@section('title', 'Goforfit | ' . $title)
@section('content')

<div class="container" >
    <div class="t-mrg2">
   <div class=" all-chaptr-cards">
      <!-- Success message -->
      <form method="POST" name="view-trainer-report" id="reportform"  action="javascript(0);">
         <div class="row">
            <div class="col">
               <a href="#a" onclick="history.back()" class="back-button">
                  <span class="arrow"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5" /></svg></span>
               </a>
               <div class="heading-rw mt-0"> <h1>{{$title}}</h1></div>
            </div>
         </div>
         <div class="row">
            <div class="col-12">
               <div id="activity_from_div" class="sports-filtr overlay">
                  <div class="form-row">

                     {{--
                     <div class="form-group col-12 col-sm-6 col-md-3 mb-3">
                        <label for="Class">By Trainer</label><br>
                        <select class="form-control mx-0 w-100" name="trainer_id" id="trainer_id" >
                           <option value="">All Trainer</option>                          
                           @foreach($trainerList as $trainer)
                           <option value="{{ $trainer->trainer_id }}">{{ $trainer->name }}</option>
                           @endforeach                          
                        </select>
                     </div>
                      --}}

                     <div class="form-group col-12 col-sm-6 col-md-4 mb-3">
                        <label for="Period">By Class</label><br>
                        <select class="form-control mx-0 w-100" name="custom_class_id" id="custom_class_id">
                           <option value="">All Class</option>
                           @foreach($classList as $class)
                           <option value="{{ $class->custom_class_id }}">{{ $class->name }}-{{ $class->section }} </option>
                           @endforeach
                        </select>
                     </div>

                     <div class="form-group col-6 col-sm-6 col-md-3 mb-3">
                        <label for="skillarea">From Date</label><br>
                        <input type="date" class="form-control mx-0 w-100" value="" required id="from_date_id" name="from_date">
                     </div>
                     <div class="form-group col-6 col-sm-6 col-md-3 mb-3">
                        <label for="sports">To Date</label><br>
                        <input type="date" class="form-control selctopt" value="" required id="to_date_id" name="to_date">
                     </div>

                     <div class="form-group col-12 col-sm-12 col-md-2 mt-4 pt-0">
                        <button type="submit" name="filldata" id="activity_fillter" value="filldatasubmit"
                           class="btn btn-primary d-block w-100 mt-2 submit_btn"><i class="fa fa-filter" aria-hidden="true"></i> View Report
                        </button>
                     </div>

                  </div>
               </div>
            </div>
         </div>
         <!---->
      </form>

      <div class="container-fluid p-0">
         <div class="responsive-tbl mb-5">
         
         <table class="table table-sm table-striped tbl-style" calspan="0" rowspan="0">
            <thead>
               <tr>
                  <th scope="col">Classes </th>                  
                  <th scope="col">Section </th>
                  <th scope="col">Roll No.</th>
                   <th scope="col">Student Name</th>
                  <th scope="col">Completed Activites</th>     
                  <th scope="col">Present</th>
                  <th scope="col">Absent</th>
                  <th scope="col">Action</th>
               </tr>
            </thead> 

            <tbody id="reportdetails">

               @foreach($students as $details)
                  <tr>
                     <td>{{ $details->class }}</td>
                     <td>{{ $details->section }}</td>
                     <td>{{ $details->rollno }}</td>
                     <td>{{ $details->student_name }}</td>
                     <td>{{ $details->completedActivites }}</td>
                     <td>{{ $details->present }}</td>
                     <td>{{ $details->absent }}</td>
                     <td ><a href="" class="btn btn-outline-warning btn-sm">View</a></td>
                  </tr>
               @endforeach

            </tbody>
         </table>
         </div>
      </div>


   </div>
</div></div>
</div>
<!-- DataTables -->
<script>
    $(document).on('submit', '#reportform', function (e) {
       e.preventDefault();
       
   
       var form = $('#reportform')[0];
       var formData = new FormData(form);
   
       $.ajaxSetup({
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
       });
   
         $.ajax({
           type: "POST",
           url: "{{ route('getDartReport') }}",
           data: formData, //$("form#reportform").serialize(),            
           processData: false,
           contentType: false,
           dataType: 'json',
   
            success: function(response) {
               var data = response.data; 
               var uniqueReports = {};

               var tableRows = '';
               if(data.length > 0){

                  data.forEach(function(item) {

                     var identifier = item.trainer.name + '-' + item.class_name + item.class_section + item.period  + item.skill_area.name + item.sport.name + item.technique.name + item.activity.title;

                     if (!uniqueReports[identifier]) { 
                         uniqueReports[identifier] = true;
                         tableRows += '<tr>';
                         tableRows += '<td>' + item.trainer.name + '</td>';
                         tableRows += '<td>' + item.class_name + '</td>';
                         tableRows += '<td>' + item.class_section + '</td>';
                         tableRows += '<td>' + item.period + '</td>';
                         tableRows += '<td>' + item.date + '</td>';
                         tableRows += '<td>' + (item.skill_area.name ? item.skill_area.name : 'N/A') + '</td>';
                         tableRows += '<td>' + (item.sport.name ? item.sport.name : 'N/A') + '</td>';
                         tableRows += '<td>' + (item.technique.name ? item.technique.name : 'N/A') + '</td>';
                         tableRows += '<td>' + (item.activity.title ? item.activity.title : 'N/A') + '</td>';
                         tableRows += '<td>' + (item.present ? item.present : '0') + '</td>';
                         tableRows += '<td>' + (item.absent ? item.absent : '0') + '</td>';
                         tableRows += '</tr>';
                     }
                 });

               }else{
                  tableRows = '<tr><td colspan="12" style="text-align:center;">No Data Found</td></tr>';
               }

               $('#reportdetails').empty().append(tableRows);
            },
             
            error: function(xhr) {
               // Handle the error response
               console.log(xhr.responseText);
            }
       });      
    });
    


    $(document).ready(function() {

        $("input[name='options_bytype']").change(function() {
            var selectedOption = $(this).val();

            console.log('selected_option   : ' + selectedOption)

        });
    });


   
</script>
@endsection