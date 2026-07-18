<?php

declare(strict_types=1);

namespace App\Preview\Controllers;

use App\Preview\Services\PreviewService;
use RuntimeException;
use Velt\Http\JsonResponse;

final class PreviewController
{
    public function show(string $id): JsonResponse
    {
        try {
            return JsonResponse::json((new PreviewService())->previewPayload($id));
        } catch (RuntimeException) {
            return JsonResponse::json([
                'success' => false,
                'error' => [
                    'code' => 'preview_session_not_found',
                    'message' => 'Preview session not found.',
                ],
            ], 404);
        }
    }

    public function session(string $id): JsonResponse
    {
        $session = (new PreviewService())->findSession($id);

        if ($session === null) {
            return JsonResponse::json([
                'success' => false,
                'error' => [
                    'code' => 'preview_session_not_found',
                    'message' => 'Preview session not found.',
                ],
            ], 404);
        }

        return JsonResponse::json($session);
    }

    public function route(string $path): JsonResponse
    {
        $service = new PreviewService();

        try {
            return JsonResponse::json($service->previewViewPayload($service->viewForPath($path)));
        } catch (RuntimeException) {
            return JsonResponse::json([
                'success' => false,
                'error' => [
                    'code' => 'preview_route_not_found',
                    'message' => 'Preview route not found.',
                ],
            ], 404);
        }
    }
}
