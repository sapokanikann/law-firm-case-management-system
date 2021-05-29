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

$id = $_GET['id'];



$query = "UPDATE `client` SET `name` = '$name', `surname` = '$surname', `street` = '$street', `house` = '$housenumber', `apartment` = '$apartmentnumber', `postal` = '$postalcode', `city` = '$city', `NIP` = '$NIP', `telephone` = '$phone', `mail` = '$mail', `contact-person` = '$contactperson', `code` = '$code', `other` = '$other' WHERE `client`.`id` = $id ";
mysqli_query($conn, $query); 
header("Location:../client.php?id=".$id);

?>
