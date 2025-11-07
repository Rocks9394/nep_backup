@extends('layouts.filldart-login-app-header')


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">


    <!-- <style>
        *,
        body {
            margin: 0;
            padding: 0;
        }

        body,
        head {
            height: 100vh;
            font-family: "Roboto", sans-serif;
            font-size: 0.9rem;
        }

        .login-page {
            height: 100vh;
            background-color: #EBF0F5;
            height: 100vh;
        }

        .login-logo {
            position: fixed;
            top: 30px;
            left: 30px;
        }

        .login-frm {
            background-color: #fff;
        }

        .login-frm h1 {
            font-size: 1.25rem;
        }

        .login-page .carousel-inner {
            position: relative;
            overflow: hidden;
        }

        .carousel {
            padding: 0 15%;
        }

        .carousel-item {
            margin-top: 15%;
            padding-top: 5%;
        }

        .carousel-caption {
            color: #333;
            position: static;
            right: auto;
            bottom: 0;
            left: auto;
            z-index: 10;
            max-width: 600px;
            margin: auto;
            margin-top: 30px;
        }

        .carousel-caption h5 {
            color: #000;
            font-size: 1.5rem;
        }
        .carousel-caption p {
            line-height: 1.5rem;
            margin-top: 15px;
        }

        .carousel-indicators li {
            background-color: rgb(0 0 0/20%);
        }

        .carousel-indicators .active {
            background-color: #292775;
        }
        .lock {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 30px;
        }
        .lock>span {
            display: inline-block;
            padding: 15px;
            background-color: #f2f2f7;
            border-radius: 100px;
        }
        .lock img {
            height: 32px;
        }

        .frm {
            display: flex;
            justify-content: center;
            margin-top: 60px;
        }

        .account-type {
            padding: 5px;
            background-color: rgb(41 39 117 / 6%);
            border-radius: 6px;
            border: 1px solid #ebf0f5;
        }

        .account-type .btn {
            font-size: inherit;
        }

        .account-type .account {
            background-color: transparent;
            color: #333;
            border: none;
            border-radius: 6px !important;
            padding: 8px;
        }

        .account-type .account.active {
            background-color: #292775 !important;
            border-color: #292775 !important;
        }

        input[type=text],
        input[type=email],
        input[type=password],
        .login-btn {
            border-radius: 6px !important;
            min-height: 48px;
        }

        input[type=text],
        input[type=email],
        input[type=password] {
            background-color: #fff;
        }

        input:-internal-autofill-selected {
            background-color: #fff !important;
        }

        .form-check {
            padding-left: 2rem;
        }

        input[type=checkbox] {
            min-height: auto;
            width: 18px;
            height: 18px;
            margin-left: -2rem;
            margin-top: .05rem;
        }

        .login-btn {
            background-color: #ff8000;
            border-color: #ff8000;
            font-weight: 500;
            transition: 0.3s;
        }

        .login-btn:hover,
        .btn-primary:not(:disabled):not(.disabled).active,
        .btn-primary:not(:disabled):not(.disabled):active,
        .show>.btn-primary.dropdown-toggle {
            background-color: #ff6a00;
            border-color: #ff6a00;
        }

        .btn-primary.focus,
        .btn-primary:focus {
            box-shadow: 0 0 0 .2rem rgb(255 128 0 / 50%) !important;
        }
    </style> -->


</head>

<body class="login-page">

    <div class="container-fluid h-100">
        <div class="row h-100">
            <div class="col-12 col-lg-7 col-xl-8 d-none d-lg-block">
                <div id="carouselExampleIndicators" class="carousel slide h-100" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner d-flex align-items-center">
                        <div class="carousel-item active">
                            <div class="text-center">
                                <img class="img-fluid" src="{{ asset('public/login/trainer.svg')}}" alt="First slide">
                                <div class="carousel-caption">
                                    <h5>For Trainer</h5>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                </div>
                            </div>
                        </div>

                        <div class="carousel-item">
                            <div class="text-center">
                                <img class="img-fluid" src="{{ asset('public/login/trainer.svg')}}" alt="Second slide">
                                <div class="carousel-caption">
                                    <h5>For School</h5>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="text-center">
                                <img class="img-fluid" src="{{ asset('public/login/parent.svg')}}" alt="Third slide">
                                <div class="carousel-caption">
                                    <h5>For Parent</h5>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a> -->
                </div>
            </div>
            <div class="col-12 col-lg-5 col-xl-4" style="background-color: #fff;">
                <div class="login-frm">
                <div class="frm">
                    <span class="login-logo"><img src="https://nep.goforfit.in/resources/images/gofor-fit-logo.png" height="40" class="d-inline-block align-top mb-2" alt=""></span>

                    <div class="container-fluid p-0">
                        <div class="row">
                            <div class="col">
                                <div class="lock"><span><img alt="lock" src="{{ asset('public/login/lock.svg')}}" class="img-fluid"></span></div>
                                <h1 class="text-center">Login to your account</h1>
                                <form>
                                    <div class="form-group account-type">
                                        <div class="btn-group btn-group-toggle d-table w-100" data-toggle="buttons">
                                            <label class="btn btn-secondary d-table-cell account active">
                                                <input type="radio" name="options" id="option1" autocomplete="off" checked> Trainer
                                            </label>
                                            <label class="btn btn-secondary account d-table-cell">
                                                <input type="radio" name="options" id="option2" autocomplete="off"> School
                                            </label>
                                            <label class="btn btn-secondary account d-table-cell">
                                                <input type="radio" name="options" id="option3" autocomplete="off"> Parent
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email address</label>
                                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Password</label>
                                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                                    </div>
                                    <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1">Remember Me</label>
                                    </div>
                                    <button type="submit" class="btn btn-primary mt-4 w-100 login-btn">Login</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>

    </div>

   <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script> 

</body>

</html>
