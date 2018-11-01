<!DOCTYPE html>
<html lang="fr">
<meta charset="UTF-8">
<head>
    <title>Inscription</title>
    <link rel="stylesheet" href="assets/css/inscryption.css">
</head>
<body>
<div class="container">
    <form id="log" action="assets/php/utils.php" method="post">
        <h3>connection</h3>
        <fieldset>
            <input name="pseudo" placeholder="Pseudo" type="text" required autofocus>
        </fieldset>
        <fieldset>
            <input name="mdp" placeholder="Mot de passe" type="password" required>
        </fieldset>
        <fieldset>
            <button name="login" type="submit" id="contact-submit">enter</button>
        </fieldset>
    </form>
</div>
</body>
</html>