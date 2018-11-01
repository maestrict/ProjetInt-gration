<?php
session_start();

class Db{
    private $db = [];
    private $pdoException = null;
    private $iPdo = null;

    public function __construct(){
        try{
            $this->iPdo = new PDO('mysql:host='.$this->getServer().';dbname=integration'
                                ,'root','integration3');
            $this->iPdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        }catch(PDOException $e){
            $this->pdoException = $e;
        }
    }

    public function getException(){
        return 'PDOException : '.($this->pdoException ? $this->pdoException->getMessage() : "aucune !");
    }

    //retourne les params pour se co au serveur
    public function getServer(){
        return in_array($_SERVER['SERVER_NAME'],['51.68.71.73','vps596525.ovh.net'])
                ? 'localhost'
                : 'vps596525.ovh.net';
    }

    public function login()
    {
        if (empty($_POST['pseudo']) || empty($_POST['mdp'])) //Oublie d'un champ
        {
            die('<p>une erreur s\'est produite pendant votre identification.
    Vous devez remplir tous les champs</p>');
        } else //On check le mot de passe
        {
            $query = $this->iPdo->prepare('SELECT userId, userPseudo, LastName, FirstName, mdp, mail, dateBirth, address, zipCode FROM tbUsers WHERE userPseudo = :pseudo');
            $query->bindValue(':pseudo', $_POST['pseudo'], PDO::PARAM_STR);
            $query->execute();
            $data = $query->fetch(PDO::FETCH_ASSOC);
            //echo "test data =".$data;
            if(!$data){//si pas dans la table user => c'est un club
                $query = $this->iPdo->prepare('SELECT clubId, clubPseudo, Name, mail, mdp, address, zipCode FROM tbClub WHERE clubPseudo = :pseudo');
                $query->bindValue(':pseudo', $_POST['pseudo'], PDO::PARAM_STR);
                $query->execute();
                $data = $query->fetch(PDO::FETCH_ASSOC);
            }

            if (password_verify($_POST['mdp'], $data['mdp'])) // Accès OK !
            {
                if(isset($_SESSION)){
                    session_unset();
                    session_destroy();
                }
                unset($data['mdp']);//pour ne pas prendre le mdp dans la session
                session_start();
                foreach ($data as $key =>$value){
                    $_SESSION[isset($data['userId'])?'user':'club'][$key] = $data[$key];
                }
            } else // Acces pas OK !
            {
                die ("<script>alert('Mot de passe et/ou pseudo incorrect')</script>");
            }
            $query->CloseCursor();
        }
    }

    public function inscription_client(){
        try{
            $date =date('y/m/d',strtotime($_POST['date']));
            $stmt = $this->iPdo->prepare("INSERT INTO tbUsers(userPseudo, LastName, FirstName, mdp, mail, dateInscription, dateBirth ) VALUES(:userPseudo, :LastName, :FirstName, :mdp, :mail, :inscription, :birth)");
            $stmt->bindParam(':userPseudo',$_POST['pseudo']);
            $stmt->bindParam(':LastName',$_POST['nom']);
            $stmt->bindParam(':FirstName',$_POST['prenom']);
            $stmt->bindParam(':mdp', password_hash($_POST['mdp'], PASSWORD_BCRYPT)); // Choix de l'algorithme de hashage <!> si 1 varchar 255 dans la db
            $stmt->bindParam(':mail',$_POST['email']);
            $stmt->bindParam(':inscription',date("Y/m/d"));
            $stmt->bindParam(':birth',$date);
            $stmt->execute();
        }catch(Exception $e){
            die("Erreur lors de la query");
        }
        $this->login();
    }

    public function inscription_club(){
        try{
            $date =date('y/m/d',strtotime($_POST['date']));
            $stmt = $this->iPdo->prepare("INSERT INTO tbClub(clubPseudo, Name, mail,zipcode, mdp, dateInscription) VALUES(:clubPseudo, :Name, :mail, :zipcode, :mdp, :inscription)");
            $stmt->bindParam(':clubPseudo',$_POST['clubPseudo']);
            $stmt->bindParam(':Name',$_POST['nom']);
            $stmt->bindParam(':mail',$_POST['email']);
            $stmt->bindParam(':zipcode',$_POST['zipcode']);
            $stmt->bindParam(':mdp',password_hash($_POST['mdp'], PASSWORD_BCRYPT));
            $stmt->bindParam(':inscription',date("Y/m/d"));
            $stmt->execute();
        }
        catch(Exception $e){
            die("Erreur lors de la query");
        }
    }

    public function getTerrains(){
        try{
            $date =date('y/m/d',strtotime($_POST['date']));
            $stmt = $this->iPdo->prepare("SELECT tId, clubId, Ter.sId, sport, description, reserve 
                                                   FROM integration.tbTerrains as Ter
                                                   join integration.tbSport as Sp 
                                                   WHERE clubId = :id;");
            $stmt->bindParam(':id',$_SESSION['club']['clubId']);
            $stmt->execute();
            $data = [];
            while($temp = $stmt->fetch(PDO::FETCH_ASSOC)){
                array_push($data, $temp);
            }
            echo"data:";
            print_r($data);
            foreach ($data as $key =>$value){
                $_SESSION['terrains'][$key] = $data[$key];
            }
        }
        catch(Exception $e){
            die("Erreur lors de la query");
        }
    }

    public function suppTerrains(){
        try{
            $date =date('y/m/d',strtotime($_POST['date']));
            $stmt = $this->iPdo->prepare("DELETE FROM integration.tbTerrains WHERE tId = :id;");
            $stmt->bindParam(':id',$_POST[]);
            //$stmt->execute();
            print_r($_POST);
        }
        catch(Exception $e){
            die("Erreur lors de la query");
        }
    }

    public function addTerrains(){
        try{
            $date =date('y/m/d',strtotime($_POST['date']));
            $stmt = $this->iPdo->prepare("insert into integration.tbTerrains(tId, sId, clubId, reserve) 
                                                    values(:tId, :sId, :clubId, :reserve);");
            $stmt->bindParam(':tId',$_POST['tId']);
            $stmt->bindParam(':clubId',$_SESSION['club']['clubId']);
            $stmt->bindParam(':sId',$_POST['sId']);
            $stmt->bindParam(':reserve',$_POST['reserve']);
            $stmt->execute();
        }
        catch(Exception $e){
            die("Erreur lors de la query");
        }
    }

    public function update($isUser){
        if($isUser){
            try{
                $stmt = $this->iPdo->prepare("UPDATE integration.tbUsers
SET userPseudo = :pseudo, LastName = :lastName, FirstName = :firstName, address = :address, zipCode = :zipCode, mail = :mail
WHERE userId = :id");
                $stmt->bindParam(':id',$_SESSION['user']['userId']);
                $stmt->bindParam(':pseudo',$_POST['pseudo']);
                $stmt->bindParam(':lastName',$_POST['nom']);
                $stmt->bindParam(':firstName',$_POST['prenom']);
                $stmt->bindParam(':address',$_POST['address']);
                $stmt->bindParam(':zipCode',$_POST['zipCode']);
                $stmt->bindParam(':mail',$_POST['email']);
                //$stmt->bindParam(':mdp',password_hash($_POST['mdp'], PASSWORD_BCRYPT));
                $stmt->execute();
//                if($stmt->rowCount()) {
//                    echo 'success';
//                } else {
//                    echo 'update failed';
//                }
            }
            catch(Exception $e){
                die("Erreur lors de la query d'update user");
            }
        }else{
            try{
                $stmt = $this->iPdo->prepare("UPDATE integration.tbClub
SET clubPseudo = :pseudo, Name = :Name, Address = :address, zipCode = :zipCode, mail = :mail, telephone = :telephone
WHERE clubId = :id");
                echo("post:");
                print_r($_POST);
                echo("session:");
                print_r($_SESSION);
                $stmt->bindParam(':id',$_SESSION['club']['clubId']);
                $stmt->bindParam(':pseudo',$_POST['pseudo']);
                $stmt->bindParam(':Name',$_POST['nom']);
                $stmt->bindParam(':address',$_POST['address']);
                $stmt->bindParam(':zipCode',$_POST['zipcode']);
                $stmt->bindParam(':mail',$_POST['email']);
                $stmt->bindParam(':telephone',$_POST['tel']);
                $stmt->execute();
            }
            catch(Exception $e){
                die("Erreur lors de la query d'update club");
            }
        }
    }

    //appele des procédure enregistré sur le serveur
    public function call($nom, $param = []){
        $tab=[];
        switch($nom){
            //2param
            case 'whois': $tab[]='?';
            //1param
            case 'userProfil':
            case 'mc_group':
            case 'mc_coursesGroup': $tab[]='?';
            //0param
            case 'mc_allGroups':
                try {
                    $appel = 'call '.$nom.'('.implode(',',$tab).')';
                    $sth = $this->iPdo->prepare($appel);
                    $sth->execute($param);
                    return $sth->fetchAll(PDO::FETCH_ASSOC);
                }catch(PDOException $e){
                    $this->pdoException = $e;
                    return ['__ERR__' => $this->getException()];
                }
            break;
            default: return ['__ERR__' => 'call impossible à '.$nom];
        }
    }
}