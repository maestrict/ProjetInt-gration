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
function terrain($choix, $param=''){
    $iDB = new Db();
    switch ($choix){
        case('supp'):
            $iDB->suppTerrains($param);
            /*foreach ($_SESSION['terrains'] as $key => $value){
                if($value['tId'] == $param) unset($_SESSION['terrains'][$key]);
            }*/
            break;
        case('get'):
            $iDB->getTerrains();
            break;
        case('ajout'):
            $iDB->addTerrains();
            break;
        default:
            die("erreur function Terrain");
            break;
    }
}
function sport($choix, $param=''){
    $iDB = new Db();
    switch($choix){
        case('get'):
            return $iDB ->getSport();
            break;
        case('ajout'):
            $iDB ->addSport();
            break;
        case('supp'):
            return $iDB ->suppSport($param);
            break;
    }
}

if(isset($_POST['inscription_client'])){
    dbInscription("client");
}elseif(isset($_POST['inscription_club'])){
    dbInscription("club");
}elseif(isset($_POST['login'])){
    dbLogin();
}elseif(isset($_POST['change'])){
    dbUpdate();
}elseif(isset($_POST['ajoutTerrain'])){
    Terrain('ajout');
}elseif($_POST['action'] == 'suppTerrains'){
    Terrain('supp', $_POST['id']);
}elseif($_POST['action'] == 'suppSport'){
    sport('supp', $_POST['id']);
}elseif(isset($_POST['ajoutSport'])){
    sport('ajout');
}


