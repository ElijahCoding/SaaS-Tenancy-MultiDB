<?php

namespace App\Providers;

use App\Console\Commands\Tenant\Migrate;
use App\Tenant\Database\DatabaseManager;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Http\Request;
use App\Tenant\Manager;

class TenantServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton(Manager::class, function () {
            return new Manager();
        });

        // route helper
        Request::macro('tenant', function () {
            return app(Manager::class)->getTenant();
        });

        // balde if
        Blade::if('tenant', function () {
            return app(Manager::class)->hasTenant();
        });
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Migrate::class, function ($app) {
            return new Migrate($app->make('migrator'), $app->make(DatabaseManager::class));
        });
    }
}
