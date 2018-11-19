function ajax(rq,args=''){
    let data = '';
    $.ajaxSetup({async:false});
    $.post("assets/php/request.php",{action: rq, id: args}, function( x ) {
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

function detail(button){
    alert("id du terrain selectionné: "+button.parentNode.parentNode.id);
}