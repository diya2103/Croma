
<?php 
include("connection.php");
include("session_customer.php");

if(isset($_REQUEST['btn_submit']))
{
if(isset($_SESSION['customer']))
			{
                $c = 1;
				$ss = "select * from c_cart";
				$rr = mysqli_query($conn,$ss);
				while($ww = mysqli_fetch_array($rr))
				{
					$c = $ww['cc_id'] + 1;
				}
				$code = "C".$c;
				$pe_code=$_REQUEST['pe_code'];
				$psp_id=$_REQUEST['psp_id'];
				$price = $_REQUEST['price'];
				$qty = $_REQUEST['qty'];
				$status = 'cart';
				$sct = "select * from c_cart where psp_id = '$psp_id' AND cc_status = '$status' and cc_username='$email'";
				$rct = mysqli_query($conn,$sct);
				if(mysqli_num_rows($rct))
				{
					header("location:add_to_cart.php");
				}
				else
				{
					$user=$_SESSION['customer'];
					$sf = "select * from c_wishlist where user_name = '$user' AND psp_id = '$psp_id'";
					$rf = mysqli_query($conn,$sf);
					if(mysqli_num_rows($rf))
					{
						$dels = "delete from c_wishlist where user_name = '$user' AND psp_id = '$psp_id'";
						mysqli_query($conn,$dels);	
					}
$insert = "insert into c_cart value('','$code','','$email','$psp_id','$qty','$price','$status','','','','','','')";
					mysqli_query($conn,$insert);
					
					$psp_id=$_REQUEST['psp_id'];
				//$price = $_REQUEST['price'];
				$qty = $_REQUEST['qty'];
				$qty1 = $_REQUEST['qty1'];
				$total=$qty1-$qty;
				
					$update="update product_size_price set pro_pur_qty='$total' where psp_id='$psp_id'";
					mysqli_query($conn,$update); 
					
					
					header("location:add_to_cart.php");
}
			}
			else
			{
				$_SESSION['psp_id'] = $psp_id;
				header("location:login.php");
			}
		}
		if(isset($_REQUEST['btn_wish']))
		{
			if(isset($_SESSION['customer']))
			{
				$user=$_SESSION['customer'];
				$psp_id=$_REQUEST['psp_id'];
				$sf = "select * from c_wishlist where user_name = '$email' AND psp_id = '$psp_id'";
				$rf = mysqli_query($conn,$sf);
				if(mysqli_num_rows($rf))
				{
					header("location:wishlist.php");
				}
				else
				{
				     $psp_id=$_REQUEST['psp_id'];
					$insert1 = "insert into c_wishlist value('','$email','$psp_id')";
					mysqli_query($conn,$insert1);
				}
			}
			else
			{
				header("location:login.php");
			}
		}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include("css.php"); ?>
<link rel="stylesheet" href="css/stylesheet.css">
<style>
* {box-sizing: border-box;}

.img-magnifier-container {
  position:relative;
}

.img-magnifier-glass {
  position: absolute;
  border: 3px solid #000;
  border-radius: 50%;
  cursor: none;
  /*Set the size of the magnifier glass:*/
  width: 150px;
  height: 150px;
}
.checked {
  color: orange;
}
</style>
<script>
function magnify(imgID, zoom) {
  var img, glass, w, h, bw;
  img = document.getElementById(imgID);
  /*create magnifier glass:*/
  glass = document.createElement("DIV");
  glass.setAttribute("class", "img-magnifier-glass");
  /*insert magnifier glass:*/
  img.parentElement.insertBefore(glass, img);
  /*set background properties for the magnifier glass:*/
  glass.style.backgroundImage = "url('" + img.src + "')";
  glass.style.backgroundRepeat = "no-repeat";
  glass.style.backgroundSize = (img.width * zoom) + "px " + (img.height * zoom) + "px";
  bw = 3;
  w = glass.offsetWidth / 2;
  h = glass.offsetHeight / 2;
  /*execute a function when someone moves the magnifier glass over the image:*/
  glass.addEventListener("mousemove", moveMagnifier);
  img.addEventListener("mousemove", moveMagnifier);
  /*and also for touch screens:*/
  glass.addEventListener("touchmove", moveMagnifier);
  img.addEventListener("touchmove", moveMagnifier);
  function moveMagnifier(e) {
    var pos, x, y;
    /*prevent any other actions that may occur when moving over the image*/
    e.preventDefault();
    /*get the cursor's x and y positions:*/
    pos = getCursorPos(e);
    x = pos.x;
    y = pos.y;
    /*prevent the magnifier glass from being positioned outside the image:*/
    if (x > img.width - (w / zoom)) {x = img.width - (w / zoom);}
    if (x < w / zoom) {x = w / zoom;}
    if (y > img.height - (h / zoom)) {y = img.height - (h / zoom);}
    if (y < h / zoom) {y = h / zoom;}
    /*set the position of the magnifier glass:*/
    glass.style.left = (x - w) + "px";
    glass.style.top = (y - h) + "px";
    /*display what the magnifier glass "sees":*/
    glass.style.backgroundPosition = "-" + ((x * zoom) - w + bw) + "px -" + ((y * zoom) - h + bw) + "px";
  }
  function getCursorPos(e) {
    var a, x = 0, y = 0;
    e = e || window.event;
    /*get the x and y positions of the image:*/
    a = img.getBoundingClientRect();
    /*calculate the cursor's x and y coordinates, relative to the image:*/
    x = e.pageX - a.left;
    y = e.pageY - a.top;
    /*consider any page scrolling:*/
    x = x - window.pageXOffset;
    y = y - window.pageYOffset;
    return {x : x, y : y};
  }
}

</script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body style="padding:0%;"> 
  <!--================ Start Header Menu Area =================-->
<?php include("customer_header.php"); ?>
	<!--================ End Header Menu Area =================-->

  <main class="site-main">
  
   
  <div class="product_image_area">
		<div class="container">
		<form method="post">
            <?php 
            $productid = $_REQUEST['psp_id'];
            $sel = "SELECT * FROM product_size_price JOIN product_entry ON product_size_price.pe_code = product_entry.pe_code WHERE product_size_price.psp_id ='$productid'" ;
             $res = mysqli_query($conn,$sel); 
             while($row = mysqli_fetch_array($res)){ ?>
			<div class="row s_product_inner">
				<div class="col-lg-6">
					<div class="owl-carousel owl-theme s_Product_carousel">
						<div class="">
						<div class="img-magnifier-container">
							<img  src="admin/Product_Upload/<?php echo $row['product_image']; ?>" style="width:400px; height:400px;"  id="myimage">
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-5 offset-lg-1">
					<div class="s_product_text">
						<h3><?php echo $row['pcolor']; ?></h3>
						<h2>₹ <?php 
				                    $total = 0;
								    $tgst = 0;
								    $gstpi = 0;
									$sprice = $row['pro_sale_price'];
									$gstpi = $sprice * $tgst / 100;
									
									echo $total = $sprice + $gstpi; //echo $rows['pro_sale_price'];  ?></h2>
						<ul class="list">
							<div class="col-md-12 single-top-right">
						<h3 class="item_name"> <?php echo $row['pe_name'] ?></h3>
						<p>Processing Time: Item will be shipped out within 3-4 working days.<br>
						CGST & SGST Included.<br><br>
						10 Days Return Policy</p>
						<div class="single-rating">
							<ul>
								<?php
								$div1 = 0;
								$tt = 0;
								$star = 0;
								$psp_id=$_REQUEST['psp_id'];
								$rts = "select * from rating join c_cart on c_cart.cc_code = rating.cc_code where c_cart.psp_id = '$psp_id'";
								$rtr = mysqli_query($conn,$rts);
								if(mysqli_num_rows($rtr))
								{
									while($rtw = mysqli_fetch_array($rtr))
									{
										$tt++;
										$star = $star + $rtw['rate'];
									}
									 $div1 = $star/$tt;
								}
								else
								{
									$div1 = 0;
								}
								 $div = number_format($div1);
								//$div = 5;
								
								
								if($div == 1)
								{
								?>
								<i class="fa fa-star checked" aria-hidden="true"></i>
								<i class="fa fa-star gray-star" aria-hidden="true"></i>
								<i class="fa fa-star gray-star" aria-hidden="true"></i>
								<i class="fa fa-star gray-star" aria-hidden="true"></i>
								<i class="fa fa-star gray-star" aria-hidden="true"></i>
								<?php
								}
								else if($div == 2)
								{
								?>
								<i class="fa fa-star checked" aria-hidden="true"></i>
								<i class="fa fa-star checked" aria-hidden="true"></i>
								<i class="fa fa-star gray-star" aria-hidden="true"></i>
								<i class="fa fa-star gray-star" aria-hidden="true"></i>
								<i class="fa fa-star gray-star" aria-hidden="true"></i>
								<?php
								}
								else if($div == 3)
								{
								?>
								<i class="fa fa-star checked" aria-hidden="true"></i>
								<i class="fa fa-star checked" aria-hidden="true"></i>
								<i class="fa fa-star checked" aria-hidden="true"></i>
								<i class="fa fa-star gray-star" aria-hidden="true"></i>
								<i class="fa fa-star gray-star" aria-hidden="true"></i>
								<?php
								}
								else if($div == 4)
								{
								?>
								<i class="fa fa-star checked" aria-hidden="true"></i>
								<i class="fa fa-star checked" aria-hidden="true"></i>
								<i class="fa fa-star checked" aria-hidden="true"></i>
								<i class="fa fa-star checked" aria-hidden="true"></i>
								<i class="fa fa-star gray-star" aria-hidden="true"></i>
								<?php
								}
								else if($div == 5)
								{
								?>
								<i class="fa fa-star checked" aria-hidden="true"></i>
								<i class="fa fa-star checked" aria-hidden="true"></i>
								<i class="fa fa-star checked" aria-hidden="true"></i>
								<i class="fa fa-star checked" aria-hidden="true"></i>
								<i class="fa fa-star checked" aria-hidden="true"></i>
								<?php
								}
								else
								{
								?>
								<i class="fa fa-star gray-star" aria-hidden="true"></i>
								<i class="fa fa-star gray-star" aria-hidden="true"></i>
								<i class="fa fa-star gray-star" aria-hidden="true"></i>
								<i class="fa fa-star gray-star" aria-hidden="true"></i>
								<i class="fa fa-star gray-star" aria-hidden="true"></i>
								<?php
								}
								?>
								
								
								<!--<li class="rating">20 reviews</li>
								<li><a href="#">Add your review</a></li>-->
							</ul> 
						</div>
							
						</ul>
						<p><?php echo $row['description'];  ?></p><br>
						<input type="hidden" name="psp_id" value="<?php echo $row['psp_id'];  ?>">
						<input type="hidden" name="price" value="<?php 
				                    $total = 0;
								    $tgst = 0;
								    $gstpi = 0;
								    $cgst = $row['cgst'];
									$sgst = $row['sgst'];
									$tgst = $cgst + $sgst;
									$sprice = $row['pro_sale_price'];
									$gstpi = $sprice * $tgst / 100;
									
									echo $total = $sprice + $gstpi; //echo $rows['pro_sale_price'];  ?>">
						<input type="hidden" name="pqty" value="<?php echo $row['pro_pur_qty'];  ?>">
						<div id="checkpin">
								<?php
								$tqty=0;
								$pqty=$row['pro_pur_qty'];
								if($pqty <= $tqty)
								{
								?>
								
								<button type="submit" class="w3ls-cart" disabled="disabled"><b class="btn btn-secondary"><i class="fa fa-cart-plus" aria-hidden="true"></i> Out Of Stock</b></button>
								
								<?php
								}
								else
								{
								?>
								<input type="hidden" name="pe_code" value="<?php echo $row['pe_code'];  ?>">
						<div class="product_count">
              <label for="qty">Quantity:</label>
              
							<input type="number" name="qty"  min="1" max="<?php echo $row['pro_pur_qty'];  ?>" title="Quantity:" class="input-text qty" placeholder="Enter qty" style="width:100px" value="1" required>
							<input type="hidden" name="qty1"  value="<?php echo $row['pro_pur_qty'];  ?>">
							
							<input type="submit" class="btn btn-danger" style="width:100px; border-radius:50px" value="Add To Cart" name="btn_submit">              
						</div>
								
								<?php
								}
								?>
						
						<button class="btn btn-success" name="btn_wish"><i class="fa fa-heart-o" aria-hidden="true"></i> Add to Wishlist</button>
						<div class="card_area d-flex align-items-center">
						
						</div>
					</div>
				</div>
			</div>
            <?php  } ?>
</form>
		</div>
	</div>
   
   
  
    

  </main>


  <!--================ Start footer Area  =================-->	
	<?php include("customer_footer.php"); ?>
	<!--================ End footer Area  =================-->

<script>
/* Initiate Magnify Function
with the id of the image, and the strength of the magnifier glass:*/
magnify("myimage", 3);
</script>

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