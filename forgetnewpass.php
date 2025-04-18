<?php 
include("connection.php");
if(isset($_SESSION['forgot']))
{
	
	$email = $_SESSION['forgot'];
	//$cno = $_SESSION['contact'];
	$otp = $_SESSION['otp'];

}
else
{
	header("location:login");
}

if(isset($_REQUEST['btn_update']))
{
	$email = $_SESSION['forgot'];
	
	$pwd = $_REQUEST['txtpwd'];
	
	$update ="update customer_registration set password='$pwd' where email='$email'";
	mysqli_query($conn,$update); 
	
	
	unset($_SESSION['forgot']);
	unset($_SESSION['contact']);
	unset($_SESSION['otp']);
	echo '<script>alert("Password change successfully")</script>';
        echo "<script>window.location='login.php'</script>";
	// header("location:index.php");
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
        <h1 style="color:#00B074;text-align:center;">New Password</h1><br>
        <center>
		<form class="login-form"  name="myForm" method="post">
						<div class="card mb-0">
							<div class="card-body">

	
		<div class="form-group">
		<div class="col-lg-6">
		<!-- <label for="exampleInputEmail1">New Password</label> -->
		<input id="email1" class="form-control" style="width:210px" type="password" name="txtpwd" placeholder="Enter New password"  pattern="[A-Za-z0-9@]{7,}" required>
		</div>
		<div id="pass" style="color:#FF0000;font-size:12px;margin-top:-15px;" class="col-lg-6"></div>
		
</div>
			
		
		<div id="payment">
		<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button id="review_submit" type="submit" name="btn_update" class="btn btn-success" value="Submit">Submit</button>
		</div>
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