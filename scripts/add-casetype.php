<?php 

$servername = "localhost";
$usernamedb = "root";
$passworddb = "";;
$conn = new mysqli($servername, $usernamedb, $passworddb, "kanc");


$name = $_POST['name'];



    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
     $query="INSERT INTO `casetypes` ( `typename` ) VALUES ( '$name' ) ";

    mysqli_query($conn, $query);
    header("location:../index.php");
