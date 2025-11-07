@extends('layouts.filldart-app')
@section('content')


<div class="pg-yallow-color">
    <div class="container">
        <div class="navbar-expand-lg">
            <div id="fillter" class="" role="group" aria-label="Basic example">
            </div>
        </div>
    </div>
</div>








<div class="">
    <div class="all-chaptr-cards">
	
	
	
	

 <div class="container"> 
 
 
 
 
 <div class="row">
                <div class="col">
                    <a href="#a" onclick="history.back()" class="back-button">
                        <span class="arrow"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5"></path>
                            </svg></span>
                        <!-- <span class="back-txt">Back</span> -->
                    </a>
                    <div class="heading-rw mt-0">
                        <h1>Back</h1>
                    </div>
                </div>
</div>
 
 
 
    <!-- <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <center><h4>Welcome to GoForFit</h4>
                    <p>This is your dashboard</p></center> -->
                    
                    <!-- Profile Widget by Piyush Kumar -->
                    <div class="row justify-content-center">
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <div class="card-header align-items-center">
                                    My Profile
                                    <button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#editProfileModal">Edit</button>
                                </div>
                                <div class="card-body">
                                        <h4>{{ $data['name'] }}</h5>
                                        <p>Class: {{ $data['class_name']}} - {{$data['section']}} </p>
                                        <p>Age: <b>{{ $data['age'] }}</b>  yrs</p>
                                        <p>Height: <b>{{ $data['height'] }}</b>  cm</p>
                                        <p>Weight: <b>{{ $data['weight'] }}</b>  kg</p>
                                </div>
                            </div>
                        </div>

                        <!-- Profile Modal by Piyush Kumar -->
                        <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('updateProfile') }}" method="POST">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" class="form-control" id="name" value="{{ $data['name'] }}" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label for="class_name">Class</label>
                                                <input type="text" class="form-control" id="class_name" value="{{ $data['class_name'] }}" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label for="section">Section</label>
                                                <input type="text" class="form-control" id="section" value="{{ $data['section'] }}" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label for="age">Age</label>
                                                <input type="number" class="form-control" id="age" name="age" value="{{ $data['age'] }}" min="1" max="120" step="1" autofocus>
                                            </div>
                                            <div class="form-group">
                                                <label for="height">Height (cm)</label>
                                                <input type="number" class="form-control" id="height" name="height" value="{{ $data['height'] }}" step="0.01">
                                            </div>
                                            <div class="form-group">
                                                <label for="weight">Weight (kg)</label>
                                                <input type="number" class="form-control" id="weight" name="weight" value="{{ $data['weight'] }}" step="0.1">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Sleep Widget by Ayushman Kumar -->
                        <div class="col-md-4 mb-4">
                                    <div class="card">
                                        <div class="card-header">Sleep
                                            <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#sleepModal">+</button>
                                        </div>
                                        <div class="card-body">
                                            <p id="sleep-display">{{ $totalSleepHours ?? 0 }} / 8 hours</p>
                                            <label for="sleep-progress">Daily Goal:</label>
                                            <progress id="sleep-progress" value="{{ $sleepGoalPercentage }}" max="100" title="You have reached {{ round($sleepGoalPercentage, 2) }}% of your daily goal."></progress>
                                            &nbsp;&nbsp;<span class="sleep-goal-percentage" data-toggle="tooltip" title="You have reached {{ round($sleepGoalPercentage, 2) }}% of your daily goal.">{{ round($sleepGoalPercentage, 2) }}%</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Sleep Modal -->
                                <div class="modal fade" id="sleepModal" tabindex="-1" role="dialog" aria-labelledby="sleepModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="sleepModalLabel">Add Sleep Record</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Nav tabs -->
                                                <ul class="nav nav-tabs" role="tablist">
                                                    <li class="nav-item">
                                                        <a class="nav-link active" data-toggle="tab" href="#day" onclick="showViewHistoryButton()">Day</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" data-toggle="tab" href="#night" onclick="showViewHistoryButton()">Night</a>
                                                    </li>
                                                </ul>

                                                <!-- Tab panes -->
                                                <div class="tab-content">
                                                    <div id="day" class="container tab-pane active"><br>
                                                        <!-- Day sleep form -->
                                                        <form id="daySleepForm" action="{{ route('day.sleep.store') }}" method="POST">
                                                            @csrf
                                                            <div class="form-group">
                                                                <label for="day_sleep_start">Day Sleep Start:</label>
                                                                <input type="time" id="day_sleep_start" name="day_sleep_start" class="form-control" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="day_sleep_end">Day Sleep End:</label>
                                                                <input type="time" id="day_sleep_end" name="day_sleep_end" class="form-control" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="sleep_date">Date:</label>
                                                                <input type="date" id="sleep_date" name="sleep_date" class="form-control" value="{{ now()->toDateString() }}" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <button type="submit" class="btn btn-primary">Add</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div id="night" class="container tab-pane fade"><br>
                                                        <!-- Night sleep form -->
                                                        <form id="nightSleepForm" action="{{ route('night.sleep.store') }}" method="POST">
                                                            @csrf
                                                            <div class="form-group">
                                                                <label for="night_sleep_start">Night Sleep Start:</label>
                                                                <input type="time" id="night_sleep_start" name="night_sleep_start" class="form-control" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="night_sleep_end">Night Sleep End:</label>
                                                                <input type="time" id="night_sleep_end" name="night_sleep_end" class="form-control" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="sleep_date_night">Date:</label>
                                                                <input type="date" id="sleep_date_night" name="sleep_date_night" class="form-control" value="{{ now()->toDateString() }}" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <button type="submit" class="btn btn-primary">Add</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Modal footer with Check History button -->
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal" data-toggle="modal" data-target="#historyModal">Check History</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- History Modal -->
                                <div class="modal fade" id="historyModal" tabindex="-1" role="dialog" aria-labelledby="historyModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="historyModalLabel">Sleep History</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                @foreach($history as $record)
                                                    <div class="history-item">
                                                        <div class="history-date">{{ \Carbon\Carbon::parse($record['date'])->format('d M Y') }}</div>
                                                        <div class="history-details">
                                                            <span>{{ $record['totalSleepHours'] }} Hrs / Day</span>
                                                            <span>{{ round($record['sleepGoalPercentage'], 2) }}% of your goals</span>
                                                            <progress value="{{ $record['sleepGoalPercentage'] }}" max="100"></progress>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                                        

                        <!-- Water Intake Widget by Himanshu -->
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <div class="card-header">Water Intake
                                    <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#waterIntakeModal">+</button>
                                </div>
                                <div class="card-body">
                                    <p id="water-intake-display">{{ $waterIntake ?? 0 }} / 8 glasses</p>
                                    <label for="water-intake-progress">Daily Goal:</label>
                                    <progress id="water-intake-progress" value="{{ $percentageOfGoal }}" max="100" title="You have reached {{ round($percentageOfGoal, 2) }}% of your daily goal."></progress>&nbsp;&nbsp;{{ $percentageOfGoal}}%
                                </div>
                            </div>
                        </div>

                        <!-- Water Intake Modal by Himanshu-->
                        <div class="modal fade" id="waterIntakeModal" tabindex="-1" role="dialog" aria-labelledby="waterIntakeModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="waterIntakeModalLabel">Add Water Intake</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form method="POST" action="{{ route('water-intake.store') }}">
                                @csrf
                                <div class="modal-body">
                                <div class="form-group">
                                    <label for="date">Date</label>
                                    <input type="date" id="date" name="date" class="form-control" value="{{ date('Y-m-d') }}">
                                </div>
                                <div class="form-group">
                                    <label for="water-intake">Water Intake (in glasses)</label>
                                    <div id="water-intake-boxes" class="d-flex flex-wrap">
                                    <!-- JavaScript will generate boxes here -->
                                    <script>
                                        document.addEventListener("DOMContentLoaded", function() {
                                        const boxesContainer = document.getElementById('water-intake-boxes');
                                        const hiddenInput = document.getElementById('water-intake');
                                        const maxGlasses = 8;

                                        for (let i = 1; i <= maxGlasses; i++) {
                                            const box = document.createElement('div');
                                            box.className = 'water-intake-box';
                                            box.dataset.value = i;
                                            box.style.width = '40px';
                                            box.style.height = '40px';
                                            box.style.margin = '5px';
                                            box.style.border = '1px solid #ccc';
                                            box.style.display = 'flex';
                                            box.style.alignItems = 'center';
                                            box.style.justifyContent = 'center';
                                            box.style.cursor = 'pointer';
                                            box.textContent = i;
                                            box.addEventListener('click', function() {
                                                updateBoxes(i);
                                            });
                                            boxesContainer.appendChild(box);
                                        }

                                        function updateBoxes(selected) {
                                            const boxes = document.querySelectorAll('.water-intake-box');
                                            boxes.forEach(box => {
                                                if (parseInt(box.dataset.value) <= selected) {
                                                    box.style.backgroundColor = 'blue';
                                                    box.style.color = 'white';
                                                } else {
                                                    box.style.backgroundColor = 'white';
                                                    box.style.color = 'black';
                                                }
                                            });
                                            hiddenInput.value = selected;
                                        }
                                        });
                                    </script>
                                    </div>
                                    <input type="hidden" id="water-intake" name="water_intake" required>
                                </div>
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#datePickerModal">Check History</button>
                                </div>
                            </form>
                            </div>
                            </div>
                        </div>
                        
                        <!-- Date Picker Modal -->
                        <div class="modal fade" id="datePickerModal" tabindex="-1" role="dialog" aria-labelledby="datePickerModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="datePickerModalLabel">Select Date</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form id="date-picker-form" method="GET" action="{{ route('water-intake.by-date') }}">
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="selected-date">Choose a date</label>
                                                <input type="date" class="form-control" id="selected-date" name="selected_date" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Show Water Intake</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Historical Water Intake Modal -->
                        <div class="modal fade" id="historicalWaterIntakeModal" tabindex="-1" role="dialog" aria-labelledby="historicalWaterIntakeModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="historicalWaterIntakeModalLabel">Water Intake History</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p id="historical-water-intake-display"></p>
                                        <p id="historical-water-intake-progress"></p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- My Plan Widget by Piyush Kumar -->
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <div class="card-header">My Plan
                                <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#updateCalorieTargetModal">Update Calorie Target</button>
                                </div>
                                <div class="card-body">
                                    <p>Goals as per current activity level and lifestyle</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span><h4>{{ $data['weight'] }}</h4> kg</span>
                                        <span style='font-size:50px;'>&#8680;</span>
                                        <span><h4>{{ number_format($data['target_weight'], 2) }}</h4> kg</span>
                                    </div><br>
                                    <p>Calories Intake: <b>{{ $targetCalories }}</b> kcal</p>
                                </div>
                            </div>
                        </div>

                        @php
                            $backgroundColor = '';
                            if ($data['bmi'] >= 18.5 && $data['bmi'] < 25) {
                                $backgroundColor = '#d4edda'; // Normal weight - Green
                            } else {
                                $backgroundColor = '#f8d7da'; // Overweight - Red
                            }
                        @endphp

                        <!-- Fitness Score Widget by Piyush Kumar -->
                        <div class="col-md-4 mb-4">
                            <div class="card fitness-card">
                                <div class="card-header align-items-center">Fitness Score</div>
                                <div class="card-body fitness-body" data-bg-color="{{ $backgroundColor }}">
                                <h4>Your BMI: {{ number_format($data['bmi'], 2) }}</h4>

                                    @if ($data['bmi'] < 18.5)
                                        <p>You are underweight.</p>
                                    @elseif ($data['bmi'] >= 18.5 && $data['bmi'] < 25)
                                        <p>You have a normal weight.</p>
                                    @else
                                        <p>You are overweight.</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Calorie Intake Widget by Dhruv Bhardwaj-->
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <span>Calorie Intake</span>
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#selectMealModal">Add</button>
                                </div>
                                <div class="card-body">
                                    <strong>Calories Intake:</strong> {{ $totalCaloriesAllToday }}/{{ $targetCalories }} <br>
                                    <progress id="calorie-progress" max="{{ $targetCalories }}" value="{{ $totalCaloriesAllToday }}">{{ round(($totalCaloriesAllToday / $targetCalories) * 100, 2) }}%</progress><br>
                                    {{ round(($totalCaloriesAllToday / $targetCalories) * 100) }}% of your goal is complete <br>
                                </div>
                            </div>
                        </div>

                        <!-- No. of PE Classes by by Animish Tiwari -->
                        <div class="col-md-8 mb-4">
                            <div class="card">
                                <div class="card-header">No. of PE classes</div>
                                <div class="card-body">
                                    <div class="mt-4">
                                        @if (isset($activities) && is_array($activities) && count($activities) > 0)
                                            <div class="activity-container">
                                                <label for="activity name">Activity Name</label>
                                                <div class="d-flex flex-nowrap">
                                                    <div class="scroll-bar">
                                                    @foreach ($activities as $activity)
                                                        <div class="activity-box p-3 mb-2" style="background-color: #697581;">
                                                            <div class="activity-title text-white">{{ $activity->title }}</div>
                                                            <p class="activity-minutes">Active Minutes = 30</p>
                                                            @foreach($reports as $report)
                                                                @if($report->activity_id == $activity->id)
                                                                     <div class="date-box">{{$report->date}}</div>
                                                                     <div class="level-box bg-success text-white">
                                                                        @php
                                                                            switch ($report->level) {
                                                                                case 0:
                                                                                    echo 'Absent';
                                                                                    break;
                                                                                case 1:
                                                                                    echo 'Learning';
                                                                                    break;
                                                                                case 2:
                                                                                    echo 'Progressing';
                                                                                    break;
                                                                                case 3:
                                                                                    echo 'Proficient';
                                                                                    break;
                                                                                case 4:
                                                                                    echo 'Exemplary';
                                                                                    break;
                                                                                default:
                                                                                    echo 'Unknown';
                                                                                    break;
                                                                            }
                                                                        @endphp
                                                                     </div>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <p>No activities found for the selected student in the last 7 days.</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Calories Burned -->
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <div class="card-header">Calories Burned</div>
                                <div class="card-body">
                                </div>
                            </div>
                        </div>

                        
                        <!-- Today's Activities -->
                        <div class="col-md-8 mb-4">
                            <div class="card">
                                <div class="card-header">Today's Activities</div>
                                <div class="card-body">
                                </div>
                            </div>
                        </div>      

                        <!-- Active PE Minutes -->
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <div class="card-header">Active PE Minutes</div>
                                <div class="card-body">
                                </div>
                            </div>
                        </div>
						
						
						</div>
						</div>
                    

@include('record_calories')



<!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
 <!-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>  -->
<!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->



@if(session('showEditProfileModal'))
    <script>
        $(document).ready(function() {
            $('#editProfileModal').modal('show');
        });
    </script>
@endif

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var fitnessCard = document.querySelector('.fitness-body');
        var bgColor = fitnessCard.getAttribute('data-bg-color');
        fitnessCard.style.backgroundColor = bgColor;
    });
</script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Event listener for date picker form submission
        document.getElementById('date-picker-form').addEventListener('submit', function(e) {
            e.preventDefault(); // Prevent form submission

            const selectedDate = document.getElementById('selected-date').value;
            
            // Fetch data using selected date
            fetch(`/water-intake-by-date?selected_date=${selectedDate}`)
                .then(response => response.json())
                .then(data => {
                    // Update historical water intake modal content
                    document.getElementById('historical-water-intake-display').innerText = `Intake for: ${data.selectedDate} - ${data.waterIntake} / 8 glasses`;
                    document.getElementById('historical-water-intake-progress').innerHTML = `<label for="water-intake-progress">Daily Goal:</label> <progress id="water-intake-progress" value="${data.percentageOfGoal}" max="100" title="You have reached ${data.percentageOfGoal.toFixed(2)}% of your daily goal."></progress>&nbsp;&nbsp;${data.percentageOfGoal.toFixed(2)}%`;

                    // Close date picker modal and show historical water intake modal
                    $('#datePickerModal').modal('hide');
                    $('#historicalWaterIntakeModal').modal('show');
                })
                .catch(error => console.error('Error:', error));
        });

        // Event listener to remove modal backdrop when historical modal is closed
        $('#historicalWaterIntakeModal').on('hidden.bs.modal', function () {
            $('.modal-backdrop').remove();
        });
    });
</script>

<script>
    $(document).ready(function() {
        let selectedDateSleep = $('#date').val();
        if (!selectedDateSleep) {
            selectedDateSleep = new Date().toISOString().split('T')[0]; // Default to today's date if none selected
            $('#date').val(selectedDateSleep);
        }

        $('#view-records-form').submit(function(event) {
            event.preventDefault();
            const form = $(this);
            const url = form.attr('action');

            $.ajax({
                type: "GET",
                url: url,
                data: form.serialize(),
                success: function(response) {
                    // Populate the modal with the response data
                    $('#historyModal .modal-body').html($(response).find('#historyModal .modal-body').html());
                    // Show the modal
                    $('#historyModal').modal('show');
                }
            });
        });
    });
</script>


<!-- jQuery UI Datepicker script -->
<!-- <script>
    $(document).ready(function() {
        $("#date").datepicker({
            dateFormat: "dd/mm/yy",
            maxDate: 0 // Prevent future dates selection
        });
</script> -->

<style>
    .activity-container {
        overflow-x: auto;
        white-space: nowrap;
       
    }
    .activity-container::-webkit-scrollbar {
        height: 8px;
    }
    .activity-container::-webkit-scrollbar-thumb {
        background-color: rgba(0,0,0,0.5);
        border-radius: 10px;
    }
    .activity-container::-webkit-scrollbar-thumb:hover {
        background-color: rgba(0,0,0,0.8);
    }
    .activity-container::-webkit-scrollbar-track {
        background: transparent;
    }
    .activity-box {
        border: 1px solid #dee2e6; /* Border color */
        border-radius: 5px; /* Rounded corners */
        padding: 10px;
        height: 110px; /* Minimum height to keep all boxes the same size */
        width: 190px; /* Set a fixed width for each activity box */
        white-space: normal; /* Allow text to wrap */
        margin-right: 8px; /* Increase the right margin between boxes */
        overflow: hidden; /* Hide overflow text */
        position: relative; /* To position the Active Minutes text absolutely */
        display: inline-block; /* Ensure boxes are displayed inline */
    }
    .activity-title {
        font-weight: bold;
        font-size: 0.38cm;
        color: #ffffff; /* White text color for better contrast */
        margin-top: 0.25cm; /* Shift the title 0.1 cm down */
    }
    .activity-minutes {
        position: absolute;
        bottom: -15px; /* Adjusted position from bottom */
        left: 6px; /* Position from left */
        color: #cfcfcfc4; /* Black color */
        font-size: 0.65em; /* Smaller font size */
    }
    .scroll-bar{
        height: 130px;
        widows: 30px;
        border: 1px solid gray;
        font-family: 'GestaRegular',Arial, Helvetica, sans-serif;
        overflow-x: auto;
        white-space: nowrap;
    }
    .level-box {
        background-color: #fb8b36; /* Orange background color */
        color: #ffffff; /* White text color */
        position: absolute;
        top: 5px; /* Adjust position from top */
        right: 5px; /* Adjust position from right */
        width: 80px; /* Adjust the width */
        height: 20px; /* Adjust the height */
        font-size: 0.6em; /* Adjust the font size */
        line-height: 20px; /* Center text vertically */
        text-align: center; /* Center text horizontally */
        border-radius: 5px; /* Rounded corners */
        font-weight: bold; /* Make the text bold */
    }
    .date-box {
        color: #020202; /* White text color */
        position: absolute;
        top: 5px; /* Adjust position from top */
        left: 5px; /* Adjust position from right */
        width: 60px; /* Adjust the width */
        height: 20px; /* Adjust the height */
        font-size: 0.7em; /* Adjust the font size */
        line-height: 20px; /* Center text vertically */
        text-align: center; /* Center text horizontally */
        border-radius: 5px; /* Rounded corners */
        font-weight: bold; /* Make the text bold */
    }
</style>

@endsection

@push('scripts')
<script>
    function showViewHistoryButton() {
        $('#viewHistoryBtn').show();
    }
</script>
@endpush



