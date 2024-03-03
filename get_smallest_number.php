<?php
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

// Find the smallest unserved record
$sql = "SELECT MIN(ordrefile) AS smallestNumber FROM ordre WHERE ticketprise = 'false'";
$result = mysqli_query($conn, $sql);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $response = array('smallestNumber' => $row['smallestNumber']);
    echo json_encode($response);
} else {
    echo "Error: " . mysqli_error($conn);
}

$conn->close();
?>
