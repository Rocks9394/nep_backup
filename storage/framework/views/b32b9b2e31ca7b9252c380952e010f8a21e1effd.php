<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Report</title>

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f0f4f9;
            color: #222;
            font-size: 10pt;
        }

        .container {
            width: 900px;
            margin: 30px auto;
            background: #fff;
            padding: 0;
            border: none;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            border-radius: 8px;
            user-select: none;
            cursor: default;
            overflow: hidden;
        }

        .header {
            padding: 20px 25px;
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
            margin: 0 !important;
            font-size: 11px;
            background: rgba(255,255,255,0.95);
        }

        .student-details th {
            background: #e8f0f8;
            text-align: left;
            padding: 8px 10px;
            width: 18%;
            border: 1px solid #d4dce6;
            font-weight: 700;
        }

        .student-details td {
            padding: 8px 10px;
            border: 1px solid #d4dce6;
            width: 32%;
            color: #334e68;
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
            text-align: left;
            border: 1px solid #333;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 180px;
        }

        .report-table th.center {
            text-align: center;
        }

        .report-table td {
            border: 1px solid #e0e0e0;
            padding: 6px;
            vertical-align: middle;
            white-space: normal;
        }

        .skill-area {
            font-weight: bold;
            background: #fafafa;
        }

        .stars {
            text-align: center;
            font-size: 12pt;
            min-width: 90px;
            align-items: center;
            white-space: nowrap;            
            overflow: hidden;
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
        }
    </style>
</head>

<body>
<div class="container">
    <div class="header">
        <div class="logo mb-3 w-100">
            <img src="<?php echo e(asset('public/assets/reports/seqfast-logo.png')); ?>"
                style="width:90px; float:left;">
            <div class="header-title">P.E. Class Activities & Teacher Observations</div>
            <img src="<?php echo e(asset('public/assets/uploads/logos/' . $school->logo)); ?>"
                style="width:90px; float:right;">
        </div>

        <!-- Student Details -->

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

    <div class="report-content">

    <!-- Report Table -->
    <table class="report-table">
        <tr>
            <th>Skill Area</th>
            <th>Activity</th>
            <th>Technique</th>
            <th>Learning Outcome</th>
            <th class="center" colspan="6">Rating</th>
            <th>Level</th>
        </tr>

        <?php $__currentLoopData = $getReport; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $spval): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td class="skill-area" rowspan="<?php echo e($spval->total); ?>">
                    <?php echo e($spval->sportsskillname); ?>

                </td>

                <?php $__currentLoopData = $getSkills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skval): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $__currentLoopData = $skval; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sskval): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($sskval->skill_sports_id != $spval->skill_sports_id) continue; ?>

                        <td><?php echo e($sskval->title); ?></td>
                        <td><?php echo $sskval->techniques_name; ?></td>
                        <td><?php echo $sskval->learning_outcomes; ?></td>
                        <td class="stars"  colspan="6">
                            <?php for($i=0; $i<$sskval->rating-1; $i++): ?>
                                <span class="star-filled">&#9733;</span>
                            <?php endfor; ?>

                            <?php for($i=0; $i<6-$sskval->rating; $i++): ?>
                                <span class="star-empty">&#9734;</span>
                            <?php endfor; ?>
                        </td>
                        <td><?php echo e($sskval->level_name); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </table>
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
<?php /**PATH C:\xampp\htdocs\nep\resources\views/reports/skill-reports.blade.php ENDPATH**/ ?>