<?php
include("connection.php");
include("session_customer.php");
?>
<style>
 .header_area .navbar .nav .nav-item {
  margin-right: 45px;
  margin-right: 23px;
  margin-bottom: -17.0px;
  padding: -1.4px;
  margin-top: -14.2px;
  }
</style>
<header class="header_area">
	<div class="main_menu">
		<nav class="navbar navbar-expand-lg navbar-light">
			<div class="container">
				<a class="navbar-brand logo_h" href="customer_index.php"><img src="img/croma.png" style="width:150px; margin-left: -117px;"></a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
					aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" >
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<div class="collapse navbar-collapse offset" id="navbarSupportedContent" >
					<ul class="nav navbar-nav menu_nav ml-auto mr-auto" style="padding-right: 281px; margin-right: 58.6px;
  margin-bottom: -27.4px;
  margin-top: -11px;">
						<li class="nav-item active" ><a href="index.php" class="hyper nav-link"><span>Home</span></a></li>
						<?php

						$sel1 = "select * from category";
						$res1 = mysqli_query($conn, $sel1);
						while ($row1 = mysqli_fetch_array($res1)) {
							$catid = $row1['category_id'];
						?>

							<li class="nav-item submenu dropdown">
								<a href="#" class="dropdown-toggle nav-link hyper" data-toggle="dropdown" ><span><?php echo $row1['category_name'] ?> <b class="caret"></b></span></a>
								<ul class="dropdown-menu multi">
									<div class="row">
										<?php
										$sel16 = "select * from subcategory where cid = '$catid'";
										$res16 = mysqli_query($conn, $sel16);

										?>
										<div class="col-sm-4">
											<ul class="multi-column-dropdown">
												<?php
												while ($row16 = mysqli_fetch_array($res16)) {
												?>
													<li class="nav-item"><a href="customer_product.php?subid=<?php echo $row16['subcategory_id'] ?>&cid=<?php echo $row1['category_id'] ?>" class="nav-link"><?php echo $row16['subcategory_name'] ?></a></li>
												<?php
												}
												?>

											</ul>

										</div>

										<div class="col-sm-4 w3l">
											<!--<a href="women.html"><img src="images/qwqw.jpg" class="img-responsive" alt=""></a>-->
										</div>
										<div class="clearfix"></div>
									</div>
								</ul>
							</li>
						<?php
						}
						?>


					</ul>
					<ul class="nav-shop" style="margin-left: -315.2px; margin-right: -139px; ">
						<!-- <li class="nav-item"><button><i class="ti-search"></i></button></li> -->
						<!-- <li class="nav-item"><button><i class="ti-shopping-cart"></i><span class="nav-shop__circle">3</span></button> </li> -->
						<?php if (isset($_SESSION['customer'])) {

						?>
							<a href="add_to_cart.php" class="notification"><span><i class="ti-shopping-cart" style="font-size:25px;color:orange"></i></span><span class="badge" style="background-color:#FF6600"><?php $scart1 = "select * from c_cart
		  			join product_size_price on product_size_price.psp_id = c_cart.psp_id
					join product_entry on product_size_price.pe_code = product_entry.pe_code
					where cc_username = '$email' AND cc_status = 'cart'";
																																																					$rcart1 = mysqli_query($conn, $scart1);
																																																					echo  $abc = mysqli_num_rows($rcart1);
																																																					?> </span></a>
							<li class="nav-item">
								<div class="dropdown">
									<button class="dropbtn"><b class="button button-header" style="color:red"><?php echo $fullname; ?></b></button>
									<div class="dropdown-content">
										<a href="myorder.php">My Order</a>
										<a href="wishlist.php">Wishlist</a>
										<a href="viewprofile.php">View Profile</a>
										<a href="changepassword.php">Change Password</a>
										<a href="logout.php">Logout</a>

									</div>
								</div>
							</li>

							<!--<li class="nav-item"><a class="button button-header" href="logout.php">Logout</a></li>-->
						<?php  } else { ?>
							<li class="nav-item"><a class="button button-header" href="login.php">Login</a></li>
						<?php } ?>
					</ul>
				</div>
			</div>
		</nav>
		<script>
			$(document).ready(function() {
				$(".dropdown").hover(
					function() {
						$('.dropdown-menu', this).stop(true, true).slideDown("fast");
						$(this).toggleClass('open');
					},
					function() {
						$('.dropdown-menu', this).stop(true, true).slideUp("fast");
						$(this).toggleClass('open');
					}
				);
			});
		</script>
	</div>
</header>