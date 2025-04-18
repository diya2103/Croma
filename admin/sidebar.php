<?php 
include("../connection.php");
include("session_admin.php");
?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Admin Panel</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Admin</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add Menu -->
          <li class="nav-item">
            <a href="index.php" class="nav-link">
              <i class="nav-icon fas fa-home"></i>
              <p>Home</p>
            </a>
          </li>
		  <li class="nav-item has-treeview"><!--menu-open-->
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Master <i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="category.php" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Category</p>
                </a>
              </li>
            </ul>  
			    
			<ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="subcategory.php" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Subcategory</p>
                </a>
              </li>
            </ul>
			<ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pincode.php" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pincode</p>
                </a>
              </li>
            </ul>
			
          </li>
		   <li class="nav-item has-treeview"><!--menu-open-->
            <a href="" class="nav-link active">
              <i class="nav-icon fas fa-hospital"></i>
              <p>Product<i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="purchaseentry.php" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Purchase Entry</p>
                </a>
              </li>
            </ul> 
			    <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="purchase_detail.php" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Purchase Detail</p>
                </a>
              </li>
            </ul>  
			</li>
			
			 </li>
		   <li class="nav-item has-treeview"><!--menu-open-->
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-user"></i>
              <p>Customer Detail<i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="customerdetail.php" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Customer Detail</p>
                </a>
              </li>
            </ul>
			<ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="order.php" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Order Detail</p>
                </a>
              </li>
            </ul> 
			 
			
			</li>
			
			<?php /*?> <li class="nav-item has-treeview"><!--menu-open-->
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-edit"></i>
              <p>Report<i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="hospital_search.php" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Hospitalwise Search</p>
                </a>
              </li>
            </ul> 
			 <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="doctor_search.php" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Doctorwise Search</p>
                </a>
              </li>
            </ul> 
			 <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="newcase_search.php" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>New Casewise Search</p>
                </a>
              </li>
            </ul> 
			<!-- <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="oldcase_search.php" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Old Casewise Search</p>
                </a>
              </li>
            </ul> -->
			</li>
		  
		     <li class="nav-item has-treeview"><!--menu-open-->
            <a href="report_googlechart.php" class="nav-link active">
              <i class="nav-icon fas fa-chart-bar"></i>
              <p>Google Chart<i class="right fas fa-angle-left"></i></p>
            </a>  
			</li><?php */?>
 
		  
		  
		  
		  
		  <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
		  <?php /*?><li class="nav-item has-treeview"><!--menu-open-->
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./index.html" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v1</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index2.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v2</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index3.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v3</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="pages/widgets.html" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Widgets
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li><?php */?>
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>