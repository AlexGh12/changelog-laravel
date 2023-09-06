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
		$this->registerMigrations();
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
        if ($this->app->runningInConsole()) {
            $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        }
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
			], 'changelog-db');
			$this->publishes([
				__DIR__.'/../database/file/changelog.sqlite' => database_path('changelog.sqlite'),
			], 'changelog-db-file');
			$this->publishes([
				__DIR__.'/../config/ChngeLog.php' => config_path('ChngeLog.php'),
				__DIR__.'/../config/database.ChngeLog.php' => config_path('database.ChngeLog.php'),
			], 'changelog-config');
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
            __DIR__.'/../config/ChangeLog.php', 'ChangeLog',
        );

		config()->set('database.connections.changelogdb', [
            'driver' => 'sqlite',
            'url' => config('ChangeLog.storage.database.changelogdb.url'),
            'database' => config('ChangeLog.storage.database.changelogdb.database'),
            'prefix' => config('ChangeLog.storage.database.changelogdb.prefix'),
            'foreign_key_constraints' => config('ChangeLog.storage.database.changelogdb.foreign_key_constraints'),
        ]);

    }
}
