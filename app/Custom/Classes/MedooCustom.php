<?php

namespace App\Custom\Classes;

use Medoo\Medoo;

class MedooCustom
{
    public function start()
    {
        return new Medoo([
            'database_type' => $_ENV["DB_CONNECTION"],
            'database_name' => $_ENV["DB_DATABASE"],
            'server' => $_ENV["DB_HOST"],
            'username' => $_ENV["DB_USERNAME"],
            'password' => $_ENV["DB_PASSWORD"]
        ]);
    }
}
