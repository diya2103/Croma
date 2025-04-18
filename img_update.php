<?php 
include("connection.php");
include("session_customer.php");
 if(isset($_REQUEST['update']))
 {
  
  $e=$_REQUEST['ima'];
  $name=$_FILES['userfile']['name'];
	   $tmp=$_FILES['userfile']['tmp_name'];
	   $type=$_FILES['userfile']['type'];
	   $size=$_FILES['userfile']['size'];
	   $path="img/".$name;
	   move_uploaded_file($tmp,$path);
  $update="update customer_registration set image='$path' where cust_id='$e'";
   mysqli_query($conn,$update);
   header("location:viewprofile.php");
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
          <h2>Profile Update</h2>
        </div>
        <div class="row">
		
            <?php
			if(isset($_REQUEST['ima']))
 {
     $e=$_REQUEST['ima'];
     $select1="select * from customer_registration where cust_id='$e'";
     $res1=mysqli_query($conn,$select1);
     $row1=mysqli_fetch_array($res1);
 }
        if(isset($_REQUEST['ima']))
        {
        ?>
        <form method="post" enctype="multipart/form-data">
        
            
           
           
            <label for="name"><b>Image</b></label>
            <input type="file" name="userfile" class="form-control" id="name" required/><br><br>
            &nbsp;<img src="<?php echo $row1['image']; ?>" height="100px" width="100px"/><br><br>
   <br><button type="submit" class="btn btn-primary w-100 py-3" name="update">Update</button>
</div>
</form>
<?php } ?>
        
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