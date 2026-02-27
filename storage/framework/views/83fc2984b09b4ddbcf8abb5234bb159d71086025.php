
<?php $__env->startSection('title', 'Goforfit | ' . $title); ?>
<?php $__env->startSection('content'); ?>
    
<link href="https://nep.goforfit.in/resources/css/demo.css" rel="Stylesheet" />
<link href="https://nep.goforfit.in/resources/css/jquery-tilesgallery.css" rel="Stylesheet" />
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="Stylesheet" />

<!-- <link href="https://cdn.jsdelivr.net/npm/lightgallery@2.0.0-beta.3/css/lightgallery.css" rel="stylesheet"/>
<link href="https://cdn.jsdelivr.net/npm/lightgallery@2.0.0-beta.3/css/lg-zoom.css" rel="stylesheet"/> -->


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
                                        <div class="media-row gallery" style="display:none;">
                                                <div class="list">
                                                    <div class="card p-0">
                                                        <div class="cover-photo">
                                                            <img data-gallery-tag="women" class="gallery-item" src="<?php echo e(asset('/public/assets/media/photo-001.jpg')); ?>" />
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
                                                            <img data-gallery-tag="women" class="gallery-item" src="<?php echo e(asset('/public/assets/media/photo-002.jpg')); ?>" />
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
                                                            <img data-gallery-tag="women" class="gallery-item" src="<?php echo e(asset('/public/assets/media/photo-003.jpg')); ?>" />
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
                                                            <img data-gallery-tag="women" class="gallery-item" src="<?php echo e(asset('/public/assets/media/photo-004.jpg')); ?>" />
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
                                                            <img data-gallery-tag="women" class="gallery-item" src="<?php echo e(asset('/public/assets/media/photo-005.jpg')); ?>" />
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
                                                            <img data-gallery-tag="women" class="gallery-item" src="<?php echo e(asset('/public/assets/media/photo-006.jpg')); ?>" />
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
                                                            <img data-gallery-tag="women" class="gallery-item" src="<?php echo e(asset('/public/assets/media/photo-007.jpg')); ?>" />
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
                                                            <img data-gallery-tag="women" class="gallery-item" src="<?php echo e(asset('/public/assets/media/photo-008.jpg')); ?>" />
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
                                                            <img data-gallery-tag="women" class="gallery-item" src="<?php echo e(asset('/public/assets/media/photo-009.jpg')); ?>" />
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
                                                            <img data-gallery-tag="women" class="gallery-item" src="<?php echo e(asset('/public/assets/media/photo-010.jpg')); ?>" />
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
                                                            <img data-gallery-tag="women" class="gallery-item" src="<?php echo e(asset('/public/assets/media/photo-011.jpg')); ?>" />
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
                                                            <img data-gallery-tag="women" class="gallery-item" src="<?php echo e(asset('/public/assets/media/photo-012.jpg')); ?>" />
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

                                        <!-- <ul class="media-row">
                                            <li class="list">
                                                
                                                    
                                                        <a href="#" class="thumbnail" data-toggle="modal" data-target="#lightbox">
                                                            <img src="<?php echo e(asset('/public/assets/media/photo-001.jpg')); ?>" class="img-fluid">
                                                        </a>
                                                    
                                                    <div class="card-body text-left">
                                                        <h5 class="card-title">Activity Title</h5>
                                                        <div class="card-text d-flex justify-content-between">
                                                            <span>Date: 24 Aug 2025</span>
                                                            <span>Class: VI</span>
                                                        </div>
                                                    </div>
                                                
                                            </li>
                                            <li class="list">
                                               
                                                        <a href="#" class="thumbnail" data-toggle="modal" data-target="#lightbox">
                                                            <img src="<?php echo e(asset('/public/assets/media/photo-002.jpg')); ?>" class="img-fluid">
                                                        </a>
                                                    
                                                    <div class="card-body text-left">
                                                        <h5 class="card-title">Activity Title</h5>
                                                        <div class="card-text d-flex justify-content-between">
                                                            <span>Date: 24 Aug 2025</span>
                                                            <span>Class: VI</span>
                                                        </div>
                                                    </div>
                                                
                                            </li>
                                            <li class="list">
                                                <div class="card p-0">
                                                    <div class="cover-photo">
                                                        <img src="<?php echo e(asset('/public/assets/media/photo-003.jpg')); ?>" class="img-fluid">
                                                    </div>
                                                    <div class="card-body text-left">
                                                        <h5 class="card-title">Activity Title</h5>
                                                        <div class="card-text d-flex justify-content-between">
                                                            <span>Date: 24 Aug 2025</span>
                                                            <span>Class: VI</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list">
                                                <div class="card p-0">
                                                    <div class="cover-photo">
                                                        <img src="<?php echo e(asset('/public/assets/media/photo-004.jpg')); ?>" class="img-fluid">
                                                    </div>
                                                    <div class="card-body text-left">
                                                        <h5 class="card-title">Activity Title</h5>
                                                        <div class="card-text d-flex justify-content-between">
                                                            <span>Date: 24 Aug 2025</span>
                                                            <span>Class: VI</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list">
                                                <div class="card p-0">
                                                    <div class="cover-photo">
                                                        <img src="<?php echo e(asset('/public/assets/media/photo-005.jpg')); ?>" class="img-fluid">
                                                    </div>
                                                    <div class="card-body text-left">
                                                        <h5 class="card-title">Activity Title</h5>
                                                        <div class="card-text d-flex justify-content-between">
                                                            <span>Date: 24 Aug 2025</span>
                                                            <span>Class: VI</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list">
                                                <div class="card p-0">
                                                    <div class="cover-photo">
                                                        <img src="<?php echo e(asset('/public/assets/media/photo-006.jpg')); ?>" class="img-fluid">
                                                    </div>
                                                    <div class="card-body text-left">
                                                        <h5 class="card-title">Activity Title</h5>
                                                        <div class="card-text d-flex justify-content-between">
                                                            <span>Date: 24 Aug 2025</span>
                                                            <span>Class: VI</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list">
                                                <div class="card p-0">
                                                    <div class="cover-photo">
                                                        <img src="<?php echo e(asset('/public/assets/media/photo-007.jpg')); ?>" class="img-fluid">
                                                    </div>
                                                    <div class="card-body text-left">
                                                        <h5 class="card-title">Activity Title</h5>
                                                        <div class="card-text d-flex justify-content-between">
                                                            <span>Date: 24 Aug 2025</span>
                                                            <span>Class: VI</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list">
                                                <div class="card p-0">
                                                    <div class="cover-photo">
                                                        <img src="<?php echo e(asset('/public/assets/media/photo-008.jpg')); ?>" class="img-fluid">
                                                    </div>
                                                    <div class="card-body text-left">
                                                        <h5 class="card-title">Activity Title</h5>
                                                        <div class="card-text d-flex justify-content-between">
                                                            <span>Date: 24 Aug 2025</span>
                                                            <span>Class: VI</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list">
                                                <div class="card p-0">
                                                    <div class="cover-photo">
                                                        <img src="<?php echo e(asset('/public/assets/media/photo-009.jpg')); ?>" class="img-fluid">
                                                    </div>
                                                    <div class="card-body text-left">
                                                        <h5 class="card-title">Activity Title</h5>
                                                        <div class="card-text d-flex justify-content-between">
                                                            <span>Date: 24 Aug 2025</span>
                                                            <span>Class: VI</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>

                                        </ul> -->
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-videos" role="tabpanel" aria-labelledby="pills-videos-tab">
                                <div class="media-grid">
                                    <div class="gallery-container">
                                        <ul class="media-row">
                                            <li class="list">
                                                <video controls>
                                                    <source src="<?php echo e(asset('/public/assets/media/dummy-video.mp4')); ?>" type="video/mp4">
                                                    <source src="<?php echo e(asset('/public/assets/media/dummy-video.mp4')); ?>" type="video/ogg">
                                                </video>
                                            </li>
                                            <li class="list">
                                                <video controls>
                                                    <source src="<?php echo e(asset('/public/assets/media/dummy-video.mp4')); ?>" type="video/mp4">
                                                    <source src="<?php echo e(asset('/public/assets/media/dummy-video.mp4')); ?>" type="video/ogg">
                                                </video>
                                            </li>
                                            <li class="list">
                                                <video controls>
                                                    <source src="<?php echo e(asset('/public/assets/media/dummy-video.mp4')); ?>" type="video/mp4">
                                                    <source src="<?php echo e(asset('/public/assets/media/dummy-video.mp4')); ?>" type="video/ogg">
                                                </video>
                                            </li>
                                            <li class="list">
                                                <video controls>
                                                    <source src="<?php echo e(asset('/public/assets/media/dummy-video.mp4')); ?>" type="video/mp4">
                                                    <source src="<?php echo e(asset('/public/assets/media/dummy-video.mp4')); ?>" type="video/ogg">
                                                </video>
                                            </li>
                                            <li class="list">
                                                <video controls>
                                                    <source src="<?php echo e(asset('/public/assets/media/dummy-video.mp4')); ?>" type="video/mp4">
                                                    <source src="<?php echo e(asset('/public/assets/media/dummy-video.mp4')); ?>" type="video/ogg">
                                                </video>
                                            </li>
                                            <li class="list">
                                                <video controls>
                                                    <source src="<?php echo e(asset('/public/assets/media/dummy-video.mp4')); ?>" type="video/mp4">
                                                    <source src="<?php echo e(asset('/public/assets/media/dummy-video.mp4')); ?>" type="video/ogg">
                                                </video>
                                            </li>
                                            <li class="list">
                                                <video controls>
                                                    <source src="<?php echo e(asset('/public/assets/media/dummy-video.mp4')); ?>" type="video/mp4">
                                                    <source src="<?php echo e(asset('/public/assets/media/dummy-video.mp4')); ?>" type="video/ogg">
                                                </video>
                                            </li>
                                            <li class="list">
                                                <video controls>
                                                    <source src="<?php echo e(asset('/public/assets/media/dummy-video.mp4')); ?>" type="video/mp4">
                                                    <source src="<?php echo e(asset('/public/assets/media/dummy-video.mp4')); ?>" type="video/ogg">
                                                </video>
                                            </li>
                                            <li class="list">
                                                <video controls>
                                                    <source src="<?php echo e(asset('/public/assets/media/dummy-video.mp4')); ?>" type="video/mp4">
                                                    <source src="<?php echo e(asset('/public/assets/media/dummy-video.mp4')); ?>" type="video/ogg">
                                                </video>
                                            </li>

                                        </ul>
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
        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> -->
      </div>

      <div class="modal-body p-4">
        <div class="uploadfiels drop_box">
            <!-- <h5 class="card-title mb-3">Upload files</h4>   -->
             <div class="from-group mb-4">
                <form class="form-row">
                    <div class="col-2">
                        <div class="form-group">
                            <label for="fordate">Activity Date</label>
                            <input type="text" class="form-control" id="dateInput" placeholder="00/00/0000">
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Class</label>
                            <select class="form-control" id="exampleFormControlSelect1">
                                <option>Select</option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Period</label>
                            <select class="form-control" id="exampleFormControlSelect1">
                                <option>Select</option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Activity</label>
                            <select class="form-control" id="exampleFormControlSelect1">
                                <option>Select</option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
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


<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous" ></script>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous" ></script>
    <script
      src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous" ></script>

    <script>
        (function($) {
            $.fn.mauGallery = function(options) {
                var options = $.extend($.fn.mauGallery.defaults, options);
                var tagsCollection = [];
                return this.each(function() {
                $.fn.mauGallery.methods.createRowWrapper($(this));
                if (options.lightBox) {
                    $.fn.mauGallery.methods.createLightBox(
                    $(this),
                    options.lightboxId,
                    options.navigation
                    );
                }
                $.fn.mauGallery.listeners(options);

                $(this)
                    .children(".gallery-item")
                    .each(function(index) {
                    $.fn.mauGallery.methods.responsiveImageItem($(this));
                    $.fn.mauGallery.methods.moveItemInRowWrapper($(this));
                    $.fn.mauGallery.methods.wrapItemInColumn($(this), options.columns);
                    var theTag = $(this).data("gallery-tag");
                    if (
                        options.showTags &&
                        theTag !== undefined &&
                        tagsCollection.indexOf(theTag) === -1
                    ) {
                        tagsCollection.push(theTag);
                    }
                    });

                if (options.showTags) {
                    $.fn.mauGallery.methods.showItemTags(
                    $(this),
                    options.tagsPosition,
                    tagsCollection
                    );
                }

                $(this).fadeIn(500);
                });
            };
            $.fn.mauGallery.defaults = {
                columns: 3,
                lightBox: true,
                lightboxId: null,
                showTags: true,
                tagsPosition: "bottom",
                navigation: true
            };
            $.fn.mauGallery.listeners = function(options) {
                $(".gallery-item").on("click", function() {
                if (options.lightBox && $(this).prop("tagName") === "IMG") {
                    $.fn.mauGallery.methods.openLightBox($(this), options.lightboxId);
                } else {
                    return;
                }
                });

                $(".gallery").on("click", ".nav-link", $.fn.mauGallery.methods.filterByTag);
                $(".gallery").on("click", ".mg-prev", () =>
                $.fn.mauGallery.methods.prevImage(options.lightboxId)
                );
                $(".gallery").on("click", ".mg-next", () =>
                $.fn.mauGallery.methods.nextImage(options.lightboxId)
                );
            };
            $.fn.mauGallery.methods = {
                createRowWrapper(element) {
                if (
                    !element
                    .children()
                    .first()
                    .hasClass("row")
                ) {
                    element.append('<div class="gallery-items-row row"></div>');
                }
                },
                wrapItemInColumn(element, columns) {
                if (columns.constructor === Number) {
                    element.wrap(
                    `<div class='item-column mb-4 col-${Math.ceil(12 / columns)}'></div>`
                    );
                } else if (columns.constructor === Object) {
                    var columnClasses = "";
                    if (columns.xs) {
                    columnClasses += ` col-${Math.ceil(12 / columns.xs)}`;
                    }
                    if (columns.sm) {
                    columnClasses += ` col-sm-${Math.ceil(12 / columns.sm)}`;
                    }
                    if (columns.md) {
                    columnClasses += ` col-md-${Math.ceil(12 / columns.md)}`;
                    }
                    if (columns.lg) {
                    columnClasses += ` col-lg-${Math.ceil(12 / columns.lg)}`;
                    }
                    if (columns.xl) {
                    columnClasses += ` col-xl-${Math.ceil(12 / columns.xl)}`;
                    }
                    element.wrap(`<div class='item-column mb-4${columnClasses}'></div>`);
                } else {
                    console.error(
                    `Columns should be defined as numbers or objects. ${typeof columns} is not supported.`
                    );
                }
                },
                moveItemInRowWrapper(element) {
                element.appendTo(".gallery-items-row");
                },
                responsiveImageItem(element) {
                if (element.prop("tagName") === "IMG") {
                    element.addClass("img-fluid");
                }
                },
                openLightBox(element, lightboxId) {
                $(`#${lightboxId}`)
                    .find(".lightboxImage")
                    .attr("src", element.attr("src"));
                $(`#${lightboxId}`).modal("toggle");
                },
                prevImage() {
                let activeImage = null;
                $("img.gallery-item").each(function() {
                    if ($(this).attr("src") === $(".lightboxImage").attr("src")) {
                    activeImage = $(this);
                    }
                });
                let activeTag = $(".tags-bar a.active-tag").data("images-toggle");
                let imagesCollection = [];
                if (activeTag === "all") {
                    $(".item-column").each(function() {
                    if ($(this).children("img").length) {
                        imagesCollection.push($(this).children("img"));
                    }
                    });
                } else {
                    $(".item-column").each(function() {
                    if (
                        $(this)
                        .children("img")
                        .data("gallery-tag") === activeTag
                    ) {
                        imagesCollection.push($(this).children("img"));
                    }
                    });
                }
                let index = 0,
                    next = null;

                $(imagesCollection).each(function(i) {
                    if ($(activeImage).attr("src") === $(this).attr("src")) {
                    index = i - 1;
                    }
                });
                next =
                    imagesCollection[index] ||
                    imagesCollection[imagesCollection.length - 1];
                $(".lightboxImage").attr("src", $(next).attr("src"));
                },
                nextImage() {
                let activeImage = null;
                $("img.gallery-item").each(function() {
                    if ($(this).attr("src") === $(".lightboxImage").attr("src")) {
                    activeImage = $(this);
                    }
                });
                let activeTag = $(".tags-bar a.active-tag").data("images-toggle");
                let imagesCollection = [];
                if (activeTag === "all") {
                    $(".item-column").each(function() {
                    if ($(this).children("img").length) {
                        imagesCollection.push($(this).children("img"));
                    }
                    });
                } else {
                    $(".item-column").each(function() {
                    if (
                        $(this)
                        .children("img")
                        .data("gallery-tag") === activeTag
                    ) {
                        imagesCollection.push($(this).children("img"));
                    }
                    });
                }
                let index = 0,
                    next = null;

                $(imagesCollection).each(function(i) {
                    if ($(activeImage).attr("src") === $(this).attr("src")) {
                    index = i + 1;
                    }
                });
                next = imagesCollection[index] || imagesCollection[0];
                $(".lightboxImage").attr("src", $(next).attr("src"));
                },
                createLightBox(gallery, lightboxId, navigation) {
                gallery.append(`
                    <div class="modal fade" id="${lightboxId ? lightboxId : "galleryLightbox"}" 
                        tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                        <div class="modal-content lightbox-content">
                        <div class="modal-body position-relative text-center">

                            ${navigation 
                            ? '<div class="mg-prev">&#10094;</div>' 
                            : ''}

                            <img class="lightboxImage img-fluid rounded" />

                            ${navigation 
                            ? '<div class="mg-next">&#10095;</div>' 
                            : ''}

                        </div>
                        </div>
                    </div>
                    </div>
                    `);
                },
                showItemTags(gallery, position, tags) {
                var tagItems =
                    '<li class="nav-item"><a class="nav-link active active-tag" href="#" data-images-toggle="all">all</a></li>';
                $.each(tags, function(index, value) {
                    tagItems += `<li class="nav-item active">
                            <a class="nav-link" href="#" data-images-toggle="${value}">${value}</a></li>`;
                });
                var tagsRow = `<ul class="my-4 tags-bar nav nav-pills">${tagItems}</ul>`;

                if (position === "bottom") {
                    gallery.append(tagsRow);
                } else if (position === "top") {
                    gallery.prepend(tagsRow);
                } else {
                    console.error(`Unknown tags position: ${position}`);
                }
                },
                filterByTag() {
                if ($(this).hasClass("active-tag")) {
                    return;
                }
                $(".active.active-tag").removeClass("active active-tag");
                $(this).addClass("active-tag active");

                var tag = $(this).data("images-toggle");

                $(".gallery-item").each(function() {
                    $(this)
                    .parents(".item-column")
                    .hide();
                    if (tag === "all") {
                    $(this)
                        .parents(".item-column")
                        .show(300);
                    } else if ($(this).data("gallery-tag") === tag) {
                    $(this)
                        .parents(".item-column")
                        .show(300);
                    }
                });
                }
            };
            })(jQuery);

    </script>
    <script>
        $(document).ready(function() {
            $('.gallery').mauGallery({
                columns: {
                    xs: 1,
                    sm: 2,
                    md: 3,
                    lg: 4,
                    xl: 6
                },
                lightBox: true,
                lightboxId: 'myAwesomeLightbox',
                showTags: true,
                tagsPosition: 'top'
            });
        });
    </script>


<?php $__env->stopPush(); ?> 




<?php echo $__env->make('layouts.filldart-app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\nep\resources\views/activity/media/gallary.blade.php ENDPATH**/ ?>