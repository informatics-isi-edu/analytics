<?php
require __DIR__ . '/../vendor/autoload.php';


$client_email = 'analytics@isi-analytics.iam.gserviceaccount.com';
$private_key = file_get_contents('key.p12');
$scopes = array('https://www.googleapis.com/auth/analytics.readonly');
$credentials = new Google_Auth_AssertionCredentials(
    $client_email,
    $scopes,
    $private_key
);

$client = new Google_Client();
$client->setAssertionCredentials($credentials);
if ($client->getAuth()->isAccessTokenExpired()) {
    $client->getAuth()->refreshTokenWithAssertion();
}

header('Content-Type: application/json');
echo $client->getAccessToken();