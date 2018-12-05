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

    public function login($update = false, $pseudo="")
    {
        if (empty($_POST['pseudo']) || empty($_POST['mdp'] && $update == false)) //Oublie d'un champ
        {
            die('<p>une erreur s\'est produite pendant votre identification.
    Vous devez remplir tous les champs</p>');
        } else //On check le mot de passe
        {
            $query = $this->iPdo->prepare('SELECT userId, userPseudo, LastName, FirstName, mdp, mail, dateBirth, address, zipCode FROM tbUsers WHERE userPseudo = :pseudo');
            $query->bindValue(':pseudo', $update == false?$_POST['pseudo']:$pseudo, PDO::PARAM_STR);
            $query->execute();
            $data = $query->fetch(PDO::FETCH_ASSOC);
            if(!$data){//si pas dans la table user => c'est un club
                $query = $this->iPdo->prepare('SELECT clubId, Name, mail, mdp, address, zipCode FROM tbClub WHERE Name = :pseudo');
                $query->bindValue(':pseudo', $update == false?$_POST['pseudo']:$pseudo, PDO::PARAM_STR);
                $query->execute();
                $data = $query->fetch(PDO::FETCH_ASSOC);
            }

            if (password_verify($_POST['mdp'], $data['mdp']) || $update == true) // verification du hash mdp!
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
                    // selection d'un code postal
                    case('zip'):$stmt = $this->iPdo->prepare("SELECT tId, Ter.clubId, Name, Ter.sId, Ter.address, sport, description, latitude, longitude, ville
                                                        FROM integration.tbTerrains as Ter
                                                        join integration.tbSport as Sp ON Ter.sId = Sp.sId
                                                        join integration.tbClub as Cl on Ter.clubId = Cl.clubId
                                                        join integration.cities as city on Cl.zipCode = city .zip
                                                        WHERE Cl.zipCode = :zip;");
                        $stmt->bindParam(':zip',$where['zip']);
                        break;
                    // selection d'un creneau horraire
                    case('dispo'):
                        $stmt = $this->iPdo->prepare("SELECT * FROM integration.reservation
                                                        where startDate between :start and :end
                                                        or finDate between :start and :end; ");
                        $stmt->bindParam(':start', $where['dispo']['start']);
                        $stmt->bindParam(':end', $where['dispo']['end']);
                        break;
                    // selection d'une address et sport
                    case('spec'):$stmt = $this->iPdo->prepare("SELECT tId, Ter.clubId, Name, Ter.sId, Ter.address, sport, description, latitude, longitude 
                                                        FROM integration.tbTerrains as Ter
                                                        join integration.tbSport as Sp ON Ter.sId = Sp.sId
                                                        join integration.tbClub as Cl on Ter.clubId = Cl.clubId
                                                        WHERE Ter.address = :address and sport = :sport;");
                        $stmt->bindParam(':address',$where['spec'][0]);
                        $stmt->bindParam(':sport',$where['spec'][1]);
                        break;
                    // selection inverse d'id
                    case('notId'):$stmt = $this->iPdo->prepare("SELECT tId, Ter.clubId, Name, Ter.sId, Ter.address, sport, description, latitude, longitude 
                                                        FROM integration.tbTerrains as Ter
                                                        join integration.tbSport as Sp ON Ter.sId = Sp.sId
                                                        join integration.tbClub as Cl on Ter.clubId = Cl.clubId
                                                        WHERE tid not in (:id);");
                        $stmt->bindParam(':id',implode( ",",$where['notId']));
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

    public function getClubs($id){
        try{
            $stmt = $this->iPdo->prepare("select * from tbClub
                                                    left join cities as city on zipCode = city.zip
                                                   Where clubId IN (".implode(',', $id).") ");
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

    public function update($data){
        if(sizeof($data)>6){
            try{
                $stmt = $this->iPdo->prepare("UPDATE integration.tbUsers
SET userPseudo = :pseudo, LastName = :lastName, FirstName = :firstName, address = :address, zipCode = :zipCode, mail = :mail, dateBirth = :birth
WHERE userId = :id");
                $stmt->bindParam(':id',$_SESSION['user']['userId']);
                $stmt->bindParam(':lastName',$data[0]);
                $stmt->bindParam(':firstName',$data[1]);
                $stmt->bindParam(':pseudo',$data[2]);
                $stmt->bindParam(':birth',$data[3]);
                $stmt->bindParam(':mail',$data[4]);
                $stmt->bindParam(':address',$data[5]);
                $stmt->bindParam(':zipCode',intval($data[6]));
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
            $this->login(true, $_POST['pseudo']);
        }else{
            try{
                $stmt = $this->iPdo->prepare("UPDATE integration.tbClub
SET Name = :Name, Address = :address, zipCode = :zipCode, mail = :mail, telephone = :telephone
WHERE clubId = :id");
                $stmt->bindParam(':id',$_SESSION['club']['clubId']);
                $stmt->bindParam(':Name',$data[0]);
                $stmt->bindParam(':telephone',$data[1]);
                $stmt->bindParam(':mail',$data[2]);
                $stmt->bindParam(':address',$data[3]);
                $stmt->bindParam(':zipCode',$data[4]);
                $stmt->execute();
            }
            catch(Exception $e){
                die("Erreur lors de la query d'update club");
            }
            $this->login(true, $_POST['nom']);
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
            $grid = explode(" ", $data['start'])[1].explode("-", explode(" ", $data['start'])[0])[2].explode("-", explode(" ", $data['start'])[0])[1].$data['id'].$_SESSION['user']['userId'];
            $stmt = $this->iPdo->prepare("insert into tbGroupe(groupeid, userid) 
                                                    values(:idgroupe, :user);");
            $stmt->bindParam(':idgroupe',$grid);
            $stmt->bindParam(':user',$_SESSION['user']['userId']);
            $stmt->execute();

            $stmt = $this->iPdo->prepare("insert into reservation(idTerrain, startDate, finDate, idgroupe, nbrParticipants) 
                                                    values(:id, :start, :end , :idgroupe, :nbrP);");
            $stmt->bindParam(':id',$data['id']);
            $stmt->bindParam(':start',$data['start']);
            $stmt->bindParam(':end',$data['end']);
            $stmt->bindParam(':idgroupe',$grid);
            $stmt->bindParam(':nbrP',$data['participant']);
            $stmt->execute();
        }
        catch(Exception $e){
            die("Erreur lors de la query");
        }
    }

    function mreserve(){
        try{
            $stmt = $this->iPdo->prepare("SELECT cpt.userid, cpt.groupeid, idTerrain, startDate, finDate, ter.sId, address, sport
                                                    from integration.reservation as reserve
                                                    join integration.tbGroupe as cpt on reserve.idgroupe = cpt.groupeid
                                                    join integration.tbTerrains as ter on reserve.idTerrain = ter.tId
                                                    join integration.tbSport as sp on ter.sId = sp.sId
                                                    where cpt.userid = :id");
            $stmt->bindParam(':id',$_SESSION['user']['userId']);
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

    function annuGroupe($id){
        try{
            $stmt = $this->iPdo->prepare("select * from tbGroupe where groupeid = :id;");
            $stmt->bindParam(':id',$id);
            $stmt->execute();
            $data = [];
            while($temp = $stmt->fetch(PDO::FETCH_ASSOC)){
                array_push($data, $temp);
            }
        }
        catch(Exception $e){
            die("Erreur lors de la query");
        }
        try{
            $appel = "call suppDeGroupe(\"{$id}\",{$_SESSION['user']['userId']})";
            //return $appel;
            $sth = $this->iPdo->prepare($appel);
            $sth->execute();
        }catch(PDOException $e){
            $this->pdoException = $e;
            return ['__ERR__' => $this->getException()];
        }
        if(count($data)<2){
            try{
                $appel = "call suppReserve(\"{$id}\")";
                //return $appel;
                $sth = $this->iPdo->prepare($appel);
                $sth->execute();
            }catch(PDOException $e){
                $this->pdoException = $e;
                return ['__ERR__' => $this->getException()];
            }
        }
        die("suppression reussie");
    }

    function mAmis($name){
        try{
            if($name == "tout"){
                $stmt = $this->iPdo->prepare("SELECT relid, fr.userid,  FirstName, userPseudo, dateBirth
                                                    FROM integration.friend as fr
                                                    join integration.tbUsers as user on fr.friendid = user.userid
                                                    WHERE fr.userid = :id;");
                $stmt->bindParam(':id',$_SESSION['user']['userId']);
            }else {
                $stmt = $this->iPdo->prepare("SELECT relid, fr.userid,  FirstName, userPseudo, dateBirth
                                                    FROM integration.friend as fr
                                                    join integration.tbUsers as user on fr.friendid = user.userid
                                                    WHERE FirstName = :name and fr.userid = :id;");
                $stmt->bindParam(':name',$name);
                $stmt->bindParam(':id',$_SESSION['user']['userId']);
            }
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

    function lookForFriends($name){
        try{
            $stmt = $this->iPdo->prepare("select * 
                                              from integration.tbUsers
                                              where userPseudo = :name or FirstName = :name or LastName = :name;");
            $stmt->bindParam(':name',$name);
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

    function addFriend($id){
        try{
            $stmt = $this->iPdo->prepare("INSERT INTO integration.friend(userid, friendid)
                                                    VALUES(:moi,:id);");
            $stmt->bindParam(':id',$id);
            $stmt->bindParam(':moi',$_SESSION['user']['userId']);
            $stmt->execute();
        }catch(Exception $e){
            die("Erreur lors de la query");
        }
        $this->login();
    }

    function groups(){
        try{
            $stmt = $this->iPdo->prepare("SELECT id, nbrParticipants, groupeid, inscrit, idTerrain, startDate, finDate, idgroupe, ter.sId, address, sport
                                                    from integration.reservation as reserve
                                                    join (SELECT groupeid, count(userid) as inscrit
		                                                  from integration.tbGroupe
		                                                  group by groupeid)as cpt on reserve.idgroupe = cpt.groupeid
                                                    join integration.tbTerrains as ter on reserve.idTerrain = ter.tId
                                                    join integration.tbSport as sp on ter.sId = sp.sId
                                                    where nbrParticipants > 1 and nbrParticipants > inscrit;");
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

    function listGroup($id){
        try{
            $stmt = $this->iPdo->prepare("SELECT * 
                                                    FROM integration.tbGroupe as grp
                                                    join integration.tbUsers as user on grp.userid = user.userId
                                                    where groupeid = :id;");
            $stmt->bindParam(':id',$id);
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

    function inscGroups($id){
        try{
            $stmt = $this->iPdo->prepare("select userid
                                                   from integration.tbGroupe
                                                   where groupeid = :id;");
            $stmt->bindParam(':id',$id);
            $stmt->execute();
            $data = [];
            while($temp = $stmt->fetch(PDO::FETCH_ASSOC)){
                array_push($data, $temp['userid']);
            }
        }
        catch(Exception $e){
            die("Erreur lors de la query");
        }
        if(in_array($_SESSION['user']['userId'], $data)){
            return 1;
        }
        try{
            $date =date('y/m/d',strtotime($_POST['date']));
            $stmt = $this->iPdo->prepare("insert into integration.tbGroupe(groupeid, userid) 
                                                    values(:groupe, :user);");
            $stmt->bindParam(':groupe',$id);
            $stmt->bindParam(':user',$_SESSION['user']['userId']);
            $stmt->execute();
        }
        catch(Exception $e){
            die("Erreur lors de la query");
        }
        return 0;
    }

    function getCity(){
        try{
            $stmt = $this->iPdo->prepare("select ville from integration.cities");
            $stmt->execute();
            $data = [];
            while($temp = $stmt->fetch(PDO::FETCH_ASSOC)){
                array_push($data, $temp['ville']);
            }
            return $data;
        }catch(Exception $e){
            die("Erreur lors de la query");
        }
    }
}