<?php
require_once('db.inc.php');

function dbInscription($status){
    $iDB = new Db();
    switch($status){
        case "client":$iDB->inscription_client();
            break;
        case "club":$iDB->inscription_club();
            break;
    }
    header("location: http://vps596525.ovh.net:8080/compte.php");
}
function dbLogin(){
    $iDB = new Db();
    $iDB->login();
    header('location: http://vps596525.ovh.net:8080/compte.php');
}
function dbUpdate(){
    $iDB = new Db();
    $iDB->update(isset($_SESSION['user'])?true:false);
}

if(isset($_POST['inscription_client'])){
    dbInscription("client");
}elseif(isset($_POST['inscription_club'])){
    dbInscription("club");
}elseif(isset($_POST['login'])){
    dbLogin();
}elseif(isset($_POST['change'])){
    dbUpdate();
}
