<?php
use GuzzleHttp\Psr7\Query;
// Database connection parameters
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
$Smallestnumber= null;
    // Find the smallest unserved record
    $sqls = "SELECT MIN(Envoie) AS Smallestnumber FROM envoieclassique WHERE ticketprise  IS NULL";
    $result = mysqli_query($conn, $sqls);
    $Smallestnumber=null;
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $Smallestnumber = $row['Smallestnumber'];     
        // Mark this record as "served" by the current user
        $update = "UPDATE envoieclassique SET ticketprise = '1' WHERE Envoie = $Smallestnumber";
        if (mysqli_query($conn, $update)) {
        $sqla= "SELECT MAX(Envoie) AS max_counterunservede FROM envoieclassique WHERE ticketprise = '1'";
        $sqlb="SELECT MAX(Envoie) AS max_counter FROM envoieclassique ";
        $RESULTA=$conn->query($sqla);
        $RESULTB=$conn->query($sqlb);
        if ($RESULTA && $RESULTB) {
            $row3 = $RESULTA->fetch_assoc();
            $row4 = $RESULTB->fetch_assoc();
            $newValue= $row4['max_counter'];
            $maxval = $row3['max_counterunservede'];
            $unserved = $newValue - $maxval;
           }
        } else {
           
        }
    } else {
    }
    echo json_encode(array('Smallestnumber' => $Smallestnumber, 'enattente' => $unserved ));
?>