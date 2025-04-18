<?php 
include("../connection.php");
include("session_admin.php");

   
?>

<!DOCTYPE html>
<html>
<head>
  <?php include("css.php");  ?>
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
 
    <!-- /.content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title"> Customer Order Tracking</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <center>
			<?php
					  $user = $_SESSION['customer'];
					  $t=$_REQUEST['t'];
					  $sor = "select * from c_cart where  (cc_status = 'ordered' OR cc_status = 'process' OR cc_status = 'dispatched' OR cc_status = 'cancel' OR cc_status = 'delivered' OR cc_status = 'Return') and cc_id='$t'";
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
								 
								 --><li class="progtrckr-done">Cancel</li>
									<?php
									}
									elseif($wor['cc_status'] == 'return')
									{
									?>
									<li class="progtrckr-done">Ordered</li><!--
								 
								 --><li class="progtrckr-done">Return</li>
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
 <!-- insert validation when data alredy exists -->

</body>
</html>
