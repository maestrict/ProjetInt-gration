function ajax(rq,idTerrain){
    //alert(idTerrain);
    $.post("?rq=assets/php/utils.php",{action: rq, id: idTerrain});
}

function chg_img(){
    alert("changer votre image avatar?");
}
