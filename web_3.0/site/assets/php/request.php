<?php
require_once ('db.inc.php');
switch (true){
    case($_POST['action'] == 'login'):
        $iDB = new Db();
        $iDB->Login();
        header('location: ../../acceuil.php');
        break;
    case($_POST['action'] == 'inscription'):
        $iDB = new Db();
        if($_POST['id']=='client'){
            $iDB->inscription_client();
        }else{
            $iDB->inscription_club();
        }
        header('location: ../../acceuil.php');
        break;
    case($_POST['action'] == 'terrain'):
        $iDB = new Db();
        die (json_encode($iDB->getTerrains($_POST['id'])));
        break;
    case($_POST['action'] == 'calendar'):
        $iDb = new Db();
        die(json_encode($iDb->Reserve($_POST['id'])));
        break;
    case($_POST['action'] == 'suppTerrains'):
        $iDb = new Db();
        $iDB->suppTerrains($_POST['id']);
        break;
    case($_POST['action'] == 'isfree'):
        $iDb = new Db();
        $date = $iDb->Reserve($_POST['id']['id']);
        if(in_array($_POST['id']['start'], $date)) return false;
        if(in_array($_POST['id']['end'], $date)) return false;
        $iDb->makeReservation($_POST['id']);
        die(true);
        break;
}

if(isset($_POST['inscription_client'])){
    $iDB = new Db();
    $iDB->inscription_client();
    header('location: /acceuil.php');
}elseif(isset($_POST['inscription_club'])){
    $iDB = new Db();
    $iDB->inscription_club();
    header('location: /acceuil.php');
}
if(isset($_POST['login'])){
    $iDB = new Db();
    $iDB->login();
    header('location: /acceuil.php');
}
if(isset($_POST['ajoutTerrain'])){
    Terrain('ajout');
}
function terrain($choix, $param=[]){
    $iDB = new Db();
    switch ($choix){
        case('supp'):
            $iDB->suppTerrains($param);
            break;
        case('get'):
            return $iDB->getTerrains($param);
            break;
        case('ajout'):
            $iDB->addTerrains();
            break;
        default:
            die("erreur function Terrain");
            break;
    }
    return 0;
}

function data_calendario(){
    $iDb = new Db();
    return $iDb->testReserve();
}