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
                                                            <h4 class="card-title">Student List</h4>
                                                            <div class="row">
                                                                <form action="./user_list.php" method="get">
                                                                    <div class="form-group row">
                                                                        <div class="col-sm-9">
                                                                            <input type="text" name="student_name" class="form-control" placeholder="Search Student Name" onblur="this.form.submit()" id="student_name">
                                                                        </div>
                                                                        <div class="col-sm-3">
                                                                            <a href="./user_list.php" class="btn btn-outline-danger col-md-12">Reset</a>
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
                                                                            <th>Phone</th>
                                                                            <th>Date / Time</th>
                                                                            <th>Action(s)</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php
                                                                        $student_name = @$_GET['student_name'];
                                                                        if ($student_name) {
                                                                            $get_client = mysqli_query($conn, "SELECT * FROM user_data WHERE username LIKE '%$student_name%' AND user_type = 'user'");
                                                                            $count = mysqli_num_rows($get_client);
                                                                        } else {
                                                                            $get_client = mysqli_query($conn, "SELECT * FROM user_data WHERE user_type = 'user'");
                                                                            $count = mysqli_num_rows($get_client);
                                                                        }
                                                                        while ($row = mysqli_fetch_array($get_client)) {
                                                                            $user_id = $row['id'];
                                                                            $username = $row['username'];
                                                                            $email = $row['email'];
                                                                            $phone = $row['phone'];
                                                                            $created_at = $row['created_at'];
                                                                            if ($count = 0) {
                                                                                echo 'No user Found!';
                                                                            } else {
                                                                                echo '<tr>
                                                                                <td>' . $username . '</td>
                                                                                <td>' . $email . '</td>
                                                                                <td>' . $phone . '</td>
                                                                                <td><label class="badge badge-danger">' . $created_at . '</label></td>
                                                                                <td>
                                                                                '; ?>
                                                                                <button type="submit" class="col-md-12 text-white btn btn-danger" onclick="doConfirm(<?php echo $user_id; ?>);">Delete Student</button>
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
                                                                                    xmlhttp.open("GET", "./helpers/delete_user.php?id=" + id);
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