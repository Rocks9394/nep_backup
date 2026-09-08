<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CWSN-Report</title>
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

        .report-page {
            width: 21cm;
            height: 1122px;
            min-height: 1122px;
            max-height: 1122px;
            box-sizing: border-box;
            page-break-after: always;
            overflow: hidden;
        }
    </style>
</head>

<body>
    <table cellpadding="0" cellspacing="0" style="width: 21cm; border-collapse: collapse; margin-left: auto; margin-right: auto; font-family: Roboto Condensed, sans-serif; font-size: 12px; border: 0px; background-color: #fff;">
        <!-- Cover Page 1 -->
        <tr>
            <td>
                <table cellpadding="0" cellspacing="0" style="width: 100%; border-collapse: collapse; font-family: Roboto Condensed, sans-serif; font-size: 12px; border: 0;">
                    <tr style="background-color: #0A87CD; height: 140px; ">
                        <td style="vertical-align: top;">
                            <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0px; height: 100%;">
                                <tr>
                                    <td style="width:180px;"></td>
                                    <td style="position: relative; vertical-align: top; width: 200px; height: 100%;">
                                        <img src="{{ asset('/assets/reports/yellow-dot.png')}}" alt="" style="width: 50px; height:50px; position: relative; left:-50px; top:0;">
                                        <div style="position: absolute; top: 0; display: flex; align-items: flex-start; z-index: 10; width: 200px; overflow: hidden;">
                                            <div class="logo" style="position: relative; width: inherit;">
                                                <span style="position: absolute; top:0; left:0; width: inherit; padding: 20px; box-sizing: border-box; display:inline-block;">
                                                    <img src="{{ asset('/assets/reports/seqfast-logo.png')}}" alt="" style="width: 160px; margin-top: 10px;">
                                                </span>
                                                <img src="{{ asset('/assets/reports/logo-bg.jpg')}}" alt="" style="width: 200px; margin-top: -50px;">
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div style="margin-left: 40px; margin-right: 40px; text-align:center; margin-top: 40px; font-weight: 600; font-size: 26px; color:#fff; text-transform: uppercase;">Physical Health and Fitness Assessment (CWSN)
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="border-collapse: collapse;">
                            <div style="width: 100%; position: relative; border-collapse: collapse;">
                                <img src="{{ asset('assets/reports/report-graphic.png')}}" alt="" style="position: absolute; top:25%; right:40px; width: 200px; border-collapse: collapse;">
                                <img src="{{ asset('assets/reports/cwsn.webp')}}" alt="" style="width: 76%;">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0;">
                                <tr>
                                   <td style="background-color:#FBCA01;">
                                        <div style="position:relative;">
                                            <span style="position:absolute; top:-38px; background:rgb(0 0 0/50%); padding:10px; width:100%; z-indix:2; box-sizing: border-box; text-align:center; color:#fff; font-size:16px; text-transform: uppercase;">Session: {{ $academicYear }}</span>
                                            <img src="{{ asset('/assets/reports/aa-bg.png')}}" alt="" style="width:198px; position: relative; top: -3px;">
                                        </div>
                                    </td>
                                    <td style="vertical-align: top; width: 100%;">
                                        <table cellpadding="0" cellspacing="0" style="width: 90%; border: 0;">
                                            <tr>
                                                <td style="height:30px;"></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <img src="{{ asset('assets/uploads/logos/' . $studentsData->logo )}}" alt="" style="width: auto; object-fit: contain; padding: 0px 0px 5px 46px; height: 100px;">
                                                    <!-- <img src="{{ asset('assets/reports/gems-school-logo.png')}}" alt="" style="padding: 0px 0px 5px 46px; height: 100px;"> -->
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="height:20px;"></td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 10px 30px 10px 50px; font-size: 20px; background:#E60A00; color:#fff; font-size: 24px; font-weight: 500; position:relative;">Personal Profile<span style=" position:absolute; top:46px; right:-20px;"><img src="{{ asset('/assets/reports/green-bg.jpg')}}" alt="" style="width:20px;"></span></td>
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
                                                                        <td style="border-bottom: 1px solid #ccc; width: 100%; text-align: center; font-weight: 600; font-size: 18px; padding: 2px 0px; text-transform:uppercase;">{{ $studentsData->student_name }}</td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2" style="padding: 6px 0;">
                                                                <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0px;">
                                                                    <tr>
                                                                        <td style="padding: 0px 0px 2px 0px;"><span style="display: inline-block; margin-right: 5px;">Class&nbsp;&&nbsp;Section</span></td>
                                                                        <td style="border-bottom: 1px solid #ccc; width: 100%; text-align: center; font-weight: 600; padding: 2px 0px;"> {{ $studentsData->display_classname }}-{{ $studentsData->section }}</td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                            
                                                        </tr>
                                                        
                                                        <tr>
                                                            <td style="padding: 6px 0;">
                                                                <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0px">
                                                                    <tr>
                                                                        <td style="padding: 0px 0px 2px 0px;"><span style="display: inline-block; margin-right: 5px; margin-left: 0px;">Roll&nbsp;No.</span></td>
                                                                        <td style="border-bottom: 1px solid #ccc; width: 100%; text-align: center; font-weight: 600; padding: 2px 0px;">{{ $studentsData->rollno ?? ''}}</td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                            <td style="padding: 6px 0; width:55%;">
                                                                <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0px">
                                                                    <tr>
                                                                        <td style="padding: 0px 0px 2px 0px;"><span style="display: inline-block; margin-right: 5px;">Registration&nbsp;No</span></td>
                                                                        <td style="border-bottom: 1px solid #ccc; width: 100%; text-align: center; font-weight: 600; padding: 2px 0px;">{{ $studentsData->admissionnumber }}</td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 6px 0;">
                                                                <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0px">
                                                                    <tr>
                                                                        <td style="padding: 0px 0px 2px 0px;"><span style="display: inline-block; margin-right: 5px;">DOB</span></td>

                                                                        @php
                                                                            use Carbon\Carbon;

                                                                            $dob = Carbon::parse($studentsData->dob); 
                                                                            $formattedDob = $dob->format('d M Y'); // 05 Jul 2019
                                                                            $age = $dob->age; // will calculate age automatically
                                                                           

                                                                            if (strtolower($studentsData->gender) === 'male') {
                                                                                $gender = 'Boy';
                                                                            } else {
                                                                                $gender = 'Girl';
                                                                            }
                                                                        @endphp
                                                                        <td style="border-bottom: 1px solid #ccc; width: 100%; text-align: center; font-weight: 600; padding: 2px 0px;"> {{ $formattedDob }} ({{ $age }} Years)</td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                            <td style="padding: 6px 0;">
                                                                <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0px">
                                                                    <tr>
                                                                        <td style="padding: 0px 0px 2px 0px;"><span style="display: inline-block; margin-right: 5px; margin-left: 5px;">Gender</span></td>
                                                                        <td style="border-bottom: 1px solid #ccc; width: 100%; text-align: center; font-weight: 600; padding: 2px 0px;">{{ $gender }}</td>
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
                                                                        <td style="border-bottom: 1px solid #ccc; width: 100%; text-align: center; font-weight: 600; padding: 2px 0px;">{{ $studentsData->school_name }}</td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 6px 0;">
                                                                <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0px">
                                                                    <tr>
                                                                        <td style="padding: 0px 0px 2px 0px;"><span style="display: inline-block; margin-right: 5px;">Code</span></td>
                                                                        <td style="border-bottom: 1px solid #ccc; width: 100%; text-align: center; font-weight: 600; padding: 2px 0px;">{{ $studentsData->school_code }}</td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                            <td style="padding: 6px 0;">
                                                                <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0px">
                                                                    <tr>
                                                                        <td style="padding: 0px 0px 2px 0px;">&nbsp;&nbsp;APAAR&nbsp;ID&nbsp;<span style="display: inline-block; margin-left: 0px; margin-right: 5px; font-size:11px;">(Optional)</span></td>
                                                                        <td style="border-bottom: 1px solid #ccc; width: 100%; text-align: center; font-weight: 600; padding: 2px 0px;">{{ $studentsData->apaarId ?? ''}}</td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2" style="padding: 6px 0;">
                                                                <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0px;">
                                                                    <tr>
                                                                        <td style="padding: 0px 0px 2px 0px;"><span style="display: inline-block; margin-right: 5px;">Disability&nbsp;&nbsp;Type</span></td>
                                                                        <td style="border-bottom: 1px solid #ccc; width: 100%; text-align: center; font-weight: 600; padding: 2px 0px;"> {{ $studentsData->disability_type }}</td>
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
                                            <!-- <tr>
                                                <td style="height:150px;"></td>
                                        </tr>
                                        <tr>
                                            <td style="text-align:right; padding: 0px 0px 0px 46px; ">
                                                <div style="float:right; text-align:center;">
                                                    <p style="margin-bottom:0px; color:#666; font-size:10px;">Powered by</p>
                                                        <img src="{{ asset('assets/reports/fitness365-logo-web.png')}}" alt="fitness365 logo" style="height:28px;">
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

        <!-- Start Page 2 -->
        <tr>
            <td style="vertical-align: top;">
                <table border="1" cellpadding="0" cellspacing="0" style="page-break-before: always; page-break-after: avoid; width: 100%; border-collapse: collapse; font-family: Roboto Condensed, sans-serif; font-size: 12px; border:0px solid transparent;">
                    <!-- Inner page Header Area (Page 2) -->
                    <tr style="height: 100px;">
                        <td style="vertical-align: top;">
                            <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0px; height: 100%; border:0;">
                                <tr>
                                    <td style="position: relative; vertical-align: top; width: 300px; height: 100%; " >
                                        @if(!empty($studentsData->logo))
                                        <div style="position: absolute; top: 17px; left:30px; display: flex; align-items: center; z-index: 1; width: auto; overflow: hidden;">
                                            <img src="{{ asset('assets/uploads/logos/' . $studentsData->logo )}}" alt="" style="width: auto; height:60px;">
                                        </div>
                                        @else 
                                        <div style="margin-left: 30px; margin-top: 30px;">
                                            School Logo -1
                                        </div>
                                        @endif 
                                    </td>


                                    <td rowspan="2" style="position: relative; vertical-align: top; width: auto; height: 100%; text-align: right;">
                                        <div style="position: absolute; top: 30px; right:30px; display: flex; align-items: center; z-index: 1; width: auto; overflow: hidden;">
                                            <img src="{{ asset('assets/reports/seqfast-logo.png')}}" alt="" style="width: auto; height:60px;">
                                        </div>
                                        <img src="{{ asset('assets/reports/inner-header-bg.png')}}" alt="" style="width: 450px; height:auto; position: relative; right:0px; top:0;">
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
                                        <div style="background: #E60A00; float:left; display: inline-flex; align-items: center; color: #fff; font-size: 18px; font-weight: 600; height: 32px;">
                                            <div style="float: left; padding: 1px 0px 0px 10px; margin-bottom: -3px;">Physical Fitness Assessment for {{ $studentsData->display_classname }}-{{ $studentsData->section }}</div>
                                            <div style="float:left; transform: skew(26deg,0deg); display:inline-block; width: 20px; height: 32px; background: #E60A00; position: relative; right: -10px;"></div>
                                        </div>
                                    </td>
                                </tr>
                                @foreach($orderedReportData as $key => $value)

                                @php
                                    $currentTerm = $value->get('Current_Term', collect())->first();
                                    $previousTerm = $value->get('Previous_Term', collect())->first();
                                    $displayKey = str_contains($key, 'Body Composition')  
                                        ? str_replace('Body Composition (BMI)', 'BMI (Body Mass Index)', $key) 
                                        : $key;
                                @endphp
                               
                                @if($key === 'Body Composition (BMI)')
                                <tr> <td style="height: 15px;"></td></tr>
                                <tr>
                                    <td style="padding: 6px 10px 6px 0px; font-size: 20px; color:#000; font-size: 18px; font-weight: 600;">{{ $displayKey }}</td> 
                                </tr>

                                <tr>
                                    <td>
                                        <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0; border-collapse: collapse;">
                                            <tr>
                                                <td style="vertical-align: top;">
                                                    <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
                                                        <tr style="font-size: 13px; line-height: 1.25rem;">
                                                            <td style="border-top: 1px solid orange; border-left: 1px solid orange; border-right: 1px solid orange; border-bottom: 0px solid transparent; border-collapse: collapse; padding:5px 15px; vertical-align: middle;">
                                                                <ul style="margin-left: 15px;">
                                                                    <li>Height recorded in cm and mm</li>
                                                                    <li>Weight will be recorded in kilogram (kg) and grams(gms)</li>
                                                                </ul>
                                                            </td>
                                                            <td style="border-top: 1px solid orange; border-right: 1px solid orange; border-bottom: 0px solid transparent; border-collapse: collapse; padding:5px 15px; vertical-align: top; padding-bottom:10px;">
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
                                                            <td style="width: 100%;" colspan="2">
                                                                <table border="1" cellpadding="0" cellspacing="0" style="width: 100%; border: 1px solid orange; font-size: 13px; border-collapse: collapse; color:#333;">
                                                                    <tr style="background-color: #fecd0a;">
                                                                        <td style="width: 20%; background-color:#0A87CD; padding: 0px 4px 2px 6px; border: 1px solid orange; color:#fff; text-align: center; font-weight: bold;" rowspan="2">Current Term</td>
                                                                        <td style="padding: 4px 0px 4px 0px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">Date</td>
                                                                        <td style="padding: 0px 4px 2px 6px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">Weight (kg)</td>
                                                                        <td style="padding: 0px 4px 2px 6px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">Height (cm)</td>
                                                                        <td style="padding: 0px 4px 2px 6px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">BMI</td>
                                                                        <td style="padding: 0px 4px 2px 6px; border: 1px solid orange; color:#000; font-weight: bold; text-align: center;">NI</td>
                                                                        <td style="padding: 0px 4px 2px 6px; border: 1px solid orange; color:#000; font-weight: bold; text-align: center;">AFZ</td>
                                                                        <td style="padding: 0px 4px 2px 6px; border: 1px solid orange; color:#000; font-weight: bold; text-align: center;">HFZ</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td style="padding: 4px 0px 4px 0px; font-weight: 500; color:#000; text-align: center;">{{ $value['Current_Term'][0]['created_at'] ?? '---'}}</td>
                                                                        <td style="padding: 0px 4px 2px 6px; text-align: center; border: 1px solid orange;"> {{ $value['Current_Term'][0]['weight'] ?? '---'}}</td>
                                                                        <td style="padding: 0px 4px 2px 6px; text-align: center; border: 1px solid orange;">  {{ $value['Current_Term'][0]['height'] ?? '---'}}</td>
                                                                        <td style="padding: 0px 4px 2px 6px; text-align: center; border: 1px solid orange;">{{ $value['Current_Term'][0]['score'] ?? '---'}}</td>
                                                                        <td style="padding: 0px 4px 2px 6px; text-align: center; border: 1px solid orange;">{{ $value['Current_Term'][0]['ni'] ?? '---'}}</td>
                                                                        <td style="padding: 0px 4px 2px 6px; text-align: center; border: 1px solid orange;">{{ $value['Current_Term'][0]['afz'] ?? '---'}}</td>
                                                                        <td style="padding: 0px 4px 2px 6px; text-align: center; border: 1px solid orange;">{{ $value['Current_Term'][0]['hfz'] ?? '---'}}</td>
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

                                @elseif(!empty($currentTerm['score']))

                                <tr> <td style="height: 15px;"></td></tr>
                                <tr>
                                    <td style="padding: 6px 10px 6px 0px; font-size: 20px; color:#000; font-size: 18px; font-weight: 600;">{{ $displayKey }}</td> 
                                </tr>

                                <tr>
                                    <td>
                                        <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0; border-collapse: collapse;">
                                            <tr>
                                                <td style="vertical-align: top;">
                                                    <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
                                                        <tr>
                                                            <td style="width: 100%">
                                                                <table border="1" cellpadding="0" cellspacing="0" style="width: 100%; border: 1px solid orange; border-bottom: 1px solid orange; font-size: 14px; border-collapse: collapse; color:#333;">
                                                                    <tr style="background-color: #fecd0a;">
                                                                        <td style="width: 20%; background-color:#0A87CD; border: 1px solid orange; color:#fff; text-align: center; font-weight: bold;" rowspan="2">Current Term</td>
                                                                        <td style="width: 16%; padding: 4px 4px 4px 6px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">Date</td>
                                                                        <td style="width: 16%; padding: 4px 4px 4px 6px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">Score</td>
                                                                        <td style="width: 16%; padding: 4px 4px 4px 6px; border: 1px solid orange; color:#000; font-weight: bold; text-align: center;">NI</td>
                                                                        <td style="width: 16%; padding: 4px 4px 4px 6px; border: 1px solid orange; color:#000; font-weight: bold; text-align: center;">AFZ</td>
                                                                        <td style="width: 16%; padding: 4px 4px 4px 6px; border: 1px solid orange; color:#000; font-weight: bold; text-align: center;">HFZ</td>
                                                                    </tr>
                                                                    <tr>                
                                                                        <td style="padding: 4px 4px 4px 6px; font-weight: 500; color:#000; text-align: center;">{{ $value['Current_Term'][0]['created_at'] ?? '---'}}</td>
                                                                        <td style="text-align: center;">{{ $value['Current_Term'][0]['score'] ?? '---'}}</td>
                                                                        <td style="text-align: center;">{{ $value['Current_Term'][0]['ni'] ?? '---'}}</td>
                                                                        <td style="text-align: center;">{{ $value['Current_Term'][0]['afz'] ?? '---'}}</td>
                                                                        <td style="text-align: center;">{{ $value['Current_Term'][0]['hfz'] ?? '---'}}</td>
                                                                        <!-- <td style="text-align: center;">---</td> -->
                                                                    </tr>

                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <table border="1" cellpadding="0" cellspacing="0" style="width: 100%; border-top: 1px solid transparent; border-left: 1px solid orange; border-right: 1px solid orange; border-bottom: 1px solid orange; font-size: 14px; border-collapse: collapse; color:#333;">
                                                        <tr>
                                                            <td style="width: 20%; border-top: 1px solid #fecd0a; background-color: #fecd0a; padding: 4px; padding: 5px 10px; color: #000; text-align: center; width: 120px; font-weight: bold;">Recommendation</td>
                                                            <td style="width: 80%; padding: 4px;">{{ $value['Current_Term'][0]['recommendation'] ?? '---' }}</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>                    
                                @endif

                                @endforeach

                                <tr>
                                    <td style="height: 15px;"></td>
                                </tr>
                                <tr>
                                    <td style="padding: 5px 10px; font-size: 20px; background:#0A87CD; color:#fff; font-size: 16px; font-weight: 600;">Fitness Zone Classification</td>
                                </tr>

                                <tr>
                                    <td>
                                        <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0; border-collapse: collapse;">
                                            <tr>
                                                <td style="vertical-align: top;">
                                                    <table border="1" cellpadding="0" cellspacing="0" style="width: 100%; border: 1px solid #0A87CD; font-size: 13px; border-collapse: collapse; color:#333;">
                                                        <tr>
                                                            <td style="padding: 3px 4px; font-weight: 500; color:#000;">NI</td>
                                                            <td style="padding: 3px 4px; font-weight: 400;">Needs Inprovment</td>
                                                            <td style="padding: 3px 4px; text-align: left;">Developing foundational fitness skills and working toward consistent performance.</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 3px 4px; font-weight: 500; color:#000;">AFZ</td>
                                                            <td style="padding: 3px 4px; font-weight: 400;">Adoptive Fitness Zone</td>
                                                            <td style="padding: 3px 4px; text-align: left;">Demonstrating steady progress with improving fitness, skill, and consistency.</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 3px 4px; font-weight: 500; color:#000;">HFZ</td>
                                                            <td style="padding: 3px 4px; font-weight: 400;">Healthy Fitness Zone</td>
                                                            <td style="padding: 3px 4px; text-align: left;">Demonstrating a healthy level of fitness with strong, consistent performance.</td>
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
        <!-- Footer Area (Page 2) -->
        <tr>
            <td style="height: 90px; vertical-align: bottom;">
                <table border="0" cellpadding="0" cellspacing="0" style="width:100%;">
                    <tr>
                        <td style="height: 30px;"></td>
                    </tr>
                    <tr>
                        <td style="width:74px;">
                            <div style="float: left; position: relative; width: 60px;">
                                <span style="position: absolute; left: 50%; top:50%; transform: translate(-50%, 0); color: #fff; z-index: 1; display: inline-block; padding: 2px 0 0 20px; font-size: 13px; font-weight: 600;"></span>
                                <img src="{{ asset('assets/reports/footer-bg.png')}}" alt="" style="width: inherit;">
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
                                            <img src="{{ asset('assets/reports/fitness365-logo-web.png')}}" alt="fitness365 logo" style="height:28px;">
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
        <!-- End of page 2  -->
        <!-- start page 3 -->
        <tr>
            <td style="vertical-align: top;">
                <table border="1" cellpadding="0" cellspacing="0" style="page-break-before: always; page-break-after: avoid; width: 100%; border-collapse: collapse; font-family: Roboto Condensed, sans-serif; font-size: 12px; border:0px solid transparent;">
                    <!-- Inner page Header Area (Page 2) -->
                    <tr style="height: 100px;">
                        <td style="vertical-align: top;">
                            <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0px; height: 100%; border:0;">
                                <tr>
                                    <td style="position: relative; vertical-align: top; width: 300px; height: 100%; " >
                                        @if(!empty($studentsData->logo))
                                        <div style="position: absolute; top: 17px; left:30px; display: flex; align-items: center; z-index: 1; width: auto; overflow: hidden;">
                                            <img src="{{ asset('assets/uploads/logos/' . $studentsData->logo )}}" alt="" style="width: auto; height:60px;">
                                        </div>
                                        @else 
                                        <div style="margin-left: 30px; margin-top: 30px;">
                                            School Logo -1
                                        </div>
                                        @endif 
                                    </td>


                                    <td rowspan="2" style="position: relative; vertical-align: top; width: auto; height: 100%; text-align: right;">
                                        <div style="position: absolute; top: 30px; right:30px; display: flex; align-items: center; z-index: 1; width: auto; overflow: hidden;">
                                            <img src="{{ asset('assets/reports/seqfast-logo.png')}}" alt="" style="width: auto; height:60px;">
                                        </div>
                                        <img src="{{ asset('assets/reports/inner-header-bg.png')}}" alt="" style="width: 450px; height:auto; position: relative; right:0px; top:0;">
                                    </td>

                                </tr>
                            </table>
                        </td>

                    </tr>                    
                </table>
            </td>
        </tr>
        <!-- content page 3 -->
        <tr>
            <td>
                <!-- Inner page Content (Page 3) -->
                <table border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td>
                            <table cellpadding="0" cellspacing="0"
                                style="width:94%; border:0; border-collapse:collapse; margin:auto; color:#333; font-size:12px;">

                                <!-- CWSN INTRODUCTION -->
                                <tr>
                                    <td style="border: 1px solid #00A923; padding: 10px 15px 8px 15px; background:#F2FFF5;">
                                        <h3 style="color: #00A923; margin-bottom: 6px; font-size: 18px;">WHO Guidelines on Physical Activity and Sedentary Behaviour 2020</h3>

                                        <h4 style="color: #000; margin-bottom: 5px; font-size: 16px;">Physical Activity Guidelines for CWSN (Age 10–17 Years)</h4>

                                        <p style="line-height: 1.25rem;">Aim for an average of at least <strong>60 minutes per day</strong> of moderate-to-vigorous intensity physical activity across the week, with most activity being aerobic.</p>

                                        <p style="line-height: 1.25rem;">Include vigorous-intensity aerobic activities, along with activities that strengthen muscles and bones, on at least <strong>3 days per week</strong>, as appropriate to the student's abilities and health status.</p>

                                        <p style="line-height: 1.25rem;">Physical activity should be appropriately adapted to the student's functional abilities, health condition and fitness level. <strong>Some physical activity is better than none.</strong></p>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="height:8px;"></td>
                                </tr>

                                <!-- ASSESSMENT COMPONENTS -->
                                <tr>
                                    <td>
                                        <table cellpadding="0" cellspacing="0"
                                            style="width:100%; border:0; border-collapse:collapse;">

                                            <tr>
                                                <td colspan="2">
                                                    <h3 style="color:#000; font-size:16px; margin:0 0 8px 0;">
                                                        CWSN Physical Fitness Assessment Components
                                                    </h3>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td style="width:50%; padding:0 25px 8px 0; vertical-align:top;">
                                                    <h4 style="color:#000; margin:0 0 3px 0; font-size:13px;">
                                                        1. Aerobic Capacity
                                                    </h4>
                                                    <p style="margin:0; line-height:14px;">
                                                        20-m PACER, 15-m PACER and One Mile Run/Walk are used to assess
                                                        aerobic capacity and cardiorespiratory endurance, with the
                                                        appropriate test selected according to the child's functional ability.
                                                    </p>
                                                </td>

                                                <td style="width:50%; padding:0 25px 0 0; vertical-align:top;">
                                                    <h4 style="color:#000; margin:0 0 3px 0; font-size:13px;">
                                                        2. Strength &amp; Endurance
                                                    </h4>
                                                    <p style="margin:0; line-height:14px;">
                                                        Curl-up, Modified Curl-up, Dumbbell Press, Pull-up, Push-up,
                                                        Seated Push-up, Trunk Lift, Isometric Push-up, Reverse Curl,
                                                        Modified Pull-Up and 40-Meter Push/Walk Test are used to assess
                                                        muscular strength and endurance according to the child's
                                                        functional ability.
                                                    </p>
                                                </td>                                               
                                            </tr>

                                            <tr>
                                                <td style="height:5px;"></td>
                                                <td style="height:5px;"></td>
                                            </tr>

                                            <tr>
                                                <td style="width:50%; padding:0; vertical-align:top;">
                                                    <h4 style="color:#000; margin:0 0 3px 0; font-size:13px;">
                                                        3. Flexibility
                                                    </h4>
                                                    <p style="margin:0; line-height:14px;">
                                                        Shoulder Stretch, Back Saver Sit and Reach and Modified Apley Test
                                                        are used to assess flexibility and range of motion, with the
                                                        appropriate test selected according to the child's functional ability.
                                                    </p>
                                                </td>
                                                <td style="width:50%; padding:0 0 8px 0; vertical-align:top;">
                                                    <h4 style="color:#000; margin:0 0 3px 0; font-size:13px;">
                                                        2. Body Composition
                                                    </h4>
                                                    <p style="margin:0; line-height:14px;">
                                                        BMI, skinfolds or percentage body fat may be used when
                                                        appropriate for the child's disability and assessment protocol.
                                                    </p>
                                                </td>
                                            </tr>

                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="height:12px;"></td>
                                </tr>

                                <!-- FITNESS ZONE INTERPRETATION -->
                                <tr>
                                    <td style="border:1px solid #0A87CD; padding:7px 10px; background:#FEFBEF;">
                                        <h4 style="color: #0A87CD; margin:0 0 4px 0; font-size:15px;">
                                            Interpretation of CWSN Fitness Results
                                        </h4>

                                        <p style="line-height:14px; margin:3px 0;">
                                            Fitness results should be interpreted against the standard applicable to
                                            the selected test and the child's disability/functional profile.
                                        </p>

                                        <p style="line-height:14px; margin:3px 0;">
                                            Where an Adapted Fitness Zone (AFZ) is available, it may be used to identify
                                            an attainable level of health-related fitness. A Healthy Fitness Zone (HFZ)
                                            may be used where the applicable general standard is appropriate.
                                        </p>

                                        <p style="line-height:14px; margin:3px 0;">
                                            For children requiring extensive support, assessment may focus on functional
                                            physical activity and individualized goals rather than applying a single
                                            universal benchmark.
                                        </p>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="height:10px;"></td>
                                </tr>

                                <!-- IMPORTANT NOTE -->
                                <tr>
                                    <td style="font-size:11px; line-height:14px; color:#555;">
                                        <strong>Note:</strong>
                                        CWSN fitness assessment is not intended to compare every child against one
                                        common physical-fitness benchmark. Test selection, adaptations and interpretation
                                        should be based on the child's disability, functional ability and the assessment
                                        protocol used by the school/qualified physical education professional.
                                    </td>
                                </tr>
                                <tr>
                                    <td style="height:25px;"></td>
                                </tr>

                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>      

        <!-- Footer Area (Page 3) -->
        <tr>
            <td>
                <table cellpadding="0" cellspacing="0" style="width: 94%; border: 0; border-collapse: collapse; margin: auto; color: #333; font-size: 12px;">
                    <tr>
                        <td>
                            <table border="1" cellpadding="0" cellspacing="0" style="width: 100%; border: 1px solid orange; font-size: 14px; border-collapse: collapse; color:#333;">
                                <tr>
                                    <td style="font-weight: 600; padding: 10px 15px; font-size: 14px; color: #000; height:110px; vertical-align:top;">PE Teacher's Observations and Comments (if any)</td>
                                    <td style="font-weight: 600; padding: 10px 15px; font-size: 14px; color: #000; text-align:center; height:100px; vertical-align:bottom;">
                                        {{-- @if($studentsData->hod_sign)
                                            <div style="margin: 10px 0 0 0; text-align:center;">
                                                <img src="{{ asset('assets/uploads/hod-signatures/' . $studentsData->hod_sign) }}" alt="" style="height: 70px;">
                                            </div>
                                        @endif  --}}
                                        <p>Teacher's Signature</p> 
                                    </td>
                                </tr>
                                
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <table border="0" cellpadding="0" cellspacing="0" style="width: 100%; font-size: 14px; border-collapse: collapse; color:#000;">
                                <tr>
                                    <td style="border: 1px solid transparent; width:50%;">
                                        <div style="padding: 15px; height: 30px; margin: 10px 0; background-color: #fff; border-right: 3px solid #fff;"></div>
                                        <p style="text-align: center; font-weight: 600;">Parent's Signature</p>
                                    </td>
                                    <td style="border: 1px solid transparent; width:50%;">
                                        @if($studentsData->signature)
                                            <div style="margin: 10px 0 0 0; text-align:center;">
                                                <img src="{{ asset('assets/uploads/signatures/' . $studentsData->signature) }}" alt="" style="height: 70px;">
                                            </div>
                                        @endif
                                        <p style="text-align: center; font-weight: 600;">Signature of Principal with Stamp</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="height: 16px;"></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table cellpadding="0" cellspacing="0" style="width: 100%; border:0;">                    
                    <tr>
                        <td style="background-color: #E60A00; height: 30px; padding: 0 30px; color:#fff;">Physical Health and Fitness Assessment</td>
                        <td style="background-color: #00A923; height: 30px; width: 30%; padding: 0 30px; text-align:right; color:#fff;">powered  by fitness365.me</td>
                    </tr>
                </table>
            </td>
        </tr>
        <!-- End of page 3  -->
    </table>

</body>

</html>