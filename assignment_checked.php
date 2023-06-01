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
                                                            $test_email = @$_GET["email"];
                                                            if ($test_email) {
                                                                $qurey2 = mysqli_query($conn, "SELECT * FROM `answers` WHERE assignment_id = '$get_assignment' AND user_email = '$test_email'");
                                                            } else {
                                                                $qurey2 = mysqli_query($conn, "SELECT * FROM `answers` WHERE assignment_id = '$get_assignment' AND user_email = '$email'");
                                                            }
                                                            while ($rows = mysqli_fetch_array($qurey2)) {
                                                                $question_id = $rows['id'];
                                                                $reference_id = $rows['assignment_id'];
                                                                $question_number = $rows['question_number'];
                                                                $answer_by_user = $rows['answer_by_user'];
                                                                $correct_answer = $rows['correct_answer'];
                                                                $created_at = $rows['created_at'];
                                                                $question_marks = array_values(mysqli_fetch_array($conn->query("SELECT question_marks FROM questions WHERE reference_id = '$get_assignment' AND question_number = '$question_number'")))[0];
                                                                $question_negitive_marks = array_values(mysqli_fetch_array($conn->query("SELECT question_negitive_marks FROM questions WHERE reference_id = '$get_assignment' AND question_number = '$question_number'")))[0];
                                                                @$i = 1 + $i;
                                                                if ($answer_by_user == $correct_answer) {
                                                                    $status = '<div class="form-check form-check-success col-md-3">';
                                                                } else {
                                                                    $status = '<div class="form-check form-check-danger col-md-3">';
                                                                }
                                                                echo '
                                                                    <h6>Question ' . $i . '</h6>
                                                                ' .  $status . '
                                                                                    <label class="form-check-label">
                                                                                    <input type="radio" class="form-check-input" name="optionsRadios' . $question_number . '" id="optionsRadios' . $question_number . '" value="A"';
                                                                if ($answer_by_user == 'A') {
                                                                    echo 'checked';
                                                                } else echo 'disabled';
                                                                echo '>
                                                                                    A
                                                                                </label>
                                                                            </div>
                                                                            ' . $status . ' 
                                                                                <label class="form-check-label">
                                                                                    <input type="radio" class="form-check-input" name="optionsRadios' . $question_number . '" id="optionsRadios1' . $question_number . '" value="B"';
                                                                if ($answer_by_user == 'B') {
                                                                    echo 'checked';
                                                                } else echo 'disabled';
                                                                echo '>
                                                                                    B
                                                                                </label>
                                                                            </div>
                                                                             ' . $status . '
                                                                                <label class="form-check-label">
                                                                                    <input type="radio" class="form-check-input" name="optionsRadios' . $question_number . '" id="optionsRadios1' . $question_number . '" value="C"';
                                                                if ($answer_by_user == 'C') {
                                                                    echo 'checked';
                                                                } else echo 'disabled';
                                                                echo '>
                                                                                    C
                                                                                </label>
                                                                            </div>
                                                                            ' . $status . ' 
                                                                                <label class="form-check-label">
                                                                                    <input type="radio" class="form-check-input" name="optionsRadios' . $question_number . '" id="optionsRadios1' . $question_number . '" value="D"';
                                                                if ($answer_by_user == 'D') {
                                                                    echo 'checked';
                                                                } else echo 'disabled';
                                                                echo '>
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
                                                                            <input type="number" disabled class="form-control col-md-6" value="' . $question_negitive_marks . '" name="negitive_marks' . $i . '"><br>
                                                                            </div>
                                                                            </div>
                                                                                ';
                                                            }
                                                            ?>
                                                        </div>
                                                    </form>
                                                    <?php
                                                    if ($test_email) {
                                                        $qurey4 = mysqli_query($conn, "SELECT * FROM `answers` WHERE assignment_id = '$get_assignment' AND user_email = '$test_email'");
                                                    } else {
                                                        $qurey4 = mysqli_query($conn, "SELECT * FROM `answers` WHERE assignment_id = '$get_assignment' AND user_email = '$email'");
                                                    }
                                                    while ($rows = mysqli_fetch_array($qurey4)) {
                                                        $question_number = $rows['question_number'];
                                                        $answer_by_user = $rows['answer_by_user'];
                                                        $correct_answer = $rows['correct_answer'];
                                                        @$assignment_total_marks += array_values(mysqli_fetch_array($conn->query("SELECT question_marks FROM questions WHERE reference_id = '$get_assignment' AND question_number = '$question_number'")))[0];
                                                        @++$total;
                                                        if ($answer_by_user == $correct_answer) {
                                                            @$correct_answers += array_values(mysqli_fetch_array($conn->query("SELECT question_marks FROM questions WHERE reference_id = '$get_assignment' AND question_number = '$question_number'")))[0];
                                                            @$score = $correct_answers;
                                                            @$marks_deducted = array_values(mysqli_fetch_array($conn->query("SELECT question_negitive_marks FROM questions WHERE reference_id = '$get_assignment'AND question_number = '$question_number'")))[0];;
                                                        } else if ($answer_by_user != $correct_answer) {
                                                            @$question_negitive_marks += array_values(mysqli_fetch_array($conn->query("SELECT question_negitive_marks FROM questions WHERE reference_id = '$get_assignment'AND question_number = '$question_number'")))[0];
                                                            $marks_deducted = $question_negitive_marks;
                                                        }
                                                    }
                                                    @$extra = array_values(mysqli_fetch_array($conn->query("SELECT question_negitive_marks FROM questions WHERE reference_id = '$get_assignment'AND question_number = '$question_number'")))[0];
                                                    $marks_deducted = $marks_deducted - $extra;
                                                    $new_score = $score - $marks_deducted;
                                                    $percentage = ($new_score / $assignment_total_marks) * 100;
                                                    $percentage = round($percentage, 2);
                                                    ?>
                                                    <div class="px-4 rating-box mb-3">
                                                        <div class="border rounded">
                                                            <div class="text-center score py-2">
                                                                <div class="rating-out"><span class="get-rating"><?= $new_score ?></span><span class="font-weight-bold">/<?= $assignment_total_marks ?></span></div>
                                                                <div><span>Main Score</span></div>
                                                            </div>
                                                            <div class="d-flex justify-content-around align-items-center align-content-center border-top">
                                                                <div class="border-right px-2 text-center py-2"><span class="d-block font-weight-bold"><?= $percentage ?>%</span><span>Percentage</span></div>
                                                                <div class="col-md-9">
                                                                    <div class="progress">
                                                                        <div class="progress-bar bg-success" role="progressbar" style="width: <?= $percentage ?>%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div><br><br>
                                                </div>
                                            </div>
                                            <?php
                                            $qurey = mysqli_query($conn, "SELECT * FROM `assignment` WHERE assignment_id = '$get_assignment'");
                                            while ($rows = mysqli_fetch_array($qurey)) {
                                                $assignment_pdf = $rows['assignment_pdf'];
                                                $files = (scandir($assignment_pdf))[2];
                                            } ?>
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
            </div>
            <?php include('./components/footer.php') ?>
            <?php include('./components/scripts.php') ?>