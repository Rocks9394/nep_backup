@extends('layouts.filldart-app')
@section('title', 'Goforfit | ' . $title)
@section('content')
<div class="pg-yallow-color">
    <div class="container">
        <div class="navbar-expand-lg">
            <div id="fillter" class="" role="group" aria-label="Basic example">
            </div>
        </div>
    </div>
</div>
<style>

</style>

<div class="container">
    <div class="t-mrg">

        <div class="row text-center justify-content-md-center">
            <div class="col-12 col-md-10 col-lg-10">
                <div class="form-row" style="justify-content: center;">
                    
                    <div class="col-4 col-md-3 col-lg-3 col-xl-2 mb-4 text-center">
                        <a href="{{ route('skill.dailyreport') }}" class="box"><div><img class="img-fluid" alt="" src="{{asset('public/uploads/icons/skills-report.svg') }}"></div><span>Daily Tracker</span></a>
                    </div>
                      
                    <div class="col-4 col-md-3 col-lg-3 col-xl-2 mb-4">
                        <a href="{{ route('skill.report') }}" class="box">
                            <div> <img class="img-fluid" alt="" src="{{asset('public/uploads/icons/skills-report.svg') }}"> </div>
                            <span>Skill Reports</span>
                        </a>
                    </div>

                    <div class="col-4 col-md-3 col-lg-2 col-xl-2 mb-4">
                        <a href="{{ route('activity.according.to.class') }}" class="box"><div><img class="img-fluid" alt="" src="{{asset('public/uploads/icons/activities.svg') }}"></div><span>Activity Planner</span></a>
                    </div>

                    <div class="col-4 col-md-3 col-lg-3 col-xl-2 mb-4">
                        <a href="{{ route('student.report', ['id' => auth()->guard('sstudent')->user()->id] )}}" class="box">
                            <div data-toggle="tooltip" data-placement="top" title="Progress Report">
                                <img class="img-fluid" alt="" src="{{ asset('public/uploads/icons/taketest.svg') }}">
                            </div>
                            <span>Progress Report</span>
                        </a>
                    </div>
                    
                    <div class="col-4 col-md-3 col-lg-2 col-xl-2 mb-4">
                        <a href="{{ route('test.videos')}}" class="box"><div><img class="img-fluid" alt="" src="{{asset('public/uploads/icons/test-demo.svg') }}"></div><span>Battery of Tests</span></a>
                    </div>


    				@if($countFMS >0)
                        <div class="col-4 col-md-3 col-lg-3 col-xl-2 mb-4">
                            <a href="{{ route('fms.skills.reports') }}" class="box" data-toggle="tooltip" data-placement="top" title="End of the term">
                                <div >
                                    <img class="img-fluid" alt="" src="{{asset('public/uploads/icons/Dashboard.svg') }}">
                                </div>
                                <span >FMS Development</span>
                            </a>
                        </div>
    				@else



    			    @endif		
					
					{{-- <div class="col-4 col-md-3 col-lg-3 col-xl-2 mb-4">
                        <a href="{{ route('pe-activities.index') }}" class="box"><div><img class="img-fluid" alt="" src="{{asset('public/uploads/icons/pe-activites.svg') }}"></div><span>P.E Activities</span></a>
                    </div> --}}


                    <div class="col-4 col-md-3 col-lg-3 col-xl-2 mb-4">
                        <a href="{{ route('learn.sports') }}" class="box"><div><img class="img-fluid" alt="" src="{{asset('public/uploads/icons/Learn-Sports.svg') }}"></div><span>Learn Sports</span></a>
                    </div>
                    

                    <div class="col-4 col-md-3 col-lg-3 col-xl-2 mb-4">
                        <a href="{{ route('getactive') }}" class="box"><div><img class="img-fluid" alt="" src="{{asset('public/uploads/icons/Get-Active.svg') }}"></div><span>Get Active</span></a>
                    </div>




                    {{-- <div class="col-4 col-md-3 col-lg-3 col-xl-2 mb-4">
                        <a href="#" class="box" data-toggle="tooltip" data-placement="top" title="Report will available at end of the term">
                            <div >
                                <img class="img-fluid" alt="" src="{{asset('public/uploads/icons/Dashboard.svg') }}">
                            </div>
                            <span >Dashboard</span>
                        </a>
                    </div> --}}
                    

					{{-- <div class="col-4 col-md-3 col-lg-2 col-xl-2 mb-4">
						<a href="{{ route('paris.olympics') }}" class="box"><div><img class="img-fluid" alt="" src="{{asset('public/uploads/icons/paris.svg') }}" style="max-height:180px;"></div><span>Paris 2024</span></a>
					</div> --}}


                </div>
            </div>

        </div>

    </div>





</div>
</div>



 <!-- Modal for profile update -->
 <div class="modal fade"  id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true" >
     <div class="modal-dialog modal-dialog modal-lg modal-dialog-centered">

         <form action="{{ route('profile.update') }}" method="POST" class="modal-lg modal-content"> 
             @csrf
             @method('PUT')
             <div class="modal-content">
                 <div class="modal-header">
                    <h5 class="modal-title" id="profileModalLabel">Update Profile</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>

                  <div class="modal-body">
                     <!-- Name Input -->

                     <div class="alert alert-warning" role="alert">
                       Last updated on : {{ date('d-M-Y', strtotime($stdInfo->last_updated)) }}
                     </div>

                     <div class="row">
                        <div class="col">
                           <div class="mb-3">
                               <label for="name" class="form-label">Name</label>
                               <input type="text" class="form-control" id="name" name="student_name" value="{{ old('student_name', $stdInfo->student_name) }}" required>
                           </div>
                        </div>
                        
                        <div class="col">
                           <div class="mb-3">
                               <label for="email" class="form-label">Email</label>
                               <input type="email" class="form-control" id="email" name="email_id" value="{{ old('email_id', $stdInfo->email_id) }}" required>
                           </div>
                         </div>
                     </div>

                     <div class="row">
                        <div class="col">

                           
                           <div class="mb-3">
                              <label for="dob" class="form-label">Date of Birth</label>
                              <input type="date" name="dob" id="dob" data-id="" value="{{ $stdInfo->dob }}" class="form-control">
                           </div>
                        </div>
                        
                        <div class="col">
                           <div class="mb-3">
                               <label for="domicile" class="form-label">Domicile</label>
                               <input type="text" class="form-control" id="domicile" name="domicile" value="{{ old('domicile', $stdInfo->domicile) }}">
                           </div>
                         </div>
                     </div>

                     <div class="row">
                        <div class="col">
                            <div class="mb-3">
                               <label for="fav_sport" class="form-label">Favourite Sport</label>
                               <input type="text" class="form-control" id="fav_sport" name="fav_sport" value="{{ old('fav_sport', $stdInfo->fav_sport) }}">
                           </div>
                        </div>
                        
                        <div class="col">
                            <div class="mb-3">
                               <label for="hobbies" class="form-label">Hobbies</label>
                               <input type="text" class="form-control" id="hobbies" name="hobbies" value="{{ old('hobbies', $stdInfo->hobbies) }}">
                           </div>
                         </div>
                     </div>
                  </div>

                 <div class="modal-footer">
                     <button type="submit" class="btn btn-sm btn-primary">Save changes</button>
                 </div>
             </div>
         </form>
     </div>
 </div>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
//    $(document).ready(function() {
//       // Initialize Bootstrap tooltips
//       $('[data-toggle="tooltip"]').tooltip();
//    });



</script>
<script>
    $('#loadProgressReport').on('click', function (e) {

        Swal.fire({
            icon: 'info',
            title: 'Temporarily Unavailable',
            text: 'This feature is temporarily unavailable. Will come back soon.',
            confirmButtonText: 'OK'
        });
        return;
        e.preventDefault();
        $.ajax({
            url: "{{ route('student.report', ['id' => auth()->guard('sstudent')->user()->id]) }}",
            type: 'GET',
            dataType: 'html',
            success: function (response) {
                $('#progressReportContainer').html(response);
            },
            error: function (xhr) {
                alert('Failed to load progress report.');
                console.error(xhr.responseText);
            }
        });
    });
</script>


@if(session('updateprofile'))
   <script>
     document.addEventListener('DOMContentLoaded', function () {
         $('#profileModal').modal('show');
     });
   </script>
@endif

@if(session()->has('message'))    
   <script type="text/javascript">
      Swal.fire({
        position: "top-end",
        icon: "success",
        title: @json(session()->get('message')),
        showConfirmButton: false,
        timer: 1500
      });
   </script>
@endif


@endsection