<?php
require_once("request.php");
require 'secure.inc.php';

?>
<link rel='stylesheet' href='../../fullcalendar/fullcalendar.css' />
<script src='../../fullcalendar/lib/jquery.min.js'></script>
<script src='../../fullcalendar/lib/moment.min.js'></script>
<script src='../../fullcalendar/fullcalendar.js'></script>
<script>
    $(function() {
        $('#calendar').fullCalendar('destroy');
        $('#calendar').fullCalendar({
            locale: 'fr',
            defaultView: 'agendaWeek',
            firstDay:1,
            height:600,
            businessHours: getBusiness(),
            selectable: true,
            selectOverlap: false,
            select: function(start, end){test(start, end);}
        })
    });
    function test(start, end){
        let query ={};
        start = moment(start).format('YYYY-MM-DD HH:mm:00');
        let date = new Date(start);
        date = date.toLocaleDateString('fr-fr',{weekday: 'long'});
        //console.log(date.charAt(0).toUpperCase()+date.slice(1)+"Start");
        //console.log(start.split(' ')[1]);
        query[date.charAt(0).toUpperCase()+date.slice(1)+"Start"] = start.split(' ')[1];


        end = moment(end).format('YYYY-MM-DD HH:mm:00');
        date = new Date(end);
        date = date.toLocaleDateString('fr-fr',{weekday: 'long'});
        //console.log(date.charAt(0).toUpperCase()+date.slice(1)+"End");
        //console.log(end.split(' ')[1]);
        query[date.charAt(0).toUpperCase()+date.slice(1)+"End"] = end.split(' ')[1];
        //console.log(query);
        console.log(ajax('horraire',{'add':query}));
        $('#calendar').fullCalendar('destroy');
        $('#calendar').fullCalendar({
            defaultView: 'agendaWeek',
            locale: 'fr',
            firstDay:1,
            height:600,
            businessHours: getBusiness(),
            selectable: true,
            selectOverlap: false,
            select: function(start, end){test(start, end)}
        });
    }
</script>
<h5>Sélectionner vos heures d'ouverture</h5>
<div>
    <form id="horraire" method="post" onSubmit="horraire(); return false">
        <table>
            <tr>
                <td>
                    <label for="Lundistart">Lundi</label><br>
                    <input type="text" name="Lundistart" id="Lundistart" onchange="validateHhMm(this);" placeholder="HH:MM:SS"><br>
                    <input type="text" name="Lundiend" id="Lundiend" onchange="validateHhMm(this);" placeholder="HH:MM:SS">
                </td>
                <td>
                    <label for="Mardistart">Mardi</label><br>
                    <input type="text" name="Mardistart" id="Mardistart" onchange="validateHhMm(this);" placeholder="HH:MM:SS"><br>
                    <input type="text" name="Mardiend" id="Mardiend" onchange="validateHhMm(this);" placeholder="HH:MM:SS">
                </td>
                <td>
                    <label for="Mercredistart">Mercredi</label><br>
                    <input type="text" name="Mercredistart" id="Mercredistart" onchange="validateHhMm(this);" placeholder="HH:MM:SS"><br>
                    <input type="text" name="Mercrediend" id="Mercrediend" onchange="validateHhMm(this);" placeholder="HH:MM:SS">
                </td>
                <td>
                    <label for="Jeudistart">Jeudi</label><br>
                    <input type="text" name="Jeudistart" id="Jeudistart" onchange="validateHhMm(this);" placeholder="HH:MM:SS"><br>
                    <input type="text" name="Jeudiend" id="Jeudiend" onchange="validateHhMm(this);" placeholder="HH:MM:SS">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="Vendredistart">Vendredi</label><br>
                    <input type="text" name="Vendredistart" id="Vendredistart" onchange="validateHhMm(this);" placeholder="HH:MM:SS"><br>
                    <input type="text" name="Vendrediend" id="Vendrediend" onchange="validateHhMm(this);" placeholder="HH:MM:SS">
                </td>
                <td>
                    <label for="Samedistart">Samedi</label><br>
                    <input type="text" name="Samedistart" id="Samedistart" onchange="validateHhMm(this);" placeholder="HH:MM:SS"><br>
                    <input type="text" name="Samediend" id="Samediend" onchange="validateHhMm(this);" placeholder="HH:MM:SS">
                </td>
                <td>
                    <label for="Dimanchestart">Dimanche</label><br>
                    <input type="text" name="Dimanchestart" id="Dimanchestart" onchange="validateHhMm(this);" placeholder="HH:MM:SS"><br>
                    <input type="text" name="Dimancheend" id="Dimancheend" onchange="validateHhMm(this);" placeholder="HH:MM:SS">
                </td>
                <td>
                    <input type="submit" value="enregistrer l'horraire">
                </td>
            </tr>
        </table>
    </form>
</div>
<div id='calendar'></div>