<?php

namespace App\Custom\Facades;

use Illuminate\Support\Facades\Facade;

class MedooCustom extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'medoocustom';
    }
}
