<?php

namespace App\Providers;

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
        //
    }
}
