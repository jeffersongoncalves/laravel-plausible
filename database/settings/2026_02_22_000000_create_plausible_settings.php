<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('plausible.domains', null);
        $this->migrator->add('plausible.host_analytics', 'https://plausible.io');
    }
};
