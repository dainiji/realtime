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
