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
            <div id="notification"></div>
            <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $full_name = $_POST['full_name'];
                $dob = $_POST['dob'];
                $email = $_POST['email'];
                $gender = $_POST['gender'];
                $address = $_POST['address'];
                $religion = $_POST['religion'];
                $inter_background_subject = $_POST['inter_background_subject'];
                $course = $_POST['course'];
                $number = $_POST['number'];
                $additional_information = $_POST['additional_information'];
                $zip_code = $_POST['zip_code'];
                $place = $_POST['place'];
                $country = $_POST['country'];
                $adhar_number = $_POST['adhar_number'];
                $razorpay_payment_id = $_POST['razorpay_payment_id'];
                $created_at = date('Y-m-d');


                $photo = strip_tags(@$_POST['photo']);
                $sign = strip_tags(@$_POST['sign']);
                $length = 10;
                $random = substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
                $folder = mkdir("./test/$random");
                $target_dir = "./test/$random/";
                $target_file = $target_dir . basename($_FILES["photo"]["name"]);
                $target_file1 = $target_dir . basename($_FILES["sign"]["name"]);
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                $imageFileType1 = strtolower(pathinfo($target_file1, PATHINFO_EXTENSION));
                if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
                    $photo = htmlspecialchars(basename($_FILES["photo"]["name"]));
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
                if (move_uploaded_file($_FILES["sign"]["tmp_name"], $target_file1)) {
                    $sign = htmlspecialchars(basename($_FILES["sign"]["name"]));
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }

                $query = mysqli_query($conn, "INSERT INTO `registration`(`id`, `full_name`, `email`,`razorpay_payment_id`, `dob`, `gender`, `address`, `religion`, `inter_background_subject`, `course`, `number`, `additional_information`, `zip_code`, `place`, `country`, `adhar_number`,`images`, `created_at`) VALUES 
                (NULL,'$full_name','$email','$razorpay_payment_id', '$dob','$gender','$address','$religion','$inter_background_subject','$course','$number','$additional_information','$zip_code','$place','$country','$adhar_number', '$target_dir','$created_at')");
                if ($query) {
                    echo "Success!";
                }
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
                                                    <input type="text" id="full_name" name="full_name" required class="form-control form-control-lg" />
                                                    <label class="form-label" for="form3Examplev2">Full Name</label>
                                                </div>

                                            </div>
                                            <div class="col-md-6 mb-4 pb-2">

                                                <div class="form-outline">
                                                    <input type="date" id="form3Examplev3" name="dob" class="form-control form-control-lg" />
                                                    <label class="form-label" for="form3Examplev3">DOB</label>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="mb-4 row">
                                            <div class="form-outline form-white col-md-6">
                                                <input type="text" id="email" name="email" required class="form-control form-control-lg" />
                                                <label class="form-label" for="form3Examplea9">Your Email</label>
                                            </div>
                                            <div class="form-outline form-white col-md-6">
                                                <input type="text" id="number" name="number" required class="form-control form-control-lg" />
                                                <label class="form-label" for="form3Examplea8">Phone Number</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-4 pb-2">
                                                <select class="form-control form-control-lg" name="gender">
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                                <label class="form-label" for="form3Examplev5">Gender</label>

                                            </div>
                                            <div class="col-md-6 mb-4 pb-2">
                                                <select class="form-control form-control-lg" name="religion">
                                                    <option value="Hindu">Hindu</option>
                                                    <option value="Muslim">Muslim</option>
                                                    <option value="Sikh">Sikh</option>
                                                    <option value="Isai">Isai</option>
                                                </select>
                                                <label class="form-label" for="form3Examplev5">Religion</label>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-4 pb-2">
                                                <select class="form-control form-control-lg" name="inter_background_subject">
                                                    <option value="PCM">PCM</option>
                                                    <option value="PCB">PCB</option>
                                                    <option value="AG">AG</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                                <label class="form-label" for="form3Examplev5">Inter background Subject</label>
                                            </div>
                                            <div class="col-md-6 mb-4 pb-2">
                                                <select class="form-control form-control-lg" name="course">
                                                    <option value="UPCATET">UPCATET</option>
                                                    <option value="BHU">BHU</option>
                                                    <option value="ICAR">ICAR</option>
                                                    <option value="AFO">AFO</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                                <label class="form-label" for="form3Examplev5">Course</label>
                                            </div>
                                        </div>


                                        <div class="form-outline form-white mt-4">
                                            <input type="file" name="photo" class="form-control form-control-lg" />
                                            <label class="form-label" for="form3Examplea8">Photo</label>
                                        </div>
                                        <div class="form-outline form-white mt-4">
                                            <input type="file" name="sign" class="form-control form-control-lg" />
                                            <label class="form-label" for="form3Examplea8">Signature</label>
                                        </div>
                                </div>
                            </div>
                            <div class="col-lg-6 bg-indigo text-white">
                                <div class="p-5">
                                    <h3 class="fw-normal mb-5">Contact Details</h3>

                                    <div class="mb-4 pb-2">
                                        <div class="form-outline form-white">
                                            <input type="text" id="form3Examplea2" name="address" class="form-control form-control-lg" />
                                            <label class="form-label" for="form3Examplea2">Street + Nr</label>
                                        </div>
                                    </div>

                                    <div class="mb-4 pb-2">
                                        <div class="form-outline form-white">
                                            <input type="text" id="form3Examplea3" name="additional_information" class="form-control form-control-lg" />
                                            <label class="form-label" for="form3Examplea3">Additional Information</label>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-5 mb-4 pb-2">

                                            <div class="form-outline form-white">
                                                <input type="text" id="form3Examplea4" name="zip_code" class="form-control form-control-lg" />
                                                <label class="form-label" for="form3Examplea4">Zip Code</label>
                                            </div>

                                        </div>
                                        <div class="col-md-7 mb-4 pb-2">

                                            <div class="form-outline form-white">
                                                <input type="text" id="form3Examplea5" name="place" class="form-control form-control-lg" />
                                                <label class="form-label" for="form3Examplea5">Place</label>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="mb-4 pb-2">
                                        <div class="form-outline form-white">
                                            <input type="text" id="form3Examplea6" name="country" class="form-control form-control-lg" />
                                            <label class="form-label" for="form3Examplea6">Country</label>
                                        </div>
                                    </div>


                                    <div class="mb-4">
                                        <div class="form-outline form-white">
                                            <input type="text" id="form3Examplea9" name="adhar_number" class="form-control form-control-lg" />
                                            <label class="form-label" for="form3Examplea9">Aadhar Number</label>
                                        </div>
                                    </div>
                                    <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">

                                    </form>

                                    <button name="submit" id="rzp-button" onclick="Paynow()" class="btn btn-light btn-lg" data-mdb-ripple-color="dark">Register</button>
                                    <script>
                                        function Paynow() {
                                            // Perform any validation or additional processing here
                                            var fullname = document.getElementById('full_name').value;
                                            var email = document.getElementById('email').value;
                                            var number = document.getElementById('number').value;

                                            if (fullname.length > 0 && email.length > 0 && number.length > 0) {
                                                var notification = document.getElementById("notification");
                                                notification.remove();
                                                var options = {
                                                    key: 'rzp_test_Xo8DF827tsxLzJ',
                                                    amount: 10000, // Amount in paise (e.g., Rs. 10.00 = 1000 paise)
                                                    currency: 'INR',
                                                    name: 'Agriculture Coaching',
                                                    handler: function(response) {
                                                        // Handle the payment success
                                                        console.log(response);
                                                        var razorpay_payment_id = response.razorpay_payment_id;
                                                        console.log(razorpay_payment_id);
                                                        document.getElementById('razorpay_payment_id').value = razorpay_payment_id; // Set the payment ID in the hidden input field
                                                        // Perform any validation or additional processing here

                                                        // Submit the form
                                                        document.getElementById('form').submit();
                                                    },
                                                    prefill: {
                                                        name: fullname,
                                                        email: email,
                                                        contact: number
                                                    }
                                                };

                                                var rzp = new Razorpay(options);
                                                rzp.open();
                                            } else {
                                                console.log("empty Feild")
                                                var notification = document.getElementById("notification");
                                                notification.innerHTML = '<div class="col-md-12 btn btn-danger">Please fill all the feilds</div>';
                                            }
                                        };
                                    </script>
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