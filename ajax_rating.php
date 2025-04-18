<?php
	include("connection.php");
	include("session_customer.php");
	//session_start();
	
	$id = $_REQUEST['field'];
	$value = $_REQUEST['query'];
	$user = $_SESSION['customer'];
	$cc_code=$_REQUEST['cc_code'];
	
	$srt1 = "select * from rating where userid = '$email' AND cc_code = '$id'";
	$rrt1 = mysqli_query($conn,$srt1);
	if(mysqli_num_rows($rrt1))
	{
		$up = "update rating set rate = '$value' where userid = '$email' AND cc_code = '$id'";
		mysqli_query($conn,$up);
	}
	else
	{
		$insert = "insert into rating values('','$id','$value','$email')";
		mysqli_query($conn,$insert);
	}
	
	?>
	<link rel="stylesheet" href="css/stylesheet.css">
									 
	<p>
	  Rating:
	  <span class="starRating">
		<?php
		for($r = 5;$r >= 1;$r--)
		{
			$srt = "select * from rating where userid = '$email' AND cc_code = '$id'";
			$rrt = mysqli_query($conn,$srt);
			$wrt = mysqli_fetch_array($rrt);
			if($wrt['rate'] == $r)
			{
			?>
			<input id="rating<?php echo $r ?>" type="radio" name="rating" value="<?php echo $r ?>" onClick="validate('<?php echo $id ?>',this.value)" title="<?php echo $r ?>" checked>
			<label for="rating<?php echo $r ?>" title="<?php echo $r ?>"><?php echo $r ?></label>
		<?php
			}
			else
			{
			?>
			<input id="rating<?php echo $r ?>" type="radio" name="rating" value="<?php echo $r ?>" onClick="validate('<?php echo $id ?>',this.value)" title="<?php echo $r ?>">
			<label for="rating<?php echo $r ?>" title="<?php echo $r ?>"><?php echo $r ?></label>
		<?php
			}
		
		}
		?>
	  </span>
	</p>
	<?php
	//echo "insert";
?>