<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require '../inc/autoload.php';

$segment=segment();
$controller=$segment[1];

switch($controller){
    case '/':
        view("home");
        break;
    case 'ajax_links':
        controller("ajax_links");
        break;
    default:
        view('404');
        break;
}
