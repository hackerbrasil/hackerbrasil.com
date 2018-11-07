<?php
//dependencias
require '../inc/autoload.php';
if(isDev()){
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}
controller('teste');
?>
