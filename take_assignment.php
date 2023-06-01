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
                                            <div class="card col-md-6">
                                                <div class="card-body">
                                                    <div class="card-title">Questions</div>
                                                    <form action="./take_assignment.php?assignment_id=<?= $_GET["assignment_id"] ?>" method="POST">
                                                        <div class="form-group row">
                                                            <?php
                                                            $get_assignment = $_GET["assignment_id"];
                                                            if (@$_POST["submit_answers"]) {
                                                                $created_at = date('Y-m-d H:i:s');
                                                                $lin = mysqli_query($conn, "INSERT INTO `link`(`id`, `email`, `assignment_code`, `created_at`) VALUES (NULL,'$email','$get_assignment','$created_at')");
                                                            }
                                                            $qurey = mysqli_query($conn, "SELECT * FROM `assignment` WHERE assignment_id = '$get_assignment'");
                                                            while ($rows = mysqli_fetch_array($qurey)) {
                                                                $assignment_id  = $rows['assignment_id'];
                                                                $assignment_pdf = $rows['assignment_pdf'];
                                                                $files = (scandir($assignment_pdf))[2];
                                                                $qurey2 = mysqli_query($conn, "SELECT * FROM `questions` WHERE reference_id = '$assignment_id '");
                                                                while ($rows = mysqli_fetch_array($qurey2)) {
                                                                    $question_id = $rows['id'];
                                                                    $reference_id = $rows['reference_id'];
                                                                    $question_number = $rows['question_number'];
                                                                    $question_answer = $rows['question_answer'];
                                                                    $question_negitive_marks = $rows['question_negitive_marks'];
                                                                    $question_marks = $rows['question_marks'];
                                                                    $created_at = $rows['created_at'];
                                                                    @$i = 1 + $i;
                                                                    if (@$_POST['submit_answers']) {
                                                                        $answer_by_user = @$_POST['optionsRadios' . $question_id . ''];
                                                                        $created_at = date('Y-m-d H:i:s');
                                                                        if ($answer_by_user) {
                                                                            $answer = mysqli_query($conn, "INSERT INTO `answers`(`id`, `user_email`, `assignment_id`, `question_number`, `answer_by_user`, `correct_answer`, `created_at`) 
                                                                    VALUES (NULL,'$email','$get_assignment','$question_number','$answer_by_user','$question_answer','$created_at')");
                                                                            echo "<meta http-equiv=\"refresh\" content=\"0; url=./assignments.php\">";
                                                                        }
                                                                    }
                                                                    echo '
                                                                    <h6>Question ' . $i . '</h6>
                                                                    <div class="form-check col-md-3">
                                                                        <label class="form-check-label">
                                                                            <input type="radio" class="form-check-input" name="optionsRadios' . $question_id . '" id="optionsRadios' . $question_id . '" value="A">
                                                                                    A
                                                                                </label>
                                                                            </div>
                                                                            <div class="form-check col-md-3">
                                                                                <label class="form-check-label">
                                                                                    <input type="radio" class="form-check-input" name="optionsRadios' . $question_id . '" id="optionsRadios1' . $question_id . '" value="B">
                                                                                    B
                                                                                </label>
                                                                            </div>
                                                                            <div class="form-check col-md-3">
                                                                                <label class="form-check-label">
                                                                                    <input type="radio" class="form-check-input" name="optionsRadios' . $question_id . '" id="optionsRadios1' . $question_id . '" value="C">
                                                                                    C
                                                                                </label>
                                                                            </div>
                                                                            <div class="form-check col-md-3">
                                                                                <label class="form-check-label">
                                                                                    <input type="radio" class="form-check-input" name="optionsRadios' . $question_id . '" id="optionsRadios1' . $question_id . '" value="D">
                                                                                    D
                                                                                </label>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                <h6>Total Marks for Question ' . $i . '</h6>
                                                                                <input type="number" disabled class="form-control col-md-6" value="' . $question_marks . '" name="total_marks' . $i . '">
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                <h6>Negitive Marks for Question ' . $i . '</h6>
                                                                                <input type="number" disabled class="form-control col-md-6" value="' . $question_negitive_marks . '" name="negitive_marks' . $i . '"><br><br>
                                                                                </div>
                                                                                </div>
                                                                                ';
                                                                }
                                                            }
                                                            echo '<input type="submit" name="submit_answers" class="text-white btn btn-primary me-2">
                                                                                <button type="reset" class="btn btn-light">Cancel</button>';
                                                            ?>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <object class="card" data="<?php echo $assignment_pdf . '/' . $files ?>" type="application/pdf" width="100%" height="100%" aria-labelledby="PDF document">
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