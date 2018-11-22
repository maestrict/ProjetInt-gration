<?php
session_start();
require_once ('assets/php/db.inc.php');
require_once('assets/php/request.php');
require 'assets/php/secure.inc.php';

if(isset($_SESSION['club'])) {
    $terrains = terrain('get', json_decode("{\"club\": \"{$_SESSION['club']['Name']}\"}", true));
}
$iDB = new Db();
?>
<!DOCKTYPE html>
<html>
<head>
    <title>Compte</title>
    <meta name="viewport" content="width=device-width , initial-scale=1" />
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/utils.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
<?php
    require 'assets/php/menu.inc.php';
?>

<div class="container">
    <div class="row">
        <div class="col">
        <section id="terrain">
            <p>voici les données de votre compte</p>
            <form action="" method="post" id="formCompte">
                    <?php
                    if(isset($_SESSION['user'])){
                        //<input type="password" name="mdp" placeholder="mdp" value="{$_SESSION['user']['mdp']}" maxlength="50" required>
                        $form = <<<EOT
                                <table>
                                    <tr>
                                        <td>
                                            <label for="nom">Nom: </label>
                                        </td>
                                        <td>
                                            <input type="text" name="nom" id="nom" placeholder="nom" value="{$_SESSION['user']['LastName']}" maxlength="20" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="prenom">Prenom: </label>
                                        
                                        </td>
                                        <td>
                                            <input type="text" name="prenom" id="prenom" placeholder="prenom" value="{$_SESSION['user']['FirstName']}" maxlength="20" required>
                                        </td>
                                    </tr>    
                                    <tr>
                                        <td>
                                            <label for="pseudo">Pseudo: </label>
                                        </td>
                                        <td>
                                            <input type="text" name="pseudo" id="pseudo" placeholder="pseudo" value="{$_SESSION['user']['userPseudo']}" maxlength="20" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="date">Date de naissance: </label>
                                        </td>
                                        <td>
                                            <input type="text" name="date" id="date" value="{$_SESSION['user']['dateBirth']}" placeholder="date">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="email">Mail: </label>
                                        </td>
                                        <td>
                                            <input type="text" name="email" id="email" placeholder="email" value="{$_SESSION['user']['mail']}" maxlength="25" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="address">Address: </label>
                                        </td>                                
                                        <td>
                                            <input type="text" name="address" id="address" placeholder="address" value="{$_SESSION['user']['address']}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="zipCode">Code Postal: </label>
                                        </td>                                
                                        <td>
                                            <input type="text" name="zipCode" id="zipCode" placeholder=0 value="{$_SESSION['user']['zipCode']}">
                                        </td>
                                    </tr>
                                    </table>
EOT;
                    }else{
                        //<input type="password" name="mdp" placeholder="mdp" value="{$_SESSION['club']['mdp']}" maxlength="50" required>
                        $form = <<<EOT
                                <table>
                                    <tr>
                                        <td>                            
                                            <label for="nom">Nom: </label>
                                        </td>
                                        <td>
                                            <input type="text" name="nom" id="nom" placeholder="nom" value="{$_SESSION['club']['Name']}" maxlength="20" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>                            
                                            <label for="tel">Telephone: </label>
                                        </td>
                                        <td>
                                            <input type="text" name="tel" id="tel" placeholder="telephone" value="{$_SESSION['club']['telephone']}" maxlength="50">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="email">Mail: </label>
                                        </td>
                                        <td>    
                                            <input type="text" name="email" id="email" placeholder="email" value="{$_SESSION['club']['mail']}" maxlength="25" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="address">Address: </label>    
                                        </td>
                                        <td>
                                            <input type="text" name="address" id="address" placeholder="address" value="{$_SESSION['club']['address']}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="zipCode">Code Postal:</label>
                                        </td>
                                        <td>
                                            <input type="text" name="zipCode" id="zipCode" placeholder="0" value="{$_SESSION['club']['zipCode']}">
                                        </td>
                                    </tr>
                                </table>
EOT;
                    }
                    echo $form;
                    ?>
                    <input type="submit" name="change" value="sauvegarder">
            </form>
        </section>
        </div>
        <?php
            echo "<pre>";
                print_r($_SESSION);
            echo "</pre>";
        ?>
        <div class="col">
            <div id="tbTerrain">
                <form method="post" name="terrain">
                    <table id="terrain" class="table table-striped table-bordered table-sm">
                        <?php
                        if(isset($_SESSION['club'])) {
                            echo "<thead><tr>";
                            foreach ($terrains[0] as $cle => $value) {
                                if ($cle == 'clubId' || $cle == 'description' || $cle == 'latitude' || $cle == 'longitude') {
                                } else {
                                    echo "<th class='th-sm'>" . $cle . "</th>";
                                    echo "<i class='fa fa-sort float-right' aria-hidden='true'></i>";
                                }
                            }
                            echo "<th>ajouter</th>";
                            echo "</tr></thead>";
                            echo "<tbody><tr>";
                            foreach ($terrains as $terrain => $test) {
                                foreach ($terrains[$terrain] as $cle => $value) {
                                    if ($cle == 'clubId' || $cle == 'description' || $cle == 'latitude' || $cle == 'longitude') {
                                    } else {
                                        echo "<td>" . $value . "</td>";
                                    }
                                }
                                echo <<<EOT
<td><input type="button" name="suppTerrain" id="{$terrains[$terrain]['tId']}" value="supprimer" onclick="ajax('suppTerrains',this.id);"></td>
EOT;
                                echo "</tr>";
                            }
                            echo "</tr></tbody>";
                            echo"<tfoot><tr>";
                            foreach ($terrains[0] as $cle => $value){
                                if ($cle == 'clubId' || $cle == 'description' || $cle == 'latitude' || $cle == 'longitude'){

                                }else{
                                    echo "<td><input type='text' name='".$cle."'></td>";
                                }
                            }
                            echo"<td><input type='submit' name='ajoutTerrain' value='ajouter'></td>";
                            echo "</tr></tfoot>";
                        }
                        ?>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
    require 'assets/php/footer.inc.php'
?>
</body>
</html>