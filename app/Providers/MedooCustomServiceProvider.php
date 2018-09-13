<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Custom\Classes\MedooCustom;

class MedooCustomServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
     public function register()
     {
         $this->app->bind('medoocustom', function () {
             return new MedooCustom($app->make('HttpClient'));
         });
     }
}
