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
<?php }
      } ?>
</div>
</div>
</section>


<!-- menu niche -->