<?php
$indexClicked = isset($_GET['psp_id']);
$headerClicked = isset($_REQUEST['subid']) && !$indexClicked;
$categoryClicked = isset($_REQUEST['cid']) && !$indexClicked && !$headerClicked;
?>
<?php
include("connection.php");
include("session_customer.php");

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
      --card-bg: #fff;
      --card-title: #222;
      --card-subtitle: #666;
      --border-color: #dee2e6;
      --btn-outline: #007bff;
      --btn-outline-hover: #0056b3;
    }
    [data-theme="dark"] {
      --primary-bg: #181818;
      --secondary-bg: #232323;
      --text-color: #f1f1f1;
      --card-bg: #232323;
      --card-title: #f1f1f1;
      --card-subtitle: #b0b0b0;
      --border-color: #444;
      --btn-outline: #4fd8ff;
      --btn-outline-hover: #00bfff;
    }
    body {
      background: var(--primary-bg);
      color: var(--text-color);
      transition: background 0.3s, color 0.3s;
    }
    .section-intro h2, h2, label {
      color: var(--text-color) !important;
    }
    .product-card {
      background: var(--card-bg);
      color: var(--text-color);
      border: 1px solid var(--border-color);
      transition: transform 0.2s ease, box-shadow 0.2s ease, background 0.3s, color 0.3s;
      border-radius: 12px;
      overflow: hidden;
    }
    .product-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }
    .product-img {
      transition: transform 0.3s ease;
      height: 250px;
      object-fit: cover;
    }
    .product-card:hover .product-img {
      transform: scale(1.05);
    }
    .card-title, .fw-bold {
      color: var(--card-title) !important;
    }
    .card-subtitle, .text-muted {
      color: var(--card-subtitle) !important;
    }
    .btn-outline-primary {
      color: var(--btn-outline) !important;
      border-color: var(--btn-outline) !important;
      background: transparent;
      transition: color 0.2s, border-color 0.2s, background 0.2s;
    }
    .btn-outline-primary:hover {
      color: #fff !important;
      background: var(--btn-outline-hover) !important;
      border-color: var(--btn-outline-hover) !important;
    }
    html {
      scroll-behavior: smooth;
    }
  </style>
</head>

<body>
  <!--================ Start Header Menu Area =================-->
  <?php include("customer_header.php"); ?>
  <!--================ End Header Menu Area =================-->

  <main class="site-main">

    <!--================ Hero banner start =================-->
    <!-- <section class="hero-banner">
      <div class="container">
        <div class="row no-gutters align-items-center pt-60px">
          <div class="col-5 d-none d-sm-block">
            <div class="hero-banner__img">
              <img class="img-fluid" src="img/home/hero-banner.png" alt="">
            </div>
          </div>
          <div class="col-sm-7 col-lg-6 offset-lg-1 pl-4 pl-md-5 pl-lg-0">
            <div class="hero-banner__content">
              <h4>Shop is fun</h4>
              <h1>Browse Our Premium Product</h1>
              <p>Us which over of signs divide dominion deep fill bring they're meat beho upon own earth without morning over third. Their male dry. They are great appear whose land fly grass.</p>
              <a class="button button-hero" href="#">Browse Now</a>
            </div>
          </div>
        </div>
      </div>
    </section> -->
    <!--================ Hero banner start =================-->

    <!--================ Hero Carousel start =================-->
    <!-- <section class="section-margin mt-0">
      <div class="owl-carousel owl-theme hero-carousel">
        <div class="hero-carousel__slide">
          <img src="img/home/hero-slide1.png" alt="" class="img-fluid">
          <a href="#" class="hero-carousel__slideOverlay">
            <h3>Wireless Headphone</h3>
            <p>Accessories Item</p>
          </a>
        </div>
        <div class="hero-carousel__slide">
          <img src="img/home/hero-slide2.png" alt="" class="img-fluid">
          <a href="#" class="hero-carousel__slideOverlay">
            <h3>Wireless Headphone</h3>
            <p>Accessories Item</p>
          </a>
        </div>
        <div class="hero-carousel__slide">
          <img src="img/home/hero-slide3.png" alt="" class="img-fluid">
          <a href="#" class="hero-carousel__slideOverlay">
            <h3>Wireless Headphone</h3>
            <p>Accessories Item</p>
          </a>
        </div>
      </div>
    </section> -->
    <!--================ Hero Carousel end =================-->

    <!-- ================ trending product section start ================= -->

    <!-- index clicked products -->

    <?php if ($indexClicked) { 
    $subcategoryid = $_GET['psp_id'];
    $select = "SELECT * FROM product_size_price 
               JOIN product_entry ON product_size_price.pe_code = product_entry.pe_code 
               WHERE product_size_price.psp_id = '$subcategoryid'";
    $res = mysqli_query($conn, $select);
?>
    <section class="section-margin calc-100px">
      <div class="container">
        <div class="section-intro pb-100px">
          <h2>Products</h2>
        </div>
        <div class="row">
          <?php if ($res && mysqli_num_rows($res) > 0) {
            while ($rows = mysqli_fetch_array($res)) {
          ?>
              <div class="col-md-6 col-lg-4 col-xl-3 mb-4">
                <div class="card border-0 shadow-sm h-100 product-card">
                  <div class="position-relative overflow-hidden" style="background-color: darkgray;">
                    <img src="admin/Product_Upload/<?php echo $row['product_image']; ?>" class="card-img-top img-fluid product-img" alt="<?php echo $row['pcolor']; ?>">
                  </div>
                  <div class="card-body text-center">
                    <h6 class="card-subtitle text-muted mb-1"><?php echo $row['pcolor']; ?></h6>
                    <h5 class="card-title fw-bold mb-2">₹<?php echo $row['pro_sale_price']; ?></h5>
                    <a href="customersingle_product.php?psp_id=<?php echo $row['psp_id']; ?>" class="btn btn-outline-primary btn-sm rounded-pill">View Product</a>
                  </div>
                </div>
              </div>
          <?php
            }
          } else {
            echo "<p>No products found.</p>";
          }
          ?>
        </div>
      </div>
    </section>
    <?php }?>

    <!-- Category products section -->
    <?php if ($categoryClicked) { 
        $categoryid = $_REQUEST['cid'];
        $select = "SELECT subcategory.*,   
       product_entry.product_image, 
       product_entry.pname, 
       product_size_price.pro_sale_price,
       product_size_price.psp_id,
       product_size_price.pcolor
    FROM subcategory
    LEFT JOIN product_entry ON subcategory.subcategory_id = product_entry.p_subid
    LEFT JOIN product_size_price ON product_entry.pe_code = product_size_price.pe_code
    WHERE subcategory.cid = '$categoryid'";
        $res = mysqli_query($conn, $select);
    ?>
    <section class="section-margin calc-60px">
      <div class="container">
        <div class="section-intro pb-60px">
          <h2>Subcategories</h2>
        </div>
        <div class="row">
          <?php while ($row = mysqli_fetch_array($res)) { ?>
            <div class="col-md-6 col-lg-4 col-xl-3 mb-4">
              <div class="card border-0 shadow-sm h-100 product-card">
                <div class="position-relative overflow-hidden" style="background-color: darkgray;">
                  <img src="admin/Product_Upload/<?php echo $row['product_image']; ?>" class="card-img-top img-fluid product-img" alt="<?php echo $row['subcategory_name']; ?>">
                </div>
                <div class="card-body text-center">
                  <h6 class="card-subtitle text-muted mb-1"><?php echo $row['pcolor']; ?></h6>
                <h5 class="card-title fw-bold mb-2">₹<?php echo $row['pro_sale_price']; ?></h5>
                <a href="customersingle_product.php?psp_id=<?php echo $row['psp_id']; ?>" class="btn btn-outline-primary btn-sm rounded-pill">View Product</a>
                  </div>
              </div>
            </div>
          <?php } ?>
        </div>
      </div>
    </section>
    <?php } ?>

    <!-- header section product -->
    <?php if ($headerClicked) { 
    $subcategoryid = $_REQUEST['subid'];
    $select = "SELECT * FROM product_entry 
               JOIN product_size_price ON product_size_price.pe_code = product_entry.pe_code 
               WHERE product_entry.p_subid = '$subcategoryid'";
    $res = mysqli_query($conn, $select);
?>
    
    <section class="section-margin calc-60px">
      <div class="container">
        <div class="section-intro pb-60px">
          <h2>Productss</h2>
        </div>
        <div class="row">
          <?php while ($row = mysqli_fetch_array($res)) {
            // print_r($rows);die;
            
          ?>
           <div class="col-md-6 col-lg-4 col-xl-3 mb-4">
                <div class="card border-0 shadow-sm h-100 product-card">
                  <div class="position-relative overflow-hidden" style="background-color: darkgray;">
                    <img src="admin/Product_Upload/<?php echo $row['product_image']; ?>" class="card-img-top img-fluid product-img" alt="<?php echo $row['pcolor']; ?>">
                  </div>
                  <div class="card-body text-center">
                    <h6 class="card-subtitle text-muted mb-1"><?php echo $row['pcolor']; ?></h6>
                    <h5 class="card-title fw-bold mb-2">₹<?php echo $row['pro_sale_price']; ?></h5>
                    <a href="customersingle_product.php?psp_id=<?php echo $row['psp_id']; ?>" class="btn btn-outline-primary btn-sm rounded-pill">View Product</a>
                  </div>
                </div>
              </div>
          <?php } ?>
        </div>
      </div>
    </section>
    <?php }?>
   
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
  <script>
    $(document).ready(function() {
      $("#categoryDropdown").change(function() {
        var catid = $(this).val(); // Get selected category ID

        if (catid) {
          $.ajax({
            url: "fetch_subcategories.php",
            type: "POST",
            data: {
              category_id: catid
            },
            success: function(data) {
              $(".trending-products").html(data); // Display products in trending section
            }
          });
        }
      });
    });
  </script>
  
</body>

</html>