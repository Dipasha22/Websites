<?php
    session_start();
    $servername = "localhost";
    $username = "root";
    $password = "";
    $port = 3307;
    $dbname = "canteen_db";
    $con = new mysqli($servername, $username, $password,$dbname,$port);
    if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
    }
    // $con = mysqli_connect('localhost','root');
    // if($con){
       
    // }else{
    //     echo "connection failed";
    // }
    // mysqli_select_db($con,'canteen_db');
    
    $email ="";
    $password = "";
    $confirm = "";


    if(isset($_POST['submit'])){
        $Name = $_POST['name'];
        $Email = $_POST['email'];
        $Date = $_POST['date'];
        $Time = $_POST['time'];
        $TableNo = $_POST['TableNo'];
    
        $q1 = " select * from tables where Id = '$TableNo' ";
        $q2 = "INSERT INTO `tables`(`Name`, `Email`, `Date`, `Time`,`Id`) VALUES ('$Name','$Email','$Date','$Time','$TableNo');";
        $result = mysqli_query($con,$q1);
        $num = mysqli_num_rows($result);
        if($num == 1){
            echo '<script>alert("Sorry:( Table is already reserved!!!")</script>';
        }else{
            $result = mysqli_query($con,$q2);
            echo '<script>
            alert("Thank you your Table is reserved Now!!!");
            window.location.href="reservation.php";
            </script>';
        }
        
    }
    else{
        echo 'not working ';
    }
?>