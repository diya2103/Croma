<?php 
    // Start session at the very beginning
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // Debug session
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    include("connection.php");

    // Debug information
    error_log("Current session in forgetotp.php: " . print_r($_SESSION, true));

    // Check if OTP was sent
    if(!isset($_SESSION['email']) || !isset($_SESSION['otp'])) {
        error_log("Missing session variables - redirecting to forgetpassword.php");
        header("Location: forgetpassword.php");
        exit();
    }

    $msg = "";

    if(isset($_POST['btn_submit'])) {
        $otp = $_POST['txtotp'];
        
        error_log("Submitted OTP: " . $otp);
        error_log("Stored OTP: " . $_SESSION['otp']);
        
        if($otp == $_SESSION['otp']) {
            $_SESSION['otp_verified'] = true;
            error_log("OTP verified successfully");
            header("Location: forgetnewpass.php");
            exit();
        } else {
            error_log("Invalid OTP entered");
            $msg = "Invalid OTP. Please try again.";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify OTP - Croma Shop</title>
    <?php include("css.php"); ?>
</head>
<body>
    <!-- Use minimal header without session checks -->
    <?php  ?>

    <main class="site-main">
        <section class="section-margin calc-100px">
            <div class="container">
                <div class="alert alert-info" role="alert">OTP sent to your email id..</div>
                <h1 style="color:#00B074;text-align:center;">OTP Verification</h1><br>
                <center>
                    <form method="post" class="login-form">
                        <div class="card mb-0" style="max-width: 400px;">
                            <div class="card-body">
                                <div class="text-center mb-3">
                                    <i class="icon-people icon-2x text-warning border-warning border-3 rounded-pill p-3 mb-3 mt-1"></i>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-6">
                                        <label for="txtotp">OTP Code</label>
                                        <input class="form-control" style="width:200px" type="number" name="txtotp" id="txtotp" placeholder="Enter OTP Code" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-6">
                                        <br><p style="color:#FF3300;"><?php echo $msg ?></p>
                                    </div>
                                </div>
                                <div>
                                    <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" name="btn_submit" class="btn btn-success" style="margin-top:10px;">Verify OTP</button>
                                </div><br><br>
                            </div>
                        </div>
                    </form>
                </center>
            </div>
        </section>
    </main>

   

    <script src="vendors/jquery/jquery-3.2.1.min.js"></script>
    <script src="vendors/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>