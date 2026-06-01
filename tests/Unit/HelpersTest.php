<?php
declare(strict_types=1);

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

final class HelpersTest extends TestCase
{
    public function test_env_returns_default_when_missing(): void
    {
        // ensure env not set
        putenv('VELT_TEST_KEY');

        $this->assertNull(env('VELT_TEST_KEY'));
        $this->assertSame('fallback', env('VELT_TEST_KEY', 'fallback'));
    }

    public function test_env_reads_putenv(): void
    {
        putenv('VELT_TEST_KEY=hello');
        $this->assertSame('hello', env('VELT_TEST_KEY'));
        putenv('VELT_TEST_KEY');
    }

    public function test_config_loader_and_accessor(): void
    {
        // load config files from project config dir
        velt_load_config(dirname(__DIR__, 2) . '/config');

        $this->assertIsArray(config('app') ?? []);
        $this->assertSame('Velt App', config('app.name'));
        $this->assertSame('local', config('app.env'));
    }
}
