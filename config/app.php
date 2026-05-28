<?php

declare(strict_types=1);

return [
    'name' => getenv('APP_NAME') ?: 'Velt App',
    'env' => getenv('APP_ENV') ?: 'local',
    'debug' => filter_var(getenv('APP_DEBUG') ?: true, FILTER_VALIDATE_BOOL),
    'url' => getenv('APP_URL') ?: 'http://127.0.0.1:8000',
];
