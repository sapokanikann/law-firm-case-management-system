<?php 

$servername = "localhost";
$usernamedb = "root";
$passworddb = "";;
$conn = new mysqli($servername, $usernamedb, $passworddb, "kanc");


$id = $_GET['id'];
$date = date("Y-m-d");


    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
     $query="UPDATE `cases` SET `closed` = '1', `closure_date` = '$date'  WHERE `cases`.`id` = '$id' ";
    //   echo $query;
    mysqli_query($conn, $query);
     header("location:../index.php");
