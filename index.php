<?php
session_start();
if(!isset($_SESSION['username'])){
    header("Location:login.php");
}


?>
<!DOCTYPE html>
<html>

<head>
    <title>Homepage</title>
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

    <?php
    $servername = "localhost";
    $usernamedb = "root";
    $passworddb = "";;
    $conn = new mysqli($servername, $usernamedb, $passworddb, "kanc");
    ?>

</head>

<body>

    <div class="containermain">
        <img src="css/case-logo.png" alt="PROSECURIST logo">
    </div>

    <div class=login-home>

        <?php

    $query = "SELECT * FROM registration";
    $result=mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
        $reg_enabled= $row['enabled'];
        }
    };

    if ($reg_enabled) {
        ?>
        <div class="home-button">
            <p> <a href="./scripts/change_reg.php"><i class="fa fa-key" aria-hidden="true"></i>
                    Disable registration
                </a></p>
        </div>
        <?php
    }
    else{
        ?>
        <div class="home-button">
            <p> <a href="./scripts/change_reg.php"><i class="fa fa-key" aria-hidden="true"></i>
                    Enable registration
                </a></p>
        </div>
        <?php
    }

        ?>
        <div class="login-info">
            <p>Logged in: <?php echo ($_SESSION['name']. " ". $_SESSION['surname'] )  ?> <a href="./scripts/sign-out.php"> <i class="fa fa-sign-out fa-1x" aria-hidden="true"></i></a></p>
        </div>
    </div>

    <form action="./index.php" method="get" id='mainform' autocomplete="off">
        <div class="search-menu">

            <div class="elem">
                <p><i class="fa fa-hashtag" aria-hidden="true"></i>Case name:</p>
                <select name="case-name" form="mainform" id="select-case-name">
                    <?php
                    $query="SELECT * FROM cases";
    $result=mysqli_query($conn, $query);
echo("<option value= >"."All". "</option>");
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            echo("<option value= $row[id]>". $row['id'] .". " . $row['name']."</option>");
        }
    }
                    ?>
                </select>
            </div>
            <script>
                var select_state, $select_state;
                $select_state = $('#select-case-name').selectize({

                    onChange: function(value) {
                        if (!value.length) return;
                    }
                });
                select_state = $select_state[0].selectize;

            </script>
            <div class="elem">
                <p><i class="fa fa-hashtag" aria-hidden="true"></i>Case no.:</p>
                <select name="case-number" form="mainform" id="select-case-number">
                    <?php
                    $query="SELECT * FROM cases";
    $result=mysqli_query($conn, $query);
echo("<option value= >"."All". "</option>");
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            echo("<option value= $row[number]>". $row['id'] .". " . $row['number']."</option>");
        }
    }
                    ?>
                </select>
            </div>

            <script>
                var select_state, $select_state;
                $select_state = $('#select-case-number').selectize({
                    onChange: function(value) {
                        if (!value.length) return;
                    }
                });
                select_state = $select_state[0].selectize;

            </script>

            <div class="elem">
                <p><i class="fa fa-male" aria-hidden="true"></i>Client:</p>
                <select name="client" form="mainform" id="select-client">
                    <?php
                    $query="SELECT * FROM client";
    $result=mysqli_query($conn, $query);
echo("<option value= >"."All". "</option>");
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            echo("<option value= $row[id]>". $row['id'] .". " . $row['name']."  ". $row['surname']. "</option>");
        }
    }
                    ?>
                </select>
            </div>
            <script>
                var select_state, $select_state;
                $select_state = $('#select-client').selectize({
                    onChange: function(value) {
                        if (!value.length) return;
                    }
                });
                select_state = $select_state[0].selectize;

            </script>
            <div class="elem">

                <p><i class="fa fa-user" aria-hidden="true"></i>Person in charge:</p>
                <select name="person" form="mainform" id="select-person">
                    <?php
                   $query="SELECT * FROM users";
                   $result=mysqli_query($conn, $query);
                    echo("<option value=>"."Any". "</option>");
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            echo("<option value= $row[id]>". $row['id'] .". " . $row['name']."  ". $row['surname']. "</option>");
                        }
                    }
                

                    ?>
                </select>
            </div>
            <script>
                var select_state, $select_state;
                $select_state = $('#select-person').selectize({
                    onChange: function(value) {
                        if (!value.length) return;
                    }
                });
                select_state = $select_state[0].selectize;

            </script>
            <div class="elem">
                <p><i class="fa fa-tag" aria-hidden="true"></i>Case type:</p>
                <select name="case-type" form="mainform" id="select-case-type">
                    <?php
                    $query="SELECT * FROM casetypes";
                    $result=mysqli_query($conn, $query);
                    echo("<option value= >"."Any". "</option>");
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            echo("<option value= $row[id]>". $row['id'] .". " . $row['typename']. "</option>");
                        }
                    }
                    ?>
                </select>
            </div>
            <script>
                var select_state, $select_state;
                $select_state = $('#select-case-type').selectize({
                    onChange: function(value) {
                        if (!value.length) return;
                    }
                });
                select_state = $select_state[0].selectize;

            </script>
            <div class="elem">
                <p><i class="fa fa-ellipsis-h" aria-hidden="true"></i>Other:</p>
                <input type="text" name="other">
            </div>
        </div>
        <div class="closed-check">
            <input type="checkbox" name="search-closed">
            <p><i class="fa fa-lock" aria-hidden="true"></i>Search in closed</p>
        </div>
        <div class="closed-check2">
            <p><i class="fa fa-sort" aria-hidden="true"></i>Sort by:</p>
            <select name="order" form=mainform>
                <option value="creation-date-desc">Creation date from newest</option>
                <option value="creation-date-asc">Creation date from oldest</option>
                <option value="task-date-asc">Date of next action from closest</option>
                <option value="task-date-desc">Date of next action from farthest</option>
                <option value="close-date-asc">Closing date from newest</option>
                <option value="close-date-desc">Closing date from oldest</option>


            </select>
        </div>
        <div class="closed-check">
            <button type="submit"><i class="fa fa-search" aria-hidden="true"></i>Search</button>
        </div>
    </form>
    <button class="add-button" onclick="showWindow('floating-case')"><i class="fa fa-calendar-plus-o" aria-hidden="true"></i>Create case</button>
    <button class="add-button" onclick="showWindow('floating-client')"><i class="fa fa-user-plus" aria-hidden="true"></i>Add client</button>
    <div class="add-button-container">
        <button class="add-button2" onclick="showWindow('floating-casetype')"><i class="fa fa-plus" aria-hidden="true"></i>Add case type</button>
        <button class="add-button2" onclick="showWindow('floating-casetype-remove')"><i class="fa fa-minus" aria-hidden="true"></i>Delete case type</button>
    </div>
    <div class="add-button-container">

        <button class="add-button2" onclick="showWindow('floating-actiontype')"><i class="fa fa-plus" aria-hidden="true"></i>Add action type</button>
        <button class="add-button2" onclick="showWindow('floating-actiontype-remove')"><i class="fa fa-minus" aria-hidden="true"></i>Delete action type</button>
    </div>


    <div class='client-table'>
        <span class="header">Case no.</span>
        <span class="header">Case name</span>
        <span class="header">Case type</span>
        <span class="header">Client</span>
        <span class="header">Creation date</span>
        <span class="header">Closing date</span>
        <span class="header">Person in charge</span>
        <span class="header">Date of last action</span>
        <span class="header">Date of next action</span>
        <span class="header"></span>

        <?php
     if(empty($_GET)){
         
         $query="SELECT cases.*,cases.name as cname ,cases.id as caseid, client.*, users.name as uuname, users.surname as uusurname, casetypes.*  FROM `cases`  JOIN client ON client.id = cases.client_id join casetypes on cases.type = casetypes.id join users on person=users.id where closed like '0' ORDER BY `cases`.`creation-date` desc";
    $result=mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            echo("<span>". $row['number']. "</span>");
            echo("<span>". $row['cname']. "</span>");
            echo("<span>". $row['typename']. "</span>");
            echo("<span> <a href=client.php?id=$row[client_id] >". $row['name']." ".$row['surname']. " </a> </span>"); 
            echo("<span>". $row['creation-date']. "</span>"); 
            if (!empty($row['closure_date'])) {
                echo("<span>". $row['closure_date']. "</span>"); 
            }else{
                echo("<span>". "---". "</span>"); 
            }
            echo("<span>". $row['uuname']." ". $row['uusurname'] ."</span>");

         $query2="SELECT actions.*, actions.`task-date` as tdate FROM `actions` where case_id=$row[caseid]   order by tdate desc limit 1";
         $result2=mysqli_query($conn, $query2);
             if (mysqli_num_rows($result2) > 0) {
                while($row2 = mysqli_fetch_assoc($result2)) {
                    echo("<span>".$row2['tdate'] . "</span>");
                }
            }else{
                echo("<span>" . "</span>");
            }
           
         $query2="SELECT actions.*, actions.`date` as tdate, DATEDIFF(CURRENT_DATE,actions.`date`) as diff FROM `actions` where case_id=$row[caseid]   and  done=0 order by diff desc limit 1";
         $result2=mysqli_query($conn, $query2);
             if (mysqli_num_rows($result) > 0) {
                while($row2 = mysqli_fetch_assoc($result)) {
                    $current_date = date("Y-m-d");
                    $current_date = date_create();
                    $tdate = date_create($row2['tdate']);
                    $diff = date_diff($current_date, $tdate);
                    $year = $current_date->format('Y');
                    $month = $current_date->format('m');
                    $day = $current_date->format('d');
                    $current_date= date_create($year."-".$month."-".$day);
                    
                    if ($tdate >= $current_date) {
                        $is_in_future=1;
                    }else{
                        $is_in_future=0;
                    }
                    if (  ($diff->format('%d')<4 or $is_in_future==0) and $row2['done']==0  ) {
                        echo("<span style='color: red;'>".$row2['tdate']. "</span>");
                    }elseif($is_in_future==0 and $row2['done']==0){
                        echo("<span style='color: red;'>".$row2['tdate']. "</span>");
                    }
                    else{
                        echo("<span>".$row2['tdate']. "</span>");
                    }
                }
            }else{
                echo("<span>" . "</span>");
            }
            
            echo("<span class='options'>" . "<i class='fa fa-search' aria-hidden='true'></i> <a href=case.php?id=". $row['caseid'] .">
            Preview  </a> <br>"  );
            echo(  "<i class='fa fa-pencil' aria-hidden='true'></i> <a href=./edit-case.php?id=". $row['caseid'] ."> Edit  </a>" . "<br>");
            echo(  "<i class='fa fa-lock' aria-hidden='true'></i> <a href=./scripts/close-case.php?id=". $row['caseid'] ."> Close  </a>" . "</span>");
        }
    }

    }else{
        $name = "%";
        $number = "%";
        $client = "%";
        $person = "%";
        $type = "%";
        $other ="%";
        $searchClosed=0;


        $order_by = $_GET['order'];

        if ($_GET['order'] == "creation-date-desc") {
            $order_by = "`cases`.`creation-date` desc" ;
        }
        if ($_GET['order'] == "creation-date-asc") {

            $order_by = "`cases`.`creation-date` asc";
        }
        if ($_GET['order'] == "task-date-asc") {

            $order_by = "`actions`.`task-date` desc";
        }
        if ($_GET['order'] == "task-date-desc") {

            $order_by = "`actions`.`task-date` asc";
        }
        if ($_GET['order'] == "close-date-asc") {

            $order_by = "`cases`.`closure_date` asc";
        }
        if ($_GET['order'] == "close-date-desc") {

            $order_by = "`cases`.`closure_date` desc";
        }

        if(!empty($_GET['case-name'])){
            $name = $_GET['case-name'];
        }
        if(!empty($_GET['case-number'])){
            $number = $_GET['case-number'];
        }
        if(!empty($_GET['client'])){
            $client = $_GET['client'];
        }
        if(!empty($_GET['person'])){
            $person = $_GET['person'];
        }
        if(!empty($_GET['case-type'])){
            $type = $_GET['case-type'];
        }
        if(!empty($_GET['other'])){
            $other = $_GET['other'];
        }
        if(isset($_GET['search-closed'])){
            $searchClosed=1;
        }

        //new query if the request is for task-date

        if ($order_by == "`actions`.`task-date` desc" or $order_by=="`actions`.`task-date` asc") {
            $query="SELECT cases.*, client.*, cases.id as caseid, users.name as uuname, users.surname as uusurname, `actions`.`task-date`,`actions`.`date` , cases.name as cname, casetypes.*,`actions`.`done` as done  FROM `cases`  JOIN client ON client.id = cases.client_id join casetypes on cases.type = casetypes.id join actions on cases.id = actions.case_id join users on person=users.id  WHERE cases.number like '%$number%' AND cases.id like '%$name%' and cases.client_id like '$client' and cases.person like '$person' and cases.type like '$type' and cases.description like '%$other%' and closed like '$searchClosed' and done like '0' and date is not null GROUP by(cases.id) ORDER BY $order_by";

        }
        elseif($order_by == "`cases`.`closure_date` desc" or $order_by == "`cases`.`closure_date` asc"){
            $query="SELECT cases.*, client.*, cases.id as caseid, users.name as uuname, users.surname as uusurname, cases.name as cname, casetypes.*  FROM `cases`  JOIN client ON client.id = cases.client_id join casetypes on cases.type = casetypes.id join users on person=users.id  WHERE cases.number like '%$number%' AND cases.id like '%$name%' and cases.client_id like '$client' and cases.person like '$person' and cases.type like '$type' and cases.description like '%$other%' and closed like '$searchClosed'   ORDER BY $order_by";
            // echo $query
        }
        else{
            $query="SELECT cases.*, client.*, cases.id as caseid, users.name as uuname, users.surname as uusurname, cases.name as cname, casetypes.*  FROM `cases`  JOIN client ON client.id = cases.client_id join casetypes on cases.type = casetypes.id join users on person=users.id  WHERE cases.number like '%$number%' AND cases.id like '%$name%' and cases.client_id like '$client' and cases.person like '$person' and cases.type like '$type' and cases.description like '%$other%' and closed like '$searchClosed'  ORDER BY $order_by";
        }
        $result=mysqli_query($conn, $query);
    
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                echo("<span>". $row['number']. "</span>");
                echo("<span>". $row['cname']. "</span>");
                echo("<span>". $row['typename']. "</span>");
                echo("<span> <a href=client.php?id=$row[client_id] >". $row['name']." ".$row['surname']. " </a> </span>"); 
                echo("<span>". $row['creation-date']. "</span>"); 
                echo("<span>". $row['closure_date']. "</span>"); 
                echo("<span>". $row['uuname']." ". $row['uusurname'] ."</span>");

                $query2="SELECT actions.*, actions.`task-date` as tdate FROM `actions` where case_id=$row[caseid]   order by tdate desc limit 1";
                $result2=mysqli_query($conn, $query2);
                if (mysqli_num_rows($result2) > 0) {
                while($row2 = mysqli_fetch_assoc($result2)) {
                    echo("<span>".$row2['tdate'] . "</span>");
                }
                }else{
                echo("<span>" . "</span>");
                }
                $query2="SELECT actions.*, actions.`date` as tdate, DATEDIFF(CURRENT_DATE,actions.`date`) as diff FROM `actions` where case_id=$row[caseid]  and done=0 order by diff desc limit 1";
                $result2=mysqli_query($conn, $query2);
                     if (mysqli_num_rows($result) > 0) {
                while($row2 = mysqli_fetch_assoc($result)) {
                    $current_date = date("Y-m-d");
                    $current_date = date_create();
                    $tdate = date_create($row2['tdate']);
                    $diff = date_diff($current_date, $tdate);
                    $year = $current_date->format('Y');
                    $month = $current_date->format('m');
                    $day = $current_date->format('d');
                    $current_date= date_create($year."-".$month."-".$day);
                    
                    if ($tdate >= $current_date) {
                        $is_in_future=1;
                    }else{
                        $is_in_future=0;
                    }
                    if ( ($diff->format('%d')<4 or $is_in_future==0) and $row2['done']==0  ) {
                        echo("<span style='color: red;'>".$row2['tdate']. "</span>");
                    }elseif($is_in_future==0 and $row2['done']==0){
                        echo("<span style='color: red;'>".$row2['tdate']. "</span>");
                    }
                    else{
                        echo("<span>".$row2['tdate']. "</span>");
                    }
                }
            }else{
                echo("<span>" . "</span>");
            }
    
                echo("<span class='options'>" . "<i class='fa fa-search' aria-hidden='true'></i> <a href=case.php?id=". $row['caseid'] .">
            Preview  </a> <br>"  );
            echo(  "<i class='fa fa-pencil' aria-hidden='true'></i> <a href=./edit-case.php?id=". $row['caseid'] ."> Edit  </a>" . "<br>");
            if ($row['closed']==0) {
                echo(  "<i class='fa fa-lock' aria-hidden='true'></i> <a href=./scripts/close-case.php?id=". $row['caseid'] ."> Close </a>" . "</span>");
            }else{
                echo "</span>";
            }

            }
        }


    }

    ?>

    </div>


    <!-- ADD CASE WINDOW -->
    <div class="floating-case" id='floating-case'>
        <h1>New case</h1>
        <form action="./scripts/add-case.php" id="addformcase" method="POST">
            <div class="search-menu">
                <div class="elem">
                    <p><i class="fa fa-search" aria-hidden="true"></i>Case type:</p>
                    <select name="type" form="addformcase" id="new-case-type" required>
                        <?php
                    $query="SELECT * FROM casetypes";
                    $result=mysqli_query($conn, $query);
                
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            echo("<option value= $row[id]>". $row[id] .". " . $row['typename']. "</option>");
                        }
                    }
                

                    ?>
                    </select>
                </div>
                <script>
                    document.getElementById('new-case-type').value = '';
                    var select_state, $select_state;
                    $select_state = $('#new-case-type').selectize({
                        onChange: function(value) {
                            if (!value.length) return;
                        }
                    });
                    select_state = $select_state[0].selectize;

                </script>
                <div class="elem">
                    <p><i class="fa fa-hashtag" aria-hidden="true"></i>Case no.:</p>
                    <input type="text" name="case-number" placeholder="---" value="---" disabled>
                </div>
                <div class="elem">
                    <p><i class="fa fa-file-text" aria-hidden="true"></i>Case name:</p>
                    <input type="text" name="case-name" placeholder="Case name" id="case-name" required>
                </div>

                <div class="elem">
                    <p><i class="fa fa-calendar" aria-hidden="true"></i>Creation date:</p>
                    <input type="date" name="date" id="" required>
                </div>
                <div class="elem">
                    <p><i class="fa fa-user" aria-hidden="true"></i>Person in charge:</p>
                    <select name="person" form="addformcase" id="new-person" required>
                        <?php
                    $query="SELECT * FROM users";
                    $result=mysqli_query($conn, $query);
                
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            echo("<option value= $row[id]>". $row['id'] .". " . $row['name']."  ". $row['surname']. "</option>");
                        }
                    }
                
                    ?>
                    </select>
                </div>
                <script>
                    document.getElementById('new-person').value = '';
                    var select_state, $select_state;
                    $select_state = $('#new-person').selectize({
                        onChange: function(value) {
                            if (!value.length) return;
                        }
                    });
                    select_state = $select_state[0].selectize;

                </script>
                <div class="elem">
                    <p><i class="fa fa-male" aria-hidden="true"></i>Client:</p>
                    <select name="client" form="addformcase" id="new-client-select" required>
                        <?php
                    $query="SELECT * FROM client";
                    $result=mysqli_query($conn, $query);
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            echo("<option value= $row[id]>". $row['id'] .". " . $row['name']."  ". $row['surname']. "</option>");
                        }
                    }
                

                    ?>

                    </select>
                </div>
                <script>
                    var select_state, $select_state;
                    document.getElementById('new-client-select').value = '';

                    $select_state = $('#new-client-select').selectize({
                        onChange: function(value) {
                            if (!value.length) return;
                        }
                    });
                    select_state = $select_state[0].selectize;

                </script>
            </div>
        </form>
        <div class="elem">
            <p><i class="fa fa-ellipsis-h" aria-hidden="true"></i>Description:</p>
            <textarea name="other" id="" cols="30" rows="10" form="addformcase" required></textarea>
        </div>
        <div class="float-buttons">
            <button type="submit" form="addformcase"><i class="fa fa-plus" aria-hidden="true"></i>Add</button>
            <button onclick="hideWindow('floating-case')"><i class="fa fa-times" aria-hidden="true"></i>Cancel</button>
        </div>


    </div>
    <!-- ADD CLIENT WINDOW -->
    <div class="floating-case" id='floating-client'>
        <h1>New client</h1>
        <form action="./scripts/add-client.php" id="addformclient" method="POST">
            <div class="search-menu">
                <div class="elem">
                    <p>Name:</p>
                    <input type="text" name="name" placeholder="Name" required>
                </div>
                <div class="elem">
                    <p>Surname:</p>
                    <input type="text" name="surname" placeholder="Surname" required>
                </div>
                <div class="elem">
                    <p>Street:</p>
                    <input type="text" name="street" placeholder="Street" required>
                </div>
                <div class="elem">
                    <p>Building no.:</p>
                    <input type="text" name="house-number" placeholder="Building no." required>
                </div>
                <div class="elem">
                    <p>Apartment no.</p>
                    <input type="text" name="apartment-number" placeholder="Apartment no." required>
                </div>
                <div class="elem">
                    <p>Postal code:</p>
                    <input type="text" name="postal-code" placeholder="Postal code" required>
                </div>
                <div class="elem">
                    <p>City:</p>
                    <input type="text" name="city" placeholder="City" required>
                </div>
                <div class="elem">
                    <p>NIP/PESEL/KRS:</p>
                    <input type="text" name="NIP" placeholder="NIP/PESEL/KRS" required>
                </div>
                <div class="elem">
                    <p>Phone:</p>
                    <input type="text" name="phone" placeholder="Phone" required>
                </div>
                <div class="elem">
                    <p>E-mail:</p>
                    <input type="text" name="mail" placeholder="E-mail" required>
                </div>
                <div class="elem">

                    <p>Contact person:</p>
                    <input type="text" name="contact-person" placeholder="Contact person">
                </div>
                <div class="elem">
                    <p>Client code:</p>
                    <input type="text" name="code" placeholder="Client code" required>
                </div>

        </form>


    </div>
    <div class="elem">
        <p><i class="fa fa-ellipsis-h" aria-hidden="true"></i>Description:</p>
        <textarea name="other" cols="30" rows="10" form="addformclient" required></textarea>
    </div>
    <div class="float-buttons">
        <button type="submit" form="addformclient"><i class="fa fa-plus" aria-hidden="true"></i>Add</button>
        <button onclick="hideWindow('floating-client')"><i class="fa fa-times" aria-hidden="true"></i>Cancel</button>
    </div>
    </div>

    <!-- ADD casetype WINDOW -->
    <div class="floating-casetype" id='floating-casetype'>
        <h1>New case type</h1>
        <form action="./scripts/add-casetype.php" id="addcasetype" method="POST">
            <div class="search-menu-casetype">
                <div class="elem">
                    <p>Name:</p>
                    <input type="text" name="name" placeholder="Name" required>
                </div>
            </div>
        </form>
        <div class="float-buttons">
            <button type="submit" form="addcasetype"><i class="fa fa-plus" aria-hidden="true"></i>Add</button>
            <button onclick="hideWindow('floating-casetype')"><i class="fa fa-times" aria-hidden="true"></i>Cancel</button>
        </div>
    </div>

    <!-- REMOVE casetype WINDOW -->
    <div class="floating-casetype" id='floating-casetype-remove'>
        <h1>Delete case type</h1>
        <form action="./scripts/remove-casetype.php" id="removecasetype" method="POST">
            <div class="search-menu-casetype">
                <div class="elem">
                    <p><i class="fa fa-tag" aria-hidden="true"></i>Name:</p>
                    <select name="id" form="removecasetype" id="select-case-type-remove">
                        <?php
                    $query="SELECT * FROM casetypes";
                    $result=mysqli_query($conn, $query);
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            echo("<option value= $row[id]>". $row['id'] .". " . $row['typename']. "</option>");
                        }
                    }
                    ?>
                    </select>
                </div>
                <script>
                    var select_state, $select_state;
                    $select_state = $('#select-case-type-remove').selectize({
                        onChange: function(value) {
                            if (!value.length) return;
                        }
                    });
                    select_state = $select_state[0].selectize;

                </script>
            </div>
        </form>
        <div class="float-buttons">
            <button type="submit" form="removecasetype"><i class="fa fa-minus" aria-hidden="true"></i>Delete</button>
            <button onclick="hideWindow('floating-casetype-remove')"><i class="fa fa-times" aria-hidden="true"></i>Cancel</button>

        </div>
    </div>


    <!-- ADD actiontype WINDOW -->
    <div class="floating-casetype" id='floating-actiontype'>
        <h1>New action type</h1>
        <form action="./scripts/add-actiontype.php" id="addactiontype" method="POST">
            <div class="search-menu-casetype">
                <div class="elem">
                    <p>Name:</p>
                    <input type="text" name="name" placeholder="Name" required>
                </div>
            </div>
        </form>
        <div class="float-buttons">
            <button type="submit" form="addactiontype"><i class="fa fa-plus" aria-hidden="true"></i>Add</button>
            <button onclick="hideWindow('floating-actiontype')"><i class="fa fa-times" aria-hidden="true"></i>Cancel</button>
        </div>
    </div>

    <!-- REMOVE actiontype WINDOW -->
    <div class="floating-casetype" id='floating-actiontype-remove'>
        <h1>Delete action type</h1>
        <form action="./scripts/remove-actiontype.php" id="removeactiontype" method="POST">
            <div class="search-menu-casetype">
                <div class="elem">
                    <p><i class="fa fa-tag" aria-hidden="true"></i>Name:</p>
                    <select name="id" form="removeactiontype" id="select-action-type-remove">
                        <?php
                    $query="SELECT * FROM actiontypes";
                    $result=mysqli_query($conn, $query);
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            echo("<option value= $row[id]>". $row['id'] .". " . $row['name']. "</option>");
                        }
                    }
                    ?>
                    </select>
                </div>
                <script>
                    var select_state, $select_state;
                    $select_state = $('#select-action-type-remove').selectize({
                        onChange: function(value) {
                            if (!value.length) return;
                        }
                    });
                    select_state = $select_state[0].selectize;

                </script>
            </div>
        </form>
        <div class="float-buttons">
            <button type="submit" form="removeactiontype"><i class="fa fa-minus" aria-hidden="true"></i>Delete</button>
            <button onclick="hideWindow('floating-actiontype-remove')"><i class="fa fa-times" aria-hidden="true"></i>Cancel</button>

        </div>
    </div>


</body>


</html>
