<?php

return [

    /*
    |--------------------------------------------------------------------------
    | ChangeLog Path
    |--------------------------------------------------------------------------
    |
    | Esta es la ruta URI desde donde se podrá acceder a ChangeLog. Siéntete libre
    | de cambiar esta ruta a la que quieras. Tenga en cuenta que el URI no afectará
    | las rutas de su API interna que no están expuestas a los usuarios.
    |
    */

    'path' => env('CHANGELOG_PATH', '_changelog'),

    /*
    |--------------------------------------------------------------------------
    | ChangeLog Interruptor maestro
    |--------------------------------------------------------------------------
    |
	| Esta opción se puede utilizar para desactivar todos los observadores de ChangeLog
	| independientemente de su configuración individual, que simplemente proporciona un único
	| y una manera conveniente de habilitar o deshabilitar el almacenamiento de datos de ChangeLog.
    |
    */

    'enabled' => env('ChangeLog_ENABLED', true),

	/*
	|--------------------------------------------------------------------------
	| Configuración de almacenamiento
	|--------------------------------------------------------------------------
	|
	| Estos son los observadores de ChangeLog que se registrarán cuando se active
	| el interruptor maestro anterior. Puede agregar o quitar observadores de ChangeLog
	| según sea necesario para su propia aplicación.
	|
	*/

	'storage' => [
        'database' => [
            'connection' => env('CHANGELOG_DB_CONNECTION', 'changelogdb'),
			'changelogdb' => [ // driver:sqlite
				'url' => env('CHANGELOG_DATABASE_URL'),
				'database' => env('CHANGELOG_DB_DATABASE', database_path('changelog.sqlite')),
				'prefix' => '',
				'foreign_key_constraints' => env('CHANGELOG_DB_FOREIGN_KEYS', true),
			],
		],
    ],


];
