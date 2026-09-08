
<?php $__env->startSection('title', 'CISCE | ' . $title); ?>
<?php $__env->startSection('content'); ?>

<style>
    .get_ready {
        position: relative;
        display: flex;
        align-items: center;
        background-color: #fff;
        justify-content: space-between;
         cursor: pointer;
    }
    .all-tests .list-group li .play{
        position: relative !important;
    }
    .pdfandvideo {
        display: flex;
        align-items: center;
    }

    .pdfandvideo > .videoplayer {
        width: 50px;
    }

    .pdfandvideo > .pdfreader {
        width: 90px !important;
    }


    .tooltip {
        z-index: 1080 !important;
        pointer-events: none; /* Prevents tooltip content from blocking touches */
    }

    /* Ensure the info icon receives touch events clearly */
    .custom-tooltip-trigger {
        padding: 4px; /* Increases touch target size for mobile */
        touch-action: manipulation;
    }


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


    @media (max-width: 768px) {
        .all-tests .list-group li a {
          padding: 12px !important;
        }

        .pdfandvideo > .videoplayer {
            width: 40px;
        }
        
        .pdfandvideo > .pdfreader {
            width: 80px !important;
        }


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
                                                           title="<b>Test Applicable for :</b><br><?php echo e(is_array($val->disability_categories) ? implode(', ', $val->disability_categories) : $val->disability_categories->implode(', ')); ?>">       
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
                                                         <a href="javascript:void(0);" class="play" data-toggle="modal" 
                                                            data-target="#playModal" data-testtypeid="<?php echo e($val->TestTypeID); ?>" data-testname="<?php echo e($val->TestPerformed); ?>"> 
                                                            <i class="bi bi-play-circle"></i> 
                                                        </a>
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
<div class="modal fade modal-video" id="playModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Running</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p class="text-muted">Loading video...</p>
      </div>
    </div>
  </div>
</div>


<script>


$(document).ready(function() {
    var $tooltips = $('[data-toggle="tooltip"]');
    $tooltips.tooltip({
        trigger: 'manual',
        boundary: 'window',
        placement: function() {
            return window.innerWidth <= 768 ? 'top' : 'right';
        }
    });

    $tooltips.on('click touchstart', function(e) {
        e.stopPropagation();
        e.preventDefault();

        var $this = $(this);
        var isOpen = $this.data('tooltip-open') === true;
        $tooltips.tooltip('hide').data('tooltip-open', false);
        if (!isOpen) {
            $this.tooltip('show').data('tooltip-open', true);
        }
    });

    $(document).on('click touchstart', function(e) {
        if (!$(e.target).closest('[data-toggle="tooltip"]').length) {
            $tooltips.tooltip('hide').data('tooltip-open', false);
        }
    });

    $('.row-clickable').on('click', function() {
        window.location.href = $(this).data('href');
    });

    $('.stop-propagation').on('click touchstart', function(e) {
        e.stopPropagation();
    });
});

document.addEventListener("DOMContentLoaded", function() {
    
    $('#playModal').on('show.bs.modal', function(event) {
        let button = $(event.relatedTarget); 
        let testTypeId = button.data('testtypeid');
        let testName   = button.data('testname');
        let flag = `<?php echo e($SeniorBMI); ?>`;
        let modal = $(this);

        modal.find('.modal-title').text(testName);

        let allVideos = <?php echo json_encode($videos, 15, 512) ?>;
        let filtered = allVideos.filter(v => v.testType_id == testTypeId);
        let html = '';

        if (flag == 1) {
            // Case 1: show only video with "_1"
            let specialVideo = filtered.find(v => v.video_url.startsWith("_1"));
            if (specialVideo) {
                let url = specialVideo.video_url.substring(2); // remove "_1"

                if (url.includes('youtu.be/')) {
                    url = url.replace('youtu.be/', 'www.youtube.com/embed/').split('?')[0];
                } else if (url.includes('watch?v=')) {
                    url = url.replace('watch?v=', 'embed/').split('&')[0];
                }

                let title = specialVideo.type_video.charAt(0).toUpperCase() + specialVideo.type_video.slice(1) + " Video";

                html += `
                    <div class="mb-4">
                        <h4 class="test-cat" style="font-size:14px; background-color:#2a2876;">${title}</h4>
                        <iframe class="demo-video"
                            src="${url}"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen>
                        </iframe>
                    </div>
                `;
            }
        } else {
            // Case 2: show videos that do NOT start with "_1"
            let otherVideos = filtered.filter(v => !v.video_url.startsWith("_1"));

            otherVideos.forEach(video => {
                let url = video.video_url;
                if (url.includes('youtu.be/')) {
                    url = url.replace('youtu.be/', 'www.youtube.com/embed/').split('?')[0];
                } else if (url.includes('watch?v=')) {
                    url = url.replace('watch?v=', 'embed/').split('&')[0];
                }

                let title = video.type_video.charAt(0).toUpperCase() + video.type_video.slice(1) + " Video";

                html += `
                    <div class="mb-4">
                        <h4 class="test-cat" style="font-size:14px; background-color:#2a2876;">${title}</h4>
                        <iframe class="demo-video"
                            src="${url}"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen>
                        </iframe>
                    </div>
                `;
            });
        }

        if (html === '') {
            html = '<p>No videos available for this test.</p>';
        }

        modal.find('.modal-body').html(html);
    });
});
$('#playModal').on('hidden.bs.modal', function () {
    $(this).find('.modal-body').html('<p class="text-muted">Loading video...</p>');
});


</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.filldart-app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\nep\resources\views/assessor/cwsnSkillsTest.blade.php ENDPATH**/ ?>