<?php
session_start();
require 'assets/php/secure.inc.php';
?>
<!DOCKTYPE html>
<html>
<head>
    <title>Acceuil</title>
    <meta name="viewport" content="width=device-width , initial-scale=1" />
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/utils.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body onload="getEvent('terrain')">
<?php
    require 'assets/php/menu.inc.php';
?>

<div class="container">
    <section id="terrain">

    </section>
</div>
<?php
require 'assets/php/footer.inc.php'
?>
</body>
</html>