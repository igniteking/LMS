<?php include('./connections/connection.php'); ?>
<?php include('./connections/global.php'); ?>
<?php include('./connections/functions.php'); ?>
<?php include('./components/header.php'); ?>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <?php include('./components/navbar.php'); ?>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            <?php include('./components/sidebar.php'); ?>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="home-tab">
                                <div class="tab-content tab-content-basic">
                                    <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="statistics-details d-flex align-items-center justify-content-between">
                                                    <div>
                                                        <p class="statistics-title">Total Assignments</p>
                                                        <h3 class="rate-percentage"><?php
                                                                                    $fetch = mysqli_query($conn, "SELECT * FROM `assignment`");
                                                                                    echo $count = mysqli_num_rows($fetch);
                                                                                    ?></h3>
                                                        <p class="text-success d-flex"><i class="mdi mdi-menu-up"></i><span>0.<?= $count ?>%</span></p>
                                                    </div>
                                                    <div>
                                                        <p class="statistics-title">Total Students</p>
                                                        <h3 class="rate-percentage"><?php
                                                                                    $fetch = mysqli_query($conn, "SELECT * FROM `user_data` WHERE user_type = 'user'");
                                                                                    echo $count = mysqli_num_rows($fetch);
                                                                                    ?></h3>
                                                        <p class="text-success d-flex"><i class="mdi mdi-menu-up"></i><span>+0.<?= $count ?>%</span></p>
                                                    </div>
                                                    <div class="d-none d-md-block">
                                                        <p class="statistics-title">Total Questions</p>
                                                        <h3 class="rate-percentage"><?php
                                                                                    $fetch = mysqli_query($conn, "SELECT * FROM `questions`");
                                                                                    echo $count = mysqli_num_rows($fetch);
                                                                                    ?></h3>
                                                        <p class="text-success d-flex"><i class="mdi mdi-menu-up"></i><span>+0.<?= $count ?>%</span></p>
                                                    </div>
                                                    <div class="d-none d-md-block">
                                                        <p class="statistics-title">Today's Assessment</p>
                                                        <h3 class="rate-percentage"><?php
                                                                                    $created_at = date('Y-m-d H:i:s');
                                                                                    $fetch = mysqli_query($conn, "SELECT * FROM `assignment` WHERE created_at = '$created_at'");
                                                                                    echo $count = mysqli_num_rows($fetch);
                                                                                    ?></h3>
                                                        <p class="text-success d-flex"><i class="mdi mdi-menu-up"></i><span>+0.<?= $count ?>%</span></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 d-flex flex-column">
                                                <div class="row flex-grow">
                                                    <div class="col-12 col-lg-4 col-lg-12 grid-margin stretch-card">
                                                        <div class="card card-rounded">
                                                            <div class="card-body">
                                                                <div class="d-sm-flex justify-content-between align-items-start">
                                                                    <div>
                                                                        <h4 class="card-title card-title-dash">Question Line Chart</h4>
                                                                        <h5 class="card-subtitle card-subtitle-dash">Total Questions VS Assignement</h5>
                                                                    </div>
                                                                    <div id="performance-line-legend"></div>
                                                                </div>
                                                                <div class="chartjs-wrapper mt-5">
                                                                    <canvas id="performaneLine"></canvas>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                    (function($) {
                        'use strict';
                        $(function() {
                            if ($("#performaneLine").length) {
                                var graphGradient = document.getElementById("performaneLine").getContext('2d');
                                var saleGradientBg = graphGradient.createLinearGradient(5, 0, 5, 100);
                                saleGradientBg.addColorStop(0, 'rgba(26, 115, 232, 0.18)');
                                saleGradientBg.addColorStop(1, 'rgba(26, 115, 232, 0.02)');
                                var salesTopData = {
                                    labels: [<?php
                                                $get_assignments = mysqli_query($conn, "SELECT * FROM `assignment` ORDER BY `assignment_id` DESC");
                                                while ($rows = mysqli_fetch_array($get_assignments)) {
                                                    $assignment_title = $rows['assignment_title'];
                                                    echo '"' . "$assignment_title" . '",';
                                                }
                                                ?>],
                                    datasets: [{
                                        label: 'Questions',
                                        data: [<?php
                                                $get_assignments = mysqli_query($conn, "SELECT * FROM `assignment` ORDER BY `assignment_id` DESC");
                                                while ($rows = mysqli_fetch_array($get_assignments)) {
                                                    $assignment_id  = $rows['assignment_id'];
                                                    $questions = mysqli_query($conn, "SELECT * FROM `questions` WHERE `reference_id` = '$assignment_id'");
                                                    echo $count = mysqli_num_rows($questions) . ',';
                                                }
                                                ?>],
                                        backgroundColor: saleGradientBg,
                                        borderColor: [
                                            '#1F3BB3',
                                        ],
                                        borderWidth: 1.5,
                                        fill: true, // 3: no fill
                                        pointBorderWidth: 1,
                                        pointRadius: [4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4],
                                        pointHoverRadius: [2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2],
                                        pointBackgroundColor: ['#1F3BB3)', '#1F3BB3', '#1F3BB3', '#1F3BB3', '#1F3BB3)', '#1F3BB3', '#1F3BB3', '#1F3BB3', '#1F3BB3)', '#1F3BB3', '#1F3BB3', '#1F3BB3', '#1F3BB3)'],
                                        pointBorderColor: ['#fff', '#fff', '#fff', '#fff', '#fff', '#fff', '#fff', '#fff', '#fff', '#fff', '#fff', '#fff', '#fff', ],
                                    }]
                                };

                                var salesTopOptions = {
                                    responsive: true,
                                    maintainAspectRatio: false,
                                    scales: {
                                        yAxes: [{
                                            gridLines: {
                                                display: true,
                                                drawBorder: false,
                                                color: "#F0F0F0",
                                                zeroLineColor: '#F0F0F0',
                                            },
                                            ticks: {
                                                beginAtZero: false,
                                                autoSkip: true,
                                                maxTicksLimit: 4,
                                                fontSize: 10,
                                                color: "#6B778C"
                                            }
                                        }],
                                        xAxes: [{
                                            gridLines: {
                                                display: false,
                                                drawBorder: false,
                                            },
                                            ticks: {
                                                beginAtZero: false,
                                                autoSkip: true,
                                                maxTicksLimit: 7,
                                                fontSize: 10,
                                                color: "#6B778C"
                                            }
                                        }],
                                    },
                                    legend: false,
                                    legendCallback: function(chart) {
                                        var text = [];
                                        text.push('<div class="chartjs-legend"><ul>');
                                        for (var i = 0; i < chart.data.datasets.length; i++) {
                                            console.log(chart.data.datasets[i]); // see what's inside the obj.
                                            text.push('<li>');
                                            text.push('<span style="background-color:' + chart.data.datasets[i].borderColor + '">' + '</span>');
                                            text.push(chart.data.datasets[i].label);
                                            text.push('</li>');
                                        }
                                        text.push('</ul></div>');
                                        return text.join("");
                                    },

                                    elements: {
                                        line: {
                                            tension: 0.4,
                                        }
                                    },
                                    tooltips: {
                                        backgroundColor: 'rgba(31, 59, 179, 1)',
                                    }
                                }
                                var salesTop = new Chart(graphGradient, {
                                    type: 'line',
                                    data: salesTopData,
                                    options: salesTopOptions
                                });
                                document.getElementById('performance-line-legend').innerHTML = salesTop.generateLegend();
                            }
                        });
                    })(jQuery);
                </script>
                <?php include('./components/footer.php') ?>
                <?php include('./components/scripts.php') ?>