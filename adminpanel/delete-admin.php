<?php

    //Include contants.php file here
    include('../config/constant.php');

    // 1. Get the ID of Admin to be deleted
    $id = $_GET['id'];

    // 2. Create SQL Query to Delete Admin
    $sql = "DELETE FROM admin_tbl WHERE id = $id";

    //Execute the Query
    $res = mysqli_query($conn, $sql);

    //Check whether the query executed sucessfully or not
    if($res==TRUE){
        // echo "Admin Deleted";
        //Create SESSION Variable to Display Message
        $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully</div>";
        //Redirect to Manage Admin Page
        header('location:'.SITEURL.'adminpanel/manage-admin.php');
    }
    else{
        // echo "Failed to delete Admin";

        $_SESSION['delete'] = "<div class='error'>Failed to delete admin</div>";
        header('location:'.SITEURL.'adminpanel/manage-admin.php');
    }

    // 3. Redirect to Manage Admin page with message(success/error)


?>