<?php
require_once("assets/php/request.php");
require 'assets/php/secure.inc.php';

?>
<link rel='stylesheet' href='fullcalendar/fullcalendar.css' />
<script src='fullcalendar/lib/jquery.min.js'></script>
<script src='fullcalendar/lib/moment.min.js'></script>
<script src='fullcalendar/fullcalendar.js'></script>
<script>
    $(function() {
        $('#calendar').fullCalendar({
            defaultView: 'agendaWeek',
            locale: 'fr',
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
        ajax('horraire',{'add':query});
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
<div id='calendar'></div>