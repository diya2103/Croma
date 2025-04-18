<?php 
include("connection.php");
include("session_customer.php");
 if(isset($_REQUEST['update']))
 {
  $firstname=$_REQUEST['firstname'];
  $address=$_REQUEST['address'];
  $city=$_REQUEST['city'];
  $gender=$_REQUEST['gender'];
  $mobileno=$_REQUEST['mobileno'];
  $e=$_REQUEST['edit'];
  $update="update customer_registration set fullname='$firstname',address='$address',city='$city',gender='$gender',mobileno='$mobileno' where cust_id='$e'";
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
			if(isset($_REQUEST['edit']))
 {
     $e=$_REQUEST['edit'];
     $select1="select * from customer_registration where cust_id='$e'";
     $res1=mysqli_query($conn,$select1);
     $row1=mysqli_fetch_array($res1);
 }
        if(isset($_REQUEST['edit']))
        {
        ?>
        <form method="post" enctype="multipart/form-data">
        
            <label for="name"><b>Full Name</b></label> 
            <input type="text" name="firstname" value="<?php echo $row1['fullname'];?>" class="form-control" id="fname" placeholder="Enter First name" onKeyPress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)" pattern="[A-Z a-z  ]{3,}" title="Minimum 3 Character Required" style="width:400px" required/><br>
            
            <label for="name"><b>Address</b></label>
            <textarea name="address" required  placeholder="Enter Address" class="form-control" id="address"><?php echo $row1['address'];?></textarea><br>
            <label for="name"><b>City</b></label>
            <input type="text" name="city" value="<?php echo $row1['city'];?>" class="form-control" id="fname" placeholder="Enter First name" onKeyPress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)" pattern="[A-Z a-z  ]{3,}" title="Minimum 3 Character Required" required/><br>
            
            <label for="name"><b>Gender</b></label>&nbsp;&nbsp;
            <input type="radio" name="gender"required value="Male" <?php if($row1['gender'] == 'Male'){ echo "checked";} ?>/>  <label>Male</label> 
            <input type="radio" name="gender" value="Female" <?php if($row1['gender'] == 'Female'){ echo "checked";} ?>/> <label>Female</label><br>
            <label for="name"><b>Mobile Number</b></label>
            <input type="text" name="mobileno" value="<?php echo $row1['mobileno'];?>" required pattern="[0-9]{10,10}" placeholder="Enter number" class="form-control" id="number"/><br>
            <?php /*?><label for="name"><b>DOB</b></label>
            <input type="date" name="dOB" value="<?php echo $row1['dOB']; ?>" required class="form-control" max="<?php $d=date('Y-m-d'); echo $d1=date($d,strtotime($d . '+2 days'));?>"/><br><?php */?>
            <label for="name"><b>Email ID</b></label> 
            <input type="email" name="emailId" value="<?php echo $row1['email'];?>" class="form-control" id="email" placeholder="Enter Email" readonly/><br>
            <?php /*?><label for="name"><b>Image</b></label>
            <input type="file" name="image" class="form-control" id="name" required/>
            &nbsp;<img src="image/<?php echo $row1['image']; ?>" height="100px" width="100px"/><br><?php */?>
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