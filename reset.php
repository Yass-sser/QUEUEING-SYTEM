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
if (isset($_POST['renitrecup'])) {
$sql="DELETE FROM ordre ";
$sql1="DELETE FROM tracking ";
$sql2="ALTER TABLE tracking AUTO_INCREMENT = 0";
$sql3="DELETE FROM envoieclassique";

if ($conn->query($sql) && $conn->query($sql1)  && $conn->query($sql2) === TRUE && $conn->query($sql3) === TRUE) {
    echo "Status reset successfully";
} else  {
    echo "Error resetting status: " . $conn->error;
}
header('Admin.php');
}
?>