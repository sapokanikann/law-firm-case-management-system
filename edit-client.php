<?php
session_start();
if(!isset($_SESSION['username'])){
    header("Location:login.php");
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Client edit</title>
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
$id=$_GET['id'];

$query = "SELECT * FROM client where id=$id";
$result=mysqli_query($conn, $query);
while($row = mysqli_fetch_assoc($result)) {
$name = $row['name'];
$surname = $row['surname'];
$street = $row['street'];
$houseno = $row['house'];
$appno = $row['apartment'];
$postal = $row['postal'];
$city = $row['city'];
$nip = $row['NIP'];
$phone = $row['telephone'];
$email = $row['mail'];
$contactperson = $row['contact-person'];
$ccode = $row['code'];
$other = $row['other'];
};


?>
    <h1>Client edit</h1>
    <form action="./scripts/edit-client.php?id=<?php echo $id ?>" id="addformclient" method="POST">
        <div class="search-menu">
            <div class="elem">
                <p>Name:</p>
                <input type="text" name="name" placeholder="Name" value="<?php echo $name  ?>" required>
            </div>
            <div class="elem">
                <p>Surname:</p>
                <input type="text" name="surname" placeholder="Surname" value="<?php echo $surname  ?>" required>
            </div>
            <div class="elem">
                <p>Street:</p>
                <input type="text" name="street" placeholder="Street" value="<?php echo $street  ?>" required>
            </div>
            <div class="elem">
                <p>Building no.:</p>
                <input type="text" name="house-number" placeholder="Building no." value="<?php echo $houseno  ?>" required>
            </div>
            <div class="elem">
                <p>Apartment no.:</p>
                <input type="text" name="apartment-number" placeholder="Apartment no." value="<?php echo $appno  ?>" required>
            </div>
            <div class="elem">
                <p>Postal code:</p>
                <input type="text" name="postal-code" placeholder="Postal code" value="<?php echo $postal  ?>" required>
            </div>
            <div class="elem">
                <p>City:</p>
                <input type="text" name="city" placeholder="City" value="<?php echo $city  ?>" required>
            </div>
            <div class="elem">
                <p>NIP/PESEL/KRS:</p>
                <input type="text" name="NIP" placeholder="NIP/PESEL/KRS" value="<?php echo $nip  ?>" required>
            </div>
            <div class="elem">
                <p>Phone:</p>
                <input type="text" name="phone" placeholder="Phone" value="<?php echo $phone  ?>" required>
            </div>
            <div class="elem">
                <p>E-mail:</p>
                <input type="text" name="mail" placeholder="E-mail" value="<?php echo $email ?>" required>
            </div>
            <div class="elem">

                <p>Contact person:</p>
                <input type="text" name="contact-person" placeholder="Contact person" value="<?php echo $contactperson  ?>">
            </div>
            <div class="elem">
                <p>Client code:</p>
                <input type="text" name="code" placeholder="Client code" value="<?php echo $ccode  ?>" required>
            </div>

    </form>
    </div>
    <div class="elem">
        <p><i class="fa fa-ellipsis-h" aria-hidden="true"></i>Description:</p>
        <textarea name="other" cols="30" rows="10" form="addformclient" required><?php echo $other  ?></textarea>
    </div>

    <div class="float-buttons">
        <button type="submit" form="addformclient"><i class="fa fa-pencil" aria-hidden="true"></i>
            Change</button>
    </div>
