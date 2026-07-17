<?php

declare(strict_types=1);

return [
    'enabled' => filter_var(getenv('PREVIEW_ENABLED') ?: true, FILTER_VALIDATE_BOOL),
    'base_url' => getenv('PREVIEW_BASE_URL') ?: 'http://127.0.0.1:8000',
    'message' => 'Welcome!',
];
