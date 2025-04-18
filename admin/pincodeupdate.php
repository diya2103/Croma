<?php
include("../connection.php");
include("session_admin.php"); 
		$value=$_REQUEST['value'];
		$id=$_REQUEST['id'];
	
		
		if($id=="pin_id")
		{
		 $q = "select * from  pincode where pincode_no='$value'";
			$res=mysqli_query($conn,$q);
			
			if(mysqli_num_rows($res)>0)
			{
				?>
			<button class="btn btn-danger" disabled="true">Pincode No already exists</button>
				
			<?php
			}
			else
			{
			?>
			
				 <input type="submit" class="btn btn-info"  name="updbtn">
				
			<?php
			}
			?>
			
	<?php
			}
?>