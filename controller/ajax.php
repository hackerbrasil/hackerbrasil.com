<?php
$segment=segment();
$controller=@explode('?',$segment[2])[0];

switch($controller){
    case 'links':
        controller("ajax_links");
        break;
}
