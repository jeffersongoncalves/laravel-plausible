<div class="filament-hidden">

![Laravel Plausible](https://raw.githubusercontent.com/jeffersongoncalves/laravel-plausible/master/art/jeffersongoncalves-laravel-plausible.png)

</div>

# Laravel Whatsapp Widget

[![Latest Version on Packagist](https://img.shields.io/packagist/v/jeffersongoncalves/laravel-plausible.svg?style=flat-square)](https://packagist.org/packages/jeffersongoncalves/laravel-plausible)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/jeffersongoncalves/laravel-plausible/run-tests.yml?branch=master&label=tests&style=flat-square)](https://github.com/jeffersongoncalves/laravel-plausible/actions?query=workflow%3Arun-tests+branch%3Amaster)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/jeffersongoncalves/laravel-plausible/fix-php-code-style-issues.yml?branch=master&label=code%20style&style=flat-square)](https://github.com/jeffersongoncalves/laravel-plausible/actions?query=workflow%3A"Fix+PHP+code+styling"+branch%3Amaster)
[![Total Downloads](https://img.shields.io/packagist/dt/jeffersongoncalves/laravel-plausible.svg?style=flat-square)](https://packagist.org/packages/jeffersongoncalves/laravel-plausible)

A lightweight Laravel package that seamlessly integrates Plausible Analytics into your Blade views. Plausible.io is a privacy-friendly, open-source alternative to Google Analytics.

## Installation

You can install the package via composer:

```bash
composer require jeffersongoncalves/laravel-plausible
```

## Usage

Publish config file.

```bash
php artisan vendor:publish --tag=plausible-config
```

Add head template.

```php
@include('plausible::script')
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Jèfferson Gonçalves](https://github.com/jeffersongoncalves)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
