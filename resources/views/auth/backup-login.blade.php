   @extends('layouts.filldart-login-app-header')
   @section('title', 'Goforfit | ' . $title)

   @section('content')

       <link href="{{ asset('assets/css/login.css') }}?v={{ time() }}" rel="stylesheet">
       <link href="{{ asset('assets/css/nvsdashboard.min.css') }}?v={{ time() }}" rel="stylesheet" media="screen">
       <link href="{{ asset('assets/css/nvsstyle.css') }}?v={{ time() }}" rel="stylesheet" media="all">
       <link href="{{ asset('assets/css/nvscustom-style.css') }}?v={{ time() }}" rel="stylesheet">
       <link href="{{ asset('assets/css/nvsresponsive.css') }}?v={{ time() }}" rel="stylesheet" media="screen">
       <link href="{{ asset('uploads/login.jpeg') }}">
       @push('styles')
           <style>
               /* 1. Base Page Setup */
               body {
                   background-image: url("{{ asset('uploads/login.jpeg') }}");
                   background-size: cover;
                   background-position: center;
                   background-repeat: no-repeat;
                   background-attachment: fixed;
                   height: 100vh;
                   margin: 0;
                   
               }

               body .__main {
                   width: 100% !important;
                   min-height: 100vh !important;

                   z-index: 1;
               }

               body .__main .login_form {
                   position: absolute !important;
                   top: 5% !important;
                   right: 10% !important;
                   width: 100% !important;
                   max-width: 460px !important;
                   min-width: 400px !important;
                   padding: 40px 35px !important;
                   border-radius: 20px !important;

                   /* Elegant Glassmorphism */
                   background: rgba(255, 255, 255, 0.15) !important;
                   backdrop-filter: blur(16px) !important;
                   -webkit-backdrop-filter: blur(16px) !important;
                   border: 1px solid rgba(255, 255, 255, 0.3) !important;
                   box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3) !important;
               }

               /* 4. Dropdown Text and Background Fix */
               .input-group-text {
                   /* Label 'Login As' ko glassy effect dega */
                   background-color: rgba(255, 255, 255, 0.15) !important;
                   color: #ffffff !important;
                   border: 1px solid rgba(255, 255, 255, 0.3) !important;
                   font-weight: 600 !important;
               }

               #login_type {
                   /* Main Dropdown box ko halka dark premium glass look dega */
                   background-color: rgba(0, 0, 0, 0.2) !important;
                   color: #ffffff !important;
                   border: 1px solid rgba(255, 255, 255, 0.3) !important;
                   font-weight: 500 !important;
               }

               /* Jab Dropdown open hoga, tab uske options padhne ke liye solid dark theme */
               #login_type option {
                   background-color: #2a3038 !important;
                   /* Sleek dark gray color */
                   color: #ffffff !important;
                   padding: 10px !important;
               }

               /* 5. Text visibility */
               .login_form label,
               .login_form h2,
               .form-check-label {
                   color: #ffffff !important;
                   text-shadow: 0 1px 3px rgba(0, 0, 0, 0.6) !important;
               }

               .captcha>input[type=checkbox] {
                   top: 27px;
                   left: 49px;
               }

               /* 6. Mobile View Setup */
               @media (max-width: 991px) {
                   body .__main {
                       position: relative !important;
                       display: flex !important;
                       align-items: center !important;
                       justify-content: center !important;
                       height: auto !important;
                       min-height: 100vh !important;
                   }

                   body .__main .login_form {
                       position: relative !important;
                       top: unset !important;
                       right: unset !important;
                       left: unset !important;
                       transform: unset !important;
                       margin: 40px auto !important;
                       max-width: 90% !important;
                       min-width: unset !important;
                   }
               }
           </style>
       @endpush

       <main class="__main">
           <div class="login_form pt-4">
               <a href="{{ url('/') }}" class="d-block text-center">
                   <img src="{{ asset('resources/images/gofor-fit-logo.png') }}" class="d-inline-block align-top mb-3"
                       alt="goforfit" title="goforfit" height="50">
               </a>

               @php
                   $user_type = Cookie::get('user_type');
                   $student_id_cookie = Cookie::get('student_id_cookie') ?? old('student_id');
                   $student_password_cookie = Cookie::get('student_password_cookie');
                   $decodedPwd = base64_decode(base64_decode($student_password_cookie));
                   $plainPassword = substr($decodedPwd, 1, -1);
                   $student_remember_token = Cookie::get('student_remember_token') ?? old('remember');
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
                           <input type="text" id="userid_input" name="student_id" placeholder="Enter User Id"
                               class="form-control" value="{{ $student_id_cookie }}" />
                           @error('student_id')
                               <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                           @enderror
                       </div>

                       <div class="input_box">
                           <label for="dob_input">Password</label>
                           <input type="password" id="dob_input" name="dob"
                               class="form-control @error('dob') is-invalid @enderror" value="{{ $plainPassword }}"
                               placeholder="Enter your password" />
                           @error('dob')
                               <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                           @enderror
                       </div>
                   </div>

                   <!-- Email Login Fields (Other Users) -->
                   <div id="email_box">
                       <div class="input_box mt-3">
                           <label for="email_input">Email</label>
                           <input type="email" id="email_input" name="email" placeholder="Enter Email"
                               class="form-control" value="{{ old('email') }}" />
                           @error('email')
                               <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                           @enderror
                       </div>

                       <div class="input_box">
                           <label for="password_input">Password</label>
                           <input type="password" id="password_input" name="password"
                               class="form-control @error('password') is-invalid @enderror"
                               placeholder="Enter your password" value="{{ old('password') }}" />
                           @error('password')
                               <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                           @enderror
                       </div>
                   </div>

                   <div class="mb-4 form-check">
                       <input type="checkbox" class="form-check-input" id="remember" name="remember"
                           {{ $student_remember_token ? 'checked' : '' }}>
                       <label class="form-check-label" for="remember">Remember Me</label>
                   </div>


                   <div class="captcha-row">
                       <div id="pagecaptcha-cont">
                           <div class="captcha">
                               <input type="checkbox" aria-label="Checkbox captcha" name="g-recaptcha-response">
                               <img alt="captcha" src="{{ asset('assets/imgs/captcha-img.png') }}" class="img-fluid"
                                   usemap="#image-map">
                               <map name="image-map">
                                   <area target="_blank" alt="Privacy" title="Privacy"
                                       href="https://policies.google.com/privacy?hl=en" coords="" shape="rect"
                                       class="m-p">
                                   <area target="_blank" alt="Terms" title="Terms"
                                       href="https://policies.google.com/terms?hl=en" coords="" shape="rect"
                                       class="m-t">
                               </map>
                           </div>
                       </div>
                       @if ($errors->any())
                           @foreach ($errors->all() as $error)
                               <p class="error_message">{{ $error }}</p>
                           @endforeach
                       @endif

                       @if (session('status') === 'error')
                           <p class="error_message">
                               {{ session('msg') }}
                           </p>
                       @endif
                   </div>

                   <button class="btn btn-lg btn-primary btn-block mb-0" type="submit"
                       style="font-weight: 600;">{{ __('Login') }}</button>
               </form>
           </div>
       </main>
       <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

       @push('scripts')
           <script>
               $(document).ready(function() {
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

                   $('#login_type').on('change', function() {
                       const selected = $(this).val();
                       $('.option_type').val(selected);
                       localStorage.setItem('selectedOption', selected);
                       toggleLoginFields(selected);
                   });
               });
           </script>
       @endpush
       <script>
           $(document).ready(function() {
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

               $('#login_type').on('change', function() {
                   const selected = $(this).val();
                   $('.option_type').val(selected);
                   localStorage.setItem('selectedOption', selected);
                   toggleLoginFields(selected);
               });
           });
       </script>
