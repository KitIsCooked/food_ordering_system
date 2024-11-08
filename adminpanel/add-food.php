<?php include('partials/menu.php'); ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Add food</h1>

            <br><br>

            <?php

            if(isset($_SESSION['upload'])){
                
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }

            ?>

            <form action="" method="POST" enctype="multipart/form-data">
                <table class="tbl-30">
                    <tr>
                        <td>Title: </td>
                        <td>
                            <input type="text" name="title" placeholder="Food title">
                        </td>
                    </tr>
                    
                    <tr>
                        <td>Description: </td>
                        <td>
                            <textarea name="description" cols="30" rows="5" placeholder="Description of the food"></textarea>
                        </td>
                    </tr>
                    
                    <tr>
                        <td>Price: </td>
                        <td>
                            <input type="number" name="price">
                        </td>
                    </tr>

                    <tr>
                        <td>Select image: </td>
                        <td>
                            <input type="file" name="image">
                        </td>
                    </tr>

                    <tr>
                        <td>Category: </td>
                        <td>
                            <select name="category">

                                <?php
                                    //Create PHP code to display categories from DB
                                    //1. Create SQL to get all active categories from DB
                                    $sql = "SELECT * FROM category_tbl WHERE active='Yes'";

                                    $res = mysqli_query($conn, $sql);
                                    
                                    //Count rows to check whether we have categories or not
                                    $count = mysqli_num_rows($res);
                                    
                                    // If count is greater than zero, we have categories else we dont have categories
                                    if($count > 0){
                                        //No Categories
                                        while($row = mysqli_fetch_assoc($res)){
                                            
                                            //Get the details of categories
                                            $id = $row['id'];
                                            $title = $row['title'];
                                            
                                            ?>

                                            <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                                            
                                            <?php
                                        }
                                    }
                                    else{

                                        ?>
                                        <option value="0">No category found</option>
                                        <?php
                                    }
                                    //2. Display on dropdown
                                ?>

                            </select>
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
                            <input type="submit" name="submit" value="Add item" class="btn-secondary">
                        </td>
                    </tr>

                </table>
            </form>

            <?php

                //Check whether the button is clicked or not
                if(isset($_POST['submit'])){

                    //Add the food in DB
                    //1. Get the data from form
                    $title = $_POST['title'];
                    $description = $_POST['description'];
                    $price = $_POST['price'];
                    $category = $_POST['category'];

                    //Check whether the button for featured and active are checked or not
                    if(isset($_POST['featured'])){

                        $featured = $_POST['featured'];
                    }
                    else{

                        $featured = "No"; //Setting the default value
                    }
                    
                    if(isset($_POST['active'])){

                        $active = $_POST['active'];
                    }
                    else{

                        $active = "No"; //Setting the default value
                    }

                    //2. Upload the image if selected
                    //Check whether the select image is clicked or not and upload the image only if the image is selected
                    if(isset($_FILES['image']['name'])){

                        //Get the details of the selected image
                        $image_name = $_FILES['image']['name'];

                        //Check whether the image is selected or not and upload image only if selected
                        if($image_name!=""){

                            //Image selected
                            //A. Rename the image
                            //Get the extension of selected image (jpg, png, gif, etc.)
                            $image_info = explode (".", $image_name);
                            $ext = end ($image_info);

                            //Create new name for image
                            $image_name= "Food-name-".rand(0000,9999).".".$ext; //New image name may be like "Food-name-657"

                            //B. Upload the image
                            //Get the src path and destination path
                            
                            // Source path is the current location of the image
                            $src = $_FILES['image']['tmp_name'];

                            //Destination Path for the image to be uploaded
                            $dst = "../images/food/".$image_name;

                            //Finally upload food image
                            $upload = move_uploaded_file($src, $dst);

                            //Check whether image uploaded or not
                            if($upload==FALSE){

                                //Failed to upload image
                                //Redirect to Add Food page witg error message
                                $_SESSION['upload'] = "<div class='error'>Failed to upload image.</div>";
                                header('location:'.SITEURL.'adminpanel/add-food.php');
                                //Stop the process
                                die();
                            }
                        }
                    }

                    else{

                        $image_name = ""; //Setting default value as blank
                    }

                    //3. Insert into DB
                    //SQL query to save or add food
                    $sql2 = "INSERT INTO food_tbl SET
                        title = '$title',
                        description = '$description',
                        price = $price,
                        image_name = '$image_name',
                        category_id = $category,
                        featured = '$featured',
                        active = '$active'
                    ";

                    //execute query
                    $res2 = mysqli_query($conn, $sql2);


                    //Check whether data inserted or not
                    //4. Redirect with message to Manage Food page

                    if($res2==TRUE){

                        $_SESSION['add'] = "<div class='success text-center'>Food added successfully.</div>";
                        header('location:'.SITEURL.'adminpanel/manage-food.php');
                    }
                    else{

                        $_SESSION['add'] = "<div class='error text-center'>Failed to add food.</div>";
                        header('location:'.SITEURL.'adminpanel/manage-food.php');
                    }

                }

            ?>

        </div>
    </div>

