<?php
/**
 * Created by PhpStorm.
 * User: Grégory
 * Date: 22-11-18
 * Time: 10:13
 */
setcookie("pseudo", "", time() - 3600);
setcookie("mdp", "", time() - 3600);
session_start();
session_unset();
session_destroy();

header('Location: index.php');
