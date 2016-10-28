# Laravel 5.2 Authorize
==

## Installation

1. Run
```php   
composer require sciarcinski/laravel-authorize
```     
in console to install this module

2. Open `config/app.php` and:

#### Service Provider
```php
Sciarcinski\LaravelAuthorize\AccessProvider::class
```

#### Facade
```php
'Access' => Sciarcinski\LaravelAuthorize\Facades\Access::class,
```

Run the `vendor:publish` command

	$ php artisan vendor:publish

