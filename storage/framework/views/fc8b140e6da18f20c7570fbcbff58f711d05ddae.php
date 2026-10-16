
<?php $__env->startSection('title', 'Goforfit | ' . $title); ?>
<?php $__env->startSection('content'); ?>

<style>
    .get_ready {  position: relative;  display: flex;  align-items: center;   background-color: #fff; justify-content: space-between;
         cursor: pointer;  }
    .all-tests .list-group li .play {  position: relative !important; }
    .pdfandvideo {    display: flex;   align-items: center;  }
    .pdfandvideo > .videoplayer {  width: 50px; }
    .pdfandvideo > .pdfreader {  width: 90px !important; }
    .tooltip { z-index: 1080 !important; pointer-events: none; }
    .custom-tooltip-trigger { padding: 4px; touch-action: manipulation; }
    .tooltip-inner {
        max-width: 300px !important;       /* Set maximum width of the box */
        width: max-content;                /* Auto-adjust width to fit content up to max-width */
        background-color: #2a2876 !important; /* Set custom background color */
        color: #ffffff !important;         /* Set text/font color */
        font-size: 13px !important;        /* Set font size */
        font-family: 'Segoe UI', Tahoma, sans-serif !important; /* Custom font family */
        text-align: left !important;       /* Align text left, right, or center */
        padding: 10px 14px !important;     /* Adjust padding inside the box */
        border-radius: 6px !important;     /* Rounded corners */
        box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.15); /* Drop shadow */
    }
    .cwsn-video-btn { 
        border: 0; background: transparent;  padding: 0; margin: 0; cursor: pointer; color: inherit;  font-size: inherit;  line-height: 1; 
    }
    .cwsn-video-btn:focus {  outline: none;  }
    .cwsn-video-btn:focus-visible {  outline: 2px solid #2a2876;  outline-offset: 3px; }
    .cwsn-video-btn i {cursor: pointer;}
    .cwsn-video-player {  width: 100%;  max-height: 70vh;  display: block;  background: #000; }
    .cwsn-youtube-wrapper { position: relative;width: 100%;   aspect-ratio: 16 / 9;  background: #000; overflow: hidden; }
    .cwsn-youtube-wrapper iframe {width: 100%;  height: 100%;  border: 0;  display: block;  }
    .cwsn-video-error {   margin: 0;  }

    @media (max-width: 768px) { 
        .all-tests .list-group li a {  padding: 12px !important;    }
        .pdfandvideo > .videoplayer { width: 40px;  }
        .pdfandvideo > .pdfreader { width: 80px !important; }
    }

</style>

<div class="container">
    <div class="t-mrg2 mb-5 pb-5">
        <div class="all-chaptr-cards">
           
            <div class="row">
                <div class="col">
                    <div class="heading-rw mt-0 mt-md-1 mb-0 p-0"> 
                        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.back-button','data' => ['title' => $title]]); ?>
<?php $component->withName('back-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($title)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?> 
                    </div>  
                </div>
            </div>
        
            <div class="row text-center justify-content-md-center">
                <div class="col-12">
                    <div class="row text-center justify-content-md-center mt-2 mt-lg-4">
                        <div class="col-12 col-md-12 col-lg-12">
                            <div class="all-tests">

                               <?php if(Crypt::decrypt($pwd_category_id) != '3'): ?>
                                <h3><span class="badge badge-pill badge-secondary" style="font-size:14px;">Conduct any one of the following tests</span></h3>
                                <?php endif; ?>
                                
                                <ul class="list-group tests mt-3">
                                    <?php $__currentLoopData = $testType; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li>

                                            <div class="get_ready row-clickable" data-href="<?php echo e(route('cwsn.test.types', ['TestTypeId' => $val->TestTypeID,'pwd_category_id' => $pwd_category_id])); ?>">

                                                <div style="width: max-content;">
                                                    <a href="javascript:void(0);" onclick="event.preventDefault();">
                                                       <span>
                                                            <?php echo e(trim($val->TestTypeName)); ?>

                                                            <?php if(in_array($val->TestTypeID, [1044, 1041, 1021])): ?>
                                                                <strong style="color: #d9534f; font-size: 0.9em;"> (Only for Wheel Chair)</strong>
                                                            <?php endif; ?>
                                                        </span>

                                                        <i class="bi bi-info-circle stop-propagation custom-tooltip-trigger" 
                                                           style="font-size: 14px; cursor: pointer; display: inline-block;"
                                                           data-toggle="tooltip" 
                                                           data-trigger="click hover focus"
                                                           data-boundary="window" 
                                                           data-html="true"  
                                                           title="<b>Test Applicable for :</b><br><?php echo e(is_array($val->disability_categories) ? implode(', ', $val->disability_categories) : $val->disability_categories->implode(', ')); ?>" onclick="event.stopPropagation();">       
                                                        </i>
                                                    </a>
                                                </div>

                                                <div class="pdfandvideo">
                                                    <div class="pdfreader">
                                                        <a href="<?php echo e(route('cwsn_admin_manual', ['testTypeId' => $val->TestTypeID])); ?>" 
                                                       target="_blank" 
                                                       rel="noopener noreferrer"
                                                       onclick="event.stopPropagation();"> 
                                                        <i class="bi bi-file-earmark-pdf"></i>
                                                    </a>
                                                    </div>
                                                    <hr>
                                                    <div class="videoplayer">
                                                        <button
                                                            type="button"
                                                            class="play cwsn-video-btn"
                                                            data-toggle="modal"
                                                            data-target="#playModal"
                                                            data-testtypeid="<?php echo e($val->TestTypeID); ?>"
                                                            data-testname="<?php echo e(trim($val->TestTypeName)); ?>"
                                                            aria-label="Play <?php echo e(trim($val->TestTypeName)); ?> video"
                                                        > <i class="bi bi-play-circle" aria-hidden="true"></i>

                                                        </button>                                                       
                                                    </div>                                                   
                                                </div>
                                                
                                                <span class="arrow-i"><i class="bi bi-arrow-right"></i></span>
                                            </div>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>           
        </div>
    </div>

</div>

<!-- Modal -->
<div  class="modal fade modal-video"  id="playModal"  tabindex="-1" role="dialog"  aria-labelledby="playModalLabel" aria-hidden="true">
    <div  class="modal-dialog modal-dialog-centered modal-lg" role="document" >
        <div class="modal-content">
            <div class="modal-header">
                <h5  class="modal-title"   id="playModalLabel" >  Video </h5>
                <button  type="button"  class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body"> <p class="text-muted mb-0"> Select a video to play. </p> </div>
        </div>
    </div>
</div>


<script>

$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})

$(function () {

    const storageBaseUrl = <?php echo json_encode(asset('storage'), 15, 512) ?>;
    const seniorBMI = <?php echo json_encode($SeniorBMI, 15, 512) ?>;
    const videos = <?php echo json_encode($videos, 15, 512) ?>;


    console.log('videos',videos);

    function getVideoUrl(videoUrl) {
        if (!videoUrl) {return null; }
        videoUrl = String(videoUrl).trim();
        if (!videoUrl) { return null; }
        if (videoUrl.startsWith('_1')) {
            videoUrl = videoUrl.substring(2).trim();
        }
        if (!videoUrl) { return null;}
        if (  videoUrl.startsWith('http://') || videoUrl.startsWith('https://') ||  videoUrl.startsWith('//') ) {
            return videoUrl;
        }
        if (videoUrl.startsWith('/storage/')) {
            return videoUrl;
        }
        return storageBaseUrl + '/' + videoUrl.replace(/^\/+/, '');
    }

    function isYouTubeUrl(videoUrl) {

        if (!videoUrl) { return false;  }

        try {

            const url = new URL(videoUrl);
            const hostname = url.hostname.toLowerCase();

            return (
                hostname === 'youtube.com' ||
                hostname === 'www.youtube.com' ||
                hostname === 'm.youtube.com' ||
                hostname === 'youtu.be' ||
                hostname === 'www.youtu.be' ||
                hostname === 'youtube-nocookie.com' ||
                hostname === 'www.youtube-nocookie.com'
            );

        } catch (error) {

            return false;

        }
    }

    function getYouTubeVideoId(videoUrl) {
        if (!videoUrl) { return null;  }

        try {

            const url = new URL(videoUrl);
            const hostname = url.hostname.toLowerCase();

            if (hostname === 'youtu.be' || hostname === 'www.youtu.be' ) {
                return url.pathname .replace(/^\/+/, '') .split('/')[0] || null;
            }

            if ( hostname === 'youtube.com' || hostname === 'www.youtube.com' ||  hostname === 'm.youtube.com' ||
                hostname === 'youtube-nocookie.com' ||  hostname === 'www.youtube-nocookie.com' ) {

                if (url.pathname === '/watch') {
                    return url.searchParams.get('v');
                }

                if (url.pathname.startsWith('/embed/')) {
                    return url.pathname .replace('/embed/', '').split('/')[0] || null;
                }

                if (url.pathname.startsWith('/shorts/')) {
                    return url.pathname .replace('/shorts/', '').split('/')[0] || null;
                }

                if (url.pathname.startsWith('/live/')) {
                    return url.pathname.replace('/live/', '').split('/')[0] || null;
                }
            }

            return null;

        } catch (error) {
            console.error('Invalid YouTube URL:',  videoUrl,  error );
            return null;
        }
    }

    function createVideoElement(videoUrl) {

        const video = document.createElement('video');

        video.className = 'cwsn-video-player';
        video.controls = true;
        video.playsInline = true;
        video.preload = 'metadata';
        video.autoplay = false;

        video.setAttribute('controlsList', 'nodownload' );
        video.setAttribute( 'disablePictureInPicture', '' );
        const source = document.createElement('source');
        source.src = videoUrl;
        video.appendChild(source);

        video.addEventListener('click',  function (event) {
            event.stopPropagation();
        });

        video.addEventListener('error', function () {
                console.error( 'Unable to load video:',  videoUrl  );
                const parent = video.parentNode;

                if (!parent) {
                    return;
                }

                const errorMessage =  document.createElement('p');
                errorMessage.className = 'text-danger cwsn-video-error mt-2';
                errorMessage.textContent = 'Unable to load this video. Please try again later.';
                parent.appendChild(errorMessage);
            }
        );

        return video;
    }

    function createYouTubePlayer(videoUrl) {

        const videoId = getYouTubeVideoId(videoUrl);

        if (!videoId) {
            const errorMessage = document.createElement('p');
            errorMessage.className ='text-danger cwsn-video-error';
            errorMessage.textContent ='Invalid YouTube video URL.';
            return errorMessage;
        }

        const wrapper =  document.createElement('div');
        wrapper.className ='cwsn-youtube-wrapper';
        const iframe =document.createElement('iframe');

        iframe.src ='https://www.youtube-nocookie.com/embed/' +  encodeURIComponent(videoId) +'?rel=0';
        iframe.title = 'Instructional test video';
        iframe.loading ='lazy';
        iframe.allow = 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share';
        iframe.setAttribute( 'allowfullscreen', '' );
        iframe.setAttribute( 'referrerpolicy','strict-origin-when-cross-origin' );
        wrapper.appendChild(iframe);
        return wrapper;
    }

    function createVideoPlayer(videoUrl) {

        if (!videoUrl) {

            const errorMessage = document.createElement('p');
            errorMessage.className = 'text-danger cwsn-video-error';
            errorMessage.textContent ='Video file is not available.';
            return errorMessage;
        }

        if (isYouTubeUrl(videoUrl)) {
            return createYouTubePlayer(videoUrl);
        }

        return createVideoElement(videoUrl);
    }

    function createVideoSection(video, videoIndex) {

        const wrapper =  document.createElement('div');
        wrapper.className ='mb-4';
        const title = document.createElement('h4');
        title.className = 'test-cat';
        title.style.fontSize = '14px';
        title.style.backgroundColor = '#2a2876';
        let videoType =  video.type_video || 'Test';

        videoType =  String(videoType).charAt(0).toUpperCase() +  String(videoType).slice(1);
        title.textContent = videoType + ' Video';
        const videoUrl =getVideoUrl(video.video_url);

        console.log('videoUrl', videoUrl);


        if (!videoUrl) {
            const errorMessage = document.createElement('p');
            errorMessage.className = 'text-danger';
            errorMessage.textContent ='Video file is not available.';
            wrapper.appendChild(title);
            wrapper.appendChild(errorMessage);
            return wrapper;
        }

        const player = createVideoPlayer(videoUrl);
        player.dataset.videoIndex =  videoIndex;
        wrapper.appendChild(title);
        wrapper.appendChild(player);
        return wrapper;
    }

    $(document).on('click','.cwsn-video-btn',  function (event) {

            event.preventDefault();
            event.stopPropagation();
            event.stopImmediatePropagation();

            const button =  $(this);
            const testTypeId = String( button.data('testtypeid') );
            const testName =button.data('testname') ||'Test Video';
            const modal = $('#playModal');

            modal.find('.modal-title')  .text(testName);

            modal .find('.modal-body') .html(
                    '<p class="text-muted mb-0">' +
                    'Loading video...' +
                    '</p>'
                );

            modal.modal('show');
            const filteredVideos =  videos.filter(
                    function (video) {
                        return String(  video.testType_id ) === testTypeId;
                    }
                );

            let selectedVideos = [];

            if (String(seniorBMI) === '1') {
                selectedVideos =  filteredVideos .filter( function (video) {
                        return String( video.video_url || '').startsWith('_1');
                    }
                ).slice(0, 1);

            } else {
                selectedVideos =  filteredVideos
                .filter(
                    function (video) {
                        return !String(  video.video_url || '').startsWith('_1');

                    }
                );
            }
            if (selectedVideos.length === 0) {

                modal .find('.modal-body')
                    .html(
                        '<p class="text-muted mb-0">' +
                        'No videos available for this test.' +
                        '</p>'
                    );

                return;
            }

            const container = document.createElement('div');
            selectedVideos.forEach(
                function (video, index) {
                    const section =  createVideoSection( video, index );
                    container.appendChild(section);
                }
            );

            modal.find('.modal-body').empty();
            modal .find('.modal-body')[0].appendChild(container);
            modal.find('video')
            .each(
                function () {  this.pause();
                    try {
                        this.currentTime = 0;
                    } catch (error) {
                        console.warn( 'Unable to reset video:',   error );
                    }
                }
            );
        }
    );

    $(document).on(  'click','.row-clickable', function (event) {
        if ( $(event.target) .closest('.cwsn-video-btn') .length) {
            return;
        }

        const href =$(this).data('href');
        if (href) { window.location.href =  href;
        }
    });

    $(document).on( 'click', '.pdfreader', function (event) {
            event.stopPropagation();
        }
    );

    $('#playModal').on('hide.bs.modal', function () {
            const modal = $(this);

            modal.find('video').each(
                function () {

                    try {
                        this.pause();
                        this.currentTime = 0;
                        this.removeAttribute('src');
                        this.load();
                    } catch (error) {
                        console.error('Error stopping video:', error );
                    }
                }
            );

            modal.find('iframe') .remove();
        }
    );

    $('#playModal').on( 'hidden.bs.modal',  function () {
            $(this) .find('.modal-body')
                .html(
                    '<p class="text-muted mb-0">' +
                    'Select a video to play.' +
                    '</p>'
                );
        }
    );

});

</script>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.filldart-app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\nep\resources\views/assessor/cwsnSkillsTest.blade.php ENDPATH**/ ?>