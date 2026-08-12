<?php

declare(strict_types=1);

namespace Tests\Feature;

use PHPUnit\Framework\TestCase;
use App\Preview\Services\PreviewService;
use App\Setup\ProjectConfigurator;
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
        putenv('VELT_PROJECT_TYPE=cross-platform');
        putenv('VELT_STYLING=nativewind');
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
        self::assertStringContainsString('tracking-[0.2em]', $response->body());
        self::assertStringNotContainsString('feature-card', $response->body());
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

    public function test_preview_session_returns_homepage_velt_tree_payload(): void
    {
        $basePath = dirname(__DIR__, 2);
        $service = new PreviewService($basePath);
        $session = $service->createSession('127.0.0.1:8000');

        self::assertFileExists($basePath . '/' . $session['qr_image']);

        $response = $this->dispatcher()->dispatch(new Request('GET', '/api/preview/' . $session['id']));

        self::assertSame(200, $response->status());
        self::assertSame('application/json', $response->headers()['Content-Type'] ?? null);

        $payload = json_decode($response->body(), true, 512, JSON_THROW_ON_ERROR);

        self::assertSame(1, $payload['schemaVersion']);
        self::assertSame('Velt', $payload['screen']);
        self::assertSame('homepage', $payload['meta']['view'] ?? null);
        self::assertSame('Card', $payload['components'][0]['type']);
        self::assertStringContainsString(
            'Framework PHP modulaire pour interfaces declaratives',
            json_encode($payload, JSON_THROW_ON_ERROR),
        );
    }

    public function test_preview_route_returns_docs_velt_tree_payload(): void
    {
        $response = $this->dispatcher()->dispatch(new Request('GET', '/api/preview-route/docs'));

        self::assertSame(200, $response->status());
        self::assertSame('application/json', $response->headers()['Content-Type'] ?? null);

        $payload = json_decode($response->body(), true, 512, JSON_THROW_ON_ERROR);

        self::assertSame(1, $payload['schemaVersion']);
        self::assertSame('Velt Documentation', $payload['screen']);
        self::assertSame('docs', $payload['meta']['view'] ?? null);
        self::assertStringContainsString('Documentation Velt', json_encode($payload, JSON_THROW_ON_ERROR));
    }

    public function test_project_configurator_creates_a_web_tailwind_sqlite_profile(): void
    {
        $path = sys_get_temp_dir() . '/velt-skeleton-' . bin2hex(random_bytes(6));
        mkdir($path . '/database', 0777, true);
        file_put_contents($path . '/.env.example', "APP_NAME=Velt\nVELT_PROJECT_TYPE=web\nVELT_STYLING=tailwind\nDB_CONNECTION=sqlite\nDB_DATABASE=database/database.sqlite\n");

        $result = (new ProjectConfigurator($path))->configure('web', 'tailwind', 'sqlite');
        $environment = (string) file_get_contents($path . '/.env');

        self::assertSame('web', $result['type']);
        self::assertSame('tailwind', $result['styling']);
        self::assertStringContainsString('VELT_PROJECT_TYPE=web', $environment);
        self::assertStringContainsString('VELT_STYLING=tailwind', $environment);
        self::assertFileExists($path . '/database/database.sqlite');
    }

    public function test_api_profile_forces_frontend_styling_off(): void
    {
        $path = sys_get_temp_dir() . '/velt-skeleton-' . bin2hex(random_bytes(6));
        mkdir($path . '/database', 0777, true);
        file_put_contents($path . '/.env.example', "VELT_PROJECT_TYPE=web\nVELT_STYLING=tailwind\nDB_CONNECTION=sqlite\nDB_DATABASE=database/database.sqlite\n");

        $result = (new ProjectConfigurator($path))->configure('api', 'tailwind', 'mysql');

        self::assertSame('api', $result['type']);
        self::assertSame('none', $result['styling']);
        self::assertStringContainsString('VELT_STYLING=none', (string) file_get_contents($path . '/.env'));
    }

    public function test_api_profile_physically_removes_web_and_preview_files(): void
    {
        $path = $this->profileFixture();

        (new ProjectConfigurator($path))->configure('api', 'tailwind', 'sqlite');

        self::assertFileDoesNotExist($path . '/routes/web.php');
        self::assertFileDoesNotExist($path . '/routes/preview.php');
        self::assertDirectoryDoesNotExist($path . '/resources');
        self::assertFileDoesNotExist($path . '/package.json');

        $composer = json_decode((string) file_get_contents($path . '/composer.json'), true, 512, JSON_THROW_ON_ERROR);
        self::assertArrayNotHasKey('velt/ui', $composer['require']);
        self::assertArrayNotHasKey('velt/preview', $composer['require']);
        self::assertSame('^0.2.0', $composer['require']['velt/cli']);
    }

    public function test_cross_platform_profile_adds_native_manifest_and_nativewind(): void
    {
        $path = $this->profileFixture();

        $result = (new ProjectConfigurator($path))->configure('cross-platform', 'tailwind', 'sqlite');

        self::assertSame('nativewind', $result['styling']);
        self::assertFileExists($path . '/native/velt.json');
        self::assertFileExists($path . '/routes/web.php');
        self::assertFileExists($path . '/routes/preview.php');
        $package = json_decode((string) file_get_contents($path . '/package.json'), true, 512, JSON_THROW_ON_ERROR);
        self::assertSame('^4.2.0', $package['devDependencies']['nativewind']);
        $composer = json_decode((string) file_get_contents($path . '/composer.json'), true, 512, JSON_THROW_ON_ERROR);
        self::assertSame('^0.1.0@alpha', $composer['require']['velt/native']);
    }

    private function dispatcher(): Dispatcher
    {
        $kernel = require dirname(__DIR__, 2) . '/bootstrap/app.php';

        return $kernel['dispatcher'];
    }

    private function profileFixture(): string
    {
        $path = sys_get_temp_dir() . '/velt-profile-' . bin2hex(random_bytes(6));
        foreach (['database', 'features/Home', 'features/Documentation', 'features/Preview', 'resources/css', 'routes', 'public/assets'] as $directory) {
            mkdir($path . '/' . $directory, 0777, true);
        }

        foreach (['routes/web.php', 'routes/api.php', 'routes/preview.php', 'resources/css/app.css', 'public/assets/app.css'] as $file) {
            file_put_contents($path . '/' . $file, 'fixture');
        }

        file_put_contents($path . '/.env.example', "VELT_PROJECT_TYPE=web\nVELT_STYLING=tailwind\nDB_CONNECTION=sqlite\nDB_DATABASE=database/database.sqlite\n");
        file_put_contents($path . '/composer.json', json_encode(['require' => ['php' => '^8.2', 'velt/framework' => '^0.1.0']], JSON_PRETTY_PRINT));
        file_put_contents($path . '/package.json', json_encode(['devDependencies' => ['tailwindcss' => '^3.4.17']], JSON_PRETTY_PRINT));
        file_put_contents($path . '/tailwind.config.js', 'fixture');
        file_put_contents($path . '/postcss.config.js', 'fixture');

        return $path;
    }
}
