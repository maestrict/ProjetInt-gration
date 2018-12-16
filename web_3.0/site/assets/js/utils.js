function ajax(rq,args=''){ // appele ajax à la db en synchrone retourne une valeur
    let data = '';
    $.ajaxSetup({async:false});
    $.post("/assets/php/request.php",{action: rq, id: args}, function( x ) {
        data = x;
    });
    return data;
}

/*function getEvent(to, args=''){
    $('#'+to).text(ajax('terrain', args));
}*/

function updateTable(select){ // actualise la liste des terrains en fonction des critaires de recherche
    // console.log(select.id);
    // console.log(select.value);
    // console.log(select);
    deleteMarkers();
    let table = [];
    if(select.id) {
        table = JSON.parse(ajax('terrain', {[select.id]: select.value}));
    }else{ // si critaire de recherche est disponibilité
        var terrain = [];
        let start = moment(select['start']).format('YYYY-MM-DD HH:mm:00');
        let end = moment(select['end']).format('YYYY-MM-DD HH:mm:00');
        table = JSON.parse(ajax('terrain', {"dispo" : {'start':start, 'end': end}})); // liste des event qui ne sont PAS disponible
        table.map((value, index) =>{
            if(table[index]['startDate'] == end){ // si l'event est juste après alors on suprime l'event probleme
                delete table[index];
            }
            else if(table[index]['finDate'] == start){ // si l'event est juste avant alors on suprime l'event probleme
                delete  table[index];
            }
        });
        table = table.filter(function () { return true });
        terrain = table.map(x =>x['idTerrain']);
        table = JSON.parse(ajax('terrain',{'notId': terrain}));
    }
    $('#club').html();  // liste des clubs
    let id = [];
    for(let i in table){
       addMarker(table[i]);  // ajoute un marker
        id.push(table[i]["clubId"]);
    }
    $('#calendar').fullCalendar('destroy');  // enleve un eventuel calendrié
    id = Array.from(new Set(id));
    // console.log(id);
    let data = JSON.parse(ajax('club', id));
    $('#club').html(mktable(data, table));
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

function mktable(data, table){  // construit table des club
    let out = '<table class="table table-striped">\n<thead>\n<tr>';
    for(i in Object.keys(data[0])){
        out += "<th>"+Object.keys(data[0])[i]+"</th>";
    }
    out+= "</tr>\n</thead>";
    out+="<tbody>";
    for(let i in data) {
        out += "<tr>";
        for (let x in data[i]) {
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

function makeCard(data){  // construit les cartes des evenements
    let out = "<div class='annonce'>";
    out += "<div class='row'>";
    out += "<div class='col'>";
    //out += "identifiant du groupe: "+data['groupeid']+"<br>";
    out += "Place(s) libre(s): "+(data['nbrParticipants']-data['inscrit'])+"<br>";
    out += "Date: "+format(data["startDate"].split(' ')[0],"dd-mm-aaaa")+", de "+data["startDate"].split(' ')[1]+" à "+data["finDate"].split(' ')[1];
    out += "</div>";
    out += "<div class='col'>";
    out += "Localisation: "+ data['address']+"<br>";
    out += "Sport: "+ data['sport']+"<br>";
    out += "<input type='button' name='join' class='blue btn btn-primary' value='Rejoindre' onclick='rejoindre(\""+data['idgroupe']+"\")'>";
    out += "</div>";
    out += "</div>";
    out += "";
    out +="</div>";
    return out;
}

function load(id, page){  // charge une page dans la div #contain
    $('#contain').fullCalendar('destroy');
    $('#'+id).load("assets/php/"+page+".php");
}

function chercheUser(name){ // cherche dans tout les utilisateurs de la plateforme
    tabAmis(ajax('amis', name), true);
}

function mesAmis(){  // cherche dans mes amis
    tabAmis((ajax('amis', null)));
}

function groups(param=false){  // liste des groups cherchant un/des joueurs
    var tableau = "";
    let input = ["address", "sport", "date", "nbrParticipants"];
    var data = JSON.parse(ajax('annonce'));
    if(param){
        for(let i in data){
            tableau +=makeCard(data[i])
        }
    }else{
        input.map((value)=>{
            if($('#'+value).val()!=""){
                if(value=="date"){
                    data.map((val, index) => {
                        let test = val["startDate"].split(' ')[0];
                        if ( test == $('#' + value).val()) {
                            tableau += makeCard(val);
                            delete data[index];
                        }
                    });
                }else {
                    data.map((val, index) => {
                        if (val[value] == $('#' + value).val()) {
                            tableau += makeCard(val);
                            delete data[index];
                        }
                    });
                }
            }
        });
    }
    $('#listAnnonces').html(tableau);
}

function rejoindre(id){  // rejoindre un groups
    alert(ajax('rejoindreGroup', id));
    groups();
}

function lsReserve(data){  // cartes de reservations
    let out = "<div class='annonce'>";
    out += "<div class='row'>";
    out += "<div class='col'>";
    // out += "identifiant du groupe: "+data['groupeid']+"<br>";
    out += "Inscrits: <br>";
    var inscrit = JSON.parse(ajax('mreserve',data['groupeid']));
    for(let i in inscrit){
        out += "- "+inscrit[i]['userPseudo']+"<br>";
    }
    out += "Date: "+format(data["startDate"].split(' ')[0],"dd-mm-aaaa")+", de "+data["startDate"].split(' ')[1]+" à "+data["finDate"].split(' ')[1];
    out += "</div>";
    out += "<div class='col'>";
    out += "Localisation: "+ data['address']+"<br>";
    out += "Sport: "+ data['sport']+"<br>";
    out += "<input type='button' name='join' value='annuler' class='blue btn btn-primary' onclick='annuler(\""+data['groupeid']+"\")'>";
    out += "</div>";
    out += "</div>";
    out += "";
    out +="</div>";
    return out;
}

function mesReservations(){  // genere une liste reservations
    let data = JSON.parse(ajax('mreserve',"list"));
    let tableau="";
    for(let i in data){
        tableau +=lsReserve(data[i])
    }
    $('#reserve').html(tableau);
}

function annuler(id){  // annuler sa reservation
    alert(ajax('annulerGroupe', id));
    mesReservations();
}

function changeDonnee(){  // modification des données de l'utilisateurs sur page contact
    if($('#prenom').length > 0){  // si c'est un sportif
        let cle = ['nom', 'prenom', 'pseudo', 'date', 'email', 'address', 'zipCode'];
        let data = [];
        for(i in cle){  // parcours les inputs
            //console.log($('#'+cle[i]).val());
            if(cle[i] == 'date'){
                data.push(format($('#'+cle[i]).val(), "dd-mm-aaaa"));
            }else {
                data.push($('#' + cle[i]).val());
            }
        }
        // console.log(data);
        ajax('update', data);
    }else{  // si c'est un club
        let cle = ['nom', 'tel', 'email', 'address', 'zipCode'];
        let data = [];
        for(i in cle){
            //console.log($('#'+cle[i]).val());
            data.push($('#'+cle[i]).val());
        }
        console.log(data);
        console.log(ajax('update', data));

    }
}

function avatar(){
    console.log(ajax('img'));
}

function disponnibilite(){  // ouvre un calendrié pour selectionner le parametre de recherche disponibilité
    $('#terrain').css("display","none");
    $('#calendar').css("background-color","whitesmoke").fullCalendar({
        defaultView: 'agendaWeek',
        locale: 'fr',
        height: 300,
        selectable: true,
        select: function(start, end){updateTable({'start':start, 'end':end})}
    });
}

function tabAmis(data, find=false){  // tableau des amis et recherche d'amis si find=true

        //<img class="card-img-top" src="/assets/img/terrain.jpg" alt="Generic placeholder image" width="140" height="140">
    let out = "";
    let test = JSON.parse(data);
    for(let i in test[0]){
        out += "<div class='card ltamis'>";
        out += "<img class='card-img-top' src='"+ajax("lookForFace",test[0][i]['userPseudo'])+"' alt='"+test[0][i]['userPseudo']+"'>";
        out += "<div class='card-body'>";
        out += "<h2 class='card-title'>"+test[0][i]['FirstName']+"</h2>";
        out += "<p class='card-text'>Grâce à notre système de localisation des clubs et vos critères.</p>";
        out += "<a class='blue btn btn-secondary' href='#' role='button'>Profil »</a>";
        out += "</div>";
        out += "</div>";
    }
    $('#amis').html(out);
    if(find){
        out = "<hr>";
        out += "<div id='etrange' class='card-group'>";
        for(let i in test[1]){
            out += "<div class='card ltamis'>";
            out += "<img class='card-img-top' src='"+ajax("lookForFace",test[1][i]['userPseudo'])+"' alt='"+test[1][i]['userPseudo']+"'>";
            out += "<div class='card-body'>";
            out += "<h2 class='card-title'>"+test[1][i]['FirstName']+"</h2>";
            out += "<p class='card-text'>Grâce à notre système de localisation des clubs et vos critères.</p>";
            out += "<a class='blue btn btn-secondary' role='button' onclick='ajax(\"addFriend\","+test[1][i]['userId']+")'>Ajouter aux amis »</a>";
            out += "</div>";
            out += "</div>";
        }
        out += "</div>";
        if($('#etrange').length > 0){
            $('#etrange').html(out);
        }else{
            $('#list').append(out);
        }
    }
}

function format(date, format){  // change le format d'une date
    let Adate = date.split('-');
    let Aformat = format.split('-');
    let out = [];
    Aformat.map((val)=>{
        switch(val){
            case('aaaa'): out.push(Adate[0]);  // année
                break;
            case('mm'): out.push(Adate[1]);  // mois
                break;
            case('dd'): out.push(Adate[2]);  // jours
                break;
        }
    });
    return out.join('-');
}

function horraire(){  // page horraires du clubs
    let day = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];
    var start = new Object();
    var end = new Object();
    for(let i in day){
        start[day[i]] = $('#'+day[i]+"start").val();
    }
    for(let i in day){
        end[day[i]] = $('#'+day[i]+"end").val();
    }
    //console.log({'save':{'start':start,'end':end}});
    var test = ajax('horraire',{'save':{'start':start,'end':end}});
    //console.log(test);
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

function validateHhMm(inputField) {  // verifie la validité des inputs des heures d'horaire des clubs
    var isValid = /^([0-1]?[0-9]|2[0-4]):([0-5][0-9])(:[0-5][0-9])?$/.test(inputField.value);

    if (isValid) {
        inputField.style.backgroundColor = '#bfa';
    } else {
        inputField.style.backgroundColor = '#fba';
    }

    return isValid;
}

function getBusiness(clubId = null){  // return un object conforme à fullcalendar decrivant les horraires des clubs
    let data = JSON.parse(ajax('horraire',{'get':clubId}));
    //console.log(data);
    let day = ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'];
    let out = [];
    if(data.length == 0) return true;
    for(let index in day){
        out.push({dow:[parseInt(index)], start: data[0][day[index]+"Start"], end: data[0][day[index]+"End"]});
    }
    return out;
}