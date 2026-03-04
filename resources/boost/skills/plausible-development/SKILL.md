---
name: plausible-development
description: Development guide for the laravel-plausible package -- Plausible Analytics integration for Laravel using spatie/laravel-settings.
---

# Plausible Development Skill

## When to use this skill

- When developing or modifying the `jeffersongoncalves/laravel-plausible` package.
- When adding new settings properties to `PlausibleSettings`.
- When modifying the Blade tracking script.
- When writing tests for the package.
- When integrating Plausible Analytics into a Laravel application.

## Setup

### Requirements

- PHP 8.2 or 8.3
- Laravel 11, 12, or 13
- `spatie/laravel-settings` ^3.0
- `spatie/laravel-package-tools` ^1.14.0

### Installation

```bash
composer require jeffersongoncalves/laravel-plausible
php artisan vendor:publish --tag="plausible-settings-migrations"
php artisan migrate
```

### Include the tracking script

```blade
<head>
    @include('plausible::script')
</head>
```

## Architecture

```
src/
  PlausibleServiceProvider.php    # Package service provider (extends PackageServiceProvider)
  Settings/
    PlausibleSettings.php         # Spatie Settings class (group: plausible)
database/
  settings/
    2026_02_22_000000_create_plausible_settings.php
resources/
  views/
    script.blade.php              # Tracking script Blade view
```

### Service Provider

`PlausibleServiceProvider` extends `PackageServiceProvider`:
- Registers package name `laravel-plausible` with views via `hasViews()`.
- Auto-registers `PlausibleSettings` into `settings.settings` config array.
- Registers settings migration path in `settings.migrations_paths`.
- Publishes migrations under tag `plausible-settings-migrations`.

### Settings Class

```php
class PlausibleSettings extends Settings
{
    public ?string $domains = null;
    public string $host_analytics = 'https://plausible.io';

    public static function group(): string { return 'plausible'; }
}
```

| Property | Type | Default | Description |
|----------|------|---------|-------------|
| `domains` | `?string` | `null` | Domain(s) to track (comma-separated) |
| `host_analytics` | `string` | `https://plausible.io` | Plausible instance URL |

### Blade View

The script only renders when `domains` is not empty. Uses `defer` for non-blocking loading.

```blade
@php($plausible = app(\JeffersonGoncalves\Plausible\Settings\PlausibleSettings::class))

@if(!empty($plausible->domains))
    <script defer data-domain="{{ $plausible->domains }}"
            src="{{ $plausible->host_analytics }}/js/script.js"></script>
@endif
```

## Features

### Reading and Updating Settings

```php
use JeffersonGoncalves\Plausible\Settings\PlausibleSettings;

$settings = app(PlausibleSettings::class);
$settings->domains = 'example.com,blog.example.com';
$settings->host_analytics = 'https://analytics.example.com';
$settings->save();
```

## Configuration

No config file -- all settings stored in the database via `spatie/laravel-settings`.

### Adding New Settings

1. Add the property to `PlausibleSettings`.
2. Create a new settings migration with `$this->migrator->add('plausible.property_name', default)`.
3. Update `script.blade.php` if the setting affects the tracking script.

## Testing Patterns

```bash
composer test           # Run Pest tests
composer test-coverage  # Run with coverage
composer analyse        # PHPStan static analysis
composer format         # Laravel Pint formatting
```

### Example Tests

```php
use JeffersonGoncalves\Plausible\Settings\PlausibleSettings;

it('renders the tracking script when domains is set', function () {
    $settings = app(PlausibleSettings::class);
    $settings->domains = 'example.com';
    $settings->save();

    $view = $this->blade('@include("plausible::script")');
    $view->assertSee('data-domain="example.com"');
    $view->assertSee('src="https://plausible.io/js/script.js"');
});

it('does not render the script when domains is null', function () {
    $settings = app(PlausibleSettings::class);
    $settings->domains = null;
    $settings->save();

    $view = $this->blade('@include("plausible::script")');
    $view->assertDontSee('<script');
});

it('has the correct default values', function () {
    $settings = app(PlausibleSettings::class);
    expect($settings->domains)->toBeNull();
    expect($settings->host_analytics)->toBe('https://plausible.io');
});

it('belongs to the plausible group', function () {
    expect(PlausibleSettings::group())->toBe('plausible');
});
```
