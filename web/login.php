<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> <!-- Lien CSS vers Bootstrap -->
    <link rel="stylesheet" type="text/css" href="assets/css/login.css"> <!-- Lien css pour la page login -->
</head>
<body>
  <div class="wrapper">
    <form id="login" class="form-signin" action="assets/php/utils.php" method="post">
        <h2 class="form-signin-heading">Connexion</h2>
        <div>
            <input type="text" class="form-control" name="pseudo" id="pseudo" placeholder="Pseudo" required="" autofocus="" />
        </div>
        <div>
            <input type="password" class="form-control" name="mdp" id="mdp" placeholder="Mot de passe" required=""/>
        </div>
        <div>
            <button name="login" class="btn btn-lg btn-primary btn-block" type="submit">Login</button
        </div>
    </form>
  </div>
</body>
</html>
