<?php
require 'vendor/autoload.php'; // Make sure to adjust the path if necessary

$client = new Google_Client();
$client->setClientId('client id'); // Replace with your Client ID
$client->setClientSecret('client secret'); // Replace with your Client Secret
$client->setRedirectUri('http://localhost/loginpage/google-signin-handler.php'); // Your redirect URI
$client->addScope('email');
$client->addScope('profile');

// Generate Google OAuth URL and echo it as the response
$loginUrl = $client->createAuthUrl();
echo $loginUrl;
?>
