@extends('layouts.app')
@section('title', 'Goforfit')
@section('content')
   <div class="pg-yallow-color">
        <div class="fillter-rw navbar-expand-lg">
            <!--<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#fillter" aria-controls="fillter" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M23 0l-8.412 15h-5.215l-8.373-15h22zm-13 17v7h4v-7h-4z"/></svg></span>
            </button> -->
            <div id="fillter" class="" role="group" aria-label="Basic example">
                <div class="">
                    <div class="row">
                        <div class="col-12 col-sm-4">
                            <div class="shot-contnts btn-group">
                                <button type="button" class="btn btn-secondary active"><span class="flt-txt">By Fillter</span><svg class="filter-i" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M23 0l-8.412 15h-5.215l-8.373-15h22zm-13 17v7h4v-7h-4z"/></svg></button>
                                <button type="button" class="btn btn-secondary"><span class="flt-txt">By Search</span><svg class="serach-i" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M9.145 18.29c-5.042 0-9.145-4.102-9.145-9.145s4.103-9.145 9.145-9.145 9.145 4.103 9.145 9.145-4.102 9.145-9.145 9.145zm0-15.167c-3.321 0-6.022 2.702-6.022 6.022s2.702 6.022 6.022 6.022 6.023-2.702 6.023-6.022-2.702-6.022-6.023-6.022zm9.263 12.443c-.817 1.176-1.852 2.188-3.046 2.981l5.452 5.453 3.014-3.013-5.42-5.421z"/></svg></button>
                            </div>

                        </div>
                        <div class="col-12 col-sm-8">

                            <form class="fltr-frm form-inline" type="get" name="chpter_from" id="chpter_from" action="{{ route('chapter') }}">
                                <select class="form-control" name="class_id" id="class_id">
                                <option>All Classes</option>
                                @foreach($classes as $cls)
                                 <?php
                                     if(!empty($_REQUEST['class_id'])&& $_REQUEST['class_id']==$cls->id){
                                       $stselect='selected';
                                     }else{
                                       $stselect='';
                                     }
                                 ?>
                                <option value="{{ $cls->id }}" <?=$stselect?>>{{ $cls->name }}</option> 
                               @endforeach  
                                
                            </select>
                                <select class="form-control" name="subject_id" id="subject_id">
                                <option>All Subjects</option>
                                @foreach($subjects as $sbj)             
                               <?php
                                 if(!empty($_REQUEST['subject_id'])&& $_REQUEST['subject_id']==$sbj->id){
                                   $subs='selected';
                                 }else{
                                   $subs='';
                                 }
                                ?> 
                                <option value="{{ $sbj->id }}" <?=$subs?>>{{ $sbj->name }}</option> 
                            @endforeach      
                            </select>
                                <button type="submit" name="searchdata" value="searchdata" class="btn btn-primary"><i class="fa fa-filter" aria-hidden="true"></i> Go</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <div class="container-fluid">
        <div class="all-chaptr-cards">
            <div class="row">
                <div class="col">
                    <div class="heading-rw">
                        <h1>All Chapters</h1>
                        <h2 class="show-rslt">(Found <strong>{{ $count}}</strong>)</h2>
                        <a class="more-chptr" href="#a">Show more<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M21 12l-18 12v-24z"/></svg></a>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php //<!--<div class="total-count">Found <strong>{{$count}}</strong> Results<br></div>-->;?>
                        @if(count($chapter)>0)
                        <?php $i=0;?>       
                        @foreach($chapter as $act)    
                        <?php
                          $i++; 
                        ?>
                        <?php
                          if(!empty($_REQUEST['chpter_name'])&& $_REQUEST['chpter_name']!=''){
                          
                            $tname=$_REQUEST['chpter_name'];

                           }else{

                            $tname='';
                         }
                        ?>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="card chapter-bx">
                        <?php 
                            $con_result = DB::table('concept')->where('chapter_id', $act->id)->get();
                            $total = DB::table('concept')->where('chapter_id', $act->id)->count();              
                        ?>
                        <a href="concepts">
                            <?php                  
                                $word = "wp-content";
                                $mystring = $act->image;
								if(empty($mystring)){
									?>               
                              <img class="card-img-top" src="{{ asset('public/uploads').'/'.'book.jpg' }}" alt="Card image cap">
                              <?php
								}else  if(strpos($mystring, $word)!== false){ ?>
                                 <a href="{{ route('home') }}">
                                   <img class="card-img-top" src="{{ $act->image }}"
                                     alt="" srcset="{{ $act->image }} 373w, {{ $act->image }} 280w" 
                                    sizes="(max-width: 300px) 100vw, 330px">
                                 </a>
                              <?php } else if (file_exists('public/uploads/'.$act->image)){ ?>
                                <img class="card-img-top" src="{{ asset('public/uploads').'/'.$act->image }}" alt="Card image cap">                           
                              <?php } else{ ?>               
                              <img class="card-img-top" src="{{ asset('public/uploads').'/'.'book.jpg' }}" alt="Card image cap">
                              <?php }  ?>   
                            <span class="card-body">
                                <span class="no-concents">{{ $total}} Concepts</span>
                            <h3 class="card-text">{{ ($act->name) }}</a></h3>
                            </span>
                        </a>
                    </div>
                </div>
                
                  @endforeach
                  @else 
                  <?php echo "<center><p align='center'> No Activity Data Found ...!</p></center>";?>    
                @endif
            </div>

        </div>
    </div>

@endsection