@extends('layouts.app')
@section('title', 'Goforfit')
@section('content')



<div class="container">
    <div class="all-chaptr-cards">
        <div class="row">
            <div class="col">
                <div class="heading-rw">
                    <h1>{{$title}}</h1>
                    <h2 class="show-rslt"> (Total Found <strong>{{$count}}</strong>, Comments<strong>{{$count_comments}}</strong>)</h2>
                   
                </div>
            </div>
			
			
			
			 <form method="get" action="{{ route('activities') }}" id="add-activity">

                @csrf

					<br>
                

                    <div class="col-md-12">
                        <div class="row">
						
						
						
						<?php
									$aclasses ='<option value="">Select Class</option>';
									if(!empty($classes)){								
											foreach($classes as $cls){	
												$aclasses.= '<option value="'.$cls->id.'" ';
												if(!empty($_GET['aclass'])){
													if($cls->id == $_GET['aclass']){ $aclasses.= ' selected'; $aclsname = $cls->name; }
												} 
												$aclasses.= ' >'.$cls->name.'</option>';
											} 
									}
									
									$asubjects ='<option value="">Subject</option>';
									if(!empty($subjects)){								
										foreach($subjects as $cls){	
											$asubjects.= '<option value="'.$cls->id.'" ';
											if(!empty($_GET['subject'])){
												if($cls->id == $_GET['subject']){ $asubjects.= ' selected'; $asubjectname = $cls->name; }
											} 
											$asubjects.= ' >'.$cls->name.'</option>'; 								
										} 
									}
									
									$achapters ='<option value="">Chapter</option>';
									if(!empty($chapters)){								
										foreach($chapters as $cls){	
											$achapters.= '<option value="'.$cls->id.'" ';
											if(!empty($_GET['chapter'])){
												if($cls->id == $_GET['chapter']){ $achapters.= ' selected'; $achaptername = $cls->name; }
											} 
											$achapters.= ' >'.$cls->name.'</option>'; 								
										} 
									}
									
									
								?>
								
								
						
										<div class="col-md-3 offset-md-1">
											
											
											<select class="form-control selctopt clsopt @error('aclass') is-invalid @enderror" name="aclass" id="id_class0" onchange="getsubjects(0,this.value)" style="width:125px">
												<?=$aclasses?>
											</select>
										
										</div>
										
										<div class="col-md-3">
											
											<select class="form-control selctopt" id="id_subject0" name="subject" onchange="getchapters(0,this.value)" style="width:125px">
												<?=$asubjects?>
											</select>
											
											
										</div>
										
										<div class="col-md-3">
											
											<select class="form-control selctopt" id="id_chapter0" name="chapter" onchange="getconcepts(0,this.value)" style="width:125px">
												<?=$achapters?>
											</select>	
											
										</div>
										
										<div class="col-md-2">
										 
											
											<button type="submit" name="search" value="search" class="add-act-link btn btn-md btn-primary  add-act-btn">Search</button>
											
										
										</div>
						</div>
							
							
						
					</div>
				
				
		 </form>
		 <div class="clearfix"><br><br></div>
			
			
        </div>
				
				
				
				
				
				
				
				
				
        <div class="row">
            @if(count($posts)>0)
            @if(!empty($posts))
            @foreach($posts as $act)
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card chapter-bx">
                    <a href="{{ url('actconcepts/'.$act->id)}}"></a>
                    <?php				   
						 $word = "wp-content";
						 $mystring = $act->image;
										 
						 
						 if(strpos($mystring, $word)!== false){
						 ?>
                    <figure class="thumb-card"><img src="{{ preg_replace('/[^(\x20-\x7F)\x0A\x0D]*/','', $act->image) }}"
                            class="card-img-top attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="">
                    </figure>
                    <?php } else if (file_exists('public/uploads/'.$act->image)){ ?>
                    <figure class="thumb-card"><img src="{{ asset('public/uploads').'/'.$act->image }}"
                            class="card-img-top attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="">
                    </figure>
                    <?php } else{ ?>
                    <figure class="thumb-card"><img src="{{ asset('public/uploads').'/'.'images.jpg' }}"
                            class="card-img-top attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="">
                    </figure>
                    <?php } ?>
                    <div class="card-body">
                        <span class="no-concents1"></span>
                        <h3>{{ preg_replace('/[^(\x20-\x7F)\x0A\x0D]*/','', $act->title) }}</h3>
						<span class="author-nm"><img src="{{ asset('resources/images').'/'.'/author-i.svg' }}" alt="author"/>{{ $act->usrname }}</span>
						@if(!empty($verified_sts))
							@foreach($verified_sts as $verified)
								@if($verified->id == $act->id)
						<span class="author-nm"><img src="{{ asset('resources/images').'/'.'/checkmark.png' }}" alt="author"/>comments</span>
								@endif
							@endforeach
						@endif
                    </div>

                </div>
            </div>

            @endforeach
            @endif
            @else
            <div class="col-12 col-md-6 offset-md-3">
                
                    <div class="pg-not-found pt-3 pl-2 pb-4 pr-5 mt-4 mb-4">
						
                        <figure class="pt-3"><img src="{{ asset('resources/images/no-data-found.png') }}"
                                class="card-img-top attachment-post-thumbnail size-post-thumbnail wp-post-image"
                                alt="No data found"> </figure>
                        <div class="nofound-txt">
                            <h1>404</h1>
                            <h2>No Data Found...!</h2>
                            <p>Oops! The page you are looking for could not be found.</p>
                            <a href="{{ url('sport') }}" class="btn btn-primary"><svg class="bck-arw" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M16.67 0l2.83 2.829-9.339 9.175 9.339 9.167-2.83 2.829-12.17-11.996z"/></svg>Back to Home</a>
                        </div>
                    </div>
                
                <!--<span class=""> No Activity Data Found ...!</span> -->

            </div>
            @endif
        </div>
        <div class="d-flex justify-content-center">{{ $posts->onEachSide(1)->links() }}</div>
    </div>
</div>


@endsection