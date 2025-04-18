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
    
    // Redirect to cart page or order confirmation
    header("location:add_to_cart.php");
}

// For Razorpay payment handling
if(isset($_REQUEST['razorpay_payment_id'])) {
    $payment_id = $_REQUEST['razorpay_payment_id'];
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
    
    // Create the order with payment info
    $insert = "insert into c_purchase values('','$c','$user','$nm','$add','$cno','$cnoa','$pin','$date','$status')";
    mysqli_query($conn,$insert);
    
    // You may want to store payment details in another table
    $payment_insert = "insert into payment_details values('','$c','$payment_id','razorpay','$date')";
    mysqli_query($conn,$payment_insert);
    
    // Update cart items
    $update = "update c_cart set cp_code = '$c', cc_status = 'ordered' where cc_username = '$user' AND cc_status = 'cart'";
    mysqli_query($conn,$update);
    
    // Redirect to success page
    header("location:add_to_cart.php");
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
            // Submit the form directly for COD
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
        "key": "rzp_test_aX7dlNyH1Xp2tx", // Your Razorpay API Key
        "amount": amount, // Amount in paise
        "currency": "INR",
        "name": "Your Store Name",
        "description": "Order Payment",
        "image": "your-logo.png",
        "handler": function(response) {
            alert("Payment Successful! Payment ID: " + response.razorpay_payment_id);

            // Store the payment ID in a hidden input
            let form = document.getElementById('orderForm');
            let input = document.createElement("input");
            input.type = "hidden";
            input.name = "razorpay_payment_id";
            input.value = response.razorpay_payment_id;
            form.appendChild(input);

            // Submit the form
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