<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Report (PDF)</title>

    <style>
        @page  {
            size: A4;
            margin: 10mm;
        }

        body {
            font-family: "Roboto Condensed", sans-serif; 
            font-optical-sizing: auto; 
            font-size: 10pt;
            color: #222;
            margin: 0;
            padding: 0;
            background: #fff;
        }

        .container {
            width: 100%;
            background: #fff;
            position: relative;
            height: 100%;
        }

        .header {
            padding: 20px 25px;
        }

        /* 🔥 PDF SAFE HEADER */
        .header-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .header-table td {
            vertical-align: middle;
        }

        .header-logo-left {
            width: 20%;
            text-align: left;
        }

        .header-title {
            width: 60%;
            text-align: center;
            font-size: 18px;
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        .header-logo-right {
            width: 20%;
            text-align: right;
        }

        .header-table img {
            height: 60px;
        }

        .student-details {
            width: 100%;
            border-collapse: collapse;
            font-size: 11px;
        }

        .student-details th,
        .student-details td {
            border: 1px solid #d4dce6;
            padding: 8px 10px;
        }

        .student-details th {
            background: #e8f0f8;
            font-weight: 700;
            text-align: left;
            width: 18%;
        }

        .student-details td {
            width: 32%;
            color: #334e68;
        }

        .report-content {
            padding: 25px;
        }

        .report-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 9pt;
        }

        .report-table th {
            background: #222;
            color: #fff;
            padding: 8px;
            border: 1px solid #333;
            white-space: nowrap;
        }

        .report-table th.center {
            text-align: center;
        }

        .report-table td {
            border: 1px solid #e0e0e0;
            padding: 6px;
            vertical-align: middle;
        }

        .skill-area {
            font-weight: bold;
            background: #fafafa;
        }

        .stars {
            text-align: center;
            font-size: 11pt;
            white-space: nowrap;
            padding: 0 5px;
        }

        .star-filled {
            color: #ffc107;
        }

        .star-empty {
            color: #ddd;
        }

        .signatures {
            position: fixed;
            bottom: 10mm;
            left: 10mm;
            right: 10mm;
        }


        .signature-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .signature-table td {
            width: 50%;
            vertical-align: top;
        }

        .signature-table td:first-child {
            text-align: left;
        }

        .signature-table td:last-child {
            text-align: right;
        }


        .signature-name {
            font-weight: bold;
            text-align:center;
            margin-bottom: 4px;
        }

        .signature-title {
            font-size: 9pt;
            text-align:center;
        }

        .signature-org {
            font-size: 8.5pt;
            text-align:center;
            color: #666;
        }
    </style>
</head>

<body>
<div class="container">

    <!-- HEADER -->
    <div class="header">

        <table class="header-table">
            <tr>
                <td class="header-logo-left">
                    <img src="<?php echo e(public_path('assets/reports/seqfast-logo.png')); ?>" width="80">
                </td>

                <td class="header-title">
                    P.E. Class Activities & Teacher Observations
                </td>

                <td class="header-logo-right">
                    <?php if(!empty($school->logo)): ?>                                        
                        <img src="<?php echo e(public_path('assets/uploads/logos/' . $school->logo)); ?>" alt="" style="width: auto; height: 50px; object-fit: contain;">
                    
                    <?php else: ?>
                        <img src="<?php echo e(public_path('assets/uploads/logos/default_school-logo.png' )); ?>" alt="" style="width: auto; height: 50px; object-fit: contain;">
                      
                    <?php endif; ?>
                </td>
            </tr>
        </table>

        <?php
            use Carbon\Carbon;
            $dob = Carbon::parse($student->dob);
            $formattedDob = $dob->format('d M Y');
            $age = $dob->age;
            $gender = strtolower($student->gender) === 'male' ? 'Boy' : 'Girl';
        ?>

        <!-- STUDENT DETAILS -->
        <table class="student-details">
            <tr>
                <th>Name</th>
                <td><?php echo e($student->student_name); ?></td>
                <th>Class</th>
                <td><?php echo e($student->classname); ?>-<?php echo e($student->section); ?></td>
            </tr>
            <tr>
                <th>Roll No</th>
                <td><?php echo e($student->rollno); ?></td>
                <th>Registration No</th>
                <td><?php echo e($student->student_uid); ?></td>
            </tr>
            <tr>
                <th>Date of Birth</th>
                <td><?php echo e($formattedDob); ?> (<?php echo e($age); ?> Years)</td>
                <th>Gender</th>
                <td><?php echo e($gender); ?></td>
            </tr>
            <tr>
                <th>School Code</th>
                <td><?php echo e($school->school_code); ?></td>
                <th>School Name</th>
                <td><?php echo e($school->school_name); ?></td>
            </tr>
        </table>
    </div>

    <!-- REPORT TABLE -->
    <div class="report-content">
        <!-- <table class="report-table">
            <tr>
                <th>Skill Area</th>
                <th>Activity</th>
                <th>Technique</th>
                <th class="center" colspan="6">Rating</th>
                <th>Level</th>
            </tr>

            <?php $__currentLoopData = $getReport; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $spval): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <?php
                    $activities = $getSkills[$spval->skill_sports_id] ?? collect();
                    $rowCount = $activities->count();
                ?>

                <?php if($rowCount > 0): ?>

                    <?php $__currentLoopData = $activities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>

                            
                            <?php if($index == 0): ?>
                                <td class="skill-area" rowspan="<?php echo e($rowCount); ?>">
                                    <?php echo e($spval->sportsskillname); ?>

                                </td>
                            <?php endif; ?>

                            <td><?php echo e($activity->title); ?></td>
                            <td><?php echo $activity->techniques_name; ?></td>

                            <td class="stars" colspan="6">
                                <?php for($i = 0; $i < $activity->rating; $i++): ?>
                                    <span class="star-filled">&#9733;</span>
                                <?php endfor; ?>

                                <?php for($i = 0; $i < 6 - $activity->rating; $i++): ?>
                                    <span class="star-empty">&#9734;</span>
                                <?php endfor; ?>
                            </td>

                            <td><?php echo e($activity->level_name); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <?php endif; ?>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </table> -->

        <table cellspacing="0" cellpadding="0" style="border-collapse: collapse; margin-bottom: 10px;">
            <tr>
                <td style="border-bottom: 3px solid #E60A00;">
                    <div style="background:#E60A00; float:left; display: inline-flex; align-items: center; color: #fff; font-size: 18px; font-weight: 600; height: 32px;">
                        <div style="float: left; padding: 1px 0px 0px 10px; margin-bottom: -3px;">Developmental Skills for Pre Nursery-A</div>
                        <div style="float:left; transform: skew(26deg,0deg); display:inline-block; width: 20px; height: 32px; background: #E60A00; position: relative; right: -10px;"></div>
                    </div>
                </td>
            </tr>
        </table>
        
        <?php $__currentLoopData = $getReport; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $spval): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <?php
                $activities = $getSkills[$spval->skill_sports_id] ?? collect();
            ?>

            <?php if($activities->count() > 0): ?>
                <h2 style="padding: 5px 10px; font-size: 20px; margin:0px; background:#0A87CD; color:#fff; font-size: 16px; font-weight: 600;"><?php echo e($spval->sportsskillname); ?></h2>
                <table class="report-table" style="margin-bottom: 30px;">
                    <tr style="background-color: #fecd0a;">
                        <!-- <th>Skill Area</th> -->
                        <th>Activity</th>
                        <th>Technique</th>
                        <th class="center" colspan="6">Rating</th>
                        <th>Level</th>
                        <th>Teacher's Observations</th>
                    </tr>

                    <?php $__currentLoopData = $activities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <!-- <td class="skill-area">
                                <?php echo e($spval->sportsskillname); ?>

                            </td> -->

                            <td><?php echo e($activity->title); ?></td>

                            <td><?php echo $activity->techniques_name; ?></td>

                            <td class="stars" colspan="6">
                                <?php for($i = 0; $i < $activity->rating; $i++): ?>
                                    <span class="star-filled">&#9733;</span>
                                <?php endfor; ?>

                                <?php for($i = 0; $i < 6 - $activity->rating; $i++): ?>
                                    <span class="star-empty">&#9734;</span>
                                <?php endfor; ?>
                            </td>

                            <td><?php echo e($activity->level_name); ?></td>

                            <td><?php echo $activity->descriptions; ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </table>

            <?php endif; ?>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </div>

    <!-- SIGNATURES -->
    <div class="signatures">
        <table class="signature-table">
            <tr>
                <td>
                    <div class="signature-name">Rashmi Sharma</div>
                    <div class="signature-title">Director</div>
                    <div class="signature-org">Sequoia Fitness & Sports Technology</div>
                </td>
                <td style="width: 30%;"></td>
                <td>
                    <div class="signature-name"><?php echo e($school->school_principal); ?></div>
                    <div class="signature-title">Principal</div>
                    <div class="signature-org"><?php echo e($school->school_name); ?></div>
                </td>
            </tr>
        </table>
    </div>

</div>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\nep\resources\views/reports/skills/skill-reports-pdf.blade.php ENDPATH**/ ?>