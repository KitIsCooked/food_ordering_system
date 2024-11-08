<?php
    
    //Start Session
    session_start();


    //Create constant to store non repeating values
    define('SITEURL', 'http://localhost/food-ordering/');
    
    define('LOCALHOST', 'localhost:3307');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', 'Wankit@2003');
    define('DB_NAME', 'food-ordering');
    

    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error()); //Database Connection
    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error()); //Selecting Database

?>