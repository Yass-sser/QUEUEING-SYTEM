<?php

$servername = "localhost"; // Replace with your database server
    $username = "username"; // Replace with your database username
    $password = "password"; // Replace with your database password
    $dbname = "qeue project"; // Replace with your database name

    // Create a connection to the database
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


require('fpdf.php');
if (isset($_POST['impr'])){
    $trakk = $_POST['trakk'];
    $ordrr = $_POST['ordrr'];
        $ticketWidth = 100;
        $ticketHeight = 100;

          $pdf = new FPDF();
          $pdf->AddPage('P', array($ticketWidth, $ticketHeight) );
          $currentDate = date("Y-m-d H:i:s");
$pdf->SetFont('Arial', 'B', 15);
$h = 7;
$pdf->SetFont('Arial', 'B', 25);
$pdf->Cell(40, 10, ' TICKET: '.$ordrr);
$pdf->Ln(18);
$pdf->SetFont('Arial', 'B', 20);
$pdf->Cell(40, 10, ''.$trakk);
$pdf->Ln(18);


// Output the PDF to the browser or save to a file
$pdf->Output('operta.pdf', 'D'); // 'D' sends the PDF as a download to the browser        

          }
          
        if (isset($_POST['found'])) {
          $id = $_POST['idd'];
          $sqq = "UPDATE Tracking SET stat = 1 WHERE id = '$id'"; // Assuming 'id' is the unique identifier column
          $resultat = mysqli_query($conn, $sqq);
          if (!$resultat) {
             echo "Error updating data: " . mysqli_error($conn);
          }
      }    
      if (isset($_POST['notfound'])) {
          $id = $_POST['idd'];
          $sqq1 = "UPDATE Tracking SET stat = 0 WHERE id = '$id'";
          $resultat1 = mysqli_query($conn, $sqq1);
          if (!$resultat1) {
              echo "Error marking as served or inserting: " . mysqli_error($conn);
          }
      } 
      echo '<script>window.location.href = "oper.php";</script>';
          ?>