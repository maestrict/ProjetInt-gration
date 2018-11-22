<!DOCKTYPE html>
<html>
<head>
    <title>Moovego</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <script src="assets/js/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <link rel="shortcut icon" type="image/x-icon" href="/assets/img/logo.ico">
</head>
<body>
<nav class='navbar navbar-expand-sm navbar-light bg-light'>
    <button class="navbar-toggler" type="button" data-toggle="collapse"
            data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item"><a class="nav-link" href="#">Acceuil</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Recherche terrain</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Recherche partenaire</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Mon Compte</a></li>
        </ul>
        <div class="btn-group dropleft">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Dropdown
            </button>
            <div class="dropdown-menu">
                <form action="assets/php/request.php" class="px-4 py-3 form-signin" id="login" method="post">
                    <div class="form-group">
                        <label for="pseudo">pseudo</label>
                        <input type="text" name="pseudo" id="pseudo" class="form-control"  placeholder="pseudo" required>
                    </div>
                    <div class="form-group">
                        <label for="mdp">Password</label>
                        <input type="password" name="mdp" id="mdp" class="form-control" placeholder="Password" required>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="dropdownCheck">
                        <label class="form-check-label" for="dropdownCheck">
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

<header id="banner">
    <div id="home" class="jumbotron">
        <h2>MooveGo</h2>
        <p>Une autre façon de pratiquer du sport<br> avec de nouvelles personnes</p>
        <a href="#one" class="more scrolly">En savoir plus</a>
    </div>
</header>

<div class="container">
    <!-- One -->
    <section id="one" class="wrapper style1 special">
        <div class="inner">
            <header class="major">
                <h2>Sport Share est une application de mise en relation de personnes, ayant pour but<br> de promouvoir les activitées sportives à plusieurs.</h2>
                <p>Sport Share est une application de mise en relation de personnes, ayant pour but de promouvoir les activitées sportives à plusieurs.</p>
            </header>
        </div>
    </section>

    <!-- Two -->
    <section id="two" class="row">
        <div class="col-md-4 bg-light">
            <img class="rounded-circle" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" width="140" height="140">
            <h2>Trouvez un terrain</h2>
            <p>Grâce à notre système de localisation des clubs et vos critères.</p>
            <a class="btn btn-secondary" href="#" role="button">View details »</a>
        </div>
        <div class="col-md-4 bg-light">
            <img class="rounded-circle" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" width="140" height="140">
            <h2>Trouvez un partenaire</h2>
            <p>Grâce à notre système de mise en relation de sportifs et vos critères.</p>
            <a class="btn btn-secondary" href="#" role="button">View details »</a>
        </div>
        <div class="col-md-4 bg-light">
            <img class="rounded-circle" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" width="140" height="140">
                <h2>Réservez le terrain</h2>
                <p>Grâce à notre plateforme qui est directement liée aux clubs.</p>
            <a class="btn btn-secondary" href="#" role="button">View details »</a>
        </div>
    </section>

    <section id="histoire" class=" mx-auto text-center col-sm-8">
        <div class="inner">
            <header class="major">
                <h2>HISTOIRE</h2>
                <p>MooveGo est une entreprise que nous, 3 jeunes entrepreneurs sportifs, avons décidés de mettre sur pied. </p>
            </header>
            <p>Nous avons pour mission d’accompagner les sportifs dans leur processus de réservation de terrain en offrant un système en ligne de réservation centralisé, rapide, simple et performant. Aussi, nous voulons les accompagner dans leurs recherches de partenaire de sport grâce à un système de mise en relation.



                Ce projet provient de deux frustrations que nous avons rencontrées : la difficulté de réservation due à un système en ligne pas assez performant voir inexistant : nous avons par exemple remarqué que plus de la moitié des clubs locaux ne disposent pas de système de réservation en ligne. Et, la difficulté de trouver un partenaire de sport.



                Notre plateforme est gratuite pour les utilisateurs, donc les sportifs à la recherche d’un terrain et/ou d’un partenaire, mais payante pour les clubs qui veulent mettre leurs terrains à disposition des sportifs.</p>
            <span>MooveGo veut rendre la pratique du sport plus accessible et améliorer le quotidien des sportifs.

​

Nous voulons que la société utilise la connectivité au service des relations humaines et propose des solutions adaptées à chacun.</span>
        </div>
    </section>
</div>
<?php
    require 'assets/php/footer.inc.php'
?>
</body>
</html>