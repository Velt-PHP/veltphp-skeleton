<?php
declare(strict_types=1);

// Bootstrap for the skeleton: load Composer autoload, .env and config files.
require __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;

// Load .env if present
if (file_exists(__DIR__ . '/../.env')) {
    $dotenv = Dotenv::createImmutable(__DIR__ . '/..');
    $dotenv->load();
}

// Load config files into memory (helpers provide velt_load_config)
if (function_exists('velt_load_config')) {
    velt_load_config(__DIR__ . '/../config');
}

// Build the Application using velt kernel and register providers required by the skeleton.
use Velt\Kernel\Application;
use Velt\Http\Integration\HttpServiceProvider;
use Velt\Kernel\Ui\UiServiceProvider;
use Velt\Http\Router;
use Velt\Http\Dispatcher;

$basePath = dirname(__DIR__);

$config = [];
foreach (glob($basePath . '/config/*.php') ?: [] as $configFile) {
    $config[basename($configFile, '.php')] = include $configFile;
}

$app = new Application($basePath, $config);
$app->registerProvider(HttpServiceProvider::class);
$app->registerProvider(UiServiceProvider::class);

$app->boot();

/** @var Router $router */
$router = $app->container()->get(Router::class);

// Register skeleton routes (web + api)
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

return [
    'app' => $app,
    'router' => $router,
    'dispatcher' => $app->container()->get(Dispatcher::class),
];
