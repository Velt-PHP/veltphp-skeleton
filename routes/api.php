<?php

declare(strict_types=1);

use Velt\Http\JsonResponse;
use Velt\Http\Router;

return static function (Router $router): void {
    $router->get('/api/preview/demo', static fn (): JsonResponse => JsonResponse::json([
        'success' => false,
        'error' => [
            'code' => 'preview_session_missing',
            'message' => 'No preview session is available for the demo route.',
        ],
    ], 404));
};
