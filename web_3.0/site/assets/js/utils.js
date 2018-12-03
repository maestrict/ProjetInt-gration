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
    console.log(select);
    let table = [];
    if(select.id) {
        table = JSON.parse(ajax('terrain', {[select.id]: select.value}));
    }else{
        var terrain = [];
        let start = moment(select['start']).format('YYYY-MM-DD HH:mm:00');
        let end = moment(select['end']).format('YYYY-MM-DD HH:mm:00');
        table = JSON.parse(ajax('terrain', {"dispo" : {'start':start, 'end': end}}));
        table.map((value, index) =>{
            if(table[index]['startDate'] == end){
                delete table[index];
            }
            else if(table[index]['finDate'] == start){
                delete  table[index];
            }
        });
        table = table.filter(function () { return true });
        terrain = table.map(x =>x['idTerrain']);
        table = JSON.parse(ajax('terrain',{'notId': terrain}));
    }
    deleteMarkers();
    $('#donne').html();
    let id = [];
    for(i in table){
       addMarker(table[i]);
        id.push(table[i]["clubId"]);
    }
    $('#calendar').fullCalendar('destroy');
    id = Array.from(new Set(id));
    // console.log(id);
    let data = JSON.parse(ajax('club', id));
    data.map((value, index) =>{
       delete data[index]['mdp'];
       delete data[index]['zip'];
       delete data[index]['id'];
       delete data[index]['clubId'];
       delete data[index]['DateInscription'];
       delete data[index]['zipCode'];
    });
    $('#donne').html(mktable(data, table));
    /*$('#donne table').DataTable( {
        data: data,
        columns: [
            { data: 'Name' },
            { data: 'Address' },
            { data: 'mail' },
            { data: 'telephone' }
        ]
    });*/
}

function mktable(data, table){
    out = '<table class="table table-striped">\n<thead>\n<tr>';
    for(i in Object.keys(data[0])){
        out += "<th>"+Object.keys(data[0])[i]+"</th>";
    }
    out+= "</tr>\n</thead>";
    out+="<tbody>";
    for(i in data) {
        out += "<tr>";
        for (x in data[i]) {
            if(data[i][x] == null){
                out += "<td></td>";
            }else{
                out += "<td>"+data[i][x]+"</td>";
            }
        }
        out+= "</tr>"
    }
    out += "</tbody>\n</table>";
    return out;
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

function groups(param=false){
    var tableau = "";
    let input = ["address", "sport", "nbrParticipants"];
    var data = JSON.parse(ajax('annonce'));
    if(param){
        for(let i in data){
            tableau +=makeCard(data[i])
        }
    }else{
        input.map((value)=>{
            if($('#'+value).val()!=""){
                data.map((val, index)=>{
                    if(val[value] == $('#'+value).val()){
                        tableau += makeCard(val);
                        delete data[index];
                    }
                });
            }
        });
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

function changeDonnee(){
    if($('#prenom')){
        let cle = ['nom', 'prenom', 'pseudo', 'date', 'email', 'address', 'zipCode'];
        let data = [];
        for(i in cle){
            //console.log($('#'+cle[i]).val());
            data.push($('#'+cle[i]).val());
        }
        // console.log(data);
        ajax('update', data);
    }else{
        let cle = ['nom', 'telephone', 'email', 'address', 'zipCode'];
        let data = [];
        for(i in cle){
            //console.log($('#'+cle[i]).val());
            data.push($('#'+cle[i]).val());
        }
        console.log(data);
        console.log(ajax('update', data));

    }
}

//fonctionne pas la vriable $_FILES est vide (la requete dans request.php est plus là)
function avatar(){
    console.log(ajax('img'));
}

function disponnibilite(){
    $('#calendar').css("background-color","whitesmoke").fullCalendar({
        defaultView: 'agendaWeek',
        locale: 'fr',
        selectable: true,
        select: function(start, end){updateTable({'start':start, 'end':end})}
    });
}