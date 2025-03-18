<?php
    // $con = mysqli_connect('localhost','root');
    // if($con){
        
    // }else{
    //     echo "connection failed";
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

    $id = $_POST['delete'];
    $q = "DELETE FROM `tables` WHERE Id= $id";
    mysqli_query($con,$q);
    header("location: tables.php");
?>