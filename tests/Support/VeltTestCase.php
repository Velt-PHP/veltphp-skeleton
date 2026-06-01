<?php
declare(strict_types=1);

namespace Tests\Support;

use PHPUnit\Framework\TestCase;
use Velt\Http\Request;
use Velt\Http\Response;

class VeltTestCase extends TestCase
{
    protected function dispatcher()
    {
        $kernel = require dirname(__DIR__, 2) . '/bootstrap/app.php';
        return $kernel['dispatcher'];
    }

    protected function get(string $path): Response
    {
        return $this->dispatcher()->dispatch(new Request('GET', $path));
    }

    protected function post(string $path, array $data = []): Response
    {
        $req = new Request('POST', $path);
        // naive body handling for tests
        $req->setBody(json_encode($data));
        return $this->dispatcher()->dispatch($req);
    }

    protected static function assertStatus(Response $response, int $status): void
    {
        self::assertSame($status, $response->status());
    }

    protected static function assertResponseJson(Response $response): void
    {
        self::assertSame('application/json', $response->headers()['Content-Type'] ?? null);
        self::assertNotFalse(json_decode($response->body(), true));
    }

    protected static function assertSee(Response $response, string $text): void
    {
        self::assertStringContainsString($text, $response->body());
    }
}
