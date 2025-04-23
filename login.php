<?php 
    session_start();
    include ("connection.php");

    // Debug session
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    // Debug initial session state
    error_log("Initial session state: " . print_r($_SESSION, true));

    if(isset($_POST['submit']))
    {
        $email = $_POST['email'];
        $password = $_POST['password'];

        error_log("Login attempt - Email: " . $email);
        error_log("Login attempt - Password: " . $password);

        // Check customer login
        $query = "SELECT * FROM customer_registration WHERE email = ? AND password = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if(mysqli_num_rows($result) > 0) {
            error_log("Customer login successful");
            // Clear any existing session data
            session_unset();
            // Regenerate session ID for security
            session_regenerate_id(true);
            // Set session variables
            $_SESSION['customer'] = $email;
            $_SESSION['email'] = $email;
            
            // Debug session after login
            error_log("Session after login: " . print_r($_SESSION, true));
            
            // Ensure headers haven't been sent
            if (!headers_sent()) {
                header("Location: index.php");
                exit();
            } else {
                error_log("Headers already sent, cannot redirect");
                echo "<script>window.location.href='index.php';</script>";
                exit();
            }
        }
        else {
            error_log("Login failed - Invalid credentials");
            $_SESSION['error'] = "Invalid Email or Password";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("css.php"); ?>
</head>
<body>
    <section class="login_box_area section-margin">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="login_box_img">
                        <div class="hover">
                            <h4>New to our website?</h4>
                            <p>There are advances being made in science and technology everyday, and a good example of this is the</p>
                            <a class="button button-account" href="register.php">Create an Account</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="login_form_inner">
                        <h3>Log in to enter</h3>
                        <?php if(isset($_SESSION['error'])): ?>
                            <div class="alert alert-danger"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
                        <?php endif; ?>
                        <form class="row login_form" method="POST" action="">
                            <div class="col-md-12 form-group">
                                <input type="email" class="form-control" name="email" placeholder="Email" required>
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="password" class="form-control" name="password" placeholder="Password" required>
                            </div>
                            <div class="col-md-12 form-group">
                                <button type="submit" class="button button-login w-100" name="submit">Log In</button>
                            </div>
                        </form>
                        <div class="text-center mt-3">
                            <a href="forgetpassword.php" class="forgot-password-link" style="color: #007bff; text-decoration: none; font-weight: 500;">Forgot Password?</a>
                        </div>
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