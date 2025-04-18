<?php
	include("../connection.php");
	
	$id = $_REQUEST['field'];
	$value = $_REQUEST['query'];
	
	
	
	if($id == 'brandid')
	{
	?>
	<label for="exampleInputEmail1">Sub Category Name</label>
	<select name="txt_bnm" class="form-control" autofocus required onChange="validate('productid',this.value)">
		<option value="">Select Sub Category</option>
		<?php 
		
		$sel12 = "select * from subcategory where cid = '$value'";
		$res12=mysqli_query($conn,$sel12);
		while($row12 = mysqli_fetch_array($res12))
		{
		?>
		<option value="<?php echo $row12['subcategory_id'] ?>"><?php echo $row12['subcategory_name'] ?></option>
		<?php
		}
		?>
	</select>
	<?php
	}
	if($id == 'productid')
	{
	?>
	<label for="exampleInputEmail1">Product Name</label>
	<select name="txt_pnm" autofocus class="form-control" required>
		<option value="">Select Product</option>
		<?php 
		
		$sel12 = "select * from product_master where cwb_id = '$value'";
		$res12=mysqli_query($conn,$sel12);
		while($row12 = mysqli_fetch_array($res12))
		{
		?>
		<option value="<?php echo $row12['product_id'] ?>"><?php echo $row12['product_name'] ?></option>
		<?php
		}
		?>
	</select>
	<?php
	}
	/*
	if($id == 'image')
	{
		for($i = 1;$i <= $value;$i++)
		{
		?>
		<div class="col-lg-3">
		  <label for="exampleInputEmail1">Image <?php echo $i ?></label>
		   <input type="file" name="userfile<?php echo $i ?>" class="form-control" required>
		</div>
		<?php
		}
	}*/
	if($id == 'size')
	{
	
	?>
		<div class="form-group col-lg-12">
			<div class="col-lg-1">
				  <input type="text" class="form-control" value="1" required readonly="true" />
			</div>
			<div class="col-lg-1">
				  <input type="text" name="txt_size<?php echo $i ?>" class="form-control"  required />
			</div>
			<div class="col-lg-2">
				  <input type="text" name="txt_pprice<?php echo $i ?>" class="form-control"  required />
			</div>
			<div class="col-lg-1">
				  <input type="text" name="txt_qty<?php echo $i ?>" class="form-control"  required />
			</div>
			<div class="col-lg-3">
				  <input type="text" name="txt_netprice<?php echo $i ?>" class="form-control"  required />
			</div>
			<div class="col-lg-2">
				  <input type="text" name="txt_saleprice<?php echo $i ?>" class="form-control"  required />
			</div>
			<!-- <div class="col-lg-2">
				  <input type="text" name="txt_barcode<?php echo $i ?>" class="form-control"  required />
			</div> -->
		</div>	
		<?php
		
	}
	
?>