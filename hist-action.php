<?php
session_start();
if(!isset($_SESSION['username'])){
    header("Location:login.php");
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Case edit</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="stylesheet" href="./css/font-awesome-4.7.0/css/font-awesome.min.css">
    <script src="./scripts/window.js"></script>
</head>

<body>
    <div class=login-home>

        <div class="home-button">
            <p> <a href="index.php"><i class="fa fa-home" aria-hidden="true"></i> Homepage
                </a></p>
        </div>
        <div class="login-info">
            <p>Logged in: <?php echo ($_SESSION['name']. " ". $_SESSION['surname'] )  ?> <a href="./scripts/sign-out.php"> <i class="fa fa-sign-out fa-1x" aria-hidden="true"></i></a></p>

        </div>
    </div>

    <div class='case-table2'>
        <span class="header">Date of action</span>
        <span class="header">Time of entering/editing</span>
        <span class="header">Person entering</span>
        <span class="header">Type of action</span>
        <span class="header">Description</span>
        <span class="header">Time</span>
        <span class="header">Notes</span>
        <span class="header">Deadline</span>

        <?php
        $servername = "localhost";
    $usernamedb = "root";
    $passworddb = "";;
         $conn = new mysqli($servername, $usernamedb, $passworddb, "kanc");
    $originalid = $_GET['id'];

    $query="SELECT * FROM `actionhistory` WHERE original_id = $originalid order by  add_date desc";
    $result=mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            echo("<span>". $row['task-date']. "</span>");
            echo("<span>". $row['add_date']. "</span>");
            echo("<span>". "person". "</span>");
            echo("<span>". $row['type']. "</span>"); 
            echo("<span>". $row['description']. "</span>"); 
            echo("<span>". substr($row['time'],0,5). "</span>"); 
            echo("<span>". $row['other']. "</span>");
            echo("<span>". $row['date']. "</span>");
        

        }
    }


    ?>
