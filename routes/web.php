<?php

declare(strict_types=1);

use App\Home\HomePage;
use Velt\Http\Router;

return static function (Router $router): void {
    $router->get('/', [HomePage::class, 'show']);
};
