<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, height=device-height,initial-scale=1.0 ,minimum-scale:1.0">
<link rel="shortcut icon" href="/proj/queue.svg" type="image/x-icon" />    
<link rel="stylesheet" href="maincss.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>GUICHET</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        const webSocket = new WebSocket('ws://localhost:8080');
    webSocket.onopen = function (event) {
        console.log('WebSocket connection opened.');
    };

    webSocket.onerror = function (error) {
        console.error('WebSocket error: ' + error);
    };

    webSocket.onclose = function (event) {
        console.log('WebSocket connection closed.');
        location.reload();
    };

function Nouveauclient(guichetNumber) {
    $.ajax({
        url: 'nouveau_client.php',
        type: 'GET',
        success: function(response) {
            var data = JSON.parse(response);
            console.log(data);
            // Update your HTML elements with the retrieved data
            $('#smallestNumber').text('TICKET: R ' + data.smallestNumber);
            $('#trackaffich').text('TRACKING: ' + data.trackaffich);
            $('#EnAttente').text(' En Attente : ' + data.EnAttente); 
            // Store data in localStorage
            try {
    localStorage.setItem('smallestNumber', data.smallestNumber);
    localStorage.setItem('trackaffich', data.trackaffich);
    localStorage.setItem('EnAttente', data.EnAttente);
} catch (e) {
    console.error('Local Storage Error:', e);
}
const smallestNumberElement = document.getElementById('smallestNumber');
    const smallestNumber = smallestNumberElement.textContent;
     // Get the value

    if(data.smallestNumber !== null){
    webSocket.send(`Prochaine Client: Office ${guichetNumber},  ${smallestNumber}`);
    location.reload();
    }
    else{
        console.log('Prochaine Client Error');
    } 
    },
        error: function(xhr, status, error) {
            console.error('Error:', status, error);
        }
    });
}

var storedSmallestNumber;
var rap;
// Retrieve the data from localStorage when the page loads
$(document).ready(function() {
    // Get the stored values
    storedSmallestNumber= localStorage.getItem('smallestNumber');
    var storedTrackaffich = localStorage.getItem('trackaffich');
    var storedEnAttente = localStorage.getItem('EnAttente');

    // Check if the values are available in localStorage
    if (storedSmallestNumber || storedTrackaffich || storedEnAttente) {
        // Update your HTML elements with the retrieved data
        $('#smallestNumber').text('TICKET: R ' + storedSmallestNumber);
        $('#trackaffich').text('TRACKING: ' + storedTrackaffich);
        $('#EnAttente').text('En Attente: '+ storedEnAttente);
        rap = 'TICKET: R ' + storedSmallestNumber;
    } else {
        
    }
    document.getElementById('officeSelect').addEventListener('change', function () {
      
        var selectedOffice = document.getElementById('officeSelect').value;

        
        try {
            localStorage.setItem('selectedOffice', selectedOffice);
        } catch (e) {
            console.error('Local Storage Error:', e);
        }
    });

 
    document.addEventListener('DOMContentLoaded', function () {
        var storedSelectedOffice = localStorage.getItem('selectedOffice');

       
        if (storedSelectedOffice) {
            document.getElementById('officeSelect').value = storedSelectedOffice;
        }
    });   

});   
function Rappel(guichetNumber){
    webSocket.send(`Prochaine Client: Office ${guichetNumber},  ${rap}`);
}




</script>
</head>
<body>
    <header>YALIDINE EXPRESS</header>
    <div class="guichet" style=" margin-left:37% ;">
        <h2 style="text-align: center; margin-top: 20px; font-weight: bold; ">Client Actuelle</h2>
        <p style="text-align: center; justify-content: center; font-size: 20px; font-style: italic; margin-top: 50px; margin-left:-30px;">
        <span id="smallestNumber"></span><br>
            <span id="trackaffich"></span><br>
            <span id="EnAttente"></span><br>
            <span id="#queuefull"></span>
        </p>
    </div>
    <br>
    <br>
    <div class="d-grid gap-2 col-6 mx-auto" >
        <button class="btn btn-danger" type="submit" name="rela" onclick="Nouveauclient(document.getElementById('officeSelect').value); playAudio();"> Demande Nouveau Client</button>
        <button class="btn btn-success" type="submit" name="rela" onclick="Rappel(document.getElementById('officeSelect').value); playAudio();"> Rappel de Client </button>
        <div class="d-grid gap-2 col-6 mx-auto">
            <label for="officeSelect" style=" font-size: 20px; font-weight:bold;  ">Sélectionner Mon Guichet:</label>
            <select id="officeSelect" style="background-color:crimson; border-radius: 10px; color: whitesmoke; height: 50px; text-align: center;" >
                <option value="1">Guichet 1</option>
                <option value="2">Guichet 2</option>
                <option value="3">Guichet 3</option>
                <option value="4">Guichet 4</option>
                <option value="5">Guichet 5</option>
            </select>
        </div>   
</div>

</body>
</html>
