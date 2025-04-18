<?php
 $msg="";
  include ("../connection.php");
  include("session_admin.php");
  if(isset($_REQUEST['submitbtn']))
  {
      $oldpassword = $_REQUEST['old_password'];
      $newpassword = $_REQUEST['password'];
      $cpassword = $_REQUEST['cpassword'];
      $email = $_SESSION['admin'];
      
      $changeselect = "SELECT * FROM adminlogin WHERE password='$oldpassword' and email='$email'";
      $result = mysqli_query($conn,$changeselect);
      if(mysqli_num_rows($result)>0)
      {
        if($_REQUEST['password'] == $_REQUEST['cpassword'])
        {
          $q1 = "UPDATE adminlogin SET password ='$newpassword',cpassword ='$cpassword' WHERE  email='$email'";
          mysqli_query($conn ,$q1);
          $msg="password change";
        }
        else               
        {
          $msg="New and Conform password Are Not Match";
        }
      }
      else
      {
    $msg="old Password is Invalid";
      }
  }
?>
<!DOCTYPE html>
<html>
<head>
<?php include ("css.php"); ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

 <?php include ("header.php"); ?>

<?php include ("sidebar.php"); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
         <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Change Password</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
        
              <form role="form" id="quickForm" method="POST">
                <div class="card-body">
                <center><b style="color:orange">
        <?php
          if($msg != '')
          {
            echo "* ".$msg; 
          }
        ?>
        </b></center><br>
                  <div class="form-group">
                    <label for="old_password">Old Password</label>
                    <input type="password" name="old_password" class="form-control" id="old_password" placeholder="Enter old password" required>
                  </div>
                  <hr>
                  <div class="form-group">
                    <label for="new_password">New Password</label>
                    <input type="password" name="password" class="form-control" id="password" placeholder="Enter new password" required >
                  </div>
                  <div class="form-group">
                    <label for="cpassword">Confirm Password</label>
                    <input type="password" name="cpassword" class="form-control" id="cpassword" placeholder="Enter confirm password" required>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="submitbtn">Submit</button>
                </div>
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
  </div>
  <!-- /.content-wrapper -->
    <?php  include ("footer.php"); ?>

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
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- jquery-validation -->
<script src="plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="plugins/jquery-validation/additional-methods.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="js/main.js"></script>
 
<!-- Datatables script -->
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

</body>
</html>
 