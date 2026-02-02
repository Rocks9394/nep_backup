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
    </style>
</head>

<body class="text-center">

    <div class="container py-4 wrapper" id="content-to-download">

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
                foreach ($groupedReport as $categoryData) {
                    foreach ($categoryData as $item) {
                        if (strtolower($item['Test_Name']) == strtolower($dbTestName)) {
                            if($dbTestName == 'BMI'){
                                return $item['Level'] ?? '--';
                            }else{
                                return $item['score'] ?? '--';
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
            <strong>Note:</strong> Test details are available in the HPE manual on the CBSE website.
        </p>

    </div>

    <button class="btn btn-primary mb-3" onclick="downloadPDF()">📄 Download Report</button>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

    <script>
        async function downloadPDF() {
    
            Swal.fire({
                title: 'Generating PDF...',
                text: 'Please wait while the PDF is being generated.',
                didOpen: () => {
                    Swal.showLoading();
                },
                allowOutsideClick: false,
            });

            try {
                const { jsPDF } = window.jspdf;
                const pdf = new jsPDF('landscape', 'pt', 'a4');
                const element = document.getElementById("content-to-download");        
                const canvas = await html2canvas(element, { scale: 4 });
                const imgData = canvas.toDataURL('image/png');

                const pageWidth = pdf.internal.pageSize.getWidth();
                const pageHeight = pdf.internal.pageSize.getHeight();

                const imgWidth = canvas.width;
                const imgHeight = canvas.height;
                const scale = Math.min(pageWidth / imgWidth, pageHeight / imgHeight);
                const finalWidth = imgWidth * scale;
                const finalHeight = imgHeight * scale;
                const marginX = (pageWidth - finalWidth) / 2;
                const marginY = (pageHeight - finalHeight) / 2;
        
                pdf.addImage(imgData, 'PNG', marginX, marginY, finalWidth, finalHeight);       
                pdf.save("Cbse_Health_Record.pdf");

                Swal.close();                        
                Swal.fire({
                    icon: 'success',
                    title: 'PDF Generated',
                    text: 'The PDF has been successfully generated and downloaded.',
                    allowOutsideClick: false,
                });
            } catch (error) {        
                Swal.close();
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong while generating the PDF. Please try again.',
                    allowOutsideClick: false,
                });
            }
        }
    </script>



</body>
</html>