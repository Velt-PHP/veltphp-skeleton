<?php

declare(strict_types=1);

namespace App\Setup;

use InvalidArgumentException;
use RuntimeException;

final class ProjectConfigurator
{
    private const TYPES = ['web', 'api', 'cross-platform'];

    private const STYLES = ['tailwind', 'nativewind', 'none'];

    private const DATABASES = ['sqlite', 'mysql', 'pgsql'];

    public function __construct(private readonly string $basePath)
    {
    }

    /** @return array{type: string, styling: string, database: string, environment: string} */
    public function configure(string $type, string $styling, string $database): array
    {
        $type = strtolower($type);
        $styling = strtolower($styling);
        $database = strtolower($database);

        $this->assertChoice('project type', $type, self::TYPES);
        $this->assertChoice('styling preset', $styling, self::STYLES);
        $this->assertChoice('database', $database, self::DATABASES);

        if ($type === 'api') {
            $styling = 'none';
        } elseif ($type === 'cross-platform') {
            $styling = 'nativewind';
        }

        $environmentPath = $this->basePath . '/.env';
        $environment = is_file($environmentPath)
            ? (string) file_get_contents($environmentPath)
            : $this->environmentExample();

        $environment = $this->setEnvironmentValue($environment, 'VELT_PROJECT_TYPE', $type);
        $environment = $this->setEnvironmentValue($environment, 'VELT_STYLING', $styling);
        $environment = $this->setEnvironmentValue($environment, 'DB_CONNECTION', $database);
        $environment = $this->setEnvironmentValue($environment, 'DB_DATABASE', $this->databaseName($database));

        if (file_put_contents($environmentPath, $environment) === false) {
            throw new RuntimeException(sprintf('Unable to write [%s].', $environmentPath));
        }

        if ($database === 'sqlite') {
            $sqlitePath = $this->basePath . '/database/database.sqlite';
            if (!is_file($sqlitePath) && touch($sqlitePath) === false) {
                throw new RuntimeException(sprintf('Unable to create [%s].', $sqlitePath));
            }
        }

        $this->applyProfile($type, $styling);

        return [
            'type' => $type,
            'styling' => $styling,
            'database' => $database,
            'environment' => $environmentPath,
        ];
    }

    /** @param list<string> $choices */
    private function assertChoice(string $label, string $value, array $choices): void
    {
        if (!in_array($value, $choices, true)) {
            throw new InvalidArgumentException(sprintf(
                'Unsupported %s [%s]. Expected one of: %s.',
                $label,
                $value,
                implode(', ', $choices),
            ));
        }
    }

    private function environmentExample(): string
    {
        $path = $this->basePath . '/.env.example';

        if (!is_file($path)) {
            throw new RuntimeException(sprintf('Environment template [%s] does not exist.', $path));
        }

        return (string) file_get_contents($path);
    }

    private function setEnvironmentValue(string $environment, string $key, string $value): string
    {
        $line = $key . '=' . $value;
        $pattern = '/^' . preg_quote($key, '/') . '=.*$/m';

        if (preg_match($pattern, $environment) === 1) {
            return (string) preg_replace($pattern, $line, $environment);
        }

        return rtrim($environment) . PHP_EOL . $line . PHP_EOL;
    }

    private function databaseName(string $database): string
    {
        return $database === 'sqlite' ? 'database/database.sqlite' : 'velt';
    }

    private function applyProfile(string $type, string $styling): void
    {
        $this->writeComposerProfile($type);

        if ($type === 'api') {
            $this->removePaths([
                'features/Home',
                'features/Documentation',
                'features/Preview',
                'resources',
                'routes/web.php',
                'routes/preview.php',
                'public/assets',
                'package.json',
                'package-lock.json',
                'postcss.config.js',
                'tailwind.config.js',
            ]);

            return;
        }

        if ($type === 'web') {
            $this->removePaths(['features/Preview', 'routes/preview.php', 'native']);
            if ($styling === 'none') {
                $this->removePaths(['resources/css', 'public/assets/app.css', 'package.json', 'package-lock.json', 'postcss.config.js', 'tailwind.config.js']);
            }

            return;
        }

        $nativePath = $this->basePath . '/native';
        if (!is_dir($nativePath) && !mkdir($nativePath, 0777, true) && !is_dir($nativePath)) {
            throw new RuntimeException(sprintf('Unable to create [%s].', $nativePath));
        }

        file_put_contents($nativePath . '/velt.json', json_encode([
            'platforms' => ['android'],
            'runtime' => 'nativephp',
            'renderer' => 'compose',
            'styling' => 'nativewind',
            'status' => 'experimental',
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . PHP_EOL);
        $this->writeCrossPlatformPackage();
    }

    private function writeComposerProfile(string $type): void
    {
        $path = $this->basePath . '/composer.json';
        if (!is_file($path)) {
            return;
        }

        $composer = json_decode((string) file_get_contents($path), true, 512, JSON_THROW_ON_ERROR);
        $base = [
            'php' => $type === 'cross-platform' ? '^8.4' : '^8.2',
            'velt/cli' => '^0.2.0',
            'velt/database' => '^0.1.0',
            'velt/http' => '^0.1.0',
            'velt/kernel' => '^0.1.0',
            'velt/orm' => '^0.1.0',
            'vlucas/phpdotenv' => '^5.5',
        ];

        if ($type !== 'api') {
            $base['velt/ui'] = '^0.1.0';
        }

        if ($type === 'cross-platform') {
            $base['bacon/bacon-qr-code'] = '^2.0';
            $base['velt/native'] = '^0.1@alpha';
            $base['velt/preview'] = '^0.1.1';
            $composer['repositories'] = [[
                'type' => 'vcs',
                'url' => 'https://github.com/Velt-PHP/velt-native',
            ]];
        } else {
            unset($composer['repositories']);
        }

        ksort($base);
        $composer['require'] = $base;
        file_put_contents($path, json_encode($composer, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . PHP_EOL);
    }

    /** @param list<string> $paths */
    private function removePaths(array $paths): void
    {
        foreach ($paths as $relativePath) {
            $path = $this->basePath . '/' . $relativePath;
            if (is_file($path) || is_link($path)) {
                unlink($path);
            } elseif (is_dir($path)) {
                $this->removeDirectory($path);
            }
        }
    }

    private function removeDirectory(string $path): void
    {
        foreach (new \FilesystemIterator($path) as $item) {
            if ($item->isDir() && !$item->isLink()) {
                $this->removeDirectory($item->getPathname());
            } else {
                unlink($item->getPathname());
            }
        }

        rmdir($path);
    }

    private function writeCrossPlatformPackage(): void
    {
        $path = $this->basePath . '/package.json';
        if (!is_file($path)) {
            return;
        }

        $package = json_decode((string) file_get_contents($path), true, 512, JSON_THROW_ON_ERROR);
        $package['devDependencies']['nativewind'] = '^4.2.0';
        ksort($package['devDependencies']);
        file_put_contents($path, json_encode($package, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . PHP_EOL);
    }
}
