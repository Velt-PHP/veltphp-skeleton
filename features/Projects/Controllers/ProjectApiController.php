<?php

declare(strict_types=1);

namespace App\Projects\Controllers;

use App\Projects\Models\Project;

final class ProjectApiController
{
    /**
     * @return array{data:list<array<string, mixed>>}
     */
    public function index(): array
    {
        return [
            'data' => array_map(
                static fn (Project $project): array => $project->toArray(),
                Project::query()->orderBy('id')->get(),
            ),
        ];
    }
}
