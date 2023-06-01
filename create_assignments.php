<?php include('./connections/connection.php'); ?>
<?php include('./connections/global.php'); ?>
<?php include('./connections/functions.php'); ?>
<?php include('./components/header.php'); ?>

<!-- default icons used in the plugin are from Bootstrap 5.x icon library (which can be enabled by loading CSS below) -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.min.css" crossorigin="anonymous">

<!-- alternatively you can use the font awesome icon library if using with `fas` theme (or Bootstrap 4.x) by uncommenting below. -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" crossorigin="anonymous">

<!-- the fileinput plugin styling CSS file -->
<link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />

<!-- the jQuery Library -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/js/plugins/buffer.min.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/js/plugins/filetype.min.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/js/plugins/piexif.min.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/js/plugins/sortable.min.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

<!-- the main fileinput plugin script JS file -->
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/js/fileinput.min.js"></script>

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
                                <div class="">
                                    <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                                        <div class="row">
                                            <div class="card">
                                                <?php
                                                if (@$_POST['submit']) {
                                                    $title = $_POST['title'];
                                                    $description = $_POST['description'];
                                                    $number = $_POST['number'];
                                                    $start_date = $_POST['start_date'];
                                                    $end_date = $_POST['end_date'];
                                                    $total_marks = $_POST['total_marks'];
                                                    $created_at = date('Y-m-d H:i:s');
                                                    $countfiles = count($_FILES['file']['name']);

                                                    // Looping all files
                                                    $length = 10;
                                                    $random = substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
                                                    $folder = mkdir("./demo/$random");
                                                    $target_dir = "./demo/$random/";

                                                    for ($i = 0; $i < $countfiles; $i++) {
                                                        $filename = $_FILES['file']['name'][$i];
                                                        // Upload file
                                                        $array_content = move_uploaded_file($_FILES['file']['tmp_name'][$i], $target_dir . $filename);
                                                    }
                                                    $path = $target_dir;
                                                    $insert_finance = mysqli_query($conn, "INSERT INTO `assignment`(`assignment_id`, `assignment_title`, `assignment_description`, `assignment_question_number`, `assignment_start_time`, `assignment_end_time`, `assignment_pdf`, `assignment_total_marks`, `created_at`) VALUES
                                                                                     (NULL,'$title','$description','$number','$start_date','$end_date','$path', '$total_marks','$created_at')");
                                                    if ($insert_finance) {
                                                        echo "<p style='padding: 10px; margin: 10px; font-size: 14px; color: #fff; font-weight: 600; border-radius: 8px; text-align: center; background: #0096c7;'>Created Succesfully!</p>";
                                                        echo "<meta http-equiv=\"refresh\" content=\"2; url=./create_assignments.php\">";
                                                    } else {
                                                        echo "<p style='padding: 10px; margin: 10px; font-size: 14px; color: #fff; font-weight: 600; border-radius: 8px; text-align: center; background: #0096c7;'>Error!</p>";
                                                    }
                                                }
                                                ?>
                                                <div class="card-body">
                                                    <h4 class="card-title">Create Assignment</h4>
                                                    <p class="card-description">
                                                        Insert Details to create a new assignment.
                                                    </p>
                                                    <form class="forms-sample" action="./create_assignments.php" method="POST" enctype='multipart/form-data'>
                                                        <div class="form-group">
                                                            <label for="exampleInputUsername1">Assignment Name</label>
                                                            <input type="text" class="form-control" id="exampleInputUsername1" name="title" placeholder="Assignment Name">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Assignment Description</label>
                                                            <textarea type="text" rows="4" cols="50" class="form-control" name="description" id="exampleInputEmail1" placeholder="Assignment Description"></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputPassword1">Number of Questions</label>
                                                            <input type="number" class="form-control" id="exampleInputPassword1" name="number" placeholder="Number of Questions">
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="exampleInputPassword1">Start Time</label>
                                                                    <input type="datetime-local" class="form-control" id="exampleInputPassword1" name="start_date" placeholder="Start Time">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="exampleInputPassword1">End Time</label>
                                                                    <input type="datetime-local" class="form-control" id="exampleInputPassword1" name="end_date" placeholder="End Time">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="exampleInputPassword1">Total Marks</label>
                                                                    <input type="number" class="form-control" id="exampleInputPassword1" name="total_marks" placeholder="Total Marks">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputPassword1">Upload Pdf</label>
                                                            <div class="file-loading">
                                                                <input id="inp-krajee-explorer-2" name="file[]" type="file" multiple>
                                                            </div>
                                                        </div>
                                                        <input type="submit" name="submit" class="btn btn-primary text-white me-2">
                                                        <button type="reset" class="btn btn-outline-danger">Cancel</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <style>
                    .btn-file {
                        background-color: white;
                        margin-top: 11.5px;
                    }

                    .fileinput-remove,
                    .fileinput-upload,
                    .fileinput-upload-button {
                        display: none;
                    }
                </style>
                <script>
                    $('#inp-krajee-explorer-2').fileinput('clear');
                    $("#inp-krajee-explorer-2").fileinput({
                        theme: "explorer",
                        // uploadUrl: "/file-upload-batch/2",
                        minFileCount: 0,
                        maxFileCount: 8,
                        maxFileSize: 10000,
                        autoReplace: false,
                        removeFromPreviewOnError: true,
                        overwriteInitial: false,
                        previewFileIcon: '<i class="fas fa-file"></i>',
                        preferIconicPreview: false, // this will force thumbnails to display icons for following file extensions
                        previewFileExtSettings: { // configure the logic for determining icon file extensions
                            'doc': function(ext) {
                                return ext.match(/(doc|docx)$/i);
                            },
                            'xls': function(ext) {
                                return ext.match(/(xls|xlsx)$/i);
                            },
                            'ppt': function(ext) {
                                return ext.match(/(ppt|pptx)$/i);
                            },
                            'zip': function(ext) {
                                return ext.match(/(zip|rar|tar|gzip|gz|7z)$/i);
                            },
                            'htm': function(ext) {
                                return ext.match(/(htm|html)$/i);
                            },
                            'txt': function(ext) {
                                return ext.match(/(txt|ini|csv|java|php|js|css)$/i);
                            },
                            'mov': function(ext) {
                                return ext.match(/(avi|mpg|mkv|mov|mp4|3gp|webm|wmv)$/i);
                            },
                            'mp3': function(ext) {
                                return ext.match(/(mp3|wav)$/i);
                            }
                        }
                    });
                </script>
                <?php include('./components/footer.php') ?>
                <?php include('./components/scripts.php') ?>