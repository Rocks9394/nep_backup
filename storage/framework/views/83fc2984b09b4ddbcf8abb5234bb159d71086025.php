
<?php $__env->startSection('title', 'Goforfit | ' . $title); ?>
<?php $__env->startSection('content'); ?>
    
<link href="https://nep.goforfit.in/resources/css/demo.css" rel="Stylesheet" />
<link href="https://nep.goforfit.in/resources/css/jquery-tilesgallery.css" rel="Stylesheet" />
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="Stylesheet" />

<!-- <link href="https://cdn.jsdelivr.net/npm/lightgallery@2.0.0-beta.3/css/lightgallery.css" rel="stylesheet"/>
<link href="https://cdn.jsdelivr.net/npm/lightgallery@2.0.0-beta.3/css/lg-zoom.css" rel="stylesheet"/> -->
<?php $sty1 = 'display:block'; ?>

<style>

    .media-row {
        list-style: none;
        padding: 0px;
        list-style: none;
        display: grid;
        grid-template-columns: repeat(auto-fill,minmax(300px, 1fr));
        gap: 10px; /* Spacing between grid items */
      
    }
    .media-row .list, video {
        aspect-ratio: 16 / 9;
    }
     .media-row .list > video {
        width: 100%;
    }
    .cover-photo {
        height: 180px;
        cursor: pointer;
    }
    .cover-photo img {
        max-width: 100%;
        object-fit: cover;
        width: 100%;
        height: 100%;
    }
    .upload {
        border: 2px dashed #ccc;
        padding: 15px;
        height: 150px;
        display: flex;
        vertical-align: middle;
        width: 100%;
        box-sizing: border-box;
        margin: 0;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        margin-bottom: 30px;
    }
    .info {
        font-size: 12px;
        color: #333;
        display: flex;
        gap: 5px;
    }

    .media-files h4, .media-files h4 span {
        font-size: 18px;
        color: #000;
    }
    .upload-list {
        display: flex;
        justify-content: start;
        align-items: center;
        background-color: #f4f4f9;
        margin-bottom: 10px;
        border-radius: 6px;
        color: #000;
    }
    .upload-list:last-child {
        margin-bottom: 0px;
    }
    .thumb {
        display: flex;
        align-items: center;
        padding: 15px;
    }
    .thumb > svg {
        object-fit: cover;
        width: 24px;
        height: 24px;
    }
    .file-size {
        color: #666;
    }
    .progress {
        width: 100%;
        background-color: #dddde9;
    }
    .cheked-i {
        width: 18px;
        height: 18px;
    }
    .cheked-i svg {
        fill: #999;
    }
    .cheked-i.uploaded svg {
        fill: #28a745;
    }
    .progress {
        height: 0.65rem;
        font-size: .55rem;
    }

    .gallery .tags-bar {
        display: none;
    }

    /* Dark modal background */
    .lightbox-content {
        background: transparent;
        border: none;
    }
    .modal-backdrop.show {
        opacity: 1 !important;
        background-color: rgba(0, 0, 0, 0.8) !important;  /* darker overlay */
    }

    /* Extra smooth animation */
    .modal.fade .modal-dialog {
        transition: transform 0.3s ease-in-out;
    }

    /* Image styling */
    .lightboxImage {
        max-height: 80vh;
        border-radius: 10px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.7);
    }

    /* Navigation buttons */
    .mg-prev,
    .mg-next {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 60px;
        height: 60px;
        background: rgba(0,0,0,0.6);
        color: #fff;
        font-size: 32px;
        font-weight: bold;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        user-select: none;
    }

    /* Position */
    .mg-prev { left: -70px; }
    .mg-next { right: -70px; }

    /* Hover effect */
    .mg-prev:hover,
    .mg-next:hover {
        background: #ffffff;
        color: #000;
        transform: translateY(-50%) scale(1.1);
    }

    /* Mobile responsive */
    @media (max-width: 768px) {
    .mg-prev { left: 10px; }
    .mg-next { right: 10px; }
    }
    


</style>



<div class="container">
    <div class="t-mrg2">
        <div class=" all-chaptr-cards" style="margin: 0;">
            <div class="row">
                    <div class="col">
                        <div class="heading-rw mt-0 mt-md-1 mb-0 p-0">
                            <a href="<?php echo e(route('filldart.dashboard')); ?>" class="back-button">
                                <span class="arrow"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5" />
                                    </svg>
                                </span>
                            </a>
                            <h1 class="mt-2 mt-md-0 ml-md-4 mb-0"><?php echo e($title); ?></h1>
                        </div>
                    </div>
                    <div class="col-auto">
                        <a type="button" id="upload_btn" class="btn btn-primary text-light text-center custome-btn-i w-100 mr-2"
                        data-toggle="modal" data-target="#exampleModalLong">
                        <i class="fa-solid fa-upload"></i>Upload
                        </a>                       
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="tabs-pnl text-center mt-4">
                        <ul class="nav nav-pills mb-3 justify-content-center" id="pills-tab" role="tablist">
                            <li class="nav-item mx-1">
                                <a class="nav-link active" id="pills-media-tab" data-toggle="pill" href="#pills-media" role="tab" aria-controls="pills-media" aria-selected="true">Photos</a>
                            </li>
                            <li class="nav-item mx-1">
                                <a class="nav-link" id="pills-videos-tab" data-toggle="pill" href="#pills-videos" role="tab" aria-controls="pills-videos" aria-selected="false">Videos</a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content-pnl my-4 text-center">
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-media" role="tabpanel" aria-labelledby="pills-media-tab">
                                <div class="media-grid mb-5">
                                    
                                    <div class="gallery-container">
                                        <div class="media-row gallery">
                                            <div class="list">
                                                <div class="card p-0">
                                                    <div class="cover-photo">
                                                        <img data-gallery-tag="women" class="gallery-item" src="<?php echo e(asset('/public/assets/media/photo-001.jpg')); ?>" onclick="openMedia(this, 'image')" />
                                                    </div>
                                                    <div class="card-body text-left">
                                                        <h5 class="card-title">Activity Title</h5>
                                                        <div class="card-text d-flex justify-content-between">
                                                            <span>Date: 24 Aug 2025</span>
                                                            <span>Class: VI</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="list">
                                                <div class="card p-0">
                                                    <div class="cover-photo">
                                                        <img data-gallery-tag="women" class="gallery-item" src="<?php echo e(asset('/public/assets/media/photo-001.jpg')); ?>" onclick="openMedia(this, 'image')" />
                                                    </div>
                                                    <div class="card-body text-left">
                                                        <h5 class="card-title">Activity Title</h5>
                                                        <div class="card-text d-flex justify-content-between">
                                                            <span>Date: 24 Aug 2025</span>
                                                            <span>Class: VI</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="list">
                                                <div class="card p-0">
                                                    <div class="cover-photo">
                                                        <img data-gallery-tag="women" class="gallery-item" src="<?php echo e(asset('/public/assets/media/photo-001.jpg')); ?>" onclick="openMedia(this, 'image')" />
                                                    </div>
                                                    <div class="card-body text-left">
                                                        <h5 class="card-title">Activity Title</h5>
                                                        <div class="card-text d-flex justify-content-between">
                                                            <span>Date: 24 Aug 2025</span>
                                                            <span>Class: VI</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                                

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-videos" role="tabpanel" aria-labelledby="pills-videos-tab">
                                <div class="media-grid">
                                    <div class="gallery-container">
                                        <div class="media-row gallery">
                                            <div class="list">
                                                <div class="card p-0">
                                                    <div class="cover-photo">
                                                        <video controls class="gallery-item" onclick="openMedia(this, 'video')">
                                                            <source src="<?php echo e(asset('/public/assets/media/dummy-video.mp4')); ?>" type="video/mp4" >
                                                        </video>    
                                                    </div>
                                                    <div class="card-body text-left">
                                                        <h5 class="card-title">Activity Title</h5>
                                                        <div class="card-text d-flex justify-content-between">
                                                            <span>Date: 24 Aug 2025</span>
                                                            <span>Class: VI</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="list">
                                                <div class="card p-0">
                                                    <div class="cover-photo">
                                                        <video controls class="gallery-item" onclick="openMedia(this, 'video')">
                                                            <source src="<?php echo e(asset('/public/assets/media/dummy-video.mp4')); ?>" type="video/mp4" >
                                                        </video>    
                                                    </div>
                                                    <div class="card-body text-left">
                                                        <h5 class="card-title">Activity Title</h5>
                                                        <div class="card-text d-flex justify-content-between">
                                                            <span>Date: 24 Aug 2025</span>
                                                            <span>Class: VI</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="list">
                                                <div class="card p-0">
                                                    <div class="cover-photo">
                                                        <video controls class="gallery-item" onclick="openMedia(this, 'video')">
                                                            <source src="<?php echo e(asset('/public/assets/media/dummy-video.mp4')); ?>" type="video/mp4" >
                                                        </video>    
                                                    </div>
                                                    <div class="card-body text-left">
                                                        <h5 class="card-title">Activity Title</h5>
                                                        <div class="card-text d-flex justify-content-between">
                                                            <span>Date: 24 Aug 2025</span>
                                                            <span>Class: VI</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="list">
                                                <div class="card p-0">
                                                    <div class="cover-photo">
                                                        <video controls class="gallery-item" onclick="openMedia(this, 'video')">
                                                            <source src="<?php echo e(asset('/public/assets/media/dummy-video.mp4')); ?>" type="video/mp4" >
                                                        </video>    
                                                    </div>
                                                    <div class="card-body text-left">
                                                        <h5 class="card-title">Activity Title</h5>
                                                        <div class="card-text d-flex justify-content-between">
                                                            <span>Date: 24 Aug 2025</span>
                                                            <span>Class: VI</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal Upload Media -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Media Library</h5>
      </div>

      <div class="modal-body p-4">
        <div class="uploadfiels drop_box">
            <!-- <h5 class="card-title mb-3">Upload files</h4>   -->
             <div class="from-group mb-4">
                <form class="row" method="POST" name="fill_dart_data_submit" id="fill_dart_submit" action="<?php echo e(route('fill.dart.data.submit')); ?>" >
                <?php echo e(method_field('post')); ?>

                <?php echo csrf_field(); ?>
                    <div class="col-12">
                        <div id="activity_from_div" class="sports-filtr overlay" style="<?= $sty1 ?>">
                            <?php
                                $sclasses = '<option value="">Class</option>';

                                if (!empty($classes)) {
                                    foreach ($classes as $cls) {

                                        $sclasses .= '<option value="' . $cls->id . '-' . $cls->class_id . '" ';
                                        if (!empty($_GET['sclass'])) {
                                            if ($cls->id == $_GET['sclass']) {
                                                $sclasses .= ' selected';
                                                $sclsname = $cls->name;
                                            }
                                        }
                                        $sclasses .= ' >' . $cls->classname . '-' . $cls->section . '</option>';
                                    }
                                }
                                $askillarea = '<option value="">Skill Area</option>';
                                if (!empty($skillareas)) {
                                    foreach ($skillareas as $skillarea) {

                                        $kselect = (!empty($_REQUEST['skillarea']) && ($_REQUEST['skillarea'] == $skillarea->id) ? 'selected="selected"' : '');

                                        $askillarea .= '<option value="' . $skillarea->id . '" ' . $kselect . '>' . $skillarea->name . '</option>';
                                    }
                                    $askillarea .= '<option value="1000" ' . $kselect . '>Sports for all</option>';
                                }
                                $asportskills = '<option value="">Skill/Sports</option>';
                                if (!empty($sportskills)) {
                                    foreach ($sportskills as $sportskill) {
                                        $spselect = (!empty($_REQUEST['skillsports']) && ($_REQUEST['skillsports'] == $sportskill->id) ? 'selected="selected"' : '');
                                        $asportskills .= '<option value="' . $sportskill->id . '" ' . $spselect . '>' . $sportskill->name . '</option>';
                                    }
                                }
                                $atechniques = '<option value="">Technique</option>';
                                if (!empty($techniques)) {
                                    foreach ($techniques as $technique) {
                                        $tselect = (!empty($_REQUEST['technique']) && ($_REQUEST['technique'] == $technique->id) ? 'selected="selected"' : '');
                                        $atechniques .= '<option value="' . $technique->id . '" ' . $tselect . '>' . $technique->name . '</option>';
                                    }
                                }
                                $getact = '<option value="">Activity</option>';
                                if (!empty($act)) {
                                    foreach ($act as $ac) {
                                        $sclasses .= '<option value="' . $ac->id . '" ';
                                        $getact .= ' >' . $ac->title . '</option>';
                                    }
                                }
                            ?>
                            <div class="form-row">
                                <div class="col-12 col-md-3 mb-3">
                                    <label for="Date">Date</label><br>
                                    <input class="form-control mx-0 w-100" type="date" max="<?php echo date("Y-m-d"); ?>" id="date" name="date">
                                </div>

                                <?php 
                                ?>

                                <input type="hidden" name="school_id" id="school_id" value="<?php echo e($schoolId); ?>">

                                <div class="col-6 col-md-3 mb-3">
                                    <label for="Class">Class</label><br>
                                    <select class="form-control mx-0 w-100" name="sclass" id="sclass0" >
                                        <?= $sclasses ?>
                                    </select>
                                </div>
                                <input type="hidden" name="custm_cls_id" id="custm_cls_id">

                                <div class="col-6 col-md-3 mb-3">
                                    <label for="Period">Period</label><br>
                                    <select class="form-control mx-0 w-100" name="period" id="period_id" onchange="getFillDARTskillarea(0,this.value)">
                                        <option value="">Period</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                    </select>

                                </div>

                            </div>
                            <div class="form-row">
                                <div class="col-12 col-md-3 mb-3">
                                    <label for="skillarea">Skill Area</label><br>
                                    <select class="form-control mx-0 w-100" id="skillarea0" name="skillarea" onchange="getskillsports(0,this.value)">
                                        <option value="">Skill Area</option>
                                    </select>
                                </div>

                                <div class="col-12 col-md-3 mb-3">
                                    <label for="sports">Skill/Sports</label><br>
                                    <select class="form-control selctopt" id="skillsports0" name="skillsports" onchange="gettechnique(0,this.value)">
                                        <option value="">Skill/Sports</option>
                                    </select>
                                </div>

                                <div class="col-12 col-md-3 mb-3">
                                    <label for="technique">Technique</label><br>
                                    <select class="form-control selctopt" id="technique0" name="technique" onchange="getactivity(0,this.value)">
                                        <option value="">Technique</option>
                                    </select>
                                </div>


                                <div class="col-12 col-md-3 mb-3">
                                    <label for="activity">Activity</label><br>
                                    <div class="activity-info">
                                    
                                    <a href="#a" id="anchor-id" data-toggle="modal" data-target="#activityDetailId"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle-fill" viewBox="0 0 16 16">
                                            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2" />
                                        </svg>
                                    </a>
                                        <select class="form-control mx-0 w-100" name="activity" id="activity_id" onchange="getstudents(0,this.value)">
                                            <option value="">Activity</option>
                                        </select>
                                    </div>

                                </div>


                            </div>
                        </div>
                    </div>
                </form>
             </div>
            <div class="upload d-flex flex-column w-100">
                <input type="file" hidden accept=".doc,.docx,.pdf" id="fileID" style="display:none;">
                <button class="btn btn-primary">Select Files</button>
                <p class="info mt-3">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                            <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
                        </svg>
                    </span>You can upload up to 4 files at a time.
                </p>
            </div>
        </div>
        <div class="media-files">
            <h4><span>3</span> files uploaded successfully</h4>  
            <div class="upload-list pr-3">
                <div class="thumb">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-file-play" viewBox="0 0 16 16">
                        <path d="M6 10.117V5.883a.5.5 0 0 1 .757-.429l3.528 2.117a.5.5 0 0 1 0 .858l-3.528 2.117a.5.5 0 0 1-.757-.43z"/>
                        <path d="M4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm0 1h8a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1"/>
                    </svg>
                </div>
                <div class="d-flex flex-column w-100 py-3">
                    <div class="d-flex justify-content-between mb-2">
                        <div class="mb-0 d-flex justify-content-between" style="gap: 15px;">
                            <span>image_025.jpg</span>
                            <span class="d-flex align-items-center"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dot" viewBox="0 0 16 16">
                                    <path d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3"/>
                                </svg>Uploading...
                            </span>
                        </div>
                        <div>50%</div>
                    </div>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <!-- <p>3.22 MB</p> -->
                </div>
            </div>
            <div class="upload-list pr-3">
                <div class="thumb">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-file-play" viewBox="0 0 16 16">
                        <path d="M6 10.117V5.883a.5.5 0 0 1 .757-.429l3.528 2.117a.5.5 0 0 1 0 .858l-3.528 2.117a.5.5 0 0 1-.757-.43z"/>
                        <path d="M4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm0 1h8a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1"/>
                    </svg>
                </div>
                <div class="d-flex flex-column w-100 py-2">
                    <div class="d-flex justify-content-between mb-1">
                        <div class="mb-0 d-flex justify-content-between" style="gap: 15px;"><span>image_025.jpg</span>
                            <span class="d-flex align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dot" viewBox="0 0 16 16">
                                    <path d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3"/>
                                </svg>Uploaded
                            </span>
                        </div>
                        <!-- <div>50%</div> -->
                        
                    </div>
                    <p class="file-size">3.22 MB</p>
                </div>
                <div class="cheked-i uploaded">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                    </svg>
                </div>
            </div>
            <div class="upload-list pr-3">
                <div class="thumb">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-file-image" viewBox="0 0 16 16">
                        <path d="M8.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0"/>
                        <path d="M12 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2M3 2a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1v8l-2.083-2.083a.5.5 0 0 0-.76.063L8 11 5.835 9.7a.5.5 0 0 0-.611.076L3 12z"/>
                    </svg>
                </div>
                <div class="d-flex flex-column w-100 py-2">
                    <div class="d-flex justify-content-between mb-1">
                        <div class="mb-0 d-flex justify-content-between" style="gap: 15px;"><span>image_025.jpg</span>
                            <span class="d-flex align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dot" viewBox="0 0 16 16">
                                    <path d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3"/>
                                </svg>Uploaded
                            </span>
                        </div>
                        <!-- <div>50%</div> -->
                    </div>
                    <!-- <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                    </div> -->
                    <p class="file-size">3.22 MB</p>
                </div>
                <div class="cheked-i uploaded">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                    </svg>
                </div>
            </div>
            <div class="upload-list pr-3">
                <div class="thumb">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-file-image" viewBox="0 0 16 16">
                        <path d="M8.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0"/>
                        <path d="M12 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2M3 2a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1v8l-2.083-2.083a.5.5 0 0 0-.76.063L8 11 5.835 9.7a.5.5 0 0 0-.611.076L3 12z"/>
                    </svg>
                </div>
                <div class="d-flex flex-column w-100 py-2">
                    <div class="d-flex justify-content-between mb-1">
                        <div class="mb-0 d-flex justify-content-between" style="gap: 15px;"><span>image_025.jpg</span>
                            <span class="d-flex align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dot" viewBox="0 0 16 16">
                                    <path d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3"/>
                                </svg>Uploaded
                            </span>
                        </div>
                        <!-- <div>50%</div> -->
                    </div>
                    <!-- <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                    </div> -->
                    <p class="file-size">3.22 MB</p>
                </div>
                <div class="cheked-i uploaded">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                    </svg>
                </div>
            </div>     
        </div>
      </div>
    <div class="modal-footer p-4">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary">Save</button>
      </div>
  </div>
</div>

<!-- VIEW MODAL -->
<div class="modal fade" id="mediaModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content bg-transparent border-0">
            <div class="modal-body text-center position-relative">

                <button class="btn btn-light position-absolute" style="left:10px;top:50%" onclick="prevMedia()">‹</button>
                <button class="btn btn-light position-absolute" style="right:10px;top:50%" onclick="nextMedia()">›</button>

                <img id="modalImage" class="img-fluid d-none" style="max-height:80vh;">
                <video id="modalVideo" controls class="w-100 d-none" style="max-height:80vh;"></video>

            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>

<?php $__env->stopPush(); ?> 
<?php echo $__env->make('layouts.filldart-app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\nep\resources\views/activity/media/gallary.blade.php ENDPATH**/ ?>