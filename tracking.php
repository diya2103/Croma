<?php 
include("connection.php");
include("session_customer.php");

	
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include("css.php"); ?>
<style>
ol.progtrckr {
    margin: 0;
    padding: 0;
    list-style-type none;
}

ol.progtrckr li {
    display: inline-block;
    text-align: center;
    line-height: 3.5em;
}

ol.progtrckr[data-progtrckr-steps="2"] li { width: 49%; }
ol.progtrckr[data-progtrckr-steps="3"] li { width: 33%; }
ol.progtrckr[data-progtrckr-steps="4"] li { width: 24%; }
ol.progtrckr[data-progtrckr-steps="5"] li { width: 19%; }
ol.progtrckr[data-progtrckr-steps="6"] li { width: 16%; }
ol.progtrckr[data-progtrckr-steps="7"] li { width: 14%; }
ol.progtrckr[data-progtrckr-steps="8"] li { width: 12%; }
ol.progtrckr[data-progtrckr-steps="9"] li { width: 11%; }

ol.progtrckr li.progtrckr-done {
    color: black;
    border-bottom: 4px solid yellowgreen;
}
ol.progtrckr li.progtrckr-todo {
    color: silver; 
    border-bottom: 4px solid silver;
}

ol.progtrckr li:after {
    content: "\00a0\00a0";
}
ol.progtrckr li:before {
    position: relative;
    bottom: -2.5em;
    float: left;
    left: 50%;
    line-height: 1em;
}
ol.progtrckr li.progtrckr-done:before {
    content: "\2713";
    color: white;
    background-color: yellowgreen;
    height: 2.2em;
    width: 2.2em;
    line-height: 2.2em;
    border: none;
    border-radius: 2.2em;
}
ol.progtrckr li.progtrckr-todo:before {
    content: "\039F";
    color: silver;
    background-color: white;
    font-size: 2.2em;
    bottom: -1.2em;
}
</style>
</head>
<body>
  <!--================ Start Header Menu Area =================-->
<?php include("customer_header.php"); ?>
	<!--================ End Header Menu Area =================-->

  <main class="site-main">
    
    
    <section class="section-margin calc-200px">
      <div class="container">
        <div class="section-intro pb-200px">
          <center><h2>Product Tracking -<?php echo $_REQUEST['tr'];?> </h2></center>
        </div>
        <div class="">
            <center>
			<?php
					  $user = $_SESSION['customer'];
					  $t=$_REQUEST['t'];
					  $sor = "select * from c_cart where cc_username = '$user' AND (cc_status = 'ordered' OR cc_status = 'process' OR cc_status = 'dispatched' OR cc_status = 'cancel' OR cc_status = 'delivered' OR cc_status = 'Return') and cc_id='$t'";
					  $ror = mysqli_query($conn,$sor);
					  if(mysqli_num_rows($ror))
					  {
					  	$i = 1;
						while($wor = mysqli_fetch_array($ror))
						{
					?>
								<ol class="progtrckr" data-progtrckr-steps="5">
									<?php
									
									if($wor['cc_status'] == 'process')
									{
									?>
									<li class="progtrckr-done">Ordered</li><!--
								 --><li class="progtrckr-done">Process</li><!--
								 --><li class="progtrckr-todo">Dispatched</li><!--
								 --><li class="progtrckr-todo">Delivered</li>
									<?php
									}
									else if($wor['cc_status'] == 'dispatched')
									{
									?>
									<li class="progtrckr-done">Ordered</li><!--
								 --><li class="progtrckr-done">Process</li><!--
								 --><li class="progtrckr-done">Dispatched</li><!--
								 --><li class="progtrckr-todo">Delivered</li>
									<?php
									}
									elseif($wor['cc_status'] == 'delivered')
									{
									?>
									<li class="progtrckr-done">Ordered</li><!--
								 --><li class="progtrckr-done">Process</li><!--
								 --><li class="progtrckr-done">Dispatched</li><!--
								 --><li class="progtrckr-done">Delivered</li>
									<?php
									}
									elseif($wor['cc_status'] == 'cancel')
									{
									?>
									<li class="progtrckr-done">Ordered</li><!--
									 --> <li class="progtrckr-done">Cancel</li><br><br><br>
								<b style="color:red"> Cancel Reason :</b> <b><?php echo $wor['cancel_desc']; ?></b>
									<?php
									}
									elseif($wor['cc_status'] == 'return')
									{
									?>
									<li class="progtrckr-done">Ordered</li><!--
								 
								 --><li class="progtrckr-done">Return</li>
								 
								<br><br><br>
								<b style="color:red"> Return Reason :</b> <b><?php echo $wor['return_desc']; ?></b> <br><b style="color:orange">Return order will be picked up within 24 hours</b><br>
								<b style="color:green">Picked up Date :  <?php $d=$wor['return_date']; $dt = strtotime("$d"); echo date("Y-m-d", strtotime("+1 days", $dt))?> (10:00 AM to 6:00 PM)</b>
								
									<?php
									}
									else
									{
									?>
									<li class="progtrckr-done">Ordered</li><!--
								 --><li class="progtrckr-todo">Process</li><!--
								 --><li class="progtrckr-todo">Dispatched</li><!--
								 --><li class="progtrckr-todo">Delivered</li>
									<?php
									}
									?>
								</ol>
								<?php
								}
								}
								?>
								</center>
        
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