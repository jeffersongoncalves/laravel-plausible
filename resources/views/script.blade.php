@if(!empty(config('plausible.domains')))
    <script defer data-domain="{{ config('plausible.domains') }}"
            src="{{ config('plausible.host_analytics') }}/js/script.js"></script>
@endif
