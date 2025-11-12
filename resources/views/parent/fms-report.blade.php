@extends('layouts.filldart-app')
@section('title', 'Goforfit | ' . $title)
@section('content')


<div class="container all-chaptr-cards mt-5">
   <div class="row">
      <div class="col-12">
         <a href="{{ route('student.dashboard') }}" class="back-button">
            <span class="arrow">
               <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                  <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5" />
               </svg>
            </span>
         </a>
         <div class="heading-rw mt-2 mb-2">
            <h1>{{$title}}</h1>
			
            @php
               $classSection = \App\Helpers\Helper::ClassSectionName($studentInfo->custom_class_id);
            @endphp
         
            {{-- <p><a href="{{ route('fms.skills.reports.pdf') }}">Download PDF</a></p> --}}
			
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-12">
         <div class="mt-5">
            <div class="stu__report__area">
               <div class="stu__bmi">
                  <div class="std-report-info">
                     <p><span>Name: </span>{{ $studentInfo->student_name }}</p>
                     <p><span>Class: {{ $classSection->name.'-'.$classSection->section }}</span></p>
                     <p><span>User ID: </span>{{ $studentInfo->user_id }}</p>
                     <p><span>Gender/DOB: </span>{{ $studentInfo->gender }}/{{ $studentInfo->dob }}</p>
                     <p><span>School: </span>{{ $studentInfo->school_name }}</p>
                  </div>

				  
               </div>
               <div class="stu__report mt-3">
                  <!--<h2>FMS Development Report</h2>-->
                  <h3 class="mt-3 mb-0">Locomotor Skills</h3>
                  <div class="test__tble mt-3">

                     @if(!empty($ReportDetail1) && count($ReportDetail1) > 0)
                     <table>
                        <tr>
                           <th width="50px">P1</th>
                           <th>{{ $ReportDetail1[0]->skill_name }}</th>
                           <th width="70px">Term 1</th>
                           <th width="70px">Term 2</th>
                        </tr>				 
                        
                        @foreach($ReportDetail1 as $key => $val) 
                        <tr>
                           <td>{{ $val->skill_type_name }}</td>
                           <td>{{ $val->description }}</td>
                           <td>@if($val->skill_type_value == 'Y') <img src="{{ asset('public/assets/imgs/check.svg') }}">
                           @endif
                           </td>
                           <td></td>
                        </tr>
                        @endforeach				  
                     </table>
                     @endif

                     @if(!empty($ReportDetail2) && count($ReportDetail2) > 0)
                     <table>				  
                        <tr>
                           <th width="50px">P2</th>
                           <th>{{ $ReportDetail2[0]->skill_name }}</th>
                           <th width="70px">Term 1</th>
                           <th width="70px">Term 2</th>
                        </tr>
                  
                        @foreach($ReportDetail2 as $key2 => $val2) 
                        <tr>
                           <td>{{ $val2->skill_type_name }}</td>
                           <td>{{ $val2->description }}</td>
                           <td>@if($val2->skill_type_value == 'Y') <img src="{{ asset('public/assets/imgs/check.svg') }}">
                           @endif
                           </td>
                           <td></td>
                        </tr>
                        @endforeach				  
                     </table>
                     @endif
               
                     @if(!empty($ReportDetail3) && count($ReportDetail3) > 0)
                     <table>				  
                        <tr>
                           <th width="50px">P3</th>
                           <th>{{ $ReportDetail3[0]->skill_name }}</th>
                           <th width="70px">Term 1</th>
                           <th width="70px">Term 2</th>
                        </tr>
                     
                        @foreach($ReportDetail3 as $key3 => $val3) 
                           <tr>
                              <td>{{ $val3->skill_type_name }}</td>
                              <td>{{ $val3->description }}</td>
                              <td>@if($val3->skill_type_value == 'Y') <img src="{{ asset('public/assets/imgs/check.svg') }}">
                              @endif
                              </td>
                              <td></td>
                           </tr>
                        @endforeach				  
                     </table>
                     @endif
               
                     @if(!empty($ReportDetail4) && count($ReportDetail4) > 0)
                     <table>				  
                        <tr>
                           <th width="50px">P4</th>
                           <th>{{ $ReportDetail4[0]->skill_name }}</th>
                           <th width="70px">Term 1</th>
                           <th width="70px">Term 2</th>
                        </tr>
                     
                        @foreach($ReportDetail4 as $key4 => $val4) 
                        <tr>
                           <td>{{ $val4->skill_type_name }}</td>
                           <td>{{ $val4->description }}</td>
                           <td>@if($val4->skill_type_value == 'Y') <img src="{{ asset('public/assets/imgs/check.svg') }}">
                           @endif
                           </td>
                           <td></td>
                        </tr>
                        @endforeach				  
                     </table>
                     @endif

                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection