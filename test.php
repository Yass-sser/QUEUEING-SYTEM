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
    $sql = "SELECT MIN(tour) AS Smallestnumber FROM fileattent WHERE statu = 'false'";
    $result = mysqli_query($conn, $sql);

    $smallestNumber = null; // Default value for smallestNumber

if ($result) {
   

    $row = mysqli_fetch_assoc($result);
    if ($row && isset($row['Smallestnumber'])) {
        $smallestNumber = $row['Smallestnumber'];
        // Mark this record as "served" by the current user
        $updateSql = "UPDATE fileattent SET statu = '1' WHERE tour = substr($SmallestNumber, 1);";
        mysqli_query($conn, $updateSql);
    }
}

$sql2 = "SELECT tracks FROM tracking WHERE id = '$smallestNumber'";
$result2 = mysqli_query($conn, $sql2);
$trackaffich = ''; // Default value if $result2 or $row1 is null
if ($result2) {
    $row1 = mysqli_fetch_assoc($result2);
    if ($row1 && isset($row1['tracks'])) {
        $trackaffich = $row1['tracks']; 
    }
}

$unserved = 0;
$sql3 = "SELECT MAX(ordrefile) AS max_counterunserved FROM ordre WHERE ticketprise = '1'";
$sql4 = "SELECT MAX(ordrefile) AS maxordre FROM ordre";
$result4 = $conn->query($sql4);
$result3 = $conn->query($sql3);
if ($result3 && $result4) {
    $row3 = $result3->fetch_assoc();
    $row4 = $result4->fetch_assoc();
    if ($row3 && $row4 && isset($row4['maxordre']) && isset($row3['max_counterunserved'])) {
        $newValue= $row4['maxordre'];
        $maxval = $row3['max_counterunserved'];
        $unserved = $newValue - $maxval;
    }
}



    // Return the data as a JSON response
    echo json_encode(array('smallestNumber' =>  $smallestNumber, 'trackaffich' => $trackaffich, 'EnAttente' => $unserved));


    
?>
