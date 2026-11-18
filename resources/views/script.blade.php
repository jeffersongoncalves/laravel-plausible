@php
    $cookieConsent = function_exists('cookie_consent_script_attributes') ? cookie_consent_script_attributes('plausible') : '';
@endphp
@php
    $plausible = app(\JeffersonGoncalves\Plausible\Settings\PlausibleSettings::class);
    $plausibleHost = rtrim($plausible->host_analytics, '/');
    // Accept "pa-XXXX", "pa-XXXX.js" or the full script URL pasted from Plausible.
    $plausibleScriptId = filled($plausible->script_id) ? basename((string) $plausible->script_id, '.js') : null;
    $plausibleNonce = \Illuminate\Support\Facades\Vite::cspNonce();
@endphp

@if($plausibleScriptId)
    <script{!! $cookieConsent !!} @if($plausibleNonce) nonce="{{ $plausibleNonce }}" @endif async src="{{ $plausibleHost }}/js/{{ $plausibleScriptId }}.js"></script>
    <script{!! $cookieConsent !!} @if($plausibleNonce) nonce="{{ $plausibleNonce }}" @endif>
        window.plausible=window.plausible||function(){(plausible.q=plausible.q||[]).push(arguments)},plausible.init=plausible.init||function(i){plausible.o=i||{}};
        plausible.init()
    </script>
@elseif(!empty($plausible->domains))
    <script{!! $cookieConsent !!} @if($plausibleNonce) nonce="{{ $plausibleNonce }}" @endif defer data-domain="{{ $plausible->domains }}"
            src="{{ $plausibleHost }}/js/script.js"></script>
@endif
