<?php
header("Refresh: 10");
include("connection.php");
include("session_customer.php");


if (isset($_REQUEST['id'])) {
	$id = $_REQUEST['id'];
	$del = "delete from c_cart where cc_id = '$id'";
	mysqli_query($conn, $del);
	header("location:add_to_cart.php");
}

if (isset($_REQUEST['btn_place'])) {
	//$a=$_REQUEST['a'];
	header("location:place_order.php");
}

// Add success message handling
if (isset($_GET['payment']) && $_GET['payment'] == 'success') {
    echo '<div class="alert alert-success" role="alert">
            Payment successful! Your order has been placed.
          </div>';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<?php include("css.php"); ?>
	<style>
		:root {
			--primary-bg: #ffffff;
			--secondary-bg: #f8f9fa;
			--text-color: #222;
			--table-header-bg: #f1f1f1;
			--table-row-bg: #fff;
			--table-border: #dee2e6;
		}
		[data-theme="dark"] {
			--primary-bg: #181818;
			--secondary-bg: #232323;
			--text-color: #f1f1f1;
			--table-header-bg: #232323;
			--table-row-bg: #181818;
			--table-border: #444;
		}
		body {
			background: var(--primary-bg);
			color: var(--text-color);
			transition: background 0.3s, color 0.3s;
		}
		.section-intro h2, h2, th, td, label {
			color: var(--text-color) !important;
		}
		.table {
			background: var(--secondary-bg);
			color: var(--text-color);
			border-color: var(--table-border);
		}
		.table th {
			background: var(--table-header-bg);
			color: var(--text-color);
			border-color: var(--table-border);
		}
		.table-striped > tbody > tr:nth-of-type(odd) {
			background: var(--table-row-bg);
		}
		.table-striped > tbody > tr:nth-of-type(even) {
			background: var(--secondary-bg);
		}
		.table td, .table th {
			border-color: var(--table-border);
		}
		.btn-danger, .btn-success, .btn-info {
			color: #fff !important;
		}
		/* Dark mode styles */
		[data-theme="dark"] .section-margin {
			background-color: #1a1a1a;
		}

		[data-theme="dark"] .container {
			background-color: #1a1a1a;
		}

		[data-theme="dark"] .section-intro h2 {
			color: #ffffff;
		}

		[data-theme="dark"] .table {
			background-color: #2d2d2d;
			color: #ffffff;
			border-color: #404040;
		}

		[data-theme="dark"] .table th {
			background-color: #2d2d2d;
			color: #ffffff;
			border-color: #404040;
		}

		[data-theme="dark"] .table td {
			background-color: #2d2d2d;
			color: #ffffff;
			border-color: #404040;
		}

		[data-theme="dark"] .table-striped tbody tr:nth-of-type(odd) {
			background-color: #2d2d2d;
		}

		[data-theme="dark"] .table-striped tbody tr:nth-of-type(even) {
			background-color: #232323;
		}

		[data-theme="dark"] .t-head {
			color: #ffffff !important;
		}

		[data-theme="dark"] .t-data {
			color: #ffffff !important;
		}

		[data-theme="dark"] .t-data a {
			color: #ffffff !important;
		}

		[data-theme="dark"] .form-control {
			background-color: #2d2d2d;
			border-color: #404040;
			color: #ffffff;
		}

		[data-theme="dark"] .form-control:focus {
			background-color: #2d2d2d;
			border-color: #4dabf7;
			color: #ffffff;
			box-shadow: 0 0 0 0.2rem rgba(77, 171, 247, 0.25);
		}

		[data-theme="dark"] .btn-danger {
			background-color: #dc3545;
			border-color: #dc3545;
			color: #ffffff !important;
		}

		[data-theme="dark"] .btn-success {
			background-color: #28a745;
			border-color: #28a745;
			color: #ffffff !important;
		}

		[data-theme="dark"] .btn-danger:hover,
		[data-theme="dark"] .btn-success:hover {
			opacity: 0.9;
		}

		[data-theme="dark"] .img-responsive {
			border: 1px solid #404040;
		}

		[data-theme="dark"] b {
			color: #ffffff !important;
		}

		[data-theme="dark"] u {
			color: #ffffff !important;
		}

		[data-theme="dark"] .site-main {
			background-color: #1a1a1a;
		}

		[data-theme="dark"] h3 {
			color: #ffffff;
		}

		[data-theme="dark"] .alert-success {
			background-color: #28a745;
			border-color: #28a745;
			color: #ffffff;
		}

		[data-theme="dark"] .alert-success a {
			color: #ffffff;
			text-decoration: underline;
		}
	</style>
	<script>
		function validate(field, query) {
			var xmlhttp;
			if (window.XMLHttpRequest) {
				// for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp = new XMLHttpRequest();
			} else {
				// for IE6, IE5
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}

			xmlhttp.onreadystatechange = function() {
				if (xmlhttp.readyState != 4 && xmlhttp.status == 200) {
					document.getElementById(field).innerHTML = "Validating..";
				} else if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
					document.getElementById(field).innerHTML = xmlhttp.responseText;
				}
				/*else 
				{
					document.getElementById(field).innerHTML = "Error Occurred. <a href='index.php'>Reload Or Try Again</a> the page.";
				}*/
			}
			xmlhttp.open("GET", "ajax.php?field=" + field + "&query=" + query, false);
			xmlhttp.send();
		}
	</script>
</head>

<body>
	<!--================ Start Header Menu Area =================-->
	<?php include("customer_header.php"); ?>
	<!--================ End Header Menu Area =================-->

	<main class="site-main">




		<section class="section-margin calc-80px">
			<div class="container">
				<div class="section-intro pb-100px" align="center">
					<h2>Add To Cart Product</h2>
				</div>
				<div class="row">
					<?php
					$user = $_SESSION['customer'];
					$scart = "select * from c_cart
		  			join product_size_price on product_size_price.psp_id = c_cart.psp_id
					join product_entry on product_size_price.pe_code = product_entry.pe_code
					join subcategory on subcategory.subcategory_id=product_entry.p_subid
					join category on category.category_id=subcategory.cid
					where cc_username = '$email' AND cc_status = 'cart'";
					$rcart = mysqli_query($conn, $scart);
					if (mysqli_num_rows($rcart)) {
					?>
						<table class="table table-striped">
							<tr>

								<th class="t-head head-it ">Products</th>
								<th class="t-head" style="width:150px;">Category Name</th>
								<th class="t-head" style="width:100px;">Product Name</th>
								<th class="t-head" style="width:200px;">Quantity</th>
								<th class="t-head" style="width:100px;">Price</th>

								<th class="t-head" style="width:100px;">Total Price</th>
								<th class="t-head">Remove</th>
							</tr>
							<form method="post">
								<?php

								$tol = 0;
								while ($wcart = mysqli_fetch_array($rcart)) {
									$qty = $wcart['cc_qty'];
									$price = $wcart['pro_pur_price'];
									$tol = $price * $qty;
									$pecode = $wcart['pe_code'];
									$simg = "select * from product_entry where pe_code = '$pecode'";
									$rimg = mysqli_query($conn, $simg);
									$wimg = mysqli_fetch_array($rimg);
								?>
									<tr class="cross">

										<td class="ring-in t-data">
											<img src="admin/Product_Upload/<?php echo $wimg['product_image'] ?>" class="img-responsive" alt="" style="height:100px;width:100px;">

										</td>
										<td class="t-data"><?php echo $wcart['category_name'] ?></td>
										<td class="t-data" style="width:150px"><?php echo $wcart['subcategory_name'] ?> - <?php echo $wcart['pname'] ?></td>
										<td class="t-data"><input type="number" name="txt_qty" class="form-control" onKeyUp="validate('<?php echo $wcart['cc_id'] ?>',this.value)" min="1" max="<?php echo $wcart['pro_pur_qty'];  ?>" value="1"></td>
										<td class="t-data" style="width:150px"><!--<i class="fa fa-inr"></i>--><?php echo number_format($wcart['pro_pur_price'], 2) ?> Rs. </td>


										<td class="t-data" id="<?php echo $wcart['cc_id'] ?>"><!--<i class="fa fa-inr"></i>--><?php echo number_format($tol, 2) ?> Rs. </td>
										<td class="t-data">
											<a href="add_to_cart.php?id=<?php echo $wcart['cc_id'] ?>" class="btn btn-danger btn-md" onClick="return confirm('Are U Sure Want to Delete ?')">X
											</a>
										</td>




									</tr>

								<?php
								}

								?>
								<?php
								$ct = 0;
								$qty1 = 0;
								$price1 = 0;
								$tol1 = 1;
								$gt1 = 0;
								$scarq = "select * from c_cart  JOIN product_size_price ON c_cart.psp_id = product_size_price.psp_id  where cc_username = '$email' AND cc_status = 'cart'";
								$rcarq = mysqli_query($conn, $scarq);
								while ($wcarq = mysqli_fetch_array($rcarq)) {
									$ct++;
									$qty1 = $wcarq['cc_qty'];
									$price1 = $wcarq['pro_pur_price'];
									$tol1 = $price1 * $qty1;
									$gt1 = $gt1 + $tol1;
								}
								?>
								<tr>
									<td></td>
									<td></td>
									<td></td>
									<td style="color:red"><b><?php //echo $ct 
																?></b></td>
									<td></td>
									<td style="color:red; width:200px"><b><u><?php echo $gt1; ?> Rs.</u></b></td>
									<td></td>
								</tr>


						</table>

				</div>

				<center>
					<input type="submit" name="btn_place" value="Check Out" class="btn btn-danger btn-md"><br>
				</center>
				</form>
				<div class="col-lg-12"><br><br></div>
			</div>
			</div>
			</div>
			</div>
			<center>



			</center>
			<?php /*?><div class="col-lg-12">
			<div class="col-lg-12">
			<form method="post">
			<?php 
	$d=$gt1;
	if($d > 2000)
	{
	?>
	
	<table border="0" align="center">
	<tr>
	<td>
	<input type="radio" name="a" value="Chocolates cookies" id="specifyColor" required /> <b class="btn btn-info">Chocolates & cookies </b><img src="images/download.jpg" height="150px" width="50px" /> </td><td>
	<input type="radio" name="a" value="Mugs" id="specifyColor" required />  <b class="btn btn-primary">Mugs</b> <img src="images/download (1).jpg" height="150px" width="50px" />  </td><td>
	<input type="radio" name="a" value="Candles" id="specifyColor" required> <b class="btn btn-danger">Candles</b> <img src="images/ss.webp" height="150px" width="50px" /> </td><td>
	<input type="radio" name="a" value="Snack Box" id="specifyColor" required> <b class="btn btn-warning">Snack Box</b> <img src="images/20230711_130610_1024x1024@2x.webp" height="150px" width="50px" /> </td><td>
	<input type="radio" name="a" value="Baby care" id="specifyColor" required> <b class="btn btn-success"> Baby care</b> <img src="images/download (2).jpg" height="150px" width="50px" /> </td>
	</tr>
	<tr>
	<td align="center">
	<input type="submit" name="btn_place" value="Check Out" class="btn btn-danger btn-md">
	</td>
	</tr>
	</table>
	
	<?php
	}
	else
	{
	?>
<center>
   <input type="submit" name="btn_place" value="Check Out" class="btn btn-danger btn-md"><br>
	<b style="color:red">If You Are Eligible for Free Gift, Then Price More Than 5,000 <i class="fa fa-inr"></i></b>
	</center>
	<?php
	}
	?>
			
			</form>
			</div>
		</div><?php */ ?>
		<?php
					} else {
		?>
			<center>
				<h3>Your Cart is Empty..!</h3>
				<a href="index.php" class="btn btn-success btn-lg">Continue Shopping...</a>
			</center>
		<?php
					}
		?>


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