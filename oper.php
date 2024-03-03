<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="maincss.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

    <title>OPERATIONS</title>  
</head>
<body>
    <header>YALIDINE EXPRESS</header>
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

    // Select data from the database
    $sql = "SELECT tracks FROM Tracking";
    $result = mysqli_query($conn, $sql);

    $sql1 = "SELECT ordrefile FROM ordre";
    $result1 = mysqli_query($conn, $sql1);
 
    $sql2="SELECT stat FROM Tracking";
    $result2 = mysqli_query($conn, $sql2);

    $sql3="SELECT id FROM Tracking";
    $result3 = mysqli_query($conn, $sql3);
    // Check if there are any results
    if (mysqli_num_rows($result) > 0 || mysqli_num_rows($result1) > 0 || mysqli_num_rows($result2) > 0) {
        echo "<table class='table table-striped' style='margin-left:5px;'>";
        echo"<thead>";
        echo "<tr><th>Tracks</th><th>Ordrefile</th><th>Status</th></tr>";
        echo"</thead>";
        // Fetch data and display in a table row by row
        while (($row = mysqli_fetch_assoc($result)) && ($row1 = mysqli_fetch_assoc($result1))&& ($row2 = mysqli_fetch_assoc($result2))&& ($row3 = mysqli_fetch_assoc($result3))) {
            if ($row2["stat"] == 0){
            echo "<tr>";
            echo"<form method='post' action='pdf.php'>";
            echo "<td>" . $row["tracks"] . "</td>";
            $trakk= $row["tracks"];
            echo "<input type='hidden' name='trakk' value='" . $row["tracks"] . "'>";
            echo "<td>" . $row1["ordrefile"] . "</td>";
            echo "<input type='hidden' name='ordrr' value='" . $row1["ordrefile"] . "'>";
            if ($row2["stat"] == 1) {
                echo '<td style ="font-size:25px;"><i class="fas fa-check-circle"></i></td>';
            }
            if ($row2["stat"] == 0) {
                echo '<td style ="font-size:25px;"><i class="fas fa-times-circle"></i></td>';
            }
            echo "<td><button type='submit' name='impr' class='btn btn-primary'>Print</button></td>";
            echo"</form> ";
            echo"<form method='post' action='pdf.php'>";
            echo "<input type='hidden' name='idd' value='" . $row3["id"] . "'>";
            echo "<td>
            <div class='btn-group btn-group-sm' role='group' aria-label='Basic example'>
  <button type='button' class='btn btn-success' onclick=\"openStatusPage('$trakk')\">status au system</button>
  <button type='submit' class='btn btn-warning' type='button' name='found' >Colis Trouvé</button>
  <button type='submit' class='btn btn-danger' type='button' name='notfound' >Colis Introuvable</button>
</div>
            </td>";
            echo "<td>" . $row3["id"] . "</td>";
            
            echo "</tr>";
            echo"</form> ";
         
    }       
}
    }

    ?>
   <script>

function openStatusPage(trackingNumber) {
    // Redirect to the desired URL using JavaScript
    window.open(`https://yalidine.app/app/colis/index.php?source=cec&column=tracking&q=${trackingNumber}`);
}


  


  

    
</script>
</body>
</html>
