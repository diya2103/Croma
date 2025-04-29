<?php 
include("connection.php");
include("session_customer.php");

	
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include("css.php"); ?>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <?php include("customer_header.php"); ?>
    <style>
    /* Dark mode styles */
    [data-theme="dark"] .gradient-custom-2 {
        background-color: #1a1a1a;
    }

    [data-theme="dark"] .card {
        background-color: #2d2d2d;
        border-color: #404040;
    }

    [data-theme="dark"] .rounded-top {
        background-color: #000 !important;
    }

    [data-theme="dark"] h5,
    [data-theme="dark"] p,
    [data-theme="dark"] .lead,
    [data-theme="dark"] .text-black,
    [data-theme="dark"] .text-black a,
    [data-theme="dark"] .text-black b,
    [data-theme="dark"] .text-black div {
        color: #ffffff !important;
    }

    [data-theme="dark"] .text-muted {
        color: #b0b0b0 !important;
    }

    [data-theme="dark"] .btn-outline-dark {
        color: #ffffff !important;
        border-color: #ffffff !important;
        background-color: transparent !important;
    }

    [data-theme="dark"] .btn-outline-dark:hover {
        background-color: #ffffff !important;
        color: #000000 !important;
    }

    [data-theme="dark"] .p-4[style*="background-color: #f8f9fa"] {
        background-color: #2d2d2d !important;
    }

    [data-theme="dark"] .img-thumbnail {
        border-color: #404040;
        background-color: #2d2d2d;
    }

    [data-theme="dark"] .container {
        background-color: #1a1a1a;
    }

    [data-theme="dark"] .site-main {
        background-color: #1a1a1a;
    }

    [data-theme="dark"] .d-flex.flex-row {
        background-color: #000 !important;
    }

    [data-theme="dark"] .card-body {
        background-color: #2d2d2d;
    }

    [data-theme="dark"] .row {
        border-bottom: 1px solid #404040;
    }

    [data-theme="dark"] .row:last-child {
        border-bottom: none;
    }
    </style>
</head>
<body>
  <!--================ Start Header Menu Area =================-->
	<!--================ End Header Menu Area =================-->

  <main class="site-main">
    
    
    <section class="h-100 gradient-custom-2">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-lg-9 col-xl-7">
        <div class="card">
          <div class="rounded-top text-white d-flex flex-row" style="background-color: #000; height:200px;">
            <div class="ms-4 mt-5 d-flex flex-column" style="width: 150px;">
              <img src="<?php echo $image; ?>"
                alt="Generic placeholder image" class="img-fluid img-thumbnail mt-4 mb-2"
                style="width: 150px; z-index: 1;max-height:150px;min-height:150px;">
                <!-- <a href="update_profile.php?edit=<?php //echo $row['nid']; ?>" class="btn btn-outline-dark" data-mdb-ripple-color="dark"
                style="z-index: 1;" role="button">Edit profile</a> -->
                <!-- <a href="user_changepassword.php" class="btn btn-outline-dark" data-mdb-ripple-color="dark"
                style="z-index: 1;" role="button">Change Password</a> -->
            </div>
            <div class="ms-3" style="margin-top: 130px;">
              <h5 style="color:white">&nbsp; <?php echo $fullname; ?></h5>
              <p> &nbsp; <?php echo $city; ?></p>
            </div>
          </div>
          <div class="p-4 text-black" style="background-color: #f8f9fa;">
           <div class="d-flex justify-content-end text-center py-1">
               <div>
                <!-- <p class="mb-1 h5">253</p>
                <p class="small text-muted mb-0">Photos</p> -->
                <a href="profile_edit.php?edit=<?php echo $cust_id; ?>" class="btn btn-outline-dark" data-mdb-ripple-color="dark"
                style="z-index: 1;" role="button"><i class="fas fa-edit"></i>&nbsp;Edit profile</a>
              </div>
              <div class="px-3">
              <a href="changepassword.php" class="btn btn-outline-dark" data-mdb-ripple-color="dark"
                style="z-index: 1;" role="button"><i class="fas fa-key"></i>&nbsp;Change Password</a>
                <!-- <p class="mb-1 h5">1026</p>
                <p class="small text-muted mb-0">Followers</p> -->
              </div>
			                <div class="px-3">
              <a href="img_update.php?ima=<?php echo $cust_id; ?>" class="btn btn-outline-dark" data-mdb-ripple-color="dark"
                style="z-index: 1;" role="button"><i class="fas fa-edit"></i>&nbsp;Image Update</a>
                <!-- <p class="mb-1 h5">1026</p>
                <p class="small text-muted mb-0">Followers</p> -->
              </div>

              <div>
              <!--<a href="resume_upload.php" class="btn btn-outline-dark" data-mdb-ripple-color="dark"
                style="z-index: 1;" role="button"><i class="fas fa-file-upload"></i>&nbsp;Upload/Download Resume</a>
               --> <!-- <p class="mb-1 h5">478</p>
                <p class="small text-muted mb-0">Following</p> -->
              </div>
            </div>
          </div> 

          <div class="card-body p-4 text-black">
            <div class="mb-5">
              <p class="lead fw-normal mb-1">Detail Profile</p>
              <div class="p-4" style="background-color: #f8f9fa;">
                <?php /*?><div class="row">
                    <div class="col-md-6"><b>Date Of Birth</b></div>
                    <div class="col-md-6"><a><?php echo $dob; ?></a></div>
                </div><?php */?>
                <div class="row">
                    <div class="col-md-6"><b>Address</b></div>
                    <div class="col-md-6"><a><?php echo $address; ?></a></div>
                </div>
                <div class="row">
                    <div class="col-md-6"><b>City</b></div>
                    <div class="col-md-6"><a><?php echo $city; ?></a></div>
                </div>
               <?php /*?> <div class="row">
                    <div class="col-md-6"><b>Area</b></div>
                    <div class="col-md-6"><a><?php echo $area; ?></a></div>
                </div><?php */?>
                <div class="row">
                    <div class="col-md-6"><b>Gender</b></div>
                    <div class="col-md-6"><a><?php echo $gender; ?></a></div>
                </div>
                <div class="row">
                    <div class="col-md-6"><b>Mobile Number</b></div>
                    <div class="col-md-6"><a><?php echo $mobileno; ?></a></div>
                </div>
                <div class="row">
                    <div class="col-md-6"><b>Email Id</b></div>
                    <div class="col-md-6"><a><?php echo $email; ?></a></div>
                </div>
                <!-- <p class="font-italic mb-1">Web Developer</p>
                <p class="font-italic mb-1">Lives in New York</p>
                <p class="font-italic mb-0">Photographer</p> -->
              </div>
            </div>
            <!-- <div class="d-flex justify-content-between align-items-center mb-4">
              <p class="lead fw-normal mb-0">Recent photos</p>
              <p class="mb-0"><a href="#!" class="text-muted">Show all</a></p>
            </div>
            <div class="row g-2">
              <div class="col mb-2">
                <img src="https://mdbcdn.b-cdn.net/img/Photos/Lightbox/Original/img%20(112).webp"
                  alt="image 1" class="w-100 rounded-3">
              </div>
              <div class="col mb-2">
                <img src="https://mdbcdn.b-cdn.net/img/Photos/Lightbox/Original/img%20(107).webp"
                  alt="image 1" class="w-100 rounded-3">
              </div>
            </div>
            <div class="row g-2">
              <div class="col">
                <img src="https://mdbcdn.b-cdn.net/img/Photos/Lightbox/Original/img%20(108).webp"
                  alt="image 1" class="w-100 rounded-3">
              </div>
              <div class="col">
                <img src="https://mdbcdn.b-cdn.net/img/Photos/Lightbox/Original/img%20(114).webp"
                  alt="image 1" class="w-100 rounded-3">
              </div>
            </div> -->
          </div>
        </div>
      </div>
    </div>
  </div>
</section> 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
    

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