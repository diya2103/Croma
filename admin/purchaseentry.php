<?php
	include('../connection.php');
	include('session_admin.php');
	if(isset($_REQUEST['id']))
	{
		$id=$_REQUEST['id'];
	}
	
	if(isset($_REQUEST['btn_submit']))
	{
		$code = 1001;
		$sel = "select * from product_entry";
		$res = mysqli_query($conn,$sel);
		while($row = mysqli_fetch_array($res))
		{
			$code = $row['pe_code'] + 1;
		}
		$txt_cat = $_REQUEST['txt_cat'];
    $txt_bnm = $_REQUEST['txt_bnm'];
    $pname = $_REQUEST['pname'];
    $date = $_REQUEST['date'];
		// $pnm = $_REQUEST['txt_pnm'];
		// $remark = $_REQUEST['txt_proname'];
		$cgst = $_REQUEST['txt_cgst'];
		$sgst = $_REQUEST['txt_sgst'];
    $desc = $_REQUEST['txt_desc'];
		foreach($_FILES['userfile']['error'] as $key=>$error)
		{
			if($error == UPLOAD_ERR_OK)
			{
				$name = $_FILES['userfile']['name'][$key];
				$tmp = $_FILES['userfile']['tmp_name'][$key];
				$type = $_FILES['userfile']['type'][$key];
				$size = $_FILES['userfile']['size'][$key];
				
				$temp = explode(".",$name);
				$dt = date('dmY_');
				$file = "IMG_".$dt.rand().".".end($temp);
				
				$path = "Product_Upload/".$file;
				move_uploaded_file($tmp,$path);
				
				$ins = "insert into product_entry values('','$txt_cat','$txt_bnm','$pname','$code','$date','$cgst','$sgst','$file','$desc')";
		  mysqli_query($conn,$ins);
			}
		}
		
		$no=$_REQUEST['txt_no_size'];
		for($i=1;$i<=$no;$i++)
		{
			$size1=$_REQUEST['txt_size'.$i];
			$pprice=$_REQUEST['txt_pprice'.$i];
			$qty=$_REQUEST['txt_qty'.$i];
			$saleprice=$_REQUEST['txt_saleprice'.$i];
		
	
			$insert="insert into product_size_price values('','$code','$size1','$qty','$pprice','$saleprice')";
			mysqli_query($conn,$insert);
			 echo '<script>alert("successfully inserted")</script>';
            echo "<script>window.location='purchase_detail.php'</script>";
		}


		
		header("location:purchase_detail.php");
}
	?>
<!DOCTYPE html>
<html>
<head>
  <?php include("css.php");  ?>
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
	xmlhttp.open("GET", "ajax.php?field=" + field + "&query=" + query, false);
	xmlhttp.send();
}

function size123(field, query) 
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
	xmlhttp.open("GET", "color_ajax.php?field=" + field + "&query=" + query, false);
	xmlhttp.send();
}
</script>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <?php include("header.php");  ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php include("sidebar.php");  ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
       
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
<!-- Main content -->
<section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">ADD Products</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <!-- ------------------- Start ------------------ -->
		
		<form method="post" enctype="multipart/form-data">
        <div class="box-body border">
			  	<div class="form-group col-lg-12">
					<div class="row mt-5">
                  <div class="col-lg-4">
                    <label for="exampleInputEmail1">Category Name</label>
                    <select name="txt_cat" class="form-control" required onChange="validate('brandid',this.value)">
                      <option value="">Select Category</option>
                      <?php
                      $sel123 = "select * from category";
                      $res123 = mysqli_query($conn,$sel123);
                      while($row123 = mysqli_fetch_array($res123))
                      {
                      ?>
                      <option value="<?php echo $row123['category_id'] ?>"><?php echo $row123['category_name'] ?></option>
                      <?php
                      }
                      ?>
                    </select>
                  </div>
                  <div class="col-lg-4" id="brandid">
                    <label for="exampleInputEmail1" style="color:#CCCCCC;">Sub Category Name</label>
                    <select disabled="disabled" style="color:#CCCCCC;" name="txt_bnm" class="form-control" required onChange="validate('productid',this.value)">
                      <option value="" selected="selected">Select Sub Category</option>
                    </select>
                  </div>
                  <div class="col-lg-4">
                    <label for="exampleInputEmail1">Product Name</label>
                      <input type="text" name="pname" class="form-control" placeholder="Enter Product"  required>
                  </div>
                  <div class="col-lg-4">
                    <label for="exampleInputEmail1">Date</label>
                      <input type="date" name="date" class="form-control" max="<?php echo date('Y-m-d'); ?>"  required>
                  </div>
                  <div class="col-lg-2 mt-4">
                    <label for="exampleInputEmail1">CGST (%)</label>
                              <input type="text" name="txt_cgst" class="form-control" placeholder="CGST" required="" pattern="[0-9]{1,15}" value="18" title="Only Numbers" readonly="" >
                  </div>
                  <div class="col-lg-2 mt-4">
                    <label for="exampleInputEmail1">SGST(%)</label>
                              <input type="text" name="txt_sgst" class="form-control" placeholder="SGST" required="" pattern="[0-9]{1,15}" value="18" title="Only Numbers" readonly="" >
                  </div>
                  <div class="col-lg-4 mt-4">
                    <label for="exampleInputEmail1">Image 1</label>
                    <input type="file" name="userfile[]" required class="form-control">
                  </div>
                  <div class="form-group col-lg-12">
						        <div class="col-lg-2">
                      <label for="exampleInputEmail1">No of Size</label>
                      <input type="text" name="txt_no_size" class="form-control" placeholder="Enter Number"  onKeyUp="size123('size',this.value)" required="" pattern="[0-9]{1,2}" title="Only Numbers">
						        </div>
				          </div>
                  <div id="size"></div>
                  <div class="form-group col-lg-12"><hr />
                    <label for="exampleInputEmail1">Product Description</label><br>
                    <textarea id="editor1" name="txt_desc" rows="8" cols="190" required>
                    </textarea>
				          </div>
                  <div class="box-footer">
                     <button type="submit" name="btn_submit" class="btn btn-primary">Submit</button>
                  </div>
					     </div>
				   </div>		
			</div>        
      </form>
            </div>
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
          <!-- right column -->
         
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    </div>
  <!-- /.content-wrapper -->
  <?php include("footer.php");  ?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
<script src="bower_components/ckeditor/ckeditor.js"></script>

<script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1')
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5()
  });
</script>
</body>
</html>