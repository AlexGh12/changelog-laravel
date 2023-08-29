<?php

namespace AlexGh12\ChangeLog;

use AlexGh12\ChangeLog\Console\database;
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
        if ($this->app->runningInConsole()) {
            $this->commands([
				Commands\PublishCommand::class,
				Commands\InstallCommand::class,
            ]);
        }

		$this->publishes([
			__DIR__.'/../config/ChangeLog.php' => base_path('config/ChangeLog.php'),
		], [
			'ChangeLog:config'
		]);
    }

    /**
     * Registra los servicios de la aplicación.
     *
     * @return void
     */
    public function register()
    {
    }
}
