<!DOCTYPE html>
<html lang="en">

<head>
  <style>
    .carousel-item {
      background-color: #000;
      height: 500px;
      position: relative;
    }

    .carousel-item img {
      object-fit: cover;
      height: 100%;
      width: 100%;
    }

    .carousel-caption {
      background: rgba(0, 0, 0, 0.5);
      padding: 20px;
      border-radius: 10px;
      bottom: 20%;
      left: 10%;
      right: 10%;
    }

    .carousel-control-prev,
    .carousel-control-next {
      width: 5%;
      opacity: 0.8;
    }

    .carousel-control-prev:hover,
    .carousel-control-next:hover {
      opacity: 1;
    }

    .carousel-indicators {
      bottom: 10%;
    }

    .carousel-indicators button {
      width: 12px;
      height: 12px;
      border-radius: 50%;
      margin: 0 5px;
    }

    .product-card {
      transition: transform 0.2s ease, box-shadow 0.2s ease;
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
 
    html {
        scroll-behavior: smooth;
    }

  </style>


  
  <link rel="preload" as="image" href="img/phone.webp">
  <link rel="preload" as="image" href="img/hppc.webp">
  <link rel="preload" as="image" href="img/headphone.webp">


  <?php include("css.php"); ?>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Bootstrap Bundle JS (correct one for 5.x) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


</head>

<body>
  <!--================ Start Header Menu Area =================-->
  <?php include("customer_header.php");  ?>
  <!--================ End Header Menu Area =================-->

  <main class="site-main">

    <!--================ Hero banner start =================-->
    <div id="carouselExampleControls" class="carousel slide carousel-fade" data-bs-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img class="d-block w-100" src="img/phone.webp" alt="First slide" style="height:577px">
        </div>
        <div class="carousel-item">
          <img class="d-block w-100" src="img/hppc.webp" alt="Second slide" style="height:577px">
        </div>
        <div class="carousel-item">
          <img class="d-block w-100" src="img/headphone.webp" alt="Third slide" style="height:577px">
        </div>
      </div>
      <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>

    <!-- Start Filter Bar -->

    <!-- End Filter Bar -->

    <?php
    $filter = "";

    if (isset($_GET['category_id']) && !empty($_GET['category_id'])) {
        $cat_id = mysqli_real_escape_string($conn, $_GET['category_id']);
        $filter = " AND product_entry.category_id = '$cat_id'";
    }

    $select = "SELECT * FROM product_size_price 
    JOIN product_entry ON product_size_price.pe_code = product_entry.pe_code 
    WHERE product_size_price.psp_id = product_size_price.psp_id $filter";

    $res = mysqli_query($conn, $select);
    ?>



    <div class="trending-products"  id="product-section">
      <!-- Subcategories or Products will load here dynamically -->
    </div>



    <section class="section-margin calc-60px">
      <div class="container">
        <div class="section-intro pb-60px">
          <p></p>
          <h2>Trending Product</h2>
        </div>
        <div class="row">

          <?php
          $sel1 = "select * from category";
          $res1 = mysqli_query($conn, $sel1);
          while ($row1 = mysqli_fetch_array($res1)) {
            $catid = $row1['category_id'];
          ?>

            <?php while ($row = mysqli_fetch_array($res)) {  ?>
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
          <?php } ?>
        </div>
      </div>
    </section>
    <!-- ================ trending product section end ================= -->

  </main>


  <!--================ Start footer Area  =================-->
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
  <!-- to fetch subcategories -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function() {
      $("#categoryDropdown").change(function() {
        var category_id = $(this).val();

        if (category_id !== "") {
          $.ajax({
            url: "fetch_subcategories.php",
            method: "POST",
            data: {
              category_id: category_id
            }, // Correct key name
            success: function(response) {
              $("#subcategory").html(response);
            }
          });
        } else {
          $("#subcategory").html('<option value="">Selectyyt Subcategory</option>');
        }
      });
    });
  </script>

  <!-- to fetch products -->

  <script>
    $(document).ready(function() {
      $('#subcategory').change(function() {
        var subcat_id = $(this).val();

        if (subcat_id !== "") {
          $.ajax({
            url: "fetch_products_by_subcategory.php",
            type: "POST",
            data: {
              subcategory_id: subcat_id
            },
            success: function(data) {
              $(".trending-products").html(data); // Load filtered products
            }
          });
        } else {
          $(".trending-products").html(""); // Optional: Clear if no subcategory selected
        }
      });
    });
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>