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
$person_id = $_SESSION['id'];


    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    if (empty($_POST['date2'])) {
        $query="INSERT INTO `actions` ( `task-date`, `type`, `time`, `date`, `description`, `other`, `case_id`, `person_id` ) VALUES ( '$task_date', '$type', '$time', NULL, '$description', '$other', '$case_id', '$person_id') ";
        mysqli_query($conn, $query);
    }else{

        $query="INSERT INTO `actions` ( `task-date`, `type`, `time`, `date`, `description`, `other`, `case_id`, `person_id` ) VALUES ( '$task_date', '$type', '$time', '$date', '$description', '$other', '$case_id', '$person_id') ";
        mysqli_query($conn, $query);
    }



    $query = "SELECT id from actions order by add_date desc limit 1";

    $result=mysqli_query($conn, $query);   
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $originalid = $row['id'];
        }
    }
    if (empty($_POST['date2'])) {

        $query="INSERT INTO `actionhistory` ( `original_id`, `task-date`, `type`, `time`, `date`, `description`, `other`, `case_id`, `person_id` ) VALUES ( '$originalid', '$task_date', '$type', '$time', NULL, '$description', '$other', '$case_id', '$person_id') ";
    }else{
        $query="INSERT INTO `actionhistory` ( `original_id`, `task-date`, `type`, `time`, `date`, `description`, `other`, `case_id`, `person_id` ) VALUES ( '$originalid', '$task_date', '$type', '$time', '$date', '$description', '$other', '$case_id', '$person_id') ";
    }
    mysqli_query($conn, $query);




    header("location:../case.php?id=$case_id");
