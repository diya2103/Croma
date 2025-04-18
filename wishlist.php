<?php 
include("connection.php");
include("session_customer.php");

if(isset($_REQUEST['id']))
{

$del=$_REQUEST['id'];
$delete="delete from c_wishlist where cw_id='$del'";
mysqli_query($conn,$delete);
header("location:wishlist.php");
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
          <center><h2>Wishlist</h2></center>
        </div>
        <div class="row">
            <div class="table-responsive">
		<div class="col-lg-12">
	<?php
	//$user = $_SESSION['customer'];
		  $scart = "select * from c_wishlist
		  			join product_size_price on product_size_price.psp_id = c_wishlist.psp_id
					join product_entry on product_size_price.pe_code = product_entry.pe_code
					join subcategory on subcategory.subcategory_id=product_entry.p_subid join category on category.category_id=subcategory.cid where user_name = '$email'";
		  $rcart = mysqli_query($conn,$scart);
		  if(mysqli_num_rows($rcart))
		  {
	?>			
 	<table class="table ">
		  <tr>
		  	
			<th class="t-head head-it " style="width:100px;">Products</th>
			<th class="t-head" style="width:150px;">Name</th>
			<!--<th class="t-head" style="width:100px;">Size</th>
			<th class="t-head" style="width:100px;">Price</th>-->
			<th class="t-head" style="width:100px;">Remove</th>
			<!--<th class="t-head">Move To Cart</th>-->
		  </tr>
		  <?php
		  
		  	$tol = 0;
		  	while($wcart = mysqli_fetch_array($rcart))
			{
				
				$price = $wcart['psp_sale_price'];
				
				$pecode = $wcart['pe_code'];
				$simg = "select * from product_entry where pe_code = '$pecode'";
				$rimg = mysqli_query($conn,$simg);
				$wimg = mysqli_fetch_array($rimg);
		  ?>
		  <tr class="cross">
		  	  
			  <td class="ring-in t-data">
			  		<img src="admin/Product_Upload/<?php echo $wimg['product_image'] ?>" class="img-responsive" alt="" style="height:150px;width:150px;">
				  
			  </td>
			  <td class="t-data"><a href="customersingle_product.php?psp_id=<?php echo $wcart['psp_id']; ?>" style="color:blue"><?php echo $wcart['category_name']; ?> - <?php echo $wcart['subcategory_name']; ?> - <?php echo $wcart['pname']; ?> - <?php echo $wcart['pcolor']; ?></a></td>
			  <?php /*?><td class="t-data"><?php echo $wcart['pro_pur_qty'] ?></td>
			  <td class="t-data"><i class="fa fa-inr"></i> <?php echo number_format($wcart['cc_price'],2) ?></td><?php */?>
	
	
			  
			  <td class="t-data">
				  <a href="wishlist.php?id=<?php echo $wcart['cw_id'] ?>" class="btn btn-danger btn-md" onClick="return confirm('Are U Sure Want to Delete ?')">X
				  </a>
			  </td>
			  <?php /*?><td class="t-data">
				  <a href="wishlist.php?cart=<?php echo $wcart['psp_id'] ?>&price=<?php echo $wcart['psp_sale_price'] ?>" class="btn btn-success btn-md" onClick="return confirm('Are U Sure Move to Cart ?')"><i class="fa fa-plus"></i>
				  </a>
			  </td><?php */?>
			
		  </tr>
		  <?php
		  	}
		  
		  ?>
		  
	</table>
			</div>
		</div>
	</div>
		
	<?php
	}
	else
	{
	?>
	<center>
	<h3>Your Wishlist is Empty..!</h3>
	<a href="index.php" class="btn btn-success btn-lg">Continue Shopping...</a>
	</center>
	<?php  
	}
	?>
		
	
		 </div>
		 </div>
        
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