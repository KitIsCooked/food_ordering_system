<?php include('../config/constant.php'); ?>

<html>
    <head>
        <title>Login</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body>
        <div class="login">
            <h1 class="text-center">Login</h1>
            <br><br>

            <?php 
                if(isset($_SESSION['login'])){

                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }

                if(isset($_SESSION['no-login-message'])){

                    echo $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']);
                }

            ?>
            <br><br>

            <!-- Login Form Starts Here -->
            <form action="" method="POST" class="text-center">
                Username: <br>
                <input type="text" name="username" placeholder="Enter username"><br><br>
                
                Password: <br>
                <input type="password" name="password" placeholder="Enter password"><br><br>

                <input type="submit" name="submit" value="Login" class="btn-primary">

                <br><br> 

            </form>
            <!-- Login Form Ends Here -->
        </div>
    </body>
</html>

<?php

    //Check whether the submit is clicked
    if(isset($_POST['submit'])){
        //Process Login
        //1. Get data from login form
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        //2. SQL query to check whether the username and password exists or not
        $sql = "SELECT * FROM admin_tbl WHERE username = '$username' AND password = '$password'";

        //3. Execute the query
        $res = mysqli_query($conn, $sql); 

        //4. Count rows to check whether the user exists or not
        $count = mysqli_num_rows($res);
        
        if($count==1){

            $_SESSION['login'] = "<div class='success text-center'>Login successful</div>";
            $_SESSION['user'] = $username; //To check whether the user is login or not and logout will unset it

            //Redirect to Home page/Dashboard
            header('location:'.SITEURL."adminpanel/");
        }
        else{

            $_SESSION['login'] = "<div class='error text-center'>Login failed. Username and password does not match.</div>";
            header('location:'.SITEURL."adminpanel/login.php");
        }

    }

?>