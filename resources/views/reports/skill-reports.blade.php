<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Report</title>

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f5f6f8;
            color: #222;
            font-size: 10pt;
        }

        .container {
            width: 800px;
            margin: 30px auto;
            background: #fff;
            padding: 25px;
            border: 1px solid #ddd;
        }

        h1 {
            text-align: center;
            font-size: 15pt;
            margin-bottom: 25px;
        }

        /* =====================
           Student Details
        ====================== */
        .student-details {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
            font-size: 9.5pt;
        }

        .student-details th {
            background: #f1f3f5;
            text-align: left;
            padding: 6px 8px;
            width: 20%;
            border: 1px solid #ccc;
            font-weight: bold;
        }

        .student-details td {
            padding: 6px 8px;
            border: 1px solid #ccc;
            width: 30%;
        }

        /* =====================
           Report Table
        ====================== */
        .report-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 9pt;
        }

        .report-table th {
            background: #222;
            color: #fff;
            padding: 8px;
            text-align: left;
            border: 1px solid #333;
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
            font-size: 10pt;
        }

        .star-filled {
            color: #000;
        }

        .star-empty {
            color: #bbb;
        }

        /* =====================
           Signatures
        ====================== */
        .signatures {
            display: flex;
            justify-content: space-between;
            margin-top: 60px;
            text-align: center;
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
    </style>
</head>

<body>
<div class="container">

    <!-- Student Details -->
    <table class="student-details">
        <tr>
            <th>Name</th>
            <td>{{ $student->student_name }}</td>
            <th>Class</th>
            <td>{{ $student->classname.'-'.$student->section }}</td>
        </tr>
        <tr>
            <th>Date of Birth</th>
            <td>{{ $student->dob }}</td>
            <th>Gender</th>
            <td>{{ $student->gender }}</td>
        </tr>
        <tr>
            <th>Weight (kg)</th>
            <td>-</td>
            <th>Height (cm)</th>
            <td>-</td>
        </tr>
    </table>

    <h1>P.E. Class Activities & Teacher Observations</h1>

    <!-- Report Table -->
    <table class="report-table">
        <tr>
            <th>Skill Area</th>
            <th>Activity</th>
            <th>Technique</th>
            <th>Learning Outcome</th>
            <th class="center" colspan="5">Rating</th>
            <th>Level</th>
        </tr>

        @foreach ($getReport as $spval)
            <tr>
                <td class="skill-area" rowspan="{{ $spval->total }}">
                    {{ $spval->sportsskillname }}
                </td>

                @foreach($getSkills as $skval)
                    @foreach($skval as $sskval)
                        @php if($sskval->skill_sports_id != $spval->skill_sports_id) continue; @endphp

                        <td>{{ $sskval->title }}</td>
                        <td>{!! $sskval->techniques_name !!}</td>
                        <td>{!! $sskval->learning_outcomes !!}</td>

                        @for($i=0; $i<$sskval->rating-1; $i++)
                            <td class="stars star-filled">&#9733;</td>
                        @endfor

                        @for($i=0; $i<6-$sskval->rating; $i++)
                            <td class="stars star-empty">&#9734;</td>
                        @endfor

                        <td>{{ $sskval->level_name }}</td>
                    </tr>
                    @endforeach
                @endforeach
        @endforeach
    </table>

    <!-- Signatures -->
    <div class="signatures">
        <div class="signature-block">
            <div class="signature-name">Rashmi Sharma</div>
            <div class="signature-title">Director</div>
            <div class="signature-org">Sequoia Fitness & Sports Technology</div>
        </div>

        <div class="signature-block">
            <div class="signature-name">Manisha Bhagee</div>
            <div class="signature-title">Principal</div>
            <div class="signature-org">The Class of One</div>
        </div>
    </div>

</div>
</body>
</html>
