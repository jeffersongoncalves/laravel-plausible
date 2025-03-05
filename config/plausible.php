<?php

return [
    // Rollup reporting allows you to aggregate stats from multiple sites and see them in one combined dashboard while keeping the individual site stats on their own separate dashboards. This way you get detailed insights into individual site performance and a holistic view of your whole network too.
    'domains' => env('PLAUSIBLE_DOMAINS'),
    'host_analytics' => env('PLAUSIBLE_HOST_ANALYTICS', 'https://plausible.io'),
];
