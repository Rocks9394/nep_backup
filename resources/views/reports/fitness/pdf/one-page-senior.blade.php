<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Student Report</title>

<style>
    @page {
        margin: 0;
    }
    body {
        font-family:"Roboto Condensed", sans-serif;
        font-size: 12px;
        margin: 0;
        padding: 0;
        background-image: url("{{ public_path('/assets/uploads/letterhead.png') }}");
        background-repeat: no-repeat;
        background-position: top center;
        background-size: contain;
        background-attachment: fixed;
    }
    .student-details {
        width: 94% !important;
        margin: 0 auto;
        border-collapse: collapse;
        border: 1px solid orange;
        margin-bottom:5px;
    }

    .student-details th,
    .student-details td {
        border: 1px solid orange;
        padding: 4px;
        text-align: left;
    }

    .student-details th {
        background-color: #007BFF;
        color: #ffffff;
    }

    .signature-footer {
        position: fixed;
        bottom: 5px;
        left: 0;
        width: 100%;
    }
</style>
</head>

<body>
    
    <!-- STUDENT DETAILS -->
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
    

    @if(!$isLetterHead)
    <table width="100%" cellpadding="0" cellspacing="0" 
        style="width:94%; border-collapse: collapse; font-family: Roboto Condensed, sans-serif; background-color: #0A87CD; margin:auto;">
        
        <tr>
            <!-- Left Logo -->
            <td width="10%" align="left" style="padding:10px;">
                <div style="background-color:#ffffff; border:5px solid orange; display:inline-block; padding:5px;">
                    <img src="{{ public_path('assets/reports/seqfast-logo.png') }}" 
                        style="width:90px; height:50px; display:block;">
                </div>
            </td>

            <!-- Title -->
            <td width="80%" align="center">
                <div style="font-size:22px; font-weight:bold; color:#fff; text-transform:uppercase; letter-spacing:1px;">
                    Physical Health and Fitness Assessment
                </div>
            </td>

            <!-- Right Logo -->
            <td width="10%" align="right" style="padding:10px;">
                <div style="background-color:#ffffff; border:5px solid orange; display:inline-block; padding:5px;">
                    <img src="{{ public_path('assets/uploads/logos/' . $studentsData->logo) }}" 
                        style="width:90px; height:50px; display:block;">
                </div>
            </td>
        </tr>
    </table>
    @else
    <div style="height:100px;"></div>
    @endif


    <table border="0" cellpadding="0" cellspacing="0" style="width:100%; margin-top:20px;">
        <tr>
            <td>
                <table width="100%" border="0" cellpadding="8" cellspacing="0" 
                    style="width:94%; margin:auto; border-collapse:collapse;border: 1px solid orange; font-size: 13px;">

                    <tr>
                        <td style="background:#0A87CD; color:#fff; font-weight:500; padding:2px 10px;">Name</td>
                        <td style="font-weight:500; border:1px solid orange; padding:2px 10px;">{{ $studentsData->student_name }} ({{ $studentsData->admissionnumber }})</td>

                        <td style="background:#0A87CD; color:#fff; font-weight:500; padding:2px 10px;">Class</td>
                        <td style="font-weight:500; border:1px solid orange; padding:2px 10px;">{{ $studentsData->display_classname.'-'.$studentsData->section }}</td>

                        <td style="background:#0A87CD; color:#fff; font-weight:500; padding:2px 10px;">Roll No</td>
                        <td style="font-weight:500; border:1px solid orange; padding:2px 10px;">{{ $studentsData->rollno }} </td>
                    </tr>   
                    <tr>
                        <td style="background:#0A87CD; color:#fff; font-weight:500; padding:2px 10px;">DOB</td>
                        <td style="font-weight:500; border:1px solid orange; padding:2px 10px;">{{ $formattedDob }} ({{ $age }} Yrs  {{ $gender }})</td>

                        <td style="background:#0A87CD; color:#fff; font-weight:500; padding:2px 10px;">School Code</td>
                        <td style="font-weight:500; border:1px solid orange; padding:2px 10px;">{{ $studentsData->school_code }}</td>

                        <td style="background:#0A87CD; color:#fff; font-weight:500; padding:2px 10px;">School</td>
                        <td style="font-weight:500; border:1px solid orange; padding:2px 10px;">{{ $studentsData->school_name }}</td>
                        
                    </tr>

                </table>
            </td>
        </tr>
    
        <tr>
            <td>
                    <!-- Inner page Content (Page 2) -->
                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td>
                            <table cellpadding="0" cellspacing="0" style="width: 94%; border: 0; border-collapse: collapse; margin: auto;">
                                <tr> <td style="height: 10px;"></td> </tr>
                                <tr>
                                    <td style="border-bottom: 3px solid #E60A00;">
                                            <div style="align-items: center; color: #fff; font-size: 18px; font-weight: 600; overflow:hidden; height: 32px;">
                                            <div style="float:left; padding: 1px 10px 3px 10px; background: #E60A00; margin-bottom: 0px;">Physical Fitness Assessment for {{ $studentsData->class }}-{{ $studentsData->section }}</div>

                                            <div style="float:left; transform: skew(25deg,0deg); display:inline-block; width: 20px; height: 32px; background: #E60A00; position: relative; right: 10px;"></div>
                                        </div>
                                    </td>
                                </tr>                               
                                @foreach($orderedReportData as $key => $value)
                                <tr> <td style="height: 3px;"></td> </tr>
                                @php

                                    $displayKey = str_contains($key, 'Body Composition')  
                                        ? str_replace('Body Composition (BMI)', 'BMI (Body Mass Index)', $key) 
                                        : $key;
                                @endphp
                                
                                
                                <tr>
                                    <td style="padding: 6px 10px 6px 0px; color:#000; font-size: 16px; font-weight: 600;">{{ $displayKey }}</td>
                                </tr>
                            
                                @if($key === 'Body Composition (BMI)')
                                <tr>
                                    <td>
                                        <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0; border-collapse: collapse;">
                                            <tr>
                                                <td style="vertical-align: top;">
                                                    <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
                                                        <tr style="font-size: 13px; line-height: 1rem;">
                                                            <td style="border: 1px solid #0A87CD; border-bottom: none; padding: 0 15px; vertical-align: middle;">
                                                                <ul style="margin: 8px 0; padding-left: 20px;">
                                                                    <li>Height recorded in cm and mm</li>
                                                                    <li>Weight will be recorded in kilogram (kg) and grams(gms)</li>
                                                                </ul>
                                                            </td>

                                                            <td style="border: 1px solid #0A87CD; border-left: none; border-bottom: none; padding: 0 15px; vertical-align: middle;">
                                                                <table border="0" cellpadding="0" cellspacing="0" style="margin: 0;">
                                                                    <tr>
                                                                        <td style="padding-right: 10px; white-space: nowrap;">Body Mass Index =</td>
                                                                        <td style="padding: 0;">
                                                                            <p style="border-bottom: 1px solid #c5c5c5; padding-bottom: 2px; margin: 0; white-space: nowrap;">Weight (in kg)</p>
                                                                            <p style="padding-top: 0; margin: 0; white-space: nowrap;">Height (in m)<sup>2</sup></p>
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
                                                                        <td style="width: 28%; padding: 4px 0px 4px 0px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">Date</td>
                                                                        <td style="width: 25%; padding: 0px 4px 2px 6px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">Weight (kg)</td>
                                                                        <td style="width: 28%; padding: 0px 4px 2px 6px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">Height (cm)</td>
                                                                        <td style="width: 28%; padding: 0px 4px 2px 6px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">BMI</td>
                                                                        <td style="padding: 0px 4px 2px 6px; border: 1px solid orange; color:#000; font-weight: bold; text-align: center;">Level</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td style="padding: 4px 0px 4px 0px; font-weight: 500; color:#000; text-align: center;">{{ $value['Current_Term'][0]['created_at'] ?? '---'}}</td>
                                                                        <td style="padding: 0px 4px 2px 6px; text-align: center; border: 1px solid orange;"> {{ $value['Current_Term'][0]['weight'] ?? '---'}}</td>
                                                                        <td style="padding: 0px 4px 2px 6px; text-align: center; border: 1px solid orange;">  {{ $value['Current_Term'][0]['height'] ?? '---'}}</td>
                                                                        <td style="padding: 0px 4px 2px 6px; text-align: center; border: 1px solid orange;">{{ $value['Current_Term'][0]['score'] ?? '---'}}</td>
                                                                        <td style="padding: 0px 4px 2px 6px; text-align: center; border: 1px solid orange;">{{ $value['Current_Term'][0]['Level'] ?? '---'}}</td>
                                                                    </tr>

                                                                </table>
                                                            </td>

                                                            <td style="width: 50%;">
                                                                <table border="1" cellpadding="0" cellspacing="0" style="width: 100%; border: 1px solid orange; font-size: 13px; border-collapse: collapse; color:#333;">
                                                                    <tr style="background-color: #fecd0a;">
                                                                        <td style="width: 20%; background-color:#0A87CD; padding: 0px 4px 2px 6px; border: 1px solid #0A87CD; color:#fff; text-align: center; font-weight: bold;" rowspan="2">Previous Term</td>
                                                                        <td style="width: 28%; padding: 4px 0px 4px 0px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">Date</td>
                                                                        <td style="width: 25%; padding: 0px 4px 2px 6px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">Weight (kg)</td>
                                                                        <td style="width: 28%; padding: 0px 4px 2px 6px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">Height (cm)</td>
                                                                        <td style="width: 28%; padding: 0px 4px 2px 6px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">BMI</td>
                                                                        <td style="padding: 0px 4px 2px 6px; border: 1px solid orange; color:#000; font-weight: bold; text-align: center;">Level</td>
                                                                    </tr>   

                                                                    <tr>
                                                                        <td style="padding: 0px 4px 2px 6px; font-weight: 500; color:#000; text-align: center;">{{ $value['Previous_Term'][0]['created_at']  ?? '---'}}</td>
                                                                        <td style="padding: 4px 0px 4px 0px;  text-align: center; border: 1px solid orange;">{{ $value['Previous_Term'][0]['weight'] ?? '---'}} </td>
                                                                        <td style="padding: 0px 4px 2px 6px; text-align: center; border: 1px solid orange;">{{ $value['Previous_Term'][0]['height'] ?? '---'}} </td>
                                                                        <td style="padding: 0px 4px 2px 6px; text-align: center; border: 1px solid orange;"> {{ $value['Previous_Term'][0]['score'] ?? '---'}} </td>
                                                                        <td style="padding: 0px 4px 2px 6px; text-align: center; border: 1px solid orange;">{{ $value['Previous_Term'][0]['Level'] ?? '---'}}</td>
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
                                @else
                                <tr>
                                    <td>
                                        <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0; border-collapse: collapse;">
                                            <tr>
                                                <td style="vertical-align: top;">
                                                    <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
                                                        <tr>
                                                            <td style="width: 50%;">
                                                                <table border="1" cellpadding="0" cellspacing="0" style="width: 100%; border: 1px solid orange; font-size: 13px; border-collapse: collapse; color:#333;">
                                                                    <tr style="background-color: #fecd0a;">
                                                                        <td style="width: 20%; background-color:#0A87CD; padding: 0px 4px 2px 6px; border: 1px solid #0A87CD; color:#fff; text-align: center; font-weight: bold;" rowspan="2">Current Term</td>
                                                                        <td style="width: 22%; padding: 0px 4px 2px 6px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">Date</td>
                                                                        <td style="width: 31%; padding: 0px 4px 2px 6px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">Score</td>
                                                                        <td style="padding: 0px 4px 2px 6px; border: 1px solid orange; color:#000; font-weight: bold; text-align: center;">Level</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td style="padding: 0px 4px 2px 6px; font-weight: 500; color:#000; text-align: center; border: 1px solid orange; border-bottom: 1px solid #00A923;">{{ $value['Current_Term'][0]['created_at'] ?? '---'}}</td>
                                                                        <td style="text-align: center; border: 1px solid orange; border-bottom: 1px solid #00A923;">{{ $value['Current_Term'][0]['score'] ?? '---'}}</td>
                                                                        <td style="text-align: center; border: 1px solid orange; border-bottom: 1px solid #00A923;">{{ $value['Current_Term'][0]['Level'] ?? '---'}}</td>

                                                                    </tr>

                                                                </table>
                                                            </td>
                                                            <td style="width: 50%;">
                                                                <table border="1" cellpadding="0" cellspacing="0" style="width: 100%; border: 1px solid orange; font-size: 13px; border-collapse: collapse; color:#333;">
                                                                    <tr style="background-color: #fecd0a;">
                                                                        <td style="font-weight: 500; width: 20%; background-color:#0A87CD; padding: 0px 4px 2px 6px; border: 1px solid #0A87CD; color:#fff; text-align: center;" rowspan="2">Previous Term</td>
                                                                        <td style="font-weight: 500; width: 22%; padding: 0px 4px 2px 6px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">Date</td>
                                                                        <td style="font-weight: 500; width: 31%; padding: 0px 4px 2px 6px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">Score</td>
                                                                        <td style="font-weight: 500; padding: 0px 4px 2px 6px; border: 1px solid orange; color:#000; font-weight: bold; text-align: center;">Level</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td style="padding: 0px 4px 2px 6px; font-weight: 500; color:#000; text-align: center; border: 1px solid orange; border-bottom: 1px solid #00A923;">{{ $value['Previous_Term'][0]['created_at'] ?? '---'}}</td>
                                                                        <td style="text-align: center; border: 1px solid orange; border-bottom: 1px solid #00A923;">{{ $value['Previous_Term'][0]['score'] ?? ''}}</td>
                                                                        <td style="text-align: center; border: 1px solid orange; border-bottom: 1px solid #00A923;">{{ $value['Previous_Term'][0]['Level'] ?? '---'}}</td>

                                                                    </tr>

                                                                </table>
                                                            </td>
                                                        </tr>

                                                    </table>

                                                </td>

                                            </tr>
                                            <tr>
                                                <td>
                                                    <table border="1" cellpadding="0" cellspacing="0" style="width: 100%; border-top: 1px solid transparent; border-left: 1px solid #00A923; border-right: 1px solid #00A923; border-bottom: 1px solid #00A923; font-size: 13px; border-collapse: collapse; color:#333;">
                                                        <tr>
                                                            <td style="border-top: 1px solid #00A923; background-color: #00A923; padding: 0px 4px 2px 4px; padding: 0px 10px 3px 10px; color: #fff; text-align: center; width: 100px; font-weight: bold;">Recommendation</td>
                                                            <td style="padding:0px 4px 2px 8px; line-height:14px; font-size:13px;">{{ $value['Current_Term'][0]['recommendation'] ?? '---' }}</td>
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
    </table>
    
        <!-- Signature -->
    <div class="signature-footer">

        <table border="0" cellpadding="0" cellspacing="0" style="width: 100%; font-size: 14px; border-collapse: collapse; color:#000;">

            <tr>
               
                <td style="width:50%; padding-left:30px; vertical-align:bottom;">
                    @if($studentsData->signature)
                    <div style="padding-left:60px;">
                        <img src="{{ public_path('/assets/uploads/signatures/' . $studentsData->signature) }}"  style="height:60px;">
                    </div>
                    <p style="font-weight:600; margin:2px 0 0 0; text-align:left;">  Signature of Principal with Stamp  </p>
                    @endif
                </td>

                <td style="width:50%; text-align:center;">

                <div style="height:60px;"></div>
                <!-- <p style="font-weight:600;">Parent's Signature</p> -->

                </td>
            </tr>

            <tr>
                <td colspan=2 style="text-align:left; padding-left:30px;">
                    <span style="font-size:12px;">
                        Go to <strong>https://fitness365.me</strong>. Login as <strong>PARENT</strong> with Username: {{ $studentsData->user_id }} and Password: {{$plainPassword}} for reports and activities
                    </span>
                </td>
            </tr>
            
            @if(!$isLetterHead)
            <tr>
                <td style="background:#E60A00;height:40px;padding:0 30px;color:#fff;">
                Physical Health and Fitness Assessment
                </td>

                <td style="background:#00A923;height:40px;padding:0 30px;text-align:right;color:#fff;">
                powered by <strong>fitness365.me</strong>
                </td>
            </tr>
            @else
            <div style="height:30px;"></div>
            @endif

        </table>

    </div>
</body>

</html>
