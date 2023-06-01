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
                                            <?php
                                            if (@$_GET['status'] == '1') {
                                                echo '<div class="row mb-3">
                                                <div class="card bg-success">
                                                    <div class="">
                                                        <div class="card-title text-center m-2 text-white">
                                                            Success!
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>';
                                            }
                                            ?>
                                            <div class="col-md-6 grid-margin stretch-card">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="card-body">
                                                            <h4 class="card-title">Questions</h4>
                                                            <div class="row p-3">
                                                                <form action="./edit_question.php?assignment_id=<?= $_GET["assignment_id"] ?>" method="POST">
                                                                    <div class="row">
                                                                        <div class="form-group row">
                                                                            <?php
                                                                            $get_assignment = $_GET["assignment_id"];
                                                                            $fetch = mysqli_query($conn, "SELECT * FROM `questions` WHERE reference_id = '$get_assignment'");
                                                                            $count = mysqli_num_rows($fetch);
                                                                            if ($count > 0) {
                                                                                if (@$_POST['update_questions']) {
                                                                                    $i = 0;
                                                                                    $button = $_POST['optionsRadios' . $i + 1  . ''];
                                                                                    $created_at = date('Y-m-d H:i:s');
                                                                                    $negitive_markds = $_POST['negitive_marks' . $i + 1 . ''];
                                                                                    $total_marks = $_POST['total_marks' . $i + 1 . ''];
                                                                                    $update = mysqli_query($conn, "UPDATE `questions` SET `question_answer`='$button',`question_marks`='$total_marks',`question_negitive_marks`='$negitive_markds' WHERE 'reference_id' = '$get_assignment'");
                                                                                    if ($update) {
                                                                                        echo '<div class="row">
                                                                                    <div class="card bg-success">
                                                                                        <div class="">
                                                                                            <div class="card-title text-center m-2 text-white">
                                                                                                Success!
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>';
                                                                                    }
                                                                                }
                                                                                $qurey = mysqli_query($conn, "SELECT * FROM `questions` WHERE reference_id = '$get_assignment'");
                                                                                while ($rows = mysqli_fetch_array($qurey)) {
                                                                                    $question_id = $rows['id'];
                                                                                    $reference_id = $rows['reference_id'];
                                                                                    $question_number = $rows['question_number'];
                                                                                    $question_answer = $rows['question_answer'];
                                                                                    $question_marks = $rows['question_marks'];
                                                                                    $question_negitive_marks  = $rows['question_negitive_marks'];
                                                                                    $created_at = $rows['created_at'];
                                                                                    @$i++;
                                                                                    echo '
                                                                                    <div class="row">
                                                                                    <h6>Question ' . $i . '</h6>
                                                                                    <div class="form-check col-md-3">
                                                                                    <label class="form-check-label">
                                                                                    <input type="radio" class="form-check-input" disabled name="optionsRadios' . $question_id . '" id="optionsRadios' . $question_id . '" value="A"';
                                                                                    if ($question_answer == 'A') echo 'checked';
                                                                                    echo '>
                                                                                    A
                                                                                </label>
                                                                            </div>
                                                                            <div class="form-check col-md-3">
                                                                                <label class="form-check-label">
                                                                                    <input type="radio" class="form-check-input"  disabled name="optionsRadios' . $question_id . '" id="optionsRadios1' . $question_id . '" value="B"';
                                                                                    if ($question_answer == 'B') echo 'checked';
                                                                                    echo '>
                                                                                    B
                                                                                </label>
                                                                            </div>
                                                                            <div class="form-check col-md-3">
                                                                                <label class="form-check-label">
                                                                                    <input type="radio" class="form-check-input"  disabled name="optionsRadios' . $question_id . '" id="optionsRadios1' . $question_id . '" value="C"';
                                                                                    if ($question_answer == 'C') echo 'checked';
                                                                                    echo '>
                                                                                    C
                                                                                </label>
                                                                            </div>
                                                                            <div class="form-check col-md-3">
                                                                                <label class="form-check-label">
                                                                                    <input type="radio" class="form-check-input" disabled name="optionsRadios' . $question_id . '" id="optionsRadios1' . $question_id . '" value="D"';
                                                                                    if ($question_answer == 'D') echo 'checked';
                                                                                    echo '>
                                                                                    D
                                                                                </label>
                                                                            </div>
                                                                            <div class="row">
                                                                            <div class="col-md-6">
                                                                            <h6>Total Marks for Question ' . $i . '</h6>
                                                                            <input type="number" class="form-control col-md-6" disabled value="' . $question_marks . '" name="total_marks' . $i . '">
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                            <h6>Negitive Marks for Question ' . $i . '</h6>
                                                                            <input type="number" class="form-control col-md-6" disabled value="' . $question_negitive_marks . '" name="negitive_marks' . $i . '"><br>
                                                                            </div>
                                                                            </div>
                                                                            </div>
                                                                                ';
                                                                                }
                                                                            } else {
                                                                                $qurey = array_values(mysqli_fetch_array($conn->query("SELECT assignment_question_number FROM assignment WHERE assignment_id = '$get_assignment'")))[0];
                                                                                for ($i = 0; $i < $qurey; $i++) {
                                                                                    if (@$_POST['create_questions']) {
                                                                                        $button = $_POST['optionsRadios' . $i + 1 . ''];
                                                                                        $negitive_markds = $_POST['negitive_marks' . $i + 1 . ''];
                                                                                        $total_marks = $_POST['total_marks' . $i + 1 . ''];
                                                                                        $created_at = date('Y-m-d H:i:s');
                                                                                        $insert = mysqli_query($conn, "INSERT INTO `questions`(`id`, `reference_id`, `question_number`, `question_answer`, `question_negitive_marks`, `question_marks`, `created_at`) 
                                                                                    VALUES (NULL,'$get_assignment','$i','$button','$negitive_markds','$total_marks', '$created_at')");
                                                                                        if ($insert) {
                                                                                            $get_assignment1 = $_GET["assignment_id"];
                                                                                            echo "<meta http-equiv=\"refresh\" content=\"0; url=./edit_question.php?status=1&&assignment_id=$get_assignment1\">";
                                                                                        }
                                                                                    }
                                                                                    echo '
                                                                                    <div class="row">
                                                                                    <h6>Question ' . $i + 1 . '</h6>
                                                                                    <div class="form-check col-md-3">
                                                                                <label class="form-check-label">
                                                                                    <input type="radio" class="form-check-input" name="optionsRadios' . $i + 1 . '" id="optionsRadios' . $i . '" value="A">
                                                                                    A
                                                                                    </label>
                                                                                    </div>
                                                                            <div class="form-check col-md-3">
                                                                                <label class="form-check-label">
                                                                                    <input type="radio" class="form-check-input" name="optionsRadios' . $i + 1 . '" id="optionsRadios' . $i . '" value="B">
                                                                                    B
                                                                                </label>
                                                                            </div>
                                                                            <div class="form-check col-md-3">
                                                                                <label class="form-check-label">
                                                                                    <input type="radio" class="form-check-input" name="optionsRadios' . $i + 1 . '" id="optionsRadios' . $i . '" value="C">
                                                                                    C
                                                                                </label>
                                                                            </div>
                                                                            <div class="form-check col-md-3">
                                                                                <label class="form-check-label">
                                                                                    <input type="radio" class="form-check-input" name="optionsRadios' . $i + 1 . '" id="optionsRadios' . $i . '" value="D">
                                                                                    D
                                                                                </label>
                                                                                </div>
                                                                                <div class="row">
                                                                                <div class="col-md-6">
                                                                                <h6>Total Marks for Question ' . $i + 1 . '</h6>
                                                                                <input type="number" class="form-control col-md-6" name="total_marks' . $i + 1 . '">
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                <h6>Negitive Marks for Question ' . $i + 1 . '</h6>
                                                                                <input type="number" class="form-control col-md-6" name="negitive_marks' . $i + 1 . '"><br><br>
                                                                                </div>
                                                                                </div>
                                                                            </div>
                                                                                ';
                                                                                }
                                                                                echo '<input type="submit" name="create_questions" class="text-white btn btn-primary me-2">
                                                                                <button type="reset" class="btn btn-light">Cancel</button>';
                                                                            }
                                                                            ?></div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 grid-margin stretch-card">
                                            <?php
                                            $assignment_pdf = array_values(mysqli_fetch_array($conn->query("SELECT assignment_pdf FROM assignment WHERE assignment_id = '$get_assignment'")))[0];
                                            $files = (scandir($assignment_pdf))[2]; ?>
                                            <object class="card" data="<?= $assignment_pdf . '/' . $files ?>" type="application/pdf" width="100%" height="100%" aria-labelledby="PDF document">
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