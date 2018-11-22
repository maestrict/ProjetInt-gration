<?php
session_start();
require_once('assets/php/request.php');
require 'assets/php/secure.inc.php';

$terrains = terrain('get');
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Gestion des terrains</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <script src="assets/js/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="assets/js/utils.js"></script>
    <script>
        $(document).ready(function () {
            $('#terrain').DataTable({
                "ordering": true // false to disable sorting (or any other option)
            });
            $('.dataTables_length').addClass('bs-select');
        });
    </script>
</head>
    <body class="is-preload">
    <?php
        require 'assets/php/menu.inc.php';
    ?>
        <section class="container">
            <div id="tbTerrain">
                <form method="post" name="terrain">
                    <table id="terrain" class="table table-striped table-bordered table-sm">
                        <?php
                        echo"<thead><tr>";
                        foreach ($terrains[0] as $cle => $value){
                            echo"<th class='th-sm'>".$cle."</th>";
                            echo"<i class='fa fa-sort float-right' aria-hidden='true'></i>";
                        }
                        echo"</tr></thead>";
                        echo"<tbody><tr>";
                        foreach ($terrains as $terrain => $test){
                            foreach ($terrains[$terrain] as $cle => $value){
                                echo"<td>".$value."</td>";
                            }
                            echo "</tr>";
                        }
                        echo"</tr></tbody>";
                        ?>
                    </table>
                </form>
            </div>
        </section>

    <?php
        require 'assets/php/footer.inc.php'
    ?>
	</body>
</html>