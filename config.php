<?php
define('ROOT',__DIR__.'/');

//Composer
require_once ROOT.'vendor/autoload.php';

//incs
require_once ROOT.'inc/controller.php';
require_once ROOT.'inc/json.php';
require_once ROOT.'inc/segment.php';
require_once ROOT.'inc/slug.php';
require_once ROOT.'inc/view.php';

use Medoo\Medoo;

$db=new Medoo([
    // required
    'database_type' => 'mysql',
    'database_name' => 'hb',
    'server' => 'localhost',
    'username' => 'root',
    'password' => ''
]);

