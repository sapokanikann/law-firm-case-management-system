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
    <link rel="stylesheet" href="res/algolia.css" />
    <link rel="stylesheet" href="res/selectize.css">

    <script src="res/jquery.min.js"></script>
    <script src="res/selectize.min.js"></script>
    <script src="res/algoliasearchLite.min.js"></script>
    <script src="res/instantsearch.js@beta"></script>
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

    <?php
    $servername = "localhost";
    $usernamedb = "root";
    $passworddb = "";;
    $conn = new mysqli($servername, $usernamedb, $passworddb, "kanc");
    $id = $_GET['id'];
    $caseid=$id;
    $original_id=$_GET['case-id'];
    $query="SELECT * FROM actions where id like '$id'";

    $result=mysqli_query($conn, $query);            
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $task_date = $row['task-date'];
            $type = $row['type'];
            $time = $row['time'];
            $date = $row['date'];
            $case = $row['case_id'];
            $other = $row['other'];
            $desc = $row['description'];
        }
    }

?>
    <h1>Action edit</h1>
    <form action="./scripts/edit-action2.php?orid=<?php echo $id?>" id="addformaction" method="POST">
        <div class="search-menu">
            <div class="elem">
                <p><i class="fa fa-calendar" aria-hidden="true"></i>Action date:</p>

                <?php
                echo ("<input type='date' name='date1' value=$task_date>")
                ?>


            </div>
            <div class="elem">
                <p><i class="fa fa-file-o" aria-hidden="true"></i>Action type:</p>
                <select name="type" form="addformaction" id="type">
                    <?php

    $query="SELECT * FROM `actiontypes`";
    $result=mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            if ($type == $row['name']) {
                echo("<option selected value =". $row['name']. ">". $row['name']. "</option>"   );
            }else{
                echo("<option value =". $row['name']. ">". $row['name']. "</option>"   );
            }

        }
    }

    $subtime = substr($time,0,5);
    ?>
                </select>
            </div>
            <script>
                var select_state, $select_state;
                $select_state = $('#type').selectize({
                    onChange: function(value) {
                        if (!value.length) return;
                    }
                });
                select_state = $select_state[0].selectize;

            </script>
            <div class="elem">
                <p><i class="fa fa-clock-o" aria-hidden="true"></i>Time:</p>
                <?php
                echo ("<input type='time' name='time' value=$subtime>")
                ?>

            </div>
            <input type="hidden" name="case-id" value="<?php echo $original_id ?>">
            <div class="elem">
                <p><i class="fa fa-calendar" aria-hidden="true"></i>Task deadline:</p>
                <?php
                echo ("<input type='date' name='date2' value=$date>")
                ?>

            </div>

        </div>
    </form>
    <div class="elem">
        <p><i class="fa fa-ellipsis-h" aria-hidden="true"></i>Description:</p>
        <?php
                echo ("<textarea name='desc' id='' cols='30' rows='10' form='addformaction'>$desc</textarea>")
                ?>

    </div>
    <div class="elem">
        <p><i class="fa fa-ellipsis-h" aria-hidden="true"></i>Notes:</p>
        <?php
                echo ("<textarea name='other' id='' cols='30' rows='10' form='addformaction'>$other</textarea>");
                ?>
    </div>
    <div class="float-buttons">
        <button type="submit" form="addformaction"><i class="fa fa-pencil" aria-hidden="true"></i>Change</button>
    </div>
