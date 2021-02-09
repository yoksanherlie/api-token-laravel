# API Token Laravel

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE)
[![Total Downloads][ico-downloads]][link-downloads]

# Setup

## Installation

``` bash
$ composer require silverbullet/api-token-laravel
```

## Configuration

Add service provider to the `providers` array in `config/app.php` file:
``` php
'providers' => [
    ...
    Silverbullet\ApiTokenLaravel\Providers\ApiTokenServiceProvider::class
],
```

Publish the migration file:
``` bash
php artisan vendor:publish --provider="Silverbullet\ApiTokenLaravel\Providers\ApiTokenServiceProvider"
```

Run the migration:
``` bash
php artisan migrate
```

# Usage

## API Token Commands

### Generate new API Token
``` bash
$ php artisan api-token:generate {name} {code?}
```

### List all API Token
``` bash
$ php artisan api-token:list
```

### Delete API Token by id
``` bash
$ php artisan api-token:delete {id}
```

## Middleware
Use middleware with the key `apitoken.auth:{code}` on your Larave route. Example:
``` php
Route::get('partner-products', function() {
    //
})->middleware('apitoken.auth:{service1}');
```

You can also pass multiple parameters for the `{code}` (e.g. `apitoken.auth{service1,service2}`). This feature enables you to authorize the service that is going to use your API.

### Authorize Request
To pass the middleware, you must include `Authorization` header as a part of your request.
```
Authorization: Basic {api_token_goes_here}
```

### Response
- `401`: Unauthenticated 
    
    This error code means you do not have the valid token.

- `403`: Unauthorized

    This error code means you do have a valid token but not the permission to access the API you are trying to access.


# License

The MIT License (MIT). Please see [License File](LICENSE) for more information.

[ico-version]: https://img.shields.io/packagist/v/silverbullet/api-token-laravel.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/silverbullet/api-token-laravel.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/silverbullet/api-token-laravel
[link-downloads]: https://packagist.org/packages/silverbullet/api-token-laravel