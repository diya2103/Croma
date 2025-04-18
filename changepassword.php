<?php 
include("connection.php");
include("session_customer.php");
$msg="";
  if(isset($_REQUEST['submitbtn']))
  {
      $oldpassword = $_REQUEST['old_password'];
      $newpassword = $_REQUEST['password'];
      $cpassword = $_REQUEST['cpassword'];
      $email = $_SESSION['customer'];
      
      $changeselect = "SELECT * FROM customer_registration WHERE password='$oldpassword' and email='$email'";
      $result = mysqli_query($conn,$changeselect);
      if(mysqli_num_rows($result)>0)
      {
        if($_REQUEST['password'] == $_REQUEST['cpassword'])
        {
          $q1 = "UPDATE customer_registration SET password ='$newpassword' WHERE  email='$email'";
          mysqli_query($conn ,$q1);
          $msg="password change";
        }
        else               
        {
          $msg="New and Conform password Are Not Match";
        }
      }
      else
      {
    $msg="old Password is Invalid";
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
<?php include("customer_header.php"); ?>
	<!--================ End Header Menu Area =================-->

  <main class="site-main">
    
    
    <section class="section-margin calc-100px">
      <div class="container">
        <div class="section-intro pb-100px">
         <center> <h2>Change Password</h2></center>
        </div>
        <div class="row">
            
        <form role="form" id="quickForm" method="POST">
                <div class="card-body">
                <center><b style="color:orange">
        <?php
          if($msg != '')
          {
            echo "* ".$msg; 
          }
        ?>
        </b></center><br>
                  <div class="form-group">
                    <label for="old_password">Old Password</label>
                    <input type="password" name="old_password" class="form-control" id="old_password" placeholder="Enter old password" style="width:300px" required>
                  </div>
              
                  <div class="form-group">
                    <label for="new_password">New Password</label>
                    <input type="password" name="password" class="form-control" id="password" placeholder="Enter new password" required >
                  </div>
                  <div class="form-group">
                    <label for="cpassword">Confirm Password</label>
                    <input type="password" name="cpassword" class="form-control" id="cpassword" placeholder="Enter confirm password" required>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="">
                  <button type="submit" class="btn btn-primary" name="submitbtn">Submit</button>
                </div>
              </form>
        </div>
      </div>
    </section>
    

  </main>


  <!--================ Start footer Area  =================-->	
	<?php include("customer_footer.php"); ?>
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