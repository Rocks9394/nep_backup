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
                                <div style="background:#fff; padding:25px 15px 10px 15px; height:130px; float:left;">
                                    <img src="{{ public_path('assets/reports/seqfast-logo.png')}}" alt="" style="width: auto; height:100px;">
                                </div>
                                <p style="margin-left:30px; float:left; text-align:center; font-size:24px; padding:34px 20px 20px 0px; width:300px; font-weight:600; line-height:24px; color:#fff;">Physical Health and Fitness Assessment (CWSN)</p>
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
                                    <td>
                                        <div style="position:relative;">
                                            <span style="position:absolute; top:-46px; background:rgb(0 0 0/50%); padding:10px; width:170px; z-indix:2; box-sizing: border-box; text-align:center; color:#fff; font-size:16px; text-transform: uppercase;">Session: {{ $academicYear }}</span>
                                            <img src="{{ public_path('assets/reports/aa-bg.png')}}" alt="" style="width:190px; height: 640px;">
                                        </div>
                                    </td>
                                    <td style="vertical-align: top; width: 100%;">
                                        <table cellpadding="0" cellspacing="0" style="width: 90%; border: 0;">
                                            <tr>
                                                <td style="height:30px;"></td>
                                            </tr>
                                            <tr>
                                                <td style="text-align:center;">
                                                    @if(!empty($studentsData->logo)) 
                                                        <img src="{{ public_path('assets/uploads/logos/' . $studentsData->logo) }}" alt="" style="padding: 0px 0px 5px 46px; height: 100px;">
                                                    @else
                                                        <img src="{{ public_path('assets/uploads/logos/default_school-logo.png' )}}" alt="" style="padding: 0px 0px 5px 46px; height: 100px;">      
                                                    @endif
                                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="height:30px;"></td>
                                            </tr>

                                            <tr>
                                                <td style="padding: 1px 30px 5px 46px; font-size: 20px; background: #E60A00; color:#fff; font-size: 24px; font-weight: 500; position:relative;">Student Profile<span style=" position:absolute; top:44px; right:-21px;"><img src="{{ public_path('assets/reports/green-bg.jpg')}}" alt="" style="width:20px;"></span></td>
                                            </tr>
                                            <tr>
                                                <td style="height:10px;"></td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 10px 30px 10px 46px; font-size: 16px; color: #333;">
                                                    <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0px">
                                                        <tr>
                                                            <td colspan="2" style="padding: 6px 0;">
                                                                <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0px">
                                                                    <tr>
                                                                        <td><span style="display: inline-block; margin-right: 3px 10px;">Name</span></td>
                                                                        <td style="border-bottom: 1px solid #e5e5e5; width: 100%; text-align: center; font-weight: 600; font-size: 18px;">{{ $studentsData->student_name }}</td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2" style="padding: 6px 0;">
                                                                <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0px;">
                                                                    <tr>
                                                                        <td><span style="display: inline-block; margin-right: 3px 10px;">Class&nbsp;&&nbsp;Section</span></td>
                                                                        <td style="border-bottom: 1px solid #e5e5e5; width: 100%; text-align: center; font-weight: 600;">{{ $studentsData->display_classname }}-{{ $studentsData->section }}</td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                            
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 6px 0; width:55%;">
                                                                <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0px">
                                                                    <tr>
                                                                        <td><span style="display: inline-block; margin-right: 10px; margin-left: 0px;">Roll&nbsp;No.</span></td>
                                                                        <td style="border-bottom: 1px solid #e5e5e5; width: 100%; text-align: center; font-weight: 600;">{{ $studentsData->rollno ?? ''}}</td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                            <td style="padding: 6px 0;">
                                                                <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0px">
                                                                    <tr>
                                                                        <td><span style="display: inline-block; margin-right: 3px 10px;">&nbsp;Registration&nbsp;No</span></td>
                                                                        <td style="border-bottom: 1px solid #e5e5e5; width: 100%; text-align: center; font-weight: 600;">{{ $studentsData->admissionnumber }}</td>
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
                                                                        <td><span style="display: inline-block; margin-right: 3px 10px; margin-left: 3px 10px;">Gender</span></td>
                                                                        <td style="border-bottom: 1px solid #e5e5e5; width: 100%; text-align: center; font-weight: 600;">{{ $gender }}</td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>

                                                         <tr>
                                                            <td style="height:20px;"></td>
                                                        </tr>

                                                        <tr>
                                                            <td colspan="2" style="padding: 6px 0;">
                                                                <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0px">
                                                                    <tr>
                                                                        <td><span style="display: inline-block; margin-right: 3px 10px;">School</span></td>
                                                                        <td style="border-bottom: 1px solid #e5e5e5; width: 100%; text-align: center; font-weight: 600;">{{ $studentsData->school_name }}</td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 6px 0;">
                                                                <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0px">
                                                                    <tr>
                                                                        <td><span style="display: inline-block; margin-right: 3px 10px;">Code</span></td>
                                                                        <td style="border-bottom: 1px solid #e5e5e5; width: 100%; text-align: center; font-weight: 600;">{{ $studentsData->school_code }}</td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                            <td style="padding: 6px 0;">
                                                                <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0px">
                                                                    <tr>
                                                                        <td style="padding: 0px 0px 2px 0px;">&nbsp;APAAR&nbsp;ID&nbsp;(Optional)</td>
                                                                        <td style="border-bottom: 1px solid #e5e5e5; width: 100%; text-align: center; font-weight: 600;">{{ $studentsData->apaarId ?? ''}}</td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2" style="padding: 6px 0;">
                                                                <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0px;">
                                                                    <tr>
                                                                        <td><span style="display: inline-block; margin-right: 3px 10px;">Disability&nbsp;&nbsp;Category</span></td>
                                                                        <td style="border-bottom: 1px solid #e5e5e5; width: 100%; text-align: center; font-weight: 600;">{{ $studentsData->disability_category }}</td>
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
                                            <div style="float:left; padding: 1px 10px 3px 10px; background: #E60A00; margin-bottom: 0px;">Physical Fitness Assessment for {{ $studentsData->display_classname }}-{{ $studentsData->section }}</div>

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
                                <tr> <td style="height: 4px;"></td></tr>
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
                                                                        <td style="width: 15%; background-color:#0A87CD; padding: 0px 4px 2px 6px; border: 1px solid orange; color:#fff; text-align: center; font-weight: bold;" rowspan="2">Current Term</td>
                                                                        <td style="padding: 4px 0px 4px 0px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">Date</td>
                                                                        <td style="padding: 0px 4px 2px 6px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">Weight (kg)</td>
                                                                        <td style="padding: 0px 4px 2px 6px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">Height (cm)</td>
                                                                        <td style="padding: 0px 4px 2px 6px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">BMI</td>
                                                                        <td style="padding: 0px 4px 2px 6px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">Level</td>
                                                                        </tr>

                                                                    <tr>
                                                                        <td style="padding: 4px 0px 4px 0px; font-weight: 500; color:#000; text-align: center;">{{ $value['Current_Term'][0]['created_at'] ?? '---'}}</td>
                                                                        <td style="padding: 0px 4px 2px 6px; text-align: center; border: 1px solid orange;"> {{ $value['Current_Term'][0]['weight'] ?? '---'}}</td>
                                                                        <td style="padding: 0px 4px 2px 6px; text-align: center; border: 1px solid orange;">  {{ $value['Current_Term'][0]['height'] ?? '---'}}</td>
                                                                        <td style="padding: 0px 4px 2px 6px; text-align: center; border: 1px solid orange;">{{ $value['Current_Term'][0]['score'] ?? '---'}}</td>
                                                                        <td style="padding: 0px 4px 2px 6px; text-align: center; border: 1px solid orange;">{{ $value['Current_Term'][0]['bmiLevel'] ?? '---'}}</td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>

                                                    </table>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <table border="1" cellpadding="0" cellspacing="0" style="width: 100%; border-top: 1px solid transparent; border-left: 1px solid orange; border-right: 1px solid orange; border-bottom: 1px solid orange; font-size: 13px; border-collapse: collapse; color:#333;">
                                                        <tr>
                                                            <td style="width: 15%; border-top: 1px solid #fecd0a; background-color: #fecd0a; color: #000; text-align: center; font-weight: bold; padding: 5px;">Recommendation</td>
                                                            <td style="width: 85%; padding: 4px;">{{ $value['Current_Term'][0]['recommendation'] ?? '---' }}</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>

                                        </table>
                                    </td>
                                </tr>

                                @else

                                <tr> <td style="height: 4px;"></td></tr>
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
                                                                <table border="1" cellpadding="0" cellspacing="0" style="width: 100%; border: 1px solid orange; border-bottom: 1px solid orange; font-size: 13px; border-collapse: collapse; color:#333;">
                                                                    <tr style="background-color: #fecd0a;">
                                                                        <td style="width: 15%; background-color:#0A87CD; border: 1px solid orange; color:#fff; text-align: center; font-weight: bold;" rowspan="2">Current Term</td>
                                                                        <td style="width: 15%; padding: 4px 4px 4px 6px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">Date</td>
                                                                        <td style="width: 25%; padding: 4px 4px 4px 6px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">Score</td>
                                                                        <td style="width: 15%; padding: 4px 4px 4px 6px; border: 1px solid orange; color:#000; font-weight: bold; text-align: center;">NI</td>
                                                                        <td style="width: 15%; padding: 4px 4px 4px 6px; border: 1px solid orange; color:#000; font-weight: bold; text-align: center;">AFZ</td>
                                                                        <td style="width: 15%; padding: 4px 4px 4px 6px; border: 1px solid orange; color:#000; font-weight: bold; text-align: center;">HFZ</td>
                                                                    </tr>
                                                                    <tr>                
                                                                        <td style="padding: 4px 4px 4px 6px; font-weight: 500; color:#000; text-align: center;">{{ $value['Current_Term'][0]['created_at'] ?? '---'}}</td>
                                                                        <td style="text-align: center; border: 1px solid orange;">{{ $value['Current_Term'][0]['score'] ?? '---'}}</td>
                                                                        <td style="text-align: center; border: 1px solid orange;">{{ $value['Current_Term'][0]['ni'] ?? '---'}}</td>
                                                                        <td style="text-align: center; border: 1px solid orange;">{{ $value['Current_Term'][0]['afz'] ?? '---'}}</td>
                                                                        <td style="text-align: center; border: 1px solid orange;">{{ $value['Current_Term'][0]['hfz'] ?? '---'}}</td>
                                                                    </tr>

                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <table border="1" cellpadding="0" cellspacing="0" style="width: 100%; border-top: 1px solid transparent; border-left: 1px solid orange; border-right: 1px solid orange; border-bottom: 1px solid orange; font-size: 13px; border-collapse: collapse; color:#333;">
                                                        <tr>
                                                            <td style="width: 15%; border-top: 1px solid #fecd0a; background-color: #fecd0a; color: #000; text-align: center; font-weight: bold; padding: 5px;">Recommendation</td>
                                                            <td style="width: 85%; padding: 4px;">{{ $value['Current_Term'][0]['recommendation'] ?? '---' }}</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>                    
                                @endif

                                @endforeach
                                <tr> <td style="height: 15px;"></td></tr>

                                <tr>
                                    <td>
                                        <table cellpadding="0" cellspacing="0" style="width:100%; border-collapse:collapse; font-size: 13px; color:#333;">
                                            <tbody>
                                                <tr style="background-color:#0A87CD;">
                                                    <td colspan="4"
                                                        style="padding:5px 10px; font-weight:bold; color:#fff; font-size:14px; border:1px solid #0A87CD;">
                                                        BMI Benchmarks for {{ $age }} years {{ $gender }}
                                                    </td>
                                                </tr>
                                                <tr style="font-weight:bold; background-color:#fecd0a; font-size: 13px; color:#000; text-align:center;">
                                                    <th style="padding:4px; border:1px solid #0A87CD;">Very Lean</th>
                                                    <th style="padding:4px; border:1px solid #0A87CD;">Healthy Fitness Zone</th>
                                                    <th style="padding:4px; border:1px solid #0A87CD;">Needs improvement</th>
                                                    <th style="padding:4px; border:1px solid #0A87CD;">Health Risk</th>
                                                </tr>

                                                <!-- Values -->
                                                <tr style="text-align:center;">
                                                    @if(is_array($getBmiBenchmark) && count($getBmiBenchmark) > 0)
                                                        <td style="padding:5px 10px; border:1px solid #0A87CD;">{{ $getBmiBenchmark['very_lean'] ?? 'N/A' }}</td>
                                                        <td style="padding:5px 10px; border:1px solid #0A87CD;">{{ $getBmiBenchmark['hfz'] ?? 'N/A' }}</td>
                                                        <td style="padding:5px 10px; border:1px solid #0A87CD;">{{ $getBmiBenchmark['ni'] ?? 'N/A' }}</td>
                                                        <td style="padding:5px 10px; border:1px solid #0A87CD;">{{ $getBmiBenchmark['health_risk'] ?? 'N/A' }}</td>
                                                    @endif
                                                </tr>

                                            </tbody>
                                        </table>

                                    </td>
                                </tr>
                                <tr>
                                    <td style="height: 5px;"></td>
                                </tr>
                                <tr>
                                    <td style="font-size: 12px;">
                                        <p>
                                            <strong>Fitness Zone Abbreviations</strong>:- &nbsp;
                                            <strong>NI:</strong> Needs Improvement &nbsp; | &nbsp;
                                            <strong>AFZ:</strong> Adapted Fitness Zone &nbsp; | &nbsp;
                                            <strong>HFZ:</strong> Healthy Fitness Zone
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="height: 5px;"></td>
                                </tr>   
                                <tr>
                                    <td style="font-size: 13px; letter-spacing: 0.01rem;"><b>Interpretation: </b>You should meet Healthy Fitness Zones (HFZs) for aerobic capacity, flexibility, and body composition; meets Adapted Fitness Zones (AFZs) for selected components where applicable; and falls within the Needs Improvement (NI) zone for components below the applicable fitness-zone standard.
                                    <br><b>Needs: </b>Priorities—Development of upper-body strength/endurance and abdominal strength/endurance. 
                                    </td>
                                </tr>                             
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <!-- page 2 footer -->
        <tr>
            <td style="vertical-align: bottom;">
                <table border="0" cellpadding="0" cellspacing="0" style="width:100%;">
                    <tr>
                        <td style="height: 20px;"></td>
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
                </table>
            </td>
        </tr>
    </table>
    <!-- End of page 2 -->
    
    <!-- Page 3 -->
    <table border="0" cellpadding="0" cellspacing="0" style=" width:100%; height: 297mm; page-break-before: always;">
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

                <table class="p3-content" cellpadding="0" cellspacing="0" style="width:94%; border:0; border-collapse:collapse; margin:0 auto; padding:0; color:#333; font-size:13px;">

                    <!-- CWSN INTRODUCTION -->
                    <tr>
                        <td style="border: 1px solid #00A923; padding: 10px 15px 8px 15px; background:#F2FFF5;">
                            <h3 style="color: #00A923; margin-bottom: 6px; font-size: 18px;">WHO Guidelines on Physical Activity and Sedentary Behaviour 2020</h3>
                            <h4 style="color: #000; margin-bottom: 5px; font-size: 16px;">Physical Activity Guidelines for CWSN</h4>
                            <p><strong>Some physical activity is better than none.</strong> Even when children are not meeting the recommended activity levels, doing some physical activity can provide health benefits.</p>
                            <p>Children should <strong>start with small amounts of physical activity</strong> and gradually increase the frequency, intensity and duration according to their abilities.</p>
                            <p>Physical activity should be appropriate to the child's <strong>current activity level, health status and physical function</strong>. When appropriately adapted, the health benefits generally outweigh the risks.</p>
                            <p>Some children may benefit from guidance from a <strong>health-care professional or physical activity and disability specialist</strong> to determine the type and amount of activity that is appropriate for them.</p>
                        </td>
                    </tr>

                    <!-- RECOMMENDED PHYSICAL ACTIVITIES FOR CWSN -->
                    <tr id="recommended-physical-activities">
                        <td style="height:12px;"></td>
                    </tr>

                    <tr id="recommended-activities-heading">
                        <td>
                            <h3 id="recommended-activities-title"
                                style="color:#000; font-size:16px; margin:0 0 8px 0;">
                                Recommended Activities for Improving Fitness in CWSN
                            </h3>
                        </td>
                    </tr>

                    <tr id="recommended-activities-content">
                        <td>
                            <table id="recommended-activities-table" cellpadding="0" cellspacing="0" style="width:100%; border:0; border-collapse:collapse; color:#333; font-size: 13px;">

                                <!-- Row 1 -->
                                <tr id="recommended-activities-row-1">

                                    <td id="aerobic-activities" style="width:50%; padding:0 25px 8px 0; vertical-align:top;">
                                        <h4 id="aerobic-activities-title" style="color:#000; margin:0 0 3px 0; font-size:13px;">
                                            1. Aerobic-Capacity
                                        </h4>
                                        <p id="aerobic-activities-description" style="margin:0; line-height:14px; font-size:13px;">
                                            One-Mile Run/Walk, 20-m PACER and 15-m PACER according to the child's functional ability.
                                        </p>
                                    </td>    
                                    <td id="flexibility-activities" style="width:50%; padding:0 25px 8px 0; vertical-align:top;">
                                        <h4 id="flexibility-activities-title" style="color:#000; margin:0 0 3px 0; font-size:13px;">
                                            2. Flexibility-related Activities
                                        </h4>

                                        <p id="flexibility-activities-description" style="margin:0; line-height:14px; font-size:13px;">
                                                Back-Saver Sit-and-Reach, Shoulder Stretch and Modified Apley Test according to the child's individual ability.
                                        </p>
                                    </td>                                
                                </tr>

                                <!-- Row 2 -->
                                <tr id="recommended-activities-row-2">
                                    <td id="strength-endurance-activities" style="width:50%; padding:0 0 8px 0; vertical-align:top;">
                                        <h4 id="strength-endurance-activities-title" style="color:#000; margin:0 0 3px 0; font-size:13px;">
                                            3. Strength &amp; Endurance
                                        </h4>
                                        <p id="strength-endurance-activities-description" style="margin:0; line-height:14px; font-size:13px;">
                                            Modified Curl-ups, Seated Push-ups, Push-ups, Pull-ups, Trunk Lift, Reverse Curl and 40-Meter Push/Walk activities according to the child's functional ability.
                                        </p>
                                    </td>
                                    <td id="balance-coordination-activities" style="width:50%; padding:0 0 8px 0; vertical-align:top;">

                                        <h4 id="balance-coordination-activities-title"
                                            style="color:#000; margin:0 0 3px 0; font-size:13px;">
                                            4. Body Composition
                                        </h4>
                                        <p id="balance-coordination-activities-description" style="margin:0; line-height:14px; font-size:13px;"> 
                                            Encourage regular adapted physical activity, active play and healthy eating habits to support healthy body weight according to the child's functional ability and individual needs.
                                        </p>
                                    </td>

                                </tr>                                
                            </table>
                        </td>
                    </tr> 
                    <tr>
                        <td>
                            <h3 id="additional-adapted-activities-title" style="color:#000; font-size:16px;">
                                Adaptation Notes for {{ $studentsData->disability_category }}<sup>*<sup>
                            </h3>
                            <p style="font-size: 13px;">{{ $studentsData->adoptation_note }}</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="line-height: 1;font-size: 12px;">
                            <span>* These notes are general guides. Always follow the student’s Individualized Education Plan (IEP), medical advice, and personal preferences for the safest and most effective activity.</span>
                        </td>   
                    </tr>                    
                    
                </table>

            </td>
        </tr>
       
        <tr>
            <td style="height:150px;"></td>
        </tr>
        <!-- page 3 footer -->
        <tr>
            <td style="vertical-align: bottom; padding-bottom: 10px;">
                <tr>
                    <td>
                        <table cellpadding="0" cellspacing="0" style="width: 94%; border: 0; border-collapse: collapse; margin: auto; color: #333; font-size: 12px;">
                            
                            <tr>
                                <td>
                                    <table border="1" cellpadding="0" cellspacing="0" style="width: 100%; border: 1px solid orange; font-size: 14px; border-collapse: collapse; color:#333;">
                                      
                                    <tr>
                                            <td style="font-weight: 600; padding: 10px 15px; font-size: 14px; color: #000; height:110px; vertical-align:top;">PE Teacher's Observations and Comments (if any)</td>
                                            <td style="font-weight: 600; border:1px solid orange; padding: 10px 15px; font-size: 14px; color: #000; text-align:center; height:100px; vertical-align:bottom;">
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
                        <table cellpadding="0" cellspacing="0" style="width: 100%; border:0; font-size:13px;">
                            <tr>
                                <td style="background-color: #E60A00; height: 40px; padding: 0 30px; color:#fff;">Physical Health and Fitness Assessment</td>
                                <td style="background-color: #00A923; height: 40px; width: 30%; padding: 0 30px; text-align:right; color:#fff;">powered by <strong>fitness365.me</strong></td>
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