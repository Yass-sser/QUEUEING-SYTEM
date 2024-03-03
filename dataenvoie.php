<?php
$servername = "localhost"; 
$username = "username"; 
$password = "password"; 
$dbname = "qeue project"; 

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
else{
   

}
    $sql = "SELECT MAX(Envoie)AS max_counter FROM envoieclassique";
    $result = $conn->query($sql);
    if ($result) {
        $row = $result->fetch_assoc();
        $currentMaxValue = $row['max_counter'];
        $newValue = $currentMaxValue + 1;
          $insertQuery = "INSERT INTO envoieclassique (Envoie) VALUES ($newValue)";
          $result = $conn->query($insertQuery);    
          if ($result === TRUE) {
            $sql2="SELECT MAX(Envoie) AS max_counterunserved FROM envoieclassique WHERE ticketprise = '1'";
         $result2 = $conn->query($sql2);
          if ($result2) {
$row1=$result2->fetch_assoc();
            $maxval=$row1['max_counterunserved'];
            $unserved = $newValue - $maxval; 
          } else {
              echo "Error executing the insert query: " . $conn->error;
          }
          }}
          $currentDate = date("Y-m-d H:i:s");
          ?>
             
             <html>
<head>
  <title>Ticket</title>
  <style>
     body {
      font-family: Arial, sans-serif;
      width: 250px; /* Set the width */
      height: 300px; /* Set the height */
      margin: 0; /* Reset margin for accurate sizing */
      padding: 10px; /* Add padding for content */
      border: 1px solid #000; /* Add a border for visualization */
      box-sizing: border-box; /* Include border in overall width/height */
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
      font-size: 20px;
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
  </style>
</head>
<body>
  <img src="loggo.jpg" alt="Logo" class="logo">
  <div class="header">AGENCE DE BATNA</div>
  <div class="ticket-number">TICKET: E <?php echo $newValue; ?></div>
  <img src="waiting.png" alt="Waiting" class="waiting-img">
  <div class="waiting-text">AVANT VOUS: <?php echo $unserved; ?></div>
  <div class="date">Date: <?php echo $currentDate; ?></div>
</body>
</html>
