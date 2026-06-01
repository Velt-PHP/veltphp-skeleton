<?php
declare(strict_types=1);

// Bootstrap du skeleton : charge l'autoload Composer, le fichier .env et les configs.
require __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;

// Charger .env si présent (utile en développement local)
if (file_exists(__DIR__ . '/../.env')) {
    $dotenv = Dotenv::createImmutable(__DIR__ . '/..');
    $dotenv->load();
}

// Charger les fichiers de configuration via les helpers du skeleton
if (function_exists('velt_load_config')) {
    velt_load_config(__DIR__ . '/../config');
}

// Construction de l'application à partir du kernel. Nous enregistrons
// ici les providers nécessaires au skeleton (HTTP + UI) et enregistrons
// les routes avant d'appeler le cycle `boot()`.
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

/** @var Router $router */
$router = $app->container()->get(Router::class);

// Enregistrer les routes du skeleton (web + api). Les fichiers de routes
// doivent renvoyer un callable acceptant (Router, Application).
foreach (['web', 'api'] as $routesFile) {
    $path = $basePath . '/routes/' . $routesFile . '.php';
    if (file_exists($path)) {
        $routes = require $path;
        if (is_callable($routes)) {
            $routes($router, $app);
        }
    }
}

// Démarrer le cycle de vie de l'application (providers, bindings, etc.).
$app->boot();

return [
    'app' => $app,
    'router' => $router,
    'dispatcher' => $app->container()->get(Dispatcher::class),
];
