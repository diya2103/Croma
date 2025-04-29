<?php 

include("connection.php");
include("session_customer.php");

	
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include("css.php"); ?>
<style>
ol.progtrckr {
    margin: 0;
    padding: 0;
    list-style-type: none;
}

ol.progtrckr li {
    display: inline-block;
    text-align: center;
    line-height: 3.5em;
}

ol.progtrckr[data-progtrckr-steps="2"] li { width: 49%; }
ol.progtrckr[data-progtrckr-steps="3"] li { width: 33%; }
ol.progtrckr[data-progtrckr-steps="4"] li { width: 24%; }
ol.progtrckr[data-progtrckr-steps="5"] li { width: 19%; }
ol.progtrckr[data-progtrckr-steps="6"] li { width: 16%; }
ol.progtrckr[data-progtrckr-steps="7"] li { width: 14%; }
ol.progtrckr[data-progtrckr-steps="8"] li { width: 12%; }
ol.progtrckr[data-progtrckr-steps="9"] li { width: 11%; }

ol.progtrckr li.progtrckr-done {
    color: black;
    border-bottom: 4px solid yellowgreen;
}
ol.progtrckr li.progtrckr-todo {
    color: silver; 
    border-bottom: 4px solid silver;
}

ol.progtrckr li:after {
    content: "\00a0\00a0";
}
ol.progtrckr li:before {
    position: relative;
    bottom: -2.5em;
    float: left;
    left: 50%;
    line-height: 1em;
}
ol.progtrckr li.progtrckr-done:before {
    content: "\2713";
    color: white;
    background-color: yellowgreen;
    height: 2.2em;
    width: 2.2em;
    line-height: 2.2em;
    border: none;
    border-radius: 2.2em;
}
ol.progtrckr li.progtrckr-todo:before {
    content: "\039F";
    color: silver;
    background-color: white;
    font-size: 2.2em;
    bottom: -1.2em;
}
</style>
</head>
<body>
  <!--================ Start Header Menu Area =================-->
<?php include("customer_header.php"); ?>
	<!--================ End Header Menu Area =================-->

  <main class="site-main">
    <section class="section-margin calc-200px">
      <div class="container">
        <div class="section-intro pb-200px">
          <center><h2>Order Tracking</h2></center>
        </div>
        <div class="">
            <center>
			<?php
            $user = $_SESSION['customer'];
            $order_id = $_GET['t'];
            $purchase_code = $_GET['p'];
            
            // Get order details with purchase information
            $query = "SELECT c.*, cp.* FROM c_cart c 
                     JOIN c_purchase cp ON c.cp_code = cp.cp_code 
                     WHERE c.cc_username = '$user' AND c.cc_id = '$order_id'";
            $result = mysqli_query($conn, $query);
            
            if(mysqli_num_rows($result) > 0) {
                $order = mysqli_fetch_array($result);
                $status = $order['cc_status'];
                
                echo "<h3>Order Code: " . $order['cp_code'] . "</h3>";
                echo "<p>Order ID: " . $order_id . "</p>";
                echo "<p>Current Status: <strong>" . ucfirst($status) . "</strong></p>";
                
                // Display tracking progress
                echo '<ol class="progtrckr" data-progtrckr-steps="5">';
                
                // Define all possible statuses
                $statuses = array('ordered', 'process', 'dispatched', 'delivered');
                
                foreach($statuses as $s) {
                    // Modified logic: "ordered" is always done, others follow normal progression
                    $class = ($s == 'ordered' || $s == $status || array_search($s, $statuses) < array_search($status, $statuses)) 
                            ? 'progtrckr-done' 
                            : 'progtrckr-todo';
                    echo '<li class="' . $class . '">' . ucfirst($s) . '</li>';
                }
                
                echo '</ol>';
                
                // Display additional order information
                echo "<div class='order-details' style='margin-top: 20px;'>";
                echo "<h4>Order Details</h4>";
                echo "<p>Order Date: " . $order['cc_date'] . "</p>";
                echo "<p>Total Amount: ₹" . $order['cc_total'] . "</p>";
                echo "<p>Shipping Address: " . $order['cp_address'] . " - " . $order['cp_pincode'] . "</p>";
                echo "<p>Contact: " . $order['cp_contact'] . "</p>";
                
                // Display cancel/return information if applicable
                if($status == 'cancel') {
                    echo "<div class='alert alert-warning'>";
                    echo "<h5>Cancellation Details</h5>";
                    echo "<p>Cancel Date: " . $order['cancel_date'] . "</p>";
                    echo "<p>Cancel Reason: " . $order['cancel_desc'] . "</p>";
                    echo "<p>Status: " . $order['cancel_status'] . "</p>";
                    echo "</div>";
                } else if($status == 'return') {
                    echo "<div class='alert alert-info'>";
                    echo "<h5>Return Details</h5>";
                    echo "<p>Return Date: " . $order['return_date'] . "</p>";
                    echo "<p>Return Reason: " . $order['return_desc'] . "</p>";
                    echo "<p>Status: " . $order['return_status'] . "</p>";
                    echo "</div>";
                }
                
                echo "</div>";
                
                // Add a back button
                echo '<div style="margin-top: 20px;">';
                echo '<a href="cus_product.php?p=' . $order['cp_code'] . '" class="btn btn-primary">Back to Order Details</a>';
                echo '</div>';
            } else {
                echo "<div class='alert alert-danger'>Order not found or you don't have permission to view this order.</div>";
                echo '<div style="margin-top: 20px;">';
                echo '<a href="cus_product.php" class="btn btn-primary">Back to Orders</a>';
                echo '</div>';
            }
            ?>
            </center>
        </div>
      </div>
    </section>
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