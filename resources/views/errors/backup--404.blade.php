<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">-->
    <link href="https://nep.goforfit.in/assets/css/custombootstrap.css" rel="stylesheet">
    
    <style>
      body{
                background: #fff;
                font-family: 'Open Sans', sans-serif;
                max-height:700px;
                overflow: hidden;
            }
            
            .c{
                text-align: center;
                display: block;
                position: relative;
                width:40%;
                margin:12% auto;
                background: rgba(255,255,255,0.8);
                padding: 5% 3% 4% 3%;
                box-shadow: 2px 2px 20px  rgba(0,0,0,0.15);
            }
            /*.f365_logo {
                position: absolute; top: 25px; left: 0; right: 0; text-align: center;

            }*/
            ._404{
                font-size: 2.5rem;
                position: relative;
                display: inline-block;
                z-index: 2;
                height: auto;
                letter-spacing: 0;
                font-weight: 600;
            }
            ._1 {
                text-align:center;
                display:block;
                position:relative;
                font-size: 1.55em;
                line-height: 32px;
            }
            ._2 {
                text-align:center;
                display:block;
                position: relative;
                font-size: 20px;
            }
            .text {
                font-size: 70px;
                text-align: center;
                position: relative;
                display: inline-block;
                margin: 19px 0px 0px 0px;
                z-index: 3;
                width: 100%;
                line-height: 1.2em;
                display: inline-block;
            }
           

            .btn {
                background-color: #067cba !important;
                position: relative;
                display: inline-block;
                min-width: 150px;
                padding: 15px;
                z-index: 5;
                font-size: 20px;
                margin:0 auto;
                color:#fff;
                text-decoration: none;
                border-radius: 0px;
                border: 0px;
                font-weight: 600;
                background-image:linear-gradient(to bottom,#067cba,#067cba)!important;
                text-shadow: none;
            }

            .btn:hover {
                background-image:linear-gradient(to bottom,#067cba,#067cba)!important;
                color:#fff !important;
            }
            .right {
                float:right;
                width:60%;
            }
            
            hr {
                padding: 0;
                border: none;
                border-top: 3px solid #444;
                color: #067cba;
                text-align: center;
                margin: 0px auto;
                width: 20%;
                height:10px;
                z-index: -10;
                margin-top:20px; 
            }
            
            hr:after {
                content: "\2022";
                display: inline-block;
                position: relative;
                top: -0.75em;
                font-size: 2em;
                padding: 0 0.2em;
                background: #fff;
            }
            
            .cloud {
                width: 350px; height: 120px;

                background: #067cba;
                background: linear-gradient(top, #067cba 100%);
                background: -webkit-linear-gradient(top, #067cba 100%);
                background: -moz-linear-gradient(top, #067cba 100%);
                background: -ms-linear-gradient(top, #067cba 100%);
                background: -o-linear-gradient(top, #067cba 100%);

                border-radius: 100px;
                -webkit-border-radius: 100px;
                -moz-border-radius: 100px;

                position: absolute;
                margin: 120px auto 20px;
                z-index:-1;
                transition: ease 1s;
            }

            .cloud:after, .cloud:before {
                content: '';
                position: absolute;
                background: #067cba;
                z-index: -1
            }

            .cloud:after {
                width: 100px; height: 100px;
                top: -50px; left: 50px;

                border-radius: 100px;
                -webkit-border-radius: 100px;
                -moz-border-radius: 100px;
            }

            .cloud:before {
                width: 180px; height: 180px;
                top: -90px; right: 50px;

                border-radius: 200px;
                -webkit-border-radius: 200px;
                -moz-border-radius: 200px;
            }
            
            .x1 {
                top:-50px;
                left:100px;
                -webkit-transform: scale(0.3);
                -moz-transform: scale(0.3);
                transform: scale(0.3);
                opacity: 0.9;
                -webkit-animation: moveclouds 15s linear infinite;
                -moz-animation: moveclouds 15s linear infinite;
                -o-animation: moveclouds 15s linear infinite;
            }
            
            .x1_5{
                top:-80px;
                left:250px;
                -webkit-transform: scale(0.3);
                -moz-transform: scale(0.3);
                transform: scale(0.3);
                -webkit-animation: moveclouds 17s linear infinite;
                -moz-animation: moveclouds 17s linear infinite;
                -o-animation: moveclouds 17s linear infinite; 
                z-index: 2;
                opacity: 0.8; 
            }

            .x2 {
                left: 250px;
                top:30px;
                -webkit-transform: scale(0.6);
                -moz-transform: scale(0.6);
                transform: scale(0.6);
                opacity: 0.6; 
                -webkit-animation: moveclouds 25s linear infinite;
                -moz-animation: moveclouds 25s linear infinite;
                -o-animation: moveclouds 25s linear infinite;
            }

            .x3 {
                left: 250px; 
                bottom: -70px;
                -webkit-transform: scale(0.6);
                -moz-transform: scale(0.6);
                transform: scale(0.6);
                opacity: 0.8;
                -webkit-animation: moveclouds 25s linear infinite;
                -moz-animation: moveclouds 25s linear infinite;
                -o-animation: moveclouds 25s linear infinite;
            }

            .x4 {
                left: 470px; botttom: 20px;
                -webkit-transform: scale(0.75);
                -moz-transform: scale(0.75);
                transform: scale(0.75);
                opacity: 0.15;
                -webkit-animation: moveclouds 18s linear infinite;
                -moz-animation: moveclouds 18s linear infinite;
                -o-animation: moveclouds 18s linear infinite;
            }

            .x5 {
                left: 200px; 
                top: 300px;
                -webkit-transform: scale(0.5);
                -moz-transform: scale(0.5);
                transform: scale(0.5);
                opacity: 0.5; 
                -webkit-animation: moveclouds 20s linear infinite;
                -moz-animation: moveclouds 20s linear infinite;
                -o-animation: moveclouds 20s linear infinite;
            }

            @-webkit-keyframes moveclouds {
                0% {margin-left: 1000px;}
                100% {margin-left: -1000px;}
            }
            @-moz-keyframes moveclouds {
                0% {margin-left: 1000px;}
                100% {margin-left: -1000px;}
            }
            @-o-keyframes moveclouds {
                0% {margin-left: 1000px;}
                100% {margin-left: -1000px;}
            }
 /* Small devices (tablets, 768px and up) */
@media only screen and (max-width:768px) { 
    
    .c{
        width:80%;
        margin:22% auto;
        padding: 7% 3% 7% 3%;
    }
    ._404{
        font-size:50px;
        /*top: 15px;*/
    }
    ._1 {
        font-size: 1.15em;
        line-height: 20px;
    }
    .btn {
        width: 140px;
        padding: 12px;
        font-size: 16px;
    }
    .x5 {
        top: 340px;
        z-index: 2;
        opacity: 1;
    }
    /*.f365_logo img {
        width: 180px;
    }*/

    hr {
        margin-top: 0px;
    }


 }

/* Medium devices (desktops, 992px and up) */
@media only screen and (max-width: 992px) { 
    
   

 }
    </style>
  </head>

    <body>
            <div id="clouds">
                    <div class="cloud x1"></div>
                    <div class="cloud x1_5"></div>
                    <div class="cloud x2"></div>
                    <div class="cloud x3"></div>
                    <div class="cloud x4"></div>
                    <div class="cloud x5"></div>
                </div>
                
                <div class="c">
                    <!--<div class="f365_logo">
                    <img src="fitness365-logo.gif">
                </div>-->
                        <br>
                    <div class="_404">404 Page Not Found</div>
                    <br><br>
                    <hr>
                    <br>
                    <!--<div class="_1">Unfortunately, there has been an error. We apologize for any inconvenience caused. Please try again later.</div>-->
                    <!-- <div class="_2">WAS NOT FOUND</div> -->
                    <br>
                    <a class="btn" href="https://nep.goforfit.in/">Back to Home</a>
                </div>
    </body>
     </html>