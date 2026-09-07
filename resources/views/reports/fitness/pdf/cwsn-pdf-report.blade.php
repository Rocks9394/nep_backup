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
        body { margin: 0; padding: 0; }

        body { font-family: "Roboto Condensed", sans-serif; font-optical-sizing: auto; background-color: #fff; }

        page[size="A4"] { width: 21cm;  height: 29.7cm; margin: 0; padding:0; }
        .act-tbl { width:100%; }
        .act-tbl td { border-bottom:1px solid #EFB9B8; }
        
    </style>
</head>

<body>
 <!-- Cover Page -->

    <table cellpadding="0" cellspacing="0" style="width: 21cm; border-collapse: collapse; margin-left: auto; margin-right: auto; font-family: Roboto Condensed, sans-serif; font-size: 12px; border: 0px; background-color: #fff;">
        <tr>
            <td>
                <table cellpadding="0" cellspacing="0" style="width: 100%; border-collapse: collapse; font-family: Roboto Condensed, sans-serif; font-size: 12px; border: 0;">
                   
                    <tr>
                        <td style="border-collapse: collapse;">
                            <div style="position: relative; background-color: #fff;">
                                <div style="position: relative; background-color: #0A87CD;margin-top:0px; z-index:0; height:136px;">
                                    <img src="{{ public_path('assets/reports/yellow-dot.png')}}" alt="" style="width: 40px; height:40px; position: relative; left:150px; top:0;">
                                </div>
                             
                                <div style="width: auto; position:absolute; top:-30px; left: 176px; z-index:10; padding:30px 15px 0 15px; display:flex;">
                                <div style="background:#fff; padding:25px 15px 10px 15px; height:140px; float:left;">
                                    <img src="{{ public_path('assets/reports/seqfast-logo.png')}}" alt="" style="width: auto; height:100px;">
                                </div>
                                <p style="margin-left:30px; float:left; font-size:24px; padding:34px 20px 20px 0px; width:300px; font-weight:600; line-height:24px; color:#fff;">Physical Health and Fitness Assessment</p>
                                </div>
                               
                                <img src="{{ public_path('assets/reports/report-graphic.png')}}" alt="" style="position: absolute; top:26%; right:40px; width: 200px; border-collapse: collapse; z-index:9;">
                               
                                <img src="{{ public_path('assets/reports/cwsn.webp')}}" alt="" style="width: 76%; z-index:2; position: relative; top:0;">
                            </div>
                        
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0;">
                                <tr>
                                    <td style="background-color: #F28F0C;">
                                        <div style="position:relative;">
                                            <span style="position:absolute; top:-48px; background:rgb(0 0 0/50%); padding:10px; width:90%; z-index:2; box-sizing: border-box; text-align:center; color:#fff; font-size:16px; font-weight:600; letter-spacing: 2px;  text-transform: uppercase;">Session: {{ $academicYear }}</span>
                                            <img src="{{ public_path('/assets/reports/aa-bg.png')}}" alt="" style="width:198px; position: relative; top: -2px; height: 615px;">
                                        </div>
                                    </td>
                                    <td style="vertical-align: top; width: 100%;">
                                        <table cellpadding="0" cellspacing="0" style="width: 90%; border: 0;">
                                            <tr>
                                                <td style="height: 80px;"></td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 1px 25px 5px 35px; font-size: 20px; background: #E60A00; color:#fff; font-size: 24px; font-weight: 500; position:relative;">Physical Health and Fitness Assessment (CwSN)<span style=" position:absolute; top:44px; right:-21px;"><img src="{{ public_path('assets/reports/yellow-bg.jpg')}}" alt="" style="width:20px;"></span></td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 30px 30px 10px 50px; font-size: 24px; font-weight: 500;">Personal Profile</td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 10px 30px 10px 50px; font-size: 16px; color: #333;">
                                                    <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0px">
                                                        <tr>
                                                            <td colspan="2" style="padding: 6px 0;">
                                                                <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0px">
                                                                    <tr>
                                                                        <td><span style="display: inline-block; margin-right: 5px;">Name</span></td>
                                                                        <td style="border-bottom: 1px solid #e5e5e5; width: 100%; text-align: center; font-weight: 600; font-size: 18px;">{{ $studentsData->student_name }}</td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 6px 0;">
                                                                <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0px;">
                                                                    <tr>
                                                                        <td><span style="display: inline-block; margin-right: 5px;">Class&nbsp;&&nbsp;Section</span></td>
                                                                        <td style="border-bottom: 1px solid #e5e5e5; width: 100%; text-align: center; font-weight: 600;"> {{ $studentsData->display_classname }} {{ $studentsData->section }}</td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                            <td style="padding: 6px 0;">
                                                                <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0px">
                                                                    <tr>
                                                                        <td><span style="display: inline-block; margin-right: 5px; margin-left: 5px;">Roll&nbsp;No.</span></td>
                                                                        <td style="border-bottom: 1px solid #e5e5e5; width: 100%; text-align: center; font-weight: 600;">{{ $studentsData->rollno ?? ''}}</td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2" style="padding: 6px 0;">
                                                                <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0px">
                                                                    <tr>
                                                                        <td><span style="display: inline-block; margin-right: 5px;">School</span></td>
                                                                        <td style="border-bottom: 1px solid #e5e5e5; width: 100%; text-align: center; font-weight: 600;">{{ $studentsData->school_name }}</td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 6px 0;">
                                                                <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0px">
                                                                    <tr>
                                                                        <td><span style="display: inline-block; margin-right: 5px;">Code</span></td>
                                                                        <td style="border-bottom: 1px solid #e5e5e5; width: 100%; text-align: center; font-weight: 600;">{{ $studentsData->school_code }}</td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                            <td style="padding: 6px 0;">
                                                                <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0px">
                                                                    <tr>
                                                                        <td><span style="display: inline-block; margin-right: 5px; margin-left: 5px;">APAAR&nbsp;ID</span></td>
                                                                        <td style="border-bottom: 1px solid #e5e5e5; width: 100%; text-align: center; font-weight: 600;">{{ $studentsData->apaarId ?? ''}}</td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2" style="padding: 6px 0;">
                                                                <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0px">
                                                                    <tr>
                                                                        <td><span style="display: inline-block; margin-right: 5px;">CISCE&nbsp;Registration&nbsp;No</span></td>
                                                                        <td style="border-bottom: 1px solid #e5e5e5; width: 100%; text-align: center; font-weight: 600;">{{ $studentsData->admissionnumber }}</td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <tr>


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

                                                            <td style="padding: 6px 0;">
                                                                <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0px">
                                                                    <tr>
                                                                        <td><span style="display: inline-block; margin-right: 5px;">DOB</span></td>
                                                                        <td style="border-bottom: 1px solid #e5e5e5; width: 100%; text-align: center; font-weight: 600;"> {{ $formattedDob }} ({{ $age }} Years)</td>
                                                                    </tr>
                                                                </table>
                                                            </td>

                                                           

                                                            <td style="padding: 6px 0;">
                                                                <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0px">
                                                                    <tr>
                                                                        <td><span style="display: inline-block; margin-right: 5px; margin-left: 5px;">Gender</span></td>
                                                                        <td style="border-bottom: 1px solid #e5e5e5; width: 100%; text-align: center; font-weight: 600;">{{ $gender }}</td>
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
                                                                        <td><span style="display: inline-block; margin-right: 5px;">Brief Summary</span></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="border-bottom: 1px solid #e5e5e5; width: 100%; text-align: center; font-weight: 600; height: 24px;"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="border-bottom: 1px solid #e5e5e5; width: 100%; text-align: center; font-weight: 600; height: 24px;"></td>
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
                                <tr>
                                    <td style="background-color: #1c9b3e; height: 30px;"></td>
                                    <td style="background-color: #F28F0C; height: 30px;"></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <!-- Page 2 -->
    <table border="0" cellpadding="0" cellspacing="0" style="width:100%; height:100%; page-break-before: always;" >
        <!-- page 2 header -->
        <tr>
            <td>
                <table border="1" cellpadding="0" cellspacing="0" style="width: 100%; border-collapse: collapse; font-family: Roboto Condensed, sans-serif; font-size: 12px; border:0px solid transparent;">
                    <tr>
                        <td style="vertical-align: top; height: 80px;">
                            <table cellpadding="0" cellspacing="0" style="width: 100%; border:0;">
                                <tr>

                                    <td style="width:300px;">
                                        @if(!empty($studentsData->logo))
                                        <div style="position: absolute; top: 17px; left:30px; display: flex; align-items: center; z-index: 1; width: auto; overflow: hidden;">
                                            <img src="{{ public_path('assets/uploads/logos/' . $studentsData->logo )}}" alt="" style="width: auto; height:60px;">
                                        </div>
                                        @else 
                                        <div style="margin-left: 30px; margin-top: 30px;">
                                            School Logo -1
                                        </div>
                                        @endif 
                                    </td>


                                    <td rowspan="2" style="position: relative; vertical-align: top; width: auto; text-align: right;">
                                        <div style="position: absolute; top: 30px; right:30px; display: flex; align-items: center; z-index: 1; width: 90px; overflow: hidden;">
                                            <img src="{{ public_path('assets/reports/seqfast-logo.png')}}" alt="" style="width: inherit;">
                                        </div>
                                        <img src="{{ public_path('assets/reports/inner-header-bg.png')}}" alt="" style="width: 450px; height:auto; position: relative; right:0px; top:0;">
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>

            </td>
        </tr>
        <!-- page 2 content -->
        <tr>
            <td>
                <!-- Inner page Content (Page 2) -->
                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td>
                            <table cellpadding="0" cellspacing="0" style="width: 94%; border: 0; border-collapse: collapse; margin: auto;">
                            
                                <tr>
                                    <td style="border-bottom: 3px solid #E60A00;">
                                         <div style="align-items: center; color: #fff; font-size: 18px; font-weight: 600; overflow:hidden; height: 32px;">
                                            <div style="float:left; padding: 1px 10px 3px 10px; background: #E60A00; margin-bottom: 0px;">Physical Fitness Assessment for CWSN</div>

                                            <div style="float:left; transform: skew(25deg,0deg); display:inline-block; width: 20px; height: 32px; background: #E60A00; position: relative; right: 10px;"></div>
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
                                                            <td style="width: 100%;" colspan="2">
                                                                <table border="1" cellpadding="0" cellspacing="0" style="width: 100%; border: 1px solid orange; font-size: 13px; border-collapse: collapse; color:#333;">
                                                                    <tr style="background-color: #fecd0a;">
                                                                        <td style="width: 20%; background-color:#0A87CD; padding: 0px 4px 2px 6px; border: 1px solid #0A87CD; color:#fff; text-align: center; font-weight: bold;" rowspan="2">Current Term</td>
                                                                        <td style="width: 25%; padding: 0px 4px 2px 6px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">Date</td>
                                                                        <td style="width: 20%; padding: 0px 4px 2px 6px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">Weight (kg)</td>
                                                                        <td style="width: 20%; padding: 0px 4px 2px 6px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">Height (cm)</td>
                                                                        <td style="width: 36%; padding: 0px 4px 2px 6px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">BMI</td>
                                                                        <td style="padding: 0px 4px 2px 6px; border: 1px solid orange; color:#000; font-weight: bold; text-align: center;">Minimal</td>
                                                                        <td style="padding: 0px 4px 2px 6px; border: 1px solid orange; color:#000; font-weight: bold; text-align: center;">Preferred</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td style="padding: 0px 4px 2px 6px; font-weight: 500; color:#000; text-align: center;">{{ $value['Current_Term'][0]['created_at'] ?? '---'}}</td>
                                                                        <td style="padding: 0px 4px 2px 6px; text-align: center; border: 1px solid orange;">{{ $value['Current_Term'][0]['weight'] ?? '---'}}</td>
                                                                        <td style="padding: 0px 4px 2px 6px; text-align: center; border: 1px solid orange;">{{ $value['Current_Term'][0]['height'] ?? '---'}}</td>
                                                                        <td style="padding: 0px 4px 2px 6px; text-align: center; border: 1px solid orange;">{{ $value['Current_Term'][0]['score'] ?? '---'}}</td>
                                                                        <td style="padding: 0px 4px 2px 6px; text-align: center; border: 1px solid orange;">{{ $value['Current_Term'][0]['minimal'] ?? '---'}}</td>
                                                                        <td style="padding: 0px 4px 2px 6px; text-align: center; border: 1px solid orange;">{{ $value['Current_Term'][0]['preferred'] ?? '---'}}</td>

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
                                                            <td style="width: 100%;">
                                                                <table border="1" cellpadding="0" cellspacing="0" style="width: 100%; border: 1px solid orange; font-size: 13px; border-collapse: collapse; color:#333;">
                                                                    <tr style="background-color: #fecd0a;">
                                                                        <td style="width: 20%; background-color:#0A87CD; border: 1px solid orange; color:#fff; text-align: center; font-weight: bold;" rowspan="2">Current Term</td>
                                                                        <td style="width: 20%; padding: 4px 4px 4px 6px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">Date</td>
                                                                        <td style="width: 20%; padding: 4px 4px 4px 6px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">Score</td>
                                                                        <td style="width: 20%; padding: 4px 4px 4px 6px; border: 1px solid orange; color:#000; font-weight: bold; text-align: center;">Minimal</td>
                                                                        <td style="width: 20%; padding: 4px 4px 4px 6px; border: 1px solid orange; color:#000; font-weight: bold; text-align: center;">Preferred</td>
                                                                    </tr>
                                                                    <tr>                
                                                                        <td style="padding: 4px 4px 4px 6px; font-weight: 500; color:#000; text-align: center;">{{ $value['Current_Term'][0]['created_at'] ?? '---'}}</td>
                                                                        <td style="border: 1px solid orange; text-align: center;">{{ $value['Current_Term'][0]['score'] ?? '---'}}</td>
                                                                        <td style="border: 1px solid orange; text-align: center;">{{ $value['Current_Term'][0]['minimal'] ?? '---'}}</td>
                                                                        <td style="border: 1px solid orange; text-align: center;">{{ $value['Current_Term'][0]['preferred'] ?? '---'}}</td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>

                                                    </table>

                                                </td>

                                            </tr>
                                            <tr>
                                                <td>
                                                    <table border="1" cellpadding="0" cellspacing="0" style="width: 100%; border: 1px solid orange; border-top: none;  font-size: 13px; border-collapse: collapse; color:#333;">
                                                        <tr>
                                                            <td style="width: 20%; border-top: 1px solid #00A923; background-color: #00A923; padding: 0px 4px 2px 4px; padding: 0px 10px 3px 10px; color: #fff; text-align: center; font-weight: bold;">Recommendation</td>
                                                            <td style="width: 80%; padding:0px 4px 2px 8px; line-height:14px; font-size:13px;">{{ $value['Current_Term'][0]['recommendation'] ?? '---' }}</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>

                                </tr>

                                @endif
                                
                                @endforeach

                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <!-- page 2 footer -->
        <tr>
            <td style="height: 35%; vertical-align: bottom;">
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
                                            <img src="{{ public_path('assets/reports/fitness365-logo-web.png')}}" alt="fitness365 logo" style="height:28px;">
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
    </table>
    <!-- End of page 2 -->

    <!-- Page 3 -->
    <table border="0" cellpadding="0" cellspacing="0" style="width:100%; height: 100%; page-break-before: always;">
       <!-- page 3 header  -->
        <tr>
            <td>
                <table border="1" cellpadding="0" cellspacing="0" style="width: 100%; border-collapse: collapse; font-family: Roboto Condensed, sans-serif; font-size: 12px; border:0px solid transparent;">
                    <tr>
                        <td style="vertical-align: top; height: 100px;">
                            <table cellpadding="0" cellspacing="0" style="width: 100%; border:0;">
                                <tr>

                                    <td style="width:300px;">
                                        @if(!empty($studentsData->logo))
                                        <div style="position: absolute; top: 17px; left:30px; display: flex; align-items: center; z-index: 1; width: auto; overflow: hidden;">
                                            <img src="{{ public_path('assets/uploads/logos/' . $studentsData->logo )}}" alt="" style="width: auto; height:60px;">
                                        </div>
                                        @else 
                                        <div style="margin-left: 30px; margin-top: 30px;">
                                            School Logo -1
                                        </div>
                                        @endif 
                                    </td>


                                    <td rowspan="2" style="position: relative; vertical-align: top; width: auto; text-align: right;">
                                        <div style="position: absolute; top: 30px; right:30px; display: flex; align-items: center; z-index: 1; width: 90px; overflow: hidden;">
                                            <img src="{{ public_path('assets/reports/seqfast-logo.png')}}" alt="" style="width: inherit;">
                                        </div>
                                        <img src="{{ public_path('assets/reports/inner-header-bg.png')}}" alt="" style="width: 450px; height:auto; position: relative; right:0px; top:0;">
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <!-- page 3 content -->
        <tr>
            <td style="padding:0; margin:0;">

                <table class="p3-content" cellpadding="0" cellspacing="0" style="width:94%; border:0; border-collapse:collapse; margin:0 auto; padding:0; color:#333; font-size:12px;">

                    <!-- CWSN INTRODUCTION -->
                    <tr>
                        <td style="border:1px solid #ED6D1E; padding:7px 10px 9px 10px; background:#FEFBEF; text-align:left;">
                            <h3 style="color:#ED6D1E; margin:0 0 3px 0; font-size:18px; text-align:left;">
                                CWSN – ADAPTED PHYSICAL FITNESS
                            </h3>

                            <p style="line-height:15px; margin:3px 0; text-align:left;">
                                Physical fitness assessment for Children With Special Needs (CWSN) is
                                individualized according to the child's functional ability, disability,
                                mobility and level of support required.
                            </p>

                            <p style="line-height:15px; margin:3px 0; text-align:left;">
                                The assessment may use adapted or alternative test items where required.
                                Results should be interpreted using the appropriate adapted/general
                                fitness standard for the selected test and disability category.
                            </p>

                            <p style="line-height:15px; margin:3px 0; text-align:left;">
                                Activities should be performed safely and progressively according to the
                                child's ability and the school's adapted physical education programme.
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td style="height:8px; padding:0;"></td>
                    </tr>

                    <!-- ASSESSMENT COMPONENTS -->
                    <tr>
                        <td style="padding:0;">

                            <table cellpadding="0" cellspacing="0"
                                style="width:100%; border:0; border-collapse:collapse; margin:0; padding:0;">

                                <tr>
                                    <td colspan="2" style="padding:0; text-align:left;">
                                        <h3 style="color:#000; font-size:16px; margin:0 0 8px 0; text-align:left;">
                                            CWSN Physical Fitness Assessment Components
                                        </h3>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="width:50%; padding:0 25px 8px 0; vertical-align:top; text-align:left;">
                                        <h4 style="color:#000; margin:0 0 3px 0; font-size:13px; text-align:left;">
                                            1. Aerobic Capacity
                                        </h4>

                                        <p style="margin:0; line-height:14px; text-align:left;">
                                            20-m PACER, 15-m PACER and One Mile Run/Walk are used to assess
                                            aerobic capacity and cardiorespiratory endurance, with the
                                            appropriate test selected according to the child's functional ability.
                                        </p>
                                    </td>

                                    <td style="width:50%; padding:0 25px 0 0; vertical-align:top; text-align:left;">
                                        <h4 style="color:#000; margin:0 0 3px 0; font-size:13px; text-align:left;">
                                            2. Strength &amp; Endurance
                                        </h4>

                                        <p style="margin:0; line-height:14px; text-align:left;">
                                            Curl-up, Modified Curl-up, Dumbbell Press, Pull-up, Push-up,
                                            Seated Push-up, Trunk Lift, Isometric Push-up, Reverse Curl,
                                            Modified Pull-Up and 40-Meter Push/Walk Test are used to assess
                                            muscular strength and endurance according to the child's
                                            functional ability.
                                        </p>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="height:5px; padding:0;"></td>
                                    <td style="height:5px; padding:0;"></td>
                                </tr>

                                <tr>
                                    <td style="width:50%; padding:0; vertical-align:top; text-align:left;">
                                        <h4 style="color:#000; margin:0 0 3px 0; font-size:13px; text-align:left;">
                                            3. Flexibility
                                        </h4>

                                        <p style="margin:0; line-height:14px; text-align:left;">
                                            Shoulder Stretch, Back Saver Sit and Reach and Modified Apley Test
                                            are used to assess flexibility and range of motion, with the
                                            appropriate test selected according to the child's functional ability.
                                        </p>
                                    </td>

                                    <td style="width:50%; padding:0 0 8px 0; vertical-align:top; text-align:left;">
                                        <h4 style="color:#000; margin:0 0 3px 0; font-size:13px; text-align:left;">
                                            2. Body Composition
                                        </h4>

                                        <p style="margin:0; line-height:14px; text-align:left;">
                                            BMI, skinfolds or percentage body fat may be used when
                                            appropriate for the child's disability and assessment protocol.
                                        </p>
                                    </td>
                                </tr>

                            </table>

                        </td>
                    </tr>
                    <!-- FITNESS ZONE INTERPRETATION -->
                    <tr>
                        <td style="border:1px solid #ED6D1E; padding:7px 10px; background:#FEFBEF; text-align:left;">

                            <h4 style="color:#ED6D1E; margin:0 0 4px 0; font-size:15px; text-align:left;">
                                Interpretation of CWSN Fitness Results
                            </h4>

                            <p style="line-height:14px; margin:3px 0; text-align:left;">
                                Fitness results should be interpreted against the standard applicable to
                                the selected test and the child's disability/functional profile.
                            </p>

                            <p style="line-height:14px; margin:3px 0; text-align:left;">
                                Where an Adapted Fitness Zone (AFZ) is available, it may be used to identify
                                an attainable level of health-related fitness. A Healthy Fitness Zone (HFZ)
                                may be used where the applicable general standard is appropriate.
                            </p>

                            <p style="line-height:14px; margin:3px 0; text-align:left;">
                                For children requiring extensive support, assessment may focus on functional
                                physical activity and individualized goals rather than applying a single
                                universal benchmark.
                            </p>

                        </td>
                    </tr>


                    <!-- IMPORTANT NOTE -->
                    <tr>
                        <td style="font-size:11px; line-height:14px; color:#555; padding:0; text-align:left;">

                            <strong>Note:</strong>
                            CWSN fitness assessment is not intended to compare every child against one
                            common physical-fitness benchmark. Test selection, adaptations and interpretation
                            should be based on the child's disability, functional ability and the assessment
                            protocol used by the school/qualified physical education professional.

                        </td>
                    </tr>

                </table>

            </td>
        </tr>
        <!-- page 3 footer -->
        <tr>
            <td style="height:14%; vertical-align: bottom;">
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
                                <td style="background-color: #E60A00; height: 32px; width: 30%; padding: 0 30px; color:#fff;">Physical Health and Fitness Assessment</td>
                                <td style="background-color: #fecd0a; height: 32px; width: 30%; padding: 0 30px; text-align:right;">Powered by <span style="font-weight:500;">fitness365.me</span></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </td>            
        </tr>
        
    </table>
    <!-- End of page 3 -->

</body>

</html>