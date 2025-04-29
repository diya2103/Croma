<?php 
    
    include ("connection.php");
    
    // Debug session
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
    // Debug initial session state
    error_log("Initial session state: " . print_r($_SESSION, true));
    
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
    require "PHPMailer/src/Exception.php";
    require "PHPMailer/src/PHPMailer.php";
    require "PHPMailer/src/SMTP.php";
    
    if(isset($_POST['btn_submit'])) {
        error_log("Form submitted with POST data: " . print_r($_POST, true));
        $email = $_POST['txtemail'];
        
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            error_log("Invalid email format: " . $email);
            $_SESSION['error'] = "Please enter a valid email address";
        } else {
            // Check if email exists in database
            $check_email = "SELECT * FROM customer_registration WHERE email = ?";
            $stmt = $conn->prepare($check_email);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if($result->num_rows > 0) {
                $otp = rand(100000,999999);
                
                // Debug information
                error_log("Email found in database: " . $email);
                error_log("Generated OTP: " . $otp);
                
                // Set session variables BEFORE sending email
                $_SESSION['email'] = $email;
                $_SESSION['otp'] = $otp;
                
                // Debug session after setting
                error_log("Session after setting variables: " . print_r($_SESSION, true));
                
                try {
                    $mail = new PHPMailer(true);
                    $mail->isSMTP();
                    $mail->Host = "smtp.gmail.com";
                    $mail->SMTPAuth = true;
                    $mail->Username = "24vishalmali@gmail.com";
                    $mail->Password = "xdaw zzdv abwv xudy";
                    $mail->SMTPSecure = "tls";
                    $mail->Port = 587;
                    $mail->setFrom("24vishalmali@gmail.com", "Croma Shop");
                    $mail->addAddress($email);
                    $mail->isHTML(true);
                    $mail->Subject = "Password Reset OTP";
                    $mail->Body = "<div style='font-family: Helvetica,Arial,sans-serif;min-width:1000px;overflow:auto;line-height:2'>
                    <div style='margin:50px auto;width:70%;padding:20px 0'>
                      <p>Thank you for choosing Croma Shop. Use the following OTP to reset your password:</p>
                      <h2 style='background: green;margin: 0 auto;width: max-content;padding: 0 10px;color: #fff;border-radius: 4px;'>$otp</h2>
                      <p style='font-size:0.9em;'>Regards,<br />Croma Shop</p>
                      </div>
                    </div>
                  </div>";
                    
                    if($mail->send()) {
                        error_log("OTP email sent successfully to: " . $email);
                        error_log("Redirecting to forgetotp.php");
                        header("Location: forgetotp.php");
                        exit();
                    } else {
                        error_log("Failed to send OTP email to: " . $email);
                        // Even if email fails, we still have the OTP in session
                        error_log("Redirecting to forgetotp.php despite email failure");
                        header("Location: forgetotp.php");
                        exit();
                    }
                } catch (Exception $e) {
                    error_log("PHPMailer Error: " . $e->getMessage());
                    // Even if email fails, we still have the OTP in session
                    error_log("Redirecting to forgetotp.php despite email error");
                    header("Location: forgetotp.php");
                    exit();
                }
            } else {
                error_log("Email not found in database: " . $email);
                $_SESSION['error'] = "Email not found in our database";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - Croma Shop</title>
    <?php include("css.php"); ?>
</head>
<body>
    <!-- Use minimal header without session checks -->
    <?php include("minimal_header.php"); ?>

    <section class="login_box_area section-margin">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="login_box_img">
                        <div class="hover">
                            <h4>Forget Password?</h4>
                            <a class="button button-account" href="login.php">Login Now</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="login_form_inner">
                        <h3>Forget Password</h3>
                        <?php if(isset($_SESSION['error'])): ?>
                            <div class="alert alert-danger"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
                        <?php endif; ?>
                        <form method="POST" action="">
                            <div class="col-md-12 form-group">
                                <input type="email" class="form-control" name="txtemail" placeholder="Email" required>
                            </div>
                            <div class="col-md-12 form-group">
                                <button type="submit" name="btn_submit" class="btn btn-success">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include("footer.php"); ?>

    <script src="vendors/jquery/jquery-3.2.1.min.js"></script>
    <script src="vendors/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>