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



@php 

#echo "<pre>";
#print_r($chartSeries);

@endphp


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


<!--<div class="row">

	<div class="col-md-12">
	  <div class="card">
		<div id="container3"></div>
	  </div>

	</div>

</div>-->



<div class="row">

	<div class="col-md-12">
	  <div class="card">
		
	
			<div id="currentCamp" class="chart"></div>
			<!--<div id="previousCamp" class="chart"></div>-->
		
	  </div>

	</div>

</div>





<?php

#echo "<pre>";
#print_r($chartSeries);
#die('----here we not make any bound----');
//$categories = ['Ajay', 'Bhawani', 'Suresh', 'Vinod', 'Govind', 'Rameshwar', 'Nameesh', 'Abhineet', 'Bhawani'];




#$letnentotals = [10,20,30,40, 50, 60, 70, 80, 90];
#echo "<pre>";
#print_r($letnentotals);
#die('----here we not make any bound----');

?>


  <script>
    Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Fitness Indicator'
    },
    xAxis: {
        //categories: ['L1', 'L2', 'L3', 'L4', 'L5', 'L6', 'L7']
		categories: @json($letnenlevels)
    },
    yAxis: [{
        title: {
            text: 'Total Student'
        }
    }, {
        title: {
            text: 'Overall Average (Bell Curve)',
            opposite: true
        }
    }],
    series: [{
        name: 'Total Student',
        type: 'column',
        //data: [10000, 20, 5, 50, 80, 25, 150],
		data: @json($letnentotals),
        color: '#7cb5ec'
    }, {
        name: 'Overall Average (Bell Curve)',
        type: 'line',
        //data: [5, 7, 6, 8, 10, 12, 11, 9, 89],
		data: @json($ranked_schoolsFitness),
        color: '#434348',
        yAxis: 1
    }],
    accessibility: {
        enabled: true,
        //description: 'This chart shows monthly sales and profit data for the year.'
		 description: 'Bhawani Graph 01.'
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
        //categories: ['UW', 'N', 'OW', 'OB']
		categories: @json($healthLevels)
    },
    yAxis: [{
        title: {
            text: 'Total Student'
        }
    }, {
        title: {
            text: 'Overall Average (Bell Curve)',
            opposite: true
        }
    }],
    series: [{
        name: 'Total Student',
        type: 'column',
        //data: [30000, 40000, 35000, 45000 ],
		data: @json($healthTotals), 
        color: '#7cb5ec'
    }, {
        name: 'Overall Average (Bell Curve)',
        type: 'line',
        //data: [5000, 7000, 6000, 8000],
		data: @json($healthRankData),
        color: '#434348',
        yAxis: 1
    }],
    accessibility: {
        enabled: true,
        description: 'Bhawani Graph 02.'
    }
});

  </script>
  
  
  <script>
/*Highcharts.chart('container3', {
    chart: {
        type: 'bar'
    },
    title: {
        text: 'School Graph based on student activity 2025',
        align: 'left'
    },
    xAxis: {
        // These are now your "Rows"
        //categories: ['Push-up', 'PCUP', 'Set & Reach', '50 mt', '600 mt']
		  categories: @json($categories)
    },
    yAxis: {
        min: 0,
        title: { text: 'Score' }
    },
    legend: {
        reversed: true
    },
    plotOptions: {
        series: {
            stacking: 'normal', // Keeps bars stacked as in your original
            dataLabels: {
                enabled: true,
                style: { whiteSpace: 'nowrap' }
            }
        }
    },
    // The data is transposed: Each series represents a Student/Column
    // Each index in the 'data' array corresponds to the category (Row) above
    /*series: [
        { name: 'L1', data: [30, 20, 45, 38, 25] },
        { name: 'L2', data: [40, 30, 52, 42, 32] },
        { name: 'L3', data: [45, 35, 57, 51, 87] },
        { name: 'L4', data: [48, 38, 58, 52, 48] },
        { name: 'L5', data: [49, 39, 69, 58, 26] },
        { name: 'L6', data: [52, 32, 70, 55, 63] },
        { name: 'L7', data: [70, 20, 80, 50, 20] }
    ]*/
	
	series : @json($chartSeries)
});*/
</script>



<script>


function drawChart(container, title) {
  Highcharts.chart(container, {
    chart: { type: 'bar' },
    title: { text: title },

    xAxis: {
      categories: @json($categories)
    },

	 yAxis: {
	  min: 0,
	  labels: {
		formatter: function () {
		  return Math.round(this.value);
		}
	  }
	},

    legend: { enabled: false },

    plotOptions: {
      series: {
        stacking: 'percent',
        
      }
    },

    /*series: [
      { data: [1,2,3,4,5,6,7], color:'#ff4d5a' },
      { data: [8,9,10,11,12,13,14], color:'#ffb366' },
      { data: [15,16,17,18,19,20,21], color:'#ffd87d' },
      { data: [22,23,24,25,26,27,28], color:'#7ecad9' },
      { data: [29,30,31,32,33,34,35], color:'#a6d96a' },
      { data: [36,37,38,39,40,41,42], color:'#7bc043' },
      { data: [43,44,4546,47,48,49], color:'#0a8f3d' }
    ]*/
	series: @json($chartSeries)
	
  });
}

drawChart('currentCamp', 'Current Camp');
//drawChart('previousCamp', 'Previous Camp');
</script>
  
  
</div>




@endsection