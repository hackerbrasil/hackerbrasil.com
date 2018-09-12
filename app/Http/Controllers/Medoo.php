<?php

namespace App\Http\Controllers;

use Medoo\Medoo as DB;

class Medoo extends DB
{
    function __construct(){
        return parent::__construct([
            'database_type' => $_ENV["DB_CONNECTION"],
            'database_name' => $_ENV["DB_DATABASE"],
            'server' => $_ENV["DB_HOST"],
            'username' => $_ENV["DB_USERNAME"],
            'password' => $_ENV["DB_PASSWORD"]
        ]);
    }
}
