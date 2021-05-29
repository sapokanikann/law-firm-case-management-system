<?php 
session_start();
if(!isset($_SESSION['username'])){
    header("Location:login.php");
}
$servername = "localhost";
$usernamedb = "root";
$passworddb = "";;
$conn = new mysqli($servername, $usernamedb, $passworddb, "kanc");

$task_date=$_POST['date1'];
$type=$_POST['type'];
$time=$_POST['time'];
// $time = "00:".$time;
$date=$_POST['date2'];
if (empty($_POST['date2']) ) {
    $date = "NULL";
}
$description=$_POST['desc'];
$other=$_POST['other'];
$case_id=$_POST['case-id'];
$originalid=$_GET['orid'];
if (isset($_POST['closed'])) {
    $done = 1;
}else{
    $done = 0;
}

if (empty($_POST['date2']) ) {
    $query="INSERT INTO `actionhistory` ( `original_id`, `task-date`, `type`, `time`, `date`, `description`, `other`, `case_id`, `person_id` ) VALUES ( '$originalid', '$task_date', '$type', '$time', NULL, '$description', '$other', '$case_id', $_SESSION[id] ) ";
}else{
    $query="INSERT INTO `actionhistory` ( `original_id`, `task-date`, `type`, `time`, `date`, `description`, `other`, `case_id`, `person_id` ) VALUES ( '$originalid', '$task_date', '$type', '$time', '$date', '$description', '$other', '$case_id', $_SESSION[id] ) ";
}
mysqli_query($conn, $query);
    //  echo $query;
    if (empty($_POST['date2']) ) {
        $query="UPDATE `actions` SET  `task-date` = '$task_date', `type` = '$type', `time` = '$time', `date` = NULL, `description` ='$description', `other` ='$other', `done` = $done WHERE `actions`.`id` = '$_GET[orid]' ";
    }else{
        $query="UPDATE `actions` SET  `task-date` = '$task_date', `type` = '$type', `time` = '$time', `date` = '$date', `description` ='$description', `other` ='$other', `done` = $done WHERE `actions`.`id` = '$_GET[orid]' ";
    }
    mysqli_query($conn, $query);


     header("location:../case.php?id=$case_id");
