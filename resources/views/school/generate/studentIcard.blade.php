
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

            @foreach($students as $studentkey=>$student)
                @php $romanClass = \App\Helpers\Helper::changeToRoman($student->class_name); @endphp

                <div style="width: 220px; margin: 5px; display: inline-block; vertical-align: top; page-break-inside: avoid; font-family: Arial, Helvetica, sans-serif;">

                    <table style="border-collapse: collapse; margin: 0; font-size: 12px; text-align: left; font-family: Arial, Helvetica, sans-serif;">

                        <tr>
                            <th style="padding: 3px 6px; border: 1px solid #ddd; text-align: center;">
                                @if($student->logo == '')
                                    <img src="{{ asset('public/assets/imgs/icard/school-logo.jpeg') }}" alt="school-logo" style="height:24px;">
                                @else
                                    <img src="{{ asset('public/logo/' . $student->logo) }}" alt="school" style="height:24px;">
                                @endif
                            </th>
                            <th style="padding: 3px 6px 3px 6px; border: 1px solid #ddd; text-align: center; ">
                                <img src="{{ asset('public/assets/imgs/icard/f365.jpg') }}" alt="f365" style="height: 24px;">
                            </th>
                        </tr>

                        <tr>
                          <td colspan="2" style="font-size: 0.85rem; font-weight: bold; padding: 6px 6px 3px 6px; border-left: 1px solid #ddd; border-right: 1px solid #ddd; font-family: Arial, Helvetica, sans-serif;"> {{ $student->student_name }}
                          </td>
                        </tr>

                        <tr>
                          <td colspan="2" style="padding: 1px 6px 1px 6px; border-left:1px solid #ddd; border-right:1px solid #ddd; font-family: Arial, Helvetica, sans-serif;">
                             Class: <span>{{ $romanClass }}-{{ $student->section_id }}</span>
                          </td>
                        </tr>

                        <tr>
                          <td colspan="2" style="padding:3px 6px 6px 6px; border-left: 1px solid #ddd; border-right: 1px solid #ddd; font-family: Arial, Helvetica, sans-serif;">
                            Registration No.: <span>{{ $student->school_code }}{{ $student->student_uid }}</span>
                          </td>
                        </tr>

                        <tr>
                          <td colspan="2" style="padding: 6px; border: 1px solid #ddd;">
                            <img src="{{ asset('public/assets/imgs/icard/sign.png') }}" alt="Issuing Authority Signature" style="height: 30px;">
                            <p style="margin: 0; padding: 0; font-size:11px;">Issuing Authority</p>
                          </td> 
                        </tr>

                        <tr style="text-align: center;">
                          
                          <td style="text-align: center; padding: 5px; border: 1px solid #ddd; ">
                            @php
                                $html = $student->student_name . "\n" . 
                                $romanClass.'-'.$student->section_id . "\n" . 'Goforfit Id :'.
                                $student->school_code . $student->student_uid;
                                $qrCode = QrCode::format('png')->size(70)->generate($html);
                                $base64 = 'data:image/png;base64,' . base64_encode($qrCode);
                            @endphp
                            <img src="{{ $base64 }}" alt="QR Code">
                          </td>
                          

                          @if($student->gender == 'Male')
                          <td style="text-align: center; padding: 5px; border: 1px solid #ddd; ">
                            <img src="{{ asset('public/assets/imgs/icard/boy.png') }}" alt="Student Image" style="width: 60px;">
                          </td>
                          @else
                          <td style="text-align: center; padding: 5px; border: 1px solid #ddd; ">
                            <img src="{{ asset('public/assets/imgs/icard/female.png') }}" alt="Student Image" style="width: 60px;">
                          </td>
                          @endif
                        </tr>


                        <tr>
                          <td colspan="2" style="padding: 5px; border: 1px solid #ddd; font-family: Arial, Helvetica,sans-serif;">
                            <h3 style="font-size: 12px; font-weight: normal; margin: 0; padding: 0; font-family: Arial, Helvetica, sans-serif;">If found, please return
                                to: 
                            </h3>
                            <p style="font-size: 0.85rem; font-weight: bold; margin: 5px 0; padding: 0; font-family: Arial, Helvetica, sans-serif;">{{ $student->school_name }}</p>
                             {{ $student->address }}<br> www.fitness365.me | info@liveplus.in
                          </td>
                        </tr>
                    </table>
                </div>
            @endforeach
        </div>
    </body>
</html>
