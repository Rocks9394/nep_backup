@extends('layouts.filldart-app')
@section('title', 'CISCE | ' . $title)
@section('content')

@stack('cwsn-style')

<audio id="whistleSound" src="{{ asset('assets/audio/15-meter-pacer.mp3') }}"></audio>

<div class="all-chaptr-cards">
    <div class="container">
        <div class="t-mrg2 mb-5 pb-5">            
            <div class="row"> <x-back-button :title="$title" /> </div>

            @php  $type = "cwsnlist"; @endphp
            
            <x-get-student-list 
                :classes="$classes" 
                :type="$type" 
                :title="$title" 
                :cwsn-type="$pwd_category_id"
            />
            
            <div class="col-12"> @yield('cwsnform') </div>
        </div>
    </div>
</div>


@stack('cwsn-module-script')

<script>
    function SubmitForm(formid, formData, route) {

        submitLoader();

        $.ajax({
            url: route,
            method: 'POST',
            data: formData, 
            success: function(response) {   
                Swal.close();   
                $(`#${formid}`)[0].reset();

                if (response.status === 'success' || response.success == true) {
                    handleResponseMessages( 'success',  '', response.message, {
                        confirmText: 'OK',
                        onConfirm: function () {
                            location.reload();
                        }
                    });
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
    }
</script>

@endsection