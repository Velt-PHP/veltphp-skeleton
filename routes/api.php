<?php

declare(strict_types=1);

use App\Projects\Controllers\ProjectApiController;
use Velt\Http\Router;

return static function (Router $router): void {
    $router->get('/api/projects', [ProjectApiController::class, 'index']);
};
