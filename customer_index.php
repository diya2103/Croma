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
    
    <!--================ Hero banner start =================-->
    <section class="hero-banner">
      <div class="container ">
        <div class="row no-gutters align-items-center pt-60px">
          <div class="col-5 d-none d-sm-block">
            <div class="hero-banner__img">
              <img class="img-fluid" src="img/category/1200x800_7_1681881931663.jpg" alt="">
            </div>
          </div>
          <div class="col-sm-7 col-lg-6 offset-lg-1 pl-4 pl-md-5 pl-lg-0">
            <div class="hero-banner__content">
            <h4>Shop is fun</h4>
              <h3 style="color:#555555;"><b>Croma</b></h3>
              <p>Croma is India's first and most trusted large format specialist retail store. Founded in 2006, Croma caters to everyone's multi-brand digital gadgets and home electronic needs.</p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--================ Hero banner start =================-->

    <!-- ================ trending product section start ================= --> 
    <?php
    $select = "SELECT product_entry.*,product_size_price.* FROM product_entry JOIN product_size_price ON product_size_price.pe_code = product_entry.pe_code";
    $res = mysqli_query($conn,$select);  
    ?>
    <section class="section-margin calc-60px">
      <div class="container">
        <div class="section-intro pb-60px">
          <p></p>
          <h2>Trending Product</h2>
        </div>
        <div class="row">
          <?php while($row = mysqli_fetch_array($res)){  ?>
          <div class="col-md-6 col-lg-4 col-xl-3">
            <div class="card text-center card-product">
              <div class="card-product__img">
                <img class="card-img" src="admin/Product_Upload/<?php echo $row['product_image']; ?>" height="200px" width="200px" alt="">
                <!-- <ul class="card-product__imgOverlay">
                  <li><button><i class="ti-shopping-cart"></i></button></li>
                </ul> -->
              </div>
              <div class="card-body">
                <p></p>
                <h4 class="card-product__title"><a href="customersingle_product.php?pid=<?php echo $row['psp_id']; ?>"><?php echo $row['pname'] ?></a></h4>
                <p class="card-product__price">₹ <?php echo $row['pro_sale_price'] ?></p>
              </div>
            </div>
          </div>
          <?php } ?>
        </div>
      </div>
    </section>
    <!-- ================ trending product section end ================= -->  


    <!-- ================ offer section start ================= --> 
    <!-- <section class="offer" id="parallax-1" data-anchor-target="#parallax-1" data-300-top="background-position: 20px 30px" data-top-bottom="background-position: 0 20px">
      <div class="container">
        <div class="row">
          <div class="col-xl-5">
            <div class="offer__content text-center">
              <h3>Up To 50% Off</h3>
              <p></p>
              <a class="button button--active mt-3 mt-xl-4" href="customer_i.php">Shop Now</a>
            </div>
          </div>
        </div>
      </div>
    </section> -->
    <!-- ================ offer section end ================= --> 


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