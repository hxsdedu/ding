# ding ding laravel packages

## Requirements
- PHP >= 7.0.0
- Laravel >= 5.5.0

## Installation
> This package requires PHP 7+ and Laravel 5.5

First, install laravel 5.5

```$xslt
composer require hxsd/ding
```

add the ServiceProvider to the providers array in `config/app.php`
```php
\HXSD\Ding\Providers\DingProvider::class,
```

add this to your facades in app.php
```php
'Ding' => \HXSD\Ding\Facades\Ding::class,
```


Then run these commands to publish assets and config：

```$xslt
php artisan vendor:publish --provider="HXSD\Ding\Providers\DingProvider"
```

## Configurations
The file config/ding.php contains an array of configurations, you can find the default configurations in there.

```php
'auth_info' => [
    // ding CorpId
    'corp_id' => '',

    // Company secret key
    'corp_secret' => '',

    // sso secret key
    'sso_secret' => '',

    // channel secret key
    'channel_secret' => '',
],
```