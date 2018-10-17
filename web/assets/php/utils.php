<?php
require_once('db.inc.php');

function dbInscription(){
    $iDB = new Db();
    $iDB->inscription();
    header("location: http://vps596525.ovh.net:8080/compte.php");
}
function dbLogin(){
    $iDB = new Db();
    $iDB->login();
    header('location: http://vps596525.ovh.net:8080/compte.php');
}

if(isset($_POST['inscription'])){
    dbInscription();
}elseif(isset($_POST['login'])){
    dbLogin();
}