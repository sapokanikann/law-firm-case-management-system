<?php 

$servername = "localhost";
$usernamedb = "root";
$passworddb = "";;
$conn = new mysqli($servername, $usernamedb, $passworddb, "kanc");

$type=$_POST['type'];
// $number=$_POST['case-number'];
$name=$_POST['case-name'];
$client=$_POST['client'];
$date=$_POST['date'];
$person=$_POST['person'];
$other=$_POST['other'];

try {
    $givenyear = DateTime::createFromFormat("Y-m-d", $date);
$givenyear = $givenyear->format("Y");
} catch (\Throwable $th) {
    //throw $th;
}



$number=get_case_number($conn,$client,$givenyear);

// count spraw danego klienta +1 
// kod danego klienta


function get_case_number($conn, $client, $givenyear){
    $year = substr($givenyear, -2);
    $fullyear = substr($givenyear,-4);


    //Get CLIENT CODE IN
    $query = "SELECT * FROM `client` where id=$client ";
    $result=mysqli_query($conn, $query);
    while($row = mysqli_fetch_assoc($result)) {
        $ccode = $row['code'];
    }
    // Now check the count of the occurences of that CODE in specified year

    $query = "SELECT COUNT(*) as cnt, year(`cases`.`creation-date`) AS Y from cases where number LIKE '%/$ccode/%' and year(`cases`.`creation-date`) like '$fullyear' GROUP BY Y";
    $result=mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $count = $row['cnt']+1;
        }
    }else{
        $count=1;
    }

    if($count==0){
        $count=1;
    }
    $query = "SELECT  code from client where id=$client";
    $result=mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $code = $row['code'];
        }
    }

    return "$count/$code/$year";

}





    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
     $query="INSERT INTO `cases` ( `type`, `number`, `name`, `client_id`, `creation-date`, `person`, `description` ) VALUES ( '$type', '$number', '$name', '$client', '$date', '$person', '$other') ";
    mysqli_query($conn, $query);
      header("location:../index.php");
