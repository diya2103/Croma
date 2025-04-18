<?php 
    include ("connection.php");
	use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\Exception;
 //joyiatbfsjyaofdz
 require "PHPMailer/src/Exception.php";
 require "PHPMailer/src/PHPMailer.php";
 require "PHPMailer/src/SMTP.php"; 
 if(isset($_REQUEST['btn_submit']))
	{
		$email = $_REQUEST['txtemail'];
		
		//$email = $_SESSION['email'];
	$_SESSION['forgot'] = $email;
	unset($_SESSION['email']);
	//$cno = $_SESSION['email'];
	$otp = rand(100000,999999);
	$_SESSION['otp'] = $otp;
	
	      $email= new PHPMailer;
        $email->isSMTP();
        $email->Host="smtp.gmail.com";
        $email->SMTPAuth=True;
        $email->Username="unistarsoftech@gmail.com";
        $email->Password="jbffssdgqqmreuhe";
        $email->SMTPSecure="ssl";
        $email->Port=465;
        $email->setFrom("unistarsoftech@gmail.com");
        $email->addAddress($_REQUEST['email']);
        $email->isHtml(true);
        $email->Subject="OTP";
        $otp=rand(1111,9999);
        $_SESSION['otp']=$otp;
        $email->Body="<div style='font-family: Helvetica,Arial,sans-serif;min-width:1000px;overflow:auto;line-height:2'>
        <div style='margin:50px auto;width:70%;padding:20px 0'>
          <p>Thank you for choosing Croma Shop. Use the following Forget Password OTP to complete your Change Password  procedures.</p>
          <h2 style='background: green;margin: 0 auto;width: max-content;padding: 0 10px;color: #fff;border-radius: 4px;'>$otp</h2>
          <p style='font-size:0.9em;'>Regards,<br />Croma Shop</p>
          </div>
        </div>
      </div>";
        $email->send();
		header("location:forgetotp.php");	
	}
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php include("css.php"); ?>
  <script type="text/javascript">
  function checkForm() 
  {
  	//alert("submit");
	// Fetching values from all input fields and storing them in variables.
	var email = document.getElementById("email1").value;
	
	
	/*var password = document.getElementById("password1").value;
	var email = document.getElementById("email1").value;
	var website = document.getElementById("website1").value;*/
	//Check input Fields Should not be blanks.
	alert("Fill All Fields");
	if (email == '') 
	{
		alert("Fill All Fields");
		return false;//
	} 
	else 
	{
		//Notifying error fields
		var email1 = document.getElementById("email");
		
		if (email1.innerHTML == 'Required'|| email1.innerHTML == 'Invalid Email') 
		{
			alert("Fill Valid Information");
			return false;
		} 
		else 
		{
			//Submit Form When All values are valid.
			document.getElementById("myForm").submit();
		}
	}
}
// AJAX code to check input field values when onblur event triggerd.
function validation(field, query) 
{
	var xmlhttp;
	if (window.XMLHttpRequest) 
	{ 
		// for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp = new XMLHttpRequest();
	} 
	else 
	{ 
		// for IE6, IE5
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	xmlhttp.onreadystatechange = function() 
	{
		if (xmlhttp.readyState != 4 && xmlhttp.status == 200) 
		{
			document.getElementById(field).innerHTML = "Validating..";
		} 
		else if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
		{
			document.getElementById(field).innerHTML = xmlhttp.responseText;
		} 
		else 
		{
			document.getElementById(field).innerHTML = "Error Occurred. <a href='index.php'>Reload Or Try Again</a> the page.";
		}
	}
	xmlhttp.open("GET", "validation.php?field=" + field + "&query=" + query, false);
	xmlhttp.send();
}
  </script>
</head>
<body>
  <!--================ Start Header Menu Area =================-->
<?php include("header.php"); ?>
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
							<h4>Forget Password?</h4>
							<!--<p>Enter Email Id and Procedure</p>-->
							<a class="button button-account" href="login.php">Login Now</a>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="login_form_inner">
						<h3>Forget Password</h3>
						<form  method="POST" >
							<div class="col-md-12 form-group">
								<input type="email" class="form-control" id="email1" name="txtemail" placeholder="Email" onFocus="this.placeholder = ''" onBlur="this.placeholder = 'Email'" onChange="validation('email',this.value)" required>
							</div>
							<div class="col-md-12 form-group">
							<div id="email">
								<button type="submit" name="btn_submit" class="btn btn-success" value="Submit">Submit</button>
								
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