<?php 

    //Authorization - Access Control

    //Check whether the use if logged in or not
    if(!isset($_SESSION['user'])){ //If user session is not set
        
        //User is not logged in
        //Redirect to login page with message
        $_SESSION['no-login-message'] = "<div class='error text-center'>Please login to access Admin Panel.</div>";

        //Redirect to login page
        header('location:'.SITEURL.'adminpanel/login.php'); //NOTE: constant.php file is not included here
                                                            //since it will be included inside menu.php file
    }

?>