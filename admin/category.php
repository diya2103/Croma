<?php 
include("../connection.php");
include("session_admin.php");

    if (isset($_REQUEST['submitbtn'])) 
    {
        $categoryname = $_REQUEST['categoryname'];
    
            $insertQuery = "INSERT INTO category VALUES(null, '$categoryname')";
            $result = mysqli_query($conn, $insertQuery);
            echo '<script>alert("successfully inserted")</script>';
            echo "<script>window.location='category.php'</script>";

        }
    
    
        if(isset($_REQUEST['edit']))
        {
                   $vid = $_REQUEST['edit'];
                    $selectquery = "SELECT * FROM category WHERE category_id = '$vid'";
                    $run = mysqli_query($conn,$selectquery);
                    $f = mysqli_fetch_array($run);
                    
        }
        if(isset($_REQUEST['updbtn']))
        {
            $category_id = $_REQUEST['edit']; 
            $categoryname = $_REQUEST['categoryname']; 
            $query = "UPDATE category SET category_name = '$categoryname' WHERE category_id = '$category_id'";  
            $result = mysqli_query($conn,$query);
            echo '<script>alert("successfully updated")</script>';
            echo "<script>window.location='category.php'</script>";
        }
        if(isset($_REQUEST['del']))
        {
            $del = $_REQUEST['del']; 
            
            $query = "DELETE FROM category WHERE category_id = '$del'";  
            $result = mysqli_query($conn,$query);
            echo '<script>alert("successfully deleted")</script>';
            echo "<script>window.location='category.php'</script>";
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
                <h3 class="card-title">ADD Category</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" id="quickForm" method="POST">
                <?php if(isset($_REQUEST['edit'])){ ?>
                <div class="card-body">
                  <div class="form-group">
                    <label for="categoryname">Category Name</label>
                    <input type="text" name="categoryname" class="form-control" id="categoryname" value="<?php echo $f['category_name']; ?>" placeholder="Enter Category" required onKeyPress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)" pattern="[A-Z a-z  ]{3,}" title="Minimum 3 Character Required">
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <div id="uid">
                  <button type="submit" class="btn btn-warning" name="updbtn">Update</button>
                  </div>
                </div>
                <?php  }else{ ?>
                    <div class="card-body">
                  <div class="form-group">
                    <label for="categoryname">Category Name</label>
                    <input type="text" name="categoryname" class="form-control" id="categoryname" placeholder="Enter Category" required onKeyPress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)" pattern="[A-Z a-z  ]{3,}" title="Minimum 3 Character Required">
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <div id="cid">
                  <button type="submit" class="btn btn-primary" name="submitbtn">Submit</button>
                  </div>
                </div>
                <?php  } ?>
              </form>
            </div>
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">

          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
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
                    $sel = "SELECT * FROM category";
                    $res = mysqli_query($conn,$sel);
                
                ?>
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Category Name</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    <?php while($row=mysqli_fetch_array($res)){ ?>
                <tr>
                  <td><?php echo $row['category_id']; ?></td>
                  <td><?php echo $row['category_name']; ?></td>
                  <td>
                    <a href="category.php?edit=<?php echo $row['category_id']; ?>" class="btn btn-primary">Edit</a>
                    <a href="category.php?del=<?php echo $row['category_id']; ?>" class="btn btn-danger" onclick="return confirm('are you sure want to delete.?')">Delete</a>
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
 <!-- insert validation when data alredy exists -->
 <script>
                $(document).ready(function(){
                $('#categoryname').keyup(function(){
                var cid = $('#categoryname').val();
                if(cid != '')
                {
                $.ajax({
                    url:"alredycategory.php",
                    method:"GET",
                    data:{value:cid,id:'cid'},
                    success:function(data)
                    {
                    $('#cid').html(data);
                    }
                });
                }
                });
                
                   });
</script>
<script>
                $(document).ready(function(){
                $('#categoryname').keyup(function(){
                var cid = $('#categoryname').val();
                if(cid != '')
                {
                $.ajax({
                    url:"alredyupdcategory.php",
                    method:"GET",
                    data:{value:cid,id:'cid'},
                    success:function(data)
                    {
                    $('#uid').html(data);
                    }
                });
                }
                });
                
                   });
</script>
</body>
</html>
