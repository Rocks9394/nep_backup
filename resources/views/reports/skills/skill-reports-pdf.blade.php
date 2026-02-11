<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Report (PDF)</title>

    <style>
        @page {
            size: A4;
            margin: 10mm;
        }

        body {
            font-family: DejaVu Sans, 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 10pt;
            color: #222;
            margin: 0;
            padding: 0;
            background: #fff;
        }

        .container {
            width: 100%;
            background: #fff;
            position: relative;
            height: 100%;
        }

        .header {
            padding: 20px 25px;
        }

        /* 🔥 PDF SAFE HEADER */
        .header-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .header-table td {
            vertical-align: middle;
        }

        .header-logo-left {
            width: 20%;
            text-align: left;
        }

        .header-title {
            width: 60%;
            text-align: center;
            font-size: 18px;
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        .header-logo-right {
            width: 20%;
            text-align: right;
        }

        .header-table img {
            height: 60px;
        }

        .student-details {
            width: 100%;
            border-collapse: collapse;
            font-size: 11px;
        }

        .student-details th,
        .student-details td {
            border: 1px solid #d4dce6;
            padding: 8px 10px;
        }

        .student-details th {
            background: #e8f0f8;
            font-weight: 700;
            text-align: left;
            width: 18%;
        }

        .student-details td {
            width: 32%;
            color: #334e68;
        }

        .report-content {
            padding: 25px;
        }

        .report-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 9pt;
        }

        .report-table th {
            background: #222;
            color: #fff;
            padding: 8px;
            border: 1px solid #333;
            white-space: nowrap;
        }

        .report-table th.center {
            text-align: center;
        }

        .report-table td {
            border: 1px solid #e0e0e0;
            padding: 6px;
            vertical-align: middle;
        }

        .skill-area {
            font-weight: bold;
            background: #fafafa;
        }

        .stars {
            text-align: center;
            font-size: 11pt;
            white-space: nowrap;
            padding: 0 5px;
        }

        .star-filled {
            color: #ffc107;
        }

        .star-empty {
            color: #ddd;
        }

        .signatures {
            position: fixed;
            bottom: 10mm;
            left: 10mm;
            right: 10mm;
        }


        .signature-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .signature-table td {
            width: 50%;
            vertical-align: top;
        }

        .signature-table td:first-child {
            text-align: left;
        }

        .signature-table td:last-child {
            text-align: right;
        }


        .signature-name {
            font-weight: bold;
            text-align:center;
            margin-bottom: 4px;
        }

        .signature-title {
            font-size: 9pt;
            text-align:center;
        }

        .signature-org {
            font-size: 8.5pt;
            text-align:center;
            color: #666;
        }
    </style>
</head>

<body>
<div class="container">

    <!-- HEADER -->
    <div class="header">

        <table class="header-table">
            <tr>
                <td class="header-logo-left">
                    <img src="{{ public_path('assets/reports/seqfast-logo.png')}}" width="80">
                </td>

                <td class="header-title">
                    P.E. Class Activities & Teacher Observations
                </td>

                <td class="header-logo-right">
                    @if(!empty($school->logo))                                        
                        <img src="{{ public_path('assets/uploads/logos/' . $school->logo) }}" alt="" style="width: auto; height: 50px; object-fit: contain;">
                    
                    @else
                        <img src="{{ public_path('assets/uploads/logos/default_school-logo.png' )}}" alt="" style="width: auto; height: 50px; object-fit: contain;">
                      
                    @endif
                </td>
            </tr>
        </table>

        @php
            use Carbon\Carbon;
            $dob = Carbon::parse($student->dob);
            $formattedDob = $dob->format('d M Y');
            $age = $dob->age;
            $gender = strtolower($student->gender) === 'male' ? 'Boy' : 'Girl';
        @endphp

        <!-- STUDENT DETAILS -->
        <table class="student-details">
            <tr>
                <th>Name</th>
                <td>{{ $student->student_name }}</td>
                <th>Class</th>
                <td>{{ $student->classname }}-{{ $student->section }}</td>
            </tr>
            <tr>
                <th>Roll No</th>
                <td>{{ $student->rollno }}</td>
                <th>Registration No</th>
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
                <td>{{ $school->school_code }}</td>
                <th>School Name</th>
                <td>{{ $school->school_name }}</td>
            </tr>
        </table>
    </div>

    <!-- REPORT TABLE -->
    <div class="report-content">
        <table class="report-table">
            <tr>
                <th>Skill Area</th>
                <th>Activity</th>
                <th>Technique</th>
                <th class="center" colspan="6">Rating</th>
                <th>Level</th>
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
                        </tr>
                    @endforeach

                @endif

            @endforeach
        </table>

    </div>

    <!-- SIGNATURES -->
    <div class="signatures">
        <table class="signature-table">
            <tr>
                <td>
                    <div class="signature-name">Rashmi Sharma</div>
                    <div class="signature-title">Director</div>
                    <div class="signature-org">Sequoia Fitness & Sports Technology</div>
                </td>
                <td style="width: 30%;"></td>
                <td>
                    <div class="signature-name">{{ $school->school_principal }}</div>
                    <div class="signature-title">Principal</div>
                    <div class="signature-org">{{ $school->school_name }}</div>
                </td>
            </tr>
        </table>
    </div>

</div>
</body>
</html>
