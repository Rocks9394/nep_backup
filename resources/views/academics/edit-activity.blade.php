@extends('layouts.app')
@section('title', 'Goforfit - EditActivity' )

@section('content')
@php $permission = array(1,3,4,5,6); @endphp

<!-- Required meta tags 
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
    integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">	
	-->


<!-- cdnjs.com / libraries / fontawesome 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" charset="utf-8"></script>-->
<script src="https://cdn.tiny.cloud/1/tx36okfd50l19ff8m449pe7pcik0rk6qojike6929d24zxfm/tinymce/5/tinymce.min.js"
    referrerpolicy="origin"></script>
<style>
.note-popover .arrow {
    display: none;
}
</style>

<div class="wrapper">
    @include('layouts.sidebar')

    <div id="content">

        <div class="navbar toggle-bar">
            <button type="button" id="sidebarCollapse" class="toggle-btn btn">
                <img src="{{ asset('resources/imgs/side-menu.svg') }}" alt="sidemenu">
            </button>


            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('academics') }}">Academic</a></li>

                    <li class="breadcrumb-item active"> Edit Activity </li>

                </ol>
            </nav>

        </div>





        <div class="dashboard-area">
            <div class="row">
                <div class="col-md-12">

                </div>
            </div>
            <form method="POST" action="{{url('update-activity')}}/{{$data->id}}" id="add-activity"
                enctype="multipart/form-data">

                @csrf
                <input type="hidden" name="activity_id" value="{{$data->id}}">
                <div class="row">

                    <div class="col-md-12">
                        <div class="frm-area">
                            <div class="card-header" data-card-widget="collapse" title="Collapse">
                                <h1 class="card-title">Edit Activity</h1>

                                <div class="act-filter-bar">
                                    <span
                                        class="ftr-academy flt-txt <?php if(!empty($_REQUEST['filterby'])){ if($_REQUEST['filterby'] == 'academy'){ echo 'active'; } }else{ echo 'active'; } ?> "
                                        id="btn-academy" onclick="getfilter('academy')">For Academy</span>
                                    <span
                                        class="ftr-sports flt-txt <?php if(!empty($_REQUEST['filterby']) && $_REQUEST['filterby'] == 'sports'){ echo 'active'; } ?>"
                                        id="btn-sports" onclick="getfilter('sports')">For Sports</span>
                                </div>
                            </div>

                            <div class="card-body">

                                <div class="row">
                                    <div class="col-md-12">

                                        @if (session('status'))
                                        <div class="alert alert-success">
                                            {{ session('msg') }}
                                        </div>
                                        @endif
                                        @if ($errors->any())
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        @endif

                                        <?php 
											   if(!empty($actconcepts[0]->class_id)){ $aclass = $actconcepts[0]->class_id; }
											   if(!empty($actconcepts[0]->subject_id)){ $asubj = $actconcepts[0]->subject_id; }
											   if(!empty($actconcepts[0]->chapter_id)){ $achapt = $actconcepts[0]->chapter_id; }
											   if(!empty($actconcepts[0]->con_id)){ $acncpt = $actconcepts[0]->con_id; }
											   
											   if(!empty($acttechniques[0]->skillarea_id)){ $askill = $acttechniques[0]->skillarea_id; }
											   if(!empty($acttechniques[0]->sportskill_id)){ $asport = $acttechniques[0]->sportskill_id; }
											   if(!empty($acttechniques[0]->technique_id)){ $atech = $acttechniques[0]->technique_id; }
												
												
											   /*
                                                <input type="hidden" name="class_id" value="<?=$concept[0]->class_id;?>">
                                        <input type="hidden" name="subject_id" value="<?=$concept[0]->subject_id;?>">
                                        <input type="hidden" name="chapter_id" value="<?=$concept[0]->chapter_id;?>">
                                        <input type="hidden" name="concept_id" value="<?=$concept[0]->id;?>">
                                        */
                                        ?>

                                        <input type="hidden" name="teaching_throug" value="1">
                                        <input type="hidden" name="status" value="0">
                                        <input type="hidden" id="filterbyelem" name="filterby"
                                            value="<?php if(!empty($_GET['filterby'])){ echo $_GET['filterby']; }else{ echo 'academy'; }?>" />




                                        <div class="fltr-drdwn form-group" id="fltr-academy"
                                            <?php if(!empty($_REQUEST['filterby']) && $_REQUEST['filterby'] == 'sports'){  echo 'style="display:none"';  } ?>>

                                            <div class="form-group">
                                                <div class="row">

                                                    <div class="col-md-6">
                                                        <label>Class</label>
                                                        <select class="form-control" name="class_id" id="id_class0"
                                                            onchange="getsubjects(0,this.value)">
                                                            <option value="">All Classes</option>
                                                            @foreach($classes as $cls)
                                                            <option value="{{ $cls->id }}" @if( !empty($aclass) &&
                                                                $cls->id == $aclass) {{ 'selected' }}@endif >
                                                                {{ $cls->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label>Subjects</label>
                                                        <select class="form-control" id="id_subject0" name="subject_id"
                                                            onchange="getchapters(0,this.value)">
                                                            <option value="">Select Subject</option>
                                                            @foreach($subjects as $sbj)
                                                            <option value="{{ $sbj->id }}" @if( !empty($asubj) && $sbj->
                                                                id == $asubj) {{ 'selected' }} @endif
                                                                >{{ $sbj->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label>Chapters</label>
                                                        <select class="form-control selctopt" id="id_chapter0"
                                                            name="chapter_id" onchange="getconcepts(0,this.value)">
                                                            <option value="">Select Chapter</option>
                                                            @foreach($chapters as $chap)
                                                            <option value="{{ $chap->id }}" @if( !empty($achapt) &&
                                                                $chap->id == $achapt) {{ 'selected' }} @endif
                                                                >{{ $chap->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6">


                                                        <label>Concepts</label>
                                                        <select class="form-control selctopt" id="id_concept0"
                                                            name="concept_id">
                                                            <option value="">Select Concepts</option>
                                                            @foreach($concepts as $con)
                                                            <option value="{{ $con->id }}" @if( !empty($acncpt) &&
                                                                $con->id == $acncpt) {{ 'selected' }} @endif
                                                                >{{ $con->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="fltr-drdwn form-group" id="fltr-sports"
                                            <?php if(empty($_REQUEST['filterby'])){ echo 'style="display:none"'; } ?>
                                            <?php if(!empty($_REQUEST['filterby']) && $_REQUEST['filterby'] == 'academy'){  echo 'style="display:none"';  } ?>>

                                            <div class="form-group">
                                                <div class="row">

                                                    <div class="col-md-6">
                                                        <label>Class</label>
                                                        <select class="form-control" name="sclass" id="sclass0"
                                                            onchange="getskillarea(0,this.value)">
                                                            <option value="">All Classes</option>
                                                            @foreach($classes as $cls)
                                                            <option value="{{ $cls->id }}" @if( !empty($aclass) &&
                                                                $cls->id == $aclass) {{ 'selected' }}@endif >
                                                                {{ $cls->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label>Skill Area</label>
                                                        <select class="form-control" id="skillarea0" name="skillarea"
                                                            onchange="getskillsports(0,this.value)">
                                                            <option value="">Select Skill Area</option>
                                                            @foreach($skills as $skl)
                                                            <option value="{{$skl->id }}" @if( !empty($askill) && $skl->
                                                                id == $askill) {{ 'selected' }}@endif >
                                                                {{$skl->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label>Skill/Sports</label>
                                                        <select class="form-control selctopt" id="skillsports0"
                                                            name="skillsports" onchange="gettechnique(0,this.value)">
                                                            <option value="">Select Skill/Sports</option>
                                                            @foreach($sports as $sprt)
                                                            <option value="{{$sprt->id }}" @if( !empty($asport) &&
                                                                $sprt->id == $asport) {{ 'selected' }}@endif >
                                                                {{ $sprt->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6">


                                                        <label>Technique</label>
                                                        <select class="form-control selctopt" id="technique0"
                                                            name="technique">
                                                            <option value="">Select Technique</option>
                                                            @foreach($techniques as $tech)
                                                            <option value="{{ $tech->id }}" @if( !empty($atech) &&
                                                                $tech->id == $atech) {{ 'selected' }}@endif >
                                                                {{ $tech->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>



                                    </div>

                                    <div class="col-md-12">

                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" name="title" class="form-control"
                                                value="{{ $data->title }}">
                                        </div>


                                        <div class="form-group">
                                            <label>Image</label>

                                            <input type="file" name="image" class="form-control">

                                        </div>




                                        <div class="form-group">
                                            <?php $word = "wp-content"; $mystring = $data->image;
											
													if(strpos($mystring, $word)!== false){ ?>
                                            <img src="{{ $data->image }}" width="100" height="100">
                                            <?php } else if (file_exists('public/uploads/'.$data->image)){ ?>
                                            <img src="{{ asset('public/uploads').'/'.$data->image }}" alt="" width="100"
                                                height="100">
                                            <?php } else { ?>
                                            <img src="{{ asset('public/uploads').'/'.'images.jpg' }}" width="100"
                                                height="100">
                                            <?php }  ?>

                                        </div>

                                        <div class="col-12">
                                            <div class="img-note hint"><img
                                                    src="{{ asset('resources/images/hint-i.png') }}"
                                                    alt=""><strong>Note:</strong> Dimension minimum 500
                                                by 300 to maximum 2000 by 2500 </div>
                                        </div>

                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="exampleInputEmail1" scope="col">YouTube
                                        URL</label>
                                    <input type="text" name="url" class="form-control " placeholder="Enter URL"
                                        value="{{ $data->url }}">
                                </div>

                                <div class="form-group">
                                    <label>Learning Outcomes</label>
                                    <textarea class="form-control editor" id="learning_outcomes"
                                        name="learning_outcomes"
                                        placeholder="Learning Outcomes">{{ $data->learning_outcomes }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1" scope="col">Description</label>
                                    <textarea id="description" class="form-control  editor" name="description"
                                        placeholder="Description">{{ $data->description }}</textarea>
                                </div>



                                <div class="form-group">
                                    <label for="exampleInputEmail1" scope="col">Variations</label>
                                    <textarea class="form-control  editor" id="variations" name="change_it"
                                        placeholder="Change it (Variations)">{{ $data->change_it }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1" scope="col">Coaching
                                        (Teaching Tips)</label>
                                    <textarea class="form-control  editor" id="coaching" name="coaching"
                                        placeholder="Coaching (Teaching Tips)">{{ $data->coaching }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1" scope="col">Equipment:</label>
                                    <textarea class="form-control  editor" id="equipment" name="equipment"
                                        placeholder="Equipment">{{ $data->equipment }}</textarea>
                                </div>

                                <div class="form-group">
                                    <div class="action-btns add-act-btn-div">
                                        <button type="submit"
                                            class="add-act-link btn btn-md btn-primary add-act-btn">Update</button>
                                    </div>
                                </div>

                            </div>
                        </div>


                    </div>
                </div>
        </div>


    </div>


    </form>


</div>


</div>
</div>

<!-- Option 2: jQuery, Popper.js, and Bootstrap JS 
<script src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
    integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"
    integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous">
</script>



-->



<script type="text/javascript">
tinymce.init({
    selector: 'textarea.editor',
    width: 900,
    height: 300
});
/*$(document).ready(function() {
    $('.editor').summernote({
        height: 200,
    });
});*/
</script>
<script>
function getfilter(elem) {

    if (elem == 'sports') {
        $('#filterbyelem').val("sports");
        $('#fltr-academy').hide();
        $('#fltr-sports').show();
        $('#btn-academy').toggleClass("active");
        $('#btn-sports').toggleClass("active");

    } else if (elem == 'academy') {
        $('#filterbyelem').val("academy");
        $('#fltr-academy').show();
        $('#fltr-sports').hide();
        $('#btn-academy').toggleClass("active");
        $('#btn-sports').toggleClass("active");
    }

}
</script>

@include('layouts.sidebarfooter')

@endsection