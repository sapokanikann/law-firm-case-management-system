<?php
session_start();
if(!isset($_SESSION['username'])){
    header("Location:../login.php");
}

    $servername = "localhost";
    $usernamedb = "root";
    $passworddb = "";;
    $conn = new mysqli($servername, $usernamedb, $passworddb, "kanc");
    $uid=$_GET['id'];
    $query="SELECT * FROM `client` WHERE id = $uid ";
    $result=mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $cname = $row['name'];
            $csurname = $row['surname'];
        };
    };





    require('./fpdf/tfpdf.php');

    $pdf = new TFPDF();
    $pdf->AddPage();
    $pdf->AddFont('DejaVu','','DejaVuSansCondensed.ttf',true);
    $pdf->SetFont('DejaVu','',12);
    $pdf->Cell(40,10,"Klient:",0,0);
    $pdf->Cell(40,10,$cname." ".$csurname,0,1);
    $pdf->Ln();
    $query="SELECT cases.*,cases.name as cname ,cases.id as caseid, client.*, users.name as uuname, users.surname as uusurname, `creation-date` as cdate, casetypes.*  FROM `cases`  JOIN client ON client.id = cases.client_id join casetypes on cases.type = casetypes.id join users on person=users.id where client_id = $uid  ORDER BY `cases`.`creation-date` DESC";
    $result=mysqli_query($conn, $query);
    $pdf->Cell(40,10,"Sprawy:",0,1);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $pdf->SetFont('DejaVu','',20);
            $pdf->MultiCell(0,10,$row['number']." ".$row['cname'], 0,1);
            $pdf->SetFont('DejaVu','',12);
            $pdf->Cell(40,10,"Typ: ".$row['typename'],0,1);
            $pdf->Cell(40,10,"Data założenia: ".$row['cdate'],0,1);
            if(!empty($row['closure_date'])){
                $pdf->Cell(40,10,"Data zamknięcia: ".$row['closure_date'],0,1);
            }
            $pdf->MultiCell(0,10,"Opis: ".trim($row['description']),0,1);
        };
    };
    $pdf->Output();
?>
