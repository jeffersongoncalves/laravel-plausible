@php($plausible = app(\JeffersonGoncalves\Plausible\Settings\PlausibleSettings::class))

@if(!empty($plausible->domains))
    <script @if(\Illuminate\Support\Facades\Vite::cspNonce()) nonce="{{ \Illuminate\Support\Facades\Vite::cspNonce() }}" @endif defer data-domain="{{ $plausible->domains }}"
            src="{{ rtrim($plausible->host_analytics, '/') }}/js/script.js"></script>
@endif
