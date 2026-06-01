<?php
return [
    'default' => env('DB_CONNECTION', 'sqlite'),
    'connections' => [
        'sqlite' => [
            'dsn' => env('DB_DSN', 'sqlite::memory:'),
        ],
    ],
];
 
