<?php 
include("connection.php");
//include("session_customer.php");
$msg = "";
$text = "";


if(isset($_REQUEST['btn_submit']))
{
$email = $_SESSION['forgot'];
	$otp = $_SESSION['otp'];
	$text = $_REQUEST['txtotp'];
	
	if($text == $otp)
	{
		header("location:forgetnewpass.php");	
	}
	else
	{
		$msg = "OTP Code Not Matched..!";
	}
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

  <main class="site-main">
    
    
    <section class="section-margin calc-100px">
      <div class="container">
        <div class="alert alert-info" role="alert">OTP sent to your email id..</div>
		<!-- <h3 class="text-center">OTP sent to your email id..</h3> -->
        <h1 style="color:#00B074;text-align:center;">OTP</h1><br>
        <center>
							<form class="login-form" id="" name="myForm" method="post">
						<div class="card mb-0">
							<div class="card-body">
								
								<div class="text-center mb-3">
									<i class="icon-people icon-2x text-warning border-warning border-3 rounded-pill p-3 mb-3 mt-1"></i>
									
								</div>
		<div class="form-group">
		<div class="col-lg-6">
		<label for="exampleInputEmail1">OTP Code</label>
		<input id="email1" class="form-control" style="width:200px" type="number" name="txtotp" placeholder="Enter OTP Code" value="<?php echo $text ?>" onKeyUp="validation('otp',this.value)" pattern="[0-9]" required>
		</div>
		<div id="otp" style="color:#FF0000;font-size:12px;margin-top:-15px;" class="col-lg-9"></div>
</div>
		<div class="form-group">
		<div class="col-lg-6">
		<br><p style="color:#FF3300;"><?php echo $msg ?></p>
		</div>
		</div>
		
		<div id="otp">
		<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button id="review_submit" type="submit" name="btn_submit"  class="btn btn-success" value="Submit" style="margin-top:10px;">Submit</button>
		
		
		</div><br><br>
					</div>
						</div>
					</form>
		
                    </center>
      </div>
    </section>
    

  </main>


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