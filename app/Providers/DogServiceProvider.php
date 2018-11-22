<?php

namespace App\Providers;

use App\Facade\Dog;
use Illuminate\Support\ServiceProvider;

class DogServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('Dog',function($app){
            return  new \App\Classes\Dog;
        });
    }
}
