
<?php $__env->startSection('title', 'Goforfit | ' . $title); ?>
<?php $__env->startSection('content'); ?>

<style>
   .video-card {
      position: relative;
      border-radius: 20px;
      overflow: hidden;
      cursor: pointer;
      width: 100%;
      height:220px;
      aspect-ratio: 16 / 9;
   }
   .video-card img {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      object-fit: cover;
      display: block;
   }
   .video-card::before {
      content: "";
      position: absolute;
      inset: 0;
      background: linear-gradient(
         to top,
         rgba(0,0,0,0.85) 0%,
         rgba(0,0,0,0.6) 40%,
         rgba(0,0,0,0.2) 75%,
         rgba(0,0,0,0.05) 100%
      );
      z-index: 1;
   }
   .video-card::after {
      content: "";
      position: absolute;
      inset: 0;
      background: linear-gradient(
         to top,
         rgba(255,122,0,0.85) 0%,
         rgba(255,140,0,0.75) 30%,
         rgba(255,140,0,0.45) 55%,
         rgba(255,140,0,0.20) 75%,
         transparent 100%
      );
      opacity: 0;
      transition: opacity 0.4s ease;
      z-index: 2;
   }
   .video-card:hover img {
      transform: scale(1.08);
   }
   .video-card:hover::after {
      opacity: 0.85;
   }
   .play-icon {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      z-index: 3;
      transition: 0.4s ease;
   }
   .card-content {
      position: absolute;
      left: 50%;
      bottom: 25px;
      transform: translateX(-50%);
      text-align: center;
      color: #fff;
      z-index: 3;
      width: 85%;
      transition: all 0.4s ease;
   }
   .card-content span {
      font-size: 16px;
      font-weight: 600;
      line-height: 1.2;
      display: block;
   }
   .video-card:hover .card-content {
      bottom: 35px;
      transform: translateX(-50%);
   }

   .video-card:hover .play-icon {
      transform: translate(-50%, -50%) scale(1.15);
   }

   /* Responsive */
   @media (max-width: 991px) {
      .video-card {
         height: 280px;
      }
   }

   @media (max-width: 767px) {
      .video-card {
         height: 240px;
      }

      .card-content span {
         font-size: 18px;
      }

      .play-icon svg {
         width: 60px;
         height: 60px;
      }
   }
</style>

<?php
$videos = [
    ['id' => 'g1rCLbqosQU', 'title' => 'Balance'],
    ['id' => 'u8jSpu9qceQ', 'title' => 'Abdominal muscular strength and Endurance'],
    ['id' => 'EjjvPin7sZc', 'title' => 'Muscular Endurance for Children'],
    ['id' => 'SCcs5ccJp8E', 'title' => 'Muscular Endurance for Adults'],
    ['id' => 'FMN9GRh5oj0', 'title' => 'Agility for 65+'],
    ['id' => '2mM5m5XLHT8', 'title' => 'Flexibility for 65+'],
    ['id' => 'WQTEnfNmwFo', 'title' => 'Abdominal Muscular Strength & Endurance for 19-65'],
    ['id' => 'QwhZl7IbtR4', 'title' => 'Cardiovascular Endurance'],
    ['id' => 'wD3DenG9JiQ', 'title' => 'Flexibility for 9-18'],
    ['id' => 'msjIcQ0lKCk', 'title' => 'Flexibility for 19 to 65'],
    ['id' => 'LZRKCMrFVCQ', 'title' => 'Aerobic Endurance for 65+'],
    ['id' => 'GX-w7lOUd0c', 'title' => 'Muscular Endurance for 65+'],
    ['id' => 'BxvdqGqeGiY', 'title' => 'Flexibility for 65+'],
];
?>

<div class="container mt-5">
    <div class="row mt-4 mb-5">

        <?php $__currentLoopData = $videos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $video): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-12 col-sm-6 col-lg-3 mb-3">
            <div class="video-card"
                data-toggle="modal"
                data-target="#videoModal"
                data-video-id="<?php echo e($video['id']); ?>"
                data-video-title="<?php echo e($video['title']); ?>">

                <img src="https://img.youtube.com/vi/<?php echo e($video['id']); ?>/maxresdefault.jpg"
                    alt="<?php echo e($video['title']); ?>">

               <div class="play-icon">
                  <svg width="40" height="40" viewBox="0 0 16 16" fill="#9d9fa8">
                     <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M6.79 5.093A.5.5 0 0 0 6 5.5v5a.5.5 0 0 0 .79.407l3.5-2.5a.5.5 0 0 0 0-.814l-3.5-2.5z"/>
                  </svg>
               </div>

               <div class="card-content">
                  <span><?php echo e($video['title']); ?></span>
               </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </div>
</div>

<!-- Modal Same as Before -->
<div class="modal fade" id="videoModal" tabindex="-1" area-hidden="true" role="dialog"
     data-backdrop="static"
     data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content bg-dark border-0">
            <div class="modal-header border-0">
                <h5 class="modal-title text-white"></h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body p-0">
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item"
                        id="modalVideoIframe"
                        src=""
                        allow="autoplay; encrypted-media"
                        allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {

    $('#videoModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var videoId = button.data('video-id');
        var videoTitle = button.data('video-title');

        var modal = $(this);
        modal.find('.modal-title').text(videoTitle);
        modal.find('#modalVideoIframe')
            .attr('src', 'https://www.youtube.com/embed/' + videoId + '?autoplay=1');
    });

    $('#videoModal').on('hidden.bs.modal', function() {
        $('#modalVideoIframe').attr('src', '');
    });

});
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.filldart-app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\nep\resources\views/parent/getactive.blade.php ENDPATH**/ ?>