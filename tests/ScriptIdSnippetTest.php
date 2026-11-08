<?php

use Illuminate\Support\Facades\Vite;
use JeffersonGoncalves\Plausible\Settings\PlausibleSettings;

function plausibleWith(array $values): void
{
    $settings = app(PlausibleSettings::class);
    foreach ($values as $key => $value) {
        $settings->{$key} = $value;
    }
    $settings->save();
}

it('renders the current snippet when script_id is set', function () {
    plausibleWith(['script_id' => 'pa-abc123', 'host_analytics' => 'https://analytics.example.com/']);

    $this->blade('@include("plausible::script")')
        ->assertSee('<script  async src="https://analytics.example.com/js/pa-abc123.js"></script>', false)
        ->assertSee('plausible.init()', false)
        ->assertDontSee('data-domain', false)
        ->assertDontSee('/js/script.js', false);
});

it('accepts the full script url or a .js suffix as script_id', function (string $input) {
    plausibleWith(['script_id' => $input]);

    $this->blade('@include("plausible::script")')
        ->assertSee('src="https://plausible.io/js/pa-abc123.js"', false);
})->with([
    'with .js' => 'pa-abc123.js',
    'full url' => 'https://plausible.io/js/pa-abc123.js',
]);

it('prefers script_id over the legacy domains snippet', function () {
    plausibleWith(['domains' => 'example.com', 'script_id' => 'pa-abc123']);

    $this->blade('@include("plausible::script")')
        ->assertSee('pa-abc123.js', false)
        ->assertDontSee('data-domain', false);
});

it('stamps the CSP nonce on both tags of the current snippet', function () {
    Vite::useCspNonce('test-nonce');
    plausibleWith(['script_id' => 'pa-abc123']);

    preg_match_all('/<script\b[^>]*>/', (string) $this->blade('@include("plausible::script")'), $tags);

    expect($tags[0])->toHaveCount(2)->each->toContain('nonce="test-nonce"');
});
