@extends('layouts.filldart-app')
@section('title', 'CISCE | ' . $title)
@section('content')

<div class="all-chaptr-cards">
    <div class="container">
        <div class="t-mrg2 mb-5 pb-5">            
            <div class="row">
                <x-back-button :title="$title" />
            </div>

            @php  $type = "cwsnlist"; @endphp

            <x-get-student-list :classes="$classes" :type="$type" :title="$title" />

            <div class="col-12">
                @yield('cwsnform')
            </div>

        </div>
    </div>
</div>


@stack('cwsn-module-script')

<script>





$(document).ready(function() {
    $('#fms_types_submit_id').submit(function(e) {
        e.preventDefault(); // prevent default form submission
    
        const studentId = document.getElementById('selected_student_id').value;
        if(!studentId){
            handleResponseMessages( 'warning',  'Select Student', 'Please select the student');
            return;
        }

        const checkedCount = $('input[name="description[]"]:checked').length;
        if (checkedCount === 0) {
            handleResponseMessages( 'warning',  'No Observation Selected', 'Please select at least one observation before submitting');
            return;
        }
        submitLoader();
        $.ajax({
            url: '{{ route("fms.types.submit") }}', 
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {	
                Swal.close();	
                $('#fms_types_submit_id')[0].reset();
                		
                if (response.status === 'success') {
                    Swal.fire({
                        title: "Success!",
                        text: response.message,
                        icon: "success"
                    }).then(() => location.reload());
                }
					
            },
            error: function (xhr) {
                Swal.fire({
                    title: "Error!",
                    text: xhr.responseJSON?.message ?? 'Unexpected error occurred',
                    icon: "error"
                });
            }
        });
    });
});
</script>

@endsection