<?php 
include("../connection.php");
include("session_admin.php");
?>
<!DOCTYPE html>
<html>
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
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <?php include("header.php"); ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php include("sidebar.php"); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Order Tracking</h1>
          </div>
        </div>
      </div>
    </div>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <center>
                <?php
                $order_id = $_GET['t'];
                $purchase_code = $_GET['p'];
                
                // Get order details - modified query to work with both parameters
                $query = "SELECT c.*, cp.* 
                         FROM c_cart c 
                         JOIN c_purchase cp ON c.cp_code = cp.cp_code 
                         WHERE (c.cc_id = '$order_id' OR c.cp_code = '$purchase_code')
                         ORDER BY c.cc_id DESC LIMIT 1";
                $result = mysqli_query($conn, $query);
                
                if(mysqli_num_rows($result) > 0) {
                    $order = mysqli_fetch_array($result);
                    $status = $order['cc_status'];
                    
                    echo "<h3>Order Code: " . $order['cp_code'] . "</h3>";
                    if($order['cc_id']) {
                        echo "<p>Cart ID: " . $order['cc_id'] . "</p>";
                    }
                    echo "<p>Customer Name: " . $order['cp_name'] . "</p>";
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
                    echo '<a href="order.php" class="btn btn-primary">Back to Orders</a>';
                    echo '</div>';
                } else {
                    echo "<div class='alert alert-danger'>Order not found.</div>";
                    echo '<div style="margin-top: 20px;">';
                    echo '<a href="order.php" class="btn btn-primary">Back to Orders</a>';
                    echo '</div>';
                }
                ?>
                </center>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- Footer -->
  <?php include("footer.php"); ?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
</div>

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
</body>
</html> 