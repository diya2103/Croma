<?php 
session_start();

// Check if OTP was verified
if(!isset($_SESSION['email']) || !isset($_SESSION['otp_verified'])) {
    header("Location: login.php");
    exit();
}

$msg = "";

if(isset($_POST['btn_submit'])) {
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    
    if(strlen($new_password) < 8) {
        $msg = "Password must be at least 8 characters long";
    } elseif($new_password !== $confirm_password) {
        $msg = "Passwords do not match";
    } else {
        include("connection.php");
        $email = $_SESSION['email'];
        
        $sql = "UPDATE customer_registration SET password = ? WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $new_password, $email);
        
        if($stmt->execute()) {
            // Clear all session variables
            session_unset();
            session_destroy();
            // Set success message in session
            session_start();
            $_SESSION['success'] = "Password updated successfully. Please login with your new password.";
            header("Location: login.php");
            exit();
        } else {
            $msg = "Error updating password";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Croma Shop</title>
    <?php include("css.php"); ?>
</head>
<body>
    <!-- Use minimal header without session checks -->
    

    <section class="section-margin calc-100px">
        <div class="container">
            <h1 style="color:#00B074;text-align:center;">Reset Password</h1><br>
            <center>
                <form method="post" class="login-form">
                    <div class="card mb-0" style="max-width: 400px;">
                        <div class="card-body">
                            <div class="text-center mb-3">
                                <i class="icon-people icon-2x text-warning border-warning border-3 rounded-pill p-3 mb-3 mt-1"></i>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-6">
                                    <label for="new_password">New Password</label>
                                    <input class="form-control" style="width:200px" type="password" name="new_password" placeholder="Enter new password" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-6">
                                    <label for="confirm_password">Confirm Password</label>
                                    <input class="form-control" style="width:200px" type="password" name="confirm_password" placeholder="Confirm new password" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-6">
                                    <br><p style="color:#FF3300;"><?php echo $msg ?></p>
                                </div>
                            </div>
                            <div>
                                <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" name="btn_submit" class="btn btn-success" value="Submit" style="margin-top:10px;">Reset Password</button>
                            </div><br><br>
                        </div>
                    </div>
                </form>
            </center>
        </div>
    </section>



    <script src="vendors/jquery/jquery-3.2.1.min.js"></script>
    <script src="vendors/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>