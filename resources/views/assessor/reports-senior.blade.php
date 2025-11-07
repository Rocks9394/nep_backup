<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <style>
        *,
        body {
            margin: 0;
            padding: 0;
        }

        body {
            font-family: "Roboto Condensed", sans-serif;
            font-optical-sizing: auto;
            background-color: #fff;
        }

        page[size="A4"] {
            width: 21cm;
            height: 29.7cm;
            margin: 0;
            padding:0;
        }
        .act-tbl {
            width:100%;
        }
        .act-tbl td {
            border-bottom:1px solid #0A87CD;
        }
        .page-3 td {
            margin: 0;
            padding: 1px 4px 2px 4px;
           white-space:normal; 
            white-space: normal; /* collapses leading spaces/newlines */
        }
        .cell {
            line-height:12px;
        }
        .cell tr {
            border-bottom:1px solid #e5e5e5;
        }

        
    </style>
</head>

<body>
 <!-- Cover Page -->
    <table cellpadding="0" cellspacing="0" style="width: 21cm; border-collapse: collapse; margin-left: auto; margin-right: auto; font-family: Roboto Condensed, sans-serif; font-size: 12px; border: 0px; background-color: #fff;">
        <tr>
            <td>
                <table cellpadding="0" cellspacing="0" style="width: 100%; border-collapse: collapse; font-family: Roboto Condensed, sans-serif; font-size: 12px; border: 0;">
                   
                    <tr>
                        <td style="border-collapse: collapse;">
                            <div style="position: relative; background-color: #fff;">
                                <div style="position: relative; background-color: #0A87CD;margin-top:0px; z-index:0; height:136px;">
                                    <img src="{{ asset('public/assets/reports/green-dot.jpg')}}" alt="" style="width: 40px; height:40px; position: relative; left:150px; top:0;">
                                </div>
                             
                                <div style="width: auto; position:absolute; top:-30px; left: 176px; z-index:10; padding:30px 15px 0 15px; display:flex;">
                                <div style="background:#fff; padding:25px 15px 10px 15px; height:140px; float:left;">
                                    <img src="{{ asset('public/assets/reports/seqfast-logo.png')}}" alt="" style="width: auto; height:100px;">
                                </div>
                                <p style="margin-left:30px; float:left; font-size:24px; padding:34px 20px 20px 0px; width:300px; font-weight:600; line-height:24px; color:#fff;">Physical Health and Fitness Assessment</p>
                                </div>
                               
                                <img src="{{ asset('public/assets/reports/report-graphic.png')}}" alt="" style="position: absolute; top:26%; right:40px; width: 200px; border-collapse: collapse; z-index:9;">
                               
                                <img src="{{ asset('public/assets/reports/report-cover-img.jpg')}}" alt="" style="width: 76%; z-index:2; position: relative; top:0;">
                            </div>
                        
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0;">
                                <tr>
                                    <td style="background-color:#E60A00;">
                                        <div style="position:relative;">
                                            <span style="position:absolute; top:-46px; background:rgb(0 0 0/50%); padding:10px; width:178px; z-indix:2; box-sizing: border-box; text-align:center; color:#fff; font-size:16px; text-transform: uppercase;">For Senior</span>
                                            <img src="{{ asset('/public/assets/reports/aa-bg.png')}}" alt="" style="width:198px;">
                                        </div>
                                    </td>
                                    <td style="vertical-align: top; width: 100%;">
                                        <table cellpadding="0" cellspacing="0" style="width: 90%; border: 0;">
                                            <tr>
                                                <td style="height:30px;"></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <img src="{{ asset('public/assets/reports/gems-school-logo.png')}}" alt="" style="padding: 0px 0px 5px 46px; height: 100px;">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="height:30px;"></td>
                                            </tr>

                                            <tr>
                                                <td style="padding: 1px 30px 5px 46px; font-size: 20px; background:#E60A00; color:#fff; font-size: 24px; font-weight: 500; position:relative;">Student Profile<span style=" position:absolute; top:44px; right:-21px;"><img src="{{ asset('public/assets/reports/green-bg.jpg')}}" alt="" style="width:20px;"></span></td>
                                            </tr>
                                            <tr>
                                                <td style="height:10px;"></td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 10px 30px 10px 46px; font-size: 16px; color: #333;">
                                                    <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0px">
                                                        <tr>
                                                            <td colspan="2" style="padding: 6px 0;">
                                                                <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0px">
                                                                    <tr>
                                                                        <td><span style="display: inline-block; margin-right: 3px 10px;">Name</span></td>
                                                                        <td style="border-bottom: 1px solid #e5e5e5; width: 100%; text-align: center; font-weight: 600; font-size: 18px;">Raghav Soni</td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2" style="padding: 6px 0;">
                                                                <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0px;">
                                                                    <tr>
                                                                        <td><span style="display: inline-block; margin-right: 3px 10px;">Class&nbsp;&&nbsp;Section</span></td>
                                                                        <td style="border-bottom: 1px solid #e5e5e5; width: 100%; text-align: center; font-weight: 600;">10 C</td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                            
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 6px 0; width:55%;">
                                                                <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0px">
                                                                    <tr>
                                                                        <td><span style="display: inline-block; margin-right: 10px; margin-left: 0px;">Roll&nbsp;No.</span></td>
                                                                        <td style="border-bottom: 1px solid #e5e5e5; width: 100%; text-align: center; font-weight: 600;"></td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                            <td style="padding: 6px 0;">
                                                                <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0px">
                                                                    <tr>
                                                                        <td><span style="display: inline-block; margin-right: 3px 10px;">&nbsp;Registration&nbsp;No</span></td>
                                                                        <td style="border-bottom: 1px solid #e5e5e5; width: 100%; text-align: center; font-weight: 600;"></td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                            
                                                        </tr>

                                                        <tr>
                                                            <td style="padding: 6px 0;">
                                                                <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0px">
                                                                    <tr>
                                                                        <td><span style="display: inline-block; margin-right: 3px 10px;">DOB</span></td>
                                                                        <td style="border-bottom: 1px solid #e5e5e5; width: 100%; text-align: center; font-weight: 600;">05 Jun 2010 (15 Years)</td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                            <td style="padding: 6px 0;">
                                                                <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0px">
                                                                    <tr>
                                                                        <td><span style="display: inline-block; margin-right: 3px 10px; margin-left: 3px 10px;">Gender</span></td>
                                                                        <td style="border-bottom: 1px solid #e5e5e5; width: 100%; text-align: center; font-weight: 600;">Boy</td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>

                                                         <tr>
                                                            <td style="height:20px;"></td>
                                                        </tr>

                                                        <tr>
                                                            <td colspan="2" style="padding: 6px 0;">
                                                                <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0px">
                                                                    <tr>
                                                                        <td><span style="display: inline-block; margin-right: 3px 10px;">School</span></td>
                                                                        <td style="border-bottom: 1px solid #e5e5e5; width: 100%; text-align: center; font-weight: 600;"></td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 6px 0;">
                                                                <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0px">
                                                                    <tr>
                                                                        <td><span style="display: inline-block; margin-right: 3px 10px;">Code</span></td>
                                                                        <td style="border-bottom: 1px solid #e5e5e5; width: 100%; text-align: center; font-weight: 600;"></td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                            <td style="padding: 6px 0;">
                                                                <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0px">
                                                                    <tr>
                                                                        <td style="padding: 0px 0px 2px 0px;">&nbsp;APAAR&nbsp;ID&nbsp;(Optional)</td>
                                                                        <td style="border-bottom: 1px solid #e5e5e5; width: 100%; text-align: center; font-weight: 600;"></td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        
                                                        <!-- <tr>
                                                            <td style="height: 140px;"></td>
                                                        </tr> -->
                                                        <!-- <tr>
                                                            <td colspan="2" style="padding: 6px 0;">
                                                                <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0px">
                                                                    <tr>
                                                                        <td><span style="display: inline-block; margin-right: 3px 10px;">Brief Summary</span></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="border-bottom: 1px solid #e5e5e5; width: 100%; text-align: center; font-weight: 600; height: 24px;"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="border-bottom: 1px solid #e5e5e5; width: 100%; text-align: center; font-weight: 600; height: 24px;"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="border-bottom: 1px solid #e5e5e5; width: 100%; text-align: center; font-weight: 600; height: 24px;"></td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr> -->
                                                    </table>
                                                </td>
                                            </tr>
                                            <!-- <tr>
                                                <td style="height:30px;"></td>
                                            </tr>
                                           <tr>
                                                <td style="text-align:right; padding: 0px 0px 0px 46px; ">
                                                    <div style="float:right; text-align:center;">
                                                    <p style="margin-bottom:0px; color:#666; font-size:10px;">Powered by</p>
                                                    <img src="{{ asset('public/assets/reports/fitness365-logo-web.png')}}" alt="fitness365 logo" style="height:28px;">
                                                    </div>
                                                </td>
                                            </tr> -->
                                        </table>
                                    </td>

                                </tr>

                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

<!-- Page 2 -->
    <table border="0" cellpadding="0" cellspacing="0" style="page-break-before: always;">
        <tr>
            <td>
                <!-- Inner page Header Area (Page 2) -->
                <table border="1" cellpadding="0" cellspacing="0" style="width: 100%; border-collapse: collapse; font-family: Roboto Condensed, sans-serif; font-size: 12px; border:0px solid transparent;">
                    <tr>
                        <td style="vertical-align: top; height: 100px;">
                            <table cellpadding="0" cellspacing="0" style="width: 100%; border:0;">
                                <tr>
                                    <td style="width:300px;">
                                        <div style="margin-left: 30px; margin-top: 30px;">
                                            School Logo
                                        </div>
                                    </td>
                                    <td rowspan="2" style="position: relative; vertical-align: top; width: auto; text-align: right;">
                                        <div style="position: absolute; top: 30px; right:30px; display: flex; align-items: center; z-index: 1; width: 90px; overflow: hidden;">
                                            <img src="{{ asset('public/assets/reports/seqfast-logo.png')}}" alt="" style="width: inherit;">
                                        </div>
                                        <img src="{{ asset('public/assets/reports/inner-header-bg.png')}}" alt="" style="width: 450px; height:auto; position: relative; right:0px; top:0;">
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                 <!-- Inner page Content (Page 2) -->
                <table border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td>
                            <table cellpadding="0" cellspacing="0" style="width: 94%; border: 0; border-collapse: collapse; margin: auto;">
                                <tr>
                                    <td style="border-bottom: 3px solid #E60A00;">
                                        <div style="align-items: center; color: #fff; font-size: 18px; font-weight: 600; overflow:hidden; height: 32px;">
                                            <div style="float:left; padding: 1px 0px 3px 10px; background: #E60A00; margin-bottom: 0px;">Physical Fitness Assessment - Class 4 to 12</div>
                                            <div style="text-align:right; float:left;"><img src="{{ asset('public/assets/reports/heading-band-corder.jpg')}}" alt="" style="width: 39px; position:relative; top:0px;"></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="height: 10px;"></td>
                                </tr>
                                <tr>
                                    <td style="padding: 6px 10px 6px 0px; color:#000; font-size: 16px; font-weight: 600;">Speed (50 Mt Dash)</td>
                                </tr>
                                <tr>
                                    <td>
                                        <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0; border-collapse: collapse;">
                                            <tr>
                                                <td style="vertical-align: top;">
                                                    <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
                                                        <tr>
                                                            <td style="width: 50%;">
                                                                <table border="1" cellpadding="0" cellspacing="0" style="width: 100%; border: 1px solid orange; font-size: 13px; border-collapse: collapse; color:#333;">
                                                                    <tr style="background-color: #fecd0a;">
                                                                        <td style="width: 20%; background-color:#0A87CD; padding: 0px 4px 2px 6px; border: 1px solid #0A87CD; color:#fff; text-align: center; font-weight: bold;" rowspan="2">Current Term</td>
                                                                        <td style="width: 25%; padding: 0px 4px 2px 6px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">Date</td>
                                                                        <td style="width: 28%; padding: 0px 4px 2px 6px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">Score</td>
                                                                        <td style="padding: 0px 4px 2px 6px; border: 1px solid orange; color:#000; font-weight: bold; text-align: center;">Level</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td style="padding: 0px 4px 2px 6px; font-weight: 500; color:#000; text-align: center; border: 1px solid orange; border-bottom: 1px solid #00A923;">20 Jun 2025</td>
                                                                        <td style="padding: 0px 4px 2px 6px; text-align: center; border: 1px solid orange; border-bottom: 1px solid #00A923;">8.360 sec</td>
                                                                        <td style="padding: 0px 4px 2px 6px; text-align: center; border: 1px solid orange; border-bottom: 1px solid #00A923;">Good</td>

                                                                    </tr>

                                                                </table>
                                                            </td>
                                                            <td style="width: 50%;">
                                                                <table border="1" cellpadding="0" cellspacing="0" style="width: 100%; border: 1px solid orange; font-size: 13px; border-collapse: collapse; color:#333;">
                                                                    <tr style="background-color: #fecd0a;">
                                                                        <td style="font-weight: 500; width: 20%; background-color:#0A87CD; padding: 0px 4px 2px 6px; border: 1px solid #0A87CD; color:#fff; text-align: center;" rowspan="2">Previous Term</td>
                                                                        <td style="font-weight: 500; width: 25%; padding: 0px 4px 2px 6px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">Date</td>
                                                                        <td style="font-weight: 500; width: 28%; padding: 0px 4px 2px 6px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">Score</td>
                                                                        <td style="font-weight: 500; padding: 0px 4px 2px 6px; border: 1px solid orange; color:#000; font-weight: bold; text-align: center;">Level</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td style="padding: 0px 4px 2px 6px; font-weight: 500; color:#000; text-align: center; border: 1px solid orange; border-bottom: 1px solid #00A923;">20 Jun 2025</td>
                                                                        <td style="padding: 0px 4px 2px 6px; text-align: center; border: 1px solid orange; border-bottom: 1px solid #00A923;">18.360 sec</td>
                                                                        <td style="padding: 0px 4px 2px 6px; text-align: center; border: 1px solid orange; border-bottom: 1px solid #00A923;">Very Low</td>

                                                                    </tr>

                                                                </table>
                                                            </td>
                                                        </tr>

                                                    </table>

                                                </td>

                                            </tr>
                                            <tr>
                                                <td>
                                                    <table border="1" cellpadding="0" cellspacing="0" style="width: 100%; border-top: 1px solid transparent; border-left: 1px solid #00A923; border-right: 1px solid #00A923; border-bottom: 1px solid #00A923; font-size: 13px; border-collapse: collapse; color:#333;">
                                                        <tr>
                                                            <td style="border-top: 1px solid #00A923; background-color: #00A923; padding: 0px 4px 2px 4px; padding: 0px 10px 3px 10px; color: #fff; text-align: center; width: 100px; font-weight: bold;">Recommendation</td>
                                                            <td style="padding:0px 4px 2px 8px; line-height:14px; font-size:13px;">Very Good. You can incorporate resisted sprints, explosive starts, and plyometric drills to enhance acceleration, stride power, and overall sprint speed.</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>

                                </tr>

                                <tr>
                                    <td style="height: 10px;"></td>
                                </tr>
                                <tr>
                                    <td style="padding: 6px 10px 6px 0px; font-size: 20px; color:#000; font-size: 16px; font-weight: 600;">Abdominal/Core Strength (Partial Curl Up - 30 Seconds)</td>
                                </tr>
                                <tr>
                                    <td>
                                        <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0; border-collapse: collapse;">
                                            <tr>
                                                <td style="vertical-align: top;">
                                                    <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
                                                        <tr>
                                                            <td style="width: 50%;">
                                                                <table border="1" cellpadding="0" cellspacing="0" style="width: 100%; border: 1px solid orange; font-size: 13px; border-collapse: collapse; color:#333;">
                                                                    <tr style="background-color: #fecd0a;">
                                                                        <td style="width: 20%; background-color:#0A87CD; padding: 0px 4px 2px 6px; border: 1px solid #0A87CD; color:#fff; text-align: center; font-weight: bold;" rowspan="2">Current Term</td>
                                                                        <td style="width: 25%; padding: 0px 4px 2px 6px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">Date</td>
                                                                        <td style="width: 28%; padding: 0px 4px 2px 6px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">Score</td>
                                                                        <td style="padding: 0px 4px 2px 6px; border: 1px solid orange; color:#000; font-weight: bold; text-align: center;">Level</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td style="padding: 0px 4px 2px 6px; font-weight: 500; color:#000; text-align: center; border: 1px solid orange; border-bottom: 1px solid #00A923;">18 Jun 2025</td>
                                                                        <td style="padding: 0px 4px 2px 6px; text-align: center; border: 1px solid orange; border-bottom: 1px solid #00A923;">18 Times</td>
                                                                        <td style="padding: 0px 4px 2px 6px; text-align: center; border: 1px solid orange; border-bottom: 1px solid #00A923;">Developing</td>

                                                                    </tr>

                                                                </table>
                                                            </td>
                                                            <td style="width: 50%;">
                                                                <table border="1" cellpadding="0" cellspacing="0" style="width: 100%; border: 1px solid orange; font-size: 13px; border-collapse: collapse; color:#333;">
                                                                    <tr style="background-color: #fecd0a;">
                                                                        <td style="width: 20%; background-color:#0A87CD; padding: 0px 4px 2px 6px; border: 1px solid #0A87CD; color:#fff; text-align: center; font-weight: bold;" rowspan="2">Previous Term</td>
                                                                        <td style="width: 25%; padding: 0px 4px 2px 6px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">Date</td>
                                                                        <td style="width: 28%; padding: 0px 4px 2px 6px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">Score</td>
                                                                        <td style="padding: 0px 4px 2px 6px; border: 1px solid orange; color:#000; font-weight: bold; text-align: center;">Level</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td style="padding: 0px 4px 2px 6px; font-weight: 500; color:#000; text-align: center; border: 1px solid orange; border-bottom: 1px solid #00A923;">10 Jun 2025</td>
                                                                        <td style="padding: 0px 4px 2px 6px; text-align: center; border: 1px solid orange; border-bottom: 1px solid #00A923;">20 Times</td>
                                                                        <td style="padding: 0px 4px 2px 6px; text-align: center; border: 1px solid orange; border-bottom: 1px solid #00A923;">Developing</td>

                                                                    </tr>

                                                                </table>
                                                            </td>
                                                        </tr>

                                                    </table>

                                                </td>

                                            </tr>
                                            <tr>
                                                <td>
                                                    <table border="1" cellpadding="0" cellspacing="0" style="width: 100%; border-top: 1px solid transparent; border-left: 1px solid #00A923; border-right: 1px solid #00A923; border-bottom: 1px solid #00A923; font-size: 13px; border-collapse: collapse; color:#333;">
                                                        <tr>
                                                            <td style="border-top: 1px solid #00A923; background-color: #00A923; padding: 0px 4px 2px 4px; padding: 0px 10px 3px 10px; color: #fff; text-align: center; width: 100px; font-weight: bold;">Recommendation</td>
                                                            <td style="padding:0px 4px 2px 8px; line-height:14px; font-size:13px;">You can further improve your strength by practicing stair climbing, hill walking, cycling, dance, pushups, sit-ups, squats, planks, crunches, Naukasana, Shalabhasana, Akarna Dhanurasana, etc</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>

                                </tr>
                                <tr>
                                    <td style="height: 10px;"></td>
                                </tr>
                                <tr>
                                    <td style="padding: 6px 10px 6px 0px; font-size: 20px; color:#000; font-size: 16px; font-weight: 600;">Flexibility (Sit and Reach)</td>
                                </tr>
                                <tr>
                                    <td>
                                        <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0; border-collapse: collapse;">
                                            <tr>
                                                <td style="vertical-align: top;">
                                                    <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
                                                        <tr>
                                                            <td style="width: 50%;">
                                                                <table border="1" cellpadding="0" cellspacing="0" style="width: 100%; border: 1px solid orange; font-size: 13px; border-collapse: collapse; color:#333;">
                                                                    <tr style="background-color: #fecd0a;">
                                                                        <td style="width: 20%; background-color:#0A87CD; padding: 0px 4px 2px 6px; border: 1px solid #0A87CD; color:#fff; text-align: center; font-weight: bold;" rowspan="2">Current Term</td>
                                                                        <td style="width: 25%; padding: 0px 4px 2px 6px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">Date</td>
                                                                        <td style="width: 28%; padding: 0px 4px 2px 6px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">Score</td>
                                                                        <td style="padding: 0px 4px 2px 6px; border: 1px solid orange; color:#000; font-weight: bold; text-align: center;">Level</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td style="padding: 0px 4px 2px 6px; font-weight: 500; color:#000; text-align: center; border: 1px solid orange; border-bottom: 1px solid #00A923;">17 Jun 2025</td>
                                                                        <td style="padding: 0px 4px 2px 6px; text-align: center; border: 1px solid orange; border-bottom: 1px solid #00A923;">0.2 cm</td>
                                                                        <td style="padding: 0px 4px 2px 6px; text-align: center; border: 1px solid orange; border-bottom: 1px solid #00A923;">Very Low</td>

                                                                    </tr>

                                                                </table>
                                                            </td>
                                                            <td style="width: 50%;">
                                                                <table border="1" cellpadding="0" cellspacing="0" style="width: 100%; border: 1px solid orange; font-size: 13px; border-collapse: collapse; color:#333;">
                                                                    <tr style="background-color: #fecd0a;">
                                                                        <td style="width: 20%; background-color:#0A87CD; padding: 0px 4px 2px 6px; border: 1px solid #0A87CD; color:#fff; text-align: center; font-weight: bold;" rowspan="2">Previous Term</td>
                                                                        <td style="width: 25%; padding: 0px 4px 2px 6px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">Date</td>
                                                                        <td style="width: 28%; padding: 0px 4px 2px 6px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">Score</td>
                                                                        <td style="padding: 0px 4px 2px 6px; border: 1px solid orange; color:#000; font-weight: bold; text-align: center;">Level</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td style="padding: 0px 4px 2px 6px; font-weight: 500; color:#000; text-align: center; border: 1px solid orange; border-bottom: 1px solid #00A923;">10 Jun 2025</td>
                                                                        <td style="padding: 0px 4px 2px 6px; text-align: center; border: 1px solid orange; border-bottom: 1px solid #00A923;">1.2 cm</td>
                                                                        <td style="padding: 0px 4px 2px 6px; text-align: center; border: 1px solid orange; border-bottom: 1px solid #00A923;">Developing</td>

                                                                    </tr>

                                                                </table>
                                                            </td>
                                                        </tr>

                                                    </table>

                                                </td>

                                            </tr>
                                            <tr>
                                                <td>
                                                    <table border="1" cellpadding="0" cellspacing="0" style="width: 100%; border-top: 1px solid transparent; border-left: 1px solid #00A923; border-right: 1px solid #00A923; border-bottom: 1px solid #00A923; font-size: 13px; border-collapse: collapse; color:#333;">
                                                        <tr>
                                                            <td style="border-top: 1px solid #00A923; background-color: #00A923; padding: 0px 4px 2px 4px; padding: 0px 10px 3px 10px; color: #fff; text-align: center; width: 100px; font-weight: bold;">Recommendation</td>
                                                            <td style="padding:0px 4px 2px 8px; line-height:14px; font-size:13px;">Sports Fit. Keep it up!</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>

                                </tr>
                                <tr>
                                    <td style="height: 10px;"></td>
                                </tr>
                                <tr>
                                    <td style="padding: 6px 10px 6px 0px; font-size: 20px; color:#000; font-size: 16px; font-weight: 600;">Muscular Endurance (Push Ups)</td>
                                </tr>
                                <tr>
                                    <td>
                                        <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0; border-collapse: collapse;">
                                            <tr>
                                                <td style="vertical-align: top;">
                                                    <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
                                                        <tr>
                                                            <td style="width: 50%;">
                                                                <table border="1" cellpadding="0" cellspacing="0" style="width: 100%; border: 1px solid orange; font-size: 13px; border-collapse: collapse; color:#333;">
                                                                    <tr style="background-color: #fecd0a;">
                                                                        <td style="width: 20%; background-color:#0A87CD; padding: 0px 4px 2px 6px; border: 1px solid #0A87CD; color:#fff; text-align: center; font-weight: bold;" rowspan="2">Current Term</td>
                                                                        <td style="width: 25%; padding: 0px 4px 2px 6px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">Date</td>
                                                                        <td style="width: 28%; padding: 0px 4px 2px 6px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">Score</td>
                                                                        <td style="padding: 0px 4px 2px 6px; border: 1px solid orange; color:#000; font-weight: bold; text-align: center;">Level</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td style="padding: 0px 4px 2px 6px; font-weight: 500; color:#000; text-align: center; border: 1px solid orange; border-bottom: 1px solid #00A923;">18 Jun 2025</td>
                                                                        <td style="padding: 0px 4px 2px 6px; text-align: center; border: 1px solid orange; border-bottom: 1px solid #00A923;">18 Times</td>
                                                                        <td style="padding: 0px 4px 2px 6px; text-align: center; border: 1px solid orange; border-bottom: 1px solid #00A923;">Developing</td>

                                                                    </tr>

                                                                </table>
                                                            </td>
                                                            <td style="width: 50%;">
                                                                <table border="1" cellpadding="0" cellspacing="0" style="width: 100%; border: 1px solid orange; font-size: 13px; border-collapse: collapse; color:#333;">
                                                                    <tr style="background-color: #fecd0a;">
                                                                        <td style="width: 20%; background-color:#0A87CD; padding: 0px 4px 2px 6px; border: 1px solid #0A87CD; color:#fff; text-align: center; font-weight: bold;" rowspan="2">Previous Term</td>
                                                                        <td style="width: 25%; padding: 0px 4px 2px 6px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">Date</td>
                                                                        <td style="width: 28%; padding: 0px 4px 2px 6px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">Score</td>
                                                                        <td style="padding: 0px 4px 2px 6px; border: 1px solid orange; color:#000; font-weight: bold; text-align: center;">Level</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td style="padding: 0px 4px 2px 6px; font-weight: 500; color:#000; text-align: center; border: 1px solid orange; border-bottom: 1px solid #00A923;">10 Jun 2025</td>
                                                                        <td style="padding: 0px 4px 2px 6px; text-align: center; border: 1px solid orange; border-bottom: 1px solid #00A923;">06 Times</td>
                                                                        <td style="padding: 0px 4px 2px 6px; text-align: center; border: 1px solid orange; border-bottom: 1px solid #00A923;">Very Low</td>

                                                                    </tr>

                                                                </table>
                                                            </td>
                                                        </tr>

                                                    </table>

                                                </td>

                                            </tr>
                                            <tr>
                                                <td>
                                                    <table border="1" cellpadding="0" cellspacing="0" style="width: 100%; border-top: 1px solid transparent; border-left: 1px solid #00A923; border-right: 1px solid #00A923; border-bottom: 1px solid #00A923; font-size: 13px; border-collapse: collapse; color:#333;">
                                                        <tr>
                                                            <td style="border-top: 1px solid #00A923; background-color: #00A923; padding: 0px 4px 2px 4px; padding: 0px 10px 3px 10px; color: #fff; text-align: center; width: 100px; font-weight: bold;">Recommendation</td>
                                                            <td style="padding:0px 4px 2px 8px; line-height:14px; font-size:13px;">Sports Fit. Keep it up!</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>

                                </tr>
                                <tr>
                                    <td style="height: 10px;"></td>
                                </tr>
                                <tr>
                                    <td style="padding: 6px 10px 6px 0px; font-size: 20px; color:#000; font-size: 16px; font-weight: 600;">Cardiovascular Fitness (600 M Run/Walk)</td>
                                </tr>
                                <tr>
                                    <td>
                                        <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0; border-collapse: collapse;">
                                            <tr>
                                                <td style="vertical-align: top;">
                                                    <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
                                                        <tr>
                                                            <td style="width: 50%;">
                                                                <table border="1" cellpadding="0" cellspacing="0" style="width: 100%; border: 1px solid orange; font-size: 13px; border-collapse: collapse; color:#333;">
                                                                    <tr style="background-color: #fecd0a;">
                                                                        <td style="width: 20%; background-color:#0A87CD; padding: 0px 4px 2px 6px; border: 1px solid #0A87CD; color:#fff; text-align: center; font-weight: bold;" rowspan="2">Current Term</td>
                                                                        <td style="width: 24%; padding: 0px 4px 2px 6px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">Date</td>
                                                                        <td style="width: 32%; padding: 0px 4px 2px 6px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">Score</td>
                                                                        <td style="padding: 0px 4px 2px 6px; border: 1px solid orange; color:#000; font-weight: bold; text-align: center;">Level</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td style="padding: 0px 4px 2px 6px; font-weight: 500; color:#000; text-align: center; border: 1px solid orange; border-bottom: 1px solid #00A923;">18 Jun 2025</td>
                                                                        <td style="padding: 0px 4px 2px 6px; text-align: center; border: 1px solid orange; border-bottom: 1px solid #00A923;">4 min 45 sec 0 ms</td>
                                                                        <td style="padding: 0px 4px 2px 6px; text-align: center; border: 1px solid orange; border-bottom: 1px solid #00A923;">Developing</td>

                                                                    </tr>

                                                                </table>
                                                            </td>
                                                            <td style="width: 50%;">
                                                                <table border="1" cellpadding="0" cellspacing="0" style="width: 100%; border: 1px solid orange; font-size: 13px; border-collapse: collapse; color:#333;">
                                                                    <tr style="background-color: #fecd0a;">
                                                                        <td style="width: 20%; background-color:#0A87CD; padding: 0px 4px 2px 6px; border: 1px solid #0A87CD; color:#fff; text-align: center; font-weight: bold;" rowspan="2">Previous Term</td>
                                                                        <td style="width: 24%; padding: 0px 4px 2px 6px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">Date</td>
                                                                        <td style="width: 32%; padding: 0px 4px 2px 6px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">Score</td>
                                                                        <td style="padding: 0px 4px 2px 6px; border: 1px solid orange; color:#000; font-weight: bold; text-align: center;">Level</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td style="padding: 0px 4px 2px 6px; font-weight: 500; color:#000; text-align: center; border: 1px solid orange; border-bottom: 1px solid #00A923;">10 Jun 2025</td>
                                                                        <td style="padding: 0px 4px 2px 6px; text-align: center; border: 1px solid orange; border-bottom: 1px solid #00A923;">3 min 45 sec 0 ms</td>
                                                                        <td style="padding: 0px 4px 2px 6px; text-align: center; border: 1px solid orange; border-bottom: 1px solid #00A923;">Excellent</td>

                                                                    </tr>

                                                                </table>
                                                            </td>
                                                        </tr>

                                                    </table>

                                                </td>

                                            </tr>
                                            <tr>
                                                <td>
                                                    <table border="1" cellpadding="0" cellspacing="0" style="width: 100%; border-top: 1px solid transparent; border-left: 1px solid #00A923; border-right: 1px solid #00A923; border-bottom: 1px solid #00A923; font-size: 13px; border-collapse: collapse; color:#333;">
                                                        <tr>
                                                            <td style="border-top: 1px solid #00A923; background-color: #00A923; padding: 0px 4px 2px 4px; padding: 0px 10px 3px 10px; color: #fff; text-align: center; width: 100px; font-weight: bold;">Recommendation</td>
                                                            <td style="padding:0px 4px 2px 8px; font-size:13px;">Sports Fit. Keep it up!</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>

                                </tr>
                                <tr>
                                    <td style="height: 10px;"></td>
                                </tr>
                                <tr>
                                    <td style="padding: 6px 10px 6px 0px; font-size: 20px; color:#000; font-size: 16px; font-weight: 600;">BMI (Body Mass Index)</td>
                                </tr>
                                <tr>
                                    <td>
                                        <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0; border-collapse: collapse;">
                                            <tr>
                                                <td style="vertical-align: top;">
                                                    <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
                                                        <tr style="font-size: 13px; line-height: 1.25rem;">
                                                            <td style="border-top: 1px solid #0A87CD; border-left: 1px solid #0A87CD; border-right: 1px solid #0A87CD; border-bottom: 0px solid transparent; border-collapse: collapse; padding:5px 15px; vertical-align: middle;">
                                                                <ul style="margin-left: 15px;">
                                                                    <li>Height recorded in cm and mm</li>
                                                                    <li>Weight will be recorded in kilogram (kg) and grams(gms)</li>
                                                                </ul>
                                                            </td>
                                                            <td style="border-top: 1px solid #0A87CD; border-right: 1px solid #0A87CD; border-bottom: 0px solid transparent; border-collapse: collapse; padding:5px 15px; vertical-align: top; padding-bottom:10px;">
                                                                <table border="0" cellpadding="0" cellspacing="0">
                                                                    <tr>
                                                                        <td>Body Mass Index =</td>
                                                                        <td style="padding:0 10px;">
                                                                        <p style="border-bottom: 1px solid #c5c5c5; padding-bottom: 2px; margin:0;">Weight (in kg)</p>
                                                                        <p style="padding-top: 0px; margin:0;">Height (in m)2</p>
                                                                        </td>
                                                                    </tr>
                                                                </table>

                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 50%;">
                                                                <table border="1" cellpadding="0" cellspacing="0" style="width: 100%; border: 1px solid orange; font-size: 13px; border-collapse: collapse; color:#333;">
                                                                    <tr style="background-color: #fecd0a;">
                                                                        <td style="width: 20%; background-color:#0A87CD; padding: 0px 4px 2px 6px; border: 1px solid #0A87CD; color:#fff; text-align: center; font-weight: bold;" rowspan="2">Current Term</td>
                                                                        <td style="width: 25%; padding: 0px 4px 2px 6px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">Date</td>
                                                                        <td style="width: 28%; padding: 0px 4px 2px 6px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">Weight</td>
                                                                        <td style="width: 28%; padding: 0px 4px 2px 6px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">Height</td>
                                                                        <td style="width: 28%; padding: 0px 4px 2px 6px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">BMI</td>
                                                                        <td style="padding: 0px 4px 2px 6px; border: 1px solid orange; color:#000; font-weight: bold; text-align: center;">Level</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td style="padding: 0px 4px 2px 6px; font-weight: 500; color:#000; text-align: center;">10&nbsp;Jun&nbsp;2025</td>
                                                                        <td style="padding: 0px 4px 2px 6px; text-align: center; border: 1px solid orange;">&lt;15.20</td>
                                                                        <td style="padding: 0px 4px 2px 6px; text-align: center; border: 1px solid orange;">&lt;15.20</td>
                                                                        <td style="padding: 0px 4px 2px 6px; text-align: center; border: 1px solid orange;">&lt;15.20</td>
                                                                        <td style="padding: 0px 4px 2px 6px; text-align: center; border: 1px solid orange;">Normal</td>

                                                                    </tr>

                                                                </table>
                                                            </td>
                                                            <td style="width: 50%;">
                                                                <table border="1" cellpadding="0" cellspacing="0" style="width: 100%; border: 1px solid orange; font-size: 13px; border-collapse: collapse; color:#333;">
                                                                    <tr style="background-color: #fecd0a;">
                                                                        <td style="width: 20%; background-color:#0A87CD; padding: 0px 4px 2px 6px; border: 1px solid #0A87CD; color:#fff; text-align: center; font-weight: bold;" rowspan="2">Previous Term</td>
                                                                        <td style="width: 25%; padding: 0px 4px 2px 6px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">Date</td>
                                                                        <td style="width: 28%; padding: 0px 4px 2px 6px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">Weight</td>
                                                                        <td style="width: 28%; padding: 0px 4px 2px 6px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">Height</td>
                                                                        <td style="width: 28%; padding: 0px 4px 2px 6px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">BMI</td>
                                                                        <td style="padding: 0px 4px 2px 6px; border: 1px solid orange; color:#000; font-weight: bold; text-align: center;">Level</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td style="padding: 0px 4px 2px 6px; font-weight: 500; color:#000; text-align: center;">10&nbsp;Jun&nbsp;2025</td>
                                                                        <td style="padding: 0px 4px 2px 6px; text-align: center; border: 1px solid orange;"> &lt;15.20 </td>
                                                                        <td style="padding: 0px 4px 2px 6px; text-align: center; border: 1px solid orange;"> &lt;15.20 </td>
                                                                        <td style="padding: 0px 4px 2px 6px; text-align: center; border: 1px solid orange;"> &lt;15.20 </td>
                                                                        <td style="padding: 0px 4px 2px 6px; text-align: center; border: 1px solid orange;">Normal</td>

                                                                    </tr>

                                                                </table>
                                                            </td>
                                                        </tr>

                                                    </table>

                                                </td>
                                            </tr>

                                        </table>
                                    </td>
                                </tr>

                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <!-- Inner page Footer Area (Page 2) -->
       <tr>
            <td>
                <table border="0" cellpadding="0" cellspacing="0" style="width:100%;">
                    <tr>
                        <td style="height: 100px;"></td>
                    </tr>
                    <tr>
                        <td style="width:94px;">
                            <div style="float: left; position: relative; width: 80px;">
                                <span style="position: absolute; left: 50%; top:50%; transform: translate(-50%, 0); color: #fff; z-index: 1; display: inline-block; padding: 6px 0 0 0px; font-size: 13px; font-weight: 600;">2</span>
                                <img src="{{ asset('public/assets/reports/footer-bg.png')}}" alt="" style="width: inherit;">
                            </div>
                        </td>
                        <td style="text-align: right;">
                            <table cellpadding="0" cellspacing="0" style="border: 0px; width: 100%;">
                                <tr>
                                    <td style="height: 44px;"></td>
                                    <td style="height: 44px;"></td>
                                </tr>
                                <tr>
                                    <td style="font-weight: 400; font-size: 13px; color:#666;">
                                        Physical Health and Fitness Assessment
                                    </td>
                                    <td style="text-align:right; padding: 0px 30px 0px 0px;">
                                        <div style="float:right; text-align:center; position:relative;">
                                            <p style="color:#666; font-size:10px; position:absolute; top:-17px; width:100%; text-align:center;">powered by</p>
                                            <img src="{{ asset('public/assets/reports/fitness365-logo-web.png')}}" alt="fitness365 logo" style="height:28px;">
                                        </div> 
                                    </td>
                                </tr>

                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

<!-- Page 3 -->
    <table border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td>
                    <!-- Inner page Header Area (Page 3) -->
                    <table border="0" cellpadding="0" cellspacing="0" style=" width: 100%; border-collapse: collapse; font-family: Roboto Condensed, sans-serif; font-size: 12px; border:0px solid transparent;">
                        <tr>
                            <td style="vertical-align: top; height: 100px;">
                                <table cellpadding="0" cellspacing="0" style="width: 100%; border:0;">
                                    <tr>
                                        <td rowspan="2" style="position: relative; vertical-align: top; width: auto; text-align: left;">
                                            <div style="position: absolute; top: 30px; left:30px; display: flex; align-items: center; z-index: 1; width: 90px; overflow: hidden;">
                                                <img src="{{ asset('public/assets/reports/seqfast-logo.png')}}" alt="" style="width: inherit;">
                                            </div>
                                            <img src="{{ asset('public/assets/reports/inner-header2-bg.png')}}" alt="" style="width: 450px; height:auto; position: relative; left:0px; top:0;">
                                        </td>
                                        <td style="width:300px; text-align: right;">
                                            <div style="margin-right: 30px; margin-top: 30px;">
                                                School Logo
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
           <!-- Inner page Content (Page 3) -->
            <tr>
                <td>
                    <table cellpadding="0" cellspacing="0" style="border: 0; border-collapse: collapse; margin: auto; width:94%;">
                                <tr>
                                    <td style="border-bottom: 3px solid #E60A00;">
                                        <div style="align-items: center; color: #fff; font-size: 18px; font-weight: 600; overflow:hidden; height: 32px;">
                                            <div style="float:left; padding: 1px 0px 3px 10px; background: #E60A00; margin-bottom: 0px;">Recommended Sports</div>
                                            <div style="text-align:right; float:left;"><img src="{{ asset('public/assets/reports/heading-band-corder.jpg')}}" alt="" style="width: 39px; position:relative; top:0px;"></div>
                                        </div>
                                        
                                    </td>
                                </tr>
                                    <tr>
                                        <td style="height: 10px;"></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0; border-collapse: collapse; border:1px solid #F28F0C; font-size: 12px; text-align:left; line-height:13px;">
                                                <tr style="background-color: #FBCA01; color:#000; font-size: 13px;">
                                                    <th style="vertical-align: top; padding: 1px 4px 2px 4px; border:1px solid #F28F0C; width:24px; text-align:center; "></th>
                                                    <th style="vertical-align: top; padding: 1px 4px 2px 4px; width:44%; border:1px solid #F28F0C; text-align:left;">Fitness Profile</th>
                                                    <th style="vertical-align: top; padding: 1px 4px 2px 4px; border:1px solid #F28F0C; text-align:left;">Recommended Team</th>
                                                    <th style="vertical-align: top; padding: 1px 4px 2px 4px; border:1px solid #F28F0C; text-align:left;">Recommended Individual Sports</th>
                                                </tr>
                                                <tr>
                                                    <td style="vertical-align: top; padding: 4px 4px; border:1px solid #F28F0C; text-align:center; ">
                                                        <img src="{{ asset('public/assets/reports/checked.png')}}" alt="checked" style="width:12px;"></td>
                                                    <td style="vertical-align: top; padding: 1px 4px 2px 4px; border:1px solid #F28F0C;">High Cardiovascular Endurance, High Muscular Endurance, Moderate Strength, High Speed, Moderate Flexibility</td>
                                                    <td style="vertical-align: top; padding: 1px 4px 2px 4px; border:1px solid #F28F0C; ">Hockey, Football, Rugby 7s </td>
                                                    <td style="vertical-align: top; padding: 1px 4px 2px 4px; border:1px solid #F28F0C; ">Athletics (1500m - 10,000m), Marathon, Cycling (Track/Road), Triathlon </td>
                                                </tr>
                                                <tr>
                                                    <td style="vertical-align: top; padding: 4px 4px; border:1px solid #F28F0C; text-align:center;  "><img src="{{ asset('public/assets/reports/checked.png')}}" alt="checked" style="width:12px;"> </td>
                                                    <td style="vertical-align: top; padding: 1px 4px 2px 4px; border:1px solid #F28F0C; ">
                                                        Moderate Cardiovascular Endurance, High Strength, High Speed, Moderate Muscular Endurance, Moderate Flexibility
                                                    </td>
                                                    <td style="vertical-align: top; padding: 1px 4px 2px 4px; border:1px solid #F28F0C; ">
                                                        Kabaddi, Cricket, Kho-Kho
                                                    </td>
                                                    <td style="vertical-align: top; padding: 1px 4px 2px 4px; border:1px solid #F28F0C; ">
                                                        Athletics (100m, 200m), Weightlifting, Wrestling, Boxing
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="vertical-align: top; padding: 4px 4px; border:1px solid #F28F0C; text-align:center; ">

                                                    </td>
                                                    <td style="vertical-align: top; padding: 1px 4px 2px 4px; border:1px solid #F28F0C;">
                                                        High Strength, Moderate Speed, Moderate Cardiovascular Endurance, Moderate Flexibility, Moderate Muscular Endurance
                                                    </td>
                                                    <td style="vertical-align: top; padding: 1px 4px 2px 4px; border:1px solid #F28F0C; ">
                                                        Tug of War, Rowing (Team)
                                                    </td>
                                                    <td style="vertical-align: top; padding: 1px 4px 2px 4px; border:1px solid #F28F0C; ">
                                                        Shot Put, Javelin, Hammer Throw, Wrestling, Powerlifting
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="vertical-align: top; padding: 4px 4px; border:1px solid #F28F0C; text-align:center; ">
                                                        <img src="{{ asset('public/assets/reports/checked.png')}}" alt="checked" style="width:12px;">
                                                    </td>
                                                    <td style="vertical-align: top; padding: 1px 4px 2px 4px; border:1px solid #F28F0C; ">
                                                        High Flexibility, High Muscular Endurance, Moderate Speed, Moderate Strength, Moderate Cardiovascular Endurance
                                                    </td>
                                                    <td style="vertical-align: top; padding: 1px 4px 2px 4px; border:1px solid #F28F0C; ">
                                                        Artistic Roller Skating (Team Display), Gymnastics Team
                                                    </td>
                                                    <td style="vertical-align: top; padding: 1px 4px 2px 4px; border:1px solid #F28F0C; ">
                                                        Gymnastics, Yoga, Mallakhamb, Artistic Skating
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="vertical-align: top; padding: 1px 4px 2px 4px; border:1px solid #F28F0C;">

                                                    </td>
                                                    <td style="vertical-align: top; padding: 1px 4px 2px 4px; border:1px solid #F28F0C;">
                                                        High Speed, High Cardiovascular Endurance, Moderate Strength, Moderate Flexibility Moderate Muscular Endurance
                                                    </td>
                                                    <td style="vertical-align: top; padding: 1px 4px 2px 4px; border:1px solid #F28F0C; ">
                                                        Cricket, Hockey, Basketball, Ultimate Frisbee
                                                    </td>
                                                    <td style="vertical-align: top; padding: 1px 4px 2px 4px; border:1px solid #F28F0C; ">
                                                        Athletics (400m, 800m), Swimming (Freestyle, Backstroke), Rowing
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="vertical-align: top; padding: 1px 4px 2px 4px; border:1px solid #F28F0C; ">

                                                    </td>
                                                    <td style="vertical-align: top; padding: 1px 4px 2px 4px; border:1px solid #F28F0C; ">
                                                        Moderate in all components
                                                    </td>
                                                    <td style="vertical-align: top; padding: 1px 4px 2px 4px; border:1px solid #F28F0C; ">
                                                        Volleyball, Handball, Baseball, Basketball
                                                    </td>
                                                    <td style="vertical-align: top; padding: 1px 4px 2px 4px; border:1px solid #F28F0C; ">
                                                        Badminton, Table Tennis, Shooting, Archery, Tennis, Squash
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="vertical-align: top; padding: 1px 4px 2px 4px; border:1px solid #F28F0C;">

                                                    </td>
                                                    <td style="vertical-align: top; padding: 1px 4px 2px 4px; border:1px solid #F28F0C;">
                                                        High Muscular Endurance, High Strength, Moderate Cardiovascular Endurance, Moderate Speed, Moderate Flexibility
                                                    </td>
                                                    <td style="vertical-align: top; padding: 1px 4px 2px 4px; border:1px solid #F28F0C; ">
                                                        Rowing (Team), Kabaddi
                                                    </td>
                                                    <td style="vertical-align: top; padding: 1px 4px 2px 4px; border:1px solid #F28F0C; ">
                                                        Rowing (Single Sculls), Canoeing, Mountaineering, Rock Climbing
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="vertical-align: top; padding: 1px 4px 2px 4px; border:1px solid #F28F0C; ">

                                                    </td>
                                                    <td style="vertical-align: top; padding: 1px 4px 2px 4px; border:1px solid #F28F0C; ">
                                                        High Flexibility, High Cardiovascular Endurance, High Speed, Moderate Strength, High Muscular Endurance
                                                    </td>
                                                    <td style="vertical-align: top; padding: 1px 4px 2px 4px; border:1px solid #F28F0C; ">
                                                        Basketball, Ultimate Frisbee
                                                    </td>
                                                    <td style="vertical-align: top; padding: 1px 4px 2px 4px; border:1px solid #F28F0C; ">
                                                        Judo, Taekwondo, Karate, Fencing, Wushu, Archery, Dance Sports
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="vertical-align: top; padding: 1px 4px 2px 4px; border:1px solid #F28F0C; ">

                                                    </td>
                                                    <td style="vertical-align: top; padding: 1px 4px 2px 4px; border:1px solid #F28F0C; ">
                                                        High Flexibility, Moderate Speed, Moderate Strength, High Muscular Endurance, Moderate Cardiovascular Endurance
                                                    </td>
                                                    <td style="vertical-align: top; padding: 1px 4px 2px 4px; border:1px solid #F28F0C; ">
                                                        Gymnastics (Team), Mallakhamb
                                                    </td>
                                                    <td style="vertical-align: top; padding: 1px 4px 2px 4px; border:1px solid #F28F0C; ">
                                                        Diving, Pole Vault, Artistic Gymnastics, Yoga
                                                    </td>
                                                </tr>

                                            </table>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="height: 10px;"></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0; border-collapse: collapse; border:1px solid #00A923; font-size: 12px;">
                                                <tr style="background-color: #00A923; color:#fff; font-size: 13px;">
                                                    <th style="vertical-align: top; padding: 1px 4px 2px 4px; width:14%; border:1px solid #00A923; text-align: left;">
                                                        Descriptor
                                                    </th>
                                                    <th style="vertical-align: top; padding: 1px 4px 2px 4px; width:18%; border:1px solid #00A923; text-align: left;">
                                                        Corresponding Levels
                                                    </th>
                                                    <th style="vertical-align: top; padding: 1px 4px 2px 4px; border:1px solid #00A923; text-align: left;">
                                                        Remarks
                                                    </th>
                                                </tr>
                                                <tr>

                                                    <td style="vertical-align: top; padding: 1px 4px 2px 4px; border:1px solid #00A923;">
                                                        High
                                                    </td>
                                                    <td style="vertical-align: top; padding: 1px 4px 2px 4px; border:1px solid #00A923;">
                                                        L6 and L7
                                                    </td>
                                                    <td style="vertical-align: top; padding: 1px 4px 2px 4px; border:1px solid #00A923;">
                                                        Top 20% of performers — well above average
                                                    </td>
                                                </tr>
                                                <tr>

                                                    <td style="vertical-align: top; padding: 1px 4px 2px 4px; border:1px solid #00A923;">
                                                        Moderate
                                                    </td>
                                                    <td style="vertical-align: top; padding: 1px 4px 2px 4px; border:1px solid #00A923;">
                                                        L4 and L5
                                                    </td>
                                                    <td style="vertical-align: top; padding: 1px 4px 2px 4px; border:1px solid #00A923;">
                                                        Between 60–80 %ile — competent range
                                                    </td>
                                                </tr>
                                                <tr>

                                                    <td style="vertical-align: top; padding: 1px 4px 2px 4px; border:1px solid #00A923;">
                                                        Low
                                                    </td>
                                                    <td style="vertical-align: top; padding: 1px 4px 2px 4px; border:1px solid #00A923;">
                                                        L1 to L3
                                                    </td>
                                                    <td style="vertical-align: top; padding: 1px 4px 2px 4px; border:1px solid #00A923;">
                                                        Used only for identifying gaps or support needs
                                                    </td>
                                                </tr>

                                            </table>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="height: 10px;"></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <table border="0" cellpadding="0" cellspacing="0" style="width: 100%; border: 1px solid #000; font-size: 12px; border-collapse: collapse; color:#333;" class="cell">
                                                <tr style="background-color: #000;">
                                                    <td style="padding: 5px 10px; font-weight: bold; color:#fff; font-size: 13px;" colspan="8">Fitness Benchmarks for 15 years Boy</td>
                                                </tr>
                                                <tr style="font-weight: bold; background-color: #ccc; font-size: 12px; color: #000;">
                                                    <td style="padding:2px 4px; width:40px; border: 1px solid #000;"></td>
                                                    <td style="padding:2px 4px; border: 1px solid #000;">L1&nbsp;(Very Low)</td>
                                                    <td style="padding:2px 4px; border: 1px solid #000;">L2&nbsp;(Low)</td>
                                                    <td style="padding:2px 4px; border: 1px solid #000;">L3&nbsp;(Developing)</td>
                                                    <td style="padding:2px 4px; border: 1px solid #000;">L4&nbsp;(Moderate)</td>
                                                    <td style="padding:2px 4px; border: 1px solid #000;">L5&nbsp;(Good)</td>
                                                    <td style="padding:2px 4px; border: 1px solid #000;">L6&nbsp;(High)</td>
                                                    <td style="padding:2px 4px; border: 1px solid #000;">L7&nbsp;(Excellent)</td>
                                                </tr>
                                                <tr style="background-color: #eee; font-weight: 500;">
                                                    <td style="padding:2px 4px; border: 1px solid #000;"></td>
                                                    <td style="padding:2px 4px; border: 1px solid #000;">&lt; 20 %ile</td>
                                                    <td style="padding:2px 4px; border: 1px solid #000;">&gt; 20 %ile</td>
                                                    <td style="padding:2px 4px; border: 1px solid #000;">&gt; 40 %ile</td>
                                                    <td style="padding:2px 4px; border: 1px solid #000;">&gt; 60 %ile</td>
                                                    <td style="padding:2px 4px; border: 1px solid #000;">&gt; 70 %ile</td>
                                                    <td style="padding:2px 4px; border: 1px solid #000;">&gt; 80 %ile</td>
                                                    <td style="padding:2px 4px; border: 1px solid #000;">&gt; 90 %ile</td>
                                                </tr>
                                                <tr>
                                                    <td style="padding:2px 4px; font-weight: bold; color: #000; border: 1px solid #000;">50 mt Dash</td>
                                                    <td style="padding:2px 4px; border: 1px solid #000;">&lt; 00 m 08 s 900 ms to 00 m 08 s 700 ms</td>
                                                    <td style="padding:2px 4px; border: 1px solid #000;">&lt; 00 m 08 s 700 ms to 00 m 08 s 300 ms</td>
                                                    <td style="padding:2px 4px; border: 1px solid #000;">&lt; 00 m 08 s 300 ms to 00 m 07 s 800 ms</td>
                                                    <td style="padding:2px 4px; border: 1px solid #000;">&lt; 00 m 07 s 800 ms to 00 m 07 s 700 ms</td>
                                                    <td style="padding:2px 4px; border: 1px solid #000;">&lt; 00 m 07 s 700 ms to 00 m 07 s 300 ms</td>
                                                    <td style="padding:2px 4px; border: 1px solid #000;">&lt; 00 m 07 s 300 ms to 00 m 07 s 400 ms</td>
                                                    <td style="padding:2px 4px; border: 1px solid #000;">&lt; 00 m 07 s 400 ms</td>
                                                </tr>
                                                <tr>
                                                    <td style="padding:2px 4px; font-weight: bold; color: #000; border: 1px solid #000;">Partial Curl Up</td>
                                                    <td style="padding:2px 4px; border: 1px solid #000;">&gt; 17 times to 20 times</td>
                                                    <td style="padding:2px 4px; border: 1px solid #000;">&gt; 20 times to 20 times</td>
                                                    <td style="padding:2px 4px; border: 1px solid #000;">&gt; 20 times to 25 times</td>
                                                    <td style="padding:2px 4px; border: 1px solid #000;">&gt; 25 times to 26 times</td>
                                                    <td style="padding:2px 4px; border: 1px solid #000;">&gt; 26 times to 28 times</td>
                                                    <td style="padding:2px 4px; border: 1px solid #000;">&gt; 28 times to 30 times</td>
                                                    <td style="padding:2px 4px; border: 1px solid #000;">&gt; 30 times</td>
                                                </tr>
                                                <tr>
                                                    <td style="padding:2px 4px; font-weight: bold; color: #000; border: 1px solid #000;">Sit and Reach</td>
                                                    <td style="padding:2px 4px; border: 1px solid #000;">&gt; 7.70 cm to 13.70 cm</td>
                                                    <td style="padding:2px 4px; border: 1px solid #000;">&gt; 13.70 cm to 18.30 cm</td>
                                                    <td style="padding:2px 4px; border: 1px solid #000;">&gt; 18.30 cm to 22.40 cm</td>
                                                    <td style="padding:2px 4px; border: 1px solid #000;">&gt; 22.40 cm to 24.60 cm</td>
                                                    <td style="padding:2px 4px; border: 1px solid #000;">&gt; 24.60 cm to 27.20 cm</td>
                                                    <td style="padding:2px 4px; border: 1px solid #000;">&gt; 27.20 cm to 34.00 cm</td>
                                                    <td style="padding:2px 4px; border: 1px solid #000;">&gt; 34.00 cm</td>
                                                </tr>
                                                <tr>
                                                    <td style="padding:2px 4px; font-weight: bold; color: #000; border: 1px solid #000;">Push Ups</td>
                                                    <td style="padding:2px 4px; border: 1px solid #000;">&gt; 13 times to15 times</td>
                                                    <td style="padding:2px 4px; border: 1px solid #000;">&gt; 15 times to 17 times</td>
                                                    <td style="padding:2px 4px; border: 1px solid #000;">&gt; 17 times to 19 times</td>
                                                    <td style="padding:2px 4px; border: 1px solid #000;">&gt; 19 times to 21 times</td>
                                                    <td style="padding:2px 4px; border: 1px solid #000;">&gt; 21 times to 23 times</td>
                                                    <td style="padding:2px 4px; border: 1px solid #000;">&gt; 23 times to 28 times</td>
                                                    <td style="padding:2px 4px; border: 1px solid #000;">&gt; 28 times</td>
                                                </tr>
                                                <tr>
                                                    <td style="padding:2px 4px; font-weight: bold; color: #000; border: 1px solid #000;">600 m Run/Walk</td>
                                                    <td style="padding:2px 4px; border: 1px solid #000;">&lt; 02 m 00 s 0 ms to 01 m 34 s 800 ms</td>
                                                    <td style="padding:2px 4px; border: 1px solid #000;">&lt; 01 m 34 s 800 ms to 01 m 33 s 0 ms</td>
                                                    <td style="padding:2px 4px; border: 1px solid #000;">&lt; 01 m 33 s 0 ms to 01 m 31 s 800 ms</td>
                                                    <td style="padding:2px 4px; border: 1px solid #000;">&lt; 01 m 31 s 800 ms to 01 m 30 s 600 ms</td>
                                                    <td style="padding:2px 4px; border: 1px solid #000;">&lt; 01 m 30 s 600 ms to 01 m 31 s 800 ms</td>
                                                    <td style="padding:2px 4px; border: 1px solid #000;">&lt; 01 m 31 s 800 ms to 01 m 30 s 600 ms</td>
                                                    <td style="padding:2px 4px; border: 1px solid #000;">&lt; 01 m 30 s 600 ms</td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="height: 10px;"></td>
                                    </tr>
                                   
                                    <tr>
                                        <td>
                                            <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
                                                <tr>
                                                    <td style="padding: 1px 4px 2px 4px; font-weight: bold; color:#fff; background-color:#000; font-size: 13px;">BMI Benchmarks for <span>15</span> years <span>Boy</span></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <table border="0" cellpadding="0" cellspacing="0" style="width: 100%; border: 1px solid #000; font-size: 12px; border-collapse: collapse; color:#333;">
                                                            <tr style="font-weight: bold; background-color: #eee; font-size: 12px; color: #000; text-align: center;">
                                                                <th style="padding:0px 4px 2px 4px; width: 10%;">UW</th>
                                                                <th style="padding:0px 4px 2px 4px; width: 10%;">N</th>
                                                                <th style="padding:0px 4px 2px 4px; width: 10%;">OW</th>
                                                                <th style="padding:0px 4px 2px 4px; width: 10%;">OB</th>
                                                                <th style="padding:0px 4px 2px 4px;"></th>
                                                            </tr>
                                                           
                                                            <tr style="text-align: center; border-top: 1px solid #000;">
                                                                <td style="padding:0px 4px 2px 4px;"> &lt;15.7 </td>
                                                                <td style="padding:0px 4px 2px 4px;"> &lt;17.5</td>
                                                                <td style="padding:0px 4px 2px 4px;"> &lt;19.7</td>
                                                                <td style="padding:0px 4px 2px 4px;"> &gt;19.7</td>
                                                                <td style="padding:0px 4px 2px 4px;"></td>
                                                            </tr>
                                                    </table>
                                                    </td>
                                                </tr>
                                               <tr>
                                                    <td><p style="font-size:12px; margin:5px 0 0 0;"><span style="font-weight:600;">Recommendation: </span>You can reduce your weight by <span style="font-weight:600;">4.48</span> Kg by improving your lifestyle and increasing regular physical activity.</p></td>
                                                </tr>
                                            </table>
                                           
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="height: 16px;"></td>
                                    </tr>

                                </table>
                </td>
            </tr>
            
            <!-- Inner page Footer Area (Page 3) -->
            <tr>
                <td>
                    <table cellpadding="0" cellspacing="0" style="width:100%;">
                        <tr>
                            <td style="width: 100%; text-align: right;">
                                <table cellpadding="0" cellspacing="0" style="border: 0px; width: 100%;">
                                    <tr>
                                        <td style="height: 40px;"></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:left; padding: 0px 0px 0px 30px;">
                                            <div style="float:left; text-align:center; position:relative;">
                                                <p style="color:#666; font-size:10px; position:absolute; top:-17px; width:100%; text-align:center;">Powered by</p>
                                                <img src="{{ asset('public/assets/reports/fitness365-logo-web.png')}}" alt="fitness365 logo" style="height:28px;">
                                            </div>
                                        </td>
                                        <td>
                                            <div style="padding: 4px 0; text-align: right; font-weight: 400; font-size: 13px; color:#666;"><span style="margin-left: 60px;">Physical Health and Fitness Assessment</span></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="height: 10px;"></td>
                                    </tr>
                                </table>
                            </td>
                            <td style="width: 94px;">
                                <div style="float: right; position: relative; width: 80px;">
                                    <!-- <span style="position: absolute; right: 50%; top:50%; transform: translate(-50%, 0); color: #000; z-index: 5; display: inline-block; padding: 6px 0 0 20px; font-size: 13px; font-weight: 600;">3</span> -->
                                    <img src="{{ asset('public/assets/reports/footer-bg2.png')}}" alt="" style="width: inherit;">
                                </div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
    </table>

    <!-- Page 4 -->
    <table border="0" cellpadding="0" cellspacing="0" style="page-break-before: always;">
        <tr>
            <td>
                <!-- Inner page Header Area (Page 4) -->
                <table border="0" cellpadding="0" cellspacing="0" style="width: 100%; border-collapse: collapse; font-family: Roboto Condensed, sans-serif; font-size: 12px; border:0px solid transparent;">
                    <tr>
                        <td style="vertical-align: top; height: 100px;">
                            <table cellpadding="0" cellspacing="0" style="width: 100%; border:0;">
                                <tr>
                                    <td style="width:300px;">
                                        <div style="margin-left: 30px; margin-top: 30px;">School Logo</div>
                                    </td>
                                    <td rowspan="2" style="position: relative; vertical-align: top; width: auto; text-align: right;">
                                        <div style="position: absolute; top: 30px; right:30px; display: flex; align-items: center; z-index: 1; width: 90px; overflow: hidden;">
                                                <img src="{{ asset('public/assets/reports/seqfast-logo.png')}}" alt="" style="width: inherit;">
                                        </div>
                                        <img src="{{ asset('public/assets/reports/inner-header-bg.png')}}" alt="" style="width: 450px; height:auto; position: relative; right:0px; top:0;">
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <!-- Inner page Content (Page 4) -->
                 <table border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td>
                                    <table cellpadding="0" cellspacing="0" style="width: 94%; border: 0; border-collapse: collapse; margin: auto; color: #333; font-size: 12px;">
                                        <tr>
                                            <td style="border: 1px solid #00A923; padding: 5px 10px 8px 10px; background:#F2FFF5;">
                                        <h3 style="color: #00A923; margin-bottom: 0px; font-size: 18px;">WHO Guidelines on Physical Activity and Sedentary Behaviour 2020</h3>
                                                <h4 style="color: #000; margin-bottom: 3px; font-size: 16px">Age Appropriate Fitness Protocols and Guidelines for age 5-18 years</h4>
                                                <p style="line-height: 14px;">At least an average of 60 minutes per day of moderate-to-vigorous intensity physical activity, across the week; most of this physical activity should be aerobic.</p>
                                                <p style="line-height: 14px;">Vigorous-intensity aerobic activities, as well as those that strengthen muscle and bone should be incorporated at least 3 days a week.</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="height: 15px;"></td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0; border-collapse: collapse;">
                                                    <tr>
                                                        <td colspan="2">
                                                            <h3 style="color: #000; font-size: 16px; margin-bottom: 5px;">Recommends the following activities for improving fitness for ages 9-14 (Class 4-8)</h3>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width: 50%; padding-right: 30px;">
                                                            <h4 style="color: #000; margin-bottom: 3px; font-size: 13px;">1. Endurance-related Activities</h4>
                                                            <p>Spot Running, Climbing Stairs, Walking on Toes, Swimming, Jumping Jacks, March and Swing Your Arms</p>
                                                        </td>
                                                        <td style="width: 50%;">
                                                            <h4 style="color: #000; margin-bottom: 3px; font-size: 13px;">2. Strength Related Activities</h4>
                                                            <p>Straight Leg Raises, Push-ups on the Wall, Long Jump, Goal Keeping</p>
                                                        </td>

                                                    </tr>
                                                    <tr>
                                                        <td style="height: 10px;"></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width: 50%; padding-right: 30px;">
                                                            <h4 style="color: #000; margin-bottom: 3px; font-size: 13px;">3. Flexibility-related Activities</h4>
                                                            <p>Calf Stretch, Child's Pose, Knee to Chest, Bend Down</p>
                                                        </td>
                                                        <td style="width: 50%;">
                                                            <h4 style="color: #000; margin-bottom: 3px; font-size: 13px;">4. Balance related Activities</h4>
                                                            <p>Single Leg Stance, Leg Swings, Walking on Lines of Different Shapes</p>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td style="height: 15px;"></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0; border-collapse: collapse;">
                                                    <tr>
                                                        <td colspan="2">
                                                            <h3 style="color: #000; font-size: 16px; margin-bottom: 10px;">Recommends the following additional activities for improving fitness for for ages 15-18 (Class 9-12)</h3>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding-right: 30px;">
                                                            <h4 style="color: #000; margin-bottom: 3px; font-size: 13px;">1. Endurance-related Activities</h4>
                                                            <p>400/800 m Race, Brisk Walking, Quick Air Punches, 4x 100 / 200 / 400 m Relay Race, Swimming, Walking Lunges</p>
                                                        </td>
                                                        <td>
                                                            <h4 style="color: #000; margin-bottom: 3px; font-size: 13px;">2. Strength related Activities</h4>
                                                            <p>Curl Up (Core Strength), Plank (Core Strength), Push Ups (Upper Body Strength), Squat (Lower Body Strength)s</p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="height: 15px;"></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2">
                                                            <h4 style="color: #000; margin-bottom: 3px; font-size: 13px;">3. Flexibility-related Activities</h4>
                                                            <p>Forward Bend</p>
                                                        </td>

                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td style="height: 15px;"></td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <h2 style="font-size: 24px; color:#0A87CD; font-size: 18px; font-weight: 600; text-align: center;">EXERCISE AND PHYSICAL ACTIVITY</h2>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="font-size: 18px; color:#000; font-size: 16px; font-weight: 500; text-align: center;">
                                                <p>* Energy expenditure on various physical activities (Kcal/Hr)</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="height: 10px;"></td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <table  border="0" cellpadding="0" cellspacing="0" style="width:100%;">
                                                    <tr>
                                                        <td style="vertical-align: top; width:80%;">

                                                            <table cellpadding="0" cellspacing="0" style="width: 100%;">
                                                                <tr>
                                                                    <td>
                                                                        <table cellpadding="0" cellspacing="0" style="width:100%">
                                                                            <tr>
                                                                                <td style="vertical-align: top; padding-right:10px;">
                                                                                    <table class="act-tbl col-3" border="1" cellpadding="0" cellspacing="0"
                                                                                                    style="border: 1px solid #0A87CD; font-size: 12px; border-collapse: collapse; color:#333;">
                                                                                                    <tr style="background-color: #0A87CD;">
                                                                                                        <td style="background-color:#0A87CD; padding: 1px 4px 2px 4px; border: 1px solid #0A87CD; color:#fff; font-weight: bold;"
                                                                                                            colspan="2">Activity</td>
                                                                                                        <td
                                                                                                            style="padding: 1px 4px 2px 4px; border: 1px solid #0A87CD; color:#fff; text-align: right; font-weight: bold;">
                                                                                                            Kcal/hr</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td
                                                                                                            style="font-weight: 500; color:#000; text-align: left; padding: 1px 4px 2px 4px;">
                                                                                                            Sleeping</td>
                                                                                                        <td
                                                                                                            style="text-align: right; padding: 1px 4px 2px 4px; border-right:1px solid #0A87CD;">
                                                                                                        </td>
                                                                                                        <td
                                                                                                            style="text-align: right; padding: 1px 4px 2px 4px; border-bottom:1px solid transparent;">
                                                                                                            44</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td
                                                                                                            style="font-weight: 500; color:#000; text-align: left; padding: 1px 4px 2px 4px;">
                                                                                                            Sitting</td>
                                                                                                        <td
                                                                                                            style="text-align: right; padding: 1px 4px 2px 4px; border-right:1px solid #0A87CD;">
                                                                                                        </td>
                                                                                                        <td
                                                                                                            style="text-align: right; padding: 1px 4px 2px 4px; border-bottom:1px solid transparent;">
                                                                                                            57</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td
                                                                                                            style="font-weight: 500; color:#000; text-align: left; padding: 1px 4px 2px 4px;">
                                                                                                            Standing</td>
                                                                                                        <td
                                                                                                            style="text-align: right; padding: 1px 4px 2px 4px; border-right:1px solid #0A87CD;">
                                                                                                        </td>
                                                                                                        <td
                                                                                                            style="text-align: right; padding: 1px 4px 2px 4px; border-bottom:1px solid transparent;">
                                                                                                            63</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td
                                                                                                            style="font-weight: 500; color:#000; text-align: left; padding: 1px 4px 2px 4px;">
                                                                                                            Walking</td>
                                                                                                        <td
                                                                                                            style="text-align: right; padding: 1px 4px 2px 4px; border-right:1px solid #0A87CD;">
                                                                                                            6.43 km/hr</td>
                                                                                                        <td
                                                                                                            style="text-align: right; padding: 1px 4px 2px 4px; border-bottom:1px solid transparent;">
                                                                                                            227</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td
                                                                                                            style="font-weight: 500; color:#000; text-align: left; padding: 1px 4px 2px 4px;">
                                                                                                            Climbing Stairs</td>
                                                                                                        <td
                                                                                                            style="text-align: right; padding: 1px 4px 2px 4px; border-right:1px solid #0A87CD;">
                                                                                                        </td>
                                                                                                        <td
                                                                                                            style="text-align: right; padding: 1px 4px 2px 4px; border-bottom:1px solid transparent;">
                                                                                                            485</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td
                                                                                                            style="font-weight: 500; color:#000; text-align: left; padding: 1px 4px 2px 4px;">
                                                                                                            Housecleaning</td>
                                                                                                        <td
                                                                                                            style="text-align: right; padding: 1px 4px 2px 4px; border-right:1px solid #0A87CD;">
                                                                                                        </td>
                                                                                                        <td
                                                                                                            style="text-align: right; padding: 1px 4px 2px 4px; border-bottom:1px solid transparent;">
                                                                                                            176</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td
                                                                                                            style="font-weight: 500; color:#000; text-align: left; padding: 1px 4px 2px 4px;">
                                                                                                            Gardening</td>
                                                                                                        <td
                                                                                                            style="text-align: right; padding: 1px 4px 2px 4px; border-right:1px solid #0A87CD;">
                                                                                                        </td>
                                                                                                        <td style="text-align: right; padding: 1px 4px 2px 4px;">227</td>
                                                                                                    </tr>
                                                                                    </table>
                                                                                    </td>
                                                                                <td style="vertical-align: top; padding-right:10px;">
                                                                                    <table class="act-tbl col-3" border="1" cellpadding="0" cellspacing="0"
                                                                                                    style="border: 1px solid #0A87CD; font-size: 12px; border-collapse: collapse; color:#333;">
                                                                                                    <tr style="background-color: #0A87CD;">
                                                                                                        <td style="background-color:#0A87CD; padding: 1px 4px 2px 4px; border: 1px solid #0A87CD; color:#fff; font-weight: bold;"
                                                                                                            colspan="2">Activity</td>
                                                                                                        <td
                                                                                                            style="padding: 1px 4px 2px 4px; border: 1px solid #0A87CD; color:#fff; text-align: right; font-weight: bold;">
                                                                                                            Kcal/hr</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td
                                                                                                            style="font-weight: 500; color:#000; text-align: left; padding: 1px 4px 2px 4px;">
                                                                                                            Cycling</td>
                                                                                                        <td
                                                                                                            style="text-align: right; padding: 1px 4px 2px 4px; border-right:1px solid #0A87CD;">City cycling
                                                                                                        </td>
                                                                                                        <td
                                                                                                            style="text-align: right; padding: 1px 4px 2px 4px; border-bottom:1px solid transparent;">
                                                                                                            302</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td
                                                                                                            style="font-weight: 500; color:#000; text-align: left; padding: 1px 4px 2px 4px;">
                                                                                                            </td>
                                                                                                        <td
                                                                                                            style="text-align: right; padding: 1px 4px 2px 4px; border-right:1px solid #0A87CD;">16.1 km/hr
                                                                                                        </td>
                                                                                                        <td
                                                                                                            style="text-align: right; padding: 1px 4px 2px 4px; border-bottom:1px solid transparent;">
                                                                                                        391</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td
                                                                                                            style="font-weight: 500; color:#000; text-align: left; padding: 1px 4px 2px 4px;">
                                                                                                            </td>
                                                                                                        <td
                                                                                                            style="text-align: right; padding: 1px 4px 2px 4px; border-right:1px solid #0A87CD;">22.53 km/hr
                                                                                                        </td>
                                                                                                        <td
                                                                                                            style="text-align: right; padding: 1px 4px 2px 4px; border-bottom:1px solid transparent;">
                                                                                                            567</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td
                                                                                                            style="font-weight: 500; color:#000; text-align: left; padding: 1px 4px 2px 4px;">
                                                                                                            </td>
                                                                                                        <td
                                                                                                            style="text-align: right; padding: 1px 4px 2px 4px; border-right:1px solid #0A87CD;">
                                                                                                            32.18 km/hr</td>
                                                                                                        <td
                                                                                                            style="text-align: right; padding: 1px 4px 2px 4px; border-bottom:1px solid transparent;">
                                                                                                            932</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td
                                                                                                            style="font-weight: 500; color:#000; text-align: left; padding: 1px 4px 2px 4px;">
                                                                                                            Running</td>
                                                                                                        <td
                                                                                                            style="text-align: right; padding: 1px 4px 2px 4px; border-right:1px solid #0A87CD;">8 km/hr
                                                                                                        </td>
                                                                                                        <td
                                                                                                            style="text-align: right; padding: 1px 4px 2px 4px; border-bottom:1px solid transparent;">
                                                                                                            523</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td
                                                                                                            style="font-weight: 500; color:#000; text-align: left; padding: 1px 4px 2px 4px;">
                                                                                                            </td>
                                                                                                        <td
                                                                                                            style="text-align: right; padding: 1px 4px 2px 4px; border-right:1px solid #0A87CD;">10 km/hr
                                                                                                        </td>
                                                                                                        <td
                                                                                                            style="text-align: right; padding: 1px 4px 2px 4px; border-bottom:1px solid transparent;">
                                                                                                            617</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td
                                                                                                            style="font-weight: 500; color:#000; text-align: left; padding: 1px 4px 2px 4px;">
                                                                                                            Garening</td>
                                                                                                        <td
                                                                                                            style="text-align: right; padding: 1px 4px 2px 4px; border-right:1px solid #0A87CD;">13 km/hr
                                                                                                        </td>
                                                                                                        <td style="text-align: right; padding: 1px 4px 2px 4px;">743</td>
                                                                                                    </tr>
                                                                                    </table>
                                                                                    </td>
                                                                                <td style="vertical-align: top; padding-right:10px;">
                                                                                    <table class="act-tbl col-2" border="1" cellpadding="0" cellspacing="0"
                                                                                                    style="border: 1px solid #0A87CD; font-size: 12px; border-collapse: collapse; color:#333; width:100%;">
                                                                                                    <tr style="background-color: #0A87CD;">
                                                                                                        <td style="background-color:#0A87CD; padding: 1px 4px 2px 4px; border: 1px solid #0A87CD; color:#fff; font-weight: bold;"
                                                                                                            >Activity</td>
                                                                                                        <td
                                                                                                            style="padding: 1px 4px 2px 4px; border: 1px solid #0A87CD; color:#fff; text-align: right; font-weight: bold;">
                                                                                                            Kcal/hr</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td
                                                                                                            style="font-weight: 500; color:#000; text-align: left; padding: 1px 4px 2px 4px; border-right:1px solid #0A87CD;">
                                                                                                            Billiards/ snooker</td>
                                                                                                        
                                                                                                        <td
                                                                                                            style="text-align: right; padding: 1px 4px 2px 4px; border-bottom:1px solid transparent;">
                                                                                                            44</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td
                                                                                                            style="font-weight: 500; color:#000; text-align: left; padding: 1px 4px 2px 4px; border-right:1px solid #0A87CD;">
                                                                                                            Roller skating</td>
                                                                                                        <td
                                                                                                            style="text-align: right; padding: 1px 4px 2px 4px; border-bottom:1px solid transparent;">
                                                                                                            57</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td
                                                                                                            style="font-weight: 500; color:#000; text-align: left; padding: 1px 4px 2px 4px; border-right:1px solid #0A87CD;">
                                                                                                            Swimming</td>
                                                                                                        <td
                                                                                                            style="text-align: right; padding: 1px 4px 2px 4px; border-bottom:1px solid transparent;">
                                                                                                            63</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td
                                                                                                            style="font-weight: 500; color:#000; text-align: left; padding: 1px 4px 2px 4px; border-right:1px solid #0A87CD;">
                                                                                                            Horseback riding</td>
                                                                                                        
                                                                                                        <td
                                                                                                            style="text-align: right; padding: 1px 4px 2px 4px; border-bottom:1px solid transparent;">
                                                                                                            227</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td
                                                                                                            style="font-weight: 500; color:#000; text-align: left; padding: 1px 4px 2px 4px; border-right:1px solid #0A87CD;">
                                                                                                            Squash</td>
                                                                                                        <td
                                                                                                            style="text-align: right; padding: 1px 4px 2px 4px; border-bottom:1px solid transparent;">
                                                                                                            485</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td
                                                                                                            style="font-weight: 500; color:#000; text-align: left; padding: 1px 4px 2px 4px; border-right:1px solid #0A87CD;">
                                                                                                            Badminton</td>
                                                                                                        <td
                                                                                                            style="text-align: right; padding: 1px 4px 2px 4px; border-bottom:1px solid transparent;">
                                                                                                            176</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td
                                                                                                            style="font-weight: 500; color:#000; text-align: left; padding: 1px 4px 2px 4px; border-right:1px solid #0A87CD;">
                                                                                                            Table tennis</td>
                                                                                                                <td style="text-align: right; padding: 1px 4px 2px 4px;">227</td>
                                                                                                    </tr>
                                                                                    </table>
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="font-size: 12px; padding-top: 4px; padding-right: 6px; line-height: 12px;">
                                                                        *Approx.energy expenditure for 60 Kg reference man. Individuals with higher body weight will
                                                                        be spending more calories than those with lower body weight. Reference woman (50 kg) will be spending 5%
                                                                        less calories.
                                                                    </td>
                                                                </tr>
                                                            </table>

                                                        </td>

                                                        <td style="vertical-align: top; width:20%;">
                                                                <table border="1" cellpadding="0" cellspacing="0" class="act-tbl col-2"
                                                                    style="border: 1px solid #0A87CD; font-size: 12px; border-collapse: collapse; color:#333;">
                                                                    <tr style="background-color: #0A87CD;">
                                                                        <td
                                                                            style="width: 100%; background-color:#0A87CD; padding: 1px 4px 2px 4px; border: 1px solid #0A87CD; color:#fff; font-weight: bold;">
                                                                            Activity</td>
                                                                        <td
                                                                            style="font-weight: 500; padding: 1px 4px 2px 4px; border: 1px solid #0A87CD; color:#fff; text-align: right; font-weight: bold;">
                                                                            Kcal/hr</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="font-weight: 500; color:#000; text-align: left; padding: 1px 4px 2px 4px; ">Tennis</td>
                                                                        <td
                                                                            style="font-weight: 500; text-align: right; padding: 1px 4px 2px 4px;">
                                                                            353</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="font-weight: 500; color:#000; text-align: left; padding: 1px 4px 2px 4px;">Volleyball
                                                                        </td>
                                                                        <td
                                                                            style="font-weight: 500; text-align: right; padding: 1px 4px 2px 4px;">
                                                                            252</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="font-weight: 500; color:#000; text-align: left; padding: 1px 4px 2px 4px;">Football</td>
                                                                        <td
                                                                            style="font-weight: 500; text-align: right; padding: 1px 4px 2px 4px;">
                                                                            441</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="font-weight: 500; color:#000; text-align: left; padding: 1px 4px 2px 4px;">Basketball
                                                                        </td>
                                                                        <td
                                                                            style="font-weight: 500; text-align: right; padding: 1px 4px 2px 4px;">
                                                                            403</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="font-weight: 500; color:#000; text-align: left; padding: 1px 4px 2px 4px;">Dancing</td>
                                                                        <td
                                                                            style="font-weight: 500; text-align: right; padding: 1px 4px 2px 4px;">
                                                                            302</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="font-weight: 500; color:#000; text-align: left; padding: 1px 4px 2px 4px;">Gymnastic</td>
                                                                        <td
                                                                            style="font-weight: 500; text-align: right; padding: 1px 4px 2px 4px;">
                                                                            202</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="font-weight: 500; color:#000; text-align: left; padding: 1px 4px 2px 4px;">Yoga</td>
                                                                        <td style="font-weight: 500; text-align: right; padding: 1px 4px 2px 4px;">195</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="font-weight: 500; color:#000; text-align: left; padding: 1px 4px 2px 4px;">HIIT Workout
                                                                        </td>
                                                                        <td style="font-weight: 500; text-align: right; padding: 1px 4px 2px 4px;">504</td>
                                                                    </tr>
                                                                </table>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                </table>
            </td>
        </tr>
        <!-- Inner page Footer Area (Page 4) -->
        <tr>
             <td style="height: 20px;"></td>
        </tr>
        <tr>
            <td>
                <table border="0" cellpadding="0" cellspacing="0" style="width: 94%; border: 1px solid #F28F0C; font-size: 14px; border-collapse: collapse; color:#333; margin:auto;">
                    <tr>
                        <td style="font-weight: 600; padding: 10px 15px; font-size: 14px; color: #000; height:70px; vertical-align:top;">PE Teacher's Observations and Comments (if any)</td>
                        <td style="font-weight: 600; padding: 10px 15px; font-size: 14px; color: #000; text-align:center; height:70px; vertical-align:bottom; border-left:1px solid orange;">Teacher's Signature</td>
                    </tr>                      
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table border="0" cellpadding="0" cellspacing="0" style="width: 100%; font-size: 14px; border-collapse: collapse; color:#000;">
                    <tr>
                        <td style="border: 1px solid transparent; width:50%;">
                            <div style="padding: 10px 0px; height: 60px; background-color: #fff; border-right: 3px solid #fff;"></div>
                                 <p style="text-align: center; font-weight: 600;">Parent's Signature</p>
                        </td>
                        <td style="border: 1px solid transparent; width:50%;">
                            <div style="padding: 10px 0px; height: 60px; background-color: #fff; border-left: 3px solid #fff;"></div>
                                <p style="text-align: center; font-weight: 600;">Signature of Principal with Stamp</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="height:24px;"></td>
        </tr>
        <tr>
            <td>
                <table cellpadding="0" cellspacing="0" style="width: 100%; border:0; font-size:13px;">
                    <tr>
                        <td style="background-color: #E60A00; height: 40px; padding: 0 30px; color:#fff;">CISCE Physical Health and Fitness Assessment</td>
                        <td style="background-color: #00A923; height: 40px; width: 30%; padding: 0 30px; text-align:right; color:#fff;">powered by <strong>fitness365.me</strong></td>
                    </tr>
                </table>
             </td>
        </tr>
    </table>

</body>

</html>