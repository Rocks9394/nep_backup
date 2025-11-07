@extends('layouts.app')
@section('title', 'Goforfit | '.$title)
@section('content')
<div class="pg-yallow-color">
<div class="container">
    <div class="fillter-rw navbar-expand-lg">
        <div id="fillter" class="" role="group" aria-label="Basic example">
            <?php
					if(!empty($_REQUEST['search']) && $_REQUEST['search']=='Search'){
					   $act2='active';
					   $sty2='display:block';
					 } else{
					   $act2='';
					   $sty2='display:none';
					 } 
						 
					 if(!empty($_REQUEST['searchdata']) && $_REQUEST['searchdata']=='searchdata'){
					   $act1='active';
					   $sty1='display:block';
					 } else{
					   $act1='';
					   $sty1='display:none';
					 }
					 
					 
					 if(empty($_REQUEST['search']) && empty($_REQUEST['searchdata'])){
						 
						$sty1='display:block';						 
					 }                    					 
				?>
           
            <div class="">
                <div class="row">
                    <div class="col-12 d-sm-none d-md-none d-xs-block"><span class="mob-pg-heading">Sports</span></div>
                    <div class="col-12 col-md-12 col-lg-2">
                        <div class="shot-contnts btn-group">
                            <button type="button" data-target="#activity_from_div" id="btn1" class="btn btn-light active <?=$act1?>"><span
                                    class="flt-txt">By Fillter</span>
									<svg class="filter-i"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                    <path d="M23 0l-8.412 15h-5.215l-8.373-15h22zm-13 17v7h4v-7h-4z" />
                                </svg></button>
                            
                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-10">

                        <div id="activity_from_div" class="sports-filtr overlay" style="<?=$sty1?>">
                            <form class="fltr-frm form-inline" type="get" name="activity_from"
                                id="activity_from_fillter" action="{{ route('sport') }}">
								
								 <?php
								$sclasses ='<option value="">Class</option>';
							if(!empty($classes)){								
								foreach($classes as $cls){	
									
									
									
									$sclasses.= '<option value="'.$cls->id.'" ';
									if(!empty($_GET['sclass'])){
										if($cls->id == $_GET['sclass']){ $sclasses.= ' selected'; $sclsname = $cls->name; }
									}
									$sclasses.= ' >'.$cls->name.'</option>';
									
								} 
							}
					$askillarea='<option value="">Skillarea</option>';					
					
					if(!empty($skillareas)){								
						foreach($skillareas as $skillarea){	
						
						   $kselect =(!empty($_REQUEST['skillarea']) &&($_REQUEST['skillarea']==$skillarea->id) ? 'selected="selected"' : ''); 
					
							$askillarea.= '<option value="'.$skillarea->id.'" '.$kselect.'>'.$skillarea->name.'</option>'; 								
						} 
					}
					
					$asportskills='<option value="">Skill/Sports</option>';
					if(!empty($sportskills)){								
						foreach($sportskills as $sportskill){
                            $spselect =(!empty($_REQUEST['skillsports']) &&($_REQUEST['skillsports']==$sportskill->id) ? 'selected="selected"' : ''); 							
							$asportskills.= '<option value="'.$sportskill->id.'" '.$spselect.'>'.$sportskill->name.'</option>'; 								
						} 
					}
					
					$atechniques='<option value="">Technique</option>';
					if(!empty($techniques)){								
						foreach($techniques as $technique){
                            $tselect =(!empty($_REQUEST['technique']) &&($_REQUEST['technique']==$technique->id) ? 'selected="selected"' : ''); 							
							$atechniques.= '<option value="'.$technique->id.'" '.$tselect.'>'.$technique->name.'</option>'; 								
						} 
					}
				?>				 
								 <select class="form-control selctopt" name="sclass" id="sclass0"   onchange="getskillarea(0,this.value)">
								<?=$sclasses?>
								</select>
                              	

                                <select class="form-control selctopt" id="skillarea0" name="skillarea" onchange="getskillsports(0,this.value)" >
                                    <?=$askillarea?>
                                </select>

                                <select class="form-control selctopt" id="skillsports0" name="skillsports" onchange="gettechnique(0,this.value)">
                                    <?=$asportskills?>
                                </select>

                                <select class="form-control selctopt" id="technique0" name="technique">
                                    <?=$atechniques?>
                                </select>
                                <button type="submit" name="searchdata" id="activity_fillter" value="searchdata"
                                    class="btn btn-primary"><i class="fa fa-filter" aria-hidden="true"></i> Go</button>
                            </form>
                        </div>

                        <div id="activity_search_div" class="sports-srch overlay" style="<?=$sty2?>">
                            <form class="fltr-frm form-inline" type="get" name="activity_from_search"
                                id="activity_from_search" action="{{ route('sport') }}">
                                <input type="text" class="form-control"
                                    value="<?=!empty($_REQUEST['activity_name']) ? $_REQUEST['activity_name'] : '' ?>"
                                    name="activity_name" id="activity_name" placeholder="Activity Name..">
                                <button type="submit" name="search" id="activity_search" value="Search"
                                    class="btn btn-primary search-btn"><svg class="search-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M21.172 24l-7.387-7.387c-1.388.874-3.024 1.387-4.785 1.387-4.971 0-9-4.029-9-9s4.029-9 9-9 9 4.029 9 9c0 1.761-.514 3.398-1.387 4.785l7.387 7.387-2.828 2.828zm-12.172-8c3.859 0 7-3.14 7-7s-3.141-7-7-7-7 3.14-7 7 3.141 7 7 7z"/></svg></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>

<div class="container">
    <div class="all-chaptr-cards">
        <div class="row">
            <div class="col">
                <div class="heading-rw">
                    <h1>{{$title}}</h1>
                    
                </div>
            </div>
        </div>

        
         <div class="row mb-4 thumbs-rw">

            <div class="col-6 col-md-4 col-lg-3 col-xl-2 offset-0">
                <div class="card chapter-bx mb-4">
                    <a href="{{route('sport' ,array('skillsports' => 38 , 'searchdata' => 'searchdata') )}}"></a>
                    <img class="" src="resources/images/sports/archery-thumb.jpg" alt="Archery">
                    <span class="card-body">
                        <h3 class="card-text">Archery</h3>
                    </span>

                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-3 col-xl-2 offset-0">
                <div class="card chapter-bx mb-4">
                    <a href="{{route('sport')}}"></a>
                    <img class="" src="resources/images/sports/athletics-thumb.jpg" alt="Athletics">
                    <span class="card-body">
                        <h3 class="card-text">Athletics</h3>
                    </span>

                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-3 col-xl-2 offset-0">
                <div class="card chapter-bx mb-4">
                    <a href="{{route('sport' ,array('skillsports' => 29 , 'searchdata' => 'searchdata'))}}"></a>
                    <img class="" src="resources/images/sports/Badminton-thumb.jpg" alt="Badminton">
                    <span class="card-body">
                        <h3 class="card-text">Badminton</h3>
                    </span>

                </div>
            </div>

            <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                <div class="card chapter-bx mb-4">
                    <a href="{{ route('sport' ,array('skillsports' => 52, 'searchdata' => 'searchdata') ) }}"></a>
                    <img class="" src="resources/images/sports/Basketball-thumb.jpg" alt="Basketball">
                    <span class="card-body">
                        <h3 class="card-text">Basketball</h3>
                    </span>

                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                <div class="card chapter-bx mb-4">
                    <a href="{{  route('sport' ,array('skillsports' => 31 , 'searchdata' => 'searchdata') )  }}"></a>
                    <img class="" src="resources/images/sports/boxing-thumb.jpg" alt="boxing">
                    <span class="card-body">
                        <h3 class="card-text">Boxing</h3>
                    </span>

                </div>
            </div>

            <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                <div class="card chapter-bx mb-4">
                    <a href="{{ route('sport' ,array('skillsports' => 51 , 'searchdata' => 'searchdata') ) }}"></a>
                    <img class="" src="resources/images/sports/Cricket-thumb.jpg" alt="Cricket">
                    <span class="card-body">
                        <h3 class="card-text">Cricket</h3>
                    </span>

                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                <div class="card chapter-bx mb-4">
                    <a href="{{ route('sport' ,array('skillsports' => 23, 'searchdata' => 'searchdata') ) }}"></a>
                    <img class="" src="resources/images/sports/Football-thumb.jpg" alt="Football">
                    <span class="card-body">
                        <h3 class="card-text">Football</h3>
                    </span>

                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                <div class="card chapter-bx mb-4">
                    <a href="{{ route('sport' ,array('skillsports' => 39, 'searchdata' => 'searchdata') ) }}"></a>
                    <img class="" src="resources/images/sports/gymnastics-thumb.jpg" alt="Gymnastics">
                    <span class="card-body">
                        <h3 class="card-text">Gymnastics</h3>
                    </span>

                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                <div class="card chapter-bx mb-4">
                    <a href="{{ route('sport' ,array('skillsports' => 52, 'searchdata' => 'searchdata') ) }}"></a>
                    <img class="" src="resources/images/sports/handBall-thumb.jpg" alt="handBall">
                    <span class="card-body">
                        <h3 class="card-text">HandBall</h3>
                    </span>

                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                <div class="card chapter-bx mb-4">
                    <a href="{{ route('sport' ,array('skillsports' => 53, 'searchdata' => 'searchdata') ) }}"></a>
                    <img class="" src="resources/images/sports/Hockey-thumb.jpg" alt="Hockey">
                    <span class="card-body">
                        <h3 class="card-text">Hockey</h3>
                    </span>

                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                <div class="card chapter-bx mb-4">
                    <a href="{{ route('sport' ,array('skillsports' => 44, 'searchdata' => 'searchdata') ) }}"></a>
                    <img class="" src="resources/images/sports/judo-thumb.jpg" alt="judo">
                    <span class="card-body">
                        <h3 class="card-text">Judo</h3>
                    </span>

                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                <div class="card chapter-bx mb-4">
                    <a href="{{ route('sport' ,array('skillsports' => 66, 'searchdata' => 'searchdata') ) }}"></a>
                    <img class="" src="resources/images/sports/Kabaddi-thumb.jpg" alt="Kabaddi">
                    <span class="card-body">
                        <h3 class="card-text">Kabaddi</h3>
                    </span>

                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                <div class="card chapter-bx mb-4">
                    <a href="{{ route('sport' ,array('skillsports' => 49, 'searchdata' => 'searchdata') ) }}"></a>
                    <img class="" src="resources/images/sports/Kho-Kho-thumb.jpg" alt="Kho Kho">
                    <span class="card-body">
                        <h3 class="card-text">Kho Kho</h3>
                    </span>

                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                <div class="card chapter-bx mb-4">
                    <a href="{{ route('sport' ,array('skillsports' => 28, 'searchdata' => 'searchdata') ) }}"></a>
                    <img class="" src="resources/images/sports/Table-tennis-thumb.jpg" alt="Table Tennis">
                    <span class="card-body">
                        <h3 class="card-text">Table Tennis</h3>
                    </span>

                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                <div class="card chapter-bx mb-4">
                    <a href="{{ route('sport' ,array('skillsports' => 42, 'searchdata' => 'searchdata') ) }}"></a>
                    <img class="" src="resources/images/sports/shooting-thumb.jpg" alt="shooting">
                    <span class="card-body">
                        <h3 class="card-text">Shooting</h3>
                    </span>

                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                <div class="card chapter-bx mb-4">
                    <a href="{{ route('sport' ,array('skillsports' => 30, 'searchdata' => 'searchdata') ) }}"></a>
                    <img class="" src="resources/images/sports/swimming-thumb.jpg" alt="Swimming">
                    <span class="card-body">
                        <h3 class="card-text">Swimming</h3>
                    </span>

                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                <div class="card chapter-bx mb-4">
                    <a href="{{ route('sport' ,array('skillsports' => 27, 'searchdata' => 'searchdata') ) }}"></a>
                    <img class="" src="resources/images/sports/Tennis-thumb.jpg" alt="Tennis">
                    <span class="card-body">
                        <h3 class="card-text">Tennis</h3>
                    </span>

                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                <div class="card chapter-bx mb-4">
                    <a href="{{ route('sport' ,array('skillsports' => 24, 'searchdata' => 'searchdata') ) }}"></a>
                    <img class="" src="resources/images/sports/Volleyball-thumb.jpg" alt="Volleyball">
                    <span class="card-body">
                        <h3 class="card-text">Volleyball</h3>
                    </span>

                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                <div class="card chapter-bx mb-4">
                    <a href="{{ route('sport')  }}"></a>
                    <img class="" src="resources/images/sports/weightlifting-thumb.jpg" alt="weightlifting">
                    <span class="card-body">
                        <h3 class="card-text">Weightlifting</h3>
                    </span>

                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                <div class="card chapter-bx mb-4">
                    <a href="{{ route('sport') }}"></a>
                    <img class="" src="resources/images/sports/wrestling-thumb.jpg" alt="wrestling">
                    <span class="card-body">
                        <h3 class="card-text">Wrestling</h3>
                    </span>

                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                <div class="card chapter-bx mb-4">
                    <a href="{{ route('sport' ,array('skillsports' => 47 , 'searchdata' => 'searchdata') ) }}"></a>
                    <img class="" src="resources/images/sports/yoga-thumb.jpg" alt="yoga">
                    <span class="card-body">
                        <h3 class="card-text">Yoga</h3>
                    </span>

                </div>
            </div>

        </div>
		
    </div>
</div>



@endsection