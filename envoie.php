<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="maincss.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>GUICHET ENVOIE CLASSIQUE</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  function Nouveauclientenvoie(){
    $.ajax({
url:'nouveau_clientenvoie.php',
type:'GET',
success:function(response){
    var data = JSON.parse(response);
    console.log(data);
    // Update your HTML elements with the retrieved data        
    $('#Smallestnumber').text('TICKET:  E '+ data.Smallestnumber);
    $('#enattente').text(' En Attente :' +data.enattente);
    localStorage.setItem('Smallestnumber', data.Smallestnumber);
localStorage.setItem('enattente', data.enattente);
}
} ) }
$(document).ready(function(){
    // Get the stored values
    var storedSmallestNumber = localStorage.getItem('Smallestnumber');
    var storedenattente =localStorage.getItem('enattente');
if(storedSmallestNumber){
    $('#Smallestnumber').text('TICKET:  E '+ storedSmallestNumber);
    $('#enattente').text(' En Attente :' +storedenattente);
}else{
    Nouveauclientenvoie();
}
});

  const webSocket = new WebSocket('ws://localhost:8080');
    webSocket.onopen = function (event) {
        console.log('WebSocket connection opened.');
    };

    webSocket.onerror = function (error) {
        console.error('WebSocket error: ' + error);
    };

    webSocket.onclose = function (event) {
        console.log('WebSocket connection closed.');
    };

    function prochaineClient(guichetNumber) {
        const SmallestnumberElement = document.getElementById('Smallestnumber');
    const Smallestnumber = SmallestnumberElement.textContent; // Get the value
        // Send the smallest number to the WebSocket server
        webSocket.send(`prochaineclientenvoie: Office ${guichetNumber}, ${Smallestnumber}`);
    }
</script>
</head
<body>
    <header>YALIDINE EXPRESS</header>
    <div class="guichet" style="margin-left:37%;">
        <h2 style="text-align: center; margin-top: 20px; ">Client Actuelle</h2>
        <p style="text-align: center; justify-content: center; font-size: 20px; font-style: italic; margin-top: 50px; margin-left:-30px;">
          <span id='Smallestnumber'></span><br>
          <span id='enattente'></span>
        </p>
    </div>
    <br>
    <br>
    <div class="d-grid gap-2 col-6 mx-auto" >
        <button class="btn btn-danger" type="submit" name="proch" onclick="prochaineClient(6); ">Apeller le Client</button>
       <button class="btn btn-danger" type="button" type="submit" name="rela" onclick="Nouveauclientenvoie()">Demande un Nouveau client</button>       
      
</div>
</body>
</html>
