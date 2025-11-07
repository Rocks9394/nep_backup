


<div style="font-family: Arial, Helvetica, sans-serif; font-size:12px;" >
   <br>
   <br>
   <br>
   <br>
   <br>
   {{--
   <table style="width: 100%;" cellpadding="0" cellspacing="0">
      <tr>
         <td>  
            <img src="data:image/png;base64,{{ base64_encode(file_get_contents( url('storage/pragyanam-logo-2.png'))) }}" alt="Check" height="50" />
         </td>		 
         <td style="text-align: right;"> 
            <img src="data:image/png;base64,{{ base64_encode(file_get_contents(url('storage/gofor-fit-logo.png'))) }}" alt="Check" height="44" />
         </td>
      </tr>
   </table>
  
    

     
   --}}


   @php
   $classSection = \App\Helpers\Helper::ClassSectionName($studentInfo->custom_class_id);
   @endphp

   <!-- Student Info Start -->
   <table style="width: 100%; border:1px solid #000;" cellpadding="3" cellspacing="3">
      <tr>
         <td><span>Name: </span>{{ $studentInfo->student_name }}</td>
         <td><span>Class: </span>{{ $classSection->name.'-'.$classSection->section }}</td>
      </tr>
      <tr>
         <td><span>User ID: </span>{{ $studentInfo->user_id }}</td>
         <td><span>Gender:</span>{{ $studentInfo->gender }}</td>
         <td><span>DOB: </span>{{ $studentInfo->dob }}</td>
      </tr>
      <tr>
         <td><span>School: </span>{{ $studentInfo->school_name }}</td>
      </tr>
   </table>

   <!-- Student Info End -->
   <br>
   <!-- <br> -->
   <h1 style="font-size: 20px;">FMS Development Report</h1>
   {{-- <h2 style="font-size: 16px;">Locomotor Skills</h2> --}}
	@if($ReportDetail1->isNotEmpty())
   <table cellpadding="3" cellspacing="3" style="width: 100%; border-top:1px solid #000; border-left:1px solid #000; border-right:1px solid #000;">
      <tr>
         <th width="50px" style="text-align: left;">P1</th>
         <th width="80%" style="text-align: left;">{{ $ReportDetail1[0]->skill_name }}</th>
         <th width="70px">Term 1</th>
         <th width="70px">Term 2</th>
      </tr>

     @foreach($ReportDetail1 as $key => $val)
      <tr>
         <td>{{ $val->skill_type_name }}</td>
         <td>{{ $val->description }}</td>
         <td style="text-align: center;">@if($val->skill_type_value == 'Y')
			 <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('assets/imgs/check.png'))) }}" alt="Check" />
            @endif
         </td>
         <td style="text-align: center;">@if($val->skill_type_value2 == 'Y')
			 <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('assets/imgs/check.png'))) }}" alt="Check" />
            @endif</td>
      </tr>
      @endforeach

   </table>
   
   
   @else
    <p>No data available for: Running.</p>
@endif


@if ($ReportDetail2->isNotEmpty())
   <table cellpadding="3" cellspacing="3" style="width: 100%; border-top:1px solid #000; border-left:1px solid #000; border-right:1px solid #000;">

      <tr>
         <th width="50px" style="text-align: left;">P2</th>
         <th width="80%" style="text-align: left;">{{ $ReportDetail2[0]->skill_name }}</th>
         <th width="70px">Term 1</th>
         <th width="70px">Term 2</th>
      </tr>

      @foreach($ReportDetail2 as $key2 => $val2)
      <tr>
         <td>{{ $val2->skill_type_name }}</td>
         <td>{{ $val2->description }}</td>
		 
		
         <td style="text-align: center;">@if($val2->skill_type_value == 'Y')  <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('assets/imgs/check.png'))) }}" alt="Check" />
            @endif
         </td>
         <td style="text-align: center;">@if($val2->skill_type_value2 == 'Y')  <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('assets/imgs/check.png'))) }}" alt="Check" />
            @endif</td>
      </tr>
      @endforeach

   </table>
@else
     <p>No data available for: Hopping.</p>
@endif


@if ($ReportDetail3->isNotEmpty())
   <table cellpadding="3" cellspacing="3" style="width: 100%; border-top:1px solid #000; border-left:1px solid #000; border-right:1px solid #000;">

      <tr>
         <th width="50px" style="text-align: left;">P3</th>
         <th width="80%" style="text-align: left;">{{ $ReportDetail3[0]->skill_name }}</th>
         <th width="70px">Term 1</th>
         <th width="70px">Term 2</th>
      </tr>


      @foreach($ReportDetail3 as $key3 => $val3)
      <tr>
         <td>{{ $val3->skill_type_name }}</td>
         <td>{{ $val3->description }}</td>
         <td style="text-align: center;">@if($val3->skill_type_value == 'Y')  <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('assets/imgs/check.png'))) }}" alt="Check" />
            @endif
         </td>
         <td style="text-align: center;">@if($val3->skill_type_value2 == 'Y')  <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('assets/imgs/check.png'))) }}" alt="Check" />
            @endif</td>
      </tr>
      @endforeach

   </table>
@else
    <p>No data available for: Jumping & Landing.</p>
@endif


@if ($ReportDetail4->isNotEmpty())
   <table cellpadding="3" cellspacing="3" style="width: 100%; border:1px solid #000;">

      <tr>
         <th width="50px" style="text-align: left;">P4</th>
         <th width="80%" style="text-align: left;">{{ $ReportDetail4[0]->skill_name }}</th>
         <th width="70px">Term 1</th>
         <th width="70px">Term 2</th>
      </tr>

      @foreach($ReportDetail4 as $key4 => $val4)
      <tr>
         <td>{{ $val4->skill_type_name }}</td>
         <td>{{ $val4->description }}</td>
         <td style="text-align: center;">@if($val4->skill_type_value == 'Y')  <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('assets/imgs/check.png'))) }}" alt="Check" />
            @endif
         </td>
         <td style="text-align: center;">@if($val4->skill_type_value2 == 'Y')  <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('assets/imgs/check.png'))) }}" alt="Check" />
            @endif</td>
      </tr>
      @endforeach

   </table>
   @else
    <p>No data available for: One-Foot Balance.</p>
@endif
</div>