<?php
session_start();
require_once('assets/php/request.php');
require 'assets/php/secure.inc.php';

$terrains = terrain('get');
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>recherche groupe</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="shortcut icon" type="image/x-icon" href="/assets/img/logo_trans.ico">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <script src="assets/js/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="assets/js/utils.js"></script>
</head>
    <body class="is-preload" onload="groups(true)">
    <?php
        require 'assets/php/menu.inc.php';
    ?>
    <main>
        <section class="container">
            <div class="row">
                <div class="col-sm">
                    <form method="post" onsubmit="groups(); return false">
                        <div class="form-group">
                            <input type="text" class="form-control" id="address" placeholder="Localisation">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="Rayon" placeholder="Rayon (km)">
                        </div>
                        <div class="form-group">
                            <select id="sport" class="form-control">
                                <option value="Sport" disabled="" selected="">Sport</option>
                                <option value="Badminton">Badminton</option>
                                <option value="Tennis">Tennis</option>
                                <option value="Padel">Padel</option>
                                <option value="Squash">Squash</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="Date" class="form-control" id="date">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="nbrParticipants" placeholder="Nombre de personnes">
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" class="blue btn btn-primary" value="Chercher"> <input type="button" name="annuler" class="blue btn btn-primary" value="Annuler" onclick="window.location.reload()">
                        </div>
                    </form>
                </div>
                <div class="col">
                    <h2>Annonces</h2>
                    <div id="listAnnonces">

                    </div>
                </div>
            </div>
        </section>
    </main>
    <?php
        require 'assets/php/footer.inc.php'
    ?>
	</body>
</html>