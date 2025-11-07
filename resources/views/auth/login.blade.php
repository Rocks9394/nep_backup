@extends('layouts.filldart-login-app-header')
@section('content')
<style>
:root {
    --input-padding-x: .75rem;
    --input-padding-y: .5rem;
}

/*

.form-label-group input::-webkit-input-placeholder {
    color: transparent;
}

.form-label-group input:-ms-input-placeholder {
    color: transparent;
}

.form-label-group input::-ms-input-placeholder {
    color: transparent;
}

.form-label-group input::-moz-placeholder {
    color: transparent;
}

.form-label-group input::placeholder {
    color: transparent;
}


.form-label-group input:not(:placeholder-shown)~label {
    padding-bottom: calc(var(--input-padding-y) / 3);
    font-size: 12px;
    color: #777;
}

.captcha-row .captcha-txtbx input {
    font-size: 0.75rem;
    padding: 0.75rem .5rem !important;
}

.form-check-input {
    margin-top: .20rem;
}

.btn-google {
    color: white;
    background-color: #ea4335;
}

.btn-facebook {
    color: white;
    background-color: #3b5998;
}

.btn-link {
    color: #ff8000;
}
.form-control {
    height: calc(1.5em + .75rem + 2px);
    padding: .75rem .5rem;
    font-size: 0.9rem;
    border-radius: .25rem;
}*/


@supports (-ms-ime-align: auto) 
{
    .form-label-group>label 
    {
        display: none;
    }

    .form-label-group input::-ms-input-placeholder 
    {
        color: #777;
    }
}



/* Fallback for IE
-------------------------------------------------- */

@media all and (-ms-high-contrast: none),
(-ms-high-contrast: active) {
    .form-label-group>label {
        display: none;
    }

    .form-label-group input:-ms-input-placeholder {
        color: #777;
    }
}
</style>

<section class="login-sec">
   <div class="cred-bx text-center">
      <img src="{{ asset('resources/images/gofor-fit-logo.png') }}" height="50" class="d-inline-block align-top mb-2" alt="">
      <div class="card card-signin text-left">
         <div class="card-body">
            <h5 class="card-title text-center mb-4"><strong>{{ __('Login to your account') }}</strong></h5>
            <form class="form-signin" method="POST" action="{{ route('auth.login') }}">
               @csrf
               @if (session('status'))
               <div class="alert alert-danger">
                  {{ session('msg') }}
               </div>
               @endif
               <div class="form-label-group">
                  <label for="inputEmail">Email address</label>
                  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                     name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                  @error('email')
                  <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                  </span>
                  @enderror
               </div>
               <div class="form-label-group">
                  <label for="inputPassword">Password</label>
                  <input id="password" type="password"
                     class="form-control @error('password') is-invalid @enderror" name="password"
                     required autocomplete="current-password">
                  @error('password')
                  <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                  </span>
                  @enderror
               </div>
               <div class="custom-control custom-checkbox mb-3">
                  <input class="form-check-input" type="checkbox" name="remember" id="remember"
                  {{ old('remember') ? 'checked' : '' }}>
                  <label class="" for="customCheck1">{{ __('Remember me') }}</label>
               </div>
               <div class="captcha-row">
                  <div class="um-field" id="capcha-page-cont">
                     <label for="captcha">Please enter the captcha text</label><br>
                     <div id="pagecaptcha-cont">
                        <div class="captchaimg">
                           <span>{!! captcha_img() !!}</span>
                        </div>
                     </div>
                     <div class="captcha-reset-btn">
                        <button type="button" class="btn btn-info btn-reload" class="reload" id="reload"> ↻
                        </button>
                     </div>
                     <div class="captcha-txtbx">
                        <input type="text" id="captcha" name="captcha"
                           class="form-control @error('captcha') is-invalid @enderror" required
                           placeholder="Captcha"  autocomplete="off">
                        @error('captcha')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>
                     <div style="clear:both;"></div>
                  </div>
               </div>
               <div style="clear:both;"></div>
               <button class="btn btn-lg btn-primary btn-block"
                  type="submit">{{ __('Login') }}</button>
            </form>
         </div>
      </div>
   </div>
</section>
       
<script>
jQuery('#reload').click(function() {
    jQuery.ajax({
        type: 'GET',
        url: "{{ route('reloadCaptcha')}}",
        success: function(data) {
            jQuery(".captchaimg span").html(data.captcha);
        }
    });
});
</script>
@endsection