<?php
require_once('assets/php/utils.php');
?>
<!DOCTYPE html>
<html lang="fr">

<meta charset="UTF-8">
<head>
    <title>Inscription</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> <!-- Lien CSS vers Bootstrap -->
    <link rel="stylesheet" type="text/css" href="assets/css/login.css"> <!-- Lien css pour la page login -->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>
<main>
    <div class="tab"><!-- boutons pour distinguer l'inscription client/club -->
        <button class="tablinks" onclick="openForm(event, 'userForm')">Inscription Client</button>
        <button class="tablinks" onclick="openForm(event, 'clubForm')">Inscription Club</button>
    </div>
    <div id="userForm" class="tabcontent">
        <div class="wrapper">
            <form action="assets/php/utils.php" method="post" id="inscription" class="form-signin">
                <h2 class="form-signin-heading">Inscription Client</h2>

                <div>
                    <input name ="nom" placeholder="Nom" type="text" tabindex="1" required autofocus>
                </div>
                <div>
                    <input name="prenom" placeholder="Prénom" type="text" tabindex="2" required autofocus>
                </div>
                <div>
                    Date de naissance : <input name="date" placeholder="Date de naissance" type="date" tabindex="3" required autofocus>
                </div>
                <div>
                    <input name="email" placeholder="Email" type="email" tabindex="4" required>
                </div>
                <div>
                    <input name="pseudo" placeholder="Pseudo" type="text" tabindex="5" required autofocus>
                </div>
                <div>
                    <input name="mdp" placeholder="Mot de passe" type="password" tabindex="6" required autofocus>
                </div>
                <div>
                    <input name="mdp2" placeholder="Confirmer mot de passe" type="password" tabindex="7" required autofocus>
                </div>
                <div>
                    <button name="inscription_client" type="submit" id="contact-submit" class="btn btn-lg btn-primary btn-block">Submit</button>
                </div>
            </form>
        </div>
    </div>
    <div id="clubForm" class="tabcontent">
        <div class="wrapper">
            <form action="assets/php/utils.php" method="post" id="inscription" class="form-signin">
                <h2 class="form-signin-heading">Inscription Club</h2>
                <div>
                    <input name="clubPseudo" placeholder="Pseudo" type="text" tabindex="1" required autofocus>
                </div>
                <div>
                    <input name="nom" placeholder="Nom" type="text" tabindex="2" required autofocus>
                </div>

                <div>
                    <input name="email" placeholder="Email" type="email" tabindex="3" required>
                </div>
                <div>
                    <input name="zipcode" placeholder="Code Postal" type="text" tabindex="4" required autofocus>
                </div>
                <div>
                    <input name="mdp" placeholder="Mot de passe" type="password" tabindex="5" required autofocus>
                </div>
                <div>
                    <input name="mdp2" placeholder="Confirmer mot de passe" type="password" tabindex="6" required autofocus>
                </div>
                <div>
                    <button name="inscription_club" type="submit" id="contact-submit" class="btn btn-lg btn-primary btn-block">Submit</button>
                </div>
            </form>
        </div>
    </div>
</main>
<script>
    //fonction js pour cacher/afficher le formulaire
    function openForm(evt,formName) { // on récupère l'id du formulaire
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) { // caché par défaut avec display:none;
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) { // on ajoute la classe active au click
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(formName).style.display = "block";
        evt.currentTarget.className += " active";
    }
</script>
</body>
</html>