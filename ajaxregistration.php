<?php
include("connection.php");
//include("session_admin.php");
 
		$value=$_REQUEST['value'];
		$id=$_REQUEST['id'];
	
		
		if($id=="cust_id")
		{
		 $q = "select * from customer_registration where email='$value'";
			$res=mysqli_query($conn,$q);
			
			if(mysqli_num_rows($res)>0)
			{
				?>
			<button class="btn btn-danger" disabled="true">Email Id already exists</button>
				
			<?php
			}
			else
			{
			?>
			
			<div class="col-md-24 form-group">
							<button type="submit" value="submit" class="button button-login w-100" style="padding: 7px 160px;" name="submit">Register</button>
							</div>
				
			<?php
			}
			?>
			
	<?php
			}
?>