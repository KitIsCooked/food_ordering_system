<?php include('partials/menu.php'); ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Update Order</h1>
            
            <br><br>

            <?php

                //Check whether id is set or not
                if(isset($_GET['id'])){

                    $id = $_GET['id'];

                    //Get all of the details based on this id
                    //SQL query to get the order details
                    $sql = "SELECT * FROM order_tbl WHERE id=$id";

                    $res = mysqli_query($conn, $sql);
                     
                    $count = mysqli_num_rows($res);

                    if($count==1){

                        //Details Available
                        $row = mysqli_fetch_assoc($res);

                        $food = $row['food'];
                        $price = $row['price'];
                        $qty = $row['qty'];
                        $status = $row['status'];
                        $customer_name = $row['customer_name'];
                        $customer_contact = $row['customer_contact'];
                        $customer_email = $row['customer_email'];
                        $customer_address = $row['customer_address'];

                    }
                    else{

                        //Not available
                        header('location:'.SITEURL.'adminpanel/manage-order.php');
                    }
                }
                else{

                    header('location:'.SITEURL.'adminpanel/manage-order.php');
                }

            ?>


            <form action="" method="POST">
                <table class="tbl-30">
                    <tr>
                        <td>Dessert name: </td>
                        <td><b><?php echo $food; ?></b></td>
                    </tr>

                    <tr>
                        <td>Price: </td>
                        <td><b>$<?php echo $price; ?></b></td>
                    <tr>

                    </tr>

                    <tr>
                        <td>Qty: </td>
                        <td>
                            <input type="number" name="qty" value="<?php echo $qty; ?>">
                        </td>
                    </tr>
                    
                    <tr>
                        <td>Status: </td>
                        <td>
                            <select name="status">
                                <option <?php if($status=="Ordered") { echo "selected"; } ?> value="Ordered">Ordered</option>
                                <option <?php if($status=="On Delivery") { echo "selected"; } ?> value="On Delivery">On delivery</option>
                                <option <?php if($status=="Delivered") { echo "selected"; } ?> value="Delivered">Delivered</option>
                                <option <?php if($status=="Cancelled") { echo "selected"; } ?> value="Cancelled">Cancelled</option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td>Customer Name: </td>
                        <td>
                            <input type="text" name="customer_name" value="<?php echo $customer_name; ?>">
                        </td>
                    </tr>
                    
                    <tr>
                        <td>Customer Contact: </td>
                        <td>
                            <input type="text" name="customer_contact" value="<?php echo $customer_contact; ?>">
                        </td>
                    </tr>
                    
                    <tr>
                        <td>Customer Email: </td>
                        <td>
                            <input type="text" name="customer_email" value="<?php echo $customer_email; ?>">
                        </td>
                    </tr>
                    
                    <tr>
                        <td>Customer Address: </td>
                        <td>
                            <input type="text" name="customer_address" value="<?php echo $customer_address; ?>">
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="hidden" name="price" value="<?php echo $price; ?>">

                            <input type="submit" name="submit" value="Update Order" class="btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>

            <?php
            
                //Check whether update button is clicked or not
                if(isset($_POST['submit'])){
                    
                    //Get all values from form
                    $id = $_POST['id'];
                    $price = $_POST['price'];
                    $qty = $_POST['qty'];
                    $total = $price * $qty;

                    $status = $_POST['status'];
                    $customer_name = $_POST['customer_name'];
                    $customer_contact = $_POST['customer_contact'];
                    $customer_email = $_POST['customer_email'];
                    $customer_address = $_POST['customer_address'];

                    $sql2 = "UPDATE order_tbl SET
                        qty = $qty,
                        total = $total,
                        status = '$status',
                        customer_name = '$customer_name',
                        customer_contact = '$customer_contact',
                        customer_email = '$customer_email',
                        customer_address = '$customer_address'
                        WHERE id=$id
                    ";
                    
                    $res2 = mysqli_query($conn, $sql2);

                    //Check whether updated or not
                    //Redirect to Manage order with Message
                    if($res==TRUE){
                        
                        //Updated
                        $_SESSION['update'] = "<div class='success text-center'>Order updated successfully.</div>";
                        header('location:'.SITEURL.'adminpanel/manage-order.php');
                    }
                    else{

                        //Failed to update
                        $_SESSION['update'] = "<div class='error text-center'>Failed to update order.</div>";
                        header('location:'.SITEURL.'adminpanel/manage-order.php');
                    }
                }
            
            ?>

        </div>
    </div>


