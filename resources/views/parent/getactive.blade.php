@extends('layouts.filldart-app')
@section('title', 'Goforfit | ' . $title)
@section('content')

<div class="container all-chaptr-cards mt-5">
   <div class="row">
      <div class="col-12">
         <div class="heading-rw mt-3 mt-md-1 mb-0 p-0">
            <a href="#a" onclick="history.back()" class="back-button">
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
   <div class="row videos_card  mt-4 mb-5">
      <div class="col-6 col-md-4 col-lg-3 mb-1" class="getactive"> 
         <div class="card mb-4"> 
         <iframe class="video" src="https://www.youtube.com/embed/g1rCLbqosQU?si=iuorgPFRzRq86VNG" frameborder="0" allowfullscreen></iframe>
         <div class="card-body">Balance</div>
      </div>   
   </div>

      <div class="col-6 col-md-4 col-lg-3 mb-1" class="getactive"> 
         <div class="card mb-4">             
         <iframe class="video" src="https://www.youtube.com/embed/u8jSpu9qceQ?si=rkSiPBpH7GGhQ-o8" frameborder="0" allowfullscreen></iframe>
         <div class="card-body">Abdominal muscular strength and Endurance</div>
      </div>   </div>

      <div class="col-6 col-md-4 col-lg-3 mb-1" class="getactive"> 
         <div class="card mb-4">             
         <iframe class="video" src="https://www.youtube.com/embed/EjjvPin7sZc?si=Cfz9vwjzHFfZ-qYl" frameborder="0" allowfullscreen></iframe>
         <div class="card-body">Muscular Endurance for Children</div>
      </div>   </div>

      <div class="col-6 col-md-4 col-lg-3 mb-1" class="getactive"> 
         <div class="card mb-4">             
         <iframe class="video" src="https://www.youtube.com/embed/SCcs5ccJp8E?si=JwVU6AAJYwek5Vr-" frameborder="0" allowfullscreen></iframe>
         <div class="card-body">Muscular Endurance for Adults</div>
      </div>   </div>

      <div class="col-6 col-md-4 col-lg-3 mb-1" class="getactive"> 
         <div class="card mb-4">             
         <iframe class="video" src="https://www.youtube.com/embed/FMN9GRh5oj0?si=lPPSu4eZUB65fhce" frameborder="0" allowfullscreen></iframe>
         <div class="card-body">Agility for 65+</div>
      </div>   </div>

      <div class="col-6 col-md-4 col-lg-3 mb-1" class="getactive"> 
         <div class="card mb-4">             
         <iframe class="video" src="https://www.youtube.com/embed/2mM5m5XLHT8?si=XBWVWydOjot_7KA1" frameborder="0" allowfullscreen></iframe>
         <div class="card-body">Flexibility for 65+</div>
      </div>   </div>

      <div class="col-6 col-md-4 col-lg-3 mb-1" class="getactive"> 
         <div class="card mb-4">             
         <iframe class="video" src="https://www.youtube.com/embed/WQTEnfNmwFo?si=-v-Hd6VkrjQWk8VB" frameborder="0" allowfullscreen></iframe>
         <div class="card-body">Abdominal Muscular Strength & Endurance for 19-65</div>
      </div>   </div>

      <div class="col-6 col-md-4 col-lg-3 mb-1" class="getactive"> 
         <div class="card mb-4">             
         <iframe class="video" src="https://www.youtube.com/embed/QwhZl7IbtR4?si=oAzkXTagIL2lWAxH" frameborder="0" allowfullscreen></iframe>
         <div class="card-body">Cardiovascular Endurance</div>
      </div>   </div>

      <div class="col-6 col-md-4 col-lg-3 mb-1" class="getactive"> 
         <div class="card mb-4">             
         <iframe class="video" src="https://www.youtube.com/embed/wD3DenG9JiQ?si=v4BSkbe4HN4fcM57" frameborder="0" allowfullscreen></iframe>
         <div class="card-body">Flexibility for 9-18</div>
      </div>   </div>

      <div class="col-6 col-md-4 col-lg-3 mb-1" class="getactive"> 
         <div class="card mb-4">             
         <iframe class="video" src="https://www.youtube.com/embed/msjIcQ0lKCk?si=TqlsYbrIxGRoZGZm" frameborder="0" allowfullscreen></iframe>
         <div class="card-body">Flexibility for 19 to 65</div>
      </div>   </div>

      <div class="col-6 col-md-4 col-lg-3 mb-1" class="getactive"> 
         <div class="card mb-4">             
         <iframe class="video" src="https://www.youtube.com/embed/LZRKCMrFVCQ?si=6J54gusxf1kaJCfG" frameborder="0" allowfullscreen></iframe>
         <div class="card-body">Aerobic Endurance for 65+</div>
      </div>   </div>
        
     <div class="col-6 col-md-4 col-lg-3 mb-1" class="getactive"> 
         <div class="card mb-4">             
         <iframe class="video" src="https://www.youtube.com/embed/GX-w7lOUd0c?si=5I-AH_UwG_PKY_YP" frameborder="0" allowfullscreen></iframe>
         <div class="card-body">Muscular Endurance for 65+</div>
      </div>   </div>
   
    <div class="col-6 col-md-4 col-lg-3 mb-1" class="getactive"> 
         <div class="card mb-4">             
         <iframe class="video" src="https://www.youtube.com/embed/BxvdqGqeGiY?si=axwJfUFtzWK9_6A_" frameborder="0" allowfullscreen></iframe>
         <div class="card-body"> Flexibility for 65+</div>
      </div>   </div>
  
   </div>
</div>




@endsection