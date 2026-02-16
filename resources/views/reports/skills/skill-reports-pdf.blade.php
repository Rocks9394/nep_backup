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
        font-family:DejaVu Sans, "Roboto Condensed", sans-serif;
        font-size: 12px;
        margin: 0;
        padding: 0;
    }

    .container {
        width: 100%;        
    }

    table {
        border-collapse: collapse;
        width: 100%;
    }

    /* Header */
    .header-table {
        background: #0A87CD;
        color: #fff;
    }

    .header-title {
        font-size: 22px;
        font-weight: bold;
        text-align: center;
        padding: 15px 0;
        text-transform: uppercase;
    }
    .table-wrapper {
        margin:0 15px !important;
    }

    /* Student Details */
    .student-details{
        width: 100%;
        border-collapse: collapse;
        font-size: 9pt;
        flex: 1;
        table-layout: fixed;
    }
    .student-details th {
        background: #e8f0f8;
        padding: 6px;
        text-align: left;
        border: 1px solid #d4dce6;
        font-weight: bold;
        width: 20%;
    }

    .student-details td {
        padding: 6px;
        border: 1px solid #d4dce6;
        width: 30%;
    }

    /* Skill Title */
    .skill-title {
        background: #0A87CD;
        margin:0 15px !important;
        color: #fff;
        font-weight: bold;
        padding: 6px 10px;
        font-size: 14px;
    }

    .report-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 9pt;
        flex: 1;
        table-layout: fixed;
    }
    .report-table th {
        background: #fecd0a;
        text-align: left;
        color: #000;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .report-table th,
    .report-table td {
        border: 1px solid orange;
        font-size: 9pt;
        padding: 6px;
    }

    .report-table th:nth-child(1),
    .report-table td:nth-child(1) { 
        width: 15%; 
    }

    .report-table th:nth-child(2),
    .report-table td:nth-child(2) { 
        width: 18%; 
    }

    .report-table th:nth-child(3),
    .report-table td:nth-child(3) { 
        width: 12%; 
    }

    .report-table th:nth-child(4),
    .report-table td:nth-child(4) { 
        width: 20%; 
    }

    .report-table th:nth-child(5),
    .report-table td:nth-child(5) { 
        width: 40%; 
    }
    .report-table td.stars {
        text-align: center;
        font-size: 12pt;
        width: 20%;
    }

    .star-filled {
        color: #ffc107;
    }

    .star-empty {
        color: #ddd;
    }

    .signature-footer {
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 100px;
    }

    .signature-table {
        width: 100%;
        padding: 0 40px 20px 40px;
    }

    .signature-table td {
        text-align: center;
        vertical-align: bottom;
    }
</style>
</head>

<body>
<div class="container">
    <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0px; height: 70px;">
        <tr style="background-color:#0A87CD;">
            <td style="width:5%;"></td>
            <td style="position: relative; vertical-align: top; width: 20%; height:70px;">
                <div style="position: absolute; top: 0; display: flex; align-items: flex-start; left: -3px; z-index: 10; width: 130px; overflow: hidden;">
                    <div class="logo" style="position: relative; width: inherit;">
                        <span style="position: absolute; top:0; left:0; width: inherit; padding: 20px; box-sizing: border-box; display:inline-block;">
                            <img src="{{ public_path('assets/reports/seqfast-logo.png')}}" alt="" style="width: 95px;margin-top: 0px;">
                        </span>
                        <img src="{{ public_path('assets/reports/logo-bg.jpg')}}" alt="" style="width: 130px;height: 140px;margin-top: -35px;">
                    </div>
                </div>
                <img src="{{ public_path('assets/reports/yellow-dot.png')}}" alt="" style="width: 35px;height: 35px;position: relative;left:124px;top: -5px;">
            </td>
            <td style="width: 50%;">
                <div style="padding: 20px 5px 20px 5px;font-weight: 600; font-size: 26px; color:#fff; text-align:center; text-transform: uppercase;">Formative Assessment Report
                </div>
            </td>
            <td style="position: relative; vertical-align: top; width: 20%; height:70px;">
                <img src="{{ public_path('assets/reports/yellow-dot.png')}}" alt="" style="width: 35px;height: 35px;position: relative;top: 0px;">
                <div style="position: absolute; top: 0; display: flex; align-items: flex-start; z-index: 10; width: 130px; overflow: hidden;left: 32px;">
                    <div class="logo" style="position: relative; width: inherit;">
                        <span style="position: absolute; top:0; left:0; width: inherit; padding: 20px; box-sizing: border-box; display:inline-block;">
                            <img src="{{ public_path('assets/uploads/logos/' . $school->logo) }}" alt="" style="width: 95px; height:70px;margin-top: 0px;">
                        </span>
                        <img src="{{ public_path('assets/reports/logo-bg.jpg')}}" alt="" style="width: 130px;height: 140px;margin-top: -35px;">
                    </div>
                </div>
            </td>
            <td style="width:5%;"></td>
        </tr>
    </table>

    <br>

    <!-- STUDENT DETAILS -->
    @php
        use Carbon\Carbon;
        $dob = Carbon::parse($student->dob);
        $formattedDob = $dob->format('d M Y');
        $age = $dob->age;
        $gender = strtolower($student->gender) === 'male' ? 'Boy' : 'Girl';
    @endphp

    <div class="table-wrapper">
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
                <td>{{ $school->school_code }}</td>
                <th>School Name</th>
                <td>{{ $school->school_name }}</td>
            </tr>
        </table>
    </table>

    <br><br>
    <div class="table-wrapper">
        <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0; border-collapse: collapse;">
            <tr>
                <td style="border-bottom: 3px solid #E60A00;">
                    <div style="align-items: center; color: #fff; font-size: 18px; font-weight: 600; overflow:hidden; height: 30px;">
                        <div style="float:left; padding: 1px 10px 1px 10px; background: #E60A00; margin-bottom: -3px;">P.E. Class Activities & Formative Assessment</div>

                        <div style="float:left; transform: skew(25deg,0deg); display:inline-block; width: 20px; height: 32px; background: #E60A00; position: relative; right: 10px;"></div>
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <br>

    <!-- SKILLS LOOP -->
    @if($getSkills->isEmpty())
       <h2 style="text-align:center; padding: 5px 10px; font-size: 20px; margin:0 15px; background-color: #fecd0a;font-size: 16px; font-weight: 600;">There is no skill report data</h2>
    @else
        @foreach ($getSkills as $skillName => $sports)

            <div class="skill-title">
                {{ $skillName }}
            </div>
            <div class="table-wrapper">
                <table class="report-table">
                    <tr>
                        <th width="15%">Sport</th>
                        <th width="20%">Activity</th>
                        <th width="15%">Technique</th>
                        <th width="20%">Rating</th>
                        <th width="30%">Observation</th>
                    </tr>

                    @foreach ($sports as $sportName => $activities)

                        @php $rowCount = $activities->count(); @endphp

                        @foreach ($activities as $index => $activity)
                            <tr>

                                @if ($index == 0)
                                    <td rowspan="{{ $rowCount }}">
                                        <strong>{{ $sportName }}</strong>
                                    </td>
                                @endif

                                <td>{{ $activity->title }}</td>

                                <td>{!! $activity->techniques_name !!}</td>

                                <td class="stars">
                                    @for($i = 0; $i < $activity->rating; $i++)
                                        <span class="star-filled">&#9733;</span>
                                    @endfor

                                    @for($i = 0; $i < 6 - $activity->rating; $i++)
                                        <span class="star-empty">&#9734;</span>
                                    @endfor
                                </td>

                                <td>Lorem ipsum dolor sit amet.</td>
                            </tr>
                        @endforeach

                    @endforeach
                </table>
            </div>

            <br>

        @endforeach
    @endif

    <!-- SIGNATURES -->
    <div class="signature-footer">
        <table class="signature-table">
            <tr>
                <td width="50%">
                    <strong>Rashmi Sharma</strong><br>
                    Director<br>
                    Sequoia Fitness & Sports Technology
                </td>

                <td width="50%">
                    <strong>{{ $school->school_principal }}</strong><br>
                    Principal<br>
                    {{ $school->school_name }}
                </td>
            </tr>
        </table>
    </div>


</div>
</body>
</html>
