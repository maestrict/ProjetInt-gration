function ajax(rq,args=''){
    let data = '';
    $.ajaxSetup({async:false});
    $.post("/assets/php/request.php",{action: rq, id: args}, function( x ) {
        data = x;
    });
    return data;
}

function getEvent(to, args=''){
    $('#'+to).text(ajax('terrain', args));
}

function updateTable(select){
    // console.log(select.id);
    // console.log(select.value);
    let table = JSON.parse(ajax('terrain', {[select.id]:select.value}));
    for(i in table){
       addMarker(table[i]);
    }
    $('#donne').text(JSON.stringify(table));
}

function makeCard(data){
    out = "<div class='annonce'>";
    out += "<div class='row'>";
    out += "<div class='col'>";
    out += "identifiant du groupe: "+data['groupeid']+"<br>";
    out += "place libres: "+(data['nbrParticipants']-data['inscrit'])+"<br>";
    out += "date: "+data['startDate']+" - "+data['finDate'];
    out += "</div>";
    out += "<div class='col'>";
    out += "localisation: "+ data['address']+"<br>";
    out += "sport: "+ data['sport']+"<br>";
    out += "<input type='button' name='join' value='rejoindre' onclick='rejoindre(\""+data['idgroupe']+"\")'>";
    out += "</div>";
    out += "</div>";
    out += "";
    out +="</div>";
    return out;
}

function detail(button){
    alert("id du terrain selectionné: "+button.parentNode.parentNode.id);
}
function load(id, page){
    $('#contain').fullCalendar('destroy');
    $('#'+id).load("assets/php/"+page+".php");
}

function chercheUser(name){
    $('#amis').html(ajax('user', name));
}

function mesAmis(){
    $('#amis').html(ajax('user', null));
}

function groups(){
    var tableau = "";
    var data = JSON.parse(ajax('annonce'));
    for(let i in data){
        tableau +=makeCard(data[i])
    }
    $('#listAnnonces').html(tableau);
}

function rejoindre(id){
    alert(ajax('rejoindreGroup', id));
    groups();
}

function lsReserve(data){
    out = "<div class='annonce'>";
    out += "<div class='row'>";
    out += "<div class='col'>";
    out += "identifiant du groupe: "+data['groupeid']+"<br>";
    out += "inscrits: <br>";
    //for inscrit-------------------------------------------------------------------------------------
    out += "date: "+data['startDate']+" - "+data['finDate'];
    out += "</div>";
    out += "<div class='col'>";
    out += "localisation: "+ data['address']+"<br>";
    out += "sport: "+ data['sport']+"<br>";
    out += "<input type='button' name='join' value='annuler' onclick='annuler(\""+data['groupeid']+"\")'>";
    out += "</div>";
    out += "</div>";
    out += "";
    out +="</div>";
    return out;
}

function mesReservations(){
    var data = JSON.parse(ajax('mreserve'));
    var tableau="";
    for(let i in data){
        tableau +=lsReserve(data[i])
    }
    $('#reserve').html(tableau);
}

function annuler(id){
    alert(ajax('annulerGroupe', id));
    mesReservations();
}