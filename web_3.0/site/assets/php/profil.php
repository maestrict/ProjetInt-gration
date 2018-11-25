<?php
session_start();
?>
<p>voici les données de votre compte</p>
<form action="" method="post" id="formCompte">
    <div class="row">
    <div class="col">
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
        </div>
        <div class="col">
            <img class="rounded-circle mx-auto" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" width="140" height="140">
        </div>
    </div>
    <input type="submit" name="change" value="sauvegarder">
</form>