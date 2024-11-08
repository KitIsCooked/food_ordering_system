<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1 class="text-center">Manage Category</h1>

        <br /><br /><br />

        <!-- Button to add Admin -->
        <a href="<?php echo SITEURL; ?>adminpanel/add-category.php" class="btn-primary">Add Category</a>
        
        <br /><br /><br />

            <?php
                if(isset($_SESSION['add'])){
                    
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }
                
                if(isset($_SESSION['remove'])){
                    
                    echo $_SESSION['remove'];
                    unset($_SESSION['remove']);
                }
                
                if(isset($_SESSION['delete'])){
                    
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }
                
                if(isset($_SESSION['no-category-found'])){
                    
                    echo $_SESSION['no-category-found'];
                    unset($_SESSION['no-category-found']);
                }
                
                if(isset($_SESSION['update'])){
                    
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }
                
                if(isset($_SESSION['upload'])){
                    
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);
                }
                
                if(isset($_SESSION['failed-remove'])){
                    
                    echo $_SESSION['failed-remove'];
                    unset($_SESSION['failed-remove']);
                }
            ?>

            <br><br>

        <table class="tbl-full">
            <tr>
                <th>SI.No</th>
                <th>Title</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>

            <?php
                //Query to Get all categories from DB
                $sql = "SELECT * FROM category_tbl";

                //Execute Query
                $res = mysqli_query($conn , $sql);

                //Count rows
                $count = mysqli_num_rows($res);

                //Create serial no variable and assign value 1
                $sn = 1;

                //Check whether we have data in DB or nor
                if($count>0){
                    //Data present
                    //Get data and display 
                    while($row=mysqli_fetch_assoc($res)){

                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        $featured = $row['featured'];
                        $active = $row['active'];

                        ?>

                            <tr>
                                <td><?php echo $sn++; ?></td>
                                <td><?php echo $title; ?></td>

                                <td>
                                    <?php 
                                        //Check whether image name is available or not
                                        if($image_name!=""){
                                            
                                            //Display the image
                                            ?>
                                            
                                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" width="100px">
                                            
                                            <?php
                                        }else{
                                            
                                            //Display the Message
                                            echo "<div class='error'>Image not Added.</div>";
                                        }
                                    ?>
                                </td>

                                <td><?php echo $image_name; ?></td>
                                <td><?php echo $featured; ?></td>
                                <td><?php echo $active; ?></td>
                                <td>
                                    <a href="<?php echo SITEURL; ?>adminpanel/update-category.php?id=<?php echo $id; ?>" class="btn-secondary">Update Category</a>
                                    <a href="<?php echo SITEURL; ?>adminpanel/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Category</a>
                                </td>
                            </tr>

                        <?php
                    }
                }
                else{
                    //Data not present
                    //Display the messsage inside table
                    ?>

                    <tr>
                        <td colspan="6"><div class="error text-center">No Category Added.</div></td>
                    </tr>

                    <?php
                }
                ?>

        </table>
    </div>
</div>

