<?php

declare(strict_types=1);

namespace App\Projects\Models;

use Velt\Orm\Model;

final class Project extends Model
{
    protected static string $table = 'projects';

    /** @var list<string> */
    protected static array $fillable = [
        'name',
        'slug',
        'description',
        'status',
        'created_at',
        'updated_at',
    ];
}
