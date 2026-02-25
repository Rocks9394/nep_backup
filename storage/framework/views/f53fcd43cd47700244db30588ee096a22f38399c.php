
<?php ini_set('memory_limit','2048M'); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Students I-Card</title>
    </head>
    <body>
        <div style="display: flex; flex-wrap: wrap; justify-content: flex-start; gap: 10px;">

            <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $studentkey=>$student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $classSection = \App\Helpers\Helper::changeToRoman($student->custom_class_id); ?>

                <div style="width: 220px; margin: 5px; display: inline-block; vertical-align: top; page-break-inside: avoid; font-family: Arial, Helvetica, sans-serif;">

                    <table style="border-collapse: collapse; margin: 0; font-size: 12px; text-align: left; font-family: Arial, Helvetica, sans-serif;">

                        <tr>
                            <th style="padding: 3px 6px; border: 1px solid #ddd; text-align: center;">
                                <?php if($student->logo == ''): ?>
                                    <img src="<?php echo e(asset('public/assets/imgs/icard/school-logo.jpeg')); ?>" alt="school-logo" style="height:24px;">
                                <?php else: ?>
                                    <img src="<?php echo e(asset('public/logo/' . $student->logo)); ?>" alt="school" style="height:24px;">
                                <?php endif; ?>
                            </th>
                            <th style="padding: 3px 6px 3px 6px; border: 1px solid #ddd; text-align: center; ">
                                <img src="<?php echo e(asset('public/assets/imgs/icard/f365.jpg')); ?>" alt="f365" style="height: 24px;">
                            </th>
                        </tr>

                        <tr>
                          <td colspan="2" style="font-size: 0.85rem; font-weight: bold; padding: 6px 6px 3px 6px; border-left: 1px solid #ddd; border-right: 1px solid #ddd; font-family: Arial, Helvetica, sans-serif;"> <?php echo e($student->student_name); ?>

                          </td>
                        </tr>

                        <tr>
                          <td colspan="2" style="padding: 1px 6px 1px 6px; border-left:1px solid #ddd; border-right:1px solid #ddd; font-family: Arial, Helvetica, sans-serif;">
                             Class: <span><?php echo e($classSection); ?></span>
                          </td>
                        </tr>

                        <tr>
                          <td colspan="2" style="padding:3px 6px 6px 6px; border-left: 1px solid #ddd; border-right: 1px solid #ddd; font-family: Arial, Helvetica, sans-serif;">
                            Registration No.: <span><?php echo e($student->school_code); ?><?php echo e($student->student_uid); ?></span>
                          </td>
                        </tr>

                        <tr>
                          <td colspan="2" style="padding: 6px; border: 1px solid #ddd;">
                            <img src="<?php echo e(asset('public/assets/imgs/icard/sign.png')); ?>" alt="Issuing Authority Signature" style="height: 30px;">
                            <p style="margin: 0; padding: 0; font-size:11px;">Issuing Authority</p>
                          </td> 
                        </tr>

                        <tr style="text-align: center;">
                          
                          <td style="text-align: center; padding: 5px; border: 1px solid #ddd; ">
                            <?php
                                $html = $student->student_name . "\n" . 
                                $classSection. "\n" . 'Goforfit Id :'.
                                $student->school_code . $student->student_uid;
                                $qrCode = QrCode::format('png')->size(70)->generate($html);
                                $base64 = 'data:image/png;base64,' . base64_encode($qrCode);
                            ?>
                            <img src="<?php echo e($base64); ?>" alt="QR Code">
                          </td>
                          

                          <?php if($student->gender == 'Male'): ?>
                          <td style="text-align: center; padding: 5px; border: 1px solid #ddd; ">
                            <img src="<?php echo e(asset('public/assets/imgs/icard/boy.png')); ?>" alt="Student Image" style="width: 60px;">
                          </td>
                          <?php else: ?>
                          <td style="text-align: center; padding: 5px; border: 1px solid #ddd; ">
                            <img src="<?php echo e(asset('public/assets/imgs/icard/female.png')); ?>" alt="Student Image" style="width: 60px;">
                          </td>
                          <?php endif; ?>
                        </tr>


                        <tr>
                          <td colspan="2" style="padding: 5px; border: 1px solid #ddd; font-family: Arial, Helvetica,sans-serif;">
                            <h3 style="font-size: 12px; font-weight: normal; margin: 0; padding: 0; font-family: Arial, Helvetica, sans-serif;">If found, please return
                                to: 
                            </h3>
                            <p style="font-size: 0.85rem; font-weight: bold; margin: 5px 0; padding: 0; font-family: Arial, Helvetica, sans-serif;"><?php echo e($student->school_name); ?></p>
                             <?php echo e($student->address); ?><br> www.fitness365.me | info@liveplus.in
                          </td>
                        </tr>
                    </table>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </body>
</html>
<?php /**PATH C:\xampp\htdocs\nep\resources\views/school/generate/studentIcard.blade.php ENDPATH**/ ?>