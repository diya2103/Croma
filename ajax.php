<?php
	include("connection.php");
	
	$id = $_REQUEST['field'];
	$value = $_REQUEST['query'];
	
	$update = "update c_cart set cc_qty = '$value' where cc_id = '$id'";
	mysqli_query($conn,$update);
	//	header("location:add_to_cart.php");
	
	$scart = "select * from c_cart where cc_id = '$id'";
	$rcart = mysqli_query($conn,$scart);
	$tol = 0;
	$wcart = mysqli_fetch_array($rcart);
	$qty = $wcart['cc_qty'];
	$price = $wcart['cc_price'];
	$tol = $price * $qty;
	
	echo number_format($tol,2);
?>