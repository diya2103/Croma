<?php
	include('../connection.php');
	include('../session.php');
	if(isset($_REQUEST['edit']))
	{
        $edit = $_REQUEST['edit'];
        $eq = "SELECT * FROM product_size_price  WHERE psp_id = '$edit'";  
        $qres = mysqli_query($conn,$eq);
        $f = mysqli_fetch_array($qres);
    }

	if(isset($_REQUEST['btn_submit']))
	{
        $aqty = $_REQUEST['aqty1'];
        $c = $_REQUEST['aqty1']+$_REQUEST['updqty'];
        $purprice = $_REQUEST['purprice'];
        //$p = $_REQUEST['purprice']+$_REQUEST['updpurprice'];
        $saleprice = $_REQUEST['saleprice'];
        //$s = $_REQUEST['saleprice']+$_REQUEST['updsaleprice'];
        
        $eid = $_REQUEST['edit'];
        $d=$_REQUEST['stock'];

        $query = "UPDATE product_size_price SET pro_pur_qty = '$c',pro_pur_price = '$purprice',pro_sale_price = '$saleprice' WHERE psp_id = '$eid'";  
        $result = mysqli_query($conn,$query);
       header("location:purchase_stock.php?stock=$d");
    }
	?>
<!DOCTYPE html>
<html>
<head>
  <?php include("css.php");  ?>
  
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
                <h3 class="card-title">Product Purchase Quantity</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <!-- ------------------- Start ------------------ -->
		
		<form method="post" enctype="multipart/form-data">
            <?php if(isset($_REQUEST['edit'])){ ?>
            <div class="box-body border">
			  	<div class="form-group col-lg-12">
                <div class="form-floating mt-3">
                <label for="floatingTextarea">Availble Qty</label>
                    <input type = "text" class="form-control" value="<?php echo $f['pro_pur_qty'];  ?>" placeholder="Product Purchase Qty" name="aqty" readonly=""><br>
					<input type = "text" class="form-control" placeholder="Update Purchase Qty" name="aqty1">
                    <input type = "hidden" class="form-control" value="<?php echo $f['pro_pur_qty'];  ?>" placeholder="Update Purchase Qty" name="updqty">

                </div>

                <div class="form-floating mt-3">
                <label for="floatingTextarea">Purchase  Price</label>
                    <input type = "text" class="form-control" value="<?php echo $f['pro_pur_price'];  ?>" placeholder="Product Purchase Price" name="purprice">
                    

                </div>
                <div class="form-floating mt-3">
                <label for="floatingTextarea">Sale Price</label>
                    <input type = "text" class="form-control" value="<?php echo $f['pro_sale_price'];  ?>" placeholder="Product Sale Price" name="saleprice">
                    

                </div>
                  <div class="box-footer mt-3">
                     <button type="submit" name="btn_submit" class="btn btn-warning">Update</button>
                  </div>		
			</div>
            <?php } ?>        
       </form>
            </div>
            <!-- /.card -->
            </div>
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

</body>
</html>