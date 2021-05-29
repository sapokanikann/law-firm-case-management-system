<?php
session_start();
if(!isset($_SESSION['username'])){
    header("Location:../login.php");
}

        $servername = "localhost";
    $usernamedb = "root";
    $passworddb = "";;
    $conn = new mysqli($servername, $usernamedb, $passworddb, "kanc");
    $cid=$_GET['id'];
    $query="SELECT * FROM `cases` WHERE id = $cid ";
    $result=mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $number = $row['number'];
            // $csurname = $row['surname'];
        };
    };
    require('./fpdf/tfpdf.php');

    $pdf = new TFPDF();
    $pdf->AddPage();
    $pdf->AddFont('DejaVu','','DejaVuSansCondensed.ttf',true);
    $pdf->SetFont('DejaVu','',12);
    $pdf->Cell(40,10,"Case no.: ",0,0);
    $pdf->Cell(40,10,$number,0,1);
    $pdf->Ln();
    $query="SELECT actions.*, users.name as uname, users.surname as usur FROM `actions` join users on users.id = actions.person_id WHERE case_id = $cid  ORDER BY `actions`.`task-date` DESC ";
    $result=mysqli_query($conn, $query);
    $pdf->Cell(40,10,"Actions:",0,1);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $pdf->SetFont('DejaVu','',20);
            $pdf->Cell(40,10,$row['type'], 0,1);
            $pdf->SetFont('DejaVu','',12);
            $pdf->Cell(40,10,"Date of action: ".$row['task-date'],0,1);
            $pdf->Cell(40,10,"Deadline of action: ".$row['date'],0,1);
            $pdf->Cell(40,10,"Type of action: ".$row['type'],0,1);
            $pdf->Cell(40,10,"Time: ".substr($row['time'],0,5),0,1);
            $pdf->MultiCell(0,10,"Description: ".trim($row['description']),0,1);
            $pdf->MultiCell(0,10,"Other: ".trim($row['other']),0,1);
        };
    };
    $pdf->Output();
?>
