<?php
// charles-blog auth
// https://console.cloud.google.com/apis/credentials/consent?project=charles-blog-197113
//Make object of Google API Client for call Google API
$google_client = new Google_Client();

//Set the OAuth 2.0 Client ID
$google_client->setClientId('542055273175-pg0da75uadekglvtearcnetvpprooked.apps.googleusercontent.com');

//Set the OAuth 2.0 Client Secret key
$google_client->setClientSecret('lwf4CoePFQ0-Gv9JM6e4c6JB');

//Set the OAuth 2.0 Redirect URI
$google_client->setRedirectUri('https://portal.medicalexamscenter.com/register-google');

//$google_client->setRedirectUri('https://localhost/JUMP/neac.localhost/register-google');

$google_client->addScope('email');
$google_client->addScope('profile');

?>