@extends('layouts.filldart-app')
@section('title', 'Goforfit | ' . $title)
@section('content')



<div class="">
   <div class="all-chaptr-cards">
      @if($errors->any())
      <div class="alert alert-info">
         <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
         </ul>
      </div>
      @endif
      
      <div class="container">
         <div class="t-mrg2">
            <div class="container-fluid">

                 @if(session('success'))
                      <div class="alert alert-info" style="text-align:center;">
                         {{ session('success') }}
                      </div>
                    @endif


               <div class="row">

                  <div class="col-12 col-md-8 col-lg">
                     <div class="heading-rw mt-0 mt-md-1 mb-0 p-0">
                        <a href="{{ route('filldart.dashboard') }}" class="back-button">
                           <span class="arrow">
                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                                 <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5" />
                              </svg>
                           </span>
                        </a>
                     
                        <h1 class="ml-md-4 mb-0">{{$title}}</h1>
                     </div>
                  </div>

                    <div class="col-12 col-md-4 col-lg-2 mb-0 mt-3 mt-md-0">
                        <div class="form-group mb-3 select-class">
                            <input type="hidden" name="school_id" id="school_id" value="{{ $school->id }}">

                            <select class="form-control mx-0 w-100" name="skill_area" id="skill_area_select" onchange="getSKillList(this.value)">
                               <option value="0">Sports for all</option>
                                @foreach($skills as $key => $val)
                                <option value="{{ $val->id }}">{{ $val->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>  


                    <div class="col-12">
                     <form method="POST" action="{{ route('mapping.sports.update', $school->id) }}">
                        @csrf
                        @method('PUT')
                        <table class="table table-bordered mt-3" id="sports_table">
                           <thead>
                              <tr>
                                 <th>#</th>
                                 <th>Sport Name</th>
                                 <th>Category</th>                                 
                                 <th>Select</th>
                              </tr>
                           </thead>
                           <tbody>
                              @foreach($sports as $index => $sport)

                              @php
                                 $mappedSports = $school->sports->pluck('id')->toArray();
                                 $alwaysChecked = ['19', '20', '21'];

                                 $isChecked = in_array($sport->id, $mappedSports) || in_array($sport->id, $alwaysChecked) ? 'checked' : '';
                              @endphp
                              <tr>
                                 <td>{{ $index + 1 }}</td>
                                 <td>{{ $sport->name }}</td>
                                 <td>{{ $sport->category ?? 'N/A' }}</td>
                                 <td class="text-center"> <input type="checkbox" name="sports[]" value="{{ $sport->id }}"
                                    {{ $isChecked }}>
                                 </td>
                              </tr>
                              
                              @endforeach
                           </tbody>
                        </table>
                        <div class="form-group mt-3 text-end float-right">
                           <button type="submit" name="filldata" id="activity_fillter" value="filldatasubmit" class="btn btn-primary">
                           <i class="fa fa-filter" aria-hidden="true"></i> Map Sports
                           </button>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>


<script>

   const mappedSports = @json($school->sports->pluck('id'));

   function getSKillList(skillId){

      if (!skillId) {
         $('#sports_table tbody').html('');
         return;
      }

      $.ajax({
        url: "{{ route('mapping.sports') }}", 
        method: 'GET',
        data: {
            skill_id: skillId,
            _token: '{{ csrf_token() }}' 
        },
        success: function(response) {

            $('#sports_table tbody').html(response.html);

        },
        error: function(err) {
            console.error("Error fetching sports:", err);
        }
      });

   }
</script>
@endsection