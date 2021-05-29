<!DOCTYPE html>
<html>

<head>
    <title>Log in</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="stylesheet" href="./css/font-awesome-4.7.0/css/font-awesome.min.css">
    <script src="./scripts/window.js"></script>
</head>

<body>

    <div class="containermain">
        <img src="css/case-logo.png" alt="PROSECURIST logo">
    </div>

    <div class="login-form">
        <h1>Log in</h1>
        <form action="./scripts/sign-in.php" method="post">
            <input type="text" name="username" placeholder="Username"> <br>
            <input type="password" name="pass" placeholder="Password"><br>
            <input type="submit" value="Log in" class="submit">


        </form>
        <?php

        $servername = "localhost";
    $usernamedb = "root";
    $passworddb = "";
$conn = new mysqli($servername, $usernamedb, $passworddb, "kanc");
$query = "SELECT * FROM registration";
    $result=mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
        $reg_enabled= $row['enabled'];
        }
    };

    if($reg_enabled){
    
?>
        <form action="./scripts/sign-up.php" method="post">
            <h1>Register</h1>
            <input type="text" name="name" placeholder="Name" required> <br>
            <input type="text" name="surname" placeholder="Surname" required> <br>
            <input type="text" name="username" placeholder="Username" required><br>
            <input type="password" name="pass" placeholder="Password" required><br>
            <input type="password" name="pass2" placeholder="Repeat password" required><br>
            <input type="submit" value="Register" class="submit">
        </form>
    </div>
    <?php
}

?>


</body>
