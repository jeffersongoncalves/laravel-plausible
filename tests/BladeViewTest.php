<?php

use JeffersonGoncalves\Plausible\Settings\PlausibleSettings;

it('does not render the script when domains is empty', function () {
    $settings = app(PlausibleSettings::class);
    $settings->domains = null;
    $settings->save();

    $view = $this->blade('@include("plausible::script")');

    $view->assertDontSee('<script', false);
});

it('renders the script with the correct data-domain when domains is set', function () {
    $settings = app(PlausibleSettings::class);
    $settings->domains = 'example.com';
    $settings->save();

    $view = $this->blade('@include("plausible::script")');

    $view->assertSee('data-domain="example.com"', false)
        ->assertSee('src="https://plausible.io/js/script.js"', false);
});

it('uses the configured host_analytics for the script src', function () {
    $settings = app(PlausibleSettings::class);
    $settings->domains = 'example.com';
    $settings->host_analytics = 'https://analytics.example.com';
    $settings->save();

    $view = $this->blade('@include("plausible::script")');

    $view->assertSee('src="https://analytics.example.com/js/script.js"', false);
});

it('normalizes a trailing slash in host_analytics to avoid a double slash', function () {
    $settings = app(PlausibleSettings::class);
    $settings->domains = 'example.com';
    $settings->host_analytics = 'https://analytics.example.com/';
    $settings->save();

    $view = $this->blade('@include("plausible::script")');

    $view->assertSee('src="https://analytics.example.com/js/script.js"', false)
        ->assertDontSee('.com//js/script.js', false);
});
