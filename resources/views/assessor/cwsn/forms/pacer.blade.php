@extends('assessor.cwsn.index')
@section('cwsnform')

@php
    $baseName = basename($__path);
    $formName = explode('.', $baseName)[0];
    $formId = $formName . '_form';
@endphp

@push('cwsn-style')
<style>
    @media only screen and (max-width: 600px) {
        .btn {  min-width: 80px; }
        #laps_completed{ width: 100px; }
    }

    @media only screen and (min-width: 600px) {
        .btn { min-width: 170px; }
        #laps_completed{ width: 140px; }
    }

    @media only screen and (min-width: 768px) {
        .btn {  min-width: 170px;}
        #laps_completed{ width: 140px; }
    }

    #scanner_btn{
        min-width: 56px !important;
    }

    button.btn.btn-secondary.d-flex.align-items-center.justify-content-center.fw-bold.fs-3.user-select-none {
        border: 1px solid orange;
    }

    .btn-danger-stop {
        background-color: #ec0000 !important;
        border-color: #ec0000 !important;
        color: #fff !important;
    }
    
    .hide {
        pointer-events: none;   
        opacity: 0.6;    
        cursor: not-allowed;
    }
</style>
@endpush

<h3 class="mb-3 text-center">Total Completed Laps ({{ $title }})</h3>

<form class="row mt-0" method="POST" name="{{ $TestTypeId }}" id="{{ $TestTypeId }}" action="javascript:void(0);">
    {{ method_field('post') }}
    @csrf

    <input type="hidden" name="skillReportId" value="{{ $skillReportId }}" id="skillReportId">
    <input type="hidden" name="pwd_category_id" value="{{ $pwd_category_id ?? '' }}">
    <input type="hidden" name="TestTypeMasterID" value="{{ $TestTypeMasterID }}">
    <input type="hidden" name="SchoolId" id="SchoolId" value="{{ $SchoolId }}">
    <input type="hidden" name="student_id" id="selected_student_id">
    
    <input type="hidden" name="final_level" id="final_level" value="1">
    <input type="hidden" name="final_shuttle" id="final_shuttle" value="0">

    <div class="card border-0 bg-light col-12 p-2 d-flex flex-column align-items-center justify-content-center text-center">       
        
        <!-- Timer Display (mm:ss:SS) -->
        <div id="timer_display" class="mb-3 fw-bold text-dark" style="font-family: monospace; font-size: 1.5rem;">00:00:00</div>

        <div class="counter-container d-flex justify-content-center align-items-center w-100 mb-3">
            <div class="d-flex align-items-center justify-content-center" style="max-width: 280px; width: 100%;">
                <button type="button" id="minus_btn" onclick="changeLap(-1)" class="btn btn-secondary d-flex align-items-center justify-content-center fw-bold fs-3 user-select-none" style="width: 55px; height: 45px; font-size: 20px;">-</button>

                <input type="number" id="laps_completed" name="laps_completed" value="0" min="0" class="form-control text-center mx-3 fw-bolder fs-3 bg-light" readonly>

                <button type="button" id="plus_btn" onclick="changeLap(1)" class="btn btn-primary d-flex align-items-center justify-content-center fw-bold fs-3 user-select-none" style="width: 55px; height: 45px; font-size: 20px;">+</button>
            </div>
        </div>
        
        <div class="badge bg-light text-dark p-2 border mb-4" style="font-size: 14px;">
            Current State: <span class="fw-bold text-indigo" id="live_status_badge">Level 1, Shuttle 0</span>
        </div>

        <!-- Timer Action Controller -->
        <div class="w-100 d-flex justify-content-center" >
            <a href="javascript:void(0)" id="startBtn" class="btn btn-success text-light py-2 w-100 d-flex justify-content-center align-items-center" style="gap: 10px;">
                <i class="bi bi-stopwatch fs-4"></i><span style="color: #fff;">Start Test</span>
            </a>
        </div>
    </div>

    @php $id = $TestTypeId; @endphp
    <x-reset-submit-btn :id="$id"/>
</form>

@push('cwsn-module-script')
<script>

    
    
    function WhistelSound(isLevelChange = false){
        const button = document.getElementById('startBtn');
        const whistleSound = document.getElementById('whistleSound');
        whistleSound.play().catch(error => {
            console.error('Error playing sound:', error);
        });
    }

    function stopWhistleSound(isLevelChange = false) {
        const whistleSound = document.getElementById('whistleSound');
        whistleSound.pause();
        whistleSound.currentTime = 0;
    }


    // Standard PACER Matrix: { Level: Number of Shuttles }
    const pacerMatrix = {
        1: 7,  2: 8,  3: 8,  4: 9,  5: 9,  6: 10, 7: 10, 8: 11,
        9: 11, 10: 11, 11: 12, 12: 12, 13: 13, 14: 13, 15: 14,
        16: 14, 17: 15, 18: 15, 19: 16, 20: 16, 21: 16
    };

    const pacerTiming = {
        // 20-meter PACER
        20: {1: 9.00, 2: 8.50, 3: 8.00, 4: 7.50, 5: 7.00, 6: 6.50, 7: 6.00, 8: 5.50, 9: 5.00, 10: 4.50, 11: 4.00,
            12: 3.50, 13: 3.00, 14: 2.80, 15: 2.60, 16: 2.40, 17: 2.20, 18: 2.00, 19: 1.90, 20: 1.80, 21: 1.70 
        },

        // 15-meter PACER
        15: {1: 6.75, 2: 6.25, 3: 5.75, 4: 5.25, 5: 4.75, 6: 4.25, 7: 3.75, 8: 3.25, 9: 2.75, 10: 2.50, 11: 2.30, 12: 2.10,
            13: 1.95,  14: 1.85, 15: 1.75,  16: 1.65, 17: 1.55, 18: 1.50, 19: 1.45, 20: 1.40, 21: 1.35
        }
    };

    

    const saveBtn      = document.getElementById(`submit_${formName}`);
    const startBtn     = document.getElementById('startBtn');
    const lapInput     = document.getElementById('laps_completed');
    const timerDisplay = document.getElementById('timer_display');
    const minusBtn     = document.getElementById('minus_btn');
    const plusBtn      = document.getElementById('plus_btn');


    const formName = parseInt(@json($TestTypeId), 10);
    let distanceMeters;
    if (formName === 1043) {
        // 20 Meter PACER Test
        distanceMeters = 20;
    } else {
        // 15 Meter PACER Test
        distanceMeters = 15;
    }

    console.log('PACER Distance:', distanceMeters);
    


    // Audio and Engine Tracking variables
    let audioCtx = null;
    let isRunning = false;
    let masterTimerInterval = null;
    let shuttleTimeout = null;
    let startTime = null;
    
    let currentLevel = 1;
    let currentShuttle = 0;
    let totalLapsCount = 0;



    function playFox40Whistle(isLevelChange = false) {
        try {
            if (!audioCtx) {
                audioCtx = new (window.AudioContext || window.webkitAudioContext)();
            }
            
            // Resume if browser suspended audio context
            if (audioCtx.state === 'suspended') {
                audioCtx.resume();
            }

            const now = audioCtx.currentTime;
            
            // Core piercing dominant frequencies matching pealess sports whistles
            const frequencies = isLevelChange ? [3100, 3350] : [2900, 3150]; 
            
            // INCREASING DURATIONS HERE:
            // Standard shuttle = 0.8 seconds | Level change = 1.5 seconds
            const duration = isLevelChange ? 1.5 : 0.8; 

            // Master volume gain control node
            const masterGain = audioCtx.createGain();

            masterGain.gain.setValueAtTime(0.0, now);
            masterGain.gain.linearRampToValueAtTime(0.85, now + 0.03); 
            masterGain.gain.setValueAtTime(0.85, now + (duration * 0.8));
            masterGain.gain.exponentialRampToValueAtTime(0.001, now + duration);

            masterGain.connect(audioCtx.destination);

            frequencies.forEach(freq => {
                const osc = audioCtx.createOscillator();
                osc.type = 'sine'; 
                osc.frequency.setValueAtTime(freq, now);

                const modulator = audioCtx.createOscillator();
                const modGain = audioCtx.createGain();

                modulator.frequency.setValueAtTime(135, now); // Rapid air flutter
                modGain.gain.setValueAtTime(18, now);         // Deep pitch vibrato punch

                modulator.connect(modGain);
                modGain.connect(osc.frequency);
                
                osc.connect(masterGain);
                
                modulator.start(now);
                osc.start(now);
                
                modulator.stop(now + duration);
                osc.stop(now + duration);
            });

        } catch (e) {
            console.error("Whistle synthesis failed: ", e);
        }
    }

    window.onload = function() { 
        if(saveBtn) saveBtn.classList.add("hide"); 
    }

    document.addEventListener("DOMContentLoaded", function () {
        
        startBtn.addEventListener("click", function() {     // Start and stop button

            if (!isRunning) {                               // Start pacer
                
                isRunning = true;
                totalLapsCount = 0;
                currentLevel = 1;
                currentShuttle = 0;
                
                lapInput.value = 0;
                updateLevelAndShuttle(0);

                // UI Mode Shifts
                startBtn.innerHTML = '<i class="bi bi-stopwatch fs-4"></i><span>Stop Test</span>';
                startBtn.classList.remove("btn-success");
                startBtn.classList.add("btn-danger-stop");

                minusBtn.classList.add("hide");
                plusBtn.classList.add("hide");

                startTime = Date.now();
                
                masterTimerInterval = setInterval(() => {
                    let msElapsed = Date.now() - startTime;
                    updateTimerDisplay(msElapsed);
                }, 30);

                // Initialize automated loop
                runNextShuttle();

            } else {
                stopPacerTest(false);
            }
            
        });


        function runNextShuttle() {         // main pacer l
            if (!isRunning) return;

            currentShuttle++;

            if (currentShuttle > pacerMatrix[currentLevel]) {   // Check if level transition boundaries have been crossed
                currentLevel++;
                currentShuttle = 1;
                
                if (currentLevel > 21) {
                    stopPacerTest(true);
                    return;
                }
              
                // playFox40Whistle(true); 
                WhistelSound();
            } else {
                
                // playFox40Whistle(false); 
                WhistelSound();
            }

            // Sync inputs instantly
            totalLapsCount++;
            lapInput.value = totalLapsCount;
            document.getElementById('final_level').value = currentLevel;
            document.getElementById('final_shuttle').value = currentShuttle;


            document.getElementById('live_status_badge').textContent = `Level ${currentLevel}, Shuttle ${currentShuttle}`;

            // Calculate precise timing duration dynamically
            // let speedKmh = speedMatrix[currentLevel];
            // let speedMps = speedKmh / 3.6; 


            const shuttleDurationMs = pacerTiming[distanceMeters][currentLevel] * 1000;

            // let shuttleDurationMs = (distanceMeters / speedMps) * 1000;

            shuttleTimeout = setTimeout(() => {
                runNextShuttle();
            }, shuttleDurationMs);
        }

        function stopPacerTest(hitMaxCeiling = false) {

            // stopWhistleSound();

            isRunning = false;
            clearInterval(masterTimerInterval);
            clearTimeout(shuttleTimeout);

            startBtn.classList.add("hide");
            minusBtn.classList.remove("hide");
            plusBtn.classList.remove("hide");

            if (saveBtn) saveBtn.classList.remove("hide");

            if (hitMaxCeiling) {
                startBtn.innerHTML = '<span>Max PACER Capacity Met!</span>';
                startBtn.className = "btn btn-warning py-2 w-100 d-flex justify-content-center text-dark";
            } else {
                startBtn.innerHTML = '<span style="color:white">Test Stopped</span>';
                startBtn.className = "btn btn-success py-2 w-100 d-flex justify-content-center";
            }
        }

        const resetBtn = document.getElementById(`reset_${formName}`);
        if (resetBtn) {
            resetBtn.addEventListener("click", function() {
                isRunning = false;
                clearInterval(masterTimerInterval);
                clearTimeout(shuttleTimeout);
                
                timerDisplay.textContent = "00:00:00";
                lapInput.value = 0;
                
                startBtn.innerHTML = '<i class="bi bi-stopwatch fs-4"></i><span style="color:white">Start Test</span>';
                startBtn.className = "btn btn-success py-2 w-100 d-flex justify-content-center align-items-center";
                startBtn.classList.remove("hide");

                minusBtn.classList.remove("hide");
                plusBtn.classList.remove("hide");

                updateLevelAndShuttle(0);
                if(saveBtn) saveBtn.classList.add("hide");
            });
        }
    });

    function updateTimerDisplay(ms) {
        let totalSeconds = Math.floor(ms / 1000);
        let minutes = Math.floor(totalSeconds / 60);
        let seconds = totalSeconds % 60;
        let centiseconds = Math.floor((ms % 1000) / 10);
        
        let minsStr = String(minutes).padStart(2, '0');
        let secsStr = String(seconds).padStart(2, '0');
        let milliStr = String(centiseconds).padStart(2, '0');
        
        timerDisplay.textContent = `${minsStr}:${secsStr}:${milliStr}`;
    }

    function changeLap(val) {
        let current = parseInt(lapInput.value) || 0;
        current += val;

        if (current >= 0) {
            lapInput.value = current;
            totalLapsCount = current;
            updateLevelAndShuttle(current);
            
            if (current > 0 && saveBtn && !isRunning) {
                saveBtn.classList.remove("hide");
            }
        }
    }

    function updateLevelAndShuttle(totalLaps) {
        let calculatedLevel = 1;
        let calculatedShuttle = 0;
        let accumulatedLaps = 0;

        if (totalLaps > 0) {
            let matched = false;
            for (let level in pacerMatrix) {
                let shuttlesInLevel = pacerMatrix[level];
                if (totalLaps <= (accumulatedLaps + shuttlesInLevel)) {
                    calculatedLevel = parseInt(level);
                    calculatedShuttle = totalLaps - accumulatedLaps;
                    matched = true;
                    break;
                }
                accumulatedLaps += shuttlesInLevel;
            }
            
            if (!matched) {
                calculatedLevel = 21;
                calculatedShuttle = totalLaps - accumulatedLaps + pacerMatrix[21];
            }
        } else {
            calculatedLevel = 1;
            calculatedShuttle = 0;
        }

        currentLevel = calculatedLevel;
        currentShuttle = calculatedShuttle;

        document.getElementById('final_level').value = calculatedLevel;
        document.getElementById('final_shuttle').value = calculatedShuttle;
        document.getElementById('live_status_badge').textContent = `Level ${calculatedLevel}, Shuttle ${calculatedShuttle}`;
    }



    $(document).ready(function() {
        $(`#${formName}`).submit(function(e) {
            e.preventDefault();

            const studentId = document.getElementById('selected_student_id').value;
            if(!studentId){
                handleResponseMessages('warning', 'Select Student', 'Please select the student');
                return;
            }
            
            const finalMmInput = $('input[name="laps_completed"]').val();
            if (finalMmInput === '' || finalMmInput === null || undefined === finalMmInput) {
                handleResponseMessages('info', '', 'Please enter position of the student');
                return;
            }

            let route = '{{ route("cwsn.types.submit") }}';
            let formData = $(this).serialize();
            SubmitForm(formName, formData, route);
            document.getElementById('live_status_badge').textContent = `Level 1, Shuttle 0`;
        });
    });
</script>
@endpush
@endsection