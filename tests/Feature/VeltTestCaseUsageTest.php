<?php
declare(strict_types=1);

namespace Tests\Feature;

use Tests\Support\VeltTestCase;

final class VeltTestCaseUsageTest extends VeltTestCase
{
    public function test_get_home_and_assert_helpers(): void
    {
        $response = $this->get('/');

        self::assertStatus($response, 200);
        self::assertSee($response, 'Build once. Render for web and preview.');
    }

    public function test_api_preview_returns_json_error(): void
    {
        $response = $this->get('/api/preview/demo');

        self::assertStatus($response, 404);
        self::assertResponseJson($response);
    }
}
