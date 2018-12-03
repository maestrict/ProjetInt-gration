<?php
session_start();
require_once('assets/php/request.php');
require_once('assets/php/utils.php');
require 'assets/php/secure.inc.php';

$terrains = terrain('get');
?>
<!DOCTYPE html>
<html>
<head>
    <title>recherche Terrain</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="shortcut icon" type="image/x-icon" href="/assets/img/logo_trans.ico">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css">
    <script src="assets/js/jquery.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCr6G5Rd6OOvx0_9SUFoYgrciriAgEvFgc&callback=getLocation"></script>
    <link rel='stylesheet' href='fullcalendar/fullcalendar.css' />
    <script src='fullcalendar/lib/jquery.min.js'></script>
    <script src='fullcalendar/lib/moment.min.js'></script>
    <script src='fullcalendar/fullcalendar.js'></script>
    <script src='fullcalendar/locale-all.js'></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="assets/js/maps.js"></script>
    <script src="assets/js/utils.js"></script>
    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"
            integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E=" crossorigin="anonymous"></script>
    <script>
        $( function() {
        $( "#dialog" ).dialog({autoOpen: false});
        $( "#dialog2" ).dialog({autoOpen: false});
        } );
    </script>
</head>
<body onload="myMap()">
<?php
    require 'assets/php/menu.inc.php';
?>
<main>
    <div class="container">
        <div class="row">
            <div id="map" class="col-lg-auto"></div>
            <div id="tbTerrain" class="col-sm-2">
                <form method="post" name="filtre">
                    <select id="sport" onchange="updateTable(this)">
                        <option value="" disabled selected>sport</option>
                        <?php
                        foreach (distinct_key($terrains,'sport') as $terrain => $test){
                            echo"<option value='{$test}'>{$test}</option>";
                        }
                        ?>
                    </select>
                    <!--<select id="club" onchange="updateTable(this)">
                        <option value="" disabled selected>nom du club</option>
                        <?php
/*                        foreach (distinct_key($terrains,'Name') as $terrain => $test){
                            echo"<option value='{$test}'>{$test}</option>";
                        }
                        */?>
                    </select>-->
                    <select>
                        <option value="" disabled selected>distance</option>
                        <?php
                        for($i=5;$i<45;$i+=5){
                            echo"<option value='{$i}'>{$i}</option>";
                        }
                        ?>
                    </select>
                    <input type="number" min="0" id="zip" name="zip" placeholder="code postal" onkeyup="updateTable(this)">
                    <input type="button" id="date" name="date" value="disponibilité" onclick="disponnibilite()">
                </form>
            </div>
            <div class="col-md">
                <div id="donne">
                </div>
                <div id="calendar">
                </div>
                <div id="dialog" title="un partenaire?">
                    <form method="post" onsubmit="reserve(); return false">
                        <label for="partenaire">nombre de partenaires recherché: </label>
                        <input type="number" name="partenaire" id="partenaire" value="0" min="0">
                        <input type="submit" value="valider">
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
<?php
    require 'assets/php/footer.inc.php'
?>
</body>
</html>