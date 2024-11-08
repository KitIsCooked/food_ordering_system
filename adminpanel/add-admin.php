<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>

        <br><br>

        <?php
            if(isset($_SESSION['add'])){ //Checking whether the Session is Set or Not
                echo $_SESSION['add']; //Display Session Message if Set
                unset($_SESSION['add']); //Removing Session Message after refreshing the page
            }
        ?>

        <form action="" method="POST">
            
            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td><input type="text" name="full_name" placeholder="Enter your name"></td>
                </tr>

                <tr>
                    <td>Username: </td>
                    <td><input type="text" name="username" placeholder="Enter your username"></td>
                </tr>

                <tr>
                    <td>Password: </td>
                    <td><input type="password" name="password" placeholder="Enter your password"></td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        
        </form>


    </div>
</div>

<?php include('partials/footer.php'); ?>

<?php
    // Process the value from form and save it in database
    // Check whether the submit button is clicked or not
    if(isset($_POST['submit'])){
        // echo "Button Clicked";
        
        //1. Get Data from form
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = md5($_POST['password']); //Password Encryption with MD5   

        //2. SQL Query to save the data into DB
        $sql = "INSERT INTO admin_tbl SET 
        full_name = '$full_name',
        username = '$username',
        password = '$password'
        ";

        //3. Executing Query and saving data in DB
        $res = mysqli_query($conn, $sql) or die(mysqli_error());

        //4. Check whether the data (Query) is inserted or not and display appropriate message
        if($res == TRUE){
            // echo "Data Inserted";
            //Create a session variable to display message
            $_SESSION['add'] = '<div class="success">Admin Added Successfully</div>';
            //Redirect Page to manage-admin
            header("location:".SITEURL.'adminpanel/manage-admin.php');
        }
        else{
            // echo "Failed to insert data";
            //Create a session variable to display message
            $_SESSION['add'] = '<div class="error">Failed to Add Admin</div>';
            //Redirect Page to manage-admin
            header("location:".SITEURL.'adminpanel/manage-admin.php');
        }
    }
?>