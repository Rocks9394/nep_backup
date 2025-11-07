{{-- BreakfastModal --}}
<div class="modal fade" id="breakfastModal" tabindex="-1" role="dialog" aria-labelledby="breakfastModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="breakfastModalLabel">
                    <button type="button" class="btn btn-secondary backToSelectMeal" style="font-size: 1.2rem; color: black;">
                        <i class="fa fa-arrow-left"></i>
                    </button>
                    Record Your Breakfast Calories
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('record.calories') }}">
                    @csrf
                    <input type="hidden" name="meal_type" value="breakfast">
                    <input type="hidden" name="status" value="1">
                    <div class="form-group">
                        <label for="food">Food Items:<span class="required-star">*</span></label>
                        <select class="form-control" id="food" name="food" required>
                            <option value="">Select Food</option>
                            @foreach($foodItems as $foodItem)
                                <option value="{{ $foodItem->food_item_name }}">{{ $foodItem->food_item_name }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger">
                            @error('food')
                            {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="form-group">
                        <label for="amount">Quantity in Bowl/Serving/Piece etc:<span class="required-star">*</span></label>
                        <input type="number" step="0.01" class="form-control" id="amount" name="amount" min="0" required>
                        <span class="text-danger">
                            @error('amount')
                            {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                </form>
            </div>
        </div>
    </div>
</div>


{{-- LunchModal --}}
<div class="modal fade" id="lunchModal" tabindex="-1" role="dialog" aria-labelledby="lunchModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="lunchModalLabel">
                    <button type="button" class="btn btn-secondary backToSelectMeal" style="font-size: 1.2rem; color: black;">
                        <i class="fa fa-arrow-left"></i>
                    </button>
                    Record Your Lunch Calories
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('record.calories') }}">
                    @csrf
                    <input type="hidden" name="meal_type" value="lunch">
                    <input type="hidden" name="status" value="2">
                    <div class="form-group">
                        <label for="food">Food Items:<span class="required-star">*</span></label>
                        <select class="form-control" id="food" name="food" required>
                            <option value="">Select Food</option>
                            @foreach($foodItems as $foodItem)
                                <option value="{{ $foodItem->food_item_name }}">{{ $foodItem->food_item_name }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger">
                            @error('food')
                            {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="form-group">
                        <label for="amount">Quantity in Bowl/Serving/Piece etc:<span class="required-star">*</span></label>
                        <input type="number" step="0.01" class="form-control" id="amount" name="amount" min="0" required>
                        <span class="text-danger">
                            @error('amount')
                            {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                </form>
            </div>
        </div>
    </div>
</div>


{{-- SnacksModal --}}
<div class="modal fade" id="snacksModal" tabindex="-1" role="dialog" aria-labelledby="snacksModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="snacksModalLabel">
                    <button type="button" class="btn btn-secondary backToSelectMeal" style="font-size: 1.2rem; color: black;">
                        <i class="fa fa-arrow-left"></i>
                    </button>
                    Record Your Snacks Calories
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('record.calories') }}">
                    @csrf
                    <input type="hidden" name="meal_type" value="snacks">
                    <input type="hidden" name="status" value="3">
                    <div class="form-group">
                        <label for="food">Food Items:<span class="required-star">*</span></label>
                        <select class="form-control" id="food" name="food" required>
                            <option value="">Select Food</option>
                            @foreach($foodItems as $foodItem)
                                <option value="{{ $foodItem->food_item_name }}">{{ $foodItem->food_item_name }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger">
                            @error('food')
                            {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="form-group">
                        <label for="amount">Quantity in Bowl/Serving/Piece etc:<span class="required-star">*</span></label>
                        <input type="number" step="0.01" class="form-control" id="amount" name="amount" min="0" required>
                        <span class="text-danger">
                            @error('amount')
                            {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- DinnerModal --}}
<div class="modal fade" id="dinnerModal" tabindex="-1" role="dialog" aria-labelledby="dinnerModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="dinnerModalLabel">
                    <button type="button" class="btn btn-secondary backToSelectMeal" style="font-size: 1.2rem; color: black;">
                        <i class="fa fa-arrow-left"></i>
                    </button>
                    Record Your Dinner Calories
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('record.calories') }}">
                    @csrf
                    <input type="hidden" name="meal_type" value="dinner">
                    <input type="hidden" name="status" value="4">
                    <div class="form-group">
                        <label for="food">Food Items:<span class="required-star">*</span></label>
                        <select class="form-control" id="food" name="food" required>
                            <option value="">Select Food</option>
                            @foreach($foodItems as $foodItem)
                                <option value="{{ $foodItem->food_item_name }}">{{ $foodItem->food_item_name }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger">
                            @error('food')
                            {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="form-group">
                        <label for="amount">Quantity in Bowl/Serving/Piece etc:<span class="required-star">*</span></label>
                        <input type="number" step="0.01" class="form-control" id="amount" name="amount" min="0" required>
                        <span class="text-danger">
                            @error('amount')
                            {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                </form>
            </div>
        </div>
    </div>
</div>









{{-- <div class="modal fade" id="recordCaloriesModal" tabindex="-1" role="dialog" aria-labelledby="recordCaloriesModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="recordCaloriesModalLabel">
                    <button type="button" class="btn btn-link p-0" id="backToSelectMeal" style="font-size: 1.2rem; color: black;">
                        <i class="fa fa-arrow-left"></i>
                    </button>
                    Record Your Calories
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('record.calories') }}">
                    @csrf
                    <input type="hidden" name="meal_type" id="mealTypeHidden">
                    <div class="form-group">
                        <label for="food">Food Items:<span class="required-star">*</span></label>
                        <select class="form-control" id="food" name="food" required>
                            <option value="">Select Food</option>
                            @foreach($foodItems as $foodItem)
                                <option value="{{ $foodItem->food_item_name }}">{{ $foodItem->food_item_name }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger">
                            @error('food')
                            {{ $message }}
                            @enderror
                        </span>
                    </div>

                    {{-- <div class="form-group">
                        <label for="serving">Serving Quantity Type:<span class="required-star">*</span></label>
                        <select class="form-control" id="serving" name="serving" required>
                            <option value="">Select Serving Quantity Type</option>
                            @php
                                // Extract unique serving unit names
                                $uniqueUnits = $foodItems->unique('serving_unit')->pluck('serving_unit');
                            @endphp
                            @foreach($uniqueUnits as $unit)
                                <option value="{{ $unit }}">{{ $unit }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger">
                            @error('serving')
                            {{ $message }}
                            @enderror
                        </span>
                    </div> --}}
                    

                    {{-- <div class="form-group">
                        <label for="amount">Quantity in Bowl/Serving/Piece etc:<span class="required-star">*</span></label>
                        <input type="number" step="0.01" class="form-control" id="amount" name="amount" min="0" required>
                        <span class="text-danger">
                            @error('amount')
                            {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                </form>
            </div>
        </div>
    </div>
</div>  --}}





<div class="modal fade" id="selectMealModal" tabindex="-1" role="dialog" aria-labelledby="selectMealModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="selectMealModalLabel">Calorie Intake</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <strong style="font-size: 1.5em;">Calories Intake:</strong> <span style="font-size: 1.5em;">{{ $totalCaloriesAllToday }}/{{ $targetCalories }}</span> <br>
                <progress id="calorie-progress" max="{{ $targetCalories }}" value="{{ $totalCaloriesAllToday }}" style="width: 100%; height: 20px;">{{ round(($totalCaloriesAllToday / $targetCalories) * 100, 2) }}%</progress><br>

                <div class="row">
                    @foreach(['breakfast', 'lunch', 'snacks', 'dinner'] as $meal)
                        <div class="col-md-6 mb-4">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <span>{{ ucfirst($meal) }}</span>
                                    <button type="button" class="btn btn-primary addMeal" data-meal="{{ $meal }}">Add</button>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <strong style="font-size: 0.875em;">Calories Consumed: </strong><span style="font-size: 0.875em;">{{ $calories[$meal] ?? 0 }} cal</span>
                                    </div>
                                    
                                    @foreach($mealDetails[$meal] as $detail)
                                        <div class="d-flex justify-content-between align-items-center mb-1"> 
											<span style="font-size: 0.85em;">{{ $detail['name'] }} | {{ $detail['amount'] }} {{ $detail['serving_type'] }}: {{ $detail['calories'] }} cal</span>
                                            <button type="button" class="btn btn-sm btn-danger deleteMeal" data-meal-id="{{ $detail['id'] }}">
                                                <i class="fa fa-trash"></i> <!-- Font Awesome trash icon -->
                                            </button>                                        
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="viewHistoryBtn">View History</button>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="calorieHistoryModal" tabindex="-1" role="dialog" aria-labelledby="calorieHistoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn btn-link p-0" id="backToSelectMealFromHistory" style="font-size: 1.2rem; color: black;">
                    <i class="fa fa-arrow-left"></i>
                </button>
                <h5 class="modal-title" id="calorieHistoryModalLabel">Calorie Intake History</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @foreach ($totalCaloriesByDay as $date => $totalCalories)
                <h6>{{ $date }}</h6>
                <div>
                    Total Calories: {{ $totalCalories }} kcal
                    <progress max="{{ $targetCalories }}" value="{{ $totalCalories }}"></progress>
                    {{ round(($totalCalories / $targetCalories) * 100) }}% of goal
                </div>
                <hr>
                @endforeach
            </div>
        </div>
    </div>
</div>


{{-- UpdateCalorieTargetModal --}}
<div class="modal fade" id="updateCalorieTargetModal" tabindex="-1" role="dialog" aria-labelledby="updateCalorieTargetModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateCalorieTargetModalLabel">
                    <button type="button" class="btn btn-secondary backToSelectMeal" style="font-size: 1.2rem; color: black;">
                        <i class="fa fa-arrow-left"></i>
                    </button>
                    Update Your Calorie Target
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('setCalorieTarget') }}">
                    @csrf
                    <div class="form-group">
                        <label for="target_calories">Target Calories</label>
                        <input type="number" class="form-control" id="target_calories" name="target_calories" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
                
            </div>
        </div>
    </div>
</div>



<!--<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>-->



<script>
    $(document).ready(function() {
        // Function to hide current modal and show selectMealModal
        function showSelectMealModal() {
            $('.modal:visible').modal('hide');
            setTimeout(function() {
                $('#selectMealModal').modal('show');
            }, 500); // Adjust the timeout duration as needed
        }

        $('.addMeal').click(function() {
            const mealType = $(this).data('meal');
            $('#selectMealModal').modal('hide'); // Hide the selectMealModal before opening any other modal
            setTimeout(function() { // Add a timeout to ensure the modal is properly hidden before showing the next one
                switch (mealType) {
                    case 'breakfast':
                        $('#breakfastModal').modal('show');
                        break;
                    case 'lunch':
                        $('#lunchModal').modal('show');
                        break;
                    case 'snacks':
                        $('#snacksModal').modal('show');
                        break;
                    case 'dinner':
                        $('#dinnerModal').modal('show');
                        break;
                }
            }, 500); // Adjust the timeout duration as needed
        });

        $('.backToSelectMeal').click(function() {
            showSelectMealModal();
        });

        $('#viewHistoryBtn').click(function() {
            $('#selectMealModal').modal('hide');
            setTimeout(function() {
                $('#calorieHistoryModal').modal('show');
            }, 500); // Adjust the timeout duration as needed
        });

        $('#backToSelectMealFromHistory').click(function() {
            $('#calorieHistoryModal').modal('hide');
            setTimeout(function() {
                $('#selectMealModal').modal('show');
            }, 500); // Adjust the timeout duration as needed
        });

        // Show updateCalorieTargetModal when clicking on updateCalorieTargetBtn
        $('#updateCalorieTargetBtn').click(function() {
            $('#selectMealModal').modal('hide');
            setTimeout(function() {
                $('#updateCalorieTargetModal').modal('show');
            }, 500); // Adjust the timeout duration as needed
        });

        // Ensure modal backdrop is removed to prevent stacking issues
        $('.modal').on('hidden.bs.modal', function () {
            $('body').removeClass('modal-open');
            $('.modal-backdrop').remove();
        });
    });
</script>


<script>
    $(document).ready(function() {
    // Handle click on delete button
    $('.deleteMeal').on('click', function() {
        var mealIdToDelete = $(this).data('meal-id');
        var $deletedItem = $(this).closest('.d-flex');

        // Use JavaScript confirm dialog before deleting
        if (confirm('Are you sure you want to delete this meal item?')) {
            $.ajax({
                url: '/delete-meal/' + mealIdToDelete,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.success) {
                        alert('Meal item deleted successfully.');

                        // Reload the page after deletion
                        location.reload(true); // true for hard reload (clear cache)
                    } else {
                        alert('Failed to delete meal item: ' + response.message);
                    }
                },
                error: function(xhr, status, error) {
                    alert('Error occurred while deleting meal item: ' + error);
                }
            });
        }
    });
});

</script>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">