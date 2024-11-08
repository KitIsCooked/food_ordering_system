<?php include('partials/menu.php'); ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Add Category</h1>

            <br><br>

            <?php
                if(isset($_SESSION['add'])){
                    
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }

                if(isset($_SESSION['upload'])){
                    
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);
                }
            ?>

            <br><br>

            <!-- Add Category Form starts here -->
            <form action="" method="POST" enctype="multipart/form-data">
                <table class="tbl-30">
                    <tr>
                        <td>Title: </td>
                        <td>
                            <input type="text" name="title" placeholder="Category title">        
                        </td>
                    </tr>

                    <tr>
                        <td>Select Image: </td>
                        <td>
                            <input type="file" name="image">
                        </td>
                    </tr>
                    
                    <tr>
                        <td>Featured: </td>
                        <td>
                            <input type="radio" name="featured" value="Yes"> Yes
                            <input type="radio" name="featured" value="No"> No
                        </td>
                    
                    </tr>

                    <tr>
                        <td>Active: </td>
                        <td>
                            <input type="radio" name="active" value="Yes"> Yes
                            <input type="radio" name="active" value="No"> No
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Upload" class="btn-secondary">
                        </td>
                    </tr>

                </table>
            </form>

            
            <!-- Add Category Form ends here -->

            <?php

                //Check whether the Submit button is clicked
                if(isset($_POST['submit'])){
                    
                    // echo "Clicked";
                    
                    //1. Get the value from Form
                        $title = $_POST['title'];

                    //Check whether the button is selected or not
                    if(isset($_POST['featured'])){

                        //Get the value from form
                        $featured = $_POST['featured'];
                    }    
                    else{
                        //Set the submit value
                        $featured = "No";
                    }

                    if(isset($_POST['active'])){

                        $active = $_POST['active'];
                    }
                    else{

                        $active = "No";
                    }

                    //Check whether the image is selected or not and set the value for image name accordingly
                    // print_r($_FILES['image']);

                    // die(); //Break the code here

                    if(isset($_FILES['image']['name'])){

                        //Upload the image
                        //To upload image we need image name, source path and destination path
                        $image_name = $_FILES['image']['name'];
                        
                        //Upload the Image only if image is selected
                        if($image_name!=""){

                            //Auto Rename our image
                            //Get the extension of our image (jps,png,gif,etc.) eg. "food1.jpg"
                            $ext = end(explode('.',$image_name));
                            
                            //Rename the image
                            $image_name = "Food_Category_".rand(000, 999).'.'.$ext; // New image name from food1.jpg to Food_Category_834.jpg

                            $source_path = $_FILES['image']['tmp_name'];
                            
                            $destination_path = "../images/category/".$image_name;

                            //Upload the image
                            $upload = move_uploaded_file($source_path, $destination_path);

                            //Check whether the image is uploaded or not
                            //If the image is not uploaded then we will stop the process and redirect it with error message
                            if($upload==FALSE){
                                //Set message
                                $_SESSION['upload'] = "<div class='error text-center'>Failed to upload image.</div>";
                                //Redirect to Add category page
                                header('location:'.SITEURL.'adminpanel/add-category.php');
                                //Stop the process
                                die();
                            }
                        }
                    }
                    else{
                        
                        //Dont  upload image and set the image_name value as blank
                        $image_name = "";
                    }

                    //2. SQL query to insert category into DB
                    $sql = "INSERT INTO category_tbl SET
                        title='$title',
                        image_name='$image_name',
                        featured='$featured',
                        active='$active'
                    ";

                    //3. Execute the query
                    $res = mysqli_query($conn, $sql);

                    //4. Check whether the query executed or not and data added or not
                    if($res==TRUE){
                        //Query executed and category added
                        $_SESSION['add'] = "<div class='success text-center'>Category added successfully.</div>";
                        
                        //Redirect to Manage Category page
                        header('location:'.SITEURL.'adminpanel/manage-category.php');
                    }
                    else{
                        //Failed to add category
                        $_SESSION['add'] = "<div class='error text-center'>Failed to add category.</div>";
                        
                        //Redirect to Manage Category page
                        header('location:'.SITEURL.'adminpanel/add-category.php');
                    }
                }

            ?>

        </div>
    </div>
