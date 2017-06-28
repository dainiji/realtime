<?php

namespace Dainidev\Talking;

use Illuminate\Support\ServiceProvider;

class TalkingServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        include __DIR__.'/routes.php';
        /* 
        for Laravel 5.4 migration
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
        
        for Laravel 5.2
        $this->publishes([
        __DIR__.'/../database/migrations/' => database_path('migrations')
        ], 'migrations'); 
        or
        /*$this->publishes([
                base_path('packages/dainidev/talking/database/migrations') => base_path('database/migrations'),
            ], 'migrations');
        */
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
        
        $this->app->make('Dainidev\Talking\Controllers\TalkingController');
        $this->loadViewsFrom(__DIR__.'/Views', 'Talking');
    }
}
