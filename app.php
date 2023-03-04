<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>ArtistAlbumPlay - Powered by Spotify | Find Your Favorite Artist's Albums</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
		    <meta name="description" content="Find All your Favorite Spotify Artist Albums in one Easy-to-use place">
		    <meta name="keywords" content="Spotify Albums, How to find Spotify Artist Albums, Reasoning With Machines, ArtistAlbumPlay">
		    <meta name="author" content="Reasoning With Machines">      
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
        <link href="css/themify-icons.css" rel="stylesheet" type="text/css" media="all" />
        <link href="css/flexslider.css" rel="stylesheet" type="text/css" media="all" />
        <link href="css/lightbox.min.css" rel="stylesheet" type="text/css" media="all" />
        <link href="css/ytplayer.css" rel="stylesheet" type="text/css" media="all" />
        <link href="css/theme-nearblack.css" rel="stylesheet" type="text/css" media="all" />
        <link href="css/font-dosis.css" rel="stylesheet" type="text/css" media="all" />
        <link href="css/custom.css" rel="stylesheet" type="text/css" media="all" />
        <link href='http://fonts.googleapis.com/css?family=Lato:300,400%7CRaleway:100,400,300,500,600,700%7COpen+Sans:400,500,600' rel='stylesheet' type='text/css'>
        <link href="http://fonts.googleapis.com/css?family=Dosis:100,300,400,600,700" rel="stylesheet" type="text/css">
   	
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-178916412-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-xxxxxxxxx-x');
</script>

      </head>
<?php
require 'vendor/autoload.php';
session_start();
  $access = $_SESSION['access'];
  $accessToken = $_SESSION['token'];
  $api = new SpotifyWebAPI\SpotifyWebAPI();
  // Fetch the saved access token from somewhere. A database for example.
  $api->setAccessToken($access); 
  $result = $api->getMySavedAlbums($options = ['limit' => 50]  );
  //echo("<PRE>".json_encode($result)."</PRE>");
?>

<body class="scroll-assist">
    <div class="foundry_modal no-bg">
        <iframe data-provider="youtube" data-video-id="rkcOA16XjCw" data-autoplay="1"></iframe>
    </div>
    <div class="nav-container">
            <a id="top"></a>
            <nav class="absolute transparent">     
            </nav>
        </div>
<?php
// See $result block below
$artist_arrays = array();
$album_arrays = array();
$link_arrays = array();
    for ($i = 0;$i<40; $i++) {
      if (isset($result->items[$i]->album->tracks->items[0]->artists[0]->name)) {
      array_push($artist_arrays,$result->items[$i]->album->tracks->items[0]->artists[0]->name);
      array_push($album_arrays,$result->items[$i]->album->name);
      array_push($link_arrays, $result->items[$i]->album->external_urls->spotify);   
      }    
    }
    $result = array_map(function ($artist_array, $album_array, $link_array) {
      return array_combine(
        ['artist', 'album', 'link'],
        [$artist_array, $album_array, $link_array]
      );
    }, $artist_arrays, $album_arrays, $link_arrays);
   $result_count = count($result);
   $result_normalized = []; 
    for ($i = 0; $i < $result_count; $i++) {  
       if ($result[$i]["artist"] !== null) {
        array_push($result_normalized,$result[$i]);       
        }
 }
?>

<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script type="text/javascript">
    var associated_album_array = <?php echo json_encode($result_normalized);  ?>;
    console.log(associated_album_array);
    if(associated_album_array.length < 1 || associated_album_array == undefined){
    //alert("empty");
   document.getElementById("message").innerHTML = "<a href='https://open.spotify.com/'>Like &#9829; an album on Spotify</a> first! <a href='#'>How do I do that?</a>";
}
    let normalized_associated_album_array = [];
      for (let i = 0; i < associated_album_array.length; i++) {
          if (associated_album_array[i].artist !== null) {
            normalized_associated_album_array.push(associated_album_array[i]);
          }
      }
//console.log("Normalized array length: "+normalized_associated_album_array.length);
    const reduced = normalized_associated_album_array;
    var filteredArr = reduced.reduce((acc, current) => {
    const x = acc.find(item => item.artist === current.artist);
    if (!x) {
      return acc.concat([current]);
    } else {
      return acc;
    }
  }, []);
  filteredArr.push({'artist':'Select an Artist', 'album':'Select an Album', 'link':'Select an Artist First!'});
</script>

<div class="main-container">

<section class="bg-primary pb160 pt-xs-80 pb-xs-80" style="padding:20px;">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                 
            <p class="mb64 mb-xs-24 text-center">
        <a href="logout.php">Log out</a>
</p>                      
<h2 class="uppercase mb40 mb-xs-24 text-center">Artist/Album/Play<sup style="font-size:12px;vertical-align: top;">Beta</sup> </h2>
            <h5 class="uppercase mb32" style="margin-top:-20px;">Powered by Spotify</h5>

    <img src="img/Spotify_Icon_RGB_Whites.png" width="15%" style="padding-bottom:20px;margin-top:-20px;">
      
                <h4 class="uppercase thin mb40 mb-xs-24">Welcome  <span style:"font-weight:600;"><?php $me = $api->me();echo $me->display_name; ?></span><br>
                 Scroll Down For Your Albums</h2>
                <h5>
                     
               
              
                                            <div class="modal-container mb0">Like ♥ an album on Spotify first!  
             
                </div>
            </div>
        </div>
        <!--end of row-->
    </div>
    <!--end of container-->
</section>

<section class="bg-primary pb120 pb-xs-80">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-10 col-sm-offset-1 col-md-offset-0" id="lets_go">
                                    <p class="mb64 mb-xs-24 text-right">
  <a href="https://www.spotify.com/us/">Sign up for Spotify</a> |  <a href="logout.php">Log out</a>
</p>                      
                <h2 class="uppercase mb40 mb-xs-24 text-center">Let's Go!</h2>
                         <h5 id="message" class="uppercase mb40 mb-xs-24 text-center"></h5>
                <hr class="mb40 mb-xs-24 fade-half">
                  <div class="col-md-12 text-right"><select id="artist_dropdown"><option value="init">Select an Artist</option></select> </div>   
                  <hr class="mb40 mb-xs-24 fade-half">
                  <div class="col-md-12 text-right"> <select id="album_dropdown"><option value="init">Select an Album</option></select> </div>   
     <hr class="mb40 mb-xs-24 fade-half">    
     <div class="col-md-12 text-right">
                                <a class="btn btn-sm btn-white mt8" href="#" style="text-decoration:none;" id="album_link">Play on Spotify</a>
                            </div>   
            <div><br><br>  <br><br>  <br><br>  
              A <a href="https://reasoningwithmachines.org?aap" target="_new">Reasoning With Machines Hosted Project</a> - Version 0.3
              <br><br>
              Special Thanks to jwilsson and <a href="https://github.com/jwilsson/spotify-web-api-php" target="_new">spotify-web-api-php</a> and <a href="https://github.com/nosmada"  target="_new">Nosmada</a>. without whom this could not 
              have happened.   Two thumbs up for Spotify for giving the monopolies a black eye and a professional API to play with.
            </div>                                                       
            </div>

        </div>
        <!--end of row-->
    </div>
    <!--end of container-->
</section>

<section class="pt0 pb0 bg-primary">
    <div class="instafeed grid-gallery gapless" data-user-name="mrareweb">
        <ul class="fade-on-hover"></ul>
    </div>
</section>
</div>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/flickr.js"></script>
<script src="js/flexslider.min.js"></script>
<script src="js/lightbox.min.js"></script>
<script src="js/masonry.min.js"></script>
<script src="js/twitterfetcher.min.js"></script>
<script src="js/spectragram.min.js"></script>
<script src="js/ytplayer.min.js"></script>
<script src="js/countdown.min.js"></script>
<script src="js/smooth-scroll.min.js"></script>
<script src="js/parallax.js"></script>
<script src="js/scripts.js"></script>

<div class="modal-container">


</div>        

<script>
PopulateDropDownList();
/* need a more elegant way to call the function - also provision for default album value */
function PopulateDropDownList() {
  //filteredArr.push({'artist':'Select and Artist', 'album':'Select an Album', 'link':'Select an Artist First!'});
  var artist_dropdown = document.getElementById("artist_dropdown");
  for (var i = 0; i < filteredArr.length; i++) {
    var option =  document.createElement("OPTION");
    option.innerHTML="Select an Artist"; 
    option.innerHTML = filteredArr[i].artist;
    //console.log(filteredArr[i].album);
    option.value = filteredArr[i].artist;
    artist_dropdown.options.add(option);  
 
    //filteredArr[i].link;
            }    
        }
</script>

<script>
$("#artist_dropdown").on('change', function(){
  var album_dropdown = document.getElementById("album_dropdown");
  var album_option =  document.createElement("OPTION");
  var album_option =  document.createElement("OPTION");
  album_dropdown.options.remove(album_option);
  var option_selected = artist_dropdown.value;
  album_dropdown_funct(option_selected);
  }
);
</script>

<script>
function album_dropdown_funct(option_selected) {

  $('#album_dropdown').empty();
  document.getElementById("album_link").innerHTML =  "";

  let redCars = normalized_associated_album_array.filter(normalized_associated_album_array => normalized_associated_album_array.artist == artist_dropdown.value);
  console.log("Using an array filter: "+JSON.stringify(redCars));
  console.log("Loop paramenter: "+redCars.length);

  for (j = 0; j < redCars.length; j++)
    {
    
    //console.log("foo");
    
    var album_dropdown = document.getElementById("album_dropdown");
    var album_option =  document.createElement("OPTION");
    //album_dropdown.options.remove(album_option);
    album_option.innerHTML = redCars[j].album;
    album_option.value = redCars[j].link;
    //var my_link = redCars[j].link;
    //album_option.value = myResults[j].album;
     album_dropdown.options.add(album_option);

     //alert(filteredArr[j].link);
    }
  }
  //alert(album_dropdown.value);  

  $("#artist_dropdown").on('change', function(){

  the_link();

});
 
  $("#album_dropdown").on('change', function(){

    the_link();

  });
</script>

<script>
function the_link(){
  document.getElementById("album_link").innerHTML = "";
  var link_to_render =  album_dropdown.value;
  var a = document.createElement('a');
      var linkText = document.createTextNode("Play on Spotify!");
      a.appendChild(linkText);
      a.title = "Play your selection on Spotify";
      a.href = link_to_render;
      document.getElementById("album_link").appendChild(a);

}
</script>



</body>
</html>