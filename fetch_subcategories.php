<head>

</head>
<section class="section-margin calc-60px">
  <div class="container">

    <div class="section-intro pb-60px ">
      <h2>Subcategories</h2>
    </div>
    <div class="row">
  <?php
  include("connection.php");
  if (isset($_POST['cid'])) {
    $cid = $_POST['cid'];
    $query = "SELECT subcategory.*,   
       product_entry.product_image, 
       product_entry.pname, 
       product_size_price.pro_sale_price,
       product_size_price.psp_id,
       product_size_price.pcolor
    FROM subcategory
    LEFT JOIN product_entry ON subcategory.subcategory_id = product_entry.p_subid
    LEFT JOIN product_size_price ON product_entry.pe_code = product_size_price.pe_code
    WHERE subcategory.cid = '$cid'";
    
    $result = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($result)) { ?>
      <div class="col-md-6 col-lg-4 col-xl-3">
        <a class="subcategory-item" data-subcatid="<?php echo $row['subcategory_id']; ?>">
          <div class="card text-center card-product">
            <div class="card-product__img">
              <?php if (!empty($row['product_image'])) { ?>
                <img src="admin/Product_Upload/<?php echo $row['product_image']; ?>" alt="Subcategory Image"
                  class="card-img" style="background-color: darkgrey;">
              <?php } else { ?>
                <img src="admin/Product_Upload/default.png" alt="No Image Available"
                  class="card-img" style="background-color: darkgrey;">
              <?php } ?>
            </div>
            <div class="card-body">
              <p></p>
              <h4 class="card-product__title"><?php echo $row['pcolor']; ?></h4>
              <p class="card-product__price">₹<?php echo $row['pro_sale_price'] ?></p>
              <a href="customer_product.php?psp_id=<?php echo isset($row['psp_id']) ? $row['psp_id'] : 'MISSING'; ?>" class="btn btn-primary">View</a>
            </div>
          </div>
        </a>
      </div>
  <?php }
  } ?>
</div>

  </div>
</section>


<!-- menu niche -->




