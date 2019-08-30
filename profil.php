<?php
session_start();
require_once('request.php');
?>
<h4>Vos données</h4>
<div class="row">
    <div class="col">
        <form id="formCompte" method="post" onSubmit="changeDonnee(); return false">
        <?php
        if(isset($_SESSION['user'])){
            //<input type="password" name="mdp" placeholder="mdp" value="{$_SESSION['user']['mdp']}" maxlength="50" required>
            $date = date_format(new DateTime($_SESSION['user']['dateBirth']), "d-m-Y");
            $form = <<<EOT
                                    <table>
                                        <tr>
                                        <div class="form-group">
                                            <td>
                                                <label for="nom">Nom : </label>
                                            </td>
                                            <td>
                                                <input class="form-control" type="text" name="nom" id="nom" placeholder="Nom" value="{$_SESSION['user']['LastName']}" maxlength="20" required>
                                            </td>
                                            </div>
                                        </tr>
                                        <tr>
                                        <div class="form-group">
                                            <td>
                                                <label for="prenom">Prénom : </label>

                                            </td>
                                            <td>
                                                <input class="form-control" type="text" name="prenom" id="prenom" placeholder="Prenom" value="{$_SESSION['user']['FirstName']}" maxlength="20" required>
                                            </td>
                                            </div>
                                        </tr>
                                        <tr>
                                        <div class="form-group">
                                            <td>
                                                <label for="pseudo">Pseudo : </label>
                                            </td>
                                            <td>
                                                <input class="form-control" type="text" name="pseudo" id="pseudo" placeholder="Pseudo" value="{$_SESSION['user']['userPseudo']}" maxlength="20" required>
                                            </td>
                                            </div>
                                        </tr>
                                        <tr>
                                        <div class="form-group">
                                            <td>
                                                <label for="date">Date de naissance : </label>
                                            </td>
                                            <td>
                                                <input class="form-control" type="text" name="date" id="date" value="{$date}" placeholder="Date">
                                            </td>
                                            </div>
                                        </tr>
                                        <tr>
                                        <div class="form-group">
                                            <td>
                                                <label for="email">Mail : </label>
                                            </td>
                                            <td>
                                                <input class="form-control" type="text" name="email" id="email" placeholder="Email" value="{$_SESSION['user']['mail']}" maxlength="25" required>
                                            </td>
                                            </div>
                                        </tr>
                                        <tr>
                                        <div class="form-group">
                                            <td>
                                                <label for="address">Adresse : </label>
                                            </td>
                                            <td>
                                                <input class="form-control" type="text" name="address" id="address" placeholder="Addresse" value="{$_SESSION['user']['address']}">
                                            </td>
                                            </div>
                                        </tr>
                                        <tr>
                                        <div class="form-group">
                                            <td>
                                                <label for="zipCode">Code Postal : </label>
                                            </td>
                                            <td>
                                                <input class="form-control" type="text" name="zipCode" id="zipCode" placeholder=0 value="{$_SESSION['user']['zipCode']}">
                                            </td>
                                            </div>
                                        </tr>
                                        </table>
EOT;
        }else{
            //<input type="password" name="mdp" placeholder="mdp" value="{$_SESSION['club']['mdp']}" maxlength="50" required>
            $form = <<<EOT
                                    <table>
                                        <tr>
                                        <div class="form-group">
                                            <td>
                                                <label for="nom">Nom: </label>
                                            </td>
                                            <td>
                                                <input class="form-control" type="text" name="nom" id="nom" placeholder="Nom" value="{$_SESSION['club']['Name']}" maxlength="20" required>
                                            </td>
                                            </div>
                                        </tr>
                                        <tr>
                                        <div class="form-group">
                                            <td>
                                                <label for="tel">Telephone: </label>
                                            </td>
                                            <td>
                                                <input class="form-control" type="text" name="tel" id="tel" placeholder="Téléphone" value="{$_SESSION['club']['telephone']}" maxlength="50">
                                            </td>
                                            </div>
                                        </tr>
                                        <tr>
                                        <div class="form-group">
                                            <td>
                                                <label for="email">Mail: </label>
                                            </td>
                                            <td>
                                                <input class="form-control" type="text" name="email" id="email" placeholder="Email" value="{$_SESSION['club']['mail']}" maxlength="25" required>
                                            </td>
                                            </div>
                                        </tr>
                                        <tr>
                                        <div class="form-group">
                                            <td>
                                                <label for="address">Adresse: </label>
                                            </td>
                                            <td>
                                                <input class="form-control" type="text" name="address" id="address" placeholder="Addresse" value="{$_SESSION['club']['address']}">
                                            </td>
                                            </div>
                                        </tr>
                                        <tr>
                                        <div class="form-group">
                                            <td>
                                                <label for="zipCode">Code Postal:</label>
                                            </td>
                                            <td>
                                                <input class="form-control" type="text" name="zipCode" id="zipCode" placeholder="0" value="{$_SESSION['club']['zipCode']}">
                                            </td>
                                            </div>
                                        </tr>
                                    </table>
EOT;
        }
        echo $form;
        ?>
            <input type="submit" name="change" value="Sauvegarder" class="btn btn-secondary">
        </form>
    </div>
    <div class="col">
        <img class="rounded-circle mx-auto" src="<?php echo(lookForFace(isset($_SESSION['user'])?$_SESSION['user']['userPseudo']:$_SESSION['club']['Name'])); ?>" alt="Generic placeholder image" width="140" height="140">
        <form  action="/assets/php/request.php" method="post" enctype="multipart/form-data">
            Select image to upload:
            <input type="file" name="fileToUpload" id="fileToUpload">
            <input type="submit" value="Upload Image" name="img" class="btn btn-secondary">
        </form>
    </div>
</div>
