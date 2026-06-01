<?php
declare(strict_types=1);

global $__velt_config;
$__velt_config = [];

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
