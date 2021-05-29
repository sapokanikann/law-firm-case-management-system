<?php
$servername = "localhost";
$usernamedb = "root";
$passworddb = "";;
$conn = new mysqli($servername, $usernamedb, $passworddb, "kanc");

$query = "SELECT * FROM registration";
    $result=mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
        $reg_enabled= $row['enabled'];
        }
    }
    if ($reg_enabled==1) {
        $rev = 0;
    }
    else{
        $rev=1;
    }

    $query="UPDATE `registration` SET `enabled` = '$rev' WHERE `registration`.`id` = 1 ";
   mysqli_query($conn, $query);
    header("Location:../index.php");
