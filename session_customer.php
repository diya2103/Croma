<?php 

        if(isset($_SESSION['customer']))
        {
            $email = $_SESSION['customer'];
            $selstudent = "SELECT * From customer_registration  WHERE email='$email'";
            $resultstudent = mysqli_query($conn,$selstudent);
            $row2=mysqli_fetch_array($resultstudent);
            $cust_id = $row2['cust_id'];
            $fullname = $row2['fullname'];
            $email = $row2['email'];
			 $address= $row2['address'];
			  $city = $row2['city'];
			  $gender = $row2['gender'];
			  $mobileno = $row2['mobileno'];
			  $image = $row2['image'];
           
        }
        else
        {
            header("location:login.php");
        }
    
?>