<?php

namespace JeffersonGoncalves\Plausible\Settings;

use Spatie\LaravelSettings\Settings;

class PlausibleSettings extends Settings
{
    public ?string $domains = null;

    public string $host_analytics = 'https://plausible.io';

    /**
     * Per-site script id from Plausible's current snippet (`pa-XXXX`, the
     * file name in `/js/pa-XXXX.js`). When set, the new snippet is rendered
     * instead of the legacy `data-domain` one.
     */
    public ?string $script_id = null;

    public static function group(): string
    {
        return 'plausible';
    }
}
