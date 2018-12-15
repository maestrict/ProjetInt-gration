<?php
session_start();
require_once('assets/php/request.php');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Compte</title>
    <meta name="viewport" content="width=device-width , initial-scale=1" />
    <link rel="shortcut icon" type="image/x-icon" href="/assets/img/logo_trans.ico">
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/utils.js"></script>
    <script src='fullcalendar/lib/jquery.min.js'></script>
    <script src='fullcalendar/lib/jquery-ui.min.js'></script>
    <script src='fullcalendar/lib/moment.min.js'></script>
    <script src='fullcalendar/fullcalendar.js'></script>
    <script src='fullcalendar/locale-all.js'></script>
    <link rel='stylesheet' href='fullcalendar/fullcalendar.css'/>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <script>
        function horraire(tId) {
            $('#reserve').fullCalendar('destroy');
            let data=[];
            $.ajaxSetup({async:false});
            data = JSON.parse(ajax('calendar', tId));
            for (let i in data){ data[i]['overlap'] = false;}
            $('#reserve').fullCalendar({
                defaultView: 'agendaWeek',
                locale: 'fr',
                firstDay:1,
                events: data,
                height: 350,
                businessHours: getBusiness()
            });
        }
    </script>
</head>
<body onload="load('contain', 'terrain')">
<?php
require 'assets/php/menu.inc.php';
?>
<main>
    <div class="container">
        <div class="row">
            <div class="col-sm-auto btn-group-vertical">
                <input type="button" value="Vos terains" class="btn btn-outline-secondary" onclick="load('contain', 'terrain')"><br>
                <input type="button" value="Vos horraires" class="btn btn-outline-secondary" onclick="load('contain', 'calendar')">
            </div>
            <div class="col-lg">
                <div id="contain">

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