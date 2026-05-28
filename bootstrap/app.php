<?php

declare(strict_types=1);

use Velt\Http\Dispatcher;
use Velt\Http\Integration\HttpServiceProvider;
use Velt\Http\Router;
use Velt\Kernel\Application;
use Velt\Kernel\Ui\UiServiceProvider;

require_once __DIR__ . '/../vendor/autoload.php';

$basePath = dirname(__DIR__);

$config = [];
foreach (glob($basePath . '/config/*.php') ?: [] as $configFile) {
    $config[basename($configFile, '.php')] = require $configFile;
}

$app = new Application($basePath, $config);
$app->registerProvider(HttpServiceProvider::class);
$app->registerProvider(UiServiceProvider::class);

/** @var Router $router */
$router = $app->container()->get(Router::class);

foreach (['web', 'api'] as $routesFile) {
    $routes = require $basePath . '/routes/' . $routesFile . '.php';

    if (is_callable($routes)) {
        $routes($router, $app);
    }
}

$app->boot();

return [
    'app' => $app,
    'router' => $router,
    'dispatcher' => $app->container()->get(Dispatcher::class),
];
