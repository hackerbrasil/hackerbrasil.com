<?php

namespace App\Providers;

use App\Custom\Classes\MedooCustom;
use Illuminate\Support\ServiceProvider;

class MedooCustomServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->app->bind('medoocustom', function () {
            return new MedooCustom($app->make('HttpClient'));
        });
    }
}
