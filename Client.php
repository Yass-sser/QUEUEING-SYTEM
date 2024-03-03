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
else{

}
$sql1="SELECT MAX(ordrefile) AS max_counter FROM ordre";
$sql2="SELECT MAX(Envoie) AS max_counterenv FROM envoieclassique";

$result1 = $conn->query($sql1);

$result2 = $conn->query($sql2);

$row1 = $result1->fetch_assoc();
$maxvalrec=$row1['max_counter'];
$row2 = $result2->fetch_assoc();
$maxvalenv=$row2['max_counterenv'];
if($result1 && $result2 ){

    $maxval=$maxvalrec+$maxvalenv;
}
?>
<html>   
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">

<title> queue manager </title>
<link rel="stylesheet" href="queuee.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
<style>
    .date-display {
        font-family: Arial, sans-serif;
        font-size: 18px;
        font-style: italic;
        color: #333;
        margin-top: 10px;
    }
</style>

</head>
<body>
 
<div class="img"></div>
<div class="cont" style="height: 100%; ">
    <img src="yalidine-logo.png" alt="">
    <div class="info-box">
        <marquee> <h3> L'AGENCE DE YALIDINE EXPRESS BATNA  VOUS SOUHAITE LE BIENVENUE 
        <br> وكالة ياليدين الجزائر الخدمات ولاية باتنة ترحب بكم  
    </h3></marquee></div>
    
    <form action="confirmation tracking.html" method="post"><button type="submit" type="button" name="increment"  class="btn btn-primary btn-lg">JE VEUX RECUPERER MON COLIS <br> استلام الطرد الخاص بي </button></form>
    <form action="confirmation envoie.html" method="post"><button type="submit" type="button" class="btn btn-success btn-lg">JE VEUX ENVOYER UN COLIS<br> ارسال الطرد الخاص بي </button></form>
    <p id="current-date" style="font-family: Arial, sans-serif; font-size: 18px; font-style: italic; color: #333; margin-top: 10px;"></p>
    <p style="font-size: 20px;">Nombre de Visiteur Aujord'hui <br> عدد الزوار اليوم </p>
    <p style="font-size: 20px;"> 
    <i class="fas fa-users fa-3x" style="color: black; vertical-align: middle;"></i>
    <span style="font-size: 45px; margin-left: 10px;"><?php echo $maxval; ?></span>
</p>


<script>
    function updateDate() {
        const currentDate = new Date().toLocaleString();
        document.getElementById("current-date").textContent = currentDate;
    }

    // Update the date every second (1000 milliseconds)
    setInterval(updateDate, 1000);

    // Call it once immediately to show the date when the page loads
    updateDate();
    const images = [
    'YALIDINE-1.jpg',
    'YALIDINE-2.jpg',
    'YALIDINE-3.jpg',
    'YALIDINE-4.jpg',
    'YALIDINE-5.jpg',
    'YALIDINE-6.jpg'
    // Add more image URLs as needed
  ];

  let currentImageIndex = 0;
  const slideshowContainer = document.querySelector('.img');

  function changeImage() {
    slideshowContainer.style.backgroundImage = `url(${images[currentImageIndex]})`;
    currentImageIndex = (currentImageIndex + 1) % images.length;
  }

  // Change the image every 3 seconds (3000 milliseconds)
  setInterval(changeImage, 3000);

  // Show the first image immediately when the page loads
  changeImage();
</script>

</div>
</body>
</html>