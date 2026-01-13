@extends('layouts.filldart-app')
@section('title', 'Goforfit | ' . $title)
@section('content')


<style type="text/css">
   .header-container {
       display: flex;
       align-content: center;
       align-items: center;
       margin-top: 22px;
   }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="">
   

      <div class="container">
         <div class="t-mrg2">
            <div class="all-chaptr-cards">
                <div class="row">
                    <div class="col-12 col-sm">
                        <div class="heading-rw mt-3 mt-md-1 mb-0 p-0">
                            <a href="{{ route('filldart.dashboard') }}" class="back-button">
                                <span class="arrow">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5" />
                                    </svg>
                                </span>
                            </a>
                                <h1 class="ml-md-4 mb-0">{{$title}}</h1>
                        </div>
                    </div>
                    <div class="col-12 col-sm-auto" id="trainer_search_box">
                        <form class="form-inline input-group mt-3 my-sm-0">
                            <div class="input-group-prepend col p-0">
                                <div class="input-group">
                                    <input class="form-control mr-2" type="search" id="trainer_search"  name="query" placeholder="Reg ID, Name, Email..." aria-label="Search">
                                </div> 
                            </div>
                            <button class="btn btn-sm btn-outline-success" type="submit">Search</button>
                        </form>
                    </div> 
                </div>

                <div class="header-container1 justify-content-center">
                    <div class="from__bx mt-4">
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <!-- <div class="col">
                                        <h3 class="m-0">Registered With School</h3>
                                    </div> -->
                                    <div class="col-12 col-auto">
                                         <!-- Toggle Buttons -->
                                        <div class="btn-group btn-group-toggle justify-content-center p-0 my-2" data-toggle="buttons">
                                            <label class="btn btn-secondary btn-sm d-flex align-items-center {{ $errors->any() ? '' : 'active' }}" style="gap:5px;">
                                                <input type="radio" name="options" id="option1" autocomplete="off" {{ $errors->any() ? '' : 'checked' }}> 
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-check2-square" viewBox="0 0 16 16"> <path d="M3 14.5A1.5 1.5 0 0 1 1.5 13V3A1.5 1.5 0 0 1 3 1.5h8a.5.5 0 0 1 0 1H3a.5.5 0 0 0-.5.5v10a.5.5 0 0 0 .5.5h10a.5.5 0 0 0 .5-.5V8a.5.5 0 0 1 1 0v5a1.5 1.5 0 0 1-1.5 1.5z"/>  <path d="m8.354 10.354 7-7a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0"/></svg>
                                                <span class="d-none d-sm-block">Registered With School</span>
                                            </label>

                                            <!-- Export Button -->
                                            <button id="enableExportBtn" type="button" class="btn btn-secondary btn-sm d-flex align-items-center" style="gap:5px; display:none !important;">
                                                <img src="https://nep.goforfit.in/public/assets/imgs/export.svg">
                                                <span class="d-none d-sm-block trainer-action-btn">Export</span>
                                            </button>

                                            <label class="btn btn-secondary btn-sm d-flex align-items-center {{ $errors->any() ? 'active' : '' }}" style="gap:5px;">
                                                <input type="radio" name="options" id="option2" autocomplete="off" {{ $errors->any() ? 'checked' : '' }}> 
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16"> <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2"/></svg>
                                                <span class="d-none d-sm-block">Add Trainer</span>
                                            </label>
                                        </div>
                                    </div>
                                    
                                </div>
                               
                            </div>
                    
                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('success') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                            @endif
                            <div id="mappedTrainersContainer" class="col-12" style="display: none;">
                                <div id="mapped_trainer_table_container" style="margin-top: 15px;">
                                    <div class="responsive">
                                            @if(count($mappedTrainers))
                                            <table class="table table-bordered m-0">
                                                <thead>
                                                    <tr>
                                                        <th>Trainer ID</th>
                                                        <th>Name</th>
                                                        <th>Email</th>
                                                        <th>Phone</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                        <th>Remove</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($mappedTrainers as $trainer)
                                                    <tr data-userid="{{ $trainer->id }}">
                                                        <td>{{ $trainer->self_registrationId ?? 'N.A.' }}</td>
                                                        <td>{{ $trainer->name }}</td>
                                                        <td>{{ $trainer->email }}</td>
                                                        <td>{{ $trainer->phone }}</td>
                                                        <td><span class="badge badge-success">{{ $trainer->status }}</span></td>
                                                        <td>
                                                        @if($trainer->status == 'Mapped')
                                                            <a href="#" data-trainer-id="{{ $trainer->id }}" class="unmap-trainer-btn" id="unmap-trainer">Un-Map</a>
                                                        @else
                                                            <a href="#" data-trainer-id="{{ $trainer->id }}" class="map-trainer-btn" id="map-trainer">Map</a>
                                                        @endif
                                                        </td>

                                                        <td  style="text-align: center;">
                                                            <a href="#" data-trainer-id="{{ $trainer->id }}" class="remove-trainer-btn" id="remove-trainer">
                                                                <i class="fa fa-trash-o" style="font-size:24px;color:red"></i>
                                                            </a>
                                                        </td>

                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            @else
                                            <p>No trainers are currently mapped to your school.</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div id="activity_from_div2 mt-2" class="sports-filtr overlay">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="w-100 studs-list">
                                                    <div id="trainer_table_container" style="display: none;" class="my-4">
                                                        <div class="reresponsive">
                                                            <table class="table table-bordered mt-4">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Trainer ID</th>
                                                                        <th>Name</th>
                                                                        <th>Email</th>
                                                                        <th>Phone</th>
                                                                        <th>Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="trainer_info_table">
                                                                    <!-- Populated dynamically -->
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="addTrainerForm" class="col-12" style="display: none;">
                                    <div style="background:#fff; padding:15px; border-radius:12px; margin-top:15px;">
                                        @include('auth.self_registration.trainer')
                                    </div>
                                </div>
                            </div>
                    </div>
            </div>
         
      </div>
   </div>
</div>

<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>

<script>

$(document).ready(function () {
    function toggleSections() {
        if ($('#option2').is(':checked')) {

            $('#addTrainerForm').show();
            $('#mappedTrainersContainer').hide();
            $('#enableExportBtn')[0].style.setProperty('display', 'none', 'important');
            if ("{{ $errors->any() }}" === "1") {
                $('#addTrainerForm').show();
            }
        } else {
           // $('#trainer_search_box').hide();
            $('#addTrainerForm').hide();
            $('#mappedTrainersContainer').show();
            $('#enableExportBtn').css('display', 'inline-block');
        }
    }

    $('input[name="options"]').on('change', toggleSections);
    $('#enableExportBtn').hide();
    toggleSections(); // run on page load
});

$('#enableExportBtn').on('click', function() {
        // Collect all user IDs from the table
    var schoolUserIds = [];
    $('#mappedTrainersContainer tbody tr').each(function() {
        var userid = $(this).data('userid');
        if(userid) schoolUserIds.push(userid);
    });

    console.log(schoolUserIds);
    if(schoolUserIds.length === 0) {
        alert('No users to export!');
        return;
    }

    $.ajax({
        url: "{{ route('export.school.users') }}",
        type: "POST",
        data: { school_user_ids: schoolUserIds, export_type: 'excel', role: 'trainer' },
        headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
        xhrFields: { responseType: 'blob' }, // important for downloading file
        success: function(blob) {
            var link = document.createElement('a');
            link.href = window.URL.createObjectURL(blob);
            link.download = "trainers-credential.xlsx";
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
            Swal.fire({
                title: 'Success',
                icon: 'success',
                text: 'Trainers credentials downloaded.',
                allowOutsideClick: false
            });
        },
        error: function(err) {
            console.error(err);
            alert('Error generating Excel');
        }
    });
});


$(document).ready(function () {

    // Autocomplete functionality
    $('#trainer_search').on('keyup', function() {
        if ($(this).val().trim() === '') {
            location.reload();
        }
    });
    $("#trainer_search").autocomplete({
        source: "{{ route('autocomplete.trainer') }}",
        minLength: 2,
        select: function (event, ui) {
            $('#trainer_search').val(ui.item.label);

            // Populate the table
            $('#trainer_info_table').html(`
                <tr>
                    <td>${ui.item.id}</td>
                    <td>${ui.item.name}</td>
                    <td>${ui.item.email}</td>
                    <td>${ui.item.phone}</td>
                    ${ui.item.activated ? `<td>                       
                        <button class="btn btn-primary btn-sm unmap-trainer-btn" data-trainer-id="${ui.item.userid}">Un-Map</button>
                        </td>` : `<td>
                            <button class="btn btn-primary btn-sm map-trainer-btn" data-trainer-id="${ui.item.userid}">Map</button>
                        </td>`}
                </tr>
            `);

            // Show the table
            $('#trainer_table_container').show();
            $('#mapped_trainer_table_container').css('display','none');
            return false;
        }
    });

    // Handle manual form submission (Search button)
    $('.form-inline').submit(function (e) {
        e.preventDefault();

        let query = $('#trainer_search').val();

        $.ajax({
            url: "{{ route('autocomplete.trainer') }}",
            data: { term: query },
            success: function (data) {
                let rows = '';
                if (data.length > 0) {
                    data.forEach(function (trainer) {
                        rows += `
                            <tr>
                                <td>${trainer.id}</td>
                                <td>${trainer.name}</td>
                                <td>${trainer.email}</td>
                                <td>${trainer.phone}</td>
                                ${trainer.activated ? `
                                    <td><button class="btn btn-primary btn-sm unmap-trainer-btn" data-trainer-id="${trainer.userid}">Un-Map</button></td>
                                ` : `
                                    <td><button class="btn btn-primary btn-sm map-trainer-btn" data-trainer-id="${trainer.userid}">Map</button></td>
                                `}
                            </tr>
                        `;
                    });
                } else {
                    rows = '<tr><td colspan="5">No trainer found</td></tr>';
                }

                $('#trainer_info_table').html(rows);
                $('#trainer_table_container').show();
                $('#mapped_trainer_table_container').css('display','none');
            }
        });
    });
});




$(document).on('click', '.map-trainer-btn', function () {
    const trainerId = $(this).data('trainer-id');


    handleResponseMessages( 'warning',  'Are you sure?', 'Do you want to map this trainer with the school?', {
        showCancel: true,
        confirmText: 'Yes, Map it!',
        cancelText: 'Cancel',
        onConfirm: () => { 
            $.ajax({
                url: "{{ route('trainer.map') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    trainer_id: trainerId
                },
                success: function (response) {
                    handleResponseMessages( 'success',  '', response.message, {
                        confirmText: 'OK',
                        onConfirm: () => { location.reload(); }
                    });
                },

                error: function (xhr) {
                    handleResponseMessages( 'error',  '', 'An error occurred while mapping the trainer.');
                }
            });
        },
        onCancel: () => { console.log('Cancelled!'); }
    });
    
});


$(document).on('click', '.remove-trainer-btn', function () {

    let action = 'Remove';
    const trainerId = $(this).data('trainer-id');
    let route = "{{ route('remove.trainer') }}";
    let message = `Do you want to remove this trainer from the school?`;
    TakeAction(action, message, trainerId, route);

});

function TakeAction(action, message, trainerId, route ){

    handleResponseMessages( 'warning',  'Are you sure?', `${message}`, {
        showCancel: true,
        confirmText: `Yes, ${action} it!`,
        cancelText: 'Cancel',
        onConfirm: () => { 
            $.ajax({
                url: route,
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    trainer_id: trainerId
                },
                success: function (response) {
                    handleResponseMessages( 'success',  '', response.message, {
                        confirmText: 'OK',
                        onConfirm: () => { location.reload(); }
                    });
                },

                error: function (xhr) {
                    handleResponseMessages( 'error',  '', 'An error occurred while mapping the trainer.');
                }
            });
        },
        onCancel: () => { console.log('Cancelled!'); }
    });
}



$(document).on('click', '.unmap-trainer-btn', function () {
    const trainerId = $(this).data('trainer-id');


     handleResponseMessages( 'warning',  'Are you sure?', 'Do you want to unmap this trainer from the school?', {
        showCancel: true,
        confirmText: 'Yes, Un-Map it!',
        cancelText: 'Cancel',
        onConfirm: () => { 
            $.ajax({
                    url: "{{ route('trainer.unmap') }}",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        trainer_id: trainerId
                    },
                    success: function (response) {
                            handleResponseMessages( 'success',  '', response.message, {
                            confirmText: 'OK',
                            onConfirm: function () {
                                location.reload();
                            }
                        });
                    },
                    error: function (xhr) {
                        alert("An error occurred while de activating the trainer.");
                    }
                });
        },
        onCancel: () => { console.log('Cancelled!'); }
    });

});
</script>

@endsection