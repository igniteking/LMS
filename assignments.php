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
                                            <?php
                                            $get_assignments = mysqli_query($conn, "SELECT * FROM `assignment` ORDER BY `assignment_id` DESC");
                                            while ($rows = mysqli_fetch_array($get_assignments)) {
                                                $assignment_id  = $rows['assignment_id'];
                                                $assignment_title = $rows['assignment_title'];
                                                $assignment_description = $rows['assignment_description'];
                                                $assignment_question_number = $rows['assignment_question_number'];
                                                $assignment_start_time = $rows['assignment_start_time'];
                                                $assignment_end_time = $rows['assignment_end_time'];
                                                $created_at = $rows['created_at'];
                                                $fetch = mysqli_query($conn, "SELECT * FROM `answers` WHERE assignment_id = '$assignment_id'");
                                                $count = mysqli_num_rows($fetch);
                                                if ($count > 0) {
                                                    echo '
                                                    <div class="align-content-center col-md-4">
                                                    <div class="review-card p-2 bg-white rounded">
                                                    <a href="./assignment_checked.php?assignment_id=' . $assignment_id . '" style="all: unset;">
                                                        <div class="text-right"><img src="https://i.imgur.com/rL9jvBE.png" width="30"></div>
                                                        <div class="d-flex mt-0 p-2"><img src="https://i.imgur.com/9Ba2m5C.png">
                                                            <div class="ml-1 mt-2">
                                                                <h6 class="crop-text mb-0">' . $assignment_title . '</h6>
                                                                <div class="mt-2"><span class="text-black-50 num-reviews">' . $assignment_title . '</span></div>
                                                            </div>
                                                        </div>
                                                        <div class="px-4 rating-box mb-3">
                                                            <div class="border rounded">
                                                                <div class="text-center score py-2">
                                                                    <div class="rating-out"><span class="get-rating">' . $assignment_question_number . '</span></div>
                                                                    <div><span>Question</span></div>
                                                                </div>
                                                            </div>
                                                        </div></a>
                                                    </div>
                                                </div>';
                                                } else {
                                                    $start_date = substr("$assignment_start_time", 0, 10);
                                                    $start_time = substr("$assignment_start_time", 11, 6);
                                                    $end_date = substr("$assignment_end_time", 0, 10);
                                                    $end_time = substr("$assignment_end_time", 11, 6);
                                                    $end = $end_date . ' ' . $end_time;
                                                    $start = $start_date . ' ' . $start_time;
                                                    $current_datetime = date('Y-m-d H:i');
                                                    $newDate = date("d M Y h:i A", strtotime($start));
                                                    $endDate = date("d M Y h:i A", strtotime($end));
                                                    if ($current_datetime < $start) {
                                                        echo '
                                                    <div class="align-content-center col-md-4">
                                                    <a href="#" style="all: unset;">
                                                    <div class="review-card p-2 bg-warning rounded">
                                                        <div class="d-flex mt-0 p-2"><img src="https://i.imgur.com/9Ba2m5C.png">
                                                            <div class="ml-1 mt-2">
                                                                <h6 class="crop-text mb-0">' . $assignment_title . '</h6>
                                                                <div class="mt-2"><span class="text-black-50 num-reviews">' . $assignment_description . '</span></div>
                                                                <h5>Assignment Available At ' . $newDate . '</h5>
                                                            </div>
                                                        </div>
                                                        <div class="px-4 rating-box mb-3">
                                                            <div class="border rounded">
                                                                <div class="text-center score py-2">
                                                                    <div class="rating-out"><span class="get-rating">' . $assignment_question_number . '</span></div>
                                                                    <div><span>Questions</span></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </a>
                                                </div>';
                                                    } else if ($current_datetime == $start) {
                                                        echo '
                                                    <div class="align-content-center col-md-4">
                                                    <a href="./take_assignment.php?assignment_id=' . $assignment_id . '" style="all: unset;">
                                                    <div class="review-card p-2 bg-success rounded">
                                                        <div class="d-flex mt-0 p-2"><img src="https://i.imgur.com/9Ba2m5C.png">
                                                            <div class="ml-1 mt-2">
                                                                <h6 class="crop-text mb-0">' . $assignment_title . '</h6>
                                                                <div class="mt-2"><span class="text-black-50 num-reviews">' . $assignment_description . '</span></div>
                                                                <h5>Assignment Available At ' . $newDate . '</h5>
                                                            </div>
                                                        </div>
                                                        <div class="px-4 rating-box mb-3">
                                                            <div class="border rounded">
                                                                <div class="text-center score py-2">
                                                                    <div class="rating-out"><span class="get-rating">' . $assignment_question_number . '</span></div>
                                                                    <div><span>Questions</span></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </a>
                                                </div>';
                                                    } else if ($current_datetime >= $end) {
                                                        echo '
                                                        <div class="align-content-center col-md-4">
                                                        <a href="#" style="all: unset;">
                                                        <div class="review-card p-2 bg-danger rounded">
                                                            <div class="d-flex mt-0 p-2"><img src="https://i.imgur.com/9Ba2m5C.png">
                                                                <div class="ml-1 mt-2">
                                                                    <h6 class="crop-text mb-0">' . $assignment_title . '</h6>
                                                                    <div class="mt-2"><span class="text-black-50 num-reviews">' . $assignment_description . '</span></div>
                                                                <h5>Assignment Ended</h5>
                                                                </div>
                                                            </div>
                                                            <div class="px-4 rating-box mb-3">
                                                                <div class="border rounded">
                                                                    <div class="text-center score py-2">
                                                                        <div class="rating-out"><span class="get-rating">' . $assignment_question_number . '</span></div>
                                                                        <div><span>Questions</span></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        </a>
                                                    </div>';
                                                    } else if ($start <= $current_datetime) {
                                                        echo '
                                                    <div class="align-content-center col-md-4">
                                                    <a href="./take_assignment.php?assignment_id=' . $assignment_id . '" style="all: unset;">
                                                    <div class="review-card p-2 bg-success rounded">
                                                        <div class="d-flex mt-0 p-2"><img src="https://i.imgur.com/9Ba2m5C.png">
                                                            <div class="ml-1 mt-2">
                                                                <h6 class="crop-text mb-0">' . $assignment_title . '</h6>
                                                                <div class="mt-2"><span class="text-black-50 num-reviews">' . $assignment_description . '</span></div>
                                                                <h5>Assignment Ends At ' . $endDate . '</h5>
                                                            </div>
                                                        </div>
                                                        <div class="px-4 rating-box mb-3">
                                                            <div class="border rounded">
                                                                <div class="text-center score py-2">
                                                                    <div class="rating-out"><span class="get-rating">' . $assignment_question_number . '</span></div>
                                                                    <div><span>Questions</span></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </a>
                                                </div>';
                                                    }
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                    var myCustomScrollbar = document.querySelector('.my-custom-scrollbar');
                    var ps = new PerfectScrollbar(myCustomScrollbar);

                    var scrollbarY = myCustomScrollbar.querySelector('.ps__rail-y');

                    myCustomScrollbar.onscroll = function() {
                        scrollbarY.style.cssText = `top: ${this.scrollTop}px!important; height: 400px; right: ${-this.scrollLeft}px`;
                    }
                </script>
                <?php include('./components/footer.php') ?>
                <?php include('./components/scripts.php') ?>