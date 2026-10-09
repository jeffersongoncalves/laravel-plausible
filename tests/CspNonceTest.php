<?php

use Illuminate\Support\Facades\Vite;
use JeffersonGoncalves\Plausible\Settings\PlausibleSettings;

it('stamps the CSP nonce on every script tag', function () {
    Vite::useCspNonce('test-nonce');
    $settings = app(PlausibleSettings::class);
    $settings->domains = 'example.com';
    $settings->save();
    $html = (string) $this->blade('@include("plausible::script")');

    preg_match_all('/<script\b[^>]*>/', $html, $tags);

    expect($tags[0])->not->toBeEmpty()->each->toContain('nonce="test-nonce"');
});

it('renders no nonce attribute when the app uses none', function () {
    $settings = app(PlausibleSettings::class);
    $settings->domains = 'example.com';
    $settings->save();
    $html = (string) $this->blade('@include("plausible::script")');

    expect($html)->toContain('<script')->not->toContain('nonce=');
});
