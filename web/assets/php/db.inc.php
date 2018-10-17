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
            $query = $this->iPdo->prepare('SELECT userId, userPseudo, LastName, FirstName, mdp, mail, dateBirth FROM tbUsers WHERE userPseudo = :pseudo');
            $query->bindValue(':pseudo', $_POST['pseudo'], PDO::PARAM_STR);
            $query->execute();
            $data = $query->fetch();
            if(isset($_SESSION)){
                session_unset();
                session_destroy();
            }
            session_start();
            if ($data['mdp'] == $_POST['mdp']) // Acces OK !
            {
                foreach ($data as $key =>$value){
                    $_SESSION['user'][$key] = $data[$key];
                }
            } else // Acces pas OK !
            {
                echo "<script>alert('Mot de passe et/ou pseudo incorrect')</script>";
            }
            $query->CloseCursor();
        }
    }

    public function inscription(){
        try{
            $date =date('y/m/d',strtotime($_POST['date']));
            $stmt = $this->iPdo->prepare("INSERT INTO tbUsers(userPseudo, LastName, FirstName, mdp, mail, dateInscription, dateBirth ) VALUES(:userPseudo, :LastName, :FirstName, :mdp, :mail, :inscription, :birth)");
            $stmt->bindParam(':userPseudo',$_POST['pseudo']);
            $stmt->bindParam(':LastName',$_POST['nom']);
            $stmt->bindParam(':FirstName',$_POST['prenom']);
            $stmt->bindParam(':mdp',$_POST['mdp']);
            $stmt->bindParam(':mail',$_POST['email']);
            $stmt->bindParam(':inscription',date("Y/m/d"));
            $stmt->bindParam(':birth',$date);
            $stmt->execute();
        }catch(Exception $e){
            die("Erreur lors de la query");
        }
        $this->login();
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