<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Health and Activity Record</title>

    <style>
        body {
            border: 2px solid #000;
            margin: 0;
            padding: 0;
        }
        header h3 {
            margin: 20px 0;
        }
        table th, table td {
            text-align: left;
            vertical-align: middle;
        }
        .table-container {
            overflow-x: auto;
            margin: 0;
            padding: 0;
        }
        .wrapper{
            margin-left: 0;
            margin-right: 0;
            text-align: center;
            max-width: 100%;
            padding: 0;
        }
        .container {
            max-width: 100%;
            padding-right: 0;
            padding-left: 0;
        }
        .table-responsive-sm {
            margin-bottom: 0;
        }
        .score{
            text-align: center;
        }
    </style>
</head>

<body class="text-center" id="content-to-download">
    <?php  $GetSchoolLogo = Helper::GetSchoolLogo();  ?>
<table cellpadding="0" cellspacing="0" style="width: 29.7cm; border-collapse: collapse; margin-left: auto; margin-right: auto; font-family: Roboto Condensed, sans-serif; font-size: 12px; border: 0px; background-color: #fff;">
    <!-- Cover Page -->
    <tr>
        <td>
            <table cellpadding="0" cellspacing="0" style="width: 100%; border-collapse: collapse; font-family: Roboto Condensed, sans-serif; font-size: 12px; border: 0;">
                <tr style="background-color: #0A87CD; height: 140px;">
                    <td style="vertical-align: top;">
                        <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0px; height: 100%;">
                            <tr>
                                <td style="width: 240px;"></td>
                                <td style="position: relative; vertical-align: top; width: 250px; height: 100%;">
                                    <img src="<?php echo e(asset('/public/assets/reports/yellow-dot.png')); ?>" alt="" style="width: 50px; height:50px; position: relative; left:-50px; top:0;">
                                    <div style="position: absolute; top: 0; display: flex; align-items: flex-start; z-index: 10; width: 250px; overflow: hidden;">
                                        <div class="logo" style="position: relative; width: inherit;">
                                            <span style="position: absolute; top:0; left:0; width: inherit; padding: 20px; box-sizing: border-box; display:inline-block;">
                                                <img src="<?php echo e(asset('/public/assets/reports/seqfast-logo.png')); ?>" alt="" style="width: 160px; margin-top: 10px;">
                                            </span>
                                            <img src="<?php echo e(asset('/public/assets/reports/logo-bg.jpg')); ?>" alt="" style="width: 250px; margin-top: -50px;">
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div style="margin-left: 50px; margin-right: 150px; margin-top: 40px; font-weight: 600; font-size: 26px; color:#fff; text-transform: uppercase;">Health and Activity Report Card</div>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td style="border-collapse: collapse;">
                        <div style="width: 100%; position: relative; border-collapse: collapse;">
                            <img src="<?php echo e(asset('public/assets/reports/report-graphic.png')); ?>" alt="" style="position: absolute; top:25%; right:50px; width: 200px; border-collapse: collapse;">
                            <img src="<?php echo e(asset('public/assets/reports/report-cover-img.png')); ?>" alt="" style="width: 85%;">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0;">
                            <tr>
                               <td style="background-color:#FBCA01;">
                                    <div style="position:relative;">
                                        <span style="position:absolute; top:-38px; background:rgb(0 0 0/50%); padding:10px; width:100%; z-index:2; box-sizing: border-box; text-align:center; color:#fff; font-size:16px; text-transform: uppercase;">For Senoir</span>
                                        <img src="<?php echo e(asset('/public/assets/reports/aa-bg.png')); ?>" alt="" style="width:198px; position: relative; top: -3px;">
                                    </div>
                                </td>
                                <td style="vertical-align: top; width: 100%;">
                                    <table cellpadding="0" cellspacing="0" style="width: 95%; border: 0;">
                                        <tr>
                                            <td style="height:30px;"></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img src="<?php echo e(asset('public/assets/uploads/logos/' . $GetSchoolLogo->logo)); ?>" alt="" style="width: auto; object-fit: contain; padding: 0px 0px 5px 46px; height: 100px;">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="height:20px;"></td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 10px 30px 10px 50px; font-size: 24px; background:#E60A00; color:#fff; font-weight: 500; position:relative;">Personal Profile
                                                <span style="position:absolute; top:46px; right:-20px;">
                                                    <img src="<?php echo e(asset('/public/assets/reports/green-bg.jpg')); ?>" alt="" style="width:20px;">
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="height:20px;"></td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 10px 30px 10px 50px; font-size: 16px; color: #333;">
                                                <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0px">
                                                    <!-- Name & Class -->
                                                    <tr>
                                                        <td colspan="2" style="padding: 6px 0;">
                                                            <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0px">
                                                                <tr>
                                                                    <td style="padding: 0px 0px 2px 0px;">Name</td>
                                                                    <td style="border-bottom: 1px solid #ccc; width: 100%; text-align: center; font-weight: 600; padding: 2px 0px; text-transform:uppercase;"><?php echo e($studentsData->student_name); ?></td>
                                                                    <td style="padding: 0px 0px 2px 0px;">Class & Section</td>
                                                                    <td style="border-bottom: 1px solid #ccc; width: 100%; text-align: center; font-weight: 600; padding: 2px 0px;"><?php echo e($studentsData->display_classname); ?>-<?php echo e($studentsData->section); ?></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <!-- Roll No & Registration No -->
                                                    <tr>
                                                        <td colspan="2" style="padding: 6px 0;">
                                                            <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0px;">
                                                                <tr>
                                                                    <td style="padding: 0px 0px 2px 0px;">Roll No.</td>
                                                                    <td style="border-bottom: 1px solid #ccc; width: 100%; text-align: center; font-weight: 600; padding: 2px 0px;"><?php echo e($studentsData->rollno ?? ''); ?></td>
                                                                    <td style="padding: 0px 0px 2px 0px;">Registration No</td>
                                                                    <td style="border-bottom: 1px solid #ccc; width: 100%; text-align: center; font-weight: 600; padding: 2px 0px;"><?php echo e($studentsData->admissionnumber); ?></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <!-- DOB & Gender -->
                                                    <tr>
                                                        <td colspan="2" style="padding: 6px 0;">
                                                            <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0px;">
                                                                <?php
                                                                    use Carbon\Carbon;
                                                                    $dob = Carbon::parse($studentsData->dob); 
                                                                    $formattedDob = $dob->format('d M Y'); 
                                                                    $age = $dob->age; 
                                                                    $gender = strtolower($studentsData->gender) === 'male' ? 'Boy' : 'Girl';
                                                                ?>
                                                                <tr>
                                                                    <td>DOB</td>
                                                                    <td style="border-bottom: 1px solid #ccc; text-align:center; font-weight:600;"><?php echo e($formattedDob); ?> (<?php echo e($age); ?> Years)</td>
                                                                    <td>Gender</td>
                                                                    <td style="border-bottom: 1px solid #ccc; text-align:center; font-weight:600;"><?php echo e($gender); ?></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <!-- School & Code -->
                                                    <tr>
                                                        <td colspan="2" style="padding: 6px 0;">
                                                            <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0px;">
                                                                <tr>
                                                                    <td>School</td>
                                                                    <td style="border-bottom: 1px solid #ccc; text-align:center; font-weight:600;"><?php echo e($studentsData->school_name); ?></td>
                                                                    <td>Code</td>
                                                                    <td style="border-bottom: 1px solid #ccc; text-align:center; font-weight:600;"><?php echo e($studentsData->school_code); ?></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <!-- APAAR ID -->
                                                    <tr>
                                                        <td colspan="2" style="padding: 6px 0;">
                                                            <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0px;">
                                                                <tr>
                                                                    <td>APAAR ID (Optional)</td>
                                                                    <td style="border-bottom: 1px solid #ccc; text-align:center; font-weight:600;"><?php echo e($studentsData->apaarId ?? ''); ?></td>
                                                                    <td>&nbsp;</td>
                                                                    <td>&nbsp;</td>
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
            </table>
        </td>
    </tr>
</table>


    <div class="container py-4 wrapper">

        <header class="border p-1 mx-3">
            <h3 class="text-center">HEALTH AND ACTIVITY RECORD</h3>
        </header>

        <?php
        
            $testMap = [
                'BMI' => 'BMI',
                'Partial Curl up' => 'Partial curl up 30 sec',
                'Flexed/Bent Arm Hang' => 'Flexed/Bent Arm Hang',
                'Sit and Reach' => 'Sit and Reach Test',
                '600 Mtr Run' => '600 meter run/walk',
                'Flamingo Balance Test' => 'Flamingo Balance Test',
                'Shuttle Run' => 'Shuttle Run (4×10 m)',
                'Sprint / Dash' => '50 mt. dash',
                'Standing Vertical Jump' => 'Vertical Jump',
                'Plate Tapping' => 'Plate Tapping',
                'Alternative Hand Wall Toss Test' => 'Alternative Hand Wall Toss Test',
            ];
            $classList = [9,10,11,12];
        ?>

        <?php
            function getScore($groupedReport, $dbTestName) {
                foreach ($groupedReport as $categoryData) {
                    foreach ($categoryData as $item) {
                        if (strtolower($item['Test_Name']) == strtolower($dbTestName)) {
                            if($dbTestName == 'BMI'){
                                return $item['Level'] ?? '--';
                            }else{
                                return $item['score'] ?? '--';
                            }
                        }
                    }
                }
                return '--';
            }
        ?>




        <div class="table-container m-3">
            <table class="table table-bordered table-responsive-sm">
                <thead class="thead-light">
                    <tr>
                        <th>Fitness Components</th>
                        <th colspan="2">Fitness Parameters</th>
                        <th>Test Name</th>
                        <th>What does it Measure</th>
                        <th>Class 9th</th>
                        <th>Class 10th</th>
                        <th>Class 11th</th>
                        <th>Class 12th</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td rowspan="6">Health Components</td>
                        <td>Body Composition</td>
                        <td></td>
                        <td>BMI</td>
                        <td>Body Mass Index for specific Age and Gender</td>
                        <?php $__currentLoopData = $classList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <td>
                                <p class="score"><?php echo e($studentsData->class_id == $class ? getScore($groupedReport, $testMap['BMI']) : '--'); ?></p>
                            </td>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tr>

                    <tr>
                        <td rowspan="2">Muscular Strength</td>
                        <td>Core</td>
                        <td>Partial Curl up</td>
                        <td>Abdominal Muscular Endurance</td>
                        <?php $__currentLoopData = $classList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <td>
                                <p class="score"><?php echo e($studentsData->class_id == $class ? getScore($groupedReport, $testMap['Partial Curl up']) : '--'); ?></p>
                            </td>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </tr>

                    <tr>
                        <td>Upper Body</td>
                        <td>Flexed/Bent Arm Hang</td>
                        <td>Muscular Endurance / Functional Strength</td>
                        <?php $__currentLoopData = $classList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <td>
                                <p class="score"><?php echo e($studentsData->class_id == $class ? getScore($groupedReport, $testMap['Flexed/Bent Arm Hang']) : '--'); ?></p>
                            </td>                            
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tr>

                    <tr>
                        <td>Flexibility</td>
                        <td></td>
                        <td>Sit and Reach</td>
                        <td>Measures flexibility of lower back and hamstrings</td>
                        <?php $__currentLoopData = $classList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <td>
                                <p class="score"><?php echo e($studentsData->class_id == $class ? getScore($groupedReport, $testMap['Sit and Reach']) : '--'); ?></p>
                            </td>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tr>

                    <tr>
                        <td>Endurance</td>
                        <td></td>
                        <td>600 Mtr Run</td>
                        <td>Cardiovascular Fitness</td>
                        <?php $__currentLoopData = $classList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <td>
                                <p class="score"><?php echo e($studentsData->class_id == $class ? getScore($groupedReport, $testMap['600 Mtr Run']) : '--'); ?></p>
                            </td>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tr>

                    <tr>
                        <td>Balance</td>
                        <td>Static Balance</td>
                        <td>Flamingo Balance Test</td>
                        <td>Ability to balance on a single leg</td>
                        <?php $__currentLoopData = $classList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <td>
                                <p class="score"><?php echo e($studentsData->class_id == $class ? getScore($groupedReport, $testMap['Flamingo Balance Test']) : '--'); ?></p>
                            </td>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tr>

                    <tr>
                        <td rowspan="5">Skill Components</td>
                        <td>Agility</td>
                        <td></td>
                        <td>Shuttle Run</td>
                        <td>Test of speed and agility</td>
                        <?php $__currentLoopData = $classList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <td>
                                <p class="score"><?php echo e($studentsData->class_id == $class ? getScore($groupedReport, $testMap['Shuttle Run']) : '--'); ?></p>
                            </td>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tr>

                    <tr>
                        <td>Speed</td>
                        <td></td>
                        <td>Sprint / Dash</td>
                        <td>Determines acceleration and speed</td>
                        <?php $__currentLoopData = $classList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <td>
                                <p class="score"><?php echo e($studentsData->class_id == $class ? getScore($groupedReport, $testMap['Sprint / Dash']) : '--'); ?></p>
                            </td>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tr>
                    </tr>

                    <tr>
                        <td>Power</td>
                        <td></td>
                        <td>Standing Vertical Jump</td>
                        <td>Measures leg power</td>
                        <?php $__currentLoopData = $classList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <td>
                                <p class="score"><?php echo e($studentsData->class_id == $class ? getScore($groupedReport, $testMap['Standing Vertical Jump']) : '--'); ?></p>
                            </td>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tr>

                    <tr>
                        <td>Coordination</td>
                        <td></td>
                        <td>Plate Tapping</td>
                        <td>Tests speed & coordination</td>
                        <?php $__currentLoopData = $classList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <td>
                                <p class="score"><?php echo e($studentsData->class_id == $class ? getScore($groupedReport, $testMap['Plate Tapping']) : '--'); ?></p>
                            </td>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tr>

                    <tr>
                        <td></td>
                        <td></td>
                        <td>Alternative Hand Wall Toss Test</td>
                        <td>Measures hand–eye coordination</td>
                         <?php $__currentLoopData = $classList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <td>
                                <p class="score"><?php echo e($studentsData->class_id == $class ? getScore($groupedReport, $testMap['Alternative Hand Wall Toss Test']) : '--'); ?></p>
                            </td>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tr>
                </tbody>
            </table>
        </div>

        <p class="mt-3">
            <strong>Note:</strong> Test details are available in the HPE manual on the CBSE website.
        </p>

    </div>

    <button class="btn btn-primary mb-3" onclick="downloadPDF()">📄 Download Report</button>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

    <script>
        async function downloadPDF() {
    
            Swal.fire({
                title: 'Generating PDF...',
                text: 'Please wait while the PDF is being generated.',
                didOpen: () => {
                    Swal.showLoading();
                },
                allowOutsideClick: false,
            });

            try {
                const { jsPDF } = window.jspdf;
                const pdf = new jsPDF('landscape', 'pt', 'a4');
                const element = document.getElementById("content-to-download");        
                const canvas = await html2canvas(element, { scale: 4 });
                const imgData = canvas.toDataURL('image/png');

                const pageWidth = pdf.internal.pageSize.getWidth();
                const pageHeight = pdf.internal.pageSize.getHeight();

                const imgWidth = canvas.width;
                const imgHeight = canvas.height;
                const scale = Math.min(pageWidth / imgWidth, pageHeight / imgHeight);
                const finalWidth = imgWidth * scale;
                const finalHeight = imgHeight * scale;
                const marginX = (pageWidth - finalWidth) / 2;
                const marginY = (pageHeight - finalHeight) / 2;
        
                pdf.addImage(imgData, 'PNG', marginX, marginY, finalWidth, finalHeight);       
                pdf.save("Cbse_Health_Record.pdf");

                Swal.close();                        
                Swal.fire({
                    icon: 'success',
                    title: 'PDF Generated',
                    text: 'The PDF has been successfully generated and downloaded.',
                    allowOutsideClick: false,
                });
            } catch (error) {        
                Swal.close();
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong while generating the PDF. Please try again.',
                    allowOutsideClick: false,
                });
            }
        }
    </script>



</body>
</html><?php /**PATH C:\xampp\htdocs\nep\resources\views/assessor/reports/cbse-report.blade.php ENDPATH**/ ?>