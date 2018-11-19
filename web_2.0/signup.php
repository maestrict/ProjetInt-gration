<!DOCTYPE html>
<html lang="fr">

<meta charset="UTF-8">
<head>
    <title>Inscription</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/utils.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</head>
<body>
<main>
    <div class="tab">
        <a class="btn btn-primary" data-toggle="collapse" href="#userForm" role="button" aria-expanded="false" aria-controls="userForm">
            Inscription Client
        </a>
        <a class="btn btn-primary" data-toggle="collapse" href="#clubForm" role="button" aria-expanded="false" aria-controls="clubForm">
            Inscription Club
        </a>
    </div>
    <div id="userForm">
        <div class="card card-body">
            <form action="assets/php/request.php" method="post" id="inscription-client" class="form-signin">
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
                    <input name="inscription_client" type="submit" id="client-submit" class="btn btn-lg btn-primary btn-block" value="Submit">
                </div>
            </form>
        </div>
    </div>
    <div id="clubForm" class="collapse">
        <div class="card card-body">
            <form action="assets/php/request.php" method="post" id="inscription-club" class="form-signin">
                <h2 class="form-signin-heading">Inscription Club</h2>
                <div>
                    <input name="nom" placeholder="Nom" type="text" tabindex="1" required autofocus>
                </div>

                <div>
                    <input name="email" placeholder="Email" type="email" tabindex="2">
                </div>
                <div>
                    <input name="address" placeholder="address" type="text" tabindex="3" autofocus>
                </div>
                <div>
                    <input name="mdp" placeholder="Mot de passe" type="password" tabindex="4" required autofocus>
                </div>
                <div>
                    <input name="mdp2" placeholder="Confirmer mot de passe" type="password" tabindex="5" required autofocus>
                </div>
                <div>
                    <button name="inscription_club" type="submit" id="club-submit" class="btn btn-lg btn-primary btn-block">Submit</button>
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