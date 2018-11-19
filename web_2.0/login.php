<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Signin Template for Bootstrap</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/utils.js"></script>
</head>

<body class="text-center">
<form action="assets/php/request.php" class="form-signin" id="login" method="post">
    <h1 class="h3 mb-3 font-weight-normal">connection</h1>
    <label for="inputEmail" class="sr-only">pseudo</label>
    <input type="text" name="pseudo" id="pseudo" class="form-control" placeholder="pseudo" required autofocus>
    <label for="inputPassword" class="sr-only">Password</label>
    <input type="password" name="mdp" id="mdp" class="form-control" placeholder="Password" required>
    <div class="checkbox mb-3">
        <label>
            <input type="checkbox" value="remember-me"> Remember me
        </label>
    </div>
    <input type="submit" value="Sign in" name="login" class="btn btn-lg btn-primary btn-block" >
    <p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p>
</form>
</body>
</html>
