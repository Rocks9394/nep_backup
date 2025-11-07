@extends('layouts.filldart-app') 
@section('title', 'Goforfit | ' . $title)
@section('content')

<div class="all-chaptr-cards">
    <div class="container">
        <div class="t-mrg2 mb-5 pb-5">
            <div class="row">
                <div class="col-12">
                    <div class="heading-rw mt-0 mt-md-1 mb-0 p-0">
                        <a href="javascript:history.back()" class="back-button">
                            <span class="arrow"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5" />
                                </svg>
                            </span>
                        </a>

                        <h1 class="ml-md-4 mb-0">{{$title}}</h1>
                    </div>
                </div>
            </div>
            <form id="addSchoolUser" method="POST" action="">
                @csrf

                <h5 class="card-title text-center mt-3">Add school user</h5>                        
                <div class="form-row">      

                    <div class="form-group col-md-9">
                        <label for="name">Full Name <span style="color: red; font-weight: bold;" >*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Full Name">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col-md-3">
                        <label for="gender">Gender <span style="color: red; font-weight: bold;" >*</span></label>
                        <select id="gender" name="gender" class="form-control @error('gender') is-invalid @enderror">
                            <option>Choose...</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Transgender">Transgender</option>
                        </select>
                        @error('gender')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="qualification">Qualification <span style="color: red; font-weight: bold;" >*</span></label>
                        <input type="text" class="form-control @error('qualification') is-invalid @enderror" name="qualification" id="qualification" placeholder="Type here">
                        @error('qualification')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col-md-5">
                        <label for="inputEmail4">Email <span style="color: red; font-weight: bold;" >*</span></label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="trainerEmail" name="email" placeholder="sc_bosh@gmail.com">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col-md-3">
                        <label for="inputPassword4">Mobile <span style="color: red; font-weight: bold;" >*</span></label>
                        <input type="number" class="form-control @error('mobile') is-invalid @enderror" id="number" name="mobile" placeholder="+91 00000 00000">
                        @error('mobile')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="form-row">

                    <div class="form-group col-sm-6 col-md-6 col-lg-3">
                        <label for="selectState">State <span style="color: red; font-weight: bold;" >*</span></label>
                        <select id="selectState" name="state" class="form-control @error('state') is-invalid @enderror">
                            <option selected>Select</option>
                            @foreach($state_list as $list)
                                <option value="{{ $list->id }}">{{ $list->name }}</option>
                            @endforeach
                        </select>
                        @error('state')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="form-group col-sm-6 col-md-6 col-lg-3">
                        <label for="selectDistrict">District <span style="color: red; font-weight: bold;" >*</span></label>
                        <select id="selectDistrict" name="district" class="form-control @error('district') is-invalid @enderror">
                            <option selected>Select</option>
                        </select>
                        @error('district')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    

                    <div class="form-group col-sm-6 col-md-6 col-lg-3">
                        <label for="inputPassword4">Block <span style="color: red; font-weight: bold;" >*</span></label>
                        <input type="text" class="form-control @error('block') is-invalid @enderror" id="number" name="block" placeholder="">
                        @error('block')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group col-sm-6 col-md-6 col-lg-3">
                        <label for="selectCity">City <span style="color: red; font-weight: bold;" >*</span></label>
                        <input type="text" class="form-control @error('city') is-invalid @enderror" id="city" name="city" placeholder="">
                        @error('city')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    
                </div>

                <!-- Address -->


                <div class="form-row">
                    <div class="form-group col-sm-6 col-md-6 col-lg-9">
                        <label for="schoolAddress">Address <span style="color: red; font-weight: bold;" >*</span></label>
                        <textarea id="schoolAddress" name="address" rows="2" class="form-control  @error('address') is-invalid @enderror"></textarea>
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col-sm-6 col-md-6 col-lg-3">
                        <label for="schoolAddress">DOB <span style="color: red; font-weight: bold;" >*</span></label>
                        <input type="date" name="dob" id="dob" class="form-control  @error('dob') is-invalid @enderror">
                        @error('dob')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Submit -->
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary"><span>Submit</span></button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>


  $(document).ready(function () {
    const today = new Date().toISOString().split("T")[0];
    $('#dob').attr('max', today);


    $('#dobForm').submit(function (e) {
      const dob = new Date($('#dob').val());
      const now = new Date();

      dob.setHours(0, 0, 0, 0);
      now.setHours(0, 0, 0, 0);

      if (dob > now) {
        alert("Date of birth cannot be in the future.");
        e.preventDefault(); // Stop form submission
      }
    });
  });


    $(document).ready(function() {
        $('#selectState').on('change', function() {
            const stateId = $(this).val();
            const selectDistrict = $('#selectDistrict');
            selectDistrict.empty().append('<option value="">Select District</option>');

            if (stateId) {
                $.ajax({
                    type: 'POST',
                    url: "{{ route('school.getDistrict') }}",
                    data: {
                        stateId: stateId,
                        _token: "{{ csrf_token() }}"
                    },
                    dataType: 'json',

                    success: function(response) {
                        $.each(response, function(index, city) {
                            selectDistrict.append(
                                $('<option>', {
                                    value: city.id,
                                    text: city.name
                                })
                            );
                        });
                    },

                    error: function(xhr, status, error) {
                        console.error("AJAX Error:", xhr.responseText);
                        $('#message').text('Error loading districts!');
                    }
                });
            }
        });
    });

</script>
<script>
   
$(document).ready(function() {
    $('#addSchoolUser').submit(function(e) {
        e.preventDefault();
        submitLoader();
        $.ajax({
            url: '{{ route("add.school.user")}}',
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                Swal.close();            
                Swal.fire({
                    title: 'Success!',
                    text: response.message,
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        location.reload();
                    }
                });	
            },
            error: function(xhr) {
                Swal.close();
                if (xhr.status === 422) {
                    const errors = xhr.responseJSON.errors;
                    $('.invalid-feedback').remove(); // Clear old errors
                    $('.is-invalid').removeClass('is-invalid');

                    $.each(errors, function(field, messages) {
                        const input = $('[name="' + field + '"]');
                        input.addClass('is-invalid');
                        input.after('<div class="invalid-feedback d-block">' + messages[0] + '</div>');
                    });
                    Swal.fire({
                        title: '',
                        text: xhr.responseJSON.message,
                        icon: 'warning'
                    });

                    return;
                }
                if (xhr.status === 409) {
                    Swal.fire({
                        title: '',
                        text: xhr.responseJSON.message || 'User already exists.',
                        icon: 'error'
                    });
                    return;
                }

                Swal.fire({
                    title: "Error!",
                    text: "Something went wrong!",
                    icon: "error"
                });
            }
        });
    });
});

</script>

@endsection
