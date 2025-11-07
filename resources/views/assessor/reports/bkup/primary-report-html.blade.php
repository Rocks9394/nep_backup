<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <style>
    *,
    body {
        margin: 0;
        padding: 0;
    }

    body {
        font-family: "Roboto Condensed", sans-serif;
        font-optical-sizing: auto;
        background-color: #eee;
    }

    page[size="A4"] {
        width: 21cm;
        height: 29.7cm;
        margin: 0;
        padding: 0;
    }

    .act-tbl {
        width: 100%;
    }

    .act-tbl td {
        border-bottom: 1px solid #0A87CD;
    }

    .page-3 td {
        margin: 0;
        padding: 4px 4px;
        white-space: normal;
        white-space: normal;
        /* collapses leading spaces/newlines */
    }

    .cell {
        line-height: 12px;
    }

    .cell tr {
        border-bottom: 1px solid #e5e5e5;
    }
    </style>
</head>

<body>

<table cellpadding="0" cellspacing="0" style="width: 21cm; margin:auto; border-collapse:">
    <tr>
        <td style="vertical-align:top;">
            <!-- Cover Page -->
            <table cellpadding="0" cellspacing="0" style="width: 100%; border-collapse: collapse; margin-left: auto; margin-right: auto; font-family: Roboto Condensed, sans-serif; font-size: 12px; border: 0px; background-color: #fff; height:1104px;">
                <tr>
                    <td>
                        <table cellpadding="0" cellspacing="0"
                            style="width: 100%; border-collapse: collapse; font-family: Roboto Condensed, sans-serif; font-size: 12px; border: 0;">

                            <tr>
                                <td style="border-collapse: collapse;">
                                    <div style="position: relative; background-color: #fff; z-index:0;">
                                        <div
                                            style="position: relative; background-color: #0A87CD; margin-top:0px; z-index:0; height:136px;">
                                            <img src="{{ asset('public/assets/reports/green-dot.jpg')}}" alt=""
                                                style="width: 40px; height:40px; position: relative; left:150px; top:0;">
                                        </div>

                                        <div
                                            style="width: auto; position:absolute; top:-30px; left: 176px; z-index:10; padding:30px 15px 0 15px; display:flex;">
                                            <div
                                                style="background:#fff; padding:25px 15px 10px 15px; height:140px; float:left;">
                                                <img src="{{ asset('public/assets/reports/cisce-logo.png')}}" alt=""
                                                    style="width: auto; height:100px;">
                                            </div>
                                            <p
                                                style="margin-left:30px; float:left; font-size:28px; padding:34px 20px 20px 0px; width:300px; font-weight:600; line-height:32px; color:#fff; text-transform:uppercase;">
                                                Physical Health and Fitness Assessment</p>
                                        </div>
                                        <div style="position: absolute; top:44%; right:40px; width: 200px;  z-index:9;">
                                            <img src="{{ asset('public/assets/reports/report-graphic.png')}}" alt="" style="width: inherit;">
                                        </div>

                                        <img src="{{ asset('public/assets/reports/report-cover-j-img.jpg')}}" alt=""
                                            style="width: 76%; z-index:2; position: relative; top:0; border:0">
                                    </div>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <table cellpadding="0" cellspacing="0" style="width: 100%; border: 0;">
                                        <tr>
                                            <td style="background-color:#E60A00;">
                                                <div style="position:relative; width:198px;">
                                                    <span style="position:absolute; top:-39px; background:#00A923; padding:10px; width:100%; z-indix:4; box-sizing: border-box; text-align:center; color:#fff; font-size:16px; text-transform: uppercase; font-weight:600; display:block;">For Junior</span>
                                                    <img src="{{ asset('public/assets/reports/aa-bg.png')}}" alt="" style="width:198px;">
                                                </div>
                                            </td>
                                            <td style="vertical-align: top; width: 100%;">
                                                <table cellpadding="0" cellspacing="0" style="width: 90%; border: 0;">
                                                    <tr>
                                                        <td style="height: 30px;"></td>
                                                    </tr>
                                                    <tr>
                                                        <td
                                                            style="padding: 4px 30px 5px 46px; font-size: 20px; background:#0A87CD; color:#fff; font-size: 24px; font-weight: 500; position:relative;">
                                                            Physical Health and Fitness Assessment<span
                                                                style=" position:absolute; top:35px; right:-20px;"><img
                                                                    src="{{ asset('public/assets/reports/green-bg.jpg')}}"
                                                                    alt="" style="width:20px;"></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td
                                                            style="height:30px;"></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding: 10px 30px 10px 46px; font-size: 16px; color: #333; height:380px; vertical-align:top;">
                                                            <table cellpadding="0" cellspacing="0"
                                                                style="width: 100%; border: 0px">
                                                                <tr>
                                                                    <td colspan="2" style="padding: 5px 0;">
                                                                        <table cellpadding="0" cellspacing="0"
                                                                            style="width: 100%; border: 0px">
                                                                            <tr>
                                                                                <td><span
                                                                                        style="display: inline-block; margin-right: 3px 10px;">Name</span>
                                                                                </td>
                                                                                <td
                                                                                    style="border-bottom: 1px solid #e5e5e5; width: 100%; text-align: center; font-weight: 600; font-size: 18px;">
                                                                                    Ajay R Nair</td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="padding: 5px 0;">
                                                                        <table cellpadding="0" cellspacing="0"
                                                                            style="width: 100%; border: 0px;">
                                                                            <tr>
                                                                                <td><span
                                                                                        style="display: inline-block; margin-right: 3px 10px;">Class&nbsp;&&nbsp;Section</span>
                                                                                </td>
                                                                                <td
                                                                                    style="border-bottom: 1px solid #e5e5e5; width: 100%; text-align: center; font-weight: 600;">
                                                                                    3 A</td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                    <td style="padding: 5px 0; width:55%;">
                                                                        <table cellpadding="0" cellspacing="0"
                                                                            style="width: 100%; border: 0px">
                                                                            <tr>
                                                                                <td><span
                                                                                        style="display: inline-block; margin-right: 3px 10px; margin-left: 3px 10px;">Roll&nbsp;No.</span>
                                                                                </td>
                                                                                <td
                                                                                    style="border-bottom: 1px solid #e5e5e5; width: 100%; text-align: center; font-weight: 600;">
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="2" style="padding: 5px 0;">
                                                                        <table cellpadding="0" cellspacing="0"
                                                                            style="width: 100%; border: 0px">
                                                                            <tr>
                                                                                <td><span
                                                                                        style="display: inline-block; margin-right: 3px 10px;">School</span>
                                                                                </td>
                                                                                <td
                                                                                    style="border-bottom: 1px solid #e5e5e5; width: 100%; text-align: center; font-weight: 600;">
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="padding: 5px 0;">
                                                                        <table cellpadding="0" cellspacing="0"
                                                                            style="width: 100%; border: 0px">
                                                                            <tr>
                                                                                <td><span
                                                                                        style="display: inline-block; margin-right: 3px 10px;">Code</span>
                                                                                </td>
                                                                                <td
                                                                                    style="border-bottom: 1px solid #e5e5e5; width: 100%; text-align: center; font-weight: 600;">
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                    <td style="padding: 5px 0;">
                                                                        <table cellpadding="0" cellspacing="0"
                                                                            style="width: 100%; border: 0px">
                                                                            <tr>
                                                                                <td><span
                                                                                        style="display: inline-block; margin-right: 3px 10px; margin-left: 3px 10px;">APAAR&nbsp;ID</span>
                                                                                </td>
                                                                                <td
                                                                                    style="border-bottom: 1px solid #e5e5e5; width: 100%; text-align: center; font-weight: 600;">
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="2" style="padding: 5px 0;">
                                                                        <table cellpadding="0" cellspacing="0"
                                                                            style="width: 100%; border: 0px">
                                                                            <tr>
                                                                                <td><span
                                                                                        style="display: inline-block; margin-right: 3px 10px;">CISCE&nbsp;Registration&nbsp;No</span>
                                                                                </td>
                                                                                <td
                                                                                    style="border-bottom: 1px solid #e5e5e5; width: 100%; text-align: center; font-weight: 600;">
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="padding: 5px 0;">
                                                                        <table cellpadding="0" cellspacing="0"
                                                                            style="width: 100%; border: 0px">
                                                                            <tr>
                                                                                <td><span
                                                                                        style="display: inline-block; margin-right: 3px 10px;">DOB</span>
                                                                                </td>
                                                                                <td
                                                                                    style="border-bottom: 1px solid #e5e5e5; width: 100%; text-align: center; font-weight: 600;">
                                                                                    15 Aug 2016 (8 Years)</td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                    <td style="padding: 5px 0;">
                                                                        <table cellpadding="0" cellspacing="0"
                                                                            style="width: 100%; border: 0px">
                                                                            <tr>
                                                                                <td><span
                                                                                        style="display: inline-block; margin-right: 3px 10px; margin-left: 3px 10px;">Gender</span>
                                                                                </td>
                                                                                <td
                                                                                    style="border-bottom: 1px solid #e5e5e5; width: 100%; text-align: center; font-weight: 600;">
                                                                                    Boy</td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="height: 15px;"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="2" style="padding: 5px 0;">
                                                                        <table cellpadding="0" cellspacing="0"
                                                                            style="width: 100%; border: 0px">
                                                                            <tr>
                                                                                <td><span
                                                                                        style="display: inline-block; margin-right: 3px 10px; font-weight:500;">Brief
                                                                                        Summary</span></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td
                                                                                    style="border-bottom: 1px solid #e5e5e5; width: 100%; text-align: center; font-weight: 600; height: 24px;">
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td
                                                                                    style="border-bottom: 1px solid #e5e5e5; width: 100%; text-align: center; font-weight: 600; height: 24px;">
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td
                                                                                    style="border-bottom: 1px solid #e5e5e5; width: 100%; text-align: center; font-weight: 600; height: 24px;">
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="height:30px;"></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="text-align:right; padding: 0px 0px 0px 46px; ">
                                                            <div style="float:right; text-align:center;">
                                                                <p style="margin-bottom:0px; color:#666; font-size:10px;">
                                                                    powered by</p>
                                                                <img src="{{ asset('public/assets/reports/fitness365-logo-web.png')}}"
                                                                    alt="fitness365 logo" style="height:28px;">
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
                    </td>
                </tr>
            </table>
        </td>
    </tr>
        <tr>
        <td style="vertical-align:top;">
            <!-- Page 2 -->
            <table border="0" cellpadding="0" cellspacing="0" style="width: 100%; page-break-before: always; height:1124px; background-color: #fff;">
                <!-- Inner page Header Area (Page 2) -->
                <tr>
                    <td style="vertical-align:top; height: 100px;">
                        <table border="0" cellpadding="0" cellspacing="0"
                            style="width: 100%; border-collapse: collapse; font-family: Roboto Condensed, sans-serif; font-size: 12px; border:0px solid transparent;">
                            <tr>
                                <td style="vertical-align: top; height: inherit;">
                                    <table border="0" cellpadding="0" cellspacing="0" style="width: 100%; border:0;">
                                        <tr>
                                            <td style="width:300px;">
                                                <div style="margin-left: 24px; margin-top: 30px;">
                                                    <img src="{{ asset('public/assets/reports/default_school-logo.png')}}" alt=""
                                                        style="height:50px;">
                                                </div>
                                            </td>
                                            <td rowspan="2"
                                                style="position: relative; vertical-align: top; width: auto; text-align: right;">
                                                <div
                                                    style="position: absolute; top: 30px; right:30px; display: flex; align-items: center; z-index: 1; width: 90px; overflow: hidden;">
                                                    <img src="{{ asset('public/assets/reports/cisce-logo.png')}}" alt=""
                                                        style="width: inherit;">
                                                </div>
                                                <img src="{{ asset('public/assets/reports/inner-header-bg.png')}}" alt=""
                                                    style="width: 450px; height:auto; position: relative; right:0px; top:0;">
                                            </td>

                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <!-- Inner page Content (Page 2) -->
                <tr>
                    <td style="vertical-align:top;">
                        <table border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td style="vertical-align:top;">
                                    <table border="0" cellpadding="0" cellspacing="0"
                                        style="width: 94%; border: 0; border-collapse: collapse; margin: auto;">
                                        <tr>
                                            <td style="border-bottom: 3px solid #E60A00;">
                                                <div style="align-items: left; color: #fff; font-size: 18px; font-weight: 600; height: 36px; position:relative; top:1px;">
                                                    <div style="float: left; padding: 6px 0px 4px 10px; display:inline-block; background: #E60A00; margin-top:4px;">
                                                        Physical Fitness Assessment - Class Upper KG</div>
                                                    <div style="text-align:right; float:left;"><img src="{{ asset('public/assets/reports/heading-band-corder.jpg')}}" alt="" style="width: 33px; position:relative; top:4px; height: 32px;"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="height: 10px;"></td>
                                        </tr>
                                        <tr>
                                            <td
                                                style="padding: 6px 10px 6px 0px; font-size: 18px; color:#000; font-size: 16px; font-weight: 600;">
                                                Hand Eye Coordination (Plate Tapping)</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <table cellpadding="0" cellspacing="0"
                                                    style="width: 100%; border: 0; border-collapse: collapse;">
                                                    <tr>
                                                        <td style="vertical-align: top;">
                                                            <table border="0" cellpadding="0" cellspacing="0"
                                                                style="width: 100%;">
                                                                <tr>
                                                                    <td style="width: 50%;">
                                                                        <table border="1" cellpadding="0" cellspacing="0"
                                                                            style="width: 100%; border: 1px solid orange; font-size: 14px; border-collapse: collapse; color:#333;">
                                                                            <tr style="background-color:#FBCA01;">
                                                                                <td style="width: 20%; background-color:#0A87CD; padding: 4px 4px 4px 6px; border: 1px solid #0A87CD; color:#fff; text-align: center; font-weight: bold; line-height:14px;"
                                                                                    rowspan="2">Current Term</td>
                                                                                <td
                                                                                    style="width: 25%; padding: 4px 4px 4px 6px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">
                                                                                    Date</td>
                                                                                <td
                                                                                    style="width: 28%; padding: 4px 4px 4px 6px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">
                                                                                    Performance</td>
                                                                                <td
                                                                                    style="padding: 4px 4px 4px 6px; border: 1px solid orange; color:#000; font-weight: bold; text-align: center;">
                                                                                    Level</td>
                                                                            </tr>

                                                                            <tr>
                                                                                <td
                                                                                    style="padding: 4px 4px 4px 6px; font-weight: 500; color:#000; text-align: center; border: 1px solid orange;">
                                                                                    10 Jun 2025</td>
                                                                                <td
                                                                                    style="padding: 4px 4px 4px 6px; text-align: center; border: 1px solid orange;">
                                                                                    22.16 Sec</td>
                                                                                <td
                                                                                    style="padding: 4px 4px 4px 6px; text-align: center; border: 1px solid orange;">
                                                                                    L2 (Very Low)</td>

                                                                            </tr>

                                                                        </table>
                                                                    </td>
                                                                    <td style="width: 50%;">
                                                                        <table border="1" cellpadding="0" cellspacing="0"
                                                                            style="width: 100%; border: 1px solid orange; font-size: 14px; border-collapse: collapse; color:#333;">
                                                                            <tr style="background-color: #FBCA01;">
                                                                                <td style="font-weight: 500; width: 20%; background-color:#0A87CD; padding: 4px 4px 4px 6px; border: 1px solid #0A87CD; color:#fff; text-align: center; line-height:14px;"
                                                                                    rowspan="2">Previous Term</td>
                                                                                <td
                                                                                    style="font-weight: 500; width: 25%; padding: 4px 4px 4px 6px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">
                                                                                    Date</td>
                                                                                <td
                                                                                    style="font-weight: 500; width: 28%; padding: 4px 4px 4px 6px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">
                                                                                    Performance</td>
                                                                                <td
                                                                                    style="font-weight: 500; padding: 4px 4px 4px 6px; border: 1px solid orange; color:#000; font-weight: bold; text-align: center;">
                                                                                    Level</td>
                                                                            </tr>

                                                                            <tr>
                                                                                <td
                                                                                    style="padding: 4px 4px 4px 6px; font-weight: 500; color:#000; text-align: center; border: 1px solid orange;">
                                                                                    10 Jun 2025</td>
                                                                                <td
                                                                                    style="padding: 4px 4px 4px 6px; text-align: center; border: 1px solid orange;">
                                                                                    22.16 Sec</td>
                                                                                <td
                                                                                    style="padding: 4px 4px 4px 6px; text-align: center; border: 1px solid orange;">
                                                                                    L2 (Very Low)</td>

                                                                            </tr>

                                                                        </table>
                                                                    </td>
                                                                </tr>

                                                            </table>

                                                        </td>

                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <table border="1" cellpadding="0" cellspacing="0"
                                                                style="width: 100%; border-top: 0px solid orange; border-left: 1px solid orange; border-right: 1px solid #00A923; border-bottom: 1px solid #00A923; font-size: 14px; border-collapse: collapse; color:#333;">
                                                                <tr>
                                                                    <td
                                                                        style="background-color: #00A923; padding: 5px 10px 5px 10px; padding: 5px 10px; color: #fff; text-align: center; width: 120px; font-weight: bold; border-top: 0px; border-left: 1px solid #00A923;">
                                                                        Recommendation</td>
                                                                    <td style="padding: 5px 10px 5px 10px; line-height:14px; font-size:13px; border-top: 0px;">
                                                                        You can further improve your coordination by practicing quick action and rapid movement activities like drum tapping, wall tapping using different colors, lights, or sounds, paper airplane throw, handkerchief catch, frisbee, and ruler drop.
                                                                    </td>
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
                                            <td
                                                style="padding: 6px 10px 6px 0px; font-size: 20px; color:#000; font-size: 16px; font-weight: 600;">
                                                Static Balance (Flamingo Balance)</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <table cellpadding="0" cellspacing="0"
                                                    style="width: 100%; border: 0; border-collapse: collapse;">
                                                    <tr>
                                                        <td style="vertical-align: top;">
                                                            <table border="0" cellpadding="0" cellspacing="0"
                                                                style="width: 100%;">
                                                                <tr>
                                                                    <td style="width: 50%;">
                                                                        <table border="1" cellpadding="0" cellspacing="0"
                                                                            style="width: 100%; border: 1px solid orange; font-size: 14px; border-collapse: collapse; color:#333;">
                                                                            <tr style="background-color: #fecd0a;">
                                                                                <td style="width: 20%; background-color:#0A87CD; padding: 4px 4px 4px 6px; border: 1px solid #0A87CD; color:#fff; text-align: center; font-weight: bold; line-height:14px;"
                                                                                    rowspan="2">Current Term</td>
                                                                                <td
                                                                                    style="width: 25%; padding: 4px 4px 4px 6px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">
                                                                                    Date</td>
                                                                                <td
                                                                                    style="width: 28%; padding: 4px 4px 4px 6px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">
                                                                                    Performance</td>
                                                                                <td
                                                                                    style="padding: 4px 4px 4px 6px; border: 1px solid orange; color:#000; font-weight: bold; text-align: center;">
                                                                                    Level</td>
                                                                            </tr>

                                                                            <tr>
                                                                                <td
                                                                                    style="padding: 4px 4px 4px 6px; font-weight: 500; color:#000; text-align: center; border: 1px solid orange;">
                                                                                    10 Jun 2025</td>
                                                                                <td
                                                                                    style="padding: 4px 4px 4px 6px; text-align: center; border: 1px solid orange;">
                                                                                    4times</td>
                                                                                <td
                                                                                    style="padding: 4px 4px 4px 6px; text-align: center; border: 1px solid orange;">
                                                                                    L7 (Excellent)</td>

                                                                            </tr>

                                                                        </table>
                                                                    </td>
                                                                    <td style="width: 50%;">
                                                                        <table border="1" cellpadding="0" cellspacing="0"
                                                                            style="width: 100%; border: 1px solid orange; font-size: 14px; border-collapse: collapse; color:#333;">
                                                                            <tr style="background-color: #fecd0a;">
                                                                                <td style="width: 20%; background-color:#0A87CD; padding: 4px 4px 4px 6px; border: 1px solid #0A87CD; color:#fff; text-align: center; font-weight: bold; line-height:14px;"
                                                                                    rowspan="2">Previous Term</td>
                                                                                <td
                                                                                    style="width: 25%; padding: 4px 4px 4px 6px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">
                                                                                    Date</td>
                                                                                <td
                                                                                    style="width: 28%; padding: 4px 4px 4px 6px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">
                                                                                    Performance</td>
                                                                                <td
                                                                                    style="padding: 4px 4px 4px 6px; border: 1px solid orange; color:#000; font-weight: bold; text-align: center;">
                                                                                    Level</td>
                                                                            </tr>

                                                                            <tr>
                                                                                <td
                                                                                    style="padding: 4px 4px 4px 6px; font-weight: 500; color:#000; text-align: center; border: 1px solid orange;">
                                                                                    10 Jun 2025</td>
                                                                                <td
                                                                                    style="padding: 4px 4px 4px 6px; text-align: center; border: 1px solid orange;">
                                                                                    22.16 Sec</td>
                                                                                <td
                                                                                    style="padding: 4px 4px 4px 6px; text-align: center; border: 1px solid orange;">
                                                                                    L2 (Very Low)</td>

                                                                            </tr>

                                                                        </table>
                                                                    </td>
                                                                </tr>

                                                            </table>

                                                        </td>

                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <table border="1" cellpadding="0" cellspacing="0"
                                                                style="width: 100%; border-top: 0px solid #00A923; border-left: 1px solid #00A923; border-right: 1px solid #00A923; border-bottom: 1px solid #00A923; font-size: 14px; border-collapse: collapse; color:#333;">
                                                                <tr>
                                                                    <td style="background-color: #00A923; padding: 5px 10px 5px 10px; padding: 5px 10px; color: #fff; text-align: center; width: 120px; font-weight: bold; border-top: 0px; border-left: 1px solid #00A923;">
                                                                        Recommendation</td>
                                                                    <td style="padding: 5px 10px 5px 10px; line-height:14px; font-size:13px; border-top: 0px;">Sports Fit. Keep it up!</td>
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
                                            <td
                                                style="padding: 6px 10px 6px 0px; color:#000; font-size: 16px; font-weight: 600;">
                                                BMI (Body Mass Index)</td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <table cellpadding="0" cellspacing="0"
                                                    style="width: 100%; border: 0; border-collapse: collapse;">
                                                    <tr>
                                                        <td style="vertical-align: top;">
                                                            <table border="0" cellpadding="0" cellspacing="0"
                                                                style="width: 100%;">
                                                                <tr style="font-size: 13px; line-height: 1.25rem;">
                                                                    <td
                                                                        style="border-top: 1px solid #0A87CD; border-left: 1px solid #0A87CD; border-right: 1px solid #0A87CD; border-bottom: 0px solid transparent; border-collapse: collapse; padding:5px 15px; vertical-align: middle;">
                                                                        <ul style="margin-left: 15px;">
                                                                            <li>Height recorded in cm and mm</li>
                                                                            <li>Weight will be recorded in kilogram (kg) and
                                                                                grams(gms)</li>
                                                                        </ul>
                                                                    </td>
                                                                    <td
                                                                        style="border-top: 1px solid #0A87CD; border-right: 1px solid #0A87CD; border-bottom: 0px solid transparent; border-collapse: collapse; padding:5px 15px; vertical-align: top; padding-bottom:10px;">
                                                                        <table border="0" cellpadding="0" cellspacing="0">
                                                                            <tr>
                                                                                <td>Body Mass Index =</td>
                                                                                <td style="padding:0 10px;">
                                                                                    <p
                                                                                        style="border-bottom: 1px solid #c5c5c5; padding-bottom: 2px; margin:0;">
                                                                                        Weight (in kg)</p>
                                                                                    <p style="padding-top: 0px; margin:0;">
                                                                                        Height (in m)2</p>
                                                                                </td>
                                                                            </tr>
                                                                        </table>

                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="width: 50%;">
                                                                        <table border="1" cellpadding="0" cellspacing="0"
                                                                            style="width: 100%; border: 1px solid orange; font-size: 13px; border-collapse: collapse; color:#333;">
                                                                            <tr style="background-color: #fecd0a;">
                                                                                <td style="width: 20%; background-color:#0A87CD; padding: 4px 4px 4px 6px; border: 1px solid #0A87CD; color:#fff; text-align: center; font-weight: bold;"
                                                                                    rowspan="2">Term I</td>
                                                                                <td
                                                                                    style="width: 25%; padding: 4px 4px 4px 6px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">
                                                                                    Date</td>
                                                                                <td
                                                                                    style="width: 28%; padding: 4px 4px 4px 6px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">
                                                                                    Weight</td>
                                                                                <td
                                                                                    style="width: 28%; padding: 4px 4px 4px 6px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">
                                                                                    Height</td>
                                                                                <td
                                                                                    style="width: 28%; padding: 4px 4px 4px 6px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">
                                                                                    BMI</td>
                                                                                <td
                                                                                    style="padding: 4px 4px 4px 6px; border: 1px solid orange; color:#000; font-weight: bold; text-align: center;">
                                                                                    Level</td>
                                                                            </tr>

                                                                            <tr>
                                                                                <td
                                                                                    style="padding: 4px 4px 4px 6px; font-weight: 500; color:#000; text-align: center;">
                                                                                    10&nbsp;Jun&nbsp;2025</td>
                                                                                <td
                                                                                    style="padding: 4px 4px 4px 6px; text-align: center; border: 1px solid orange;">
                                                                                    &lt;15.20</td>
                                                                                <td
                                                                                    style="padding: 4px 4px 4px 6px; text-align: center; border: 1px solid orange;">
                                                                                    &lt;15.20</td>
                                                                                <td
                                                                                    style="padding: 4px 4px 4px 6px; text-align: center; border: 1px solid orange;">
                                                                                    &lt;15.20</td>
                                                                                <td
                                                                                    style="padding: 4px 4px 4px 6px; text-align: center; border: 1px solid orange;">
                                                                                    Normal</td>

                                                                            </tr>

                                                                        </table>
                                                                    </td>
                                                                    <td style="width: 50%;">
                                                                        <table border="1" cellpadding="0" cellspacing="0"
                                                                            style="width: 100%; border: 1px solid orange; font-size: 13px; border-collapse: collapse; color:#333;">
                                                                            <tr style="background-color: #fecd0a;">
                                                                                <td style="width: 20%; background-color:#0A87CD; padding: 4px 4px 4px 6px; border: 1px solid #0A87CD; color:#fff; text-align: center; font-weight: bold;"
                                                                                    rowspan="2">Term II</td>
                                                                                <td
                                                                                    style="width: 25%; padding: 4px 4px 4px 6px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">
                                                                                    Date</td>
                                                                                <td
                                                                                    style="width: 28%; padding: 4px 4px 4px 6px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">
                                                                                    Weight</td>
                                                                                <td
                                                                                    style="width: 28%; padding: 4px 4px 4px 6px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">
                                                                                    Height</td>
                                                                                <td
                                                                                    style="width: 28%; padding: 4px 4px 4px 6px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">
                                                                                    BMI</td>
                                                                                <td
                                                                                    style="padding: 4px 4px 4px 6px; border: 1px solid orange; color:#000; font-weight: bold; text-align: center;">
                                                                                    Level</td>
                                                                            </tr>

                                                                            <tr>
                                                                                <td
                                                                                    style="padding: 4px 4px 4px 6px; font-weight: 500; color:#000; text-align: center;">
                                                                                    10&nbsp;Jun&nbsp;2025</td>
                                                                                <td
                                                                                    style="padding: 4px 4px 4px 6px; text-align: center; border: 1px solid orange;">
                                                                                    &lt;15.20 </td>
                                                                                <td
                                                                                    style="padding: 4px 4px 4px 6px; text-align: center; border: 1px solid orange;">
                                                                                    &lt;15.20 </td>
                                                                                <td
                                                                                    style="padding: 4px 4px 4px 6px; text-align: center; border: 1px solid orange;">
                                                                                    &lt;15.20 </td>
                                                                                <td
                                                                                    style="padding: 4px 4px 4px 6px; text-align: center; border: 1px solid orange;">
                                                                                    Normal</td>

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
                                        <tr>
                                            <td style="height: 15px;"></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <table border="1" cellpadding="0" cellspacing="0"
                                                    style="width: 100%; border: 1px solid #000; font-size: 12px; line-height:14px; border-collapse: collapse; color:#333; text-align:left;">
                                                    <tr style="background-color: #000;">
                                                        <td style="padding: 5px 10px 5px 10px; font-weight: bold; color:#fff; font-size: 16px; line-height:18px;"
                                                            colspan="8">Fitness Benchmarks for 8 year Boy</td>
                                                    </tr>
                                                    <tr
                                                        style="font-weight: bold; background-color: #ccc; color: #000; text-align:left;">
                                                        <td
                                                            style="padding: 5px 10px 5px 10px; border: 1px solid #000; width:40px;">
                                                        </td>
                                                        <td style="padding: 5px 10px 5px 10px; border: 1px solid #000;">
                                                            L1&nbsp;(Very&nbsp;Low)</td>
                                                        <td style="padding: 5px 10px 5px 10px; border: 1px solid #000;">
                                                            L2&nbsp;(Low)</td>
                                                        <td style="padding: 5px 10px 5px 10px; border: 1px solid #000;">
                                                            L3&nbsp;(Developing)</td>
                                                        <td style="padding: 5px 10px 5px 10px; border: 1px solid #000;">
                                                            L4&nbsp;(Moderate)</td>
                                                        <td style="padding: 5px 10px 5px 10px; border: 1px solid #000;">
                                                            L5&nbsp;(Good)</td>
                                                        <td style="padding: 5px 10px 5px 10px; border: 1px solid #000;">
                                                            L6&nbsp;(High)</td>
                                                        <td style="padding: 5px 10px 5px 10px; border: 1px solid #000;">
                                                            L7&nbsp;(Excellent)</td>
                                                    </tr>
                                                    <tr style="background-color: #eee; font-weight: 500; text-align:left;">
                                                        <td style="padding: 5px 10px 5px 10px; border: 1px solid #000;"></td>
                                                        <td style="padding: 5px 10px 5px 10px; border: 1px solid #000;">&lt; 20
                                                            %ile</td>
                                                        <td style="padding: 5px 10px 5px 10px; border: 1px solid #000;">&gt; 20
                                                            %ile</td>
                                                        <td style="padding: 5px 10px 5px 10px; border: 1px solid #000;">&gt; 40
                                                            %ile</td>
                                                        <td style="padding: 5px 10px 5px 10px; border: 1px solid #000;">&gt; 60
                                                            %ile</td>
                                                        <td style="padding: 5px 10px 5px 10px; border: 1px solid #000;">&gt; 70
                                                            %ile</td>
                                                        <td style="padding: 5px 10px 5px 10px; border: 1px solid #000;">&gt; 80
                                                            %ile</td>
                                                        <td style="padding: 5px 10px 5px 10px; border: 1px solid #000;">&gt; 90
                                                            %ile</td>
                                                    </tr>
                                                    <tr>
                                                        <td
                                                            style="padding: 5px 10px 5px 10px; font-weight: bold; color: #000; border: 1px solid #000;">
                                                            Plate Tapping</td>
                                                        <td style="padding: 5px 10px 5px 10px; border: 1px solid #000;">&lt; 00
                                                            m 17 s 310 ms to 00 m 15 s 510 ms</td>
                                                        <td style="padding: 5px 10px 5px 10px; border: 1px solid #000;">&lt;00 m
                                                            15 s 510 ms to 00 m 14 s 100 ms</td>
                                                        <td style="padding: 5px 10px 5px 10px; border: 1px solid #000;">&lt; 00
                                                            m 14 s 100 ms to 00 m 13 s 70 ms</td>
                                                        <td style="padding: 5px 10px 5px 10px; border: 1px solid #000;">&lt; 00
                                                            m 13 s 70 ms to 00 m 12 s 580 ms</td>
                                                        <td style="padding: 5px 10px 5px 10px; border: 1px solid #000;">&lt; 00
                                                            m 12 s 580 ms to 00 m 12 s 50 ms</td>
                                                        <td style="padding: 5px 10px 5px 10px; border: 1px solid #000;">&lt; 00
                                                            m 12 s 50 ms to 00 m 11 s 370 ms</td>
                                                        <td style="padding: 5px 10px 5px 10px; border: 1px solid #000;">&lt; 00
                                                            m 11 s 370 ms</td>
                                                    </tr>
                                                    <tr>
                                                        <td
                                                            style="padding: 5px 10px 5px 10px; font-weight: bold; color: #000; border: 1px solid #000;">
                                                            Flamingo Balance</td>
                                                        <td style="padding: 5px 10px 5px 10px; border: 1px solid #000;">&lt; 26
                                                            times to 18 times</td>
                                                        <td style="padding: 5px 10px 5px 10px; border: 1px solid #000;">&lt; 18
                                                            times to 14 times</td>
                                                        <td style="padding: 5px 10px 5px 10px; border: 1px solid #000;">&lt; 14
                                                            times to 10 times</td>
                                                        <td style="padding: 5px 10px 5px 10px; border: 1px solid #000;">&lt; 10
                                                            times to 8 times</td>
                                                        <td style="padding: 5px 10px 5px 10px; border: 1px solid #000;">&lt; 8
                                                            times to 7 times</td>
                                                        <td style="padding: 5px 10px 5px 10px; border: 1px solid #000;">&lt; 7
                                                            times to 5 times</td>
                                                        <td style="padding: 5px 10px 5px 10px; border: 1px solid #000;">&lt; 5
                                                            times</td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td style="height: 15px;"></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
                                                    <tr>
                                                        <td
                                                            style="padding: 5px 10px 5px 10px; color:#fff; background-color: #000; font-size: 16px; font-weight: 600;">
                                                            BMI Benchmarks for 8 years Boy</td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <table border="0" cellpadding="0" cellspacing="0"
                                                                style="width: 100%; border: 1px solid #000; font-size: 12px; border-collapse: collapse; color:#333;">
                                                                <tr
                                                                    style="font-weight: bold; background-color: #eee; font-size: 12px; color: #000; text-align: center;">
                                                                    <th style="padding:2px 4px 2px 4px; width: 10%;">UW</th>
                                                                    <th style="padding:2px 4px 2px 4px; width: 10%;">N</th>
                                                                    <th style="padding:2px 4px 2px 4px; width: 10%;">OW</th>
                                                                    <th style="padding:2px 4px 2px 4px; width: 10%;">OB</th>
                                                                    <th style="padding:2px 4px 2px 4px;"></th>
                                                                </tr>

                                                                <tr style="text-align: center;">
                                                                    <td style="padding:2px 4px 2px 4px;"> &lt;15.7 </td>
                                                                    <td style="padding:2px 4px 2px 4px;"> &lt;17.5</td>
                                                                    <td style="padding:2px 4px 2px 4px;"> &lt;19.7</td>
                                                                    <td style="padding:2px 4px 2px 4px;"> &gt;19.7</td>
                                                                    <td style="padding:2px 4px 2px 4px;"></td>
                                                                </tr>

                                                            </table>

                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p style="font-size:12px; margin:5px 0 0 0;"><span
                                                        style="font-weight:600;">Recommendation: </span>You can reduce your
                                                    weight by 4.48 Kg by improving your lifestyle and increasing regular
                                                    physical activity.</p>
                                            </td>
                                        </tr>

                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td style="height: 66px;"></td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <!-- Inner page Footer Area (Page 2) -->
                <tr>
                    <td>
                        <table border="0" cellpadding="0" cellspacing="0" style="width:100%;">
                            <tr>
                                <td style="width:74px;">
                                    <div style="float: left; position: relative; width: 60px;">
                                        <span style="position: absolute; left: 50%; top:50%; transform: translate(-50%, 0); color: #fff; z-index: 1; display: inline-block; padding: 0px 0 0 18px; font-size: 13px; font-weight: 600;">2</span>
                                        <img src="{{ asset('public/assets/reports/footer-bg.png')}}" alt=""
                                            style="width: inherit;">
                                    </div>
                                </td>
                                <td style="text-align: right;">
                                    <table cellpadding="0" cellspacing="0" style="border: 0px; width: 100%;">
                                        <tr>
                                            <td style="height: 20px;"></td>
                                            <td style="height: 20px;"></td>
                                        </tr>
                                        <tr>
                                            <td style="font-weight: 400; font-size: 13px; color:#666; text-align:left;">
                                                Physical Health and Fitness Assessment
                                            </td>
                                            <td style="text-align:right; padding: 0px 30px 0px 0px;">
                                                <div style="float:right; text-align:center; position:relative;">
                                                    <p
                                                        style="color:#666; font-size:10px; position:absolute; top:-17px; width:100%; text-align:center;">
                                                        powered by</p>
                                                    <img src="{{ asset('public/assets/reports/fitness365-logo-web.png')}}"
                                                        alt="fitness365 logo" style="height:28px;">
                                                </div>
                                            </td>
                                        </tr>

                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td style="height: 15px;"></td>
                </tr>
                
            </table>
        </td>
    </tr>
        <tr>
        <td>
            <!-- Page 3 -->
            <table border="0" cellpadding="0" cellspacing="0" style="background-color: #fff; width: 100%; height:1124px;">
                <!-- Inner page Header Area (Page 3) -->
                <tr>
                    <td>
                        <table border="0" cellpadding="0" cellspacing="0"
                            style="width: 100%; border-collapse: collapse; font-family: Roboto Condensed, sans-serif; font-size: 12px; border:0px solid transparent;">
                            <tr>
                                <td style="vertical-align: top; height: 100px;">
                                    <table cellpadding="0" cellspacing="0" style="width: 100%; border:0;">
                                        <tr>
                                            <td rowspan="2"
                                                style="position: relative; vertical-align: top; width: auto; text-align: left;">
                                                <div
                                                    style="position: absolute; top: 30px; left:30px; display: flex; align-items: center; z-index: 1; width: 90px; overflow: hidden;">
                                                    <img src="{{ asset('public/assets/reports/cisce-logo.png')}}" alt=""
                                                        style="width: inherit;">
                                                </div>
                                                <img src="{{ asset('public/assets/reports/inner-header2-bg.png')}}" alt=""
                                                    style="width: 450px; height:auto; position: relative; left:0px; top:0;">
                                            </td>
                                            <td style="width:300px; text-align: right;">
                                                <div style="margin-right: 24px; margin-top: 30px;">
                                                    <img src="{{ asset('public/assets/reports/default_school-logo.png')}}" alt=""
                                                        style="height:50px;">
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <!-- Inner page Content (Page 2) -->
                <tr>
                    <td style="vertical-align:top;">
                        <table border="0" cellpadding="0" cellspacing="0" style="width: 94%; border: 0; border-collapse: collapse; margin: auto;">
                            <tr>
                                <td style="border-bottom: 3px solid #E60A00;">
                                                <div style="align-items: left; color: #fff; font-size: 18px; font-weight: 600; height: 36px; position:relative; top:1px;">
                                                    <div style="float: left; padding: 6px 0px 4px 10px; display:inline-block; background: #E60A00; margin-top:4px;">
                                            Developmental Skills for Age 5-8 (Class Upper KG)</div>
                                        <div style="text-align:right; float:left;"><img src="{{ asset('public/assets/reports/heading-band-corder.jpg')}}" alt="" style="width: 33px; position:relative; top:4px; height: 32px;"></div>
                                    </div>

                                </td>
                            </tr>
                            <tr>
                                <td style="height: 10px;"></td>
                            </tr>
                            <tr>
                                <td
                                    style="padding: 5px 10px 5px 10px; background:#0A87CD; color:#fff; font-size: 16px; font-weight: 600;">
                                    Locomotive Skills</td>
                            </tr>
                            <tr>
                                <td>
                                    <table border="0" cellpadding="0" cellspacing="0"
                                        style="width: 100%; border: 0; border-collapse: collapse;">
                                        <tr>
                                            <td style="vertical-align: top;">
                                                <table border="0" cellpadding="0" cellspacing="0"
                                                    style="width: 100%; border: 1px solid orange; font-size: 13px; border-collapse: collapse; color:#333;">
                                                    <tr style="background-color: #fecd0a;">
                                                        <td style="font-weight: 500; width: 30%; background-color:#fecd0a; padding: 4px 4px 4px 6px; border: 1px solid orange; color:#000; border: 1px solid orange;"
                                                            rowspan="2">Skills</td>
                                                        <td
                                                            style="font-weight: 500; width: 12%; padding: 4px 4px 4px 6px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold; border: 1px solid orange;">
                                                            Current Term</td>
                                                        <td
                                                            style="font-weight: 500; width: 14%; padding: 4px 4px 4px 6px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold; border: 1px solid orange;">
                                                            Previous Term</td>
                                                        <td style="font-weight: 500; padding: 4px 4px 4px 6px; border: 1px solid orange; color:#000; border: 1px solid orange;"
                                                            rowspan="2">Recommendation</td>
                                                    </tr>
                                                    <tr>
                                                        <td
                                                            style="font-weight: 500; background-color:#ffe167; padding: 4px 4px 4px 6px; border: 1px solid orange; color:#000; text-align: center; border: 1px solid orange;">
                                                            Outcome</td>
                                                        <td
                                                            style="font-weight: 500; background-color: #ffe167; padding: 4px 4px 4px 6px; border: 1px solid orange; color:#000; text-align: center; border: 1px solid orange;">
                                                            Outcome</td>
                                                    </tr>
                                                    <tr>
                                                        <td
                                                            style="padding: 4px 4px 4px 6px; font-weight: 500; color:#000; border: 1px solid orange;">
                                                            Running</td>
                                                        <td
                                                            style="padding: 4px 4px 4px 6px; text-align: center; border: 1px solid orange;">
                                                            Accomplished</td>
                                                        <td style="padding: 4px 4px 4px 6px; border: 1px solid orange;"></td>
                                                        <td
                                                            style="padding: 4px 4px 4px 6px; font-size: 12px; border: 1px solid orange;">
                                                            Maintain form and endurance through sport-specific sprinting drills.
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td
                                                            style="padding: 4px 4px 4px 6px; font-weight: 500; color:#000; border: 1px solid orange;">
                                                            Hopping</td>
                                                        <td
                                                            style="padding: 4px 4px 4px 6px; text-align: center; border: 1px solid orange;">
                                                            Developing</td>
                                                        <td style="padding: 4px 4px 4px 6px; border: 1px solid orange;"></td>
                                                        <td
                                                            style="padding: 4px 4px 4px 6px; font-size: 12px; border: 1px solid orange;">
                                                            Hop over lines or cones and play hopscotch to improve balance.</td>
                                                    </tr>
                                                    <tr>
                                                        <td
                                                            style="padding: 4px 4px 4px 6px; font-weight: 500; color:#000; border: 1px solid orange;">
                                                            Skipping</td>
                                                        <td
                                                            style="padding: 4px 4px 4px 6px; text-align: center; border: 1px solid orange;">
                                                            Emerging</td>
                                                        <td style="padding: 4px 4px 4px 6px; border: 1px solid orange;"></td>
                                                        <td
                                                            style="padding: 4px 4px 4px 6px; font-size: 12px; border: 1px solid orange;">
                                                            Learn the step-hop pattern slowly with music or rhythm claps.</td>
                                                    </tr>
                                                    <tr>
                                                        <td
                                                            style="padding: 4px 4px 4px 6px; font-weight: 500; color:#000; border: 1px solid orange;">
                                                            Dodging</td>
                                                        <td
                                                            style="padding: 4px 4px 4px 6px; text-align: center; border: 1px solid orange;">
                                                            Developing</td>
                                                        <td style="padding: 4px 4px 4px 6px; border: 1px solid orange;"></td>
                                                        <td
                                                            style="padding: 4px 4px 4px 6px; font-size: 12px; border: 1px solid orange;">
                                                            Maintain form and endurance through sport-specific sprinting drills.
                                                        </td>
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
                                <td
                                    style="padding: 5px 10px 5px 10px; background:#0A87CD; color:#fff; font-size: 16px; font-weight: 600;">
                                    Object Control Skills</td>
                            </tr>
                            <tr>
                                <td>
                                    <table border="0" cellpadding="0" cellspacing="0"
                                        style="width: 100%; border: 0; border-collapse: collapse;">
                                        <tr>
                                            <td style="vertical-align: top;">
                                                <table border="1" cellpadding="0" cellspacing="0"
                                                    style="width: 100%; border: 1px solid orange; font-size: 13px; border-collapse: collapse; color:#333;">
                                                    <tr style="background-color: #fecd0a;">
                                                        <td style="font-weight: 500; width: 30%; background-color:#fecd0a; padding: 4px 4px 4px 6px; border: 1px solid orange; color:#000;"
                                                            rowspan="2">Skills</td>
                                                        <td
                                                            style="font-weight: 500; width: 12%; padding: 4px 4px 4px 6px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">
                                                            Current Term</td>
                                                        <td
                                                            style="font-weight: 500; width: 14%; padding: 4px 4px 4px 6px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">
                                                            Previous Term</td>
                                                        <td style="font-weight: 500; padding: 4px 4px 4px 6px; border: 1px solid orange; color:#000;"
                                                            rowspan="2">Recommendation</td>
                                                    </tr>
                                                    <tr>
                                                        <td
                                                            style="font-weight: 500; background-color:#ffe167; padding: 4px 4px 4px 6px; border: 1px solid orange; color:#000; text-align: center;">
                                                            Outcome</td>
                                                        <td
                                                            style="font-weight: 500; background-color: #ffe167; padding: 4px 4px 4px 6px; border: 1px solid orange; color:#000; text-align: center;">
                                                            Outcome</td>
                                                    </tr>
                                                    <tr>
                                                        <td
                                                            style="padding: 4px 4px 4px 6px; font-weight: 500; color:#000; border: 1px solid orange;">
                                                            Catching & Receiving Bounce Ball</td>
                                                        <td
                                                            style="padding: 4px 4px 4px 6px; text-align: center; border: 1px solid orange;">
                                                            Acquired</td>
                                                        <td style="padding: 4px 4px 4px 6px; border: 1px solid orange;"></td>
                                                        <td
                                                            style="padding: 4px 4px 4px 6px; font-size: 12px; border: 1px solid orange;">
                                                            Catch balls of different heights and speeds with consistency.</td>
                                                    </tr>
                                                    <tr>
                                                        <td
                                                            style="padding: 4px 4px 4px 6px; font-weight: 500; color:#000; border: 1px solid orange;">
                                                            Catching Small Ball with Two Hands</td>
                                                        <td
                                                            style="padding: 4px 4px 4px 6px; text-align: center; border: 1px solid orange;">
                                                            Developing</td>
                                                        <td style="padding: 4px 4px 4px 6px; border: 1px solid orange;"></td>
                                                        <td
                                                            style="padding: 4px 4px 4px 6px; font-size: 12px; border: 1px solid orange;">
                                                            Practice toss and catch with a partner or against a wall.</td>
                                                    </tr>
                                                    <tr>
                                                        <td
                                                            style="padding: 4px 4px 4px 6px; font-weight: 500; color:#000; border: 1px solid orange;">
                                                            Under Arm Throw</td>
                                                        <td
                                                            style="padding: 4px 4px 4px 6px; text-align: center; border: 1px solid orange;">
                                                            Accomplished</td>
                                                        <td style="padding: 4px 4px 4px 6px; border: 1px solid orange;"></td>
                                                        <td
                                                            style="padding: 4px 4px 4px 6px; font-size: 12px; border: 1px solid orange;">
                                                            Integrate throws with movement or different weighted objects.</td>
                                                    </tr>
                                                    <!-- <tr>
                                                        <td
                                                            style="padding: 4px 4px 4px 6px; font-weight: 500; color:#000; border: 1px solid orange;">
                                                            Over Arm Throw</td>
                                                        <td
                                                            style="padding: 4px 4px 4px 6px; text-align: center; border: 1px solid orange;">
                                                            Accomplished</td>
                                                        <td style="padding: 4px 4px 4px 6px; border: 1px solid orange;"></td>
                                                        <td
                                                            style="padding: 4px 4px 4px 6px; font-size: 12px; border: 1px solid orange;">
                                                            Apply overarm throws in sport-like drills such as cricket or
                                                            baseball.</td>
                                                    </tr> -->

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
                                <td
                                    style="padding: 2px 10px; font-size: 20px; background:#0A87CD; color:#fff; font-size: 16px; font-weight: 600;">
                                    Body Management Skills</td>
                            </tr>
                            <tr>
                                <td>
                                    <table border="0" cellpadding="0" cellspacing="0"
                                        style="width: 100%; border: 0; border-collapse: collapse;">
                                        <tr>
                                            <td style="vertical-align: top;">
                                                <table border="0" cellpadding="0" cellspacing="0"
                                                    style="width: 100%; border: 1px solid orange; font-size: 13px; border-collapse: collapse; color:#333;">
                                                    <tr style="background-color: #fecd0a;">
                                                        <td style="font-weight: 500; width: 30%; background-color:#fecd0a; padding: 4px 4px 4px 6px; border: 1px solid orange; color:#000;"
                                                            rowspan="2">Skills</td>
                                                        <td
                                                            style="font-weight: 500; width: 12%; padding: 4px 4px 4px 6px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">
                                                            Current Term</td>
                                                        <td
                                                            style="font-weight: 500; width: 14%; padding: 4px 4px 4px 6px; border: 1px solid orange; color:#000; text-align: center; font-weight: bold;">
                                                            Previous Term</td>
                                                        <td style="font-weight: 500; padding: 4px 4px 4px 6px; border: 1px solid orange; color:#000;"
                                                            rowspan="2">Recommendation</td>
                                                    </tr>
                                                    <tr>
                                                        <td
                                                            style="font-weight: 500; background-color:#ffe167; padding: 4px 4px 4px 6px; border: 1px solid orange; color:#000; text-align: center;">
                                                            Outcome</td>
                                                        <td
                                                            style="font-weight: 500; background-color: #ffe167; padding: 4px 4px 4px 6px; border: 1px solid orange; color:#000; text-align: center;">
                                                            Outcome</td>
                                                    </tr>
                                                    <tr>
                                                        <td
                                                            style="padding: 4px 4px 4px 6px; font-weight: 500; color:#000; border: 1px solid orange;">
                                                            One-Foot Balance</td>
                                                        <td
                                                            style="padding: 4px 4px 4px 6px; text-align: center; border: 1px solid orange;">
                                                            Developing</td>
                                                        <td style="padding: 4px 4px 4px 6px; border: 1px solid orange;"></td>
                                                        <td
                                                            style="padding: 4px 4px 4px 6px; font-size: 12px; border: 1px solid orange;">
                                                            Balance on soft surfaces or cushions and try with eyes closed.</td>
                                                    </tr>
                                                    <tr>
                                                        <td
                                                            style="padding: 4px 4px 4px 6px; font-weight: 500; color:#000; border: 1px solid orange;">
                                                            Beam Walk</td>
                                                        <td
                                                            style="padding: 4px 4px 4px 6px; text-align: center; border: 1px solid orange;">
                                                            Acquired</td>
                                                        <td style="padding: 4px 4px 4px 6px; border: 1px solid orange;"></td>
                                                        <td
                                                            style="padding: 4px 4px 4px 6px; font-size: 12px; border: 1px solid orange;">
                                                            Include turns and steps while maintaining balance.</td>
                                                    </tr>

                                                </table>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td style="height: 15px;"></td>
                                        </tr>

                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td
                                    style="padding: 5px 10px 5px 10px; background:#0A87CD; color:#fff; font-size: 16px; font-weight: 600;">
                                    Developmental Stages for 8 year Boy</td>
                            </tr>


                            <tr>
                                <td>
                                    <table border="0" cellpadding="0" cellspacing="0"
                                        style="width: 100%; border: 0; border-collapse: collapse;">
                                        <tr>
                                            <td>
                                                <table border="0" cellpadding="0" cellspacing="0" style="border: 1px solid #0A87CD; font-size:12px; width:100%;">
                                                    <tr>
                                                        <td
                                                            style="padding: 4px 4px; font-weight: 500; text-align:center; border-right: 1px solid #0A87CD; border-bottom: 1px solid #0A87CD;">
                                                            1</td>
                                                        <td
                                                            style="padding: 4px 4px; font-weight: 500; color:#000; border-right: 1px solid #0A87CD; border-bottom: 1px solid #0A87CD;">
                                                            Emerging</td>
                                                        <td
                                                            style="padding: 4px 4px; text-align: left; border-right: 1px solid #0A87CD; border-bottom: 1px solid #0A87CD; color:#333;">
                                                            Taking first steps with willingness to try and improve!
                                                        </td>
                                                        <td
                                                            style="padding: 4px 4px; font-weight: 500; text-align:center; border-right: 1px solid #0A87CD; border-bottom: 1px solid #0A87CD;">
                                                            2</td>
                                                        <td
                                                            style="padding: 4px 4px; font-weight: 500; color:#000; border-right: 1px solid #0A87CD; border-bottom: 1px solid #0A87CD;">
                                                            Dveloping</td>
                                                        <td
                                                            style="padding: 4px 4px; text-align: left; border-right: 1px solid #0A87CD; border-bottom: 1px solid #0A87CD; color:#333;">
                                                            Making great progress with noticeable improvement and
                                                            effort!</td>


                                                    </tr>
                                                    <tr>
                                                        <td
                                                            style="padding: 4px 4px; font-weight: 500; text-align:center; border-right: 1px solid #0A87CD; border-bottom: 0px;">
                                                            3</td>
                                                        <td
                                                            style="padding: 4px 4px; font-weight: 500; color:#000; border-right: 1px solid #0A87CD; border-bottom: 0px;">
                                                            Acquired</td>
                                                        <td
                                                            style="padding: 4px 4px; text-align: left; border-right: 1px solid #0A87CD; border-bottom: 0px; color:#333;">
                                                            Confidently performing skills with consistency and joy!
                                                        </td>

                                                        <td
                                                            style="padding: 4px 4px; font-weight: 500; text-align:center; border-right: 1px solid #0A87CD; border-bottom: 0px;">
                                                            4</td>
                                                        <td
                                                            style="padding: 4px 4px; font-weight: 500; color:#000; border-right: 1px solid #0A87CD; border-bottom: 0px; color:#333;">
                                                            Accomplished</td>
                                                        <td
                                                            style="padding: 4px 4px; text-align: left;">
                                                            Masterful execution with precision, and adaptability!
                                                        </td>
                                                    </tr>

                                                </table>

                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>


                          
                            <tr>
                                <td style="vertical-align:top;">
                                    <!--Case 1-->

                                    <!-- <table border="0" cellpadding="0" cellspacing="0"
                                        style="width: 100%; border: 0; border-collapse: collapse; margin: auto;">
                                        <tr>
                                            <td style="height:20px;"></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h4 style="margin-bottom:5px;">Imbibing seven core values of Olympics and Paralympics</h4>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="font-size:13px; line-height:18px;">
                                                The Olympics and Paralympics are about much more than winning. The values underpin the Games
                                                as a set of universal principles, but they can be applied to education and our lives, as
                                                well as to sport itself. The Olympic and Paralympic values are great character education
                                                lessons for both children and adults. So, what are the seven Olympic and Paralympic values?
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="height:10px;"></td>
                                        </tr>
                                        <tr>
                                            <td style="text-align:left;">
                                                <table border="0" cellpadding="0" cellspacing="0" style="width: 100%; border: 0; border-collapse: collapse; margin: 0; border:1px solid #ccc; background:#fff;">
                                                    <tr>
                                                        <td style="width:50%; border-right:1px solid #ccc; text-align:center; overflow:hidden; height: 150px;">
                                                            <img src="{{ asset('public/assets/reports/3-olympic-value.png')}}" alt="" style="height: 100%; width:auto;">
                                                        </td>
                                                        <td style="width:50%; text-align:center; overflow:hidden; height: 150px;">
                                                            <img src="{{ asset('public/assets/reports/4-olympic-value.png')}}" alt="" style="height: 148px; width:auto;">
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table> -->
                                    <!--Case 2-->

                                    <!-- 
                                    <table border="0" cellpadding="0" cellspacing="0" style="width: 100%; border: 0; border-collapse: collapse;">
                                        <tr>
                                            <td style="height:15px;"></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h4 style="font-size:16px; color:#000; text-align:center; margin:0; text-transform:uppercase;">Suggested Daily Routine for Students (Age & Class-wise)</h4>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="height:10px;"></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <table border="0" cellpadding="0" cellspacing="0" style="width: 100%; border: 1px solid #000; border-collapse: collapse; text-align:center; font-size:13px;">
                                                    <tr style="background:#ccc; color:#000;">
                                                        <th style="border:1px solid #000; padding:3px 0;">Class</th>
                                                        <th style="border:1px solid #000; padding:3px 0;">Sleep Time</th>
                                                        <th style="border:1px solid #000; padding:3px 0;">Study Time</th>
                                                        <th style="border:1px solid #000; padding:3px 0;">Play Time</th>
                                                        <th style="border:1px solid #000; padding:3px 0;">Watch TV</th>
                                                        <th style="border:1px solid #000; padding:3px 0;">Eating Time</th>
                                                        <th style="border:1px solid #000; padding:3px 0;">School Time</th>
                                                        <th style="border:1px solid #000; padding:3px 0;">Assignment</th>
                                                    </tr>
                                                    <tr>
                                                        <td style="border:1px solid #000; padding:2px 0;">1-3</td>
                                                        <td style="border:1px solid #000; padding:2px 0;">9 Hours</td>
                                                        <td style="border:1px solid #000; padding:2px 0;">1 Hours</td>
                                                        <td style="border:1px solid #000; padding:2px 0;">2 Hours</td>
                                                        <td style="border:1px solid #000; padding:2px 0;">1 Hours</td>
                                                        <td style="border:1px solid #000; padding:2px 0;">1 Hours</td>
                                                        <td style="border:1px solid #000; padding:2px 0;">7 Hours</td>
                                                        <td style="border:1px solid #000; padding:2px 0;">1 Hours</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="border:1px solid #000; padding:2px 0;">1-3</td>
                                                        <td style="border:1px solid #000; padding:2px 0;">9 Hours</td>
                                                        <td style="border:1px solid #000; padding:2px 0;">1 Hours</td>
                                                        <td style="border:1px solid #000; padding:2px 0;">2 Hours</td>
                                                        <td style="border:1px solid #000; padding:2px 0;">1 Hours</td>
                                                        <td style="border:1px solid #000; padding:2px 0;">1 Hours</td>
                                                        <td style="border:1px solid #000; padding:2px 0;">7 Hours</td>
                                                        <td style="border:1px solid #000; padding:2px 0;">1 Hours</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="border:1px solid #000; padding:2px 0;">1-3</td>
                                                        <td style="border:1px solid #000; padding:2px 0;">9 Hours</td>
                                                        <td style="border:1px solid #000; padding:2px 0;">1 Hours</td>
                                                        <td style="border:1px solid #000; padding:2px 0;">2 Hours</td>
                                                        <td style="border:1px solid #000; padding:2px 0;">1 Hours</td>
                                                        <td style="border:1px solid #000; padding:2px 0;">1 Hours</td>
                                                        <td style="border:1px solid #000; padding:2px 0;">7 Hours</td>
                                                        <td style="border:1px solid #000; padding:2px 0;">1 Hours</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="border:1px solid #000; padding:2px 0;">1-3</td>
                                                        <td style="border:1px solid #000; padding:2px 0;">9 Hours</td>
                                                        <td style="border:1px solid #000; padding:2px 0;">1 Hours</td>
                                                        <td style="border:1px solid #000; padding:2px 0;">2 Hours</td>
                                                        <td style="border:1px solid #000; padding:2px 0;">1 Hours</td>
                                                        <td style="border:1px solid #000; padding:2px 0;">1 Hours</td>
                                                        <td style="border:1px solid #000; padding:2px 0;">7 Hours</td>
                                                        <td style="border:1px solid #000; padding:2px 0;">1 Hours</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="border:1px solid #000; padding:2px 0;">1-3</td>
                                                        <td style="border:1px solid #000; padding:2px 0;">9 Hours</td>
                                                        <td style="border:1px solid #000; padding:2px 0;">1 Hours</td>
                                                        <td style="border:1px solid #000; padding:2px 0;">2 Hours</td>
                                                        <td style="border:1px solid #000; padding:2px 0;">1 Hours</td>
                                                        <td style="border:1px solid #000; padding:2px 0;">1 Hours</td>
                                                        <td style="border:1px solid #000; padding:2px 0;">7 Hours</td>
                                                        <td style="border:1px solid #000; padding:2px 0;">1 Hours</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="border:1px solid #000; padding:2px 0;">1-3</td>
                                                        <td style="border:1px solid #000; padding:2px 0;">9 Hours</td>
                                                        <td style="border:1px solid #000; padding:2px 0;">1 Hours</td>
                                                        <td style="border:1px solid #000; padding:2px 0;">2 Hours</td>
                                                        <td style="border:1px solid #000; padding:2px 0;">1 Hours</td>
                                                        <td style="border:1px solid #000; padding:2px 0;">1 Hours</td>
                                                        <td style="border:1px solid #000; padding:2px 0;">7 Hours</td>
                                                        <td style="border:1px solid #000; padding:2px 0;">1 Hours</td>
                                                    </tr>
                                                </table>
                                                <div style="clear:both; margin-top:10px;">
                                                    <p style="font-weight:500; color:#000; font-size:14px;">Note:</p>
                                                    <ul style="margin-left:25px; margin-top:3px; line-height:16px; font-size:13px;">
                                                        <li>Playing game can improve vision, promote social skills, increase attention span and reduces stress. </li>
                                                        <li>Sleep is a vital need, essential to a child's health and growth. Sleep promotes alertness, memory and performance. Children who get enough sleep are more likely to function better and are less prone to behavioral problems and moodiness.</li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                       

                                    </table>  -->


                                    <!--Case 3 Posture-->

                                    <table border="0" cellpadding="0" cellspacing="0" style="width: 100%; border: 0; border-collapse: collapse;">
                                        <tr>
                                            <td style="height:30px;"></td>
                                        </tr>
                                        <tr>
                                            <td style="background:#CCEAD8; padding:5px 0; text-align:center;">
                                                <h4 style="color:#00963F; margin-bottom:0; text-transform:uppercase; font-size:14px;">Correct Posture</h4>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="background:#fff; text-align:center;">
                                                <img src="{{ asset('public/assets/reports/correct-posture.png')}}" alt="" style="height: 180px; width:auto;">
                                            </td>
                                        </tr>
                                        <td style="background:#FACECC; padding:5px 0; text-align:center;">
                                            <h4 style="color:#E60A00; margin-bottom:0; text-transform:uppercase; font-size:14px;">Incorrect Posture</h4>
                                        </td>
                                        <tr>
                                            <td style="background:#fff; text-align:center;">
                                                <img src="{{ asset('public/assets/reports/incorrect-posture.png')}}" alt="" style="height: 180px; width:auto;">
                                            </td>
                                        </tr>
                                    </table>
                                </td>
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
                                            <td style="height: 30px;"></td>
                                        </tr>
                                        <tr>
                                            <td style="height: 30px;"></td>
                                        </tr>
                                        <tr>
                                            <td style="text-align:left; padding: 0px 0px 0px 30px;">
                                                <div style="float:left; text-align:center; position:relative;">
                                                    <p
                                                        style="color:#666; font-size:10px; position:absolute; top:-14px; width:100%; text-align:center;">
                                                        powered by</p>
                                                    <img src="{{ asset('public/assets/reports/fitness365-logo-web.png')}}"
                                                        alt="fitness365 logo" style="height:32px;">
                                                </div>
                                            </td>
                                            <td>
                                                <div style="padding: 5px 0; text-align: right; font-weight: 400; font-size: 13px; color:#666;">
                                                    <span style="margin-right: 15px;">Physical Health and Fitness Assessment</span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="height: 15px;"></td>
                                        </tr>
                                    </table>
                                </td>
                                <td style="width: 74px;">
                                    <div style="float: right; position: relative; width: 60px; top:15px;">
                                        <!-- <span style="position: absolute; right: 50%; top:50%; transform: translate(-50%, 0); color: #000; z-index: 5; display: inline-block; padding: 6px 0 0 20px; font-size: 13px; font-weight: 600;">3</span> -->
                                        <img src="{{ asset('public/assets/reports/footer-bg2.png')}}" alt=""
                                            style="width: inherit;">
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td style="height: 15px;"></td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <!-- Page 4 -->
            <table border="0" cellpadding="0" cellspacing="0" style="background-color: #fff; width: 100%; page-break-before: always; height:1124px;">
                <tr>
                    <td>
                        <table border="1" cellpadding="0" cellspacing="0" style="width: 100%; border-collapse: collapse; font-family: Roboto Condensed, sans-serif; font-size: 12px; border:0px solid transparent;">
                        <!-- Inner page Header Area (Page 4) -->
                            <tr>
                                <td style="vertical-align: top; height: 100px;">
                                    <table cellpadding="0" cellspacing="0" style="width: 100%; border:0;">
                                            <tr>
                                                <td style="width:300px;">
                                                    <div style="margin-left: 24px; margin-top: 30px;">
                                                        <img src="{{ asset('public/assets/reports/default_school-logo.png')}}" alt=""
                                                            style="height:50px;">
                                                    </div>
                                                </td>
                                                <td rowspan="2"
                                                    style="position: relative; vertical-align: top; width: auto; text-align: right;">
                                                    <div
                                                        style="position: absolute; top: 30px; right:30px; display: flex; align-items: center; z-index: 1; width: 90px; overflow: hidden;">
                                                        <img src="{{ asset('public/assets/reports/cisce-logo.png')}}" alt=""
                                                            style="width: inherit;">
                                                    </div>
                                                    <img src="{{ asset('public/assets/reports/inner-header-bg.png')}}" alt=""
                                                        style="width: 450px; height:auto; position: relative; right:0px; top:0;">
                                                </td>
                                            </tr>
                                        </table>
                                </td>
                            </tr>
                            <!-- Inner page Content (Page 4) -->
                            <tr>
                                <td>
                                    <table cellpadding="0" cellspacing="0"
                                        style="width: 94%; border: 0; border-collapse: collapse; margin: auto; color: #333; font-size: 12px;">
                                        <tr>
                                            <td
                                                style="border: 1px solid #00A923; padding: 8px 10px 8px 10px; background:#F2FFF5;">
                                                <h3 style="color: #00A923; margin-bottom: 5px; font-size: 18px;">WHO Guidelines
                                                    on Physical Activity and Sedentary Behaviour 2020</h3>
                                                <h4 style="color: #000; margin-bottom: 5px; font-size: 16px">Age
                                                    Appropriate Fitness Protocols and Guidelines for age 5-18 years</h4>
                                                <p style="line-height: 16px; font-size:13px;">At least an average of 60 minutes per day of
                                                    moderate-to-vigorous intensity physical activity, across the week; most of
                                                    this physical activity should be aerobic.</p>
                                                <p style="line-height: 16px; font-size:13px;">Vigorous-intensity aerobic activities, as well as
                                                    those that strengthen muscle and bone should be incorporated at least 3 days
                                                    a week.</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="height: 15px;"></td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <table cellpadding="0" cellspacing="0"
                                                    style="width: 100%; border: 0; border-collapse: collapse;">
                                                    <tr>
                                                        <td colspan="2">
                                                            <h3 style="color: #000; font-size: 16px; margin-bottom: 5px;">
                                                                Recommends the following activities for improving Fundamental
                                                                Movement Skills for ages 5-8 years (Class 1-3)</h3>
                                                            <p style="line-height: 16px;">The focus is on the development of key Fundamental Movement
                                                                Skills which are required for life. Fit India recommends the
                                                                following activities for improvement of fitness for the 5-8 age
                                                                groups:</p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="height: 6px;"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <h4 style="color: #000; margin: 3px 10px; font-size: 14px;">
                                                                1. Locomotor Skills</h4>
                                                            <p style="padding-left:14px; padding-right:14px; line-height: 16px;">Walking, Running,
                                                                Leaping/Jumping, Hopping/Skipping/Galloping,
                                                                Sliding/Crawling/Rolling/rotating</p>
                                                        </td>
                                                        <td>
                                                            <h4 style="color: #000; margin: 3px 10px; font-size: 14px;">
                                                                2. Manipulative Skills</h4>
                                                            <p style="padding-left:14px; padding-right:14px; line-height: 16px;">Throwing,
                                                                Catching, Bouncing/Dribbling, Trapping, Kicking with Hand/with
                                                                leg, Volleying, Striking etc.</p>
                                                        </td>

                                                    </tr>
                                                    <tr>
                                                        <td style="height: 10px;"></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2">
                                                            <h4 style="color: #000; margin: 3px 10px; font-size: 14px;">
                                                                3. Body Management/Non-locomotor Skills</h4>
                                                            <p style="padding-left:14px; padding-right:14px; line-height: 16px;">Curling,
                                                                Stretching, Twisting / Turning / Spinning, Pushing / Pulling,
                                                                Rocking, Swinging / Pivoting, Balancing / Counter Balancing,
                                                                Counter-tension etc.</p>
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
                                                <table cellpadding="0" cellspacing="0"
                                                    style="width: 100%; border: 0; border-collapse: collapse;">
                                                    <tr>
                                                        <td colspan="2">
                                                            <h3 style="color: #000; font-size: 16px; margin-bottom: 5px;">
                                                                Recommends the following activities for improving fitness for
                                                                ages 5-8 years</h3>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <h4 style="color: #000; margin: 3px 10px; font-size: 14px;">
                                                                1. Hand-Eye Coordination Activities</h4>
                                                            <p style="padding-left:14px; padding-right:14px; line-height: 16px;">Ball Toss Against
                                                                Wall, Juggling with Scarves or Balls, Target Throws, Table
                                                                Tennis / Bat & Ball, Clap-Catch Game, Reaction Ball Drill</p>
                                                        </td>
                                                        <td>
                                                            <h4 style="color: #000; margin: 3px 10px; font-size: 14px;">
                                                                2. One-Leg Balance Activities</h4>
                                                            <p style="padding-left:14px; padding-right:14px; line-height: 16px;">Single-Leg Stance,
                                                                Balance with Arm Movements, Reach-and-Touch, Leg Swings, Tree
                                                                Pose (Yoga), Balance Pad / Cushion Stance</p>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td style="height: 30px;"></td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <h2
                                                    style="font-size: 24px; color:#0A87CD; font-size: 18px; font-weight: 600; text-align: center;">
                                                    EXERCISE AND PHYSICAL ACTIVITY</h2>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td
                                                style="font-size: 20px; color:#000; font-size: 16px; font-weight: 500; text-align: center;">
                                                <p>* Energy expenditure on various physical activities (Kcal/Hr)</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="height: 15px;"></td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <table border="0" cellpadding="0" cellspacing="0" style="width:100%;">
                                                    <tr>
                                                        <td style="vertical-align: top; width:80%;">
                                                            <table cellpadding="0" cellspacing="0" style="width: 100%;">
                                                                <tr>
                                                                    <td>
                                                                        <table cellpadding="0" cellspacing="0"
                                                                            style="width:100%">
                                                                            <tr>
                                                                                <td
                                                                                    style="vertical-align: top; padding-right:10px;">
                                                                                    <table class="act-tbl col-3" border="1"
                                                                                        cellpadding="0" cellspacing="0"
                                                                                        style="border: 1px solid #0A87CD; font-size: 12px; border-collapse: collapse; color:#333;">
                                                                                        <tr style="background-color: #0A87CD">
                                                                                            <td style="background-color:#0A87CD padding: 4px 4px; border: 1px solid #0A87CD; color:#fff; font-weight: bold;"
                                                                                                colspan="2">Activity</td>
                                                                                            <td
                                                                                                style="padding: 4px 4px; border: 1px solid #0A87CD; color:#fff; text-align: right; font-weight: bold;">
                                                                                                Kcal/hr</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td
                                                                                                style="font-weight: 500; color:#000; text-align: left; padding: 4px 4px;">
                                                                                                Sleeping</td>
                                                                                            <td
                                                                                                style="text-align: right; padding: 4px 4px; border-right:1px solid #0A87CD;">
                                                                                            </td>
                                                                                            <td
                                                                                                style="text-align: right; padding: 4px 4px; border-bottom:1px solid transparent;">
                                                                                                44</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td
                                                                                                style="font-weight: 500; color:#000; text-align: left; padding: 4px 4px;">
                                                                                                Sitting</td>
                                                                                            <td
                                                                                                style="text-align: right; padding: 4px 4px; border-right:1px solid #0A87CD;">
                                                                                            </td>
                                                                                            <td
                                                                                                style="text-align: right; padding: 4px 4px; border-bottom:1px solid transparent;">
                                                                                                57</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td
                                                                                                style="font-weight: 500; color:#000; text-align: left; padding: 4px 4px;">
                                                                                                Standing</td>
                                                                                            <td
                                                                                                style="text-align: right; padding: 4px 4px; border-right:1px solid #0A87CD;">
                                                                                            </td>
                                                                                            <td
                                                                                                style="text-align: right; padding: 4px 4px; border-bottom:1px solid transparent;">
                                                                                                63</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td
                                                                                                style="font-weight: 500; color:#000; text-align: left; padding: 4px 4px;">
                                                                                                Walking</td>
                                                                                            <td
                                                                                                style="text-align: right; padding: 4px 4px; border-right:1px solid #0A87CD;">
                                                                                                6.43 km/hr</td>
                                                                                            <td
                                                                                                style="text-align: right; padding: 4px 4px; border-bottom:1px solid transparent;">
                                                                                                227</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td
                                                                                                style="font-weight: 500; color:#000; text-align: left; padding: 4px 4px;">
                                                                                                Climbing Stairs</td>
                                                                                            <td
                                                                                                style="text-align: right; padding: 4px 4px; border-right:1px solid #0A87CD;">
                                                                                            </td>
                                                                                            <td
                                                                                                style="text-align: right; padding: 4px 4px; border-bottom:1px solid transparent;">
                                                                                                485</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td
                                                                                                style="font-weight: 500; color:#000; text-align: left; padding: 4px 4px;">
                                                                                                Housecleaning</td>
                                                                                            <td
                                                                                                style="text-align: right; padding: 4px 4px; border-right:1px solid #0A87CD;">
                                                                                            </td>
                                                                                            <td
                                                                                                style="text-align: right; padding: 4px 4px; border-bottom:1px solid transparent;">
                                                                                                176</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td
                                                                                                style="font-weight: 500; color:#000; text-align: left; padding: 4px 4px;">
                                                                                                Gardening</td>
                                                                                            <td
                                                                                                style="text-align: right; padding: 4px 4px; border-right:1px solid #0A87CD;">
                                                                                            </td>
                                                                                            <td
                                                                                                style="text-align: right; padding: 4px 4px;">
                                                                                                227</td>
                                                                                        </tr>
                                                                                    </table>
                                                                                </td>
                                                                                <td
                                                                                    style="vertical-align: top; padding-right:10px;">
                                                                                    <table class="act-tbl col-3" border="1"
                                                                                        cellpadding="0" cellspacing="0"
                                                                                        style="border: 1px solid #0A87CD; font-size: 12px; border-collapse: collapse; color:#333;">
                                                                                        <tr style="background-color: #0A87CD">
                                                                                            <td style="background-color:#0A87CD padding: 4px 4px; border: 1px solid #0A87CD; color:#fff; font-weight: bold;"
                                                                                                colspan="2">Activity</td>
                                                                                            <td
                                                                                                style="padding: 4px 4px; border: 1px solid #0A87CD; color:#fff; text-align: right; font-weight: bold;">
                                                                                                Kcal/hr</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td
                                                                                                style="font-weight: 500; color:#000; text-align: left; padding: 4px 4px;">
                                                                                                Cycling</td>
                                                                                            <td
                                                                                                style="text-align: right; padding: 4px 4px; border-right:1px solid #0A87CD;">
                                                                                                City cycling
                                                                                            </td>
                                                                                            <td
                                                                                                style="text-align: right; padding: 4px 4px; border-bottom:1px solid transparent;">
                                                                                                302</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td
                                                                                                style="font-weight: 500; color:#000; text-align: left; padding: 4px 4px;">
                                                                                            </td>
                                                                                            <td
                                                                                                style="text-align: right; padding: 4px 4px; border-right:1px solid #0A87CD;">
                                                                                                16.1 km/hr
                                                                                            </td>
                                                                                            <td
                                                                                                style="text-align: right; padding: 4px 4px; border-bottom:1px solid transparent;">
                                                                                                391</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td
                                                                                                style="font-weight: 500; color:#000; text-align: left; padding: 4px 4px;">
                                                                                            </td>
                                                                                            <td
                                                                                                style="text-align: right; padding: 4px 4px; border-right:1px solid #0A87CD;">
                                                                                                22.53 km/hr
                                                                                            </td>
                                                                                            <td
                                                                                                style="text-align: right; padding: 4px 4px; border-bottom:1px solid transparent;">
                                                                                                567</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td
                                                                                                style="font-weight: 500; color:#000; text-align: left; padding: 4px 4px;">
                                                                                            </td>
                                                                                            <td
                                                                                                style="text-align: right; padding: 4px 4px; border-right:1px solid #0A87CD;">
                                                                                                32.18 km/hr</td>
                                                                                            <td
                                                                                                style="text-align: right; padding: 4px 4px; border-bottom:1px solid transparent;">
                                                                                                932</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td
                                                                                                style="font-weight: 500; color:#000; text-align: left; padding: 4px 4px;">
                                                                                                Running</td>
                                                                                            <td
                                                                                                style="text-align: right; padding: 4px 4px; border-right:1px solid #0A87CD;">
                                                                                                8 km/hr
                                                                                            </td>
                                                                                            <td
                                                                                                style="text-align: right; padding: 4px 4px; border-bottom:1px solid transparent;">
                                                                                                523</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td
                                                                                                style="font-weight: 500; color:#000; text-align: left; padding: 4px 4px;">
                                                                                            </td>
                                                                                            <td
                                                                                                style="text-align: right; padding: 4px 4px; border-right:1px solid #0A87CD;">
                                                                                                10 km/hr
                                                                                            </td>
                                                                                            <td
                                                                                                style="text-align: right; padding: 4px 4px; border-bottom:1px solid transparent;">
                                                                                                617</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td
                                                                                                style="font-weight: 500; color:#000; text-align: left; padding: 4px 4px;">
                                                                                                Garening</td>
                                                                                            <td
                                                                                                style="text-align: right; padding: 4px 4px; border-right:1px solid #0A87CD;">
                                                                                                13 km/hr
                                                                                            </td>
                                                                                            <td
                                                                                                style="text-align: right; padding: 4px 4px;">
                                                                                                743</td>
                                                                                        </tr>
                                                                                    </table>
                                                                                </td>
                                                                                <td
                                                                                    style="vertical-align: top; padding-right:10px;">
                                                                                    <table class="act-tbl col-2" border="1"
                                                                                        cellpadding="0" cellspacing="0"
                                                                                        style="border: 1px solid #0A87CD; font-size: 12px; border-collapse: collapse; color:#333; width:100%;">
                                                                                        <tr style="background-color: #0A87CD">
                                                                                            <td
                                                                                                style="background-color:#0A87CD padding: 4px 4px; border: 1px solid #0A87CD; color:#fff; font-weight: bold;">
                                                                                                Activity</td>
                                                                                            <td
                                                                                                style="padding: 4px 4px; border: 1px solid #0A87CD; color:#fff; text-align: right; font-weight: bold;">
                                                                                                Kcal/hr</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td
                                                                                                style="font-weight: 500; color:#000; text-align: left; padding: 4px 4px; border-right:1px solid #0A87CD;">
                                                                                                Billiards/ snooker</td>

                                                                                            <td
                                                                                                style="text-align: right; padding: 4px 4px; border-bottom:1px solid transparent;">
                                                                                                44</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td
                                                                                                style="font-weight: 500; color:#000; text-align: left; padding: 4px 4px; border-right:1px solid #0A87CD;">
                                                                                                Roller skating</td>
                                                                                            <td
                                                                                                style="text-align: right; padding: 4px 4px; border-bottom:1px solid transparent;">
                                                                                                57</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td
                                                                                                style="font-weight: 500; color:#000; text-align: left; padding: 4px 4px; border-right:1px solid #0A87CD;">
                                                                                                Swimming</td>
                                                                                            <td
                                                                                                style="text-align: right; padding: 4px 4px; border-bottom:1px solid transparent;">
                                                                                                63</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td
                                                                                                style="font-weight: 500; color:#000; text-align: left; padding: 4px 4px; border-right:1px solid #0A87CD;">
                                                                                                Horseback riding</td>

                                                                                            <td
                                                                                                style="text-align: right; padding: 4px 4px; border-bottom:1px solid transparent;">
                                                                                                227</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td
                                                                                                style="font-weight: 500; color:#000; text-align: left; padding: 4px 4px; border-right:1px solid #0A87CD;">
                                                                                                Squash</td>
                                                                                            <td
                                                                                                style="text-align: right; padding: 4px 4px; border-bottom:1px solid transparent;">
                                                                                                485</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td
                                                                                                style="font-weight: 500; color:#000; text-align: left; padding: 4px 4px; border-right:1px solid #0A87CD;">
                                                                                                Badminton</td>
                                                                                            <td
                                                                                                style="text-align: right; padding: 4px 4px; border-bottom:1px solid transparent;">
                                                                                                176</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td
                                                                                                style="font-weight: 500; color:#000; text-align: left; padding: 4px 4px; border-right:1px solid #0A87CD;">
                                                                                                Table tennis</td>
                                                                                            <td
                                                                                                style="text-align: right; padding: 4px 4px;">
                                                                                                227</td>
                                                                                        </tr>
                                                                                    </table>
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td
                                                                        style="font-size: 12px; padding-top: 4px; padding-right: 6px; line-height: 16px;">
                                                                        *Approx.energy expenditure for 60 Kg reference man.
                                                                        Individuals with higher body weight will
                                                                        be spending more calories than those with lower body
                                                                        weight. Reference woman (50 kg) will be spending 5%
                                                                        less calories.
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                        <td style="vertical-align: top; width:20%;">
                                                            <table border="1" cellpadding="0" cellspacing="0"
                                                                class="act-tbl col-2"
                                                                style="border: 1px solid #0A87CD; font-size: 12px; border-collapse: collapse; color:#333;">
                                                                <tr style="background-color: #0A87CD">
                                                                    <td
                                                                        style="width: 100%; background-color:#0A87CD padding: 4px 4px; border: 1px solid #0A87CD; color:#fff; font-weight: bold;">
                                                                        Activity</td>
                                                                    <td
                                                                        style="font-weight: 500; padding: 4px 4px; border: 1px solid #0A87CD; color:#fff; text-align: right; font-weight: bold;">
                                                                        Kcal/hr</td>
                                                                </tr>
                                                                <tr>
                                                                    <td
                                                                        style="font-weight: 500; color:#000; text-align: left; padding: 4px 4px; ">
                                                                        Tennis</td>
                                                                    <td
                                                                        style="font-weight: 500; text-align: right; padding: 4px 4px;">
                                                                        353</td>
                                                                </tr>
                                                                <tr>
                                                                    <td
                                                                        style="font-weight: 500; color:#000; text-align: left; padding: 4px 4px;">
                                                                        Volleyball
                                                                    </td>
                                                                    <td
                                                                        style="font-weight: 500; text-align: right; padding: 4px 4px;">
                                                                        252</td>
                                                                </tr>
                                                                <tr>
                                                                    <td
                                                                        style="font-weight: 500; color:#000; text-align: left; padding: 4px 4px;">
                                                                        Football</td>
                                                                    <td
                                                                        style="font-weight: 500; text-align: right; padding: 4px 4px;">
                                                                        441</td>
                                                                </tr>
                                                                <tr>
                                                                    <td
                                                                        style="font-weight: 500; color:#000; text-align: left; padding: 4px 4px;">
                                                                        Basketball
                                                                    </td>
                                                                    <td
                                                                        style="font-weight: 500; text-align: right; padding: 4px 4px;">
                                                                        403</td>
                                                                </tr>
                                                                <tr>
                                                                    <td
                                                                        style="font-weight: 500; color:#000; text-align: left; padding: 4px 4px;">
                                                                        Dancing</td>
                                                                    <td
                                                                        style="font-weight: 500; text-align: right; padding: 4px 4px;">
                                                                        302</td>
                                                                </tr>
                                                                <tr>
                                                                    <td
                                                                        style="font-weight: 500; color:#000; text-align: left; padding: 4px 4px;">
                                                                        Gymnastic</td>
                                                                    <td
                                                                        style="font-weight: 500; text-align: right; padding: 4px 4px;">
                                                                        202</td>
                                                                </tr>
                                                                <tr>
                                                                    <td
                                                                        style="font-weight: 500; color:#000; text-align: left; padding: 4px 4px;">
                                                                        Yoga</td>
                                                                    <td
                                                                        style="font-weight: 500; text-align: right; padding: 4px 4px;">
                                                                        195</td>
                                                                </tr>
                                                                <tr>
                                                                    <td
                                                                        style="font-weight: 500; color:#000; text-align: left; padding: 4px 4px;">
                                                                        HIIT Workout
                                                                    </td>
                                                                    <td
                                                                        style="font-weight: 500; text-align: right; padding: 4px 4px;">
                                                                        504</td>
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
                <!-- <tr>
                    <td style="height: 20px;"></td>
                </tr> -->
                <tr>
                    <td>
                        <table border="1" cellpadding="0" cellspacing="0"
                            style="width: 94%; border: 1px solid orange; font-size: 14px; border-collapse: collapse; color:#333; margin:auto;">
                            <tr>
                                <td
                                    style="font-weight: 600; padding: 10px 15px; font-size: 14px; color: #000; height:100px; vertical-align:top;">
                                    PE Teacher's Observations and Comments (if any)</td>
                                <td
                                    style="font-weight: 600; padding: 10px 15px; font-size: 14px; color: #000; text-align:center; height:100px; vertical-align:bottom; border-left:1px solid orange;">
                                    Teacher's Signature</td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>
                        <table border="0" cellpadding="0" cellspacing="0"
                            style="width: 100%; font-size: 14px; border-collapse: collapse; color:#000;">
                            <tr>
                                <td style="border: 1px solid transparent; width:50%;">
                                    <div
                                        style="padding: 10px 0px; height: 60px; background-color: #fff; border-right: 3px solid #fff;">
                                    </div>
                                    <p style="text-align: center; font-weight: 600;">Parent's Signature</p>
                                </td>
                                <td style="border: 1px solid transparent; width:50%;">
                                    <div
                                        style="padding: 10px 0px; height: 60px; background-color: #fff; border-left: 3px solid #fff;">
                                    </div>
                                    <p style="text-align: center; font-weight: 600;">Signature of Principal with Stamp</p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td style="height:14px;"></td>
                </tr>
                <tr>
                    <td>
                        <table cellpadding="0" cellspacing="0" style="width: 100%; border:0; font-size:13px;">
                            <tr>
                                <td style="background-color: #fecd0a; height: 40px; padding: 0 30px;">Physical Health and
                                    Fitness Assessment</td>
                                <td
                                    style="background-color: #1c9b3e; height: 40px; width: 30%; padding: 0 30px; text-align:right; color:#fff;">
                                    powered by <strong>fitness365.me</strong></td>
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