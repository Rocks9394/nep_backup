
<?php $__env->startSection('title', 'Goforfit | ' . $title); ?>
<?php $__env->startSection('content'); ?>
    
<link href="https://nep.goforfit.in/resources/css/demo.css" rel="Stylesheet" />
<link href="https://nep.goforfit.in/resources/css/jquery-tilesgallery.css" rel="Stylesheet" />
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="Stylesheet" />

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php $sty1 = 'display:block'; ?>

<style>
    /* Glassmorphism backdrop */
    .modal-backdrop.show {
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        background: rgba(0,0,0,0.6) !important;
    }

    /* Modal container */
    #mediaModal .modal-content {
        background: transparent;
        border: none;
        box-shadow: none;
    }

    /* Image & video */
    #modalImage, #modalVideo {
        max-height: 80vh;
        border-radius: 12px;
        transition: all 0.3s ease;
    }
    .media-row {
        display: grid !important;
        grid-template-columns: repeat(3, 1fr) !important;
        gap: 15px;
    }
    .media-card {
        width: 100%;
        max-width: 420px; /* controls card size */
        border-radius: 16px;
        overflow: hidden;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 6px 18px rgba(0,0,0,0.1);
    }

    .media-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 28px rgba(0,0,0,0.18);
    }

    .gallery-cover {
        width: 100%;
        height: 260px; /* increased height */
        object-fit: cover;
        display: block;
    }
    .card{
        padding: 0.5rem !important;
    }

    .card-body {
        padding: 10px 15px;
    }

    .card-title {
        font-size: 18px;
        font-weight: 600;
    }

    .card-text {
        font-size: 14px;
        color: #555;
    }

    /* Navigation buttons */
    .nav-btn {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 55px;
        height: 55px;
        border-radius: 50%;
        background: rgba(255,255,255,0.2);
        backdrop-filter: blur(8px);
        color: #fff;
        font-size: 28px;
        border: none;
        cursor: pointer;
        transition: 0.3s;
    }

    .nav-btn:hover {
        background: #fff;
        color: #000;
        transform: translateY(-50%) scale(1.1);
    }

    .prev-btn { left: -70px; }
    .next-btn { right: -70px; }

    /* Optional: make even bigger on large screens */
    @media (min-width: 992px) {
        .media-card {
            max-width: 500px;
        }

        .gallery-cover {
            height: 300px;
        }
    }
    /* Mobile fix */
    @media (max-width: 768px) {
        .prev-btn { left: 10px; }
        .next-btn { right: 10px; }
    }

    .cover-photo {
        height: 300px;
        cursor: pointer;
    }
    .cover-photo img,
    .cover-photo video,
    .gallery-cover,
    .gallery-cover img,
    .gallery-cover video {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }
    .gallery-cover {
        cursor: pointer;
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
                                            <?php
                                                $imageMedia = $media->where('media_type', 'image');
                                                $imageGroups = $imageMedia->groupBy(function($item) {
                                                    return ($item->activity_id ?? 'no-activity') . '-' . ($item->class_id ?? 'no-class');
                                                });
                                            ?>
                                            <?php $__currentLoopData = $imageGroups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="list d-flex justify-content-center">
                                                <div class="card media-card" data-media-type="image" onclick="openCardMedia(this)">
                                                    
                                                    <div class="cover-photo">
                                                        <?php if($group->first()): ?>
                                                            <img src="<?php echo e($group->first()->url ?? asset('/public/assets/media/photo-001.jpg')); ?>" class="gallery-cover" />
                                                        <?php else: ?>
                                                            <img src="<?php echo e(asset('/public/assets/media/photo-001.jpg')); ?>" class="gallery-cover" />
                                                        <?php endif; ?>
                                                    </div>

                                                    <div class="card-body text-left">
                                                        <h5 class="card-title">
                                                            <?php echo e($group->first()->activity ? $group->first()->activity->title : 'Activity'); ?>

                                                        </h5>

                                                        <div class="card-text d-flex justify-content-between flex-wrap">
                                                            <span>Date: <?php echo e(optional($group->first()->date)->format('d M Y') ?? 'N/A'); ?></span>
                                                            <span>Class: <?php echo e($group->first()->class_id ?? 'N/A'); ?></span>
                                                        </div>
                                                    </div>

                                                    <div class="group-media d-none">
                                                        <?php $__currentLoopData = $group; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <img data-type="image" data-src="<?php echo e($item->url); ?>" data-date="<?php echo e(optional($item->date)->format('d M Y') ?? 'N/A'); ?>" />
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </div>

                                                </div>
                                            </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-videos" role="tabpanel" aria-labelledby="pills-videos-tab">
                                <div class="media-grid">
                                    <div class="gallery-container">
                                        <div class="media-row gallery">
                                            <?php
                                                $videoMedia = $media->where('media_type', 'video');
                                                $videoGroups = $videoMedia->groupBy(function($item) {
                                                    return ($item->activity_id ?? 'no-activity') . '-' . ($item->class_id ?? 'no-class');
                                                });
                                            ?>
                                            <?php $__currentLoopData = $videoGroups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="list">
                                                <div class="card p-0 media-card" data-media-type="video" onclick="openCardMedia(this)">
                                                    <div class="cover-photo">
                                                        <?php if($group->first()): ?>
                                                        <video class="gallery-cover" muted playsinline controls preload="metadata" style="display:block;">
                                                            <source src="<?php echo e($group->first()->url ?? asset('/public/assets/media/dummy-video.mp4')); ?>" type="video/mp4" >
                                                        </video>
                                                        <?php else: ?>
                                                        <video class="gallery-cover" muted playsinline controls preload="metadata" style="max-height:220px; display:block;">
                                                            <source src="<?php echo e(asset('/public/assets/media/dummy-video.mp4')); ?>" type="video/mp4" >
                                                        </video>
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="card-body text-left">
                                                        <h5 class="card-title"><?php echo e($group->first()->activity ? $group->first()->activity->title : 'Activity Video'); ?></h5>
                                                        <div class="card-text d-flex justify-content-between">
                                                            <span>Date: <?php echo e(optional($group->first()->date)->format('d M Y') ?? 'N/A'); ?></span>
                                                            <span>Class: <?php echo e($group->first()->class_id ?? 'N/A'); ?></span>
                                                        </div>
                                                    </div>
                                                    <div class="group-media d-none">
                                                        <?php $__currentLoopData = $group; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <div data-type="video" data-src="<?php echo e($item->url); ?>" data-date="<?php echo e(optional($item->date)->format('d M Y') ?? 'N/A'); ?>"></div>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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

<!-- VIEW MODAL -->
<div class="modal fade" id="mediaModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">

            <div class="modal-body text-center position-relative">

                <button class="nav-btn prev-btn" onclick="prevMedia()">&#10094;</button>
                <button class="nav-btn next-btn" onclick="nextMedia()">&#10095;</button>

                <div id="mediaCounter" class="position-absolute" style="top:10px; right:10px; color:#fff; background:rgba(0,0,0,.35); padding:6px 10px; border-radius:8px; z-index:15; font-weight:600; font-size:14px;">0/0</div>

                <img id="modalImage" class="d-none" style="max-width:100%; max-height:80vh; border-radius: 12px;" />
                <video id="modalVideo" controls class="d-none" style="max-width:100%; max-height:80vh; border-radius: 12px;"></video>

            </div>

        </div>
    </div>
</div>

<!-- Modal Upload Media -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Upload Activity Media</h5>
      </div>

      <div class="modal-body p-4">
        <div class="uploadfiels drop_box">
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
                                <div class="col-12 col-md-4 mb-3">
                                    <label for="Date">Date</label><br>
                                    <input class="form-control mx-0 w-100" type="date" max="<?php echo date("Y-m-d"); ?>" id="date" name="date" required>
                                </div>

                                <?php 
                                ?>

                                <input type="hidden" name="school_id" id="school_id" value="<?php echo e($schoolId); ?>">

                                <div class="col-6 col-md-4 mb-3">
                                    <label for="Class">Class</label><br>
                                    <select class="form-control mx-0 w-100" name="sclass" id="sclass0" required>
                                        <?= $sclasses ?>
                                    </select>
                                </div>
                                <input type="hidden" name="custm_cls_id" id="custm_cls_id">

                                <div class="col-6 col-md-4 mb-3">
                                    <label for="Period">Period</label><br>
                                    <select class="form-control mx-0 w-100" name="period" id="period_id" onchange="getFillDARTskillarea(0,this.value)" required>
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
                                    <select class="form-control mx-0 w-100" id="skillarea0" name="skillarea" onchange="getskillsports(0,this.value)" required>
                                        <option value="">Skill Area</option>
                                    </select>
                                </div>

                                <div class="col-12 col-md-3 mb-3">
                                    <label for="sports">Skill/Sports</label><br>
                                    <select class="form-control selctopt" id="skillsports0" name="skillsports" onchange="gettechnique(0,this.value)" required>
                                        <option value="">Skill/Sports</option>
                                    </select>
                                </div>

                                <div class="col-12 col-md-3 mb-3">
                                    <label for="technique">Technique</label><br>
                                    <select class="form-control selctopt" id="technique0" name="technique" onchange="getactivity(0,this.value)" required>
                                        <option value="">Technique</option>
                                    </select>
                                </div>


                                <div class="col-12 col-md-3 mb-3">
                                    <label for="activity">Activity</label><br>
                                    <div class="activity-info">
                                        <select class="form-control mx-0 w-100" name="activity" id="activity_id" required>
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
                <input type="file" hidden accept="image/*,video/*" id="fileID" multiple style="display:none;">
                <button type="button" class="btn btn-primary" id="selectFilesBtn">Select Files</button>
                <p class="info mt-3 d-flex align-items-center gap-2">
                    <span class="d-flex align-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                            <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
                        </svg>
                    </span>
                    <span>
                        Selected files: <span id="selectedFileCount">0</span>/5 (max 1MB for image and 20MB for videos each)
                    </span>
                </p>
            </div>
        </div>
        <div id="filePreviewContainer" style="display:block; margin:auto; text-align:center;">
            <h6>Preview:</h6>
            <div id="filePreviewRow" style="display:flex; gap:10px; justify-content:center; flex-wrap:wrap;"></div>
        </div>
        <div class="media-files" style="display:none;">
            <h4><span>0</span> files uploaded successfully</h4>  
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
        <button type="button" class="btn btn-primary" id="saveBtn">Save</button>
      </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    let currentMediaGroup = [];
    let currentGroupIndex = 0;

    function openCardMedia(card) {
        const groupEls = card.querySelectorAll('.group-media [data-type]');
        if (!groupEls.length) {
            return;
        }

        currentMediaGroup = Array.from(groupEls).map(el => ({
            type: el.dataset.type,
            src: el.dataset.src,
            date: el.dataset.date || 'N/A'
        }));

        currentGroupIndex = 0;
        showCurrentMedia();
        $('#mediaModal').modal('show');
    }

    function showCurrentMedia() {
        const item = currentMediaGroup[currentGroupIndex];
        const modalImg = document.getElementById('modalImage');
        const modalVideo = document.getElementById('modalVideo');
        const counter = document.getElementById('mediaCounter');

        modalImg.classList.add('d-none');
        modalVideo.classList.add('d-none');

        if (modalVideo.src) {
            modalVideo.pause();
            modalVideo.removeAttribute('src');
            modalVideo.load();
        }

        if (!item) {
            counter.textContent = '0/0';
            return;
        }

        counter.textContent = `${currentGroupIndex + 1}/${currentMediaGroup.length} | ${item.date}`;

        if (item.type === 'image') {
            modalImg.src = item.src;
            modalImg.classList.remove('d-none');
        } else if (item.type === 'video') {
            modalVideo.src = item.src;
            modalVideo.classList.remove('d-none');
            modalVideo.load();
            modalVideo.play().catch(() => {});
        }
    }

    function nextMedia() {
        if (!currentMediaGroup.length) return;
        currentGroupIndex = (currentGroupIndex + 1) % currentMediaGroup.length;
        showCurrentMedia();
    }

    function prevMedia() {
        if (!currentMediaGroup.length) return;
        currentGroupIndex = (currentGroupIndex - 1 + currentMediaGroup.length) % currentMediaGroup.length;
        showCurrentMedia();
    }

    document.addEventListener('keydown', function(e) {
        if ($('#mediaModal').hasClass('show')) {
            if (e.key === 'ArrowRight') nextMedia();
            if (e.key === 'ArrowLeft') prevMedia();
            if (e.key === 'Escape') $('#mediaModal').modal('hide');
        }
    });

    $('#mediaModal').on('hidden.bs.modal', function () {
        const video = document.getElementById('modalVideo');
        video.pause();
        video.removeAttribute('src');
        video.load();
    });
</script>

<script>
    // Upload functionality
    document.getElementById('selectFilesBtn').addEventListener('click', function() {
        document.getElementById('fileID').click();
    });

    document.getElementById('fileID').addEventListener('change', function(e) {
        const files = e.target.files;
        const fileCount = files.length;
        const countDisplay = document.getElementById('selectedFileCount');
        
        // Validate files
        const MAX_IMAGE_SIZE = 1 * 1024 * 1024; // 1MB
        const MAX_VIDEO_SIZE = 20 * 1024 * 1024; // 20MB
        const ALLOWED_TYPES = ['image/jpeg', 'image/png', 'image/gif', 'image/webp', 'video/mp4', 'video/mpeg', 'video/quicktime', 'video/x-msvideo', 'video/webm'];
        let validFiles = [];
        let invalidFiles = [];

        Array.from(files).forEach((file) => {
            const isValidType = ALLOWED_TYPES.includes(file.type);
            const isImage = file.type.startsWith('image/');
            const isVideo = file.type.startsWith('video/');
            const maxSize = isImage ? MAX_IMAGE_SIZE : isVideo ? MAX_VIDEO_SIZE : MAX_IMAGE_SIZE;
            const isValidSize = file.size <= maxSize;

            if (isValidType && isValidSize) {
                validFiles.push(file);
            } else {
                invalidFiles.push(file);
            }
        });

        console.log("validFiles", validFiles);
        console.log("invalidFiles", invalidFiles);

        // Show warning for invalid files
        if (invalidFiles.length > 0) {
            let errorMsg = '';
            invalidFiles.forEach((file) => {
                const isImage = file.type.startsWith('image/');
                const isVideo = file.type.startsWith('video/');
                const maxSize = isImage ? MAX_IMAGE_SIZE : isVideo ? MAX_VIDEO_SIZE : MAX_IMAGE_SIZE;
                const maxSizeMB = maxSize / (1024 * 1024);
                
                if (file.size > maxSize) {
                    const sizeMB = (file.size / (1024 * 1024)).toFixed(2);
                    errorMsg += `File Too Large </br>Maximum allowed file size is ${maxSizeMB}MB<br>`;
                } else {
                    errorMsg += `Invalid file type.</br> Allowed: JPG, PNG, GIF, WebP (images) or MP4, MPEG, MOV, AVI, WebM (videos)<br>`;
                }
            });

            Swal.fire({
                icon: 'warning',
                title: 'Error',
                html: errorMsg,
                allowClickOutside: false,
                showConfirmButton: true
            });
        }

        // Update display count
        if (countDisplay) {
            countDisplay.textContent = validFiles.length;
        }

        // Generate previews for valid files only
        const previewContainer = document.getElementById('filePreviewContainer');
        const previewRow = document.getElementById('filePreviewRow');
        
        if (validFiles.length === 0) {
            previewContainer.style.display = 'none';
            previewRow.innerHTML = '';
        }else if (validFiles.length > 5) {
            countDisplay.textContent = '0',
            previewContainer.style.display = 'none';
            previewRow.innerHTML = '';
            Swal.fire({
                icon: 'info',
                title: 'Maximum 5 files allowed',
                text: 'You can upload up to 5 images or videos. Please remove extra files and try again.',
                allowOutsideClick: false,
                showConfirmButton: true
            });
        } else {
            previewContainer.style.display = 'block';
            previewRow.innerHTML = '';
            
            Array.from(validFiles).forEach((file, index) => {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    const previewItem = document.createElement('div');
                    previewItem.style.cssText = 'position:relative; width:80px; height:80px; border-radius:6px; overflow:hidden; background:#f0f0f0;';
                    
                    if (file.type.startsWith('image/')) {
                        previewItem.innerHTML = `<img src="${e.target.result}" style="width:100%; height:100%; object-fit:cover;">`;
                    } else if (file.type.startsWith('video/')) {
                        previewItem.innerHTML = `
                            <video style="width:100%; height:100%; object-fit:cover; background:#000;">
                                <source src="${e.target.result}">
                            </video>
                            <div style="position:absolute; top:50%; left:50%; transform:translate(-50%,-50%); color:white; font-size:24px;">▶</div>
                        `;
                    } else {
                        previewItem.innerHTML = `<div style="display:flex; align-items:center; justify-content:center; width:100%; height:100%; font-size:12px; text-align:center; padding:5px;">${file.name.substring(0, 10)}</div>`;
                    }
                    
                    previewRow.appendChild(previewItem);
                };
                
                reader.readAsDataURL(file);
            });
        }
    });

    document.getElementById('saveBtn').addEventListener('click', function() {
        const files = document.getElementById('fileID').files;
        if (files.length === 0) {
            Swal.fire({
                icon: 'warning',
                title: 'No Files Selected',
                text: 'Please select at least one file to upload',
                allowClickOutside: false,
                showConfirmButton: true
            });
            return;
        }

        // Validate files before upload
        const MAX_IMAGE_SIZE = 1 * 1024 * 1024; // 1MB
        const MAX_VIDEO_SIZE = 20 * 1024 * 1024; // 20MB
        const ALLOWED_TYPES = ['image/jpeg', 'image/png', 'image/gif', 'image/webp', 'video/mp4', 'video/mpeg', 'video/quicktime', 'video/x-msvideo', 'video/webm'];
        let fileErrors = [];

        Array.from(files).forEach((file, index) => {
            // Check file type
            if (!ALLOWED_TYPES.includes(file.type)) {
                fileErrors.push(`❌ "${file.name}" - Invalid file type. Allowed: JPG, PNG, GIF, WebP (images) or MP4, MPEG, MOV, AVI, WebM (videos).`);
            }

            // Check file size
            const isImage = file.type.startsWith('image/');
            const isVideo = file.type.startsWith('video/');
            const maxSize = isImage ? MAX_IMAGE_SIZE : isVideo ? MAX_VIDEO_SIZE : MAX_IMAGE_SIZE;
            const maxSizeMB = maxSize / (1024 * 1024);
            
            if (file.size > maxSize) {
                const sizeMB = (file.size / (1024 * 1024)).toFixed(2);
                fileErrors.push(`❌ "${file.name}" - File size (${sizeMB}MB) exceeds maximum of ${maxSizeMB}MB.`);
            }
        });

        if (fileErrors.length > 0) {
            Swal.fire({
                icon: 'error',
                title: 'Invalid Files',
                html: '<div style="text-align: left; max-height: 300px; overflow-y: auto;">' + 
                      fileErrors.map(err => '<p style="margin:5px 0;">' + err + '</p>').join('') +
                      '</div>',
                allowClickOutside: false,
                showConfirmButton: true
            });
            return;
        }

        uploadFiles(files);
    });

    function uploadFiles(files) {
        try {
            const schoolIdEl = document.getElementById('school_id');
            const activityIdEl = document.getElementById('activity_id');
            const dateEl = document.getElementById('date');
            const sclassEl = document.getElementById('sclass0');

            // Validate all elements exist
            if (!schoolIdEl || !dateEl || !sclassEl || !activityIdEl) {
                Swal.fire({
                    icon: 'error',
                    title: 'Form Error',
                    text: 'Some form elements are missing. Please refresh the page.',
                    allowClickOutside: false,
                    showConfirmButton: true
                });
                return;
            }

            // Get values
            const schoolId = schoolIdEl.value;
            const date = dateEl.value;
            const sclass = sclassEl.value;
            const activityId = activityIdEl.value;

            // Validate required fields
            let errors = [];
            
            if (!date || date.trim() === '') {
                errors.push('Date is required');
            }
            
            if (!sclass || sclass.trim() === '') {
                errors.push('Class is required');
            }
            
            if (!activityId || activityId.trim() === '') {
                errors.push('Activity is required');
            }

            // Show errors if any
            if (errors.length > 0) {
                const errorList = errors.map(err => '• ' + err).join('<br>');
                Swal.fire({
                    icon: 'error',
                    title: 'Missing Required Fields',
                    html: errorList,
                    allowClickOutside: false,
                    showConfirmButton: true
                });
                return;
            }

            // All validations passed, proceed with upload
            const formData = new FormData();
            formData.append('school_id', schoolId);
            formData.append('activity_id', activityId);
            formData.append('date', date);
            formData.append('sclass', sclass);

            for (let i = 0; i < files.length; i++) {
                formData.append('files[]', files[i]);
            }

            // Clear previous uploads
            const mediaFilesSection = document.querySelector('.media-files');
            if (mediaFilesSection) {
                mediaFilesSection.style.display = 'block';
                mediaFilesSection.innerHTML = '<h4><span>0</span> files uploaded successfully</h4>';
            }

        // Show progress for each file
        const mediaFilesDiv = document.querySelector('.media-files');
        if (!mediaFilesDiv) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Upload area not found',
                allowClickOutside: false,
                showConfirmButton: true
            });
            return;
        }

        for (let i = 0; i < files.length; i++) {
            const fileItem = document.createElement('div');
            fileItem.className = 'upload-list pr-3';
            fileItem.innerHTML = `
                <div class="thumb">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-file-play" viewBox="0 0 16 16">
                        <path d="M6 10.117V5.883a.5.5 0 0 1 .757-.429l3.528 2.117a.5.5 0 0 1 0 .858l-3.528 2.117a.5.5 0 0 1-.757-.43z"/>
                        <path d="M4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm0 1h8a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1"/>
                    </svg>
                </div>
                <div class="d-flex flex-column w-100 py-3">
                    <div class="d-flex justify-content-between mb-2">
                        <div class="mb-0 d-flex justify-content-between" style="gap: 15px;">
                            <span>${files[i].name}</span>
                            <span class="d-flex align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dot" viewBox="0 0 16 16">
                                    <path d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3"/>
                                </svg>Uploading...
                            </span>
                        </div>
                        <div id="progress-${i}">0%</div>
                    </div>
                    <div class="progress">
                        <div class="progress-bar" id="progress-bar-${i}" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            `;
            mediaFilesDiv.appendChild(fileItem);
        }

        // Upload via AJAX
        const xhr = new XMLHttpRequest();
        xhr.open('POST', '<?php echo e(route("upload.media")); ?>');
        xhr.setRequestHeader('X-CSRF-TOKEN', '<?php echo e(csrf_token()); ?>');

        xhr.upload.addEventListener('progress', function(e) {
            if (e.lengthComputable) {
                const percentComplete = (e.loaded / e.total) * 100;
                for (let j = 0; j < files.length; j++) {
                    const bar = document.getElementById('progress-bar-' + j);
                    const text = document.getElementById('progress-' + j);
                    if (bar) bar.style.width = percentComplete + '%';
                    if (text) text.textContent = Math.round(percentComplete) + '%';
                }
            }
        });

        xhr.onload = function() {
            try {
                if (xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        // Update UI for success
                        const headSpan = document.querySelector('.media-files h4 span');
                        if (headSpan) {
                            headSpan.textContent = response.files.length;
                        }
                        const uploadLists = document.querySelectorAll('.upload-list');
                        for (let i = 0; i < response.files.length && i < uploadLists.length; i++) {
                            const item = uploadLists[i];
                            if (item) {
                                const progressEl = item.querySelector('.progress');
                                if (progressEl) progressEl.style.display = 'none';
                                
                                const statusSpan = item.querySelector('.d-flex.justify-content-between.mb-2 .d-flex.align-items-center');
                                if (statusSpan) {
                                    statusSpan.innerHTML = `
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dot" viewBox="0 0 16 16">
                                            <path d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3"/>
                                        </svg>Uploaded
                                    `;
                                }
                                const progressDiv = item.querySelector('.d-flex.justify-content-between.mb-2 > div:last-child');
                                if (progressDiv) progressDiv.remove();
                                item.innerHTML += `
                                    <p class="file-size">${(response.files[i].file_size / 1024 / 1024).toFixed(2)} MB</p>
                                    <div class="cheked-i uploaded">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 1-.708.708l3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 0 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5"/>
                                        </svg>
                                    </div>
                                `;
                            }
                        }
                        Swal.fire({
                            icon: 'success',
                            title: 'Upload Successful!',
                            text: `${response.files.length} file(s) uploaded successfully.`,
                            allowClickOutside: false,
                            showConfirmButton: true
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Upload Failed',
                            text: response.error || 'Unknown error occurred',
                            allowClickOutside: false,
                            showConfirmButton: true
                        });
                    }
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Upload Failed',
                        text: 'Server error occurred',
                        allowClickOutside: false,
                        showConfirmButton: true
                    });
                }
            } catch (error) {
                console.error('Upload error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'An error occurred during upload',
                });
            }
        };

        xhr.onerror = function() {
            Swal.fire({
                icon: 'error',
                title: 'Upload Failed',
                text: 'Network error occurred',
            });
        };

        xhr.send(formData);
        } catch (error) {
            console.error('Upload error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error: ' + error.message,
                allowClickOutside: false,
                showConfirmButton: true
            });
        }
    }
</script>
<?php $__env->stopPush(); ?> 
<?php echo $__env->make('layouts.filldart-app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\nep\resources\views/activity/media/gallary.blade.php ENDPATH**/ ?>