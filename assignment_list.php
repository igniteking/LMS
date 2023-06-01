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
                                                            <h4 class="card-title">Assignment List</h4>
                                                            <div class="row">
                                                                <form action="./assignment_list.php" method="get">
                                                                    <div class="form-group row">
                                                                        <div class="col-sm-9">
                                                                            <input type="text" name="project_name" class="form-control" placeholder="Search Assignment Name" onblur="this.form.submit()" id="client_name">
                                                                        </div>
                                                                        <div class="col-sm-3">
                                                                            <a href="./assignment_list.php" class="btn btn-outline-danger col-md-12">Reset</a>
                                                                        </div>
                                                                </form>
                                                            </div>
                                                            <div id="notification"></div>

                                                            <div class="table-responsive">
                                                                <table class="table table-hover">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Title</th>
                                                                            <th>Description</th>
                                                                            <th>Number of Questions</th>
                                                                            <th>PDF</th>
                                                                            <th>Date / Time</th>
                                                                            <th>Action(s)</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php
                                                                        $project_name = @$_GET['project_name'];
                                                                        if ($project_name) {
                                                                            $get_client = mysqli_query($conn, "SELECT * FROM assignment WHERE assignment_title LIKE '%$project_name%'");
                                                                            $count = mysqli_num_rows($get_client);
                                                                        } else {
                                                                            $get_client = mysqli_query($conn, "SELECT * FROM assignment ORDER BY assignment_id DESC");
                                                                            $count = mysqli_num_rows($get_client);
                                                                        }
                                                                        while ($row = mysqli_fetch_array($get_client)) {
                                                                            $assignment_id = $row['assignment_id'];
                                                                            $assignment_title = $row['assignment_title'];
                                                                            $assignment_description = $row['assignment_description'];
                                                                            $assignment_question_number = $row['assignment_question_number'];
                                                                            $assignment_pdf = $row['assignment_pdf'];
                                                                            @$files = (scandir($assignment_pdf))[2];
                                                                            $created_at = $row['created_at'];
                                                                            if ($count = 0) {
                                                                                echo 'No user Found!';
                                                                            } else {
                                                                                echo '<tr>
                                                                                <td>' . $assignment_title . '</td>
                                                                                <td>' . $assignment_description . '</td>
                                                                                <td>' . $assignment_question_number . '</td>
                                                                                <td><a href="' . $assignment_pdf . '/' . $files . '">' . $files . '</td>
                                                                                <td><label class="badge badge-danger">' . $created_at . '</label></td>
                                                                                <td>
                                                                                <a href="./edit_question.php?assignment_id=' . $assignment_id . '"><button class="col-md-3 text-white btn btn-success">Edit Question</button></a>
                                                                                <a href="./student_list.php?assignment_id=' . $assignment_id . '"><button class="col-md-3 text-white btn btn-warning">View Student List</button></a>
                                                                                '; ?>
                                                                                <button type="submit" class="col-md-3 text-white btn btn-danger" onclick="doConfirm(<?php echo $assignment_id; ?>);">Delete Assignemnt</button>
                                                                        <?php echo '</td>
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