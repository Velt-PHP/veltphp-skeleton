<?php
declare(strict_types=1);

// Helpers de configuration et d'environnement pour le skeleton.
// Ces fonctions sont destinées à faciliter le développement local et
// les tests d'intégration du skeleton. Elles sont temporaires et
// seront remplacées par l'implémentation centrale du kernel lorsque
// `ConfigRepositoryInterface` sera disponible.

global $__velt_config;
$__velt_config = [];

/**
 * Charge tous les fichiers PHP dans un répertoire de config et les
 * expose via la fonction `config()`.
 */
function velt_load_config(string $dir): void
{
    global $__velt_config;
    $files = glob($dir . '/*.php');
    if ($files === false) {
        return;
    }
    foreach ($files as $file) {
        $key = basename($file, '.php');
        $cfg = include $file;
        if (is_array($cfg)) {
            $__velt_config[$key] = $cfg;
        }
    }
}

/**
 * Récupère une valeur de configuration en notation pointée.
 * Ex: `config('app.name')`.
 */
function config(string $key, $default = null)
{
    global $__velt_config;
    $parts = explode('.', $key);
    $value = $__velt_config;
    foreach ($parts as $p) {
        if (is_array($value) && array_key_exists($p, $value)) {
            $value = $value[$p];
        } else {
            return $default;
        }
    }
    return $value;
}

/**
 * Lit une variable d'environnement avec fallback vers 
 * `$_ENV`, `$_SERVER` puis une valeur par défaut.
 */
function env(string $key, $default = null)
{
    $val = getenv($key);
    if ($val !== false) {
        return $val;
    }
    if (array_key_exists($key, $_ENV)) {
        return $_ENV[$key];
    }
    if (array_key_exists($key, $_SERVER)) {
        return $_SERVER[$key];
    }
    return $default;
}
