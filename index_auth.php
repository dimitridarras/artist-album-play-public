<?php

require 'vendor/autoload.php';

$session = new SpotifyWebAPI\Session(
    'FROM-SPOTIFY-API_DASHBOARD',
    'FROM-SPOTIFY-API_DASHBOARD',
    'YOUR+DOMAIN+callback.php'
);

$options = [
    'scope' => [
        'playlist-read-private',
        'user-read-private',
        'user-library-read',
        'user-library-modify',
    ],
];

header('Location: ' . $session->getAuthorizeUrl($options));
die();

?>
