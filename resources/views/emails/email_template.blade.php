<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
  
<head>
  <meta name="robots" content="noindex, nofollow" />
  <meta name="referrer" content="no-referrer" />
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="color-scheme" content="light dark">
  <meta name="supported-color-schemes" content="light dark">
  <title>Grids Master Template</title>

  <style type="text/css">
    CLIENT-SPECIFIC STYLES body,
    table,
    td,
    a {
      -webkit-text-size-adjust: 100%;
      -ms-text-size-adjust: 100%;
    }

    table,
    td {
      mso-table-lspace: 0pt;
      mso-table-rspace: 0pt;
    }

    img {
      -ms-interpolation-mode: bicubic;
      border-radius: 12px;
    }

    /* RESET STYLES */
    img {
      border: 0;
      outline: none;
      text-decoration: none;
    }

    table {
      border-collapse: collapse !important;
    }

    body {
      margin: 0 !important;
      padding: 0 !important;
      width: 100% !important;
    }

    /* iOS BLUE LINKS */
    a[x-apple-data-detectors] {
      color: inherit !important;
      text-decoration: none !important;
      font-size: inherit !important;
      font-family: inherit !important;
      font-weight: inherit !important;
      line-height: inherit !important;
    }

    /* ANDROID CENTER FIX */
    div[style*="margin: 16px 0;"] {
      margin: 0 !important;
    }

    /* MEDIA QUERIES */
    @media all and (max-width:639px) {
      .wrapper {
        width: 320px !important;
        padding: 0 !important;
      }

      .container {
        width: 300px !important;
        padding: 0 !important;
      }

      .mobile {
        width: 300px !important;
        display: block !important;
        padding: 0 !important;
      }

      .img {
        width: 100% !important;
        height: auto !important;
      }

      *[class="mobileOff"] {
        width: 0px !important;
        display: none !important;
      }

      *[class*="mobileOn"] {
        display: block !important;
        max-height: none !important;
      }
    }

    /* DARK MODE STYLES */
    :root {
      color-scheme: light dark;
      supported-color-schemes: light dark;
      -webkit-font-smoothing: antialiased;
      -moz-osx-font-smoothing: grayscale;
    }

    @media (prefers-color-scheme: dark) {

      body {
        background-color: #262626 !important;
      }

      [data-ogsb] body {
        background-color: #262626 !important;
      }

      table {
        background-color: #212121 !important;
      }

      [data-ogsb] table {
        background-color: #212121 !important;
      }

      .logo-light {
        display: none;
        display: none !important;
      }

      [data-ogsc] .logo-light {
        display: none !important;
      }

      .logo-dark {
        display: block !important;
      }

      [data-ogsc] .logo-dark {
        display: block !important;
      }

      h1 {
        color: #FFFFFF !important;
      }

      [data-ogsc] h1 {
        color: #FFFFFF !important;
      }

      h2 {
        color: #FFFFFF !important;
      }

      [data-ogsc] h2 {
        color: #ffffff !important;
      }

      h3 {
        color: #FFFFFF !important;
      }

      [data-ogsc] h3 {
        color: #FFFFFF !important;
      }

      h4 {
        color: #FFFFFF !important;
      }

      [data-ogsc] h4 {
        color: #FFFFFF !important;
      }

      h5 {
        color: #FFFFFF !important;
      }

      [data-ogsc] h5 {
        color: #FFFFFF !important;
      }

      h6 {
        color: #FFFFFF !important;
      }

      [data-ogsc] h6 {
        color: #FFFFFF !important;
      }

      .hr {
        background: #FFFFFF !important;
      }

      [data-ogsc] .hr {
        background: #FFFFFF !important;
      }

      p {
        color: #ffffff !important;
      }

      [data-ogsc] p {
        color: #FFFFFF !important;
      }

      li {
        color: #FFFFFF !important;
      }

      [data-ogsc] li {
        color: #FFFFFF !important;
      }

      li>span {
        color: #FFFFFF !important;
      }

      [data-ogsc] li>span {
        color: #FFFFFF !important;
      }

      .link {
        color: #FFFFFF !important;
      }

      [data-ogsc] .link {
        color: #FFFFFF !important;
      }

      .button {
        background-color: #FFFFFF !important;
        color: #000000 !important;
      }

      [data-ogsb] .button {
        background-color: #FFFFFF !important;
        color: #000000 !important;
      }

    }
  </style>

</head>

<body style="margin:0; padding:0; background-color:#292775; font-family: Arial, Helvetica, sans-serif;">
  
 <!--  <div style="display:none;">Preheader Text</div>
  <div style="background-color: #292775; height: 550px; width: 100%; position:absolute; top:0; left:0; right:0; z-index:-1; border-bottom: 8px solid #FF8000;"></div> -->

  <!-- <div style="text-align: left;"> -->
    
    <table width="100%" border="0" cellpadding="0" cellspacing="0" style="border-bottom: 8px solid #FF8000;">
      <tr>
        <td height="20" style="font-size:10px; line-height:10px;">&nbsp;</td>
      </tr>

      <tr>
        <td align="center" valign="top">

          <!-- company Logos -->
          <table width="600" cellpadding="10" cellspacing="0" border="0" class="wrapper" style="background-color: #ffffff; border-radius: 12px;">
            <tr>
              <td align="center" valign="top">
                <!-- Header -->
                <table width="580" cellpadding="0" cellspacing="0" border="0" class="container">
                  <tr>
                    <td width="290" class="mobile" align="left" valign="top">
                      <img src="{{ asset('public/logo/'.$reportDetail['schooldata']['logo']) }}" alt="" height="50px">
                    </td>
                    <td width="290" class="mobile" align="right" valign="top">
                      <img src="{{ asset('public/logo/fitness365-logo.png') }}" alt="" height="50px">
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>


          <!-- Company Description -->
          <table width="600" cellpadding="0" cellspacing="0" border="0" class="wrapper">
            <tr>
              <td height="10" style="font-size:10px; line-height:10px;">&nbsp;</td>
            </tr>
            <tr>
              <td valign="top" align="center">

                <table width="580" cellpadding="0" cellspacing="0" border="0" class="container">
                  <tr>
                    <td valign="top" style="color: #ffffff; font-size:14px;">
                      <h1>Empowering Your Child’s Future Through Fitness!</h1>
                      <p style="color: rgba(255 255 255/80%); line-height: 24px;">Fitness365 is transforming Physical Education with structured programs that build strength, discipline, and confidence — helping every child thrive in body and mind.</p>
                    </td>
                  </tr>
                </table>

              </td>
            </tr>
            <tr>
              <td height="10" style="font-size:10px; line-height:10px;">&nbsp;</td>
            </tr>
          </table>

          <!-- Dynamic Data (Student's Report)-->          
          <table width="600" cellpadding="0" cellspacing="0" border="0" class="wrapper" bgcolor="#FFFFFF" style=" border-radius: 12px; box-shadow: 0 1px 3px rgba(0 0 0/20%); margin-bottom: 50px;">
            
            <tr>
              <td height="10" style="font-size:10px; line-height:10px;">&nbsp;</td>
            </tr>

            <tr>
              <td align="center">
                <table width="580" cellpadding="0" cellspacing="0" border="0" class="container" style="font-size:14px;">
                  <tr>
                    <td style="color:#333333;">
                      <p>Dear Parent,</p>
                      <p style="line-height: 24px;">We are pleased to share your child’s <strong style="color:#292775;">Monthly Physical Education & Fitness Report</strong> as part of our ongoing program with Fitness365 at <strong><span style="color:#FF8000;">{{ $reportDetail['schooldata']['school_name'] }} </span></strong></p>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>

            <tr>
              <td height="10" style="font-size:10px; line-height:10px;">&nbsp;</td>
            </tr>

            @if(!empty($reportDetail['reportCardDetails']) && collect($reportDetail['reportCardDetails'])->isNotEmpty())

              <!-- Students Personal Details -->
              <tr>
                <td style="color:#333333;">
                  <h3 style="width: 580px; margin: auto; margin-bottom: 15px; font-size: 14px;">
                    <span style=" font-style: italic;">{{ $reportDetail['studentProfile']['name'] }}'s</span> <span style="font-style: italic;">{{ $reportDetail['studentProfile']['report_month'] }}  {{ $reportDetail['studentProfile']['report_year'] }}</span> <span style="font-weight:normal;">Activities</span></h3>
                </td>
              </tr>

              <!-- Report Details -->
              <tr>
                <td valign="top">      
                  <table width="580" cellpadding="4" cellspacing="0" border="1" class="container" style="margin: auto; border-color: #292775; text-align: left; font-size:12px;">
                      <tr class="s3" style="background-color: #292775; color: #FFFFFF;">
                        <th width="90px;">Skill / Sports</th>
                        <th width="80px;">Technique</th>
                        <th>Activity</th>
                        <th width="75px" colspan="7">Rating</th>                        
                        <th width="80px;">Level</th>
                      </tr>

                      @foreach(collect($reportDetail['reportCardDetails'])->sortKeys() as $skillName => $skillarea)

                        @php
                           $sportRowspan = 0;
                           foreach($skillarea as $technique){
                              $sportRowspan += count($technique); 
                           }
                           $sportFirstRow = true; 
                        @endphp

                        @foreach(collect($skillarea)->sortKeys() as $techniqueName => $activities)
                          @php $techniqueRowspan = count($activities); @endphp

                          @foreach(collect($activities)->sortKeys() as $activity_title => $activity)

                            @foreach($activity as $outcomes)

                              <tr>
                                @if($sportFirstRow)
                                   <td rowspan="{{ $sportRowspan }}" style="text-align: center;">
                                    <p class="s4" style="margin: 3px 0;">{{ $skillName ?? 'N.A' }}</p></td>
                                   @php $sportFirstRow = false; @endphp
                                @endif

                                @if(!isset($techniqueFirstRow))
                                   @php $techniqueFirstRow = true; @endphp
                                @endif

                                @if($techniqueFirstRow)
                                <td rowspan="{{ $techniqueRowspan }}" style="text-align: center;">
                                  <p class="s4" style="margin: 3px 0;">{{ $techniqueName ?? 'N.A' }}</p></td>
                                  @php $techniqueFirstRow = false; @endphp
                                @endif

                                <td><p class="s4" style="margin: 3px 0;">{{ $activity_title ?? 'N.A' }}</p></td>

                                <td class="star" colspan="7" style="text-align: center;">
                                  <img src="{{ asset('public/assets/imgs/ratings/r'.$outcomes['level'].'.png') }}" alt="ratings" height="12px">                                  
                                </td>         

                                <td><p class="s4" style="margin: 3px 0;">{{ $outcomes['level_name'] ?? 'N.A' }}</p></td>
                              </tr>
                            @endforeach   
                          @endforeach

                          @php unset($techniqueFirstRow); @endphp

                        @endforeach
                     @endforeach
                  </table>
                </td>
              </tr>
              
            @endif

              <tr>
                <td>
                  <table width="580" cellpadding="4" cellspacing="0" border="0" class="container" style="margin: 15px auto 0px auto; font-size:12px;">
                    <tr>
                      <td style="background-color: #ffebd7; color:#333333; border-radius: 6px; padding: 0 10px;">
                        <p style="line-height: 18px;">Log into <a href="https://goforfit.in/login" target="_blank" style="color: #FF8000;"><strong>https://goforfit.in/login</strong></a> with your <strong>Username</strong> and <strong>Password</strong> to view details about your child’s physical development, including fitness levels, participation in Sports and Physical activities, skill improvement, and overall progress</p>
                      </td>
                    </tr>

                  </table>
                </td>
              </tr>

              <tr>
                <td height="10" style="font-size:10px; line-height:10px;">&nbsp;</td>
              </tr>
          </table>
        </td>
      </tr>
    </table>


    <!-- Active Life Style -->
    <table width="100%" border="0" cellpadding="0" cellspacing="0" style="background-color: #E6E6F2; width: 100%; text-align: center;">
      <tr>
        <td align="center" style="padding: 50px 0;">

          <table width="580" cellpadding="0" cellspacing="0" border="0" class="container">
            <tr>
              <td align="center" valign="top">
                <table width="80%" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td align="center">
                      <table border="0" cellpadding="0" cellspacing="0" width="95%">
                        <tr>
                          <td style="text-align: center; color: #333333;">
                          <p style="text-transform: uppercase; font-size: 14px;">Encourage your child to lead an active lifestyle</p>
                          <h2>Suggested daily routine for students (Age & Class-wise)</h2>
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
                <table width="600" cellpadding="0" cellspacing="0" border="0" class="container" style="font-size:14px;">
                  <tr>
                    <td>
                      <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                        <div class="card-body p-0">
                          <table class="table table-bordered mt-4" border="1" width="600" cellpadding="4" cellspacing="0" style="border-color: #292775; text-align: left; font-size:14px;">
                            <thead style="background-color: #292775; color: #FFFFFF;">
                              <tr>
                                <th scope="col" width="12.5%">Class</th>
                                <th scope="col" width="12.5%">Sleep</th>
                                <th scope="col" width="12.5%">Study</th>
                                <th scope="col" width="12.5%">Play</th>
                                <th scope="col" width="12.5%">Watch TV</th>
                                <th scope="col" width="12.5%">Eating</th>
                                <th scope="col" width="12.5%">School</th>
                                <th scope="col" width="12.5%">Assignment</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>1-3</td>
                                <td>9 Hrs</td>
                                <td>1 Hr</td>
                                <td>2 Hrs</td>
                                <td>1 Hr</td>
                                <td>1 Hr</td>
                                <td>7 Hrs</td>
                                <td>1 Hr</td>
                              </tr>
                              <tr>
                                <td>4-5</td>
                                <td>9 Hrs</td>
                                <td>1 Hr</td>
                                <td>2 Hrs</td>
                                <td>1 Hr</td>
                                <td>1 Hr</td>
                                <td>7 Hrs</td>
                                <td>1 Hr</td>
                              </tr>
                              <tr>
                                <td>6-8</td>
                                <td>9 Hrs</td>
                                <td>1 Hr</td>
                                <td>2 Hrs</td>
                                <td>1 Hr</td>
                                <td>1 Hr</td>
                                <td>7 Hrs</td>
                                <td>1 Hr</td>
                              </tr>
                              <tr>
                                <td>9-10</td>
                                <td>9 Hrs</td>
                                <td>1 Hr</td>
                                <td>2 Hrs</td>
                                <td>1 Hr</td>
                                <td>1 Hr</td>
                                <td>7 Hrs</td>
                                <td>1 Hr</td>
                              </tr>
                              <tr>
                                <td>11-12</td>
                                <td>9 Hrs</td>
                                <td>1 Hr</td>
                                <td>2 Hrs</td>
                                <td>1 Hr</td>
                                <td>1 Hr</td>
                                <td>7 Hrs</td>
                                <td>1 Hr</td>
                              </tr>

                            </tbody>
                          </table>
                        </div>
                      </div>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
      </tr>
    </table>

    <!-- Blogs -->
    <table width="100%" border="0" cellpadding="0" cellspacing="0" style="width: 100%; text-align: center; background-color: #FF8000;">
      <tr>
        <td align="center" style="padding: 30px 0; 50px 0;">
          <table width="600" cellpadding="0" cellspacing="0" border="0" class="wrapper">
            <tr>
              <td height="10" style="font-size:10px; line-height:10px;">&nbsp;</td>
            </tr>
            <tr>
              <td align="center" valign="top">
                <table width="80%" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td align="center" style="color: #ffffff;">
                      <p style="text-transform: uppercase; font-size: 14px;">Fitness Community</p>
                      <h2>Be the Role Model – Start Your Family’s Fitness Journey With Us!</h2>
                    </td>
                  </tr>
                </table>

              </td>
            </tr>
            <tr>
              <td height="10" style="font-size:10px; line-height:10px;">&nbsp;</td>
            </tr>
            <tr>
              <td align="center" valign="top">

                <table width="100%" cellpadding="0" cellspacing="0" border="0" class="container">
                  <tr>
                    <td class="mobile" align="center" valign="top">
                      <a href="https://liveplus.in/2021/04/14/how-to-find-the-best-at-home-workouts-for-you/" style="display: block; text-decoration: none; background-color: #ffffff; color:#333333; overflow: hidden; border-radius: 10px; margin-right: 7px; width: 98%; height: 100%;">
                        <div style="display: block; border-radius: 0px; width: 100%;">
                          <img src="https://liveplus.in/new-template/assets/img_blog1.png" alt="" style="border-radius: 0px; aspect-ratio: 16/9; width: 100%; height: auto;">
                        </div>
                        <div style="padding: 0 15px;">
                          <h2 style="font-size: 16px; line-height: 1.35rem; text-align: left; min-height: 44px;">
                            How to find the best at Home Workouts for you
                          </h2>
                        </div>
                      </a>

                    </td>
                    <td class="mobile" align="center" valign="top">
                      <a href="https://liveplus.in/2021/05/13/four-exercises-to-increase-focus/" style="display: block; text-decoration: none; background-color: #ffffff; color:#333333; overflow: hidden; border-radius: 10px; margin-left: 7px; width: 98%; height: 100%;">
                        <div style="display: block; border-radius: 0px; width: 100%;">
                          <img src="https://liveplus.in/new-template/assets/img_blog2.png" alt="" style="border-radius: 0px; aspect-ratio: 16/9; width: 100%; height: auto;">
                        </div>
                        <div style="padding: 0 15px;">
                          <h2 style="font-size: 16px; line-height: 1.35rem; text-align: left; min-height: 44px;">
                          Four exercises to increase focus
                          </h2>
                        </div>
                      </a>
                    </td>

                  </tr>
                  <tr>
                    <td class="mobile" align="center" valign="top" colspan="2" style="padding: 50px 0 20px 0;">
                      <a href="https://liveplus.in" target="_blank" style="padding: 15px 20px; background-color: #ffffff; border-radius: 8px; color: #292775; text-decoration: none; font-weight: bold;">Join Our Community</a>
                    </td>
                  </tr>
                </table>

              </td>
            </tr>
            <tr>
              <td height="10" style="font-size:10px; line-height:10px;">&nbsp;</td>
            </tr>
          </table>
        </td>
      </tr>
    </table>

    <!-- Footer -->
    <table width="100%" border="0" cellpadding="0" cellspacing="0" style="background-color: #000000; width: 100%; text-align: center; font-size: 14px;">
    <tr>
        <td align="center">
          <table width="640" cellpadding="0" cellspacing="0" border="0" class="wrapper">
            <tr>
              <td height="10" style="font-size:10px; line-height:10px;">&nbsp;</td>
            </tr>
            <tr>
              <td align="center" valign="middle">

                <table width="600" cellpadding="0" cellspacing="0" border="0" class="container">
                  <tr>
                    <td width="300" class="mobile" align="left" valign="middle">
                      <a href="https://fitness365.me" target="_blank" style="color: #999999; text-decoration: none; display: flex; align-items: center; gap: 10px;"><img src="https://liveplus.in/new-template/assets/web.png" alt="" style="border-radius: 0px; aspect-ratio: 1/1; width: 24px; height: 24px;"><span>https://fitness365.me</span></a>
                    </td>
                    <td width="300" class="mobile" align="right" valign="middle">
                      <div style="display: flex; align-items: center; justify-content: right; color: #999999; gap: 10px; padding: 10px 0;">
                        <span>Follow me on</span>
                        <a href="https://www.facebook.com/fitness365india" target="_blank"><img src="https://liveplus.in/new-template/assets/facebook.png" alt="" style="border-radius: 0px; aspect-ratio: 1/1; width: 24px; height: 24px;"></a>
                        <a href="https://www.instagram.com/fitness365india/" target="_blank"><img src="https://liveplus.in/new-template/assets/instagram.png" alt="" style="border-radius: 0px; aspect-ratio: 1/1; width: 24px; height: 24px;"></a>
                        <a href="https://www.youtube.com/Fitness365india" target="_blank"><img src="https://liveplus.in/new-template/assets/youtube.png" alt="" style="border-radius: 0px; aspect-ratio: 1/1; width: 24px; height: 24px;"></a>
                      </div>
                    </td>
                  </tr>
                </table>

              </td>
            </tr>
            <tr>
              <td height="10" style="font-size:10px; line-height:10px;">&nbsp;</td>
            </tr>
          </table>

          </div>
        </td>
      </tr>
    </table>


</body>
</html>
