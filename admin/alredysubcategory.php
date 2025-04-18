<?php
include("../connection.php");
include("session_admin.php");
 
		$value=$_REQUEST['value'];
		$id=$_REQUEST['id'];
	
		
		if($id=="cid")
		{
		 $q = "select * from  subcategory where subcategory_name='$value'";
			$res=mysqli_query($conn,$q);
			
			if(mysqli_num_rows($res)>0)
			{
				?>
			<button class="btn btn-danger" disabled="true">subcategory alredy exists</button>
				
			<?php
			}
			else
			{
			?>
			
				 <input type="submit" class="btn btn-info"  name="submitbtn">
				
			<?php
			}
			?>
			
	<?php
			}
?>