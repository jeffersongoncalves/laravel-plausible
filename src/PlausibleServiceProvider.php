<?php

namespace JeffersonGoncalves\Plausible;

use Illuminate\Support\Facades\Config;
use JeffersonGoncalves\Plausible\Settings\PlausibleSettings;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class PlausibleServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package->name('laravel-plausible')
            ->hasViews();
    }

    public function packageRegistered(): void
    {
        parent::packageRegistered();

        Config::set('settings.settings', array_merge(
            Config::get('settings.settings', []),
            [PlausibleSettings::class]
        ));
    }

    public function packageBooted(): void
    {
        parent::packageBooted();

        $migrationsPath = __DIR__.'/../database/settings';

        Config::set('settings.migrations_paths', array_merge(
            Config::get('settings.migrations_paths', []),
            [$migrationsPath]
        ));

        $this->publishes([
            $migrationsPath => database_path('settings'),
        ], 'plausible-settings-migrations');
    }
}
