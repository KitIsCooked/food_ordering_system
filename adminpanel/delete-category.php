<?php 
//Include constant file
    include('../config/constant.php');
    //Check whether the id and image_name value os set or not
    if(isset($_GET['id']) and isset($_GET['image_name'])){

        //Get the value and delete
        // echo "Get value and delete";
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //Remove the physical image file if available
        if($image_name!=""){
            
            //Image available, so remove it
            $path = "../images/category/".$image_name;
            //Remove the image
            $remove = unlink($path);

            //If failed to remove image then add an error message and stop the process
            if($remove==FALSE){

                //Set the session message
                $_SESSION['remove'] = "<div class='error'>Failed to remove category image.</div>";
                //Redirect to Manage Category page
                header('location:'.SITEURL.'adminpanel/manage-category.php');
                //Stop the process
                die();
            }
        }


        //Delete data from DB
        //SQL query to delete data from DB
        $sql = "DELETE FROM category_tbl WHERE id=$id";

        //Execute Query
        $res = mysqli_query($conn, $sql);

        //Check whether the data is deleted from DB or not
        if($res==TRUE){
            
            //Set success message and redirect
            $_SESSION['delete'] = "<div class='success'>Category deleted successfully.</div>";
            //Redirect to manage category
            header('location:'.SITEURL.'adminpanel/manage-category.php');
        }
        else{
            //Set Fail message and redirect
            $_SESSION['delete'] = "<div class='error'>Failed to delete category.</div>";
            //Redirect to manage category
            header('location:'.SITEURL.'adminpanel/manage-category.php');
        }

    }
    else{
        //Redirect to Manage Category Page
        header('location:'.SITEURL.'adminpanel/manage-category.php');
    }

?>