@extends('layouts.filldart-app')
@section('title', 'Goforfit | ' . $title)
@section('content')


<div class="container all-chaptr-cards mt-5">
   <div class="row">
      <div class="col-12">
         <a href="#a" onclick="history.back()" class="back-button">
            <span class="arrow">
               <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                  <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5" />
               </svg>
            </span>
         </a>
         <div class="heading-rw mt-0 mb-0">
            <h1>{{$title}}</h1>
         </div>
      </div>
   </div>

<div class="row" id="skill_report1">
    <div class="col-12">
        @foreach($studentsDetails as $details)
        <div class="container-fluid1">
            <div class="row mt-5 ">
               <div class="col-12">
                  <div class=" student-info">
                     <div class="container-fluid">
                        <div class="row">
                           <div class="col-12 col-md-4 col-lg">
                              <span class="lb">Name:</span><span>{{ $details->student_name }}</span>
                           </div>
                           <div class="col-6 col-md-4 col-lg">
                              <span class="lb">Class:</span><span>{{ \App\Helpers\Helper::className($details->class_id) }}  {{ $details->section_id }}</span>
                           </div>
                           <div class="col-6 col-md-4 col-lg-2">
                              <span class="lb">Roll No:</span><span>{{ $details->rollno }}</span>
                           </div>
                           <div class="col-6 col-md-4 col-lg-2">
                              <span class="lb">DOB:</span><span>{{ $details->dob }}</span>
                           </div>
                           <div class="col-6 col-md-4 col-lg-2">
                              <span class="lb">Gender:</span><span>{{ $details->gender }}</span>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>




           
            <div class="row mt-4">            
                <!-- <div class="col-12">
                    <h1 style="text-indent: 0pt;text-align: center; margin-bottom: 30px;" class="report-heading">Skill Report </h1>
                </div> -->

                <div class="col-12 student-report">
                    <div class="grid">
                    <table cellspacing="0" cellpadding="0" class="tbl">
                       <tr class="s3">
                          <th width="220px;">Skill Area</th>
                          <th width="190px;">Skill / Sports</th>
                          <th width="120px;">Technique</th>
                          <th>Activity</th>
                          <th colspan="7" width="130px;">Rating</th>
                          <th width="140px;">Level</th>
                       </tr>

                        @php
                            $activityTitlesDisplayed = [];
                        @endphp

                        @foreach($details['StudentReport'] as $records)


                            @php 
                                $activityTitle = $records['activity']['title']  ?? 'N.A.';
                            @endphp

                            @if (!in_array($activityTitle, $activityTitlesDisplayed))

                           <tr>
                              
                              <td >
                                 <p class="s4">
                                    {{ $records['skillArea']['name'] ?? 'N.A' }}
                                 </p>
                              </td>
                              <td>
                                 <p class="s4">
                                    {{ $records['sport']['name'] ?? 'N.A' }}
                                 </p>
                              </td>
                              <td>
                                 <p class="s4">
                                    {{ $records['technique']['name'] ?? 'N.A.'}}
                                 </p>
                              </td>
                              <td>
                                 <p class="s4">
                                    {{ $records['activity']['title'] ?? 'N.A' }}
                                 </p>
                              </td>
                              <?php for ($i=0; $i < $records['level'] ; $i++) {  ?>
                              <td class="star">
                                 <p class="s5">&#9733;</p>
                              </td>
                              <?php } ?>
                              <?php for ($i=0 ; $i < 7-$records['level'] ; $i++ ) { ?>
                              <td class="star">
                                 <p class="s5">&#9734;</p>
                              </td>
                              <?php } ?>
                              <?php  
                                 switch ($records['level']) {
                                         case '1':
                                             $level = 'Beginning';
                                             break;
                                     
                                         case '2':
                                             $level = 'Learning';
                                             break;
                                     
                                         case '3':
                                             $level = 'Progressing';
                                             break;
                                     
                                         case '4':
                                             $level = 'Developing';
                                             break;
                                     
                                         case '5':
                                             $level = 'Desired';
                                             break;

                                         case '6':
                                             $level = 'Proficient';
                                             break;

                                         case '7':
                                             $level = 'Exemplary';
                                             break;

                                         default:
                                             $level = 'Absent';
                                             break;
                                     }
                                 ?>
                              <td style="width:12pt;border-top-style:solid;border-top-width:1pt;border-top-color:#eeedf4;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#eeedf4; padding-top:2px; padding-bottom:6px; padding-left: 15px;">
                                 
                                 @php
                                    $data = json_decode($records, true);
                                    $description = $data['level']['description']  ?? 'N.A';
                                 @endphp

                                 <p class="s4" data-toggle="tooltip" data-placement="bottom" data-delay='{"show":"3000", "hide":"3000"}' title="{{ $description  }}" style="padding-top: 3pt;padding-right: 2pt;text-indent: 0pt;text-align: left;">       
                                    {{ $level  }}
                                 </p>

                              </td>
                           </tr>

                            @php 
                                $activityTitlesDisplayed[] = $activityTitle;
                            @endphp

                        @endif

                       @endforeach
                    </table>
                    </div>
                </div>
            </div>
            

             {{--
            @if(!empty($studentProfile['reportCardDetails']) && collect($studentProfile['reportCardDetails'])->isNotEmpty())
            <div class="row mt-4">
               <div class="col-12 student-report">
                     <div class="grid">
                        
                        

                           <table cellspacing="0" cellpadding="0" class="tbl">
                              <tr class="s3">
                                 <th width="170px;">Skill / Sports</th>
                                 <th width="170px;">Technique</th>
                                 <th>Activity</th>
                                 <th colspan="7" width="130px;">Rating</th>
                                 <th width="140px;">Level</th>
                              </tr>

                                 @foreach(collect($studentProfile['reportCardDetails'])->sortKeys() as $skillName => $skillarea)

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
                                                   <td rowspan="{{ $sportRowspan }}" style="text-align: center;"><p class="s4">{{ $skillName ?? 'N.A' }}</p></td>
                                                   @php $sportFirstRow = false; @endphp
                                                @endif

                                                @if(!isset($techniqueFirstRow))
                                                   @php $techniqueFirstRow = true; @endphp
                                                @endif

                                                @if($techniqueFirstRow)
                                                  <td rowspan="{{ $techniqueRowspan }}" style="text-align: center;"><p class="s4">{{ $techniqueName ?? 'N.A' }}</p></td>
                                                  @php $techniqueFirstRow = false; @endphp
                                                @endif

                                                <td><p class="s4">{{ $activity_title ?? 'N.A' }}</p></td>
                                                <td class="star" colspan="7" style="text-align: left;">
                                                @for ($i = 0; $i < $outcomes['level']; $i++)
                                                   
                                                      <span class="s5">&#9733;</span>
                                                   
                                                   
                                                @endfor

                                                 @for ($i = 0; $i < 7 - $outcomes['level']; $i++)
                                                   <span class="s5">&#9734;</span>
                                                @endfor
                                                </td>

                                                <!-- @for ($i = 0; $i < 7 - $outcomes['level']; $i++)
                                                   <td class="star"  style="text-align: center;"><p class="s5">&#9734;</p></td>
                                                @endfor -->

                                                <td><p class="s4">{{ $outcomes['level_name'] ?? 'N.A' }}</p></td>
                                             </tr>
                                          @endforeach   
                                       @endforeach

                                       @php unset($techniqueFirstRow); @endphp

                                    @endforeach
                                 @endforeach
                              @else

                              <div class="col-12 col-md-12">
                                    <div class="my-5" style="text-align: center;">
                                        <h5 class="m-0">Report Not Available</h5> 
                                    </div>
                              </div>

                           </table>
                           
                     </div>
                  </div>
            </div>
            @endif

            --}}
        </div>
    </div>
    </hr>
    @endforeach


    <button class="btn btn-link collapsed mt-4" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree"> Rubric Descriptions </button>
    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
       <div class="card-body">
          <table class="table table-bordered mt-4">
             <thead>
                <tr>
                   <th scope="col">Level</th>
                   <th scope="col">Level Name</th>
                   <th scope="col">Description</th>
                </tr>
             </thead>
             <tbody>
                @foreach($levels as $level)
                <tr>
                   <td>L-{{$level->level_value}} </td>
                   <td> {{$level->level_name}} </td>
                   <td> {{$level->description}} </td>
                </tr>
                @endforeach              
             </tbody>
          </table>
       </div>
    </div>
 
</div>
</div>
@endsection