var map;
var marqueur = [];
var event = [];
function myMap() {
//debugger;
    let mapOptions = {
        center: new google.maps.LatLng(50.6657, 4.5868),
        zoom: 14,
        mapTypeId: google.maps.MapTypeId.HYBRID
    };

    map = new google.maps.Map(document.getElementById("map"), mapOptions);
}
function addMarker(terrain) {
    //création du marqueur
    marqueur.push(new google.maps.Marker({
        position: new google.maps.LatLng(terrain['latitude'], terrain['longitude']),
        map: map
    }));
    google.maps.event.addListener(marqueur[marqueur.length-1], 'click', function() {
        $('#calendar').fullCalendar('destroy');
        $('#donne').html(makeTable(terrain))
    });
}
function setMapOnAll(map) {
    for (let i = 0; i < marqueur.length; i++) {
        marqueur[i].setMap(map);
    }
}
function clearMarkers() {
    setMapOnAll(null);
}
function deleteMarkers() {
    clearMarkers();
    marqueur = [];
}

function makeTable(data){
    if($('#sport').val() == undefined){
        data = JSON.parse(ajax('terrain', {'address':data['address']}));
    }else{
        data = JSON.parse(ajax('terrain', {'spec':[data['address'], data['sport']]}));
    }
    for (let i in data) { // supprimer les infos inutiles pour l'utilisateur
        delete data[i]['clubId'];
        delete data[i]['sId'];
        delete data[i]['description'];
        delete data[i]['latitude'];
        delete data[i]['longitude'];
    }
    let table = "<table class='table table-striped'>";
    let header = "<thead><tr>";
    for (let i in data[0]){
        header += "<th>"+i+"</th>";
    }
    header += "<th>détail</th>";
    header += "</tr></thead>";
    let main = "<tbody>";
    for (let y in data){
        main += "<tr>";
        for (let x in data[y]) {
            main += "<td>" + data[y][x] + "</td>";
        }
        main += "<td><input type='button' value='horaire' onclick='calendar("+data[y]['tId']+")'></td></tr>";
    }
    main += "</tbody>";
    return table+header+main;
}

function calendar(tId) {
    $('#calendar').fullCalendar('destroy');
    let data=[];
    $.ajaxSetup({async:false});
    data = JSON.parse(ajax('calendar', tId));
    for (let i in data){ data[i]['overlap'] = false;}
    $('#calendar').fullCalendar({
        defaultView: 'agendaWeek',
        locale: 'fr',
        events: data,
        selectable: true,
        select: function(start, end){addEvent(tId, start, end)},
        header: {
            center: 'addEventButton'
        },
        customButtons: {
            addEventButton: {
                text: 'add event...',
                click: function() {
                        var dateStr = prompt("Enter a date in 'YYYY-MM-DD HH:MM:SS' format");
                        var start = moment(dateStr);
                        dateStr = prompt("Enter a date in 'YYYY-MM-DD HH:MM:SS' format");
                        var end = moment(dateStr);

                    if (start.isValid() && end.isValid()) {
                        addEvent(tId, start, end);
                    } else {
                        alert('Invalid date.');
                    }
                }
            }
        }
    });
}

function addEvent(tId, start, end) {
    start = moment(start).format('YYYY-MM-DD HH:mm:00');
    event.push(start);
    end = moment(end).format('YYYY-MM-DD HH:mm:00');
    event.push(end);
    event.push(tId);
    if(ajax('isfree', {'id': event[2], 'start':event[0], 'end': event[1]})){
        $( "#dialog" ).dialog("open");
    }
}
function reserve(){
    // console.log("start "+start);
    // console.log("end "+end);
    // console.log($('#partenaire').val());
    let eventData;
    $("#dialog").dialog("close");
    eventData = {
        title: "",
        start: event[0],
        end: event[1],
        overlap: false
    };
    ajax('reservation', {'id': event[2], 'start':event[0], 'end': event[1], 'participant': parseInt($('#partenaire').val())+1});
    $('#calendar').fullCalendar('renderEvent', eventData, true); // stick? = true
    $('#calendar').fullCalendar('unselect');
}