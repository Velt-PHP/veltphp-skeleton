<?php

declare(strict_types=1);

use Velt\Database\Schema\Blueprint;
use Velt\Database\Schema\Schema;

return new class {
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table): void {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->string('description', true);
            $table->string('status');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::drop('projects');
    }
};
