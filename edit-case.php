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
$query="SELECT * FROM cases where id like '$id'";
$result=mysqli_query($conn, $query);            
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        $type = $row['type'];
        $name = $row['name'];
        $client_id = $row['client_id'];
        $creation_date = $row['creation-date'];
        $person = $row['person'];
        $desc = $row['description'];
        $closure_date = $row['closure_date'];
        $closed = $row['closed'];
    }
}


?>
    <h1>Case edit</h1>
    <form action="./scripts/edit-case2.php?id=<?php echo ($id) ?>" id="addformcase" method="POST">
        <div class="search-menu">
            <div class="elem">
                <p><i class="fa fa-search" aria-hidden="true"></i>Case type:</p>
                <select name="type" form="addformcase" id="type">
                    <?php
                    $query="SELECT * FROM casetypes";
                    $result=mysqli_query($conn, $query);
                
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            if ($row['id'] == $type) {
                                echo("<option value= $row[id] selected> ". "$row[id]" .". " . $row['typename']. "</option>");
                            }else{
                                echo("<option value= $row[id]>". $row[id] .". " . $row['typename']. "</option>");

                            }
                        }
                    }
                

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
                <p><i class="fa fa-hashtag" aria-hidden="true"></i>Case no.:</p>
                <?php
                    $query="SELECT `number` FROM cases where id like '$id'";
                    $result=mysqli_query($conn, $query);            
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            echo("  <input type='text' name='case-number' value= ".  $row['number']."  >      ");
                        }
                    }
                ?>

            </div>
            <div class="elem">
                <p><i class="fa fa-file-text" aria-hidden="true"></i>Case name:</p>
                <?php
                echo ("<input type='text' name='case-name' value='$name'  id='case-name'>")

                ?>
            </div>

            <div class="elem">
                <p><i class="fa fa-calendar" aria-hidden="true"></i>Creation date:</p>
                <?php
                echo ("<input type='date' name='creation_date' value=$creation_date>")

                ?>

            </div>

            <div class="elem">
                <p><i class="fa fa-user" aria-hidden="true"></i>Person in charge:</p>
                <select name="person" form="addformcase" id="person">
                    <?php
                    $query="SELECT * FROM users";
                    $result=mysqli_query($conn, $query);
                
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            if ($row['id'] == $person) {
                                echo("<option value= $row[id] selected>". $row[id] .". " . $row['name']."  ". $row['surname']. "</option>");
                            }else{
                                echo("<option value= $row[id]>". $row[id] .". " . $row['name']."  ". $row['surname']. "</option>");
                            }
                        }
                    }
                
                    ?>
                </select>
            </div>
            <script>
                var select_state, $select_state;
                $select_state = $('#person').selectize({
                    onChange: function(value) {
                        if (!value.length) return;
                    }
                });
                select_state = $select_state[0].selectize;

            </script>
            <div class="elem">
                <p><i class="fa fa-male" aria-hidden="true"></i>Client:</p>
                <select name="client" form="addformcase" id="klient">
                    <?php
                    $query="SELECT * FROM client";
                    $result=mysqli_query($conn, $query);
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            if ($client_id==$row['id']) {
                                echo("<option value= $row[id] selected> ". $row[id] .". " . $row['name']."  ". $row['surname']. "</option>");
                            }else{
                                echo("<option value= $row[id]>". $row[id] .". " . $row['name']."  ". $row['surname']. "</option>");
                            }
                        }
                    }
                

                    ?>

                </select>
            </div>
            <script>
                var select_state, $select_state;
                $select_state = $('#klient').selectize({
                    onChange: function(value) {
                        if (!value.length) return;
                    }
                });
                select_state = $select_state[0].selectize;

            </script>
            <div class="elem">
                <p><i class="fa fa-calendar" aria-hidden="true"></i>Closing date:</p>
                <?php
                echo ("<input type='date' name='closure_date' value=$closure_date>")

                ?>

            </div>
            <div class="elem">
                <p><i class="fa fa-lock" aria-hidden="true"></i>Closed:</p>
                <?php
                if ($closed == 1) {
                    echo ("<input type='checkbox' name='closed' value=$closed checked > ");
                }else{
                    echo ("<input type='checkbox' name='closed' value=$closed  >");
                }

                ?>

            </div>
        </div>
    </form>
    <div class="elem">
        <p><i class="fa fa-ellipsis-h" aria-hidden="true"></i>Description:</p>
        <?php
                echo ("<textarea name='other' cols='30' rows='10' form='addformcase'> $desc</textarea>")

                ?>

    </div>
    <div class="float-buttons">
        <button type="submit" form="addformcase"><i class="fa fa-pencil" aria-hidden="true"></i>
            Change</button>

    </div>





    <?php

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
     $query="SELECT * FROM cases where `id` like '$id' ";
    mysqli_query($conn, $query);
