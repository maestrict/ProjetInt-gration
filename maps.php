<?php
session_start();
require_once('assets/php/request.php');
require_once('assets/php/utils.php');
require 'assets/php/secure.inc.php';

$terrains = terrain('get');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Recherche Terrain</title>
    <meta name="viewport" content="width=device-width , initial-scale=1" />
    <meta name="theme-color" content="#317EFB"/>
    <meta name="Description" content="page principale du site où on peut cherche un terrain de sport en fonctions de plusieurs parametres">
    <link rel="shortcut icon" type="image/x-icon" href="/assets/img/logo_trans.ico">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css">
    <script src="assets/js/jquery.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCr6G5Rd6OOvx0_9SUFoYgrciriAgEvFgc&callback=getLocation"></script>
    <link rel='stylesheet' href='fullcalendar/fullcalendar.css' />
    <script src='fullcalendar/lib/jquery.min.js'></script>
    <script async src='fullcalendar/lib/moment.min.js'></script>
    <script async src='fullcalendar/fullcalendar.js'></script>
    <script async src='fullcalendar/locale-all.js'></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="assets/js/maps.js"></script>
    <script src="assets/js/utils.js"></script>
    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"
            integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E=" crossorigin="anonymous"></script>
    <script>
        $( function() {
        $( "#dialog" ).dialog({autoOpen: false});
        } );
    </script>
</head>
<body onload="getLocation()">
<?php
    require 'assets/php/menu.inc.php';
?>
<main>
    <div class="container">
      <h2>Rechercher un terrain</h2>
        <div class="row">
            <div id="map" class="col-lg-auto"></div>
            <div id="tbTerrain" class="col-sm">
                <div class="row">
                    <form method="post" name="filtre">
                  <div class="form-group">

                    <select id="sport" onchange="updateTable(this)" class="form-control">
                        <option value="Sport" disabled selected>Sport</option>
                        <?php
                        foreach (distinct_key($terrains,'sport') as $terrain => $test){
                            echo"<option value='{$test}'>{$test}</option>";
                        }
                        ?>
                    </select>
                  </div>
                    <!--<select id="club" onchange="updateTable(this)">
                        <option value="" disabled selected>nom du club</option>
                        <?php
/*                        foreach (distinct_key($terrains,'Name') as $terrain => $test){
                            echo"<option value='{$test}'>{$test}</option>";
                        }
                        */?>
                    </select>-->
                    <div class="form-group">
                        <input type="number" min="0" id="zip" name="zip" placeholder="Code Postal" onkeyup="updateTable(this)" class="form-control">
                    </div>
                    <div class="form-group">
                      <select class="form-control">
                          <option value="" disabled selected>Distance (Km)</option>
                          <?php
                          for($i=5;$i<45;$i+=5){
                              echo"<option value='{$i}'>{$i}</option>";
                          }
                          ?>
                      </select>
                    </div>
                    <div>
                      <input type="button" id="date" name="date" value="Disponibilité" onclick="disponnibilite()" class="blue btn btn-primary">
                    </div>
                </form>
                </div>
                <div class="row" id="donne">
                    <div id="terrain">

                    </div>
                    <div id="calendar">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div id="club">

            </div>
        </div>
        <div id="dialog" title="un partenaire?">
            <form method="post" onsubmit="reserve(); return false">
                <label for="partenaire">Nombre de partenaires recherché: </label>
                <input type="number" name="partenaire" id="partenaire" value="0" min="0">
                <input type="submit" value="valider">
            </form>
        </div>
    </div>
</main>
<?php
    require 'assets/php/footer.inc.php'
?>
</body>
</html>
