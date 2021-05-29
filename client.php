<?php
session_start();
if(!isset($_SESSION['username'])){
    header("Location:login.php");
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Client</title>
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

    <div class="client-info">
        <?php
    $servername = "localhost";
    $usernamedb = "root";
    $passworddb = "";
    $conn = new mysqli($servername, $usernamedb, $passworddb, "kanc");
    $uid=$_GET['id'];
    $query="SELECT * FROM `client` WHERE id = $uid ";
    $result=mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
          echo (" <div>
          <p> Name Surname: <br>" .$row['name']. " ".  $row['surname']."</p>
          <p> Address: <br> Ul. " . $row['street'] . " ". $row['house'] . "/". $row['apartment'].  "<br>"  . $row['postal']. " ". $row['city']    ."</p>
          <p> NIP/PESEL/KRS:<br>". $row['NIP']. "</p>

      </div>  

      <div>
      <p>Phone: ". $row['telephone'] .  "</p>
      <p>E-mail: ". $row['mail']   .  "</p>
      <p>Contact person:<br> " .  $row['contact-person']  ."</p>
  </div>
  <div>
            <p>Notes: ". $row['other'] . "<p>
        </div>
    "



    );



        }
    }

    ?>

    </div>

    <div class="case-buttons">

        <button class="add-button"><i class="fa fa-file-text-o" aria-hidden="true"></i><a href="./scripts/report-client.php?id=<?php echo $uid;  ?>"> Generate report </a></button>
        <button class="add-button"><i class="fa fa-pencil" aria-hidden="true"></i><a href="./edit-client.php?id=<?php echo $uid;  ?>"> Edit </a></button>

    </div>

    <div class='client-table'>
        <span class="header">Case no.</span>
        <span class="header">Case name</span>
        <span class="header">Case type</span>
        <span class="header">Client</span>
        <span class="header">Date of creation</span>
        <span class="header">Date of closing</span>
        <span class="header">Person in charge</span>
        <span class="header">Date of last action</span>
        <span class="header">Date of next action</span>
        <span class="header"></span>
        <?php
     if(empty($_GET)){

        $query="SELECT cases.*,cases.name as cname ,cases.id as caseid, client.*, users.name as uuname, users.surname as uusurname, casetypes.*  FROM `cases`  JOIN client ON client.id = cases.client_id join casetypes on cases.type = casetypes.id join users on person=users.id  ORDER BY `cases`.`creation-date` DESC";
         
    $result=mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            echo("<span>". $row['number']. "</span>");
            echo("<span>". $row['cname']. "</span>");
            echo("<span>". $row['typename']. "</span>");
            echo("<span> <a href=client.php?id=$row[client_id] >". $row['name']." ".$row['surname']. " </a> </span>"); 
            echo("<span>". $row['creation-date']. "</span>"); 
            if ($row['closed']) {
                echo("<span>". $row['closure_date']. "</span>"); 
            }else{
                echo("<span>". "---". "</span>"); 
            }
            echo("<span>". $row['uuname']." ". $row['uusurname'] ."</span>");
            echo("<span>". "????". "</span>");
            echo("<span>". "?????". "</span>");
            
            echo("<span class='options'>" . "<i class='fa fa-search' aria-hidden='true'></i> <a href=case.php?id=". $row['caseid'] .">
            Preview  </a> <br>"  );
            echo(  "<i class='fa fa-pencil' aria-hidden='true'></i> <a href=./edit-case.php?id=". $row['caseid'] ."> Edit  </a>" . "<br>");
            echo(  "<i class='fa fa-lock' aria-hidden='true'></i> <a href=./scripts/close-case.php?id=". $row['caseid'] ."> Close  </a>" . "</span>");

        }
    }

    }else{
        $name = "%";
        $number = "%";
        $client = $uid;
        $person = "%";
        $type = "%";
        $other ="%";
        $searchClosed=0;

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


        $query="SELECT cases.*, client.*,cases.name as cname, cases.id as caseid, users.name as uuname, users.surname as uusurname, casetypes.*  FROM `cases`  JOIN client ON client.id = cases.client_id join casetypes on cases.type = casetypes.id join users on person=users.id  WHERE cases.number like '$number' AND cases.name like '$name' and cases.client_id like '$client' and cases.person like '$person' and cases.type like '$type' and cases.description like '$other'   ORDER BY `cases`.`creation-date` DESC";
        // echo $query;
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
            if (($row['closed']==0)) {
                echo(  "<i class='fa fa-lock' aria-hidden='true'></i> <a href=./scripts/close-case.php?id=". $row['caseid'] ."> Close  </a>" . "</span>");
            }else{
                echo "</span>";
            }

            }
        }


    }

    ?>
    </div>
    <!-- ADD CASE WINDOW -->
    <div class="floating-case" id='floating-action'>
        <h1>New case</h1>
        <form action="./scripts/add-action.php" id="addformaction" method="POST">
            <div class="search-menu">
                <div class="elem">
                    <p><i class="fa fa-calendar" aria-hidden="true"></i>Date of action:</p>
                    <input type="date">
                </div>
                <div class="elem">
                    <p><i class="fa fa-file-o" aria-hidden="true"></i>Type of action:</p>
                    <select name="client" form="addformaction">
                        <option value="klient1">Mail coming in</option>
                        <option value="klient2">Mail coming out</option>
                        <option value="klient3">Meeting</option>
                        <option value="klient4">Hearing</option>
                        <option value="klient3">Phone</option>
                        <option value="klient3">Other</option>
                    </select>
                </div>
                <div class="elem">
                    <p><i class="fa fa-clock-o" aria-hidden="true"></i>Time:</p>
                    <input type="text" name="date" id="">
                </div>
                <div class="elem">
                    <p><i class="fa fa-calendar" aria-hidden="true"></i>Task deadline:</p>
                    <input type="date">
                </div>
            </div>
        </form>
        <div class="elem">
            <p><i class="fa fa-ellipsis-h" aria-hidden="true"></i>Description:</p>
            <textarea name="other" id="" cols="30" rows="10" form="addformaction"></textarea>
        </div>
        <div class="elem">
            <p><i class="fa fa-ellipsis-h" aria-hidden="true"></i>Notes:</p>
            <textarea name="other" id="" cols="30" rows="10" form="addformaction"></textarea>
        </div>
        <div class="float-buttons">
            <button type="submit" form="addformaction"><i class="fa fa-plus" aria-hidden="true"></i>Add</button>
            <button onclick="hideWindow('floating-action')"><i class="fa fa-times" aria-hidden="true"></i>Cancel</button>
        </div>


    </div>

</body>

</html>
