<?php include('./connections/connection.php'); ?>
<?php include('./connections/global.php'); ?>
<?php include('./connections/functions.php'); ?>
<?php include('./components/header.php'); ?>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<div class="row">
    <div class="wrapper">
        <div class="container">
            <div class="card-body">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="col-md-2">
                        <img src="https://agriculturecoaching.in/wp-content/uploads/2023/05/LMS2.png" alt="logo" srcset="">
                    </div>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="https://agriculturecoaching.in">
                                    <h5><b>Home</b></h5>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="https://agriculturecoaching.in/all-courses/">
                                    <h5><b>Courses</b></h5>
                                </a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="https://agriculturecoaching.in/about-me/">
                                    <h5><b>About Us</b></h5>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="https://agriculturecoaching.in/my-blog-page/">
                                    <h5><b>My BLog Page</b></h5>
                                </a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="https://agriculturecoaching.in/contact/">
                                    <h5><b>Contact</b></h5>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="https://agriculturecoaching.in/instructor-registration/">
                                    <h5><b>Teacher Registrations</b></h5>
                                </a>
                            </li>
                        </ul>
                        <a href="https://agriculturecoaching.in/student-registration/">
                            <div class="btn btn-outline-success p-3" id="new-btn" style="border-radius: 50px; width: 150px; margin-left: 50px;">Login/Signup</div>
                        </a>
                        <style>
                            #new-btn:hover {
                                background-color: #00a32a;
                                color: white;
                            }

                            #newbtn {
                                background-color: #00a32a;
                                color: white;
                            }

                            .bg-image {
                                background-image: url('https://agriculturecoaching.in/wp-content/uploads/2023/05/hd-wallpaper-gef3280d87_1920.jpg');
                                background-size: cover;
                                background-position: center;
                                /* Additional CSS properties for background customization */
                                height: 450px;
                                width: 100%;
                            }
                        </style>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</div>
<section class="h-100 h-custom gradient-custom-2">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <?php
            $attendies = mysqli_query($conn, "SELECT * FROM registration");
            while ($rows = mysqli_fetch_array($attendies)) {
                $id = $rows['id'];
                $full_name = $rows['full_name'];
                $dob = $rows['dob'];
                $email = $rows['email'];
                $gender = $rows['gender'];
                $number = $rows['number'];
                $inter_background_subject = $rows['inter_background_subject'];
                $religion = $rows['religion'];
                $course = $rows['course'];
                $images = $rows['images'];
                $address = $rows['address'];
                $additional_information = $rows['additional_information'];
                $zip_code = $rows['zip_code'];
                $place = $rows['place'];
                $country = $rows['country'];
                $adhar_number = $rows['adhar_number'];
                $created_at = $rows['created_at'];

                $folderPath = $images;

                // Scan the folder and retrieve the list of files
                $files = scandir($folderPath);

                // Remove '.' and '..' directories from the list
                $files = array_diff($files, ['.', '..']);
            }
            ?>
            <div class="col-12">
                <div class="card card-registration card-registration-2" style="border-radius: 15px;">
                    <div class="card-body p-0">
                        <div class="row g-0">
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <h3 class="fw-normal mb-5" style="color: #4835d4;">General Infomation</h3>
                                    <form action="./form.php" enctype='multipart/form-data' id="form" method="post">
                                        <div class="row">
                                            <div class="col-md-6 mb-4 pb-2">

                                                <div class="form-outline">
                                                    <input type="text" id="full_name" name="full_name" value="<?= $full_name ?>" class="form-control form-control-lg" />
                                                    <label class="form-label" for="form3Examplev2">Full Name</label>
                                                </div>

                                            </div>
                                            <div class="col-md-6 mb-4 pb-2">

                                                <div class="form-outline">
                                                    <input type="text" id="form3Examplev3" name="dob" value="<?= $dob ?>" class="form-control form-control-lg" />
                                                    <label class="form-label" for="form3Examplev3">DOB</label>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="mb-4 row">
                                            <div class="form-outline form-white col-md-6">
                                                <input type="text" id="email" name="email" value="<?= $email ?>" class="form-control form-control-lg" />
                                                <label class="form-label" for="form3Examplea9">Your Email</label>
                                            </div>
                                            <div class="form-outline form-white col-md-6">
                                                <input type="text" id="number" name="number" value="<?= $number ?>" class="form-control form-control-lg" />
                                                <label class="form-label" for="form3Examplea8">Phone Number</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-4 pb-2">
                                                <Input typr="text" class="form-control form-control-lg" value="<?= $gender ?>"> <label class="form-label" for="form3Examplev5">Gender</label>
                                            </div>
                                            <div class="col-md-6 mb-4 pb-2">
                                                <Input typr="text" class="form-control form-control-lg" value="<?= $religion ?>">
                                                <label class="form-label" for="form3Examplev5">Religion</label>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-4 pb-2">
                                                <Input typr="text" class="form-control form-control-lg" value="<?= $inter_background_subject ?>"><label class="form-label" for="form3Examplev5">Inter background Subject</label>
                                            </div>
                                            <div class="col-md-6 mb-4 pb-2">
                                                <input type="text" class="form-control form-control-lg" value="<?= $course ?>" id="">
                                                <label class="form-label" for="form3Examplev5">Course</label>
                                            </div>
                                        </div>

                                        <div class="form-outline form-white mt-4">
                                            <?php
                                            // Loop through the files and do something with each file
                                            foreach ($files as $file) {
                                                echo '<img src="' . $images . '/' . $file . '" alt="" class="img image img-responsive" width="200px" srcset="">';
                                            }
                                            ?>
                                        </div>
                                </div>
                            </div>
                            <div class="col-lg-6 bg-indigo text-white">
                                <div class="p-5">
                                    <h3 class="fw-normal mb-5">Contact Details</h3>

                                    <div class="mb-4 pb-2">
                                        <div class="form-outline form-white">
                                            <input type="text" id="form3Examplea2" name="address" value="<?= $address ?>" class="form-control form-control-lg" />
                                            <label class="form-label" for="form3Examplea2">Street + Nr</label>
                                        </div>
                                    </div>

                                    <div class="mb-4 pb-2">
                                        <div class="form-outline form-white">
                                            <input type="text" id="form3Examplea3" name="additional_information" value="<?= $additional_information ?>" class="form-control form-control-lg" />
                                            <label class="form-label" for="form3Examplea3">Additional Information</label>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-5 mb-4 pb-2">

                                            <div class="form-outline form-white">
                                                <input type="text" id="form3Examplea4" name="zip_code" value="<?= $zip_code ?>" class="form-control form-control-lg" />
                                                <label class="form-label" for="form3Examplea4">Zip Code</label>
                                            </div>

                                        </div>
                                        <div class="col-md-7 mb-4 pb-2">

                                            <div class="form-outline form-white">
                                                <input type="text" id="form3Examplea5" name="place" value="<?= $place ?>" class="form-control form-control-lg" />
                                                <label class="form-label" for="form3Examplea5">Place</label>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="mb-4 pb-2">
                                        <div class="form-outline form-white">
                                            <input type="text" id="form3Examplea6" name="country" value="<?= $country ?>" class="form-control form-control-lg" />
                                            <label class="form-label" for="form3Examplea6">Country</label>
                                        </div>
                                    </div>


                                    <div class="mb-4">
                                        <div class="form-outline form-white">
                                            <input type="text" id="form3Examplea9" name="adhar_number" value="<?= $adhar_number ?>" class="form-control form-control-lg" />
                                            <label class="form-label" for="form3Examplea9">Aadhar Number</label>
                                        </div>
                                    </div>
                                    <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<style>
    @media (min-width: 1025px) {
        .h-custom {
            height: 120vh !important;
        }
    }

    .card-registration .select-input.form-control[readonly]:not([disabled]) {
        font-size: 1rem;
        line-height: 2.15;
        padding-left: .75em;
        padding-right: .75em;
    }

    .card-registration .select-arrow {
        top: 13px;
    }

    .gradient-custom-2 {
        /* fallback for old browsers */
        background: #a1c4fd;

        /* Chrome 10-25, Safari 5.1-6 */
        background: -webkit-linear-gradient(to right, rgba(161, 196, 253, 1), rgba(194, 233, 251, 1));

        /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
        background: linear-gradient(to right, rgba(161, 196, 253, 1), rgba(194, 233, 251, 1))
    }

    .bg-indigo {
        background-color: #4835d4;
    }

    @media (min-width: 992px) {
        .card-registration-2 .bg-indigo {
            border-top-right-radius: 15px;
            border-bottom-right-radius: 15px;
        }
    }

    @media (max-width: 991px) {
        .card-registration-2 .bg-indigo {
            border-bottom-left-radius: 15px;
            border-bottom-right-radius: 15px;
        }
    }
</style>
<?php include('./components/footer.php') ?>
<?php include('./components/scripts.php') ?>