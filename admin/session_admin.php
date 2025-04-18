<?php 
        if(isset($_SESSION['admin']))
        {
            $email = $_SESSION['admin'];
        
        }
        else
        {
            header("location:../login.php");
        }

?>