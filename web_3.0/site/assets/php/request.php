<?php
require_once ('db.inc.php');  // db
switch (true){  // appelle ajax
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
        die(true);
        break;
    case($_POST['action'] == 'reservation'):
        $iDb = new Db();
        $iDb->makeReservation($_POST['id']);
        break;
    case($_POST['action'] == 'amis'):
        $iDb = new Db();
        $out = [];
        $out[0] = $iDb->mAmis($_POST['id'] == null?"tout":$_POST['id']);
        if($_POST['id'] != null){
            array_push($out, $iDb->lookForFriends($_POST['id']));
        }
        die(json_encode($out));
        break;
    case($_POST['action'] == 'annonce'):
        $iDb = new Db();
        die(json_encode($iDb->groups()));
        break;
    case($_POST['action'] == 'rejoindreGroup'):
        $iDb = new Db();
        //die(json_encode($iDb->inscGroups($_POST['id'])));
        if($iDb->inscGroups($_POST['id']) == 1){
            die('vous etes déjà dans ce groupe');
        }else{
            die("votre inscription à bien été enregistrée");
        }
        break;
    case($_POST['action'] == 'mreserve'):
        $iDb = new Db();
        if($_POST['id'] == "list") {
            die(json_encode($iDb->mreserve()));
        }else{
            die(json_encode($iDb->listGroup($_POST['id'])));
        }
        break;
    case($_POST['action'] == 'annulerGroupe'):
        $iDb = new Db();
        die($iDb->annuGroupe($_POST['id']));
        break;
    case($_POST['action'] == 'update'):
        $iDb = new Db();
        $iDb->update($_POST['id']);
        break;
    case($_POST['action'] == 'club'):
        $iDb = new Db();
        die(json_encode($iDb->getClubs($_POST['id'])));
        break;
    case($_POST['action'] == 'lookForFace'):
        die(lookForFace($_POST['id']));
        break;
    case($_POST['action'] == 'addFriend'):
        $iDb = new Db();
        $iDb->addFriend($_POST['id']);
        break;
    case($_POST['action'] == 'horraire'):
        $iDb = new Db();
        if(key($_POST['id']) == 'save'){
            $iDb->horraire('save',$_POST['id']);
        }elseif(key($_POST['id']) == 'get'){
            die(json_encode($iDb->horraire('get',$_POST['id'])));
        }elseif(key($_POST['id']) == 'add'){
            die($iDb->horraire('add',$_POST['id']));
        }
        break;
}

// post
if(isset($_POST['inscription_client'])){
    $iDB = new Db();
    $iDB->inscription_client();
    header('location: /acceuil.php');
}elseif(isset($_POST['inscription_club'])){
    $iDB = new Db();
    $iDB->inscription_club();
    header('location: /acceuil.php');
}elseif(isset($_POST['login'])){
    $iDB = new Db();
    if(isset($_POST['remember'])){//cookie
        setcookie("pseudo",$_POST['pseudo'], time() + (86400 * 10), "/");
        setcookie("mdp",$_POST['mdp'], time() + (86400 * 10), "/");
    }
    $iDB->login();
    //print_r($_POST);
    header('location: /acceuil.php');
}elseif(isset($_POST['ajoutTerrain'])){
    Terrain('ajout');
}elseif(isset($_POST['img'])){
    $target_dir = $_SERVER['DOCUMENT_ROOT']."/uploads/";
    $target_dir = isset($_SESSION['user']) ? $target_dir."user/" . $_SESSION['user']['userPseudo'] : $target_dir."club/" . $_SESSION['club']['Name'];
    $target_file = $target_dir.".". array_reverse(explode(".", basename($_FILES["fileToUpload"]["name"])))[0];
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
            die("File is not an image.");
        }
    }
// Check if file already exists
    if (file_exists($target_file)) {
        $uploadOk = 0;
        die("Sorry, file already exists.");
    }
// Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        $uploadOk = 0;
        die("Sorry, your file is too large.");
    }
// Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
        $uploadOk = 0;
        die("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
    }
// Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        die("Sorry, your file was not uploaded.");
// if everything is ok, try to upload file
    } else {
        //die(isset($_SESSION['user'])?"/uploads/user/".$_SESSION['user']['userPseudo']."/". basename($_FILES["fileToUpload"]["name"]):"/uploads/club/".$_SESSION['club']['Name']."/". basename($_FILES["fileToUpload"]["name"]));
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            header('location: /compte.php');
            die("The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.");
        } else {
            die("Sorry, there was an error uploading your file.");
        }
    }
}elseif(isset($_POST['contact'])){
    mailTo();
}

function terrain($choix, $param=[]){  //fonction pour ajouter, supprimer, retourner un terrain
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

function lookForFace($name){  // recherche l'image correspondant a l'utilisateur
    $extention = ['.jpg', '.png', '.jpeg', '.gif'];
    $out = "/assets/img/default_profile.jpg";
    foreach ($extention as $value){
        $existe = file_exists($_SERVER['DOCUMENT_ROOT']."/uploads/" . (isset($_SESSION['user'])?"user/":"club/").$name.$value);
        if($existe) {
            $out = "/uploads/" . (isset($_SESSION['user'])?"user/":"club/").$name.$value;
        }
    }
    return($out);
}