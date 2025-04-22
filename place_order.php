<?php 
include("connection.php");
include("session_customer.php");

if(isset($_REQUEST['btn_submit'])) {
    $nm = $_REQUEST['txt_nm'];
    $add = $_REQUEST['txt_add'];
    $cno = $_REQUEST['txt_cno'];
    $cnoa = $_REQUEST['txt_cnoa'];
    $pin = $_REQUEST['txt_pin'];
    $user = $_SESSION['customer'];
    $c = 10001;
    $ss = "select * from c_purchase";
    $rr = mysqli_query($conn,$ss);
    while($ww = mysqli_fetch_array($rr)) {
        $c = $ww['cp_id'] + 10001;
    }
    $date = date('Y-m-d');
    $status = 'ordered';
    
    // Create the order record
    $insert = "insert into c_purchase values('','$c','$user','$nm','$add','$cno','$cnoa','$pin','$date','$status')";
    mysqli_query($conn,$insert);
    
    // Update cart items to link them to this order
    $update = "update c_cart set cp_code = '$c', cc_status = '$st' where cc_username = '$user' AND cc_status = 'cart'";
    mysqli_query($conn,$update);
    
    // Delete cart items to clear the cart
    $delete_cart = "delete from c_cart where cc_username = '$user' AND cc_status = 'ordered'";
    mysqli_query($conn, $delete_cart);
    
    // Redirect to cart page or order confirmation
    header("location:add_to_cart.php");
    exit();
}

// For Razorpay payment handling
if (isset($_REQUEST['razorpay_payment_id'])) {
    // Create payment_details table if it doesn't exist
    $create_table = "CREATE TABLE IF NOT EXISTS payment_details (
        id INT AUTO_INCREMENT PRIMARY KEY,
        order_id VARCHAR(50) NOT NULL,
        payment_id VARCHAR(100) NOT NULL,
        payment_method VARCHAR(50) NOT NULL,
        payment_date DATE NOT NULL
    )";
    
    if (!mysqli_query($conn, $create_table)) {
        die("Error creating payment_details table: " . mysqli_error($conn));
    }

    $payment_id = $_REQUEST['razorpay_payment_id'];
    $nm = $_REQUEST['txt_nm'];
    $add = $_REQUEST['txt_add'];
    $cno = $_REQUEST['txt_cno'];
    $cnoa = $_REQUEST['txt_cnoa'];
    $pin = $_REQUEST['txt_pin'];
    $user = $_SESSION['customer'];
    $c = 10001;
    $ss = "select * from c_purchase";
    $rr = mysqli_query($conn, $ss);
    while ($ww = mysqli_fetch_array($rr)) {
        $c = $ww['cp_id'] + 10001;
    }
    $date = date('Y-m-d');
    $status = 'ordered';

    // Start transaction
    mysqli_begin_transaction($conn);

    try {
        // Create the order with payment info
        $insert = "insert into c_purchase values('','$c','$user','$nm','$add','$cno','$cnoa','$pin','$date','$status')";
        if (!mysqli_query($conn, $insert)) {
            throw new Exception("Error creating order: " . mysqli_error($conn));
        }

        // Store payment details
        $payment_insert = "insert into payment_details (order_id, payment_id, payment_method, payment_date) 
                          values('$c','$payment_id','razorpay','$date')";
        if (!mysqli_query($conn, $payment_insert)) {
            throw new Exception("Error storing payment details: " . mysqli_error($conn));
        }

        // Update cart items to mark them as processed
        $update = "update c_cart set cp_code = '$c', cc_status = 'ordered' 
                   where cc_username = '$user' AND cc_status = 'cart'";
        if (!mysqli_query($conn, $update)) {
            throw new Exception("Error updating cart status: " . mysqli_error($conn));
        }

        // Delete cart items
        $delete_cart = "delete from c_cart 
                        where cc_username = '$user' 
                        AND cc_status = 'cart'";
        if (!mysqli_query($conn, $delete_cart)) {
            throw new Exception("Error clearing cart: " . mysqli_error($conn));
        }

        // Commit transaction
        mysqli_commit($conn);
        
        // Redirect to cart page with success message
        header("location:add_to_cart.php?payment=success");
        exit();
    } catch (Exception $e) {
        // Rollback transaction on error
        mysqli_rollback($conn);
        die("Transaction failed: " . $e->getMessage());
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php include("css.php"); ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script>
function validate(field, query) {
    var xmlhttp;
    if (window.XMLHttpRequest) { 
        xmlhttp = new XMLHttpRequest();
    } else { 
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState < 4) {
            document.getElementById(field).innerHTML = "Validating...";
        } else if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
            document.getElementById(field).innerHTML = xmlhttp.responseText;
        } 
    };

    xmlhttp.open("GET", "ajax_main.php?field=" + field + "&query=" + query, true);
    xmlhttp.send();
}

$(document).ready(function() {
    // Event handler for the Pay Now button
    $(document).on("click", "#btn_pay", function() {
        var paymentMethod = $("#txt_payment").val();

        if (paymentMethod === "razorpay") {
            initiateRazorpay();
        } else if (paymentMethod === "cash") {
            // Submit the form directly for 
			
            $("#orderForm").submit();
        } else {
            alert("Please select a payment method");
        }
    });
});

function initiateRazorpay() {
    // Get amount from hidden field that was set by ajax response
    var amount = document.getElementById('razorpay_amount').value;
    
    var options = {
        "key": "rzp_test_7cAYWDrHyJZOBd", // Your Razorpay API Key
        "amount": amount, // Amount in paise
        "currency": "INR",
        "name": "Your Store Name",
        "description": "Order Payment",
        "image": "your-logo.png",
        "handler": function(response) {
            // Create a new form for submission
            var form = document.createElement('form');
            form.method = 'POST';
            form.action = 'place_order.php';

            // Add all the form fields
            var fields = ['txt_nm', 'txt_add', 'txt_cno', 'txt_cnoa', 'txt_pin'];
            fields.forEach(function(field) {
                var input = document.createElement('input');
                input.type = 'hidden';
                input.name = field;
                input.value = document.getElementsByName(field)[0].value;
                form.appendChild(input);
            });

            // Add the payment ID
            var paymentInput = document.createElement('input');
            paymentInput.type = 'hidden';
            paymentInput.name = 'razorpay_payment_id';
            paymentInput.value = response.razorpay_payment_id;
            form.appendChild(paymentInput);

            // Submit the form
            document.body.appendChild(form);
            form.submit();
        },
        "prefill": {
            "name": document.getElementsByName("txt_nm")[0].value,
            "contact": document.getElementsByName("txt_cno")[0].value
        },
        "theme": {
            "color": "#3399cc"
        }
    };
    var rzp = new Razorpay(options);
    rzp.open();
}
</script>
</head>
<body>
  <!--================ Start Header Menu Area =================-->
<?php include("customer_header.php"); ?>
  <main class="site-main">
    <section class="section-margin calc-100px">
      <div class="container">
        <div class="section-intro pb-100px" align="center">
          <h2>Place Order</h2>
        </div>
        <div class="row">    
            <form method="post" id="orderForm">                        
                <div class="">
                    <input type="text" name="txt_nm" placeholder="Name" required class="form-control" style="width:500px"><br>
                    <div class="clearfix"></div>
                </div>
                <div class="key">
                    <input type="text" name="txt_add" placeholder="Delivery Address" required class="form-control" style="width:500px"><br>
                    <div class="clearfix"></div>
                </div>
                <div class="key">
                    <input type="text" name="txt_cno" placeholder="Contact" required pattern="[0-9]{10,10}" class="form-control" title="10 digit number" style="width:500px"><br>
                    <div class="clearfix"></div>
                </div>
                <div class="key">
                    <input type="text" name="txt_cnoa" placeholder="Alternative Contact" required pattern="[0-9]{10,10}" class="form-control" title="10 digit number" style="width:500px"><br>
                    <div class="clearfix"></div>
                </div>
                <div class="key">
                    <input type="text" name="txt_pin" placeholder="Pincode" onChange="validate('pincode',this.value)" class="form-control" required pattern="[0-9]{6,6}" title="6 digit pincode" style="width:500px"><br>
                    <div class="clearfix"></div>
                </div>                      
                <div id="pincode">
                    <div class="key">
                    <select name="txt_payment" id="txt_payment" class="form-control" required onChange="validate('payment',this.value)" disabled="disabled" style="width:500px;"><br><br>
                        <option value="">-- Select payment --</option>
                        <option value="cash">Cash on delivery</option>
                        <option value="razorpay">Online Payment (Razorpay)</option>
                    </select>
                    </div>
                </div>                      
                <div id="payment">
                    <!-- Payment button will be inserted here via AJAX -->
                </div>                      
            </form>        
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