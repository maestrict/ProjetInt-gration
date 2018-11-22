var map;
var marqueur = [];
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

function makeTable(data){
    data = JSON.parse(ajax('terrain', {'address':data['address']}));
    /*delete data['sId'];
    delete data['description'];
    delete data['latitude'];
    delete data['longitude'];*/
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
        main += "<td><input type='button' value='horaire' onclick='calendar("+data['tId']+")'></td></tr>";
    }
    main += "</tbody>";
    return table+header+main;
}

function calendar(tId) {
    let data=[];
    $.ajaxSetup({async:false});
    data = JSON.parse(ajax('calendar', tId));
    for (let i in data){ data[i]['overlap'] = false;}
    $('#calendar').fullCalendar({
        defaultView: 'agendaWeek',
        locale: 'fr',
        events: data,
        selectable: true,
        select: function(start, end){addEvent(tId, start, end)}
    });
}

function addEvent(tId, start, end) {
    start = moment(start).format('YYYY-MM-DD HH:mm:00');
    end = moment(end).format('YYYY-MM-DD HH:mm:00');
    let title = prompt('Event Title:');
    let eventData;
    if(ajax('isfree', {'id': tId, 'start':start, 'end': end})){
        // console.log("start "+start);
        // console.log("end "+end);
        if (title) {
            eventData = {
                title: title,
                start: start,
                end: end,
                overlap: false
            };
            $('#calendar').fullCalendar('renderEvent', eventData, true); // stick? = true
        }
        $('#calendar').fullCalendar('unselect');
    }
}