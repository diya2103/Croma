


<section class="section-margin calc-60px">
<?php
include("connection.php");

if (isset($_POST['cid'])) {
    $cid = $_POST['cid'];
    $query = "SELECT subcategory.*, product_entry.product_image, product_entry.pname 
              FROM subcategory 
              LEFT JOIN product_entry ON subcategory.subcategory_id = product_entry.p_subid 
              WHERE subcategory.cid = '$cid'";
    $result = mysqli_query($conn, $query);

    echo "<h2>Subcategories</h2>";
    echo "<div class='row'>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<div class='col-md-4'>";
        echo "<a href='#' class='subcategory-item' data-subcatid='" . $row['subcategory_id'] . "'>";
        // echo "<div class='card'>";
        // echo "<div class='card-body'>";
        
        
        // Display the image if available, else show a placeholder
        echo "<section class='section-margin calc-60px'>";
        echo "<div class='container'>";
        echo "<div class='section-intro pb-60px'>";
        echo "<div class-'row'";
        echo "<div class='col-md-6 col-lg-4 col-xl-3'>";
        echo "<div class='card text-center card-product'>";
        echo "<div class='card-product__img'>";
        if (!empty($row['product_image'])) {
            echo "<img clas='card-img' src='admin/Product_Upload/" . $row['product_image'] . "' alt='Subcategory Image' class='img-fluid' style='width: 100%; height: 150px; object-fit: cover;'>";
        } else {
            echo "<img src='admin/Product_Upload/default.png' alt='No Image Available' class='img-fluid' style='width: 100%; height: 150px; object-fit: cover;'>";
        }
        echo "</div></div></div><div></div></div></section>";

        echo '<h4 class="card-product__title">' . $row['pname'] . "</h4>"; // Display subcategory name
       
        echo '<p class="card-product__price">₹' . $row['pro_sale_price'] . '</p>';

        echo "</div></div></a></div>";
    }
    echo "</div>";
}
?>
</section>










