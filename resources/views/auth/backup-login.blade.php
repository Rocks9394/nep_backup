@extends('layouts.filldart-login-app-header')
@section('title', 'Goforfit | ' . $title)

@section('content')

<link href="{{ asset('public/assets/css/login.css') }}?v={{ time() }}" rel="stylesheet">
<link href="{{ asset('public/assets/css/nvsdashboard.min.css') }}?v={{ time() }}" rel="stylesheet" media="screen">        
<link href="{{ asset('public/assets/css/nvsstyle.css') }}?v={{ time() }}" rel="stylesheet" media="all">
<link href="{{ asset('public/assets/css/nvscustom-style.css') }}?v={{ time() }}" rel="stylesheet">
<link href="{{ asset('public/assets/css/nvsresponsive.css') }}?v={{ time() }}" rel="stylesheet" media="screen">

@push('styles')
<style>
   .captcha>input[type=checkbox] {
    top: 27px;
    left: 49px;
}
</style>
@endpush

<main class="__main">
   <div class="login_form pt-4">
         <a href="{{ url('/') }}" class="d-block text-center">
         <img src="{{ asset('resources/images/gofor-fit-logo.png') }}" class="d-inline-block align-top mb-3" alt="goforfit" title="goforfit" height="50">
      </a>

      @php
         $user_type                = Cookie::get('user_type');
         $student_id_cookie        = Cookie::get('student_id_cookie') ?? old('student_id');
         $student_password_cookie  = Cookie::get('student_password_cookie');  
         $decodedPwd = base64_decode(base64_decode($student_password_cookie));
         $plainPassword = substr($decodedPwd, 1, -1);
         $student_remember_token   = Cookie::get('student_remember_token') ?? old('remember');  
      @endphp
	  
	   <!--<strong style="color:orange">The system will be unavailable on 12th August 2025 from 2:00 PM to 5:00 PM due to scheduled maintenance.</strong>-->

      <form method="POST" action="{{ route('auth.login.new') }}">
         @csrf

         <div class="input-group">
            <div class="input-group-prepend">
               <label class="input-group-text">Login As</label>
               <input type="hidden" name="login_by" class="option_type" value="">
            </div>
            <select class="custom-select form-control" id="login_type">
               <option selected>Choose User Type</option>
               <option value="School">School</option>
               <option value="Trainer">Trainer</option>
               <option value="Parent">Parent</option>
            </select>
         </div>

         <!-- Parent Login Fields -->
         <div id="user_id_box" style="display: none;">
            <div class="input_box mt-3">
               <label for="userid_input">User Id</label>
               <input type="text" id="userid_input" name="student_id" placeholder="Enter User Id" class="form-control" value="{{ $student_id_cookie }}" />
               @error('student_id') <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span> @enderror
            </div>

            <div class="input_box">
               <label for="dob_input">Password</label>
               <input type="password" id="dob_input" name="dob" class="form-control @error('dob') is-invalid @enderror" value="{{ $plainPassword }}" placeholder="Enter your password" />
               @error('dob') <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span> @enderror
            </div>
         </div>

         <!-- Email Login Fields (Other Users) -->
         <div id="email_box">
            <div class="input_box mt-3">
               <label for="email_input">Email</label>
               <input type="email" id="email_input" name="email" placeholder="Enter Email" class="form-control" value="{{ old('email') }}" />
               @error('email') <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span> @enderror
            </div>

            <div class="input_box">
               <label for="password_input">Password</label>
               <input type="password" id="password_input" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter your password" value="{{ old('password') }}" />
               @error('password') <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span> @enderror
            </div>
         </div>

         <div class="mb-4 form-check">
            <input type="checkbox" class="form-check-input" id="remember" name="remember" {{ $student_remember_token ? 'checked' : '' }}>
            <label class="form-check-label" for="remember">Remember Me</label>
         </div>
		 
		

         <div class="captcha-row">
            <div id="pagecaptcha-cont">
               <div class="captcha">
                  <input type="checkbox" aria-label="Checkbox captcha" name="g-recaptcha-response">
                  <img alt="captcha" src="{{ asset('public/assets/imgs/captcha-img.png') }}" class="img-fluid" usemap="#image-map">
                  <map name="image-map">
                     <area target="_blank" alt="Privacy" title="Privacy" href="https://policies.google.com/privacy?hl=en" coords="" shape="rect" class="m-p">
                     <area target="_blank" alt="Terms" title="Terms" href="https://policies.google.com/terms?hl=en" coords="" shape="rect" class="m-t">
                  </map>
               </div>
            </div>
            @if($errors->any())
               @foreach ($errors->all() as $error)
                  <p class="error_message">{{ $error }}</p>
               @endforeach
            @endif

            @if(session('status') === 'error')
                <p class="error_message">
                    {{ session('msg') }}
                </p>
            @endif
         </div> 

         <button class="btn btn-lg btn-primary btn-block mb-0" type="submit" style="font-weight: 600;">{{ __('Login') }}</button>
      </form>
   </div>
</main>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

   <script>
      $(document).ready(function () {
         function toggleLoginFields(userType) {

            $('#userid_input').val('');
            $('#birth_date').val('');
            $('#email_input').val('');
            $('#password_input').val('');


            if (userType === 'Parent') {
               $('#user_id_box').show();
               $('#userid_input').prop('required', true).prop('disabled', false);
               $('#birth_date').prop('required', true).prop('disabled', false);

               // Hide email login
               $('#email_box').hide();
               $('#email_input').prop('required', false).prop('disabled', true);
               $('#password').prop('required', false).prop('disabled', true);
            } else {
               // Show email login
               $('#email_box').show();
               $('#email_input').prop('required', true).prop('disabled', false);
               $('#password').prop('required', true).prop('disabled', false);

               // Hide parent login
               $('#user_id_box').hide();
               $('#userid_input').prop('required', false).prop('disabled', true);
               $('#birth_date').prop('required', false).prop('disabled', true);
            }

         }

         const savedOption = localStorage.getItem('selectedOption') || 'School';
         

         $('.option_type').val(savedOption);
         $('#login_type').val(savedOption);


         toggleLoginFields(savedOption);

         $('#login_type').on('change', function () {
            const selected = $(this).val();
            $('.option_type').val(selected);
            localStorage.setItem('selectedOption', selected);
            toggleLoginFields(selected);
         });
      });

   </script>