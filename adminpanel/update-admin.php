<?php include('partials/menu.php'); ?>
    
    <div class="main-content">
        <div class="wrapper">
            <h1>Update Admin</h1>

            <br><br>

            <?php 
                //1. Get the id of selected Admin
                $id=$_GET['id'];
                
                //2. Create sql query to get the details
                $sql="SELECT * FROM admin_tbl WHERE id=$id";

                //Execute the query
                $res=mysqli_query($conn, $sql);

                //Check whether the query is executed or not
                if($res==TRUE){
                    //Check whether the data is available or not
                    $count = mysqli_num_rows($res);
                    //Check whether we have admin data or not
                    if($count==1){
                        //Get the details
                        // echo "Admin available";
                        $row=mysqli_fetch_assoc($res);

                        $full_name = $row['full_name'];
                        $username = $row['username'];
                    }
                }
                else{
                    //Redirect to Manage admin page
                    header('location:'.SITEURL.'adminpanel/manage-admin.php');
                }



            ?>

            <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td>    
                        <input type="text" name="full_name" value="<?php echo $full_name; ?>" placeholder="Enter your full name">
                    </td>
                </tr>

                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username; ?>" placeholder="Enter your username">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                    </td>
                </tr>

            </table>

            </form>
        </div>
    </div>

<?php

    //Check whether the submit button is clicked or not
    if(isset($_POST['submit'])){
        // echo "Button clicked";
        //Get all the values from form to update
        $id = $_POST['id'];
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];

        //Create SQL query to Update Admin
        $sql = "UPDATE admin_tbl SET
        full_name = '$full_name',
        username = '$username'
        WHERE id = '$id'
        ";

        $res = mysqli_query($conn, $sql);

        //Check whether the query executed or not
        if($res==TRUE){
            //Query executed and admin added successfully
            $_SESSION['update'] = "<div class='success'>Admin Updated Successfully</div>";
            //Redirect to Manage admin page
            header('location:'.SITEURL.'adminpanel/manage-admin.php');
        }
        else{
            //Failed to update admin
            $_SESSION['update'] = "<div class='success'>Failed to Delete Admin</div>";
            //Redirect to Manage Admin page
            header('location:'.SITEURL.'adminpanel/manage-admin.php');
        }
    }

?>

