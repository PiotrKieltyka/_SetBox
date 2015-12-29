<?php

	session_start();

	if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
	{
		header('Location: setbox.php');
		exit();
	}

?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>SETBOX</title>

    <meta name="description" content="bla bla bla bla bla bla bla bla!" />
    <meta name="keywords" content="" />

    <link rel="stylesheet" href="style.css" type="text/css" />
    <link rel="stylesheet" href="css/fontello.css" type="text/css" />
    <link href='https://fonts.googleapis.com/css?family=Lato|Josefin+Sans&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
    <script src="timer.js"></script>


</head>
<body onload="odliczanie();">

<div id="nav">

    <ol>
        <li><a href="#">Strona główna</a></li>
        <li><a href="#">Techno</a>
            <ul>
                <li><a href="#">Adam Beyer</a></li>
                <li><a href="#">Chris Liebing</a></li>
                <li><a href="#"></a></li>
                <li><a href="#"></a></li>
            </ul>
        </li>
        <li><a href="#">House</a>
            <ul>
                <li><a href="#">Solomun</a></li>
                <li><a href="#"></a></li>
                <li><a href="#"></a></li>
                <li><a href="#"></a></li>
            </ul>
        </li>
        <li><a href="#">Goa/Psy Trance</a>
            <ul>
                <li><a href="#">Astral Projection</a></li>
                <li><a href="#"></a></li>
                <li><a href="#"></a></li>
                <li><a href="#"></a></li>
            </ul>
        </li>
        <li><a href="#">Drum'n'Bass</a>
            <ul>
                <li><a href="#">Aphrodite</a></li>
                <li><a href="#"></a></li>
                <li><a href="#"></a></li>
                <li><a href="#"></a></li>
            </ul>
        </li>
        <li><a href="#">O autorach</a></li>
    </ol>

</div>

 <div id="container">

     <div class="rectangle">
         <div id="logo">
             <img src="logofinal.png" height=100px>
         </div>
         <div id="zegar">12:00:00</div>
         <div style="clear: both;"></div>
     </div>

     <div class="square">

         <div class="tile1">
             <br /><form action="zaloguj.php" method="post">
                 Login  <input type="text" name="login" size="10"><br />
                 Haslo <input type="password" name="haslo" size="10"><br />
                 <input type="submit" value="Wyslij" class="button"><br />
                 <a href="register.php" class="button">Zarejestruj</a>
             </form>
             <?php if(isset($_SESSION['blad'])) echo $_SESSION['blad'] ?>
         </div>

         <div class="tile1">
             <a href="" class="tilelink"><i class="icon-headphones"></i> <br />Poznaj nowości</a>
             </div>
         <div style="clear: both;"></div>

         <div class="tile3">
             <a href="search.php" class="tilelink"><i class="icon-search"></i> <br />Szukaj</a>
         </div>

         <div class="tile3">
             <a href="" class="tilelink"><i class="icon-sellsy"></i> <br />Statystyki</a>
         </div>

         <div class="tile2">
             <a href="upload.php" class="tilelink"><i class="icon-upload-cloud"></i> <br />Upload</a>
         </div>

         <div class="tile2">
         <a href="download.php" class="tilelink"><i class="icon-download-cloud"></i> <br />Download</a>
        </div>

        <div class="tile6">

        </div>

     <div style="clear: both;"></div>

         <div class="yt">
             <a href="http://youtube.com" target="_blank" class="sociallink"><i class="icon-youtube-squared"></i></a>
         </div>
         <div class="fb">
             <a href="http://facebook.com" target="_blank" class="sociallink"><i class="icon-facebook"></i></a>
         </div>
         <div class="gp">
             <a href="http://plus.google.com" target="_blank" class="sociallink"><i class="icon-gplus"></i></a>
         </div>
         <div class="tw">
             <a href="http://twitter.com" target="_blank" class="sociallink"><i class="icon-twitter"></i></a>
         </div>

</div>
     <div class="square">
         <div class="tile5">
             Witaj w aplikacji SETBOX.<br />
                <br /> Aby sie zalogować wpisz swój login i haslo w lewym górnym BOXie.
                 <br /><br />

             <div id="ytplayer"></div>

             <script>
                 var tag = document.createElement('script');
                 tag.src = "https://www.youtube.com/player_api";
                 var firstScriptTag = document.getElementsByTagName('script')[0];
                 firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
                 var player;
                 function onYouTubePlayerAPIReady() {
                     player = new YT.Player('ytplayer', {
                         height: '350',
                         width: '425',
                         videoId: 'i7Zstp8jlgo',
                         playerVars: { 'autoplay': 0, 'start': 3890, 'controls': 1, 'fs': 0, 'showinfo': 0 }
                     });
                 }
             </script>
            <br /><br /> Po zalogowaniu będziesz miał dostęp do całej naszej biblioteki muzycznej.

         </div>
     </div>
     <div style="clear: both;"></div>

     <div class="rectangle">2015 &copy; Piotr Kiełtyka, Bartosz Wojciechowski - <a href="index.php" class="tilelinkhtml5">SETBOX</a>  <i class="icon-mail"></i></div>

 </div>

<script src="jquery-2.1.4.min.js"></script>

 <script>
     $(document).ready(function() {
         var stickyNavTop = $('#nav').offset().top;
         var stickyNav = function(){
             var scrollTop = $(window).scrollTop();
             if (scrollTop > stickyNavTop) {
                 $('#nav').addClass('sticky');
             } else {
                 $('#nav').removeClass('sticky');
             }
         };
         stickyNav();
         $(window).scroll(function() {
             stickyNav();
         });
     });
 </script>

</body>
</html>