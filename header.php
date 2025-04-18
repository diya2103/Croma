<?php
include("connection.php");
include("session_customer.php");
?>
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

        <ul class="nav-shop" style="margin-left: -315.2px; padding-top: 20px;">
            <!-- <li class="nav-item"><button><i class="ti-search"></i></button></li> -->
            <!-- <li class="nav-item"><button><i class="ti-shopping-cart"></i><span class="nav-shop__circle">3</span></button> </li> -->
            <?php if (isset($_SESSION['customer'])) {

            ?>
                


                <li class="nav-item"><a href="add_to_cart.php" class="notification"><span><i class="ti-shopping-cart" style="font-size:25px;color:dimgrey" title="Cart"></i></span><span class="badge" style="background-color:dimgrey" title="Cart"><?php $scart1 = "select * from c_cart
		  			join product_size_price on product_size_price.psp_id = c_cart.psp_id
					join product_entry on product_size_price.pe_code = product_entry.pe_code
					where cc_username = '$email' AND cc_status = 'cart'";
                                                                                                                                                                                                                                                        $rcart1 = mysqli_query($conn, $scart1);
                                                                                                                                                                                                                                                        echo  $abc = mysqli_num_rows($rcart1);
                                                                                                                                                                                                                                                        ?> </span></a></li>
                <li class="nav-item" style="margin-right: 115px; margin-left: -17px ;" >
                    <div class="dropdown">

                        <button class="dropbtn">

                            <b class="button button-header" style="color:dimgrey; padding: 10px 25px;">
                                <img src="<?php echo $image; ?>" alt="User Image" style="width: 30px; height: 30px; border-radius: 50%; object-fit: cover; border: 2px solid #ddd;">
                                <?php echo $fullname; ?></b></button>
                        <div class="dropdown-content">
                            <a href="myorder.php" class="far fa-clipboard"> <span class="custom-text">My Order</span></a>
                            <a href="wishlist.php" class="far fa-heart"> <span class="custom-text">Wishlist</span></a>
                            <a href="viewprofile.php" class="far fa-user"> <span class="custom-text">View Profile</span></a>
                            <a href="changepassword.php" class="fas fa-key"> <span class="custom-text">Change Password</span></a>
                            <a href="logout.php" class="icon icon-logout myaccount-Icon fas fa-right-from-bracket"><span class="custom-text">Logout</span></a>
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