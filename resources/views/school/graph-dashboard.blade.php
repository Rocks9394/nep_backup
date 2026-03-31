@extends('layouts.filldart-app')
@section('title', 'Goforfit | ' . $title)

@section('content')

<style>
    .card-text { font-size: 29px; text-align: center; margin-top: 20px; }
    .card-title { text-align: center; margin-top: 23px; }
    .table thead th { background:#434386; color:#fff; border-bottom:0; }
    .students_count { display:flex; justify-content:center; gap:15px; margin-top:16px; }
    .students_count p { font-weight:500; }

    .card {
        padding: 15px;
        margin-bottom: 20px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    #mapChart {
        width: 100%;     /* or any width you want */
        height: 360px;
        position: relative;
        overflow: hidden; 
    }
    #mapTooltip{
        position: absolute;
        display: none;
        background: #fff;
        border: 1px solid #ccc;
        padding: 10px 12px;
        border-radius: 6px;
        font-size: 13px;
        box-shadow: 0 2px 2px rgba(0,0,0,0.05);
        pointer-events: none;
        z-index: 1000;
    }
    #indiaMap {
        width: 100%;
        height: 100%;
    }
    #indiaMap svg {
        width: 100%;
        height: 100%;
        display: block;
        object-fit: contain;
    }

    #indiaMap svg path {
        transition: fill 0.3s ease;
        cursor: pointer;
    }

    .map-legend {
        position: absolute;
        bottom: 20px;
        right: 50px;
        background: #fff;
        padding: 2px 5px;
        border-radius: 6px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
        z-index: 1 !important;
        min-width: 120px;
    }

    .legend-item {
        display: flex;
        align-items: center;
        margin-bottom: 1px;
        font-size: 11px;

    }

    .legend-item:last-child {
        margin-bottom: 0;
    }

    .legend-item span {
        width: 10px;
        height: 10px;
        display: inline-block;
        margin-right: 5px;
        border-radius: 2px;
    }
   .loader-overlay {
        position: absolute;
        top: 40%;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        flex-direction: column;
        align-items: center;
        z-index: 1 !important;
        pointer-events: none;
    }

    .loader-overlay .pulse {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        position: relative;
        margin-bottom: 8px;
    }

    .loader-overlay .pulse::before,
    .loader-overlay .pulse::after {
        content: "";
        position: absolute;
        inset: 0;
        border-radius: 50%;
        border: 6px solid #000;
        animation: pulseRing 1.2s ease-out infinite;
    }

    .loader-overlay .pulse::after {
        animation-delay: 0.8s;
        opacity: 0.5;
    }

    @keyframes pulseRing {
        0% { transform: scale(0.3); opacity: 0.9; }
        100% { transform: scale(1.2); opacity: 0; }
    }

    .loader-overlay p {
        margin: 0;
        font-weight: 500;
        font-size: 14px;
        color: #333;
    }
    .highcharts-credits{
        pointer-events: none;
    }
</style>

<div class="container-fluid">
    <div class="t-mrg2 mb-5 pb-5 px-4">
        <div class="row">
            <div class="col-12 col-md">
                <div class="heading-rw mt-0 mt-md-1 mb-0 p-0">                
                    <x:back-button title="{{$title}}" />
                </div>
            </div>
        </div>

        <div class="mt-3">
            <div class="row mt-4 position-relative" id="loaderRow">
                <div class="loader-overlay">
                    <div class="pulse"></div>
                </div>

                <!-- Cards -->
                <div class="col-md-6">
                    <div class="card">
                        <div id="dd" style="height: 400px;"></div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <h5 class="card-title text-center mt-2 mb-3 text-dark">State-wise Fitness Map</h5>
                        <div id="mapChart">
                            <div id="indiaMap">
                                {!! file_get_contents(public_path('assets/uploads/map.svg')) !!}
                            </div>
                            <div class="map-legend mt-3"></div>
                            <div id="mapTooltip"></div>
                        </div>
                    </div>
                </div>                
            </div>
            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="card">
                        <div id="fitnessChart" style="height: 400px;"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div id="healthChart" style="height: 400px;"></div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card">
                        <div id="spiderChart" style="height: 800px;"></div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Highcharts core -->
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script src="https://code.highcharts.com/highcharts-more.js"></script>
<script src="https://code.highcharts.com/modules/packed-bubble.js"></script>
<script src="https://code.highcharts.com/modules/no-data-to-display.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        
        const fitnessLevels  = @json($fitnessLevels);
        const fitnessData    = @json($fitnessTotals);
        const fitnessAvg     = @json($ranked_schoolsFitness);

        const healthLevels   = @json($healthLevels);
        const healthData     = @json($healthTotals);
        const healthAvg      = @json($healthRankData);

        const skillCategories = @json($categories);
        const skillSeries     = @json($chartSeries);        
        // const FitnessMap1      = @json($FitnessMap);
        const tooltip = document.getElementById("mapTooltip");
       
        const FitnessMapUrl = "https://nep.goforfit.in/api/states-fitness-data";

        let FitnessMap = [];
        renderPieChart();
        fetch(FitnessMapUrl, {
            headers: {
                'Accept': 'application/json'
            }
        })
        .then(response => {
            if (!response.ok) throw new Error(`API response not OK: ${response.status}`);
            return response.json();
        })
        .then(result => {            
            document.getElementsByClassName('loader-overlay')[0].style.display = 'none';
            FitnessMap = result.stateData || (result.data && result.data.stateData) || [];
            buildOverallHealthChart(FitnessMap);
            buildIndiaMap(FitnessMap);
            renderIndiaMap();
            renderPieChart();
        })
        .catch(error => {
            console.error("Could not load mapdata API:", error);
        });

        function buildOverallHealthChart(FitnessMap) {
            const overallHealthData = { UW:0, N:0, OW:0, OB:0 };
            FitnessMap.forEach(state => {
                overallHealthData.UW += parseInt(state.UW) || 0;
                overallHealthData.N  += parseInt(state.N)  || 0;
                overallHealthData.OW += parseInt(state.OW) || 0;
                overallHealthData.OB += parseInt(state.OB) || 0;
            });

            const healthCategories = ['UW','N','OW','OB'];
            const pieData = healthCategories.map(cat => ({
                name: cat,
                y: overallHealthData[cat],
                color: { UW:'#a3d55f', N:'#00953b', OW:'#ffaa62', OB:'#fe4a5d' }[cat]
            }));

            Highcharts.chart('dd', {
                chart: { type: 'pie', height: 360 },
                title: { text: 'Country Health Indicator' },
                series: [{ name: 'Students', colorByPoint: true, data: pieData }]
            });
        }

        
        const stateCodeMap = {
            "Andhra Pradesh": "INAP",
            "Arunachal Pradesh": "INAR",
            "Assam": "INAS",
            "Bihar": "INBR",
            "Chhattisgarh": "INCT",
            "Goa": "INGA",
            "Gujarat": "INGJ",
            "Haryana": "INHR",
            "Himachal Pradesh": "INHP",
            "Jharkhand": "INJH",
            "Karnataka": "INKA",
            "Kerala": "INKL",
            "Madhya Pradesh": "INMP",
            "Maharashtra": "INMH",
            "Manipur": "INMN",
            "Meghalaya": "INML",
            "Mizoram": "INMZ",
            "Nagaland": "INNL",
            "Odisha": "INOR",
            "Punjab": "INPB",
            "Rajasthan": "INRJ",
            "Sikkim": "INSK",
            "Tamil Nadu": "INTN",
            "Telangana": "INTG",
            "Tripura": "INTR",
            "Uttar Pradesh": "INUP",
            "Uttarakhand": "INUT",
            "West Bengal": "INWB",
            "Delhi": "INDL",
            "Andaman and Nicobar Islands": "INAN",
            "Chandigarh": "INCH",
            "Dadra and Nagar Haveli": "INDH",
            "Daman and Diu": "INDD",
            "Jammu and Kashmir": "INJK",
            "Ladakh": "INLA",
            "Lakshadweep": "INLD",
            "Puducherry": "INPY"
        };

        const stateData = {};

        function renderPieChart(){
            if (document.getElementById('dd')) {
                try {
                    const healthCategories = ['UW', 'N', 'OW', 'OB'];

                    const overallHealthData = { UW: 0, N: 0, OW: 0, OB: 0 };
                    FitnessMap.forEach(state => {
                        overallHealthData.UW += parseInt(state.UW) || 0;
                        overallHealthData.N  += parseInt(state.N)  || 0;
                        overallHealthData.OW += parseInt(state.OW) || 0;
                        overallHealthData.OB += parseInt(state.OB) || 0;
                    });

                    const pieData = healthCategories.map(cat => ({
                        name: cat,
                        y: overallHealthData[cat],
                        color: (() => {
                            // Set your colors for each category
                            const colors = { UW:'#a3d55f', N:'#00953b', OW:'#ffaa62', OB:'#fe4a5d' };
                            return colors[cat] || '#ccc';
                        })()
                    }));

                    // Render pie chart
                    Highcharts.chart('dd', {
                        chart: {
                            type: 'pie',
                            height: 360
                        },
                        title: { text: 'Country Health Indicator' },
                        tooltip: {
                            pointFormat: '{series.name}: <b>{point.y}</b> ({point.percentage:.1f}%)'
                        },
                        accessibility: {
                            point: { valueSuffix: '%' }
                        },
                        plotOptions: {
                            pie: {
                                allowPointSelect: true,
                                cursor: 'pointer',
                                dataLabels: {
                                    enabled: true,
                                    format: '<b>{point.name}</b>: {point.y} ({point.percentage:.1f}%)'
                                }
                            }
                        },
                        series: [{
                            name: 'Students',
                            colorByPoint: true,
                            data: pieData
                        }]
                    });

                } catch (error) {
                    console.error('Overall Health Pie Chart Error:', error);
                    document.getElementById('dd').innerHTML = '<div class="map-error">Error loading overall health pie chart</div>';
                }
            }
        }
        

        // India Map with multiple fallback options

        function buildIndiaMap(FitnessMap){
            FitnessMap.forEach(item => {
                let stateName = item.name;

                if (stateName.includes("Delhi")) {
                    stateName = "Delhi";
                }

                const code = stateCodeMap[stateName];

                if (code) {
                    stateData[code] = item;
                }
            });
        }      

        function renderIndiaMap(){
            document.querySelectorAll("#indiaMap svg path").forEach(path => {
                const code = path.id;
                const data = stateData[code];

                const mapColors = ['#fe4a5d','#ffaa62','#ffd26e','#74c4d6','#a3d55f','#6bc04b','#00953b'];

                function generateLegend() {
                    const legendContainer = document.querySelector('.map-legend');
                    if (!legendContainer) return;

                    legendContainer.innerHTML = '';

                    mapColors.forEach((color, index) => {
                        let min = index * 25;
                        let max = (index + 1) * 25;

                        let label = index === mapColors.length - 1 
                            ? `${min}+` 
                            : `${min}–${max}`;

                        const item = document.createElement('div');
                        item.className = 'legend-item';
                        item.innerHTML = `<span style="background:${color}"></span> ${label} Schools`;

                        legendContainer.appendChild(item);
                    });
                }

                generateLegend();


                function getBaseColor(schools) {
                    if (!schools) return '#bbb';

                    let index = Math.floor((schools - 1) / 25);
                    if (index >= mapColors.length) index = mapColors.length - 1;

                    return mapColors[index] + 'CC';
                }

                const schools = data ? data.schools : 0;
                path.dataset.baseColor = getBaseColor(schools);
                path.style.fill = path.dataset.baseColor;

                path.addEventListener("mouseenter", function () {
                    const baseColor = this.dataset.baseColor;

                    this.style.fill = baseColor.replace(/CC$/, 'FF'); 
                    if (!data) {
                        tooltip.innerHTML = `<strong>No data</strong>`;
                    } else {
                        tooltip.innerHTML = `
                            <strong>${data.name}</strong><br>
                            Schools: ${data.schools}<br>
                            Students: ${data.students}<br>
                            UW: ${data.UW}<br>
                            N: ${data.N}<br>
                            OW: ${data.OW}<br>
                            OB: ${data.OB}
                        `;
                    }
                    tooltip.style.display = "block";
                });

                path.addEventListener("mousemove", function (e) {
                    const container = document.getElementById("mapChart");
                    const rect = container.getBoundingClientRect();
                    tooltip.style.left = (e.clientX - rect.left + 10) + "px";
                    tooltip.style.top = (e.clientY - rect.top - 40) + "px";
                });

                path.addEventListener("mouseleave", function () {
                    this.style.fill = this.dataset.baseColor; // restore original
                    tooltip.style.display = "none";
                });
            });
        }
        

        const levelColors = {
            L0:'#01160a', L1:'#fe4a5d', L2:'#ffaa62', L3:'#ffd26e',
            L4:'#74c4d6', L5:'#a3d55f', L6:'#6bc04b', L7:'#00953b', L8:'#01160a'
        };
        const healthColors = ['#a3d55f','#00953b','#ffaa62','#fe4a5d'];

        function buildColumnData(levels, values, colorMap = null, fallbackColors = []) {
            return levels.map((lvl, i) => ({
                y: values[i] ?? 0,
                color: colorMap ? (colorMap[lvl] || '#000') : (fallbackColors[i] || '#000')
            }));
        }

        // Fitness Chart
        if (document.getElementById('fitnessChart')) {
            try {
                Highcharts.chart('fitnessChart', {
                    chart: { type: 'column' },
                    title: { text: 'Fitness Indicator' },
                    xAxis: { categories: fitnessLevels },
                    yAxis: [{
                        title: { text: 'Total Students' },
                        visible: true
                    },{
                        title: { text: 'Overall Average' },
                        opposite: true,
                        labels: { enabled: false }
                    }],
                    tooltip: {
                        shared: true,
                        crosshairs: true
                    },
                    noData: {
                        style: { fontWeight: 'bold', fontSize: '15px', color: '#303030' }
                    },
                    series: [
                        { 
                            name: 'Total Students', 
                            data: buildColumnData(fitnessLevels, fitnessData, levelColors),
                            type: 'column'
                        },
                        { 
                            name: 'Overall Average', 
                            type: 'spline', 
                            data: fitnessAvg, 
                            yAxis: 1, 
                            color: '#434348',
                            marker: { enabled: true }
                        }
                    ]
                });
            } catch (error) {
                console.error('Fitness Chart Error:', error);
                document.getElementById('fitnessChart').innerHTML = '<div class="map-error">Error loading fitness chart</div>';
            }
        }

        // Health Chart
        if (document.getElementById('healthChart')) {
            try {
                Highcharts.chart('healthChart', {
                    chart: { type: 'column' },
                    title: { text: 'Health Indicator' },
                    xAxis: { categories: healthLevels },
                    yAxis: [{
                        title: { text: 'Total Students' },
                        visible: true
                    },{
                        title: { text: 'Overall Average' },
                        opposite: true,
                        labels: { enabled: false }
                    }],
                    tooltip: {
                        shared: true,
                        crosshairs: true
                    },
                    series: [
                        { 
                            name: 'Total Students', 
                            data: buildColumnData(healthLevels, healthData, null, healthColors),
                            type: 'column'
                        },
                        { 
                            name: 'Overall Average', 
                            type: 'spline', 
                            data: healthAvg, 
                            yAxis: 1, 
                            color: '#434348',
                            marker: { enabled: true }
                        }
                    ]
                });
            } catch (error) {
                console.error('Health Chart Error:', error);
                document.getElementById('healthChart').innerHTML = '<div class="map-error">Error loading health chart</div>';
            }
        }

        // Skill Chart
        if (document.getElementById('spiderChart')) {
            try {
                Highcharts.chart('spiderChart', {
                    chart: {
                        polar: true,
                        type: 'area',
                    },

                    title: {
                        text: 'Skill Analysis',
                        style: {
                            fontSize: '18px',
                            fontWeight: 'bold',
                        }
                    },

                    pane: {
                        size: '85%'
                    },

                    xAxis: {
                        categories: skillCategories,
                        tickmarkPlacement: 'on',
                        lineWidth: 0,
                        labels: {
                            style: {
                                fontSize: '13px',
                                color: '#555'
                            }
                        }
                    },

                    yAxis: {
                        min: 0,
                        gridLineInterpolation: 'polygon',
                        lineWidth: 0,
                        labels: {
                            style: {
                                fontSize: '11px',
                                color: '#666'
                            }
                        }
                    },

                    legend: {
                        enabled: true,
                        itemStyle: {
                            fontSize: '12px',
                            color: '#333'
                        }
                    },

                    plotOptions: {
                        series: {
                            fillOpacity: 0.25,  // slightly more visible
                            lineWidth: 3,
                            marker: {
                                radius: 5
                            },
                            dataLabels: {
                                enabled: true,
                                style: {
                                    fontSize: '12px',
                                    textOutline: 'none',
                                    color: '#222'
                                }
                            },
                            pointPlacement: 'on'
                        }
                    },

                    tooltip: {
                        shared: true,
                        backgroundColor: '#fff',
                        borderColor: '#999',
                        borderRadius: 5,
                        style: {
                            color: '#000'
                        }
                    },

                    series: skillSeries
                });
            } catch (error) {
                console.error('Skill Chart Error:', error);
                document.getElementById('spiderChart').innerHTML = '<div class="map-error">Error loading skill chart</div>';
            }
        }
        
    });
</script>

@endsection