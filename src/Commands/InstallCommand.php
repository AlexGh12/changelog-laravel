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
		$this->call('vendor:publish', ['--tag' => 'changelog-db-file', '--force' => true]);
		$this->info('Archivo SQLite generado exitosamente!');

		$this->call('vendor:publish', ['--tag' => 'changelog-db', '--force' => true]);
		$this->info('Migración creada exitosamente!');

		$this->call('migrate', ['--database' => 'changelogdb']);
		$this->info('migración generada exitosamente!');

    }
}
