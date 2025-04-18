<?php 
include("../connection.php");
include("session_admin.php");
if(isset($_REQUEST['c']))
{
$c=$_REQUEST['c'];
$p=$_REQUEST['p'];
$update="update c_cart set cc_status='process' where cc_id='$c'";
mysqli_query($conn,$update);
header("location:cus_product.php?p=$p");

}
if(isset($_REQUEST['d']))
{
$d=$_REQUEST['d'];
$p=$_REQUEST['p'];
$update="update c_cart set cc_status='dispatched' where cc_id='$d'";
mysqli_query($conn,$update);
header("location:cus_product.php?p=$p");

}
if(isset($_REQUEST['e']))
{
$e=$_REQUEST['e'];
$p=$_REQUEST['p'];
$update="update c_cart set cc_status='delivered' where cc_id='$e'";
mysqli_query($conn,$update);

        $bill = 1;
		$sel = "select * from c_deliver";
		$res = mysqli_query($conn,$sel);
		while($row = mysqli_fetch_array($res))
		{
			$bill = $row['bill_no'] + 1;
		}
		$date = date('Y-m-d');
		$insert = "insert into c_deliver values('','$p','$bill','$date')";
		mysqli_query($conn,$insert);
		
header("location:cus_product.php?p=$p");

}

if(isset($_REQUEST['f']))
{
$e=$_REQUEST['f'];
$p=$_REQUEST['p'];
$update="update c_cart set cancel_status='Approved cancel request' where cc_id='$e'";
mysqli_query($conn,$update);
header("location:cus_product.php?p=$p");

}

if(isset($_REQUEST['g']))
{
$e=$_REQUEST['g'];
$p=$_REQUEST['p'];
$update="update c_cart set return_status='Approved return request' where cc_id='$e'";
mysqli_query($conn,$update);
header("location:cus_product.php?p=$p");

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
 
    <!-- /.content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Register Customer Details</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                
                <thead>
                <tr>
                  <th>Id</th>
		   <th>Code</th>
		   <th>Product Name</th>
		   <th>Quantity</th>
		   <th>Price</th>
		   <th>Order Status</th>
		    <th>Tracking</th>
                </tr>
                </thead>
                <tbody>
                    <?php
		   $i=1;
		   $p=$_REQUEST['p'];
		   $select="select * from c_cart join c_purchase on c_purchase.cp_code=c_cart.cp_code join product_size_price on product_size_price.psp_id=c_cart.psp_id join product_entry on product_entry.pe_code=product_size_price.pe_code join subcategory on subcategory.subcategory_id=product_entry.p_subid join category on category.category_id=subcategory.cid where  c_purchase.cp_code='$p'";
		   $res=mysqli_query($conn,$select);
		   while($row=mysqli_fetch_array($res))
		   {
		   ?>
		   <tr>
		   <td><?php echo $i; ?></td>
		   <td><?php echo $row['cp_code']; ?></td>
		   <td><?php echo $row['category_name']; ?> - <?php echo $row['subcategory_name']; ?> - <?php echo $row['pname']; ?> - <?php echo $row['pcolor']; ?></td>
		   <td><?php echo $row['cc_qty']; ?> </td>
		   <td><?php echo $row['cc_price']; ?> Rs.</td>
		   <td>
		   
		   <?php if($row['cc_status']=='ordered')
		   {
		   ?>
		    <a class="btn btn-info" href="cus_product.php?c=<?php echo $row['cc_id']; ?>&p=<?php echo $row['cp_code']; ?>" onClick="return confirm('Are you sure Process this order?')"><?php echo $row['cc_status']; ?></b></a>
		   
		   <?php
		   }
		   else if($row['cc_status']=='process')
		   {
		   ?>
		    <a class="btn btn-primary" href="cus_product.php?d=<?php echo $row['cc_id']; ?>&p=<?php echo $row['cp_code']; ?>" onClick="return confirm('Are you sure Dispatch this order?')"><?php echo $row['cc_status']; ?></b></a>
		  
		   <?php
		   }elseif($row['cc_status']=='dispatched')
		   {
		   ?>
		  <a class="btn btn-warning" href="cus_product.php?e=<?php echo $row['cc_id']; ?>&p=<?php echo $row['cp_code']; ?>" onClick="return confirm('Are you sure Delivered this order?')"><?php echo $row['cc_status']; ?></b></a>
		   <?php
		   }elseif($row['cc_status']=='delivered')
		   {
		   ?>
		   <b class="btn btn-success"><?php echo $row['cc_status']; ?></b>
		   
		   
		   <?php
		   }elseif($row['cc_status']=='cancel')
		   {
		   ?>
		   <b class="btn btn-secondary"><?php echo $row['cc_status']; ?></b>
		       <?php
			   if($row['cancel_status']=='pending cancel request')
			   {
			   ?>
		  <a class="btn btn-danger" href="cus_product.php?f=<?php echo $row['cc_id']; ?>&p=<?php echo $row['cp_code']; ?>" onClick="return confirm('Are you sure Approved this cancel order?')"><?php echo $row['cancel_status']; ?></b></a>
		  <?php
		  }
		  else
		  {
		  ?>
		  <b class="btn btn-success"><?php echo $row['cancel_status']; ?></b>
		  <?php
		  }
		  ?>
		   
		   <?php
		   }elseif($row['cc_status']=='return')
		   {
		   ?>
		   <b class="btn btn-primary"><?php echo $row['cc_status']; ?></b>
		   <?php
			   if($row['return_status']=='pending return request')
			   {
			   ?>
		  <a class="btn btn-danger" href="cus_product.php?g=<?php echo $row['cc_id']; ?>&p=<?php echo $row['cp_code']; ?>" onClick="return confirm('Are you sure Approved this return order?')"><?php echo $row['return_status']; ?></b></a>
		  <?php
		  }
		  else
		  {
		  ?>
		  <b class="btn btn-success"><?php echo $row['return_status']; ?></b>
		  <?php
		  }
		  ?>
		   <?php
		   }
		   ?>
		   </td>
		   <td><a class="btn btn-warning" href="tracking.php?t=<?php echo $row['cc_id']; ?>&p=<?php echo $row['cp_code']; ?>&tr=<?php echo $row['pname']; ?>">Tracking</a></td>
		  
		   </tr>
		   <?php
		      $i++;
		   }
		
		   ?></tbody>
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
 <!-- insert validation when data alredy exists -->

</body>
</html>
