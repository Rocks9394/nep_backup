@extends('admin.layouts.app')
@section('title', 'Goforfit - Admin Dashboard')

@section('content')

    <style>
        .gradient-green {
            background: #039a48;
        }

        .gradient-orange {
            background: #ffcb08;
        }

        .gradient-blue {
            background: #007ec6;
        }

        .card-title {
            font-size: 1rem;
            text-transform: uppercase;
        }

        .counter {
            font-size: 2.5rem;
            font-weight: 700;
        }
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
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
              <!-- Small boxes (Stat box) -->
              <div class="row">
                <div class="col-lg-4 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3 class="counter" data-target="{{ $regSchools }}">0</h3>
                            <p>Registered Schools</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-school"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3 class="counter" data-target="{{ $regTrainers }}">0</h3>
                            <p>Registered Trainers</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-tie"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3 class="counter" data-target="{{ $totalStudents }}">0</h3>
                            <p>Total Students</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                </div>
              </div>

              <!-- Charts -->
              <div class="row g-3">
                <div class="col-12 col-md-4">
                    <div class="card shadow p-2" style="height:300px;">
                        <div class="card-header fw-bold">School Completion Status</div>
                        <div class="card-body p-2">
                            <canvas id="schoolStatusChart"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-4">
                    <div class="card shadow p-2" style="height:300px;">
                        <div class="card-header fw-bold">Student Completion Status</div>
                        <div class="card-body p-2">
                            <canvas id="studentSummaryChart"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-4">
                    <div class="card shadow p-2" style="height:300px;">
                        <div class="card-header fw-bold">Top 5 Schools by Status</div>
                        <div class="card-body p-2">
                            <canvas id="topSchoolsChart"></canvas>
                        </div>
                    </div>
                </div>
              </div>
              <div class="row g-2">
                <div class="col-12 col-md-6">
                  <div class="card shadow p-2" style="height:300px;">   
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span class="fw-bold">Fitness Indicator</span>

                        <select id="skillFilter" class="form-select form-select-sm" style="width: 180px; margin-left:120px;">
                            <option value="">All Skills</option>
                            @foreach ($categories as $skill)
                                <option value="{{ $skill }}">{{ $skill }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="card-body p-2">
                        <canvas id="skillLevelChart"></canvas>
                    </div>
                  </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="card shadow p-2" style="height:300px;">
                        <div class="card-header fw-bold">Health Indicatior</div>
                        <div class="card-body p-2">
                            <canvas id="healthSummaryChart"></canvas>
                        </div>
                    </div>
                </div>
              </div>
            </div>
        </section>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {

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
                {{ $completedSchools ?? 0 }},
                {{ $ongoingSchools ?? 0 }},
                {{ $yetToStartSchools ?? 0 }}
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
                            {{ $totalStudents }},
                            {{ $totalCompleted }},
                            {{ $totalOngoing }},
                            {{ $totalYetToStart }}
                        ],
                        backgroundColor: ['#396afc', '#28a745', '#ffcb08', '#ec0000']
                    }]
                },
                options: {
                  responsive: true,
                  maintainAspectRatio: false,
                  plugins: {
                      legend: {
                          display: false
                      }
                  },
                  scales: {
                    x: {
                      beginAtZero: true,
                      ticks: {
                          font: {
                              size: 10
                          }
                      }
                    },
                    y: {
                      beginAtZero: true,
                      ticks: {
                          font: {
                              size: 10
                          }
                      }
                    },

                  },
                }
            });

            // health summury 

            const healthData = @json($healthData);

            new Chart(document.getElementById('healthSummaryChart'), {
                type: 'bar',
                data: {
                    labels: healthData.map(item => item.LEVEL),
                    datasets: [{
                        label: 'Students',
                        data: healthData.map(item => item.Total_Student),
                        backgroundColor: ['#396afc', '#28a745', '#ffcb08', '#ec0000']
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        x: {
                            beginAtZero: true,
                            ticks: {
                                font: {
                                    size: 10
                                }
                            }
                        },
                        y: {
                            beginAtZero: true,
                            ticks: {
                                font: {
                                    size: 10
                                }
                            }
                        }
                    }
                }
            });

            // fitness chart data 
            const levelNames = @json($levelNames);
            const matrix = @json($matrix); 
            const categories = @json($categories);
            const levelColors = @json($levelColors);

            let chart;
            function getData(selectedSkill) {
                if (!selectedSkill) {
                    return levelNames.map(level => {
                        let total = 0;
                        categories.forEach(skill => {
                            total += (matrix[skill]?.[level] || 0);
                        });
                        return total;
                    });
                }
                return levelNames.map(level => {
                    return (matrix[selectedSkill]?.[level] || 0);
                });
            }

            function renderChart(selectedSkill = '') {

                const dataValues = getData(selectedSkill);

                const ctx = document.getElementById('skillLevelChart');

                if (chart) {
                    chart.data.datasets[0].data = dataValues;
                    chart.update();
                    return;
                }

                chart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: levelNames,
                        datasets: [{
                            label: 'Students',
                            data: dataValues,
                            backgroundColor: levelNames.map(l => levelColors[l] || '#000')
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            x: {
                                title: {
                                    display: true,
                                    text: 'Levels (L0 - L8)'
                                },
                                ticks: {
                                    font: { size: 12 }
                                }
                            },
                            y: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'Students'
                                },
                                ticks: {
                                    font: { size: 12 }
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                display: false
                            }
                        }
                    }
                });
            }

            renderChart();
            document.getElementById('skillFilter').addEventListener('change', function () {
                renderChart(this.value);
            });
            

            const allSchools = @json($topSchools);

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
                        x: {
                            beginAtZero: true
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
                                generateLabels: function() {
                                    return [{
                                            text: 'Completed',
                                            fillStyle: '#28a745'
                                        },
                                        {
                                            text: 'Ongoing',
                                            fillStyle: '#ffcb08'
                                        },
                                        {
                                            text: 'Yet To Start',
                                            fillStyle: '#ec0000'
                                        }
                                    ];
                                }
                            },
                            onClick: function(e, legendItem) {

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
@endsection
