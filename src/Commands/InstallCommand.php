<?php

namespace AlexGh12\ChangeLog\Commands;


use Illuminate\Console\Command;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ChangeLog:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Genera la Base de Datos y las tablas necesarias para el funcionamiento de la aplicación.';

    /**
     * Execute the console command.
     */
    public function handle()
    {

		$source = __DIR__."/../config/database/changelog.sqlite";
		$destination = database_path('changelog.sqlite');

		if (copy($source, $destination)) {
			$this->info("Archivo copiado con éxito.");
		} else {
			$this->info("Error al copiar el archivo.");
		}

		Artisan::call('migrate');
        $this->info('Migration generada exitosamente!');
    }
}
