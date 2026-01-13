@extends('layouts.filldart-app')
@section('title', 'Goforfit | ' . $title)
@section('content')


<style type="text/css">
p.card-text {
        font-size: 29px;
    text-align: center;
    margin-top: 20px;
}

h5.card-title {
    text-align: center;
    margin-top: 23px;
}

.table thead th {
    border-bottom: 0px;
    background-color: #434386;
    color: #fff;
}

.students_count {
    display: flex;
    justify-content: center;
    column-gap: 15px;
    margin-top: 16px;
}

.students_count p{
   font-weight: 500;
}

</style>

<div class="container all-chaptr-cards mt-5">
   <div class="row">
      <div class="col-12">
        <div class="heading-rw mt-0 mt-md-1 mb-0 p-0">
          <a href="{{ route('filldart.dashboard') }}"  class="back-button">
              <span class="arrow">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5" />
                </svg>
              </span>
          </a>
          <h1 class="ml-md-4 mb-0">{{$title}}</h1>
         </div>
      </div>
   </div>

   <div class="row senior_card mt-4 mb-5">

      <div class="col-6 col-md-6 col-lg-4 mb-3" class="getactive"> 
            <div class="card">
              <div class="card-body p-0">
                <h5 class="card-title mt-3">Total Students</h5>
                <p class="card-text mt-2" style="font-weight:600;"><a href="{{ route('schoolDashboardGraph') }}">{{ $SchoolData['students']->count() }}</a></p>

                 <div class="students_count">
                      <p >{{ $SchoolData['students']->where('gender', 'Male')->count() }} Boys</p>
                      /
                      <p >{{ $SchoolData['students']->where('gender', 'Female')->count() }} Girls</p>
                  </div>
              </div>
             
            </div>   
        </div>

        <div class="col-6 col-md-6 col-lg-4 mb-3" class="getactive"> 
            <div class="card">
              <div class="card-body p-0">
                <h5 class="card-title mt-3">Active Sessions</h5>
                <p class="card-text mt-2" style="font-weight:600;">{{ $SchoolData['activeSession']->count() }}</p>
                <div class="students_count">
                      <p >{{ $SchoolData['activeSession']->count() * 40 }} Minutes</p>
                  </div>
              </div>
            </div>   
        </div>
      
      <div class="col-12 col-md-12 col-lg-4 mb-3" class="getactive"> 
            <div class="card">
              <div class="card-body p-0"> 
                <h5 class="card-title mt-3">P.E. And Activities</h5>
                <p class="card-text mt-2" style="font-weight:600;">{{ $PEActivityCount->count() }}</p> 
                <div class="students_count">
					@if($PEActivityCount->groupBy('skill_area_id')->count() > 0)
						<p>{{ $PEActivityCount->groupBy('skill_area_id')->count() }} Fundamental Movement Skill</p>  
					@endif

                    @if( $schoolSportsCount > 0) 
                        /<p> {{ $schoolSportsCount }} Sports</p> 
                    @endif 
                    
                    {{--
					@if($PEActivityCount->where('skill_area_id', '2')->groupBy('skill_sports_id')->count() > 0) 
						/<p> {{ $PEActivityCount->where('skill_area_id', '2')->groupBy('skill_sports_id')->count() }} Sports</p> 
					@endif 
                    --}}

					@if($PEActivityCount->where('skill_area_id', '6')->groupBy('skill_sports_id')->count() > 0)
						/<p> {{ $PEActivityCount->where('skill_area_id', '6')->groupBy('skill_sports_id')->count() }} Recreational Activities</p>
					@endif 
                </div>
              </div>
         </div>   
      </div>
      <div class="col-12 col-md-12 col-lg-12 mb-1" class="getactive"> 
        <div class="responsive mb-4">
          <table class="table table-bordered mt-3">
            <thead>
              <tr>
                  <th scope="col">Class</th>
                  <th scope="col">Section</th>
                  <th scope="col">Students</th>
                  <th scope="col">Boys</th>
                  <th scope="col">Girls</th>
                  <th scope="col">Active Session</th>
                  <th scope="col">Active Minutes</th>
              </tr>
            </thead>
            <tbody>

              @foreach ($classData as $classKey => $data)
              <tr>
                <th scope="row">{{ $data['class'] }} </th>
                <td>{{ $data['section'] }} </td>
                <td>{{ $data['total_students'] }}</td>        
                <td>{{ $data['total_boys'] }}</td>
                <td>{{ $data['total_girls'] }}</td>
                <td>{{ $SchoolData['activeSession']->where('custom_class_id',  $data['custom_class_id'])->count() }}</td>
                <td>{{ $SchoolData['activeSession']->where('custom_class_id',  $data['custom_class_id'])->count() * 40 }}</td>              
              </tr>
              @endforeach
              
            </tbody>
          </table>
        </div>
      </div>

      <div class="col-12 col-md-12 col-lg-6 mb-1"> 
           <h5 class="card-title mt-0 mb-3">Active Trainers</h5>
                <table class="table table-bordered mb-4">
                  <thead>
                    <tr>
                      <th scope="col">Name</th>
                      <th scope="col">Session</th>
                      <th scope="col">Days</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($trainerActivities as $trainerId => $data)
                    <tr>
                      <td>{{ $data['TrainerName'] }}</td>
                      <td>{{ $data['total_activities'] }}</td>
                      <td>{{ $data['days_active'] }}</td> 
                    </tr>
                     @endforeach
                  </tbody>
                </table>
      </div>
	  
	  
    

      <div class="col-12 col-md-12 col-lg-6 mb-1" class="getactive" style="overflow:auto"> 
        <h5 class="card-title mt-0 mb-3">Latest Activites</h5>
        <table class="table table-bordered">
          <thead>
            <tr>
              <th scope="col" style="width:100px;">Date</th>
              <th scope="col">Activity</th>
              <th scope="col">Trainer Name</th>
              <th scope="col"> Class </th>
              <th scope="col"> Section </th>
              <th scope="col">Period</th>
            </tr>
          </thead>
            <tbody>		  
    
            @php
              use Carbon\Carbon;
            @endphp

              @if($latestActivity->isEmpty())
                  <tr>
                      <td colspan="6" class="text-center">No latest activity</td>
                  </tr>
              @else
                  @foreach($latestActivity as $key => $val)
                      <tr>
                          <td>{{ Carbon::parse($val->date)->format('d-m-Y') }}</td>
                          <td>{{ $val->activity_title }}</td>
                          <td>{{ $val->submitted_by_name }}</td>
                          <td>{{ $val->class_by_name }} </td>
                          <td>{!! Helper::customSection($val->custom_class_id) !!} </td>
                          <td>{{ $val->period }}</td>
                      </tr>
                  @endforeach
              @endif


          </tbody>
        </table>  
      </div> 
   </div>
</div>




@endsection