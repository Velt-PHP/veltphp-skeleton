<?php

declare(strict_types=1);

namespace Tests\Feature;

use PHPUnit\Framework\TestCase;
use Velt\Database\Migrations\Migrator;
use Velt\Database\Seeders\SeederRunner;
use Velt\Http\Dispatcher;
use Velt\Http\Request;
use Velt\Ui\Providers\UiServiceProvider;

final class SkeletonSmokeTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        putenv('APP_ENV=testing');
        putenv('DB_CONNECTION=sqlite');
        putenv('DB_DATABASE=:memory:');
    }

    public function test_ui_service_provider_is_available_from_generated_project_autoload(): void
    {
        self::assertTrue(class_exists(UiServiceProvider::class));
    }

    public function test_home_route_returns_rendered_velt_page_with_assets(): void
    {
        $response = $this->dispatcher()->dispatch(new Request('GET', '/'));

        self::assertSame(200, $response->status());
        self::assertStringContainsString('<!doctype html>', $response->body());
        self::assertStringContainsString('/assets/app.css', $response->body());
        self::assertStringContainsString('Framework PHP modulaire pour interfaces declaratives', $response->body());
        self::assertStringContainsString('logo-mark', $response->body());
    }

    public function test_documentation_pages_are_registered(): void
    {
        $dispatcher = $this->dispatcher();

        $docs = $dispatcher->dispatch(new Request('GET', '/docs'));
        $database = $dispatcher->dispatch(new Request('GET', '/database'));

        self::assertSame(200, $docs->status());
        self::assertSame(200, $database->status());
        self::assertStringContainsString('Documentation', $docs->body());
        self::assertStringContainsString('Backend et base de donnees', $database->body());
    }

    public function test_migrations_seeders_model_and_projects_api_work_together(): void
    {
        $dispatcher = $this->dispatcher();
        $basePath = dirname(__DIR__, 2);

        self::assertSame(
            ['2026_07_13_000000_create_projects_table.php'],
            (new Migrator($basePath . '/database/migrations'))->migrate(),
        );

        (new SeederRunner())->run(\Database\Seeders\DatabaseSeeder::class);

        $response = $dispatcher->dispatch(new Request('GET', '/api/projects'));

        self::assertSame(200, $response->status());
        self::assertSame('application/json', $response->headers()['Content-Type'] ?? null);

        $payload = json_decode($response->body(), true, 512, JSON_THROW_ON_ERROR);

        self::assertCount(2, $payload['data']);
        self::assertSame('welcome-flow', $payload['data'][0]['slug']);
        self::assertSame('database-demo', $payload['data'][1]['slug']);
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
