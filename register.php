<?php
    session_start();

    if(isset($_POST['email'])) {

        $wszystko_OK = true;

        $login = $_POST['login'];
        if((strlen($login)<3) || (strlen($login)>20)) { $wszystko_OK = false; $_SESSION['e_login'] = "Login musi posiadać od 3 do 20 znaków"; }
        if(ctype_alnum($login)==false) { $wszystko_OK = false; $_SESSION['e_login'] = "Login może składać się tylko z liter i cyfr (bez polskich znaków)"; }

        $email = $_POST['email'];
        $emailB = filter_var($email,FILTER_SANITIZE_EMAIL);
        if((filter_var($emailB, FILTER_VALIDATE_EMAIL) == false) || ($emailB!=$email)) { $wszystko_OK = false; $_SESSION['e_email'] = "Podaj poprawny adres email"; }

        $haslo1 = $_POST['haslo1'];
        $haslo2 = $_POST['haslo2'];
        if((strlen($haslo1)<8 || (strlen($haslo1)>20))) { $wszystko_OK = false; $_SESSION['e_haslo'] = "Hasło musi posiadać od 8 do 20 znaków"; }
        if($haslo1 != $haslo2) { $wszystko_OK = false; $_SESSION['e_haslo'] = "Podane hasła nie są takie same"; }

        $haslo_hash = password_hash($haslo1, PASSWORD_DEFAULT);

        if(!isset($_POST['regulamin'])) { $wszystko_OK = false; $_SESSION['e_regulamin'] = "Potwierdź akceptację regulaminu"; }

        require_once "connect.php";
        mysqli_report(MYSQLI_REPORT_STRICT);
        try { $polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
            if($polaczenie->connect_errno!=0) { throw new Exception(mysqli_connect_errno()); }
            else {
                $rezultat = $polaczenie->query("SELECT id FROM users WHERE email='$email'");
                if(!$rezultat) throw new Exception($polaczenie->error);
                $ile_takich_maili = $rezultat->num_rows;
                if($ile_takich_maili>0) { $wszystko_OK = false; $_SESSION['e_email'] = "Istnieje już konto przypisane do tego adresu e-mail"; }

                $rezultat = $polaczenie->query("SELECT id FROM users WHERE login='$login'");
                if(!$rezultat) throw new Exception($polaczenie->error);
                $ile_takich_loginow = $rezultat->num_rows;
                if($ile_takich_loginow>0) { $wszystko_OK = false; $_SESSION['e_login'] = "Istnieje już konto przypisane do tego loginu"; }

                if($wszystko_OK == true) {
                    if($polaczenie->query("INSERT INTO users VALUES(NULL, '$login', '$haslo_hash', '$email', 14)")) {
                        $_SESSION['udana_rejestracja'] = true;
                        header('Location:index.php');
                    }
                    else {
                        throw new Exception($polaczenie->error);
                    }
                }

                $polaczenie->close();
            }

            }
        catch (Exception $e) {
            echo '<span style="color: red;">Blad serwera';
            }
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
            <a href="profile.php" class="tilelink"><i class="icon-cog-alt"></i> <br />Twój Profil</a>
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
            <form method="post">
                Podaj swój login <input type="text" name="login"><br />
                <? if(isset($_SESSION['e_login'])) { echo '<div class="error">'.$_SESSION['e_login'].'</div>'; unset($_SESSION['e_login']); } ?>
                Wpisz swój email <input type="email" name="email"><br />
                <? if(isset($_SESSION['e_email'])) { echo '<div class="error">'.$_SESSION['e_email'].'</div>'; unset($_SESSION['e_email']); } ?>
                Wpisz swoje hasło <input type="password" name="haslo1"><br />
                Powtórz swoje hasło <input type="password" name="haslo2"><br />
                <? if(isset($_SESSION['e_haslo'])) { echo '<div class="error">'.$_SESSION['e_haslo'].'</div>'; unset($_SESSION['e_haslo']); } ?>
                <label><input type="checkbox" name="regulamin" />Akceptuję regulamin<br /></label>
                <? if(isset($_SESSION['e_regulamin'])) { echo '<div class="error">'.$_SESSION['e_regulamin'].'</div>'; unset($_SESSION['e_regulamin']); } ?>
                <input type="submit" value="Zarejestruj się">
            </form>
            <br /><br />

            <br /><br />

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