<?php
session_start();
?>
<form method="post" name="terrain">
    <table id="terrain" class="table table-striped table-bordered table-sm">
        <?php
            require_once('request.php');
            $terrains = terrain('get', json_decode("{\"club\": \"{$_SESSION['club']['Name']}\"}", true));
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
        ?>
    </table>
</form>