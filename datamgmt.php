<?php
require('fpdf.php');
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "qeue project";

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
}

// Insert tracking received into the database
if (isset($_POST['trak'])) {
    $inputData = $_POST["trackr"];
    $sql = "INSERT INTO tracking (tracks) VALUES ('$inputData')";
    $conn->query($sql);

    // Generate an order number for the client
    $sql = "SELECT MAX(ordrefile) AS max_counter FROM ordre";
    $result = $conn->query($sql);
    if ($result) {
        $row = $result->fetch_assoc();
        $currentMaxValue = $row['max_counter'];
        $newValue = $currentMaxValue + 1;

        // Insert a new row with the incremented value
        $insertSql = "INSERT INTO ordre (ordrefile, ticketprise) VALUES ($newValue,'0')";

        $sql2 = "SELECT MAX(ordrefile) AS max_counterunserved FROM ordre WHERE ticketprise = '1'";
        $result2 = $conn->query($sql2);
        if ($result2) {
            $row1 = $result2->fetch_assoc();
            $maxval = $row1['max_counterunserved'];
            $unserved = $newValue - $maxval;
            if ($conn->query($insertSql) === TRUE) {
                $ticketWidth = 75;
                $ticketHeight = 150;

                
                

                // Add JavaScript to automatically print the PDF
                echo "
                <script type='text/javascript'>
                    document.addEventListener('DOMContentLoaded', function() {
                        setTimeout(function() {
                            window.print();
                        }, 200); // Delay for 1 second to allow for the PDF to fully load
                    });
                </script>
                ";}}}}
                ?>
