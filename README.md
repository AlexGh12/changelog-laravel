<p align="center"><img src="art/logo.svg" alt="Logo Alex Gh"></p>

<p align="center">
    <a href="https://packagist.org/packages/alexgh12/changelog-laravel">
        <img src="https://img.shields.io/packagist/dt/alexgh12/changelog-laravel" alt="Total Downloads">
    </a>
    <a href="https://packagist.org/packages/alexgh12/changelog-laravel">
        <img src="https://img.shields.io/packagist/v/alexgh12/changelog-laravel" alt="Latest Stable Version">
    </a>
    <a href="https://packagist.org/packages/alexgh12/changelog-laravel">
        <img src="https://img.shields.io/packagist/l/alexgh12/changelog-laravel" alt="License">
    </a>
</p>

# Introducción

> Es versión ALPHA asi que muchos comandos aun no funcionan.

Registra todos tus cambios del proyecto por versiones y genera tu `CHANGELOG.md`, ademas de poder generar una vista de xambios

## Instalación

Ejecutar en la consola:
```bash
composer require AlexGh12/ChangeLog-laravel
```

Despues ejecutar comando
```bash
php artisan ChangeLog:publish
```

Para finalizar la intalación hay que ejecutar las migraciones
```bash
php artisan migrate
```

## Configuración

Puedes realizar las configuraciones desde el archivo `config/ChangeLog.php`

## Uso

### Registrar cambios

Para hacer el registro de los cambios de tu proyecto hay que ejecutar:

```bash
php artisan serve
```

Ahora visitar [http://localhost:8000/changelog/](http://localhost:8000/changelog/)

<!-- Todo: Agregar imagen --> 

### Generar CHANGELOG.md

Una ves registrados los cambios puedes generar el archivo `CHANGELOG.md` con:

```bash
php artisan ChangeLog:generate
```


## Licencia

AlexGh12 es de codigo abierto software con licencia [MIT](LICENSE.md).
