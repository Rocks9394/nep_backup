@extends('layouts.filldart-app')
@section('title', 'Goforfit | ' . $title)
@section('content')


<style type="text/css">
p.card-text {
    font-size: 29px;
    text-align: center;
    margin-top: 20px;
}

h5.card-title {
    text-align: center;
    margin-top: 23px;
}

.table thead th {
    border-bottom: 0px;
    background-color: #434386;
    color: #fff;
}

.students_count {
    display: flex;
    justify-content: center;
    column-gap: 15px;
    margin-top: 16px;
}

.students_count p{
   font-weight: 500;
}

</style>

<div class="container all-chaptr-cards mt-5">
   <div class="row">
      <div class="col-12">
        <div class="heading-rw mt-0 mt-md-1 mb-0 p-0">
          <a href="{{ route('filldart.dashboard') }}"  class="back-button">
              <span class="arrow">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5" />
                </svg>
              </span>
          </a>
          <h1 class="ml-md-4 mb-0">{{$title}}</h1>
         </div>
      </div>
   </div>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-more.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script src="https://code.highcharts.com/modules/full-screen.js"></script>


<div class="row">
	<div class="col-md-6">
      
	  <div class="card">
		<div id="container"></div>
	  </div>
	
	</div>
	
	
	<div class="col-md-6">
	
		<div class="card">
				<div id="container2"></div>
		</div>
	</div>

</div>









  <script>
    Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Letnen Indicator'
    },
    xAxis: {
        categories: ['L1', 'L2', 'L3', 'L4', 'L5', 'L6', 'L7']
    },
    yAxis: [{
        title: {
            text: 'Sales (in USD)'
        }
    }, {
        title: {
            text: 'Profit (in USD)',
            opposite: true
        }
    }],
    series: [{
        name: 'Sales',
        type: 'column',
        data: [10000, 20, 5, 50, 80, 25, 150],
        color: '#7cb5ec'
    }, {
        name: 'Profit',
        type: 'line',
        data: [5, 7, 6, 8, 10, 12, 11],
        color: '#434348',
        yAxis: 1
    }],
    accessibility: {
        enabled: true,
        description: 'This chart shows monthly sales and profit data for the year.'
    }
});



    Highcharts.chart('container2', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Health Indicator'
    },
    xAxis: {
        categories: ['UW', 'N', 'OW', 'OB']
    },
    yAxis: [{
        title: {
            text: 'Sales (in USD)'
        }
    }, {
        title: {
            text: 'Profit (in USD)',
            opposite: true
        }
    }],
    series: [{
        name: 'Sales',
        type: 'column',
        data: [30000, 40000, 35000, 45000 ],
        color: '#7cb5ec'
    }, {
        name: 'Profit',
        type: 'line',
        data: [5000, 7000, 6000, 8000],
        color: '#434348',
        yAxis: 1
    }],
    accessibility: {
        enabled: true,
        description: 'This chart shows monthly sales and profit data for the year.'
    }
});

  </script>
</div>




@endsection