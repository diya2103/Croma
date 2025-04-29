<?php 
// session_start();
    include "connection.php";
	
    // include("session_customer.php");
    if(isset($_REQUEST['submit']))
    {
        $fullname = mysqli_real_escape_string($conn,$_REQUEST['fullname']);
        $email = mysqli_real_escape_string($conn,$_REQUEST['email']);
        $password = mysqli_real_escape_string($conn,$_REQUEST['password']);
		$address=$_REQUEST['address'];
		$city=$_REQUEST['city'];
		$mobileno=$_REQUEST['mobileno'];
		
      
          $query = "INSERT INTO customer_registration VALUES(NULL,'$fullname','$email','$password','$address','$city','','$mobileno','Active','')";
        $result = mysqli_query($conn,$query);
        if($result)
        {
            echo '<script>alert("successfully inserted")</script>';
        }else
        {
            echo '<script>alert("failed to insert")</script>';
        }
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
<?php include("css.php"); ?>
</head>
<body>
  <!--================ Start Header Menu Area =================-->
	<!--================ End Header Menu Area =================-->
      <!-- ================ start banner area ================= -->	
	
	<!-- ================ end banner area ================= -->
 <!--================Login Box Area =================-->
 <section class="login_box_area section-margin">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<div class="login_box_img">
						<div class="hover">
							<h4>Already have an account?</h4>
							<p>There are advances being made in science and technology everyday, and a good example of this is the</p>
							<a class="button button-account" href="login.php">Login Now</a>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="login_form_inner register_form_inner">
						<h3>Create an account</h3>
						<form class="row login_form"  id="register_form" method="post" action="register.php">
							<div class="col-md-12 form-group">
								<input type="text" class="form-control" id="fullname" name="fullname"  placeholder = "Enter fullname" onKeyPress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)" pattern="[A-Z a-z  ]{3,}" title="Minimum 3 Character Required" required>
							</div>
							<div class="col-md-12 form-group">
								<input type="text" class="form-control" id="address" name="address" placeholder="address"  pattern="[A-Z a-z 0-9,.  ]{3,}" title="Minimum 3 Character Required" required>
              				</div>
							<div class="col-md-12 form-group">
								<input type="text" class="form-control" id="city" name="city" placeholder="city" pattern="[A-Z a-z  ]{3,}" title="Minimum 3 Character Required" required>
              				</div>
							<div class="col-md-12 form-group">
								<input type="text" class="form-control" id="mobileno" name="mobileno" placeholder="mobileno" pattern="[0-9]{10,10}" title="Minimum 10 Digit Required" required>
              				</div>
							<?php /*?><div class="col-md-12 form-group">
								<input type="radio"  id="gender" name="gender" placeholder="gender" onFocus="this.placeholder = ''" onBlur="this.placeholder = 'gender'" required> Male
								<input type="radio"  id="gender" name="gender" placeholder="gender" onFocus="this.placeholder = ''" onBlur="this.placeholder = 'gender'" required>Female
								
              				</div><?php */?>
							<div class="col-md-12 form-group">
								<input type="text" class="form-control" id="email" name="email" placeholder="Email Address"  required>
                            </div>
							   
              				<div class="col-md-12 form-group">
								<input type="password" class="form-control" id="password" name="password" placeholder="Password"  required>
              				</div>
							
              				<div id="cust_id">
							<div class="col-md-24 form-group">
							<button type="submit" value="submit" class="button button-login w-100" style="padding: 7px 160px;" name="submit">Register</button>
							</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================End Login Box Area =================-->


  <!--================ Start footer Area  =================-->	
	<!--================ End footer Area  =================-->



  <script src="vendors/jquery/jquery-3.2.1.min.js"></script>
  <script src="vendors/bootstrap/bootstrap.bundle.min.js"></script>
  <script src="vendors/skrollr.min.js"></script>
  <script src="vendors/owl-carousel/owl.carousel.min.js"></script>
  <script src="vendors/nice-select/jquery.nice-select.min.js"></script>
  <script src="vendors/jquery.ajaxchimp.min.js"></script>
  <script src="vendors/mail-script.js"></script>
  <script src="js/main.js"></script>
  <script>
                $(document).ready(function(){
                $('#email').keyup(function(){
                var cust_id = $('#email').val();
                if(cust_id != '')
                {
                $.ajax({
                    url:"ajaxregistration.php",
                    method:"GET",
                    data:{value:cust_id,id:'cust_id'},
                    success:function(data)
                    {
                    $('#cust_id').html(data);
                    }
                });
                }
                });
                
                   });
</script>
</body>
</html>