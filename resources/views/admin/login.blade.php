<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin Login</title>


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <link href="{{ asset('resources/css/style.css') }}" rel="stylesheet">

    <link rel="icon" href="{{ asset('resources/images/goforfit-logo.png') }}" sizes="32x32" />
    <link rel="icon" href="{{ asset('resources/images/goforfit-logo.png') }}" sizes="192x192" />
    <link rel="apple-touch-icon-precomposed" href="{{ asset('resources/images/fit-fav.ico') }}" />
    <meta name="msapplication-TileImage" content="{{ asset('resources/images/fit-fav.ico') }}" />

</head>

<style>
:root {
    --input-padding-x: .5rem;
    --input-padding-y: .25rem;
}

body {
    background: #edf2f6;
    /*background: linear-gradient(to right, #0062E6, #33AEFF);*/
    font-size: 12px;
}

.credential-pg footer {
    position: fixed;
}

.cred-bx {
    position: absolute;
    top: 5%;
    left: 0;
    right: 0;
    bottom: 0;
    margin: auto;
    width: 300px;
    /*height:530px;*/
}

.cred-bx figure::before {
    background: transparent;
}

.cred-bx figure img {
    height: 40px;
}

.card-signin {
    border: 0;
    border-radius: 0.5rem;
    box-shadow: 0 0.5rem 1rem 0 rgb(0 0 0 / 5%);
    /*height:450px;*/
}

.card-signin .card-title {
    margin-bottom: 1rem;
    font-weight: 500;
    font-size: 1.25rem;
}

.card-signin .card-body {
    padding: 1.5rem;
}

.form-signin {
    width: 100%;
}

.form-signin .btn {
    font-size: 80%;
    border-radius: 5rem;
    font-weight: bold;
    transition: all 0.2s;
}

.form-label-group {
    position: relative;
    margin-bottom: 1rem;
}

.form-label-group input {
    height: auto;
    border-radius: 0.35rem;
    font-size: 0.75rem;
}

.form-label-group>input {
    padding: var(--input-padding-y) var(--input-padding-x);
}

.form-label-group>label {
    padding: var(--input-padding-y)
        /*var(--input-padding-x)*/
    ;
}

.form-label-group>label {
    /*position: absolute;
  top: 0;
  left: 0;*/
    display: block;
    width: 100%;
    margin-bottom: 0;
    /* Override default `<label>` margin */
    line-height: 1.5;
    color: #495057;
    border: 1px solid transparent;
    border-radius: .25rem;
    transition: all .1s ease-in-out;
    padding: 0;
    margin-bottom: 3px;
}

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

.form-label-group input:not(:placeholder-shown) {
    /*padding-top: calc(var(--input-padding-y) + var(--input-padding-y) * (2 / 3));
  padding-bottom: calc(var(--input-padding-y) / 3);*/
}

.form-label-group input:not(:placeholder-shown)~label {
    /*padding-top: calc(var(--input-padding-y) / 3);*/
    padding-bottom: calc(var(--input-padding-y) / 3);
    font-size: 12px;
    color: #777;
}

.captcha-row .captcha-txtbx input {
    font-size: 0.75rem;
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

#pagecaptcha-cont,
.captchaimg,
.captcha-reset-btn {
    display: inline-block;
}

.captcha-txtbx {
    margin: 15px 0;
}

.custom-control {
    padding-left: 1.3rem;
}

/* Fallback for Edge
-------------------------------------------------- */

@supports (-ms-ime-align: auto) {
    .form-label-group>label {
        display: none;
    }

    .form-label-group input::-ms-input-placeholder {
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

<body>

    <div class="container-fluid">

        <!-- Content section -->
        <section>
            <div class="container">
                <div class="cred-bx">
                    <figure class="text-center mb-4 pb-2"><img alt="GoforFit"
                            src="{{ asset('resources/images/gofor-fit-logo.svg') }}"></figure>
                    <div class="card card-signin">
                        <div class="card-body">
                            <h5 class="card-title text-center">{{ __('Login') }}</h5>
                            <form action="{{ route('admin.postlogin') }}" method="POST" id="frontadmin"
                                novalidate="novalidate">
                                @csrf


                                @if (session('status'))
                                <div class="alert alert-danger">
                                    {{ session('msg') }}
                                </div>
                                @endif

                                <div class="form-label-group">
                                    <label for="inputEmail">Email address</label>
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus>

                                </div>

                                <div class="form-label-group">
                                    <label for="inputPassword">Password</label>
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-password">

                                </div>

                                <div class="custom-control custom-checkbox mb-3">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>
                                    <label for="customCheck1">{{ __('Remember me') }}</label>
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
                                            <button type="button" class="btn btn-info" class="reload" id="reload"> ↻
                                            </button>
                                        </div>

                                        <div class="captcha-txtbx">
                                            <input type="text" id="captcha" name="captcha"
                                                class="form-control @error('captcha') is-invalid @enderror" required
                                                placeholder="Captcha">
                                            @error('captcha')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div style="clear:both;"></div>
                                    </div>
                                </div>
                                <button class="btn btn-lg btn-primary btn-block text-uppercase"
                                    type="submit">{{ __('Login') }}</button>

                            </form>

                        </div>
                    </div>
                </div>

            </div>

        </section>
        <!-- Content section end-->

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

    </div>
</body>

</html>