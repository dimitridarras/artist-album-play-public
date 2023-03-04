<?php

require 'vendor/autoload.php';

$session = new SpotifyWebAPI\Session(
    'FROM-SPOTIFY-API_DASHBOARD',
    'FROM-SPOTIFY-API_DASHBOARD',
    'YOUR+DOMAIN+callback.php'
);

// Request a access token using the code from Spotify
$session->requestAccessToken($_GET['code']);

/*
$accessToken = $session->getAccessToken();
$refreshToken = $session->getRefreshToken();
*/

// Store the access and refresh tokens somewhere. In a database for example.

session_start();
$_SESSION['access'] = $session->getAccessToken();
$_SESSION['token'] = $session->getRefreshToken();



// Send the user along and fetch some data!
header('Location: app.php');
die();

?>