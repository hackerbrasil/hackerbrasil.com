<?php

namespace App\Custom\Classes;

use Medoo\Medoo;

class MedooCustom
{
    public function connect($dbName=false)
    {
        if(!$dbName){
            $dbName=$_ENV["DB_DATABASE"];
        }
        return new Medoo([
            'database_type' => $_ENV["DB_CONNECTION"],
            'database_name' => $dbName,
            'server' => $_ENV["DB_HOST"],
            'username' => $_ENV["DB_USERNAME"],
            'password' => $_ENV["DB_PASSWORD"]
        ]);
    }
}
