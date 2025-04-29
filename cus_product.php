<?php 
include("connection.php");
include("session_customer.php");

if(isset($_REQUEST['btn_update']))
{
$c=$_REQUEST['txt_catid'];
$p1=$_REQUEST['txt_cat'];
$p=$_REQUEST['txt_catid1'];
$da=date('Y-m-d');
$update="update c_cart set cancel_desc='$p1',cancel_date='$da',cc_status='cancel',cancel_status='pending cancel request' where cc_id='$c'";
mysqli_query($conn,$update);
header("location:cus_product.php?p=$p");

}
if(isset($_REQUEST['btn_update1']))
{
$c=$_REQUEST['txt_catid'];
$p1=$_REQUEST['txt_cat'];
$p=$_REQUEST['txt_catid1'];
$da=date('Y-m-d');
$update="update c_cart set return_date='$da',return_desc='$p1',cc_status='return',return_status='pending return request' where cc_id='$c'";
mysqli_query($conn,$update);
header("location:cus_product.php?p=$p");

}

	
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<style>
	/* Modal styling */
	.modal {
		z-index: 9999 !important;
	}
	.modal-backdrop {
		z-index: 9998 !important;
	}
	.modal-dialog {
		margin-top: 80px;
	}
	.modal-content {
		border-radius: 8px;
		box-shadow: 0 2px 10px rgba(0,0,0,0.1);
	}
	.modal-header {
		background-color: #f8f9fa;
		border-bottom: 1px solid #dee2e6;
		border-radius: 8px 8px 0 0;
		padding: 1rem;
	}
	.modal-header h4 {
		margin: 0;
		color: #333;
		font-weight: 500;
	}
	.modal-body {
		padding: 1.5rem;
	}
	.modal-footer {
		border-top: 1px solid #dee2e6;
		padding: 1rem;
	}
	.form-group label {
		font-weight: 500;
		color: #555;
		margin-bottom: 0.5rem;
	}
	.form-control {
		border: 1px solid #ced4da;
		border-radius: 4px;
		padding: 0.75rem;
		min-height: 100px;
		resize: vertical;
	}
	.form-control:focus {
		border-color: #80bdff;
		box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
	}

	/* Table Styles */
	.table {
		table-layout: fixed;
		width: 100%;
	}

	.table td {
		vertical-align: middle !important;
		padding: 8px !important;
		font-size: 12px;
		word-wrap: break-word;
	}

	.table th {
		padding: 8px 6px !important;
		font-size: 12px;
		background-color: #f8f9fa;
	}

	/* Order Status Button Styles */
	.btn {
		font-weight: 500;
		padding: 4px 8px;
		border-radius: 3px;
		transition: all 0.2s ease;
		font-size: 11px;
		letter-spacing: 0.2px;
		margin: 2px 0;
		line-height: 1.4;
		white-space: nowrap;
		display: inline-block;
		text-align: center;
		width: auto;
	}

	/* Status Buttons */
	.btn-status {
		min-width: 70px;
		margin-bottom: 3px;
		display: block;
	}

	.btn-info {
		background-color: #0dcaf0;
		border-color: #0dcaf0;
		color: #000;
	}

	.btn-primary {
		background-color: #0d6efd;
		border-color: #0d6efd;
		color: #fff;
	}

	.btn-warning {
		background-color: #ffc107;
		border-color: #ffc107;
		color: #000;
	}

	.btn-success {
		background-color: #198754;
		border-color: #198754;
		color: #fff;
	}

	.btn-danger {
		background-color: #dc3545;
		border-color: #dc3545;
		color: #fff;
	}

	/* Action Buttons */
	.btn-action {
		font-size: 10px;
		padding: 3px 6px;
		margin-top: 3px;
		display: block;
		width: 100%;
		text-align: left;
	}

	.btn-action i {
		font-size: 10px;
		margin-right: 3px;
	}

	/* Tracking Button */
	.btn-tracking {
		background-color: #fd7e14;
		border-color: #fd7e14;
		color: #fff;
		width: 100%;
		margin: 0;
		text-align: center;
	}

	.btn-tracking i {
		margin-right: 4px;
	}

	/* Rating Button */
	.btn-rating {
		background-color: #6f42c1;
		border-color: #6f42c1;
		color: #fff;
		width: 100%;
		margin: 0;
		text-align: center;
	}

	/* Status Badges */
	.badge {
		padding: 2px 6px;
		font-weight: normal;
		border-radius: 2px;
		font-size: 10px;
		margin-top: 3px;
		display: block;
		text-align: center;
		width: 100%;
	}

	.badge-warning {
		background-color: #fff3cd;
		color: #856404;
		border: 1px solid #ffeeba;
	}

	.badge-success {
		background-color: #d4edda;
		color: #155724;
		border: 1px solid #c3e6cb;
	}

	/* Product Link Style */
	.product-link {
		color: #0d6efd;
		text-decoration: none;
		font-weight: 500;
	}

	.product-link:hover {
		text-decoration: underline;
	}

	/* Text Styles */
	.text-muted {
		color: #6c757d !important;
		font-size: 11px;
	}
	</style>
<?php include("css.php"); ?>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="css/stylesheet.css">
<script>
function validate(field, query) 
{
	var xmlhttp;
	if (window.XMLHttpRequest) 
	{ 
		// for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp = new XMLHttpRequest();
	} 
	else 
	{ 
		// for IE6, IE5
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	xmlhttp.onreadystatechange = function() 
	{
		if (xmlhttp.readyState != 4 && xmlhttp.status == 200) 
		{
			document.getElementById(field).innerHTML = "Validating..";
		} 
		else if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
		{
			document.getElementById(field).innerHTML = xmlhttp.responseText;
		} 
		/*else 
		{
			document.getElementById(field).innerHTML = "Error Occurred. <a href='index.php'>Reload Or Try Again</a> the page.";
		}*/
	}
	xmlhttp.open("GET", "ajax_rating.php?field=" + field + "&query=" + query, false);
	xmlhttp.send();
}
</script>
</head>
<body>
	<?php include("customer_header.php"); ?>
  <!--================ Start Header Menu Area =================-->
	<!--================ End Header Menu Area =================-->

  <main class="site-main">
    
    
    <section class="section-margin calc-100px">
      <div class="container">
        <div class="section-intro pb-100px">
          <center><h2>View Product Detail</h2></center>
        </div>
        <div class="row">
            <table class="table table-striped" border="1">
		   <tr>
		   <th>Id</th>
		   <th>Code</th>
		   <th>Product Name</th>
		   <th>Quantity</th>
		   <th>Price</th>
		   <th>Order Status</th>
		    <th>Tracking</th>
			
		   <th>Rating</th>
		   <th>Invoice</th>
		   </tr>
		   <?php
		   $i=1;
		   $p=$_REQUEST['p'];
		   $select="select * from c_cart join c_purchase on c_purchase.cp_code=c_cart.cp_code join product_size_price on product_size_price.psp_id=c_cart.psp_id join product_entry on product_entry.pe_code=product_size_price.pe_code join subcategory on subcategory.subcategory_id=product_entry.p_subid join category on category.category_id=subcategory.cid where cc_username='$email' and c_purchase.cp_code='$p'  ";
		   $res=mysqli_query($conn,$select);
		   while($row=mysqli_fetch_array($res))
		   {
		   ?>
		   <tr>
		   <td><?php echo $i; ?></td>
		   <td><?php echo $row['cp_code']; ?></td>
		   <td><a href="customersingle_product.php?psp_id=<?php echo $row['psp_id']; ?>" style="color:blue"><?php echo $row['category_name']; ?> - <?php echo $row['subcategory_name']; ?> - <?php echo $row['pname']; ?> - <?php echo $row['pcolor']; ?></a><br>
		  
		  </td>
		   <td><?php echo $row['cc_qty']; ?> </td>
		   <td><?php echo $row['cc_price']; ?> Rs.</td>
		   <td>
		   <?php 
		   if($row['cc_status'] == 'ordered' || $row['cc_status'] == 'process' || $row['cc_status'] == 'dispatched' || $row['cc_status'] == 'delivered' || $row['cc_status'] == 'cancel' || $row['cc_status'] == 'return')
		   {
			   if($row['cc_status'] == 'ordered')
			   {
				   ?>
				   <button class="btn btn-info btn-status">Ordered</button>
				   <button type="button" class="btn btn-danger btn-sm btn-action" data-toggle="modal" data-target="#myModal<?php echo $i ?>">
					   <i class="fa fa-times"></i> Cancel Order
				   </button>
				   <!-- Modal -->
				   <div class="modal fade" id="myModal<?php echo $i ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					   <div class="modal-dialog">
						   <div class="modal-content">
							   <div class="modal-header">
								   <h4 class="modal-title">Cancel Order</h4>
								   <button type="button" class="close" data-dismiss="modal">&times;</button>
							   </div>
							   <form method="post">
								   <div class="modal-body">
									   <input type="hidden" name="txt_catid" value="<?php echo $row['cc_id'] ?>">
									   <input type="hidden" name="txt_catid1" value="<?php echo $row['cp_code'] ?>">
									   <div class="form-group">
										   <label>Cancel Reason</label>
										   <textarea name="txt_cat" class="form-control" placeholder="Enter Reason" required></textarea>
									   </div>
								   </div>
								   <div class="modal-footer">
									   <button type="submit" name="btn_update" class="btn btn-primary">Submit</button>
									   <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								   </div>
							   </form>
						   </div>
					   </div>
				   </div>
				   <?php
			   }
			   else if($row['cc_status'] == 'process')
			   {
				   echo '<button class="btn btn-primary btn-status">Processing</button>';
			   }
			   else if($row['cc_status'] == 'dispatched')
			   {
				   echo '<button class="btn btn-warning btn-status">Dispatched</button>';
			   }
			   else if($row['cc_status'] == 'delivered')
			   {
				   ?>
				   <button class="btn btn-success btn-status">Delivered</button>
				   <button type="button" class="btn btn-primary btn-sm btn-action" data-toggle="modal" data-target="#returnModal<?php echo $i ?>">
					   <i class="fa fa-undo"></i> Return Order
				   </button>
				   <!-- Return Modal -->
				   <div class="modal fade" id="returnModal<?php echo $i ?>" tabindex="-1" role="dialog" aria-labelledby="returnModalLabel" aria-hidden="true">
					   <div class="modal-dialog">
						   <div class="modal-content">
							   <div class="modal-header">
								   <h4 class="modal-title">Return Order</h4>
								   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
									   <span aria-hidden="true">&times;</span>
								   </button>
							   </div>
							   <form method="post">
								   <div class="modal-body">
									   <input type="hidden" name="txt_catid" value="<?php echo $row['cc_id'] ?>">
									   <input type="hidden" name="txt_catid1" value="<?php echo $row['cp_code'] ?>">
									   <div class="form-group">
										   <label for="returnReason">Please provide a reason for returning the order:</label>
										   <textarea id="returnReason" name="txt_cat" class="form-control" 
											   placeholder="Enter your reason for return" required></textarea>
									   </div>
								   </div>
								   <div class="modal-footer">
									   <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
									   <button type="submit" name="btn_update1" class="btn btn-primary">Submit Return Request</button>
								   </div>
							   </form>
						   </div>
					   </div>
				   </div>
				   <?php
			   }
			   else if($row['cc_status'] == 'cancel')
			   {
				   echo '<button class="btn btn-secondary btn-status">Cancelled</button>';
				   if($row['cancel_status'] == 'pending cancel request') {
					   echo '<span class="badge badge-warning">Cancellation Pending</span>';
				   } else {
					   echo '<span class="badge badge-success">Cancellation Approved</span>';
				   }
			   }
			   else if($row['cc_status'] == 'return')
			   {
				   echo '<button class="btn btn-primary btn-status">Returned</button>';
				   if($row['return_status'] == 'pending return request') {
					   echo '<span class="badge badge-warning">Return Pending</span>';
				   } else {
					   echo '<span class="badge badge-success">Return Approved</span>';
				   }
			   }
		   }
		   else
		   {
			   ?>
			   <button class="btn btn-info btn-status">Ordered</button>
			   <button type="button" class="btn btn-danger btn-sm btn-action" data-toggle="modal" data-target="#myModal<?php echo $i ?>">
				   <i class="fa fa-times"></i> Cancel Order
			   </button>
			   <?php
		   }
		   ?>
		   </td>
		   <td><a class="btn btn-tracking" href="tracking.php?t=<?php echo $row['cc_id']; ?>&p=<?php echo $row['cp_code']; ?>&tr=<?php echo $row['pname']; ?>">
			   <i class="fa fa-truck"></i> Track Order
		   </a></td>
		   
		   <td><?php if($row['cc_status']=='delivered' OR $row['cc_status']=='return')
		   {
		   ?>
		   <a href="rating.php?cc_code=<?php echo $cc=$row['cc_code']; ?>&p=<?php echo $cc=$row['cp_code']; ?>" title="Rating" class="btn btn-rating btn-md">
			   <i class="fa fa-star"></i> Rate Order
		   </a>
		   <?php
		   }
		   else
		   {
		   ?>
		   <span class="text-muted">Order not delivered yet</span>
		   <?php
		   }
		   ?> 
		   </td>
		  <td><?php if($row['cc_status']=='delivered')
		   {
		   ?>
		   <a href="bill.php?cc_code=<?php echo $cc=$row['cc_code']; ?>&p=<?php echo $cc=$row['cp_code']; ?>" title="Bill" class="btn btn-primary btn-md">
			   <i class="fa fa-file-invoice"></i> Invoice
		   </a>
		   <?php
		   }
		   else
		   {
		   ?>
		   <span class="text-muted">Order not delivered yet</span>
		   <?php
		   }
		   ?> 
		   </td>
		   </tr>
		   <?php
		      $i++;
		   }
		
		   ?>
		   </table> 
        
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