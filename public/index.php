<?php
//boot
require '../config.php';

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
