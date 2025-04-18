<?php
include("connection.php");

$id = $_REQUEST['field'];
$value = $_REQUEST['query'];

if($id == 'checkpin') {
    $psp = $_SESSION['product'];

    $sel = "select * from purchase_size_price
            join purchase_entry on purchase_entry.pe_code = purchase_size_price.pe_code
            join product_master on product_master.product_id = purchase_entry.product_id
            join category_wise_brand on product_master.cwb_id = category_wise_brand.cwb_id
            join category_master on category_master.category_id = category_wise_brand.category_id
            join brand_master on brand_master.brand_id = category_wise_brand.brand_id
            where psp_id = '$psp'";
    $res = mysqli_query($conn,$sel);
    $row = mysqli_fetch_array($res);
    $pecode = $row['pe_code'];
    $pqty = $row['psp_qty'];
    
    $tqty = 0;
    $aqty = 0;
    $s1 = "select * from c_cart where psp_id = '$psp'";
    $y1 = mysqli_query($conn,$s1);
    while($yo1 = mysqli_fetch_array($y1)) {
        $qty = $yo1['cc_qty'];
        $tqty = $tqty + $qty;
    }
    
    $selq = "select * from pincode where pincode_no = '$value' AND pin_status = 'active'";
    $resq = mysqli_query($conn,$selq);
    if(mysqli_num_rows($resq)) {
        ?>
        <strong style="color:#00CC00;">Valid Pincode..!</strong><br />
        <?php
        if($pqty <= $tqty) {
        ?>
        <button type="submit" class="w3ls-cart" disabled="disabled"><i class="fa fa-cart-plus" aria-hidden="true"></i> Out Of Stock</button>
        <?php
        } else {
        ?>
        <button type="submit" class="w3ls-cart" name="btn_add" ><i class="fa fa-cart-plus" aria-hidden="true"></i> Add to cart</button>
        <?php
        }
        ?>
        <button class="w3ls-cart w3ls-cart-like" name="btn_wish"><i class="fa fa-heart-o" aria-hidden="true"></i> Add to Wishlist</button>
        <?php
    } else {
        ?>
        <strong style="color:#FF3300;">Invalid Pincode..!</strong><br />
        <?php
        if($pqty <= $tqty) {
        ?>
        <button type="submit" class="w3ls-cart" disabled="disabled"><i class="fa fa-cart-plus" aria-hidden="true"></i> Out Of Stock</button>
        <?php
        } else {
        ?>
        <button type="submit" class="w3ls-cart" name="btn_add" disabled="disabled"><i class="fa fa-cart-plus" aria-hidden="true"></i> Add to cart</button>
        <?php
        }
        ?>
        <button class="w3ls-cart w3ls-cart-like" name="btn_wish"><i class="fa fa-heart-o" aria-hidden="true"></i> Add to Wishlist</button>
        <?php
    }
}

if($id == 'pincode') {
    $ss1 = "select * from pincode where pincode_no = '$value'";
    $rr1 = mysqli_query($conn,$ss1);
    if(mysqli_num_rows($rr1)) {
    ?>
    <center>
        <div class="key">
        <select name="txt_payment" id="txt_payment" class="form-control" required onChange="validate('payment',this.value)" style="width:500px;">
            <option value="">-- Select payment --</option>
            <option value="cash">Cash on delivery (COD)</option>
            <option value="razorpay">Online Payment (Razorpay)</option>
        </select>
        </div>
    </center>
    <?php
    } else {
    ?>
    <div class="callout callout-danger" style="width:100%;padding:5px;background-color:#F50A33;color:#FFFFFF;">
        <h4>Warning..!</h4>
        <p>This Order are not place on this Pincode Address..!</p>
    </div>
    <?php
    }
}

if($id == 'payment') {
    $user = $_SESSION['customer'];
    if($value == 'cash') {
    ?>
    <br /><br />
        <input type="submit" name="btn_submit" value="Place Order" class="btn btn-success" style="width:500px;">
    <?php    
    } else if($value == 'razorpay') {
        $ct = 0;
        $qty1 = 0;
        $price1 = 0;
        $tol1 = 0;
        $gt1 = 0;
        $scarq = "select * from c_cart where cc_username = '$user' AND cc_status = 'cart'";
        $rcarq = mysqli_query($conn,$scarq);
        while($wcarq = mysqli_fetch_array($rcarq)) {
            $ct++;
            $qty1 = $wcarq['cc_qty'];
            $price1 = $wcarq['cc_price'];
            $tol1 = $price1 * $qty1;
            $gt1 = $gt1 + $tol1;
        }
        $_SESSION['gt'] = $gt1;
        $amount_in_paise = $gt1 * 100; // Convert to paise for Razorpay
    ?>
    <br /><br />
    <!-- Store the amount in paise in a hidden field -->
    <input type="hidden" id="razorpay_amount" value="<?php echo $amount_in_paise; ?>">
    <button type="button" id="btn_pay" name="btn_pay" class="btn btn-success btn-md" style="width:500px;">Pay Now ₹<?php echo $gt1; ?></button>
    <?php
    } else {
    ?>
    <div class="callout callout-danger" style="width:100%;padding:5px;background-color:#F50A33;color:#FFFFFF;">
        <h4>Warning..!</h4>
        <p>Select Payment Option..!</p>
    </div>
    <?php
    }    
}

?>
