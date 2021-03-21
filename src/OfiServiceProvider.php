<?php

namespace Ofi\Route;

use Illuminate\Support\ServiceProvider;

class OfiServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/autoroute.php', 'autoroute');

        // Register the service the package provides.
        $this->app->singleton('autoroute', function ($app) {
            return new AutoRoute;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['autoroute'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole(): void
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__ . '/../config/autoroute.php' => config_path('autoroute.php'),
        ], 'autoroute.config');
    }
}
