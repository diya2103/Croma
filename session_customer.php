<?php 
    // Debug session state
    error_log("Session state in session_customer.php: " . print_r($_SESSION, true));

    if(isset($_SESSION['customer']))
    {
        $email = $_SESSION['customer'];
        error_log("Customer session found: " . $email);
        
        $selstudent = "SELECT * From customer_registration WHERE email=?";
        $stmt = $conn->prepare($selstudent);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $resultstudent = $stmt->get_result();
        
        if($row2 = $resultstudent->fetch_assoc()) {
            $cust_id = $row2['cust_id'];
            $fullname = $row2['fullname'];
            $email = $row2['email'];
            $address = $row2['address'];
            $city = $row2['city'];
            $gender = $row2['gender'];
            $mobileno = $row2['mobileno'];
            $image = $row2['image'];
        } else {
            error_log("Customer not found in database: " . $email);
            session_unset();
            session_destroy();
            if (!headers_sent()) {
                header("location:login.php");
                exit();
            }
        }
    }
    else
    {
        error_log("No customer session found");
        if (!headers_sent()) {
            header("location:login.php");
            exit();
        }
    }
?>