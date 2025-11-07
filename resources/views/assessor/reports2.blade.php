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
        }

        page[size="A4"] {
            width: 21cm;
            height: 29.7cm;
            margin: 0;
        }
    </style>
</head>

<body>
    <table cellpadding="0" cellspacing="0" style="width: 21cm; border-collapse: collapse; margin-left: auto; margin-right: auto; font-family: Roboto Condensed, sans-serif; font-size: 12px; border: 0px;">
        <!-- Cover Page -->
        <tr>
            <td>
                <table cellpadding="0" cellspacing="0" style="width: 100%; border-collapse: collapse; font-family: Roboto Condensed, sans-serif; font-size: 12px; border: 0;">
                    <tr style="background-color: #fecd0a; height: 140px; ">
                        <td style="vertical-align: top;">
                            <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0px; height: 100%;">
                                <tr>
                                    <td style="width:180px;"></td>
                                    <td style="position: relative; vertical-align: top; width: 200px; height: 100%;">
                                        <img src="{{ asset('/public/assets/reports/green-dot.jpg')}}" alt="" style="width: 50px; height:50px; position: relative; left:-50px; top:0;">
                                        <div style="position: absolute; top: 0; display: flex; align-items: flex-start; z-index: 10; width: 200px; overflow: hidden;">
                                            <div class="logo" style="position: relative; width: 180px;">
                                                <span style="position: absolute; top:0; left:0; width: inherit; padding: 10px; box-sizing: border-box;">
                                                    <img src="{{ asset('/public/assets/reports/cisce-logo.png')}}" alt="" style="width: inherit; margin-top: 20px;">
                                                </span>
                                                <img src="{{ asset('/public/assets/reports/logo-bg.jpg')}}" alt="" style="width: 200px; margin-top: -50px;">
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div style="margin-left: 30px; margin-right: 50px; margin-top: 40px; font-weight: 600; font-size: 24px;">Council for the Indian School Certificate Examinations</div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="border-collapse: collapse;">
                            <div style="width: 86%; position: relative; border-collapse: collapse;">
                                <img src="{{ asset('/public/assets/reports/report-graphic.png')}}" alt="" style="position: absolute; top:25%; right:-55px; width: 200px; border-collapse: collapse;">
                                <img src="{{ asset('/public/assets/reports/report-cover-img.png')}}" alt="" style="width: inherit;">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0;">
                                <tr>
                                    <td style="background-color:#f28f18;">
                                        <img src="{{ asset('/public/assets/reports/aa-bg.jpg')}}" alt="" style="width:188px;">
                                    </td>
                                    <td style="vertical-align: top; width: 100%;">
                                        <table cellpadding="0" cellspacing="0" style="width: 90%; border: 0;">
                                            <tr>
                                                <td style="height: 50px;"></td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 10px 30px 10px 50px; font-size: 20px; background:#1c9b3e; color:#fff; font-size: 24px; font-weight: 500; position:relative;">Physical Health and Fitness Assessment<span style=" position:absolute; top:46px; right:-20px;"><img src="{{ asset('/public/assets/reports/yellow-bg.jpg')}}" alt="" style="width:20px;"></span></td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 40px 30px 10px 50px; font-size: 24px; font-weight: 500;">Personal Profile</td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 10px 30px 10px 50px; font-size: 16px; color: #333;">
                                                    <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0px">
                                                        <tr>
                                                            <td colspan="2" style="padding: 15px 0;">
                                                                <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0px">
                                                                    <tr>
                                                                        <td><span style="display: inline-block; margin-right: 5px;">Name</span></td>
                                                                        <td style="border-bottom: 1px solid #ccc; width: 100%;"></td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 15px 0;">
                                                                <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0px;">
                                                                    <tr>
                                                                        <td><span style="display: inline-block; margin-right: 5px;">Class&nbsp;&&nbsp;Section</span></td>
                                                                        <td style="border-bottom: 1px solid #ccc; width: 100%;"></td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                            <td style="padding: 15px 0;">
                                                                <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0px">
                                                                    <tr>
                                                                        <td><span style="display: inline-block; margin-right: 5px; margin-left: 5px;">Roll&nbsp;No.</span></td>
                                                                        <td style="border-bottom: 1px solid #ccc; width: 100%;"></td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2" style="padding: 15px 0;">
                                                                <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0px">
                                                                    <tr>
                                                                        <td><span style="display: inline-block; margin-right: 5px;">School</span></td>
                                                                        <td style="border-bottom: 1px solid #ccc; width: 100%;"></td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 15px 0;">
                                                                <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0px">
                                                                    <tr>
                                                                        <td><span style="display: inline-block; margin-right: 5px;">Code</span></td>
                                                                        <td style="border-bottom: 1px solid #ccc; width: 100%;"></td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                            <td style="padding: 15px 0;">
                                                                <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0px">
                                                                    <tr>
                                                                        <td><span style="display: inline-block; margin-right: 5px; margin-left: 5px;">APAAR&nbsp;ID</span></td>
                                                                        <td style="border-bottom: 1px solid #ccc; width: 100%;"></td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2" style="padding: 15px 0;">
                                                                <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0px">
                                                                    <tr>
                                                                        <td><span style="display: inline-block; margin-right: 5px;">CISCE&nbsp;Registration&nbsp;No</span></td>
                                                                        <td style="border-bottom: 1px solid #ccc; width: 100%;"></td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 15px 0;">
                                                                <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0px">
                                                                    <tr>
                                                                        <td><span style="display: inline-block; margin-right: 5px;">DOB</span></td>
                                                                        <td style="border-bottom: 1px solid #ccc; width: 100%;"></td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                            <td style="padding: 15px 0;">
                                                                <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0px">
                                                                    <tr>
                                                                        <td><span style="display: inline-block; margin-right: 5px; margin-left: 5px;">Blood&nbsp;Group</span></td>
                                                                        <td style="border-bottom: 1px solid #ccc; width: 100%;"></td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                            </tr>
                                        </table>
                                    </td>

                                </tr>
                                <tr>
                                    <td style="background-color: #1c9b3e; height: 30px;"></td>
                                    <td style="background-color: #fecd0a; height: 30px;"></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <!-- Page 2 -->
        <tr>
            <td>
                <table border="1" cellpadding="0" cellspacing="0" style="width: 100%; border-collapse: collapse; font-family: Roboto Condensed, sans-serif; font-size: 12px; border:0px solid transparent;">
                    <!-- Inner page Header Area (Page 2) -->
                    <tr style="height: 110px;">
                        <td style="vertical-align: top;">
                            <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0px; height: 100%; border:0;">
                                <tr>
                                    <td style="width:300px;">
                                        <div style="margin-left: 40px; margin-top: 30px;">
                                            School Logo
                                        </div>
                                    </td>
                                    <td rowspan="2" style="position: relative; vertical-align: top; width: auto; height: 100%;">
                                        <div style="position: absolute; top: 30px; right:30px; display: flex; align-items: center; z-index: 1; width: 90px; overflow: hidden;">
                                            <img src="{{ asset('/public/assets/reports/cisce-logo.png')}}" alt="" style="width: inherit;">
                                        </div>
                                        <img src="{{ asset('/public/assets/reports/inner-header-bg.png')}}" alt="" style="width: 550px; height:auto; position: relative; right:0px; top:0;">
                                    </td>

                                </tr>
                            </table>
                        </td>

                    </tr>
                    <!-- Inner page Content (Page 2) -->
                    <tr>
                        <td>
                            <table cellpadding="0" cellspacing="0" style="width: 94%; border: 0; border-collapse: collapse; margin: auto;">
                                <tr>
                                    <td style="border-bottom: 3px solid #000;">
                                        <div style="background: #000; float:left; display: inline-flex; align-items: center; color: #fff; font-size: 22px; font-weight: 600;">
                                            <div style="float: left; padding: 1px 0px 0px 10px;">Development Skills Class 1 to 3</div>
                                            <div style="float:left; transform: skew(30deg,0deg); display:inline-block; width: 50px; height: 38px; background: #000; position: relative; right: -15px;"></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="height: 15px;"></td>
                                </tr>
                                <tr>
                                    <td style="padding: 6px 10px 6px 10px; font-size: 20px; background:#1c9b3e; color:#fff; font-size: 18px; font-weight: 600;">LOCOMOTOR SKILLS</td>
                                </tr>
                                <tr>
                                    <td style="height: 15px;"></td>
                                </tr>

                                <tr>
                                    <td>
                                        <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0; border-collapse: collapse;">
                                            <tr>
                                                <td style="vertical-align: top;">
                                                    <table border="1" cellpadding="0" cellspacing="0" style="width: 100%; border: 1px solid orange; font-size: 12px; border-collapse: collapse; color:#333;">
                                                        <tr style="background-color: #fecd0a;">
                                                            <td style="font-weight: 500; width: 70%; background-color: orange; padding: 5px 4px 5px 6px; border: 1px solid orange; color:#000;">P-01</td>
                                                            <td style="font-weight: 500; padding: 5px 4px 5px 6px; border: 1px solid orange; color:#000;">RUNNING</td>
                                                            <td style="font-weight: 500; background-color: orange; padding: 5px 4px 5px 6px; border: 1px solid orange; color:#000;">TERM I</td>
                                                            <td style="font-weight: 500; padding: 5px 4px 5px 6px; border: 1px solid orange; color:#000;">TERM II</td>
                                                        </tr>

                                                        <tr>
                                                            <td colspan="2" style="padding: 5px 4px 5px 6px;">Non-hopping leg supports the take-off and momentum of the hop</td>
                                                            <td style="padding: 5px 4px 5px 6px;"></td>
                                                            <td style="padding: 5px 4px 5px 6px;"></td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2" style="padding: 5px 4px 5px 6px;">Head and trunk are still, looks straight ahead while running</td>
                                                            <td style="padding: 5px 4px 5px 6px;"></td>
                                                            <td style="padding: 5px 4px 5px 6px;"></td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2" style="padding: 5px 4px 5px 6px;">Both feet are off the ground for a short period of time, between steps</td>
                                                            <td style="padding: 5px 4px 5px 6px;"></td>
                                                            <td style="padding: 5px 4px 5px 6px;"></td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2" style="padding: 5px 4px 5px 6px;">Arm move in alternate direction to legs</td>
                                                            <td style="padding: 5px 4px 5px 6px;"></td>
                                                            <td style="padding: 5px 4px 5px 6px;"></td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2" style="padding: 5px 4px 5px 6px;">Foot placement in a straight line</td>
                                                            <td style="padding: 5px 4px 5px 6px;"></td>
                                                            <td style="padding: 5px 4px 5px 6px;"></td>
                                                        </tr>

                                                    </table>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td style="height: 10px;"></td>
                                            </tr>

                                        </table>
                                    </td>

                                </tr>

                                <tr>
                                    <td>
                                        <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0;">
                                            <tr>
                                                <td style="vertical-align: top;">
                                                    <table border="1" cellpadding="0" cellspacing="0" style="width: 100%; border: 1px solid orange; font-size: 12px; border-collapse: collapse; collapse; color:#333;">
                                                        <tr style="background-color: #fecd0a;">
                                                            <td style="font-weight: 500; width: 70%; background-color: orange; padding: 5px 4px 5px 6px; border: 1px solid orange; color:#000;">P-02</td>
                                                            <td style="font-weight: 500; padding: 5px 4px 5px 6px; border: 1px solid orange; color:#000;">RUNNING</td>
                                                            <td style="font-weight: 500; background-color: orange; padding: 5px 4px 5px 6px; border: 1px solid orange; color:#000;">TERM I</td>
                                                            <td style="font-weight: 500; padding: 5px 4px 5px 6px; border: 1px solid orange; color:#000;">TERM II</td>
                                                        </tr>

                                                        <tr>
                                                            <td colspan="2" style="padding: 5px 4px 5px 6px;">Non-hopping leg supports the take-off and momentum of the hop</td>
                                                            <td style="padding: 5px 4px 5px 6px;"></td>
                                                            <td style="padding: 5px 4px 5px 6px;"></td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2" style="padding: 5px 4px 5px 6px;">Head and trunk are still, looks straight ahead while running</td>
                                                            <td style="padding: 5px 4px 5px 6px;"></td>
                                                            <td style="padding: 5px 4px 5px 6px;"></td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2" style="padding: 5px 4px 5px 6px;">Both feet are off the ground for a short period of time, between steps</td>
                                                            <td style="padding: 5px 4px 5px 6px;"></td>
                                                            <td style="padding: 5px 4px 5px 6px;"></td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2" style="padding: 5px 4px 5px 6px;">Arm move in alternate direction to legs</td>
                                                            <td style="padding: 5px 4px 5px 6px;"></td>
                                                            <td style="padding: 5px 4px 5px 6px;"></td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2" style="padding: 5px 4px 5px 6px;">Foot placement in a straight line</td>
                                                            <td style="padding: 5px 4px 5px 6px;"></td>
                                                            <td style="padding: 5px 4px 5px 6px;"></td>
                                                        </tr>

                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="height: 10px;"></td>
                                            </tr>

                                        </table>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0;">
                                            <tr>
                                                <td style="vertical-align: top;">
                                                    <table border="1" cellpadding="0" cellspacing="0" style="width: 100%; border: 1px solid orange; font-size: 12px; border-collapse: collapse; color:#333;">
                                                        <tr style="background-color: #fecd0a;">
                                                            <td style="font-weight: 500; width: 70%; background-color: orange; padding: 5px 4px 5px 6px; border: 1px solid orange; color:#000;">P-03</td>
                                                            <td style="font-weight: 500; padding: 5px 4px 5px 6px; border: 1px solid orange; color:#000;">RUNNING</td>
                                                            <td style="font-weight: 500; background-color: orange; padding: 5px 4px 5px 6px; border: 1px solid orange; color:#000;">TERM I</td>
                                                            <td style="font-weight: 500; padding: 5px 4px 5px 6px; border: 1px solid orange; color:#000;">TERM II</td>
                                                        </tr>

                                                        <tr>
                                                            <td colspan="2" style="padding: 5px 4px 5px 6px; color:#000;">Non-hopping leg supports the take-off and momentum of the hop</td>
                                                            <td style="padding: 5px 4px 5px 6px; color:#000;"></td>
                                                            <td style="padding: 5px 4px 5px 6px; color:#000;"></td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2" style="padding: 5px 4px 5px 6px; color:#000;">Head and trunk are still, looks straight ahead while running</td>
                                                            <td style="padding: 5px 4px 5px 6px; color:#000;"></td>
                                                            <td style="padding: 5px 4px 5px 6px; color:#000;"></td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2" style="padding: 5px 4px 5px 6px; color:#000;">Both feet are off the ground for a short period of time, between steps</td>
                                                            <td style="padding: 5px 4px 5px 6px; color:#000;"></td>
                                                            <td style="padding: 5px 4px 5px 6px; color:#000;"></td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2" style="padding: 5px 4px 5px 6px; color:#000;">Arm move in alternate direction to legs</td>
                                                            <td style="padding: 5px 4px 5px 6px; color:#000;"></td>
                                                            <td style="padding: 5px 4px 5px 6px; color:#000;"></td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2" style="padding: 5px 4px 5px 6px; color:#000;">Foot placement in a straight line</td>
                                                            <td style="padding: 5px 4px 5px 6px; color:#000;"></td>
                                                            <td style="padding: 5px 4px 5px 6px; color:#000;"></td>
                                                        </tr>

                                                    </table>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td style="height: 10px;"></td>
                                            </tr>

                                        </table>
                                    </td>

                                </tr>

                                <tr>
                                    <td>
                                        <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0;">
                                            <tr>
                                                <td style="vertical-align: top;">
                                                    <table border="1" cellpadding="0" cellspacing="0" style="width: 100%; border: 1px solid orange; font-size: 12px; border-collapse: collapse; color:#333;">
                                                        <tr style="background-color: #fecd0a;">
                                                            <td style="font-weight: 500; width: 70%; background-color: orange; padding: 5px 4px 5px 6px; border: 1px solid orange; color:#000;">P-04</td>
                                                            <td style="font-weight: 500; padding: 5px 4px 5px 6px; border: 1px solid orange; color:#000;">RUNNING</td>
                                                            <td style="font-weight: 500; background-color: orange; padding: 5px 4px 5px 6px; border: 1px solid orange; color:#000;">TERM I</td>
                                                            <td style="font-weight: 500; padding: 5px 4px 5px 6px; border: 1px solid orange; color:#000;">TERM II</td>
                                                        </tr>

                                                        <tr>
                                                            <td colspan="2" style="padding: 5px 4px 5px 6px; color:#000;">Non-hopping leg supports the take-off and momentum of the hop</td>
                                                            <td style="padding: 5px 4px 5px 6px; color:#000;"></td>
                                                            <td style="padding: 5px 4px 5px 6px; color:#000;"></td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2" style="padding: 5px 4px 5px 6px; color:#000;">Head and trunk are still, looks straight ahead while running</td>
                                                            <td style="padding: 5px 4px 5px 6px; color:#000;"></td>
                                                            <td style="padding: 5px 4px 5px 6px; color:#000;"></td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2" style="padding: 5px 4px 5px 6px; color:#000;">Both feet are off the ground for a short period of time, between steps</td>
                                                            <td style="padding: 5px 4px 5px 6px; color:#000;"></td>
                                                            <td style="padding: 5px 4px 5px 6px; color:#000;"></td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2" style="padding: 5px 4px 5px 6px; color:#000;">Arm move in alternate direction to legs</td>
                                                            <td style="padding: 5px 4px 5px 6px; color:#000;"></td>
                                                            <td style="padding: 5px 4px 5px 6px; color:#000;"></td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2" style="padding: 5px 4px 5px 6px; color:#000;">Foot placement in a straight line</td>
                                                            <td style="padding: 5px 4px 5px 6px; color:#000;"></td>
                                                            <td style="padding: 5px 4px 5px 6px; color:#000;"></td>
                                                        </tr>

                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="height: 10px;"></td>
                                            </tr>

                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0;">
                                            <tr>
                                                <td style="vertical-align: top;">
                                                    <table border="1" cellpadding="0" cellspacing="0" style="width: 100%; border: 1px solid orange; font-size: 12px; border-collapse: collapse; color:#333;">
                                                        <tr style="background-color: #fecd0a;">
                                                            <td style="font-weight: 500; width: 70%; background-color: orange; padding: 5px 4px 5px 6px; border: 1px solid orange; color:#000;">P-05</td>
                                                            <td style="font-weight: 500; padding: 5px 4px 5px 6px; border: 1px solid orange; color:#000;">RUNNING</td>
                                                            <td style="font-weight: 500; background-color: orange; padding: 5px 4px 5px 6px; border: 1px solid orange; color:#000;">TERM I</td>
                                                            <td style="font-weight: 500; padding: 5px 4px 5px 6px; border: 1px solid orange; color:#000;">TERM II</td>
                                                        </tr>

                                                        <tr>
                                                            <td colspan="2" style="padding: 5px 4px 5px 6px; color:#000;">Non-hopping leg supports the take-off and momentum of the hop</td>
                                                            <td style="padding: 5px 4px 5px 6px; color:#000;"></td>
                                                            <td style="padding: 5px 4px 5px 6px; color:#000;"></td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2" style="padding: 5px 4px 5px 6px; color:#000;">Head and trunk are still, looks straight ahead while running</td>
                                                            <td style="padding: 5px 4px 5px 6px; color:#000;"></td>
                                                            <td style="padding: 5px 4px 5px 6px; color:#000;"></td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2" style="padding: 5px 4px 5px 6px; color:#000;">Both feet are off the ground for a short period of time, between steps</td>
                                                            <td style="padding: 5px 4px 5px 6px; color:#000;"></td>
                                                            <td style="padding: 5px 4px 5px 6px; color:#000;"></td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2" style="padding: 5px 4px 5px 6px; color:#000;">Arm move in alternate direction to legs</td>
                                                            <td style="padding: 5px 4px 5px 6px; color:#000;"></td>
                                                            <td style="padding: 5px 4px 5px 6px; color:#000;"></td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2" style="padding: 5px 4px 5px 6px; color:#000;">Foot placement in a straight line</td>
                                                            <td style="padding: 5px 4px 5px 6px; color:#000;"></td>
                                                            <td style="padding: 5px 4px 5px 6px; color:#000;"></td>
                                                        </tr>

                                                    </table>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td style="height: 10px;"></td>
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
                            <table>
                                <tr>
                                    <td style="width: 150px;">
                                        <div style="float: left; position: relative; width: 96px;">
                                            <span style="position: absolute; left: 50%; top:50%; transform: translate(-50%, 0); color: #fff; z-index: 1; display: inline-block; padding: 12px 0 0 35px; font-size: 14px;">2</span>
                                            <img src="{{ asset('/public/assets/reports/footer-bg.png')}}" alt="" style="width: inherit;">
                                        </div>

                                    </td>
                                    <td style="width: 100%; text-align: right;">
                                        <table cellpadding="0" cellspacing="0" style="border: 0px; width: 100%;">
                                            <tr>
                                                <td style="height: 50px;"></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div style="background-color:#FECD0A; padding: 6px 0; text-align: center; font-weight: 500; width: 98%; float: right;">PHYSICAL HEALTH AND FITNESS ASSESSMENT</div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="height: 10px;"></td>
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

</body>

</html>