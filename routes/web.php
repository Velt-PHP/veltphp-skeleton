<?php

declare(strict_types=1);

use App\Documentation\Controllers\DocumentationController;
use App\Home\Controllers\HomeController;
use Velt\Http\Router;

return static function (Router $router): void {
    $router->get('/', [HomeController::class, 'show']);
    $router->get('/docs', [DocumentationController::class, 'docs']);
    $router->get('/database', [DocumentationController::class, 'database']);
};
