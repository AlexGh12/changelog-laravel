<?php

namespace AlexGh12\ChangeLog;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class ChangeLogServiceProvider extends ServiceProvider
{
	/**
     * Inicia los servicios de la aplicación
     *
     * @return void
     */
    public function boot()
    {
		$this->registerCommands();
		$this->registerPublishing();

		if (! config('ChangeLog.enabled')) {
            return;
        }

		$this->registerRoutes();

		$this->loadViewsFrom(
            __DIR__.'/../resources/views', 'ChangeLog'
        );
    }

	/**
     * Register the package routes.
     *
     * @return void
     */
    private function registerRoutes()
    {
        Route::group($this->routeConfiguration(), function () {
            $this->loadRoutesFrom(__DIR__.'/Http/routes.php');
        });
    }

	/**
     * Get the Telescope route group configuration array.
     *
     * @return array
     */
    private function routeConfiguration()
    {
        return [
            // 'domain' => config('ChangeLog.domain', null),
            'namespace' => 'AlexGh12\ChangeLog\Http\Controllers',
            'prefix' => config('ChangeLog.path'),
            // 'middleware' => 'ChangeLog',
        ];
    }

    /**
     * Register the package's migrations.
     *
     * @return void
     */
    private function registerMigrations()
    {
        // if ($this->app->runningInConsole() && $this->shouldMigrate()) {
        //     $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // }
    }

    /**
     * Register the package's publishable resources.
     *
     * @return void
     */
    private function registerPublishing()
    {

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../database/migrations' => database_path('migrations'),
            ], 'changelog-migrations');

            $this->publishes([
                __DIR__.'/../config/ChngeLog.php' => config_path('ChngeLog.php'),
            ], 'changelog-config');

            // $this->publishes([
            //     __DIR__.'/../stubs/ChangeLogServiceProvider.stub' => app_path('Providers/ChangeLogServiceProvider.php'),
            // ], 'ChangeLog-provider');
        }
    }

    /**
     * Register the package's commands.
     *
     * @return void
     */
    protected function registerCommands()
    {
		if ($this->app->runningInConsole()) {
            $this->commands([
				Commands\PublishCommand::class,
				Commands\InstallCommand::class,
            ]);
        }
    }

    /**
     * Registra los servicios de la aplicación.
     *
     * @return void
     */
    public function register()
    {
		$this->mergeConfigFrom(
            __DIR__.'/../config/ChangeLog.php', 'ChangeLog'
        );

    }
}
