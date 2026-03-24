
<?php $__env->startSection('title', 'Goforfit | ' . $title); ?>

<?php $__env->startSection('content'); ?>

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
        box-shadow: 0 2px 8px rgba(0,0,0,0.15);
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
</style>

<div class="container-fluid">
    <div class="t-mrg2 mb-5 pb-5 px-4">
        <div class="row">
            <div class="col-12 col-md">
                <div class="heading-rw mt-0 mt-md-1 mb-0 p-0">                
                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.back-button','data' => ['title' => ''.e($title).'']]); ?>
<?php $component->withName('back-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['title' => ''.e($title).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                </div>
            </div>
        </div>

        <div class="mt-3">
            <div class="row mt-4">
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
                                <?php echo file_get_contents(public_path('assets/uploads/map.svg')); ?>

                            </div>
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
                        <div id="skillChart" style="height: 400px;"></div>
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        
        const fitnessLevels  = <?php echo json_encode($letnenlevels, 15, 512) ?>;
        const fitnessData    = <?php echo json_encode($letnentotals, 15, 512) ?>;
        const fitnessAvg     = <?php echo json_encode($ranked_schoolsFitness, 15, 512) ?>;

        const healthLevels   = <?php echo json_encode($healthLevels, 15, 512) ?>;
        const healthData     = <?php echo json_encode($healthTotals, 15, 512) ?>;
        const healthAvg      = <?php echo json_encode($healthRankData, 15, 512) ?>;

        const skillCategories = <?php echo json_encode($categories, 15, 512) ?>;
        const skillSeries     = <?php echo json_encode($chartSeries, 15, 512) ?>;        
        const FitnessMap      = <?php echo json_encode($FitnessMap, 15, 512) ?>;

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

        const overallHealthData = { UW:0, N:0, OW:0, OB:0 };

        FitnessMap.forEach(state => {
            overallHealthData.UW += state.UW || 0;
            overallHealthData.N  += state.N  || 0;
            overallHealthData.OW += state.OW || 0;
            overallHealthData.OB += state.OB || 0;
        });
        if (document.getElementById('dd')) {
            try {
                // Health categories
                const healthCategories = ['UW', 'N', 'OW', 'OB'];
                const overallHealthData = { UW: 0, N: 0, OW: 0, OB: 0 };

                <?php echo json_encode($FitnessMap, 15, 512) ?>.forEach(state => {
                    overallHealthData.UW += state.UW || 0;
                    overallHealthData.N  += state.N  || 0;
                    overallHealthData.OW += state.OW || 0;
                    overallHealthData.OB += state.OB || 0;
                });

                const healthTotalsAllStates = healthCategories.map(cat => overallHealthData[cat]);

                const chartData = buildColumnData(healthCategories, healthTotalsAllStates, null, ['#a3d55f','#00953b','#ffaa62','#fe4a5d']);

                Highcharts.chart('dd', {
                    chart: { type: 'column' },
                    title: { text: 'Country Health Indicator' },
                    xAxis: { categories: healthCategories },
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
                            data: chartData,
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
                console.error('Overall Health Chart Error:', error);
                document.getElementById('dd').innerHTML = '<div class="map-error">Error loading overall health chart</div>';
            }
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
        if (document.getElementById('skillChart')) {
            try {
                Highcharts.chart('skillChart', {
                    chart: { type: 'bar' },
                    title: { text: 'Skill Analysis' },
                    xAxis: { categories: skillCategories },
                    yAxis: { min: 0, labels: { formatter() { return Math.round(this.value); } } },
                    legend: { enabled: false },
                    plotOptions: {
                        series: {
                            stacking: 'percent',
                            states: { inactive: { opacity: 1 } },
                            point: {
                                events: {
                                    mouseOver: function () {
                                        const chart = this.series.chart;
                                        chart.series.forEach((s) => {
                                            s.group.attr({ opacity: s.index === this.series.index ? 1 : 0.2 });
                                        });
                                    }
                                }
                            },
                            events: {
                                mouseOut: function () {
                                    this.chart.series.forEach(s => s.group.attr({ opacity: 1 }));
                                }
                            }
                        }
                    },
                    series: skillSeries
                });
            } catch (error) {
                console.error('Skill Chart Error:', error);
                document.getElementById('skillChart').innerHTML = '<div class="map-error">Error loading skill chart</div>';
            }
        }

        // India Map with multiple fallback options

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
            "Delhi": "INDL"
        };

        const stateData = {};

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

        const tooltip = document.getElementById("mapTooltip");

        document.querySelectorAll("#indiaMap svg path").forEach(path => {

            const code = path.id;
            const data = stateData[code];

            const colors = ['#fe4a5d','#ffaa62','#ffd26e','#74c4d6','#a3d55f','#6bc04b','#00953b'];

            function getBaseColor(schools) {
                if (!schools) return '#ddd'; 
                let index = Math.floor(schools / 50);
                if (index >= colors.length) index = colors.length - 1;
                return colors[index] + 'CC';
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
        console.log(stateData);
        
    });
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.filldart-app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\nep\resources\views/school/graph-dashboard.blade.php ENDPATH**/ ?>