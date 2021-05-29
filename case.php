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
    <div class="case-info">

        <div>
            <?php
    $servername = "localhost";
    $usernamedb = "root";
    $passworddb = "";
    $conn = new mysqli($servername, $usernamedb, $passworddb, "kanc");
    $caseid=$_GET['id'];
    $query="SELECT * FROM `cases` WHERE id = $caseid ";
    $result=mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $caseno = $row['number'];
            $casename = $row['name'];
            $casedesc = $row['description'];

        }
    }

    ?>
            <p><i class="fa fa-hashtag" aria-hidden="true"></i>Case no. <?php echo $caseno ?></p>
            <p><i class="fa fa-search" aria-hidden="true"></i><?php echo $casename ?></p>
        </div>

        <div>
            <p><i class="fa fa-comment" aria-hidden="true"></i><?php echo $casedesc ?>
            <p>
        </div>
    </div>

    <div class="case-buttons">
        <button class="add-button" onclick="showWindow('floating-action')"><i class="fa fa-plus-circle" aria-hidden="true"></i>Add action</button>
        <button class="add-button"><i class="fa fa-file-text-o" aria-hidden="true"></i> <a href="./scripts/report-case.php?id=<?php echo $caseid ?>"> Generate report</button></a>
    </div>

    <div class='case-table'>
        <span class="header">Date of action</span>
        <span class="header">Time of entering/editing</span>
        <span class="header">Person entering</span>
        <span class="header">Type of action</span>
        <span class="header">Description</span>
        <span class="header">Time</span>
        <span class="header">Notes</span>
        <span class="header">Deadline</span>
        <span class="header"></span>
        <?php

    // var_dump($_GET);
    $query="SELECT actions.*, users.name as uname, users.surname as usur FROM `actions` join users on users.id = actions.person_id WHERE case_id = $caseid  ORDER BY `actions`.`add_date` DESC ";
    // echo $query;
    $result=mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            echo("<span>". $row['task-date']. "</span>");
            echo("<span>". $row['add_date']. "</span>");
            echo("<span>". $row['uname']." ".$row['usur']. "</span>");
            echo("<span>". $row['type']. "</span>"); 
            echo("<span>". $row['description']. "</span>"); 
            echo("<span>". substr($row['time'],0,5). "</span>"); 
            echo("<span>". $row['other']. "</span>");
            echo("<span>". $row['date']. "</span>");
        
            echo("<span>" . " <a href=edit-action.php?id=$row[id]&case-id=$caseid> Edit  </a> <br>");
            echo( " <a href=hist-action.php?id=$row[id]> Edit history  </a>" . "</span>");
        }
    }


    ?>

    </div>
    <!-- ADD CASE WINDOW -->
    <div class="floating-case" id='floating-action'>
        <h1>New action</h1>
        <form action="./scripts/add-action.php" id="addformaction" method="POST">
            <div class="search-menu">
                <div class="elem">
                    <p><i class="fa fa-calendar" aria-hidden="true"></i>Date of action:</p>
                    <input type="date" name="date1" required>
                </div>
                <div class="elem">
                    <p><i class="fa fa-file-o" aria-hidden="true"></i>Type of action:</p>
                    <select name="type" form="addformaction" id="type" required>
                        <?php
    
    // var_dump($_GET);
    $query="SELECT * FROM `actiontypes`";
    // echo $query;
    $result=mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            echo("<option value =". $row['name']. ">". $row['name']. "</option>"   );

        }
    }


    ?>

                    </select>
                </div>
                <script>
                    document.getElementById('type').value = '';
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
                    <input type="time" name="time" required>
                </div>
                <input type="hidden" name="case-id" required value="<?php echo $caseid ?>">
                <div class="elem">
                    <p><i class="fa fa-calendar" aria-hidden="true"></i>Deadline:</p>
                    <input type="date" name="date2">
                </div>
            </div>
        </form>
        <div class="elem">
            <p><i class="fa fa-ellipsis-h" aria-hidden="true"></i>Description:</p>
            <textarea name="desc" id="" cols="30" rows="10" form="addformaction" required></textarea>
        </div>
        <div class="elem">
            <p><i class="fa fa-ellipsis-h" aria-hidden="true"></i>Notes:</p>
            <textarea name="other" id="" cols="30" rows="10" form="addformaction" required></textarea>
        </div>
        <div class="float-buttons">
            <button type="submit" form="addformaction"><i class="fa fa-plus" aria-hidden="true"></i>Add</button>
            <button onclick="hideWindow('floating-action')"><i class="fa fa-times" aria-hidden="true"></i>Cancel</button>
        </div>


    </div>

</body>

</html>
