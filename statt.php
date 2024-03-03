<?php
// Now, perform another cURL request to fetch the status using the authenticated session
$statusUrl = "https://yalidine.app/app/colis/index.php?source=cec&column=tracking&q=yal-67MNWW";  // Replace with the actual status URL
$ch = curl_init($statusUrl);

// Set cURL options for status retrieval
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookies.txt');  // Use the saved cookies for authentication

// Execute cURL for status retrieval
$status = curl_exec($ch);

// Check for cURL errors
if (curl_errno($ch)) {
    echo 'Error fetching status: ' . curl_error($ch);
} else {
    echo 'Status retrieval successful:';
    echo $status;
}

// Close cURL session
curl_close($ch);
?>
