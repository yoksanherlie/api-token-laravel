<?php

namespace Silverbullet\ApiTokenLaravel;

use Illuminate\Support\ServiceProvider;
use Silverbullet\ApiTokenLaravel\Console\GenerateApiToken;
use Silverbullet\ApiTokenLaravel\Console\ListApiToken;
use Silverbullet\ApiTokenLaravel\Console\DeleteApiToken;
use Silverbullet\ApiTokenLaravel\Http\Middleware\ApiTokenAuthorized;

class ApiTokenServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->registerMiddleware();
        $this->registerMigrations();
    }

    /**
    * Register the service provider.
    *
    * @return void
    */
    public function register()
    {
        $this->commands([
            GenerateApiToken::class,
            ListApiToken::class,
            DeleteApiToken::class
        ]);
    }

    /**
     * Register middleware for this service.
     * 
     * @return void
     */
    public function registerMiddleware()
    {
        $router = $this->app['router'];

        $method = method_exists($route, 'aliasMiddleware') ? 'aliasMiddleware' : 'middleware';

        $router->$method('apitoken.auth', ApiTokenAuthorized::class);
    }

    public function registerMigration()
    {
        $migrationPath = __DIR__ . '/../../database/migrations';
        $this->publishes([
            $migrationPath => database_path('migrations')
        ], 'migrations');
    }
}