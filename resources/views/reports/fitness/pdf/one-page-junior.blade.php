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
            font-family: "Roboto Condensed", sans-serif;
            font-size: 10px;
            line-height: 1.15;
            margin: 0;
            padding: 0;
            background-image: url("{{ public_path('/assets/uploads/letterhead.png') }}");
            background-repeat: no-repeat;
            background-position: top center;
            background-size: contain;
            background-attachment: fixed;

            padding-top: 100px;
        }

        h3 {
            margin: 4px 0;
            font-size: 14px;
        }
        .students-detail{
            width:98%;
            margin:auto;
            padding:0 10px 5px 10px;
        }

        .students-detail table td {
            padding: 2px 4px;
        }

        .fitness-title {
            text-align: center;
            font-weight: bold;
            margin: 4px 0;
        }

        .progress-bar {
            width: 100%;
            height: 8px;
            background: #ddd;
            border-radius: 1px;
            overflow: hidden;
        }        

        .progress-fill {
            height: 100%;
        }

        .bmi-bar {
            width: 100%;
            height: 8px;
            background: #ddd;
            border-radius: 1px;
            overflow: hidden;
        }

        .bmi-fill {
            height: 100%;
        }

        .fitness-indicator {
            display: flex;
            justify-content: space-between;
            font-size: 10px;
            margin-top: 2px;
        }

        .fitness-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 3px;
        }

        .fitness-table th,
        .fitness-table td {
            border-bottom: 1px solid #ccc;
            padding: 3px 4px;
            font-size: 10px;
        }

        .signature-footer {
            position: fixed;
            bottom: 40px;
            left: 0;
            width: 100%;
        }
    </style>
</head>

<body>

@php
use Carbon\Carbon;

$dob = Carbon::parse($studentsData->dob);
$formattedDob = $dob->format('d M Y');
$age = $dob->age;

$gender = strtolower($studentsData->gender) === 'male' ? 'Boy' : 'Girl';
$totalLevel = 0;
$totalTests = 0;

foreach($orderedReportData as $key => $value){
    if($key != 'Body Composition (BMI)'){
        $currentCurrlevelText = $value['Current_Term'][0]['Level'] ?? '';
        preg_match('/L(\d+)/', $currentCurrlevelText, $match);
        $currentLevel = !empty($match) ? (int)$match[1] : 0;
        if($currentLevel > 0){
            $totalLevel += $currentLevel;
            $totalTests++;
        }
    }
}

$avgLevel = $totalTests > 0 ? round($totalLevel / $totalTests, 1) : 0;
$avgPercent = round(($avgLevel / 8) * 100, 0);

$levelColor = [
    0 => '#ffffff',
    1 => '#f44336',
    2 => '#ff5722',
    3 => '#ff9800',
    4 => '#ffc107',
    5 => '#8bc34a',
    6 => '#4caf50',
    7 => '#388e3c',
    8 => '#2e7d32'
];
@endphp

<!-- STUDENT DETAILS -->
<div class="students-detail">
    <h3 style="text-align:center;font-size:16px;">Fitness Assessment Report</h3>
    <div style="width:100%;display:table;border-bottom:1px solid grey;">

        <!-- LEFT SIDE -->
        <div style="display:table-cell;width:50%;padding-right:5px;vertical-align:top">
            <table style="width:100%">
                <tr>
                    <td><b>Name:</b></td>
                    <td>{{ $studentsData->student_name }} ({{ $studentsData->admissionnumber }})</td>
                </tr>
                <tr>
                    <td><b>Class:</b></td>
                    <td>{{ $studentsData->display_classname.'-'.$studentsData->section }}</td>
                </tr>
                <tr>
                    <td><b>Roll No:</b></td>
                    <td>{{ $studentsData->rollno }}</td>
                </tr>
                <tr>
                    <td><b>DOB/Gender:</b></td>
                    <td>{{ $formattedDob }} ({{ $age }} Yrs {{ $gender }})</td>
                </tr>
                <tr>
                    <td><b>School:</b></td>
                    <td>{{ $studentsData->school_name }} ({{ $studentsData->school_code }})</td>
                </tr>
            </table>
        </div>

        <!-- RIGHT SIDE -->
        <div style="display:table-cell;width:50%;padding:0 0 5px 5px;vertical-align:top">
            <div style="width:100%; max-width:600px; margin:auto; font-family: 'Roboto Condensed', sans-serif; font-size:10px;">
                <!-- Overall Fitness Bar -->
                <div class="progress-bar">
                    @php
                        $overallWidth = ($avgLevel / 8) * 100;
                        $overallColor = $levelColor[ceil($avgLevel)];
                    @endphp
                    <div class="progress-fill" style="width:{{ $overallWidth }}%; background:grey"></div>
                    <!-- <div class="progress-fill" style="width:{{ $overallWidth }}%; background:{{ $overallColor }};"></div> -->
                </div>
                <div class="fitness-indicator">
                    <div style="display:flex; justify-content: space-around; font-size:10px;">
                        <span style="margin-right:32px;">L0</span>
                        <span style="margin-right:32px;">L1</span>
                        <span style="margin-right:32px;">L2</span>
                        <span style="margin-right:32px;">L3</span>
                        <span style="margin-right:32px;">L4</span>
                        <span style="margin-right:32px;">L5</span>
                        <span style="margin-right:32px;">L6</span>
                        <span style="margin-right:32px;">L7</span>
                    </div>
                </div>
            </div>

            <div class="fitness-title" style="font-size:12px;">My Fitness Indicator</div>

            <table class="fitness-table">
                <thead>
                    <tr>
                        <th></th>
                        <th style="text-align:left">Period</th>
                        <th style="text-align:left">Weight</th>
                        <th style="text-align:left">Height</th>
                        <th style="text-align:left">BMI</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orderedReportData as $key => $value)
                        @if($key === 'Body Composition (BMI)')
                            <tr>
                                <td><strong>Current</strong></td>
                                <td>{{ $value['Current_Term'][0]['created_at'] ?? '---' }}</td>
                                <td>{{ $value['Current_Term'][0]['weight'] ?? '---' }}</td>
                                <td>{{ $value['Current_Term'][0]['height'] ?? '---' }}</td>
                                <td>{{ $value['Current_Term'][0]['score'] ?? '---' }} ({{ $value['Current_Term'][0]['Level'] ?? '---' }})</td>
                            </tr>
                            <tr>
                                <td><strong>Previous</strong></td>
                                <td>{{ $value['Previous_Term'][0]['created_at'] ?? '---' }}</td>
                                <td>{{ $value['Previous_Term'][0]['weight'] ?? '---' }}</td>
                                <td>{{ $value['Previous_Term'][0]['height'] ?? '---' }}</td>
                                <td>{{ $value['Previous_Term'][0]['score'] ?? '---' }} ({{ $value['Previous_Term'][0]['Level'] ?? '---' }})</td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<div style="width:98%;margin:auto;padding:0 10px;">
    <h3>My Developmental Skills Score</h3>
    <hr>
    <table style="width:100%; border-collapse:collapse; font-size:10px;">

        <thead style="border-bottom:1px solid #000;">
        <tr>
            <th style="text-align:left; width:15%;">Skill Name</th>
            <th style="text-align:left; width:20%;">Test Name</th>
            <th style="text-align:left; width:10%;">Term</th>
            <th style="text-align:center; width:20%;">Score</th>
            <th style="text-align:left;">Recommendation</th>
        </tr>
        </thead>
        <tbody>
            @foreach($FmsReportData as $key => $reportData)
                @php $rowCount = count($reportData) * 2; @endphp
                @foreach($reportData as $index => $data)

                    <tr>

                        @if($index == 0)
                            <td rowspan="{{ $rowCount }}" style="vertical-align:top; font-weight:bold;">
                                {{ $key }}
                            </td>
                        @endif

                        <td rowspan="2" style="vertical-align:top;">
                            {{ $data['Test_Name'] ?? '' }}
                        </td>

                        <td style="text-align:left;">Current</td>

                        <td style="text-align:center;">
                            @if(!empty($data['current_count']))
                                <img src="{{ public_path('assets/imgs/'.$data['current_count'].'smiles.png') }}" height="15">
                            @else
                                NA
                            @endif
                        </td>

                        <td rowspan="2">
                            {{ $data['recommendation'] ?? '' }}
                        </td>

                    </tr>

                    <tr style="border-bottom:1px solid #ccc;">
                        <td style="text-align:left;">Previous</td>

                        <td style="text-align:center;">
                            @if(!empty($data['previous_count']))
                                <img src="{{ public_path('assets/imgs/'.$data['previous_count'].'smiles.png') }}" height="15">
                            @else
                                NA
                            @endif
                        </td>
                    </tr>

                @endforeach
                <tr style="border-top:1px solid #aaa;">
                    <td colspan="5"></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <table cellpadding="0" cellspacing="0" style="border:1px solid #ccc; width:100%;margin-bottom:5px; margin-top:5px; border-collapse:collapse; font-size:11px;">
        <tbody>
            <tr>
                <td colspan="5"style="padding:4px 6px; font-size:12px; font-weight:bold; border:1px solid #ccc;">
                    Benchmarks for {{ $age }} years {{ $gender }}
                </td>
            </tr>
            <tr style="font-weight:bold; background-color:#ccc; color:#000; text-align:center;">
                <th style="padding:2px; border:1px solid #ccc;"><img src="{{ public_path('assets/imgs/1smiles.png') }}" height="15"></th>
                <th style="padding:2px; border:1px solid #ccc;"><img src="{{ public_path('assets/imgs/2smiles.png') }}" height="15"></th>
                <th style="padding:2px; border:1px solid #ccc;"><img src="{{ public_path('assets/imgs/3smiles.png') }}" height="15"></th>
                <th style="padding:2px; border:1px solid #ccc;"><img src="{{ public_path('assets/imgs/4smiles.png') }}" height="15"></th>
                <th style="padding:2px; border:1px solid #ccc;"><img src="{{ public_path('assets/imgs/5smiles.png') }}" height="15"></th>
            </tr>

            <!-- Values -->
            <tr style="text-align:center;">                
                <td style="border:1px solid #ccc;">Emerging</td>
                <td style="border:1px solid #ccc;">Developing</td>
                <td style="border:1px solid #ccc;">Acquired</td>
                <td style="border:1px solid #ccc;">Advanced</td>
                <td style="border:1px solid #ccc;">Accomplished</td>
            </tr>

        </tbody>
    </table>
</div>
@if(!in_array($studentsData->class_id, [14, 18, 22, 23]))
    <!-- FITNESS SCORE TABLE -->
    <div style="width:98%;margin:auto;padding:10px; page-break-before: always;">
        <hr>
        <h3>My Fitness Score</h3>
        <hr>
        <table style="width:100%;border-collapse:collapse;font-size:10px; margin:auto;">
            <thead style="border-bottom:1px solid">
                <tr>
                    <th style="width:15%;text-align:left">Test Name</th>
                    <th style="width:6%;text-align:left">Term</th>
                    <th style="width:2%;text-align:left">L1</th>
                    <th style="width:2%;text-align:left">L2</th>
                    <th style="width:2%;text-align:left">L3</th>
                    <th style="width:2%;text-align:left">L4</th>
                    <th style="width:2%;text-align:left">L5</th>
                    <th style="width:2%;text-align:left">L6</th>
                    <th style="width:2%;text-align:left">L7</th>
                    <th style="width:10%;text-align:center">My Score</th>
                    <th style="width:10%;text-align:center">Indicator</th>
                    <th style="width:45%;padding-left:10px;text-align:left">Feedback</th>
                </tr>
            </thead>
            <tbody style="padding:0;">
                @foreach($orderedReportData as $key => $value)
                    @php
                        $displayKey = str_contains($key, 'Body Composition')
                            ? str_replace('Body Composition (BMI)', 'BMI (Body Mass Index)', $key)
                            : $key;

                        $currentCurrlevelText = $value['Current_Term'][0]['Level'] ?? null;
                        preg_match('/L(\d+)/', $currentCurrlevelText, $match);
                        $currentLevel = !empty($match) ? (int)$match[1] : 0;

                        $prevCurrlevelText = $value['Previous_Term'][0]['Level'] ?? null;
                        preg_match('/L(\d+)/', $prevCurrlevelText, $matchPrev);
                        $prevLevel = !empty($matchPrev) ? (int)$matchPrev[1] : 0;
                    @endphp

                    @if($key != 'Body Composition (BMI)')
                        <!-- Current -->
                        <tr>
                            <td rowspan="2"><b>{{ $displayKey }}</b></td>
                            <td>Current</td>
                            <td colspan="7">
                                <div class="progress-bar">
                                    @php
                                        $currentWidth = ($currentLevel / 8) * 100;
                                        $overallColor = $levelColor[ceil($currentLevel)];
                                    @endphp
                                    <div class="progress-fill" style="width:{{ $currentWidth }}%; background:grey;"></div>
                                    <!-- <div class="progress-fill" style="width:{{ $currentWidth }}%; background:{{ $overallColor }};"></div> -->
                                </div>
                            </td>
                            <td style="text-align:center">{{ $value['Current_Term'][0]['score'] ?? '---' }}</td>
                            <td style="text-align:center">{{ $value['Current_Term'][0]['Level'] ?? '---' }}</td>
                            <td style="padding-left:8px;">&bull; {{ $value['Current_Term'][0]['recommendation'] ?? '---' }}</td>
                        </tr>
                        <!-- Previous -->
                        <tr>
                            <td>Previous</td>
                            <td colspan="7">
                                <div class="progress-bar">
                                    @php
                                        $previousWidth = ($prevLevel / 8) * 100;
                                        $overallColor = $levelColor[ceil($prevLevel)];
                                    @endphp
                                    <div class="progress-fill" style="width:{{ $previousWidth }}%; background:grey;"></div>
                                    <!-- <div class="progress-fill" style="width:{{ $previousWidth }}%; background:{{ $overallColor }};"></div> -->
                                </div>
                            </td>
                            <td style="text-align:center">{{ $value['Previous_Term'][0]['score'] ?? '---' }}</td>
                            <td style="text-align:center">{{ $value['Previous_Term'][0]['Level'] ?? '---' }}</td>
                            <td style="padding-left:8px;">&bull; {{ $value['Previous_Term'][0]['recommendation'] ?? '---' }}</td>
                        </tr>
                        <tr>
                            <td colspan="12">
                                <hr style="border:0; border-top:1px solid #ccc; margin:0;">
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
        <!-- Fitness Benchmarks  -->
        <table cellpadding="0" cellspacing="0" style="border:1px solid #ccc; width:100%; margin-top:5px; border-collapse:collapse; font-size:11px;">
            <tbody>
                <tr>
                    <td colspan="7"style="padding:4px 6px; font-size:12px; font-weight:bold; border:1px solid #ccc;">
                        Benchmarks for {{ $age }} years {{ $gender }}
                    </td>
                </tr>
                <tr style="font-weight:bold; background-color:#ccc; color:#000; text-align:center;">
                    <th style="border:1px solid #ccc;">L7(>90)</th>
                    <th style="border:1px solid #ccc;">L6(>80)</th>
                    <th style="border:1px solid #ccc;">L5(>70)</th>
                    <th style="border:1px solid #ccc;">L4(>60)</th>
                    <th style="border:1px solid #ccc;">L3(>40)</th>
                    <th style="border:1px solid #ccc;">L2(>20)</th>
                    <th style="border:1px solid #ccc;">L1(>10)</th>
                </tr>

                <!-- Values -->
                <tr style="text-align:center;">                
                    <td style="border:1px solid #ccc;">Sports Fit</td>
                    <td style="border:1px solid #ccc;">Athletic</td>
                    <td style="border:1px solid #ccc;">Very Good</td>
                    <td style="border:1px solid #ccc;">Good</td>
                    <td style="border:1px solid #ccc;">Can do Better</td>
                    <td style="border:1px solid #ccc;">Must Improve</td>
                    <td style="border:1px solid #ccc;">Work Harder</td>
                </tr>

            </tbody>
        </table>

    </div>  
    <div style="display:table;table-layout:fixed;width:98%;margin:auto;padding:5px 2px;">

        <!-- LEFT SIDE -->
        <div style="display:table-cell;width:60%;margin:auto;vertical-align:middle;padding-right:8px;">
            <table style="width:100%;border-collapse:collapse;font-size:11px;border:1px solid #ccc;">
                <tbody>
                    <tr style="font-size:12px; font-weight:bold; background:#ccc;">
                        <td style="padding:1px 2px; border:1px solid #ccc;"></td>
                        <td style="border:1px solid #ccc;text-align:center;">UW</td>
                        <td style="border:1px solid #ccc;text-align:center;">N</td>
                        <td style="border:1px solid #ccc;text-align:center;">OW</td>
                        <td style="border:1px solid #ccc;text-align:center;">OB</td>
                        <td style="border:1px solid #ccc;text-align:center;">Weight</td>
                        <td style="border:1px solid #ccc;text-align:center;">Height</td>
                        <td style="border:1px solid #ccc;">BMI</td>
                    </tr>
                    @foreach($orderedReportData as $key => $value)
                        @php
                            $CurrlevelText = strtolower($value['Current_Term'][0]['Level'] ?? '');
                            $PrevlevelText = strtolower($value['Previous_Term'][0]['Level'] ?? '');
                            $currWidth = 0;
                            $prevWidth = 0;
                            if (str_contains($CurrlevelText, 'uw')) {
                                $currWidth = 25;
                            } elseif (str_contains($CurrlevelText, 'normal')) {
                                $currWidth = 50;
                            } elseif (str_contains($CurrlevelText, 'ow')) {
                                $currWidth = 75;
                            } elseif (str_contains($CurrlevelText, 'ob')) {
                                $currWidth = 100;
                            }
                            if (str_contains($PrevlevelText, 'uw')) {
                                $prevWidth = 25;
                            } elseif (str_contains($PrevlevelText, 'normal')) {
                                $prevWidth = 50;
                            } elseif (str_contains($PrevlevelText, 'ow')) {
                                $prevWidth = 75;
                            } elseif (str_contains($PrevlevelText, 'ob')) {
                                $prevWidth = 100;
                            }
                        @endphp
                        @if($key === 'Body Composition (BMI)')
                            <tr>
                                <td style="padding:2px; font-size:10px;"><strong>Current</strong></td>
                                <td colspan="4">
                                    <div class="bmi-bar">
                                        <div class="bmi-fill"  style="background:grey; width:{{ $currWidth }}%;"></div>
                                    </div>
                                </td>
                                <td style="text-align:center;">{{ $value['Current_Term'][0]['weight'] ?? '---' }}</td>
                                <td style="text-align:center;">{{ $value['Current_Term'][0]['height'] ?? '---' }}</td>
                                <td>{{ $value['Current_Term'][0]['score'] ?? '---' }} ({{ $value['Current_Term'][0]['Level'] ?? '---' }})</td>
                            </tr>
                            <tr>
                                <td style="padding:2px; font-size:10px;"><strong>Previous</strong></td>
                                <td colspan="4">
                                    <div class="bmi-bar">
                                        <div class="bmi-fill"  style="background:grey; width:{{ $prevWidth }}%;"></div>
                                    </div>
                                </td>
                                <td style="text-align:center;">{{ $value['Previous_Term'][0]['weight'] ?? '---' }}</td>
                                <td style="text-align:center;">{{ $value['Previous_Term'][0]['height'] ?? '---' }}</td>
                                <td>{{ $value['Previous_Term'][0]['score'] ?? '---' }} ({{ $value['Previous_Term'][0]['Level'] ?? '---' }})</td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>


        <!-- RIGHT SIDE -->
        <div style="display:table-cell;width:40%;vertical-align:middle;padding-left:8px;">
            <table style="width:100%;border-collapse:collapse;font-size:11px;">
                <tbody>

                    <tr>
                        <td colspan="4" style="padding:3px 6px; font-size:12px; font-weight:bold;border:1px solid #ccc;">
                            BMI Benchmarks for {{ $age }} years {{ $gender }}
                        </td>
                    </tr>

                    <tr style="background:#ccc;text-align:center;font-weight:bold;">
                        <td style="border:1px solid #ccc;">UW</td>
                        <td style="border:1px solid #ccc;">N</td>
                        <td style="border:1px solid #ccc;">OW</td>
                        <td style="border:1px solid #ccc;">OB</td>
                    </tr>

                    <tr style="text-align:center;">
                        <td style="border:1px solid #ccc;">{{ $getBmiBenchmark['UW'] ?? 'N/A' }}</td>
                        <td style="border:1px solid #ccc;">{{ $getBmiBenchmark['N'] ?? 'N/A' }}</td>
                        <td style="border:1px solid #ccc;">{{ $getBmiBenchmark['OW'] ?? 'N/A' }}</td>
                        <td style="border:1px solid #ccc;">{{ $getBmiBenchmark['OB'] ?? 'N/A' }}</td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
@endif
<div style="width:98%;margin:auto;padding:0 10px;">
    <table cellpadding="0" cellspacing="0" style="border:1px solid #ccc; width:100%;margin-bottom:5px; margin-top:5px; border-collapse:collapse; font-size:11px;">
        <tbody>
            <!-- Diet Section -->
            <tr>
                <td style="padding:1px 4px; font-weight:bold;">
                    Diet Recommendations:
                </td>
            </tr>
            <tr>
                <td style="padding:1px 10px;">
                    a. Calorie - Need to be decreased.
                </td>
            </tr>
            <tr>
                <td style="padding:1px 10px;">
                    b. Food Restrictions - Need to restrict food with extra fat.
                </td>
            </tr>
            <tr>
                <td style="padding:1px 10px;">
                    c. Healthier Choices - Replace fast foods and synthetic food items with natural and healthier choices like natural juices instead of sugar coated or aerated drinks.
                </td>
            </tr>
            <!-- Lifestyle Section -->
            <tr>
                <td style="padding:1px 4px; font-weight:bold;">
                    Active Lifestyle to be pursued
                </td>
            </tr>
            <tr>
                <td style="padding:1px 10px;">
                    a. Exercise - Regular exercise is essential and recommended on daily basis.
                </td>
            </tr>
            <tr>
                <td style="padding:1px 10px;">
                    b. Physical Activity - Keep moving is the most efficient way to burn calories and shed excess weight, any extra movement helps burn calories. Involve in household chores and do other basic activities yourself.
                </td>
            </tr>
            <tr>
                <td style="padding:1px 10px;">
                    c. Sports Participation - Regular sports participation is important. Involve in more of endurance sports.
                </td>
            </tr>
        </tbody>
    </table>
</div>

<!-- SIGNATURE -->

<div class="signature-footer">

    <table style="width:100%;font-size:14px">

        <tr>

            <td style="width:50%;padding-left:30px">

                @if($studentsData->signature)

                    <img src="{{ public_path('/assets/uploads/signatures/'.$studentsData->signature) }}" style="height:60px">

                    <p style="font-weight:600;margin:2px 0">
                        Signature of Principal with Stamp
                    </p>

                @endif

            </td>

            <td style="width:50%;text-align:center">
                <div style="height:60px"></div>
            </td>

        </tr>

        <tr>

            <td colspan="2" style="padding-left:30px">

                <span style="font-size:12px">

                    Go to <b>https://fitness365.me</b>.  
                    Login as <b>PARENT</b> with Username:
                    {{ $studentsData->user_id }} and Password: {{ $plainPassword }}

                </span>

            </td>

        </tr>

    </table>

</div>
</body>
</html>