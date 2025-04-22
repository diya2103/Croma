<?php
include("connection.php");
include("session_customer.php");
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<style>
    .custom-text {
        font-family: "Roboto", sans-serif;
    }

    .nav-shop {
        display: flex;
        align-items: center;
        gap: 25px;
        /* Adjust spacing between icons */
        margin-left: -315.2px;
        padding-top: 20px;
    }

    .nav-shop .nav-item {
        list-style: none;
    }
    .header_area {
  position: sticky;
  top: 0;
  z-index: 1000;
  background-color: #fff; /* Make sure background isn't transparent */
  box-shadow: 0 2px 5px rgba(0,0,0,0.1); /* Optional shadow effect */
}

</style>
<header class="header_area" >

    <nav class="navbar navbar-expand-lg navbar-light" style="height: 83.8px;">

        <a class="navbar-brand logo_h" href="index.php"><img src="img/croma.png" style="width:150px; margin-left: 100px;"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>

        <ul class="nav navbar-nav menu_nav ml-auto mr-auto" style="padding-right: 281px; margin-right: 58.6px;">
            <li class="nav-item active"><a href="index.php" class="hyper nav-link"><span>Home</span></a></li>
            <li class="nav-item submenu dropdown">
                <a href="#" class="dropdown-toggle nav-link hyper menu-hover">
                    <span>Menu <b class="caret"></b></span>
                </a>
                <ul class="dropdown-menu multi category-menu">
                    <?php
                    include("connection.php");
                    $sel1 = "SELECT * FROM category";
                    $res1 = mysqli_query($conn, $sel1);
                    while ($row1 = mysqli_fetch_array($res1)) {
                        $catid = $row1['category_id'];
                    ?>
                        <li class="nav-item submenu dropdown category-item" data-catid="<?php echo $catid; ?>">
                            <a href="#" class="category-link dropdown-toggle nav-link hyper">
                                <span><?php echo $row1['category_name']; ?> <b class="caret"></b></span>
                            </a>
                            <ul class="dropdown-menu multi subcategoryList" id="subcategoryList_<?php echo $catid; ?>">
                                <!-- Subcategories will be loaded dynamically -->
                            </ul>
                        </li>
                    <?php } ?>
                </ul>
            </li>
        </ul>

        <ul class="nav-shop" style="margin-left: -315.2px; ">
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
							<li class="nav-item" style="margin-left: 14.8px;">
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
    </nav>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Click on category to load subcategories
            $(".category-item").click(function(e) {
                e.preventDefault();
                var catid = $(this).data("catid");

                $.ajax({
                    url: "fetch_subcategories.php",
                    type: "POST",
                    data: {
                        cid: catid
                    },
                    success: function(data) {
                        $(".trending-products").html(data); // Display subcategories in trending section
                    }
                });
            });

            // Click on subcategory to load products
            $(document).on("click", ".subcategory-item", function(e) {
                e.preventDefault();
                var subcatid = $(this).data("subcatid");

                $.ajax({
                    url: "fetch_products.php",
                    type: "POST",
                    data: {
                        subcatid: subcatid
                    },
                    success: function(data) {
                        $(".trending-products").html(data); // Display products in trending section
                    }
                });
            });
        });
    </script>

    </div>
</header>