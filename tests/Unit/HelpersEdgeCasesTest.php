<?php
declare(strict_types=1);

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

final class HelpersEdgeCasesTest extends TestCase
{
    public function test_config_missing_key_returns_default(): void
    {
        // ensure config loaded
        velt_load_config(dirname(__DIR__, 2) . '/config');

        $this->assertSame('fallback', config('does.not.exist', 'fallback'));
    }

    public function test_env_boolean_casting_and_defaults(): void
    {
        putenv('VELT_BOOL_TRUE=true');
        putenv('VELT_BOOL_FALSE=false');

        $this->assertSame('true', env('VELT_BOOL_TRUE'));
        $this->assertSame('false', env('VELT_BOOL_FALSE'));

        putenv('VELT_BOOL_TRUE');
        putenv('VELT_BOOL_FALSE');

        $this->assertSame(true, env('NON_EXISTENT_BOOL', true));
    }
}
