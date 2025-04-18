<?php 
include("connection.php");
include("session_customer.php");

	
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
          <center><h2>My Order</h2></center>
        </div>
        <div class="row">
           <table class="table table-striped" border="1">
		   <tr>
		   <th>Id</th>
		   <th>Code</th>
		   <th>Name</th>
		   <th>Address</th>
		   <th>Contact No</th>
		   <th>Product</th>
		   <!--<th>Tracking</th>-->
		   </tr>
		   <?php
		   $i=1;
		   $select="select * from c_purchase where user_email='$email'";
		   $res=mysqli_query($conn,$select);
		   while($row=mysqli_fetch_array($res))
		   {
		   ?>
		   <tr>
		   <td><?php echo $i; ?></td>
		   <td><?php echo $row['cp_code']; ?></td>
		   <td><?php echo $row['cp_name']; ?></td>
		   <td><?php echo $row['cp_address']; ?> - <?php echo $row['cp_pincode']; ?></td>
		   <td><?php echo $row['cp_contact']; ?></td>
		   <td><a href="cus_product.php?p=<?php echo $row['cp_code']; ?>" class="btn btn-info">View Product</a></td>
		  <?php /*?><td><a href="product_tracking.php?t=<?php echo $row['cp_code']; ?>" class="btn btn-warning">Product Tracking</a></td><?php */?>
		   </tr>
		   <?php
		      $i++;
		   }
		
		   ?>
		   </table> 
        
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