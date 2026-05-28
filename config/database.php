<?php

declare(strict_types=1);

return [
    'default' => getenv('DB_CONNECTION') ?: 'sqlite',
    'connections' => [
        'sqlite' => [
            'driver' => 'sqlite',
            'database' => getenv('DB_DATABASE') ?: 'database/database.sqlite',
        ],
    ],
];
