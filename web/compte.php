<?php
session_start();
require_once('assets/php/utils.php');
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>compte</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <link rel="stylesheet" href="assets/css/style.css" />
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
                            <li><a href="sport.php">sport</a></li>
                            <?php
                            if(isset($_SESSION['club'])) {
                                echo"<li><a href = \"terrain.php\"> gestion des terrains </a></li>";
                            }
                            ?>
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
                    <div class="left">
                        <?php
                        if(isset($_SESSION['user'])){
                            //<input type="password" name="mdp" placeholder="mdp" value="{$_SESSION['user']['mdp']}" maxlength="50" required>
                            $form = <<<EOT
                            <table>
                                <tr>
                                    <td>
                                        <label for="nom">Nom: </label>
                                    </td>
                                    <td>
                                        <input type="text" name="nom" id="nom" placeholder="nom" value="{$_SESSION['user']['LastName']}" maxlength="20" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="prenom">Prenom: </label>
                                    
                                    </td>
                                    <td>
                                        <input type="text" name="prenom" id="prenom" placeholder="prenom" value="{$_SESSION['user']['FirstName']}" maxlength="20" required>
                                    </td>
                                </tr>    
                                <tr>
                                    <td>
                                        <label for="pseudo">Pseudo: </label>
                                    </td>
                                    <td>
                                        <input type="text" name="pseudo" id="pseudo" placeholder="pseudo" value="{$_SESSION['user']['userPseudo']}" maxlength="20" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="date">Date de naissance: </label>
                                    </td>
                                    <td>
                                        <input type="text" name="date" id="date" value="{$_SESSION['user']['dateBirth']}" placeholder="date">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="email">Mail: </label>
                                    </td>
                                    <td>
                                        <input type="text" name="email" id="email" placeholder="email" value="{$_SESSION['user']['mail']}" maxlength="25" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="address">Address: </label>
                                    </td>                                
                                    <td>
                                        <input type="text" name="address" id="address" placeholder="address" value="{$_SESSION['user']['address']}">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="zipCode">Code Postal: </label>
                                    </td>                                
                                    <td>
                                        <input type="text" name="zipCode" id="zipCode" placeholder=0 value="{$_SESSION['user']['zipCode']}">
                                    </td>
                                </tr>
                                </table>
EOT;
                        }else{
                            //<input type="password" name="mdp" placeholder="mdp" value="{$_SESSION['club']['mdp']}" maxlength="50" required>
                            $form = <<<EOT
                            <table>
                                <tr>
                                    <td>                            
                                        <label for="nom">Nom: </label>
                                    </td>
                                    <td>
                                        <input type="text" name="nom" id="nom" placeholder="nom" value="{$_SESSION['club']['Name']}" maxlength="20" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                    <label for="pseudo">Pseudo: </label>                            
                                    </td>
                                    <td>
                                        <input type="text" name="pseudo" id="pseudo" placeholder="pseudo" value="{$_SESSION['club']['clubPseudo']}" maxlength="20" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>                            
                                        <label for="tel">Telephone: </label>
                                    </td>
                                    <td>
                                        <input type="text" name="tel" id="tel" placeholder="telephone" value="{$_SESSION['club']['telephone']}" maxlength="50">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="email">Mail: </label>
                                    </td>
                                    <td>    
                                        <input type="text" name="email" id="email" placeholder="email" value="{$_SESSION['club']['mail']}" maxlength="25" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="address">Address: </label>    
                                    </td>
                                    <td>
                                        <input type="text" name="address" id="address" placeholder="address" value="{$_SESSION['club']['address']}">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="zipCode">Code Postal:</label>
                                    </td>
                                    <td>
                                        <input type="text" name="zipCode" id="zipCode" placeholder="0" value="{$_SESSION['club']['zipCode']}">
                                    </td>
                                </tr>
                            </table>
EOT;
                        }
                        echo $form;
                    ?>
                    </div>
                    <div class="right">
                        <img src="images/avatar.jpg" id="avatar" onclick="chg_img()">
                        <?php
                        if(isset($_SESSION['club'])){
                            $donnee = <<<EOT
                            <br><a href="terrain.php">gestion des terrains</a>
EOT;
                        }
                        echo $donnee;
                        ?>
                    </div>
                    <div id="sub_compte">
                        <input type="submit" name="change" value="sauvegarder">
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