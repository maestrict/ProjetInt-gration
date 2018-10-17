<?php
session_start();
require_once('assets/php/utils.php');
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>sign up</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
</head>
<body class="is-preload">

<!-- Page Wrapper -->
<div id="page-wrapper">

    <!-- Header -->
    <header id="header">
        <h1>Compte</h1>
        <nav id="nav">
            <ul>
                <li class="special">
                    <a href="#menu" class="menuToggle"><span>Menu</span></a>
                    <div id="menu">
                        <ul>
                            <li><a href="index.php">déconnection</a></li>
                            <li><a href="compte.php">Home</a></li>
                            <li><a href="#">Compte</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </nav>
    </header>

    <!-- Main -->
    <article id="main">
        <section class="wrapper compte">
            <div id="compte">
                <p>voici les données de votre compte</p>
                <form action="" method="post" id="formCompte">
                    <div id="data">
                        <input type="text" name="nom" placeholder="nom" value="<?= $_SESSION['user']['LastName'];?>" maxlength="20" required>
                        <input type="text" name="prenom" placeholder="prenom" value="<?= $_SESSION['user']['FirstName'];?>" maxlength="20" required>
                        <input type="text" name="pseudo" placeholder="pseudo" value="<?= $_SESSION['user']['userPseudo'];?>" maxlength="20" required>
                        <input type="password" name="mdp" placeholder="mdp" value="<?= $_SESSION['user']['mdp'];?>" maxlength="50" required>
                        <input type="text" name="date" id="date" value="<?= $_SESSION['user']['dateBirth'];?>" placeholder="date">
                        <input type="text" name="email" placeholder="email" value="<?= $_SESSION['user']['mail'];?>" maxlength="25" required>
                    </div>
                    <div id="img">
                        <img src="images/avatar.jpg" id="avatar" onclick="chg_img()">
                    </div>
                    <div id="sub_compte">
                        <input type="submit" name="test" value="sauvegarder">
                    </div>
                </form>
            </div>
        </section>
    </article>

    <!-- Footer -->
    <footer id="footer">
        <ul class="icons">
            <li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
            <li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
            <li><a href="#" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
            <li><a href="#" class="icon fa-dribbble"><span class="label">Dribbble</span></a></li>
            <li><a href="#" class="icon fa-envelope-o"><span class="label">Email</span></a></li>
        </ul>
        <ul class="copyright">
            <li>&copy; Untitled</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
        </ul>
    </footer>

</div>

<!-- Scripts -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/jquery.scrollex.min.js"></script>
<script src="assets/js/jquery.scrolly.min.js"></script>
<script src="assets/js/browser.min.js"></script>
<script src="assets/js/breakpoints.min.js"></script>
<script src="assets/js/util.js"></script>
<script src="assets/js/main.js"></script>
<script src="assets/js/utils.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="assets/js/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $(function(){
        $("#date").datepicker({maxDate: -1, dateFormat:"dd/mm/yy"}).attr("autocomplete","off").prop('max', function(){
            return new Date().toJSON().split('T')[0];
        });
    });
</script>

</body>
</html>