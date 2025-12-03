@extends('layouts.filldart-app')
@section('title', 'CISCE | ' . $title)
@section('content')

@push('style-css')
    <link href="{{ asset('public/assets/css/student_dashboard_style/main.css') }}" rel="stylesheet" />
@endpush

<style>
    .score-bar {
        display: flex;
        width: 250px;
        height: 20px;
        border: 1px solid #333;
        border-radius: 5px;
        overflow: hidden;
    }

    .segment {
        flex: 1;
        height: 100%;
        opacity: 0.2;
        transition: opacity 0.3s ease-in-out;
    }

    .segment-1 { background-color: #f44336; } 
    .segment-2 { background-color: #ff9800; }
    .segment-3 { background-color: #ffeb3b; } 
    .segment-4 { background-color: #8bc34a; }
    .segment-5 { background-color: #4caf50; } 

    .score-label {
        font-family: sans-serif;
        margin-top: 5px;
    }

    .level-bar {
        display: flex;
        gap: 2px;
        margin: 10px 0;
    }

    .color-levels {
        flex: 1;
        height: 10px;
        background-color: #e0e0e0; /* Default (inactive) color */
        border-radius: 4px;
        transition: background-color 0.3s ease, opacity 0.3s ease;
    }
    .segment2 {
        flex: 1;
        height: 15px;
        width: 100px;
        background-color: #e0e0e0;
        border-radius: 5px;
        transition: all 0.5s ease;
        margin: 2px;
    }

    .segment2:last-child {
        margin-right: 0;
    }

    .segments-1.filled { background-color: #f44336; } /* Red */
    .segments-2.filled { background-color: #ff5722; } /* Deep Orange */
    .segments-3.filled { background-color: #ff9800; } /* Orange */
    .segments-4.filled { background-color: #ffc107; } /* Amber */
    .segments-5.filled { background-color: #8bc34a; } /* Light Green */
    .segments-6.filled { background-color: #4caf50; } /* Green */
    .segments-7.filled { background-color: #388e3c; } /* Dark Green */

    .modal {
        display: none; /* Hidden by default */
        position: fixed; 
        z-index: 1; 
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto; 
        background-color: rgba(0,0,0,0.5); /* Black background with opacity */
    }

    .modal-content {
        background-color: #fff;
        margin: 15% auto;
        padding: 20px;
        width: 60%;
        border-radius: 8px;
    }

    .close {
        float: right;
        font-size: 24px;
        cursor: pointer;
    }
    .color-container {
        display: flex;
        flex-direction: column;
        gap: 5px;
        width: auto;
    }

    .color-block {
        width: 100%;
        color: white;
        text-align: center;
        padding: 2px;
        font-weight: bold;
        display: block;
        border-radius: 5px
    }
    * {text-rendering: optimizeLegibility; font-size:100%;}
        /* svg g g {font-size:0px;} */
    #bmi_gauge svg g g {
        font-size: 0px !important;
    }

    .garph-01 {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 20px;
    }

    .donut_single {
        width: 150px;
        height: 150px;
    }

    .level-detail {
        text-align: center;
    }
    
    .back-btn {
        display: inline;
    }
    .back-btn img {
        display: inline;
    }
    .lazy-image {
        opacity: 0;
        transition: opacity 0.5s ease-in-out;
    }

    .lazy-image.loaded {
        opacity: 1;
    }
</style>

    @php
        $BmiClassess = ['1','2','3','4','5','6','7','8','9','10','11','12'];
        $juniorClassess = ['1','2','3',];
        $siniorClassess = ['4','5','6','7','8','9','10','11','12'];

    @endphp

<div class="all-chaptr-cards">
    <div class="container">
        <!-- <h2 class="text-center m-2">{{$title}}</h2> -->
        <div class="row mt-5">
            <div class="col-12 col-md-6 col-lg-6 apst">
                <a href="{{ route('student.dashboard')}}" class="back-btn">
                <img src="{{ asset('public/assets/imgs/back-arrow.png') }}" alt="">
                </a>
                <div class="user-information backgroud-01 w-100">
                <img src="{{ asset('resources/images/avtar.png') }}" class="d-inline-block align-top" height="35" alt="avtar">
                <div class="left-text pl-3 w-100 user-u-info">
                    <h2>{{ Auth::guard('sstudent')->user()->student_name }}</h2>
                    <h3>{{$studentAge}} Years, {{$studentData->gender}}</h3>
                    <p class="lead">{{$studentData->school_name}}</p>
                    <p>{{$studentData->className}}-{{$studentData->section}}, Roll No: {{$studentData->rollno}}</p>
                </div>
                </div>
            </div>

            <div class="col-4 col-md-2 col-lg-2 apst">
                <div class="student-rank left-text text-center backgroud-01 h-100 d-flex flex-column justify-content-center align-items-center">
                    <h4>School Rank</h4>
                    <span>12</span>
                </div>
            </div>

            <div class="col-4 col-md-2 col-lg-2 apst">
                <div class="student-rank left-text text-center backgroud-01 h-100 d-flex flex-column justify-content-center align-items-center">
                    <h4>State Rank</h4>
                    <span>13262</span>
                </div>
            </div>

            <div class="col-4 col-md-2 col-lg-2 apst">
                <div class="student-rank left-text text-center backgroud-01 h-100 d-flex flex-column justify-content-center align-items-center">
                    <h4>National Rank</h4>
                    <span>10222</span>
                </div>
            </div>
            </div>



        @if (in_array((string) $classId, $BmiClassess))        
            <div class="row mt-4">
                <div class="col-12 col-md-6 col-lg-4 col-xl-4 order-md-2 order-lg-1 apst">
                    <div class="fitness-box h-100">
                        <div class="garph-01">
                            <div id="donut_single" class="donut_single"></div>
                            <div id="overallFitness" class="level-detail left-text text-center">
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-md-12 col-lg-4 col-xl-4 order-md-1 order-lg-2 apst">
                    <div class="fitness-box h-100 w-100">
                        <div class="weight_01 left-text">
                            <div class="center-img-weight">
                                <img src="{{ asset('public/assets/imgs/height-icon.jpg') }}" alt="Height" class="img-fluid img lazy-image" loading="lazy" />
                                <div class="weight-input">
                                    <h4>Height</h4>
                                    <span>{{ $bmiRecord->height ?? '---' }} cm</span>
                                </div>
                            </div>
                        </div>
                        <div class="weight_02 left-text">
                            <div class="center-img-weight">
                                <img src="{{ asset('public/assets/imgs/weight-icon.png') }}" alt="weight" class="img-fluid img lazy-image" loading="lazy" />
                                <div class="weight-input">
                                    <h4>Weight</h4>
                                    <span>{{ $bmiRecord->weight ?? '---' }} kg</span>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-4 col-xl-4 order-3 apst">
                    <div class="fitness-box h-100">
                        <div class="meater left-text w-100">                                
                            <div class="left-text benchmark">
                                <h4>BMI</h4>
                                <span>{{$bmiRecord->score ?? '---' }} ({{$bmiRecord->level ?? '---' }})</span>
                                <a href="#" id="openModal">BMI Benchmark <i class="fa fa-angle-right"></i></a>
                            </div>
                            <div id="bmi_gauge"></div>
                            <div class="color-container">
                                <div class="color-block" style="background-color: lightgrey;">UW</div>
                                <div class="color-block" style="background-color: #0F9D58;">N</div>
                                <div class="color-block" style="background-color: #ff9900;">OW</div>
                                <div class="color-block" style="background-color: #DB4437;">OB</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>           
        @endif


        
        <div class="clearfix"></div>

        <div class="my-5">
             {{-- for FMS tests --}}

            <div class="row no-gutters">

                @if (in_array((string) $classId, $juniorClassess))   
                <h2 class="test-heading text-center mt-2 mb-3">FMS Development Tests</h2>
                    @foreach($fmsTestData as $test)
                        <div class="col-12 col-md-6 col-lg-6 col-xl-4">
                            <div class="test-box">
                                <div class="tests left-text">
                                    <img src="{{ asset('public/icons/BatteryOfTests/' . $test->icons) }}" alt="logo" class="img-fluid img lazy-image" loading="lazy" />
                                    <div class="left-text w-100">
                                        <h4>{{ $test->skill_name }}</h4>
                                        <div class="score-bar w-100" id="scoreBar">
                                            <div class="segment segment-1"></div>
                                            <div class="segment segment-2"></div>
                                            <div class="segment segment-3"></div>
                                            <div class="segment segment-4"></div>
                                            <div class="segment segment-5"></div>
                                        </div>
                                        <div class="score-outcome d-flex justify-content-between align-items-center">
                                            <div class="score-label" id="scoreLabel">{{ $test->score }}</div>                           
                                            <div class="outcome">{{ $test->outcome }}</div>                           
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach 
                @else
                    @if(!in_array((string) $classId, $siniorClassess))
                        <h2 class="test-heading text-center">You have not given FMS tests yet</h2>
                    @endif
                @endif
    
            </div>
            <div class="clearfix"></div>
            <div class="row no-gutters">

                @if (in_array((string) $classId, $juniorClassess) || in_array((string) $classId, $siniorClassess))  
                <h2 class="test-heading text-center mt-3 mb-3">Fitness Tests</h2>
                    @foreach($fitnessTest as $index => $test) 
                        <div class="col-12 col-md-6 col-lg-6 col-xl-4">
                            <div class="test-box">
                                <div class="tests left-text">
                                    <img src="{{ asset('public/icons/BatteryOfTests/' . $test->icons) }}" alt="logo" class="img-fluid img lazy-image" loading="lazy" />
                                    <div class="left-text w-100">
                                        <h4>{{ $test->skill_name }}</h4>
                                        <div class="level-box">
                                            <div class="current-lavel">Current Level</div>
                                            <div class="clearfix"></div>
                                            
                                            <div class="level-bar" data-score="{{ $test->level }}">
                                                @for ($i = 1; $i <= 7; $i++)
                                                <div class="segment2 segments-{{ $i }}"></div>
                                                @endfor
                                            </div>

                                            <div class="score-outcome d-flex justify-content-between align-items-center">
                                                <div class="score-label" id="scoreLabel">Level {{ $test->level }}</div>                           
                                                <div class="outcome">{{ $test->levelOutcome }}</div>                           
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach  
                @else
                    <h2 class="test-heading text-center mb-4 mt-5 pt-3 pt-md-5 mb-md-5">You have not given any Fitness tests yet</h2>
                @endif
            </div>
        </div>

        
        <div class="form-row download-report mb-4">
            <div class="col-12 col-sm-4 col-lg-4 mb-3">
                <a href="{{ route('student.report')}}" class="btn btn-primary btn-lg w-100" target="_blank">Download Report </a>
            </div>
            <div class="col-12 col-sm-4 col-lg-4 mb-3">
                <a class="btn btn-primary btn-lg w-100 notAvailable" target="_blank">Fitness History <i class="fa fa-angle-right"></i> </a>
            </div>
            <div class="col-12 col-sm-4 col-lg-4 mb-3">
                <a class="btn btn-primary btn-lg w-100 notAvailable" target="_blank">National Benchmark<span></span><i class="fa fa-angle-right"> </a>
            </div>
        </div>

        {{-- code end here --}}
    </div> 
</div>

<!-- BMI benchmark modal  -->
<div id="bmiModal" class="modal" data-backdrop="static" data-keyboard="false">
    <div class="modal-content">
        <span class="close">&times;</span>
        <table border="1" cellpadding="0" cellspacing="0" style="width: 100%; margin-top:30px; border: 0px; font-size: 14px; border-collapse: collapse; color:#333; text-align:left;">
            <tr style="background-color: #ccc;">
                <td style="padding: 5px 10px; font-weight: bold; color:#000; font-size: 16px;" colspan="8">BMI Benchmarks for {{ $studentAge }} years {{ $studentData->gender }}</td>
            </tr>
            <tr style="font-weight: bold; text-align: center; background-color: #eee; font-size: 12px; color: #000;">
                <td>UW</td>
                <td>N</td>
                <td>OW</td>
                <td>OB</td>
            </tr>
                    
            @if(is_array($getBmiBenchmark) && count($getBmiBenchmark) > 0)
            <tr>
                <td class="text-center" style="padding: 5px 10px; color: #000;">{{ $getBmiBenchmark['UW'] ?? 'N/A' }}</td>
                <td class="text-center" style="padding: 5px 10px; color: #000;">{{ $getBmiBenchmark['N'] ?? 'N/A' }}</td>
                <td class="text-center" style="padding: 5px 10px; color: #000;">{{ $getBmiBenchmark['OW'] ?? 'N/A' }}</td>
                <td class="text-center" style="padding: 5px 10px; color: #000;">{{ $getBmiBenchmark['OB'] ?? 'N/A' }}</td>
            </tr>
            @endif
        </table>
    </div>
</div>


<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
    google.charts.load('current', {'packages':['gauge']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        const bmi = {{ $bmiRecord->score ?? 0 }};
        const benchmark = @json($getBmiBenchmark);

        const extractNumbers = (text) => {
            const matches = text.match(/[\d.]+/g);
            return matches ? matches.map(Number) : [];
        };

        const uwLimit = extractNumbers(benchmark.UW)[0] || 0;
        const nLimits = extractNumbers(benchmark.N);
        const owLimits = extractNumbers(benchmark.OW);
        const obLimit = extractNumbers(benchmark.OB)[0] || 0;

        // Determine BMI zone value
        let targetValue;
        let targetLabel;

        if (bmi < uwLimit) {
            targetValue = 0.5;
            targetLabel = 'UW';
        } else if (bmi < nLimits[1]) {
            targetValue = 1.5;
            targetLabel = 'N';
        } else if (bmi < owLimits[1]) {
            targetValue = 2.5;
            targetLabel = 'OW';
        } else {
            targetValue = 3.5;
            targetLabel = 'OB';
        }

        // Use the actual label in the data
        const data = google.visualization.arrayToDataTable([
            ['Label', 'Value'],
            [targetLabel, targetValue],
        ]);

        const options = {
            width: '70%',
            height: 150,
            min: 0,
            max: 4,
            greenFrom: 1, greenTo: 2,       // N - Green
            yellowFrom: 2, yellowTo: 3,     // OW - Orange
            redFrom: 3, redTo: 4,           // OB - Red
            majorTicks:[],
            minorTicks: 0,
            animation: { 
                duration: 50,
                easing: 'linear'
            }
        };

        const chart = new google.visualization.Gauge(document.getElementById('bmi_gauge'));
        chart.draw(data, options);

        let currentValue = 0;
        const step = 0.05;
        const interval = setInterval(() => {
            if (currentValue < targetValue) {
                currentValue += step;
                if (currentValue > targetValue) currentValue = targetValue;
            } else if (currentValue > targetValue) {
                currentValue -= step;
                if (currentValue < targetValue) currentValue = targetValue;
            }
            data.setValue(0, 1, currentValue);
            chart.draw(data, options);

            if (currentValue === targetValue) clearInterval(interval);
        }, 50);
    }
    
    // window.addEventListener('resize', drawChart);
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const maxScore = 5;

        document.querySelectorAll('.test-box').forEach(box => {
            const scoreBar = box.querySelector('.score-bar');
            const scoreLabel = box.querySelector('.score-label');
            if (!scoreBar || !scoreLabel) return;

            const score = parseFloat(scoreLabel.textContent);
            const segments = scoreBar.querySelectorAll('.segment');

            segments.forEach((segment, index) => {
            const segmentIndex = index + 1;
            if (score >= segmentIndex) {
                segment.style.opacity = '1';
            } else if (score > index && score < segmentIndex) {
                segment.style.opacity = (score - index).toFixed(2);
            } else {
                segment.style.opacity = '0.15';
            }
            });

            scoreLabel.textContent = `Score: ${score}/${maxScore}`;
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const maxLevel = 7;

        function applyColoredLevelProgress() {
            const levelBars = document.querySelectorAll('.level-bar');

            levelBars.forEach(levelBar => {
                const rawLevel = levelBar.getAttribute('data-score') || 'L0';
                const level = parseFloat(rawLevel.replace(/[^0-9.]/g, '')) || 0;
                const segments = levelBar.querySelectorAll('.segment2');


                segments.forEach((segment, index) => {
                    const segmentIndex = index + 1;

                    if (level >= segmentIndex) {
                        segment.classList.add('filled');
                        segment.style.opacity = '1';
                    } else if (level > index && level < segmentIndex) {
                        segment.classList.add('filled');
                        segment.style.opacity = (level - index).toFixed(2);
                    } else {
                        segment.classList.remove('filled');
                        segment.style.opacity = '0.3';
                    }
                });
            });
        }
        applyColoredLevelProgress();
    });
</script>
<script>
  document.getElementById("openModal").addEventListener("click", function(e) {
        e.preventDefault();
        document.getElementById("bmiModal").style.display = "block";
  });
  document.querySelector(".close").addEventListener("click", function() {
        document.getElementById("bmiModal").style.display = "none";
  });

  document.getElementById("bmiModal").addEventListener("click", function(e) {
        if (e.target === this) {
            e.stopPropagation();
        }
    });
  window.addEventListener("click", function(event) {
        const modal = document.getElementById("bmiModal");
        if (event.target === modal) {
            modal.style.display = "none";
        }
  });


let fitnessTest = @json($fitnessTest);
const levelMap = {
    'L0': 0,
    'L1': 1,
    'L2': 2,
    'L3': 3,
    'L4': 4,
    'L5': 5,
    'L6': 6,
    'L7': 7,
    'L8': 8
};

const levels = fitnessTest.map(test => test.level);

const numericScores = levels.map(level => levelMap[level] || 0);

const sum = numericScores.reduce((acc, score) => acc + score, 0);

const avgScore = numericScores.length ? sum / numericScores.length : 0;

const maxScore = 8;

const overallPercentile = ((avgScore) / maxScore) * 100;

// Display the initial structure
document.getElementById('overallFitness').innerHTML = `
  <h4>Overall Fitness Level</h4>
  <span>0%</span>
`;


let start = 0;
const end = overallPercentile;
const duration = 2000; // 2 seconds
const stepTime = 20;   // update every 20ms
const increment = end / (duration / stepTime);

const spanElement = document.querySelector('#overallFitness span');

const timer = setInterval(() => {
  start += increment;
  if (start >= end) {
    start = end;
    clearInterval(timer);
  }
  spanElement.textContent = `${start.toFixed(2)}%`;
}, stepTime);


// Load Google Charts
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawOverallFitness);

function drawOverallFitness() {
    var targetValue = parseFloat(overallPercentile.toFixed(2));
    
    var data = google.visualization.arrayToDataTable([
        ['Label', 'Value'],
        ['Fitness', 0] 
    ]);
    var formatter = new google.visualization.NumberFormat({
        pattern: '#.##'
    });
    formatter.format(data, 1);
    
    var options = {
        greenFrom: 0,
        greenTo: 100,
        minorTicks: 0,
        majorTicks: [],
        hideTicks: true,
        max: 100,
        animation: { 
            duration: 500,
            easing: 'linear'
        }
    };

    var chart = new google.visualization.Gauge(document.getElementById('donut_single'));
    chart.draw(data, options);
    let current = 0;
    let step = targetValue / 50;

    let interval = setInterval(() => {
        current += step;
        if (current >= targetValue) {
            current = targetValue;
            clearInterval(interval);
        }

        data.setValue(0, 1, parseFloat(current.toFixed(2)));
        formatter.format(data, 1);
        chart.draw(data, options);
    }, 50);
}

    document.addEventListener("DOMContentLoaded", function() {
        const images = document.querySelectorAll('.lazy-image');

        images.forEach(img => {
            if (img.complete) {
                img.classList.add('loaded');
            }

            img.addEventListener('load', () => {
                img.classList.add('loaded');
            });
        });
    });



    $('.notAvailable').on('click', function (e) {

        Swal.fire({
            icon: 'info',
            title: 'Not Available',
            text: 'Data not available. Please try again later.',
            confirmButtonText: 'OK',
            allowOutsideClick: false
        });
        return;
    });
</script>


@endsection