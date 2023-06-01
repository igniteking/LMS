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
                                                            <h4 class="card-title">Training Program List</h4>
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
                                                                        $student_name = @$_GET['registration_details'];
                                                                        $get_assignment = @$_GET["assignment_id"];
                                                                        $attendies = mysqli_query($conn, "SELECT * FROM registration");
                                                                        while ($rows = mysqli_fetch_array($attendies)) {
                                                                            $id = $rows['id'];
                                                                            $full_name = $rows['full_name'];
                                                                            $newemail = $rows['email'];
                                                                            $gender = $rows['gender'];
                                                                            $inter_background_subject = $rows['inter_background_subject'];
                                                                            $course = $rows['course'];
                                                                            $created_at = $rows['created_at'];
                                                                            echo '<tr>
                                                                                <td>' . $full_name . '</td>
                                                                                <td>' . $newemail . '</td>
                                                                                <td>' . $inter_background_subject . '</td>
                                                                                <td>' . $course . '</td>
                                                                                <td><label class="badge badge-danger">' . $created_at . '</label></td>
                                                                                <td>
                                                                                    <a href="./form_preview.php?assignment_id=' . $id . '"><button class="col-md-12 text-white btn btn-primary">View Registration Details</button></a>
                                                                                </td>
                                                                            </tr>';
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
                <?php include('./components/footer.php') ?>
                <?php include('./components/scripts.php') ?>