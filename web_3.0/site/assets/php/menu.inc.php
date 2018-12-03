<?php
/**
 * Created by PhpStorm.
 * User: Grégory
 * Date: 22-11-18
 * Time: 09:14
 */

?>
<nav class='navbar navbar-expand-sm navbar-light bg-light'>
    <button class="navbar-toggler" type="button" data-toggle="collapse"
            data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item"><a class="nav-link" id="menuacceuil" href="../../acceuil.php">Acceuil</a></li>
            <li class="nav-item"><a class="nav-link" id="menuterrain" href="../../maps.php">Recherche terrain</a></li>
            <li class="nav-item"><a class="nav-link" id="menupartenaire" href="../../terrain.php">Recherche partenaire</a></li>
            <li class="nav-item"><a class="nav-link" id="menucompte" href="../../compte.php">Mon Compte</a></li>
        </ul>
        <ul class="navbar-nav my-2 my-lg-0">
            <?php
                if(isset($_SESSION['user']) || isset($_SESSION['club'])){
                    echo "<li class=\"nav-item\"><a class=\"nav-link\" href=\"../../logout.php\">Se déconnecter</a></li>";
                }else{
                    echo "<li class=\"nav-item\"><a class=\"nav-link\" href=\"../../login.php\">Se connecter</a></li>";
                    echo "<li class=\"nav-item\"><a class=\"nav-link\" href=\"../../signup.php\">S'inscrire</a></li>";
                }
            ?>
        </ul>
    </div>
</nav>
