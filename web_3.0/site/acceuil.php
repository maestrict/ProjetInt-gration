<?php
session_start();
require 'assets/php/secure.inc.php';
?>
<!DOCKTYPE html>
<html>
<head>
    <title>Acceuil</title>
    <meta name="viewport" content="width=device-width , initial-scale=1" />
    <link rel="shortcut icon" type="image/x-icon" href="/assets/img/logo_trans.ico">
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/utils.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body onload="getEvent('terrain')">
<?php
    require 'assets/php/menu.inc.php';
?>
<main>
    <header id="banner">
        <div id="home" class="jumbotron">
            <div class="text-center">
                <h1>MooveGo</h1>
                <img src="/assets/img/logo_white.png" class="size">
                <p id="slogan" class="font-italic">Sport anywhere with anybody</p>
            </div>
        </div>
    </header>

    <div class="container acceuil">
        <!-- One -->
        <section id="one" class="wrapper style1 special">
            <div class="inner">
                <header class="major">
                    <h4>MooveGo est une plateforme permettant aux sportifs de réserver un terrain de Tennis, Badminton, Padel & Squash dans la province du Brabant Wallon. Nous avons pour but de promouvoir les activités sportives à plusieurs.</h4>
                    <p>MooveGo est également une plateforme permettant de trouver un ou plusieurs partenaire(s) sportif(s) grâce à un système d’annonce simple et pratique.</p>
                </header>
            </div>
        </section>

        <!-- Two -->
        <h2 class="title">Services</h2>
        <section id="two" class="card-deck mb-3 text-center">
            <div class="card mb-4 shadow-sm">
                <img class="rounded-circle mx-auto" src="/assets/img/terrain.jpg" alt="Generic placeholder image" width="140" height="140">
                <h2>Trouvez un terrain</h2>
                <p>Grâce à notre système de localisation des clubs et vos critères.</p>
                <a class="blue btn btn-secondary" href="#" role="button">View details »</a>
            </div>
            <div class="card mb-4 shadow-sm">
                <img class="rounded-circle mx-auto" src="/assets/img/unsplash.jpg" alt="Generic placeholder image" width="140" height="140">
                <h2>Trouvez un partenaire</h2>
                <p>Grâce à notre système de mise en relation de sportifs et vos critères.</p>
                <a class="blue btn btn-secondary" href="#" role="button">View details »</a>
            </div>
            <div class="card mb-4 shadow-sm">
                <img class="rounded-circle mx-auto" src="/assets/img/reserved.jpg" alt="Generic placeholder image" width="140" height="140">
                <h2>Réservez le terrain</h2>
                <p>Grâce à notre plateforme qui est directement liée aux clubs.</p>
                <a class="blue btn btn-secondary" href="#" role="button">View details »</a>
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
                    <p>MooveGo est une entreprise que nous, 3 jeunes entrepreneurs sportifs, avons décidé de mettre sur pied. </p>
                </header>
                <p>Nous avons pour mission d’accompagner les sportifs dans leur processus de réservation de terrain en offrant un système en ligne de réservation centralisé, rapide, simple et performant. Aussi, nous voulons les accompagner dans leurs recherches de partenaire de sport grâce à un système de mise en relation.



                    Ce projet provient de deux frustrations que nous avons rencontrées : la difficulté de réservation due à un système en ligne pas assez performant voir inexistant : nous avons par exemple remarqué que plus de la moitié des clubs locaux ne disposent pas de système de réservation en ligne. Et, la difficulté de trouver un partenaire de sport.



                    Notre plateforme est gratuite pour les utilisateurs, donc les sportifs à la recherche d’un terrain et/ou d’un partenaire, mais payante pour les clubs qui veulent mettre leurs terrains à disposition des sportifs.</p>
                <span>MooveGo veut rendre la pratique du sport plus accessible et améliorer le quotidien des sportifs.

    ​

    Nous voulons que la société utilise la connectivité au service des relations humaines et propose des solutions adaptées à chacun.</span>
            </div>
        </section>
        <div class="bg-light contact index">
            <div class="well well-sm">
                <form>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">
                                    Nom</label>
                                <input type="text" class="form-control" id="name" placeholder="Nom" required="required" />
                            </div>
                            <div class="form-group">
                                <label for="email">
                                    Adresse email</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span>
                                    </span>
                                    <input type="email" class="form-control" id="email" placeholder="Email" required="required" /></div>
                            </div>
                            <div class="form-group">
                                <label for="subject">
                                    Sujet</label>
                                <select id="subject" name="subject" class="form-control" required="required">
                                    <option value="na" selected disabled>Choisissez un sujet</option>
                                    <option value="service">Service client</option>
                                    <option value="suggestions">Suggestions</option>
                                    <option value="product">Support Produit</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">
                                    Message</label>
                                <textarea name="message" id="message" class="form-control" rows="9" cols="25" required="required"
                                          placeholder="Message"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary pull-right" id="btnContactUs">
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