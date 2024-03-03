<?php
// Database connection parameters
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "qeue project";

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$smallestNumber = null;
$trackaffich = '';

// Select the smallest number and corresponding track using a LEFT JOIN
$sql = "SELECT ordre.ordrefile AS Smallestnumber, tracking.tracks 
        FROM ordre
        LEFT JOIN tracking ON ordre.ordrefile = tracking.id
        WHERE ordre.ticketprise = 'false'
        ORDER BY ordre.ordrefile ASC LIMIT 1";

$result = $conn->query($sql);

if ($result) {
    $row = $result->fetch_assoc();
    if ($row && isset($row['Smallestnumber'])) {
        $smallestNumber = $row['Smallestnumber'];
        $trackaffich = $row['tracks'];
        
        // Mark this record as "served" by the current user
        $updateSql = "UPDATE ordre SET ticketprise = '1' WHERE ordrefile = $smallestNumber";
        $conn->query($updateSql);
    }
}

$unserved = 0;

// Calculate the number of unserved clients
$sql3 = "SELECT MAX(ordrefile) AS max_counterunserved FROM ordre WHERE ticketprise = '1'";
$sql4 = "SELECT MAX(ordrefile) AS maxordre FROM ordre";
$result4 = $conn->query($sql4);
$result3 = $conn->query($sql3);

if ($result3 && $result4) {
    $row3 = $result3->fetch_assoc();
    $row4 = $result4->fetch_assoc();
    if ($row3 && $row4 && isset($row4['maxordre']) && isset($row3['max_counterunserved'])) {
        $newValue = $row4['maxordre'];
        $maxval = $row3['max_counterunserved'];
        $unserved = $newValue - $maxval;
    }
}

// Return the data as a JSON response
echo json_encode(array('smallestNumber' =>  $smallestNumber, 'trackaffich' => $trackaffich, 'EnAttente' => $unserved));

// Close the database connection
$conn->close();
?>
