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
                    <div class="">
                        <div class="">
                            <div class="home-tab">
                                <div class="">
                                    <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                                        <div class="row">
                                            <div class="card-body">
                                                <div class="col-lg-12 grid-margin stretch-card">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h4 class="card-title">Student Score List</h4>
                                                            <div class="row">
                                                                <form action="./student_list.php?assignment_id=<?php $_GET["assignment_id"]; ?>" method="get">
                                                                    <div class="form-group row">
                                                                        <div class="col-sm-9">
                                                                            <input type="text" name="student_name" class="form-control" placeholder="Search Student Name" onblur="this.form.submit()" id="student_name">
                                                                            <input type="hidden" name="assignment_id" value="<?php echo $_GET["assignment_id"]; ?>">
                                                                        </div>
                                                                        <div class="col-sm-3">
                                                                            <a href="./student_list.php?assignment_id=<?php echo $_GET["assignment_id"]; ?>" class="btn btn-outline-danger col-md-12">Reset</a>
                                                                        </div>
                                                                </form>
                                                            </div>
                                                            <div id="notification"></div>

                                                            <div class="table-responsive">
                                                                <table class="table table-hover">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Student Name</th>
                                                                            <th>Email</th>
                                                                            <th>Score</th>
                                                                            <th>Percentage (%)</th>
                                                                            <th>Date / Time</th>
                                                                            <th>Action(s)</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php
                                                                        $student_name = @$_GET['student_name'];
                                                                        $get_assignment = $_GET["assignment_id"];
                                                                        $attendies = mysqli_query($conn, "SELECT * FROM link");
                                                                        while ($row = mysqli_fetch_array($attendies)) {
                                                                            $link_email = $row['email'];
                                                                            $user_select = mysqli_query($conn, "SELECT * FROM user_data WHERE email = '$link_email'");
                                                                            while ($row = mysqli_fetch_array($user_select)) {
                                                                                $attandie_username = $row['username'];
                                                                                $attandie_email = $row['email'];
                                                                            }
                                                                            if ($student_name) {
                                                                                $qurey3 = mysqli_query($conn, "SELECT * FROM `answers` WHERE assignment_id = '$get_assignment' AND user_email LIKE '%$student_name%'");
                                                                                $count = mysqli_num_rows($qurey3);
                                                                            } else {
                                                                                $qurey3 = mysqli_query($conn, "SELECT * FROM `answers` WHERE assignment_id = '$get_assignment' AND user_email = '$attandie_email'");
                                                                                $count = mysqli_num_rows($qurey3);
                                                                            }
                                                                            if ($count == 0) {
                                                                                echo '<h5 class="m-4">No user Found!</h5>';
                                                                            } else {
                                                                                while ($rows = mysqli_fetch_array($qurey3)) {
                                                                                    $assignment_id = $rows['assignment_id'];
                                                                                    $answer_by_user = $rows['answer_by_user'];
                                                                                    $correct_answer = $rows['correct_answer'];
                                                                                    $created_at = $rows['created_at'];
                                                                                    @++$total;
                                                                                    if ($answer_by_user == $correct_answer) {
                                                                                        @++$score;
                                                                                    }
                                                                                }
                                                                                $percentage = ($score / $total) * 100; // 20
                                                                                $percentage = round($percentage, 2);
                                                                                echo '<tr>
                                                                                <td>' . $attandie_username . '</td>
                                                                                <td>' . $attandie_email . '</td>
                                                                                <td>' . $score . '/' . $total . '</td>
                                                                                <td>' . $percentage . '%</td>
                                                                                <td><label class="badge badge-danger">' . $created_at . '</label></td>
                                                                                <td>
                                                                                <a href="./assignment_checked.php?assignment_id=' . $assignment_id . '&&email=' . $link_email . '"><button class="col-md-12 text-white btn btn-primary">View Student Answers</button></a>
                                                                                </td>
                                                                                </tr>';
                                                                            }
                                                                        }
                                                                        ?>
                                                                        <script>
                                                                            function doConfirm(id) {

                                                                                var ok = confirm("Are you sure to Delete?")
                                                                                if (ok) {

                                                                                    var xmlhttp = new XMLHttpRequest();
                                                                                    xmlhttp.onreadystatechange = function() {
                                                                                        if (this.readyState == 4 && this.status == 200) {
                                                                                            document.getElementById("notification").innerHTML = this.responseText;
                                                                                        }
                                                                                    };
                                                                                    xmlhttp.open("GET", "./helpers/delete_post.php?id=" + id);
                                                                                    xmlhttp.send();
                                                                                }
                                                                            }
                                                                        </script>
                                                                    </tbody>
                                                                </table>
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
            <?php include('./components/footer.php') ?>
            <?php include('./components/scripts.php') ?>