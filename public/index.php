<?php
//boot
require '../config.php';

//extra
require '../inc/controller.php';
require '../inc/json.php';
require '../inc/segment.php';
require '../inc/view.php';

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
