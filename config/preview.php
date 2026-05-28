<?php

declare(strict_types=1);

return [
    'enabled' => filter_var(getenv('PREVIEW_ENABLED') ?: true, FILTER_VALIDATE_BOOL),
    'demo_session' => null,
];
