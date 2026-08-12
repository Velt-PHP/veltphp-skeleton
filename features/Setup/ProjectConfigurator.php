<?php

declare(strict_types=1);

namespace App\Setup;

use InvalidArgumentException;
use RuntimeException;

final class ProjectConfigurator
{
    private const TYPES = ['web', 'api'];

    private const STYLES = ['tailwind', 'none'];

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
}
