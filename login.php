<?php 
    include ("connection.php");
    if(isset($_REQUEST['submit']))
    {
        $email = mysqli_real_escape_string($conn,$_POST['email']);
        $password = mysqli_real_escape_string($conn,$_POST['password']);

        $query = "SELECT * FROM adminlogin WHERE email = '$email' AND password = '$password'";
        $result = mysqli_query($conn,$query);

        $query1 = "SELECT * FROM customer_registration WHERE email = '$email' AND password = '$password'";
        $result1 = mysqli_query($conn,$query1);
        $row = mysqli_fetch_array($result);
        if(mysqli_num_rows($result)>0)
        {
            $_SESSION['admin'] = $email;
           
          
            echo "<script>window.location='admin/index.php'</script>";
		}
        else if(mysqli_num_rows($result1)>0)
        {
            $_SESSION['customer'] = $email;
            $_SESSION['password'] = $row['password'];
            echo "<script>window.location='index.php'</script>";

        }else
        {
            echo '<script>alert("Invalid Email Id & Password")</script>';
			header("Location: login.php");
			exit();
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
						<form class="row login_form" method="POST" >
							<div class="col-md-12 form-group">
								<input type="email" class="form-control" id="name" name="email" placeholder="Email" onFocus="this.placeholder = ''" onBlur="this.placeholder = 'Email'" required>
							</div>
							<div class="col-md-12 form-group">
								<input type="password" class="form-control" id="password" name="password" placeholder="Password" onFocus="this.placeholder = ''" onBlur="this.placeholder = 'Password'" required>
							</div>
							<!--<div class="col-md-12 form-group">
								<div class="creat_account">
									<input type="checkbox" id="f-option2" name="selector">
									<label for="f-option2">Keep me logged in</label>
								</div>
							</div>-->
							<div class="col-md-12 form-group">
								<button type="submit" value="submit" class="button button-login w-100" name="submit">Log In</button>
								<a href="forgetpassword.php" style="color:blue">Forgot Password?</a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================End Login Box Area =================-->


  <!--================ Start footer Area  =================-->	
	<?php include("footer.php"); ?>
	<!--================ End footer Area  =================-->



  <script src="vendors/jquery/jquery-3.2.1.min.js"></script>
  <script src="vendors/bootstrap/bootstrap.bundle.min.js"></script>
  <script src="vendors/skrollr.min.js"></script>
  <script src="vendors/owl-carousel/owl.carousel.min.js"></script>
  <script src="vendors/nice-select/jquery.nice-select.min.js"></script>
  <script src="vendors/jquery.ajaxchimp.min.js"></script>
  <script src="vendors/mail-script.js"></script>
  <script src="js/main.js"></script>
</body>
</html>