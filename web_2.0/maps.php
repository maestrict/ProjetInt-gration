<?php
session_start();
require_once('assets/php/request.php');
require_once('assets/php/utils.php');
$terrains = terrain('get');
?>
<!DOCTYPE html>
<html>
<head>
    <title>recherche Terrain</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <script src="assets/js/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"
    integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E=" crossorigin="anonymous"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=[apiKey]&callback=getLocation"></script>
    <link rel='stylesheet' href='fullcalendar/fullcalendar.css' />
    <script src='fullcalendar/lib/jquery.min.js'></script>
    <script src='fullcalendar/lib/moment.min.js'></script>
    <script src='fullcalendar/fullcalendar.js'></script>
    <script src='fullcalendar/locale-all.js'></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="assets/js/maps.js"></script>
    <script src="assets/js/utils.js"></script>
</head>
<body onload="getEvent('donne')">
<nav class='navbar navbar-expand-sm navbar-light bg-light'>
    <button class="navbar-toggler" type="button" data-toggle="collapse"
            data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item"><a class="nav-link" href="acceuil.php">Acceuil</a></li>
            <li class="nav-item"><a class="nav-link" href="maps.php">Recherche terrain</a></li>
            <li class="nav-item"><a class="nav-link" href="terrain.php">Recherche partenaire</a></li>
            <li class="nav-item"><a class="nav-link" href="compte.php">Mon Compte</a></li>
        </ul>
        <ul class="navbar-nav my-2 my-lg-0">
            <li class="nav-item"><a class="nav-link" href="login.php">Connection</a></li>
            <li class="nav-item"><a class="nav-link" href="signup.php">S'inscrire</a></li>
        </ul>
    </div>
</nav>
<div class="container-fluid">
    <div class="row">
        <div id="map" class="col-lg"><input type="button" onclick="myMap()" value="load map"></div>
        <div id="tbTerrain" class="col-md">
            <form method="post" name="filtre">
                <select id="address" onchange="updateTable(this)">
                    <option value="" disabled selected>address</option>
                    <?php
                    foreach ($terrains as $terrain => $test){
                        echo"<option value='{$terrains[$terrain]['address']}'>{$terrains[$terrain]['address']}</option>";
                    }
                    ?>
                </select>
                <select id="sport" onchange="updateTable(this)">
                    <option value="" disabled selected>sport</option>
                    <?php
                    foreach ($terrains as $terrain => $test){
                        echo"<option value='{$terrains[$terrain]['sport']}'>{$terrains[$terrain]['sport']}</option>";
                    }
                    ?>
                </select>
                <select id="club" onchange="updateTable(this)">
                    <option value="" disabled selected>nom du club</option>
                    <?php
                    foreach ($terrains as $terrain => $test){
                        echo"<option value='{$terrains[$terrain]['Name']}'>{$terrains[$terrain]['Name']}</option>";
                    }
                    ?>
                </select>
            </form>
            <div id="donne">

            </div>
            <div id="calendar">

            </div>
        </div>
    </div>
</div>
<footer class="footer bg-light">
    <ul class="icons">
        <li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
        <li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
        <li><a href="#" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
        <li><a href="#" class="icon fa-dribbble"><span class="label">Dribbble</span></a></li>
        <li><a href="#" class="icon fa-envelope-o"><span class="label">Email</span></a></li>
    </ul>
</footer>
</body>
</html>
