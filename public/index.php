<?php
//dependencias
require '../inc/autoload.php';
if(isDev()){
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}

//regras
$segment=segment();
$controller=$segment[1];
switch($controller){
    case '/':
    view("home");
    break;
    case 'baixarLinks':
    controller("baixarLinks");
    break;
    case 'dashboard':
    controller("dashboard");
    break;
    case 'feed':
    controller("feed");
    break;
    case 'signin':
    controller("signin");
    break;
    default:
    view('404');
    break;
}
