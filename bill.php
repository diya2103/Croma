<?php 
include("connection.php");
include("session_customer.php");

	
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include("css.php"); ?>
<script type="text/javascript">     
    function PrintDiv() {    
       var divToPrint = document.getElementById('divToPrint');
       var popupWin = window.open('', '_blank', 'width=300,height=300');
       popupWin.document.open();
       popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
        popupWin.document.close();
            }
 </script>
</head>
<body>
  <!--================ Start Header Menu Area =================-->
<?php include("customer_header.php"); ?>
	<!--================ End Header Menu Area =================-->

  <main class="site-main">
    
    
    <section class="section-margin calc-100px">
      <div class="container">
        <div class="section-intro pb-100px">
          <center><h2>Invoice</h2></center>
        </div>
        <div class="row">
		<?php
		$p=$_REQUEST['p'];
		 $select="select * from c_purchase join c_deliver on c_deliver.cp_code=c_purchase.cp_code where c_purchase.cp_code='$p'";
		  $res=mysqli_query($conn,$select);
		   while($wor=mysqli_fetch_array($res))
		   {
		   ?>
            
       
							<div class="col-lg-12" style="padding-top:10px;border-bottom:1px solid #CCCCCC;">
								<div id="divToPrint">
								<table border="1" style="width:100%;">
									<tr height="100">
										<th colspan="5"><h3 align="center">Croma Shop</h3></th>
									</tr>
									<tr>
										<th colspan="3">
											<p style="padding:5px;">Customer : <?php echo $wor['cp_name'] ?></p>
											<p style="padding:5px;">Address : <?php echo $wor['cp_address'] ?></p>
											<p style="padding:5px;">Pincode : <?php echo $wor['cp_pincode'] ?></p>
											<p style="padding:5px;">Contact : <?php echo $wor['cp_contact'] ?></p>
											<p style="padding:5px;">Alt Contact : <?php echo $wor['cp_alternative_contact'] ?></p>
										</th>
										
										<th colspan="2">
											<p style="padding:5px;">Bill no : <?php echo $wor['bill_no'] ?></p>
											<p style="padding:5px;">Order Date : <?php echo $wor['cp_date'] ?></p>
											<p style="padding:5px;">Tracking ID : <?php echo $wor['cp_code'] ?></p>
											<p style="padding:5px;">Order ID : <?php echo $wor['cp_id'] ?></p>
											<p style="padding:5px;">Deliver Date : <?php echo $wor['cd_date'] ?></p>
										</th>
									</tr>
									<tr style="height:40px;">
										<th><center>No</center></th>
										<th><center>Product</center></th>
										<th><center>Qty</center></th>
										<th><center>Price</center></th>
										<th><center>Total Price</center></th>
									</tr>
									<?php
									$r = 1;
									$cpcode1 = $wor['cp_code'];
									$tol1 = 0;
									$gt1 = 0;
									$scart1 = "select * from c_cart join c_purchase on c_purchase.cp_code=c_cart.cp_code join product_size_price on product_size_price.psp_id=c_cart.psp_id join product_entry on product_entry.pe_code=product_size_price.pe_code join subcategory on subcategory.subcategory_id=product_entry.p_subid join category on category.category_id=subcategory.cid where cc_username='$email' and c_purchase.cp_code='$p'";
									$rcart1 = mysqli_query($conn,$scart1);
									while($wcart1 = mysqli_fetch_array($rcart1))
									{
										$qty1 = $wcart1['cc_qty'];
										$price1 = $wcart1['cc_price'];
										$tol1 = $price1 * $qty1;
										$gt1 = $gt1 + $tol1;
										
									?>
									<tr style="height:40px;">
										<td><center><?php echo $r ?></center></td>
										<td><center><?php echo $wcart1['category_name']; ?> - <?php echo $wcart1['subcategory_name']; ?> - <?php echo $wcart1['pname']; ?> - <?php echo $wcart1['pcolor']; ?></center></td>
										<td><center><?php echo $wcart1['cc_qty']?></center></td>
										<td><center><?php echo number_format($wcart1['cc_price'],2) ?></center></td>
										<td><center>Rs. <?php echo number_format($tol1,2) ?></center></td>
									</tr>
									<?php
										$r++;
									}
									?>
									
									<tr style="height:40px;">
										<td colspan="3"></td>
										<th><center>Total Amount</center></th>
										<td><center>Rs. <?php echo number_format($gt1,2) ?></center></td>
									</tr>
								</table>
								</div>
								<?php
								}
								?>
								<!-- /*id = print -->
								<br>
								<center><button type="submit" class="btn btn-success" onClick="PrintDiv();"><i class="fa fa-print"></i> Print</button></center>
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