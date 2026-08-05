@extends('layouts.filldart-app')
@section('title', 'CISCE | ' . $title)
@section('content')

<div class="container">
    <div class="t-mrg2 mb-5 pb-5">
        <div class="row">
            <div class="col-12">            
                <div class="row"> <x-back-button :title="$title" /> </div>             

                <div class="row text-center justify-content-md-center mt-2 mt-lg-4">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="all-tests">
                            <ul class="list-group tests mt-3">
                                @foreach($testType as $key => $val)
                                    <li>
                                        <div class="get_ready">
                                            <a href="{{ route('cwsn.test.types', ['TestTypeId' => $val->TestTypeID,'pwd_category_id' => $pwd_category_id]) }}">
                                                <span>{{ $val->TestTypeName }}</span>
                                                <span class="arrow-i"><i class="bi bi-arrow-right"></i></span>
                                            </a>
                                        </div>
                                        <a href="javascript:void(0);" class="play" data-toggle="modal" 
                                            data-target="#playModal" data-testtypeid="{{ $val->TestTypeID }}" data-testname="{{ $val->TestPerformed }}"> <i class="bi bi-play-circle"></i> 
                                        </a>
                                    </li>
                                @endforeach
                            </ul>

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
document.addEventListener("DOMContentLoaded", function() {
    
    $('#playModal').on('show.bs.modal', function(event) {
        let button = $(event.relatedTarget); 
        let testTypeId = button.data('testtypeid');
        let testName   = button.data('testname');
        let flag = `{{$SeniorBMI}}`;
        let modal = $(this);

        modal.find('.modal-title').text(testName);

        let allVideos = @json($videos);
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

@endsection
