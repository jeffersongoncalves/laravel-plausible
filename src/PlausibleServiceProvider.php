<?php

namespace JeffersonGoncalves\Plausible;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class PlausibleServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package->name('laravel-plausible')
            ->hasConfigFile('plausible')
            ->hasViews();
    }
}
