@if(!empty($dailyReportCard['reportCardDetails']) && collect($dailyReportCard['reportCardDetails'])->isNotEmpty())

    @foreach(collect($dailyReportCard['reportCardDetails'])->sortKeys() as $sport => $details)

        <div class="col-12"> <h2 class="mt-0 mb-4">{{ $sport }}</h2> </div>                                    
        @foreach(collect($details)->sortByDesc('date') as $detail)
            <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                <div class="card mb-4 mt-2">

                    <div class="activity-img" onclick="modelContent({{ $detail['activity_id'] }}, '{{ $detail['skillsport'] }}',  '{{ $sport }}', '{{ $detail['techniques'] }}', '{{ $dailyReportCard['studentProfile']['class']  }} - {{$dailyReportCard['studentProfile']['section'] ?? '' }}', true)">
                        <div class="class">
                            <div class="date col py-1">{{ date('d-M-Y', strtotime($detail['date'])) ?? 'N.A' }}</div>
                            <div class="prd col py-1">Period {{ $detail['period'] ?? 'N.A' }}</div>
                        </div>

                        @php 
                            if($detail['image'] == ''){
                               $imagepath = 'change-activities/default_activity_img.svg'; 
                            } else {
                                if(str_starts_with($detail['image'], 'https')){
                                    $imagepath = $detail['image'];
                                }else{
                                    $file = 'uploads/'.$detail['image'];
                                    if (file_exists($file)) {                                                        
                                        $imagepath = 'uploads/'.$detail['image'];
                                    } else {
                                       $imagepath = 'change-activities/default_activity_img.svg';
                                    }
                                }
                            } 
                        @endphp

                        <div class="img_overlay"></div>
                        <img class="card-img-top" src="{{ $imagepath }}" alt="Card image cap">
                    </div>

                    <div class="card-body">
                        <h5 class="card-title">{{ $detail['activity'] ?? 'N.A' }}</h5> 
                        <p class="card-text"><strong>Rating</strong>                            
                            <span class="rating" style="position: relative; top: -5px;">
                                <span class="stars" style="margin-right: 0px;">
                                    <?php for ($i=0; $i < $detail['level'] ; $i++) {  ?>
                                      <img alt="star" src="{{'change-activities/star_fill-o.svg'}}" class="img-fluid">
                                    <?php } ?>
                                      
                                    <?php for ($i=0 ; $i < 7-$detail['level'] ; $i++ ) { ?>
                                        <img alt="star" src="{{'change-activities/star_border-o.svg'}}" class="img-fluid">
                                    <?php } ?>
                                </span>
                            </span>
                        </p>

                        <p class="card-text"><strong>Skill/Sports</strong> {{ $detail['skillsport'] ?? 'N.A' }} </p>
                        <p class="card-text"><strong>Technique</strong>{{ $detail['techniques'] ?? 'N.A' }}  </p>
                        <p class="card-text"><strong>Level- {{ $detail['level'] ?? 'N.A' }}</strong>{{ $detail['level_name'] ?? 'N.A' }} </p>
                    </div>
                </div>
            </div>
        @endforeach
    @endforeach

@else
    <div class="col-12 mt-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body py-5">

                <div class="d-flex flex-column align-items-center">
                    <div class="mb-3">
                        <i class="fas fa-calendar-alt text-muted"
                           style="font-size: 45px;"></i>
                    </div>

                    <h5 class="mb-2 text-dark">
                        No Report Data Available
                    </h5>

                    <p class="text-muted mb-0 text-center">
                        There is no daily tracker data available for the selected session.
                        Please select another session or check back later.
                    </p>
                </div>

            </div>
        </div>
    </div>
@endif
