<?php
require_once ('assets/php/db.inc.php');
if(isset($_COOKIE["pseudo"]) and isset($_COOKIE["mdp"])) {
    //echo "Cookie founded!";
    $iDB = new Db();
    $iDB->login(2,$_COOKIE["pseudo"], $_COOKIE["mdp"]);
    header('location: acceuil.php');
}
?><!DOCTYPE html>
<html lang="fr">
<head>
    <title>Moovego</title>
    <meta name="viewport" content="width=device-width , initial-scale=1" />
    <meta name="theme-color" content="#317EFB"/>
    <meta name="Description" content="Moovego, site de reservation en ligne de terrain.">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <script src="assets/js/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="assets/js/utils.js"></script>
    <script src="assets/js/modernizr-custom.js"></script>
    <link rel="shortcut icon" type="image/x-icon" href="/assets/img/logo_trans.ico">
</head>
<body>
<nav class='navbar navbar-expand-sm navbar-light bg-light'>
    <button class="navbar-toggler" type="button" data-toggle="collapse"
            data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item"><a class="nav-link" href="login.php">Acceuil</a></li>
            <li class="nav-item"><a class="nav-link" href="login.php">Recherche terrain</a></li>
            <li class="nav-item"><a class="nav-link" href="login.php">Recherche partenaire</a></li>
            <li class="nav-item"><a class="nav-link" href="login.php">Mon Compte</a></li>
            <li class="nav-item"><a class="nav-link" href="login.php" id="mobile">Login</a></li>
        </ul>
        <div class="btn-group dropleft">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Login
            </button>
            <div id="loginMenu" class="dropdown-menu">
                <form action="assets/php/request.php" class="px-4 py-3 form-signin" id="login" method="post">
                    <div class="form-group">
                        <label for="pseudo">Pseudo</label>
                        <input type="text" name="pseudo" id="pseudo" class="form-control"  placeholder="Pseudo" required>
                    </div>
                    <div class="form-group">
                        <label for="mdp">Password</label>
                        <input type="password" name="mdp" id="mdp" class="form-control" placeholder="Password" required>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember">
                        <label class="form-check-label" for="remember">
                            Remember me
                        </label>
                    </div>
                    <input type="submit" name="login" class="btn btn-primary" value="Sign in">
                </form>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="signup.php">New around here? Sign up</a>
                <a class="dropdown-item" href="login.php">Forgot password?</a>
            </div>
        </div>
    </div>
</nav>
<main>
    <header id="banner">
        <div id="home" class="jumbotron image">
            <div class="text-center">
                <h1>MooveGo</h1>
                <img src="/assets/img/logo_white.png" class="size" alt="logo Moovego">
                <p id="slogan" class="font-italic">Sport anywhere with anybody</p>
            </div>
        </div>
    </header>

    <div class="container acceuil">
        <section id="one" class="wrapper style1 special">
            <div class="inner">
                <header class="major">
                    <h4>MooveGo est une plateforme permettant aux sportifs de réserver un terrain de Tennis, Badminton, Padel & Squash dans la province du Brabant Wallon. Nous avons pour but de promouvoir les activités sportives à plusieurs.</h4>
                    <p>MooveGo est également une plateforme permettant de trouver un ou plusieurs partenaire(s) sportif(s) grâce à un système d’annonce simple et pratique.</p>
                </header>
            </div>
        </section>

        <h2 class="title">Services</h2>
        <section id="two" class="card-deck mb-3 text-center">
            <div class="card mb-4 shadow-sm">
                <picture>
                    <source srcset="/assets/img/terrain.webp" type="image/webp" sizes="140px">
                    <source srcset="/assets/img/terrain.jpg" type="image/jpeg" sizes="140px">
                    <img src="/assets/img/default_profile.jpg" alt="Trouvez un terrain" width="140" height="140" class="rounded-circle mx-auto">
                </picture>
                <!--<img class="rounded-circle mx-auto" src="/assets/img/terrain.webp" alt="Trouvez un terrain" width="140" height="140">-->
                <h2>Trouvez un terrain</h2>
                <p>Grâce à notre système de localisation des clubs et vos critères.</p>
                <a class="blue btn btn-secondary" href="http://www.moovego.be:8080/#details" role="button">View details »</a>
            </div>
            <div class="card mb-4 shadow-sm">
                <picture>
                    <source srcset="/assets/img/unsplash.webp" type="image/webp" sizes="140px">
                    <source srcset="/assets/img/unsplash.jpg" type="image/jpeg" sizes="140px">
                    <img src="/assets/img/default_profile.jpg" alt="Trouvez un terrain" width="140" height="140" class="rounded-circle mx-auto">
                </picture>
                <h2>Trouvez un partenaire</h2>
                <p>Grâce à notre système de mise en relation de sportifs et vos critères.</p>
                <a class="blue btn btn-secondary" href="http://www.moovego.be:8080/#details" role="button">View details »</a>
            </div>
            <div class="card mb-4 shadow-sm">
                <picture>
                    <source srcset="/assets/img/reserved.webp" type="image/webp" sizes="140px">
                    <source srcset="/assets/img/reserved.jpg" type="image/jpeg" sizes="140px">
                    <img src="/assets/img/default_profile.jpg" alt="Trouvez un terrain" width="140" height="140" class="rounded-circle mx-auto">
                </picture>
                <h2>Réservez le terrain</h2>
                <p>Grâce à notre plateforme qui est directement liée aux clubs.</p>
                <a class="blue btn btn-secondary" href="http://www.moovego.be:8080/#details" role="button">View details »</a>
            </div>
        </section>

        <section id="shsport" class="index blue mx-auto text-center col-sm-8">
            <table>
                <caption><h2>Sports</h2></caption>
                <tr>
                    <td><img src="assets/img/tennis.png" class="img-fluid" alt="tennis"></td>
                    <td><img src="assets/img/padel.png" class="img-fluid" alt="padel"></td>
                </tr>
                <tr>
                    <td><img src="assets/img/badminton.png" class="img-fluid" alt="badminton"></td>
                    <td><img src="assets/img/squash.png" class="img-fluid" alt="squash"></td>
                </tr>
            </table>
        </section>

        <section id="histoire" class="index mx-auto text-center col-sm-8">
            <div class="inner">
                <header class="major">
                    <h2>HISTOIRE</h2>
                    <p>MooveGo est une entreprise que nous, 6 jeunes entrepreneurs sportifs, avons décidé de mettre sur pied. </p>
                </header>
                <p>Nous avons pour mission d’accompagner les sportifs dans leur processus de réservation de terrain en offrant un système en ligne de réservation centralisé, rapide, simple et performant. Aussi, nous voulons les accompagner dans leurs recherches de partenaire de sport grâce à un système de mise en relation.



                    Ce projet provient de deux frustrations que nous avons rencontrées : la difficulté de réservation due à un système en ligne pas assez performant voire inexistant : nous avons par exemple remarqué que plus de la moitié des clubs locaux ne dispose pas de système de réservation en ligne. Et, la difficulté de trouver un partenaire de sport.



                    Notre plateforme est gratuite pour les utilisateurs, donc les sportifs à la recherche d’un terrain et/ou d’un partenaire, mais payante pour les clubs qui veulent mettre leurs terrains à disposition des sportifs.</p>
                <span>MooveGo veut rendre la pratique du sport plus accessible et améliorer le quotidien des sportifs.

    ​

    Nous voulons que la société utilise la connectivité au service des relations humaines et propose des solutions adaptées à chacun.</span>
            </div>
        </section>
        <div class="bg-light contact index">
            <div class="well well-sm">
                <form action="assets/php/request.php" class="contact" id="form_contact" method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">
                                    Nom</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Nom" required/>
                            </div>
                            <div class="form-group">
                                <label for="email">
                                    Adresse email</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span>
                                    </span>
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Email" required/></div>
                            </div>
                            <div class="form-group">
                                <label for="subject">
                                    Sujet</label>
                                <select id="subject" name="subject" class="form-control" required>
                                    <option value="na" selected disabled>Choisissez un sujet</option>
                                    <option value="service">Service client</option>
                                    <option value="suggestions">Suggestions</option>
                                    <option value="product">Support Produit</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="message">
                                    Message</label>
                                <textarea name="message" id="message" class="form-control" rows="9" cols="25" required
                                          placeholder="Message"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary pull-right" id="contact" name="contact">
                                Envoyer</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
<?php
    require 'assets/php/footer.inc.php'
?>
</body>
</html>
