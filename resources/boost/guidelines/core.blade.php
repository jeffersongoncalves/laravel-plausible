## Laravel Plausible

### Overview

Laravel Plausible integrates [Plausible Analytics](https://plausible.io) into Laravel Blade views.
It uses `spatie/laravel-settings` to store configuration in the database, requiring no config files.
The package auto-registers its service provider and settings migration.

**Namespace:** `JeffersonGoncalves\Plausible`
**Service Provider:** `PlausibleServiceProvider` (extends `Spatie\LaravelPackageTools\PackageServiceProvider`)

### Key Concepts

- **No config file** -- all settings are stored in the database via `spatie/laravel-settings`.
- **Blade view** -- include `<x-plausible::script />` or `@include('plausible::script')` in your layout.
- The tracking script only renders when `domains` is not empty.
- Supports self-hosted Plausible instances via the `host_analytics` setting.

### Settings (spatie/laravel-settings)

Settings class: `JeffersonGoncalves\Plausible\Settings\PlausibleSettings`
Group: `plausible`

| Property | Type | Default | Description |
|----------|------|---------|-------------|
| `domains` | `?string` | `null` | Comma-separated domain(s) to track |
| `host_analytics` | `string` | `https://plausible.io` | Plausible instance URL |

@verbatim
<code-snippet name="read-settings" lang="php">
use JeffersonGoncalves\Plausible\Settings\PlausibleSettings;

$settings = app(PlausibleSettings::class);
$settings->domains;        // ?string
$settings->host_analytics; // string
</code-snippet>
@endverbatim

@verbatim
<code-snippet name="update-settings" lang="php">
use JeffersonGoncalves\Plausible\Settings\PlausibleSettings;

$settings = app(PlausibleSettings::class);
$settings->domains = 'example.com';
$settings->host_analytics = 'https://analytics.example.com';
$settings->save();
</code-snippet>
@endverbatim

### Configuration

No config file is published. All configuration is managed through the `PlausibleSettings` class.

**Publish settings migration:**

@verbatim
<code-snippet name="publish-migration" lang="bash">
php artisan vendor:publish --tag="plausible-settings-migrations"
php artisan migrate
</code-snippet>
@endverbatim

### Blade Integration

Include the tracking script in your layout's `<head>`:

@verbatim
<code-snippet name="blade-include" lang="blade">
{{-- In your layout file (e.g., layouts/app.blade.php) --}}
<head>
    @include('plausible::script')
</head>
</code-snippet>
@endverbatim

The script renders as:

@verbatim
<code-snippet name="rendered-output" lang="html">
<script defer data-domain="example.com"
        src="https://plausible.io/js/script.js"></script>
</code-snippet>
@endverbatim

### Conventions

- Settings group name: `plausible`
- View namespace: `plausible`
- Package name: `laravel-plausible`
- Migration publish tag: `plausible-settings-migrations`
- No models or relationships -- this is a script-injection package.
- PHP 8.2+ required, Laravel 11+, spatie/laravel-settings ^3.0.
