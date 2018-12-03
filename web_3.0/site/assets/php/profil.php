<?php
session_start();
?>
<script>
    $(function() {
        $( "#zipCode" ).autocomplete({
            source: function( request, response ) {
                $.ajax({
                    url: "/assets/php/request.php",
                    type:'post',
                    data: {"autocomplete":"1"},
                    success: function(data) {
                        console.log(data);
                    }
                });
            },
        });
    });
</script>
<h4>voici les données de votre compte</h4>
<div class="row">
    <div class="col">
        <form id="formCompte" method="post" onSubmit="changeDonnee(); return false">
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
            <input type="submit" name="change" value="sauvegarder" class="btn btn-secondary">
        </form>
    </div>
    <div class="col">
        <img class="rounded-circle mx-auto" src="<?php
        $extention = ['.jpg', '.png', '.jpeg', '.gif'];
        $out = "/assets/img/default_profile.jpg";
        foreach ($extention as $value){
            $existe = file_exists($_SERVER['DOCUMENT_ROOT']."/uploads/" . (isset($_SESSION['user'])?"user/".$_SESSION['user']['userPseudo']:"club/".$_SESSION['club']['Name']).$value);
            if($existe) {
                $out = "/uploads/" . (isset($_SESSION['user'])?"user/".$_SESSION['user']['userPseudo']:"club/".$_SESSION['club']['Name']).$value;
            }
        }
        echo($out);
        ?>" alt="Generic placeholder image" width="140" height="140">
        <form  action="/assets/php/request.php" method="post" enctype="multipart/form-data">
            Select image to upload:
            <input type="file" name="fileToUpload" id="fileToUpload">
            <input type="submit" value="Upload Image" name="img" class="btn btn-secondary">
        </form>
    </div>
</div>
