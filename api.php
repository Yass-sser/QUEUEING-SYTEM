<?php
// Authentication credentials for the separate system
$loginUrl = 'https://yalidine.app/app/login.php';  // Replace with the actual login URL
$loginData = array(
    'username' => 'b.bouzid@yalidine.com',
    'password' => 'pJX4Kju7Txzvw'
);

// Create a new cURL resource for login
$ch = curl_init($loginUrl);

// Set cURL options for login
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $loginData);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookies.txt');  // Save cookies to a file for subsequent requests

// Execute cURL for login
$result = curl_exec($ch);

// Check for cURL errors during login
if (curl_errno($ch)) {
    echo 'Login failed: ' . curl_error($ch);
    exit;
}

// Close cURL session for login
curl_close($ch);

// Now, perform another cURL request to fetch the status using the authenticated session
$statusUrl = "https://yalidine.app/app/colis/index.php?source=cec&column=tracking&q=yal-67MNWW";  // Replace with the actual status URL
$ch = curl_init($statusUrl);

// Set cURL options for status retrieval
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookies.txt');  // Use the saved cookies for authentication

// Execute cURL for status retrieval
$status = curl_exec($ch);

// Check for cURL errors during status retrieval
if (curl_errno($ch)) {
    echo 'Error fetching status: ' . curl_error($ch);
    exit;
}

// Close cURL session for status retrieval
curl_close($ch);
// Update the regular expression based on the actual HTML structure
preg_match('/<title>(.*?)<\/title>/i', $status, $titleMatches);


// Display only the title of the page
if (isset($titleMatches[1])) {
    echo 'Title retrieval successful:';
    echo $titleMatches[1];
} else {
    echo 'Unable to extract title from the page.';
}
?>
