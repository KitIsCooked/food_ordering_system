<?php include('partials/menu.php'); ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Change Password</h1>

            <br><br>
            
            <?php 
            
                if(isset($_GET['id'])){
                    $id = $_GET['id'];
                }

            ?>

            <form action="" method="POST">
                <table class="tbl-30">
                    <tr>
                        <td>Current Password: </td>
                        <td>
                            <input type="password" name="current_password" placeholder="Enter you current password">
                        </td>
                    </tr>

                    <tr>
                        <td>New Password: </td>
                        <td>
                            <input type="password" name="new_password" placeholder="New password">
                        </td>
                    </tr>

                    <tr>
                        <td>Confirm Password:</td>
                        <td>
                            <input type="password" name="confirm_password" placeholder="Confirm Password">
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="id"  value="<?php echo $id; ?>">
                            <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>

<?php
    //Check whether the submit button is clicked
    if(isset($_POST['submit'])){
        // echo "clicked";

        //1. Get the data from form
        $id=$_POST['id'];
        $current_password = md5($_POST['current_password']);
        $new_password = md5($_POST['new_password']);
        $confirm_password = md5($_POST['confirm_password']);

        //2. Check whether the user with current id and password exists or not
        $sql = "SELECT * FROM admin_tbl WHERE id=$id AND password='$current_password'";

        // Execute the query
        $res = mysqli_query($conn, $sql);

        if($res==TRUE){
            //Check if data is available
            $count=mysqli_num_rows($res);

            if($count==1){
                //User exists and password can be changed
                // echo "User found";
                //Check whether the new password match or not
                if($new_password==$confirm_password){
                    //Update the Password
                    // echo "Password matched";
                    $sql2 = "UPDATE admin_tbl SET
                    password='$new_password' 
                    WHERE id=$id
                    ";

                    //Execute the Query
                    $res2 = mysqli_query($conn, $sql2);

                    //Check whether the query executed or not
                    if($res2==TRUE){
                        //Display Success Message
                        //Redirect to Manage admin page with error message
                        $_SESSION['change-pwd'] = "<div class='success'>Password changed successfully. </div>";
                        //Redirect the user
                        header('location:'.SITEURL."adminpanel/manage-admin.php");
                    }
                    else{
                        //Display error message
                        //Redirect to Manage admin page with error message
                        $_SESSION['change-pwd'] = "<div class='error'>Password not changed. Try again.</div>";
                        //Redirect the user
                        header('location:'.SITEURL."adminpanel/manage-admin.php");
                    }
                }
                else{
                    //Redirect to Manage admin page with error message
                    $_SESSION['pwd-not-matched'] = "<div class='error'>Password does not match. </div>";
                    //Redirect the user
                    header('location:'.SITEURL."adminpanel/manage-admin.php");
                }
                
            }
            else{
                //User does not exist set Message and redirect
                $_SESSION['user-not-found'] = "<div class='error'>User not found. </div>";
                //Redirect the user
                header('location:'.SITEURL."adminpanel/manage-admin.php");
            }
        }

        //3. Check whether the new password and confirm password matches or not

        //4. Change password if all above is true
    }

?>

