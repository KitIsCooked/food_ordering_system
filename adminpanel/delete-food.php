<?php 
    include('../config/constant.php');

    if(isset($_GET['id']) && isset($_GET['image_name'])){

    //Process to Delete
    
    //1. Get the Image name
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    //2. Remove the image if available
    //Check whether the image is available or not and delete only if available
    if($image_name != ""){

        //It has image and needs to remove from folder
        //Get the image path 
        $path = "../images/food/".$image_name;

        //Remove image file from folder
        $remove = unlink($path);

        //Check whether the image is removed or not
        if($remove==FALSE){
            
            //Failed to remove Image
            $_SESSION['upload'] = "<div class='error text-center'>Failed to remove image file.</div>";
            header('location:'.SITEURL.'adminpanel/manage-food.php');

            //Stop process of Deleting Food
            die();
        }
    }

        //3. Delete food from DB
        $sql = "DELETE FROM food_tbl WHERE id=$id";
        
        //Execute the query
        $res = mysqli_query($conn, $sql);

        //Check whether the query executed or not
        if($res==TRUE){

            $_SESSION['delete'] = "<div class='success text-center'>Food Deleted successfully.</div>";
            header('location:'.SITEURL.'adminpanel/manage-food.php');
        }
        else{

            $_SESSION['delete'] = "<div class='success text-center'>Failed to delete food.</div>";
            header('location:'.SITEURL.'adminpanel/manage-food.php');
        }

    }
    else{

        //Redirect to Manage Food page
        $_SESSION['unauthorized'] = "<div class='error text-center'>Unauthorized Access.</div>";
        header('location:'.SITEURL.'adminpanel/manage-food.php');
    } 

?>

