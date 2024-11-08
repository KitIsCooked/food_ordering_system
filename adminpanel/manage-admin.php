<?php include('partials/menu.php'); ?>

    <!-- Main Content Section Start -->
    <div class="main-content">
        <div class="wrapper">
            <h1 class="text-center">Manage Admin</h1>

            <br /><br />

            <?php
                if(isset($_SESSION['add'])){
                    echo $_SESSION['add']; //Display Session Message
                    unset($_SESSION['add']); //Removing Session Message after refreshing the page
                }

                if(isset($_SESSION['delete']))
                {
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }

                if(isset($_SESSION['update'])){
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }

                if(isset($_SESSION['user-not-found'])){
                    echo $_SESSION['user-not-found'];
                    unset($_SESSION['user-not-found']);
                }

                if(isset($_SESSION['pwd-not-matched'])){
                    echo $_SESSION['pwd-not-matched'];
                    unset($_SESSION['pwd-not-matched']);
                }
                
                if(isset($_SESSION['change-pwd'])){
                    echo $_SESSION['change-pwd'];
                    unset($_SESSION['change-pwd']);
                }
            ?>

            <br><br><br>
            
            <!-- Button to add Admin -->
            <a href="add-admin.php" class="btn-primary">Add Admin</a>

            <br /><br /><br />

            <table class="tbl-full">
                <tr>
                    <th>SI.No</th>
                    <th>Full Name</th>
                    <th>Username</th>
                    <th>Actions</th>
                </tr>

                <?php
                    //Get all Admins
                    $sql = "SELECT * FROM admin_tbl";

                    //Execute the Query
                    $res = mysqli_query($conn, $sql);

                    //Check whether the query is ececuted or not
                    if($res == TRUE){
                        //Count rows whether we have data in DB or not
                        $rows = mysqli_num_rows($res); //Function to get all the rows in Database
                        
                        $sn=1; //Create a variable and assign the value

                        //Check the num of rows
                        if($rows>0){
                            //Rows are available in DB
                            while($rows=mysqli_fetch_assoc($res)){
                                //Using While Loop to get all the data from DB
                                //And the loop will run as long as data is there in DB

                                //Get individual data
                                $id=$rows['id'];
                                $full_name=$rows['full_name'];
                                $username=$rows['username'];

                                //Display the Values in out table
                                ?>

                                <tr>
                                    <td><?php echo $sn++; ?></td>
                                    <td><?php echo $full_name; ?></td>
                                    <td><?php echo $username; ?></td>
                                    <td>
                                        <a href="<?php echo SITEURL; ?>adminpanel/update-password.php?id=<?php echo $id; ?>" class="btn-primary">Update Password</a>
                                        <a href="<?php echo SITEURL; ?>adminpanel/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update Admin</a>
                                        <a href="<?php echo SITEURL; ?>adminpanel/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete Admin</a>
                                    </td>
                                </tr>

                                                <?php

                                            }
                                        }
                                        else{
                                            //No data available
                                        }
                                    }

                                ?>
                </table>

            </div>
        </div>
    <!-- Main Content Section Ends -->

