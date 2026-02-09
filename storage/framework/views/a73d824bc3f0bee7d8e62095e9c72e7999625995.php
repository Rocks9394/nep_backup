
<?php $__env->startSection('title', 'Goforfit | ' . $title); ?>
<?php $__env->startSection('content'); ?>
<style type="text/css">
    * {
        margin: 0;
        padding: 0;
        text-indent: 0;
    }

    .s1 {
        color: black;
        font-family: Arial, sans-serif;
        font-style: normal;
        font-weight: normal;
        text-decoration: none;
        font-size: 9.5pt;
    }

    .s2 {
        color: #333;
        font-family: Arial, sans-serif;
        font-style: normal;
        font-weight: normal;
        text-decoration: none;
        font-size: 9pt;
    }

    h1 {
        color: black;
        font-family: Arial, sans-serif;
        font-style: normal;
        font-weight: bold;
        text-decoration: none;
        font-size: 13pt;
    }

    h2 {
        color: black;
        font-family: Arial, sans-serif;
        font-style: normal;
        font-weight: bold;
        text-decoration: none;
        font-size: 9.5pt;
    }

    .s3 {
        color: black;
        font-family: Arial, sans-serif;
        font-style: normal;
        font-weight: bold;
        text-decoration: none;
        font-size: 9pt;
    }

    .s4, .s4 p {
        color: black;
        font-family: Arial, sans-serif;
        font-style: normal;
        font-weight: normal;
        text-decoration: none;
        font-size: 9pt;
    }

    .s5 {
        color: black;
        font-family: "MS UI Gothic", sans-serif;
        font-style: normal;
        font-weight: normal;
        text-decoration: none;
        font-size: 9pt;
    }

    .s6 {
        color: black;
        font-family: Arial, sans-serif;
        font-style: normal;
        font-weight: normal;
        text-decoration: none;
        font-size: 10pt;
        vertical-align: 2pt;
    }

    .s7 {
        color: #333;
        font-family: Arial, sans-serif;
        font-style: normal;
        font-weight: normal;
        text-decoration: none;
        font-size: 9.5pt;
    }

    .s8 {
        color: #333;
        font-family: Arial, sans-serif;
        font-style: normal;
        font-weight: normal;
        text-decoration: none;
        font-size: 8.5pt;
    }

    p {
        color: #000000;
        font-family: Arial, sans-serif;
        font-style: normal;
        font-weight: normal;
        text-decoration: none;
        font-size: 6.5pt;
        margin: 0pt;
    }

    .a,
    a {
        color: #FFF;
        font-family: Arial, sans-serif;
        font-style: normal;
        font-weight: normal;
        text-decoration: none;
        font-size: 6.5pt;
    }

    table,
    tbody {
        vertical-align: top;
        overflow: visible;
    }

    /*   css code here*/
    .tbl-style {
       font-size: 14px;
       background-color: #fff;
       overflow: hidden;
    }
    .table tbody+tbody {
        border-top: 0px;
    }
    .table td, .table th {
        border-top: 0px;
        padding: 0.5rem;
    }
    .table thead th {
        border-bottom: 0px;
        background-color: #333;
        color:#fff;
    }
    .btn-secondary {
        background-color: #e6e6f9;
        border-color: #292775;
        color: #292775;
    }
    .btn-secondary:hover {
       background-color: #cdcde7;
       color: #292775;
    }
    .btn-secondary:not(:disabled):not(.disabled).active, .btn-secondary:not(:disabled):not(.disabled):active, .show>.btn-secondary.dropdown-toggle {
        background-color: #292775;
        border-color: #292775;
    }
    .responsive-tbl {
       overflow-x: auto;
       border: 1px solid #333;
       margin: 30px 0;
       border-radius: 6px;
    }
    .table-striped tbody tr:nth-of-type(odd) {
        background-color: rgb(237 239 244 / 80%);
    }

</style>



<div class="pg-yallow-color">
   <div class="container">
      <div class="navbar-expand-lg">
         <div id="fillter" class="" role="group" aria-label="Basic example">
         </div>
      </div>
   </div>
</div>

<div class="all-chaptr-cards">
  <form class="container" method="#" name="#" id="#"  action="javascript(0);">
     <div class="row">
        <div class="col">
           <div class="heading-rw mb-4">
              <h1><?php echo e($title); ?></h1>
           </div>
        </div>
     </div>
     <div class="row">
        <div class="col-12">
           <div id="activity_from_div" class="sports-filtr overlay">
              <div class="form-row">

                
                <div class="form-group col-12 col-sm-6 col-md-4 mb-3">
                    <label for="Period">By Class</label><br>
                    <select class="form-control mx-0 w-100" name="custom_class_id" id="custom_class_id">
                       <option value="">All Class</option>
                       <?php $__currentLoopData = $classList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                       <option value="<?php echo e($class->class_id); ?>-<?php echo e($class->id); ?> "><?php echo e($class->name); ?>-<?php echo e($class->section); ?> </option>
                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                 </div>
                 

                 <div class="form-group col-12 col-sm-6 col-md-4 mb-3">
                    <label for="Class">By Students</label><br>
                    <select class="form-control mx-0 w-100" name="trainer_id" id="trainer_id" >
                       <option value="">All Student</option>
                       <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                       <option value=" <?php echo e($data->id); ?> "><?php echo e($data->student_name); ?></option>
                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                 </div>

                 

                 <div class="form-group col-12 col-sm-12 col-md-2 mt-4 pt-0">
                    <button type="button" name="#" id="#" value="#" class="btn btn-primary d-block w-100 mt-2 submit_btn">
                        <i class="fa fa-filter" aria-hidden="true"></i> View Report
                    </button>
                 </div>

                 <div class="form-group col-12 col-sm-12 col-md-2 mt-4 pt-0">
                     <button class="btn btn-primary d-block w-100 mt-2 submit_btn" type="button" data-toggle="collapse" data-target="#skill_report" aria-expanded="false" aria-controls="skill_report"> View All  </button>
                 </div>

              </div>
           </div>
        </div>
     </div>
  </form>
</div>


    
    





<div class="collapse1" id="skill_report1">
    <div class="card card-body">

    <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $details): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div style="margin: auto; width: 800px;">
       <div style="width: 100%; margin-top: 30px;">
            <table class="s1" style="text-indent: 0pt;text-align: left; border: 2px solid #000; padding: 5px; margin-bottom: 30px; width: 800px;"
             cellspacing="0" cellpadding="0">
             <tr>
                <th style="padding: 4px;">Name</th>
                <td style="padding: 4px;"><?php echo e($details->student_name); ?></td>
                <th style="padding: 4px;">Class</th>
                <td style="padding: 4px;"><?php echo e($details->class); ?> <?php echo e($details->section_id); ?></td>
             </tr>
             <tr>
                <th style="padding: 4px;">Date of Birth</th>
                <td style="padding: 4px;"><?php echo e($details->dob); ?></td>
                <th style="padding: 4px;">Gender</th>
                <td style="padding: 4px;"><?php echo e($details->gender); ?></td>
             </tr>

            <?php if($details->weight && $details->height): ?>
             <tr> 
                <th style="padding: 4px;">Weight (kgs)</th>
                <td style="padding: 4px;">-</td>
                <th style="padding: 4px;">Height (cms)</th>
                <td style="padding: 4px;">-</td>
             </tr>
            <?php endif; ?>
            </table>

            <h1 style="text-indent: 0pt;text-align: center; margin-bottom: 30px;">P.E. Class activities and Observations by Teacher </h1>

            <table style="border-collapse:collapse; width: 100%;" cellspacing="0" cellpadding="0">
                <tr class="s3">
                  <th style="text-align: left; width:25%; padding-bottom: 4px;">Skill Area</th>
                  <th style="text-align: left; width:15%; padding-bottom: 4px;">Skill / Sports</th>
                  <th style="text-align: left; width:15%; padding-bottom: 4px;">Technique</th>
                  <th style="text-align: left; width:auto; padding-bottom: 4px;">Activity</th>
                  <th style="text-align: center; padding-bottom: 4px;" colspan="5">Rating</th>
                  <th style="text-align: left; padding-bottom: 4px; padding-left: 15px; width:10%;">Level</th>
                </tr>
               

                <?php $__currentLoopData = $details->reports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $records): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                
                <tr style="height:18pt">

                  <td style="border-top-style:solid;border-top-width:1pt;border-top-color:#E5E5E5;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#E5E5E5;border-right-style:solid;border-right-width:1pt;border-right-color:#E5E5E5; vertical-align: middle; padding-top:2px; padding-bottom:2px;"
                     rowspan="total">

                     <p style="text-indent: 0pt;text-align: left;"><br /></p>
                     <p class="s3" style="padding-left: 2pt;text-indent: 0pt;line-height: 117%;text-align: left;">
                        <?php echo e($records->records['skill_area_id']); ?> 
                     </p>
                  </td>

                  <td
                     style="border-top-style:solid;border-top-width:1pt;border-top-color:#E5E5E5;border-left-style:solid;border-left-width:1pt;border-left-color:#E5E5E5;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#E5E5E5; padding-left:2px; padding-top:2px; padding-bottom:6px;">
                     <p class="s4" style="padding-top: 3pt;padding-left: 2pt;text-indent: 0pt;text-align: left;">
                        <?php echo e($records->records['skill_sports_id']); ?>

                     </p>
                  </td>

                  <td
                     style="border-top-style:solid;border-top-width:1pt;border-top-color:#E5E5E5;border-left-style:solid;border-left-width:1pt;border-left-color:#E5E5E5;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#E5E5E5; padding-left:2px; padding-top:2px; padding-bottom:6px;">
                     <p class="s4" style="padding-top: 3pt;padding-left: 2pt;text-indent: 0pt;text-align: left;">
                        <?php echo e($records->records['technique_id']); ?>

                     </p>
                  </td>


                   <td
                     style="border-top-style:solid;border-top-width:1pt;border-top-color:#E5E5E5;border-left-style:solid;border-left-width:1pt;border-left-color:#E5E5E5;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#E5E5E5; padding-left:2px; padding-top:2px; padding-bottom:6px;">
                     <p class="s4" style="padding-top: 3pt;padding-left: 2pt;text-indent: 0pt;text-align: left;">
                        <?php echo e($records->records['activity_id']); ?>

                     </p>
                  </td>

                    <?php for ($i=0; $i < $records->level ; $i++) {  ?>
                       <td style="width:12pt;border-top-style:solid;border-top-width:1pt;border-top-color:#E5E5E5;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#E5E5E5; padding-top:6px; padding-bottom:6px;">
                         <p class="s5" style="padding-left: 2pt;text-indent: 0pt;text-align: center;">&#9733;</p>
                      </td>
                    <?php } ?>
                    

                    <?php for ($i=0 ; $i < 5-$records->level ; $i++ ) { ?>
                    <td style="width:12pt;border-top-style:solid;border-top-width:1pt;border-top-color:#E5E5E5;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#E5E5E5; padding-top:6px; padding-bottom:6px;">
                         <p class="s5" style="padding-left: 2pt;text-indent: 0pt;text-align: left;">&#9734;</p>
                      </td>                       
                    <?php } ?>


                    <?php  
                        switch ($records->level) {
                            case '1':
                                $level = 'Learning';
                                break;

                            case '2':
                                $level = 'Progressing';
                                break;

                            case '3':
                                $level = 'Desired';
                                break;

                            case '4':
                                $level = 'Proficient';
                                break;

                            case '5':
                                $level = 'Exemplary';
                                break;                                
                            
                            default:
                                $level = 'Absent';
                                break;
                        }
                    ?> 

                    <td style="width:12pt;border-top-style:solid;border-top-width:1pt;border-top-color:#E5E5E5;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#E5E5E5; padding-top:2px; padding-bottom:6px; padding-left: 15px;">
                     <p class="s4" style="padding-top: 3pt;padding-right: 2pt;text-indent: 0pt;text-align: left;">                    
                        <?php echo e($level); ?>

                     </p>
                  </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </table>
       </div>
    </div>

    </hr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.filldart-app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\nep\resources\views/reports/SkillReport.blade.php ENDPATH**/ ?>