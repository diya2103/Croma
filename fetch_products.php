<?php
include("connection.php");

if (isset($_POST['subcatid'])) {
    $subcatid = $_POST['subcatid'];
    $query = "SELECT * FROM product_entry WHERE subcategory_id = '$subcatid'";
    $result = mysqli_query($conn, $query);

    echo "<h2>Products</h2>";
    echo "<div class='row'>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<div class='col-md-4'>";
        echo "<div class='card text-center card-product'>";
        echo "<div class='card-product__img'>";
        echo "<img class='card-img' src='admin/Product_Upload/" . $row['product_image'] . "' alt=''>";
        echo "</div>";
        echo "<div class='card-body'>";
        echo "<h4 class='card-product__title'><a href='customersingle_product.php?id=" . $row['pe_code'] . "'>" . $row['pname'] . "</a></h4>";
        echo "<p class='card-product__price'>₹" . $row['pro_sale_price'] . "</p>";
        echo "</div></div></div>";
    }
    echo "</div>";
}
?>


<!-- ..... -->
<?php
include("connection.php");

if (isset($_POST['subcategory_id'])) {
    $subcategory_id = $_POST['subcategory_id'];

    $query = "SELECT subcategory.*, 
       product_entry.product_image, 
       product_entry.pname, 
       product_size_price.pro_sale_price,
       product_size_price.psp_id,
       product_size_price.pcolor
FROM subcategory
LEFT JOIN product_entry ON subcategory.subcategory_id = product_entry.p_subid
LEFT JOIN product_size_price ON product_entry.pe_code = product_size_price.pe_code
WHERE subcategory.subcategory_id = '$subcategory_id'";

    
    $result = mysqli_query($conn, $query);

    echo '<section class="section-margin calc-60px">';
    echo '<div class="container">';
    echo '<div class="section-intro pb-60px mt-5">';
    echo '<h2>Products</h2>';
    echo '</div>';
    echo '<div class="row">'; // <-- Add row wrapper

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            ?>
            <div class="col-md-6 col-lg-4 col-xl-3">
              <div class="card text-center card-product">
                <div class="card-product__img">
                  <img class="card-img" src="admin/Product_Upload/<?php echo $row['product_image']; ?>" alt="" style="background-color: darkgrey;">
                </div>
                <div class="card-body">
                  <h4 class="card-product__title"><?php echo $row['pcolor']; ?></h4>
                  <p class="card-product__price">₹<?php echo $row['pro_sale_price'] ?></p>
                  <a href="customer_product.php?psp_id=<?php echo $row['psp_id']; ?>" class="btn btn-primary">View</a>
                </div>
              </div>
            </div>
<?php
        }
    } else {
        echo "<p>No products found for this subcategory.</p>";
    }

    echo '</div>'; // <-- close row
    echo '</div>';
    echo '</section>';
}
?>
