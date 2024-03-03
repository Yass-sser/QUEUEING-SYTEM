<?php
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
              $currentDate = date("Y-m-d H:i:s");            
            }}}?>
            <!DOCTYPE html>
<html>
<head>
  <title>Ticket</title>
  <style>
     body {
      font-family: Arial, sans-serif;
      width: 250px; /* Set the width */
      height: 150px; /* Set the height */
      margin: 0; /* Reset margin for accurate sizing */
      padding: 10px; /* Add padding for content */
    }
    .logo {
      width: 50%;
      height: auto;
      margin-bottom: 10px; /* Add spacing after logo */
    }
    .header {
      font-weight: bold;
      font-size: 16px;
      margin-bottom: 8px; /* Add spacing after header */
    }
    .ticket-number {
      font-weight: bold;
      font-size: 30px;
      margin-bottom: 6px; /* Add spacing after ticket number */
    }
    .waiting-img {
      width: 30px;
      height: 30px;
    }
    .waiting-text {
      font-weight: bold;
      font-size: 15px;
    }
    .date {
      font-size: 10px;
    }
    .input-data{
        font-weight: bold;
      font-size: 20px;
      margin-bottom: 6px;
    }
    .footer{
      font-size: 10px;
      font-weight: bold;
    }
    .date{
      font-weight: bold;
    }
  </style>
</head>
<body>
  <img src="loggo.jpg" alt="Logo" class="logo">
  <div class="header">AGENCE DE BATNA</div>
  <div class="ticket-number">TICKET: R <?php echo $newValue; ?></div>
  <div class="input-data"><?php echo $inputData; ?></div>
  <img src="waiting.png" alt="Waiting" class="waiting-img">
  <div class="waiting-text">AVANT VOUS: <?php echo $unserved; ?></div>
  <br>

  <div class="date"> <?php echo $currentDate; ?></div>
  <br>
  <div class="footer"> Merci de Votre Visite <br>  حفاظا على المحيط يرجى رمي التدكرة في الحاوية الصفراء </div>
</body>
</html>
