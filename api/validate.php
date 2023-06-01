<?php
$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "agri";
$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName) or die;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">

</head>

<body>
    <?php
    if (@$_GET["payment_id"]) {
        $payment_id = @$_GET["payment_id"];
        session_start();
        $final_email = $_SESSION['email'];
        $dinal_username = $_SESSION['username'];
        $refral_code = $_SESSION['refral_code'];
        $sponser_id = $_SESSION['sponser_id'];
        $parent_code = $_SESSION['parent_code'];
    } else {

        $name = @$_GET['username'];
        $email = @$_GET['email'];
        $refral_code = @$_GET['refral_code'];
        $sponser_id = @$_GET['sponser_id'];
        $parent_code = @$_GET['parent_code'];
        session_start();

        $_SESSION["email"] = "$email";
        $_SESSION["username"] = "$name";
        $_SESSION["refral_code"] = "$refral_code";
        $_SESSION["sponser_id"] = "$sponser_id";
        $_SESSION["parent_code"] = "$parent_code";
    }
    $course_category_less = "Acctivate Account";
    $amount = '1000';
    $days = "365";
    $added_on = date('Y-m-d h:i:s');
    $payment_status = "completed";
    $course_category = 'Account Activation';
    $days = "1180";
    $razorpayButton = '<form><script src="https://checkout.razorpay.com/v1/payment-button.js" data-payment_button_id="pl_Kl3BZ3BFaPwmCU" async> </script> </form>';
    ?>
    <div class="container">
        <div class="row m-0">
            <div class="col-md-7 col-12">
                <div class="row">
                    <div class="col-12 mb-4">
                        <div class="row box-right">
                            <div class="col-md-8 ps-0 ">
                                <p class="ps-3 textmuted fw-bold h6 mb-0">TOTAL AMOUNT</p>
                                <p class="h1 fw-bold d-flex"> <span class=" fas fa-dollar-sign textmuted pe-1 h6 align-text-top mt-1"></span><?php echo $amount ?> <span class="textmuted">.00</span> </p>
                                <p class="ms-3 px-2 bg-green"><?php echo $course_category ?></p>
                            </div>
                            <div class="col-md-4">
                                <!-- <p class="p-blue"> <span class="fas fa-circle pe-2"></span>Pending </p>
                <p class="fw-bold mb-3"><span class="fas fa-dollar-sign pe-1"></span>1254 <span class="textmuted">.50</span> </p>
                <p class="p-org"><span class="fas fa-circle pe-2"></span>On drafts</p>
                <p class="fw-bold"><span class="fas fa-dollar-sign pe-1"></span>00<span class="textmuted">.00</span></p> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-12 px-0 mb-4">
                        <div class="box-right">
                            <div class="d-flex pb-2">
                                <p class="fw-bold h7"><span class="textmuted">Note From:- </span>H.E Future</p>
                                <p class="ms-auto p-blue"><span class=" bg btn btn-primary fas fa-pencil-alt me-3"></span> <span class=" bg btn btn-primary far fa-clone"></span> </p>
                            </div>
                            <div class="bg-blue p-2">
                                <P class="h8">*Note:- Please make sure you copy the payment id from the payment tab after payment is completed!</P>
                                <P class="h8 textmuted">Please do not go back or refresh the page. Click on the pay button to pay and create your account!
                                <p class="p-blue bg btn btn-primary h8">LEARN MORE</p>
                                </P>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 px-0">
                        <div class="box-right">
                            <div class="row">
                                <p class="fw-bold"></p>
                                <p class="h7"><a href="../index.php"><input type="button" value="Skip" class="btn btn-primary col-md-12"></a></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 px-0 mt-4">
                        <div class="box-right">
                            <div class="d-flex mb-2">
                                <p class="fw-bold">QR Code</p>
                                <p class="ms-auto textmuted"><span class="fas fa-times"></span></p>
                            </div>
                            <div class="d-flex mb-1">
                                <p class="h7">#H.E Future</p>
                            </div>
                            <div class="row">
                                <div class="col-12 mb-2">
                                    <img src="../assets/dist/img/code.jpg" alt="" class="img-responsive" width="100%">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5 col-12 ps-md-5 p-0 ">
                <div class="box-left">
                    <p class="textmuted h8">Invoice</p>
                    <p class="fw-bold h7"><?php if (@$_GET["payment_id"]) {
                                                echo $_SESSION["username"];
                                            } else {
                                                echo $_GET['username'];
                                            } ?></p>
                    <p class="textmuted h8"><?php if (@$_GET["payment_id"]) {
                                                echo $_SESSION["email"];
                                            } else {
                                                echo $_GET['email'];
                                            } ?></p><br>
                    <div class="h8">
                        <div class="row m-0 border mb-3">
                            <div class="col-6 h8 pe-0 ps-2">
                                <p class="textmuted py-2">Items</p> <span class="d-block"><?php echo $course_category; ?></span>
                            </div>
                            <div class="col-2 text-center p-0">
                                <p class="textmuted p-2">Qty</p> <span class="d-block">1</span>
                            </div>
                            <div class="col-2 p-0 text-center h8 border-end">
                                <p class="textmuted p-2">Price</p><?php echo $amount ?></span> <span class="d-block py-2 ">
                            </div>
                            <div class="col-2 p-0 text-center">
                                <p class="textmuted p-2">Total</p><span class="fas fa-dollar-sign"><?php echo $amount ?></span>
                            </div>
                        </div>
                        <div class="d-flex h7 mb-2">
                            <p class="">Total Amount</p>
                            <p class="ms-auto"><span class="fas fa-dollar-sign"></span><?php echo $amount ?></p>
                        </div>
                        <div class="h8 mb-5">
                            <p class="textmuted">Total Amount for this purchase</p>
                        </div>
                    </div>
                    <?php if (!@$_GET['payment_id']) { ?>
                        <div class="">
                            <p class="h7 fw-bold mb-1">Pay this Invoice</p>
                            <p class="textmuted h8 mb-2">Make payment for this invoice by clicking on the pay button!</p>
                            <div class="form">
                                <center>
                                    <form action="./validate.php" method="GET">
                                        <div class="input-group mb-3">
                                            <input type="text" name="payment_id" class="form-control" placeholder="Transaction Id">
                                        </div>
                                        <div class="row input-group">
                                            <input type="submit" class="btn btn-outline-primary col-md-5" value="Submit">
                                            <div class="col-md-2"></div>
                                            <input type="reset" class="btn btn-outline-danger col-md-5">
                                        </div>
                                    </form>
                                </center>
                            </div>
                        </div><br><br>
                    <?php } else {
                    } ?>
                    <div class="">
                        <p class="h7 fw-bold mb-1">Insert Payment Id</p>
                        <p class="textmuted h8 mb-2">Insert Transaction Id in the given feild!</p>
                        <?php
                        $transaction_id = @$_GET['payment_id'];
                        if ($transaction_id) {
                            $created_at = date("Y-m-d H:i:s");
                            mysqli_query($conn, "INSERT INTO verification(id, email, status, transaction_id, created_at) values(NULL, '$final_email', 'pending', '$transaction_id', '$created_at')");
                            // mysqli_query($conn, "UPDATE user_data SET `active` = '1' WHERE `email` = '$final_email'");
                            echo "<meta http-equiv=\"refresh\" content=\"2; url=../index.php?activation_status=1\">";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif
        }

        p {
            margin: 0
        }

        .container {
            max-width: 900px;
            margin: 30px auto;
            background-color: #e8eaf6;
            padding: 35px;
        }

        .box-right {
            padding: 30px 25px;
            background-color: white;
            border-radius: 15px
        }

        .box-left {
            padding: 20px 20px;
            background-color: white;
            border-radius: 15px
        }

        .textmuted {
            color: #7a7a7a
        }

        .bg-green {
            background-color: #d4f8f2;
            color: #06e67a;
            padding: 3px 0;
            display: inline;
            border-radius: 25px;
            font-size: 11px
        }

        .p-blue {
            font-size: 14px;
            color: #1976d2
        }

        .fas.fa-circle {
            font-size: 12px
        }

        .p-org {
            font-size: 14px;
            color: #fbc02d
        }

        .h7 {
            font-size: 15px
        }

        .h8 {
            font-size: 12px
        }

        .h9 {
            font-size: 10px
        }

        .bg-blue {
            background-color: #dfe9fc9c;
            border-radius: 5px
        }

        .form-control {
            box-shadow: none !important
        }

        .card input::placeholder {
            font-size: 14px
        }

        ::placeholder {
            font-size: 14px
        }

        input.card {
            position: relative
        }

        .far.fa-credit-card {
            position: absolute;
            top: 10px;
            padding: 0 15px
        }

        .fas,
        .far {
            cursor: pointer
        }

        .cursor {
            cursor: pointer
        }

        .btn.btn-primary {
            box-shadow: none;
            height: 40px;
            padding: 11px
        }

        .bg.btn.btn-primary {
            background-color: transparent;
            border: none;
            color: #1976d2
        }

        .bg.btn.btn-primary:hover {
            color: #539ee9
        }

        @media(max-width:320px) {
            .h8 {
                font-size: 11px
            }

            .h7 {
                font-size: 13px
            }

            ::placeholder {
                font-size: 10px
            }
        }
    </style>
</body>

</html>