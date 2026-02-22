<?php

namespace JeffersonGoncalves\Plausible\Settings;

use Spatie\LaravelSettings\Settings;

class PlausibleSettings extends Settings
{
    public ?string $domains = null;

    public string $host_analytics = 'https://plausible.io';

    public static function group(): string
    {
        return 'plausible';
    }
}
