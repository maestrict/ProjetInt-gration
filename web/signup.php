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
</head>
<body>
<div class="wrapper">
    <form action="assets/php/utils.php" method="post" id="inscription" class="form-signin">
        <h2 class="form-signin-heading">Inscryption</h2>

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
            <button name="inscription" type="submit" id="contact-submit" class="btn btn-lg btn-primary btn-block">Submit</button>
        </div>
    </form>
</div>
</body>
</html>