<?php

declare(strict_types=1);

namespace Tests\Feature;

use PHPUnit\Framework\TestCase;
use Velt\Http\Dispatcher;
use Velt\Http\Request;
use Velt\Ui\Providers\UiServiceProvider;

final class SkeletonSmokeTest extends TestCase
{
    public function test_ui_service_provider_is_available_from_generated_project_autoload(): void
    {
        self::assertTrue(class_exists(UiServiceProvider::class));
    }

    public function test_home_route_returns_rendered_velt_page(): void
    {
        $response = $this->dispatcher()->dispatch(new Request('GET', '/'));

        self::assertSame(200, $response->status());
        self::assertStringContainsString('<!doctype html>', $response->body());
        self::assertStringContainsString('Velt App', $response->body());
        self::assertStringContainsString('Your Velt project is installed and ready.', $response->body());
    }

    public function test_preview_demo_route_returns_clean_json_error_without_session(): void
    {
        $response = $this->dispatcher()->dispatch(new Request('GET', '/api/preview/demo'));

        self::assertSame(404, $response->status());
        self::assertSame('application/json', $response->headers()['Content-Type'] ?? null);

        $payload = json_decode($response->body(), true);

        self::assertSame(false, $payload['success'] ?? null);
        self::assertSame('preview_session_missing', $payload['error']['code'] ?? null);
    }

    private function dispatcher(): Dispatcher
    {
        $kernel = require dirname(__DIR__, 2) . '/bootstrap/app.php';

        return $kernel['dispatcher'];
    }
}
