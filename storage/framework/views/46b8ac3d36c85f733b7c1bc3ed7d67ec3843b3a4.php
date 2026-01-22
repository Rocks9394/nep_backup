<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <style>
        *,
        body {
            margin: 0;
            padding: 0;
        }

        body {
            font-family: "Roboto Condensed", sans-serif;
            font-optical-sizing: auto;
            background-color: #fff;
        }

        page[size="A4"] {
            width: 21cm;
            height: 29.7cm;
            margin: 0;
            padding: 0;
        }

        .act-tbl {
            width: 100%;
        }

        .act-tbl td {
            border-bottom: 1px solid #0A87CD;
        }

        .page-3 td {
            margin: 0;
            padding: 2px 4px;
            white-space: normal;
            white-space: normal;
            /* collapses leading spaces/newlines */
        }

        .cell {
            line-height: 12px;
        }

        .cell tr {
            border-bottom: 1px solid #e5e5e5;
        }
    </style>
</head>

<body>
    <!-- Cover Page -->
    <table cellpadding="0" cellspacing="0"
        style="width: 21cm; border-collapse: collapse; margin-left: auto; margin-right: auto; font-family: Roboto Condensed, sans-serif; font-size: 12px; border: 0px; background-color: #fff;">
        <tr>
            <td>
                <table cellpadding="0" cellspacing="0"
                    style="width: 100%; border-collapse: collapse; font-family: Roboto Condensed, sans-serif; font-size: 12px; border: 0;">

                    <tr>
                        <td style="border-collapse: collapse;">
                            <div style="position: relative; background-color: #fff;">
                                <div
                                    style="position: relative; background-color: #0A87CD;margin-top:0px; z-index:0; height:136px;">
                                    <img src="<?php echo e(public_path('assets/reports/green-dot.jpg')); ?>" alt=""
                                        style="width: 40px; height:40px; position: relative; left:150px; top:0;">
                                </div>

                                <div
                                    style="width: auto; position:absolute; top:-30px; left: 176px; z-index:10; padding:30px 15px 0 15px; display:flex;">
                                    <div
                                        style="background:#fff; padding:25px 15px 10px 15px; height:140px; float:left;">
                                        <img src="<?php echo e(public_path('assets/reports/seqfast-logo.png')); ?>" alt=""
                                            style="width: auto; height:100px;">
                                    </div>
                                    <p
                                        style="margin-left:30px; float:left; font-size:28px; padding:34px 20px 20px 0px; width:300px; font-weight:600; line-height:24px; color:#fff; text-transform:uppercase;">
                                        Physical Health and Fitness Assessment</p>
                                </div>

                                <img src="<?php echo e(public_path('assets/reports/report-graphic.png')); ?>" alt=""
                                    style="position: absolute; top:26%; right:40px; width: 200px; border-collapse: collapse; z-index:9;">

                                <img src="<?php echo e(public_path('assets/reports/report-cover-j-img.jpg')); ?>" alt=""
                                    style="width: 76%; z-index:2; position: relative; top:0;">
                            </div>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0;">
                                <tr>
                                    <td style="background-color:#E60A00;">
                                        <div style="position:relative;">
                                            <span
                                                style="position:absolute; top:-44px; background:rgb(0 0 0/50%); padding:10px; width:178px; z-indix:2; box-sizing: border-box; text-align:center; color:#fff; font-size:16px; text-transform: uppercase;">For
                                                Junior</span>
                                            <img src="<?php echo e(public_path('assets/reports/aa-bg.png')); ?>" alt=""
                                                style="width:198px;">
                                        </div>
                                    </td>
                                    <td style="vertical-align: top; width: 100%;">
                                        <table cellpadding="0" cellspacing="0" style="width: 90%; border: 0;">
                                            <tr>
                                                <td style="height:30px;"></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <?php if(!empty($studentsData->logo)): ?>
                                                        <img src="<?php echo e(public_path('assets/uploads/logos/' . $studentsData->logo)); ?>"
                                                            alt=""
                                                            style="padding: 0px 0px 5px 46px; height: 100px;">
                                                    <?php else: ?>
                                                        <img src="<?php echo e(public_path('assets/uploads/logos/default_school-logo.png')); ?>"
                                                            alt=""
                                                            style="padding: 0px 0px 5px 46px; height: 100px;">
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="height:30px;"></td>
                                            </tr>
                                            <tr>
                                                <td
                                                    style="padding: 1px 30px 5px 46px; font-size: 20px; background:#E60A00; color:#fff; font-size: 24px; font-weight: 500; position:relative;">
                                                    Student Profile<span
                                                        style=" position:absolute; top:44px; right:-21px;"><img
                                                            src="<?php echo e(public_path('assets/reports/green-bg.jpg')); ?>"
                                                            alt="" style="width:20px;"></span></td>
                                            </tr>
                                            <tr>
                                                <td style="height:10px;"></td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 10px 30px 10px 46px; font-size: 16px; color: #333;">
                                                    <table cellpadding="0" cellspacing="0"
                                                        style="width: 100%; border: 0px">
                                                        <tr>
                                                            <td colspan="2" style="padding: 6px 0;">
                                                                <table cellpadding="0" cellspacing="0"
                                                                    style="width: 100%; border: 0px">
                                                                    <tr>
                                                                        <td><span
                                                                                style="display: inline-block; margin-right: 3px 10px;">Name</span>
                                                                        </td>
                                                                        <td
                                                                            style="border-bottom: 1px solid #e5e5e5; width: 100%; text-align: center; font-weight: 600; font-size: 18px;">
                                                                            <?php echo e($studentsData->student_name); ?></td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2" style="padding: 6px 0;">
                                                                <table cellpadding="0" cellspacing="0"
                                                                    style="width: 100%; border: 0px;">
                                                                    <tr>
                                                                        <td><span
                                                                                style="display: inline-block; margin-right: 3px 10px;">Class&nbsp;&&nbsp;Section</span>
                                                                        </td>
                                                                        <td
                                                                            style="border-bottom: 1px solid #e5e5e5; width: 100%; text-align: center; font-weight: 600;">
                                                                            <?php echo e($studentsData->display_classname); ?>-<?php echo e($studentsData->section); ?>

                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </td>

                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 6px 0; width:55%;">
                                                                <table cellpadding="0" cellspacing="0"
                                                                    style="width: 100%; border: 0px">
                                                                    <tr>
                                                                        <td><span
                                                                                style="display: inline-block; margin-right: 10px; margin-left: 0px;">Roll&nbsp;No.</span>
                                                                        </td>
                                                                        <td
                                                                            style="border-bottom: 1px solid #e5e5e5; width: 100%; text-align: center; font-weight: 600;">
                                                                            <?php echo e($studentsData->rollno ?? ''); ?></td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                            <td style="padding: 6px 0;">
                                                                <table cellpadding="0" cellspacing="0"
                                                                    style="width: 100%; border: 0px">
                                                                    <tr>
                                                                        <td><span
                                                                                style="display: inline-block; margin-right: 3px 10px;">&nbsp;Registration&nbsp;No</span>
                                                                        </td>
                                                                        <td
                                                                            style="border-bottom: 1px solid #e5e5e5; width: 100%; text-align: center; font-weight: 600;">
                                                                            <?php echo e($studentsData->admissionnumber); ?></td>
                                                                    </tr>
                                                                </table>
                                                            </td>

                                                        </tr>

                                                        <tr>
                                                            <td style="padding: 6px 0;">
                                                                <table cellpadding="0" cellspacing="0"
                                                                    style="width: 100%; border: 0px">
                                                                    <tr>
                                                                        <?php
                                                                            use Carbon\Carbon;

                                                                            $dob = Carbon::parse($studentsData->dob);
                                                                            $formattedDob = $dob->format('d M Y'); // 05 Jul 2019
                                                                            $age = $dob->age; // will calculate age automatically

                                                                            if (
                                                                                strtolower($studentsData->gender) ===
                                                                                'male'
                                                                            ) {
                                                                                $gender = 'Boy';
                                                                            } else {
                                                                                $gender = 'Girl';
                                                                            }
                                                                        ?>
                                                                        <td><span
                                                                                style="display: inline-block; margin-right: 3px 10px;">DOB</span>
                                                                        </td>
                                                                        <td
                                                                            style="border-bottom: 1px solid #e5e5e5; width: 100%; text-align: center; font-weight: 600;">
                                                                            <?php echo e($formattedDob); ?> (<?php echo e($age); ?>

                                                                            Years)</td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                            <td style="padding: 6px 0;">
                                                                <table cellpadding="0" cellspacing="0"
                                                                    style="width: 100%; border: 0px">
                                                                    <tr>
                                                                        <td><span
                                                                                style="display: inline-block; margin-right: 3px 10px; margin-left: 3px 10px;">Gender</span>
                                                                        </td>
                                                                        <td
                                                                            style="border-bottom: 1px solid #e5e5e5; width: 100%; text-align: center; font-weight: 600;">
                                                                            <?php echo e($gender); ?></td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td style="height:20px;"></td>
                                                        </tr>

                                                        <tr>
                                                            <td colspan="2" style="padding: 6px 0;">
                                                                <table cellpadding="0" cellspacing="0"
                                                                    style="width: 100%; border: 0px">
                                                                    <tr>
                                                                        <td><span
                                                                                style="display: inline-block; margin-right: 3px 10px;">School</span>
                                                                        </td>
                                                                        <td
                                                                            style="border-bottom: 1px solid #e5e5e5; width: 100%; text-align: center; font-weight: 600;">
                                                                            <?php echo e($studentsData->school_name); ?></td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 6px 0;">
                                                                <table cellpadding="0" cellspacing="0"
                                                                    style="width: 100%; border: 0px">
                                                                    <tr>
                                                                        <td><span
                                                                                style="display: inline-block; margin-right: 3px 10px;">Code</span>
                                                                        </td>
                                                                        <td
                                                                            style="border-bottom: 1px solid #e5e5e5; width: 100%; text-align: center; font-weight: 600;">
                                                                            <?php echo e($studentsData->school_code); ?></td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                            <td style="padding: 6px 0;">
                                                                <table cellpadding="0" cellspacing="0"
                                                                    style="width: 100%; border: 0px">
                                                                    <tr>
                                                                        <td style="padding: 0px 0px 2px 0px;">
                                                                            &nbsp;APAAR&nbsp;ID&nbsp;(Optional)</td>
                                                                        <td
                                                                            style="border-bottom: 1px solid #e5e5e5; width: 100%; text-align: center; font-weight: 600;">
                                                                            <?php echo e($studentsData->apaarId ?? ''); ?></td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>

                                                    </table>
                                                </td>
                                            </tr>

                                            <!-- <tr>
                                                <td style="height:30px;"></td>
                                            </tr>
                                            <tr>
                                                <td style="text-align:right; padding: 0px 0px 0px 46px; ">
                                                    <div style="float:right; text-align:center;">
                                                    <p style="margin-bottom:0px; color:#666; font-size:10px;">powered by</p>
                                                    <img src="<?php echo e(public_path('assets/reports/fitness365-logo-web.png')); ?>" alt="fitness365 logo" style="height:28px;">
                                                    </div>
                                                </td>
                                            </tr> -->
                                        </table>
                                    </td>

                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>


    <!-- Page 2 -->

    <table table border="0" cellpadding="0" cellspacing="0" style="width:100%; page-break-before: always;">
        <tr>
            <td>
                <!-- Inner page Header Area (Page 2) -->
                <table border="0" cellpadding="0" cellspacing="0"
                    style=" width: 100%; border-collapse: collapse; font-family: Roboto Condensed, sans-serif; font-size: 12px; border:0px solid transparent;">
                    <tr>
                        <td style="vertical-align: top; height: 100px;">
                            <table cellpadding="0" cellspacing="0" style="width: 100%; border:0;">
                                <tr>
                                    <td rowspan="2"
                                        style="position: relative; vertical-align: top; width: auto; text-align: left;">
                                        <div
                                            style="position: absolute; top: 30px; left:30px; display: flex; align-items: center; z-index: 1; width: 90px; overflow: hidden;">
                                            <img src="<?php echo e(public_path('assets/reports/seqfast-logo.png')); ?>"
                                                alt="" style="width: inherit;">
                                        </div>
                                        <img src="<?php echo e(public_path('assets/reports/inner-header2-bg.png')); ?>"
                                            alt=""
                                            style="width: 450px; height:auto; position: relative; left:0px; top:0;">
                                    </td>
                                    <td style="width:300px;">
                                        <?php if(!empty($studentsData->logo)): ?>
                                            <div
                                                style="position: absolute; top: 30px; right:30px; display: flex; align-items: center; z-index: 1; width: 90px; overflow: hidden;">
                                                <img src="<?php echo e(public_path('assets/uploads/logos/' . $studentsData->logo)); ?>"
                                                    alt=""
                                                    style="width: auto; height: 50px; object-fit: contain;">
                                            </div>
                                        <?php else: ?>
                                            <div
                                                style="position: absolute; top: 30px; right:30px; display: flex; align-items: center; z-index: 1; width: 90px; overflow: hidden;">
                                                <img src="<?php echo e(public_path('assets/uploads/logos/default_school-logo.png')); ?>"
                                                    alt=""
                                                    style="width: auto; height: 50px; object-fit: contain;">
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <!-- Inner page Content (Page 2) -->
                <table border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td>
                            <table border="0" cellpadding="0" cellspacing="0"
                                style="width: 94%; border: 0; border-collapse: collapse; margin: auto;">
                                <tr>
                                    <td style="border-bottom: 3px solid #E60A00;">
                                        <div
                                            style="align-items: center; color: #fff; font-size: 18px; font-weight: 600; overflow:hidden; height: 32px;">
                                            <div
                                                style="float:left; padding: 1px 0px 3px 10px; background: #E60A00; margin-bottom: 0px;">
                                                Physical Fitness Assessment for Age 5-8 (Class 1-3)</div>
                                            <div style="text-align:right; float:left;"><img
                                                    src="<?php echo e(public_path('assets/reports/heading-band-corder.jpg')); ?>"
                                                    alt="" style="width: 39px; position:relative; top:0px;">
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                                <tr>
                                    <td style="height: 5px;"></td>
                                </tr>

                                <?php $__currentLoopData = $orderedReportData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php

                                        $displayKey = str_contains($key, 'Body Composition')
                                            ? str_replace('Body Composition (BMI)', 'BMI (Body Mass Index)', $key)
                                            : $key;
                                    ?>
                                    <tr>
                                        <td style="height: 10px;"></td>
                                    </tr>

                                    <tr>
                                        <td
                                            style="padding: 6px 10px 6px 0px; color:#000; font-size: 16px; font-weight: 600;">
                                            <?php echo e($displayKey); ?></td>
                                    </tr>

                                    <?php if($key === 'Body Composition (BMI)'): ?>
                                        <tr>
                                            <td>
                                                <table cellpadding="0" cellspacing="0"
                                                    style="width: 100%; border: 0; border-collapse: collapse;">
                                                    <tr>
                                                        <td style="vertical-align: top;">
                                                            <table border="0" cellpadding="0" cellspacing="0"
                                                                style="width: 100%;">
                                                                <tr style="font-size: 13px; line-height: 1.25rem;">
                                                                    <td
                                                                        style="border-top: 1px solid #0A87CD; border-left: 1px solid #0A87CD; border-right: 1px solid #0A87CD; border-bottom: 0px solid transparent; border-collapse: collapse; padding:5px 15px; vertical-align: middle;">
                                                                        <ul style="margin-left: 15px;">
                                                                            <li>Height recorded in cm and mm</li>
                                                                            <li>Weight will be recorded in kilogram (kg)
                                                                                and grams(gms)</li>
                                                                        </ul>
                                                                    </td>
                                                                    <td
                                                                        style="border-top: 1px solid #0A87CD; border-right: 1px solid #0A87CD; border-bottom: 0px solid transparent; border-collapse: collapse; padding:5px 15px; vertical-align: top; padding-bottom:10px;">
                                                                        <table border="0" cellpadding="0"
                                                                            cellspacing="0">
                                                                            <tr>
                                                                                <td>Body Mass Index =</td>
                                                                                <td style="padding:0 10px;">
                                                                                    <p
                                                                                        style="border-bottom: 1px solid #c5c5c5; padding-bottom: 2px; margin:0;">
                                                                                        Weight (in kg)</p>
                                                                                    <p
                                                                                        style="padding-top: 0px; margin:0;">
                                                                                        Height (in m)2</p>
                                                                                </td>
                                                                            </tr>
                                                                        </table>

                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="width: 50%;">
                                                                        <table border="1" cellpadding="0"
                                                                            cellspacing="0"
                                                                            style="width: 100%; border: 1px solid orange; font-size: 13px; border-collapse: collapse; color:#333;">
                                                                            <tr style="background-color: #fecd0a;">
                                                                                <td style="width: 20%; background-color:#0A87CD; padding: 0px 4px 2px 6px; border: 1px solid #0A87CD; color:#fff; text-align: center; font-weight: bold;"
                                                                                    rowspan="2">Current Term</td>
                                                                                <td
                                                                                    style="width: 25%; padding: 0px 4px 2px 6px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">
                                                                                    Date</td>
                                                                                <td
                                                                                    style="width: 28%; padding: 0px 4px 2px 6px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">
                                                                                    Weight</td>
                                                                                <td
                                                                                    style="width: 28%; padding: 0px 4px 2px 6px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">
                                                                                    Height</td>
                                                                                <td
                                                                                    style="width: 28%; padding: 0px 4px 2px 6px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">
                                                                                    BMI</td>
                                                                                <td
                                                                                    style="padding: 0px 4px 2px 6px; border: 1px solid orange; color:#000; font-weight: bold; text-align: center;">
                                                                                    Level</td>
                                                                            </tr>

                                                                            <tr>
                                                                                <td
                                                                                    style="padding: 0px 4px 2px 6px; font-weight: 500; color:#000; text-align: center;">
                                                                                    <?php echo e($value[0]['created_at'] ?? '---'); ?>

                                                                                </td>
                                                                                <td
                                                                                    style="padding: 0px 4px 2px 6px; text-align: center; border: 1px solid orange;">
                                                                                    <?php if(!empty($value[0]['weight'])): ?>
                                                                                        <?php echo e($value[0]['weight']); ?> kg
                                                                                    <?php else: ?>
                                                                                        ---
                                                                                    <?php endif; ?>
                                                                                </td>
                                                                                <td
                                                                                    style="padding: 0px 4px 2px 6px; text-align: center; border: 1px solid orange;">
                                                                                    <?php if(!empty($value[0]['height'])): ?>
                                                                                        <?php echo e($value[0]['height']); ?> cm
                                                                                    <?php else: ?>
                                                                                        ---
                                                                                    <?php endif; ?>
                                                                                </td>
                                                                                <td
                                                                                    style="padding: 0px 4px 2px 6px; text-align: center; border: 1px solid orange;">
                                                                                    <?php echo e($value[0]['score'] ?? '---'); ?>

                                                                                </td>
                                                                                <td
                                                                                    style="padding: 0px 4px 2px 6px; text-align: center; border: 1px solid orange;">
                                                                                    <?php echo e($value[0]['Level'] ?? '---'); ?>

                                                                                </td>

                                                                            </tr>

                                                                        </table>
                                                                    </td>
                                                                    <td style="width: 50%;">
                                                                        <table border="1" cellpadding="0"
                                                                            cellspacing="0"
                                                                            style="width: 100%; border: 1px solid orange; font-size: 13px; border-collapse: collapse; color:#333;">
                                                                            <tr style="background-color: #fecd0a;">
                                                                                <td style="width: 20%; background-color:#0A87CD; padding: 0px 4px 2px 6px; border: 1px solid #0A87CD; color:#fff; text-align: center; font-weight: bold;"
                                                                                    rowspan="2">Previous Term</td>
                                                                                <td
                                                                                    style="width: 25%; padding: 0px 4px 2px 6px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">
                                                                                    Date</td>
                                                                                <td
                                                                                    style="width: 28%; padding: 0px 4px 2px 6px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">
                                                                                    Weight</td>
                                                                                <td
                                                                                    style="width: 28%; padding: 0px 4px 2px 6px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">
                                                                                    Height</td>
                                                                                <td
                                                                                    style="width: 28%; padding: 0px 4px 2px 6px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">
                                                                                    BMI</td>
                                                                                <td
                                                                                    style="padding: 0px 4px 2px 6px; border: 1px solid orange; color:#000; font-weight: bold; text-align: center;">
                                                                                    Level</td>
                                                                            </tr>

                                                                            <tr>
                                                                                <td
                                                                                    style="padding: 0px 4px 2px 6px; font-weight: 500; color:#000; text-align: center;">
                                                                                    ---</td>
                                                                                <td
                                                                                    style="padding: 0px 4px 2px 6px; text-align: center; border: 1px solid orange;">
                                                                                    ---</td>
                                                                                <td
                                                                                    style="padding: 0px 4px 2px 6px; text-align: center; border: 1px solid orange;">
                                                                                    ---</td>
                                                                                <td
                                                                                    style="padding: 0px 4px 2px 6px; text-align: center; border: 1px solid orange;">
                                                                                    ---</td>
                                                                                <td
                                                                                    style="padding: 0px 4px 2px 6px; text-align: center; border: 1px solid orange;">
                                                                                    ---</td>

                                                                            </tr>

                                                                        </table>
                                                                    </td>
                                                                </tr>

                                                            </table>

                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <table border="1" cellpadding="0" cellspacing="0"
                                                                style="width: 100%; border-top: 1px solid transparent; border-left: 1px solid #00A923; border-right: 1px solid #00A923; border-bottom: 1px solid #00A923; font-size: 13px; border-collapse: collapse; color:#333;">
                                                                <tr>
                                                                    <td
                                                                        style="border-top: 1px solid #00A923; background-color: #00A923; padding: 0px 4px 2px 4px; padding: 0px 10px 3px 10px; color: #fff; text-align: center; width: 100px; font-weight: bold;">
                                                                        Recommendation</td>
                                                                    <td
                                                                        style="padding:0px 4px 2px 8px; font-size:13px;">
                                                                        <?php echo e($value[0]['recommendation'] ?? '---'); ?></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>

                                                </table>
                                            </td>
                                        </tr>
                                    <?php else: ?>
                                        <tr>
                                            <td>
                                                <table cellpadding="0" cellspacing="0"
                                                    style="width: 100%; border: 0; border-collapse: collapse;">
                                                    <tr>
                                                        <td style="vertical-align: top;">
                                                            <table border="0" cellpadding="0" cellspacing="0"
                                                                style="width: 100%;">
                                                                <tr>
                                                                    <td style="width: 50%;">
                                                                        <table border="1" cellpadding="0"
                                                                            cellspacing="0"
                                                                            style="width: 100%; border: 1px solid orange; font-size: 13px; border-collapse: collapse; color:#333;">
                                                                            <tr style="background-color: #fecd0a;">
                                                                                <td style="width: 20%; background-color:#0A87CD; padding: 0px 4px 2px 6px; border: 1px solid #0A87CD; color:#fff; text-align: center; font-weight: bold;"
                                                                                    rowspan="2">Current Term</td>
                                                                                <td
                                                                                    style="width: 25%; padding: 0px 4px 2px 6px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">
                                                                                    Date</td>
                                                                                <td
                                                                                    style="width: 28%; padding: 0px 4px 2px 6px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">
                                                                                    Score</td>
                                                                                <td
                                                                                    style="padding: 0px 4px 2px 6px; border: 1px solid orange; color:#000; font-weight: bold; text-align: center;">
                                                                                    Level</td>
                                                                            </tr>

                                                                            <tr>
                                                                                <td
                                                                                    style="padding: 0px 4px 2px 6px; font-weight: 500; color:#000; text-align: center; border: 1px solid orange; border-bottom: 1px solid #00A923;">
                                                                                    <?php echo e($value[0]['created_at'] ?? '---'); ?>

                                                                                </td>
                                                                                <td
                                                                                    style="padding: 0px 4px 2px 6px; text-align: center; border: 1px solid orange; border-bottom: 1px solid #00A923;">
                                                                                    <?php echo e($value[0]['score'] ?? '---'); ?>

                                                                                </td>
                                                                                <td
                                                                                    style="padding: 0px 4px 2px 6px; text-align: center; border: 1px solid orange; border-bottom: 1px solid #00A923;">
                                                                                    <?php echo e($value[0]['Level'] ?? '---'); ?>

                                                                                </td>

                                                                            </tr>

                                                                        </table>
                                                                    </td>
                                                                    <td style="width: 50%;">
                                                                        <table border="1" cellpadding="0"
                                                                            cellspacing="0"
                                                                            style="width: 100%; border: 1px solid orange; font-size: 13px; border-collapse: collapse; color:#333;">
                                                                            <tr style="background-color: #fecd0a;">
                                                                                <td style="font-weight: 500; width: 20%; background-color:#0A87CD; padding: 0px 4px 2px 6px; border: 1px solid #0A87CD; color:#fff; text-align: center;"
                                                                                    rowspan="2">Previous Term</td>
                                                                                <td
                                                                                    style="font-weight: 500; width: 25%; padding: 0px 4px 2px 6px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">
                                                                                    Date</td>
                                                                                <td
                                                                                    style="font-weight: 500; width: 28%; padding: 0px 4px 2px 6px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">
                                                                                    Score</td>
                                                                                <td
                                                                                    style="font-weight: 500; padding: 0px 4px 2px 6px; border: 1px solid orange; color:#000; font-weight: bold; text-align: center;">
                                                                                    Level</td>
                                                                            </tr>

                                                                            <tr>
                                                                                <td
                                                                                    style="padding: 0px 4px 2px 6px; font-weight: 500; color:#000; text-align: center; border: 1px solid orange; border-bottom: 1px solid #00A923;">
                                                                                    ---</td>
                                                                                <td
                                                                                    style="padding: 0px 4px 2px 6px; text-align: center; border: 1px solid orange; border-bottom: 1px solid #00A923;">
                                                                                    ---</td>
                                                                                <td
                                                                                    style="padding: 0px 4px 2px 6px; text-align: center; border: 1px solid orange; border-bottom: 1px solid #00A923;">
                                                                                    ---</td>

                                                                            </tr>

                                                                        </table>
                                                                    </td>
                                                                </tr>

                                                            </table>

                                                        </td>

                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <table border="1" cellpadding="0" cellspacing="0"
                                                                style="width: 100%; border-top: 1px solid transparent; border-left: 1px solid #00A923; border-right: 1px solid #00A923; border-bottom: 1px solid #00A923; font-size: 13px; border-collapse: collapse; color:#333;">
                                                                <tr>
                                                                    <td
                                                                        style="border-top: 1px solid #00A923; background-color: #00A923; padding: 0px 4px 2px 4px; padding: 0px 10px 3px 10px; color: #fff; text-align: center; width: 100px; font-weight: bold;">
                                                                        Recommendation</td>
                                                                    <td
                                                                        style="padding:0px 4px 2px 8px; line-height:14px; font-size:13px;">
                                                                        <?php echo e($value[0]['recommendation'] ?? '---'); ?></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>

                                        </tr>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                <tr>
                                    <td style="height: 15px;"></td>
                                </tr>
                                <tr>
                                    <td>
                                        <table border="1" cellpadding="0" cellspacing="0"
                                            style="width: 100%; border: 1px solid #0A87CD; font-size: 12px; border-collapse: collapse; color:#000;">
                                            <tr style="background-color: #0A87CD;">
                                                <td style="padding: 5px 10px; font-weight: bold; color:#fff; font-size: 14px;"
                                                    colspan="8">Fitness Benchmarks for <?php echo e($age); ?> years
                                                    <?php echo e($gender); ?></td>
                                            </tr>
                                            <tr
                                                style="font-weight: bold; background-color: #fecd0a; font-size: 12px; color: #000;">
                                                <td style="padding: 4px;"></td>
                                                <td style="padding: 4px; border:1px solid #0A87CD;">L1 (Very Low)</td>
                                                <td style="padding: 4px; border:1px solid #0A87CD;">L2 (Low)</td>
                                                <td style="padding: 4px; border:1px solid #0A87CD;">L3 (Developing)
                                                </td>
                                                <td style="padding: 4px; border:1px solid #0A87CD;">L4 (Moderate)</td>
                                                <td style="padding: 4px; border:1px solid #0A87CD;">L5 (Good)</td>
                                                <td style="padding: 4px; border:1px solid #0A87CD;">L6 (High)</td>
                                                <td style="padding: 4px; border:1px solid #0A87CD;">L7 (Excellent)</td>
                                            </tr>
                                            <tr style="background-color: #fff6d1; font-weight: 500; color:#333;">
                                                <td style="padding: 4px; border:1px solid #0A87CD;"></td>
                                                <td style="padding: 4px; border:1px solid #0A87CD;">
                                                    < 20 %ile</td>
                                                <td style="padding: 4px; border:1px solid #0A87CD;">≥ 20 %ile</td>
                                                <td style="padding: 4px; border:1px solid #0A87CD;">≥ 40 %ile</td>
                                                <td style="padding: 4px; border:1px solid #0A87CD;">≥ 60 %ile</td>
                                                <td style="padding: 4px; border:1px solid #0A87CD;">≥ 70 %ile</td>
                                                <td style="padding: 4px; border:1px solid #0A87CD;">≥ 80 %ile</td>
                                                <td style="padding: 4px; border:1px solid #0A87CD;">≥ 90 %ile</td>
                                            </tr>
                                            <?php $__empty_1 = true; $__currentLoopData = $getFitnessBenchmark; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $skillname): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                <tr>
                                                    <td
                                                        style="padding: 2px; font-weight: bold; color: #000; border:1px solid #0A87CD;">
                                                        <?php echo e($skillname->skill_name); ?>

                                                    </td>

                                                    <?php $__currentLoopData = $skillname->ranges; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $level => $range): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <td style="padding: 2px; border:1px solid #0A87CD;">
                                                            <?php echo e($range); ?>

                                                        </td>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                <tr>
                                                    <td colspan="8"
                                                        style="padding: 4px; border:1px solid #0A87CD;">
                                                        <p style="text-align:center;">
                                                            <span style="font-weight:bold;">Note :</span>
                                                            No Fitness Benchmarks available for a
                                                            <?php echo e($age); ?>-year-old <?php echo e($gender); ?> in
                                                            <?php echo e($studentsData->class); ?>

                                                        </p>
                                                    </td>
                                                </tr>
                                            <?php endif; ?>

                                        </table>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="height: 15px;"></td>
                                </tr>
                                <tr>
                                    <td>
                                        <table cellpadding="0" cellspacing="0"
                                            style="width:100%; border-collapse:collapse; font-size:12px; color:#333;">
                                            <tbody>
                                                <tr style="background-color:#0A87CD;">
                                                    <td colspan="4"
                                                        style="padding:5px 10px; font-weight:bold; color:#fff; font-size:14px; border:1px solid #0A87CD;">
                                                        BMI Benchmarks for <?php echo e($age); ?> years
                                                        <?php echo e($gender); ?>

                                                    </td>
                                                </tr>
                                                <tr
                                                    style="font-weight:bold; background-color:#fecd0a; font-size:12px; color:#000; text-align:center;">
                                                    <th style="padding:4px; border:1px solid #0A87CD;">UW</th>
                                                    <th style="padding:4px; border:1px solid #0A87CD;">N</th>
                                                    <th style="padding:4px; border:1px solid #0A87CD;">OW</th>
                                                    <th style="padding:4px; border:1px solid #0A87CD;">OB</th>
                                                </tr>

                                                <!-- Values -->
                                                <tr style="text-align:center;">
                                                    <?php if(is_array($getBmiBenchmark) && count($getBmiBenchmark) > 0): ?>
                                                        <td style="padding:5px 10px; border:1px solid #0A87CD;">
                                                            <?php echo e($getBmiBenchmark['UW'] ?? 'N/A'); ?></td>
                                                        <td style="padding:5px 10px; border:1px solid #0A87CD;">
                                                            <?php echo e($getBmiBenchmark['N'] ?? 'N/A'); ?></td>
                                                        <td style="padding:5px 10px; border:1px solid #0A87CD;">
                                                            <?php echo e($getBmiBenchmark['OW'] ?? 'N/A'); ?></td>
                                                        <td style="padding:5px 10px; border:1px solid #0A87CD;">
                                                            <?php echo e($getBmiBenchmark['OB'] ?? 'N/A'); ?></td>
                                                    <?php endif; ?>
                                                </tr>

                                            </tbody>
                                        </table>

                                    </td>
                                </tr>

                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="height: 8px;"></td>
        </tr>
        <!-- Inner page Footer Area (Page 2) -->
        <tr>
            <td>
                <table cellpadding="0" cellspacing="0" style="width:100%;">
                    <tr>
                        <td style="width: 100%; text-align: right;">
                            <table cellpadding="0" cellspacing="0" style="border: 0px; width: 100%;">
                                <tr>
                                    <td style="height: 40px;"></td>
                                </tr>
                                <tr>
                                    <td style="text-align:left; padding: 0px 0px 0px 30px;">
                                        <div style="float:left; text-align:center; position:relative;">
                                            <p
                                                style="color:#666; font-size:10px; position:absolute; top:-14px; width:100%; text-align:center;">
                                                powered by</p>
                                            <img src="<?php echo e(public_path('assets/reports/fitness365-logo-web.png')); ?>"
                                                alt="fitness365 logo" style="height:32px;">
                                        </div>
                                    </td>
                                    <td>
                                        <div
                                            style="padding: 6px 0; text-align: right; font-weight: 400; font-size: 13px; color:#666;">
                                            <span style="margin-left: 60px;">Physical Health and Fitness
                                                Assessment</span></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="height: 10px;"></td>
                                </tr>
                            </table>
                        </td>
                        <td style="width: 94px;">
                            <div style="float: right; position: relative; width: 80px;">
                                <!-- <span style="position: absolute; right: 50%; top:50%; transform: translate(-50%, 0); color: #000; z-index: 5; display: inline-block; padding: 6px 0 0 20px; font-size: 13px; font-weight: 600;">3</span> -->
                                <img src="<?php echo e(public_path('assets/reports/footer-bg2.png')); ?>" alt=""
                                    style="width: inherit;">
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <!-- Page 3 -->

    <table border="0" cellpadding="0" cellspacing="0" style="page-break-before: always; width: 100%;">
        <tr>
            <td>
                <!-- Inner page Header Area (Page 3) -->
                <table border="1" cellpadding="0" cellspacing="0"
                    style="width: 100%; border-collapse: collapse; font-family: Roboto Condensed, sans-serif; font-size: 12px; border:0px solid transparent;">
                    <tr>
                        <td style="vertical-align: top; height: 100px;">
                            <table cellpadding="0" cellspacing="0" style="width: 100%; border:0;">
                                <tr>
                                    <td style="width:300px;">
                                        <?php if(!empty($studentsData->logo)): ?>
                                            <div
                                                style="position: absolute; top: 30px; left:22px; display: flex; align-items: center; z-index: 1;">
                                                <img src="<?php echo e(public_path('assets/uploads/logos/' . $studentsData->logo)); ?>"
                                                    alt=""
                                                    style="width: auto; height: 50px; object-fit: contain;">
                                            </div>
                                        <?php else: ?>
                                            <div
                                                style="position: absolute; top: 30px; left:22px; display: flex; align-items: center; z-index: 1;">
                                                <img src="<?php echo e(public_path('assets/uploads/logos/default_school-logo.png')); ?>"
                                                    alt=""
                                                    style="width: auto; height: 50px; object-fit: contain;">
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <td rowspan="2"
                                        style="position: relative; vertical-align: top; width: auto; text-align: right;">
                                        <div
                                            style="position: absolute; top: 30px; right:30px; display: flex; align-items: center; z-index: 1; width: 90px; overflow: hidden;">
                                            <img src="<?php echo e(public_path('assets/reports/seqfast-logo.png')); ?>"
                                                alt="" style="width: inherit;">
                                        </div>
                                        <img src="<?php echo e(public_path('assets/reports/inner-header-bg.png')); ?>"
                                            alt=""
                                            style="width: 450px; height:auto; position: relative; right:0px; top:0;">
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <!-- Inner page Content (Page 3) -->
        <tr>
            <td>
                <table border="0" cellpadding="0" cellspacing="0"
                    style="width: 94%; border: 0; border-collapse: collapse; margin: auto;">
                    <tr>
                        <td style="border-bottom: 3px solid #E60A00;">
                            <div
                                style="align-items: center; color: #fff; font-size: 18px; font-weight: 600; overflow:hidden; height: 32px;">
                                <div
                                    style="float:left; padding: 1px 0px 3px 10px; background: #E60A00; margin-bottom: 0px;">
                                    Developmental Skills for Age 5-8 (Class 1-3)</div>
                                <div style="text-align:right; float:left;"><img
                                        src="<?php echo e(public_path('assets/reports/heading-band-corder.jpg')); ?>"
                                        alt="" style="width: 39px; position:relative; top:0px;"></div>
                            </div>

                        </td>
                    </tr>
                    <tr>
                        <td style="height: 10px;"></td>
                    </tr>
                    <tr>
                        <td
                            style="padding: 1px 10px 3px 10px; background:#0A87CD; color:#fff; font-size: 16px; font-weight: 600;">
                            Locomotive Skills</td>
                    </tr>
                    <tr>
                        <td>
                            <table border="0" cellpadding="0" cellspacing="0"
                                style="width: 100%; border: 0; border-collapse: collapse;">
                                <tr>
                                    <td style="vertical-align: top;">
                                        <table border="0" cellpadding="0" cellspacing="0"
                                            style="width: 100%; border: 1px solid orange; font-size: 13px; border-collapse: collapse; color:#333;">
                                            <tr style="background-color: #fecd0a;">
                                                <td style="font-weight: 500; width: 30%; background-color:#fecd0a; padding: 1px 4px 2px 6px; border: 1px solid orange; color:#000; border: 1px solid orange;"
                                                    rowspan="2">Skills</td>
                                                <td
                                                    style="font-weight: 500; width: 12%; padding: 1px 4px 2px 6px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold; border: 1px solid orange;">
                                                    Current Term</td>
                                                <td
                                                    style="font-weight: 500; width: 14%; padding: 1px 4px 2px 6px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold; border: 1px solid orange;">
                                                    Previous Term</td>
                                                <td style="font-weight: 500; padding: 1px 4px 2px 6px; border: 1px solid orange; color:#000; border: 1px solid orange;"
                                                    rowspan="2">Recommendation</td>
                                            </tr>
                                            <tr>
                                                <td
                                                    style="font-weight: 500; background-color:#ffe167; padding: 1px 4px 2px 6px; border: 1px solid orange; color:#000; text-align: center; border: 1px solid orange;">
                                                    Outcome</td>
                                                <td
                                                    style="font-weight: 500; background-color: #ffe167; padding: 1px 4px 2px 6px; border: 1px solid orange; color:#000; text-align: center; border: 1px solid orange;">
                                                    Outcome</td>
                                            </tr>
                                            <tr>
                                                <td
                                                    style="padding: 1px 4px 2px 6px; font-weight: 500; color:#000; border: 1px solid orange;">
                                                    Running</td>
                                                <td
                                                    style="padding: 1px 4px 2px 6px; text-align: center; border: 1px solid orange;">
                                                    Accomplished</td>
                                                <td style="padding: 1px 4px 2px 6px; border: 1px solid orange;"></td>
                                                <td
                                                    style="padding: 1px 4px 2px 6px; font-size: 12px; border: 1px solid orange;">
                                                    Maintain form and endurance through sport-specific sprinting drills.
                                                </td>
                                            </tr>
                                            <tr>
                                                <td
                                                    style="padding: 1px 4px 2px 6px; font-weight: 500; color:#000; border: 1px solid orange;">
                                                    Hopping</td>
                                                <td
                                                    style="padding: 1px 4px 2px 6px; text-align: center; border: 1px solid orange;">
                                                    Developing</td>
                                                <td style="padding: 1px 4px 2px 6px; border: 1px solid orange;"></td>
                                                <td
                                                    style="padding: 1px 4px 2px 6px; font-size: 12px; border: 1px solid orange;">
                                                    Hop over lines or cones and play hopscotch to improve balance.</td>
                                            </tr>
                                            <tr>
                                                <td
                                                    style="padding: 1px 4px 2px 6px; font-weight: 500; color:#000; border: 1px solid orange;">
                                                    Skipping</td>
                                                <td
                                                    style="padding: 1px 4px 2px 6px; text-align: center; border: 1px solid orange;">
                                                    Emerging</td>
                                                <td style="padding: 1px 4px 2px 6px; border: 1px solid orange;"></td>
                                                <td
                                                    style="padding: 1px 4px 2px 6px; font-size: 12px; border: 1px solid orange;">
                                                    Learn the step-hop pattern slowly with music or rhythm claps.</td>
                                            </tr>
                                            <tr>
                                                <td
                                                    style="padding: 1px 4px 2px 6px; font-weight: 500; color:#000; border: 1px solid orange;">
                                                    Dodging</td>
                                                <td
                                                    style="padding: 1px 4px 2px 6px; text-align: center; border: 1px solid orange;">
                                                    Developing</td>
                                                <td style="padding: 1px 4px 2px 6px; border: 1px solid orange;"></td>
                                                <td
                                                    style="padding: 1px 4px 2px 6px; font-size: 12px; border: 1px solid orange;">
                                                    Maintain form and endurance through sport-specific sprinting drills.
                                                </td>
                                            </tr>
                                            <tr>
                                                <td
                                                    style="padding: 1px 4px 2px 6px; font-weight: 500; color:#000; border: 1px solid orange;">
                                                    Jumping & Landing</td>
                                                <td
                                                    style="padding: 1px 4px 2px 6px; text-align: center; border: 1px solid orange;">
                                                    Developing</td>
                                                <td style="padding: 1px 4px 2px 6px; border: 1px solid orange;"></td>
                                                <td
                                                    style="padding: 1px 4px 2px 6px; font-size: 12px; border: 1px solid orange;">
                                                    Jump over low hurdles or lines and land with bent knees.</td>
                                            </tr>

                                        </table>
                                    </td>
                                </tr>

                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="height: 10px;"></td>
                    </tr>
                    <tr>
                        <td
                            style="padding: 1px 10px 3px 10px; background:#0A87CD; color:#fff; font-size: 16px; font-weight: 600;">
                            Object Control Skills</td>
                    </tr>
                    <tr>
                        <td>
                            <table border="0" cellpadding="0" cellspacing="0"
                                style="width: 100%; border: 0; border-collapse: collapse;">
                                <tr>
                                    <td style="vertical-align: top;">
                                        <table border="1" cellpadding="0" cellspacing="0"
                                            style="width: 100%; border: 1px solid orange; font-size: 13px; border-collapse: collapse; color:#333;">
                                            <tr style="background-color: #fecd0a;">
                                                <td style="font-weight: 500; width: 30%; background-color:#fecd0a; padding: 1px 4px 2px 6px; border: 1px solid orange; color:#000;"
                                                    rowspan="2">Skills</td>
                                                <td
                                                    style="font-weight: 500; width: 12%; padding: 1px 4px 2px 6px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">
                                                    Current Term</td>
                                                <td
                                                    style="font-weight: 500; width: 14%; padding: 1px 4px 2px 6px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">
                                                    Previous Term</td>
                                                <td style="font-weight: 500; padding: 1px 4px 2px 6px; border: 1px solid orange; color:#000;"
                                                    rowspan="2">Recommendation</td>
                                            </tr>
                                            <tr>
                                                <td
                                                    style="font-weight: 500; background-color:#ffe167; padding: 1px 4px 2px 6px; border: 1px solid orange; color:#000; text-align: center;">
                                                    Outcome</td>
                                                <td
                                                    style="font-weight: 500; background-color: #ffe167; padding: 1px 4px 2px 6px; border: 1px solid orange; color:#000; text-align: center;">
                                                    Outcome</td>
                                            </tr>
                                            <tr>
                                                <td
                                                    style="padding: 1px 4px 2px 6px; font-weight: 500; color:#000; border: 1px solid orange;">
                                                    Catching & Receiving Bounce Ball</td>
                                                <td
                                                    style="padding: 1px 4px 2px 6px; text-align: center; border: 1px solid orange;">
                                                    Acquired</td>
                                                <td style="padding: 1px 4px 2px 6px; border: 1px solid orange;"></td>
                                                <td
                                                    style="padding: 1px 4px 2px 6px; font-size: 12px; border: 1px solid orange;">
                                                    Catch balls of different heights and speeds with consistency.</td>
                                            </tr>
                                            <tr>
                                                <td
                                                    style="padding: 1px 4px 2px 6px; font-weight: 500; color:#000; border: 1px solid orange;">
                                                    Catching Small Ball with Two Hands</td>
                                                <td
                                                    style="padding: 1px 4px 2px 6px; text-align: center; border: 1px solid orange;">
                                                    Developing</td>
                                                <td style="padding: 1px 4px 2px 6px; border: 1px solid orange;"></td>
                                                <td
                                                    style="padding: 1px 4px 2px 6px; font-size: 12px; border: 1px solid orange;">
                                                    Practice toss and catch with a partner or against a wall.</td>
                                            </tr>
                                            <tr>
                                                <td
                                                    style="padding: 1px 4px 2px 6px; font-weight: 500; color:#000; border: 1px solid orange;">
                                                    Under Arm Throw</td>
                                                <td
                                                    style="padding: 1px 4px 2px 6px; text-align: center; border: 1px solid orange;">
                                                    Accomplished</td>
                                                <td style="padding: 1px 4px 2px 6px; border: 1px solid orange;"></td>
                                                <td
                                                    style="padding: 1px 4px 2px 6px; font-size: 12px; border: 1px solid orange;">
                                                    Integrate throws with movement or different weighted objects.</td>
                                            </tr>
                                            <tr>
                                                <td
                                                    style="padding: 1px 4px 2px 6px; font-weight: 500; color:#000; border: 1px solid orange;">
                                                    Over Arm Throw</td>
                                                <td
                                                    style="padding: 1px 4px 2px 6px; text-align: center; border: 1px solid orange;">
                                                    Accomplished</td>
                                                <td style="padding: 1px 4px 2px 6px; border: 1px solid orange;"></td>
                                                <td
                                                    style="padding: 1px 4px 2px 6px; font-size: 12px; border: 1px solid orange;">
                                                    Apply overarm throws in sport-like drills such as cricket or
                                                    baseball.</td>
                                            </tr>
                                            <tr>
                                                <td
                                                    style="padding: 1px 4px 2px 6px; font-weight: 500; color:#000; border: 1px solid orange;">
                                                    Striking Drop & Hit Forward</td>
                                                <td
                                                    style="padding: 1px 4px 2px 6px; text-align: center; border: 1px solid orange;">
                                                    Emerging</td>
                                                <td style="padding: 1px 4px 2px 6px; border: 1px solid orange;"></td>
                                                <td
                                                    style="padding: 1px 4px 2px 6px; font-size: 12px; border: 1px solid orange;">
                                                    Drop and tap balloons or soft balls using hand or paddle.</td>
                                            </tr>
                                            <tr>
                                                <td
                                                    style="padding: 1px 4px 2px 6px; font-weight: 500; color:#000; border: 1px solid orange;">
                                                    Dribbling with Hands</td>
                                                <td
                                                    style="padding: 1px 4px 2px 6px; text-align: center; border: 1px solid orange;">
                                                    Developing</td>
                                                <td style="padding: 1px 4px 2px 6px; border: 1px solid orange;"></td>
                                                <td
                                                    style="padding: 1px 4px 2px 6px; font-size: 12px; border: 1px solid orange;">
                                                    Dribble in zigzag paths while switching hands.</td>
                                            </tr>
                                            <tr>
                                                <td
                                                    style="padding: 1px 4px 2px 6px; font-weight: 500; color:#000; border: 1px solid orange;">
                                                    Dribbling with Feet</td>
                                                <td
                                                    style="padding: 1px 4px 2px 6px; text-align: center; border: 1px solid orange;">
                                                    Acquired</td>
                                                <td style="padding: 1px 4px 2px 6px; border: 1px solid orange;"></td>
                                                <td
                                                    style="padding: 1px 4px 2px 6px; font-size: 12px; border: 1px solid orange;">
                                                    Dribble faster and lower, maintaining control during movement.</td>
                                            </tr>
                                            <tr>
                                                <td
                                                    style="padding: 1px 4px 2px 6px; font-weight: 500; color:#000; border: 1px solid orange;">
                                                    Kicking Stationary Ball</td>
                                                <td
                                                    style="padding: 1px 4px 2px 6px; text-align: center; border: 1px solid orange;">
                                                    Emerging</td>
                                                <td style="padding: 1px 4px 2px 6px; border: 1px solid orange;"></td>
                                                <td
                                                    style="padding: 1px 4px 2px 6px; font-size: 12px; border: 1px solid orange;">
                                                    Practice gentle kicks using the inside of the foot.</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="height: 10px;"></td>
                    </tr>
                    <tr>
                        <td
                            style="padding: 2px 10px; font-size: 20px; background:#0A87CD; color:#fff; font-size: 16px; font-weight: 600;">
                            Body Management Skills</td>
                    </tr>
                    <tr>
                        <td>
                            <table border="0" cellpadding="0" cellspacing="0"
                                style="width: 100%; border: 0; border-collapse: collapse;">
                                <tr>
                                    <td style="vertical-align: top;">
                                        <table border="0" cellpadding="0" cellspacing="0"
                                            style="width: 100%; border: 1px solid orange; font-size: 13px; border-collapse: collapse; color:#333;">
                                            <tr style="background-color: #fecd0a;">
                                                <td style="font-weight: 500; width: 30%; background-color:#fecd0a; padding: 1px 4px 2px 6px; border: 1px solid orange; color:#000;"
                                                    rowspan="2">Skills</td>
                                                <td
                                                    style="font-weight: 500; width: 12%; padding: 1px 4px 2px 6px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">
                                                    Current Term</td>
                                                <td
                                                    style="font-weight: 500; width: 14%; padding: 1px 4px 2px 6px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">
                                                    Previous Term</td>
                                                <td style="font-weight: 500; padding: 1px 4px 2px 6px; border: 1px solid orange; color:#000;"
                                                    rowspan="2">Recommendation</td>
                                            </tr>
                                            <tr>
                                                <td
                                                    style="font-weight: 500; background-color:#ffe167; padding: 1px 4px 2px 6px; border: 1px solid orange; color:#000; text-align: center;">
                                                    Outcome</td>
                                                <td
                                                    style="font-weight: 500; background-color: #ffe167; padding: 1px 4px 2px 6px; border: 1px solid orange; color:#000; text-align: center;">
                                                    Outcome</td>
                                            </tr>
                                            <tr>
                                                <td
                                                    style="padding: 1px 4px 2px 6px; font-weight: 500; color:#000; border: 1px solid orange;">
                                                    One-Foot Balance</td>
                                                <td
                                                    style="padding: 1px 4px 2px 6px; text-align: center; border: 1px solid orange;">
                                                    Developing</td>
                                                <td style="padding: 1px 4px 2px 6px; border: 1px solid orange;"></td>
                                                <td
                                                    style="padding: 1px 4px 2px 6px; font-size: 12px; border: 1px solid orange;">
                                                    Balance on soft surfaces or cushions and try with eyes closed.</td>
                                            </tr>
                                            <tr>
                                                <td
                                                    style="padding: 1px 4px 2px 6px; font-weight: 500; color:#000; border: 1px solid orange;">
                                                    Beam Walk</td>
                                                <td
                                                    style="padding: 1px 4px 2px 6px; text-align: center; border: 1px solid orange;">
                                                    Acquired</td>
                                                <td style="padding: 1px 4px 2px 6px; border: 1px solid orange;"></td>
                                                <td
                                                    style="padding: 1px 4px 2px 6px; font-size: 12px; border: 1px solid orange;">
                                                    Include turns and steps while maintaining balance.</td>
                                            </tr>

                                        </table>
                                    </td>

                                </tr>
                                <tr>
                                    <td style="height: 15px;"></td>
                                </tr>

                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td
                            style="padding: 1px 10px 3px 10px; background:#0A87CD; color:#fff; font-size: 16px; font-weight: 600;">
                            Developmental Stages for 8 year Boy</td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top;">
                            <table border="0" cellpadding="0" cellspacing="0"
                                style="width:100%; border-collapse:collapse; font-size:13px; color:#333;">
                                <tr>
                                    <td
                                        style="border:1px solid #0A87CD; padding:3px 4px; text-align:left; width:110px;">
                                        <img src="<?php echo e(public_path('assets/imgs/1smiles.png')); ?>" style="height:20px;">
                                    </td>
                                    <td
                                        style="border:1px solid #0A87CD; padding:3px 4px; font-weight:500; color:#000;">
                                        Emerging
                                    </td>
                                    <td style="border:1px solid #0A87CD; padding:3px 4px; text-align:left;">
                                        Taking first steps with willingness to try and improve!
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border:1px solid #0A87CD; padding:3px 4px;">
                                        <img src="<?php echo e(public_path('assets/imgs/2smiles.png')); ?>" style="height:20px;">
                                    </td>
                                    <td
                                        style="border:1px solid #0A87CD; padding:3px 4px; font-weight:500; color:#000;">
                                        Developing
                                    </td>
                                    <td style="border:1px solid #0A87CD; padding:3px 4px;">
                                        Making great progress with noticeable improvement and effort!
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border:1px solid #0A87CD; padding:3px 4px;">
                                        <img src="<?php echo e(public_path('assets/imgs/3smiles.png')); ?>" style="height:20px;">
                                    </td>
                                    <td
                                        style="border:1px solid #0A87CD; padding:3px 4px; font-weight:500; color:#000;">
                                        Acquired
                                    </td>
                                    <td style="border:1px solid #0A87CD; padding:3px 4px;">
                                        Confidently performing skills with consistency and joy!
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border:1px solid #0A87CD; padding:3px 4px;">
                                        <img src="<?php echo e(public_path('assets/imgs/4smiles.png')); ?>" style="height:20px;">
                                    </td>
                                    <td
                                        style="border:1px solid #0A87CD; padding:3px 4px; font-weight:500; color:#000;">
                                        Accomplished
                                    </td>
                                    <td style="border:1px solid #0A87CD; padding:3px 4px;">
                                        Masterful execution with precision, and adaptability!
                                    </td>
                                </tr>
                            </table>

                        </td>

                    </tr>
                </table>
            </td>
        </tr>
        <!-- Inner page Footer Area (Page 3) -->
        <tr>
            <td>
                <table border="0" cellpadding="0" cellspacing="0" style="width:100%;">
                    <tr>
                        <td style="height: 50px;"></td>
                    </tr>
                    <tr>
                        <td style="width:94px;">
                            <div style="float: left; position: relative; width: 80px;">
                                <span
                                    style="position: absolute; left: 50%; top:50%; transform: translate(-50%, 0); color: #fff; z-index: 1; display: inline-block; padding: 6px 0 0 0px; font-size: 13px; font-weight: 600;">2</span>
                                <img src="<?php echo e(public_path('assets/reports/footer-bg.png')); ?>" alt=""
                                    style="width: inherit;">
                            </div>
                        </td>
                        <td style="text-align: right;">
                            <table cellpadding="0" cellspacing="0" style="border: 0px; width: 100%;">
                                <tr>
                                    <td style="height: 44px;"></td>
                                    <td style="height: 44px;"></td>
                                </tr>
                                <tr>
                                    <td style="font-weight: 400; font-size: 13px; color:#666;">
                                        Physical Health and Fitness Assessment
                                    </td>
                                    <td style="text-align:right; padding: 0px 30px 0px 0px;">
                                        <div style="float:right; text-align:center; position:relative;">
                                            <p
                                                style="color:#666; font-size:10px; position:absolute; top:-17px; width:100%; text-align:center;">
                                                powered by</p>
                                            <img src="<?php echo e(public_path('assets/reports/fitness365-logo-web.png')); ?>"
                                                alt="fitness365 logo" style="height:28px;">
                                        </div>
                                    </td>
                                </tr>

                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <!-- Page 4 -->
    <table border="0" cellpadding="0" cellspacing="0" style="page-break-before: always; width: 100%;">
        <tr>
            <td>
                <!-- Inner page Header Area (Page 2) -->
                <table border="1" cellpadding="0" cellspacing="0"
                    style="width: 100%; border-collapse: collapse; font-family: Roboto Condensed, sans-serif; font-size: 12px; border:0px solid transparent;">
                    <tr>
                        <td style="vertical-align: top; height: 100px;">
                            <table cellpadding="0" cellspacing="0" style="width: 100%; border:0;">
                                <tr>
                                    <td style="width:300px;">
                                        <?php if(!empty($studentsData->logo)): ?>
                                            <div
                                                style="position: absolute; top: 30px; left:22px; display: flex; align-items: center; z-index: 1;">
                                                <img src="<?php echo e(public_path('assets/uploads/logos/' . $studentsData->logo)); ?>"
                                                    alt=""
                                                    style="width: auto; height: 50px; object-fit: contain;">
                                            </div>
                                        <?php else: ?>
                                            <div
                                                style="position: absolute; top: 30px; left:22px; display: flex; align-items: center; z-index: 1;">
                                                <img src="<?php echo e(public_path('assets/uploads/logos/default_school-logo.png')); ?>"
                                                    alt=""
                                                    style="width: auto; height: 50px; object-fit: contain;">
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <td rowspan="2"
                                        style="position: relative; vertical-align: top; width: auto; text-align: right;">
                                        <div
                                            style="position: absolute; top: 30px; right:30px; display: flex; align-items: center; z-index: 1; width: 90px; overflow: hidden;">
                                            <img src="<?php echo e(public_path('assets/reports/seqfast-logo.png')); ?>"
                                                alt="" style="width: inherit;">
                                        </div>
                                        <img src="<?php echo e(public_path('assets/reports/inner-header-bg.png')); ?>"
                                            alt=""
                                            style="width: 450px; height:auto; position: relative; right:0px; top:0;">
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <!-- Inner page Header Area (Page 4) -->
        <tr>


            <td>
                <table border="1" cellpadding="0" cellspacing="0"
                    style="width: 100%; border-collapse: collapse; font-family: Roboto Condensed, sans-serif; font-size: 12px; border:0px solid transparent;">

                    <!-- Inner page Content (Page 4) -->
                    <tr>
                        <td>
                            <table cellpadding="0" cellspacing="0"
                                style="width: 94%; border: 0; border-collapse: collapse; margin: auto; color: #333; font-size: 12px;">
                                <tr>
                                    <td
                                        style="border: 1px solid #00A923; padding: 5px 10px 8px 10px; background:#F2FFF5;">
                                        <h3 style="color: #00A923; margin-bottom: 0px; font-size: 18px;">WHO Guidelines
                                            on Physical Activity and Sedentary Behaviour 2020</h3>
                                        <h4 style="color: #000; margin-bottom: 3px 10px; font-size: 16px">Age
                                            Appropriate Fitness Protocols and Guidelines for age 5-18 years</h4>
                                        <p style="line-height: 14px;">At least an average of 60 minutes per day of
                                            moderate-to-vigorous intensity physical activity, across the week; most of
                                            this physical activity should be aerobic.</p>
                                        <p style="line-height: 14px;">Vigorous-intensity aerobic activities, as well as
                                            those that strengthen muscle and bone should be incorporated at least 3 days
                                            a week.</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="height: 15px;"></td>
                                </tr>

                                <tr>
                                    <td>
                                        <table cellpadding="0" cellspacing="0"
                                            style="width: 100%; border: 0; border-collapse: collapse;">
                                            <tr>
                                                <td colspan="2">
                                                    <h3 style="color: #000; font-size: 16px; margin-bottom: 3px 10px;">
                                                        Recommends the following activities for improving Fundamental
                                                        Movement Skills for ages 5-8 years (Class 1-3)</h3>
                                                    <p>The focus is on the development of key Fundamental Movement
                                                        Skills which are required for life. Fit India recommends the
                                                        following activities for improvement of fitness for the 5-8 age
                                                        groups:</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="height: 6px;"></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h4 style="color: #000; margin-bottom: 3px 10px; font-size: 14px;">
                                                        1. Locomotor Skills</h4>
                                                    <p style="padding-left:14px; padding-right:14px;">Walking, Running,
                                                        Leaping/Jumping, Hopping/Skipping/Galloping,
                                                        Sliding/Crawling/Rolling/rotating</p>
                                                </td>
                                                <td>
                                                    <h4 style="color: #000; margin-bottom: 3px 10px; font-size: 14px;">
                                                        2. Manipulative Skills</h4>
                                                    <p style="padding-left:14px; padding-right:14px;">Throwing,
                                                        Catching, Bouncing/Dribbling, Trapping, Kicking with Hand/with
                                                        leg, Volleying, Striking etc.</p>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td style="height: 10px;"></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <h4 style="color: #000; margin-bottom: 3px 10px; font-size: 14px;">
                                                        3. Body Management/Non-locomotor Skills</h4>
                                                    <p style="padding-left:14px; padding-right:14px;">Curling,
                                                        Stretching, Twisting / Turning / Spinning, Pushing / Pulling,
                                                        Rocking, Swinging / Pivoting, Balancing / Counter Balancing,
                                                        Counter-tension etc.</p>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>

                                </tr>
                                <tr>
                                    <td style="height: 10px;"></td>
                                </tr>
                                <tr>
                                    <td>
                                        <table cellpadding="0" cellspacing="0"
                                            style="width: 100%; border: 0; border-collapse: collapse;">
                                            <tr>
                                                <td colspan="2">
                                                    <h3 style="color: #000; font-size: 16px; margin-bottom: 5px;">
                                                        Recommends the following activities for improving fitness for
                                                        ages 5-8 years</h3>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h4 style="color: #000; margin-bottom: 3px 10px; font-size: 14px;">
                                                        1. Hand-Eye Coordination Activities</h4>
                                                    <p style="padding-left:14px; padding-right:14px;">Ball Toss Against
                                                        Wall, Juggling with Scarves or Balls, Target Throws, Table
                                                        Tennis / Bat & Ball, Clap-Catch Game, Reaction Ball Drill</p>
                                                </td>
                                                <td>
                                                    <h4 style="color: #000; margin-bottom: 3px 10px; font-size: 14px;">
                                                        2. One-Leg Balance Activities</h4>
                                                    <p style="padding-left:14px; padding-right:14px;">Single-Leg
                                                        Stance, Balance with Arm Movements, Reach-and-Touch, Leg Swings,
                                                        Tree Pose (Yoga), Balance Pad / Cushion Stance</p>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="height: 20px;"></td>
                                </tr>

                                <tr>
                                    <td>
                                        <h2
                                            style="font-size: 24px; color:#0A87CD; font-size: 18px; font-weight: 600; text-align: center;">
                                            EXERCISE AND PHYSICAL ACTIVITY</h2>
                                    </td>
                                </tr>
                                <tr>
                                    <td
                                        style="font-size: 20px; color:#000; font-size: 16px; font-weight: 500; text-align: center;">
                                        <p>* Energy expenditure on various physical activities (Kcal/Hr)</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="height: 15px;"></td>
                                </tr>

                                <tr>
                                    <td>
                                        <table border="0" cellpadding="0" cellspacing="0" style="width:100%;">
                                            <tr>
                                                <td style="vertical-align: top; width:80%;">
                                                    <table cellpadding="0" cellspacing="0" style="width: 100%;">
                                                        <tr>
                                                            <td>
                                                                <table cellpadding="0" cellspacing="0"
                                                                    style="width:100%">
                                                                    <tr>
                                                                        <td
                                                                            style="vertical-align: top; padding-right:10px;">
                                                                            <table class="act-tbl col-3"
                                                                                border="1" cellpadding="0"
                                                                                cellspacing="0"
                                                                                style="border: 1px solid #0A87CD; font-size: 12px; border-collapse: collapse; color:#333;">
                                                                                <tr style="background-color: #0A87CD;">
                                                                                    <td style="background-color:#0A87CD; padding: 2px 4px; border: 1px solid #0A87CD; color:#fff; font-weight: bold;"
                                                                                        colspan="2">Activity</td>
                                                                                    <td
                                                                                        style="padding: 2px 4px; border: 1px solid #0A87CD; color:#fff; text-align: right; font-weight: bold;">
                                                                                        Kcal/hr</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td
                                                                                        style="font-weight: 500; color:#000; text-align: left; padding: 2px 4px;">
                                                                                        Sleeping</td>
                                                                                    <td
                                                                                        style="text-align: right; padding: 2px 4px; border-right:1px solid #0A87CD;">
                                                                                    </td>
                                                                                    <td
                                                                                        style="text-align: right; padding: 2px 4px; border-bottom:1px solid transparent;">
                                                                                        44</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td
                                                                                        style="font-weight: 500; color:#000; text-align: left; padding: 2px 4px;">
                                                                                        Sitting</td>
                                                                                    <td
                                                                                        style="text-align: right; padding: 2px 4px; border-right:1px solid #0A87CD;">
                                                                                    </td>
                                                                                    <td
                                                                                        style="text-align: right; padding: 2px 4px; border-bottom:1px solid transparent;">
                                                                                        57</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td
                                                                                        style="font-weight: 500; color:#000; text-align: left; padding: 2px 4px;">
                                                                                        Standing</td>
                                                                                    <td
                                                                                        style="text-align: right; padding: 2px 4px; border-right:1px solid #0A87CD;">
                                                                                    </td>
                                                                                    <td
                                                                                        style="text-align: right; padding: 2px 4px; border-bottom:1px solid transparent;">
                                                                                        63</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td
                                                                                        style="font-weight: 500; color:#000; text-align: left; padding: 2px 4px;">
                                                                                        Walking</td>
                                                                                    <td
                                                                                        style="text-align: right; padding: 2px 4px; border-right:1px solid #0A87CD;">
                                                                                        6.43 km/hr</td>
                                                                                    <td
                                                                                        style="text-align: right; padding: 2px 4px; border-bottom:1px solid transparent;">
                                                                                        227</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td
                                                                                        style="font-weight: 500; color:#000; text-align: left; padding: 2px 4px;">
                                                                                        Climbing Stairs</td>
                                                                                    <td
                                                                                        style="text-align: right; padding: 2px 4px; border-right:1px solid #0A87CD;">
                                                                                    </td>
                                                                                    <td
                                                                                        style="text-align: right; padding: 2px 4px; border-bottom:1px solid transparent;">
                                                                                        485</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td
                                                                                        style="font-weight: 500; color:#000; text-align: left; padding: 2px 4px;">
                                                                                        Housecleaning</td>
                                                                                    <td
                                                                                        style="text-align: right; padding: 2px 4px; border-right:1px solid #0A87CD;">
                                                                                    </td>
                                                                                    <td
                                                                                        style="text-align: right; padding: 2px 4px; border-bottom:1px solid transparent;">
                                                                                        176</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td
                                                                                        style="font-weight: 500; color:#000; text-align: left; padding: 2px 4px;">
                                                                                        Gardening</td>
                                                                                    <td
                                                                                        style="text-align: right; padding: 2px 4px; border-right:1px solid #0A87CD;">
                                                                                    </td>
                                                                                    <td
                                                                                        style="text-align: right; padding: 2px 4px;">
                                                                                        227</td>
                                                                                </tr>
                                                                            </table>
                                                                        </td>
                                                                        <td
                                                                            style="vertical-align: top; padding-right:10px;">
                                                                            <table class="act-tbl col-3"
                                                                                border="1" cellpadding="0"
                                                                                cellspacing="0"
                                                                                style="border: 1px solid #0A87CD; font-size: 12px; border-collapse: collapse; color:#333;">
                                                                                <tr style="background-color: #0A87CD;">
                                                                                    <td style="background-color:#0A87CD; padding: 2px 4px; border: 1px solid #0A87CD; color:#fff; font-weight: bold;"
                                                                                        colspan="2">Activity</td>
                                                                                    <td
                                                                                        style="padding: 2px 4px; border: 1px solid #0A87CD; color:#fff; text-align: right; font-weight: bold;">
                                                                                        Kcal/hr</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td
                                                                                        style="font-weight: 500; color:#000; text-align: left; padding: 2px 4px;">
                                                                                        Cycling</td>
                                                                                    <td
                                                                                        style="text-align: right; padding: 2px 4px; border-right:1px solid #0A87CD;">
                                                                                        City cycling
                                                                                    </td>
                                                                                    <td
                                                                                        style="text-align: right; padding: 2px 4px; border-bottom:1px solid transparent;">
                                                                                        302</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td
                                                                                        style="font-weight: 500; color:#000; text-align: left; padding: 2px 4px;">
                                                                                    </td>
                                                                                    <td
                                                                                        style="text-align: right; padding: 2px 4px; border-right:1px solid #0A87CD;">
                                                                                        16.1 km/hr
                                                                                    </td>
                                                                                    <td
                                                                                        style="text-align: right; padding: 2px 4px; border-bottom:1px solid transparent;">
                                                                                        391</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td
                                                                                        style="font-weight: 500; color:#000; text-align: left; padding: 2px 4px;">
                                                                                    </td>
                                                                                    <td
                                                                                        style="text-align: right; padding: 2px 4px; border-right:1px solid #0A87CD;">
                                                                                        22.53 km/hr
                                                                                    </td>
                                                                                    <td
                                                                                        style="text-align: right; padding: 2px 4px; border-bottom:1px solid transparent;">
                                                                                        567</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td
                                                                                        style="font-weight: 500; color:#000; text-align: left; padding: 2px 4px;">
                                                                                    </td>
                                                                                    <td
                                                                                        style="text-align: right; padding: 2px 4px; border-right:1px solid #0A87CD;">
                                                                                        32.18 km/hr</td>
                                                                                    <td
                                                                                        style="text-align: right; padding: 2px 4px; border-bottom:1px solid transparent;">
                                                                                        932</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td
                                                                                        style="font-weight: 500; color:#000; text-align: left; padding: 2px 4px;">
                                                                                        Running</td>
                                                                                    <td
                                                                                        style="text-align: right; padding: 2px 4px; border-right:1px solid #0A87CD;">
                                                                                        8 km/hr
                                                                                    </td>
                                                                                    <td
                                                                                        style="text-align: right; padding: 2px 4px; border-bottom:1px solid transparent;">
                                                                                        523</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td
                                                                                        style="font-weight: 500; color:#000; text-align: left; padding: 2px 4px;">
                                                                                    </td>
                                                                                    <td
                                                                                        style="text-align: right; padding: 2px 4px; border-right:1px solid #0A87CD;">
                                                                                        10 km/hr
                                                                                    </td>
                                                                                    <td
                                                                                        style="text-align: right; padding: 2px 4px; border-bottom:1px solid transparent;">
                                                                                        617</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td
                                                                                        style="font-weight: 500; color:#000; text-align: left; padding: 2px 4px;">
                                                                                        Garening</td>
                                                                                    <td
                                                                                        style="text-align: right; padding: 2px 4px; border-right:1px solid #0A87CD;">
                                                                                        13 km/hr
                                                                                    </td>
                                                                                    <td
                                                                                        style="text-align: right; padding: 2px 4px;">
                                                                                        743</td>
                                                                                </tr>
                                                                            </table>
                                                                        </td>
                                                                        <td
                                                                            style="vertical-align: top; padding-right:10px;">
                                                                            <table class="act-tbl col-2"
                                                                                border="1" cellpadding="0"
                                                                                cellspacing="0"
                                                                                style="border: 1px solid #0A87CD; font-size: 12px; border-collapse: collapse; color:#333; width:100%;">
                                                                                <tr style="background-color: #0A87CD;">
                                                                                    <td
                                                                                        style="background-color:#0A87CD; padding: 2px 4px; border: 1px solid #0A87CD; color:#fff; font-weight: bold;">
                                                                                        Activity</td>
                                                                                    <td
                                                                                        style="padding: 2px 4px; border: 1px solid #0A87CD; color:#fff; text-align: right; font-weight: bold;">
                                                                                        Kcal/hr</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td
                                                                                        style="font-weight: 500; color:#000; text-align: left; padding: 2px 4px; border-right:1px solid #0A87CD;">
                                                                                        Billiards/ snooker</td>

                                                                                    <td
                                                                                        style="text-align: right; padding: 2px 4px; border-bottom:1px solid transparent;">
                                                                                        44</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td
                                                                                        style="font-weight: 500; color:#000; text-align: left; padding: 2px 4px; border-right:1px solid #0A87CD;">
                                                                                        Roller skating</td>
                                                                                    <td
                                                                                        style="text-align: right; padding: 2px 4px; border-bottom:1px solid transparent;">
                                                                                        57</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td
                                                                                        style="font-weight: 500; color:#000; text-align: left; padding: 2px 4px; border-right:1px solid #0A87CD;">
                                                                                        Swimming</td>
                                                                                    <td
                                                                                        style="text-align: right; padding: 2px 4px; border-bottom:1px solid transparent;">
                                                                                        63</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td
                                                                                        style="font-weight: 500; color:#000; text-align: left; padding: 2px 4px; border-right:1px solid #0A87CD;">
                                                                                        Horseback riding</td>

                                                                                    <td
                                                                                        style="text-align: right; padding: 2px 4px; border-bottom:1px solid transparent;">
                                                                                        227</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td
                                                                                        style="font-weight: 500; color:#000; text-align: left; padding: 2px 4px; border-right:1px solid #0A87CD;">
                                                                                        Squash</td>
                                                                                    <td
                                                                                        style="text-align: right; padding: 2px 4px; border-bottom:1px solid transparent;">
                                                                                        485</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td
                                                                                        style="font-weight: 500; color:#000; text-align: left; padding: 2px 4px; border-right:1px solid #0A87CD;">
                                                                                        Badminton</td>
                                                                                    <td
                                                                                        style="text-align: right; padding: 2px 4px; border-bottom:1px solid transparent;">
                                                                                        176</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td
                                                                                        style="font-weight: 500; color:#000; text-align: left; padding: 2px 4px; border-right:1px solid #0A87CD;">
                                                                                        Table tennis</td>
                                                                                    <td
                                                                                        style="text-align: right; padding: 2px 4px;">
                                                                                        227</td>
                                                                                </tr>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td
                                                                style="font-size: 12px; padding-top: 4px; padding-right: 6px; line-height: 12px;">
                                                                *Approx.energy expenditure for 60 Kg reference man.
                                                                Individuals with higher body weight will
                                                                be spending more calories than those with lower body
                                                                weight. Reference woman (50 kg) will be spending 5%
                                                                less calories.
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td style="vertical-align: top; width:20%;">
                                                    <table border="1" cellpadding="0" cellspacing="0"
                                                        class="act-tbl col-2"
                                                        style="border: 1px solid #0A87CD; font-size: 12px; border-collapse: collapse; color:#333;">
                                                        <tr style="background-color: #0A87CD;">
                                                            <td
                                                                style="width: 100%; background-color:#0A87CD; padding: 2px 4px; border: 1px solid #0A87CD; color:#fff; font-weight: bold;">
                                                                Activity</td>
                                                            <td
                                                                style="font-weight: 500; padding: 2px 4px; border: 1px solid #0A87CD; color:#fff; text-align: right; font-weight: bold;">
                                                                Kcal/hr</td>
                                                        </tr>
                                                        <tr>
                                                            <td
                                                                style="font-weight: 500; color:#000; text-align: left; padding: 2px 4px; ">
                                                                Tennis</td>
                                                            <td
                                                                style="font-weight: 500; text-align: right; padding: 2px 4px;">
                                                                353</td>
                                                        </tr>
                                                        <tr>
                                                            <td
                                                                style="font-weight: 500; color:#000; text-align: left; padding: 2px 4px;">
                                                                Volleyball
                                                            </td>
                                                            <td
                                                                style="font-weight: 500; text-align: right; padding: 2px 4px;">
                                                                252</td>
                                                        </tr>
                                                        <tr>
                                                            <td
                                                                style="font-weight: 500; color:#000; text-align: left; padding: 2px 4px;">
                                                                Football</td>
                                                            <td
                                                                style="font-weight: 500; text-align: right; padding: 2px 4px;">
                                                                441</td>
                                                        </tr>
                                                        <tr>
                                                            <td
                                                                style="font-weight: 500; color:#000; text-align: left; padding: 2px 4px;">
                                                                Basketball
                                                            </td>
                                                            <td
                                                                style="font-weight: 500; text-align: right; padding: 2px 4px;">
                                                                403</td>
                                                        </tr>
                                                        <tr>
                                                            <td
                                                                style="font-weight: 500; color:#000; text-align: left; padding: 2px 4px;">
                                                                Dancing</td>
                                                            <td
                                                                style="font-weight: 500; text-align: right; padding: 2px 4px;">
                                                                302</td>
                                                        </tr>
                                                        <tr>
                                                            <td
                                                                style="font-weight: 500; color:#000; text-align: left; padding: 2px 4px;">
                                                                Gymnastic</td>
                                                            <td
                                                                style="font-weight: 500; text-align: right; padding: 2px 4px;">
                                                                202</td>
                                                        </tr>
                                                        <tr>
                                                            <td
                                                                style="font-weight: 500; color:#000; text-align: left; padding: 2px 4px;">
                                                                Yoga</td>
                                                            <td
                                                                style="font-weight: 500; text-align: right; padding: 2px 4px;">
                                                                195</td>
                                                        </tr>
                                                        <tr>
                                                            <td
                                                                style="font-weight: 500; color:#000; text-align: left; padding: 2px 4px;">
                                                                HIIT Workout
                                                            </td>
                                                            <td
                                                                style="font-weight: 500; text-align: right; padding: 2px 4px;">
                                                                504</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
        <!-- Inner page Footer Area (Page 4) -->
        <tr>
            <td style="height: 20px;"></td>
        </tr>
        <tr>
            <td>
                <table border="1" cellpadding="0" cellspacing="0"
                    style="width: 94%; border: 1px solid #F28F0C; font-size: 14px; border-collapse: collapse; color:#333; margin:auto;">
                    <tr>
                        <td
                            style="font-weight: 600; padding: 10px 15px; font-size: 14px; color: #000; height:80px; vertical-align:top;">
                            PE Teacher's Observations and Comments (if any)</td>
                        <td
                            style="font-weight: 600; padding: 10px 15px; font-size: 14px; color: #000; text-align:center; height:80px; vertical-align:bottom; border-left:1px solid orange;">
                            Teacher's Signature</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table border="0" cellpadding="0" cellspacing="0"
                    style="width: 100%; font-size: 14px; border-collapse: collapse; color:#000;">
                    <tr>
                        <td style="border: 1px solid transparent; width:50%;">
                            <div
                                style="padding: 10px 0px; height: 63px; background-color: #fff; border-right: 3px solid #fff;">
                            </div>
                            <p style="text-align: center; font-weight: 600;">Parent's Signature</p>
                        </td>
                        <td style="border: 1px solid transparent; width:50%;">
                            <div
                                style="padding: 10px 0px; height: 63px; background-color: #fff; border-left: 3px solid #fff;">
                            </div>
                            <p style="text-align: center; font-weight: 600;">Signature of Principal with Stamp</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="height:14px;"></td>
        </tr>
        <tr>
            <td>
                <table cellpadding="0" cellspacing="0" style="width: 100%; border:0; font-size:13px;">
                    <tr>
                        <td style="background-color: #E60A00; height: 40px; padding: 0 30px; color:#fff;">CISCE
                            Physical Health and Fitness Assessment</td>
                        <td
                            style="background-color: #00A923; height: 40px; width: 30%; padding: 0 30px; text-align:right; color:#fff;">
                            powered by <strong>fitness365.me</strong></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

</body>

</html>
<?php /**PATH C:\xampp\htdocs\nep\resources\views/reports/fitness/junior-report.blade.php ENDPATH**/ ?>