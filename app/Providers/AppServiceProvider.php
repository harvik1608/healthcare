<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if(!defined('APP_NAME')) {
            define('APP_NAME','HealthCare');
        }

        if(!defined('API_URL')) {
            define('API_URL','http://localhost/healthcare/public/api');
        }
    }
}
