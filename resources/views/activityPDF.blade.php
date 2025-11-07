<!DOCTYPE html>
<html>
<head>
    <title>Activity PDF</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
		
	<style>

		html, body {
			background:#ffffff;
			border:0;
			padding:0;
		}
		.cover-page, .last-page { margin:0; padding:0 0 1% 0; }
		
		.cover-page img, .last-page img { width:100%; height:100vh; margin:0; }
		
		.page-dv {
			margin-bottom:100px;
			page-break-after: always;
			padding:0;
		}
		
		.act-img {
			display:inline-block;
			/*overflow:hidden;
			height:300px;
			wight:200px;*/
			float:right;
		}
		figure, img {
			height: 200px;
			width: auto;
			margin:15px 0 15px 30px;
		}	
		h2, h4 {margin:0; text-transform:uppercase; }
		h2 {font-size: 1.35em; line-height:1.3; margin-bottom:15px; background:#292775; padding:5px 0px 5px 10px; border-left:5px solid #ff8000; color:#fff; }
		h3, h4, h5 {color:#111111; font-weight:bold; margin-top:30px; }
		h3 {font-size: 1.4em; background:red; }
		h4 {font-size: 1.25em; /*background:blue;*/ }
		h5 {font-size: 1em; background:yellow; }
		.basic-activty { clear:boith; margin-bottom:30px; }
		.st-activity { background:#fff0e1; padding:0; }
		.act-row, .act-core { clear:both; border-bottom:1px solid #f5dcc3; color:#333; padding: 10px 15px 5px 15px;  }
		.org-rw { background:#ff8000; padding: 10px 15px 5px 15px; color:#fff; font-weight:bold; font-size:1.15em; }
		.act-core { border-bottom:0px; padding-bottom:5px; }
		.act-row span, .act-core span { display:inline-block; margin-right:5px; min-width:150px; }
		/*.chptr { font-size:1.25em; color:#292775; }*/
		.chptr p.pr-row { font-weight:bold; }
		
		.st-activity p {margin:0; padding:0 0 5px 0; font-weight:400; }
		
		.logos-dv img { clear:both; }
		b, strong { font-size:1.25em; }
		.basic-activty b, .basic-activty strong, .chptr p { font-size:1.05em; }
		
		
		ul, ol { margin-left:30px; padding:0; }
		ul li, ol li { margin-bottom:6px; padding:0; }
		p, li {
			color:#333;
			font-size: 0.90em;
			line-height:1.4em;
			padding-bottom:0;
		}
		
		/*.last-page {
			background-color:#292775;
			height:98%;
			padding:0;			
		}
		.address-dv { width:70%; padding:40% 3% 0 4%; color:#fff; font-size:1em; }
		.address-dv img { height:auto; margin:0 0 15px 0; padding:0; }
		.address-dv h4 {color:#fff; font-size:1.15em; line-height:1.5; text-transform:capitalize; padding-bottom:5px; margin:0; }
		.address-dv p { font-size:0.8em; margin:0; padding-bottom:5px; color:#fff; }*/
		
	@page {
		size: A4 landscape;
        margin: 4% 3% 2.5% 3%;
		/*color:#000000;*/
		/*font-family: Arial, Helvetica, sans-serif;*/
		font-family: 'Roboto', sans-serif;
		border:0px solid #4caf50;	
    }
	
	/*div { page: narrow }
		table { page: rotated }
		.row{ clear:both; }
		.colum { width:50%; float:left; }*/
		
	
	</style>
	
</head>
 
<body>
<div class="cover-page">
	<img src="{{ asset('public/uploads/activity-cover-page_Math.jpg')}}" alt="">
</div>
<div class="container">
    <div class="row">
        <div class="col">
			
			@foreach($activities as $activity)
				<div class="page-dv">
				<div class="basic-activty">
				
				<div class="st-activity">
				
				<div class="act-row org-rw">
				<span>{{ $activity->clsname }}</span><span>Subject: {{ $activity->subjectname }}</span>
				</div>
				<div class="act-row chptr">
				<p class="pr-row"><b>Chapter:</b> {{ $activity->chaptername }}</p>
				<p class="pr-row"><b>Concept:</b> {{ $activity->conceptname }}</p>
				</div>
				<!--<p class="pr-row">{{ $activity->cls1name }}</p>-->
				<div class="act-core">
				<span><b>Skill:</b> {{ $activity->skillareaname }}</span>	<span><b>Sports:</b> {{ $activity->sportsname }}</span> <span><b>Technique:</b> {{ $activity->techniquename }}</span>
				</div>
				
				</div>
				
				
				</div>
				<h2>{{ $activity->title }}</h2>				
				
				<div class="act-img"><img src="{{ asset('public/uploads').'/'.$activity->image }}" class="card-img-top attachment-post-thumbnail size-post-thumbnail wp-post-image" alt=""></div>
				{!! html_entity_decode($activity->description) !!}
				<div class="row">
					<div class="col colum">
					<h4>{{ 'Learning Outcomes' }}</h4>
					{!! html_entity_decode($activity->learning_outcomes) !!}</div>
					
					<div class="col colum">
					<h4>{{ 'Variations' }}</h4>
					{!! html_entity_decode($activity->change_it) !!}</div>
					
					<div class="col colum">
					<h4>{{ 'Coaching Tips' }}</h4>
					{!! html_entity_decode($activity->coaching) !!}</div>
					
					<div class="col colum">
					<h4>{{ 'Equipment' }}</h4>
					{!! html_entity_decode($activity->equipment) !!}</div>
				</div>
				
				<div style="clear:both; min-height:30px;"></div>
				
				</div>
			@endforeach
			
		</div>
	</div>
</div>

		
<div class="last-page">
<img src="{{ asset('public/uploads/activity-cover-back.jpg')}}" alt="">
	<!--<div class="address-dv">
			<div class="logos-dv">
			<img src="{{ asset('public/uploads/nvs_logo2.png')}}" alt="nvs logo" style="height:100px;">
			<img src="{{ asset('public/uploads/Seqfast_web2.png')}}" alt="Seqfast logo" style="height:50px;">
		</div>
		<h4>Sequoia Fitness and Sports Technology Pvt. Ltd. (Fitness365)</h4>
		<p>127, First Floor, Tower B-3, Spaze ITech Park, Sector 49, Sohna Road, Gurugram, Haryana 122049, India</p>
		<p>Mob: +91 98102 59395 / E-mail:info@seqfast.com </p>
	</div>-->
</div>

</body>
</html>