# ArtistAlbumPlay
Implementation of Spotify's API to make listening to music dead simple again, meaning listening to your favorited albums from start to finish, provided
you've either deselected shuffle play or set that with an API Call, not included. 
Please contact me at [my personal website](https://dimitridarras.com) if you would like to see a demo or otherwise clone the droplet I host for the project.

This project uses Spotify's [Web API](https://developer.spotify.com/documentation/web-api/).  You will need a Spotify Account in order to access
the [Spotify Developer API Dashboard](https://developer.spotify.com/dashboard/).   When you create an app, you will have a key and token to use
with the API.   Pay attention to API limits and pagination: gettable album information caps out at 50 albums per request, for instance.  You will
need to make additional paginated requests to retrieve more data.

In brief, API calls are made to the album endpoint and converted to a JavaScript object for display with dropdowns populated by a user's given album list. 
This code is just for fleshing out a proof of concept and has not been vetted for quality.  There is an API call limit of 50 albums, which could be expanded with some parameters
but not without some tricky offsets.   Spotify should remove this limit or otherwise charge for it.

Special thanks to @nosmada and [jwilsson](https://github.com/jwilsson/spotify-web-api-php).    Spotify-web-api-php is not managed by composer
in this project although it should be.    For local development, I'm using [Lando](https://github.com/lando/lando), an awesome docker-based VM solution.

![Project homepage](/readme-assets/screenshot01.png)

Project homepage 

![Authenticated user](/readme-assets/screenshot02.png)

Authenticated user may access albums and click "Play on Spotify" to access the Spotify client (web or app)

![Spotify Developer Dashboard ](/readme-assets/dashboard.png)

Spotify Developer Dashboard to administer credentials and apps

