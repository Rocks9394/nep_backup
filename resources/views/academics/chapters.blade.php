@extends('layouts.app')
@section('title','Academic')
@section('content')

<div class="pg-yallow-color">
<div class="container">
    <div class="fillter-rw navbar-expand-lg">
        <div id="fillter" class="" role="group" aria-label="Basic example">
            <?php
					$classname = ''; $subjectname = ''; $bookname = '';
					
					
					if(!empty($_REQUEST['search']) && $_REQUEST['search']=='Search'){
					   $act2='active'; $sty2='display:block';
					 } else{
					   $act2='';  $sty2='display:none';
					 } 
						 
					 if(!empty($_REQUEST['searchdata']) && $_REQUEST['searchdata']=='searchdata'){
					   $act1='active';  $sty1='display:block';
					 } else{
					   $act1=''; $sty1='display:none';
					 }
					 
					if(empty($_REQUEST['search']) && empty($_REQUEST['searchdata'])){ $sty1='display:block'; }                    					 
				?>
            <div class="">
                <div class="row">
                    <div class="col-12 d-sm-none d-md-none d-xs-block"><span class="mob-pg-heading">Academic</span>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="shot-contnts btn-group">
                            <button type="button" id="cbtn1" class="btn btn-light active <?=$act1?>"><span class="flt-txt">By
                                    Fillter</span></button>
                            <button type="button" id="cbtn2" class="btn btn-light  <?=$act2?>"><span
                                    class="flt-txt">By Search</span></button>
                        </div>

                       

                    </div>
                    <div class="col-12 col-md-9">
                        <div id="chpter_from_div" class="academic-filtr overlay" style="<?=$sty1?>">
                            <form class="fltr-frm form-inline" method="get" name="chpter_from" id="chpter_from" 
                                action="{{ route('chapters',[$class, $subject])}}" >
								
									<select class="form-control" name="class" id="id_class0" onchange="getsubjects(0,this.value)">
											<option value="">All Classes</option>
										@foreach($classes as $cls)
										   <option value="{{ $cls->id }}" @if( $cls->id == $class) {{ 'selected' }} <?php $classname = $cls->name; ?> @endif > {{ $cls->name }}</option>
										@endforeach
									</select>

									<select class="form-control" id="id_subject0" name="subject"
										onchange="getchapters(0,this.value)">
										<option value="">Select Subjects</option>
										
										@foreach($subjects as $sbj)
										<option value="{{ $sbj->id }}" @if( $sbj->id == $subject) {{ 'selected' }} <?php $subjectname = $sbj->name; ?> @endif  >{{ $sbj->name }}</option>
										@endforeach
									</select>
									
									@if(count($books)>1)
									<select class="form-control" id="books" name="books">
										<option value="">Select Books</option>
										
										@foreach($books as $bk)
										<option value="{{ $bk->book }}" {{ $bookname == $bk->book ? 'selected="selected"' : ''}} >{{ $bk->book }}</option>
										@endforeach
									</select>
									@endif
                                <button type="button" name="searchdata" id="chpter_fillter" class="btn btn-primary" onclick="return filterchapters();" ><i class="fa fa-filter" aria-hidden="true"  ></i> Go</button>
                            </form>
                        </div>
                        <div id="chpter_search_div" class="academic-srch overlay" style="<?=$sty2?>">
                            <form class="fltr-frm form-inline" type="get" name="chpter_from_search"
                                id="chpter_from_search" action="{{ route('chapters', [$class, $subject] ) }}">
                                <input type="text" class="form-control" name="chpter_name" id="chpter_name"
                                    placeholder="Chapter Name..">
                                <button type="submit" name="search" id="chpter_search" value="Search"
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
					<h1> {{ $classname }} - {{ $subjectname }} Chapters  </h1>
					<h2 class="show-rslt"> (<strong>{{$count}}</strong> Records found)</h2>

                </div>
				
            </div>
        </div>
		
        <div class="row">
			
           
			
			@if(!empty($chapters))
				@foreach($chapters as $act)
			   
				
				<div class="col-6 col-md-4 col-lg-3">
					<div class="card chapter-bx">
						<a href="{{ url('concepts/'.$act->id)}}"></a>
						<?php if($act->image!=''){ ?>
						<figure class="thumb-card"><img width="307" height="207" src="{{ $act->image }}"
								class="card-img-top attachment-post-thumbnail size-post-thumbnail wp-post-image"
								alt="Card image cap"></figure>
						<?php } else{ ?>
						<figure class="thumb-card"><img class="card-img-top"
								src="{{ asset('resources/images/activity-default-img.png') }}" alt="Card image cap">
						</figure>
						<?php }  ?>
						<div class="card-body">
							<span class="no-concents"> {{ ($act->cnt) }} Concepts </span>
							
							<h3>{{ ($act->name) }}</h3>
						</div>

					</div>
				</div>
				
				@endforeach
			 
			
			
			
			

			@else
           <div class="col-12 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                
                    <div class="pg-not-found pt-3 pl-2 pb-4 pr-5 mt-4 mb-4">

                        <figure class="pt-3"><img src="{{ asset('resources/images/no-data-found.png') }}"
                                class="card-img-top attachment-post-thumbnail size-post-thumbnail wp-post-image"
                                alt="No data found"> </figure>
                        <div class="nofound-txt">
                            <h1>404</h1>
                            <h2>No Activity Data Found...!</h2>
                            <p>Oops! The page you are looking for could not be found.</p>
                            <a href="{{ url('sport') }}" class="btn btn-primary"><svg class="bck-arw"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path d="M16.67 0l2.83 2.829-9.339 9.175 9.339 9.167-2.83 2.829-12.17-11.996z" />
                                </svg>Back to Home</a>
                        </div>
                    </div>
                

            </div>
			@endif
           

			
           
           
        </div>
       
    </div>
</div>
<script type="text/javascript">
	$(function() {
		$('#cbtn1').on('click', function() {
			//alert('aaaa'); chpter_search_div  
			$('#chpter_from_div').show();
			$('#chpter_search_div').hide();
			$(this).siblings().removeClass('active')
			$(this).addClass('active');
		});

		$('#cbtn2').on('click', function() {
			// alert('bbbb'); 	
			$('#chpter_search_div').show();
			$('#chpter_from_div').hide();
			$(this).siblings().removeClass('active')
			$(this).addClass('active');
		});
	});
</script>

<script type="text/javascript">

	function filterchapters(){
		let aclass = $('#id_class0').val();
		let subject = $('#id_subject0').val();
		let book = $('#books').val();
		
		if(!aclass){
			alert('Please select class');
			return false;
		}
		
		if(!subject){
			alert('Please select subject');
			return false;
		}
		
		window.location.href = "{{ url( 'chapters') }}/"+ aclass +"/"+ subject +"/"+ book;
		
	}
	
</script>

@endsection