<?php
require_once ("assets/php/request.php");
?>
<!DOCTYPE html>
<html>
<head>
    <title>recherche Terrain</title>
    <link rel='stylesheet' href='fullcalendar/fullcalendar.css' />
    <script src='fullcalendar/lib/jquery.min.js'></script>
    <script src='fullcalendar/lib/moment.min.js'></script>
    <script src='fullcalendar/fullcalendar.js'></script>
    <script>
        $(function() {
            $('#calendar').fullCalendar({
                events:
                    <?php echo(json_encode(data_calendario()))?>  //this is where I call the data
                ,
                defaultView: 'agendaWeek',
            })
        });
    </script>
</head>
<body>
<div id='calendar'></div>
</body>
</html>