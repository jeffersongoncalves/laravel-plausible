# Changelog

All notable changes to this project will be documented in this file.

## v2.0.2 - 2026-04-26

### What's Changed

* build(deps): bump ramsey/composer-install from 3 to 4 by @dependabot[bot] in https://github.com/jeffersongoncalves/laravel-plausible/pull/12
* build(deps): bump dependabot/fetch-metadata from 2.5.0 to 3.0.0 by @dependabot[bot] in https://github.com/jeffersongoncalves/laravel-plausible/pull/13

**Full Changelog**: https://github.com/jeffersongoncalves/laravel-plausible/compare/v2.0.1...v2.0.2

## v2.0.1 - 2026-02-24

### What's Changed

- Add Laravel 13.x support in composer.json
- Add orchestra/testbench ^11.0 for Laravel 13 testing

## v2.0.0 - 2026-02-22

### Breaking Changes

- **Migrated from config/env to [spatie/laravel-settings](https://github.com/spatie/laravel-settings)** — settings are now stored in the database instead of `config/plausible.php` and environment variables.
- Removed `config/plausible.php` — `PLAUSIBLE_DOMAINS` and `PLAUSIBLE_HOST_ANALYTICS` env vars are no longer used.

### What's New

- **Database-backed settings** — manage Plausible configuration from an admin panel or programmatically via `PlausibleSettings` class.
- **Settings migration** — publish with `php artisan vendor:publish --tag=plausible-settings-migrations`.

### Upgrade Guide

1. Update the package:
   
   ```bash
   composer require jeffersongoncalves/laravel-plausible:^2.0
   
   
   
   ```
2. Publish and run the settings migration:
   
   ```bash
   php artisan vendor:publish --tag=plausible-settings-migrations
   php artisan migrate
   
   
   
   ```
3. Configure settings programmatically:
   
   ```php
   use JeffersonGoncalves\Plausible\Settings\PlausibleSettings;
   
   $settings = app(PlausibleSettings::class);
   $settings->domains = 'example.com';
   $settings->save();
   
   
   
   ```
4. Remove old `PLAUSIBLE_DOMAINS` and `PLAUSIBLE_HOST_ANALYTICS` entries from your `.env` file.
   
5. Delete `config/plausible.php` if it was published in your project.
   

**Full Changelog**: https://github.com/jeffersongoncalves/laravel-plausible/compare/v1.0.2...v2.0.0

## v1.0.2 - 2025-03-05

**Full Changelog**: https://github.com/jeffersongoncalves/laravel-plausible/compare/v1.0.1...v1.0.2

## v1.0.1 - 2025-03-05

**Full Changelog**: https://github.com/jeffersongoncalves/laravel-plausible/compare/v1.0.0...v1.0.1

## v1.0.0 - 2025-03-05

**Full Changelog**: https://github.com/jeffersongoncalves/laravel-plausible/commits/v1.0.0
