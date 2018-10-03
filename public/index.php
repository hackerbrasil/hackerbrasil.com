<?php
//boot
require '../config.php';

//extra
require '../inc/controller.php';
require '../inc/segment.php';
require '../inc/view.php';

$segment=segment();
$controller=$segment[1];

switch($controller){
    case '/':
        view("home/get");
        break;
    case 'ajax':
        controller("ajax");
        break;
    default:
        view('404');
        break;
}
