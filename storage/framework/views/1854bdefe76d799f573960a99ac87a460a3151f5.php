<?php $__env->startSection('title', 'Goforfit - Admin Dashboard'); ?>

<?php $__env->startSection('content'); ?>


<style>
    .card-modern {
        border: none;
        border-radius: 18px;
        padding: 25px;
        color: white;
        box-shadow: 0 10px 25px rgba(0,0,0,0.08);
        transition: 0.3s ease-in-out;
    }
    .card-modern:hover {
        transform: translateY(-5px);
    }
    .gradient-green { background: #039a48; }
    .gradient-orange { background: #ffcb08; }
    .gradient-blue { background: #007ec6; }
    .card-title { font-size: 1rem; text-transform: uppercase; }
    .counter { font-size: 2.5rem; font-weight: 700; }
</style>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li>             
			        <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <section class="content">
      <div class="container-fluid">
        <div class="col pt-4 pb-4">
          <!-- TOP CARDS -->
          <div class="row g-3 mb-4 text-center">

            <div class="col-12 col-md-4">
              <div class="card-modern gradient-green text-center">
                  <div class="card-title">Registered Schools</div>
                  <div class="counter" data-target="<?php echo e($regSchools); ?>">0</div>
              </div>
            </div>

            <div class="col-12 col-md-4">
              <div class="card-modern gradient-orange text-center">
                  <div class="card-title">Registered Trainers</div>
                  <div class="counter" data-target="<?php echo e($regTrainers); ?>">0</div>
              </div>
            </div>

            <div class="col-12 col-md-4">
              <div class="card-modern gradient-blue text-center">
                  <div class="card-title">Registered Students</div>
                  <div class="counter" data-target="<?php echo e($totalStudents); ?>">0</div>
              </div>
            </div>
          </div>

          <!-- CHARTS -->
          <div class="row g-3">
              <div class="col-12 col-md-4">
                <div class="card shadow p-2" style="height:350px;">
                    <div class="card-header fw-bold">School Completion Status</div>
                    <div class="card-body p-2">
                        <canvas id="schoolStatusChart"></canvas>
                    </div>
                </div>
              </div>

              <div class="col-12 col-md-4">
                <div class="card shadow p-2" style="height:350px;">
                    <div class="card-header fw-bold">Student Completion Status</div>
                    <div class="card-body p-2">
                        <canvas id="studentSummaryChart"></canvas>
                    </div>
                </div>
              </div>

              <div class="col-12 col-md-4">
                <div class="card shadow p-2" style="height:350px;">
                    <div class="card-header fw-bold">Top 5 Schools by Status</div>
                    <div class="card-body p-2">
                        <canvas id="topSchoolsChart"></canvas>
                    </div>
                </div>
              </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    //  Animate Counters 
    const counters = document.querySelectorAll('.counter');
    counters.forEach(counter => {
        const updateCount = () => {
            const target = +counter.getAttribute('data-target');
            const count = +counter.innerText.replace(/,/g, '');
            const increment = Math.ceil(target / 100);

            if (count < target) {
                const newCount = count + increment;
                counter.innerText = newCount.toLocaleString();
                setTimeout(updateCount, 20);
            } else {
                counter.innerText = target.toLocaleString();
            }
        };
        updateCount();
    });

    const doughnutData = [
        <?php echo e($completedSchools ?? 0); ?>,
        <?php echo e($ongoingSchools ?? 0); ?>,
        <?php echo e($yetToStartSchools ?? 0); ?>

    ];

    new Chart(document.getElementById('schoolStatusChart'), {
        type: 'doughnut',
        data: {
            labels: ['Completed', 'Ongoing', 'Yet To Start'],
            datasets: [{
                data: doughnutData,
                backgroundColor: ['#396afc', '#ffcb08', '#ec0000'],
                hoverOffset: 10
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            layout: {
                padding: {
                    top: 10,
                    bottom: 20,
                }
            },
            plugins: { 
                legend: { 
                    display: true,
                    position: 'bottom', 
                    labels: { 
                        boxWidth: 15, 
                        boxHeight: 12, 
                        padding: 12,
                    }
                }
            }
        }
    });

    // STUDENT SUMMARY BAR
    new Chart(document.getElementById('studentSummaryChart'), {
        type: 'bar',
        data: {
            labels: ['Total', 'Completed', 'Ongoing', 'Yet To Start'],
            datasets: [{
                label: 'Students',
                data: [
                    <?php echo e($totalStudents); ?>,
                    <?php echo e($totalCompleted); ?>,
                    <?php echo e($totalOngoing); ?>,
                    <?php echo e($totalYetToStart); ?>

                ],
                backgroundColor: ['#396afc', '#28a745', '#ffcb08', '#ec0000']
            }]
        },
        options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true } } }
    });

    const allSchools = <?php echo json_encode($topSchools, 15, 512) ?>;

    function getTop5(type) {
        return [...allSchools]
            .sort((a, b) => b[type] - a[type])
            .slice(0, 5);
    }

    function prepareData(type) {
        const top5 = getTop5(type);

        return {
            labels: top5.map(item => item.school_code),
            data: top5.map(item => item[type])
        };
    }

    const colors = {
        completed: '#28a745',
        ongoing: '#ffcb08',
        yet_to_start: '#ec0000'
    };

    // Default = Completed
    let currentType = 'completed';
    let initialData = prepareData(currentType);

    const topChart = new Chart(document.getElementById('topSchoolsChart'), {
        type: 'bar',
        data: {
            labels: initialData.labels,
            datasets: [{
                label: 'Top 5 Completed',
                data: initialData.data,
                backgroundColor: colors[currentType]
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            indexAxis: 'y',
            scales: {
                x: { beginAtZero: true }
            },
            plugins: {
                legend: {
                    display: true,
                    position: 'bottom',
                    labels: {
                        boxWidth: 15,
                        boxHeight: 12,
                        padding: 12,
                        generateLabels: function () {
                            return [
                                { text: 'Completed', fillStyle: '#28a745' },
                                { text: 'Ongoing', fillStyle: '#ffcb08' },
                                { text: 'Yet To Start', fillStyle: '#ec0000' }
                            ];
                        }
                    },
                    onClick: function (e, legendItem) {

                        let type = 'completed';
                        if (legendItem.text === 'Ongoing') type = 'ongoing';
                        if (legendItem.text === 'Yet To Start') type = 'yet_to_start';

                        const newData = prepareData(type);

                        topChart.data.labels = newData.labels;
                        topChart.data.datasets[0].data = newData.data;
                        topChart.data.datasets[0].backgroundColor = colors[type];
                        topChart.data.datasets[0].label = 'Top 5 ' + legendItem.text;

                        topChart.update();
                    }
                }
            }
        }
    });

});
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\nep\resources\views/admin/home.blade.php ENDPATH**/ ?>