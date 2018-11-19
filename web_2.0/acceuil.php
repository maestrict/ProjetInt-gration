<?php
session_start();
?>
<!DOCKTYPE html>
<html>
<head>
    <title>Acceuil</title>
    <meta name="viewport" content="width=device-width , initial-scale=1" />
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/utils.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body onload="getEvent('terrain')">
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

<div class="container">
    <section id="terrain">

    </section>
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