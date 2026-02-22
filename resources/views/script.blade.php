@php($plausible = app(\JeffersonGoncalves\Plausible\Settings\PlausibleSettings::class))

@if(!empty($plausible->domains))
    <script defer data-domain="{{ $plausible->domains }}"
            src="{{ $plausible->host_analytics }}/js/script.js"></script>
@endif
