<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Health and Activity Record</title>

    <style>
        body {
            border: 2px solid #000;
            margin: 0;
            padding: 0;
        }
        header h3 {
            margin: 20px 0;
        }
        table th, table td {
            text-align: left;
            vertical-align: middle;
        }
        .table-container {
            overflow-x: auto;
            margin: 0;
            padding: 0;
        }
        .wrapper{
            margin-left: 0;
            margin-right: 0;
            text-align: center;
            max-width: 100%;
            padding: 0;
        }
        .container {
            max-width: 100%;
            padding-right: 0;
            padding-left: 0;
        }
        .table-responsive-sm {
            margin-bottom: 0;
        }
        .score{
            text-align: center;
        }
        @page {
            size: A4 landscape;
            margin: 0;
        }
        table {
            border-collapse: collapse;
        }
    </style>
</head>

<body class="text-center">
    @php  $GetSchoolLogo = Helper::GetSchoolLogo();  @endphp
    <table cellpadding="0" cellspacing="0" style="width: 29.7cm; margin: 0 auto; background-color: #fff;">

        <!-- COVER PAGE -->
        <tr>
            <td>

                <table cellpadding="0" cellspacing="0" style="width: 100%;">

                    <!-- HEADER -->
                    <tr style="background-color: #0A87CD; height: 140px; position:relative; z-index:2;">
                        <td>
                            <table cellpadding="0" cellspacing="0" style="width:100%; height:100%;">
                                <tr>
                                    <td style="width:180px;"></td>

                                    <td style="position: relative; width: 220px;">
                                        <img src="{{ asset('/public/assets/reports/yellow-dot.png') }}"
                                            style="width: 50px;
                                                position: absolute;
                                                left: -50px;
                                                top: -33px;">

                                        <!-- logo wrapper -->
                                        <div style="position:absolute; top:0;">
                                            <img src="{{ asset('/public/assets/reports/logo-bg.jpg') }}"
                                                style="width: 200px; margin-top: -50px;">
                                            <img src="{{ asset('/public/assets/reports/seqfast-logo.png') }}"
                                                style="
                                                    width: 167px;
                                                    position: absolute;
                                                    top: 10px;
                                                    left: 18px;
                                                    z-index: 5;
                                                ">
                                        </div>
                                    </td>

                                    <td>
                                        <div style="margin:40px 60px 0 40px;
                                                    font-size:26px;
                                                    font-weight:600;
                                                    color:#fff;
                                                    text-transform:uppercase;">
                                            Physical Health and Fitness Assessment
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>


                    <tr>
                        <td style="position:relative; z-index:1;">
                            <img src="{{ asset('public/assets/reports/report-cover-img.png') }}"
                                style="width:85%;">

                            <img src="{{ asset('public/assets/reports/report-graphic.png') }}"
                                style="position:absolute; right:40px; top:25%; width:220px;">
                        </td>
                    </tr>


                    <tr>
                        <td>

                            <table cellpadding="0" cellspacing="0" style="width:100%;">

                                <tr>
                                    <td style="width:200px; background:#FBCA01; vertical-align:top; position:relative; z-index:5; margin-top:-120px;">
                                        <div style="position:relative;">
                                            <span style="
                                                position:absolute;
                                                top:-44px;
                                                width:100%;
                                                text-align:center;
                                                background:rgba(0,0,0,0.5);
                                                color:#fff;
                                                padding:10px;
                                                text-transform:uppercase;">
                                                For Senior
                                            </span>
                                            <img src="{{ asset('/public/assets/reports/aa-bg.png') }}"
                                                style="width:200px;">
                                        </div>
                                    </td>
                                    <td style="padding:30px;">
                                        <img src="{{ asset('public/assets/uploads/logos/' . $GetSchoolLogo->logo) }}"
                                            style="height:100px; object-fit:contain;">

                                        <div style="height:20px;"></div>

                                        <div style="
                                            background:#E60A00;
                                            color:#fff;
                                            font-size:24px;
                                            font-weight:500;
                                            padding:12px 20px;
                                            position:relative;
                                            margin-left: -30px;">
                                            Personal Profile
                                            <img src="{{ asset('/public/assets/reports/green-bg.jpg') }}" style="width:20px; position:absolute; right:-20px; top:100%;">
                                        </div>

                                        <div style="height:20px;"></div>

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
                                                <td style="height: 15px;"></td>
                                            </tr>
                                            <!-- <tr>
                                                <td colspan="2" style="padding: 6px 0;">
                                                    <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0px">
                                                        <tr>
                                                            <td><span style="display: inline-block; margin-right: 5px; font-weight:500;">Brief Summary</span></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="border-bottom: 1px solid #ccc; width: 100%; text-align: center; font-weight: 600; height: 24px; padding: 2px 0;"></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="border-bottom: 1px solid #ccc; width: 100%; text-align: center; font-weight: 600; height: 24px; padding: 2px 0;"></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="border-bottom: 1px solid #ccc; width: 100%; text-align: center; font-weight: 600; height: 24px; padding: 2px 0;"></td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr> -->
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


    <div class="container py-4 wrapper">

        <header class="border p-1 mx-3">
            <h3 class="text-center">HEALTH AND ACTIVITY RECORD</h3>
        </header>

        @php
        
            $testMap = [
                'BMI' => 'BMI',
                'Partial Curl up' => 'Partial curl up 30 sec',
                'Flexed/Bent Arm Hang' => 'Flexed/Bent Arm Hang',
                'Sit and Reach' => 'Sit and Reach Test',
                '600 Mtr Run' => '600 meter run/walk',
                'Flamingo Balance Test' => 'Flamingo Balance Test',
                'Shuttle Run' => 'Shuttle Run (4×10 m)',
                'Sprint / Dash' => '50 mt. dash',
                'Standing Vertical Jump' => 'Vertical Jump',
                'Plate Tapping' => 'Plate Tapping',
                'Alternative Hand Wall Toss Test' => 'Alternative Hand Wall Toss Test',
            ];
            $classList = [9,10,11,12];
        @endphp

        @php
            function getScore($groupedReport, $dbTestName) {

                foreach ($groupedReport as $category) {

                    // $category is a Collection (e.g. Cardiovascular Endurance)
                    foreach ($category as $termWiseData) {

                        // $termWiseData is a Collection (e.g. Current_Term)
                        foreach ($termWiseData as $item) {

                            if (!isset($item['Test_Name'])) {
                                continue;
                            }

                            if (strcasecmp($item['Test_Name'], $dbTestName) === 0) {
                                return $dbTestName === 'BMI'
                                    ? ($item['Level'] ?? '--')
                                    : ($item['score'] ?? '--');
                            }
                        }
                    }
                }

                return '--';
            }
        @endphp


        <div class="table-container m-3">
            <table class="table table-bordered table-responsive-sm">
                <thead class="thead-light">
                    <tr>
                        <th>Fitness Components</th>
                        <th colspan="2">Fitness Parameters</th>
                        <th>Test Name</th>
                        <th>What does it Measure</th>
                        <th>Class 9th</th>
                        <th>Class 10th</th>
                        <th>Class 11th</th>
                        <th>Class 12th</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td rowspan="6">Health Components</td>
                        <td>Body Composition</td>
                        <td></td>
                        <td>BMI</td>
                        <td>Body Mass Index for specific Age and Gender</td>
                        @foreach($classList as $class)
                            <td>
                                <p class="score">{{ $studentsData->class_id == $class ? getScore($groupedReport, $testMap['BMI']) : '--' }}</p>
                            </td>
                        @endforeach
                    </tr>

                    <tr>
                        <td rowspan="2">Muscular Strength</td>
                        <td>Core</td>
                        <td>Partial Curl up</td>
                        <td>Abdominal Muscular Endurance</td>
                        @foreach($classList as $class)
                            <td>
                                <p class="score">{{ $studentsData->class_id == $class ? getScore($groupedReport, $testMap['Partial Curl up']) : '--' }}</p>
                            </td>
                        @endforeach

                    </tr>

                    <tr>
                        <td>Upper Body</td>
                        <td>Flexed/Bent Arm Hang</td>
                        <td>Muscular Endurance / Functional Strength</td>
                        @foreach($classList as $class)
                            <td>
                                <p class="score">{{ $studentsData->class_id == $class ? getScore($groupedReport, $testMap['Flexed/Bent Arm Hang']) : '--' }}</p>
                            </td>                            
                        @endforeach
                    </tr>

                    <tr>
                        <td>Flexibility</td>
                        <td></td>
                        <td>Sit and Reach</td>
                        <td>Measures flexibility of lower back and hamstrings</td>
                        @foreach($classList as $class)
                            <td>
                                <p class="score">{{ $studentsData->class_id == $class ? getScore($groupedReport, $testMap['Sit and Reach']) : '--' }}</p>
                            </td>
                        @endforeach
                    </tr>

                    <tr>
                        <td>Endurance</td>
                        <td></td>
                        <td>600 Mtr Run</td>
                        <td>Cardiovascular Fitness</td>
                        @foreach($classList as $class)
                            <td>
                                <p class="score">{{ $studentsData->class_id == $class ? getScore($groupedReport, $testMap['600 Mtr Run']) : '--' }}</p>
                            </td>
                        @endforeach
                    </tr>

                    <tr>
                        <td>Balance</td>
                        <td>Static Balance</td>
                        <td>Flamingo Balance Test</td>
                        <td>Ability to balance on a single leg</td>
                        @foreach($classList as $class)
                            <td>
                                <p class="score">{{ $studentsData->class_id == $class ? getScore($groupedReport, $testMap['Flamingo Balance Test']) : '--' }}</p>
                            </td>
                        @endforeach
                    </tr>

                    <tr>
                        <td rowspan="5">Skill Components</td>
                        <td>Agility</td>
                        <td></td>
                        <td>Shuttle Run</td>
                        <td>Test of speed and agility</td>
                        @foreach($classList as $class)
                            <td>
                                <p class="score">{{ $studentsData->class_id == $class ? getScore($groupedReport, $testMap['Shuttle Run']) : '--' }}</p>
                            </td>
                        @endforeach
                    </tr>

                    <tr>
                        <td>Speed</td>
                        <td></td>
                        <td>Sprint / Dash</td>
                        <td>Determines acceleration and speed</td>
                        @foreach($classList as $class)
                            <td>
                                <p class="score">{{ $studentsData->class_id == $class ? getScore($groupedReport, $testMap['Sprint / Dash']) : '--' }}</p>
                            </td>
                        @endforeach
                    </tr>
                    </tr>

                    <tr>
                        <td>Power</td>
                        <td></td>
                        <td>Standing Vertical Jump</td>
                        <td>Measures leg power</td>
                        @foreach($classList as $class)
                            <td>
                                <p class="score">{{ $studentsData->class_id == $class ? getScore($groupedReport, $testMap['Standing Vertical Jump']) : '--' }}</p>
                            </td>
                        @endforeach
                    </tr>

                    <tr>
                        <td>Coordination</td>
                        <td></td>
                        <td>Plate Tapping</td>
                        <td>Tests speed & coordination</td>
                        @foreach($classList as $class)
                            <td>
                                <p class="score">{{ $studentsData->class_id == $class ? getScore($groupedReport, $testMap['Plate Tapping']) : '--' }}</p>
                            </td>
                        @endforeach
                    </tr>

                    <tr>
                        <td></td>
                        <td></td>
                        <td>Alternative Hand Wall Toss Test</td>
                        <td>Measures hand–eye coordination</td>
                         @foreach($classList as $class)
                            <td>
                                <p class="score">{{ $studentsData->class_id == $class ? getScore($groupedReport, $testMap['Alternative Hand Wall Toss Test']) : '--' }}</p>
                            </td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
        </div>

        <p class="mt-3">
            <strong>Note:</strong> Test details are available in the <a href="https://cbseacademic.nic.in/web_material/CurriculumMain21/Coscholastic/Health_and_Physical_Education(HPE)IX-XII.pdf" target="_blank">HPE manual</a> on the CBSE website.
        </p>

    </div>

</body>
</html>