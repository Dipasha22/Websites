<?php
    session_start();
    // $con = mysqli_connect('localhost','root');
    // if(mysqli_connect_error()){
    //     header("location: Add_to_cart.php");
    //     echo '<script>alert("cant connect to database)</script>';
    // }
    // mysqli_select_db($con,'canteen_db');
    $servername = "localhost";
    $username = "root";
    $password = "";
    $port = 3307;
    $dbname = "canteen_db";
    $con = new mysqli($servername, $username, $password,$dbname,$port);
    if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
    }
    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        if(isset($_POST['purchase'])){
            $q= "INSERT INTO `order_manager`(`Full_name`, `Phone_No`, `Address`, `Pay_Mode`) VALUES ('$_POST[fullName]','$_POST[phoneNo]','$_POST[address]','$_POST[paymode]')";
            $result = mysqli_query($con,$q);
            if($result){
                $Order_Id = mysqli_insert_id($con);
                $q2 = "INSERT INTO `user_orders`(`Order_id`, `Item_Name`, `Price`, `Quantity`) VALUES (?,?,?,?)";
                $stmt = mysqli_prepare($con,$q2);
                if($stmt){
                    mysqli_stmt_bind_param($stmt,"isii",$Order_Id,$Item_Name,$Price,$Quantity);
                    foreach ($_SESSION['cart'] as $key => $value) {
                        $Item_Name = $value['Item_Name'];
                        $Price = $value['price'];
                        $Quantity = $value['Quantity'];
                        mysqli_stmt_execute($stmt);
                    }
                    unset($_SESSION['cart']);
                    echo "<script>
                    alert('Order Placed!!');
                    window.location.href='Index_login.php';
                    </script>";
                }
                else{
                    echo "<script>
                    alert('sql query preparation error');
                    window.location.href='Add_to_cart.php';
                    </script>";
                    
                }
            }
            else
            {
                echo '<script>alert("cant connect to database")</script>';
                header("location: Add_to_cart.php");
            }
        }
    }
    
?>
