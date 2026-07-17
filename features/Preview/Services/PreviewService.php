<?php

declare(strict_types=1);

namespace App\Preview\Services;

use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\PlainTextRenderer;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;
use RuntimeException;

final class PreviewService
{
    private string $basePath;
    private string $storagePath;

    public function __construct(?string $basePath = null)
    {
        $this->basePath = $basePath ?? dirname(__DIR__, 3);
        $this->storagePath = $this->basePath . '/storage/preview';
    }

    /**
     * @return array<string, mixed>
     */
    public function createSession(?string $host = null): array
    {
        $sessionId = bin2hex(random_bytes(6));
        $baseUrl = $this->baseUrl($host);
        $url = $baseUrl . '/api/preview/' . $sessionId;
        $qrPath = $this->qrcodePath($sessionId);

        $this->ensureStorage();
        $this->writeQrSvg($url, $qrPath);

        $session = [
            'id' => $sessionId,
            'url' => $url,
            'qr_payload' => $url,
            'qr_image' => $this->relativePath($qrPath),
            'message' => 'Welcome!',
            'created_at' => date(DATE_ATOM),
        ];

        $sessions = $this->readSessions();
        $sessions[$sessionId] = $session;
        $this->writeSessions($sessions);

        return $session;
    }

    /**
     * @return array<string, mixed>|null
     */
    public function findSession(string $sessionId): ?array
    {
        $sessions = $this->readSessions();

        return $sessions[$sessionId] ?? null;
    }

    /**
     * @return array<string, mixed>
     */
    public function previewPayload(string $sessionId): array
    {
        $session = $this->findSession($sessionId);

        if ($session === null) {
            throw new RuntimeException('Preview session not found.');
        }

        return [
            'schemaVersion' => '1.0',
            'screen' => 'home',
            'components' => [
                [
                    'type' => 'Text',
                    'value' => $session['message'] ?? 'Welcome!',
                    'props' => [
                        'value' => $session['message'] ?? 'Welcome!',
                    ],
                ],
            ],
            'meta' => [
                'sessionId' => $sessionId,
                'source' => 'skeleton.preview',
            ],
        ];
    }

    public function qrTerminal(string $payload): string
    {
        return (new Writer(new PlainTextRenderer(2)))->writeString($payload);
    }

    private function baseUrl(?string $host): string
    {
        $configured = getenv('PREVIEW_BASE_URL');

        if (is_string($configured) && $configured !== '') {
            return rtrim($configured, '/');
        }

        $host ??= '127.0.0.1:8000';

        if (! str_contains($host, '://')) {
            $host = 'http://' . $host;
        }

        return rtrim($host, '/');
    }

    private function writeQrSvg(string $payload, string $path): void
    {
        $renderer = new ImageRenderer(
            new RendererStyle(320, 4),
            new SvgImageBackEnd(),
        );

        (new Writer($renderer))->writeFile($payload, $path);
    }

    private function ensureStorage(): void
    {
        foreach ([$this->storagePath, $this->storagePath . '/qrcodes'] as $path) {
            if (! is_dir($path) && ! mkdir($path, 0775, true) && ! is_dir($path)) {
                throw new RuntimeException("Unable to create preview storage directory [{$path}].");
            }
        }
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    private function readSessions(): array
    {
        $path = $this->sessionsPath();

        if (! is_file($path)) {
            return [];
        }

        $json = file_get_contents($path);
        $data = json_decode($json === false ? '{}' : $json, true);

        return is_array($data) ? $data : [];
    }

    /**
     * @param array<string, array<string, mixed>> $sessions
     */
    private function writeSessions(array $sessions): void
    {
        $json = json_encode($sessions, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);

        if ($json === false || file_put_contents($this->sessionsPath(), $json . PHP_EOL) === false) {
            throw new RuntimeException('Unable to write preview sessions.');
        }
    }

    private function sessionsPath(): string
    {
        return $this->storagePath . '/sessions.json';
    }

    private function qrcodePath(string $sessionId): string
    {
        return $this->storagePath . '/qrcodes/' . $sessionId . '.svg';
    }

    private function relativePath(string $path): string
    {
        $relative = str_replace('\\', '/', substr($path, strlen($this->basePath) + 1));

        return $relative === false ? $path : $relative;
    }
}
