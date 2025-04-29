<?php
include("connection.php");
include("session_customer.php");

$query = isset($_GET['q']) ? mysqli_real_escape_string($conn, $_GET['q']) : '';
$results = array();

if (strlen($query) >= 2) {
    // Search in categories
    $cat_query = "SELECT * FROM category WHERE category_name LIKE '%$query%'";
    $cat_result = mysqli_query($conn, $cat_query);
    if ($cat_result) {
        while ($row = mysqli_fetch_array($cat_result)) {
            $results[] = array(
                'type' => 'category',
                'id' => $row['category_id'],
                'name' => $row['category_name'],
                'link' => 'customer_product.php?cid=' . $row['category_id']
            );
        }
    }

    // Search in subcategories
    $subcat_query = "SELECT s.*, c.category_name 
                    FROM subcategory s 
                    JOIN category c ON s.cid = c.category_id 
                    WHERE s.subcategory_name LIKE '%$query%'";
    $subcat_result = mysqli_query($conn, $subcat_query);
    if ($subcat_result) {
        while ($row = mysqli_fetch_array($subcat_result)) {
            $results[] = array(
                'type' => 'subcategory',
                'id' => $row['subcategory_id'],
                'name' => $row['subcategory_name'],
                'category' => $row['category_name'],
                'link' => 'customer_product.php?subid=' . $row['subcategory_id'] . '&cid=' . $row['cid']
            );
        }
    }

    // Search in products
    $prod_query = "SELECT p.*, c.category_name, s.subcategory_name 
                  FROM product_entry p 
                  LEFT JOIN category c ON p.p_cid = c.category_id 
                  LEFT JOIN subcategory s ON p.p_subid = s.subcategory_id 
                  WHERE p.pname LIKE '%$query%' 
                  OR p.description LIKE '%$query%'";
    $prod_result = mysqli_query($conn, $prod_query);
    if ($prod_result) {
        while ($row = mysqli_fetch_array($prod_result)) {
            $results[] = array(
                'type' => 'product',
                'id' => $row['pe_code'],
                'name' => $row['pname'],
                'category' => $row['category_name'],
                'subcategory' => $row['subcategory_name'],
                'link' => 'customer_product.php?pid=' . $row['pe_code']
            );
        }
    }
}

// Output results
if (empty($results)) {
    echo '<div class="search-result-item">No results found for "' . htmlspecialchars($query) . '"</div>';
} else {
    foreach ($results as $result) {
        echo '<div class="search-result-item">';
        echo '<a href="' . $result['link'] . '">';
        echo '<div>' . htmlspecialchars($result['name']) . '</div>';
        if (isset($result['category'])) {
            echo '<div class="search-result-category">';
            if ($result['type'] == 'subcategory') {
                echo 'Subcategory in ' . htmlspecialchars($result['category']);
            } else if ($result['type'] == 'product') {
                echo 'Product in ' . htmlspecialchars($result['category']);
                if ($result['subcategory']) {
                    echo ' > ' . htmlspecialchars($result['subcategory']);
                }
            }
            echo '</div>';
        }
        echo '</a>';
        echo '</div>';
    }
}
?> 