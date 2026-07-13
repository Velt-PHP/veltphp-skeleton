<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Projects\Models\Project;
use Velt\Database\Seeders\Seeder;

final class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $now = date('Y-m-d H:i:s');

        foreach ($this->projects($now) as $project) {
            if (Project::where('slug', $project['slug'])->first() !== null) {
                continue;
            }

            Project::create($project);
        }
    }

    /**
     * @return list<array<string, string>>
     */
    private function projects(string $now): array
    {
        return [
            [
                'name' => 'Welcome Flow',
                'slug' => 'welcome-flow',
                'description' => 'A polished Velt welcome page built with declarative .velt.php views.',
                'status' => 'ready',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Database Demo',
                'slug' => 'database-demo',
                'description' => 'SQLite, migrations, seeders and an ORM model wired into the default app.',
                'status' => 'ready',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];
    }
}
