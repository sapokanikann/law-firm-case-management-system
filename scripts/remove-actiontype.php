<?php 

$servername = "localhost";
$usernamedb = "root";
$passworddb = "";;
$conn = new mysqli($servername, $usernamedb, $passworddb, "kanc");
$id = $_POST['id'];



    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
     $query="DELETE FROM `actiontypes` WHERE `actiontypes`.`id` = $id";
    mysqli_query($conn, $query);
    header("location:../index.php");

