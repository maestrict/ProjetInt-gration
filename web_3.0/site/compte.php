<?php
session_start();
require 'assets/php/secure.inc.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Compte</title>
    <meta name="viewport" content="width=device-width , initial-scale=1" />
    <meta name="theme-color" content="#317EFB"/>
    <meta name="Description" content="page compte avec les infos de l'utilisateur">
    <link rel="shortcut icon" type="image/x-icon" href="/assets/img/logo_trans.ico">
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/utils.js"></script>
    <script async src='fullcalendar/lib/jquery.min.js'></script>
    <script async src='fullcalendar/lib/jquery-ui.min.js'></script>
    <script async src='fullcalendar/lib/moment.min.js'></script>
    <script async src='fullcalendar/fullcalendar.js'></script>
    <script async src='fullcalendar/locale-all.js'></script>
    <link rel='stylesheet' href='fullcalendar/fullcalendar.css'/>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body onload="load('contain', 'profil')">
<?php
    require 'assets/php/menu.inc.php';
?>
<main>
    <div class="container">
        <div class="row">
            <div class="col-md-auto btn-group-vertical">
                <span class="btn btn-outline-primary active">
                <?php
                echo(isset($_SESSION['user'])?"sportif":"club");
                ?>
                </span><br>
                <input type="button" class="btn btn-outline-secondary" value="Mon profil" onclick="load('contain', 'profil')"><br>
                <?php
                if(isset($_SESSION['user'])){
                    echo("<input type='button' class='btn btn-outline-secondary' value='Mes réservations' onclick=\"load('contain', 'reserve')\"><br>");
                    echo("<input type=\"button\" class=\"btn btn-outline-secondary\" value=\"Mes partenaires\" onclick=\"load('contain', 'partenaire')\"><br>");
                }else{
                    echo("<input type=\"button\" class=\"btn btn-outline-secondary\" value=\"Mes Terrains\" onclick=\"location.href='/possession.php';\"><br>");
                }
                ?>
            </div>
            <div class="col">
            <section id="contain">

            </section>
            </div>
        </div>
    </div>
</main>
<?php
    require 'assets/php/footer.inc.php'
?>
</body>
</html>