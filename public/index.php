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
    controller("home");
    break;
    case 'api':
    controller('api');
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
    case 'logout':
    controller("logout");
    break;
    case 'signin':
    controller("signin");
    break;
    case 'top10':
    controller("top10");
    break;
    default:
    view('404');
    break;
}
