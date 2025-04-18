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
<?php include("css.php"); ?>


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
  <!--================ Start Header Menu Area =================-->
<?php include("customer_header.php"); ?>
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
		   <td><?php echo $row['category_name']; ?> - <?php echo $row['subcategory_name']; ?> - <?php echo $row['pname']; ?> - <?php echo $row['pcolor']; ?><br>
		   <?php  $cc=$_REQUEST['cc_code']; ?>
		  <div id="<?php echo $cc ?>">
									 	<link rel="stylesheet" href="css/stylesheet.css">
									 
										<p>
										  Rating:
										  <span class="starRating">
											<?php
											
											for($r = 5;$r >= 1;$r--)
											{
											  $cc_code=$_REQUEST['cc_code'];
												$srt = "select * from rating where userid = '$email' AND cc_code = '$cc_code'";
												$rrt = mysqli_query($conn,$srt);
												$wrt = mysqli_fetch_array($rrt);
												if($wrt['rate'] == $r)
												{
												?>
												<input id="rating<?php echo $r ?>" type="radio" name="rating" value="<?php echo $r ?>" onClick="validate('<?php echo $row['cc_code'] ?>',this.value)" title="<?php echo $r ?>" checked>
												<label for="rating<?php echo $r ?>" title="<?php echo $r ?>"><?php echo $r ?></label>
											<?php
												}
												else
												{
												?>
												<input id="rating<?php echo $r ?>" type="radio" name="rating" value="<?php echo $r ?>" onClick="validate('<?php echo $row['cc_code'] ?>',this.value)" title="<?php echo $r ?>">
												<label for="rating<?php echo $r ?>" title="<?php echo $r ?>"><?php echo $r ?></label>
											<?php
												}
											}
											?>
										  </span>
										  
										</p>
									</div>
								
		  </td>
		   <td><?php echo $row['cc_qty']; ?> </td>
		   <td><?php echo $row['cc_price']; ?> Rs.</td>
		   <td>
		   
		   <?php if($row['cc_status']=='ordered')
		   {
		   ?>
		   <b class="btn btn-info"><?php echo $row['cc_status']; ?></b>
		   <br><br>
		    <form method="post">
  <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myModal<?php echo $i ?>"><i class="fa fa-edit"></i>Cancel</button>
 <!-- Modal -->
 <div class="modal fade" id="myModal<?php echo $i ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
 <div class="modal-content">
<br><br><br><br><br>
<div class="modal-header">
 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
 <!--<h4 class="modal-title" id="myModalLabel">Add Amount</h4>-->
</div>
<form class="form-horizontal style-form" method="post">
<div class="modal-body">
<input type="hidden" name="txt_catid" value="<?php echo $row['cc_id'] ?>">
<input type="hidden" name="txt_catid1" value="<?php echo $row['cp_code'] ?>">
<div class="form-group">
 <label class="col-sm-6 col-sm-6 control-label">Add Cancel Reason</label>
 <div class="col-sm-8">
<textarea type="text" name="txt_cat" class="form-control" placeholder="Enter Reason" style="width:400px" required></textarea>
 </div>
</div>

</div>
<div class="modal-footer">

 <button type="submit" name="btn_update" class="btn btn-primary">Save changes</button>
</div>
</form>
  </div>
</div>
		   
		   <?php
		   }
		   else if($row['cc_status']=='process')
		   {
		   ?>
		   <b class="btn btn-primary"><?php echo $row['cc_status']; ?></b>
		   <a class="btn btn-danger" href="cus_product.php?c=<?php echo $row['cc_id']; ?>&p=<?php echo $row['cp_code']; ?>" onClick="return confirm('Are you sure cancel this order?')">cancel</a>
		   <?php
		   }elseif($row['cc_status']=='dispatched')
		   {
		   ?>
		   <b class="btn btn-warning"><?php echo $row['cc_status']; ?></b>
		   <?php
		   }elseif($row['cc_status']=='delivered')
		   {
		   ?>
		   <b class="btn btn-success"><?php echo $row['cc_status']; ?></b>
		  <br><br>
		  <?php
		   $p=$_REQUEST['p']; 
		  $se="select * from c_deliver where c_deliver.cp_code='$p'";
		  $res1=mysqli_query($conn,$se);
		  $roww=mysqli_fetch_array($res1);
		   $f=date('Y-m-d');
		   $d=$roww['cd_date']; $dt = strtotime("$d");  $cs=date("Y-m-d", strtotime("+9 days", $dt));
		  if($f <= $cs)
		  {
		  ?>
		  Return Last date: <?php echo $cs?>
		    <form method="post">
  <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myModal<?php echo $i ?>"><i class="fa fa-edit"></i>Return</button>
 <!-- Modal -->
 <div class="modal fade" id="myModal<?php echo $i ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
 <div class="modal-content">
<br><br><br><br><br><br>
<div class="modal-header">
 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
 <!--<h4 class="modal-title" id="myModalLabel">Add Amount</h4>-->
</div>
<form class="form-horizontal style-form" method="post">
<div class="modal-body">
<input type="hidden" name="txt_catid" value="<?php echo $row['cc_id'] ?>">
<input type="hidden" name="txt_catid1" value="<?php echo $row['cp_code'] ?>">
<div class="form-group">
 <label class="col-sm-6 col-sm-6 control-label">Add Return Reason</label>
 <div class="col-sm-8">
<textarea type="text" name="txt_cat" class="form-control" placeholder="Enter Reason" style="width:400px" required></textarea>
 </div>
</div>

</div>
<div class="modal-footer">

 <button type="submit" name="btn_update1" class="btn btn-primary">Save changes</button>
</div>
</form>
<?php
}
else
{
?>

<?php
}
?>
  </div>
</div>
		   
		  
		   <?php
		   }elseif($row['cc_status']=='cancel')
		   {
		   ?>
		   <b class="btn btn-secondary"><?php echo $row['cc_status']; ?></b><br><br>
		  <?php
			   if($row['cancel_status']=='pending cancel request')
			   {
			   ?>
		   <b class="btn btn-success"><?php echo $row['cancel_status']; ?></b>
		  <?php
		  }
		  else
		  {
		  ?>
		  <b class="btn btn-success"><?php echo $row['cancel_status']; ?></b>
		  <?php
		  }
		  ?>
		   <?php
		   }elseif($row['cc_status']=='return')
		   {
		   ?>
		   <b class="btn btn-primary"><?php echo $row['cc_status']; ?></b><br><br>
		   <?php
			   if($row['return_status']=='pending return request')
			   {
			   ?>
		   <b class="btn btn-success"><?php echo $row['return_status']; ?></b>
		  <?php
		  }
		  else
		  {
		  ?>
		  <b class="btn btn-success"><?php echo $row['return_status']; ?></b>
		  <?php
		  }
		  ?>
		   
		   <?php
		   }
		   ?>
		   </td>
		   <td><a class="btn btn-warning" href="tracking.php?t=<?php echo $row['cc_id']; ?>&p=<?php echo $row['cp_code']; ?>&tr=<?php echo $row['pname']; ?>">Tracking</a></td>
		   
		  
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