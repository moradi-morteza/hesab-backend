<?php


namespace Core;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class CoreServiceProvider extends ServiceProvider
{

    private $namespace = 'Core';

    public function boot()
    {

        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(__DIR__ . '/Routes/api.php');

        $this->loadViewsFrom(__DIR__.'/Resources/Views','CoreView');

        $this->publishes([
            __DIR__.'/Database/Migrations/' => database_path('migrations'),
        ], 'migrations.modules');

    }

}
