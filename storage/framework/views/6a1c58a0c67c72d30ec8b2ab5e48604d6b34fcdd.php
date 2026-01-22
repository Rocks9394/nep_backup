<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <style>
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

        page[size="A4"] {
            width: 21cm;
            height: 29.7cm;
            margin: 0;
        }
    </style>
</head>

<body>
    <?php  $GetSchoolLogo = Helper::GetSchoolLogo();  ?>
    <table cellpadding="0" cellspacing="0" style="width: 21cm; border-collapse: collapse; margin-left: auto; margin-right: auto; font-family: Roboto Condensed, sans-serif; font-size: 12px; border: 0px; background-color: #fff;">
        <!-- Cover Page -->
        <tr>
            <td>
                <table cellpadding="0" cellspacing="0" style="width: 100%; border-collapse: collapse; font-family: Roboto Condensed, sans-serif; font-size: 12px; border: 0;">
                    <tr style="background-color: #0A87CD; height: 140px; ">
                        <td style="vertical-align: top;">
                            <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0px; height: 100%;">
                                <tr>
                                    <td style="width:180px;"></td>
                                    <td style="position: relative; vertical-align: top; width: 200px; height: 100%;">
                                        <img src="<?php echo e(asset('/public/assets/reports/yellow-dot.png')); ?>" alt="" style="width: 50px; height:50px; position: relative; left:-50px; top:0;">
                                        <div style="position: absolute; top: 0; display: flex; align-items: flex-start; z-index: 10; width: 200px; overflow: hidden;">
                                            <div class="logo" style="position: relative; width: inherit;">
                                                <span style="position: absolute; top:0; left:0; width: inherit; padding: 20px; box-sizing: border-box; display:inline-block;">
                                                    <img src="<?php echo e(asset('/public/assets/reports/seqfast-logo.png')); ?>" alt="" style="width: 160px; margin-top: 10px;">
                                                </span>
                                                <img src="<?php echo e(asset('/public/assets/reports/logo-bg.jpg')); ?>" alt="" style="width: 200px; margin-top: -50px;">
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div style="margin-left: 40px; margin-right: 120px; margin-top: 40px; font-weight: 600; font-size: 26px; color:#fff; text-transform: uppercase;">Physical Health and Fitness Assessment
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="border-collapse: collapse;">
                            <div style="width: 100%; position: relative; border-collapse: collapse;">
                                <img src="<?php echo e(asset('public/assets/reports/report-graphic.png')); ?>" alt="" style="position: absolute; top:25%; right:40px; width: 200px; border-collapse: collapse;">
                                <img src="<?php echo e(asset('public/assets/reports/report-cover-img.png')); ?>" alt="" style="width: 76%;">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0;">
                                <tr>
                                   <td style="background-color:#FBCA01;">
                                        <div style="position:relative;">
                                            <span style="position:absolute; top:-38px; background:rgb(0 0 0/50%); padding:10px; width:100%; z-indix:2; box-sizing: border-box; text-align:center; color:#fff; font-size:16px; text-transform: uppercase;">For Senoir</span>
                                            <img src="<?php echo e(asset('/public/assets/reports/aa-bg.png')); ?>" alt="" style="width:198px; position: relative; top: -3px;">
                                        </div>
                                    </td>
                                    <td style="vertical-align: top; width: 100%;">
                                        <table cellpadding="0" cellspacing="0" style="width: 90%; border: 0;">
                                            <tr>
                                                <td style="height:30px;"></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <img src="<?php echo e(asset('public/assets/uploads/logos/' . $GetSchoolLogo->logo)); ?>" alt="" style="width: auto; object-fit: contain; padding: 0px 0px 5px 46px; height: 100px;">
                                                    <!-- <img src="<?php echo e(asset('public/assets/reports/gems-school-logo.png')); ?>" alt="" style="padding: 0px 0px 5px 46px; height: 100px;"> -->
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="height:20px;"></td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 10px 30px 10px 50px; font-size: 20px; background:#E60A00; color:#fff; font-size: 24px; font-weight: 500; position:relative;">Personal Profile<span style=" position:absolute; top:46px; right:-20px;"><img src="<?php echo e(asset('/public/assets/reports/green-bg.jpg')); ?>" alt="" style="width:20px;"></span></td>
                                            </tr>
                                            <tr>
                                                <td style="height:20px;"></td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 10px 30px 10px 50px; font-size: 16px; color: #333;">
                                                    <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0px">
                                                        <tr>
                                                            <td colspan="2" style="padding: 6px 0;">
                                                                <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0px">
                                                                    <tr>
                                                                        <td style="padding: 0px 0px 2px 0px;"><span style="display: inline-block; margin-right: 5px;">Name</span></td>
                                                                        <td style="border-bottom: 1px solid #ccc; width: 100%; text-align: center; font-weight: 600; font-size: 18px; padding: 2px 0px; text-transform:uppercase;"><?php echo e($studentsData->student_name); ?></td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2" style="padding: 6px 0;">
                                                                <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0px;">
                                                                    <tr>
                                                                        <td style="padding: 0px 0px 2px 0px;"><span style="display: inline-block; margin-right: 5px;">Class&nbsp;&&nbsp;Section</span></td>
                                                                        <td style="border-bottom: 1px solid #ccc; width: 100%; text-align: center; font-weight: 600; padding: 2px 0px;"> <?php echo e($studentsData->display_classname); ?>-<?php echo e($studentsData->section); ?></td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                            
                                                        </tr>
                                                        
                                                        <tr>
                                                            <td style="padding: 6px 0;">
                                                                <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0px">
                                                                    <tr>
                                                                        <td style="padding: 0px 0px 2px 0px;"><span style="display: inline-block; margin-right: 5px; margin-left: 0px;">Roll&nbsp;No.</span></td>
                                                                        <td style="border-bottom: 1px solid #ccc; width: 100%; text-align: center; font-weight: 600; padding: 2px 0px;"><?php echo e($studentsData->rollno ?? ''); ?></td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                            <td style="padding: 6px 0; width:55%;">
                                                                <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0px">
                                                                    <tr>
                                                                        <td style="padding: 0px 0px 2px 0px;"><span style="display: inline-block; margin-right: 5px;">Registration&nbsp;No</span></td>
                                                                        <td style="border-bottom: 1px solid #ccc; width: 100%; text-align: center; font-weight: 600; padding: 2px 0px;"><?php echo e($studentsData->admissionnumber); ?></td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 6px 0;">
                                                                <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0px">
                                                                    <tr>
                                                                        <td style="padding: 0px 0px 2px 0px;"><span style="display: inline-block; margin-right: 5px;">DOB</span></td>

                                                                        <?php
                                                                            use Carbon\Carbon;

                                                                            $dob = Carbon::parse($studentsData->dob); 
                                                                            $formattedDob = $dob->format('d M Y'); // 05 Jul 2019
                                                                            $age = $dob->age; // will calculate age automatically
                                                                           

                                                                            if (strtolower($studentsData->gender) === 'male') {
                                                                                $gender = 'Boy';
                                                                            } else {
                                                                                $gender = 'Girl';
                                                                            }
                                                                        ?>
                                                                        <td style="border-bottom: 1px solid #ccc; width: 100%; text-align: center; font-weight: 600; padding: 2px 0px;"> <?php echo e($formattedDob); ?> (<?php echo e($age); ?> Years)</td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                            <td style="padding: 6px 0;">
                                                                <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0px">
                                                                    <tr>
                                                                        <td style="padding: 0px 0px 2px 0px;"><span style="display: inline-block; margin-right: 5px; margin-left: 5px;">Gender</span></td>
                                                                        <td style="border-bottom: 1px solid #ccc; width: 100%; text-align: center; font-weight: 600; padding: 2px 0px;"><?php echo e($gender); ?></td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="height: 15px;"></td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2" style="padding: 6px 0;">
                                                                <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0px">
                                                                    <tr>
                                                                        <td style="padding: 0px 0px 2px 0px;"><span style="display: inline-block; margin-right: 5px;">School</span></td>
                                                                        <td style="border-bottom: 1px solid #ccc; width: 100%; text-align: center; font-weight: 600; padding: 2px 0px;"><?php echo e($studentsData->school_name); ?></td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 6px 0;">
                                                                <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0px">
                                                                    <tr>
                                                                        <td style="padding: 0px 0px 2px 0px;"><span style="display: inline-block; margin-right: 5px;">Code</span></td>
                                                                        <td style="border-bottom: 1px solid #ccc; width: 100%; text-align: center; font-weight: 600; padding: 2px 0px;"><?php echo e($studentsData->school_code); ?></td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                            <td style="padding: 6px 0;">
                                                                <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0px">
                                                                    <tr>
                                                                        <td style="padding: 0px 0px 2px 0px;">&nbsp;&nbsp;APAAR&nbsp;ID&nbsp;<span style="display: inline-block; margin-left: 0px; margin-right: 5px; font-size:11px;">(Optional)</span></td>
                                                                        <td style="border-bottom: 1px solid #ccc; width: 100%; text-align: center; font-weight: 600; padding: 2px 0px;"><?php echo e($studentsData->apaarId ?? ''); ?></td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="height: 15px;"></td>
                                                        </tr>
                                                        <!-- <tr>
                                                            <td colspan="2" style="padding: 6px 0;">
                                                                <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0px">
                                                                    <tr>
                                                                        <td><span style="display: inline-block; margin-right: 5px; font-weight:500;">Brief Summary</span></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="border-bottom: 1px solid #ccc; width: 100%; text-align: center; font-weight: 600; height: 24px; padding: 2px 0;"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="border-bottom: 1px solid #ccc; width: 100%; text-align: center; font-weight: 600; height: 24px; padding: 2px 0;"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="border-bottom: 1px solid #ccc; width: 100%; text-align: center; font-weight: 600; height: 24px; padding: 2px 0;"></td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr> -->
                                                    </table>
                                                </td>
                                            </tr>
                                            <!-- <tr>
                                                <td style="height:150px;"></td>
                                        </tr>
                                        <tr>
                                            <td style="text-align:right; padding: 0px 0px 0px 46px; ">
                                                <div style="float:right; text-align:center;">
                                                    <p style="margin-bottom:0px; color:#666; font-size:10px;">Powered by</p>
                                                        <img src="<?php echo e(asset('public/assets/reports/fitness365-logo-web.png')); ?>" alt="fitness365 logo" style="height:28px;">
                                                </div>
                                            </td>
                                        </tr> -->
                                    </table>
                                </td>

                                </tr>
                                <!-- <tr>
                                    <td style="background-color: #1c9b3e; height: 30px;"></td>
                                    <td style="background-color: #F28F0C; height: 30px;"></td>
                                </tr> -->
                                
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <!-- Page 2 -->
        <tr>
            <td style="vertical-align: top; height: 1032px;">
                <table border="1" cellpadding="0" cellspacing="0" style="page-break-before: always; width: 100%; border-collapse: collapse; font-family: Roboto Condensed, sans-serif; font-size: 12px; border:0px solid transparent;">
                    <!-- Inner page Header Area (Page 2) -->
                    <tr style="height: 110px;">
                        <td style="vertical-align: top;">
                            <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0px; height: 100%; border:0;">
                                <tr>

                                     <td style="position: relative; vertical-align: top; width: 360px; height: 100%; " >                               
                                        <?php if(!empty($studentsData->logo)): ?>                                        
                                            <div style="position: absolute; top: 30px; left:22px; display: flex; align-items: center; z-index: 1;">
                                                <img src="<?php echo e(asset('public/assets/uploads/logos/' . $GetSchoolLogo->logo)); ?>" alt="" style="width: auto; height: 50px; object-fit: contain;">
                                            </div>
                                        <?php else: ?>
                                            <div style="position: absolute; top: 30px; left:22px; display: flex; align-items: center; z-index: 1;">
                                                <img src="<?php echo e(asset('public/assets/uploads/logos/default_school-logo.png' )); ?>" alt="" style="width: auto; height: 50px; object-fit: contain;">
                                            </div>
                                        <?php endif; ?>
                                    </td>

                                    <td rowspan="2" style="position: relative; vertical-align: top; width: auto; height: 100%; text-align: right;">
                                        <div style="position: absolute; top: 30px; right:30px; display: flex; align-items: center; z-index: 1; width: 90px; overflow: hidden;">
                                            <img src="<?php echo e(asset('public/assets/reports/seqfast-logo.png')); ?>" alt="" style="width: inherit;">
                                        </div>
                                        <img src="<?php echo e(asset('public/assets/reports/inner-header-bg.png')); ?>" alt="" style="width: 450px; height:auto; position: relative; right:0px; top:0;">
                                    </td>

                                </tr>
                            </table>
                        </td>

                    </tr>
                    <!-- Inner page Content (Page 2) -->
                    <tr>
                        <td>
                            <table cellpadding="0" cellspacing="0" style="width: 94%; border: 0; border-collapse: collapse; margin: auto; ">
                                <tr>
                                    <td style="border-bottom: 3px solid #E60A00;">
                                        <div style="background:#E60A00; float:left; display: inline-flex; align-items: center; color: #fff; font-size: 18px; font-weight: 600; height: 32px;">
                                            <div style="float: left; padding: 1px 0px 0px 10px; margin-bottom: -3px;">Physical Fitness Assessment for <?php echo e($studentsData->class); ?>-<?php echo e($studentsData->section); ?></div>
                                            <div style="float:left; transform: skew(26deg,0deg); display:inline-block; width: 20px; height: 32px; background: #E60A00; position: relative; right: -10px;"></div>
                                        </div>
                                    </td>
                                </tr>
                                
                                <?php $__currentLoopData = $orderedReportData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <?php

                                    $displayKey = str_contains($key, 'Body Composition')  
                                        ? str_replace('Body Composition (BMI)', 'BMI (Body Mass Index)', $key) 
                                        : $key;
                                ?>
                               
                                <tr> <td style="height: 15px;"></td></tr>
                                <tr>
                                    <td style="padding: 6px 10px 6px 0px; font-size: 20px; color:#000; font-size: 18px; font-weight: 600;"><?php echo e($displayKey); ?></td> 
                                </tr>
                                

                                <?php if($key === 'Body Composition (BMI)'): ?>


                                <tr>
                                    <td>
                                        <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0; border-collapse: collapse;">
                                            <tr>
                                                <td style="vertical-align: top;">
                                                    <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
                                                        <tr style="font-size: 13px; line-height: 1.25rem;">
                                                            <td style="border-top: 1px solid #0A87CD; border-left: 1px solid #0A87CD; border-right: 1px solid #0A87CD; border-bottom: 0px solid transparent; border-collapse: collapse; padding:5px 15px; vertical-align: middle;">
                                                                <ul style="margin-left: 15px;">
                                                                    <li>Height recorded in cm and mm</li>
                                                                    <li>Weight will be recorded in kilogram (kg) and grams(gms)</li>
                                                                </ul>
                                                            </td>
                                                            <td style="border-top: 1px solid #0A87CD; border-right: 1px solid #0A87CD; border-bottom: 0px solid transparent; border-collapse: collapse; padding:5px 15px; vertical-align: top; padding-bottom:10px;">
                                                                <table border="0" cellpadding="0" cellspacing="0">
                                                                    <tr>
                                                                        <td>Body Mass Index =</td>
                                                                        <td style="padding:0 10px;">
                                                                        <p style="border-bottom: 1px solid #c5c5c5; padding-bottom: 2px; margin:0;">Weight (in kg)</p>
                                                                        <p style="padding-top: 0px; margin:0;">Height (in m)2</p>
                                                                        </td>
                                                                    </tr>
                                                                </table>

                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 50%;">
                                                                <table border="1" cellpadding="0" cellspacing="0" style="width: 100%; border: 1px solid orange; font-size: 13px; border-collapse: collapse; color:#333;">
                                                                    <tr style="background-color: #fecd0a;">
                                                                        <td style="width: 20%; background-color:#0A87CD; padding: 0px 4px 2px 6px; border: 1px solid #0A87CD; color:#fff; text-align: center; font-weight: bold;" rowspan="2">Current Term</td>
                                                                        <td style="width: 25%; padding: 4px 0px 4px 0px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">Date</td>
                                                                        <td style="width: 28%; padding: 0px 4px 2px 6px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">Weight</td>
                                                                        <td style="width: 28%; padding: 0px 4px 2px 6px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">Height</td>
                                                                        <td style="width: 28%; padding: 0px 4px 2px 6px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">BMI</td>
                                                                        <td style="padding: 0px 4px 2px 6px; border: 1px solid orange; color:#000; font-weight: bold; text-align: center;">Level</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td style="padding: 4px 0px 4px 0px; font-weight: 500; color:#000; text-align: center;"><?php echo e($value[0]['created_at'] ?? '---'); ?></td>
                                                                        <td style="padding: 0px 4px 2px 6px; text-align: center; border: 1px solid orange;">
                                                                            <?php if(!empty($value[0]['weight'])): ?>
                                                                                <?php echo e($value[0]['weight']); ?> kg
                                                                            <?php else: ?>
                                                                                ---
                                                                            <?php endif; ?>
                                                                        </td>
                                                                        <td style="padding: 0px 4px 2px 6px; text-align: center; border: 1px solid orange;">
                                                                            <?php if(!empty($value[0]['height'])): ?>
                                                                                <?php echo e($value[0]['height']); ?> cm
                                                                            <?php else: ?>
                                                                                ---
                                                                            <?php endif; ?>
                                                                        </td>
                                                                        <td style="padding: 0px 4px 2px 6px; text-align: center; border: 1px solid orange;"><?php echo e($value[0]['score'] ?? '---'); ?></td>
                                                                        <td style="padding: 0px 4px 2px 6px; text-align: center; border: 1px solid orange;"><?php echo e($value[0]['Level'] ?? '---'); ?></td>

                                                                    </tr>

                                                                </table>
                                                            </td>
                                                            <td style="width: 50%;">
                                                                <table border="1" cellpadding="0" cellspacing="0" style="width: 100%; border: 1px solid orange; font-size: 13px; border-collapse: collapse; color:#333;">
                                                                    <tr style="background-color: #fecd0a;">
                                                                        <td style="width: 20%; background-color:#0A87CD; padding: 0px 4px 2px 6px; border: 1px solid #0A87CD; color:#fff; text-align: center; font-weight: bold;" rowspan="2">Previous Term</td>
                                                                        <td style="width: 25%; padding: 4px 0px 4px 0px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">Date</td>
                                                                        <td style="width: 28%; padding: 0px 4px 2px 6px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">Weight</td>
                                                                        <td style="width: 28%; padding: 0px 4px 2px 6px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">Height</td>
                                                                        <td style="width: 28%; padding: 0px 4px 2px 6px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">BMI</td>
                                                                        <td style="padding: 0px 4px 2px 6px; border: 1px solid orange; color:#000; font-weight: bold; text-align: center;">Level</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td style="padding: 0px 4px 2px 6px; font-weight: 500; color:#000; text-align: center;">---</td>
                                                                        <td style="padding: 4px 0px 4px 0px;  text-align: center; border: 1px solid orange;">--- </td>
                                                                        <td style="padding: 0px 4px 2px 6px; text-align: center; border: 1px solid orange;"> --- </td>
                                                                        <td style="padding: 0px 4px 2px 6px; text-align: center; border: 1px solid orange;"> --- </td>
                                                                        <td style="padding: 0px 4px 2px 6px; text-align: center; border: 1px solid orange;">---</td>

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

                                <?php else: ?>

                                <tr>
                                    <td>
                                        <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0; border-collapse: collapse;">
                                            <tr>
                                                <td style="vertical-align: top;">
                                                    <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
                                                        <tr>
                                                            <td style="width: 50%;">
                                                                <table border="1" cellpadding="0" cellspacing="0" style="width: 100%; border: 1px solid orange; border-bottom: 1px solid #00A923; font-size: 14px; border-collapse: collapse; color:#333;">
                                                                    <tr style="background-color: #fecd0a;">
                                                                        <td style="width: 20%; background-color:#0A87CD; padding: 4px 4px 4px 6px; border: 1px solid #0A87CD; color:#fff; text-align: center; font-weight: bold;" rowspan="2">Current Term</td>
                                                                        <td style="width: 25%; padding: 4px 4px 4px 6px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">Date</td>
                                                                        <td style="width: 28%; padding: 4px 4px 4px 6px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">Score</td>
                                                                        <td style="padding: 4px 4px 4px 6px; border: 1px solid orange; color:#000; font-weight: bold; text-align: center;">Level</td>
                                                                    </tr>

                                                                    <tr>                
                                                                        <td style="padding: 4px 4px 4px 6px; font-weight: 500; color:#000; text-align: center;"><?php echo e($value[0]['created_at'] ?? '---'); ?></td>
                                                                        <td style="padding: 4px 4px 4px 6px; text-align: center;"><?php echo e($value[0]['score'] ?? '---'); ?></td>
                                                                        <td style="padding: 4px 4px 4px 6px; text-align: center;"><?php echo e($value[0]['Level'] ?? '---'); ?></td>

                                                                    </tr>

                                                                </table>
                                                            </td>
                                                            <td style="width: 50%;">
                                                                <table border="1" cellpadding="0" cellspacing="0" style="width: 100%; border: 1px solid orange; border-bottom: 1px solid #00A923; font-size: 14px; border-collapse: collapse; color:#333;">
                                                                    <tr style="background-color: #fecd0a;">
                                                                        <td style="font-weight: 500; width: 20%; background-color:#0A87CD; padding: 4px 4px 4px 6px; border: 1px solid #0A87CD; color:#fff; text-align: center;" rowspan="2">Previous Term</td>
                                                                        <td style="font-weight: 500; width: 25%; padding: 4px 4px 4px 6px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">Date</td>
                                                                        <td style="font-weight: 500; width: 28%; padding: 4px 4px 4px 6px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">Score</td>
                                                                        <td style="font-weight: 500; padding: 4px 4px 4px 6px; border: 1px solid orange; color:#000; font-weight: bold; text-align: center;">Level</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td style="padding: 4px 4px 4px 6px; font-weight: 500; color:#000; text-align: center;">---</td>
                                                                        <td style="padding: 4px 4px 4px 6px; text-align: center;">---</td>
                                                                        <td style="padding: 4px 4px 4px 6px; text-align: center;">---</td>

                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <table border="1" cellpadding="0" cellspacing="0" style="width: 100%; border-top: 1px solid transparent; border-left: 1px solid #00A923; border-right: 1px solid #00A923; border-bottom: 1px solid #00A923; font-size: 14px; border-collapse: collapse; color:#333;">
                                                        <tr>
                                                            <td style="border-top: 1px solid #00A923; background-color: #00A923; padding: 4px; padding: 5px 10px; color: #fff; text-align: center; width: 100px; font-weight: bold;">Recommendation</td>
                                                            <td style="padding: 4px;"><?php echo e($value[0]['recommendation'] ?? '---'); ?></td>
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
                                    <td style="height: 10px;"></td> 
                                </tr>

                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <!-- Inner page Footer Area (Page 2) -->

        
                    <tr>
                        <td>
                            <table border="0" cellpadding="0" cellspacing="0" style="width:100%;">
                                <tr>
                                    <td style="height: 30px;"></td>
                                </tr>
                                <tr>
                                    <td style="width:74px;">
                                        <div style="float: left; position: relative; width: 60px;">
                                            <span style="position: absolute; left: 50%; top:50%; transform: translate(-50%, 0); color: #fff; z-index: 1; display: inline-block; padding: 2px 0 0 20px; font-size: 13px; font-weight: 600;"></span>
                                            <img src="<?php echo e(asset('public/assets/reports/footer-bg.png')); ?>" alt="" style="width: inherit;">
                                        </div>
                                    </td>
                                    <td style="text-align: right;">
                                        <table cellpadding="0" cellspacing="0" style="border: 0px; width: 100%;">
                                            <tr>
                                                <td style="height: 15px;"></td>
                                                <td style="height: 15px;"></td>
                                            </tr>
                                            <tr>
                                                <td style="font-weight: 400; font-size: 13px; color:#666; text-align:left;">
                                                    Physical Health and Fitness Assessment
                                                </td>
                                                <td style="text-align:right; padding: 0px 30px 0px 0px;">
                                                    <div style="float:right; text-align:center; position:relative;">
                                                        <p style="color:#666; font-size:10px; position:absolute; top:-17px; width:100%; text-align:center;">powered  by</p>
                                                        <img src="<?php echo e(asset('public/assets/reports/fitness365-logo-web.png')); ?>" alt="fitness365 logo" style="height:28px;">
                                                    </div> 
                                                </td>
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



        <!-- Page 3 -->
        <tr>
            <td style="vertical-align: top; height: 1032px;">
                <table border="1" cellpadding="0" cellspacing="0" style="page-break-before: always; width: 100%; border-collapse: collapse; font-family: Roboto Condensed, sans-serif; font-size: 12px; border:0px solid transparent;">
                    <!-- Inner page Header Area (Page 3) -->
                    <tr style="height: 100px;">
                        <td style="vertical-align: top;">
                            <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0px; height: 100%; border:0;">
                                <tr>

                                    <td rowspan="2" style="position: relative; vertical-align: top; width: auto; height: 100%; text-align: left;">
                                        <div style="position: absolute; top: 30px; left:30px; display: flex; align-items: center; z-index: 1; width: 90px; overflow: hidden;">
                                            <img src="<?php echo e(asset('/public/assets/reports/seqfast-logo.png')); ?>" alt="" style="width: inherit;">
                                        </div>
                                        <img src="<?php echo e(asset('/public/assets/reports/inner-header2-bg.png')); ?>" alt="" style="width: 450px; height:auto; position: relative; left:0px; top:0;">
                                    </td>

                                    
                                    <td style="position: relative; vertical-align: top; width: 360px; height: 100%; " >                               
                                        <?php if(!empty($studentsData->logo)): ?>                                        
                                            <div style="position: absolute; top: 30px; right:30px; display: flex; align-items: center; z-index: 1;">
                                                <img src="<?php echo e(asset('public/assets/uploads/logos/' . $GetSchoolLogo->logo)); ?>" alt="" style="width: auto; height: 50px; object-fit: contain;">
                                            </div>
                                        <?php else: ?>
                                            <div style="position: absolute; top: 30px; right:30px; display: flex; align-items: center; z-index: 1;">
                                                <img src="<?php echo e(asset('public/assets/uploads/logos/default_school-logo.png' )); ?>" alt="" style="width: auto; height: 50px; object-fit: contain;">
                                            </div>
                                        <?php endif; ?>
                                    </td>

                                    <!-- <td style="width:300px; text-align: right;">
                                        <div style="margin-right: 30px; margin-top: 30px;">
                                            School Logo
                                        </div>
                                    </td> -->

                                </tr>
                            </table>
                        </td>

                    </tr>
                    <!-- Inner page Content (Page 3) -->
                    <tr>
                        <td>
                            <table cellpadding="0" cellspacing="0" style="width: 94%; border: 0; border-collapse: collapse; margin: auto;">
                                <tr>
                                    <td style="border-bottom: 3px solid #E60A00;">
                                        <div style="background:#E60A00; float:left; display: inline-flex; align-items: center; color: #fff; font-size: 18px; font-weight: 600; height: 32px;">
                                            <div style="float: left; padding: 1px 0px 0px 10px; margin-bottom: -3px;">Recommended Sports</div>
                                            <div style="float:left; transform: skew(26deg,0deg); display:inline-block; width: 20px; height: 32px; background: #E60A00; position: relative; right: -10px;"></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="height: 15px;"></td>
                                </tr>
                                <tr>
                                    <td>
                                        <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0; border-collapse: collapse; border:1px solid #0A87CD;">
                                            <tr style="background-color: #0A87CD; color:#fff; font-size: 14px;">
                                                <!-- <th style="vertical-align: top; padding: 3px 4px; border:1px solid #0A87CD;">

                                                </th> -->
                                                <th style="vertical-align: top; padding: 3px 4px; width:44%; border:1px solid #0A87CD;">
                                                    Fitness Profile
                                                </th>
                                                <th style="vertical-align: top; padding: 3px 4px; border:1px solid #0A87CD;">
                                                    Recommended Team
                                                </th>
                                                <th style="vertical-align: top; padding: 3px 4px; border:1px solid #0A87CD;">
                                                    Recommended Individual Sports
                                                </th>
                                            </tr>
                                            <tr>
                                                <!-- <td style="vertical-align: top; padding: 3px 4px; border:1px solid #0A87CD;">
                                                    <img src="<?php echo e(asset('assets/reports/checked.png')); ?>" alt="checked" height="12px">
                                                </td> -->
                                                <td style="vertical-align: top; padding: 3px 4px; border:1px solid #0A87CD;">
                                                    High Cardiovascular Endurance, High Muscular Endurance, Moderate Strength, High Speed, Moderate Flexibility
                                                </td>
                                                <td style="vertical-align: top; padding: 3px 4px; border:1px solid #0A87CD; ">
                                                    Hockey, Football, Rugby 7s
                                                </td>
                                                <td style="vertical-align: top; padding: 3px 4px; border:1px solid #0A87CD; ">
                                                    Athletics (1500m - 10,000m), Marathon, Cycling (Track/Road), Triathlon
                                                </td>
                                            </tr>
                                            <tr>
                                              <!--   <td style="vertical-align: top; padding: 3px 4px; border:1px solid #0A87CD; ">
                                                    <img src="<?php echo e(asset('assets/reports/checked.png')); ?>" alt="checked" height="12px">
                                                </td> -->
                                                <td style="vertical-align: top; padding: 3px 4px; border:1px solid #0A87CD; ">
                                                    Moderate Cardiovascular Endurance, High Strength, High Speed, Moderate Muscular Endurance, Moderate Flexibility
                                                </td>
                                                <td style="vertical-align: top; padding: 3px 4px; border:1px solid #0A87CD; ">
                                                    Kabaddi, Cricket, Kho-Kho
                                                </td>
                                                <td style="vertical-align: top; padding: 3px 4px; border:1px solid #0A87CD; ">
                                                    Athletics (100m, 200m), Weightlifting, Wrestling, Boxing
                                                </td>
                                            </tr>
                                            <tr>
                                               <!--  <td style="vertical-align: top; padding: 3px 4px; border:1px solid #0A87CD;">

                                                </td> -->
                                                <td style="vertical-align: top; padding: 3px 4px; border:1px solid #0A87CD;">
                                                    High Strength, Moderate Speed, Moderate Cardiovascular Endurance, Moderate Flexibility, Moderate Muscular Endurance
                                                </td>
                                                <td style="vertical-align: top; padding: 3px 4px; border:1px solid #0A87CD; ">
                                                    Tug of War, Rowing (Team)
                                                </td>
                                                <td style="vertical-align: top; padding: 3px 4px; border:1px solid #0A87CD; ">
                                                    Shot Put, Javelin, Hammer Throw, Wrestling, Powerlifting
                                                </td>
                                            </tr>
                                            <tr>
                                                <!-- <td style="vertical-align: top; padding: 3px 4px; border:1px solid #0A87CD; ">
                                                    <img src="<?php echo e(asset('assets/reports/checked.png')); ?>" alt="checked" height="12px">
                                                </td> -->
                                                <td style="vertical-align: top; padding: 3px 4px; border:1px solid #0A87CD; ">
                                                    High Flexibility, High Muscular Endurance, Moderate Speed, Moderate Strength, Moderate Cardiovascular Endurance
                                                </td>
                                                <td style="vertical-align: top; padding: 3px 4px; border:1px solid #0A87CD; ">
                                                    Artistic Roller Skating (Team Display), Gymnastics Team
                                                </td>
                                                <td style="vertical-align: top; padding: 3px 4px; border:1px solid #0A87CD; ">
                                                    Gymnastics, Yoga, Mallakhamb, Artistic Skating
                                                </td>
                                            </tr>
                                            <tr>
                                               <!--  <td style="vertical-align: top; padding: 3px 4px; border:1px solid #0A87CD;">

                                                </td> -->
                                                <td style="vertical-align: top; padding: 3px 4px; border:1px solid #0A87CD;">
                                                    High Speed, High Cardiovascular Endurance, Moderate Strength, Moderate Flexibility Moderate Muscular Endurance
                                                </td>
                                                <td style="vertical-align: top; padding: 3px 4px; border:1px solid #0A87CD; ">
                                                    Cricket, Hockey, Basketball, Ultimate Frisbee
                                                </td>
                                                <td style="vertical-align: top; padding: 3px 4px; border:1px solid #0A87CD; ">
                                                    Athletics (400m, 800m), Swimming (Freestyle, Backstroke), Rowing
                                                </td>
                                            </tr>
                                            <tr>
                                               <!--  <td style="vertical-align: top; padding: 3px 4px; border:1px solid #0A87CD; ">

                                                </td> -->
                                                <td style="vertical-align: top; padding: 3px 4px; border:1px solid #0A87CD; ">
                                                    Moderate in all components
                                                </td>
                                                <td style="vertical-align: top; padding: 3px 4px; border:1px solid #0A87CD; ">
                                                    Volleyball, Handball, Baseball, Basketball
                                                </td>
                                                <td style="vertical-align: top; padding: 3px 4px; border:1px solid #0A87CD; ">
                                                    Badminton, Table Tennis, Shooting, Archery, Tennis, Squash
                                                </td>
                                            </tr>
                                            <tr>
                                               <!--  <td style="vertical-align: top; padding: 3px 4px; border:1px solid #0A87CD;">

                                                </td> -->
                                                <td style="vertical-align: top; padding: 3px 4px; border:1px solid #0A87CD;">
                                                    High Muscular Endurance, High Strength, Moderate Cardiovascular Endurance, Moderate Speed, Moderate Flexibility
                                                </td>
                                                <td style="vertical-align: top; padding: 3px 4px; border:1px solid #0A87CD; ">
                                                    Rowing (Team), Kabaddi
                                                </td>
                                                <td style="vertical-align: top; padding: 3px 4px; border:1px solid #0A87CD; ">
                                                    Rowing (Single Sculls), Canoeing, Mountaineering, Rock Climbing
                                                </td>
                                            </tr>
                                            <tr>
                                              <!--   <td style="vertical-align: top; padding: 3px 4px; border:1px solid #0A87CD; ">

                                                </td> -->
                                                <td style="vertical-align: top; padding: 3px 4px; border:1px solid #0A87CD; ">
                                                    High Flexibility, High Cardiovascular Endurance, High Speed, Moderate Strength, High Muscular Endurance
                                                </td>
                                                <td style="vertical-align: top; padding: 3px 4px; border:1px solid #0A87CD; ">
                                                    Basketball, Ultimate Frisbee
                                                </td>
                                                <td style="vertical-align: top; padding: 3px 4px; border:1px solid #0A87CD; ">
                                                    Judo, Taekwondo, Karate, Fencing, Wushu, Archery, Dance Sports
                                                </td>
                                            </tr>
                                            <tr>
                                                <!-- <td style="vertical-align: top; padding: 3px 4px; border:1px solid #0A87CD; ">

                                                </td> -->
                                                <td style="vertical-align: top; padding: 3px 4px; border:1px solid #0A87CD; ">
                                                    High Flexibility, Moderate Speed, Moderate Strength, High Muscular Endurance, Moderate Cardiovascular Endurance
                                                </td>
                                                <td style="vertical-align: top; padding: 3px 4px; border:1px solid #0A87CD; ">
                                                    Gymnastics (Team), Mallakhamb
                                                </td>
                                                <td style="vertical-align: top; padding: 3px 4px; border:1px solid #0A87CD; ">
                                                    Diving, Pole Vault, Artistic Gymnastics, Yoga
                                                </td>
                                            </tr>


                                        </table>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="height: 15px;"></td>
                                </tr>
                                <tr>
                                    <td>
                                        <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0; border-collapse: collapse; border:1px solid #1c9b3e;">
                                            <tr style="background-color: #1c9b3e; color:#fff; font-size: 14px;">
                                                <th style="vertical-align: top; padding: 3px 4px; width:14%; border:1px solid #1c9b3e; text-align: left;">
                                                    Descriptor
                                                </th>
                                                <th style="vertical-align: top; padding: 3px 4px; width:18%; border:1px solid #1c9b3e; text-align: left;">
                                                    Corresponding Levels
                                                </th>
                                                <th style="vertical-align: top; padding: 3px 4px; border:1px solid #1c9b3e; text-align: left;">
                                                    Remarks
                                                </th>
                                            </tr>
                                            <tr>

                                                <td style="vertical-align: top; padding: 3px 4px; border:1px solid #1c9b3e;">
                                                    High
                                                </td>
                                                <td style="vertical-align: top; padding: 3px 4px; border:1px solid #1c9b3e;">
                                                    L6 and L7
                                                </td>
                                                <td style="vertical-align: top; padding: 3px 4px; border:1px solid #1c9b3e;">
                                                    Top 20% of performers — well above average
                                                </td>
                                            </tr>
                                            <tr>

                                                <td style="vertical-align: top; padding: 3px 4px; border:1px solid #1c9b3e;">
                                                    Moderate
                                                </td>
                                                <td style="vertical-align: top; padding: 3px 4px; border:1px solid #1c9b3e;">
                                                    L4 and L5
                                                </td>
                                                <td style="vertical-align: top; padding: 3px 4px; border:1px solid #1c9b3e;">
                                                    Between 60–80 %ile — competent range
                                                </td>
                                            </tr>
                                            <tr>

                                                <td style="vertical-align: top; padding: 3px 4px; border:1px solid #1c9b3e;">
                                                    Low
                                                </td>
                                                <td style="vertical-align: top; padding: 3px 4px; border:1px solid #1c9b3e;">
                                                    L1 to L3
                                                </td>
                                                <td style="vertical-align: top; padding: 3px 4px; border:1px solid #1c9b3e;">
                                                    Used only for identifying gaps or support needs
                                                </td>
                                            </tr>

                                        </table>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="height: 15px;"></td>
                                </tr>
                                <tr>
                                    <td>
                                        <table border="1" cellpadding="0" cellspacing="0" style="width: 100%; border: 1px solid #0A87CD; font-size: 12px; border-collapse: collapse; color:#000;">
                                            <tr style="background-color: #0A87CD;">
                                                <td style="padding: 5px 10px; font-weight: bold; color:#fff; font-size: 14px;" colspan="8">Fitness Benchmarks for <?php echo e($age); ?> years <?php echo e($gender); ?></td>
                                            </tr>
                                            <tr style="font-weight: bold; background-color: #fecd0a; font-size: 12px; color: #000;">
                                                <td style="padding: 4px;"></td>
                                                <td style="padding: 4px;">L1 (Very Low)</td>
                                                <td style="padding: 4px;">L2 (Low)</td>
                                                <td style="padding: 4px;">L3 (Developing)</td>
                                                <td style="padding: 4px;">L4 (Moderate)</td>
                                                <td style="padding: 4px;">L5 (Good)</td>
                                                <td style="padding: 4px;">L6 (High)</td>
                                                <td style="padding: 4px;">L7 (Excellent)</td>
                                            </tr>
                                            <tr style="background-color: #fff6d1; font-weight: 500; color:#333;">
                                                <td style="padding: 4px;"></td>
                                                <td style="padding: 4px;">
                                                    < 20 %ile</td>
                                                <td style="padding: 4px;">≥ 20 %ile</td>
                                                <td style="padding: 4px;">≥ 40 %ile</td>
                                                <td style="padding: 4px;">≥ 60 %ile</td>
                                                <td style="padding: 4px;">≥ 70 %ile</td>
                                                <td style="padding: 4px;">≥ 80 %ile</td>
                                                <td style="padding: 4px;">≥ 90 %ile</td>
                                            </tr>


                                          
                                            <?php $__empty_1 = true; $__currentLoopData = $getFitnessBenchmark; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $skillname): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <tr>            
                                                <td style="padding: 4px; font-weight: bold; color: #000;"><?php echo e($skillname->skill_name); ?></td>
                                                <?php $__currentLoopData = $skillname->ranges; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $level => $range): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <td style="padding: 4px;"><?php echo e($range); ?></td>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                 <tr>                                                  
                                                    <td style="padding: 4px;" colspan="8"> 
                                                       <p style="text-align:center;"> <span style="padding: 4px; font-weight: bold; color: #000;">Note : </span> No Fitness Benchmarks available for a <?php echo e($age); ?>-year-old <?php echo e($gender); ?> in <?php echo e($studentsData->class); ?> </p>
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
                                        <table border="1" cellpadding="0" cellspacing="0" style="width: 100%; border: 1px solid #0A87CD; font-size: 14px; border-collapse: collapse; color:#fff; text-align:left;">
                                            <tr style="background-color: #0A87CD;">
                                                <td style="padding: 5px 10px; font-weight: bold; color:#fff; font-size: 16px;" colspan="8">BMI Benchmarks for <?php echo e($age); ?> years <?php echo e($gender); ?></td>
                                            </tr>
                                            <tr style="font-weight: bold; background-color: #fecd0a; font-size: 12px; color: #000;  text-align:center;">
                                                <td style="padding: 5px 10px;">UW</td>
                                                <td style="padding: 5px 10px;">N</td>
                                                <td style="padding: 5px 10px;">OW</td>
                                                <td style="padding: 5px 10px;">OB</td>
                                            </tr>
                                            
                                            
                                            <?php if(is_array($getBmiBenchmark) && count($getBmiBenchmark) > 0): ?>
                                            <tr style="text-align:center;">
                                                <td style="padding: 5px 10px; color: #000;"><?php echo e($getBmiBenchmark['UW'] ?? 'N/A'); ?></td>
                                                <td style="padding: 5px 10px; color: #000;"><?php echo e($getBmiBenchmark['N'] ?? 'N/A'); ?></td>
                                                <td style="padding: 5px 10px; color: #000;"><?php echo e($getBmiBenchmark['OW'] ?? 'N/A'); ?></td>
                                                <td style="padding: 5px 10px; color: #000;"><?php echo e($getBmiBenchmark['OB'] ?? 'N/A'); ?></td>
                                            </tr>
                                            <?php endif; ?>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="height: 15px;"></td>
                                </tr>

                            </table>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
       

        <tr>
                                    <td>
                                        <table border="0" cellpadding="0" cellspacing="0" style="width:100%;">
                                            <tr>
                                                <td style="height: 30px;"></td>
                                                <td style="height: 30px;"></td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: right;">
                                                    <table cellpadding="0" cellspacing="0" style="border: 0px; width: 100%;">
                                                        <tr>
                                                            <td style="height: 20px;"></td>
                                                            <td style="height: 20px;"></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="text-align:left; padding: 0px 0px 0px 30px;">
                                                                <div style="float:left; text-align:center; position:relative;">
                                                                    <p style="color:#666; font-size:10px; position:absolute; top:-17px; width:100%; text-align:center;">powered  by</p>
                                                                    <img src="<?php echo e(asset('public/assets/reports/fitness365-logo-web.png')); ?>" alt="fitness365 logo" style="height:28px;">
                                                                </div> 
                                                            </td>

                                                            <td style="font-weight: 400; font-size: 13px; color:#666; text-align:right;">
                                                                Physical Health and Fitness Assessment
                                                            </td>
                                                            
                                                        </tr>

                                                    </table>
                                                </td>

                                                <td style="width:74px;">
                                                    <div style="float: right; position: relative; width: 60px;">
                                                        <span style="position: absolute; left: 50%; top:50%; transform: translate(-50%, 0); color: #fff; z-index: 1; display: inline-block; padding: 2px 20px 0 0px; font-size: 13px; font-weight: 600;"></span>
                                                        <img src="<?php echo e(asset('public/assets/reports/footer-bg2.png')); ?>" alt="" style="width: inherit;">
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td style="height: 15px;"></td>
                                            </tr>
                                        </table>
                                    </td>
                    </tr>


        <!-- Page 4 -->
        <tr>
            <td style="vertical-align: top; height: 1032px;">
                <table border="1" cellpadding="0" cellspacing="0" style="page-break-before: always; width: 100%; border-collapse: collapse; font-family: Roboto Condensed, sans-serif; font-size: 12px; border:0px solid transparent;">
                    <!-- Inner page Header Area (Page 4) -->
                    <tr style="height: 100px;">
                        <td style="vertical-align: top;">
                            <table cellpadding="0" cellspacing="0" style="width: 100%; height: 100%; border:0;">
                                <tr>

                                    <!-- <td style="width:300px;">
                                        <div style="margin-left: 30px; margin-top: 30px;">
                                            School Logo
                                        </div>
                                    </td> -->

                                    <td style="position: relative; vertical-align: top; width: 360px; height: 100%; " >                               
                                        <?php if(!empty($studentsData->logo)): ?>                                        
                                            <div style="position: absolute; top: 30px; left:30px; display: flex; align-items: center; z-index: 1; overflow: hidden;">
                                                <img src="<?php echo e(asset('public/assets/uploads/logos/' . $GetSchoolLogo->logo)); ?>" alt="" style="width: auto; height: 50px; object-fit: contain;">
                                            </div>
                                        <?php else: ?>
                                            <div style="position: absolute; top: 30px; left:30px; display: flex; align-items: center; z-index: 1; overflow: hidden;">
                                                <img src="<?php echo e(asset('public/assets/uploads/logos/default_school-logo.png' )); ?>" alt="" style="width: auto; height: 50px; object-fit: contain;">
                                            </div>
                                        <?php endif; ?>
                                    </td>

                                    <td rowspan="2" style="position: relative; vertical-align: top; width: auto; height: 100%; text-align: right;">
                                        <div style="position: absolute; top: 30px; right:30px; display: flex; align-items: center; z-index: 1; width: 90px; overflow: hidden;">
                                            <img src="<?php echo e(asset('/public/assets/reports/seqfast-logo.png')); ?>" alt="" style="width: inherit;">
                                        </div>
                                        <img src="<?php echo e(asset('/public/assets/reports/inner-header-bg.png')); ?>" alt="" style="width: 450px; height:auto; position: relative; right:0px; top:0;">
                                    </td>

                                </tr>
                            </table>
                        </td>

                    </tr>
                    <!-- Inner page Content (Page 4) -->
                    <tr>
                        <td>
                            <table cellpadding="0" cellspacing="0" style="width: 94%; border: 0; border-collapse: collapse; margin: auto; color: #333; font-size: 12px;">
                                <tr>
                                    <td style="border: 1px solid #00A923; padding: 10px 15px 8px 15px; background:#F2FFF5;">
                                        <h3 style="color: #00A923; margin-bottom: 6px; font-size: 18px;">WHO Guidelines on Physical Activity and Sedentary Behaviour 2020</h3>
                                        <h4 style="color: #000; margin-bottom: 5px; font-size: 16px">Age Appropriate Fitness Protocols and Guidelines for age 5-18 years</h4>
                                        <p style="line-height: 1.25rem;">At least an average of 60 minutes per day of moderate-to-vigorous intensity physical activity, across the week; most of this physical activity should be aerobic.</p>
                                        <p style="line-height: 1.25rem;">Vigorous-intensity aerobic activities, as well as those that strengthen muscle and bone should be incorporated at least 3 days a week.</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="height: 15px;"></td>
                                </tr>

                                <tr>
                                    <td>
                                        <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0; border-collapse: collapse;">
                                            <tr>
                                                <td colspan="2">
                                                    <h3 style="color: #000; font-size: 16px; margin-bottom: 5px;">Recommends the following activities for improving fitness for ages 9-14 (Class 4-8)</h3>
                                                    <!-- <p>The focus is on the development of key Fundamental Movement Skills which are required for life. Fit India recommends the following activities for improvement of fitness for the 5-8 age groups:</p> -->
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="height: 6px;"></td>
                                            </tr>
                                            <tr>
                                                 <td style="width: 50%; padding-right: 30px;">
                                                    <h4 style="color: #000; margin-bottom: 5px; font-size: 14px;">1. Endurance-related Activities</h4>
                                                    <p>Spot Running, Climbing Stairs, Walking on Toes, Swimming, Jumping Jacks, March and Swing Your Arms</p>
                                                </td>
                                                 <td style="width: 50%;">
                                                    <h4 style="color: #000; margin-bottom: 5px; font-size: 14px;">2. Strength Related Activities</h4>
                                                    <p>Straight Leg Raises, Push-ups on the Wall, Long Jump, Goal Keeping</p>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td style="height: 10px;"></td>
                                            </tr>
                                            <tr>
                                                 <td style="width: 50%; padding-right: 30px;">
                                                    <h4 style="color: #000; margin-bottom: 5px; font-size: 14px;">3. Flexibility-related Activities</h4>
                                                    <p>Calf Stretch, Child's Pose, Knee to Chest, Bend Down</p>
                                                </td>
                                                 <td style="width: 50%;">
                                                    <h4 style="color: #000; margin-bottom: 5px; font-size: 14px;">4. Balance related Activities</h4>
                                                    <p>Single Leg Stance, Leg Swings, Walking on Lines of Different Shapes</p>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>

                                </tr>
                                <tr>
                                    <td style="height: 30px;"></td>
                                </tr>
                                <tr>
                                    <td>
                                        <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0; border-collapse: collapse;">
                                            <tr>
                                                <td colspan="2">
                                                    <h3 style="color: #000; font-size: 16px; margin-bottom: 10px;">Recommends the following additional activities for improving fitness for for ages 15-18 (Class 9-12)</h3>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding-right: 30px;">
                                                    <h4 style="color: #000; margin-bottom: 5px; font-size: 14px;">1. Endurance-related Activities</h4>
                                                    <p>400/800 m Race, Brisk Walking, Quick Air Punches, 4x 100 / 200 / 400 m Relay Race, Swimming, Walking Lunges</p>
                                                </td>
                                                <td>
                                                    <h4 style="color: #000; margin-bottom: 5px; font-size: 14px;">2. Strength related Activities</h4>
                                                    <p>Curl Up (Core Strength), Plank (Core Strength), Push Ups (Upper Body Strength), Squat (Lower Body Strength)s</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="height: 15px;"></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <h4 style="color: #000; margin-bottom: 5px; font-size: 14px;">3. Flexibility-related Activities</h4>
                                                    <p>Forward Bend</p>
                                                </td>

                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="height: 30px;"></td>
                                </tr>

                                <tr>
                                    <td>
                                        <h2 style="font-size: 24px; color:#0A87CD; font-size: 18px; font-weight: 600; text-align: center;">EXERCISE AND PHYSICAL ACTIVITY</h2>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-size: 18px; color:#000; font-size: 16px; font-weight: 500; text-align: center;">
                                        <p>* Energy expenditure on various physical activities (Kcal/Hr)</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="height: 15px;"></td>
                                </tr>

                                <tr>
                                    <td>
                                        <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0; border-collapse: collapse;">
                                            <tr>
                                                <td style="vertical-align: top;" colspan="3">
                                                    <div style="display: flex; gap: 5px;">
                                                        <table border="1" cellpadding="0" cellspacing="0" style="width: 220px; border: 1px solid #0A87CD; font-size: 12px; border-collapse: collapse; color:#333;">
                                                            <tr style="background-color: #0A87CD;">
                                                                <td style="width: 155px; background-color:#0A87CD; padding: 3px 4px; border: 1px solid #0A87CD; color:#fff; font-weight: bold;" colspan="2">Activity</td>
                                                                <td style="padding: 3px 4px; border: 1px solid #0A87CD; color:#fff; text-align: right; font-weight: bold;">Kcal/hr</td>
                                                            </tr>
                                                            <tr>
                                                                <td style="font-weight: 500; color:#000; text-align: left; padding: 3px 4px;">Sleeping</td>
                                                                <td style="text-align: right; padding: 3px 4px; border-left: 1px solid transparent;"></td>
                                                                <td style="text-align: right; padding: 3px 4px; border-bottom: 1px solid transparent;">44</td>
                                                            </tr>
                                                            <tr>
                                                                <td style="font-weight: 500; color:#000; text-align: left; padding: 3px 4px;">Sitting</td>
                                                                <td style="text-align: right; padding: 3px 4px; border-left: 1px solid transparent;"></td>
                                                                <td style="text-align: right; padding: 3px 4px; border-bottom: 1px solid transparent;">57</td>
                                                            </tr>
                                                            <tr>
                                                                <td style="font-weight: 500; color:#000; text-align: left; padding: 3px 4px;">Standing</td>
                                                                <td style="text-align: right; padding: 3px 4px; border-left: 1px solid transparent;"></td>
                                                                <td style="text-align: right; padding: 3px 4px; border-bottom: 1px solid transparent;">63</td>
                                                            </tr>
                                                            <tr>
                                                                <td style="font-weight: 500; color:#000; text-align: left; padding: 3px 4px;">Walking</td>
                                                                <td style="text-align: right; padding: 3px 4px; border-left: 1px solid transparent;">6.43 km/hr</td>
                                                                <td style="text-align: right; padding: 3px 4px; border-bottom: 1px solid transparent;">227</td>
                                                            </tr>
                                                            <tr>
                                                                <td style="font-weight: 500; color:#000; text-align: left; padding: 3px 4px;">Climbing Stairs</td>
                                                                <td style="text-align: right; padding: 3px 4px; border-left: 1px solid transparent;"></td>
                                                                <td style="text-align: right; padding: 3px 4px; border-bottom: 1px solid transparent;">485</td>
                                                            </tr>
                                                            <tr>
                                                                <td style="font-weight: 500; color:#000; text-align: left; padding: 3px 4px;">Housecleaning</td>
                                                                <td style="text-align: right; padding: 3px 4px; border-left: 1px solid transparent;"></td>
                                                                <td style="text-align: right; padding: 3px 4px; border-bottom: 1px solid transparent;">176</td>
                                                            </tr>
                                                            <tr>
                                                                <td style="font-weight: 500; color:#000; text-align: left; padding: 3px 4px;">Gardening</td>
                                                                <td style="text-align: right; padding: 3px 4px; border-left: 1px solid transparent;"></td>
                                                                <td style="text-align: right; padding: 3px 4px;">227</td>
                                                            </tr>
                                                        </table>

                                                        <table border="1" cellpadding="0" cellspacing="0" style="width: 200px; border: 1px solid #0A87CD; font-size: 12px; border-collapse: collapse; color:#333;">
                                                            <tr style="background-color: #0A87CD;">
                                                                <td style="width:165px; background-color:#0A87CD; padding: 3px 4px; border: 1px solid #0A87CD; color:#fff; font-weight: bold;" colspan="2">Activity</td>
                                                                <td style="padding: 3px 4px; border: 1px solid #0A87CD; color:#fff; text-align: right; font-weight: bold;">Kcal/hr</td>
                                                            </tr>
                                                            <tr>
                                                                <td style="font-weight: 500; color:#000; text-align: left; padding: 3px 4px;">Cycling</td>
                                                                <td style="text-align: right; padding: 3px 4px; border-left: 1px solid transparent;">City cycling</td>
                                                                <td style="text-align: right; padding: 3px 4px; border-bottom: 1px solid transparent;">302</td>
                                                            </tr>
                                                            <tr>
                                                                <td style="font-weight: 500; color:#000; text-align: left; padding: 3px 4px;"></td>
                                                                <td style="text-align: right; padding: 3px 4px; border-left: 1px solid transparent;">16.1 km/hr </td>
                                                                <td style="text-align: right; padding: 3px 4px; border-bottom: 1px solid transparent;">391</td>
                                                            </tr>
                                                            <tr>
                                                                <td style="font-weight: 500; color:#000; text-align: left; padding: 3px 4px;"></td>
                                                                <td style="text-align: right; padding: 3px 4px; border-left: 1px solid transparent;">22.53 km/hr</td>
                                                                <td style="text-align: right; padding: 3px 4px; border-bottom: 1px solid transparent;">567</td>
                                                            </tr>
                                                            <tr>
                                                                <td style="font-weight: 500; color:#000; text-align: left; padding: 3px 4px;"></td>
                                                                <td style="text-align: right; padding: 3px 4px; border-left: 1px solid transparent;">32.18 km/hr</td>
                                                                <td style="text-align: right; padding: 3px 4px; border-bottom: 1px solid transparent;">932</td>
                                                            </tr>
                                                            <tr>
                                                                <td style="font-weight: 500; color:#000; text-align: left; padding: 3px 4px;">Running</td>
                                                                <td style="text-align: right; padding: 3px 4px; border-left: 1px solid transparent;">8 km/hr</td>
                                                                <td style="text-align: right; padding: 3px 4px; border-bottom: 1px solid transparent;">523</td>
                                                            </tr>
                                                            <tr>
                                                                <td style="font-weight: 500; color:#000; text-align: left; padding: 3px 4px;"></td>
                                                                <td style="text-align: right; padding: 3px 4px; border-left: 1px solid transparent;">10 km/hr</td>
                                                                <td style="text-align: right; padding: 3px 4px; border-bottom: 1px solid transparent;">617</td>
                                                            </tr>
                                                            <tr>
                                                                <td style="font-weight: 500; color:#000; text-align: left; padding: 3px 4px;"></td>
                                                                <td style="text-align: right; padding: 3px 4px; border-left: 1px solid transparent;">13 km/hr</td>
                                                                <td style="text-align: right; padding: 3px 4px;">743</td>
                                                            </tr>
                                                        </table>

                                                        <table border="1" cellpadding="0" cellspacing="0" style="width: 170px; border: 1px solid #0A87CD; font-size: 12px; border-collapse: collapse; color:#333;">
                                                            <tr style="background-color: #0A87CD;">
                                                                <td style="width:135px; background-color:#0A87CD; padding: 3px 4px; border: 1px solid #0A87CD; color:#fff; font-weight: bold;">Activity</td>
                                                                <td style="font-weight: 500; padding: 3px 4px; border: 1px solid #0A87CD; color:#fff; text-align: right; font-weight: bold;">Kcal/hr</td>
                                                            </tr>
                                                            <tr>
                                                                <td style="font-weight: 500; color:#000; text-align: left; padding: 3px 4px;">Billiards/ Snooker</td>
                                                                <td style="text-align: right; padding: 3px 4px; border-bottom: 1px solid transparent;">176</td>
                                                            </tr>
                                                            <tr>
                                                                <td style="font-weight: 500; color:#000; text-align: left; padding: 3px 4px;">Roller Skating</td>
                                                                <td style="font-weight: 500; text-align: right; padding: 3px 4px; border-bottom: 1px solid transparent;">365</td>
                                                            </tr>
                                                            <tr>
                                                                <td style="font-weight: 500; color:#000; text-align: left; padding: 3px 4px;">Swimming</td>
                                                                <td style="font-weight: 500; text-align: right; padding: 3px 4px; border-bottom: 1px solid transparent;">302</td>
                                                            </tr>
                                                            <tr>
                                                                <td style="font-weight: 500; color:#000; text-align: left; padding: 3px 4px;">Horseback Riding</td>
                                                                <td style="font-weight: 500; text-align: right; padding: 3px 4px; border-bottom: 1px solid transparent;">202</td>
                                                            </tr>
                                                            <tr>
                                                                <td style="font-weight: 500; color:#000; text-align: left; padding: 3px 4px;">Squash</td>
                                                                <td style="font-weight: 500; text-align: right; padding: 3px 4px; border-bottom: 1px solid transparent;">491</td>
                                                            </tr>
                                                            <tr>
                                                                <td style="font-weight: 500; color:#000; text-align: left; padding: 3px 4px;">Badminton</td>
                                                                <td style="font-weight: 500; text-align: right; padding: 3px 4px; border-bottom: 1px solid transparent;">441</td>
                                                            </tr>
                                                            <tr>
                                                                <td style="font-weight: 500; color:#000; text-align: left; padding: 3px 4px;">Table Tennis</td>
                                                                <td style="font-weight: 500; text-align: right; padding: 3px 4px;">277</td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                    <p style="font-size: 12px; margin-top: 5px; line-height: 1.15rem;">*Approx.energy expenditure for 60 Kg reference man. Individuals with higher body weight will be spending more calories than those with lower body weight. Reference woman (50 kg) will be spending 5% less calories</p>
                                                </td>

                                                <td style="vertical-align: top;">
                                                    <div style="display: flex; gap: 5px;">
                                                        <table border="1" cellpadding="0" cellspacing="0" style="width: 140px; border: 1px solid #0A87CD; font-size: 12px; border-collapse: collapse; color:#333;">
                                                            <tr style="background-color: #0A87CD;">
                                                                <td style="width: 125px; background-color:#0A87CD; padding: 3px 4px; border: 1px solid #0A87CD; color:#fff; font-weight: bold;">Activity</td>
                                                                <td style="font-weight: 500; padding: 3px 4px; border: 1px solid #0A87CD; color:#fff; text-align: right; font-weight: bold;">Kcal/hr</td>
                                                            </tr>
                                                            <tr>
                                                                <td style="font-weight: 500; color:#000; text-align: left; padding: 3px 4px; ">Tennis</td>
                                                                <td style="font-weight: 500; text-align: right; padding: 3px 4px; border-bottom: 1px solid transparent;">353</td>
                                                            </tr>
                                                            <tr>
                                                                <td style="font-weight: 500; color:#000; text-align: left; padding: 3px 4px;">Volleyball</td>
                                                                <td style="font-weight: 500; text-align: right; padding: 3px 4px; border-bottom: 1px solid transparent;">252</td>
                                                            </tr>
                                                            <tr>
                                                                <td style="font-weight: 500; color:#000; text-align: left; padding: 3px 4px;">Football</td>
                                                                <td style="font-weight: 500; text-align: right; padding: 3px 4px; border-bottom: 1px solid transparent;">441</td>
                                                            </tr>
                                                            <tr>
                                                                <td style="font-weight: 500; color:#000; text-align: left; padding: 3px 4px;">Basketball</td>
                                                                <td style="font-weight: 500; text-align: right; padding: 3px 4px; border-bottom: 1px solid transparent;">403</td>
                                                            </tr>
                                                            <tr>
                                                                <td style="font-weight: 500; color:#000; text-align: left; padding: 3px 4px;">Dancing</td>
                                                                <td style="font-weight: 500; text-align: right; padding: 3px 4px; border-bottom: 1px solid transparent;">302</td>
                                                            </tr>
                                                            <tr>
                                                                <td style="font-weight: 500; color:#000; text-align: left; padding: 3px 4px;">Gymnastic</td>
                                                                <td style="font-weight: 500; text-align: right; padding: 3px 4px; border-bottom: 1px solid transparent;">202</td>
                                                            </tr>
                                                            <tr>
                                                                <td style="font-weight: 500; color:#000; text-align: left; padding: 3px 4px;">Yoga</td>
                                                                <td style="font-weight: 500; text-align: right; padding: 3px 4px;">195</td>
                                                            </tr>
                                                            <tr>
                                                                <td style="font-weight: 500; color:#000; text-align: left; padding: 3px 4px;">HIIT Workout</td>
                                                                <td style="font-weight: 500; text-align: right; padding: 3px 4px;">504</td>
                                                            </tr>
                                                        </table>
                                                    </div>
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
                                        <table border="1" cellpadding="0" cellspacing="0" style="width: 100%; border: 1px solid orange; font-size: 14px; border-collapse: collapse; color:#333;">
                                            <tr>
                                                <td style="padding: 10px 15px; font-size: 14px; color: #000; height:100px; vertical-align:top;">
                                                    <h4 style="font-weight: 600;">PE Teacher's Observations and Comments (if any)</h4>
                                                    

                                                    <p style="padding-top:5px; font-size:13px;">

                                                        <!-- Report Summary -->
                                                    </p>
                                                  

                                                </td>
                                                <!-- <td style="font-weight: 600; padding: 10px 15px; font-size: 14px; color: #000; text-align:center; height:100px; vertical-align:bottom;">Issuer's Signature</td> -->
                                            </tr>
                                            
                                        </table>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <table border="0" cellpadding="0" cellspacing="0" style="width: 100%; font-size: 14px; border-collapse: collapse; color:#000;">
                                            <tr>
                                                <td style="border: 1px solid transparent; width:50%; height: 90px; position:relative;">
                                                    <div style="margin: 10px 0 0 0; text-align:center;">
                                                        <img src="<?php echo e(asset('/public/assets/imgs/rashmi_stamp.jpg')); ?>" alt="" style="height: 70px;">
                                                    </div>
                                                    <p style="text-align: center; font-weight: 600;">Issued by</p>
                                                </td>
                                                
                                                <td style="border: 1px solid transparent; width:50%;">
                                                    <?php if($studentsData->signature): ?>
                                                        <div style="margin: 10px 0 0 0; text-align:center;">
                                                            <img src="<?php echo e(asset('public/assets/uploads/signatures/' . $studentsData->signature)); ?>" alt="" style="height: 70px;">
                                                        </div>
                                                    <?php endif; ?>
                                                    <p style="text-align: center; font-weight: 600;">Signature of Principal with Stamp</p>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="height: 10px;"></td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
        <!-- Inner page Footer Area (Page 4) -->
        <tr>
            <td>
                <table cellpadding="0" cellspacing="0" style="width: 100%; border:0;">
                                <tr>
                                    <td style="background-color: #E60A00; height: 30px; padding: 0 30px; color:#fff;">Physical Health and Fitness Assessment</td>
                                    <td style="background-color: #00A923; height: 30px; width: 30%; padding: 0 30px; text-align:right; color:#fff;">Powered by fitness365.me</td>
                                </tr>
                            </table>
            </td>
        </tr>
    </table>

</body>

</html><?php /**PATH C:\xampp\htdocs\nep\resources\views/assessor/reports/senior-report.blade.php ENDPATH**/ ?>