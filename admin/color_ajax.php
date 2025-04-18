<?php
	include("../connection.php");
	
	$id = $_REQUEST['field'];
	$value = $_REQUEST['query'];
	
	
	?>
	<div class="form-group col-lg-12 d-flex m-2">
		<div class="col-lg-3"><label for="exampleInputEmail1">Product</label></div>
		<div class="col-lg-3"><label for="exampleInputEmail1">Purchase Price</label></div>
		<div class="col-lg-3"><label for="exampleInputEmail1">Qty</label></div>
		<!--<div class="col-lg-3"><label for="exampleInputEmail1">Net Price</label></div>-->
		<div class="col-lg-3"><label for="exampleInputEmail1">Sale price</label></div>
	</div>
	
	<?php
	for($i = 1;$i <= $value;$i++)
	{
	?>
	
<div class="form-group col-lg-12 d-flex ">
	<div class="col-lg-3">
		  <input type="text" name="txt_size<?php echo $i ?>" class="form-control"  required >
	</div>
	<div class="col-lg-3">
		  <input type="text" name="txt_pprice<?php echo $i ?>" class="form-control"  required >
	</div>
	<div class="col-lg-3">
		  <input type="text" name="txt_qty<?php echo $i ?>" class="form-control"  required >
	</div>
	<!--<div class="col-lg-3">
		  <input type="text" name="txt_netprice<?php echo $i ?>" class="form-control"  required />
	</div>-->
	<div class="col-lg-3">
		  <input type="text" name="txt_saleprice<?php echo $i ?>" class="form-control"   required >
	</div>
</div>
	<?php
	}
	?>