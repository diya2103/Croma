<?php
include("connection.php");
include("session_customer.php");

if (isset($_POST['razorpay_payment_id'])) {
    $payment_id = $_POST['razorpay_payment_id'];
    $email = $_SESSION['customer'];

    // Process the order (e.g., save order details to an orders table)
    // Example: Uncomment and customize if you have an orders table
    /*
    $total_amount = $_POST['total_amount']; // Ensure total_amount is passed from the form
    $order_query = "INSERT INTO orders (user_email, payment_id, total_amount, order_date) 
                    VALUES (?, ?, ?, NOW())";
    $stmt = mysqli_prepare($conn, $order_query);
    mysqli_stmt_bind_param($stmt, "ssd", $email, $payment_id, $total_amount);
    if (!mysqli_stmt_execute($stmt)) {
        die("Error saving order: " . mysqli_error($conn));
    }
    mysqli_stmt_close($stmt);
    */

    // Clear the cart for the user
    $clear_cart = "DELETE FROM c_cart WHERE cc_username = ? AND cc_status = 'cart'";
    $stmt = mysqli_prepare($conn, $clear_cart);
    mysqli_stmt_bind_param($stmt, "s", $email);
    if (!mysqli_stmt_execute($stmt)) {
        die("Error clearing cart: " . mysqli_error($conn));
    }
    mysqli_stmt_close($stmt);

    // Redirect to cart with success message
    header("Location: add_to_cart.php?success=payment_completed");
    exit();
} else {
    // No payment ID provided
    header("Location: add_to_cart.php?error=invalid_payment");
    exit();
}
?>