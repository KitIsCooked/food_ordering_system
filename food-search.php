<?php include('partials-front/menu.php'); ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            <?php

            //Get the search keyword
            $search = $_POST['search'];
            
            ?>
            
            <h2>You searched for <a href="#" class="text-white">"<?php echo $search; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Menu</h2>

            <?php

                //SQL query to get foods based on search keyword
                $sql = "SELECT * FROM food_tbl WHERE title LIKE '%$search%' OR description LIKE '%$search%'";

                // Corrected variable name to $sql
                $res = mysqli_query($conn, $sql);

                $count = mysqli_num_rows($res);

                if($count > 0){

                    //Check whether food available or not
                    while($row = mysqli_fetch_assoc($res)){
                        
                        //Get the details 
                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $description = $row['description'];
                        $image_name = $row['image_name'];
                        ?>

                        <div class="food-menu-box">
                            <div class="food-menu-img">

                                <?php

                                    //Check if image name is available
                                    if($image_name == ""){

                                        //Not available
                                        echo "<div class='error text-center'>Image not available.</div>";
                                    }
                                    else{

                                        //Image available
                                        ?>

                                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="img-responsive2 img-curve">

                                        <?php
                                    }

                                ?>

                            </div>

                            <div class="food-menu-desc">
                                <h4><?php echo $title; ?></h4>
                                <p class="food-price">$<?php echo $price; ?></p>
                                <p class="food-detail">
                                    <?php echo $description; ?>
                                </p>
                                <br>

                                <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                            </div>
                        </div>

                        <?php // Corrected to <?php here
                    }
                }
                else{

                    //Food not available
                    echo "<div class='error text-center'>Food not found.</div>";
                }
            ?>

            <div class="clearfix"></div>

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

<?php include('partials-front/footer.php'); ?>