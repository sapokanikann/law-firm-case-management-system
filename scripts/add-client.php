<?php 

$servername = "localhost";
$usernamedb = "root";
$passworddb = "";;
$conn = new mysqli($servername, $usernamedb, $passworddb, "kanc");


$name=$_POST['name'];
$surname=$_POST['surname'];
$street=$_POST['street'];
$housenumber=$_POST['house-number'];
$apartmentnumber=$_POST['apartment-number'];
$postalcode=$_POST['postal-code'];
$city=$_POST['city'];
$NIP=$_POST['NIP'];
$phone=$_POST['phone'];
$mail=$_POST['mail'];
$contactperson=$_POST['contact-person'];
$code=$_POST['code'];
$other=$_POST['other'];

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
     $query = "INSERT INTO `client` ( `name`, `surname`, `street`, `house`, `apartment`, `postal`, `city`, `NIP`, `telephone`, `mail`, `contact-person`, `code`, `other`) VALUES ( '$name', '$surname', '$street', '$housenumber', '$apartmentnumber', '$postalcode', '$city', '$NIP', '$phone', '$mail', '$contactperson', '$code', '$other') ";
     //echo $query;
    mysqli_query($conn, $query);
    header("location:../index.php");
