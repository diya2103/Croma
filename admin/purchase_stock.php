<?php
	include('../connection.php');
	include('session_admin.php');
	if(isset($_REQUEST['stock']))
	{
		$stock=$_REQUEST['stock'];
        $sel = "SELECT category.*,subcategory.*,product_entry.*,product_size_price.* FROM product_entry JOIN category ON category.category_id = product_entry.p_cid JOIN subcategory ON subcategory.subcategory_id = product_entry.p_subid JOIN product_size_price 
        ON product_entry.pe_code = product_size_price.pe_code WHERE product_size_price.pe_code = '$stock'";
         $result = mysqli_query($conn,$sel);
         $f = mysqli_fetch_array($result);
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
                <h3 class="card-title">Purchase Entry</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <!-- ------------------- Start ------------------ -->
		
		<form method="post" enctype="multipart/form-data">
           <div class="row">
            <div class="col-6">
                <h4 class="text-center m-4 "><b>Category & Subcategory</b></h4>
                    <div class="d-flex bd-highlight">
                        <div class="p-2 flex-grow-1 bd-highlight"><b>Category</b></div>
                        <div class="p-2 flex-grow-1 bd-highlight"><?php echo $f['category_name'];  ?></div>
                    </div>
                    <div class="d-flex bd-highlight">
                        <div class="p-2 flex-grow-1 bd-highlight"><b>Sub category</b></div>
                        <div class="p-2 flex-grow-1 bd-highlight"><?php echo $f['subcategory_name'];  ?></div>
                    </div>
                    <div class="d-flex bd-highlight">
                        <div class="p-2 flex-grow-1 bd-highlight"><b>Product</b></div>
                        <div class="p-2 flex-grow-1 bd-highlight"><?php echo $f['pname'];  ?></div>
                    </div>
                    <hr>
                    <div class="d-flex bd-highlight">
                        <div class="p-2 flex-grow-1 bd-highlight"><b>Tax</b></div>
                        <div class="p-2 bd-highlight"></div>
                        <div class="p-2 bd-highlight"><b>CGST</b></div>
                        <div class="p-2 flex-grow-1 bd-highlight"><?php echo $f['cgst'];  ?>%</div>
                    </div>
            </div>
          
            <div class="col-6">
                <h4 class="text-center m-4 "><b>Purchase Detail</b></h4>
                <div class="d-flex bd-highlight">
                        <div class="p-2 flex-grow-1 bd-highlight"><b>Purchase Code</b></div>
                        <div class="p-2 flex-grow-2 bd-highlight"><?php echo $f['pe_code'];  ?></div>
                    </div>
                    <div class="d-flex bd-highlight">
                        <div class="p-2 flex-grow-1 bd-highlight"><b>Product Name</b></div>
                        <div class="p-2 flex-grow-2 bd-highlight"><?php echo $f['pname'];  ?></div>
                    </div>
                    <div class="d-flex bd-highlight">
                        <div class="p-2 flex-grow-1 bd-highlight"><b>Purchase Date</b></div>
                        <div class="p-2 flex-grow-2 bd-highlight"><?php echo $f['date'];  ?></div>
                    </div>
                    <hr>
                    <div class="d-flex bd-highlight">
                        <div class="p-2  bd-highlight"><b>SGST</b></div>
                        <div class="p-2   flex-grow-1 bd-highlight"><?php echo $f['sgst'];  ?>%</div>
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
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Category Details</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <?php 
                  $stock=$_REQUEST['stock'];
                  $pstock = "SELECT category.*,subcategory.*,product_entry.*,product_size_price.* FROM product_entry JOIN category ON category.category_id = product_entry.p_cid JOIN subcategory ON subcategory.subcategory_id = product_entry.p_subid JOIN product_size_price 
                  ON product_entry.pe_code = product_size_price.pe_code WHERE product_size_price.pe_code = '$stock'";
                    $res = mysqli_query($conn,$pstock);

                ?>
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Size</th>
                  <th>Sale Qty</th>
                  <th>Availble Qty</th>
                  <th>Purchase Price</th>
                  <th>Sale Price</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    <?php while($row=mysqli_fetch_array($res)){ ?>
                <tr>
                  <td><?php echo $row['psp_id']; ?></td>
                  <td><?php echo $row['pcolor']; ?></td>
                  <td>0</td>
                  <td><?php echo $row['pro_pur_qty']; ?></td>
                  <td><?php echo $row['pro_pur_price']; ?></td>
                  <td><?php echo $row['pro_sale_price']; ?></td>
                  <td>
                    <a href="purchase_stock_edit.php?edit=<?php echo $row['psp_id']; ?>&stock=<?php echo $_REQUEST['stock']; ?>" class="btn btn-primary">Edit</a>
                  </td>
                </tr>
               <?php } ?>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
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