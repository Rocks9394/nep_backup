<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="<?php echo e(asset('public/favicon.ico')); ?>" sizes="32x32" />
    <title>Student Report</title>

    <style>
        page[size="A4"] {
            width: 21cm;
            height: 29.7cm;
            margin: 0;
        }
            *,
        body {
            margin: 0;
            padding: 0;
        }

        body {
            font-family: "Roboto Condensed", sans-serif;
            font-optical-sizing: auto;
            background-color: #eee;
        }

        .container {
            background: #fff;
            padding: 0;
            border: none;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            /* border-radius: 8px; */
            user-select: none;
            cursor: default;
            overflow: hidden;
            width: 100%;
            max-width: 21cm;
            margin: 0 auto;
            min-height: 29.7cm;
            display: flex;
            flex-direction: column;
        }

        .header {
            padding: 40px 25px 10px;
        }

        .logo {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px !important;
        }

        .logo img {
            height: 60px;
            width: auto;
            object-fit: contain;
        }

        .header-title {
            text-align: center;
            font-size: 18px;
            font-weight: 700;
            margin: 0;
            letter-spacing: 0.5px;
        }

        h1 {
            display: none;
        }

        .student-details {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #0A87CD;
            margin: 0 !important;
            font-size: 12px;
            background: rgba(255,255,255,0.95);
        }

        .student-details th {
            background: #e8f0f8;
            text-align: left;
            padding: 5px;
            width: 20%;
            border: 1px solid #d4dce6;
            font-weight: 700;
        }

        .student-details td {
            padding: 5px;
            border: 1px solid #d4dce6;
            width: 30%;
            color: #334e68;
        }
        .report-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 9pt;
            flex: 1;
            table-layout: fixed;
        }

        .report-table th,
        .report-table td {
            border: 1px solid orange;
            font-size: 9pt;
            padding: 6px;
        }

        .report-table th {
            color: #000;
            text-align: left;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .report-table th:nth-child(1),
        .report-table td:nth-child(1) { 
            width: 15%; 
        }

        .report-table th:nth-child(2),
        .report-table td:nth-child(2) { 
            width: 18%; 
        }

        .report-table th:nth-child(3),
        .report-table td:nth-child(3) { 
            width: 12%; 
        }

        .report-table th:nth-child(4),
        .report-table td:nth-child(4) { 
            width: 20%; 
        }

        .report-table th:nth-child(5),
        .report-table td:nth-child(5) { 
            width: 40%; 
        }
        .report-table td.stars {
            text-align: center;
            font-size: 12pt;
            width: 20%;
        }

        .skill-area {
            font-weight: bold;
            background: #fafafa;
        }

        .star-filled {
            color: #ffc107;
        }

        .star-empty {
            color: #ddd;
        }
        
        .signatures {
            display: flex;
            justify-content: space-between;
            margin-top: 60px;
            text-align: center;
            padding: 0 25px 25px;
            margin-top: auto;
        }

        .signature-block {
            width: 45%;
        }

        .signature-name {
            font-weight: bold;
            margin-bottom: 4px;
        }

        .signature-title {
            font-size: 9pt;
            color: #444;
        }

        .signature-org {
            font-size: 8.5pt;
            color: #666;
        }

        .report-content {
            padding: 25px;
            display: flex;
            flex-direction: column;
            flex: 1;
        }

        @media  screen {
            body {
                background: #f0f4f9;
            }
        }
    </style>
</head>

<body>
<div class="container" style="width: 21cm; border-collapse: collapse; margin-left: auto; margin-right: auto; font-family: Roboto Condensed, sans-serif; font-size: 12px; border: 0px; background-color: #fff;">
    <table cellspacing="0" cellpadding="0" style="border-collapse: collapse; width:100%;">
        <tr style="background-color: #0A87CD; height: 70px; ">
            <td style="vertical-align: top;">
                <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0px; height: 100%;">
                    <tr>
                        <td style="width:5%;"></td>
                        <td style="position: relative; vertical-align: top; width: 20%; height: 100%;">
                            <div style="position: absolute; top: 0; display: flex; align-items: flex-start; left: -3px; z-index: 10; width: 130px; overflow: hidden;">
                                <div class="logo" style="position: relative; width: inherit;">
                                    <span style="position: absolute; top:0; left:0; width: inherit; padding: 20px; box-sizing: border-box; display:inline-block;">
                                        <img src="<?php echo e(asset('/public/assets/reports/seqfast-logo.png')); ?>" alt="" style="width: 95px;margin-top: 0px;">
                                    </span>
                                    <img src="<?php echo e(asset('/public/assets/reports/logo-bg.jpg')); ?>" alt="" style="width: 130px;height: 140px;margin-top: -35px;">
                                </div>
                            </div>
                            <img src="<?php echo e(asset('/public/assets/reports/yellow-dot.png')); ?>" alt="" style="width: 35px;height: 35px;position: relative;left:124px;top: -5px;">
                        </td>
                        <td style="width: 50%;">
                            <div style="padding: 20px 5px 20px 5px;font-weight: 600; font-size: 26px; color:#fff; text-align:center; text-transform: uppercase;">Formative Assessment Report
                            </div>
                        </td>
                        <td style="position: relative; vertical-align: top; width: 20%; height: 100%;">
                            <img src="<?php echo e(asset('/public/assets/reports/yellow-dot.png')); ?>" alt="" style="width: 35px;height: 35px;position: relative;top: -5px;">
                            <div style="position: absolute; top: 0; display: flex; align-items: flex-start; z-index: 10; width: 130px; overflow: hidden;left: 32px;">
                                <div class="logo" style="position: relative; width: inherit;">
                                    <span style="position: absolute; top:0; left:0; width: inherit; padding: 20px; box-sizing: border-box; display:inline-block;">
                                        <img src="<?php echo e(asset('public/assets/uploads/logos/' . $school->logo)); ?>" alt="" style="width: 95px;margin-top: 0px;">
                                    </span>
                                    <img src="<?php echo e(asset('/public/assets/reports/logo-bg.jpg')); ?>" alt="" style="width: 130px;height: 140px;margin-top: -35px;">
                                </div>
                            </div>
                        </td>
                        <td style="width:5%;"></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <div class="header" >
        <?php

            use Carbon\Carbon;
            $dob = Carbon::parse($student->dob); 
            $formattedDob = $dob->format('d M Y'); // 05 Jul 2019
            $age = $dob->age;
                                                                            
            if (strtolower($student->gender) === 'male') {
                $gender = 'Boy';
            } else {
                $gender = 'Girl';
            }
        ?>
        
        <table class="student-details">
            <tr>
                <th>Name</th>
                <td><?php echo e($student->student_name); ?></td>
                <th>Class</th>
                <td><?php echo e($student->classname.'-'.$student->section); ?></td>
            </tr>
            <tr>
                <th>Roll No</th>
                <td><?php echo e($student->rollno); ?></td>
                <th>Registration Number</th>
                <td><?php echo e($student->student_uid); ?></td>
            </tr>
            <tr>
                <th>Date of Birth</th>
                <td><?php echo e($formattedDob); ?> (<?php echo e($age); ?> Years)</td>
                <th>Gender</th>
                <td><?php echo e($gender); ?></td>
            </tr>
            <tr>
                <th>Height (cm)</th>
                <td>-</td>
                <th>Weight (kg)</th>
                <td>-</td>
            </tr>
            <tr>
                <th>School Code</th>
                <td><?php echo e($school->school_code); ?></td>
                <th>School Name</th>
                <td><?php echo e($school->school_name); ?></td>
            </tr>
        </table>
    </div>

    <!-- <table cellspacing="0" cellpadding="0" style="border-collapse: collapse;">
        <td rowspan="2" style="position: relative; vertical-align: top; width: auto; height: 100%;">
            <img src="https://nep.localhost/public/assets/reports/inner-header2-bg.png" alt="" style="width: 450px; height:auto; position: relative; left:0px; top:0;">
        </td>
    </table> -->

    <div class="report-content">
        <table cellspacing="0" cellpadding="0" style="border-collapse: collapse; margin-bottom: 10px;">
            <tr>
                <td style="border-bottom: 3px solid #E60A00;">
                    <div style="background:#E60A00; float:left; display: inline-flex; align-items: center; color: #fff; font-size: 18px; font-weight: 600; height: 32px;">
                        <div style="float: left; padding: 1px 0px 0px 10px; margin-bottom: -3px;">P.E. Class Activities & Formative Assessment</div>
                        <div style="float:left; transform: skew(26deg,0deg); display:inline-block; width: 20px; height: 32px; background: #E60A00; position: relative; right: -10px;"></div>
                    </div>
                </td>
            </tr>
        </table>
        <?php if($getSkills->isEmpty()): ?>
            <h2 style="text-align:center; padding: 5px 10px; font-size: 20px; margin:0px; background-color: #fecd0a;font-size: 16px; font-weight: 600;">There is no skill report data</h2>
        <?php else: ?>
            <?php $__currentLoopData = $getSkills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skillName => $sports): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <h2 style="padding: 5px 10px; font-size: 20px; margin:0px; background:#0A87CD; color:#fff; font-size: 16px; font-weight: 600;"><?php echo e($skillName); ?></h2>

                <table class="report-table" style="margin-bottom: 30px;">
                    <tr style="background-color: #fecd0a;">
                        <th>Sport</th>
                        <th>Activity</th>
                        <th>Technique</th>
                        <th class="center" colspan="6">Rating</th>
                        <th>Observation</th>
                    </tr>

                    <?php $__currentLoopData = $sports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sportName => $activities): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <?php $rowCount = $activities->count(); ?>

                        <?php $__currentLoopData = $activities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>

                                <?php if($index == 0): ?>
                                    <td rowspan="<?php echo e($rowCount); ?>" style="font-weight:bold;">
                                        <?php echo e($sportName); ?>

                                    </td>
                                <?php endif; ?>

                                <td><?php echo e($activity->title); ?></td>

                                <td><?php echo $activity->techniques_name; ?></td>

                                <td colspan="6" class="stars">
                                    <?php for($i = 0; $i < $activity->rating; $i++): ?>
                                        <span class="star-filled">&#9733;</span>
                                    <?php endfor; ?>

                                    <?php for($i = 0; $i < 6 - $activity->rating; $i++): ?>
                                        <span class="star-empty">&#9734;</span>
                                    <?php endfor; ?>
                                </td>

                                <td>Lorem ipsum dolor sit amet.</td>

                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </table>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>

    </div>

    <!-- Signatures -->
    <div class="signatures">
        <div class="signature-block">
            <div class="signature-name">Rashmi Sharma</div>
            <div class="signature-title">Director</div>
            <div class="signature-org">Sequoia Fitness & Sports Technology</div>
        </div>

        <div class="signature-block">
            <div class="signature-name"><?php echo e($school->school_principal); ?></div>
            <div class="signature-title">Principal</div>
            <div class="signature-org"><?php echo e($school->school_name); ?></div>
        </div>
    </div>

</div>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\nep\resources\views/reports/skills/skill-reports.blade.php ENDPATH**/ ?>