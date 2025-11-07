@extends('layouts.filldart-app')
@section('title', 'Goforfit | '.$sport_name )
@section('content')


@push('style-css')
<!-- GLightbox CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css">

<style>
    
.card.chapter-bx .card-body {
    padding: 0.85rem 1.25rem;
    /* position: absolute;
    width: 100%;
    min-height: 100%;
    background: #000000;
    background: linear-gradient(0deg, rgba(0, 0, 0, 0.50) 0%, rgba(0, 0, 0, 0.20) 50%, rgba(0, 0, 0, 0) 100%); */
}
.chapter-bx h3.card-text {
    font-size: 14px;
    /* color: #fff;
    position: absolute;
    bottom: 15px; */
}
.chapter-bx .cover {
    position: relative;
    width: 100%;
    height: 100%;
    display: block;
}

.chapter-bx .cover::before {
    content: "";
    width: 24px;
    height: 24px;
    background-color: #fff;
    position: absolute;
    left: 50%;
    top: 50%;
    transform: translate( -50%, -50%);
    z-index: 2;
}
.chapter-bx .cover > svg {
    position: absolute;
    left: 50%;
    top: 50%;
    transform: translate( -50%, -50%);
    width: 48px;
    fill: red;
    z-index: 2;
}

</style>


@endpush

<div class="container-fluid">
    <div class="t-mrg2 mb-5 pb-5">
        <div class="container all-chaptr-cards">

            <!-- Header with Back Button -->
            <div class="row">
                <div class="col-12">
                    <div class="heading-rw mt-0 mt-md-1 mb-0 p-0">

                      <a href="javascript:history.back()" class="back-button">
                        <span class="arrow"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16"> <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5" />
                            </svg></span> 
                        </a>
                      
                        <h1 class="mt-2 mt-md-0 ml-md-4 mb-0">{{ $sport_name }}</h1>
                    </div>
                </div>
            </div>


            @foreach($groupedChapters as $chapter => $chapterData)
            <div class="chapter-card mt-5">
                <h2 class="chapter-title">{{ $chapter }} : {{ $chapterData['chapter_topic'] }}</h2>

                <!-- Video Grid -->
                <div class="row mt-3 mt-lg-4">
                    @foreach($chapterData['videos'] as $video)
                        @php
                            preg_match("/v=([a-zA-Z0-9_-]+)/", $video->video_url, $matches);
                            $youtubeId = $matches[1] ?? '';
                            $embedUrl = $youtubeId ? "https://www.youtube.com/embed/{$youtubeId}" : $video->video_url;
                        @endphp

                        <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                            <div class="card chapter-bx p-0 mb-4">

                                <!-- GLightbox link -->
                                <a href="{{ $embedUrl }}" class="glightbox" data-type="video">
                                    <span class="cover position-relative">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                             class="bi bi-play-btn-fill position-absolute top-50 start-50 translate-middle"
                                             viewBox="0 0 16 16" style="width: 50px; height: 50px; color: rgba(255,255,255,0.8)">
                                            <path d="M0 12V4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2m6.79-6.907A.5.5 0 0 0 6 5.5v5a.5.5 0 0 0 .79.407l3.5-2.5a.5.5 0 0 0 0-.814z"/>
                                        </svg>

                                        <img src="{{ $video->thumbnail_url }}" class="card-img-top" alt="{{ $video->title }}">
                                    </span>

                                    <span class="card-body">
                                        <h3 class="card-text">{{ $video->title ?? 'N.A.'}}</h3>
                                    </span>
                                </a>

                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @endforeach

        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- GLightbox JS -->


<script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>
<script>
    const lightbox = GLightbox({
        selector: '.glightbox',
        autoplayVideos: true,
        plyr: {
            youtube: {
                noCookie: true, // optional: use youtube-nocookie.com
                rel: 0, // disable related videos
            }
        }
    });
</script>
@endpush

