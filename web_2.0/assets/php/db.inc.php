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
            if(!$data){//si pas dans la table user => c'est un club
                $query = $this->iPdo->prepare('SELECT clubId, Name, mail, mdp, address, zipCode FROM tbClub WHERE Name = :pseudo');
                $query->bindValue(':pseudo', $_POST['pseudo'], PDO::PARAM_STR);
                $query->execute();
                $data = $query->fetch(PDO::FETCH_ASSOC);
            }

            if (password_verify($_POST['mdp'], $data['mdp'])) // verification du hash mdp!
            {
                if(isset($_SESSION)){//si la session est set
                    session_unset();
                    session_destroy();
                }
                unset($data['mdp']);//pour ne pas prendre le mdp dans la session
                session_start();
                foreach ($data as $key =>$value){
                    if($key == 'dateBirth'){//pour la date de naissance traitement de forme
                        $_SESSION[isset($data['userId'])?'user':'club'][$key] = date('d/m/y',strtotime($data[$key]));
                    }
                    $_SESSION[isset($data['userId'])?'user':'club'][$key] = $data[$key];//tri pour ecrire dans session user ou session
                }
            } else // Acces pas OK !
            {
                echo("<script>alert('Mot de passe et/ou pseudo incorrect')</script>");
            }
            $query->CloseCursor();//fermer la connection
        }
    }

    public function inscription_client(){
        try{
            $date =date('y/m/d',strtotime($_POST['date']));// format de date
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
            $date =date('y/m/d',strtotime($_POST['date'])); // format de date
            $stmt = $this->iPdo->prepare("INSERT INTO tbClub(Name, mail,Address, mdp, dateInscription) VALUES(:Name, :mail, :address, :mdp, :inscription)");
            $stmt->bindParam(':Name',$_POST['nom']);
            $stmt->bindParam(':mail',$_POST['email']);
            $stmt->bindParam(':address',$_POST['address']);
            $stmt->bindParam(':mdp',password_hash($_POST['mdp'], PASSWORD_BCRYPT));
            $stmt->bindParam(':inscription',date("Y/m/d"));
            $stmt->execute();
        }
        catch(Exception $e){
            die("Erreur lors de la query");
        }
    }

    public function getTerrains($where=[]){
        try{
            $stmt = $this->iPdo->prepare("SELECT tId, Ter.clubId, Name, Ter.sId, Ter.address, sport, description, latitude, longitude 
                                                    FROM integration.tbTerrains as Ter
                                                    join integration.tbSport as Sp ON Ter.sId = Sp.sId
                                                    join integration.tbClub as Cl on Ter.clubId = Cl.clubId");
            if(is_array($where)){
                switch (key($where)){
                    // selection d'un club
                    case('club'):$stmt = $this->iPdo->prepare("SELECT tId, Ter.clubId, Name, Ter.sId, Ter.address, sport, description, latitude, longitude 
                                                        FROM integration.tbTerrains as Ter
                                                        join integration.tbSport as Sp ON Ter.sId = Sp.sId
                                                        join integration.tbClub as Cl on Ter.clubId = Cl.clubId
                                                        WHERE Cl.Name = :club;");
                        $stmt->bindParam(':club',$where['club']);
                        break;
                    // selection d'un sport
                    case('sport'):$stmt = $this->iPdo->prepare("SELECT tId, Ter.clubId, Name, Ter.sId, Ter.address, sport, description, latitude, longitude 
                                                        FROM integration.tbTerrains as Ter
                                                        join integration.tbSport as Sp ON Ter.sId = Sp.sId
                                                        join integration.tbClub as Cl on Ter.clubId = Cl.clubId
                                                        WHERE Sp.sport = :sport;");
                        $stmt->bindParam(':sport',$where['sport']);
                        break;
                    // selection d'une address
                    case('address'):$stmt = $this->iPdo->prepare("SELECT tId, Ter.clubId, Name, Ter.sId, Ter.address, sport, description, latitude, longitude 
                                                        FROM integration.tbTerrains as Ter
                                                        join integration.tbSport as Sp ON Ter.sId = Sp.sId
                                                        join integration.tbClub as Cl on Ter.clubId = Cl.clubId
                                                        WHERE Ter.address = :address;");
                        $stmt->bindParam(':address',$where['address']);
                        break;
                }
            }
            $stmt->execute();
            $data = [];
            while($temp = $stmt->fetch(PDO::FETCH_ASSOC)){// fetch des resultats dans $data
                array_push($data, $temp);
            }
            return $data;
        }
        catch(Exception $e){
            die("Erreur lors de la query");
        }
    }

    // ajout d'un terrain dans la db
    public function addTerrains(){
        try{
            $stmt = $this->iPdo->prepare("insert into integration.tbTerrains(sId, clubId) 
                                                    values(:sId, :clubId);");
            $stmt->bindParam(':clubId',$_SESSION['club']['clubId']);
            $stmt->bindParam(':sId',$_POST['sId']);
            $stmt->execute();
        }
        catch(Exception $e){
            die("Erreur lors de la query");
        }
    }

    //
    public function suppTerrains($id){
        try{
            $appel = 'call suppTerrain('.$id.')';
            $sth = $this->iPdo->prepare($appel);
            $sth->execute();
        }catch(PDOException $e){
            $this->pdoException = $e;
            return ['__ERR__' => $this->getException()];
        }
    }

    public function getSport(){
        try{
            $stmt = $this->iPdo->prepare("SELECT sId, sport, description
                                                   FROM integration.tbSport");
            $stmt->execute();
            $data = [];
            while($temp = $stmt->fetch(PDO::FETCH_ASSOC)){
                array_push($data, $temp);
            }
            return $data;
        }catch(Exception $e){
            die("Erreur lors de la query");
        }
    }

    public function addSport(){
        try{
            $date =date('y/m/d',strtotime($_POST['date']));
            $stmt = $this->iPdo->prepare("insert into integration.tbSport(sport, description) 
                                                    values(:sport, :description);");
            $stmt->bindParam(':sport',$_POST['sport']);
            $stmt->bindParam(':description',$_POST['description']);
            $stmt->execute();
        }
        catch(Exception $e){
            die("Erreur lors de la query");
        }
    }

    public function suppSport($id){
        try{
            $appel = 'call suppSport('.$id.')';
            $sth = $this->iPdo->prepare($appel);
            $sth->execute();
        }catch(PDOException $e){
            $this->pdoException = $e;
            return ['__ERR__' => $this->getException()];
        }
    }

    public function getClubs(){
        try{
            $stmt = $this->iPdo->prepare("SELECT clubPseudo, Name, address, mail
                                                   FROM integration.tbClub");
            $stmt->execute();
            $data = [];
            while($temp = $stmt->fetch(PDO::FETCH_ASSOC)){
                array_push($data, $temp);
            }
            return $data;
        }catch(Exception $e){
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

    function Reserve($tId){
        try{
            $stmt = $this->iPdo->prepare("SELECT id, idTerrain, startDate as start, finDate as end
                                                   FROM integration.reservation
                                                   WHERE idTerrain = :tId;");
            $stmt->bindParam(':tId',$tId);
            $stmt->execute();
            $data = [];
            while($temp = $stmt->fetch(PDO::FETCH_ASSOC)){
                array_push($data, $temp);
            }
            return $data;
        }
        catch(Exception $e){
            die("Erreur lors de la query");
        }
    }

    function makeReservation($data){
        try{
            $stmt = $this->iPdo->prepare("insert into reservation(idTerrain, startDate, finDate) 
                                                    values(:id, :start, :end );");
            $stmt->bindParam(':id',$data['id']);
            $stmt->bindParam(':start',$data['start']);
            $stmt->bindParam(':end',$data['end']);
            $stmt->execute();
        }
        catch(Exception $e){
            die("Erreur lors de la query");
        }
    }
}