<?php
require_once ('assets/php/db.inc.php');
require_once('assets/php/request.php');
require 'assets/php/secure.inc.php';
?>
<!DOCKTYPE html>
<html>
<head>
    <title>Compte</title>
    <meta name="viewport" content="width=device-width , initial-scale=1" />
    <link rel="shortcut icon" type="image/x-icon" href="/assets/img/logo_trans.ico">
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/utils.js"></script>
    <script src='fullcalendar/lib/jquery.min.js'></script>
    <script src='fullcalendar/lib/jquery-ui.min.js'></script>
    <script src='fullcalendar/lib/moment.min.js'></script>
    <script src='fullcalendar/fullcalendar.js'></script>
    <script src='fullcalendar/locale-all.js'></script>
    <link rel='stylesheet' href='fullcalendar/fullcalendar.css'/>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
<form action="assets/php/request.php" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="UploadImage" name="img" class="btn btn-secondary">
</form>
</body>
</html>