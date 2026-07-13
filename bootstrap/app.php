<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;
use Velt\Database\DatabaseManager;
use Velt\Database\DatabaseServiceProvider;
use Velt\Http\Dispatcher;
use Velt\Http\Integration\HttpServiceProvider;
use Velt\Http\Router;
use Velt\Kernel\Application;
use Velt\Ui\Providers\UiServiceProvider;

if (file_exists(__DIR__ . '/../.env')) {
    Dotenv::createImmutable(__DIR__ . '/..')->load();
}

if (function_exists('velt_load_config')) {
    velt_load_config(__DIR__ . '/../config');
}

$basePath = dirname(__DIR__);

$config = [];
foreach (glob($basePath . '/config/*.php') ?: [] as $configFile) {
    $config[basename($configFile, '.php')] = include $configFile;
}

$app = new Application($basePath, $config);
$app->registerProvider(HttpServiceProvider::class);
$app->registerProvider(UiServiceProvider::class);
$app->registerProvider(DatabaseServiceProvider::class);

/** @var Router $router */
$router = new Router();
$app->container()->instance(Router::class, $router);

foreach (['web', 'api'] as $routesFile) {
    $path = $basePath . '/routes/' . $routesFile . '.php';
    if (file_exists($path)) {
        $routes = require $path;
        if (is_callable($routes)) {
            $routes($router, $app);
        }
    }
}

$app->boot();
$app->container()->get(DatabaseManager::class);

return [
    'app' => $app,
    'router' => $router,
    'dispatcher' => $app->container()->get(Dispatcher::class),
];
