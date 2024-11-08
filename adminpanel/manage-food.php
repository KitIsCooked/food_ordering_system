<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1 class="text-center">Manage Food Items</h1>
        <br /><br /><br />

        <!-- Button to add Admin -->
        <a href="<?php echo SITEURL; ?>adminpanel/add-food.php" class="btn-primary">Add dessert</a>

        <br /><br /><br />

        <?php
            if(isset($_SESSION['add'])){

                echo $_SESSION['add'];
                unset ($_SESSION['add']);
            }

            if(isset($_SESSION['delete'])){

                echo $_SESSION['delete'];
                unset ($_SESSION['delete']);
            }
            
            if(isset($_SESSION['upload'])){

                echo $_SESSION['upload'];
                unset ($_SESSION['upload']);
            }
            
            if(isset($_SESSION['unauthorized'])){

                echo $_SESSION['unauthorized'];
                unset ($_SESSION['unauthorized']);
            }
            
            if(isset($_SESSION['update'])){

                echo $_SESSION['update'];
                unset ($_SESSION['update']);
            }
            
        ?>

        <br>

        <table class="tbl-full">
            <tr>
                <th>SI.No</th>
                <th>Title</th>
                <th>Price</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Action</th>
            </tr>

            <?php

                //SQL query to get all the Food 
                $sql = "SELECT * FROM food_tbl";

                //Execute query
                $res = mysqli_query($conn, $sql);

                //Count rows to check whether we have food or not
                $count = mysqli_num_rows($res);

                //Create Serial Number variable as 1
                $sn = 1;

                if($count>0){

                    //We have Food in DB
                    //Get the food from DB and display
                    while($row=mysqli_fetch_assoc($res)){
                        //Get the value from individual columns
                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $image_name = $row['image_name'];
                        $featured = $row['featured'];
                        $active = $row['active'];
                        ?>
 
                        <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo $title; ?></td>
                            <td><?php echo $price; ?></td>
                            <td>
                                <?php 
                                    //Check whether we have image or not
                                    if($image_name==""){
                                        
                                        //We do nott have image, Display error message
                                        echo "<div class='error text-center'>Image not added.</div>";
                                    }
                                    else{
                                        
                                        //We have image, Display Image
                                        ?>
                                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" width="100px">
                                        <?php
                                    }
                                ?>
                            </td>
                            <td><?php echo $featured; ?></td>
                            <td><?php echo $active; ?></td>
                            <td>
                                <a href="<?php echo SITEURL; ?>adminpanel/update-food.php?id=<?php echo $id; ?>" class="btn-secondary">Update Food</a>
                                <a href="<?php echo SITEURL; ?>adminpanel/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Food</a>
                            </td>
                        </tr>

                        <?php
                        
                    }
                }
                else{

                    //Food not added in DB
                    echo "<tr> <td colspan='7' class='error text-center'> Food not added yet. </td> </tr>";
                }

            ?>

        </table>
    </div>
</div>

