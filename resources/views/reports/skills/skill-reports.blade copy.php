<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Report</title>

    <style>
        @page {
            size: A4;
            margin: 15mm;
        }
        body {
            font-family: "Roboto Condensed", sans-serif; 
            font-optical-sizing: auto; 
            background: #fff;
            color: #222;
            font-size: 10pt;
        }

        .container {
            background: #fff;
            padding: 0;
            border: none;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            border-radius: 8px;
            user-select: none;
            cursor: default;
            overflow: hidden;
            width: 100%;
            max-width: 190mm; /* A4 width safe */
            margin: 0 auto;
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
            flex: 1;
        }

        .report-table th {
            color: #000;
            padding: 8px;
            text-align: left;    
            padding: 8px 9px 8px 9px;
            border: 1px solid orange;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 180px;
        }

        .report-table th.center {
            text-align: center;
        }

        .report-table td {            
            border: 1px solid orange;
            padding: 6px;
            vertical-align: middle;
            white-space: normal;
        }

        .skill-area {
            font-weight: bold;
            background: #fafafa;
        }

        .report-table .stars {
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
            display: flex;
            flex-direction: column;
        }

        @media screen {
            body {
                background: #f0f4f9;
            }
        }
    </style>
</head>

<body>
<div class="container">
    <div class="header">
        <div class="logo mb-3 w-100">
            <img src="{{ asset('public/assets/reports/seqfast-logo.png') }}"
                style="width:90px; float:left;">
            <div class="header-title">P.E. Class Activities & Teacher Observations</div>
            <img src="{{ asset('public/assets/uploads/logos/' . $school->logo) }}"
                style="width:90px; float:right;">
        </div>

        <!-- Student Details -->

        @php

            use Carbon\Carbon;
            $dob = Carbon::parse($student->dob); 
            $formattedDob = $dob->format('d M Y'); // 05 Jul 2019
            $age = $dob->age;
                                                                            
            if (strtolower($student->gender) === 'male') {
                $gender = 'Boy';
            } else {
                $gender = 'Girl';
            }
        @endphp
        <table class="student-details">
            <tr>
                <th>Name</th>
                <td>{{ $student->student_name }}</td>
                <th>Class</th>
                <td>{{ $student->classname.'-'.$student->section }}</td>
            </tr>
            <tr>
                <th>Roll No</th>
                <td>{{ $student->rollno }}</td>
                <th>Registration Number</th>
                <td>{{ $student->student_uid }}</td>
            </tr>
            <tr>
                <th>Date of Birth</th>
                <td>{{ $formattedDob }} ({{ $age }} Years)</td>
                <th>Gender</th>
                <td>{{ $gender }}</td>
            </tr>
            <tr>
                <th>Height (cm)</th>
                <td>-</td>
                <th>Weight (kg)</th>
                <td>-</td>
            </tr>
            <tr>
                <th>School Code</th>
                <td>{{$school->school_code}}</td>
                <th>School Name</th>
                <td>{{$school->school_name}}</td>
            </tr>
        </table>
    </div>

    <div class="report-content">

    <!-- Report Table -->
        <!-- <table class="report-table">
            <tr style="background-color: #fecd0a;">
                <th>Skill Area</th>
                <th>Activity</th>
                <th>Technique</th>
                <th class="center" colspan="6">Rating</th>
                <th>Level</th>
                <th>Teacher's Observations</th>
            </tr>

            @foreach ($getReport as $spval)

                @php
                    $activities = $getSkills[$spval->skill_sports_id] ?? collect();
                    $rowCount = $activities->count();
                @endphp

                @if($rowCount > 0)

                    @foreach($activities as $index => $activity)
                        <tr>

                            {{-- Print Skill Area only once --}}
                            @if($index == 0)
                                <td class="skill-area" rowspan="{{ $rowCount }}">
                                    {{ $spval->sportsskillname }}
                                </td>
                            @endif

                            <td>{{ $activity->title }}</td>
                            <td>{!! $activity->techniques_name !!}</td>

                            <td class="stars" colspan="6">
                                @for($i = 0; $i < $activity->rating; $i++)
                                    <span class="star-filled">&#9733;</span>
                                @endfor

                                @for($i = 0; $i < 6 - $activity->rating; $i++)
                                    <span class="star-empty">&#9734;</span>
                                @endfor
                            </td>

                            <td>{{ $activity->level_name }}</td>                            
                            <td>{!! $activity->descriptions !!}</td>
                        </tr>
                    @endforeach

                @endif

            @endforeach
        </table> -->
        <table cellspacing="0" cellpadding="0" style="border-collapse: collapse; margin-bottom: 10px;">
            <tr>
                <td style="border-bottom: 3px solid #E60A00;">
                    <div style="background:#E60A00; float:left; display: inline-flex; align-items: center; color: #fff; font-size: 18px; font-weight: 600; height: 32px;">
                        <div style="float: left; padding: 1px 0px 0px 10px; margin-bottom: -3px;">P.E. Class Activities & Fermative Assessment for {{$student->classname}}</div>
                        <div style="float:left; transform: skew(26deg,0deg); display:inline-block; width: 20px; height: 32px; background: #E60A00; position: relative; right: -10px;"></div>
                    </div>
                </td>
            </tr>
        </table>
        
        @foreach ($getReport as $spval)

            @php
                $activities = $getSkills[$spval->skill_sports_id] ?? collect();
            @endphp

            @if($activities->count() > 0)
                <h2 style="padding: 5px 10px; font-size: 20px; margin:0px; background:#0A87CD; color:#fff; font-size: 16px; font-weight: 600;">{{ $spval->sportsskillname }}</h2>
                <table class="report-table" style="margin-bottom: 30px;">
                    <tr style="background-color: #fecd0a;">
                        <!-- <th>Skill Area</th> -->
                        <th>Technique</th>
                        <th>Activity</th>
                        <th class="center" colspan="6">Rating</th>
                        <th>Level</th>
                        <th>Teacher's Observations</th>
                    </tr>

                    @foreach($activities as $activity)
                        <tr>
                            <!-- <td class="skill-area">
                                {{ $spval->sportsskillname }}
                            </td> -->

                            <td>{!! $activity->techniques_name !!}</td>
                            <td>{{ $activity->title }}</td>

                            <td class="stars" colspan="6">
                                @for($i = 0; $i < $activity->rating; $i++)
                                    <span class="star-filled">&#9733;</span>
                                @endfor

                                @for($i = 0; $i < 6 - $activity->rating; $i++)
                                    <span class="star-empty">&#9734;</span>
                                @endfor
                            </td>

                            <td>{{ $activity->level_name }}</td>

                            <td>{!! $activity->descriptions !!}</td>
                        </tr>
                    @endforeach

                </table>

            @endif

        @endforeach


    </div>

    <!-- Signatures -->
    <div class="signatures">
        <div class="signature-block">
            <div class="signature-name">Rashmi Sharma</div>
            <div class="signature-title">Director</div>
            <div class="signature-org">Sequoia Fitness & Sports Technology</div>
        </div>

        <div class="signature-block">
            <div class="signature-name">{{$school->school_principal}}</div>
            <div class="signature-title">Principal</div>
            <div class="signature-org">{{$school->school_name}}</div>
        </div>
    </div>

</div>
</body>
</html>
