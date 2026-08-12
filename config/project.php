<?php

declare(strict_types=1);

return [
    'type' => env('VELT_PROJECT_TYPE', 'web'),
    'styling' => env('VELT_STYLING', 'tailwind'),
    'platforms' => env('VELT_PROJECT_TYPE', 'web') === 'cross-platform' ? ['web', 'android'] : [env('VELT_PROJECT_TYPE', 'web')],
];
