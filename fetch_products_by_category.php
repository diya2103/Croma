<?php
include("connection.php");

if (isset($_POST['subcategory_id'])) {
  $subcat_id = $_POST['subcategory_id'];

  $query = "SELECT 
              product_entry.product_image, 
              product_entry.pname, 
              product_entry.pcolor,
              product_size_price.pro_sale_price,
              product_size_price.psp_id
            FROM product_entry
            LEFT JOIN product_size_price ON product_entry.pe_code = product_size_price.pe_code
            WHERE product_entry.p_subid = '$subcat_id'";

  $result = mysqli_query($conn, $query);

  while ($row = mysqli_fetch_assoc($result)) {
    ?>
    <div class="col-md-6 col-lg-4 col-xl-3">
      <div class="card text-center card-product">
        <div class="card-product__img">
          <img class="card-img" src="admin/Product_Upload/<?php echo $row['product_image']; ?>" alt="Product Image" style="background-color: darkgrey;">
        </div>
        <div class="card-body">
          <h4 class="card-product__title"><?php echo $row['pname']; ?></h4>
          <p class="card-product__price">₹<?php echo $row['pro_sale_price']; ?></p>
          <a href="customer_product.php?psp_id=<?php echo $row['psp_id']; ?>" class="btn btn-primary">View</a>
        </div>
      </div>
    </div>
    <?php
  }
}
?>
hij