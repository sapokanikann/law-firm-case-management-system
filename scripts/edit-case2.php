<?php

$servername = "localhost";
$usernamedb = "root";
$passworddb = "";;
$conn = new mysqli($servername, $usernamedb, $passworddb, "kanc");

$type=$_POST['type'];
$number=$_POST['case-number'];
$name=$_POST['case-name'];
$client=$_POST['client'];
$person=$_POST['person'];
$other=$_POST['other'];
$creation_date = $_POST['creation_date'];
$closure_date = $_POST['closure_date'];
if (isset($_POST['closed']) ) {
    $closed = 1;
}else{
    $closed = 0;
}
$id = $_GET['id'];
if (empty($closure_date)) {
    $closure_date='null';
    $query = "UPDATE `cases` SET  `type` = '$type', `number` = '$number', `name` = '$name', `client_id` = '$client', `creation-date` = '$creation_date', `person` = '$person', `description` = '$other', `closure_date` = $closure_date, `closed` = $closed WHERE `cases`.`id` = $id ";
    mysqli_query($conn, $query); 
    header('Location:../index.php');
} else





$query = "UPDATE `cases` SET  `type` = '$type', `number` = '$number', `name` = '$name', `client_id` = '$client', `creation-date` = '$creation_date', `person` = '$person', `description` = '$other', `closure_date` = '$closure_date', `closed` = $closed WHERE `cases`.`id` = $id ";
mysqli_query($conn, $query); 
header('Location:../index.php');

?>
